<style>
    #diplomacy_turns {
        border-collapse: collapse;
        width: 100%;
    }
    #diplomacy_turns > thead > tr {
        background-color: #eeeeee;
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
                <a href="<?= PluginEngine::getLink($plugin, array(), "view_turn/".$turn->getId()) ?>"><?= htmlReady($turn['name']) ?></a></td>
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
            <td><a href="<?= PluginEngine::getLink($plugin, array(), 'edit_turn') ?>"><?= Assets::img("icons/16/blue/add") ?></a></td>
        </tr>
    </tfoot>
</table>

<div id="turn_window"></div>

<script>
jQuery("#diplomacy_turns tr.turn").live("click", function () {
    var turn_id = jQuery(this).attr('data-turn_id');
    location.href = STUDIP.URLHelper.getURL(STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/diplomacy/view_turn/" + turn_id, {
        'cid': '<?= Request::option('cid') ?>'
    });
});
</script>