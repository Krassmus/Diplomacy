<?
$label = $turn->isNew() ? _("Name der neuen Spielrunde") : _("Name der Spielrunde");
?>
<form action="<?= PluginEngine::getLink($plugin, array(), 'turns/edit/'.$turn->getId()) ?>" method="post" enctype="multipart/form-data">
    <input type="text"
           name="name"
           value="<?= htmlReady($turn['name']) ?>"
           style="width: 100%; font-size: 1.8em; font-weight: bold;"
           placeholder="<?= $label ?>"
           aria-label="<?= $label ?>">
    <br>

    <div style="margin: 10px; text-align: center">
        <label style="cursor: pointer;">
            <input type="file" name="map" style="display: none;">
            <?= Assets::img("icons/16/blue/upload", array('class' => "text-bottom")) ?>
            <?= _("Karte hochladen") ?>
        </label>

        <? if ($turn['document_id']) : ?>
        <label>
            <input type="checkbox" name="delete_map" value="1">
            <?= _("Alte Karte löschen") ?>
        </label>
        <? endif ?>
    </div>

    <textarea name="description" style="width: 100%; height: 150px;"><?= htmlReady($turn['description']) ?></textarea>
    <div style="text-align: center">
        <?= \Studip\Button::createAccept(_("Speichern"), array('onclick' => 'window.setTimeout(function () { jQuery(this).attr("disabled", "disabled"); }, 10);'))?>
    </div>
</form>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");