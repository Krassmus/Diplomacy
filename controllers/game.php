<?php

class GameController extends PluginController
{
    public function initialize_action()
    {
        Navigation::activateItem('/course/diplomacy/overview');
        $this->maps = DiplomacyMap::findBySQL('1 ORDER BY name ASC');
    }

    public function choose_variant_action($map_id)
    {
        PageLayout::setTitle(_('Variante auswählen'));
        if ($map_id !== 'blank') {
            $this->map = DiplomacyMap::find($map_id);
        }
        if (Request::isPost()) {
            $game = new DiplomacyGame();
            $game['course_id'] = Context::get()->id;
            $game['map_id'] = $this->map ? $this->map->id : 'blank';
            $game['variant_id'] = Request::option('variant_id');
            $game->store();
            $turn = new DiplomacyTurn();
            $turn['seminar_id'] = Context::get()->id;
            $turn['name'] = _('Frühjahr').' '.$this->name['starting_year'];
            $turn->store();
            if ($this->map) {
                foreach ($this->map->variants as $variant) {
                    if ($variant->id === Request::option('variant_id')) {
                        foreach ($variant->nations as $nation) {
                            $id = md5(Context::get()->id . '/' . $nation->id);
                            $group = Statusgruppen::find($id);
                            if (!$group) {
                                $group = new Statusgruppen();
                                $group->setId(md5(Context::get()->id . '/' . $nation->id));
                            }
                            $group['name'] = $nation['name'];
                            $group['range_id'] = Context::get()->id;
                            $group['selfassign'] = 0;
                            $group->store();

                            $command = new DiplomacyCommand();
                            $command['statusgruppe_id'] = $group->id;
                            $command['turn_id'] = $turn->id;
                            $command['statusgruppe_name'] = $group['name'];
                            $command['content'] = json_encode($nation['starting_positions']->getArrayCopy());
                            $command->store();
                        }
                    }
                }
            }
            PageLayout::postSuccess(_('Spiel wurde initialisiert.'));
            $this->redirect('turns/overview');
        }
    }
}
