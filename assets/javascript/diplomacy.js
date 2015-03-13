STUDIP.Diplomacy = {
    'show_turn': function () {
        jQuery.ajax({
            'url': STUDIP.ABSOLUTE_URI + "/plugins.php/Diplomacy/view_turn",
            'data': {
                
            }
        });
    }
};

jQuery(function () {
    jQuery(".command").each(function (index, element) {
        jQuery(element).data("html", jQuery(element).html());
    });
    jQuery(".command").on("mouseup", function () {
        var selectedText = window.getSelection().toString();
        if (selectedText.length > 0) {
            var regexp = new RegExp(selectedText, "ig");
            jQuery(".command").each(function (index, node) {
                var html = jQuery(node).data("html");
                var html = html.replace(regexp, '<span class="selection">' + selectedText + '</span>');
                if (jQuery(node).html() !== html) {
                    jQuery(node).html(html);
                }
            });
        } else {
            jQuery(".command").each(function (index, node) {
                jQuery(node).html(jQuery(node).data("html"));
            });
        }
    });

    /*var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(text);
    selection.removeAllRanges();
    selection.addRange(range);*/
});