<?php

class DiplomacyProvince extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_provinces';
        $config['belongs_to']['map'] = array(
            'class_name' => 'DiplomacyMap',
            'foreign_key' => 'map_id'
        );
        $config['has_many']['connections'] = array(
            'class_name' => DiplomacyConnection::class,
            'foreign_key' => 'province_id',
            'assoc_func' => 'findByProvince'
        );
        parent::configure($config);
    }

}
