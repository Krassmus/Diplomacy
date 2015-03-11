<h1><?= _("Diplomacy") ?></h1>

<p>
    <?= _("Diplomacy ist ein altehrw�rdiges Spiel. Auf den ersten Blick erinnert es viele an Risiko nur auf einer Europakarte. Tats�chlich sind Risiko und Diplomacy fast zeitgleich unabh�ngig voneinander entstanden. Wohingegen Risiko aber fast ein reines Gl�cksspiel ist, verzichtet Diplomacy komplett auf den Faktor Gl�ck. W�rfel, Karten, das alles gibt es hier nicht. Stattdessen agieren alle Spieler zeitgleich, schreiben Befehle auf und decken sie gleichzeitig auf. Die Schwierigkeit besteht f�r die Spieler darin, zu wissen, was die anderen Spieler f�r Befehle aufschreiben. Dazu muss man kommunizieren bzw. Diplomatie betreiben.") ?>
</p>

<h2><?= _("Regelfundus") ?></h2>
<p>
    <?= _("Zu Diplomacy gibt es mehrere Karten und mehrere Regelvarianten. Es ist absolut wichtig, dass Sie sich vor Beginn des Spiels auf eine Karte und einen Regelsatz einigen. Dazu werden hier einige Regeln verlinkt, aus denen Sie sich die sinnigste aussuchen k�nnen.") ?>
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
            <td><?= _("Variante: Gl�cklicher Verteidiger") ?></td>
            <td><?= _("Nach dieser Zusatzregel ist ein Verteidiger durchaus in der Lage, sich gegen zwei Angreifer zu behaupten, wenn er den Supporter der beiden angreift. Dadurch f�llt der Supportbefehl und der Angriff ist nicht mehr unterst�tzt. Greift der Verteidiger hingegen die angreifende Einheit an, bleibt der Supportbefehl stehen und der Verteidiger verliert. Man k�nnte also sagen, der Verteidiger braucht Gl�ck, um sich verteidigen zu k�nnen. - Oder genaues Wissen �ber die Angriffspl�ne seines Feindes.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Schwacher Convoy") ?></td>
            <td><?= _("Nach dieser Regel f�llt ein Convoy-Befehl nicht erst, wenn die Flotte vertrieben wird, sondern schon bei einem einzelnen Angriff. In dem Fall wird der Convoy-Befehl analog zum Supportbefehl in einen Haltebefehl umgewandelt, der dann auch wiederum supportet werden kann. Die Armee, die convoyt werden sollte, kommt nicht voran. Der schwache Convoy wird oft kombiniert mit der Variante, dass Flotten an K�stengebieten auch convoyen k�nnen (aber nur in Gebiete, in die die Flotte auch angreifen k�nnte). Das bietet ein sehr interessantes Stellungsspiel durch flexible Rochaden.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Eilmarschbefehl") ?></td>
            <td><?= _("Diese Regel ist besonders geeignet f�r gro�e Karten. Nach Standardregeln ist es so, dass eine Armee eineinhalb Jahre auf der Reise ist von Griechenland bis nach Wien. Wenn das Gebiet aber nicht feindlich ist, ist das eine absurd lange Zeit. Man kann einer Einheit auch einen Eilmarsch-Befehl geben, der wie folgt aufgeschrieben werden w�rde: A Gre E Ser - Tri - Vie. Diese Armee hat absolut keine Angriffst�rke in der Runde, in der sie sich auf Eilmarsch befindet. Zudem muss jedes Gebiet der Reise absolut frei, unumk�mpft und darf kein feindlicher St�tzpunk sein, ansonsten kommt die Einheit auf dem letzten freien Gebiet der Reise zum Stehen. Auch zwei sich kreuzende Eilm�rsche sind auf diese Weise unm�glich. Beide Eilm�rsche w�rden zum Stillstand kommen. Einheiten auf dem Eilmarsch k�nnen nicht unterst�tzt werden. Flotten k�nnen auch auf dem Eilmarsch sein. Ein Eilmarsch kann maximal f�nf Gebiete umfassen. Der Sinn dieser Regel ist, dass ein Land schneller in der Lage sein soll, seine Westfront nach Osten zu verlegen. Dadurch erhofft man sich, dass Spieler schneller die Seiten wechseln, wozu sie zuvor logistisch nicht in der Lage waren.") ?></td>
        </tr>
        <tr>
            <td><?= _("Variante: Chaos-Aufbau") ?></td>
            <td><?= _("Eine sehr naheliegende Variante ist es, den Spielern zu erm�glichen, neue Einheiten auf allen eigenen und freien St�tzpunkten aufzubauen. Dadurch kann man Angriffskriege sehr viel flexibler gestalten. Es kann aber auch passieren, dass man sein Heimatland verliert, trotzdem aber noch aufbauf�hig bleibt. Auch diese Regel ist wie der Eilmarsch-Befehl auf gro�en Karten beliebt und wichtig.") ?></td>
        </tr>
    </tbody>
</table>

<?
Sidebar::Get()->setImage($plugin->getPluginURL()."/assets/diplomacy-sidebar.png");