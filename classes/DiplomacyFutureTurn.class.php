<?php

class DiplomacyFutureTurn extends SimpleORMap {
    
    public function __construct($id = null)
    {
        $this->db_table = "diplomacyfutureturns";
        $this->belongs_to = array(
            'course' => array(
                'class_name' => 'Course',
                'foreign_key' => 'Seminar_id'
            ),
        );
        parent::__construct($id);
    }
}
