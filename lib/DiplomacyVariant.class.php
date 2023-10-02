<?php

class DiplomacyVariant extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_starting_variants';
        $config['belongs_to']['map'] = array(
            'class_name' => 'DiplomacyMap',
            'foreign_key' => 'map_id'
        );
        $config['has_many']['nations'] = array(
            'class_name' => DiplomacyNation::class,
            'foreign_key' => 'variant_id',
            'order_by' => 'ORDER BY name ASC'
        );
        parent::configure($config);
    }

}
