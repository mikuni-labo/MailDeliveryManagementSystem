
/**
 * Visitor
 ======================================================*/

/**
 * Toggle search area.
 */
(function($){
    $('#search_area').css('display', 'none');

    // 検索エリアのToggleEvent
    $('#search_toggle').click(function() {
        $('#search_area').toggle();

        if($('#search_area').css('display') === 'none')
            $('#search_toggle').html('<small><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;選択エリアを表示する</small>');
        else
            $('#search_toggle').html('<small><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>&nbsp;選択エリアを隠す</small>');
    });
})(jQuery);
