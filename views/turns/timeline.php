<div id="timeline_slider" style="width: calc(100% - 20px); margin-bottom: 20px;"></div>
<script>
    jQuery(function () {
        jQuery("#timeline_slider").slider({
            'max': <?= count($turns) ?>,
            'min': 1,
            'value': <?= count($turns) ?>,
            'slide': function (event, ui) {
                jQuery("#maps >li:visible:not(#version_" + ui.value + ")").hide();
                jQuery("#map_" + ui.value).show();
                jQuery("#map_name").text(jQuery("#map_" + ui.value).data("name"));
            }
        });
    });
</script>

<h1 id="map_name" style="text-align: center;"><?= htmlReady($turns[0]['name']) ?></h1>

<ul class="clean" id="maps">
    <? foreach ($turns as $key => $turn) : ?>
        <li id="map_<?= count($turns) - $key ?>"
            data-name="<?= htmlReady($turn['name']) ?>"
            style="<?= $key > 0 ? "display:none; " : "" ?>">
            <img src="<?= GetDownloadLink($turn->map->getId(), $turn->map['filename']) ?>" style="width: 100%; display: block;">
        </li>
    <? endforeach ?>
</ul>