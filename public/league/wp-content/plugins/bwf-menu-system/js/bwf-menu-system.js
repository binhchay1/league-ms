var $j = jQuery.noConflict();
$j(document).ready(function() {
    function getActiveSite(_option) {
        let activeUrl = window.location.hostname;
        let activeSiteArray = activeUrl.split(".");
        let activeSiteName;
        if (_option == 1) {
            switch (activeSiteArray[0]) {
                case 'fansite':
                case 'bwfbadminton':
                    activeSiteName = 'fansite';
                    break;
                case 'fansite2020':
                    activeSiteName = 'fansite2020';
                    break;
                case 'fansitecn':
                    activeSiteName = 'fansitecn';
                    break;
                case 'olympics':
                    activeSiteName = 'olympics';
                    break;
                case 'sudirman':
                case 'bwfsudirmancup':
                    activeSiteName = 'sudirman';
                    break;
                case 'thomasuber':
                case 'bwfthomasubercups':
                    activeSiteName = 'thomasuber';
                    break;
                case 'worldchampionships':
                case 'bwfworldchampionships':
                    activeSiteName = 'worldchampionships';
                    break;
                case 'worldtour':
                case 'bwfworldtour':
                    activeSiteName = 'worldtour';
                    break;
                case 'worldtourfinals':
                case 'bwfworldtourfinals':
                    activeSiteName = 'worldtourfinals';
                    break;
                default:
                    activeSiteName = activeSiteArray[0];
                    break;
            }
            if (activeSiteArray[1] == 'cn') {
                activeSiteName = 'fansitecn';
            }
            return activeSiteName;
        } else if (_option == 2) {
            return activeSiteArray;
        }
    }
    let activeSite = getActiveSite(1);
    const moreLinkDesktop = $j("#top-menu-desktop li.nav-platform-sub-1 > a");
    const moreListDesktop = document.querySelector(".nav-platform-sub-1 ul.arrow-box-top");
    const moreDesktopAnimation = gsap.to(moreListDesktop, {
        duration: 0.01,
        display: 'block',
        reversed: true
    });
    moreLinkDesktop.on("click", function(e) {
        e.preventDefault();
        let otherSubMenus = $j('#top-menu-desktop .nav-site-menu li.menu-item-has-children').children('ul.sub-menu.is_active');
        if (otherSubMenus.length > 0) {
            otherSubMenus.removeClass('is_active');
            let otherTl = new gsap.timeline({
                paused: true
            });
            otherTl.to(otherSubMenus, {
                duration: 0.01,
                display: "none"
            });
            otherTl.play();
        }
        moreLinkDesktop.toggleClass('is_active');
        if ($j('#top-menu-desktop .nav-site-search').hasClass('is_active')) {
            $j('#top-menu-desktop .nav-site-search').removeClass('is_active');
            searchDesktop.reverse();
        }
        moreDesktop1Animation.reverse();
        moreDesktop2Animation.reverse();
        if ($j(this).children('span').css('transform') == 'none') {
            $j(this).children('span').css({
                'transform': 'rotate(180deg)'
            });
        } else {
            $j(this).children('span').css({
                'transform': ''
            });
        }
        moreDesktopAnimation.reversed() ? moreDesktopAnimation.play() : moreDesktopAnimation.reverse();
    });
    const moreLink1Desktop = $j("#top-menu-desktop a#platform-sublink-1");
    const moreLink2Desktop = $j("#top-menu-desktop a#platform-sublink-2");
    const moreList1Desktop = $j("#top-menu-desktop ul#platform-sublist-1");
    const moreList2Desktop = $j("#top-menu-desktop ul#platform-sublist-2");
    const moreDesktop1Animation = gsap.to(moreList1Desktop, {
        duration: 0.01,
        display: "block",
        reversed: true
    });
    const moreDesktop2Animation = gsap.to(moreList2Desktop, {
        duration: 0.01,
        display: "block",
        reversed: true
    });
    moreLink1Desktop.on("click", function(e) {
        e.preventDefault();
        moreDesktop2Animation.reverse();
        moreDesktop1Animation.reversed() ? moreDesktop1Animation.play() : moreDesktop1Animation.reverse();
    });
    moreLink2Desktop.on("click", function(e) {
        e.preventDefault();
        moreDesktop1Animation.reverse();
        moreDesktop2Animation.reversed() ? moreDesktop2Animation.play() : moreDesktop2Animation.reverse();
    });
    $j(document).on('click', '#top-menu-mobile li.nav-platform-sub-1 > a', function(e) {
        e.preventDefault();
        if (mobileMenu.hasClass('slide-in')) {
            closeMobileSubMenu();
            mobileLogo.css('top', '-85px');
            mobileMenu.removeClass('slide-in');
            mobileMenu.addClass('slide-out');
        }
        mobileSearch.removeClass('is-active');
        if ($j('.hamburger').hasClass("is-active")) {
            $j('.hamburger').removeClass("is-active");
        }
        $j('#top-menu-mobile li.nav-platform-sub-2 > ul').removeClass('slide-right');
        $j('#top-menu-mobile .nav-platform-sub-1 .active-platform .mobile-more-text').toggleClass('rotate-arrow');
        $j('#top-menu-mobile .nav-platform-sub-1 .active-platform .mobile-more-arrow').toggleClass('rotate-arrow');
        if ($j(this).siblings('ul').hasClass('slide-down')) {
            $j('#top-menu-mobile li.nav-platform-sub-2 > ul').removeClass('active');
            $j('#top-menu-mobile li.nav-platform-sub-2 > ul').removeClass('submenu-show');
            $j(this).siblings('ul').removeClass('slide-down');
            $j(this).siblings('ul').addClass('slide-top');
        } else {
            $j(this).siblings('ul').removeClass('slide-top');
            $j(this).siblings('ul').addClass('slide-down');
        }
    });
    $j(document).on('click', '#top-menu-mobile li.nav-platform-sub-2 > a', function(e) {
        e.preventDefault();
        if ($j(this).parent().siblings('.nav-platform-sub-2').children('ul').hasClass('submenu-show')) {
            $j(this).parent().siblings('.nav-platform-sub-2').children('ul').removeClass('submenu-show');
            $j(this).parent().siblings('.nav-platform-sub-2').children('ul').addClass('submenu-hide');
            $j(this).parent().siblings('.nav-platform-sub-2').removeClass('active');
        }
        $j(this).parent().toggleClass('active');
        if ($j(this).siblings('ul').hasClass('submenu-show')) {
            $j(this).siblings('ul').removeClass('submenu-show');
            $j(this).siblings('ul').addClass('submenu-hide');
        } else {
            $j(this).siblings('ul').removeClass('submenu-hide');
            $j(this).siblings('ul').addClass('submenu-show');
        }
    });
    if (activeSite != 'corporate' && activeSite != 'shuttletime' && activeSite != 'development') {
        $j(document).on('click', '#top-menu-desktop li.menu-item-has-children > a', function(e) {
            e.preventDefault();
            moreDesktop1Animation.reverse();
            moreDesktop2Animation.reverse();
            moreDesktopAnimation.reverse();
            let otherSubMenus = $j(this).parent().siblings('li.menu-item-has-children').children('ul.is_active');
            if (otherSubMenus.length > 0) {
                otherSubMenus.removeClass('is_active');
                let otherTl = new gsap.timeline({
                    paused: true
                });
                otherTl.to(otherSubMenus, {
                    duration: 0.01,
                    display: "none"
                });
                otherTl.play();
            }
            let thisSubMenu = $j(this).siblings('ul');
            thisSubMenu.toggleClass('is_active');
            thisSubMenu.addClass('arrow-box-top');
            if (thisSubMenu.hasClass('is_active')) {
                let thisTl = gsap.to(thisSubMenu, {
                    duration: 0.01,
                    display: "block",
                    paused: true,
                    reversed: true
                });
                thisTl.play();
            } else {
                let thisTl = new gsap.timeline({
                    paused: true
                });
                thisTl.to(thisSubMenu, {
                    duration: 0.01,
                    display: "none"
                });
                thisTl.play();
            }
        });
    }
    $j(document).on('click', '#top-menu-mobile .site-top-menu > li.menu-item-has-children > a', function(e) {
        e.preventDefault();
        if ($j(this).siblings('ul').children('li.submenu-header').length === 0) {
            let submenuTitle = $j(this).text();
            $j(this).siblings('ul').prepend('<li class="submenu-header"><a href="#">' + submenuTitle + '</a></li>');
        }
        let thisSubMenu = $j(this).siblings('ul');
        let menuMobile = new gsap.timeline({
            paused: true
        });
        menuMobile.to(thisSubMenu, {
            duration: 0.5,
            visibility: "visible",
            x: 0,
            ease: "power2.in"
        });
        menuMobile.to($j('.nav-platform-social'), {
            duration: 0.5,
            height: 0,
            display: "none",
            ease: "power2.in"
        }, "-=0.5");
        if (activeSite == 'fansitecn') {
            menuMobile.to($j('.menu-main-chinese-container'), {
                duration: 0.5,
                bottom: 0,
                ease: "power2.in"
            }, "-=0.5");
        } else if (activeSite == 'development') {
            if ($j('.menu-main-menu-container').length) {
                menuMobile.to($j('.menu-main-menu-container'), {
                    duration: 0.5,
                    bottom: 0,
                    ease: "power2.in"
                }, "-=0.5");
            }
            if ($j('.menu-main-chinese-container').length) {
                menuMobile.to($j('.menu-main-chinese-container'), {
                    duration: 0.5,
                    bottom: 0,
                    ease: "power2.in"
                }, "-=0.5");
            }
            if ($j('.menu-main-french-container').length) {
                menuMobile.to($j('.menu-main-french-container'), {
                    duration: 0.5,
                    bottom: 0,
                    ease: "power2.in"
                }, "-=0.5");
            }
            if ($j('.menu-main-spanish-container').length) {
                menuMobile.to($j('.menu-main-spanish-container'), {
                    duration: 0.5,
                    bottom: 0,
                    ease: "power2.in"
                }, "-=0.5");
            }
            if ($j('.menu-main-portuguese-container').length) {
                menuMobile.to($j('.menu-main-portuguese-container'), {
                    duration: 0.5,
                    bottom: 0,
                    ease: "power2.in"
                }, "-=0.5");
            }
        } else {
            menuMobile.to($j('.menu-main-menu-container'), {
                duration: 0.5,
                bottom: 0,
                ease: "power2.in"
            }, "-=0.5");
        }
        menuMobile.play();
        $j(this).parent('li').toggleClass('submenu_active');
    });
    $j(document).on('click', '#top-menu-mobile ul.sub-menu li.submenu-header > a', function(e) {
        e.preventDefault();
        let thisSubMenu = $j(this).parent().parent();
        if ($j(this).parent().hasClass('level-2')) {
            let menuMobile = new gsap.timeline({
                paused: true
            });
            menuMobile.to(thisSubMenu, {
                duration: 0.5,
                x: "100%",
                ease: "power2.in"
            });
            menuMobile.to(thisSubMenu, {
                duration: 0,
                visibility: "hidden"
            });
            menuMobile.play();
        } else {
            let menuMobile = new gsap.timeline({
                paused: true
            });
            menuMobile.to(thisSubMenu, {
                duration: 0.5,
                x: "100%",
                ease: "power2.in"
            });
            menuMobile.to(thisSubMenu, {
                duration: 0,
                visibility: "hidden"
            });
            menuMobile.to($j('.nav-platform-social'), {
                duration: 0,
                display: "block"
            }, "-=0.5");
            menuMobile.to($j('.nav-platform-social'), {
                duration: 0.5,
                height: 60,
                ease: "power2.in"
            }, "-=0.5");
            if (activeSite == 'fansitecn') {
                menuMobile.to($j('.menu-main-chinese-container'), {
                    duration: 0.5,
                    bottom: 60,
                    ease: "power2.in"
                }, "-=0.5");
            } else {
                menuMobile.to($j('.menu-main-menu-container'), {
                    duration: 0.5,
                    bottom: 60,
                    ease: "power2.in"
                }, "-=0.5");
            }
            menuMobile.play();
        }
    });
    $j(document).on('click', '#top-menu-mobile .site-top-menu ul > li.menu-item-has-children > a', function(e) {
        e.preventDefault();
        if ($j(this).siblings('ul').children('li.submenu-header').length === 0) {
            let submenuTitle = $j(this).text();
            $j(this).siblings('ul').prepend('<li class="submenu-header level-2"><a href="#">' + submenuTitle + '</a></li>');
        }
        let thisSubMenu = $j(this).siblings('ul');
        let thisSubMenuLinks = $j(this).siblings('ul').children('li').children('a');
        let menuMobile = new gsap.timeline({
            paused: true
        });
        menuMobile.to(thisSubMenu, {
            duration: 0.5,
            visibility: "visible",
            x: 0,
            ease: "power2.in"
        });
        menuMobile.play();
        $j(this).parent('li').toggleClass('submenu_active');
    });
    let prevScrollpos = window.pageYOffset;
    let desktopMainLogo = $j("#top-menu-desktop .nav-site-logo img.desktop-main-logo");
    let desktopAltLogo = $j("#top-menu-desktop .nav-site-logo img.desktop-alt-logo");
    let desktopLogoAnimation = new gsap.timeline({
        paused: true,
        reversed: true
    });
    desktopLogoAnimation.to(desktopMainLogo, {
        duration: 0.15,
        opacity: 0,
        display: "none"
    });
    desktopLogoAnimation.to(desktopAltLogo, {
        duration: 0.15,
        opacity: 1,
        display: "block"
    }, "+=0.15");
    window.onscroll = function() {
        let currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            $j("#top-menu-desktop #nav-platform-bar .nav-platform-inner").removeClass('hide-nav-platform');
            $j("#top-menu-desktop .nav-site-filler").removeClass('hide-nav-filler');
            $j("#top-menu-desktop .nav-site-logo").removeClass('hide-nav-logo');
            if (activeSite == 'fansite' || activeSite == 'fansitecn' || activeSite == 'corporate') {
                desktopLogoAnimation.reverse();
            }
        } else if (currentScrollPos > 75) {
            $j("#top-menu-desktop #nav-platform-bar .nav-platform-inner").addClass('hide-nav-platform');
            $j("#top-menu-desktop .nav-site-filler").addClass('hide-nav-filler');
            $j("#top-menu-desktop .nav-site-logo").addClass('hide-nav-logo');
            if (activeSite == 'fansite' || activeSite == 'fansitecn' || activeSite == 'corporate') {
                desktopLogoAnimation.play();
            }
        }
        prevScrollpos = currentScrollPos;
    }
    const hamburger = $j(".hamburger");
    const mobileMenu = $j("#top-menu-mobile .nav-site-wrap .nav-site-menu");
    const mobileSearch = $j('#top-menu-mobile .nav-site-search');
    const mobileLogo = $j('#top-menu-mobile .nav-site-logo');
    hamburger.on("click", function() {
        if ($j('#top-menu-mobile .nav-site-search .search-box').hasClass('is-active')) {
            $j(searchMobileKey).val('');
            clearMobileSearch();
            $j("#top-menu-mobile .menu-main-menu-container").css('filter', 'unset');
            $j('#top-menu-mobile .search-dropdown-wrap').slideUp(400);
            $j("#top-menu-mobile #searchclear").css('visibility', 'hidden');
            $j("#top-menu-mobile #searchclear").css('opacity', 0);
            $j('#top-menu-mobile .nav-site-search .search-box').removeClass('is-active')
            return;
        }
        hamburger.toggleClass("is-active");
        mobileSearch.toggleClass('is-active');
        $j(searchMobileKey).val('');
        clearMobileSearch();
        $j("#top-menu-mobile .menu-main-menu-container").css('filter', 'unset');
        $j('#top-menu-mobile .search-dropdown-wrap').slideUp(400);
        $j("#top-menu-mobile #searchclear").css('visibility', 'hidden');
        $j("#top-menu-mobile #searchclear").css('opacity', 0);
        if (mobileMenu.hasClass('slide-in')) {
            mobileLogo.css('top', '-85px');
            closeMobileSubMenu();
            mobileMenu.removeClass('slide-in');
            mobileMenu.addClass('slide-out');
        } else {
            mobileLogo.css('top', '-200px');
            mobileMenu.removeClass('slide-out');
            mobileMenu.addClass('slide-in');
        }
    });

    function closeMobileSubMenu() {
        const thisSubMenu = $j('#top-menu-mobile .nav-site-menu').find('ul.sub-menu');
        if (thisSubMenu.length > 0) {
            let menuMobile = new gsap.timeline({
                paused: true
            });
            menuMobile.to(thisSubMenu, {
                duration: 0.5,
                x: "100%",
                ease: "power2.in"
            });
            menuMobile.to(thisSubMenu, {
                duration: 0,
                visibility: "hidden"
            });
            menuMobile.to($j('.nav-platform-social'), {
                duration: 0,
                display: "block"
            }, "-=0.5");
            menuMobile.to($j('.nav-platform-social'), {
                duration: 0.5,
                height: 60,
                ease: "power2.in"
            }, "-=0.5");
            if (activeSite == 'fansitecn') {
                menuMobile.to($j('.menu-main-chinese-container'), {
                    duration: 0.5,
                    bottom: 60,
                    ease: "power2.in"
                }, "-=0.5");
            } else {
                menuMobile.to($j('.menu-main-menu-container'), {
                    duration: 0.5,
                    bottom: 60,
                    ease: "power2.in"
                }, "-=0.5");
            }
            menuMobile.play();
        }
    }

    function setActiveMenu() {
        let pathArray = window.location.pathname.split('/');
        switch (activeSite) {
            case 'fansite':
                if (pathArray[1] == "player") {
                    $j("li#menu-item-33929, li.menu-item-33929").addClass("current-menu-item");
                } else if (pathArray[1] == "rankings") {
                    $j("li#menu-item-33925, li.menu-item-33925").addClass("current-menu-item");
                } else if (pathArray[1] == "events") {
                    $j("li#menu-item-33926, li.menu-item-33926").addClass("current-menu-item");
                } else if (pathArray[1] == "live" || pathArray[1] == "live-scores") {
                    $j("li#menu-item-33923, li.menu-item-33923").addClass("current-menu-item");
                } else if (pathArray[1] == "results") {
                    $j("li#menu-item-33927, li.menu-item-33927").addClass("current-menu-item");
                } else if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-33928, li.menu-item-33928").addClass("current-menu-item");
                }
                break;
            case 'fansitecn':
                if (pathArray[1] == "player") {
                    $j("li#menu-item-27014, li.menu-item-27014").addClass("current-menu-item");
                } else if (pathArray[1] == "rankings") {
                    $j("li#menu-item-27011, li.menu-item-27011").addClass("current-menu-item");
                } else if (pathArray[1] == "events") {
                    $j("li#menu-item-27012, li.menu-item-27012").addClass("current-menu-item");
                } else if (pathArray[1] == "live" || pathArray[1] == "live-scores") {
                    $j("li#menu-item-27016, li.menu-item-27016").addClass("current-menu-item");
                } else if (pathArray[1] == "results") {
                    $j("li#menu-item-27013, li.menu-item-27013").addClass("current-menu-item");
                } else if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-27015, li.menu-item-27015").addClass("current-menu-item");
                }
                break;
            case 'olympics':
                if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-1469, li.menu-item-1469").addClass("current-menu-item");
                } else if (pathArray[1] == "live") {
                    $j("li#menu-item-2750, li.menu-item-2750").addClass("current-menu-item");
                } else if (pathArray[1] == "results" || pathArray[1] == "player") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                } else if (pathArray[1] == "about") {
                    $j("li#menu-item-1467, li.menu-item-1467").addClass("current-menu-item");
                }
                break;
            case 'sudirman':
                if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-1469, li.menu-item-1469").addClass("current-menu-item");
                } else if (pathArray[1] == "live") {
                    $j("li#menu-item-2750, li.menu-item-2750").addClass("current-menu-item");
                } else if (pathArray[1] == "results") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                } else if (pathArray[1] == "player" || pathArray[1] == "player-titles" || pathArray[1] == "h2h") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                }
                break;
            case 'thomasuber':
                if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-1469, li.menu-item-1469").addClass("current-menu-item");
                } else if (pathArray[1] == "live") {
                    $j("li#menu-item-2750, li.menu-item-2750").addClass("current-menu-item");
                } else if (pathArray[1] == "results") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                } else if (pathArray[1] == "player" || pathArray[1] == "player-titles" || pathArray[1] == "h2h") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                }
                break;
            case 'worldchampionships':
                if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-1469, li.menu-item-1469").addClass("current-menu-item");
                } else if (pathArray[1] == "live") {
                    $j("li#menu-item-2750, li.menu-item-2750").addClass("current-menu-item");
                } else if (pathArray[1] == "results") {
                    $j("li#menu-item-2746, li.menu-item-2746").addClass("current-menu-item");
                } else if (pathArray[1] == "player" || pathArray[1] == "player-titles" || pathArray[1] == "h2h") {
                    $j("li#menu-item-2901, li.menu-item-2901").addClass("current-menu-item");
                }
                break;
            case 'worldtour':
                if (pathArray[1] == "tournament") {
                    $j("li#menu-item-17, li.menu-item-17").addClass("current-menu-item");
                } else if (pathArray[1] == "news-single" || pathArray[1] == "news-tag") {
                    $j("li#menu-item-16, li.menu-item-16").addClass("current-menu-item");
                } else if (pathArray[1] == "player") {
                    $j("li#menu-item-8, li.menu-item-8").addClass("current-menu-item");
                }
                break;
            default:
                break;
        }
    }
    setActiveMenu();
    $j('#search-desktop').keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $j('#search-mobile').keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    let home_url = window.location.origin;
    let searchDesktopKey = $j('#search-desktop');
    let searchDesktopLoader = $j('#top-menu-desktop .search-loader');
    let searchDesktopMessage = $j('#top-menu-desktop .search-message');
    let searchResults = $j('#top-menu-desktop .search-results-wrap');
    let searchDesktop = new gsap.timeline({
        paused: true,
        reversed: true
    });
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-desktop-open', {
        duration: 0.15,
        height: 0,
        display: "none"
    });
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-desktop-close', {
        duration: 0.15,
        height: 18,
        display: "flex"
    });
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-box', {
        duration: 0,
        autoAlpha: 1
    });
    searchDesktop.to('#top-menu-desktop .nav-site-search', {
        duration: 0.35,
        width: '100%'
    });
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-box input', {
        duration: 0,
        padding: '12px 18px 12px 49px'
    }, "-=0.25");
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-dropdown-wrap', {
        duration: 0.2,
        autoAlpha: 1
    }, "-=0.5");
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-message', {
        duration: 0.35,
        autoAlpha: 1
    }, "-=0.15");
    searchDesktop.to('#top-menu-desktop .nav-site-search .search-results-wrap', {
        duration: 0.35,
        display: "flex"
    }, "-=0.35");
    $j(document).on('click', '#top-menu-desktop .nav-site-search img', function(e) {
        e.preventDefault();
        $j('#top-menu-desktop .nav-site-search').toggleClass('is_active');
        const moreLinkDesktop = document.querySelector("#top-menu-desktop li.nav-platform-sub-1 a");
        if (moreLinkDesktop.classList.contains('is_active')) {
            moreLinkDesktop.click();
        }
        let otherSubMenus = $j('#top-menu-desktop .nav-site-menu li.menu-item-has-children').children('ul.sub-menu.is_active');
        if (otherSubMenus.length > 0) {
            otherSubMenus.removeClass('is_active');
            let otherTl = new gsap.timeline({
                paused: true
            });
            otherTl.to(otherSubMenus, {
                duration: 0.01,
                display: "none"
            });
            otherTl.play();
        }
        if (searchDesktop.reversed()) {
            searchDesktop.play();
            setTimeout(() => {
                $j('#search-desktop').focus();
                $j('#search-desktop').prop('autofocus');
            }, 1000);
        } else {
            clearDesktopSearch();
            $j(searchDesktopKey).val('');
            searchDesktop.reverse();
        }
    });
    $j(document).click(function(e) {
        var target = $j(e.target);
        if (!target.closest('#top-menu-desktop .nav-site-search').length) {
            $j('#top-menu-desktop .nav-site-search').toggleClass('is_active');
            clearDesktopSearch();
            $j(searchDesktopKey).val('');
            searchDesktop.reverse();
        }
    });

    function clearDesktopSearch() {
        searchDesktopMessage.slideDown(200);
        searchResults.removeClass('is_searching');
        searchDesktopLoader.removeClass('is_active');
        $j('#top-menu-desktop .search-results-news ul').html('');
        $j('#top-menu-desktop .search-results-players ul').html('');
        $j('#top-menu-desktop .search-results-tournaments ul').html('');
        $j('#top-menu-desktop .search-results-news h2 span').remove();
        $j('#top-menu-desktop .search-results-players h2 span').remove();
        $j('#top-menu-desktop .search-results-tournaments h2 span').remove();
        $j('#top-menu-desktop .nav-site-search .search-box #searchclear').css({
            'visibility': 'hidden',
            'opacity': 0
        });
    }
    let menuDesktopSearch = new SearchDesktop();
    menuDesktopSearch.findPlayer();

    function SearchDesktop() {
        this.findPlayer = function() {
            if (searchDesktopKey.length > 0) {
                $j(searchDesktopKey).on('input', function() {
                    if ($j(this).val().length >= 3) {
                        $j('#top-menu-desktop .nav-site-search .search-box #searchclear').css({
                            'visibility': 'visible',
                            'opacity': 1
                        });
                        return;
                    } else {
                        clearDesktopSearch();
                    }
                });
                let searchFunction;
                if (activeSite == 'shuttletime' || activeSite == 'development') {
                    searchFunction = 'menu_search_posts';
                } else if (activeSite == 'corporate') {
                    searchFunction = 'menu_search_pages';
                } else {
                    searchFunction = 'menu_find_player';
                }
                $j("#searchclear").click(function() {
                    $j(searchDesktopKey).val('');
                    $j(searchDesktopKey).focus();
                    clearDesktopSearch();
                });
                searchDesktopKey.autocomplete({
                    source: function(req, response) {
                        searchDesktopMessage.slideUp(200);
                        searchResults.addClass('is_searching');
                        searchDesktopLoader.addClass('is_active');
                        $j.getJSON(home_url + '/wp-load.php?action=' + searchFunction, req, response);
                    },
                    response: function(event, ui) {
                        searchResults.removeClass('is_searching');
                        searchDesktopLoader.removeClass('is_active');
                        $j('#top-menu-desktop .search-results-news ul').html('');
                        $j('#top-menu-desktop .search-results-players ul').html('');
                        $j('#top-menu-desktop .search-results-tournaments ul').html('');
                        let searchCountArray = {};
                        ui.content.forEach(function(element) {
                            if (!searchCountArray[element.type]) {
                                searchCountArray[element.type] = 0;
                            }
                            if (element.value == 'none') {
                                searchCountArray[element.type] = 0;
                            } else {
                                searchCountArray[element.type] += 1;
                            }
                        });
                        $j('#top-menu-desktop .search-results-news h2 span').remove();
                        $j('#top-menu-desktop .search-results-news h2').append('<span> (' + searchCountArray['news'] + ' found)</span>');
                        $j('#top-menu-desktop .search-results-players h2 span').remove();
                        $j('#top-menu-desktop .search-results-players h2').append('<span> (' + searchCountArray['player'] + ' found)</span>');
                        $j('#top-menu-desktop .search-results-tournaments h2 span').remove();
                        $j('#top-menu-desktop .search-results-tournaments h2').append('<span> (' + searchCountArray['tournament'] + ' found)</span>');
                    },
                    minLength: 3
                }).autocomplete("instance")._renderItem = function(ul, item) {
                    if (item.type == 'news') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-desktop .search-results-news ul'));
                        } else {
                            if (activeSite == 'shuttletime' || activeSite == 'development' || activeSite == 'corporate') {
                                return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.date + ")</span></div>").appendTo($j('#top-menu-desktop .search-results-news ul'));
                            } else {
                                return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.date + " - " + item.site + ")</span></div>").appendTo($j('#top-menu-desktop .search-results-news ul'));
                            }
                        }
                    } else if (item.type == 'player') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-desktop .search-results-players ul'));
                        } else {
                            return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.value + ")</span></div>").appendTo($j('#top-menu-desktop .search-results-players ul'));
                        }
                    } else if (item.type == 'tournament') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-desktop .search-results-tournaments ul'));
                        } else {
                            return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.site + ")</span></div>").appendTo($j('#top-menu-desktop .search-results-tournaments ul'));
                        }
                    }
                }
            }
        }
    }
    let searchMobileKey = $j('#search-mobile');
    let searchMobileLoader = $j('#top-menu-mobile .search-loader');
    let searchMobileMessage = $j('#top-menu-mobile .search-message');
    let searchMobileResults = $j('#top-menu-mobile .search-results-wrap');
    let resultsMobileNews = $j('#top-menu-mobile .search-results-news');
    let resultsMobilePlayers = $j('#top-menu-mobile .search-results-players');
    let resultsMobileTournaments = $j('#top-menu-mobile .search-results-tournaments');
    $j(document).on('focus', '#top-menu-mobile .nav-site-search', function(e) {
        e.preventDefault();
        $j('#top-menu-mobile .search-dropdown-wrap').slideDown(400);
        $j('#top-menu-mobile .nav-site-search .search-box').addClass('is-active');
        $j("#top-menu-mobile .menu-main-menu-container").css('filter', 'blur(2px)');
    });

    function clearMobileSearch() {
        searchMobileMessage.slideDown(200);
        searchMobileResults.removeClass('is_searching');
        searchMobileLoader.removeClass('is_active');
        resultsMobileNews.children('ul').slideUp(300);
        resultsMobilePlayers.children('ul').slideUp(300);
        resultsMobileTournaments.children('ul').slideUp(300);
        resultsMobileNews.children('h2').removeClass('is_active');
        resultsMobilePlayers.children('h2').removeClass('is_active');
        resultsMobileTournaments.children('h2').removeClass('is_active');
        $j('#top-menu-mobile .search-results-news ul').html('');
        $j('#top-menu-mobile .search-results-players ul').html('');
        $j('#top-menu-mobile .search-results-tournaments ul').html('');
        $j('#top-menu-mobile .search-results-news h2 span').remove();
        $j('#top-menu-mobile .search-results-players h2 span').remove();
        $j('#top-menu-mobile .search-results-tournaments h2 span').remove();
        $j("#top-menu-mobile #searchclear").css({
            'visibility': 'hidden',
            'opacity': 0
        });
    }
    $j(document).on('click', '#top-menu-mobile .search-results-news', function(e) {
        resultsMobilePlayers.children('h2').removeClass('is_active');
        resultsMobilePlayers.children('ul').slideUp(300);
        resultsMobileTournaments.children('h2').removeClass('is_active');
        resultsMobileTournaments.children('ul').slideUp(300);
        resultsMobileNews.children('h2').toggleClass('is_active');
        resultsMobileNews.children('ul').slideToggle(300);
    });
    $j(document).on('click', '#top-menu-mobile .search-results-players', function(e) {
        resultsMobileNews.children('h2').removeClass('is_active');
        resultsMobileNews.children('ul').slideUp(300);
        resultsMobileTournaments.children('h2').removeClass('is_active');
        resultsMobileTournaments.children('ul').slideUp(300);
        resultsMobilePlayers.children('h2').toggleClass('is_active');
        resultsMobilePlayers.children('ul').slideToggle(300);
    });
    $j(document).on('click', '#top-menu-mobile .search-results-tournaments', function(e) {
        resultsMobileNews.children('h2').removeClass('is_active');
        resultsMobileNews.children('ul').slideUp(300);
        resultsMobilePlayers.children('h2').removeClass('is_active');
        resultsMobilePlayers.children('ul').slideUp(300);
        resultsMobileTournaments.children('h2').toggleClass('is_active');
        resultsMobileTournaments.children('ul').slideToggle(300);
    });
    var menuMobileSearch = new SearchMobile();
    menuMobileSearch.findPlayer();

    function SearchMobile() {
        this.findPlayer = function() {
            if (searchMobileKey.length > 0) {
                $j(searchMobileKey).on('input', function() {
                    if ($j(this).val().length >= 3) {
                        $j("#top-menu-mobile #searchclear").css({
                            'visibility': 'visible',
                            'opacity': 1
                        });
                        return;
                    } else {
                        clearMobileSearch();
                    }
                });
                let searchFunction;
                if (activeSite == 'shuttletime' || activeSite == 'development') {
                    searchFunction = 'menu_search_posts';
                } else if (activeSite == 'corporate') {
                    searchFunction = 'menu_search_pages';
                } else {
                    searchFunction = 'menu_find_player';
                }
                $j("#top-menu-mobile #searchclear").click(function() {
                    $j(searchMobileKey).val('');
                    $j(searchMobileKey).focus();
                    clearMobileSearch();
                });
                searchMobileKey.autocomplete({
                    source: function(req, response) {
                        searchMobileMessage.slideUp(200);
                        searchMobileResults.addClass('is_searching');
                        searchMobileLoader.addClass('is_active');
                        $j.getJSON(home_url + '/wp-load.php?action=' + searchFunction, req, response);
                    },
                    response: function(event, ui) {
                        searchMobileResults.removeClass('is_searching');
                        searchMobileLoader.removeClass('is_active');
                        $j('#top-menu-mobile .search-results-news ul').html('');
                        $j('#top-menu-mobile .search-results-players ul').html('');
                        $j('#top-menu-mobile .search-results-tournaments ul').html('');
                        let searchCountArray = {};
                        ui.content.forEach(function(element) {
                            if (!searchCountArray[element.type]) {
                                searchCountArray[element.type] = 0;
                            }
                            if (element.value == 'none') {
                                searchCountArray[element.type] = 0;
                            } else {
                                searchCountArray[element.type] += 1;
                            }
                        });
                        $j('#top-menu-mobile .search-results-news h2 span').remove();
                        $j('#top-menu-mobile .search-results-news h2').append('<span> (' + searchCountArray['news'] + ' found)</span>');
                        $j('#top-menu-mobile .search-results-players h2 span').remove();
                        $j('#top-menu-mobile .search-results-players h2').append('<span> (' + searchCountArray['player'] + ' found)</span>');
                        $j('#top-menu-mobile .search-results-tournaments h2 span').remove();
                        $j('#top-menu-mobile .search-results-tournaments h2').append('<span> (' + searchCountArray['tournament'] + ' found)</span>');
                    },
                    minLength: 3
                }).autocomplete("instance")._renderItem = function(ul, item) {
                    if (item.type == 'news') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-mobile .search-results-news ul'));
                        } else {
                            if (activeSite == 'shuttletime' || activeSite == 'development' || activeSite == 'corporate') {
                                return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.date + ")</span></div>").appendTo($j('#top-menu-mobile .search-results-news ul'));
                            } else {
                                return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.date + " - " + item.site + ")</span></div>").appendTo($j('#top-menu-mobile .search-results-news ul'));
                            }
                        }
                    } else if (item.type == 'player') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-mobile .search-results-players ul'));
                        } else {
                            return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.value + ")</span></div>").appendTo($j('#top-menu-mobile .search-results-players ul'));
                        }
                    } else if (item.type == 'tournament') {
                        if (item.value == 'none') {
                            return $j("<li>").append("<div>" + item.label + "</div>").appendTo($j('#top-menu-mobile .search-results-tournaments ul'));
                        } else {
                            return $j("<li>").append("<div><a href='" + item.url + "'>" + item.label + "</a> <span>(" + item.site + ")</span></div>").appendTo($j('#top-menu-mobile .search-results-tournaments ul'));
                        }
                    }
                }
            }
        }
    }
});