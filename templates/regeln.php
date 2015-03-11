<h1><?= _("Diplomacy") ?></h1>

<p>
    <?= _("Diplomacy ist ein altehrwürdiges Spiel. Auf den ersten Blick erinnert es viele an Risiko nur auf einer Europakarte. Tatsächlich sind Risiko und Diplomacy fast zeitgleich unabhängig voneinander entstanden. Wohingegen Risiko aber fast ein reines Glücksspiel ist, verzichtet Diplomacy komplett auf den Faktor Glück. Würfel, Karten, das alles gibt es hier nicht. Stattdessen agieren alle Spieler zeitgleich, schreiben Befehle auf und decken sie gleichzeitig auf. Die Schwierigkeit besteht für die Spieler darin, zu wissen, was die anderen Spieler für Befehle aufschreiben. Dazu muss man kommunizieren bzw. Diplomatie betreiben.") ?>
</p>

<h2><?= _("Regelfundus") ?></h2>
<p>
    <?= _("Zu Diplomacy gibt es mehrere Karten und mehrere Regelvarianten. Es ist absolut wichtig, dass Sie sich vor Beginn des Spiels auf eine Karte und einen Regelsatz einigen. Dazu werden hier einige Regeln verlinkt, aus denen Sie sich die sinnigste aussuchen können.") ?>
</p>

<table class="default nohover">
    <tbody>
        <tr>
            <td><?= _("Offizielle Standardregeln") ?></td>
            <td><a href="http://en.wikibooks.org/wiki/Diplomacy/Rules">http://en.wikibooks.org/wiki/Diplomacy/Rules</a></td>
        </tr>
        <tr>
            <td><?= _("Standardkarte") ?></td>
            <td><img src="<?= $plugin->getPluginURL() ?>/assets/images/map.png" width="100%"></td>
        </tr>
        <tr>
            <td><?= _("Variante: Glücklicher Verteidiger") ?></td>
            <td><?= _("Nach dieser Zusatzregel ist ein Verteidiger durchaus in der Lage, sich gegen zwei Angreifer zu behaupten, wenn er den Supporter der beiden angreift. Dadurch fällt der Supportbefehl und der Angriff ist nicht mehr unterstützt. Greift der Verteidiger hingegen die angreifende Einheit an, bleibt der Supportbefehl stehen und der Verteidiger verliert. Man könnte also sagen, der Verteidiger braucht Glück, um sich verteidigen zu können. - Oder genaues Wissen über die Angriffspläne seines Feindes.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Schwacher Convoy") ?></td>
            <td><?= _("Nach dieser Regel fällt ein Convoy-Befehl nicht erst, wenn die Flotte vertrieben wird, sondern schon bei einem einzelnen Angriff. In dem Fall wird der Convoy-Befehl analog zum Supportbefehl in einen Haltebefehl umgewandelt, der dann auch wiederum supportet werden kann. Die Armee, die convoyt werden sollte, kommt nicht voran. Der schwache Convoy wird oft kombiniert mit der Variante, dass Flotten an Küstengebieten auch convoyen können (aber nur in Gebiete, in die die Flotte auch angreifen könnte). Das bietet ein sehr interessantes Stellungsspiel durch flexible Rochaden.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Eilmarschbefehl") ?></td>
            <td><?= _("Diese Regel ist besonders geeignet für große Karten. Nach Standardregeln ist es so, dass eine Armee eineinhalb Jahre auf der Reise ist von Griechenland bis nach Wien. Wenn das Gebiet aber nicht feindlich ist, ist das eine absurd lange Zeit. Man kann einer Einheit auch einen Eilmarsch-Befehl geben, der wie folgt aufgeschrieben werden würde: A Gre E Ser - Tri - Vie. Diese Armee hat absolut keine Angriffstärke in der Runde, in der sie sich auf Eilmarsch befindet. Zudem muss jedes Gebiet der Reise absolut frei, unumkämpft und darf kein feindlicher Stützpunk sein, ansonsten kommt die Einheit auf dem letzten freien Gebiet der Reise zum Stehen. Auch zwei sich kreuzende Eilmärsche sind auf diese Weise unmöglich. Beide Eilmärsche würden zum Stillstand kommen. Einheiten auf dem Eilmarsch können nicht unterstützt werden. Flotten können auch auf dem Eilmarsch sein. Ein Eilmarsch kann maximal fünf Gebiete umfassen. Der Sinn dieser Regel ist, dass ein Land schneller in der Lage sein soll, seine Westfront nach Osten zu verlegen. Dadurch erhofft man sich, dass Spieler schneller die Seiten wechseln, wozu sie zuvor logistisch nicht in der Lage waren.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Chaos-Aufbau") ?></td>
            <td><?= _("Eine sehr naheliegende Variante ist es, den Spielern zu ermöglichen, neue Einheiten auf allen eigenen und freien Stützpunkten aufzubauen. Dadurch kann man Angriffskriege sehr viel flexibler gestalten. Es kann aber auch passieren, dass man sein Heimatland verliert, trotzdem aber noch aufbaufähig bleibt. Auch diese Regel ist wie der Eilmarsch-Befehl auf großen Karten beliebt und wichtig.") ?></td>
        </tr>
    </tbody>
</table>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");