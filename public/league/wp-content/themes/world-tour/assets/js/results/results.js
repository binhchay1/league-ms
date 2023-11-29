(function($) {
    $(document).ready(function() {
        var separators = ['=', '&'];
        var paramUrl;
        var result = $('.results');
        if (result.length >= 0) {
            $.loadResultContent = function(ajaxType) {
                $.ajax({
                    url: pageUrl + '?ajax=' + ajaxType,
                    success: function(data) {
                        $('.wrapper-content-results .content-results .item-results').html(data);
                    }
                });
                if (pageUrl != window.location) {
                    window.history.pushState({
                        path: pageUrl
                    }, '', pageUrl);
                }
            }
            $(document).on('click', '#ajaxTabsResults a', function(e) {
                pageUrl = $(this).attr('href');
                paramUrl = pageUrl.split('/');
                $("#ajaxTabsResults li").removeClass("active");
                $(this).parent().addClass("active");
                $(".results .wrapper-content-results .content-results .item-results").html(get_white_loading());
                $(this).parent().parent().removeClass('expanded');
                if (paramUrl[7] != 'draw' && paramUrl[7] != 'podium') {
                    $.loadResultContent('bwfdate');
                    e.preventDefault();
                }
                if (paramUrl[7] == 'draw') {
                    $.loadResultContent('bwfdraw');
                    e.preventDefault();
                }
                if (paramUrl[7] == 'podium') {
                    $.loadResultContent('bwfpodium');
                    e.preventDefault();
                }
            });
            $(document).on('change', 'select.ddlMatchResult', function(e) {
                pageUrl = $(this).val();
                var param = pageUrl.split('/');
                if (param[7] == 'draw') {
                    $('.wrapper-content-results .content-results .item-results .active').hide();
                    $('.wrapper-content-results .content-results .item-results .draws').show();
                    $('.wrapper-content-results .content-results .item-results .draws').html(get_white_loading());
                    $.loadResultContent('bwfdraw');
                } else {
                    $('.wrapper-content-results .content-results .item-results .active').show();
                    $('.wrapper-content-results .content-results .item-results .draws').hide();
                }
                e.preventDefault();
            });
            $.loadResultStat = function(matchCode) {
                $.ajax({
                    url: pageUrl + '&ajax=bwfstats',
                    type: 'GET',
                    contentType: "application/json; charset=utf-8",
                    success: function(data) {
                        $('ul.list-sort-time').find('li.stats').slideUp();
                        $('.results .wrapper-content-results .content-results .item-results').html('');
                        $('.results .wrapper-content-results .content-results .item-results').append(data);
                    }
                });
                if (pageUrl != window.location) {
                    window.history.pushState({
                        path: pageUrl
                    }, '', pageUrl);
                }
            }
            $(document).on('click', 'ul.list-sort-time li a#match-link', function(e) {
                pageUrl = $(this).attr('href');
                paramUrl = pageUrl.split(new RegExp(separators.join('|'), 'g'));
                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active')
                    $('ul.list-sort-time li.stats-' + paramUrl[1]).slideUp();
                    param = pageUrl.split('?');
                    pageUrl = param[0];
                    if (pageUrl != window.location) {
                        window.history.pushState({
                            path: pageUrl
                        }, '', pageUrl);
                    }
                    e.preventDefault();
                } else {
                    $('ul.list-sort-time').find('li.stats').slideUp();
                    $('ul.list-sort-time li.stats-' + paramUrl[1]).slideDown().html(get_white_loading_float());
                    $.loadResultStat(paramUrl[1]);
                    e.preventDefault();
                }
            });
            $(document).on('click', 'ul.list-sort-time li a#match-stat-tab', function(e) {
                pageUrl = $(this).attr('href');
                paramUrl = pageUrl.split(new RegExp(separators.join('|'), 'g'));
                $("#livescore-top .live-tab-content").html(get_white_loading_float());
                $.loadResultStat(paramUrl[1]);
                e.preventDefault();
            });
            $(document).on('click', 'table.game-stats a#game-stat-number', function(e) {
                pageUrl = $(this).attr('href');
                paramUrl = pageUrl.split(new RegExp(separators.join('|'), 'g'));
                $("#livescore-top .live-tab-content").html(get_white_loading_float());
                $.loadResultStat(paramUrl[1]);
                e.preventDefault();
            });
        }
    });
    $("#ajaxTabs").on('click', function() {
        $(this).toggleClass('expanded');
    });
})(jQuery);