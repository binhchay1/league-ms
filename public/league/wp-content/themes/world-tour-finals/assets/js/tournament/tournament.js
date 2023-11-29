(function($) {
    $(document).ready(function() {
        var separators = ['=', '&'];
        var paramUrl;
        var result = $('.results');
        if (result.length >= 0) {
            $.loadResultContent = function(ajaxType) {
                $.ajax({
                    url: pageUrl + '?ajaxTmt=' + ajaxType,
                    success: function(data) {
                        $('.content-main .wrapper-content-results .content-results').html(data);
                    }
                });
                if (pageUrl != window.location) {
                    window.history.pushState({
                        path: pageUrl
                    }, '', pageUrl);
                }
            }
            $(document).on('click', '#ajaxTabsTmt a', function(e) {
                pageUrl = $(this).attr('href');
                paramUrl = pageUrl.split('/');
                console.log(paramUrl[6]);
                $("#ajaxTabsTmt li").removeClass("active");
                $(this).parent().addClass("active");
                $(".content-main .wrapper-content-results .content-results").html(get_black_loading());
                $(this).parent().parent().removeClass('expanded');
                if (paramUrl[6] == 'overview') {
                    $('section.content-main').removeClass('bg-dark');
                    $('section.content-main').addClass('bg-white');
                    $.loadResultContent('overview');
                    e.preventDefault();
                }
                if (paramUrl[6] == 'history') {
                    $('section.content-main').removeClass('bg-dark');
                    $('section.content-main').addClass('bg-white');
                    $.loadResultContent('history');
                    e.preventDefault();
                }
                if (paramUrl[6] == 'gallery') {
                    $('section.content-main').removeClass('bg-dark');
                    $('section.content-main').addClass('bg-white');
                    $.loadResultContent('gallery');
                    e.preventDefault();
                }
            });
        }
    });
})(jQuery);