<?php

class DiplomacyCommand extends SimpleORMap 
{
    public function __construct($id = null)
    {
        $this->db_table = "diplomacycommands";
        $this->belongs_to = array(
            'user' => array(
                'class_name' => 'User',
                'foreign_key' => 'user_id'
            ),
            'commands' => array(
                'class_name' => 'DiplomacyTurn',
                'foreign_key' => 'turn_id'
            )
        );
        parent::__construct($id);
    }
}
