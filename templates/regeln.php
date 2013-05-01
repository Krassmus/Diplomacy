<h1><?= _("Diplomacy-Regeln") ?></h1>

<ul class="rules">
    <li>
        <?= _("Jede Einheit (Flotte oder Armee) bekommt pro Runde nur einen Befehl, der von der Struktur her ein Angriffsbefehl, ein Haltebefehl, eine Unterst�tzung bei den erstgenannten Befehlen einer anderen Einheit oder (bei Flotten) ein Convoy-Befehl, um eine Armee �ber mehrere Felder in einem Zug zu geleiten. Jeder Befehl wird klar und unzweideutig aufgeschrieben. Ist der Befehl zweideutig, kann er nicht vom General der betreffenden Einheit befolgt werden und die Einheit h�lt stattdessen (und kann dabei theoretisch sogar unterst�tzt werden).") ?>
    </li>
    <li>
        <?= _("Alle Befehle aller Spieler werden gleichzeitig aufgedeckt und gleichzeitig behandelt. Niemand schreibt, wenn schon die Befehle vorgelesen werden und niemand liest seine Befehle vor, wenn noch jemand mehr Zeit braucht. Jeder bekommt so viel Zeit, wie er m�chte, um seine Befehle sauber ausformulieren zu k�nnen.") ?>
    </li>
    <li>
        <?= _("Der Unterst�tzungsbefehl kann nur in Kraft treten, wenn die unterst�tzende Einheit benachbart zum Ort des Geschehens ist UND wenn die unterst�tzende Einheit nicht gerade angegriffen wird (ganz egal, ob der Angriff klappt oder nicht). Angegriffene Einheiten, die unterst�tzen wollten, halten stattdessen auf jeden Fall (, und k�nnen auch dabei unterst�tzt werden).") ?>
    </li>
    <li>
        <?= _("Pro Land kann nur eine Einheit stehen. Wollen zwei Einheiten in ein Land, so kommt nur die Einheit mit der meisten Unterst�tzung hinein. Haben beide Einheiten eine gleichstarke Unterst�tzung, kommt keine rein und das Land gilt als umk�mpft. Stand schon vorher eine Einheit in dem Land, so muss sie daraus verschwinden, wenn sie nicht mindestens so viel Unterst�tzung beim Halten hat, wie die Eindringlinge beim Angriff.") ?>
    </li>
    <li>
        <?= _("Eine �convoyende� Flotte kann ihren Convoy solange durchf�hren, wie sie nicht vertrieben wird. Eine Flotte, die angegriffen wird, sich aber (eventuell auch mit Unterst�tzung) halten kann, kann weiterhin den Convoy durchf�hren.") ?>
    </li>
    <li>
        <?= _("Die Armee, die convoyt wird, kann von sich aus nur einen Angriff der St�rke 0 durchf�hren � das ist schw�cher als ein normaler Angriff, kann also nur in freie und unumk�mpfte Gebiete geschehen. Allerdings kann die Armee von weiteren Armeen und Schiffen (die nicht schon den Convoy machen) beim Angriff unterst�tzt werden, so dass der Angriff St�rke 1 (normale Kampfst�rke) oder noch h�her bekommt.") ?>
    </li>
    <li>
        <?= _("Wird eine Einheit per Angriff aus ihrem Land vertrieben, muss sie sich in ein benachbartes Land zur�ckziehen, das sie auch normal betreten k�nnte. Sie kann dabei nicht unterst�tzt werden und ihre Bewegung ist schw�cher als ein fremder Angriff und sogar schw�cher als eine Armee, die ohne Unterst�tzung convoyt wird. Allein eine Flotte, die sich auf keine Wasser- oder K�stenregion zur�ckziehen kann, kann sich in eine Armee umwandeln und �ber Land fliehen. Diese Umwandlung kann nur durch Vertreibung geschehen und nicht r�ckg�ngig gemacht werden. Eine Armee kann sich in einem vergleichbaren Fall auch nie in eine Flotte umwandeln.") ?>
    </li>
    <li>
        <?= _("Nach jeder Herbstrunde (es gibt nur Fr�hjahrs- und Herbstrunden) wird die Anzahl der Einheiten jedes Landes an seine St�tzpunktzahl angeglichen. M�ssen Einheiten aufgel�st werden, kann sich der betroffene Spieler aussuchen, welche das sein sollen. Ein Aufbau von neuen Einheiten geschieht immer in unbesetzten eigenen Heimatst�tzpunkten, die man immer noch kontrolliert.") ?>
    </li>
</ul>

<h2><?= _("Beispielbefehle") ?></h2>

<table class="default content">
    <tbody>
        <tr>
            <td>
                F Pet (sc) � BOT<br>
                A Swe � Pet<br>
                F Nor C [A Swe � Pet]<br>
                A Den � Swe
            </td>
            <td>
                A Tri - Ven<br>
                F ADR S [A Tri � Ven]<br>
                A Ven � Tri<br>
                F IOS � ADR
            </td>
            <td>
                A Ruh � Bel<br>
                A Mun � Bur<br>
                F Hol S [A Ruh � Bel]<br>
                A Bel xxx<br>
                A Bur S [A Bel xxx]
            </td>
        </tr>
    </tbody>
</table>

<h2><?= _("Anmerkungen") ?></h2>

<p class="info" style="font-style: italic;">
<?= _("Diese Regeln sind nicht die Originalregeln von Diplomacy, sondern in langen Jahren entstandene Hausregeln. Jedem steht es frei, eigene Hausregeln oder gar die Originalregeln der verschiedenen Editionen von Diplomacy zu verwenden. Je nach gespielter Karte (ja, es gibt im Internet viele weitere Karten anstatt des ersten Weltkriegs) k�nnen sich die Regeln eh unterscheiden. Falls Sie also eigene Regeln verwenden wollen, k�nnen Sie im Wiki eine Seite anlegen mit dem Namen DiplomacyRegeln, und diese Regeln werden anstatt dieser hier dargestellt.") ?>
</p>