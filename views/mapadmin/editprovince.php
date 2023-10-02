<?
$provinces_array = [];
foreach ($province->connections as $connection) {
    if ($connection['province_a_id'] === $province->id) {
        $provinces_array[] = [
            'connection_id' => $connection['connection_id'],
            'province_id' => $connection['province_b_id'],
            'province_name' => $connection->province_b->name,
            'province_longname' => $connection->province_b->longname,
            'subarea' => $connection['subarea_b'],
            'own_subarea' => $connection['subarea_a'],
            'type' => $connection['type']
        ];
    } else {
        $provinces_array[] = [
            'connection_id' => $connection['connection_id'],
            'province_id' => $connection['province_a_id'],
            'province_name' => $connection->province_a->name,
            'province_longname' => $connection->province_a->longname,
            'subarea' => $connection['subarea_a'],
            'own_subarea' => $connection['subarea_b'],
            'type' => $connection['type']
        ];
    }
}
?>
<form class="default"
      action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/editprovince/'.$map->id.'/'.$province->id) ?>"
      method="post">

    <fieldset>
        <legend><?= _('Grunddaten') ?></legend>

        <label>
            <?= _('Abkürzung') ?>
            <input type="text" name="name" value="<?= htmlReady($province['name']) ?>" required>
        </label>

        <label>
            <?= _('Name') ?>
            <input type="text" name="longname" value="<?= htmlReady($province['longname']) ?>" required>
        </label>

        <label>
            <?= _('Typ') ?>
            <select name="type">
                <option value="land"<?= $province['type'] === 'land' ? ' selected' : '' ?>><?= _('Land') ?></option>
                <option value="water"<?= $province['type'] === 'water' ? ' selected' : '' ?>><?= _('Meer') ?></option>
                <option value="coast"<?= $province['type'] === 'coast' ? ' selected' : '' ?>><?= _('Küste') ?></option>
            </select>
        </label>

        <input type="hidden" name="base" value="0">
        <label>
            <input type="checkbox" name="base" value="1" <?= $province['base'] ? 'checked' : '' ?>>
            <?= _('Stützpunkt') ?>
        </label>
    </fieldset>

    <fieldset id="diplomacy_edit_province_connections"
              data-connections="<?= htmlReady(json_encode($provinces_array)) ?>">
        <legend><?= _('Verknüpfungen') ?></legend>

        <table class="default nohover" id="diplomacy_province_connections_edit">
            <thead>
                <tr>
                    <th>
                        <?= _('Provinz / Gebiet') ?>
                    </th>
                    <th><?= _('Ausprägung (ec, wc, etc.)') ?></th>
                    <th>
                        <?= _('Verbindungstyp') ?>
                    </th>
                    <th><?= _('Eigene Ausprägung (ec, wc, etc.)') ?></th>
                    <th class="actions">
                        <?= _('Aktion') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="connection in sortedConnections">
                    <td>
                        <input type="hidden" :name="'connections[' + connection.connection_id + '][province_id]'" :value="connection.province_id">
                        <input type="hidden" :name="'connections[' + connection.connection_id + '][subarea]'" :value="connection.subarea">
                        <input type="hidden" :name="'connections[' + connection.connection_id + '][type]'" :value="connection.type">
                        <input type="hidden" :name="'connections[' + connection.connection_id + '][own_subarea]'" :value="connection.own_subarea">
                        {{ connection.province_name + (connection.province_longname ? ' - ' + connection.province_longname : '') }}
                    </td>
                    <td>{{ connection.subarea }}</td>
                    <td>{{ connection.type }}</td>
                    <td>{{ connection.own_subarea }}</td>
                    <td class="actions">
                        <a href="" @click.prevent="deleteConnection(connection.connection_id)">
                            <?= Icon::create('trash', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tbody>

            </tbody>
            <tbody>
                <tr>
                    <td>
                        <select id="diplomacy_add_province">
                            <? foreach ($map->provinces as $p) : ?>
                                <? if ($p->id !== $province->id) : ?>
                                    <option value="<?= $p->id ?>" data-name="<?= htmlReady($p->name) ?>" data-longname="<?= htmlReady($p->longname) ?>"><?= htmlReady($p->name.($p->longname ? ' - '. $p->longname : '')) ?></option>
                                <? endif ?>
                            <? endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="diplomacy_add_province_subarea" placeholder="<?= _('Küste?') ?>">
                    </td>
                    <td>
                        <select id="diplomacy_add_province_type">
                            <option value="land"><?= _('Landverbindung') ?></option>
                            <option value="water"><?= _('Wasserverbindung') ?></option>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="diplomacy_add_own_subarea" placeholder="<?= _('Küste?') ?>">
                    </td>
                    <td class="actions">
                        <a href="" @click.prevent="addConnection">
                            <?= Icon::create('add', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div>
            <?= _('Beachten Sie, dass man Gebiete gegebenenfalls doppelt verbinden muss, je nach Verbindungstyp. Im klassischen Diplomacy sind Sewastopol und Rumänien sowohl über Land verbunden als auch über Wasser, damit auch Schiffe von dem einen Gebiet zum anderen fahren können.') ?>
        </div>

    </fieldset>


    <div data-dialog-button>
        <?= \Studip\Button::create(_('Speichern')) ?>
    </div>
</form>
