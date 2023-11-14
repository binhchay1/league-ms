<!DOCTYPE html>
<html lang="vi" itemscope itemtype="http://schema.org/Article">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#ffffff">

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" href="/assets/images/favicons/favicon-152.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/favicons/favicon-57.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicons/favicon-76.png" />
    <link rel="apple-touch-icon" sizes="96x96" href="/assets/images/favicons/favicon-96.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/favicons/favicon-120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/favicons/favicon-152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicons/favicon-180.png" />

    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/assets/images/favicons/favicon-16.png" />
    <link rel="shortcut icon" type="image/png" sizes="32x32" href="/assets/images/favicons/favicon-32.png" />
    <link rel="shortcut icon" type="image/png" sizes="48x48" href="/assets/images/favicons/favicon-48.png" />
    <link rel="shortcut icon" type="image/png" sizes="64x64" href="/assets/images/favicons/favicon-64.png" />
    <link rel="shortcut icon" type="image/png" sizes="96x96" href="/assets/images/favicons/favicon-96.png" />
    <link rel="shortcut icon" type="image/png" sizes="196x196" href="/assets/images/favicons/favicon-196.png" />

    <meta name="msapplication-TileColor" content="#E45357">
    <meta name="msapplication-TileImage" content="/assets/images/favicons/favicon-144.png" />

    <meta name="application-name" content="LeagueRepublic">
    <meta name="msapplication-tooltip" content="LeagueRepublic">
    <meta name="msapplication-config" content="/assets/images/favicons/browserconfig.xml">
    <!--  Favicons END -->

    <title>Homepage</title>
    <meta name="description" content="Easily manage your league: fixture generator, results, statistics, players and get a professional website." />
    <meta name="keywords" content="league management software,sports management software,sports organiser,youth sports website builder,best sports website design, league scheduler,fixture generator" />
    <meta name="robots" content="Index,Follow" />
    <link rel="canonical" href="{{ env('APP_URL', 'https://baminto.io') }}" />
    <link rel="stylesheet" type="text/css" href="{{ __('/css/page/style.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>

    <!-- JS END -->
    <link rel="alternate" hreflang="en-US" href="https://us.leaguerepublic.com/index.html" />
    <link rel="alternate" hreflang="vi" href="https://vi.leaguerepublic.com/index.html" />
    <link rel="alternate" hreflang="x-default" href="https://www.leaguerepublic.com/index.html" />

</head>

<body>
    <header style="background: #001e28">
        <div class="top-nav">
            <ul class="container">

            </ul>
        </div>
        <nav class="container">
            <a href="/index.html"><img src="/assets/images/lr-logo/logo.svg" alt="LeagueRepublic" width="225" height="52"></a>
            <button id="toggle-menu" onclick="toggleMobileMenu()"></button>
            <ul id="menu">
                <li class="menu">{{__('Giải đấu')}}
                    <ul>
                        <li>
                            <a href="{{route('list.tour')}}">
                                {{__('Danh sách giải đấu')}}
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="menu">Features
                    <ul>
                        <li><a href="/features/scheduling.html">League Scheduler</a></li>
                        <li><a href="/features/results-and-statistics.html">Results & Statistics</a></li>
                        <li><a href="/features/team-and-player-registration.html">Team & Player Registration</a></li>
                        <li><a href="/features/site-builder.html">Site Builder</a></li>
                        <li><a href="/features/league-website-integration.html">Website Integration</a></li>
                    </ul>
                </li>
                <li class="menu">
                    <span>EN</span>
                    <ul >
                        <li>
                            <a class="" href="https://us.leaguerepublic.com/">
                                English (US)
                            </a>
                        </li>

                        <li>
                            <a class="" href="https://vi.leaguerepublic.com/">
                                Tiếng Việt
                            </a>
                        </li>

                    </ul>
                </li>

                <li><a href="{{ route('login') }}" class="button white">{{ __('Đăng nhập') }}</a></li>
                <li><a style="color:white;" href="{{ route('register_user') }}" class="button ">{{ __('Đăng kí') }}</a></li>
            </ul>
        </nav>
    </header>
    <div class="league" style="background: #eee; border-radius: 10px; margin-top: -25px;">
        @yield('content')
        @include('page.footer')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/common.min.1.3.js"></script>
    <script src="{{ asset('js/vendors/countUp/countUp.js') }}"></script>
    @yield('js')


</body>

</html>
