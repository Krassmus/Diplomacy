<?php
/*
 *  Copyright (c) 2012  Rasmus Fuhse <fuhse@data-quest.de>
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
 */

class InitPlugin extends DBMigration
{
    function up() {
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `diplomacyturns` (
                `turn_id` varchar(32) NOT NULL,
                `Seminar_id` varchar(32) NOT NULL,
                `name` varchar(64) DEFAULT NULL,
                `document_id` varchar(32) NULL,
                `description` text DEFAULT NULL,
                `chdate` bigint(20) NOT NULL,
                `mkdate` bigint(20) NOT NULL,
                PRIMARY KEY (`turn_id`),
                KEY `Seminar_id` (`Seminar_id`)
            ) ENGINE=MyISAM;
        ");
        DBManager::get()->exec("
            CREATE TABLE IF NOT EXISTS `diplomacycommands` (
                `turn_id` varchar(32) NOT NULL,
                `statusgruppe_id` varchar(32) NOT NULL,
                `statusgruppe_name` varchar(256) NOT NULL,
                `content` text NOT NULL,
                `chdate` bigint(20) NOT NULL,
                `mkdate` bigint(20) NOT NULL,
                PRIMARY KEY (`turn_id`,`statusgruppe_id`)
            ) ENGINE=MyISAM;
        ");
    }
    
    function down() {
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacyturns` ");
        DBManager::get()->exec("DROP TABLE IF EXISTS `diplomacycommands` ");
    }
    
    
}