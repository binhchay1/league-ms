<!DOCTYPE html>
<html lang="vi" itemscope itemtype="http://schema.org/Article">
<style>
    a:link { text-decoration: none; }
</style>
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

    <title>
        @yield('title') - badominton.io
    </title>
    <meta name="description" content="Easily manage your league: fixture generator, results, statistics, players and get a professional website." />
    <meta name="keywords" content="league management software,sports management software,sports organiser,youth sports website builder,best sports website design, league scheduler,fixture generator" />
    <meta name="robots" content="Index,Follow" />
    <link rel="canonical" href="{{ env('APP_URL', 'https://baminto.io') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/page/style.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>

    <!-- JS END -->
    <link rel="alternate" hreflang="en-US" href="https://us.leaguerepublic.com/index.html" />
    <link rel="alternate" hreflang="vi" href="https://vi.leaguerepublic.com/index.html" />
    <link rel="alternate" hreflang="x-default" href="https://www.leaguerepublic.com/index.html" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body>
    <header style="background: #001e28; height: 190px">
        <div class="top-nav">
            <ul class="container">

            </ul>
        </div>
        <nav class="container">
            <a href="{{route('home')}}"><img src="/images/logo.png" alt="LeagueRepublic" style="width: 120px; border-radius: 9px"></a>
            <button id="toggle-menu" onclick="toggleMobileMenu()"></button>
            <ul id="menu">
                <li class="menu">{{ __('Giải đấu') }}
                    <ul>
                        <li>
                            <a href="{{route('list.tour')}}">
                                {{ __('Danh sách giải đấu') }}
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
                    <ul>
                        <li>
                            <a class="" href="{{ route('app.setLocale', ['locale' => 'en']) }}">
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

                <li><a href="{{ route('login') }}" class="button white">{{ __('Đăng nhập') }}</a></li>
                <li><a style="color:white;" href="{{ route('register_user') }}" class="button ">{{ __('Đăng kí') }}</a></li>
            </ul>
        </nav>
    </header>
    <div class="league" style="background: #eee; border-radius: 10px;">
        <div class="container"style="padding: 10px;">
            <main >
                @yield('content')
            </main>
        </div>
        <div style="background: white">
            @include('page.footer')
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/common.min.1.3.js"></script>
    <script src="{{ asset('js/vendors/countUp/countUp.js') }}"></script>
    @yield('js')


</body>

</html>
