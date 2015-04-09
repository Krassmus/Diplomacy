<?php

require_once 'app/controllers/plugin_controller.php';
require_once 'lib/datei.inc.php';

class TurnsController extends PluginController {

    function before_filter(&$action, &$args)
    {
        parent::before_filter($action, $args);
        Navigation::activateItem("/course/diplomacy");
        PageLayout::addScript($this->plugin->getPluginURL()."/assets/javascript/diplomacy.js");
    }

    public function overview_action() {
        $this->turns = DiplomacyTurn::findBySQL("Seminar_id = ? ORDER BY mkdate DESC", array($_SESSION['SessionSeminar']));
        $this->nations = Statusgruppen::findBySQL("range_id = ? ORDER BY position ASC", array($_SESSION['SessionSeminar']));
    }

    public function view_action($turn_id = null) {
        if (!$turn_id) {
            $turn_id = Request::option("turn_id");
        }
        $this->turn = new DiplomacyTurn($turn_id);
        $this->turns = DiplomacyTurn::findBySQL("Seminar_id = ? ORDER BY mkdate DESC", array($_SESSION['SessionSeminar']));
        if (Request::get('command') && Request::isPost() && $this->turn->isLatestTurn()) {
            $gruppe = new DiplomacyGroup(Request::option("statusgruppe_id"));
            if ($gruppe->amIMember()) {
                $command = $this->turn->getMyCommand($gruppe->getId());
                $command['content'] = Request::get('command');
                $command['iamdone'] = Request::int('iamdone');
                $command['statusgruppe_name'] = $gruppe['name'];
                $success = $command->store();
                PageLayout::postMessage(MessageBox::success(_("Befehle wurden gespeichert, können aber bis zum Ende der Runde jederzeit geändert werden.")));
            } else {
                throw new AccessDeniedException("Unerlaubter Zugriff auf Gruppe");
            }
        }

        $this->statusgruppen = DiplomacyGroup::findMine($this->turn['Seminar_id']);
    }

    public function edit_action($turn_id = null)
    {
        if (!$GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) {
            throw new AccessDeniedException("Kein Zugriff");
        }
        $this->turn = new DiplomacyTurn($turn_id);
        Navigation::activateItem("/course/diplomacy");
        if (Request::isPost() && (!$this->turn['Seminar_id'] or $this->turn['Seminar_id'] === $_SESSION['SessionSeminar'])) {
            if ($this->turn->isNew() && Request::get("start_date")) {
                $this->turn = new DiplomacyFutureTurn();
                $this->turn['Seminar_id'] = $_SESSION['SessionSeminar'];
                $this->turn['name'] = Request::get("name");
                $this->turn['description'] = Request::get("description");
                $this->turn['start_time'] = strtotime(Request::get("start_date") ." ". Request::get("start_time"));
                $this->turn['whenitsdone'] = Request::int("whenitsdone");
                $this->turn->store();
                PageLayout::postMessage(MessageBox::success(_("Neuer Rundenwechsel wurde eingeplant. Der Rundenwechsel wird automatisch vollzogen, sobald die Zeit gekommen ist.")));
                $this->redirect("turns/overview");
                return;
            }
            $this->turn['Seminar_id'] = $_SESSION['SessionSeminar'];
            $this->turn['name'] = Request::get("name");
            $this->turn['description'] = Request::get("description");
            $success = $this->turn->store();
            if (count($_FILES)) {
                $folder_id = md5("DIPLOMACY_MAP_FOLDER_".$_SESSION['SessionSeminar']);
                $folder = new DocumentFolder($folder_id);
                if ($folder->isNew()) {
                    $folder['name'] = "Diplomacy Karten";
                    $folder['range_id'] = $_SESSION['SessionSeminar'];
                    $folder['seminar_id'] = $_SESSION['SessionSeminar'];
                    $folder['user_id'] = $GLOBALS['user']->id;
                    $folder['permission'] = 7;
                    $folder->store();
                }
                validate_upload($_FILES['map']);
                //upload($_FILES['map'], true, $folder_id);
                $document = array();
                $document['name'] = $document['filename'] = studip_utf8decode(strtolower($_FILES['map']['name']));
                $document['user_id'] = $GLOBALS['user']->id;
                $document['author_name'] = get_fullname();
                $document['seminar_id'] = $_SESSION['SessionSeminar'];
                $document['range_id'] = $folder_id;
                $document['filesize'] = $_FILES['map']['size'];
                $newfile = StudipDocument::createWithFile($_FILES['map']['tmp_name'], $document);
                if ($newfile) {
                    $this->turn['document_id'] = $newfile->getId();
                    $this->turn->store();
                }
            }
            if (Request::get("delete_map")) {
                $this->turn['document_id'] = null;
                $this->turn->store();
            }
            PageLayout::postMessage(MessageBox::success(_("Zug wurde gespeichert.")));
            $this->redirect("turns/overview");
        }

    }

    public function timeline_action() {
        $this->turns = DiplomacyTurn::findBySQL("Seminar_id = ? AND document_id IS NOT NULL ORDER BY mkdate DESC", array($_SESSION['SessionSeminar']));
    }

    public function scheduled_action() {
        if (!$GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) {
            throw new AccessDeniedException("Kein Zugriff");
        }
        $this->turns = DiplomacyFutureTurn::findBySQL("Seminar_id = ? ORDER BY start_time DESC", array($_SESSION['SessionSeminar']));
    }
}