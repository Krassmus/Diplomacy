<?php

class DiplomacyGroup extends SimpleORMap {
    
    static public function findMine($seminar_id, $user_id = null) {
        $user_id or $user_id = $GLOBALS['user']->id;
        $statement = DBManager::get()->prepare(
            "SELECT statusgruppen.* " .
            "FROM statusgruppen " .
                "INNER JOIN statusgruppe_user ON (statusgruppen.statusgruppe_id = statusgruppe_user.statusgruppe_id) " .
            "WHERE statusgruppe_user.user_id = :user_id " .
                "AND statusgruppen.range_id = :seminar_id " .
        "");
        $statement->execute(array(
            'user_id' => $user_id,
            'seminar_id' => $seminar_id
        ));
        $groups = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($groups as $key => $group_data) {
            $groups[$key] = new DiplomacyGroup();
            $groups[$key]->setData($group_data);
            $groups[$key]->setNew(false);
        }
        return $groups;
    }
    
    public function __construct($id = null) {
        $this->db_table = "statusgruppen";
        parent::__construct($id);
    }
    
    public function amIMember($user_id = null) {
        $user_id or $user_id = $GLOBALS['user']->id;
        $statement = DBManager::get()->prepare(
            "SELECT 1 " .
            "FROM statusgruppe_user " .
            "WHERE user_id = :user_id " .
                "AND statusgruppe_id = :statusgruppe_id " .
        "");
        $statement->execute(array(
            'user_id' => $user_id,
            'statusgruppe_id' => $this->getId()
        ));
        return $statement->fetch(PDO::FETCH_COLUMN, 0);
    }
    
    public function getMembers() {
        $statement = DBManager::get()->prepare(
            "SELECT user_id FROM statusgruppe_user " .
            "WHERE statusgruppe_id = :id " .
        "");
        $statement->execute(array('id' => $this->getId()));
        return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
    }
}