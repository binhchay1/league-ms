;
(function($, window, document, undefined) {
    var item, dom, width, num, pos, drag, speed, state, e;
    item = {
        index: false,
        indexAbs: false,
        posLeft: false,
        clone: false,
        active: false,
        loaded: false,
        lazyLoad: false,
        current: false,
        width: false,
        center: false,
        page: false,
        hasVideo: false,
        playVideo: false
    };
    dom = {
        el: null,
        $el: null,
        stage: null,
        $stage: null,
        oStage: null,
        $oStage: null,
        $items: null,
        $oItems: null,
        $cItems: null,
        $content: null
    };
    width = {
        el: 0,
        stage: 0,
        item: 0,
        prevWindow: 0,
        cloneLast: 0
    };
    num = {
        items: 0,
        oItems: 0,
        cItems: 0,
        active: 0,
        merged: []
    };
    drag = {
        start: 0,
        startX: 0,
        startY: 0,
        current: 0,
        currentX: 0,
        currentY: 0,
        offsetX: 0,
        offsetY: 0,
        distance: null,
        startTime: 0,
        endTime: 0,
        updatedX: 0,
        targetEl: null
    };
    state = {
        isTouch: false,
        isScrolling: false,
        isSwiping: false,
        direction: false,
        inMotion: false
    };
    e = {
        _onDragStart: null,
        _onDragMove: null,
        _onDragEnd: null,
        _transitionEnd: null,
        _resizer: null,
        _responsiveCall: null,
        _goToLoop: null,
        _checkVisibile: null
    };

    function Owl(element, options) {
        element.owlCarousel = {
            'name': 'Owl Carousel',
            'author': 'Bartosz Wojciechowski',
            'version': '2.0.0-beta.2.1'
        };
        this.settings = null;
        this.options = $.extend({}, Owl.Defaults, options);
        this.itemData = $.extend({}, item);
        this.dom = $.extend({}, dom);
        this.width = $.extend({}, width);
        this.num = $.extend({}, num);
        this.drag = $.extend({}, drag);
        this.state = $.extend({}, state);
        this.e = $.extend({}, e);
        this.plugins = {};
        this._supress = {};
        this._current = null;
        this._speed = null;
        this._coordinates = null;
        this.dom.el = element;
        this.dom.$el = $(element);
        for (var plugin in Owl.Plugins) {
            this.plugins[plugin[0].toLowerCase() + plugin.slice(1)] = new Owl.Plugins[plugin](this);
        }
        this.init();
    }
    Owl.Defaults = {
        items: 3,
        loop: false,
        center: false,
        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,
        margin: 0,
        stagePadding: 0,
        merge: false,
        mergeFit: true,
        autoWidth: false,
        startPosition: 0,
        smartSpeed: 250,
        fluidSpeed: false,
        dragEndSpeed: false,
        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,
        responsiveClass: false,
        fallbackEasing: 'swing',
        info: false,
        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',
        themeClass: 'owl-theme',
        baseClass: 'owl-carousel',
        itemClass: 'owl-item',
        centerClass: 'center',
        activeClass: 'active'
    };
    Owl.Plugins = {};
    Owl.prototype.init = function() {
        this.setResponsiveOptions();
        this.trigger('initialize');
        if (!this.dom.$el.hasClass(this.settings.baseClass)) {
            this.dom.$el.addClass(this.settings.baseClass);
        }
        if (!this.dom.$el.hasClass(this.settings.themeClass)) {
            this.dom.$el.addClass(this.settings.themeClass);
        }
        if (this.settings.rtl) {
            this.dom.$el.addClass('owl-rtl');
        }
        this.browserSupport();
        if (this.settings.autoWidth && this.state.imagesLoaded !== true) {
            var imgs, nestedSelector, width;
            imgs = this.dom.$el.find('img');
            nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
            width = this.dom.$el.children(nestedSelector).width();
            if (imgs.length && width <= 0) {
                this.preloadAutoWidthImages(imgs);
                return false;
            }
        }
        this.width.prevWindow = this.viewport();
        this.createStage();
        this.fetchContent();
        this.eventsCall();
        this.internalEvents();
        this.dom.$el.addClass('owl-loading');
        this.refresh(true);
        this.dom.$el.removeClass('owl-loading').addClass('owl-loaded');
        this.trigger('initialized');
        this.addTriggerableEvents();
    };
    Owl.prototype.setResponsiveOptions = function() {
        if (!this.options.responsive) {
            this.settings = $.extend({}, this.options);
        } else {
            var viewport = this.viewport(),
                overwrites = this.options.responsive,
                match = -1;
            $.each(overwrites, function(breakpoint) {
                if (breakpoint <= viewport && breakpoint > match) {
                    match = Number(breakpoint);
                }
            });
            this.settings = $.extend({}, this.options, overwrites[match]);
            delete this.settings.responsive;
            if (this.settings.responsiveClass) {
                this.dom.$el.attr('class', function(i, c) {
                    return c.replace(/\b owl-responsive-\S+/g, '');
                }).addClass('owl-responsive-' + match);
            }
        }
    };
    Owl.prototype.optionsLogic = function() {
        this.dom.$el.toggleClass('owl-center', this.settings.center);
        if (this.settings.loop && this.num.oItems < this.settings.items) {
            this.settings.loop = false;
        }
        if (this.settings.autoWidth) {
            this.settings.stagePadding = false;
            this.settings.merge = false;
        }
    };
    Owl.prototype.createStage = function() {
        var oStage = document.createElement('div'),
            stage = document.createElement(this.settings.stageElement);
        oStage.className = 'owl-stage-outer';
        stage.className = 'owl-stage';
        oStage.appendChild(stage);
        this.dom.el.appendChild(oStage);
        this.dom.oStage = oStage;
        this.dom.$oStage = $(oStage);
        this.dom.stage = stage;
        this.dom.$stage = $(stage);
        oStage = null;
        stage = null;
    };
    Owl.prototype.createItemContainer = function() {
        var item = document.createElement(this.settings.itemElement);
        item.className = this.settings.itemClass;
        return $(item);
    };
    Owl.prototype.fetchContent = function(extContent) {
        if (extContent) {
            this.dom.$content = (extContent instanceof jQuery) ? extContent : $(extContent);
        } else if (this.settings.nestedItemSelector) {
            this.dom.$content = this.dom.$el.find('.' + this.settings.nestedItemSelector).not('.owl-stage-outer');
        } else {
            this.dom.$content = this.dom.$el.children().not('.owl-stage-outer');
        }
        this.num.oItems = this.dom.$content.length;
        if (this.num.oItems !== 0) {
            this.initStructure();
        }
    };
    Owl.prototype.initStructure = function() {
        this.createNormalStructure();
    };
    Owl.prototype.createNormalStructure = function() {
        var i, $item;
        for (i = 0; i < this.num.oItems; i++) {
            $item = this.createItemContainer();
            this.initializeItemContainer($item, this.dom.$content[i]);
            this.dom.$stage.append($item);
        }
        this.dom.$content = null;
    };
    Owl.prototype.createCustomStructure = function(howManyItems) {
        var i, $item;
        for (i = 0; i < howManyItems; i++) {
            $item = this.createItemContainer();
            this.createItemContainerData($item);
            this.dom.$stage.append($item);
        }
    };
    Owl.prototype.initializeItemContainer = function(item, content) {
        this.trigger('change', {
            property: {
                name: 'item',
                value: item
            }
        });
        this.createItemContainerData(item);
        item.append(content);
        this.trigger('changed', {
            property: {
                name: 'item',
                value: item
            }
        });
    };
    Owl.prototype.createItemContainerData = function(item, source) {
        var data = $.extend({}, this.itemData);
        if (source) {
            $.extend(data, source.data('owl-item'));
        }
        item.data('owl-item', data);
    };
    Owl.prototype.cloneItemContainer = function(item) {
        var $clone = item.clone(true, true).addClass('cloned');
        this.createItemContainerData($clone, $clone);
        $clone.data('owl-item').clone = true;
        return $clone;
    };
    Owl.prototype.updateLocalContent = function() {
        var k, item;
        this.dom.$oItems = this.dom.$stage.find('.' + this.settings.itemClass).filter(function() {
            return $(this).data('owl-item').clone === false;
        });
        this.num.oItems = this.dom.$oItems.length;
        for (k = 0; k < this.num.oItems; k++) {
            item = this.dom.$oItems.eq(k);
            item.data('owl-item').index = k;
        }
    };
    Owl.prototype.loopClone = function() {
        if (!this.settings.loop || this.num.oItems < this.settings.items) {
            return false;
        }
        var append, prepend, i, items = this.settings.items,
            last = this.num.oItems - 1;
        if (this.settings.stagePadding && this.settings.items === 1) {
            items += 1;
        }
        this.num.cItems = items * 2;
        for (i = 0; i < items; i++) {
            append = this.cloneItemContainer(this.dom.$oItems.eq(i));
            prepend = this.cloneItemContainer(this.dom.$oItems.eq(last - i));
            this.dom.$stage.append(append);
            this.dom.$stage.prepend(prepend);
        }
        this.dom.$cItems = this.dom.$stage.find('.' + this.settings.itemClass).filter(function() {
            return $(this).data('owl-item').clone === true;
        });
    };
    Owl.prototype.reClone = function() {
        if (this.dom.$cItems !== null) {
            this.dom.$cItems.remove();
            this.dom.$cItems = null;
            this.num.cItems = 0;
        }
        if (!this.settings.loop) {
            return;
        }
        this.loopClone();
    };
    Owl.prototype.calculate = function() {
        var i, j, elMinusMargin, dist, allItems, iWidth, mergeNumber, posLeft = 0,
            fullWidth = 0;
        this.width.el = this.dom.$el.width() - (this.settings.stagePadding * 2);
        this.width.view = this.dom.$el.width();
        elMinusMargin = this.width.el - (this.settings.margin * (this.settings.items === 1 ? 0 : this.settings.items - 1));
        this.width.el = this.width.el + this.settings.margin;
        this.width.item = ((elMinusMargin / this.settings.items) + this.settings.margin).toFixed(3);
        this.dom.$items = this.dom.$stage.find('.owl-item');
        this.num.items = this.dom.$items.length;
        if (this.settings.autoWidth) {
            this.dom.$items.css('width', '');
        }
        this._coordinates = [];
        this.num.merged = [];
        if (this.settings.rtl) {
            dist = this.settings.center ? -((this.width.el) / 2) : 0;
        } else {
            dist = this.settings.center ? (this.width.el) / 2 : 0;
        }
        this.width.mergeStage = 0;
        for (i = 0; i < this.num.items; i++) {
            if (this.settings.merge) {
                mergeNumber = this.dom.$items.eq(i).find('[data-merge]').attr('data-merge') || 1;
                if (this.settings.mergeFit && mergeNumber > this.settings.items) {
                    mergeNumber = this.settings.items;
                }
                this.num.merged.push(parseInt(mergeNumber));
                this.width.mergeStage += this.width.item * this.num.merged[i];
            } else {
                this.num.merged.push(1);
            }
            iWidth = this.width.item * this.num.merged[i];
            if (this.settings.autoWidth) {
                iWidth = this.dom.$items.eq(i).width() + this.settings.margin;
                if (this.settings.rtl) {
                    this.dom.$items[i].style.marginLeft = this.settings.margin + 'px';
                } else {
                    this.dom.$items[i].style.marginRight = this.settings.margin + 'px';
                }
            }
            this._coordinates.push(dist);
            this.dom.$items.eq(i).data('owl-item').posLeft = posLeft;
            this.dom.$items.eq(i).data('owl-item').width = iWidth;
            if (this.settings.rtl) {
                dist += iWidth;
                posLeft += iWidth;
            } else {
                dist -= iWidth;
                posLeft -= iWidth;
            }
            fullWidth -= Math.abs(iWidth);
            if (this.settings.center) {
                this._coordinates[i] = !this.settings.rtl ? this._coordinates[i] - (iWidth / 2) : this._coordinates[i] +
                    (iWidth / 2);
            }
        }
        if (this.settings.autoWidth) {
            this.width.stage = this.settings.center ? Math.abs(fullWidth) : Math.abs(dist);
        } else {
            this.width.stage = Math.abs(fullWidth);
        }
        allItems = this.num.oItems + this.num.cItems;
        for (j = 0; j < allItems; j++) {
            this.dom.$items.eq(j).data('owl-item').indexAbs = j;
        }
        this.setSizes();
    };
    Owl.prototype.setSizes = function() {
        if (this.settings.stagePadding !== false) {
            this.dom.oStage.style.paddingLeft = this.settings.stagePadding + 'px';
            this.dom.oStage.style.paddingRight = this.settings.stagePadding + 'px';
        }
        if (this.settings.rtl) {
            window.setTimeout($.proxy(function() {
                this.dom.stage.style.width = this.width.stage + 'px';
            }, this), 0);
        } else {
            this.dom.stage.style.width = this.width.stage + 'px';
        }
        for (var i = 0; i < this.num.items; i++) {
            if (!this.settings.autoWidth) {
                this.dom.$items[i].style.width = this.width.item - (this.settings.margin) + 'px';
            }
            if (this.settings.rtl) {
                this.dom.$items[i].style.marginLeft = this.settings.margin + 'px';
            } else {
                this.dom.$items[i].style.marginRight = this.settings.margin + 'px';
            }
            if (this.num.merged[i] !== 1 && !this.settings.autoWidth) {
                this.dom.$items[i].style.width = (this.width.item * this.num.merged[i]) - (this.settings.margin) + 'px';
            }
        }
        this.width.stagePrev = this.width.stage;
    };
    Owl.prototype.responsive = function() {
        if (!this.num.oItems) {
            return false;
        }
        var elChanged = this.isElWidthChanged();
        if (!elChanged) {
            return false;
        }
        if (this.trigger('resize').isDefaultPrevented()) {
            return false;
        }
        this.state.responsive = true;
        this.refresh();
        this.state.responsive = false;
        this.trigger('resized');
    };
    Owl.prototype.refresh = function() {
        var current = this.dom.$oItems && this.dom.$oItems.eq(this.normalize(this.current(), true));
        this.trigger('refresh');
        this.setResponsiveOptions();
        this.updateLocalContent();
        this.optionsLogic();
        if (this.num.oItems === 0) {
            return false;
        }
        this.dom.$stage.addClass('owl-refresh');
        this.reClone();
        this.calculate();
        this.dom.$stage.removeClass('owl-refresh');
        if (!current) {
            this.dom.oStage.scrollLeft = 0;
            this.reset(this.dom.$oItems.eq(0).data('owl-item').indexAbs);
        } else {
            this.reset(current.data('owl-item').indexAbs);
        }
        this.state.orientation = window.orientation;
        this.watchVisibility();
        this.trigger('refreshed');
    };
    Owl.prototype.updateActiveItems = function() {
        this.trigger('change', {
            property: {
                name: 'items',
                value: this.dom.$items
            }
        });
        var i, j, item, ipos, iwidth, outsideView;
        for (i = 0; i < this.num.items; i++) {
            this.dom.$items.eq(i).data('owl-item').active = false;
            this.dom.$items.eq(i).data('owl-item').current = false;
            this.dom.$items.eq(i).removeClass(this.settings.activeClass).removeClass(this.settings.centerClass);
        }
        this.num.active = 0;
        padding = this.settings.stagePadding * 2;
        stageX = this.coordinates(this.current()) + padding;
        view = this.settings.rtl ? this.width.view : -this.width.view;
        for (j = 0; j < this.num.items; j++) {
            item = this.dom.$items.eq(j);
            ipos = item.data('owl-item').posLeft;
            iwidth = item.data('owl-item').width;
            outsideView = this.settings.rtl ? ipos - iwidth - padding : ipos - iwidth + padding;
            if ((this.op(ipos, '<=', stageX) && (this.op(ipos, '>', stageX + view))) || (this.op(outsideView, '<', stageX) && this.op(outsideView, '>', stageX + view))) {
                this.num.active++;
                item.data('owl-item').active = true;
                item.data('owl-item').current = true;
                item.addClass(this.settings.activeClass);
                if (!this.settings.lazyLoad) {
                    item.data('owl-item').loaded = true;
                }
                if (this.settings.loop) {
                    this.updateClonedItemsState(item.data('owl-item').index);
                }
            }
        }
        if (this.settings.center) {
            this.dom.$items.eq(this.current()).addClass(this.settings.centerClass).data('owl-item').center = true;
        }
        this.trigger('changed', {
            property: {
                name: 'items',
                value: this.dom.$items
            }
        });
    };
    Owl.prototype.updateClonedItemsState = function(activeIndex) {
        var center, $el, i;
        if (this.settings.center) {
            center = this.dom.$items.eq(this.current()).data('owl-item').index;
        }
        for (i = 0; i < this.num.items; i++) {
            $el = this.dom.$items.eq(i);
            if ($el.data('owl-item').index === activeIndex) {
                $el.data('owl-item').current = true;
                if ($el.data('owl-item').index === center) {
                    $el.addClass(this.settings.centerClass);
                }
            }
        }
    };
    Owl.prototype.eventsCall = function() {
        this.e._onDragStart = $.proxy(function(e) {
            this.onDragStart(e);
        }, this);
        this.e._onDragMove = $.proxy(function(e) {
            this.onDragMove(e);
        }, this);
        this.e._onDragEnd = $.proxy(function(e) {
            this.onDragEnd(e);
        }, this);
        this.e._transitionEnd = $.proxy(function(e) {
            this.transitionEnd(e);
        }, this);
        this.e._resizer = $.proxy(function() {
            this.responsiveTimer();
        }, this);
        this.e._responsiveCall = $.proxy(function() {
            this.responsive();
        }, this);
        this.e._preventClick = $.proxy(function(e) {
            this.preventClick(e);
        }, this);
    };
    Owl.prototype.responsiveTimer = function() {
        if (this.viewport() === this.width.prevWindow) {
            return false;
        }
        window.clearTimeout(this.resizeTimer);
        this.resizeTimer = window.setTimeout(this.e._responsiveCall, this.settings.responsiveRefreshRate);
        this.width.prevWindow = this.viewport();
    };
    Owl.prototype.internalEvents = function() {
        var isTouch = isTouchSupport(),
            isTouchIE = isTouchSupportIE();
        if (isTouch && !isTouchIE) {
            this.dragType = ['touchstart', 'touchmove', 'touchend', 'touchcancel'];
        } else if (isTouch && isTouchIE) {
            this.dragType = ['MSPointerDown', 'MSPointerMove', 'MSPointerUp', 'MSPointerCancel'];
        } else {
            this.dragType = ['mousedown', 'mousemove', 'mouseup'];
        }
        if ((isTouch || isTouchIE) && this.settings.touchDrag) {
            this.on(document, this.dragType[3], this.e._onDragEnd);
        } else {
            this.dom.$stage.on('dragstart', function() {
                return false;
            });
            if (this.settings.mouseDrag) {
                this.dom.stage.onselectstart = function() {
                    return false;
                };
            } else {
                this.dom.$el.addClass('owl-text-select-on');
            }
        }
        if (this.transitionEndVendor) {
            this.on(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd, false);
        }
        if (this.settings.responsive !== false) {
            this.on(window, 'resize', this.e._resizer, false);
        }
        this.dragEvents();
    };
    Owl.prototype.dragEvents = function() {
        if (this.settings.touchDrag && (this.dragType[0] === 'touchstart' || this.dragType[0] === 'MSPointerDown')) {
            this.on(this.dom.stage, this.dragType[0], this.e._onDragStart, false);
        } else if (this.settings.mouseDrag && this.dragType[0] === 'mousedown') {
            this.on(this.dom.stage, this.dragType[0], this.e._onDragStart, false);
        } else {
            this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
        }
    };
    Owl.prototype.onDragStart = function(event) {
        var ev, isTouchEvent, pageX, pageY, animatedPos;
        ev = event.originalEvent || event || window.event;
        if (ev.which === 3) {
            return false;
        }
        if (this.dragType[0] === 'mousedown') {
            this.dom.$stage.addClass('owl-grab');
        }
        this.trigger('drag');
        this.drag.startTime = new Date().getTime();
        this.speed(0);
        this.state.isTouch = true;
        this.state.isScrolling = false;
        this.state.isSwiping = false;
        this.drag.distance = 0;
        isTouchEvent = ev.type === 'touchstart';
        pageX = isTouchEvent ? event.targetTouches[0].pageX : (ev.pageX || ev.clientX);
        pageY = isTouchEvent ? event.targetTouches[0].pageY : (ev.pageY || ev.clientY);
        this.drag.offsetX = this.dom.$stage.position().left - this.settings.stagePadding;
        this.drag.offsetY = this.dom.$stage.position().top;
        if (this.settings.rtl) {
            this.drag.offsetX = this.dom.$stage.position().left + this.width.stage - this.width.el +
                this.settings.margin;
        }
        if (this.state.inMotion && this.support3d) {
            animatedPos = this.getTransformProperty();
            this.drag.offsetX = animatedPos;
            this.animate(animatedPos);
            this.state.inMotion = true;
        } else if (this.state.inMotion && !this.support3d) {
            this.state.inMotion = false;
            return false;
        }
        this.drag.startX = pageX - this.drag.offsetX;
        this.drag.startY = pageY - this.drag.offsetY;
        this.drag.start = pageX - this.drag.startX;
        this.drag.targetEl = ev.target || ev.srcElement;
        this.drag.updatedX = this.drag.start;
        if (this.drag.targetEl.tagName === "IMG" || this.drag.targetEl.tagName === "A") {
            this.drag.targetEl.draggable = false;
        }
        this.on(document, this.dragType[1], this.e._onDragMove, false);
        this.on(document, this.dragType[2], this.e._onDragEnd, false);
    };
    Owl.prototype.onDragMove = function(event) {
        var ev, isTouchEvent, pageX, pageY, minValue, maxValue, pull;
        if (!this.state.isTouch) {
            return;
        }
        if (this.state.isScrolling) {
            return;
        }
        ev = event.originalEvent || event || window.event;
        isTouchEvent = ev.type == 'touchmove';
        pageX = isTouchEvent ? ev.targetTouches[0].pageX : (ev.pageX || ev.clientX);
        pageY = isTouchEvent ? ev.targetTouches[0].pageY : (ev.pageY || ev.clientY);
        this.drag.currentX = pageX - this.drag.startX;
        this.drag.currentY = pageY - this.drag.startY;
        this.drag.distance = this.drag.currentX - this.drag.offsetX;
        if (this.drag.distance < 0) {
            this.state.direction = this.settings.rtl ? 'right' : 'left';
        } else if (this.drag.distance > 0) {
            this.state.direction = this.settings.rtl ? 'left' : 'right';
        }
        if (this.settings.loop) {
            if (this.op(this.drag.currentX, '>', this.coordinates(this.minimum())) && this.state.direction === 'right') {
                this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this.num.oItems);
            } else if (this.op(this.drag.currentX, '<', this.coordinates(this.maximum())) && this.state.direction === 'left') {
                this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this.num.oItems);
            }
        } else {
            minValue = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
            maxValue = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
            pull = this.settings.pullDrag ? this.drag.distance / 5 : 0;
            this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
        }
        if ((this.drag.distance > 8 || this.drag.distance < -8)) {
            if (ev.preventDefault !== undefined) {
                ev.preventDefault();
            } else {
                ev.returnValue = false;
            }
            this.state.isSwiping = true;
        }
        this.drag.updatedX = this.drag.currentX;
        if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
            this.state.isScrolling = true;
            this.drag.updatedX = this.drag.start;
        }
        this.animate(this.drag.updatedX);
    };
    Owl.prototype.onDragEnd = function() {
        var compareTimes, distanceAbs, closest;
        if (!this.state.isTouch) {
            return;
        }
        if (this.dragType[0] === 'mousedown') {
            this.dom.$stage.removeClass('owl-grab');
        }
        this.trigger('dragged');
        this.drag.targetEl.removeAttribute("draggable");
        this.state.isTouch = false;
        this.state.isScrolling = false;
        this.state.isSwiping = false;
        if (this.drag.distance === 0 && this.state.inMotion !== true) {
            this.state.inMotion = false;
            return false;
        }
        this.drag.endTime = new Date().getTime();
        compareTimes = this.drag.endTime - this.drag.startTime;
        distanceAbs = Math.abs(this.drag.distance);
        if (distanceAbs > 3 || compareTimes > 300) {
            this.removeClick(this.drag.targetEl);
        }
        closest = this.closest(this.drag.updatedX);
        this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
        this.current(closest);
        if (!this.settings.pullDrag && this.drag.updatedX === this.coordinates(closest)) {
            this.transitionEnd();
        }
        this.drag.distance = 0;
        this.off(document, this.dragType[1], this.e._onDragMove);
        this.off(document, this.dragType[2], this.e._onDragEnd);
    };
    Owl.prototype.removeClick = function(target) {
        this.drag.targetEl = target;
        $(target).on('click.preventClick', this.e._preventClick);
        window.setTimeout(function() {
            $(target).off('click.preventClick');
        }, 300);
    };
    Owl.prototype.preventClick = function(ev) {
        if (ev.preventDefault) {
            ev.preventDefault();
        } else {
            ev.returnValue = false;
        }
        if (ev.stopPropagation) {
            ev.stopPropagation();
        }
        $(ev.target).off('click.preventClick');
    };
    Owl.prototype.getTransformProperty = function() {
        var transform, matrix3d;
        transform = window.getComputedStyle(this.dom.stage, null).getPropertyValue(this.vendorName + 'transform');
        transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
        matrix3d = transform.length === 16;
        return matrix3d !== true ? transform[4] : transform[12];
    };
    Owl.prototype.closest = function(coordinate) {
        var position = 0,
            pull = 30;
        if (!this.settings.freeDrag) {
            $.each(this.coordinates(), $.proxy(function(index, value) {
                if (coordinate > value - pull && coordinate < value + pull) {
                    position = index;
                } else if (this.op(coordinate, '<', value) && this.op(coordinate, '>', this.coordinates(index + 1) || value - this.width.el)) {
                    position = this.state.direction === 'left' ? index + 1 : index;
                }
            }, this));
        }
        if (!this.settings.loop) {
            if (this.op(coordinate, '>', this.coordinates(this.minimum()))) {
                position = coordinate = this.minimum();
            } else if (this.op(coordinate, '<', this.coordinates(this.maximum()))) {
                position = coordinate = this.maximum();
            }
        }
        return position;
    };
    Owl.prototype.animate = function(coordinate) {
        this.trigger('translate');
        this.state.inMotion = this.speed() > 0;
        if (this.support3d) {
            this.dom.$stage.css({
                transform: 'translate3d(' + coordinate + 'px' + ',0px, 0px)',
                'transform-style': 'preserve-3d',
                transition: (this.speed() / 1000) + 's'
            });
        } else if (this.state.isTouch) {
            this.dom.$stage.css({
                left: coordinate + 'px'
            });
        } else {
            this.dom.$stage.animate({
                left: coordinate
            }, this.speed() / 1000, this.settings.fallbackEasing, $.proxy(function() {
                if (this.state.inMotion) {
                    this.transitionEnd();
                }
            }, this));
        }
    };
    Owl.prototype.current = function(position) {
        if (position === undefined) {
            return this._current;
        }
        if (this.num.oItems === 0) {
            return undefined;
        }
        position = this.normalize(position);
        if (this._current === position) {
            this.animate(this.coordinates(this._current));
        } else {
            var event = this.trigger('change', {
                property: {
                    name: 'position',
                    value: position
                }
            });
            if (event.data !== undefined) {
                position = this.normalize(event.data);
            }
            this._current = position;
            this.animate(this.coordinates(this._current));
            this.updateActiveItems();
            this.trigger('changed', {
                property: {
                    name: 'position',
                    value: this._current
                }
            });
        }
        return this._current;
    };
    Owl.prototype.reset = function(position) {
        this.suppress(['change', 'changed']);
        this.speed(0);
        this.current(position);
        this.release(['change', 'changed']);
    };
    Owl.prototype.normalize = function(position, relative) {
        if (position === undefined || !this.dom.$items) {
            return undefined;
        }
        if (this.settings.loop) {
            var n = this.dom.$items.length;
            position = ((position % n) + n) % n;
        } else {
            position = Math.max(this.minimum(), Math.min(this.maximum(), position));
        }
        return relative ? this.dom.$items.eq(position).data('owl-item').index : position;
    };
    Owl.prototype.maximum = function() {
        var maximum, width, settings = this.settings;
        if (!settings.loop && settings.center) {
            maximum = this.num.oItems - 1;
        } else if (!settings.loop && !settings.center) {
            maximum = this.num.oItems - settings.items;
        } else if (settings.loop || settings.center) {
            maximum = this.num.oItems + settings.items;
        } else if (settings.autoWidth || settings.merge) {
            revert = settings.rtl ? 1 : -1;
            width = this.dom.$stage.width() - this.$el.width();
            $.each(this.coordinates(), function(index, coordinate) {
                if (coordinate * revert >= width) {
                    return false;
                }
                maximum = index + 1;
            });
        } else {
            throw 'Can not detect maximum absolute position.'
        }
        return maximum;
    };
    Owl.prototype.minimum = function() {
        return this.dom.$oItems.eq(0).data('owl-item').indexAbs;
    };
    Owl.prototype.speed = function(speed) {
        if (speed !== undefined) {
            this._speed = speed;
        }
        return this._speed;
    };
    Owl.prototype.coordinates = function(position) {
        return position !== undefined ? this._coordinates[position] : this._coordinates;
    };
    Owl.prototype.duration = function(from, to, factor) {
        return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
    };
    Owl.prototype.to = function(position, speed) {
        if (this.settings.loop) {
            var distance = position - this.normalize(this.current(), true),
                revert = this.current(),
                before = this.current(),
                after = this.current() + distance,
                direction = before - after < 0 ? true : false;
            if (after < this.settings.items && direction === false) {
                revert = this.num.items - (this.settings.items - before) - this.settings.items;
                this.reset(revert);
            } else if (after >= this.num.items - this.settings.items && direction === true) {
                revert = before - this.num.oItems;
                this.reset(revert);
            }
            window.clearTimeout(this.e._goToLoop);
            this.e._goToLoop = window.setTimeout($.proxy(function() {
                this.speed(this.duration(this.current(), revert + distance, speed));
                this.current(revert + distance);
            }, this), 30);
        } else {
            this.speed(this.duration(this.current(), position, speed));
            this.current(position);
        }
    };
    Owl.prototype.next = function(speed) {
        speed = speed || false;
        this.to(this.normalize(this.current(), true) + 1, speed);
    };
    Owl.prototype.prev = function(speed) {
        speed = speed || false;
        this.to(this.normalize(this.current(), true) - 1, speed);
    };
    Owl.prototype.transitionEnd = function(event) {
        if (event !== undefined) {
            event.stopPropagation();
            var eventTarget = event.target || event.srcElement || event.originalTarget;
            if (eventTarget !== this.dom.stage) {
                return false;
            }
        }
        this.state.inMotion = false;
        this.trigger('translated');
    };
    Owl.prototype.isElWidthChanged = function() {
        var newElWidth = this.dom.$el.width() - this.settings.stagePadding,
            prevElWidth = this.width.el + this.settings.margin;
        return newElWidth !== prevElWidth;
    };
    Owl.prototype.viewport = function() {
        var width;
        if (this.options.responsiveBaseElement !== window) {
            width = $(this.options.responsiveBaseElement).width();
        } else if (window.innerWidth) {
            width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
        } else {
            throw 'Can not detect viewport width.';
        }
        return width;
    };
    Owl.prototype.insertContent = function(content) {
        this.dom.$stage.empty();
        this.fetchContent(content);
        this.refresh();
    };
    Owl.prototype.addItem = function(content, position) {
        var $item = this.createItemContainer();
        position = position || 0;
        this.initializeItemContainer($item, content);
        if (this.dom.$oItems.length === 0) {
            this.dom.$stage.append($item);
        } else {
            if (pos !== -1) {
                this.dom.$oItems.eq(position).before($item);
            } else {
                this.dom.$oItems.eq(position).after($item);
            }
        }
        this.refresh();
    };
    Owl.prototype.removeItem = function(pos) {
        this.dom.$oItems.eq(pos).remove();
        this.refresh();
    };
    Owl.prototype.addTriggerableEvents = function() {
        var handler = $.proxy(function(callback, event) {
            return $.proxy(function(e) {
                if (e.relatedTarget !== this) {
                    this.suppress([event]);
                    callback.apply(this, [].slice.call(arguments, 1));
                    this.release([event]);
                }
            }, this);
        }, this);
        $.each({
            'next': this.next,
            'prev': this.prev,
            'to': this.to,
            'destroy': this.destroy,
            'refresh': this.refresh,
            'replace': this.insertContent,
            'add': this.addItem,
            'remove': this.removeItem
        }, $.proxy(function(event, callback) {
            this.dom.$el.on(event + '.owl.carousel', handler(callback, event + '.owl.carousel'));
        }, this));
    };
    Owl.prototype.watchVisibility = function() {
        if (!isElVisible(this.dom.el)) {
            this.dom.$el.addClass('owl-hidden');
            window.clearInterval(this.e._checkVisibile);
            this.e._checkVisibile = window.setInterval($.proxy(checkVisible, this), 500);
        }

        function isElVisible(el) {
            return el.offsetWidth > 0 && el.offsetHeight > 0;
        }

        function checkVisible() {
            if (isElVisible(this.dom.el)) {
                this.dom.$el.removeClass('owl-hidden');
                this.refresh();
                window.clearInterval(this.e._checkVisibile);
            }
        }
    };
    Owl.prototype.preloadAutoWidthImages = function(imgs) {
        var loaded, that, $el, img;
        loaded = 0;
        that = this;
        imgs.each(function(i, el) {
            $el = $(el);
            img = new Image();
            img.onload = function() {
                loaded++;
                $el.attr('src', img.src);
                $el.css('opacity', 1);
                if (loaded >= imgs.length) {
                    that.state.imagesLoaded = true;
                    that.init();
                }
            };
            img.src = $el.attr('src') || $el.attr('data-src') || $el.attr('data-src-retina');
        });
    };
    Owl.prototype.destroy = function() {
        if (this.dom.$el.hasClass(this.settings.themeClass)) {
            this.dom.$el.removeClass(this.settings.themeClass);
        }
        if (this.settings.responsive !== false) {
            this.off(window, 'resize', this.e._resizer);
        }
        if (this.transitionEndVendor) {
            this.off(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd);
        }
        for (var i in this.plugins) {
            this.plugins[i].destroy();
        }
        if (this.settings.mouseDrag || this.settings.touchDrag) {
            this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
            if (this.settings.mouseDrag) {
                this.off(document, this.dragType[3], this.e._onDragStart);
            }
            if (this.settings.mouseDrag) {
                this.dom.$stage.off('dragstart', function() {
                    return false;
                });
                this.dom.stage.onselectstart = function() {};
            }
        }
        this.dom.$el.off('.owl');
        if (this.dom.$cItems !== null) {
            this.dom.$cItems.remove();
        }
        this.e = null;
        this.dom.$el.data('owlCarousel', null);
        delete this.dom.el.owlCarousel;
        this.dom.$stage.unwrap();
        this.dom.$items.unwrap();
        this.dom.$items.contents().unwrap();
        this.dom = null;
    };
    Owl.prototype.op = function(a, o, b) {
        var rtl = this.settings.rtl;
        switch (o) {
            case '<':
                return rtl ? a > b : a < b;
            case '>':
                return rtl ? a < b : a > b;
            case '>=':
                return rtl ? a <= b : a >= b;
            case '<=':
                return rtl ? a >= b : a <= b;
            default:
                break;
        }
    };
    Owl.prototype.on = function(element, event, listener, capture) {
        if (element.addEventListener) {
            element.addEventListener(event, listener, capture);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, listener);
        }
    };
    Owl.prototype.off = function(element, event, listener, capture) {
        if (element.removeEventListener) {
            element.removeEventListener(event, listener, capture);
        } else if (element.detachEvent) {
            element.detachEvent('on' + event, listener);
        }
    };
    Owl.prototype.trigger = function(name, data, namespace) {
        var status = {
                item: {
                    count: this.num.oItems,
                    index: this.current()
                }
            },
            handler = $.camelCase($.grep(['on', name, namespace], function(v) {
                return v
            }).join('-').toLowerCase()),
            event = $.Event([name, 'owl', namespace || 'carousel'].join('.').toLowerCase(), $.extend({
                relatedTarget: this
            }, status, data));
        if (!this._supress[event.type]) {
            $.each(this.plugins, function(name, plugin) {
                if (plugin.onTrigger) {
                    plugin.onTrigger(event);
                }
            });
            this.dom.$el.trigger(event);
            if (typeof this.settings[handler] === 'function') {
                this.settings[handler].apply(this, event);
            }
        }
        return event;
    };
    Owl.prototype.suppress = function(events) {
        $.each(events, $.proxy(function(index, event) {
            this._supress[event] = true;
        }, this));
    }
    Owl.prototype.release = function(events) {
        $.each(events, $.proxy(function(index, event) {
            delete this._supress[event];
        }, this));
    }
    Owl.prototype.browserSupport = function() {
        this.support3d = isPerspective();
        if (this.support3d) {
            this.transformVendor = isTransform();
            var endVendors = ['transitionend', 'webkitTransitionEnd', 'transitionend', 'oTransitionEnd'];
            this.transitionEndVendor = endVendors[isTransition()];
            this.vendorName = this.transformVendor.replace(/Transform/i, '');
            this.vendorName = this.vendorName !== '' ? '-' + this.vendorName.toLowerCase() + '-' : '';
        }
        this.state.orientation = window.orientation;
    };

    function isStyleSupported(array) {
        var p, s, fake = document.createElement('div'),
            list = array;
        for (p in list) {
            s = list[p];
            if (typeof fake.style[s] !== 'undefined') {
                fake = null;
                return [s, p];
            }
        }
        return [false];
    }

    function isTransition() {
        return isStyleSupported(['transition', 'WebkitTransition', 'MozTransition', 'OTransition'])[1];
    }

    function isTransform() {
        return isStyleSupported(['transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform'])[0];
    }

    function isPerspective() {
        return isStyleSupported(['perspective', 'webkitPerspective', 'MozPerspective', 'OPerspective', 'MsPerspective'])[0];
    }

    function isTouchSupport() {
        return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
    }

    function isTouchSupportIE() {
        return window.navigator.msPointerEnabled;
    }
    $.fn.owlCarousel = function(options) {
        return this.each(function() {
            if (!$(this).data('owlCarousel')) {
                $(this).data('owlCarousel', new Owl(this, options));
            }
        });
    };
    $.fn.owlCarousel.Constructor = Owl;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    LazyLoad = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, LazyLoad.Defaults, this.owl.options);
        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'items' && e.property.value && !e.property.value.is(':empty')) {
                    this.check();
                }
            }, this)
        };
        this.owl.dom.$el.on(this.handlers);
    };
    LazyLoad.Defaults = {
        lazyLoad: false
    };
    LazyLoad.prototype.check = function() {
        var attr = window.devicePixelRatio > 1 ? 'data-src-retina' : 'data-src',
            src, img, i, $item;
        for (i = 0; i < this.owl.num.items; i++) {
            $item = this.owl.dom.$items.eq(i);
            if ($item.data('owl-item').current === true && $item.data('owl-item').loaded === false) {
                img = $item.find('.owl-lazy');
                src = img.attr(attr);
                src = src || img.attr('data-src');
                if (src) {
                    img.css('opacity', '0');
                    this.preload(img, $item);
                }
            }
        }
    };
    LazyLoad.prototype.preload = function(images, $item) {
        var $el, img, srcType;
        images.each($.proxy(function(i, el) {
            this.owl.trigger('load', null, 'lazy');
            $el = $(el);
            img = new Image();
            srcType = window.devicePixelRatio > 1 ? $el.attr('data-src-retina') : $el.attr('data-src');
            srcType = srcType || $el.attr('data-src');
            img.onload = $.proxy(function() {
                $item.data('owl-item').loaded = true;
                if ($el.is('img')) {
                    $el.attr('src', img.src);
                } else {
                    $el.css('background-image', 'url(' + img.src + ')');
                }
                $el.css('opacity', 1);
                this.owl.trigger('loaded', null, 'lazy');
            }, this);
            img.src = srcType;
        }, this));
    };
    LazyLoad.prototype.destroy = function() {
        var handler, property;
        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };
    $.fn.owlCarousel.Constructor.Plugins.lazyLoad = LazyLoad;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    AutoHeight = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, AutoHeight.Defaults, this.owl.options);
        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && this.owl.settings.autoHeight) {
                    this.setHeight();
                }
            }, this)
        };
        this.owl.dom.$el.on(this.handlers);
    };
    AutoHeight.Defaults = {
        autoHeight: false,
        autoHeightClass: 'owl-height'
    };
    AutoHeight.prototype.setHeight = function() {
        var loaded = this.owl.dom.$items.eq(this.owl.current()),
            stage = this.owl.dom.$oStage,
            iterations = 0,
            isLoaded;
        if (!this.owl.dom.$oStage.hasClass(this.owl.settings.autoHeightClass)) {
            this.owl.dom.$oStage.addClass(this.owl.settings.autoHeightClass);
        }
        isLoaded = window.setInterval(function() {
            iterations += 1;
            if (loaded.data('owl-item').loaded) {
                stage.height(loaded.height() + 'px');
                clearInterval(isLoaded);
            } else if (iterations === 500) {
                clearInterval(isLoaded);
            }
        }, 100);
    };
    AutoHeight.prototype.destroy = function() {
        var handler, property;
        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };
    $.fn.owlCarousel.Constructor.Plugins.autoHeight = AutoHeight;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    Video = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, Video.Defaults, this.owl.options);
        this.handlers = {
            'resize.owl.carousel': $.proxy(function(e) {
                if (this.owl.settings.video && !this.isInFullScreen()) {
                    e.preventDefault();
                }
            }, this),
            'refresh.owl.carousel changed.owl.carousel': $.proxy(function(e) {
                if (this.owl.state.videoPlay) {
                    this.stopVideo();
                }
            }, this),
            'refresh.owl.carousel refreshed.owl.carousel': $.proxy(function(e) {
                if (!this.owl.settings.video) {
                    return false;
                }
                this.refreshing = e.type == 'refresh';
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (this.refreshing && e.property.name == 'items' && e.property.value && !e.property.value.is(':empty')) {
                    this.checkVideoLinks();
                }
            }, this)
        };
        this.owl.dom.$el.on(this.handlers);
        this.owl.dom.$el.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
            this.playVideo(e);
        }, this));
    };
    Video.Defaults = {
        video: false,
        videoHeight: false,
        videoWidth: false
    };
    Video.prototype.checkVideoLinks = function() {
        var videoEl, item, i;
        for (i = 0; i < this.owl.num.items; i++) {
            item = this.owl.dom.$items.eq(i);
            if (item.data('owl-item').hasVideo) {
                continue;
            }
            videoEl = item.find('.owl-video');
            if (videoEl.length) {
                this.owl.state.hasVideos = true;
                this.owl.dom.$items.eq(i).data('owl-item').hasVideo = true;
                videoEl.css('display', 'none');
                this.getVideoInfo(videoEl, item);
            }
        }
    };
    Video.prototype.getVideoInfo = function(videoEl, item) {
        var info, type, id, dimensions, vimeoId = videoEl.data('vimeo-id'),
            youTubeId = videoEl.data('youtube-id'),
            width = videoEl.data('width') || this.owl.settings.videoWidth,
            height = videoEl.data('height') || this.owl.settings.videoHeight,
            url = videoEl.attr('href');
        if (vimeoId) {
            type = 'vimeo';
            id = vimeoId;
        } else if (youTubeId) {
            type = 'youtube';
            id = youTubeId;
        } else if (url) {
            id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
            if (id[3].indexOf('youtu') > -1) {
                type = 'youtube';
            } else if (id[3].indexOf('vimeo') > -1) {
                type = 'vimeo';
            }
            id = id[6];
        } else {
            throw new Error('Missing video link.');
        }
        item.data('owl-item').videoType = type;
        item.data('owl-item').videoId = id;
        item.data('owl-item').videoWidth = width;
        item.data('owl-item').videoHeight = height;
        info = {
            type: type,
            id: id
        };
        dimensions = width && height ? 'style="width:' + width + 'px;height:' + height + 'px;"' : '';
        videoEl.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');
        this.createVideoTn(videoEl, info);
    };
    Video.prototype.createVideoTn = function(videoEl, info) {
        var tnLink, icon, path, customTn = videoEl.find('img'),
            srcType = 'src',
            lazyClass = '',
            that = this.owl;
        if (this.owl.settings.lazyLoad) {
            srcType = 'data-src';
            lazyClass = 'owl-lazy';
        }
        if (customTn.length) {
            addThumbnail(customTn.attr(srcType));
            customTn.remove();
            return false;
        }

        function addThumbnail(tnPath) {
            icon = '<div class="owl-video-play-icon"></div>';
            if (that.settings.lazyLoad) {
                tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + tnPath + '"></div>';
            } else {
                tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + tnPath + ')"></div>';
            }
            videoEl.after(tnLink);
            videoEl.after(icon);
        }
        if (info.type === 'youtube') {
            path = "http://img.youtube.com/vi/" + info.id + "/hqdefault.jpg";
            addThumbnail(path);
        } else if (info.type === 'vimeo') {
            $.ajax({
                type: 'GET',
                url: 'http://vimeo.com/api/v2/video/' + info.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    path = data[0].thumbnail_large;
                    addThumbnail(path);
                    if (that.settings.loop) {
                        that.updateActiveItems();
                    }
                }
            });
        }
    };
    Video.prototype.stopVideo = function() {
        this.owl.trigger('stop', null, 'video');
        var item = this.owl.dom.$items.eq(this.owl.state.videoPlayIndex);
        item.find('.owl-video-frame').remove();
        item.removeClass('owl-video-playing');
        this.owl.state.videoPlay = false;
    };
    Video.prototype.playVideo = function(ev) {
        this.owl.trigger('play', null, 'video');
        if (this.owl.state.videoPlay) {
            this.stopVideo();
        }
        var videoLink, videoWrap, videoType, target = $(ev.target || ev.srcElement),
            item = target.closest('.' + this.owl.settings.itemClass);
        videoType = item.data('owl-item').videoType, id = item.data('owl-item').videoId, width = item.data('owl-item').videoWidth || Math.floor(item.data('owl-item').width - this.owl.settings.margin), height = item.data('owl-item').videoHeight || this.owl.dom.$stage.height();
        if (videoType === 'youtube') {
            videoLink = "<iframe width=\"" + width + "\" height=\"" + height + "\" src=\"http://www.youtube.com/embed/" +
                id + "?autoplay=1&v=" + id + "\" frameborder=\"0\" allowfullscreen></iframe>";
        } else if (videoType === 'vimeo') {
            videoLink = '<iframe src="http://player.vimeo.com/video/' + id + '?autoplay=1" width="' + width +
                '" height="' + height +
                '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }
        item.addClass('owl-video-playing');
        this.owl.state.videoPlay = true;
        this.owl.state.videoPlayIndex = item.data('owl-item').indexAbs;
        videoWrap = $('<div style="height:' + height + 'px; width:' + width + 'px" class="owl-video-frame">' +
            videoLink + '</div>');
        target.after(videoWrap);
    };
    Video.prototype.isInFullScreen = function() {
        var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
        if (fullscreenElement) {
            if ($(fullscreenElement.parentNode).hasClass('owl-video-frame')) {
                this.owl.speed(0);
                this.owl.state.isFullScreen = true;
            }
        }
        if (fullscreenElement && this.owl.state.isFullScreen && this.owl.state.videoPlay) {
            return false;
        }
        if (this.owl.state.isFullScreen) {
            this.owl.state.isFullScreen = false;
            return false;
        }
        if (this.owl.state.videoPlay) {
            if (this.owl.state.orientation !== window.orientation) {
                this.owl.state.orientation = window.orientation;
                return false;
            }
        }
        return true;
    };
    Video.prototype.destroy = function() {
        var handler, property;
        this.owl.dom.$el.off('click.owl.video');
        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };
    $.fn.owlCarousel.Constructor.Plugins.video = Video;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    Animate = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Animate.Defaults, this.core.options);
        this.swapping = true;
        this.previous = undefined;
        this.next = undefined;
        this.handlers = {
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position') {
                    this.previous = this.core.current();
                    this.next = e.property.value;
                }
            }, this),
            'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
                this.swapping = e.type == 'translated';
            }, this),
            'translate.owl.carousel': $.proxy(function(e) {
                if (this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
                    this.swap();
                }
            }, this)
        };
        this.core.dom.$el.on(this.handlers);
    };
    Animate.Defaults = {
        animateOut: false,
        animateIn: false
    };
    Animate.prototype.swap = function() {
        if (this.core.settings.items !== 1 || !this.core.support3d) {
            return;
        }
        this.core.speed(0);
        var left, clear = $.proxy(this.clear, this),
            previous = this.core.dom.$items.eq(this.previous),
            next = this.core.dom.$items.eq(this.next),
            incoming = this.core.settings.animateIn,
            outgoing = this.core.settings.animateOut;
        if (this.core.current() === this.previous) {
            return;
        }
        if (outgoing) {
            left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
            previous.css({
                'left': left + 'px'
            }).addClass('animated owl-animated-out').addClass(outgoing).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }
        if (incoming) {
            next.addClass('animated owl-animated-in').addClass(incoming).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }
    };
    Animate.prototype.clear = function(e) {
        $(e.target).css({
            'left': ''
        }).removeClass('animated owl-animated-out owl-animated-in').removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut);
        this.core.transitionEnd();
    }
    Animate.prototype.destroy = function() {
        var handler, property;
        for (handler in this.handlers) {
            this.core.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };
    $.fn.owlCarousel.Constructor.Plugins.Animate = Animate;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    Autoplay = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Autoplay.Defaults, this.core.options);
        this.handlers = {
            'translated.owl.carousel refreshed.owl.carousel': $.proxy(function() {
                this.autoplay();
            }, this),
            'play.owl.autoplay': $.proxy(function(e, t, s) {
                this.play(t, s);
            }, this),
            'stop.owl.autoplay': $.proxy(function() {
                this.stop();
            }, this),
            'mouseover.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.pause();
                }
            }, this),
            'mouseleave.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.autoplay();
                }
            }, this)
        };
        this.core.dom.$el.on(this.handlers);
    };
    Autoplay.Defaults = {
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoplaySpeed: false
    };
    Autoplay.prototype.autoplay = function() {
        this.core.settings.autoplayTimeout = 3000;
        if (this.core.settings.autoplay && !this.core.state.videoPlay) {
            window.clearInterval(this.interval);
            this.interval = window.setInterval($.proxy(function() {
                this.play();
            }, this), this.core.settings.autoplayTimeout);
        } else {
            window.clearInterval(this.interval);
        }
    };
    Autoplay.prototype.play = function(timeout, speed) {
        if (document.hidden === true) {
            return;
        }
        if (this.core.state.isTouch || this.core.state.isScrolling || this.core.state.isSwiping || this.core.state.inMotion) {
            return;
        }
        if (this.core.settings.autoplay === false) {
            window.clearInterval(this.interval);
            return;
        }
        this.core.next(this.core.settings.autoplaySpeed);
    };
    Autoplay.prototype.stop = function() {
        window.clearInterval(this.interval);
    };
    Autoplay.prototype.pause = function() {
        window.clearInterval(this.interval);
    };
    Autoplay.prototype.destroy = function() {
        var handler, property;
        window.clearInterval(this.interval);
        for (handler in this.handlers) {
            this.core.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };
    $.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    'use strict';
    var Navigation = function(carousel) {
        this.core = carousel;
        this.initialized = false;
        this.pages = [];
        this.controls = {};
        this.template = null;
        this.$element = this.core.dom.$el;
        this.overrides = {
            next: this.core.next,
            prev: this.core.prev,
            to: this.core.to
        };
        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'items') {
                    if (!this.initialized) {
                        this.initialize();
                        this.initialized = true;
                    }
                    this.update();
                    this.draw();
                }
                if (this.filling) {
                    e.property.value.data('owl-item').dot = $(':first-child', e.property.value).find('[data-dot]').andSelf().data('dot');
                }
            }, this),
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && !this.core.state.revert && !this.core.settings.loop && this.core.settings.navRewind) {
                    var current = this.core.current(),
                        maximum = this.core.maximum(),
                        minimum = this.core.minimum();
                    e.data = e.property.value > maximum ? current >= maximum ? minimum : maximum : e.property.value < minimum ? maximum : e.property.value;
                }
                this.filling = this.core.settings.dotsData && e.property.name == 'item' && e.property.value && e.property.value.is(':empty');
            }, this),
            'refreshed.owl.carousel': $.proxy(function() {
                if (this.initialized) {
                    this.update();
                    this.draw();
                }
            }, this)
        };
        this.core.options = $.extend({}, Navigation.Defaults, this.core.options);
        this.$element.on(this.handlers);
    }
    Navigation.Defaults = {
        nav: false,
        navRewind: true,
        navText: ['prev', 'next'],
        navSpeed: false,
        navElement: 'div',
        navContainer: false,
        navContainerClass: 'owl-nav',
        navClass: ['owl-prev', 'owl-next'],
        slideBy: 1,
        dotClass: 'owl-dot',
        dotsClass: 'owl-dots',
        dots: true,
        dotsEach: false,
        dotData: false,
        dotsSpeed: false,
        dotsContainer: false,
        controlsClass: 'owl-controls'
    }
    Navigation.prototype.initialize = function() {
        var $container, override, options = this.core.settings;
        if (!options.dotsData) {
            this.template = $('<div>').addClass(options.dotClass).append($('<span>')).prop('outerHTML');
        }
        if (!options.navContainer || !options.dotsContainer) {
            this.controls.$container = $('<div>').addClass(options.controlsClass).appendTo(this.$element);
        }
        this.controls.$indicators = options.dotsContainer ? $(options.dotsContainer) : $('<div>').hide().addClass(options.dotsClass).appendTo(this.controls.$container);
        this.controls.$indicators.on(this.core.dragType[2], 'div', $.proxy(function(e) {
            var index = $(e.target).parent().is(this.controls.$indicators) ? $(e.target).index() : $(e.target).parent().index();
            e.preventDefault();
            this.to(index, options.dotsSpeed);
        }, this));
        $container = options.navContainer ? $(options.navContainer) : $('<div>').addClass(options.navContainerClass).prependTo(this.controls.$container);
        this.controls.$next = $('<' + options.navElement + '>');
        this.controls.$previous = this.controls.$next.clone();
        this.controls.$previous.addClass(options.navClass[0]).html(options.navText[0]).hide().prependTo($container).on(this.core.dragType[2], $.proxy(function(e) {
            this.prev();
        }, this));
        this.controls.$next.addClass(options.navClass[1]).html(options.navText[1]).hide().appendTo($container).on(this.core.dragType[2], $.proxy(function(e) {
            this.next();
        }, this));
        for (override in this.overrides) {
            this.core[override] = $.proxy(this[override], this);
        }
    }
    Navigation.prototype.destroy = function() {
        var handler, control, property, override;
        for (handler in this.handlers) {
            this.$element.off(handler, this.handlers[handler]);
        }
        for (control in this.controls) {
            this.controls[control].remove();
        }
        for (override in this.overides) {
            this.core[override] = this.overrides[override];
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }
    Navigation.prototype.update = function() {
        var i, j, k, options = this.core.settings,
            lower = this.core.num.cItems / 2,
            upper = this.core.num.items - lower,
            size = options.center || options.autoWidth || options.dotData ? 1 : options.dotsEach || options.items;
        if (options.slideBy !== 'page') {
            options.slideBy = Math.min(options.slideBy, options.items);
        }
        if (options.dots) {
            this.pages = [];
            for (i = lower, j = 0, k = 0; i < upper; i++) {
                if (j >= size || j === 0) {
                    this.pages.push({
                        start: i - lower,
                        end: i - lower + size - 1
                    });
                    j = 0, ++k;
                }
                j += this.core.num.merged[i];
            }
        }
    }
    Navigation.prototype.draw = function() {
        var difference, i, html = '',
            options = this.core.settings,
            $items = this.core.dom.$oItems,
            index = this.core.normalize(this.core.current(), true);
        if (options.nav && !options.loop && !options.navRewind) {
            this.controls.$previous.toggleClass('disabled', index <= 0);
            this.controls.$next.toggleClass('disabled', index >= this.core.maximum());
        }
        this.controls.$previous.toggle(options.nav);
        this.controls.$next.toggle(options.nav);
        if (options.dots) {
            difference = this.pages.length - this.controls.$indicators.children().length;
            if (difference > 0) {
                for (i = 0; i < Math.abs(difference); i++) {
                    html += options.dotData ? $items.eq(i).data('owl-item').dot : this.template;
                }
                this.controls.$indicators.append(html);
            } else if (difference < 0) {
                this.controls.$indicators.children().slice(difference).remove();
            }
            this.controls.$indicators.find('.active').removeClass('active');
            this.controls.$indicators.children().eq($.inArray(this.current(), this.pages)).addClass('active');
        }
        this.controls.$indicators.toggle(options.dots);
    }
    Navigation.prototype.onTrigger = function(event) {
        var options = this.core.settings;
        event.page = {
            index: $.inArray(this.current(), this.pages),
            count: this.pages.length,
            size: options.center || options.autoWidth || options.dotData ? 1 : options.dotsEach || options.items
        };
    }
    Navigation.prototype.current = function() {
        var index = this.core.normalize(this.core.current(), true);
        return $.grep(this.pages, function(o) {
            return o.start <= index && o.end >= index;
        }).pop();
    }
    Navigation.prototype.getPosition = function(successor) {
        var position, length, options = this.core.settings;
        if (options.slideBy == 'page') {
            position = $.inArray(this.current(), this.pages);
            length = this.pages.length;
            successor ? ++position : --position;
            position = this.pages[((position % length) + length) % length].start;
        } else {
            position = this.core.normalize(this.core.current(), true);
            length = this.core.num.oItems;
            successor ? position += options.slideBy : position -= options.slideBy;
        }
        return position;
    }
    Navigation.prototype.next = function(speed) {
        $.proxy(this.overrides.to, this.core)(this.getPosition(true), speed);
    }
    Navigation.prototype.prev = function(speed) {
        $.proxy(this.overrides.to, this.core)(this.getPosition(false), speed);
    }
    Navigation.prototype.to = function(position, speed, standard) {
        var length;
        if (!standard) {
            length = this.pages.length;
            $.proxy(this.overrides.to, this.core)(this.pages[((position % length) + length) % length].start, speed);
        } else {
            $.proxy(this.overrides.to, this.core)(position, speed);
        }
    }
    $.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;
})(window.Zepto || window.jQuery, window, document);;
(function($, window, document, undefined) {
    'use strict';
    var Hash = function(carousel) {
        this.core = carousel;
        this.hashes = {};
        this.$element = this.core.dom.$el;
        this.handlers = {
            'initialized.owl.carousel': $.proxy(function() {
                if (window.location.hash.substring(1)) {
                    $(window).trigger('hashchange.owl.navigation');
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (this.filling) {
                    e.property.value.data('owl-item').hash = $(':first-child', e.property.value).find('[data-hash]').andSelf().data('hash');
                    this.hashes[e.property.value.data('owl-item').hash] = e.property.value;
                }
            }, this),
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && this.core.current() === undefined && this.core.settings.startPosition == 'URLHash') {
                    e.data = this.hashes[window.location.hash.substring(1)];
                }
                this.filling = e.property.name == 'item' && e.property.value && e.property.value.is(':empty');
            }, this),
        };
        this.core.options = $.extend({}, Hash.Defaults, this.core.options);
        this.$element.on(this.handlers);
        $(window).on('hashchange.owl.navigation', $.proxy(function() {
            var hash = window.location.hash.substring(1),
                items = this.core.dom.$oItems,
                position = this.hashes[hash] && items.index(this.hashes[hash]) || 0;
            if (!hash) {
                return false;
            }
            this.core.dom.oStage.scrollLeft = 0;
            this.core.to(position, false, true);
        }, this));
    }
    Hash.Defaults = {
        URLhashListener: false
    }
    Hash.prototype.destroy = function() {
        var handler, property;
        $(window).off('hashchange.owl.navigation');
        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }
    $.fn.owlCarousel.Constructor.Plugins.Hash = Hash;
})(window.Zepto || window.jQuery, window, document);