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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
        clear: both;
        display: block;
        font-weight: 400;
        line-height: 1.428571429;
        padding: 10px;
        white-space: nowrap;
        font-size: 16px !important;

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

    .nav-link {
        color: white;
        text-decoration: none;
        padding: 10px;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .dropdown-content a {
        color: black !important;
        padding: 10px;
        text-decoration: none;
        display: block;
        clear: both;
        font-weight: 400 !important;
        line-height: 1.428571429;
        white-space: nowrap;
        font-size: 16px !important;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .nav-item:hover .dropdown-content {
        display: block;
    }

    /* Mobile menu */
    @media (max-width: 768px) {
        .nav-bar {
            flex-direction: column;
            align-items: center;
        }
        .nav-item {
            width: 100%;
        }
        .dropdown-content {
            position: static;
            width: 100%;
        }
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

        <nav class="navbar navbar-expand-lg sticky-top navbar-light m-0 shadow-sm" >
            <div class="container">
                <a href="{{ route('home') }}"><img  class="logo-image" src="{{ asset('/images/logo-no-background.png') }}" alt="{{ env('APP_NAME', 'Badminton.io') }}" width="100" height="100"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto ">
                        <div class="nav-item">
                            <a class="mx-2 nav-link">{{__('LEAGUE')}} ▼</a>
                            <div class="dropdown-content">
                                <a href="{{route('list.league')}}">{{__('List League')}}</a>
                                <a href="{{route('league.createTour')}}">{{__('Create League')}}</a>
                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="mx-2 nav-link">{{__('GROUP')}} ▼</a>
                            <div class="dropdown-content">
                                <a href="{{route('list.group')}}">{{__('List Group')}}</a>
                                <a href="{{route('group.createGroup')}}">{{__('Create Group')}}</a>
                            </div>
                        </div>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link mx-2 text-uppercase" href="{{ route('ranking') }}">{{__('RANKING')}}</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('news') }}">{{__('NEWS')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('match') }}">{{__('MATCH CENTER')}}</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link mx-2 text-uppercase exchange" href="{{route('exchange.home')}}" target="_blank">{{__('EXCHANGE ')}}</a>--}}
{{--                        </li>--}}

                        @if(Auth::check() && Auth::user()->role =="admin" )
                        <li class="nav-item" style="background: #312f2f">
                            <a class="nav-link mx-2 text-uppercase" href="{{ route('dashboard') }}">{{__('DASHBOARD')}}</a>
                        </li>
                        @endif
                        @if(Auth::check())
                            <div class="nav-item">
                                <a class="mx-2 nav-link"> <span>
                                        @if (strpos(Auth::user()->profile_photo_path, 'http') > 0)
                                            <img class="avatar-user" width="25" height="25" src="{{  asset(Auth::user()->profile_photo_path ?? '/images/no-image.png') }}">
                                        @else
                                            <img class="avatar-user" width="25" height="25" src="{{ asset( Auth::user()->profile_photo_path ?? '/images/no-image.png') }}">
                                        @endif
                                </span>
                                    {{ Auth::user()->name }}
                                     ▼</a>
                                <div class="dropdown-content">
                                    <a href="{{ route('profile.edit') }}">{{__('My profile')}}</a>
                                    <a href="{{ route('my.league') }}">{{__('My league')}}</a>
                                    <a href="{{ route('my.group') }}">{{__('My group')}}</a>
                                    <a href="{{ route('logout') }}">{{__('Logout')}}</a>
                                </div>
                            </div>
                        @else
                            <li><a href="{{ route('login') }}" class="button white ">{{ __('Log In') }}</a></li>
                            <li><a href="{{ route('register_user') }}" class="button btn-register">{{ __('Register') }}</a></li>
                        @endif

                        @if(Auth::check())
                            @php
                                $count = 0;
                                $listNotification = Cache::get('notification_next_match_' . Auth::user()->id);
                                if(isset($listNotification))
                                {
                                   foreach($listNotification as $notification) {
                                    if($notification->status == 0) {
                                    $count++;
                                        }
                                    }
                                }

                            @endphp
                            <li class="li-notification">
                                <a class="notification" id="notification">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge">{{ $count }}</span>
                                </a>
                                @if(count($dataUser->league ?? []) )
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
    <div data-wpr-lazyrender="1" class="wrapper-footer">
        <div class="wrapper-copyright">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 text-center mt-4">
                        <img width="100" height="auto" src="{{asset('/images/MOBOBOM.png')}}" data-lazy-src="" data-ll-status="loaded" class="entered lazyloaded"><noscript><img width="198" height="41" src="//vnitourist.com/wp-content/uploads/2024/06/logo-modobom-resize.png"></noscript>
                        <span style="margin-left: 10px;    text-transform: uppercase; margin-bottom: 12px;">badminton.com is a brand in the key project <a href="https://vnisocial.com/" style="margin-left: 3px"> VNISOCIAL ECOSYSTEM</a> of international company <a href="https://modobom.com/" style="margin-left: 3px"> Modobom</a>.</span>
                    </div> <!-- col-sm-3 -->
                </div>
            </div>
        </div>
    </div>
    <div class="" style="background: #222; text-transform: uppercase; margin-top: 10px">
        <footer class="container py-5"  >
            <div class="row">
                <div class="color-white col-md-3 mb-3">
                    <h4 class="color-white">{{ __('Criteria') }}</h4>
                    <ul class="nav flex-column footer-p">
                        <p>{{ __('Efficiency and ease-of-use are our mission, simplifying the process of running a sports league.') }}</p>
                        <p>{{ __('Badminton.io is available to all at no cost. Additionally, we offer premium plans that include additional functionality.') }}</p>
                    </ul>
                </div>

                <div class="col-md-3 mb-3 color-white">
                    <h4 class="color-white">{{ __('About') }}</h4>
                    <ul class="nav-a">
                        <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3 color-white">
                    <h4 class="color-white">{{ __('Features') }}</h4>
                    <ul class="nav-a " style="display: flex; flex-direction: column;">
                        <li><a href="{{ route('list.league') }}">{{ __('League') }}</a></li>
                        <li><a href="">{{ __('Shop') }}</a></li>
                        <li><a href="{{ route('list.group') }}">{{ __('Group') }}</a></li>
                        <li><a href="{{ route('news') }}">{{ __('News') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 color-white">
                    <form>
                        <h4 class="h3 color-white">{{ __('Badminton.io') }}</h4>
                        <p >
                            <small class="nav-a">
                                <a href="{{ route('term.and.conditions') }}">{{ __('Terms & Conditions') }}</a>
                                <br>
                                <a href="{{ route('privacy') }}">{{ __('Privacy') }}</a>
                                <br>
                                <a href="{{ route('home')}}">{{ __('Badminton.io') }}</a>
                            </small>
                        </p>
                        <ul class="social">
                            <li><a href="{{route('home')}}"><img src="{{ asset('/images/logo-no-background.png') }}"  width="70" height="70"></a></li>
                        </ul>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top color-white  footer-p">
                <p>{{__('© 2023 Company, Inc. All rights reserved.The content of this website is the property of Badominton.io or used under licence by Badominton.io .
                No part may be copied, republished, stored, or otherwise republished or transmitted without the prior written permission of Badominton . For further information, please refer to our')}}</p>
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
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
    <script>
        $(document).ready(function() {
            @if (session('success'))
            toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
            toastr.error("{{ session('error') }}");
            @endif

            @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
            @endif

            @if (session('info'))
            toastr.info("{{ session('info') }}");
            @endif
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", // Vị trí hiển thị
            "timeOut": "5000"
        };
    </script>


    <script>
        document.querySelectorAll('.open-new-tab').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                window.open(this.href, '_blank');
            });
        });
    </script>
    @yield('js')
</body>

</html>
