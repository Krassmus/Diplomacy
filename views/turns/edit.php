<?
$label = $turn->isNew() ? _("Name der neuen Spielrunde") : _("Name der Spielrunde");
?>
<form action="<?= PluginEngine::getLink($plugin, array(), 'turns/edit/'.$turn->getId()) ?>"
      method="post"
      class="default"
      enctype="multipart/form-data">
    <input type="text"
           name="name"
           value="<?= htmlReady($turn['name']) ?>"
           style="width: 100%; font-size: 1.6em; font-weight: bold;"
           placeholder="<?= $label ?>"
           aria-label="<?= $label ?>">
    <br>

    <div style="padding: 10px; text-align: center">
        <label style="cursor: pointer;">
            <input type="file" name="map" style="display: none;">
            <?= Icon::create('upload', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
            <?= _("Karte hochladen") ?>
        </label>

        <? if ($turn['document_id']) : ?>
        <label>
            <input type="checkbox" name="delete_map" value="1">
            <?= _("Alte Karte löschen") ?>
        </label>
        <? endif ?>
    </div>

    <label>
        <textarea name="description"><?= htmlReady($turn['description']) ?></textarea>
    </label>

    <? if ($turn->isNew()) : ?>
        <label>
            <?= _("Optional: Runde soll noch nicht sofort starten, sondern erst ...") ?>
            <input type="text" name="start_date" data-datetime-picker onChange="if (this.value) { jQuery('#whenitsdone').show('fade'); } else { jQuery('#whenitsdone').hide('fade'); }">
        </label>


        <div>
            <label style="display: none;" id="whenitsdone">
                <input type="checkbox" name="whenitsdone" value="1" checked>
                <?= _("Runde fängt automatisch früher an, wenn alle Spieler bestätigen, dass sie fertig sind.") ?>
            </label>
        </div>
    <? endif ?>

    <div data-dialog-button>
        <?= \Studip\Button::createAccept(_("Speichern"), array('onclick' => 'window.setTimeout(function () { jQuery(this).attr("disabled", "disabled"); }, 10);'))?>
    </div>
</form>
