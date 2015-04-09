<?php
/*
 *  Copyright (c) 2013  Rasmus Fuhse <fuhse@data-quest.de>
 * 
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License as
 *  published by the Free Software Foundation; either version 2 of
 *  the License, or (at your option) any later version.
 */

require_once dirname(__file__)."/classes/DiplomacyTurn.class.php";
require_once dirname(__file__)."/classes/DiplomacyFutureTurn.class.php";
require_once dirname(__file__)."/classes/DiplomacyGroup.class.php";

class Diplomacy extends StudIPPlugin implements StandardPlugin {
    
    public function getTabNavigation($course_id) {
        $navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'turns/overview'));
        $navigation->setImage($this->getPluginURL()."/assets/diplomacy_white.svg");
        $navigation->setActiveImage($this->getPluginURL()."/assets/diplomacy_black.svg");
        $navigation->addSubNavigation("overview", new AutoNavigation(_("Rundenübersicht"), PluginEngine::getURL($this, array(), 'turns/overview')));
        if ($GLOBALS['perm']->have_studip_perm("tutor", $course_id)
                && DiplomacyFutureTurn::countBySQL("seminar_id = ?", array($course_id)) > 0) {
            $navigation->addSubNavigation("scheduled", new AutoNavigation(_("Geplante Rundenwechsel"), PluginEngine::getURL($this, array(), 'turns/scheduled')));
        }
        $navigation->addSubNavigation("timeline", new AutoNavigation(_("Historie"), PluginEngine::getURL($this, array(), 'turns/timeline')));
        $navigation->addSubNavigation("rules", new AutoNavigation(_("Regel-Vorschläge"), PluginEngine::getURL($this, array(), 'rules')));
        return array("diplomacy" => $navigation);
    }
    
    public function rules_action() {
        $template = $this->getTemplate("regeln.php");
        $template->set_attribute("plugin", $this);
        echo $template->render();
    }
    
    public function getInfoTemplate($course_id) {
        return null;
    }
    
    public function getIconNavigation($course_id, $last_visit, $user_id = null) {
        $icon_navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'turns/overview'));
        $new_turns = DiplomacyTurn::findBySQL("Seminar_id = ? AND mkdate > ?", array($course_id, $last_visit));
        if (count($new_turns)) {
            $icon_navigation->setImage($this->getPluginURL()."/assets/diplomacy_red.svg", array('title' => _("Neue Runde in Diplomacy!"), 'width' => "16px"));
            $icon_navigation->setTitle(_("Neue Runde in Diplomacy!"));
        } else {
            $icon_navigation->setImage($this->getPluginURL()."/assets/diplomacy_grey.svg", array('title' => _("Diplomacy"), 'width' => "16px"));
        }
        return $icon_navigation;
    }
    
    public function getNotificationObjects($course_id, $since, $user_id)
    {
        return array();
    }
    
    protected function getTemplate($template_file_name, $layout = "without_infobox") {
        if (!$this->template_factory) {
            $this->template_factory = new Flexi_TemplateFactory(dirname(__file__)."/templates");
        }
        $template = $this->template_factory->open($template_file_name);
        if ($layout) {
            if (method_exists($this, "getDisplayName")) {
                PageLayout::setTitle($this->getDisplayName());
            } else {
                PageLayout::setTitle(get_class($this));
            }
            $template->set_layout($GLOBALS['template_factory']->open($layout === "without_infobox" ? 'layouts/base_without_infobox' : 'layouts/base'));
        }
        return $template;
    }
}