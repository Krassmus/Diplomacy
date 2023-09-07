<?php

class DiplomacyCommand extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacycommands';
        $config['belongs_to']['user'] = array(
            'class_name' => 'User',
            'foreign_key' => 'user_id'
        );
        $config['belongs_to']['commands'] = array(
            'class_name' => 'DiplomacyTurn',
            'foreign_key' => 'turn_id'
        );
        parent::configure($config);
    }

}
