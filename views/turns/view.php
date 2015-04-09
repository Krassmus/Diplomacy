<h1><?= htmlReady($turn['name']) ?></h1>
<? if ($turn['document_id']) : ?>
    <img src="<?= GetDownloadLink($turn['document_id'], "Map.jpg") ?>" width="100%" style="display: block;">
<? endif ?>

<div class="turn_description">
<?= formatReady($turn['description']) ?>
</div>

<? if ($GLOBALS['perm']->have_studip_perm("tutor", $_SESSION['SessionSeminar'])) : ?>
    <div style="text-align: center;">
        <?= Studip\LinkButton::create(_("Bearbeiten"), PluginEngine::getURL($plugin, array(), "turns/edit/".$turn->getId())) ?>
    </div>
<? endif ?>

<? if ($turn->isLatestTurn()) : ?>
    <? foreach ($statusgruppen as $gruppe) : ?>
    <form action="<?= URLHelper::getLink("?") ?>" method="post">
        <input type="hidden" name="statusgruppe_id" value="<?= $gruppe->getId() ?>">
        <input type="hidden" name="turn_id" value="<?= $turn->getId() ?>">
        <? $command = $turn->getMyCommand($gruppe->getId()) ?>
        <label>
            <h2><?= sprintf(_("Befehle von %s in der aktuellen Runde"), htmlReady($command['statusgruppe_name'])) ?></h2>
            <textarea name="command" style="width: 100%; height: 200px;"><?= $command ? htmlReady($command['content']) : "" ?></textarea>
        </label>

        <? $futureturn = DiplomacyFutureTurn::findOneBySQL("seminar_id = ? ORDER BY start_time ASC", array($_SESSION['SessionSeminar'])); ?>
        <? if ($futureturn && $futureturn['whenitsdone']) : ?>
            <label>
                <input type="checkbox" name="iamdone" value="1"<?= $command['iamdone'] ? " checked" : "" ?>>
                <?= _("Ich bin fertig und einverstanden, und der Rundenwechsel kann meinetwegen jederzeit stattfinden.") ?>
            </label>
        <? endif ?>

        <?= Studip\Button::createAccept(_("Speichern")) ?>
    </form>
    <? endforeach ?>
<? else : ?>
    <? foreach ($turn->commands as $command) : ?>
    <div>
        <h2><?= htmlReady(DiplomacyGroup::find($command['statusgruppe_id'])->name) ?></h2>
        <div class="command">
        <?= nl2br(htmlReady($command['content'])) ?>
        </div>
    </div>
    <? endforeach ?>
<? endif; ?>

<style>
    .selection {
        background-color: yellow;
    }
</style>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");

$selector = new SelectorWidget();
$selector->setTitle(_("Zughistorie"));
$selector->setUrl(PluginEngine::getURL($plugin, array(), "turns/view"));
$selector->setSelectParameterName("turn_id");
foreach ($turns as $t) {
    $selector->addElement(new SelectElement($t->getId(), $t['name']));
}
$selector->setSelection($turn->getId());

Sidebar::Get()->addWidget($selector);