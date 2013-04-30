<?php

require_once dirname(__file__)."/DiplomacyCommand.class.php";

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
}
