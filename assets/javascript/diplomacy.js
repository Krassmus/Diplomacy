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
        var selection = window.getSelection();
        var html = jQuery(this).data("html");
        if (selection.anchorNode.data) {
            var start = selection.anchorOffset <= selection.focusOffset ? selection.anchorOffset : selection.focusOffset;
            var end = selection.anchorOffset > selection.focusOffset ? selection.anchorOffset : selection.focusOffset;
            var selectedText = selection.anchorNode.data.substr(start, end - start);
            if (selectedText.length > 0) {
                var regexp = new RegExp(selectedText, "ig");
                html = html.replace(regexp, '<span class="selection">' + selectedText + '</span>');
            }
        }
        if (jQuery(this).html() !== html) {
            jQuery(this).html(html);
        }
    });

    /*var selection = window.getSelection();
    var range = document.createRange();
    range.selectNodeContents(text);
    selection.removeAllRanges();
    selection.addRange(range);*/
});