<? foreach ($map->variants as $variant) : ?>
    <article class="studip">
        <header>
            <h1>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/overview')?>">
                    <?= Icon::create('home', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                »
                <?= htmlReady($variant['name']) ?>
            </h1>
            <nav>
                <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/variant_edit/'.$map->id.'/'.$variant->id) ?>" data-dialog title="<?= _('Variante bearbeiten') ?>">
                    <?= Icon::create('edit', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                </a>
                <form class="inline" action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/variant_delete/'.$map->id.'/'.$variant->id) ?>" method="post" data-confirm="<?= _('Wollen Sie wirklich die ganze Spielervariante mit Nationen und Startpositionen löschen?') ?>">
                    <?= Icon::create('trash', Icon::ROLE_CLICKABLE)->asInput(20, ['class' => 'text-bottom']) ?>
                </form>
            </nav>
        </header>

        <table class="default">
            <thead>
                <tr>
                    <th><?= _('Nation') ?></th>
                    <th><?= _('Startstützpunkte') ?></th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
            <? foreach ($variant->nations as $nation) : ?>
                <tr>
                    <td><?= htmlReady($nation['name']) ?></td>
                    <td>
                        <?
                        $number = 0;
                        if ($nation->starting_positions) {
                            foreach ($nation->starting_positions as $unit) {
                                if ($unit['type'] != 'area') {
                                    $number++;
                                }
                            }
                        }
                        echo $number;
                        ?>
                    </td>
                    <td class="actions">
                        <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/edit_nation/'.$variant->id.'/'.$nation->id) ?>" data-dialog>
                            <?= Icon::create('edit', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                        </a>
                    </td>
                </tr>
            <? endforeach ?>
            <? if (!count($variant->nations)) : ?>
            <tr>
                <td colspan="100">
                    <?= _('Noch keine Nation vorhanden.') ?>
                </td>
            </tr>
            <? endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="100">
                        <a href="<?= PluginEngine::getLink($plugin, [], 'mapadmin/edit_nation/'.$variant->id.'/') ?>"
                           data-dialog>
                            <?= Icon::create('add', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                            <?= _('Neue Nation anlegen') ?>
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </article>
<? endforeach ?>

<?

$actions = new ActionsWidget();
$actions->addLink(
    _('Startvariante hinzufügen'),
    PluginEngine::getURL($plugin, [], 'mapadmin/variant_edit/'.$map->id),
    Icon::create('add', Icon::ROLE_CLICKABLE),
    ['data-dialog' => 1]
);
Sidebar::Get()->addWidget($actions);
