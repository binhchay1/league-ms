<html lang="en" class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">

    <meta name="msapplication-TileColor" content="#E45357">
    <meta name="msapplication-TileImage" content="/assets/images/favicons/favicon-144.png">
    <meta name="application-name" content="{{ env('APP_NAME', 'Badminton.io') }}">
    <meta name="msapplication-tooltip" content="{{ env('APP_NAME', 'Badminton.io') }}">
    <meta name="description" content="{{ __('Run your badminton league for free, badminton scheduling and online results and statistics displayed on your free website.') }}">
    <meta name="keywords" content="{{ __('badminton scheduling,badminton scheduler,badminton league,badminton league website,manage badminton league online,run badminton league online') }}">
    <meta name="robots" content="Index, Follow">

    <title>@yield('title')</title>

    <link rel="canonical" href="https://www.leaguerepublic.com/badminton.html">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/page/style.css') }}">
    <link rel="alternate" hreflang="en-US" href="https://badminton.io">
    <link rel="alternate" hreflang="af" href="https://badminton.io">
    <link rel="alternate" hreflang="x-default" href="https://badminton.io">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo-no-background.png') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <link rel="stylesheet" id="dashicons-css" href="{{asset('league/wp-includes/css/dashicons.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="editor-buttons-css" href="{{asset('league/wp-includes/css/editor.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="wp-block-library-css" href="{{asset('league/wp-includes/css/dist/block-library/style.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="bwf-newsletter-signup-style-css" href="{{asset('league/wp-content/plugins/bwf-newsletter/css/newsletter-signup.css?ver=1.2')}}"  />
    <link rel="stylesheet" id="bootstrap-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/bootstrap.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="bwf_menu_style-css" href="{{asset('league/wp-content/plugins/bwf-menu-system/css/bwf-menu-system.css?ver=1.233')}}"  />
    <link rel="stylesheet" id="bwf-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/style.css?ver=1.233')}}"  />
    <link rel="stylesheet" id="hover-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/hover-min.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="jquery-ui-autocomplete-css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="fancybox-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/fancybox-master/dist/jquery.fancybox.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="select2-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/select2/dist/css/select2.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="fontawesome-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/fontawesome/css/font-awesome.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="animate.ss-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/animate.css/animate.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="owl-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.carousel.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    <link rel="stylesheet" id="owl-theme-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.theme.default.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
    @yield('css')

</head>

<body >
    <header style="background-color: #222">
        <div class="top-nav">
            <ul class="container">
                <li><a href="/top-sites.html">{{ __('Top league') }}</a></li>
                <li class="menu">
                    <span>en</span>
                    <ul>
                        <li>
                            <a class="{{ Session::get('locale') == 'en' ? 'active' : ''}}" href="{{ route('app.setLocale', ['locale' => 'en']) }}">
                                English (US)
                            </a>
                        </li>

                        <li>
                            <a class="{{ Session::get('locale') == 'vi' ? 'active' : ''}}" href="{{ route('app.setLocale', ['locale' => 'vi']) }}">
                                Tiếng Việt
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <nav class="container">
            <a href="{{ route('home') }}"><img style="margin-bottom: 30px" class="left" src="{{ asset('/images/logo-no-background.png') }}" alt="{{ env('APP_NAME', 'Badminton.io') }}" width="100" height="100"></a>
            <button id="toggle-menu" onclick="toggleMobileMenu()"></button>
            <ul id="menu" style="display: flex !important;">
                <li class="pt-2"><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                <li class="pt-2"><a href="{{ route('list.group') }}">{{ __('Group') }}</a></li>
                <li class="pt-2"><a href="{{ route('shop') }}">{{ __('Shop') }}</a></li>
                <li class="pt-2"><a href="{{ route('pricing') }}">{{ __('Pricing') }}</a></li>
                <li id="search">
                    <form id="search-league" action="{{ route('search') }}" method="post">
                        @csrf
                        <div onclick="openSearch()">
                            <input type="search" name="search" placeholder="{{ __('Search leagues') }}...">
                            <button type="button">
                                <img src="{{ asset('/svg/icon-search.svg') }}" alt="{{ __('Search') }}" title="{{ __('Search') }}" width="15" height="15">
                            </button>
                        </div>
                    </form>
                </li>
                @if(Auth::check())
                <li>
                    <div class="dropdown">
                        <a style="text-decoration: none;" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="avatar-user" width="40" height="40" src="{{ Auth::user()->profile_photo_path }}">
                        </a>

                        <ul class="dropdown-menu mt-2 p-3" aria-labelledby="dropdownMenuLink">
                            <li class="d-flex justify-content-center align-items-center"><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user mr-2"></i> {{ __('Profile') }}</a></li>
                            <li class="d-flex justify-content-center align-items-center"><a class="dropdown-item" href="{{ route('my.group') }}"><i class="fas fa-users mr-2"></i> {{ __('My group') }}</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="{{ route('signout') }}"><i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log out') }}</a></li>
                        </ul>
                    </div>
                </li>
                @else
                <li><a href="{{ route('login') }}" class="button white">{{ __('Log In') }}</a></li>
                <li><a href="{{ route('register_user') }}" class="button">{{ __('Sign Up') }}</a></li>
                @endif
            </ul>
        </nav>
    </header>

    @yield('content')

    <footer style="background-color: #222">
        <div class="container color-white">
            <div>
                <h4 class="h3 color-white">Criteria</h4>
                <p>{{ __('Efficiency and ease-of-use are our mission, simplifying the process of running a sports league.') }}</p>
                <p>{{ env('APP_NAME', 'Badminton.io') }} {{ __('is available to all at no cost. Additionally, we offer premium plans that include additional functionality.') }}</p>
            </div>
            <div>
                <ul>
                    <li>
                        <h4 class="h3 color-white">{{ __('Company') }}</h4>
                    </li>
                    <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    <li><a href="{{ route('pricing') }}">{{ __('Pricing') }}</a></li>
                    <li><a href="{{ route('top.league') }}">{{ __('Top League') }}</a></li>
                    <li><a href="{{ route('search') }}">{{ __('Search') }}</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h4 class="h3 color-white">{{ __('Features') }}</h4>
                    </li>
                    <li><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                    <li><a href="{{ route('shop') }}">{{ __('Shop') }}</a></li>
                    <li><a href="{{ route('list.group') }}">{{ __('Group') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="h3 color-white">{{ env('APP_NAME', 'Badminton.io') }}</h4>
                <p>
                    <small>
                        <a href="{{ route('term.and.conditions') }}">{{ __('Terms & Conditions') }}</a>,
                        <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                        <br>
                        <span class="color-white">{{ __('Copyright© 2023') }}</span> <a href="{{ route('home')}}">{{ env('APP_NAME', 'Badminton.io') }}</a>
                    </small>
                </p>
                <ul class="social">
                    <li><a href="https://www.linkedin.com/company/badminton.io"><img src="{{ asset('/svg/icon-linkedin.svg') }}" alt="{{ __('LinkedIn') }}" width="30" height="31"></a></li>
                    <li><a href="https://twitter.com/badminton.io"><img src="{{ asset('/svg/icon-twitter.svg') }}" alt="{{ __('Twitter') }}" width="30" height="31"></a></li>
                    <li><a href="https://www.facebook.com/badminton.io"><img src="{{ asset('/svg/icon-facebook.svg') }}" alt="Facebook" width="30" height="31"></a></li>
                    <li><a href="https://www.youtube.com/user/badminton.io"><img src="{{ asset('/svg/icon-youtube.svg') }}" alt="YouTube" width="30" height="31"></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="{{ asset('/js/page/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/page/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/page/common.min.js') }}"></script>

    @yield('js')
</body>

</html>
