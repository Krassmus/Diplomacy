<?
$label = _("Name der Spielrunde");
?>
<form action="<?= PluginEngine::getLink($plugin, array(), 'turns/editfuture/'.$turn->getId()) ?>" method="post" enctype="multipart/form-data">
    <input type="text"
           name="name"
           value="<?= htmlReady($turn['name']) ?>"
           style="width: 100%; font-size: 1.8em; font-weight: bold;"
           placeholder="<?= $label ?>"
           aria-label="<?= $label ?>">
    <br>

    <textarea name="description" style="width: 100%; height: 150px;"><?= htmlReady($turn['description']) ?></textarea>

    <div>
    <label for="start_date">
        <?= _("Optional: Runde soll noch nicht sofort starten, sondern erst ...") ?>
    </label>
    </div>
    <input type="date" name="start_date" id="start_date" value="<?= date("d.m.Y", $turn['start_time']) ?>" required>
    <input type="text" name="start_time" value="<?= date("H:i", $turn['start_time']) ?>" required>
    <script>
        jQuery(function () {
            jQuery("#start_date").datepicker();
        });
    </script>

    <div>
        <label id="whenitsdone">
            <input type="checkbox" name="whenitsdone" value="1"<?= $turn['whenitsdone'] ? " checked" : "" ?>>
            <?= _("Runde fängt automatisch früher an, wenn alle Spieler bestätigen, dass sie fertig sind.") ?>
        </label>
    </div>

    <div style="text-align: center">
        <?= \Studip\Button::createAccept(_("Speichern"), array('onclick' => 'window.setTimeout(function () { jQuery(this).attr("disabled", "disabled"); }, 10);'))?>
    </div>
</form>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");