<h1><?= htmlReady($turn['name']) ?></h1>
<? if ($turn['document_id']) : ?>
    <img src="<?= GetDownloadLink($turn['document_id'], "Map.jpg") ?>" width="100%" style="display: block;">
<? endif ?>

<div class="turn_description">
<?= formatReady($turn['description']) ?>
</div>

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
        <div class="command">
        <?= nl2br(htmlReady($command['content'])) ?>
        </div>
    </div>
    <? endforeach ?>
<? endif; ?>

<?
$selector = new SelectorWidget();
$selector->setTitle(_("Zughistorie"));
$selector->setUrl(PluginEngine::getURL($plugin, array(), "turns/view"));
$selector->setSelectParameterName("turn_id");
foreach ($turns as $t) {
    $selector->addElement(new SelectElement($t->getId(), $t['name']));
}
$selector->setSelection($turn->getId());

Sidebar::Get()->addWidget($selector);