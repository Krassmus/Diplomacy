<form action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/variant_edit/'.$map->id.'/'.$variant->id) ?>"
      method="post"
      class="default">

    <?= MessageBox::info(_('Spielervarianten dienen dazu, eine Karte mal mit 7 oder mal mit 6 Spielern zu spielen. Dazu kann man die Startpositionen der Ländern variieren.')) ?>

    <label>
        <?= _('Name') ?>
        <input type="text" name="name" value="<?= htmlReady($variant['name']) ?>">
    </label>

    <div data-dialog-button>
        <?= \Studip\Button::create(_('Speichern')) ?>
    </div>
</form>
