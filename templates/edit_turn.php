<?
$label = $turn->isNew() ? _("Name der neuen Spielrunde") : _("Name der Spielrunde");
?>
<form action="<?= PluginEngine::getLink($plugin, array(), 'edit_turn/'.$turn->getId()) ?>" method="post">
    <input type="text" 
           name="name" 
           value="<?= htmlReady($turn['name']) ?>" 
           style="width: 100%; font-size: 1.8em; font-weight: bold;"
           placeholder="<?= $label ?>"
           aria-label="<?= $label ?>">
    <br>
    <input type="file" name="thefile">
    <textarea name="description" style="width: 100%; height: 150px;"><?= htmlReady($turn['description']) ?></textarea>
    <br>
    <?= \Studip\Button::createAccept(_("Speichern"), array('onclick' => 'window.setTimeout(function () { jQuery(this).attr("disabled", "disabled"); }, 10);'))?>
</form>
