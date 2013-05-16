<h1><?= htmlReady($turn['name']) ?></h1>

<div class="turn_description">
<?= formatReady($turn['description']) ?>
</div>

<? if ($turn->isLatestTurn()) : ?>
    <? $info = count($statusgruppen) ? _("Geben Sie Ihre Befehle für die aktuelle Runde an.") : _("Dies ist die aktuelle Runde. Die Befehle werden erst einsehbar, wenn sie vorbei ist.") ?>
    <? foreach ($statusgruppen as $gruppe) : ?>
    <form action="?cid=<?= Request::option('cid') ?>" method="post">
        <input type="hidden" name="statusgruppe_id" value="<?= $gruppe->getId() ?>">
        <? $command = $turn->getMyCommand($gruppe->getId()) ?>
        <label>
            <h2><?= sprintf(_("Befehle von %s in der aktuellen Runde"), htmlReady($command['statusgruppe_name'])) ?></h2>
            <textarea name="command" style="width: 100%; height: 200px;"><?= $command ? htmlReady($command['content']) : "" ?></textarea>
        </label>
        <?= Studip\Button::createAccept(_("speichern")) ?>
    </form>
    <? endforeach ?>
<? else : ?>
    <? $info = _("Es war eine sehr gute Runde.") ?>
    <? foreach ($turn->commands as $command) : ?>
    <div class="command">
        <h2><?= htmlReady(DiplomacyGroup::find($command['statusgruppe_id'])->name) ?></h2>
        <div class="command">
        <?= htmlReady(nl2br($command['content'])) ?>
        </div>
    </div>
    <? endforeach ?>
<? endif; ?>

<?
$infobox = array(
    array("kategorie" => _("Informationen"),
          "eintrag"   =>
        array(
            array(
                "icon" => "icons/16/black/info",
                "text" => $info
            )
        )
    )
);
$infobox = array(
    'picture' => $plugin->getPluginURL() . "/assets/images/infobox.png",
    'content' => $infobox
);