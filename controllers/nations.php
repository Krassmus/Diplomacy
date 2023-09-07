<?php

class NationsController extends PluginController
{

    function before_filter(&$action, &$args)
    {
        parent::before_filter($action, $args);
        Navigation::activateItem("/course/diplomacy");
    }

    public function create_action()
    {

    }
}
