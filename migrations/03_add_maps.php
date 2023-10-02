<?php

class AddMaps extends Migration
{
    function up() {
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_maps` (
                `map_id` char(32) NOT NULL,
                `name` varchar(32) DEFAULT NULL,
                `description` text DEFAULT NULL,
                `starting_year` int(11) DEFAULT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`map_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_nations` (
                `nation_id` char(32) NOT NULL,
                `variant_id` char(32) NOT NULL,
                `name` varchar(20) NOT NULL,
                `starting_positions` text DEFAULT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`nation_id`),
                KEY `variant_id` (`variant_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_provinces` (
                `province_id` char(32) NOT NULL,
                `map_id` char(32) NOT NULL,
                `type` enum('land','water','coast') DEFAULT NULL,
                `name` varchar(10) DEFAULT NULL,
                `longname` varchar(40) DEFAULT NULL,
                `base` tinyint(1) NOT NULL DEFAULT 0,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`province_id`),
                KEY `map_id` (`map_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_starting_variants` (
                `variant_id` char(32) NOT NULL,
                `name` varchar(40) NOT NULL,
                `map_id` char(32) NOT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`variant_id`),
                KEY `map_id` (`map_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_connections` (
                `connection_id` char(32) NOT NULL,
                `province_a_id` char(32) NOT NULL,
                `subarea_a` varchar(20) DEFAULT NULL,
                `province_b_id` char(32) NOT NULL,
                `subarea_b` varchar(20) DEFAULT NULL,
                `type` enum('water','land') NOT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`connection_id`)
            )
        ");
        DBManager::get()->exec("
            CREATE TABLE `diplomacy_games` (
                `course_id` char(32) NOT NULL,
                `map_id` char(32) NOT NULL,
                `variant_id` char(32) DEFAULT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`course_id`),
                KEY `map_id` (`map_id`),
                KEY `variant_id` (`variant_id`)
            )
        ");
        DBManager::get()->exec("
            INSERT INTO `diplomacy_games` (`course_id`, `map_id`, `variant_id`, `chdate`, `mkdate`)
            SELECT `tools_activated`.`range_id`, 'blank', NULL, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
            FROM `tools_activated`
                INNER JOIN `plugins` ON (`tools_activated`.`plugin_id` = `plugins`.`pluginid`)
            WHERE `plugins`.`pluginclassname` = 'Diplomacy'
        ");


    }

    function down()
    {
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_maps` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_nations` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_provinces` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_starting_variants` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_connections` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacy_games` ");
    }


}
