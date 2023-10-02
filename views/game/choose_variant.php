<form action="<?= PluginEngine::getLink($plugin, [], 'game/choose_variant/'.($map ? $map->id : 'blank'))?>"
      method="post">
    <ul class="clean diplomacymaps">
        <? if ($map) : ?>
        <? foreach ($map->variants as $variant) : ?>
            <li>
                <button name="variant_id" value="<?= htmlReady($variant->id) ?>">
                    <h3><?= htmlReady($variant['name']) ?></h3>
                </button>
            </li>
        <? endforeach ?>
        <? else : ?>
            <li>
                <button>
                    <h3><?= _('Flexibles Spiel') ?></h3>
                    <p>
                        <?= _('Erstelle für jeden Spieler eine Teilnehmergruppe in der Veranstaltung, und dann kann es los gehen.') ?>
                    </p>
                </button>
            </li>
        <? endif ?>
    </ul>
</form>
