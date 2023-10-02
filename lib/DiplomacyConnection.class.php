<?php

class DiplomacyConnection extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_connections';
        $config['belongs_to']['province_a'] = [
            'class_name' => DiplomacyProvince::class,
            'foreign_key' => 'province_a_id'
        ];
        $config['belongs_to']['province_b'] = [
            'class_name' => DiplomacyProvince::class,
            'foreign_key' => 'province_b_id'
        ];
        parent::configure($config);
    }

    static public function findByProvince($province_id)
    {
        return self::findBySQL('province_a_id = :province_id OR province_b_id = :province_id', [
            'province_id' => $province_id
        ]);
    }

}
