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
require_once dirname(__file__)."/classes/DiplomacyGroup.class.php";

class Diplomacy extends StudIPPlugin implements StandardPlugin {
    
    public function getTabNavigation($course_id) {
        $navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'overview'));
        $navigation->setImage($this->getPluginURL()."/assets/white_star.png");
        $navigation->setActiveImage($this->getPluginURL()."/assets/black_star.png");
        $navigation->addSubNavigation("overview", new AutoNavigation(_("Rundenübersicht"), PluginEngine::getURL($this, array(), 'overview')));
        return array("diplomacy" => $navigation);
    }
    
    public function overview_action() {
        $template = $this->getTemplate("overview.php");
        $template->set_attribute('turns', DiplomacyTurn::findBySQL("Seminar_id = ? ORDER BY mkdate DESC", array($_SESSION['SessionSeminar'])));
        $template->set_attribute("plugin", $this);
        echo $template->render();
    }
    
    public function view_turn_action($turn_id) {
        $turn = new DiplomacyTurn($turn_id);
        Navigation::activateItem("/course/diplomacy");
        if (Request::get('command') && Request::isPost() && $turn->isLatestTurn()) {
            $gruppe = new DiplomacyGroup(Request::option("statusgruppe_id"));
            if ($gruppe->amIMember()) {
                $command = $turn->getMyCommand($gruppe->getId());
                $command['content'] = Request::get('command');
                $command['statusgruppe_name'] = $gruppe['name'];
                $success = $command->store();
                PageLayout::postMessage(MessageBox::success(_("Befehle wurden gespeichert, können aber bis zum Ende der Runde jederzeit geändert werden.")));
            } else {
                throw new AccessDeniedException("Unerlaubter Zugriff auf Gruppe");
            }
        }
        
        $template = $this->getTemplate("turn.php");
        $template->set_attribute("turn", $turn);
        $template->set_attribute('statusgruppen', DiplomacyGroup::findMine($turn['Seminar_id']));
        $template->set_attribute("plugin", $this);
        echo $template->render();
    }
    
    public function edit_turn_action($turn_id = null) {
        if (!$GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) {
            throw new AccessDeniedException("Kein Zugriff");
        }
        $turn = new DiplomacyTurn($turn_id);
        Navigation::activateItem("/course/diplomacy");
        if (Request::isPost() && (!$turn['Seminar_id'] or $turn['Seminar_id'] === $_SESSION['SessionSeminar'])) {
            $turn['Seminar_id'] = $_SESSION['SessionSeminar'];
            $turn['name'] = Request::get("name");
            $turn['description'] = Request::get("description");
            $success = $turn->store();
        }
        
        $template = $this->getTemplate("edit_turn.php");
        $template->set_attribute("turn", $turn);
        $template->set_attribute("plugin", $this);
        echo $template->render();
    }
    
    public function getInfoTemplate($course_id) {
        return null;
    }
    
    public function getIconNavigation($course_id, $last_visit, $user_id = null) {
        $icon_navigation = new Navigation(_("Diplomacy"), PluginEngine::getURL($this, array(), 'overview'));
        $new_turns = DiplomacyTurn::findBySQL("Seminar_id = ? AND mkdate > ?", array($course_id, $last_visit));
        if (count($new_turns)) {
            $icon_navigation->setImage($this->getPluginURL()."/assets/red_star.png", array('title' => _("Neue Runde in Diplomacy!")));
            $icon_navigation->setTitle(_("Neue Runde in Diplomacy!"));
        } else {
            $icon_navigation->setImage($this->getPluginURL()."/assets/grey_star.png", array('title' => _("Diplomacy")));
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