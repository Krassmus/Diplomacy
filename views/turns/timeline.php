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
            }
        });
    });
</script>

<ul class="clean" id="maps">
    <? foreach ($turns as $key => $turn) : ?>
        <li id="map_<?= count($turns) - $key ?>"
            data-name="<?= htmlReady($turn['name']) ?>">
            <img src="<?= GetDownloadLink($turn->map->getId(), $turn->map['filename']) ?>" style="width: 100%; display: block;">
        </li>
    <? endforeach ?>
</ul>