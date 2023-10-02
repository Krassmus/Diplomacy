<?
$types = [
    'land' => _('Land'),
    'water' => _('Meer'),
    'coast' => _('Küste')
];
?>
<table class="default">
    <caption>
        <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/overview')?>">
            <?= Icon::create('home', Icon::ROLE_CLICKABLE)->asImg(25, ['class' => 'text-bottom']) ?>
        </a>
        »
        <?= htmlReady($map['name']) ?>
    </caption>
    <thead>
        <tr>
            <th><?= _('Abkürzung') ?></th>
            <th><?= _('Provinz / Gebiet') ?></th>
            <th><?= _('Typ') ?></th>
            <th><?= _('Stützpunkt') ?></th>
            <th><?= _('Verknüpfungen') ?></th>
            <th class="actions"></th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($map->provinces as $province) : ?>
        <tr>
            <td>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/editprovince/'.$map->id.'/'.$province->id) ?>"
                   id="province_<?= htmlReady($province->id) ?>"
                   title="<?= _('Provinz bearbeiten') ?>"
                   data-dialog>
                    <?= htmlReady($province['name']) ?>
                </a>
            </td>
            <td><?= htmlReady($province['longname']) ?></td>
            <td><?= $types[$province['type']] ?></td>
            <td>
                <? if ($province['base']) : ?>
                    <?= Icon::create('checkbox-checked', Icon::ROLE_INFO)->asImg(20, ['class' => 'text-bottom']) ?>
                <? endif ?>
            </td>
            <td>
                <?= count($province->connections) ?>
            </td>
            <td class="actions">
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/editprovince/'.$map->id.'/'.$province->id) ?>"
                   title="<?= _('Provinz bearbeiten') ?>"
                   data-dialog>
                    <?= Icon::create('edit', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <form class="inline" action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/province_delete/'.$province->id)?>"
                      data-confirm="<?= _('Provinz / Gebiet wirklich löschen?') ?>"
                      title="<?= _('Provinz löschen') ?>"
                      method="post">
                    <?= Icon::create('trash', Icon::ROLE_CLICKABLE)->asInput(20, ['class' => 'text-bottom']) ?>
                </form>
            </td>
        </tr>
        <? endforeach ?>
        <? if (!count($map->provinces)) : ?>
            <tr>
                <td colspan="100">
                    <?= _('Noch keine Provinzen') ?>
                </td>
            </tr>
        <? endif ?>
    </tbody>
</table>

<?

$actions = new ActionsWidget();
$actions->addLink(
    _('Neue Provinz erstellen'),
    PluginEngine::getURL($plugin, [], 'mapadmin/editprovince/'.$map->id),
    Icon::create('add', Icon::ROLE_CLICKABLE),
    ['data-dialog' => 1]
);
Sidebar::Get()->addWidget($actions);
