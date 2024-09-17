<html lang="en" class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">

    <meta name="msapplication-TileColor" content="#E45357">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/images/favicons/favicon-144.png') }}">
    <meta name="application-name" content="{{ env('APP_NAME', 'Badminton.io') }}">
    <meta name="msapplication-tooltip" content="{{ env('APP_NAME', 'Badminton.io') }}">
    <meta name="description" content="{{ __('Run your badminton league for free, badminton scheduling and online results and statistics displayed on your free website.') }}">
    <meta name="keywords" content="{{ __('badminton scheduling,badminton scheduler,badminton league,badminton league website,manage badminton league online,run badminton league online') }}">
    <meta name="robots" content="Index, Follow">

    <title>@yield('title')</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cambria:wght@300;400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="canonical" href="https://badminton.io">
    <link rel="alternate" hreflang="en-US" href="https://badminton.io">
    <link rel="alternate" hreflang="af" href="https://badminton.io">
    <link rel="alternate" hreflang="x-default" href="https://badminton.io">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo-no-background.png') }}">

    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/content/league.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/page/homepage.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
</head>

<style>
    .navbar-toggler {
        background: white !important;
    }

    .navbar-nav .nav-item a:hover {
        color: lightgrey;
    }

    .navbar-nav .nav-item a {
        color: white;
        font-size: 17px;
    }

    .dropdown-menu .dropdown-item {
        color: black !important;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #e3e3e3 !important;
    }

    .btn-register {
        margin-left: 5px !important;
    }

    .navbar-nav .nav-link.show {
        color: white!important;
    }



