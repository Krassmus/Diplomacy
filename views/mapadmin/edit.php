<form class="default"
      action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/edit/'.$map->id) ?>"
      method="post">

    <label>
        <?= _('Name') ?>
        <input type="text" name="name" value="<?= htmlReady($map['name']) ?>" required>
    </label>

    <label>
        <?= _('Startjahr') ?>
        <input type="number" name="starting_year" value="<?= htmlReady($map['starting_year']) ?>" required>
    </label>

    <label>
        <?= _('Beschreibung') ?>
        <textarea name="description"><?= htmlReady($map['description']) ?></textarea>
    </label>

    <div data-dialog-button>
        <?= \Studip\Button::create(_('Speichern')) ?>
    </div>
</form>
