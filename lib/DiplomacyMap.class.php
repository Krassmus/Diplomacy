<?php

class DiplomacyMap extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_maps';
        $config['has_many']['provinces'] = array(
            'class_name' => 'DiplomacyProvince',
            'foreign_key' => 'map_id',
            'order_by' => 'ORDER BY name ASC'
        );
        $config['has_many']['variants'] = array(
            'class_name' => 'DiplomacyVariant',
            'foreign_key' => 'map_id',
            'order_by' => 'ORDER BY name ASC'
        );
        parent::configure($config);
    }

}
