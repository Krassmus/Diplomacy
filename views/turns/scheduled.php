<table class="default future_turns">
    <thead>
        <tr>
            <td><?= _("Runde") ?></td>
            <td><?= _("Startzeit") ?></td>
        </tr>
    </thead>
    <tbody>
        <? if (count($turns)) : ?>
        <? foreach ($turns as $turn) : ?>
        <tr data-turn_id="<?= $turn->getId() ?>" class="turn">
            <td>
                <a href="<?= PluginEngine::getLink($plugin, array(), "turns/editfuture/".$turn->getId()) ?>" style="float: right;">
                    <?= Assets::img("icons/16/blue/edit", array('class' => "text-bottom")) ?>
                    <?= htmlReady($turn['name']) ?>
                </a>
            </td>
            <td><?= date("j.n.Y - G:i", $turn['start_time']) ?> <?= _("Uhr") ?></td>
        </tr>
        <? endforeach ?>
        <? else : ?>
        <tr>
            <td colspan="2"><?= _("Noch keine Runden gestartet.") ?></td>
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
jQuery(".future_turns tr.turn").live("click", function () {
    var turn_id = jQuery(this).attr('data-turn_id');
    location.href = STUDIP.URLHelper.getURL(STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/diplomacy/turns/editfuture/" + turn_id, {
        'cid': '<?= Request::option('cid') ?>'
    });
});
</script>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");
