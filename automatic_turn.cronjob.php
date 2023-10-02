<?php

class AutomaticTurnJob extends CronJob
{
    /**
     * Returns the name of the cronjob.
     */
    public static function getName()
    {
        return _('Diplomacy: automatische Rundenwechsel');
    }

    /**
     * Returns the description of the cronjob.
     */
    public static function getDescription()
    {
        return _('Sofern der Leiter eines Diplomacy-Zuges das eingestellt hat, führt dieser Job automatisch einen neuen Rundenwechsel durch.');
    }

    public function setUp() {
        require_once __DIR__ . '/lib/DiplomacyFutureTurn.class.php';
        require_once __DIR__ . '/lib/DiplomacyTurn.class.php';
    }

    /**
     * Executes the cronjob.
     *
     * @param mixed $last_result What the last execution of this cronjob
     *                           returned.
     * @param Array $parameters Parameters for this cronjob instance which
     *                          were defined during scheduling.
     *                          Only valid parameter at the moment is
     *                          "verbose" which toggles verbose output while
     *                          purging the cache.
     */
    public function execute($last_result, $parameters = array())
    {
        $scheduled_turns = DiplomacyFutureTurn::findBySQL("start_time <= UNIX_TIMESTAMP()");
        foreach ($scheduled_turns as $scheduled_turn) {
            $turn = new DiplomacyTurn();
            $turn->setData($scheduled_turn->toArray());
            $turn['mkdate'] = $turn['chdate'] = time();
            $turn->store();
            $scheduled_turn->delete();
        }
    }
}
