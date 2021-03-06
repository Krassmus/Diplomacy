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

    <div style="padding: 10px; text-align: center">
        <label style="cursor: pointer;">
            <input type="file" name="map" style="display: none;">
            <?= Assets::img("icons/16/blue/upload", array('class' => "text-bottom")) ?>
            <?= _("Karte hochladen") ?>
        </label>

        <? if ($turn['document_id']) : ?>
        <label>
            <input type="checkbox" name="delete_map" value="1">
            <?= _("Alte Karte l�schen") ?>
        </label>
        <? endif ?>
    </div>

    <textarea name="description" style="width: 100%; height: 150px;"><?= htmlReady($turn['description']) ?></textarea>

    <? if ($turn->isNew()) : ?>
        <div>
        <label for="start_date">
            <?= _("Optional: Runde soll noch nicht sofort starten, sondern erst ...") ?>
        </label>
        </div>
        <input type="date" name="start_date" id="start_date" onChange="if (this.value) { jQuery('#whenitsdone').show('fade'); } else { jQuery('#whenitsdone').hide('fade'); }">
        <input type="text" name="start_time" value="12:00">
        <script>
            jQuery(function () {
                jQuery("#start_date").datepicker();
            });
        </script>

        <div>
            <label style="display: none;" id="whenitsdone">
                <input type="checkbox" name="whenitsdone" value="1" checked>
                <?= _("Runde f�ngt automatisch fr�her an, wenn alle Spieler best�tigen, dass sie fertig sind.") ?>
            </label>
        </div>
    <? endif ?>

    <div style="text-align: center">
        <?= \Studip\Button::createAccept(_("Speichern"), array('onclick' => 'window.setTimeout(function () { jQuery(this).attr("disabled", "disabled"); }, 10);'))?>
    </div>
</form>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");