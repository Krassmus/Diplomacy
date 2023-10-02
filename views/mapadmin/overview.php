<table class="default">
    <caption>
        <?= _('Diplomacy-Karten') ?>
    </caption>
    <thead>
        <tr>
            <th><?= _('Kartenname') ?></th>
            <th class="actions"><?= _('Aktion') ?></th>
        </tr>
    </thead>
    <tbody>
    <? foreach ($maps as $map) : ?>
        <tr>
            <td>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/provinces/'.$map->id) ?>">
                    <?= htmlReady($map['name']) ?>
                </a>
            </td>
            <td class="actions">
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/edit/'.$map->id) ?>" data-dialog title="<?= _('Kartendaten bearbeiten') ?>">
                    <?= Icon::create('edit', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/nations/'.$map->id) ?>" title="<?= _('Nationen bearbeiten') ?>">
                    <?= Icon::create($this->plugin->getPluginURL().'/assets/flag_blue.svg', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/provinces/'.$map->id) ?>" title="<?= _('Provinzen bearbeiten') ?>">
                    <?= Icon::create('globe', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/download/'.$map->id)?>" download="<?= htmlReady($map['name'].'.dipl') ?>" title="<?= _('Karte herunterladen') ?>">
                    <?= Icon::create('download', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <form action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/delete/'.$map->id) ?>"
                      method="post"
                      class="inline"
                      data-confirm
                      title="<?= _('Karte löschen') ?>">
                    <?= Icon::create('trash', Icon::ROLE_CLICKABLE)->asInput(20, ['class' => 'text-bottom']) ?>
                </form>
            </td>
        </tr>
    <? endforeach ?>
    <? if (!count($maps)) : ?>
    <tr>
        <td colspan="100">
            <?= _('Noch keine Karten') ?>
        </td>
    </tr>
    <? endif ?>
    </tbody>
</table>

<?

$actions = new ActionsWidget();
$actions->addLink(
    _('Neue Karte erstellen'),
    PluginEngine::getURL($plugin, [], 'mapadmin/edit'),
    Icon::create('add', Icon::ROLE_CLICKABLE),
    ['data-dialog' => 1]
);
Sidebar::Get()->addWidget($actions);
