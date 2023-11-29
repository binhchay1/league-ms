;
(function(window, document, $, undefined) {
    'use strict';
    if (!$) {
        return;
    }
    if ($.fn.fancybox) {
        $.error('fancyBox already initialized');
        return;
    }
    var defaults = {
        loop: false,
        margin: [44, 0],
        gutter: 50,
        keyboard: true,
        arrows: true,
        infobar: false,
        toolbar: true,
        buttons: ['slideShow', 'fullScreen', 'thumbs', 'close'],
        idleTime: 4,
        smallBtn: 'auto',
        protect: false,
        modal: false,
        image: {
            preload: "auto",
        },
        ajax: {
            settings: {
                data: {
                    fancybox: true
                }
            }
        },
        iframe: {
            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true" src=""></iframe>',
            preload: true,
            css: {},
            attr: {
                scrolling: 'auto'
            }
        },
        animationEffect: "zoom",
        animationDuration: 366,
        zoomOpacity: 'auto',
        transitionEffect: "fade",
        transitionDuration: 366,
        slideClass: '',
        baseClass: '',
        baseTpl: '<div class="fancybox-container" role="dialog" tabindex="-1">' +
            '<div class="fancybox-bg"></div>' +
            '<div class="fancybox-inner">' +
            '<div class="fancybox-infobar">' +
            '<button data-fancybox-prev title="{{PREV}}" class="fancybox-button fancybox-button--left"></button>' +
            '<div class="fancybox-infobar__body">' +
            '<span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span>' +
            '</div>' +
            '<button data-fancybox-next title="{{NEXT}}" class="fancybox-button fancybox-button--right"></button>' +
            '</div>' +
            '<div class="fancybox-toolbar">' +
            '{{BUTTONS}}' +
            '</div>' +
            '<div class="fancybox-navigation">' +
            '<button data-fancybox-prev title="{{PREV}}" class="fancybox-arrow fancybox-arrow--left" />' +
            '<button data-fancybox-next title="{{NEXT}}" class="fancybox-arrow fancybox-arrow--right" />' +
            '</div>' +
            '<div class="fancybox-stage"></div>' +
            '<div class="fancybox-caption-wrap">' +
            '<div class="fancybox-caption"></div>' +
            '</div>' +
            '</div>' +
            '</div>',
        spinnerTpl: '<div class="fancybox-loading"></div>',
        errorTpl: '<div class="fancybox-error"><p>{{ERROR}}<p></div>',
        btnTpl: {
            slideShow: '<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{PLAY_START}}"></button>',
            fullScreen: '<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fullscreen" title="{{FULL_SCREEN}}"></button>',
            thumbs: '<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{THUMBS}}"></button>',
            close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"></button>',
            smallBtn: '<button data-fancybox-close class="fancybox-close-small" title="{{CLOSE}}"></button>'
        },
        parentEl: 'body',
        autoFocus: true,
        backFocus: true,
        trapFocus: true,
        fullScreen: {
            autoStart: false,
        },
        touch: {
            vertical: true,
            momentum: true
        },
        hash: null,
        media: {},
        slideShow: {
            autoStart: false,
            speed: 4000
        },
        thumbs: {
            autoStart: false,
            hideOnClose: true
        },
        onInit: $.noop,
        beforeLoad: $.noop,
        afterLoad: $.noop,
        beforeShow: $.noop,
        afterShow: $.noop,
        beforeClose: $.noop,
        afterClose: $.noop,
        onActivate: $.noop,
        onDeactivate: $.noop,
        clickContent: function(current, event) {
            return current.type === 'image' ? 'zoom' : false;
        },
        clickSlide: 'close',
        clickOutside: 'close',
        dblclickContent: false,
        dblclickSlide: false,
        dblclickOutside: false,
        mobile: {
            clickContent: function(current, event) {
                return current.type === 'image' ? 'toggleControls' : false;
            },
            clickSlide: function(current, event) {
                return current.type === 'image' ? 'toggleControls' : 'close';
            },
            dblclickContent: function(current, event) {
                return current.type === 'image' ? 'zoom' : false;
            },
            dblclickSlide: function(current, event) {
                return current.type === 'image' ? 'zoom' : false;
            }
        },
        lang: 'en',
        i18n: {
            'en': {
                CLOSE: 'Close',
                NEXT: 'Next',
                PREV: 'Previous',
                ERROR: 'The requested content cannot be loaded. <br/> Please try again later.',
                PLAY_START: 'Start slideshow',
                PLAY_STOP: 'Pause slideshow',
                FULL_SCREEN: 'Full screen',
                THUMBS: 'Thumbnails'
            },
            'de': {
                CLOSE: 'Schliessen',
                NEXT: 'Weiter',
                PREV: 'Zurück',
                ERROR: 'Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es später nochmal.',
                PLAY_START: 'Diaschau starten',
                PLAY_STOP: 'Diaschau beenden',
                FULL_SCREEN: 'Vollbild',
                THUMBS: 'Vorschaubilder'
            }
        }
    };
    var $W = $(window);
    var $D = $(document);
    var called = 0;
    var isQuery = function(obj) {
        return obj && obj.hasOwnProperty && obj instanceof $;
    };
    var requestAFrame = (function() {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || function(callback) {
            return window.setTimeout(callback, 1000 / 60);
        };
    })();
    var transitionEnd = (function() {
        var t, el = document.createElement("fakeelement");
        var transitions = {
            "transition": "transitionend",
            "OTransition": "oTransitionEnd",
            "MozTransition": "transitionend",
            "WebkitTransition": "webkitTransitionEnd"
        };
        for (t in transitions) {
            if (el.style[t] !== undefined) {
                return transitions[t];
            }
        }
    })();
    var forceRedraw = function($el) {
        return ($el && $el.length && $el[0].offsetHeight);
    };
    var FancyBox = function(content, opts, index) {
        var self = this;
        self.opts = $.extend(true, {
            index: index
        }, defaults, opts || {});
        if (opts && $.isArray(opts.buttons)) {
            self.opts.buttons = opts.buttons;
        }
        self.id = self.opts.id || ++called;
        self.group = [];
        self.currIndex = parseInt(self.opts.index, 10) || 0;
        self.prevIndex = null;
        self.prevPos = null;
        self.currPos = 0;
        self.firstRun = null;
        self.createGroup(content);
        if (!self.group.length) {
            return;
        }
        self.$lastFocus = $(document.activeElement).blur();
        self.slides = {};
        self.init(content);
    };
    $.extend(FancyBox.prototype, {
        init: function() {
            var self = this;
            var testWidth, $container, buttonStr;
            var firstItemOpts = self.group[self.currIndex].opts;
            self.scrollTop = $D.scrollTop();
            self.scrollLeft = $D.scrollLeft();
            if (!$.fancybox.getInstance() && !$.fancybox.isMobile && $('body').css('overflow') !== 'hidden') {
                testWidth = $('body').width();
                $('html').addClass('fancybox-enabled');
                testWidth = $('body').width() - testWidth;
                if (testWidth > 1) {
                    $('head').append('<style id="fancybox-style-noscroll" type="text/css">.compensate-for-scrollbar, .fancybox-enabled body { margin-right: ' + testWidth + 'px; }</style>');
                }
            }
            buttonStr = '';
            $.each(firstItemOpts.buttons, function(index, value) {
                buttonStr += (firstItemOpts.btnTpl[value] || '');
            });
            $container = $(self.translate(self, firstItemOpts.baseTpl.replace('\{\{BUTTONS\}\}', buttonStr))).addClass('fancybox-is-hidden').attr('id', 'fancybox-container-' + self.id).addClass(firstItemOpts.baseClass).data('FancyBox', self).prependTo(firstItemOpts.parentEl);
            self.$refs = {
                container: $container
            };
            ['bg', 'inner', 'infobar', 'toolbar', 'stage', 'caption'].forEach(function(item) {
                self.$refs[item] = $container.find('.fancybox-' + item);
            });
            if (!firstItemOpts.arrows || self.group.length < 2) {
                $container.find('.fancybox-navigation').remove();
            }
            if (!firstItemOpts.infobar) {
                self.$refs.infobar.remove();
            }
            if (!firstItemOpts.toolbar) {
                self.$refs.toolbar.remove();
            }
            self.trigger('onInit');
            self.activate();
            self.jumpTo(self.currIndex);
        },
        translate: function(obj, str) {
            var arr = obj.opts.i18n[obj.opts.lang];
            return str.replace(/\{\{(\w+)\}\}/g, function(match, n) {
                var value = arr[n];
                if (value === undefined) {
                    return match;
                }
                return value;
            });
        },
        createGroup: function(content) {
            var self = this;
            var items = $.makeArray(content);
            $.each(items, function(i, item) {
                var obj = {},
                    opts = {},
                    data = [],
                    $item, type, src, srcParts;
                if ($.isPlainObject(item)) {
                    obj = item;
                    opts = item.opts || item;
                } else if ($.type(item) === 'object' && $(item).length) {
                    $item = $(item);
                    data = $item.data();
                    opts = 'options' in data ? data.options : {};
                    opts = $.type(opts) === 'object' ? opts : {};
                    obj.src = 'src' in data ? data.src : (opts.src || $item.attr('href'));
                    ['width', 'height', 'thumb', 'type', 'filter'].forEach(function(item) {
                        if (item in data) {
                            opts[item] = data[item];
                        }
                    });
                    if ('srcset' in data) {
                        opts.image = {
                            srcset: data.srcset
                        };
                    }
                    opts.$orig = $item;
                    if (!obj.type && !obj.src) {
                        obj.type = 'inline';
                        obj.src = item;
                    }
                } else {
                    obj = {
                        type: 'html',
                        src: item + ''
                    };
                }
                obj.opts = $.extend(true, {}, self.opts, opts);
                if ($.fancybox.isMobile) {
                    obj.opts = $.extend(true, {}, obj.opts, obj.opts.mobile);
                }
                type = obj.type || obj.opts.type;
                src = obj.src || '';
                if (!type && src) {
                    if (src.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i)) {
                        type = 'image';
                    } else if (src.match(/\.(pdf)((\?|#).*)?$/i)) {
                        type = 'pdf';
                    } else if (src.charAt(0) === '#') {
                        type = 'inline';
                    }
                }
                obj.type = type;
                obj.index = self.group.length;
                if (obj.opts.$orig && !obj.opts.$orig.length) {
                    delete obj.opts.$orig;
                }
                if (!obj.opts.$thumb && obj.opts.$orig) {
                    obj.opts.$thumb = obj.opts.$orig.find('img:first');
                }
                if (obj.opts.$thumb && !obj.opts.$thumb.length) {
                    delete obj.opts.$thumb;
                }
                if ($.type(obj.opts.caption) === 'function') {
                    obj.opts.caption = obj.opts.caption.apply(item, [self, obj]);
                } else if ('caption' in data) {
                    obj.opts.caption = data.caption;
                }
                obj.opts.caption = obj.opts.caption === undefined ? '' : obj.opts.caption + '';
                if (type === 'ajax') {
                    srcParts = src.split(/\s+/, 2);
                    if (srcParts.length > 1) {
                        obj.src = srcParts.shift();
                        obj.opts.filter = srcParts.shift();
                    }
                }
                if (obj.opts.smallBtn == 'auto') {
                    if ($.inArray(type, ['html', 'inline', 'ajax']) > -1) {
                        obj.opts.toolbar = false;
                        obj.opts.smallBtn = true;
                    } else {
                        obj.opts.smallBtn = false;
                    }
                }
                if (type === 'pdf') {
                    obj.type = 'iframe';
                    obj.opts.iframe.preload = false;
                }
                if (obj.opts.modal) {
                    obj.opts = $.extend(true, obj.opts, {
                        infobar: 0,
                        toolbar: 0,
                        smallBtn: 0,
                        keyboard: 0,
                        slideShow: 0,
                        fullScreen: 0,
                        thumbs: 0,
                        touch: 0,
                        clickContent: false,
                        clickSlide: false,
                        clickOutside: false,
                        dblclickContent: false,
                        dblclickSlide: false,
                        dblclickOutside: false
                    });
                }
                self.group.push(obj);
            });
        },
        addEvents: function() {
            var self = this;
            self.removeEvents();
            self.$refs.container.on('click.fb-close', '[data-fancybox-close]', function(e) {
                e.stopPropagation();
                e.preventDefault();
                self.close(e);
            }).on('click.fb-prev touchend.fb-prev', '[data-fancybox-prev]', function(e) {
                e.stopPropagation();
                e.preventDefault();
                self.previous();
            }).on('click.fb-next touchend.fb-next', '[data-fancybox-next]', function(e) {
                e.stopPropagation();
                e.preventDefault();
                self.next();
            });
            $W.on('orientationchange.fb resize.fb', function(e) {
                if (e && e.originalEvent && e.originalEvent.type === "resize") {
                    requestAFrame(function() {
                        self.update();
                    });
                } else {
                    self.$refs.stage.hide();
                    setTimeout(function() {
                        self.$refs.stage.show();
                        self.update();
                    }, 500);
                }
            });
            $D.on('focusin.fb', function(e) {
                var instance = $.fancybox ? $.fancybox.getInstance() : null;
                if (instance.isClosing || !instance.current || !instance.current.opts.trapFocus || $(e.target).hasClass('fancybox-container') || $(e.target).is(document)) {
                    return;
                }
                if (instance && $(e.target).css('position') !== 'fixed' && !instance.$refs.container.has(e.target).length) {
                    e.stopPropagation();
                    instance.focus();
                    $W.scrollTop(self.scrollTop).scrollLeft(self.scrollLeft);
                }
            });
            $D.on('keydown.fb', function(e) {
                var current = self.current,
                    keycode = e.keyCode || e.which;
                if (!current || !current.opts.keyboard) {
                    return;
                }
                if ($(e.target).is('input') || $(e.target).is('textarea')) {
                    return;
                }
                if (keycode === 8 || keycode === 27) {
                    e.preventDefault();
                    self.close(e);
                    return;
                }
                if (keycode === 37 || keycode === 38) {
                    e.preventDefault();
                    self.previous();
                    return;
                }
                if (keycode === 39 || keycode === 40) {
                    e.preventDefault();
                    self.next();
                    return;
                }
                self.trigger('afterKeydown', e, keycode);
            });
            if (self.group[self.currIndex].opts.idleTime) {
                self.idleSecondsCounter = 0;
                $D.on('mousemove.fb-idle mouseenter.fb-idle mouseleave.fb-idle mousedown.fb-idle touchstart.fb-idle touchmove.fb-idle scroll.fb-idle keydown.fb-idle', function() {
                    self.idleSecondsCounter = 0;
                    if (self.isIdle) {
                        self.showControls();
                    }
                    self.isIdle = false;
                });
                self.idleInterval = window.setInterval(function() {
                    self.idleSecondsCounter++;
                    if (self.idleSecondsCounter >= self.group[self.currIndex].opts.idleTime) {
                        self.isIdle = true;
                        self.idleSecondsCounter = 0;
                        self.hideControls();
                    }
                }, 1000);
            }
        },
        removeEvents: function() {
            var self = this;
            $W.off('orientationchange.fb resize.fb');
            $D.off('focusin.fb keydown.fb .fb-idle');
            this.$refs.container.off('.fb-close .fb-prev .fb-next');
            if (self.idleInterval) {
                window.clearInterval(self.idleInterval);
                self.idleInterval = null;
            }
        },
        previous: function(duration) {
            return this.jumpTo(this.currPos - 1, duration);
        },
        next: function(duration) {
            return this.jumpTo(this.currPos + 1, duration);
        },
        jumpTo: function(pos, duration, slide) {
            var self = this,
                firstRun, loop, current, previous, canvasWidth, currentPos, transitionProps;
            var groupLen = self.group.length;
            if (self.isSliding || self.isClosing || (self.isAnimating && self.firstRun)) {
                return;
            }
            pos = parseInt(pos, 10);
            loop = self.current ? self.current.opts.loop : self.opts.loop;
            if (!loop && (pos < 0 || pos >= groupLen)) {
                return false;
            }
            firstRun = self.firstRun = (self.firstRun === null);
            if (groupLen < 2 && !firstRun && !!self.isSliding) {
                return;
            }
            previous = self.current;
            self.prevIndex = self.currIndex;
            self.prevPos = self.currPos;
            current = self.createSlide(pos);
            if (groupLen > 1) {
                if (loop || current.index > 0) {
                    self.createSlide(pos - 1);
                }
                if (loop || current.index < groupLen - 1) {
                    self.createSlide(pos + 1);
                }
            }
            self.current = current;
            self.currIndex = current.index;
            self.currPos = current.pos;
            self.trigger('beforeShow', firstRun);
            self.updateControls();
            currentPos = $.fancybox.getTranslate(current.$slide);
            current.isMoved = (currentPos.left !== 0 || currentPos.top !== 0) && !current.$slide.hasClass('fancybox-animated');
            current.forcedDuration = undefined;
            if ($.isNumeric(duration)) {
                current.forcedDuration = duration;
            } else {
                duration = current.opts[firstRun ? 'animationDuration' : 'transitionDuration'];
            }
            duration = parseInt(duration, 10);
            if (firstRun) {
                if (current.opts.animationEffect && duration) {
                    self.$refs.container.css('transition-duration', duration + 'ms');
                }
                self.$refs.container.removeClass('fancybox-is-hidden');
                forceRedraw(self.$refs.container);
                self.$refs.container.addClass('fancybox-is-open');
                current.$slide.addClass('fancybox-slide--current');
                self.loadSlide(current);
                self.preload();
                return;
            }
            $.each(self.slides, function(index, slide) {
                $.fancybox.stop(slide.$slide);
            });
            current.$slide.removeClass('fancybox-slide--next fancybox-slide--previous').addClass('fancybox-slide--current');
            if (current.isMoved) {
                canvasWidth = Math.round(current.$slide.width());
                $.each(self.slides, function(index, slide) {
                    var pos = slide.pos - current.pos;
                    $.fancybox.animate(slide.$slide, {
                        top: 0,
                        left: (pos * canvasWidth) + (pos * slide.opts.gutter)
                    }, duration, function() {
                        slide.$slide.removeAttr('style').removeClass('fancybox-slide--next fancybox-slide--previous');
                        if (slide.pos === self.currPos) {
                            current.isMoved = false;
                            self.complete();
                        }
                    });
                });
            } else {
                self.$refs.stage.children().removeAttr('style');
            }
            if (current.isLoaded) {
                self.revealContent(current);
            } else {
                self.loadSlide(current);
            }
            self.preload();
            if (previous.pos === current.pos) {
                return;
            }
            transitionProps = 'fancybox-slide--' + (previous.pos > current.pos ? 'next' : 'previous');
            previous.$slide.removeClass('fancybox-slide--complete fancybox-slide--current fancybox-slide--next fancybox-slide--previous');
            previous.isComplete = false;
            if (!duration || (!current.isMoved && !current.opts.transitionEffect)) {
                return;
            }
            if (current.isMoved) {
                previous.$slide.addClass(transitionProps);
            } else {
                transitionProps = 'fancybox-animated ' + transitionProps + ' fancybox-fx-' + current.opts.transitionEffect;
                $.fancybox.animate(previous.$slide, transitionProps, duration, function() {
                    previous.$slide.removeClass(transitionProps).removeAttr('style');
                });
            }
        },
        createSlide: function(pos) {
            var self = this;
            var $slide;
            var index;
            index = pos % self.group.length;
            index = index < 0 ? self.group.length + index : index;
            if (!self.slides[pos] && self.group[index]) {
                $slide = $('<div class="fancybox-slide"></div>').appendTo(self.$refs.stage);
                self.slides[pos] = $.extend(true, {}, self.group[index], {
                    pos: pos,
                    $slide: $slide,
                    isLoaded: false,
                });
                self.updateSlide(self.slides[pos]);
            }
            return self.slides[pos];
        },
        scaleToActual: function(x, y, duration) {
            var self = this;
            var current = self.current;
            var $what = current.$content;
            var imgPos, posX, posY, scaleX, scaleY;
            var canvasWidth = parseInt(current.$slide.width(), 10);
            var canvasHeight = parseInt(current.$slide.height(), 10);
            var newImgWidth = current.width;
            var newImgHeight = current.height;
            if (!(current.type == 'image' && !current.hasError) || !$what || self.isAnimating) {
                return;
            }
            $.fancybox.stop($what);
            self.isAnimating = true;
            x = x === undefined ? canvasWidth * 0.5 : x;
            y = y === undefined ? canvasHeight * 0.5 : y;
            imgPos = $.fancybox.getTranslate($what);
            scaleX = newImgWidth / imgPos.width;
            scaleY = newImgHeight / imgPos.height;
            posX = (canvasWidth * 0.5 - newImgWidth * 0.5);
            posY = (canvasHeight * 0.5 - newImgHeight * 0.5);
            if (newImgWidth > canvasWidth) {
                posX = imgPos.left * scaleX - ((x * scaleX) - x);
                if (posX > 0) {
                    posX = 0;
                }
                if (posX < canvasWidth - newImgWidth) {
                    posX = canvasWidth - newImgWidth;
                }
            }
            if (newImgHeight > canvasHeight) {
                posY = imgPos.top * scaleY - ((y * scaleY) - y);
                if (posY > 0) {
                    posY = 0;
                }
                if (posY < canvasHeight - newImgHeight) {
                    posY = canvasHeight - newImgHeight;
                }
            }
            self.updateCursor(newImgWidth, newImgHeight);
            $.fancybox.animate($what, {
                top: posY,
                left: posX,
                scaleX: scaleX,
                scaleY: scaleY
            }, duration || 330, function() {
                self.isAnimating = false;
            });
            if (self.SlideShow && self.SlideShow.isActive) {
                self.SlideShow.stop();
            }
        },
        scaleToFit: function(duration) {
            var self = this;
            var current = self.current;
            var $what = current.$content;
            var end;
            if (!(current.type == 'image' && !current.hasError) || !$what || self.isAnimating) {
                return;
            }
            $.fancybox.stop($what);
            self.isAnimating = true;
            end = self.getFitPos(current);
            self.updateCursor(end.width, end.height);
            $.fancybox.animate($what, {
                top: end.top,
                left: end.left,
                scaleX: end.width / $what.width(),
                scaleY: end.height / $what.height()
            }, duration || 330, function() {
                self.isAnimating = false;
            });
        },
        getFitPos: function(slide) {
            var self = this;
            var $what = slide.$content;
            var imgWidth = slide.width;
            var imgHeight = slide.height;
            var margin = slide.opts.margin;
            var canvasWidth, canvasHeight, minRatio, width, height;
            if (!$what || !$what.length || (!imgWidth && !imgHeight)) {
                return false;
            }
            if ($.type(margin) === "number") {
                margin = [margin, margin];
            }
            if (margin.length == 2) {
                margin = [margin[0], margin[1], margin[0], margin[1]];
            }
            if ($W.width() < 800) {
                margin = [0, 0, 0, 0];
            }
            canvasWidth = parseInt(self.$refs.stage.width(), 10) - (margin[1] + margin[3]);
            canvasHeight = parseInt(self.$refs.stage.height(), 10) - (margin[0] + margin[2]);
            minRatio = Math.min(1, canvasWidth / imgWidth, canvasHeight / imgHeight);
            width = Math.floor(minRatio * imgWidth);
            height = Math.floor(minRatio * imgHeight);
            return {
                top: Math.floor((canvasHeight - height) * 0.5) + margin[0],
                left: Math.floor((canvasWidth - width) * 0.5) + margin[3],
                width: width,
                height: height
            };
        },
        update: function() {
            var self = this;
            $.each(self.slides, function(key, slide) {
                self.updateSlide(slide);
            });
        },
        updateSlide: function(slide) {
            var self = this;
            var $what = slide.$content;
            if ($what && (slide.width || slide.height)) {
                $.fancybox.stop($what);
                $.fancybox.setTranslate($what, self.getFitPos(slide));
                if (slide.pos === self.currPos) {
                    self.updateCursor();
                }
            }
            slide.$slide.trigger('refresh');
            self.trigger('onUpdate', slide);
        },
        updateCursor: function(nextWidth, nextHeight) {
            var self = this;
            var isScaledDown;
            var $container = self.$refs.container.removeClass('fancybox-is-zoomable fancybox-can-zoomIn fancybox-can-drag fancybox-can-zoomOut');
            if (!self.current || self.isClosing) {
                return;
            }
            if (self.isZoomable()) {
                $container.addClass('fancybox-is-zoomable');
                if (nextWidth !== undefined && nextHeight !== undefined) {
                    isScaledDown = nextWidth < self.current.width && nextHeight < self.current.height;
                } else {
                    isScaledDown = self.isScaledDown();
                }
                if (isScaledDown) {
                    $container.addClass('fancybox-can-zoomIn');
                } else {
                    if (self.current.opts.touch) {
                        $container.addClass('fancybox-can-drag');
                    } else {
                        $container.addClass('fancybox-can-zoomOut');
                    }
                }
            } else if (self.current.opts.touch) {
                $container.addClass('fancybox-can-drag');
            }
        },
        isZoomable: function() {
            var self = this;
            var current = self.current;
            var fitPos;
            if (!current || self.isClosing) {
                return;
            }
            if (current.type === 'image' && current.isLoaded && !current.hasError && (current.opts.clickContent === 'zoom' || ($.isFunction(current.opts.clickContent) && current.opts.clickContent(current) === "zoom"))) {
                fitPos = self.getFitPos(current);
                if (current.width > fitPos.width || current.height > fitPos.height) {
                    return true;
                }
            }
            return false;
        },
        isScaledDown: function() {
            var self = this;
            var current = self.current;
            var $what = current.$content;
            var rez = false;
            if ($what) {
                rez = $.fancybox.getTranslate($what);
                rez = rez.width < current.width || rez.height < current.height;
            }
            return rez;
        },
        canPan: function() {
            var self = this;
            var current = self.current;
            var $what = current.$content;
            var rez = false;
            if ($what) {
                rez = self.getFitPos(current);
                rez = Math.abs($what.width() - rez.width) > 1 || Math.abs($what.height() - rez.height) > 1;
            }
            return rez;
        },
        loadSlide: function(slide) {
            var self = this,
                type, $slide;
            var ajaxLoad;
            if (slide.isLoading) {
                return;
            }
            if (slide.isLoaded) {
                return;
            }
            slide.isLoading = true;
            self.trigger('beforeLoad', slide);
            type = slide.type;
            $slide = slide.$slide;
            $slide.off('refresh').trigger('onReset').addClass('fancybox-slide--' + (type || 'unknown')).addClass(slide.opts.slideClass);
            switch (type) {
                case 'image':
                    self.setImage(slide);
                    break;
                case 'iframe':
                    self.setIframe(slide);
                    break;
                case 'html':
                    self.setContent(slide, slide.src || slide.content);
                    break;
                case 'inline':
                    if ($(slide.src).length) {
                        self.setContent(slide, $(slide.src));
                    } else {
                        self.setError(slide);
                    }
                    break;
                case 'ajax':
                    self.showLoading(slide);
                    ajaxLoad = $.ajax($.extend({}, slide.opts.ajax.settings, {
                        url: slide.src,
                        success: function(data, textStatus) {
                            if (textStatus === 'success') {
                                self.setContent(slide, data);
                            }
                        },
                        error: function(jqXHR, textStatus) {
                            if (jqXHR && textStatus !== 'abort') {
                                self.setError(slide);
                            }
                        }
                    }));
                    $slide.one('onReset', function() {
                        ajaxLoad.abort();
                    });
                    break;
                default:
                    self.setError(slide);
                    break;
            }
            return true;
        },
        setImage: function(slide) {
            var self = this;
            var srcset = slide.opts.image.srcset;
            var found, temp, pxRatio, windowWidth;
            if (srcset) {
                pxRatio = window.devicePixelRatio || 1;
                windowWidth = window.innerWidth * pxRatio;
                temp = srcset.split(',').map(function(el) {
                    var ret = {};
                    el.trim().split(/\s+/).forEach(function(el, i) {
                        var value = parseInt(el.substring(0, el.length - 1), 10);
                        if (i === 0) {
                            return (ret.url = el);
                        }
                        if (value) {
                            ret.value = value;
                            ret.postfix = el[el.length - 1];
                        }
                    });
                    return ret;
                });
                temp.sort(function(a, b) {
                    return a.value - b.value;
                });
                for (var j = 0; j < temp.length; j++) {
                    var el = temp[j];
                    if ((el.postfix === 'w' && el.value >= windowWidth) || (el.postfix === 'x' && el.value >= pxRatio)) {
                        found = el;
                        break;
                    }
                }
                if (!found && temp.length) {
                    found = temp[temp.length - 1];
                }
                if (found) {
                    slide.src = found.url;
                    if (slide.width && slide.height && found.postfix == 'w') {
                        slide.height = (slide.width / slide.height) * found.value;
                        slide.width = found.value;
                    }
                }
            }
            slide.$content = $('<div class="fancybox-image-wrap"></div>').addClass('fancybox-is-hidden').appendTo(slide.$slide);
            if (slide.opts.preload !== false && slide.opts.width && slide.opts.height && (slide.opts.thumb || slide.opts.$thumb)) {
                slide.width = slide.opts.width;
                slide.height = slide.opts.height;
                slide.$ghost = $('<img />').one('error', function() {
                    $(this).remove();
                    slide.$ghost = null;
                    self.setBigImage(slide);
                }).one('load', function() {
                    self.afterLoad(slide);
                    self.setBigImage(slide);
                }).addClass('fancybox-image').appendTo(slide.$content).attr('src', slide.opts.thumb || slide.opts.$thumb.attr('src'));
            } else {
                self.setBigImage(slide);
            }
        },
        setBigImage: function(slide) {
            var self = this;
            var $img = $('<img />');
            slide.$image = $img.one('error', function() {
                self.setError(slide);
            }).one('load', function() {
                clearTimeout(slide.timouts);
                slide.timouts = null;
                if (self.isClosing) {
                    return;
                }
                slide.width = this.naturalWidth;
                slide.height = this.naturalHeight;
                if (slide.opts.image.srcset) {
                    $img.attr('sizes', '100vw').attr('srcset', slide.opts.image.srcset);
                }
                self.hideLoading(slide);
                if (slide.$ghost) {
                    slide.timouts = setTimeout(function() {
                        slide.timouts = null;
                        slide.$ghost.hide();
                    }, Math.min(300, Math.max(1000, slide.height / 1600)));
                } else {
                    self.afterLoad(slide);
                }
            }).addClass('fancybox-image').attr('src', slide.src).appendTo(slide.$content);
            if (($img[0].complete || $img[0].readyState == "complete") && $img[0].naturalWidth && $img[0].naturalHeight) {
                $img.trigger('load');
            } else if ($img[0].error) {
                $img.trigger('error');
            } else {
                slide.timouts = setTimeout(function() {
                    if (!$img[0].complete && !slide.hasError) {
                        self.showLoading(slide);
                    }
                }, 100);
            }
        },
        setIframe: function(slide) {
            var self = this,
                opts = slide.opts.iframe,
                $slide = slide.$slide,
                $iframe;
            slide.$content = $('<div class="fancybox-content' + (opts.preload ? ' fancybox-is-hidden' : '') + '"></div>').css(opts.css).appendTo($slide);
            $iframe = $(opts.tpl.replace(/\{rnd\}/g, new Date().getTime())).attr(opts.attr).appendTo(slide.$content);
            if (opts.preload) {
                self.showLoading(slide);
                $iframe.on('load.fb error.fb', function(e) {
                    this.isReady = 1;
                    slide.$slide.trigger('refresh');
                    self.afterLoad(slide);
                });
                $slide.on('refresh.fb', function() {
                    var $wrap = slide.$content,
                        frameWidth = opts.css.width,
                        frameHeight = opts.css.height,
                        scrollWidth, $contents, $body;
                    if ($iframe[0].isReady !== 1) {
                        return;
                    }
                    try {
                        $contents = $iframe.contents();
                        $body = $contents.find('body');
                    } catch (ignore) {}
                    if ($body && $body.length) {
                        if (frameWidth === undefined) {
                            scrollWidth = $iframe[0].contentWindow.document.documentElement.scrollWidth;
                            frameWidth = Math.ceil($body.outerWidth(true) + ($wrap.width() - scrollWidth));
                            frameWidth += $wrap.outerWidth() - $wrap.innerWidth();
                        }
                        if (frameHeight === undefined) {
                            frameHeight = Math.ceil($body.outerHeight(true));
                            frameHeight += $wrap.outerHeight() - $wrap.innerHeight();
                        }
                        if (frameWidth) {
                            $wrap.width(frameWidth);
                        }
                        if (frameHeight) {
                            $wrap.height(frameHeight);
                        }
                    }
                    $wrap.removeClass('fancybox-is-hidden');
                });
            } else {
                this.afterLoad(slide);
            }
            $iframe.attr('src', slide.src);
            if (slide.opts.smallBtn === true) {
                slide.$content.prepend(self.translate(slide, slide.opts.btnTpl.smallBtn));
            }
            $slide.one('onReset', function() {
                try {
                    $(this).find('iframe').hide().attr('src', '//about:blank');
                } catch (ignore) {}
                $(this).empty();
                slide.isLoaded = false;
            });
        },
        setContent: function(slide, content) {
            var self = this;
            if (self.isClosing) {
                return;
            }
            self.hideLoading(slide);
            slide.$slide.empty();
            if (isQuery(content) && content.parent().length) {
                content.parent('.fancybox-slide--inline').trigger('onReset');
                slide.$placeholder = $('<div></div>').hide().insertAfter(content);
                content.css('display', 'inline-block');
            } else if (!slide.hasError) {
                if ($.type(content) === 'string') {
                    content = $('<div>').append($.trim(content)).contents();
                    if (content[0].nodeType === 3) {
                        content = $('<div>').html(content);
                    }
                }
                if (slide.opts.filter) {
                    content = $('<div>').html(content).find(slide.opts.filter);
                }
            }
            slide.$slide.one('onReset', function() {
                if (slide.$placeholder) {
                    slide.$placeholder.after(content.hide()).remove();
                    slide.$placeholder = null;
                }
                if (slide.$smallBtn) {
                    slide.$smallBtn.remove();
                    slide.$smallBtn = null;
                }
                if (!slide.hasError) {
                    $(this).empty();
                    slide.isLoaded = false;
                }
            });
            slide.$content = $(content).appendTo(slide.$slide);
            if (slide.opts.smallBtn && !slide.$smallBtn) {
                slide.$smallBtn = $(self.translate(slide, slide.opts.btnTpl.smallBtn)).appendTo(slide.$content.filter('div').first());
            }
            this.afterLoad(slide);
        },
        setError: function(slide) {
            slide.hasError = true;
            slide.$slide.removeClass('fancybox-slide--' + slide.type);
            this.setContent(slide, this.translate(slide, slide.opts.errorTpl));
        },
        showLoading: function(slide) {
            var self = this;
            slide = slide || self.current;
            if (slide && !slide.$spinner) {
                slide.$spinner = $(self.opts.spinnerTpl).appendTo(slide.$slide);
            }
        },
        hideLoading: function(slide) {
            var self = this;
            slide = slide || self.current;
            if (slide && slide.$spinner) {
                slide.$spinner.remove();
                delete slide.$spinner;
            }
        },
        afterLoad: function(slide) {
            var self = this;
            if (self.isClosing) {
                return;
            }
            slide.isLoading = false;
            slide.isLoaded = true;
            self.trigger('afterLoad', slide);
            self.hideLoading(slide);
            if (slide.opts.protect && slide.$content && !slide.hasError) {
                slide.$content.on('contextmenu.fb', function(e) {
                    if (e.button == 2) {
                        e.preventDefault();
                    }
                    return true;
                });
                if (slide.type === 'image') {
                    $('<div class="fancybox-spaceball"></div>').appendTo(slide.$content);
                }
            }
            self.revealContent(slide);
        },
        revealContent: function(slide) {
            var self = this;
            var $slide = slide.$slide;
            var effect, effectClassName, duration, opacity, end, start = false;
            effect = slide.opts[self.firstRun ? 'animationEffect' : 'transitionEffect'];
            duration = slide.opts[self.firstRun ? 'animationDuration' : 'transitionDuration'];
            duration = parseInt(slide.forcedDuration === undefined ? duration : slide.forcedDuration, 10);
            if (slide.isMoved || slide.pos !== self.currPos || !duration) {
                effect = false;
            }
            if (effect === 'zoom' && !(slide.pos === self.currPos && duration && slide.type === 'image' && !slide.hasError && (start = self.getThumbPos(slide)))) {
                effect = 'fade';
            }
            if (effect === 'zoom') {
                end = self.getFitPos(slide);
                end.scaleX = end.width / start.width;
                end.scaleY = end.height / start.height;
                delete end.width;
                delete end.height;
                opacity = slide.opts.zoomOpacity;
                if (opacity == 'auto') {
                    opacity = Math.abs(slide.width / slide.height - start.width / start.height) > 0.1;
                }
                if (opacity) {
                    start.opacity = 0.1;
                    end.opacity = 1;
                }
                $.fancybox.setTranslate(slide.$content.removeClass('fancybox-is-hidden'), start);
                forceRedraw(slide.$content);
                $.fancybox.animate(slide.$content, end, duration, function() {
                    self.complete();
                });
                return;
            }
            self.updateSlide(slide);
            if (!effect) {
                forceRedraw($slide);
                slide.$content.removeClass('fancybox-is-hidden');
                if (slide.pos === self.currPos) {
                    self.complete();
                }
                return;
            }
            $.fancybox.stop($slide);
            effectClassName = 'fancybox-animated fancybox-slide--' + (slide.pos > self.prevPos ? 'next' : 'previous') + ' fancybox-fx-' + effect;
            $slide.removeAttr('style').removeClass('fancybox-slide--current fancybox-slide--next fancybox-slide--previous').addClass(effectClassName);
            slide.$content.removeClass('fancybox-is-hidden');
            forceRedraw($slide);
            $.fancybox.animate($slide, 'fancybox-slide--current', duration, function(e) {
                $slide.removeClass(effectClassName).removeAttr('style');
                if (slide.pos === self.currPos) {
                    self.complete();
                }
            }, true);
        },
        getThumbPos: function(slide) {
            var self = this;
            var rez = false;
            var isElementVisible = function($el) {
                var element = $el[0];
                var elementRect = element.getBoundingClientRect();
                var parentRects = [];
                var visibleInAllParents;
                while (element.parentElement !== null) {
                    if ($(element.parentElement).css('overflow') === 'hidden' || $(element.parentElement).css('overflow') === 'auto') {
                        parentRects.push(element.parentElement.getBoundingClientRect());
                    }
                    element = element.parentElement;
                }
                visibleInAllParents = parentRects.every(function(parentRect) {
                    var visiblePixelX = Math.min(elementRect.right, parentRect.right) - Math.max(elementRect.left, parentRect.left);
                    var visiblePixelY = Math.min(elementRect.bottom, parentRect.bottom) - Math.max(elementRect.top, parentRect.top);
                    return visiblePixelX > 0 && visiblePixelY > 0;
                });
                return visibleInAllParents && elementRect.bottom > 0 && elementRect.right > 0 && elementRect.left < $(window).width() && elementRect.top < $(window).height();
            };
            var $thumb = slide.opts.$thumb;
            var thumbPos = $thumb ? $thumb.offset() : 0;
            var slidePos;
            if (thumbPos && $thumb[0].ownerDocument === document && isElementVisible($thumb)) {
                slidePos = self.$refs.stage.offset();
                rez = {
                    top: thumbPos.top - slidePos.top + parseFloat($thumb.css("border-top-width") || 0),
                    left: thumbPos.left - slidePos.left + parseFloat($thumb.css("border-left-width") || 0),
                    width: $thumb.width(),
                    height: $thumb.height(),
                    scaleX: 1,
                    scaleY: 1
                };
            }
            return rez;
        },
        complete: function() {
            var self = this;
            var current = self.current;
            var slides = {};
            if (current.isMoved || !current.isLoaded || current.isComplete) {
                return;
            }
            current.isComplete = true;
            current.$slide.siblings().trigger('onReset');
            forceRedraw(current.$slide);
            current.$slide.addClass('fancybox-slide--complete');
            $.each(self.slides, function(key, slide) {
                if (slide.pos >= self.currPos - 1 && slide.pos <= self.currPos + 1) {
                    slides[slide.pos] = slide;
                } else if (slide) {
                    $.fancybox.stop(slide.$slide);
                    slide.$slide.off().remove();
                }
            });
            self.slides = slides;
            self.updateCursor();
            self.trigger('afterShow');
            if ($(document.activeElement).is('[disabled]') || (current.opts.autoFocus && !(current.type == 'image' || current.type === 'iframe'))) {
                self.focus();
            }
        },
        preload: function() {
            var self = this;
            var next, prev;
            if (self.group.length < 2) {
                return;
            }
            next = self.slides[self.currPos + 1];
            prev = self.slides[self.currPos - 1];
            if (next && next.type === 'image') {
                self.loadSlide(next);
            }
            if (prev && prev.type === 'image') {
                self.loadSlide(prev);
            }
        },
        focus: function() {
            var current = this.current;
            var $el;
            if (this.isClosing) {
                return;
            }
            if (current && current.isComplete) {
                $el = current.$slide.find('input[autofocus]:enabled:visible:first');
                if (!$el.length) {
                    $el = current.$slide.find('button,:input,[tabindex],a').filter(':enabled:visible:first');
                }
            }
            $el = $el && $el.length ? $el : this.$refs.container;
            $el.focus();
        },
        activate: function() {
            var self = this;
            $('.fancybox-container').each(function() {
                var instance = $(this).data('FancyBox');
                if (instance && instance.uid !== self.uid && !instance.isClosing) {
                    instance.trigger('onDeactivate');
                }
            });
            if (self.current) {
                if (self.$refs.container.index() > 0) {
                    self.$refs.container.prependTo(document.body);
                }
                self.updateControls();
            }
            self.trigger('onActivate');
            self.addEvents();
        },
        close: function(e, d) {
            var self = this;
            var current = self.current;
            var effect, duration;
            var $what, opacity, start, end;
            var done = function() {
                self.cleanUp(e);
            };
            if (self.isClosing) {
                return false;
            }
            self.isClosing = true;
            if (self.trigger('beforeClose', e) === false) {
                self.isClosing = false;
                requestAFrame(function() {
                    self.update();
                });
                return false;
            }
            self.removeEvents();
            if (current.timouts) {
                clearTimeout(current.timouts);
            }
            $what = current.$content;
            effect = current.opts.animationEffect;
            duration = $.isNumeric(d) ? d : (effect ? current.opts.animationDuration : 0);
            current.$slide.off(transitionEnd).removeClass('fancybox-slide--complete fancybox-slide--next fancybox-slide--previous fancybox-animated');
            current.$slide.siblings().trigger('onReset').remove();
            if (duration) {
                self.$refs.container.removeClass('fancybox-is-open').addClass('fancybox-is-closing');
            }
            self.hideLoading(current);
            self.hideControls();
            self.updateCursor();
            if (effect === 'zoom' && !(e !== true && $what && duration && current.type === 'image' && !current.hasError && (end = self.getThumbPos(current)))) {
                effect = 'fade';
            }
            if (effect === 'zoom') {
                $.fancybox.stop($what);
                start = $.fancybox.getTranslate($what);
                start.width = start.width * start.scaleX;
                start.height = start.height * start.scaleY;
                opacity = current.opts.zoomOpacity;
                if (opacity == 'auto') {
                    opacity = Math.abs(current.width / current.height - end.width / end.height) > 0.1;
                }
                if (opacity) {
                    end.opacity = 0;
                }
                start.scaleX = start.width / end.width;
                start.scaleY = start.height / end.height;
                start.width = end.width;
                start.height = end.height;
                $.fancybox.setTranslate(current.$content, start);
                $.fancybox.animate(current.$content, end, duration, done);
                return true;
            }
            if (effect && duration) {
                if (e === true) {
                    setTimeout(done, duration);
                } else {
                    $.fancybox.animate(current.$slide.removeClass('fancybox-slide--current'), 'fancybox-animated fancybox-slide--previous fancybox-fx-' + effect, duration, done);
                }
            } else {
                done();
            }
            return true;
        },
        cleanUp: function(e) {
            var self = this,
                instance;
            self.current.$slide.trigger('onReset');
            self.$refs.container.empty().remove();
            self.trigger('afterClose', e);
            if (self.$lastFocus && !!self.current.opts.backFocus) {
                self.$lastFocus.focus();
            }
            self.current = null;
            instance = $.fancybox.getInstance();
            if (instance) {
                instance.activate();
            } else {
                $W.scrollTop(self.scrollTop).scrollLeft(self.scrollLeft);
                $('html').removeClass('fancybox-enabled');
                $('#fancybox-style-noscroll').remove();
            }
        },
        trigger: function(name, slide) {
            var args = Array.prototype.slice.call(arguments, 1),
                self = this,
                obj = slide && slide.opts ? slide : self.current,
                rez;
            if (obj) {
                args.unshift(obj);
            } else {
                obj = self;
            }
            args.unshift(self);
            if ($.isFunction(obj.opts[name])) {
                rez = obj.opts[name].apply(obj, args);
            }
            if (rez === false) {
                return rez;
            }
            if (name === 'afterClose') {
                $D.trigger(name + '.fb', args);
            } else {
                self.$refs.container.trigger(name + '.fb', args);
            }
        },
        updateControls: function(force) {
            var self = this;
            var current = self.current;
            var index = current.index;
            var opts = current.opts;
            var caption = opts.caption;
            var $caption = self.$refs.caption;
            current.$slide.trigger('refresh');
            self.$caption = caption && caption.length ? $caption.html(caption) : null;
            if (!self.isHiddenControls) {
                self.showControls();
            }
            $('[data-fancybox-count]').html(self.group.length);
            $('[data-fancybox-index]').html(index + 1);
            $('[data-fancybox-prev]').prop('disabled', (!opts.loop && index <= 0));
            $('[data-fancybox-next]').prop('disabled', (!opts.loop && index >= self.group.length - 1));
        },
        hideControls: function() {
            this.isHiddenControls = true;
            this.$refs.container.removeClass('fancybox-show-infobar fancybox-show-toolbar fancybox-show-caption fancybox-show-nav');
        },
        showControls: function() {
            var self = this;
            var opts = self.current ? self.current.opts : self.opts;
            var $container = self.$refs.container;
            self.isHiddenControls = false;
            self.idleSecondsCounter = 0;
            $container.toggleClass('fancybox-show-toolbar', !!(opts.toolbar && opts.buttons)).toggleClass('fancybox-show-infobar', !!(opts.infobar && self.group.length > 1)).toggleClass('fancybox-show-nav', !!(opts.arrows && self.group.length > 1)).toggleClass('fancybox-is-modal', !!opts.modal);
            if (self.$caption) {
                $container.addClass('fancybox-show-caption ');
            } else {
                $container.removeClass('fancybox-show-caption');
            }
        },
        toggleControls: function() {
            if (this.isHiddenControls) {
                this.showControls();
            } else {
                this.hideControls();
            }
        },
    });
    $.fancybox = {
        version: "3.1.28",
        defaults: defaults,
        getInstance: function(command) {
            var instance = $('.fancybox-container:not(".fancybox-is-closing"):first').data('FancyBox');
            var args = Array.prototype.slice.call(arguments, 1);
            if (instance instanceof FancyBox) {
                if ($.type(command) === 'string') {
                    instance[command].apply(instance, args);
                } else if ($.type(command) === 'function') {
                    command.apply(instance, args);
                }
                return instance;
            }
            return false;
        },
        open: function(items, opts, index) {
            return new FancyBox(items, opts, index);
        },
        close: function(all) {
            var instance = this.getInstance();
            if (instance) {
                instance.close();
                if (all === true) {
                    this.close();
                }
            }
        },
        destroy: function() {
            this.close(true);
            $D.off('click.fb-start');
        },
        isMobile: document.createTouch !== undefined && /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent),
        use3d: (function() {
            var div = document.createElement('div');
            return window.getComputedStyle && window.getComputedStyle(div).getPropertyValue('transform') && !(document.documentMode && document.documentMode < 11);
        }()),
        getTranslate: function($el) {
            var matrix;
            if (!$el || !$el.length) {
                return false;
            }
            matrix = $el.eq(0).css('transform');
            if (matrix && matrix.indexOf('matrix') !== -1) {
                matrix = matrix.split('(')[1];
                matrix = matrix.split(')')[0];
                matrix = matrix.split(',');
            } else {
                matrix = [];
            }
            if (matrix.length) {
                if (matrix.length > 10) {
                    matrix = [matrix[13], matrix[12], matrix[0], matrix[5]];
                } else {
                    matrix = [matrix[5], matrix[4], matrix[0], matrix[3]];
                }
                matrix = matrix.map(parseFloat);
            } else {
                matrix = [0, 0, 1, 1];
                var transRegex = /\.*translate\((.*)px,(.*)px\)/i;
                var transRez = transRegex.exec($el.eq(0).attr('style'));
                if (transRez) {
                    matrix[0] = parseFloat(transRez[2]);
                    matrix[1] = parseFloat(transRez[1]);
                }
            }
            return {
                top: matrix[0],
                left: matrix[1],
                scaleX: matrix[2],
                scaleY: matrix[3],
                opacity: parseFloat($el.css('opacity')),
                width: $el.width(),
                height: $el.height()
            };
        },
        setTranslate: function($el, props) {
            var str = '';
            var css = {};
            if (!$el || !props) {
                return;
            }
            if (props.left !== undefined || props.top !== undefined) {
                str = (props.left === undefined ? $el.position().left : props.left) + 'px, ' + (props.top === undefined ? $el.position().top : props.top) + 'px';
                if (this.use3d) {
                    str = 'translate3d(' + str + ', 0px)';
                } else {
                    str = 'translate(' + str + ')';
                }
            }
            if (props.scaleX !== undefined && props.scaleY !== undefined) {
                str = (str.length ? str + ' ' : '') + 'scale(' + props.scaleX + ', ' + props.scaleY + ')';
            }
            if (str.length) {
                css.transform = str;
            }
            if (props.opacity !== undefined) {
                css.opacity = props.opacity;
            }
            if (props.width !== undefined) {
                css.width = props.width;
            }
            if (props.height !== undefined) {
                css.height = props.height;
            }
            return $el.css(css);
        },
        animate: function($el, to, duration, callback, leaveAnimationName) {
            var event = transitionEnd || 'transitionend';
            if ($.isFunction(duration)) {
                callback = duration;
                duration = null;
            }
            if (!$.isPlainObject(to)) {
                $el.removeAttr('style');
            }
            $el.on(event, function(e) {
                if (e && e.originalEvent && (!$el.is(e.originalEvent.target) || e.originalEvent.propertyName == 'z-index')) {
                    return;
                }
                $el.off(event);
                if ($.isPlainObject(to)) {
                    if (to.scaleX !== undefined && to.scaleY !== undefined) {
                        $el.css('transition-duration', '0ms');
                        to.width = Math.round($el.width() * to.scaleX);
                        to.height = Math.round($el.height() * to.scaleY);
                        to.scaleX = 1;
                        to.scaleY = 1;
                        $.fancybox.setTranslate($el, to);
                    }
                } else if (leaveAnimationName !== true) {
                    $el.removeClass(to);
                }
                if ($.isFunction(callback)) {
                    callback(e);
                }
            });
            if ($.isNumeric(duration)) {
                $el.css('transition-duration', duration + 'ms');
            }
            if ($.isPlainObject(to)) {
                $.fancybox.setTranslate($el, to);
            } else {
                $el.addClass(to);
            }
            $el.data("timer", setTimeout(function() {
                $el.trigger('transitionend');
            }, duration + 16));
        },
        stop: function($el) {
            clearTimeout($el.data("timer"));
            $el.off(transitionEnd);
        }
    };

    function _run(e) {
        var target = e.currentTarget,
            opts = e.data ? e.data.options : {},
            items = opts.selector ? $(opts.selector) : (e.data ? e.data.items : []),
            value = $(target).attr('data-fancybox') || '',
            index = 0,
            active = $.fancybox.getInstance();
        e.preventDefault();
        if (active && active.current.opts.$orig.is(target)) {
            return;
        }
        if (value) {
            items = items.length ? items.filter('[data-fancybox="' + value + '"]') : $('[data-fancybox="' + value + '"]');
            index = items.index(target);
            if (index < 0) {
                index = 0;
            }
        } else {
            items = [target];
        }
        $.fancybox.open(items, opts, index);
    }
    $.fn.fancybox = function(options) {
        var selector;
        options = options || {};
        selector = options.selector || false;
        if (selector) {
            $('body').off('click.fb-start', selector).on('click.fb-start', selector, {
                options: options
            }, _run);
        } else {
            this.off('click.fb-start').on('click.fb-start', {
                items: this,
                options: options
            }, _run);
        }
        return this;
    };
    $D.on('click.fb-start', '[data-fancybox]', _run);
}(window, document, window.jQuery || jQuery));;
(function($) {
    'use strict';
    var format = function(url, rez, params) {
        if (!url) {
            return;
        }
        params = params || '';
        if ($.type(params) === "object") {
            params = $.param(params, true);
        }
        $.each(rez, function(key, value) {
            url = url.replace('$' + key, value || '');
        });
        if (params.length) {
            url += (url.indexOf('?') > 0 ? '&' : '?') + params;
        }
        return url;
    };
    var defaults = {
        youtube: {
            matcher: /(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(watch\?(.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(.*)|[\w-]{11}|\?listType=(.*)&list=(.*))(.*)/i,
            params: {
                autoplay: 1,
                autohide: 1,
                fs: 1,
                rel: 0,
                hd: 1,
                wmode: 'transparent',
                enablejsapi: 1,
                html5: 1
            },
            paramPlace: 8,
            type: 'iframe',
            url: '//www.youtube.com/embed/$4',
            thumb: '//img.youtube.com/vi/$4/hqdefault.jpg'
        },
        vimeo: {
            matcher: /^.+vimeo.com\/(.*\/)?([\d]+)(.*)?/,
            params: {
                autoplay: 1,
                hd: 1,
                show_title: 1,
                show_byline: 1,
                show_portrait: 0,
                fullscreen: 1,
                api: 1
            },
            paramPlace: 3,
            type: 'iframe',
            url: '//player.vimeo.com/video/$2'
        },
        metacafe: {
            matcher: /metacafe.com\/watch\/(\d+)\/(.*)?/,
            type: 'iframe',
            url: '//www.metacafe.com/embed/$1/?ap=1'
        },
        dailymotion: {
            matcher: /dailymotion.com\/video\/(.*)\/?(.*)/,
            params: {
                additionalInfos: 0,
                autoStart: 1
            },
            type: 'iframe',
            url: '//www.dailymotion.com/embed/video/$1'
        },
        vine: {
            matcher: /vine.co\/v\/([a-zA-Z0-9\?\=\-]+)/,
            type: 'iframe',
            url: '//vine.co/v/$1/embed/simple'
        },
        instagram: {
            matcher: /(instagr\.am|instagram\.com)\/p\/([a-zA-Z0-9_\-]+)\/?/i,
            type: 'image',
            url: '//$1/p/$2/media/?size=l'
        },
        gmap_place: {
            matcher: /(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(((maps\/(place\/(.*)\/)?\@(.*),(\d+.?\d+?)z))|(\?ll=))(.*)?/i,
            type: 'iframe',
            url: function(rez) {
                return '//maps.google.' + rez[2] + '/?ll=' + (rez[9] ? rez[9] + '&z=' + Math.floor(rez[10]) + (rez[12] ? rez[12].replace(/^\//, "&") : '') : rez[12]) + '&output=' + (rez[12] && rez[12].indexOf('layer=c') > 0 ? 'svembed' : 'embed');
            }
        },
        gmap_search: {
            matcher: /(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(maps\/search\/)(.*)/i,
            type: 'iframe',
            url: function(rez) {
                return '//maps.google.' + rez[2] + '/maps?q=' + rez[5].replace('query=', 'q=').replace('api=1', '') + '&output=embed';
            }
        }
    };
    $(document).on('onInit.fb', function(e, instance) {
        $.each(instance.group, function(i, item) {
            var url = item.src || '',
                type = false,
                media, thumb, rez, params, urlParams, o, provider;
            if (item.type) {
                return;
            }
            media = $.extend(true, {}, defaults, item.opts.media);
            $.each(media, function(n, el) {
                rez = url.match(el.matcher);
                o = {};
                provider = n;
                if (!rez) {
                    return;
                }
                type = el.type;
                if (el.paramPlace && rez[el.paramPlace]) {
                    urlParams = rez[el.paramPlace];
                    if (urlParams[0] == '?') {
                        urlParams = urlParams.substring(1);
                    }
                    urlParams = urlParams.split('&');
                    for (var m = 0; m < urlParams.length; ++m) {
                        var p = urlParams[m].split('=', 2);
                        if (p.length == 2) {
                            o[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
                        }
                    }
                }
                params = $.extend(true, {}, el.params, item.opts[n], o);
                url = $.type(el.url) === "function" ? el.url.call(this, rez, params, item) : format(el.url, rez, params);
                thumb = $.type(el.thumb) === "function" ? el.thumb.call(this, rez, params, item) : format(el.thumb, rez);
                if (provider === 'vimeo') {
                    url = url.replace('&%23', '#');
                }
                return false;
            });
            if (type) {
                item.src = url;
                item.type = type;
                if (!item.opts.thumb && !(item.opts.$thumb && item.opts.$thumb.length)) {
                    item.opts.thumb = thumb;
                }
                if (type === 'iframe') {
                    $.extend(true, item.opts, {
                        iframe: {
                            preload: false,
                            attr: {
                                scrolling: "no"
                            }
                        }
                    });
                    item.contentProvider = provider;
                    item.opts.slideClass += ' fancybox-slide--' + (provider == 'gmap_place' || provider == 'gmap_search' ? 'map' : 'video');
                }
            } else {
                item.type = 'image';
            }
        });
    });
}(window.jQuery));;
(function(window, document, $) {
    'use strict';
    var requestAFrame = (function() {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || function(callback) {
            return window.setTimeout(callback, 1000 / 60);
        };
    })();
    var cancelAFrame = (function() {
        return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.oCancelAnimationFrame || function(id) {
            window.clearTimeout(id);
        };
    })();
    var pointers = function(e) {
        var result = [];
        e = e.originalEvent || e || window.e;
        e = e.touches && e.touches.length ? e.touches : (e.changedTouches && e.changedTouches.length ? e.changedTouches : [e]);
        for (var key in e) {
            if (e[key].pageX) {
                result.push({
                    x: e[key].pageX,
                    y: e[key].pageY
                });
            } else if (e[key].clientX) {
                result.push({
                    x: e[key].clientX,
                    y: e[key].clientY
                });
            }
        }
        return result;
    };
    var distance = function(point2, point1, what) {
        if (!point1 || !point2) {
            return 0;
        }
        if (what === 'x') {
            return point2.x - point1.x;
        } else if (what === 'y') {
            return point2.y - point1.y;
        }
        return Math.sqrt(Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2));
    };
    var isClickable = function($el) {
        if ($el.is('a,button,input,select,textarea,label') || $.isFunction($el.get(0).onclick) || $el.data('selectable')) {
            return true;
        }
        for (var i = 0, atts = $el[0].attributes, n = atts.length; i < n; i++) {
            if (atts[i].nodeName.substr(0, 14) === 'data-fancybox-') {
                return true;
            }
        }
        return false;
    };
    var hasScrollbars = function(el) {
        var overflowY = window.getComputedStyle(el)['overflow-y'];
        var overflowX = window.getComputedStyle(el)['overflow-x'];
        var vertical = (overflowY === 'scroll' || overflowY === 'auto') && el.scrollHeight > el.clientHeight;
        var horizontal = (overflowX === 'scroll' || overflowX === 'auto') && el.scrollWidth > el.clientWidth;
        return vertical || horizontal;
    };
    var isScrollable = function($el) {
        var rez = false;
        while (true) {
            rez = hasScrollbars($el.get(0));
            if (rez) {
                break;
            }
            $el = $el.parent();
            if (!$el.length || $el.hasClass('fancybox-stage') || $el.is('body')) {
                break;
            }
        }
        return rez;
    };
    var Guestures = function(instance) {
        var self = this;
        self.instance = instance;
        self.$bg = instance.$refs.bg;
        self.$stage = instance.$refs.stage;
        self.$container = instance.$refs.container;
        self.destroy();
        self.$container.on('touchstart.fb.touch mousedown.fb.touch', $.proxy(self, 'ontouchstart'));
    };
    Guestures.prototype.destroy = function() {
        this.$container.off('.fb.touch');
    };
    Guestures.prototype.ontouchstart = function(e) {
        var self = this;
        var $target = $(e.target);
        var instance = self.instance;
        var current = instance.current;
        var $content = current.$content;
        var isTouchDevice = (e.type == 'touchstart');
        if (isTouchDevice) {
            self.$container.off('mousedown.fb.touch');
        }
        if (!current || self.instance.isAnimating || self.instance.isClosing) {
            e.stopPropagation();
            e.preventDefault();
            return;
        }
        if (e.originalEvent && e.originalEvent.button == 2) {
            return;
        }
        if (!$target.length || isClickable($target) || isClickable($target.parent())) {
            return;
        }
        if (e.originalEvent.clientX > $target[0].clientWidth + $target.offset().left) {
            return;
        }
        self.startPoints = pointers(e);
        if (!self.startPoints || (self.startPoints.length > 1 && instance.isSliding)) {
            return;
        }
        self.$target = $target;
        self.$content = $content;
        self.canTap = true;
        $(document).off('.fb.touch');
        $(document).on(isTouchDevice ? 'touchend.fb.touch touchcancel.fb.touch' : 'mouseup.fb.touch mouseleave.fb.touch', $.proxy(self, "ontouchend"));
        $(document).on(isTouchDevice ? 'touchmove.fb.touch' : 'mousemove.fb.touch', $.proxy(self, "ontouchmove"));
        if (!(instance.current.opts.touch || instance.canPan()) || !($target.is(self.$stage) || self.$stage.find($target).length)) {
            if ($target.is('img')) {
                e.preventDefault();
            }
            return;
        }
        e.stopPropagation();
        if (!($.fancybox.isMobile && (isScrollable(self.$target) || isScrollable(self.$target.parent())))) {
            e.preventDefault();
        }
        self.canvasWidth = Math.round(current.$slide[0].clientWidth);
        self.canvasHeight = Math.round(current.$slide[0].clientHeight);
        self.startTime = new Date().getTime();
        self.distanceX = self.distanceY = self.distance = 0;
        self.isPanning = false;
        self.isSwiping = false;
        self.isZooming = false;
        self.sliderStartPos = self.sliderLastPos || {
            top: 0,
            left: 0
        };
        self.contentStartPos = $.fancybox.getTranslate(self.$content);
        self.contentLastPos = null;
        if (self.startPoints.length === 1 && !self.isZooming) {
            self.canTap = !instance.isSliding;
            if (current.type === 'image' && (self.contentStartPos.width > self.canvasWidth + 1 || self.contentStartPos.height > self.canvasHeight + 1)) {
                $.fancybox.stop(self.$content);
                self.$content.css('transition-duration', '0ms');
                self.isPanning = true;
            } else {
                self.isSwiping = true;
            }
            self.$container.addClass('fancybox-controls--isGrabbing');
        }
        if (self.startPoints.length === 2 && !instance.isAnimating && !current.hasError && current.type === 'image' && (current.isLoaded || current.$ghost)) {
            self.isZooming = true;
            self.isSwiping = false;
            self.isPanning = false;
            $.fancybox.stop(self.$content);
            self.$content.css('transition-duration', '0ms');
            self.centerPointStartX = ((self.startPoints[0].x + self.startPoints[1].x) * 0.5) - $(window).scrollLeft();
            self.centerPointStartY = ((self.startPoints[0].y + self.startPoints[1].y) * 0.5) - $(window).scrollTop();
            self.percentageOfImageAtPinchPointX = (self.centerPointStartX - self.contentStartPos.left) / self.contentStartPos.width;
            self.percentageOfImageAtPinchPointY = (self.centerPointStartY - self.contentStartPos.top) / self.contentStartPos.height;
            self.startDistanceBetweenFingers = distance(self.startPoints[0], self.startPoints[1]);
        }
    };
    Guestures.prototype.ontouchmove = function(e) {
        var self = this;
        self.newPoints = pointers(e);
        if ($.fancybox.isMobile && (isScrollable(self.$target) || isScrollable(self.$target.parent()))) {
            e.stopPropagation();
            self.canTap = false;
            return;
        }
        if (!(self.instance.current.opts.touch || self.instance.canPan()) || !self.newPoints || !self.newPoints.length) {
            return;
        }
        self.distanceX = distance(self.newPoints[0], self.startPoints[0], 'x');
        self.distanceY = distance(self.newPoints[0], self.startPoints[0], 'y');
        self.distance = distance(self.newPoints[0], self.startPoints[0]);
        if (self.distance > 0) {
            if (!(self.$target.is(self.$stage) || self.$stage.find(self.$target).length)) {
                return;
            }
            e.stopPropagation();
            e.preventDefault();
            if (self.isSwiping) {
                self.onSwipe();
            } else if (self.isPanning) {
                self.onPan();
            } else if (self.isZooming) {
                self.onZoom();
            }
        }
    };
    Guestures.prototype.onSwipe = function() {
        var self = this;
        var swiping = self.isSwiping;
        var left = self.sliderStartPos.left || 0;
        var angle;
        if (swiping === true) {
            if (Math.abs(self.distance) > 10) {
                self.canTap = false;
                if (self.instance.group.length < 2 && self.instance.opts.touch.vertical) {
                    self.isSwiping = 'y';
                } else if (self.instance.isSliding || self.instance.opts.touch.vertical === false || (self.instance.opts.touch.vertical === 'auto' && $(window).width() > 800)) {
                    self.isSwiping = 'x';
                } else {
                    angle = Math.abs(Math.atan2(self.distanceY, self.distanceX) * 180 / Math.PI);
                    self.isSwiping = (angle > 45 && angle < 135) ? 'y' : 'x';
                }
                self.instance.isSliding = self.isSwiping;
                self.startPoints = self.newPoints;
                $.each(self.instance.slides, function(index, slide) {
                    $.fancybox.stop(slide.$slide);
                    slide.$slide.css('transition-duration', '0ms');
                    slide.inTransition = false;
                    if (slide.pos === self.instance.current.pos) {
                        self.sliderStartPos.left = $.fancybox.getTranslate(slide.$slide).left;
                    }
                });
                if (self.instance.SlideShow && self.instance.SlideShow.isActive) {
                    self.instance.SlideShow.stop();
                }
            }
        } else {
            if (swiping == 'x') {
                if (self.distanceX > 0 && (self.instance.group.length < 2 || (self.instance.current.index === 0 && !self.instance.current.opts.loop))) {
                    left = left + Math.pow(self.distanceX, 0.8);
                } else if (self.distanceX < 0 && (self.instance.group.length < 2 || (self.instance.current.index === self.instance.group.length - 1 && !self.instance.current.opts.loop))) {
                    left = left - Math.pow(-self.distanceX, 0.8);
                } else {
                    left = left + self.distanceX;
                }
            }
            self.sliderLastPos = {
                top: swiping == 'x' ? 0 : self.sliderStartPos.top + self.distanceY,
                left: left
            };
            if (self.requestId) {
                cancelAFrame(self.requestId);
                self.requestId = null;
            }
            self.requestId = requestAFrame(function() {
                if (self.sliderLastPos) {
                    $.each(self.instance.slides, function(index, slide) {
                        var pos = slide.pos - self.instance.currPos;
                        $.fancybox.setTranslate(slide.$slide, {
                            top: self.sliderLastPos.top,
                            left: self.sliderLastPos.left + (pos * self.canvasWidth) + (pos * slide.opts.gutter)
                        });
                    });
                    self.$container.addClass('fancybox-is-sliding');
                }
            });
        }
    };
    Guestures.prototype.onPan = function() {
        var self = this;
        var newOffsetX, newOffsetY, newPos;
        self.canTap = false;
        if (self.contentStartPos.width > self.canvasWidth) {
            newOffsetX = self.contentStartPos.left + self.distanceX;
        } else {
            newOffsetX = self.contentStartPos.left;
        }
        newOffsetY = self.contentStartPos.top + self.distanceY;
        newPos = self.limitMovement(newOffsetX, newOffsetY, self.contentStartPos.width, self.contentStartPos.height);
        newPos.scaleX = self.contentStartPos.scaleX;
        newPos.scaleY = self.contentStartPos.scaleY;
        self.contentLastPos = newPos;
        if (self.requestId) {
            cancelAFrame(self.requestId);
            self.requestId = null;
        }
        self.requestId = requestAFrame(function() {
            $.fancybox.setTranslate(self.$content, self.contentLastPos);
        });
    };
    Guestures.prototype.limitMovement = function(newOffsetX, newOffsetY, newWidth, newHeight) {
        var self = this;
        var minTranslateX, minTranslateY, maxTranslateX, maxTranslateY;
        var canvasWidth = self.canvasWidth;
        var canvasHeight = self.canvasHeight;
        var currentOffsetX = self.contentStartPos.left;
        var currentOffsetY = self.contentStartPos.top;
        var distanceX = self.distanceX;
        var distanceY = self.distanceY;
        minTranslateX = Math.max(0, canvasWidth * 0.5 - newWidth * 0.5);
        minTranslateY = Math.max(0, canvasHeight * 0.5 - newHeight * 0.5);
        maxTranslateX = Math.min(canvasWidth - newWidth, canvasWidth * 0.5 - newWidth * 0.5);
        maxTranslateY = Math.min(canvasHeight - newHeight, canvasHeight * 0.5 - newHeight * 0.5);
        if (newWidth > canvasWidth) {
            if (distanceX > 0 && newOffsetX > minTranslateX) {
                newOffsetX = minTranslateX - 1 + Math.pow(-minTranslateX + currentOffsetX + distanceX, 0.8) || 0;
            }
            if (distanceX < 0 && newOffsetX < maxTranslateX) {
                newOffsetX = maxTranslateX + 1 - Math.pow(maxTranslateX - currentOffsetX - distanceX, 0.8) || 0;
            }
        }
        if (newHeight > canvasHeight) {
            if (distanceY > 0 && newOffsetY > minTranslateY) {
                newOffsetY = minTranslateY - 1 + Math.pow(-minTranslateY + currentOffsetY + distanceY, 0.8) || 0;
            }
            if (distanceY < 0 && newOffsetY < maxTranslateY) {
                newOffsetY = maxTranslateY + 1 - Math.pow(maxTranslateY - currentOffsetY - distanceY, 0.8) || 0;
            }
        }
        return {
            top: newOffsetY,
            left: newOffsetX
        };
    };
    Guestures.prototype.limitPosition = function(newOffsetX, newOffsetY, newWidth, newHeight) {
        var self = this;
        var canvasWidth = self.canvasWidth;
        var canvasHeight = self.canvasHeight;
        if (newWidth > canvasWidth) {
            newOffsetX = newOffsetX > 0 ? 0 : newOffsetX;
            newOffsetX = newOffsetX < canvasWidth - newWidth ? canvasWidth - newWidth : newOffsetX;
        } else {
            newOffsetX = Math.max(0, canvasWidth / 2 - newWidth / 2);
        }
        if (newHeight > canvasHeight) {
            newOffsetY = newOffsetY > 0 ? 0 : newOffsetY;
            newOffsetY = newOffsetY < canvasHeight - newHeight ? canvasHeight - newHeight : newOffsetY;
        } else {
            newOffsetY = Math.max(0, canvasHeight / 2 - newHeight / 2);
        }
        return {
            top: newOffsetY,
            left: newOffsetX
        };
    };
    Guestures.prototype.onZoom = function() {
        var self = this;
        var currentWidth = self.contentStartPos.width;
        var currentHeight = self.contentStartPos.height;
        var currentOffsetX = self.contentStartPos.left;
        var currentOffsetY = self.contentStartPos.top;
        var endDistanceBetweenFingers = distance(self.newPoints[0], self.newPoints[1]);
        var pinchRatio = endDistanceBetweenFingers / self.startDistanceBetweenFingers;
        var newWidth = Math.floor(currentWidth * pinchRatio);
        var newHeight = Math.floor(currentHeight * pinchRatio);
        var translateFromZoomingX = (currentWidth - newWidth) * self.percentageOfImageAtPinchPointX;
        var translateFromZoomingY = (currentHeight - newHeight) * self.percentageOfImageAtPinchPointY;
        var centerPointEndX = ((self.newPoints[0].x + self.newPoints[1].x) / 2) - $(window).scrollLeft();
        var centerPointEndY = ((self.newPoints[0].y + self.newPoints[1].y) / 2) - $(window).scrollTop();
        var translateFromTranslatingX = centerPointEndX - self.centerPointStartX;
        var translateFromTranslatingY = centerPointEndY - self.centerPointStartY;
        var newOffsetX = currentOffsetX + (translateFromZoomingX + translateFromTranslatingX);
        var newOffsetY = currentOffsetY + (translateFromZoomingY + translateFromTranslatingY);
        var newPos = {
            top: newOffsetY,
            left: newOffsetX,
            scaleX: self.contentStartPos.scaleX * pinchRatio,
            scaleY: self.contentStartPos.scaleY * pinchRatio
        };
        self.canTap = false;
        self.newWidth = newWidth;
        self.newHeight = newHeight;
        self.contentLastPos = newPos;
        if (self.requestId) {
            cancelAFrame(self.requestId);
            self.requestId = null;
        }
        self.requestId = requestAFrame(function() {
            $.fancybox.setTranslate(self.$content, self.contentLastPos);
        });
    };
    Guestures.prototype.ontouchend = function(e) {
        var self = this;
        var dMs = Math.max((new Date().getTime()) - self.startTime, 1);
        var swiping = self.isSwiping;
        var panning = self.isPanning;
        var zooming = self.isZooming;
        self.endPoints = pointers(e);
        self.$container.removeClass('fancybox-controls--isGrabbing');
        $(document).off('.fb.touch');
        if (self.requestId) {
            cancelAFrame(self.requestId);
            self.requestId = null;
        }
        self.isSwiping = false;
        self.isPanning = false;
        self.isZooming = false;
        if (self.canTap) {
            return self.onTap(e);
        }
        self.speed = 366;
        self.velocityX = self.distanceX / dMs * 0.5;
        self.velocityY = self.distanceY / dMs * 0.5;
        self.speedX = Math.max(self.speed * 0.5, Math.min(self.speed * 1.5, (1 / Math.abs(self.velocityX)) * self.speed));
        if (panning) {
            self.endPanning();
        } else if (zooming) {
            self.endZooming();
        } else {
            self.endSwiping(swiping);
        }
        return;
    };
    Guestures.prototype.endSwiping = function(swiping) {
        var self = this;
        var ret = false;
        self.instance.isSliding = false;
        self.sliderLastPos = null;
        if (swiping == 'y' && Math.abs(self.distanceY) > 50) {
            $.fancybox.animate(self.instance.current.$slide, {
                top: self.sliderStartPos.top + self.distanceY + (self.velocityY * 150),
                opacity: 0
            }, 150);
            ret = self.instance.close(true, 300);
        } else if (swiping == 'x' && self.distanceX > 50 && self.instance.group.length > 1) {
            ret = self.instance.previous(self.speedX);
        } else if (swiping == 'x' && self.distanceX < -50 && self.instance.group.length > 1) {
            ret = self.instance.next(self.speedX);
        }
        if (ret === false && (swiping == 'x' || swiping == 'y')) {
            self.instance.jumpTo(self.instance.current.index, 150);
        }
        self.$container.removeClass('fancybox-is-sliding');
    };
    Guestures.prototype.endPanning = function() {
        var self = this;
        var newOffsetX, newOffsetY, newPos;
        if (!self.contentLastPos) {
            return;
        }
        if (self.instance.current.opts.touch.momentum === false) {
            newOffsetX = self.contentLastPos.left;
            newOffsetY = self.contentLastPos.top;
        } else {
            newOffsetX = self.contentLastPos.left + (self.velocityX * self.speed);
            newOffsetY = self.contentLastPos.top + (self.velocityY * self.speed);
        }
        newPos = self.limitPosition(newOffsetX, newOffsetY, self.contentStartPos.width, self.contentStartPos.height);
        newPos.width = self.contentStartPos.width;
        newPos.height = self.contentStartPos.height;
        $.fancybox.animate(self.$content, newPos, 330);
    };
    Guestures.prototype.endZooming = function() {
        var self = this;
        var current = self.instance.current;
        var newOffsetX, newOffsetY, newPos, reset;
        var newWidth = self.newWidth;
        var newHeight = self.newHeight;
        if (!self.contentLastPos) {
            return;
        }
        newOffsetX = self.contentLastPos.left;
        newOffsetY = self.contentLastPos.top;
        reset = {
            top: newOffsetY,
            left: newOffsetX,
            width: newWidth,
            height: newHeight,
            scaleX: 1,
            scaleY: 1
        };
        $.fancybox.setTranslate(self.$content, reset);
        if (newWidth < self.canvasWidth && newHeight < self.canvasHeight) {
            self.instance.scaleToFit(150);
        } else if (newWidth > current.width || newHeight > current.height) {
            self.instance.scaleToActual(self.centerPointStartX, self.centerPointStartY, 150);
        } else {
            newPos = self.limitPosition(newOffsetX, newOffsetY, newWidth, newHeight);
            $.fancybox.setTranslate(self.content, $.fancybox.getTranslate(self.$content));
            $.fancybox.animate(self.$content, newPos, 150);
        }
    };
    Guestures.prototype.onTap = function(e) {
        var self = this;
        var $target = $(e.target);
        var instance = self.instance;
        var current = instance.current;
        var endPoints = (e && pointers(e)) || self.startPoints;
        var tapX = endPoints[0] ? endPoints[0].x - self.$stage.offset().left : 0;
        var tapY = endPoints[0] ? endPoints[0].y - self.$stage.offset().top : 0;
        var where;
        var process = function(prefix) {
            var action = current.opts[prefix];
            if ($.isFunction(action)) {
                action = action.apply(instance, [current, e]);
            }
            if (!action) {
                return;
            }
            switch (action) {
                case "close":
                    instance.close(self.startEvent);
                    break;
                case "toggleControls":
                    instance.toggleControls(true);
                    break;
                case "next":
                    instance.next();
                    break;
                case "nextOrClose":
                    if (instance.group.length > 1) {
                        instance.next();
                    } else {
                        instance.close(self.startEvent);
                    }
                    break;
                case "zoom":
                    if (current.type == 'image' && (current.isLoaded || current.$ghost)) {
                        if (instance.canPan()) {
                            instance.scaleToFit();
                        } else if (instance.isScaledDown()) {
                            instance.scaleToActual(tapX, tapY);
                        } else if (instance.group.length < 2) {
                            instance.close(self.startEvent);
                        }
                    }
                    break;
            }
        };
        if (e.originalEvent && e.originalEvent.button == 2) {
            return;
        }
        if (instance.isSliding) {
            return;
        }
        if (tapX > $target[0].clientWidth + $target.offset().left) {
            return;
        }
        if ($target.is('.fancybox-bg,.fancybox-inner,.fancybox-outer,.fancybox-container')) {
            where = 'Outside';
        } else if ($target.is('.fancybox-slide')) {
            where = 'Slide';
        } else if (instance.current.$content && instance.current.$content.has(e.target).length) {
            where = 'Content';
        } else {
            return;
        }
        if (self.tapped) {
            clearTimeout(self.tapped);
            self.tapped = null;
            if (Math.abs(tapX - self.tapX) > 50 || Math.abs(tapY - self.tapY) > 50 || instance.isSliding) {
                return this;
            }
            process('dblclick' + where);
        } else {
            self.tapX = tapX;
            self.tapY = tapY;
            if (current.opts['dblclick' + where] && current.opts['dblclick' + where] !== current.opts['click' + where]) {
                self.tapped = setTimeout(function() {
                    self.tapped = null;
                    process('click' + where);
                }, 300);
            } else {
                process('click' + where);
            }
        }
        return this;
    };
    $(document).on('onActivate.fb', function(e, instance) {
        if (instance && !instance.Guestures) {
            instance.Guestures = new Guestures(instance);
        }
    });
    $(document).on('beforeClose.fb', function(e, instance) {
        if (instance && instance.Guestures) {
            instance.Guestures.destroy();
        }
    });
}(window, document, window.jQuery));;
(function(document, $) {
    'use strict';
    var SlideShow = function(instance) {
        this.instance = instance;
        this.init();
    };
    $.extend(SlideShow.prototype, {
        timer: null,
        isActive: false,
        $button: null,
        speed: 3000,
        init: function() {
            var self = this;
            self.$button = self.instance.$refs.toolbar.find('[data-fancybox-play]').on('click', function() {
                self.toggle();
            });
            if (self.instance.group.length < 2 || !self.instance.group[self.instance.currIndex].opts.slideShow) {
                self.$button.hide();
            }
        },
        set: function() {
            var self = this;
            if (self.instance && self.instance.current && (self.instance.current.opts.loop || self.instance.currIndex < self.instance.group.length - 1)) {
                self.timer = setTimeout(function() {
                    self.instance.next();
                }, self.instance.current.opts.slideShow.speed || self.speed);
            } else {
                self.stop();
                self.instance.idleSecondsCounter = 0;
                self.instance.showControls();
            }
        },
        clear: function() {
            var self = this;
            clearTimeout(self.timer);
            self.timer = null;
        },
        start: function() {
            var self = this;
            var current = self.instance.current;
            if (self.instance && current && (current.opts.loop || current.index < self.instance.group.length - 1)) {
                self.isActive = true;
                self.$button.attr('title', current.opts.i18n[current.opts.lang].PLAY_STOP).addClass('fancybox-button--pause');
                if (current.isComplete) {
                    self.set();
                }
            }
        },
        stop: function() {
            var self = this;
            var current = self.instance.current;
            self.clear();
            self.$button.attr('title', current.opts.i18n[current.opts.lang].PLAY_START).removeClass('fancybox-button--pause');
            self.isActive = false;
        },
        toggle: function() {
            var self = this;
            if (self.isActive) {
                self.stop();
            } else {
                self.start();
            }
        }
    });
    $(document).on({
        'onInit.fb': function(e, instance) {
            if (instance && !instance.SlideShow) {
                instance.SlideShow = new SlideShow(instance);
            }
        },
        'beforeShow.fb': function(e, instance, current, firstRun) {
            var SlideShow = instance && instance.SlideShow;
            if (firstRun) {
                if (SlideShow && current.opts.slideShow.autoStart) {
                    SlideShow.start();
                }
            } else if (SlideShow && SlideShow.isActive) {
                SlideShow.clear();
            }
        },
        'afterShow.fb': function(e, instance, current) {
            var SlideShow = instance && instance.SlideShow;
            if (SlideShow && SlideShow.isActive) {
                SlideShow.set();
            }
        },
        'afterKeydown.fb': function(e, instance, current, keypress, keycode) {
            var SlideShow = instance && instance.SlideShow;
            if (SlideShow && current.opts.slideShow && (keycode === 80 || keycode === 32) && !$(document.activeElement).is('button,a,input')) {
                keypress.preventDefault();
                SlideShow.toggle();
            }
        },
        'beforeClose.fb onDeactivate.fb': function(e, instance) {
            var SlideShow = instance && instance.SlideShow;
            if (SlideShow) {
                SlideShow.stop();
            }
        }
    });
    $(document).on("visibilitychange", function() {
        var instance = $.fancybox.getInstance();
        var SlideShow = instance && instance.SlideShow;
        if (SlideShow && SlideShow.isActive) {
            if (document.hidden) {
                SlideShow.clear();
            } else {
                SlideShow.set();
            }
        }
    });
}(document, window.jQuery));;
(function(document, $) {
    'use strict';
    var fn = (function() {
        var fnMap = [
            ['requestFullscreen', 'exitFullscreen', 'fullscreenElement', 'fullscreenEnabled', 'fullscreenchange', 'fullscreenerror'],
            ['webkitRequestFullscreen', 'webkitExitFullscreen', 'webkitFullscreenElement', 'webkitFullscreenEnabled', 'webkitfullscreenchange', 'webkitfullscreenerror'],
            ['webkitRequestFullScreen', 'webkitCancelFullScreen', 'webkitCurrentFullScreenElement', 'webkitCancelFullScreen', 'webkitfullscreenchange', 'webkitfullscreenerror'],
            ['mozRequestFullScreen', 'mozCancelFullScreen', 'mozFullScreenElement', 'mozFullScreenEnabled', 'mozfullscreenchange', 'mozfullscreenerror'],
            ['msRequestFullscreen', 'msExitFullscreen', 'msFullscreenElement', 'msFullscreenEnabled', 'MSFullscreenChange', 'MSFullscreenError']
        ];
        var val;
        var ret = {};
        var i, j;
        for (i = 0; i < fnMap.length; i++) {
            val = fnMap[i];
            if (val && val[1] in document) {
                for (j = 0; j < val.length; j++) {
                    ret[fnMap[0][j]] = val[j];
                }
                return ret;
            }
        }
        return false;
    })();
    if (!fn) {
        if ($ && $.fancybox) {
            $.fancybox.defaults.btnTpl.fullScreen = false;
        }
        return;
    }
    var FullScreen = {
        request: function(elem) {
            elem = elem || document.documentElement;
            elem[fn.requestFullscreen](elem.ALLOW_KEYBOARD_INPUT);
        },
        exit: function() {
            document[fn.exitFullscreen]();
        },
        toggle: function(elem) {
            elem = elem || document.documentElement;
            if (this.isFullscreen()) {
                this.exit();
            } else {
                this.request(elem);
            }
        },
        isFullscreen: function() {
            return Boolean(document[fn.fullscreenElement]);
        },
        enabled: function() {
            return Boolean(document[fn.fullscreenEnabled]);
        }
    };
    $(document).on({
        'onInit.fb': function(e, instance) {
            var $container;
            var $button = instance.$refs.toolbar.find('[data-fancybox-fullscreen]');
            if (instance && !instance.FullScreen && instance.group[instance.currIndex].opts.fullScreen) {
                $container = instance.$refs.container;
                $container.on('click.fb-fullscreen', '[data-fancybox-fullscreen]', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    FullScreen.toggle($container[0]);
                });
                if (instance.opts.fullScreen && instance.opts.fullScreen.autoStart === true) {
                    FullScreen.request($container[0]);
                }
                instance.FullScreen = FullScreen;
            } else {
                $button.hide();
            }
        },
        'afterKeydown.fb': function(e, instance, current, keypress, keycode) {
            if (instance && instance.FullScreen && keycode === 70) {
                keypress.preventDefault();
                instance.FullScreen.toggle(instance.$refs.container[0]);
            }
        },
        'beforeClose.fb': function(instance) {
            if (instance && instance.FullScreen) {
                FullScreen.exit();
            }
        }
    });
    $(document).on(fn.fullscreenchange, function() {
        var instance = $.fancybox.getInstance();
        if (instance.current && instance.current.type === 'image' && instance.isAnimating) {
            instance.current.$content.css('transition', 'none');
            instance.isAnimating = false;
            instance.update(true, true, 0);
        }
        instance.trigger('onFullscreenChange', FullScreen.isFullscreen());
    });
}(document, window.jQuery));;
(function(document, $) {
    'use strict';
    var FancyThumbs = function(instance) {
        this.instance = instance;
        this.init();
    };
    $.extend(FancyThumbs.prototype, {
        $button: null,
        $grid: null,
        $list: null,
        isVisible: false,
        init: function() {
            var self = this;
            var first = self.instance.group[0],
                second = self.instance.group[1];
            self.$button = self.instance.$refs.toolbar.find('[data-fancybox-thumbs]');
            if (self.instance.group.length > 1 && self.instance.group[self.instance.currIndex].opts.thumbs && ((first.type == 'image' || first.opts.thumb || first.opts.$thumb) && (second.type == 'image' || second.opts.thumb || second.opts.$thumb))) {
                self.$button.on('click', function() {
                    self.toggle();
                });
                self.isActive = true;
            } else {
                self.$button.hide();
                self.isActive = false;
            }
        },
        create: function() {
            var instance = this.instance,
                list, src;
            this.$grid = $('<div class="fancybox-thumbs"></div>').appendTo(instance.$refs.container);
            list = '<ul>';
            $.each(instance.group, function(i, item) {
                src = item.opts.thumb || (item.opts.$thumb ? item.opts.$thumb.attr('src') : null);
                if (!src && item.type === 'image') {
                    src = item.src;
                }
                if (src && src.length) {
                    list += '<li data-index="' + i + '"  tabindex="0" class="fancybox-thumbs-loading"><img data-src="' + src + '" /></li>';
                }
            });
            list += '</ul>';
            this.$list = $(list).appendTo(this.$grid).on('click', 'li', function() {
                instance.jumpTo($(this).data('index'));
            });
            this.$list.find('img').hide().one('load', function() {
                var $parent = $(this).parent().removeClass('fancybox-thumbs-loading'),
                    thumbWidth = $parent.outerWidth(),
                    thumbHeight = $parent.outerHeight(),
                    width, height, widthRatio, heightRatio;
                width = this.naturalWidth || this.width;
                height = this.naturalHeight || this.height;
                widthRatio = width / thumbWidth;
                heightRatio = height / thumbHeight;
                if (widthRatio >= 1 && heightRatio >= 1) {
                    if (widthRatio > heightRatio) {
                        width = width / heightRatio;
                        height = thumbHeight;
                    } else {
                        width = thumbWidth;
                        height = height / widthRatio;
                    }
                }
                $(this).css({
                    width: Math.floor(width),
                    height: Math.floor(height),
                    'margin-top': Math.min(0, Math.floor(thumbHeight * 0.3 - height * 0.3)),
                    'margin-left': Math.min(0, Math.floor(thumbWidth * 0.5 - width * 0.5))
                }).show();
            }).each(function() {
                this.src = $(this).data('src');
            });
        },
        focus: function() {
            if (this.instance.current) {
                this.$list.children().removeClass('fancybox-thumbs-active').filter('[data-index="' + this.instance.current.index + '"]').addClass('fancybox-thumbs-active').focus();
            }
        },
        close: function() {
            this.$grid.hide();
        },
        update: function() {
            this.instance.$refs.container.toggleClass('fancybox-show-thumbs', this.isVisible);
            if (this.isVisible) {
                if (!this.$grid) {
                    this.create();
                }
                this.instance.trigger('onThumbsShow');
                this.focus();
            } else if (this.$grid) {
                this.instance.trigger('onThumbsHide');
            }
            this.instance.update();
        },
        hide: function() {
            this.isVisible = false;
            this.update();
        },
        show: function() {
            this.isVisible = true;
            this.update();
        },
        toggle: function() {
            this.isVisible = !this.isVisible;
            this.update();
        }
    });
    $(document).on({
        'onInit.fb': function(e, instance) {
            if (instance && !instance.Thumbs) {
                instance.Thumbs = new FancyThumbs(instance);
            }
        },
        'beforeShow.fb': function(e, instance, item, firstRun) {
            var Thumbs = instance && instance.Thumbs;
            if (!Thumbs || !Thumbs.isActive) {
                return;
            }
            if (item.modal) {
                Thumbs.$button.hide();
                Thumbs.hide();
                return;
            }
            if (firstRun && item.opts.thumbs.autoStart === true) {
                Thumbs.show();
            }
            if (Thumbs.isVisible) {
                Thumbs.focus();
            }
        },
        'afterKeydown.fb': function(e, instance, current, keypress, keycode) {
            var Thumbs = instance && instance.Thumbs;
            if (Thumbs && Thumbs.isActive && keycode === 71) {
                keypress.preventDefault();
                Thumbs.toggle();
            }
        },
        'beforeClose.fb': function(e, instance) {
            var Thumbs = instance && instance.Thumbs;
            if (Thumbs && Thumbs.isVisible && instance.opts.thumbs.hideOnClose !== false) {
                Thumbs.close();
            }
        }
    });
}(document, window.jQuery));;
(function(document, window, $) {
    'use strict';
    if (!$.escapeSelector) {
        $.escapeSelector = function(sel) {
            var rcssescape = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\x80-\uFFFF\w-]/g;
            var fcssescape = function(ch, asCodePoint) {
                if (asCodePoint) {
                    if (ch === "\0") {
                        return "\uFFFD";
                    }
                    return ch.slice(0, -1) + "\\" + ch.charCodeAt(ch.length - 1).toString(16) + " ";
                }
                return "\\" + ch;
            };
            return (sel + "").replace(rcssescape, fcssescape);
        };
    }
    var shouldCreateHistory = true;
    var currentHash = null;
    var timerID = null;

    function parseUrl() {
        var hash = window.location.hash.substr(1);
        var rez = hash.split('-');
        var index = rez.length > 1 && /^\+?\d+$/.test(rez[rez.length - 1]) ? parseInt(rez.pop(-1), 10) || 1 : 1;
        var gallery = rez.join('-');
        if (index < 1) {
            index = 1;
        }
        return {
            hash: hash,
            index: index,
            gallery: gallery
        };
    }

    function triggerFromUrl(url) {
        var $el;
        if (url.gallery !== '') {
            $el = $("[data-fancybox='" + $.escapeSelector(url.gallery) + "']").eq(url.index - 1);
            if (!$el.length) {
                $el = $("#" + $.escapeSelector(url.gallery) + "");
            }
            if ($el.length) {
                shouldCreateHistory = false;
                $el.trigger('click');
            }
        }
    }

    function getGalleryID(instance) {
        var opts;
        if (!instance) {
            return false;
        }
        opts = instance.current ? instance.current.opts : instance.opts;
        return opts.hash || (opts.$orig ? opts.$orig.data('fancybox') : '');
    }
    $(function() {
        setTimeout(function() {
            if ($.fancybox.defaults.hash === false) {
                return;
            }
            $(document).on({
                'onInit.fb': function(e, instance) {
                    var url, gallery;
                    if (instance.group[instance.currIndex].opts.hash === false) {
                        return;
                    }
                    url = parseUrl();
                    gallery = getGalleryID(instance);
                    if (gallery && url.gallery && gallery == url.gallery) {
                        instance.currIndex = url.index - 1;
                    }
                },
                'beforeShow.fb': function(e, instance, current) {
                    var gallery;
                    if (!current || current.opts.hash === false) {
                        return;
                    }
                    gallery = getGalleryID(instance);
                    if (gallery && gallery !== '') {
                        if (window.location.hash.indexOf(gallery) < 0) {
                            instance.opts.origHash = window.location.hash;
                        }
                        currentHash = gallery + (instance.group.length > 1 ? '-' + (current.index + 1) : '');
                        if ('replaceState' in window.history) {
                            if (timerID) {
                                clearTimeout(timerID);
                            }
                            timerID = setTimeout(function() {
                                window.history[shouldCreateHistory ? 'pushState' : 'replaceState']({}, document.title, window.location.pathname + window.location.search + '#' + currentHash);
                                timerID = null;
                                shouldCreateHistory = false;
                            }, 300);
                        } else {
                            window.location.hash = currentHash;
                        }
                    }
                },
                'beforeClose.fb': function(e, instance, current) {
                    var gallery, origHash;
                    if (timerID) {
                        clearTimeout(timerID);
                    }
                    if (current.opts.hash === false) {
                        return;
                    }
                    gallery = getGalleryID(instance);
                    origHash = instance && instance.opts.origHash ? instance.opts.origHash : '';
                    if (gallery && gallery !== '') {
                        if ('replaceState' in history) {
                            window.history.replaceState({}, document.title, window.location.pathname + window.location.search + origHash);
                        } else {
                            window.location.hash = origHash;
                            $(window).scrollTop(instance.scrollTop).scrollLeft(instance.scrollLeft);
                        }
                    }
                    currentHash = null;
                }
            });
            $(window).on('hashchange.fb', function() {
                var url = parseUrl();
                if ($.fancybox.getInstance()) {
                    if (currentHash && currentHash !== url.gallery + '-' + url.index && !(url.index === 1 && currentHash == url.gallery)) {
                        currentHash = null;
                        $.fancybox.close();
                    }
                } else if (url.gallery !== '') {
                    triggerFromUrl(url);
                }
            });
            triggerFromUrl(parseUrl());
        }, 50);
    });
}(document, window, window.jQuery));