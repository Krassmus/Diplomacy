<ul class="clean diplomacymaps">
    <? foreach ($maps as $map) : ?>
    <li>
        <a href="<?= PluginEngine::getLink($plugin, [], 'game/choose_variant/'.$map->id) ?>" data-dialog>
            <h3><?= htmlReady($map['name']) ?></h3>
            <p>
                <?= htmlReady($map['description']) ?>
            </p>

            <? if (count($map->variants) > 1) : ?>
            <ul>
                <? foreach ($map->variants as $variant) : ?>
                <li>
                    <?= htmlReady($variant['name']) ?>
                </li>
                <? endforeach ?>
            </ul>
            <? endif ?>
        </a>
    </li>
    <? endforeach ?>
    <li>
        <a href="<?= PluginEngine::getLink($plugin, [], 'game/choose_variant/blank') ?>" data-dialog>
            <h3><?= _('Flexibles Spiel') ?></h3>
            <p><?= _('Maximale Freiheit. Aber es muss selbst ausgewertet und selbst die Karte gezeichnet werden.') ?></p>
        </a>
    </li>
</ul>
