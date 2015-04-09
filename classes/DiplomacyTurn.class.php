<?php

require_once dirname(__file__)."/DiplomacyCommand.class.php";
require_once dirname(__file__)."/DiplomacyGroup.class.php";
require_once 'lib/models/PersonalNotifications.class.php';

class DiplomacyTurn extends SimpleORMap {
    
    public function __construct($id = null)
    {
        $this->db_table = "diplomacyturns";
        $this->belongs_to = array(
            'course' => array(
                'class_name' => 'Course',
                'foreign_key' => 'Seminar_id'
            ),
        );
        $this->has_one = array(
            'map' => array(
                'class_name' => 'StudipDocument',
                'foreign_key' => 'document_id',
                'assoc_foreign_key' => 'dokument_id'
            ),
        );
        $this->has_many = array(
            'commands' => array(
                'class_name' => 'DiplomacyCommand',
                'on_delete' => 'delete',
                'on_store' => 'store'
            )
        );
        parent::__construct($id);
    }
    
    public function getMyCommand($statusgruppe_id) {
        $commands = DiplomacyCommand::findBySQL("turn_id = ? AND statusgruppe_id = ?", array($this->getId(), $statusgruppe_id));
        if (!$commands) {
            $command = new DiplomacyCommand();
            $command['statusgruppe_id'] = $statusgruppe_id;
            $command['turn_id'] = $this->getId();
            return $command;
        } else {
            return $commands[0];
        }
    }
    
    public function isLatestTurn() {
        $statement = DBManager::get()->prepare(
            "SELECT COUNT(*) " .
            "FROM diplomacyturns " .
            "WHERE Seminar_id = :seminar_id " .
                "AND mkdate > :mkdate " .
        "");
        $statement->execute(array('seminar_id' => $this['Seminar_id'], 'mkdate' => $this['mkdate']));
        return $statement->fetch(PDO::FETCH_COLUMN, 0) < 1;
    }
    
    public function store() {
        $newturn = $this->isNew();
        $success = parent::store();
        if ($success && $newturn) {
            //Benachrichtige alle Spieler
            $groups = DiplomacyGroup::findBySQL("range_id = ?", array($this['Seminar_id']));
            $users = array();
            foreach ($groups as $group) {
                $users = array_merge($users, $group->getMembers());
            }
            PersonalNotifications::add(
                array_unique($users),
                URLHelper::getURL("plugins.php/diplomacy/turns/overview", array('cid' => $this['Seminar_id'])),
                _("Eine neue Spielrunde wurde gestartet!"),
                "diplomacy_turn_".$this->getId(),
                $GLOBALS['ABSOLUTE_URI_STUDIP']."plugins_packages/RasmusFuhse/Diplomacy/assets/airship_blue.svg"
            );
        }
    }

    public function areAllPlayersDone()
    {
        $commands = $this->numberOfDonePlayers();
        $players = $this->numberOfActivePlayers();
        return $commands >= $players;
    }

    public function numberOfActivePlayers()
    {
        $statement = DBManager::get()->prepare("
                SELECT COUNT(DISTINCT statusgruppen.statusgruppe_id)
                FROM statusgruppen
                    INNER JOIN statusgruppe_user ON (statusgruppen.statusgruppe_id = statusgruppe_user.statusgruppe_id)
                WHERE statusgruppen.range_id = :seminar_id
            ");
        $statement->execute(array('seminar_id' => $this['seminar_id']));
        return $statement->fetch(PDO::FETCH_COLUMN, 0);
    }

    public function numberOfDonePlayers()
    {
        $statement = DBManager::get()->prepare("
                SELECT COUNT(*)
                FROM diplomacycommands
                WHERE turn_id = :turn_id
                    AND iamdone = '1'
            ");
        $statement->execute(array('turn_id' => $this->getId()));
        return $statement->fetch(PDO::FETCH_COLUMN, 0);
    }
}
