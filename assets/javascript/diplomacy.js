STUDIP.Diplomacy = {
    'show_turn': function () {
        jQuery.ajax({
            'url': STUDIP.ABSOLUTE_URI + "/plugins.php/Diplomacy/view_turn",
            'data': {
                
            }
        });
    }
};