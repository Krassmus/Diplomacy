<style>
    #diplomacy_turns {
        border-collapse: collapse;
        width: 100%;
    }
    #diplomacy_turns > thead > tr {
        background-color: #eeeeee;
        background-image: url('<?= $plugin->getPluginURL()."/assets/images/background_grey.png" ?>');
        background-repeat: repeat-x;
    }
    #diplomacy_turns > thead > tr > td {
        color: #eeeeee;
        font-weight: bold;
        text-shadow: 0px 0px 5px black;
    }
    #diplomacy_turns > tbody > tr > td {
        padding: 7px;
        padding-left: 20px;
        padding-right: 20px;
        border: #cccccc thin solid;
        cursor: pointer;
    }
    #diplomacy_turns > thead > tr > td {
        padding: 40px;
        padding-left: 20px;
        padding-right: 20px;
        border: #777777 thin solid;
        border-top: none;
    }
</style>

<table id="diplomacy_turns">
    <thead>
        <tr>
            <td><?= _("Runde") ?></td>
            <td><?= _("Abgegebene Befehle") ?></td>
            <td><?= _("Startzeit") ?></td>
        </tr>
    </thead>
    <tbody>
        <? if (count($turns)) : ?>
        <? foreach ($turns as $turn) : ?>
        <tr data-turn_id="<?= $turn->getId() ?>" class="turn">
            <td>
                <? if ($GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) : ?>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/edit/".$turn->getId()) ?>" style="float: right;"><?= Assets::img("icons/16/blue/edit", array('class' => "text-bottom")) ?></a>
                <? endif ?>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/view/".$turn->getId()) ?>"><?= htmlReady($turn['name']) ?></a></td>
            <td><?= count($turn->commands) ?></td>
            <td><?= date("j.n.Y - G:i", $turn['mkdate']) ?> <?= _("Uhr") ?></td>
        </tr>
        <? endforeach ?>
        <? else : ?>
        <tr>
            <td colspan="3"><?= _("Noch keine Runden gestartet.") ?></td>
        </tr>
        <? endif ?>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <? if ($GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) : ?>
                <a href="<?= PluginEngine::getLink($plugin, array(), 'turns/edit') ?>" title="<?= _("Neue Runde starten") ?>">
                    <?= Assets::img("icons/16/blue/add") ?>
                </a>
                <? endif ?>
            </td>
        </tr>
    </tfoot>
</table>

<div id="turn_window"></div>

<script>
jQuery("#diplomacy_turns tr.turn").live("click", function () {
    var turn_id = jQuery(this).attr('data-turn_id');
    location.href = STUDIP.URLHelper.getURL(STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/diplomacy/turns/view/" + turn_id, {
        'cid': '<?= Request::option('cid') ?>'
    });
});
</script>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");

$actions = new ActionsWidget();
if (false && count($nations) === 0) {
    $actions->addLink(_("Nationen erstellen und zuweisen"), PluginEngine::getURL($plugin, array(), 'nations/create'), null, array('data-dialog' => "1"));
} else {
    $actions->addLink(_("Nationen verwalten"), URLHelper::getURL('admin_statusgruppe.php'));
}
Sidebar::Get()->addWidget($actions);