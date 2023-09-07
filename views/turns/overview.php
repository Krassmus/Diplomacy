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
        <? foreach ($turns as $key => $turn) : ?>
        <? if ($key === 0) {
            $futureturn = DiplomacyFutureTurn::findOneBySQL("seminar_id = ? ORDER BY start_time DESC LIMIT 1", array(Context::get()->id));
        } else {
            $futureturn = null;
        } ?>
        <tr data-turn_id="<?= $turn->getId() ?>" class="turn">
            <td>
                <? if ($GLOBALS['perm']->have_studip_perm("tutor", Context::get()->id)) : ?>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/edit/".$turn->getId()) ?>" style="float: right;" data-dialog>
                    <?= Icon::create("edit", Icon::ROLE_CLICKABLE)->asImg(20, array('class' => "text-bottom")) ?>
                </a>
                <? endif ?>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/view/".$turn->getId()) ?>">
                    <?= htmlReady($turn['name']) ?>
                </a>
                <? if ($futureturn) : ?>
                    <div style="font-size: 0.8em;">
                        <?= sprintf(_("Endet automatisch am %s um %s Uhr."), date("d.m.Y", $futureturn['start_time']), date("H:i", $futureturn['start_time'])) ?>
                    </div>
                <? endif ?>
            </td>
            <td>
                <?= count($turn->commands) ?>
                <? if ($futureturn && $futureturn['whenitsdone']) : ?>
                    <div style="font-size: 0.8em;">
                        <?= sprintf(_("%s von %s Spieler sind fertig."), $turn->numberOfDonePlayers(), $turn->numberOfActivePlayers()) ?>
                    </div>
                <? endif ?>
            </td>
            <td><?= date("j.n.Y - G:i", $turn['mkdate']) ?> <?= _("Uhr") ?></td>
        </tr>
        <? endforeach ?>
        <? else : ?>
        <tr>
            <td colspan="3"><?= _("Noch keine Runden gestartet.") ?></td>
        </tr>
        <? endif ?>
    </tbody>
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
$actions = new ActionsWidget();
if ($GLOBALS['perm']->have_studip_perm("tutor", Context::getId())) {
    $actions->addLink(
        _("Neue Runde starten"),
        PluginEngine::getURL($plugin, array(), 'turns/edit'),
        Icon::create('add', Icon::ROLE_CLICKABLE),
        ['data-dialog' => 1]
    );
    $actions->addLink(
        _("Nationen verwalten"),
        URLHelper::getURL('dispatch.php/course/statusgroups'),
        Icon::create('admin', Icon::ROLE_CLICKABLE)
    );
}
Sidebar::Get()->addWidget($actions);
