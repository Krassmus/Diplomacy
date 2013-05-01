<h1><?= _("Diplomacy-Regeln") ?></h1>

<ul class="rules">
    <li>
        <?= _("Jede Einheit (Flotte oder Armee) bekommt pro Runde nur einen Befehl, der von der Struktur her ein Angriffsbefehl, ein Haltebefehl, eine Unterstützung bei den erstgenannten Befehlen einer anderen Einheit oder (bei Flotten) ein Convoy-Befehl, um eine Armee über mehrere Felder in einem Zug zu geleiten. Jeder Befehl wird klar und unzweideutig aufgeschrieben. Ist der Befehl zweideutig, kann er nicht vom General der betreffenden Einheit befolgt werden und die Einheit hält stattdessen (und kann dabei theoretisch sogar unterstützt werden).") ?>
    </li>
    <li>
        <?= _("Alle Befehle aller Spieler werden gleichzeitig aufgedeckt und gleichzeitig behandelt. Niemand schreibt, wenn schon die Befehle vorgelesen werden und niemand liest seine Befehle vor, wenn noch jemand mehr Zeit braucht. Jeder bekommt so viel Zeit, wie er möchte, um seine Befehle sauber ausformulieren zu können.") ?>
    </li>
    <li>
        <?= _("Der Unterstützungsbefehl kann nur in Kraft treten, wenn die unterstützende Einheit benachbart zum Ort des Geschehens ist UND wenn die unterstützende Einheit nicht gerade angegriffen wird (ganz egal, ob der Angriff klappt oder nicht). Angegriffene Einheiten, die unterstützen wollten, halten stattdessen auf jeden Fall (, und können auch dabei unterstützt werden).") ?>
    </li>
    <li>
        <?= _("Pro Land kann nur eine Einheit stehen. Wollen zwei Einheiten in ein Land, so kommt nur die Einheit mit der meisten Unterstützung hinein. Haben beide Einheiten eine gleichstarke Unterstützung, kommt keine rein und das Land gilt als umkämpft. Stand schon vorher eine Einheit in dem Land, so muss sie daraus verschwinden, wenn sie nicht mindestens so viel Unterstützung beim Halten hat, wie die Eindringlinge beim Angriff.") ?>
    </li>
    <li>
        <?= _("Eine „convoyende“ Flotte kann ihren Convoy solange durchführen, wie sie nicht vertrieben wird. Eine Flotte, die angegriffen wird, sich aber (eventuell auch mit Unterstützung) halten kann, kann weiterhin den Convoy durchführen.") ?>
    </li>
    <li>
        <?= _("Die Armee, die convoyt wird, kann von sich aus nur einen Angriff der Stärke 0 durchführen – das ist schwächer als ein normaler Angriff, kann also nur in freie und unumkämpfte Gebiete geschehen. Allerdings kann die Armee von weiteren Armeen und Schiffen (die nicht schon den Convoy machen) beim Angriff unterstützt werden, so dass der Angriff Stärke 1 (normale Kampfstärke) oder noch höher bekommt.") ?>
    </li>
    <li>
        <?= _("Wird eine Einheit per Angriff aus ihrem Land vertrieben, muss sie sich in ein benachbartes Land zurückziehen, das sie auch normal betreten könnte. Sie kann dabei nicht unterstützt werden und ihre Bewegung ist schwächer als ein fremder Angriff und sogar schwächer als eine Armee, die ohne Unterstützung convoyt wird. Allein eine Flotte, die sich auf keine Wasser- oder Küstenregion zurückziehen kann, kann sich in eine Armee umwandeln und über Land fliehen. Diese Umwandlung kann nur durch Vertreibung geschehen und nicht rückgängig gemacht werden. Eine Armee kann sich in einem vergleichbaren Fall auch nie in eine Flotte umwandeln.") ?>
    </li>
    <li>
        <?= _("Nach jeder Herbstrunde (es gibt nur Frühjahrs- und Herbstrunden) wird die Anzahl der Einheiten jedes Landes an seine Stützpunktzahl angeglichen. Müssen Einheiten aufgelöst werden, kann sich der betroffene Spieler aussuchen, welche das sein sollen. Ein Aufbau von neuen Einheiten geschieht immer in unbesetzten eigenen Heimatstützpunkten, die man immer noch kontrolliert.") ?>
    </li>
</ul>

<h2><?= _("Beispielbefehle") ?></h2>

<table class="default content">
    <tbody>
        <tr>
            <td>
                F Pet (sc) – BOT<br>
                A Swe – Pet<br>
                F Nor C [A Swe – Pet]<br>
                A Den – Swe
            </td>
            <td>
                A Tri - Ven<br>
                F ADR S [A Tri – Ven]<br>
                A Ven – Tri<br>
                F IOS – ADR
            </td>
            <td>
                A Ruh – Bel<br>
                A Mun – Bur<br>
                F Hol S [A Ruh – Bel]<br>
                A Bel xxx<br>
                A Bur S [A Bel xxx]
            </td>
        </tr>
    </tbody>
</table>

<h2><?= _("Anmerkungen") ?></h2>

<p class="info" style="font-style: italic;">
<?= _("Diese Regeln sind nicht die Originalregeln von Diplomacy, sondern in langen Jahren entstandene Hausregeln. Jedem steht es frei, eigene Hausregeln oder gar die Originalregeln der verschiedenen Editionen von Diplomacy zu verwenden. Je nach gespielter Karte (ja, es gibt im Internet viele weitere Karten anstatt des ersten Weltkriegs) können sich die Regeln eh unterscheiden. Falls Sie also eigene Regeln verwenden wollen, können Sie im Wiki eine Seite anlegen mit dem Namen DiplomacyRegeln, und diese Regeln werden anstatt dieser hier dargestellt.") ?>
</p>