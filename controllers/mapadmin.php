<?php

class MapadminController extends PluginController
{

    public function before_filter(&$action, &$args)
    {
        parent::before_filter($action, $args);
        if (!$GLOBALS['perm']->have_perm('root')) {
            throw new AccessDeniedException();
        }
        Navigation::activateItem('/admin/locations/diplomacy');
    }

    public function overview_action()
    {
        $this->maps = DiplomacyMap::findBySQL('1 ORDER BY `name` ASC');
    }

    public function edit_action($map_id = null)
    {
        $this->map = new DiplomacyMap($map_id);
        if ($this->map->isNew()) {
            PageLayout::setTitle(_('Karte erstellen'));
        } else {
            PageLayout::setTitle(_('Karte bearbeiten'));
        }
        if (Request::isPost()) {
            $this->map['name'] = Request::get('name');
            $this->map['description'] = Request::get('description');
            $this->map['starting_year'] = Request::int('starting_year');
            $this->map->store();
            PageLayout::postSuccess(_('Karte wurde gespeichert.'));
            $this->redirect('mapadmin/overview');
        }
    }

    public function delete_action(DiplomacyMap $map)
    {
        if (Request::isPost()) {
            $map->delete();
            PageLayout::postSuccess(_('Karte wurde gelöscht.'));
        }
        $this->redirect('mapadmin/overview');
    }

    public function provinces_action(DiplomacyMap $map)
    {
        $this->map = $map;
        PageLayout::addScript($this->plugin->getPluginURL().'/assets/edit_province.js');
    }

    public function editprovince_action(DiplomacyMap $map, $province_id = null)
    {
        $this->map = $map;
        $this->province = new DiplomacyProvince($province_id);
        PageLayout::addScript($this->plugin->getPluginURL().'/assets/edit_province.js');
        if (Request::isPost()) {
            $this->province['name'] = Request::get('name');
            $this->province['longname'] = Request::get('longname');
            $this->province['type'] = Request::get('type');
            $this->province['base'] = Request::int('base');
            $this->province['map_id'] = $map->id;
            $this->province->store();

            $old_connection_ids = $this->province->connections->pluck('connection_id');
            $new_connection_ids = [];
            foreach (Request::getArray('connections') as $connectiondata) {
                if (!in_array($connectiondata['connection_id'], $old_connection_ids)) {
                    $connection = new DiplomacyConnection();
                    $connection['province_a_id'] = $this->province->id;
                    $connection['subarea_a'] = $connectiondata['own_subarea'] ?? null;
                    $connection['province_b_id'] = $connectiondata['province_id'];
                    $connection['subarea_b'] = $connectiondata['subarea'] ?? null;
                    $connection['type'] = $connectiondata['type'];
                    $connection->store();
                    $new_connection_ids[] = $connection->id;
                } else {
                    $new_connection_ids[] = $connectiondata['connection_id'];
                }
            }
            foreach ($old_connection_ids as $connection_id) {
                if (!in_array($connection_id, $new_connection_ids)) {
                    $connection = DiplomacyConnection::find($connection_id);
                    $connection->delete();
                }
            }
            $this->redirect('mapadmin/provinces/'.$this->province['map_id'].'#province_'.$this->province->id);
        }
    }

    public function province_delete_action(DiplomacyProvince $province)
    {
        $map_id = $province['map_id'];
        if (Request::isPost()) {
            $province->delete();
            PageLayout::postSuccess(_('Provinz erfolgreich gelöscht.'));
        }
        $this->redirect('mapadmin/provinces/'.$map_id);
    }

    public function nations_action(DiplomacyMap $map)
    {
        $this->map = $map;
        PageLayout::addScript($this->plugin->getPluginURL().'/assets/edit_nation.js');
        if (count($this->map->variants) === 0) {
            $variant = new DiplomacyVariant();
            $variant['map_id'] = $map->id;
            $variant['name'] = _('Startaufstellung');
            $variant->store();
            $this->map->restore();
        }
    }

    public function edit_nation_action(DiplomacyVariant $variant, $nation_id = null)
    {
        $this->nation = new DiplomacyNation($nation_id);
        $this->variant = $variant;
        $this->provinces = $this->variant->map->provinces;
        PageLayout::addScript($this->plugin->getPluginURL().'/assets/edit_nation.js');
        PageLayout::setTitle(_('Nation bearbeiten'));
        if (Request::isPost()) {
            $this->nation['variant_id'] = $variant->id;
            $this->nation['name'] = Request::get('name');
            $this->nation['starting_positions'] = Request::getArray('units', []);
            $this->nation->store();
            PageLayout::postSuccess(_('Nation wurde gespeichert.'));
            $this->redirect('mapadmin/nations/'.$variant['map_id']);
        }
    }

    public function download_action(DiplomacyMap $map)
    {
        $data = [
            'meta' => [
                'name' => $map['name'],
                'description' => $map['description']
            ],
            'provinces' => [],
            'connections' => [],
            'variants' => []
        ];
        foreach ($map->provinces as $province) {
            $data['provinces'][] = [
                'province_id' => $province->id,
                'name' => $province['name'],
                'longname' => $province['longname'],
                'base' => (bool) $province['base'],
                'type' => $province['type']
            ];
        }
        $connections = DiplomacyConnection::findBySQL('LEFT JOIN diplomacy_provinces ON (diplomacy_provinces.province_id = diplomacy_connections.province_a_id OR diplomacy_provinces.province_id = diplomacy_connections.province_b_id) WHERE diplomacy_provinces.map_id = ?', [
            $map->id
        ]);
        foreach ($connections as $connection) {
            $data['connections'][] = [
                'province_a_id' => $connection['province_a_id'],
                'province_b_id' => $connection['province_b_id'],
                'subarea_a' => $connection['subarea_a'],
                'subarea_b' => $connection['subarea_b'],
                'type' => $connection['type']
            ];
        }
        $this->response->add_header('Content-Disposition', 'attachment; '.$map['name'].'.dipl');
        $this->render_json($data);
    }

    public function variant_edit_action(DiplomacyMap $map, $variant_id = null)
    {
        $this->map = $map;
        $this->variant = new DiplomacyVariant($variant_id);
        if (Request::isPost()) {
            $this->variant['map_id'] = $map->id;
            $this->variant['name'] = Request::get('name');
            $this->variant->store();
            PageLayout::postSuccess(_('Spielervariante wurde gespeichert.'));
            $this->redirect('mapadmin/nations/'.$map->id);
        }
    }

    public function variant_delete_action(DiplomacyMap $map, $variant_id = null)
    {
        $this->map = $map;
        $this->variant = new DiplomacyVariant($variant_id);
        if (Request::isPost()) {
            $this->variant->delete();
            PageLayout::postSuccess(_('Spielervariante wurde gelöscht.'));
            $this->redirect('mapadmin/nations/'.$map->id);
        }
    }
}
