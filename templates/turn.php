<? if ($turn->isLatestTurn()) : ?>
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
    <? foreach ($turn->commands as $command) : ?>
    <div class="command">
        <h2><?= htmlReady(DiplomacyGroup::find($command['statusgruppe_id'])->name) ?></h2>
        <?= formatReady($command['content']) ?>
    </div>
    <? endforeach ?>
<? endif; ?>
