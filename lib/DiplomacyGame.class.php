<?php

class DiplomacyGame extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_games';
        $config['belongs_to']['variant'] = array(
            'class_name' => DiplomacyVariant::class,
            'foreign_key' => 'variant_id'
        );
        $config['belongs_to']['map'] = array(
            'class_name' => DiplomacyMap::class,
            'foreign_key' => 'map_id'
        );
        parent::configure($config);
    }

}
