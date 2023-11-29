"use strict";
var $j;
$j = jQuery.noConflict();
$j(document).ready(function() {
    var contentImageSelector;
    contentImageSelector = '.content-news-detail .description img, ' +
        '.news--entry-content img, ' +
        '.page-content_holder img, ' +
        '#wcs-single img, .slider-section img' +
        '#slider-overview' +
        '#slider-playerprofile img, ' +
        '#event-slider img';
});
var bLazy = new Blazy({
    selector: 'img',
    offset: 100,
    success: function(ele) {},
    error: function(ele, msg) {
        if (msg === 'missing') {} else if (msg === 'invalid') {}
    }
});
var bLazyRevalidate = function() {
    setTimeout(function() {
        bLazy.revalidate();
    }, 500);
};
$j(window).load(function() {
    bLazyRevalidate();
});
$j(document).ajaxComplete(function(event, request, settings) {
    bLazyRevalidate();
});