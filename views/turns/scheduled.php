<table class="default future_turns">
    <caption>
        <?= _("Geplante Rundenwechsel") ?>
    </caption>
    <thead>
        <tr>
            <th><?= _("Runde") ?></th>
            <th><?= _("Startzeit") ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? if (count($turns)) : ?>
        <? foreach ($turns as $turn) : ?>
        <tr data-turn_id="<?= $turn->getId() ?>" class="turn">
            <td>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/editfuture/".$turn->getId()) ?>">
                    <?= Assets::img("icons/16/blue/edit", array('class' => "text-bottom")) ?>
                    <?= htmlReady($turn['name']) ?>
                </a>
            </td>
            <td><?= date("j.n.Y - G:i", $turn['start_time']) ?> <?= _("Uhr") ?></td>
            <td>
                <a href="<?= PluginEngine::getLink($plugin, array(), 'turns/deletefuture/'.$turn->getId()) ?>" onClick="return window.confirm('<?= _("Wirklich löschen?") ?>');">
                    <?= Assets::img("icons/20/blue/trash", array('class' => "text-bottom")) ?>
                </a>
            </td>
        </tr>
        <? endforeach ?>
        <? else : ?>
        <tr>
            <td colspan="3"><?= _("Keine Rundenwechsel in Planung.") ?></td>
        </tr>
        <? endif ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
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
jQuery(".future_turns tr.turn").live("click", function () {
    var turn_id = jQuery(this).attr('data-turn_id');
    location.href = STUDIP.URLHelper.getURL(STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/diplomacy/turns/editfuture/" + turn_id, {
        'cid': '<?= Request::option('cid') ?>'
    });
});
</script>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");
