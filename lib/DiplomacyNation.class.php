<?php

class DiplomacyNation extends SimpleORMap
{
    static protected function configure($config = array())
    {
        $config['db_table'] = 'diplomacy_nations';
        $config['belongs_to']['variant'] = array(
            'class_name' => DiplomacyVariant::class,
            'foreign_key' => 'variant_id'
        );
        $config['serialized_fields']['starting_positions'] = 'JSONArrayObject';
        parent::configure($config);
    }

}
