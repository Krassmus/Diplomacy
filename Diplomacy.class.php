<?php
/*
 *  Copyright (c) 2013  Rasmus Fuhse <fuhse@data-quest.de>
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
 */

require_once dirname(__file__)."/lib/DiplomacyTurn.class.php";
require_once dirname(__file__)."/lib/DiplomacyFutureTurn.class.php";
require_once dirname(__file__)."/lib/DiplomacyGroup.class.php";

class Diplomacy extends StudIPPlugin implements StandardPlugin, SystemPlugin
{

    public function __construct()
    {
        parent::__construct();
        StudipAutoloader::addAutoloadPath(__DIR__ . '/lib');
        if ($GLOBALS['perm']->have_perm('root')) {
            $nav = new Navigation(_('Diplomacy-Karten'), PluginEngine::getURL($this, [], 'mapadmin/overview'));
            Navigation::addItem('/admin/locations/diplomacy', $nav);
        }
    }

    public function getTabNavigation($course_id) {
        $game = DiplomacyGame::find($course_id);
        if (!$game) {
            if (!$GLOBALS['perm']->have_studip_perm("tutor", $course_id)) {
                return [];
            }
            $navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'game/initialize'));
            $navigation->addSubNavigation("overview", new Navigation(_("Spiel starten"), PluginEngine::getURL($this, array(), 'game/initialize')));
            return array("diplomacy" => $navigation);
        } else {
            $navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'turns/overview'));
            $navigation->addSubNavigation("overview", new Navigation(_("Rundenübersicht"), PluginEngine::getURL($this, array(), 'turns/overview')));
            if ($GLOBALS['perm']->have_studip_perm("tutor", $course_id)
                && DiplomacyFutureTurn::countBySQL("seminar_id = ?", array($course_id)) > 0) {
                $navigation->addSubNavigation("scheduled", new Navigation(_("Geplante Rundenwechsel"), PluginEngine::getURL($this, array(), 'turns/scheduled')));
            }
            $navigation->addSubNavigation("timeline", new Navigation(_("Historie"), PluginEngine::getURL($this, array(), 'turns/timeline')));
            $navigation->addSubNavigation("rules", new Navigation(_("Regel-Vorschläge"), PluginEngine::getURL($this, array(), 'rules/index')));
        }
        return array("diplomacy" => $navigation);
    }


    public function getInfoTemplate($course_id) {
        return null;
    }

    public function getIconNavigation($course_id, $last_visit, $user_id = null) {
        $icon_navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'turns/overview'));
        $new_turns = DiplomacyTurn::findBySQL("Seminar_id = ? AND mkdate > ?", array($course_id, $last_visit));
        if (count($new_turns)) {
            $icon_navigation->setImage(Icon::create($this->getPluginURL()."/assets/diplomacy_red.svg"), array('title' => _("Neue Runde in Diplomacy!")));
            $icon_navigation->setTitle(_("Neue Runde in Diplomacy!"));
        } else {
            $icon_navigation->setImage(Icon::create($this->getPluginURL()."/assets/diplomacy_blue.svg"), array('title' => _("Diplomacy")));
        }
        return $icon_navigation;
    }

    public function getNotificationObjects($course_id, $since, $user_id)
    {
        return array();
    }

    public function perform($unconsumed_path)
    {
        $this->addStylesheet('assets/diplomacy.scss');
        parent::perform($unconsumed_path); // TODO: Change the autogenerated stub

    }

}
