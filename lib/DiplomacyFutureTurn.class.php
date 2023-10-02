<?php

class DiplomacyFutureTurn extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacyfutureturns';
        $config['belongs_to']['course'] = array(
            'class_name' => 'Course',
            'foreign_key' => 'Seminar_id'
        );
        parent::configure($config);
    }
}
