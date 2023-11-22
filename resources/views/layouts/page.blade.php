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
    <meta name="robots" content="Index,Follow">

    <title>@yield('title')</title>

    <link rel="canonical" href="https://www.leaguerepublic.com/badminton.html">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/page/style.css') }}">
    <link rel="alternate" hreflang="en-US" href="https://badminton.io">
    <link rel="alternate" hreflang="af" href="https://badminton.io">
    <link rel="alternate" hreflang="x-default" href="https://badminton.io">

    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
    @yield('css')

</head>

<body>
    <header>
        <div class="top-nav">
            <ul class="container">
                <li><a href="/top-sites.html">{{ __('Top league') }}</a></li>
                <li class="menu">
                    <span>en</span>
                    <ul>
                        <li>
                            <a class="active" href="{{ route('app.setLocale', ['locale' => 'en']) }}">
                                English (US)
                            </a>
                        </li>

                        <li>
                            <a class="" href="{{ route('app.setLocale', ['locale' => 'vi']) }}">
                                Tiếng Việt
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <nav class="container">
            <a href="{{ route('home') }}"><img src="{{ asset('/images/logo-no-background.png') }}" alt="{{ env('APP_NAME', 'Badminton.io') }}" width="80" height="80"></a>
            <button id="toggle-menu" onclick="toggleMobileMenu()"></button>
            <ul id="menu">
                <li><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                <li><a href="{{ route('list.group') }}">{{ __('Group') }}</a></li>
                <li><a href="{{ route('shop') }}">{{ __('Shop') }}</a></li>
                <li><a href="{{ route('pricing') }}">{{ __('Pricing') }}</a></li>
                <li id="search">
                    <form id="searchMenuForm" name="searchMenuForm" action="{{ route('search') }}" method="post">
                        <div onclick="openSearch()">
                            <input type="search" name="searchValue" placeholder="{{ __('Search leagues') }}...">
                            <button type="button">
                                <img src="{{ asset('/svg/icon-search.svg') }}" alt="{{ __('Search') }}" title="{{ __('Search') }}" width="15" height="15">
                            </button>
                        </div>
                    </form>
                </li>
                <li><a href="{{ route('login') }}" class="button white">{{ __('Log In') }}</a></li>
                <li><a href="{{ route('register_user') }}" class="button">{{ __('Sign Up') }}</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <footer>
        <div class="container">
            <div>
                <h4 class="h3">{{ env('APP_NAME', 'Badminton.io') }}</h4>
                <p>{{ __('Efficiency and ease-of-use are our mission, simplifying the process of running a sports league.') }}</p>
                <p>{{ env('APP_NAME', 'Badminton.io') }} {{ __('is available to all at no cost. Additionally, we offer premium plans that include additional functionality.') }}</p>
                <ul class="social">
                    <li><a href="https://www.linkedin.com/company/badminton.io"><img src="{{ asset('/svg/icon-linkedin.svg') }}" alt="LinkedIn" width="30" height="31"></a></li>
                    <li><a href="https://twitter.com/badminton.io"><img src="{{ asset('/svg/icon-twitter.svg') }}" alt="Twitter" width="30" height="31"></a></li>
                    <li><a href="https://www.facebook.com/badminton.io"><img src="{{ asset('/svg/icon-facebook.svg') }}" alt="Facebook" width="30" height="31"></a></li>
                    <li><a href="https://www.youtube.com/user/badminton.io"><img src="{{ asset('/svg/icon-youtube.svg') }}" alt="YouTube" width="30" height="31"></a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h4 class="h3">{{ __('Company') }}</h4>
                    </li>
                    <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    <li><a href="{{ route('pricing') }}">{{ __('Pricing') }}</a></li>
                    <li><a href="{{ route('top.league') }}">{{ __('Top League') }}</a></li>
                    <li><a href="{{ route('search') }}">{{ __('Search') }}</a></li>
                    <li><a href="{{ route('login') }}">{{ __('Log In') }}</a></li>
                    <li><a href="{{ route('register_user') }}">{{ __('Sign Up') }}</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>
                        <h4 class="h3">{{ __('Features') }}</h4>
                    </li>
                    <li><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                    <li><a href="{{ route('shop') }}">{{ __('Shop') }}</a></li>
                </ul>
            </div>
            <div>
                <p>
                    <small>
                        <a href="{{ route('term.and.conditions') }}">{{ __('Terms & Conditions') }}</a>,
                        <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                        <br>
                        {{ __('Copyright© 2023') }} <a href="{{ route('home')}}">{{ env('APP_NAME', 'Badminton.io') }}</a>
                    </small>
                </p>
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
