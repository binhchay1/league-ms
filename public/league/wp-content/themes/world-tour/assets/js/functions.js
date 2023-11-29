var $j = jQuery.noConflict();

function get_loading() {
    return '<div class="loading"></div>';
}

function get_white_loading() {
    return '<div class="white_loading"></div>';
}

function get_white_loading_float() {
    return '<div class="white_loading_float"></div>';
}

function get_black_loading() {
    return '<div class="black_loading"></div>';
}

function get_black_loading_float() {
    return '<div class="black_loading_float"></div>';
}

function hide_white_loading() {
    $j('.white_loading').hide();
}

function set_loading(obj) {
    var loading = get_loading();
    $j(obj).html(loading);
}

function hide_loading() {
    $j('.loading').hide();
}

function remove_loading(obj) {
    $j(obj).find('.loading').remove();
}

function remove_white_loading(obj) {
    $j(obj).find('.white_loading').remove();
}

function remove_black_loading(obj) {
    $j(obj).find('.black_loading').remove();
}

function convert_placeholder_to_mouse(obj) {
    if ($j(obj).length < 1) return;
    var placeholder = $j(obj).attr('placeholder');
    if (placeholder != '' || placeholder != 'undefined') {
        $j(obj).on('focus', function() {
            $j(obj).attr('placeholder', '');
        });
        $j(obj).on('focusout', function() {
            $j(obj).attr('placeholder', placeholder);
        });
    }
};
$j.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return results[1] || 0;
    }
}