</style>
<body>
    <header style="background-color: #222">
        <div class="top-nav">
            <ul class="container">
                <li class="menu">
                    <span>en</span>
                    <ul>
                        <li>
                            <a class="{{ Session::get('locale') == 'en' ? 'active' : ''}}" href="{{ route('app.setLocale', ['locale' => 'en']) }}">
                                {{ __('English') }}
                            </a>
                        </li>

                        <li>
                            <a class="{{ Session::get('locale') == 'vi' ? 'active' : ''}}" href="{{ route('app.setLocale', ['locale' => 'vi']) }}">
                                {{ __('Vietnamese') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
{{--        <nav class="container">--}}
{{--            <div class="navigation-menu__overlay" onclick="toggleMenuClicked()"></div>--}}

{{--            @if(Route::is('home') )--}}
{{--            <button type="button" class="hamburger-menu" onclick="toggleMenuClicked()">--}}
{{--                <span class="material-icons" id="open-icon">menu</span>--}}
{{--                <span class="material-icons" id="close-icon">close</span>--}}
{{--            </button>--}}
{{--            @else--}}
{{--            <button type="button" class="hamburger-menu" onclick="window.history.go(-1); return false;">--}}
{{--                <span class="fa fa-arrow-left" id="open-icon" style="color: white"></span>--}}
{{--            </button>--}}
{{--            @endif--}}

{{--            <a href="{{ route('home') }}"><img  class="logo-image" src="{{ asset('/images/logo-no-background.png') }}" alt="{{ env('APP_NAME', 'Badminton.io') }}" width="100" height="100"></a>--}}


{{--            <ul class="menu-main navigation-menu__labels">--}}
{{--                <li class="pt-2"><a href="{{ route('list.league') }}">{{ __('LEAGUE') }}</a></li>--}}
{{--                <li class="pt-2"><a href="{{ route('list.group') }}">{{ __('GROUP') }}</a></li>--}}
{{--                <li class="pt-2"><a href="{{ route('ranking') }}">{{ __('RANKING') }}</a></li>--}}
{{--                <li class="pt-2"><a href="{{ route('news') }}">{{ __('NEWS') }}</a></li>--}}
{{--                <li class="pt-2"><a href="{{ route('match') }}">{{ __('MATCH CENTER') }}</a></li>--}}
{{--                @if(Auth::check())--}}
{{--                <li class="pt-2"><a href="{{ route('league.create') }}">{{ __('CREATE LEAGUE') }}</a></li>--}}
{{--                @endif--}}
{{--                <li id="search">--}}
{{--                    <form id="search-league" action="{{ route('search') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <div onclick="openSearch()">--}}
{{--                            <input type="search" name="search" placeholder="{{ __('Search leagues') }}...">--}}
{{--                            <button type="button">--}}
{{--                                <img src="{{ asset('/svg/icon-search.svg') }}" alt="{{ __('Search') }}" title="{{ __('Search') }}" width="15" height="15">--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </li>--}}
{{--                <div class="nav-group">--}}
{{--                    @if(Auth::check())--}}
{{--                    <li class="menu">--}}
{{--                        <span>--}}
{{--                            @if (strpos(Auth::user()->profile_photo_path, 'http') > 0)--}}
{{--                            <img class="avatar-user" width="40" height="40" src="{{ Auth::user()->profile_photo_path ?? asset('/images/no-image.png') }}">--}}
{{--                            @else--}}
{{--                            <img class="avatar-user" width="40" height="40" src="{{ asset( Auth::user()->profile_photo_path ?? '/images/no-image.png') }}">--}}
{{--                            @endif--}}
{{--                        </span>--}}
{{--                        <ul class="submenu">--}}
{{--                            <li>--}}
{{--                                <a class="account" href="{{ route('profile.edit') }}">--}}
{{--                                    {{ __('Profile') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <a class="account" href="{{ route('my.group') }}">--}}
{{--                                    {{ __('My group') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li><a class="dropdown-item account" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt mr-2 "></i>{{ __('Logout') }}</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    @else--}}
{{--                    <li><a href="{{ route('login') }}" class="button white ">{{ __('Log In') }}</a></li>--}}
{{--                    <li><a href="{{ route('register_user') }}" class="button btn-register">{{ __('Register') }}</a></li>--}}
{{--                    @endif--}}

{{--                    @if(Auth::check())--}}
{{--                    @php--}}
{{--                    $count = 0;--}}
{{--                    $listNotification = Cache::get('notification_next_match_' . Auth::user()->id);--}}
{{--                    foreach($listNotification as $notification) {--}}
{{--                    if($notification->status == 0) {--}}
{{--                    $count++;--}}
{{--                    }--}}
{{--                    }--}}
{{--                    @endphp--}}
{{--                    <li class="li-notification">--}}
{{--                        <a class="notification" id="notification">--}}
{{--                            <i class="fas fa-bell"></i>--}}
{{--                            <span class="badge">{{ $count }}</span>--}}
{{--                        </a>--}}
{{--                        @if(count($listNotification) > 0)--}}
{{--                        <ul class="dropdown-notification" id="dropdown-notification">--}}
{{--                            @foreach($listNotification as $notification)--}}
{{--                            @if($notification->status == 0)--}}
{{--                            <li class="noti-unread"><a>{{ $notification->content }}</a></li>--}}
{{--                            @else--}}
{{--                            <li><a>{{ $notification->content }}</a></li>--}}
{{--                            @endif--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        @else--}}
{{--                        <ul class="dropdown-notification" id="dropdown-notification">--}}
{{--                            <li><a>{{ __('Empty Notification') }}</a></li>--}}
{{--                        </ul>--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                </div>--}}
{{--                @endif--}}

{{--            </ul>--}}
{{--        </nav>--}}

        <nav class="navbar navbar-expand-lg sticky-top navbar-light p-3 shadow-sm" >
            <div class="container">
                <a href="{{ route('home') }}"><img  class="logo-image" src="{{ asset('/images/logo-no-background.png') }}" alt="{{ env('APP_NAME', 'Badminton.io') }}" width="100" height="100"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
{{--                    <div class="ms-auto d-none d-lg-block">--}}
{{--                        <div class="input-group">--}}
{{--                            <span class="border-warning input-group-text bg-warning text-white"><i class="fa-solid fa-magnifying-glass"></i></span>--}}
{{--                            <input type="text" class="form-control border-warning" style="color:#7a7a7a">--}}
{{--                            <button class="btn btn-warning text-white">Search</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <ul class="navbar-nav ms-auto ">
                        <div class="nav-item dropdown">
                            <a class="nav-link mx-2 dropdown-toggle text-uppercase" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{__('LEAGUE')}}
                                <i class="fa fa-sort-down"></i>

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{route('list.league')}}">{{__('List League')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('league.create')}}">{{__('Create League')}}</a></li>
                            </ul>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('ranking') }}">{{__('RANKING')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('news') }}">{{__('NEWS')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('match') }}">{{__('MATCH CENTER')}}</a>
                        </li>
                        <div class="nav-item dropdown">
                            <a class="nav-link mx-2 dropdown-toggle text-uppercase" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{__('GROUP')}}
                                <i class="fa fa-sort-down"></i>

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{route('list.group')}}">{{__('List Group')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('group.create')}}">{{__('Create Group')}}</a></li>
                            </ul>
                        </div>
                        @if(Auth::check() && Auth::user()->role =="admin" )
                        <li class="nav-item" style="background: #312f2f">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('dashboard') }}">{{__('DASHBOARD')}}</a>
                        </li>
                        @endif
                        @if(Auth::check())
                            <div class="nav-item dropdown" style="margin-top: -1px">

                                <a class="nav-link mx-2 dropdown-toggle text-uppercase " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <span>
                                        @if (strpos(Auth::user()->profile_photo_path, 'http') > 0)
                                          <img class="avatar-user" width="25" height="25" src="{{ Auth::user()->profile_photo_path ?? asset('/images/no-image.png') }}">
                                      @else
                                          <img class="avatar-user" width="25" height="25" src="{{ asset( Auth::user()->profile_photo_path ?? '/images/no-image.png') }}">
                                      @endif
                                </span>
                                    {{ Auth::user()->name }}
                                    <i class="fa fa-sort-down"></i>

                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item"href="{{ route('profile.edit') }}">{{__('My profile')}}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('my.league') }}">{{__('My league')}}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('my.group') }}">{{__('My group')}}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">{{__('Logout')}}</a></li>
                                </ul>
                            </div>
                        @else
                            <li><a href="{{ route('login') }}" class="button white ">{{ __('Log In') }}</a></li>
                            <li><a href="{{ route('register_user') }}" class="button btn-register">{{ __('Register') }}</a></li>
                        @endif

                        @if(Auth::check())
                            @php
                                $count = 0;
                                $listNotification = Cache::get('notification_next_match_' . Auth::user()->id);
                                foreach($listNotification as $notification) {
                                if($notification->status == 0) {
                                $count++;
                                }
                                }
                            @endphp
                            <li class="li-notification">
                                <a class="notification" id="notification">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge">{{ $count }}</span>
                                </a>
                                @if(count($listNotification) > 0)
                                    <ul class="dropdown-notification" id="dropdown-notification">
                                        @foreach($listNotification as $notification)
                                            @if($notification->status == 0)
                                                <li class="noti-unread"><a>{{ $notification->content }}</a></li>
                                            @else
                                                <li><a>{{ $notification->content }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="dropdown-notification" id="dropdown-notification">
                                        <li><a>{{ __('Empty Notification') }}</a></li>
                                    </ul>
                                @endif
                            </li>
                        @endif


                </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <div class="" style="background: #222; ">
        <footer class="container py-5"  >
            <div class="row">
                <div class="color-white col-md-3 mb-3">
                    <h4 class="color-white">{{ __('Criteria') }}</h4>
                    <ul class="nav flex-column">
                        <p>{{ __('Efficiency and ease-of-use are our mission, simplifying the process of running a sports league.') }}</p>
                        <p>{{ env('APP_NAME', 'Badminton.io') }} {{ __('is available to all at no cost. Additionally, we offer premium plans that include additional functionality.') }}</p>
                    </ul>
                </div>

                <div class="col-md-3 mb-3 color-white">
                    <h4 class="color-white">{{ __('About') }}</h4>
                    <ul class="nav">
                        <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3">
                    <h4 class="color-white">{{ __('Features') }}</h4>
                    <ul class="nav" style="display: flex; flex-direction: column;">
                        <li><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                        <li><a href="">{{ __('Shop') }}</a></li>
                        <li><a href="{{ route('list.group') }}">{{ __('Group') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 ">
                    <form>
                        <h4 class="h3 color-white">{{ env('APP_NAME', 'Badminton.io') }}</h4>
                        <p>
                            <small>
                                <a href="{{ route('term.and.conditions') }}">{{ __('Terms & Conditions') }}</a>,
                                <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                                <br>
                                <a href="{{ route('home')}}">{{ env('APP_NAME', 'Badminton.io') }}</a>
                            </small>
                        </p>
                        <ul class="social">
                            <li><a href=""><img src="{{ asset('/svg/icon-linkedin.svg') }}" alt="{{ __('LinkedIn') }}" width="30" height="31"></a></li>
                            <li><a href=""><img src="{{ asset('/svg/icon-twitter.svg') }}" alt="{{ __('Twitter') }}" width="30" height="31"></a></li>
                            <li><a href=""><img src="{{ asset('/svg/icon-facebook.svg') }}" alt="{{ __('Facebook') }}" width="30" height="31"></a></li>
                            <li><a href=""><img src="{{ asset('/svg/icon-youtube.svg') }}" alt="{{ __('YouTube') }}" width="30" height="31"></a></li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top color-white">
                <p>{{__('© 2023 Company, Inc. All rights reserved.')}}</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="{{ asset('/js/page/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/page/common.min.js') }}"></script>
    <script>
        $('.open-btn').click(function() {
            $('nav.container').toggleClass('active');
        })

        const toggleMenuClicked = () => {
            const body = document.body;
            const openIcon = document.getElementById("open-icon");
            const closeIcon = document.getElementById("close-icon");

            body.classList.toggle("open");

            if (body.classList.contains("open")) {
                openIcon.style.display = "none";
                closeIcon.style.display = "flex";
            } else {
                openIcon.style.display = "flex";
                closeIcon.style.display = "none";
            }
        };
    </script>
    <script>
        $(document).ready(() => {
            let isMenuAlreadyOpen = false;
            $('#open-icon').on('click', () => {
                $('body').css("overflow", isMenuAlreadyOpen ? "auto" : "hidden")
                isMenuAlreadyOpen = !isMenuAlreadyOpen
            })
        })
    </script>

    @yield('js')
</body>

</html>
