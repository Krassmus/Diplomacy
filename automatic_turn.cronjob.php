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
        require_once __DIR__.'/classes/DiplomacyFutureTurn.class.php';
        require_once __DIR__.'/classes/DiplomacyTurn.class.php';
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

        $seminar_ids = DBManager::get()->prepare("
            SELECT DISTINCT seminar_id
            FROM diplomacyfutureturns
            WHERE whenitsdone = '1'
        ");
        $seminar_ids->execute();
        $seminar_ids = $seminar_ids->fetchAll(PDO::FETCH_COLUMN, 0);
        foreach ($seminar_ids as $seminar_id) {
            $oldturn = DiplomacyTurn::findOneBySQL("seminar_id = ? ORDER BY mkdate DESC LIMIT 1", array($seminar_id));

            $statement = DBManager::get()->prepare("
                SELECT COUNT(*)
                FROM diplomacycommands
                WHERE turn_id = :turn_id
            ");
            $statement->execute(array('turn_id' => $oldturn->getId()));
            $commands = $statement->fetch(PDO::FETCH_COLUMN, 0);

            $statement = DBManager::get()->prepare("
                SELECT COUNT(*)
                FROM statusgruppe
                    INNER JOIN statusgruppe_user ON (statusgruppe.statusgruppe_id = statusgruppe_user.statusgruppe_id)
                WHERE range_id = :seminar_id
            ");
            $statement->execute(array('seminar_id' => $seminar_id));
            $players = $statement->fetch(PDO::FETCH_COLUMN, 0);

            if ($commands >= $players) {
                $futureturn = DiplomacyFutureTurn::findOneBySQL("seminar_id = ? ORDER BY start_time ASC", array($seminar_id));
                if ($turn['whenitsdone']) {
                    $turn = DiplomacyTurn();
                    $turn->setData($futureturn->toArray());
                    $turn['mkdate'] = $turn['chdate'] = time();
                    $turn->store();
                    $futureturn->delete();
                }
            }
        }
    }
}
