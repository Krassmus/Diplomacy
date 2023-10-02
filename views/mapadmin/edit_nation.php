<?
$units_data = [];
if ($nation->starting_positions) {
    foreach ($nation->starting_positions as $province_id => $unit) {
        $province = DiplomacyProvince::find($province_id);
        $units_data[] = [
            'province_id' => $province_id,
            'type' => $unit['type'],
            'province_name' => $province['name'],
            'province_longname' => $province['longname'],
            'subarea' => $unit['subarea']
        ];
    }
}
?>

<form action="<?= PluginEngine::getLink($plugin, [], 'mapadmin/edit_nation/'.$variant->id.'/'.$nation->id) ?>"
      class="default"
      method="post">
    <label>
        <?= _('Name der Nation') ?>
        <input type="text" name="name" value="<?= htmlReady($nation['name']) ?>">
    </label>

    <table class="default nohover"
           id="diplomacy_edit_nation_units"
           data-units="<?= htmlReady(json_encode($units_data)) ?>">
        <thead>
            <tr>
                <th><?= _('Land') ?></th>
                <th><?= _('Ausprägung') ?></th>
                <th><?= _('Einheit') ?></th>
                <th class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="unit in sortedUnits" :key="unit.province_id">
                <td>
                    <input type="hidden" :name="'units[' + unit.province_id + '][type]'" :value="unit.type">
                    <input type="hidden" :name="'units[' + unit.province_id + '][subarea]'" :value="unit.subarea">
                    {{ unit.province_name + ' - ' + unit.province_longname }}
                </td>
                <td>
                    {{ unit.subarea }}
                </td>
                <td>{{ unit.type }}</td>
                <td>
                    <a href="" @click.prevent="deleteUnit(unit.province_id)">
                        <?= Icon::create('trash', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                    </a>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    <select id="add_unit_province">
                        <? foreach ($provinces as $province) : ?>
                        <option value="<?= htmlReady($province->id) ?>"
                                data-province_name="<?= htmlReady($province['name']) ?>"
                                data-province_longname="<?= htmlReady($province['longname']) ?>">
                            <?= htmlReady($province['name'] . ($province['longname'] ? ' - '.$province['longname'] : '')) ?>
                        </option>
                        <? endforeach ?>
                    </select>
                </td>
                <td>
                    <input type="text" id="add_unit_subarea" placeholder="<?= _('Küste?') ?>">
                </td>
                <td>
                    <select id="add_unit_type">
                        <option value="area"><?= _('Gebiet ohne Einheit') ?></option>
                        <option value="army"><?= _('Armee') ?></option>
                        <option value="fleet"><?= _('Flotte') ?></option>
                        <option value="squadron"><?= _('Schwadron') ?></option>
                        <option value="carrier"><?= _('Flugzeugträger') ?></option>
                    </select>
                </td>
                <td>
                    <a href="" @click.prevent="addUnit">
                        <?= Icon::create('add', Icon::ROLE_CLICKABLE)->asImg(20, ['class' => 'text-bottom']) ?>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <div data-dialog-button>
        <?= \Studip\Button::create(_('Speichern'))?>
    </div>
</form>
