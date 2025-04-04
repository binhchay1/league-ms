@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    @if(Route::current()->getName() == 'leagueResult.bracket')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}"/>
    @endif
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color:#dc3545 !important; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .card-title {
        color: black !important;
    }

    p.display {
        font-size: 15px !important;
    }

    .btn-custom {
        background-color: #dc3545 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px 15px!important;
        border: none;
    }

    .btn-custom:hover {
        background-color: #ff4b2b !important;
    }

    /* Tùy chỉnh dropdown */
    .btn-dropdown {
        background: white;
        border: 2px solid #ff4b2b !important;
        border-radius: 10px;
        color: #dc3545;
        padding: 10px 12px !important;
    }

    .btn-dropdown:hover {
        background: #f1f1f1 !important;
    }
</style>
@section('content')
    <div id="page" class="hfeed site">
        <div class=" results">
            <div class="wrapper-results">
                <div class="container" >
                    <div class="box-results-tournament">
                        <div>
                            <div class="logo-left">
                                <img src="{{ asset($leagueInfor->images ?? '/images/logo-no-background.png') }}"
                                     class="show-image-league" alt="logo">
                            </div>
                            <div class="" id="info-league">
                                <h2>{{ $leagueInfor->name }}</h2>
                                <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                                <p class="display">
                                    <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                                </p>
                                <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                ?>
                                <p class="display">
                                    <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                                </p>
                                <p class="display">
                                    <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('leagueResult.bracket',$leagueInfor['slug']) }}">
                                <button class="btn btn-custom">{{ __('Bracket') }} </button>
                            </a>
                            <a href="{{ route('leagueResult.info',$leagueInfor['slug']) }}">
                                <button class="btn btn-custom">{{ __('Result') }} </button>
                            </a>
                            <a href="{{ route('leagueSchedule.info',$leagueInfor['slug']) }}">
                                <button class="btn btn-custom">{{ __('Schedule') }} </button>
                            </a>
                            <a href="{{ route('leaguePlayer.info',$leagueInfor['slug']) }}">
                                <button class="btn btn-custom">{{ __('Player') }} </button>
                            </a>
                            <!-- Dropdown -->
                        @if(Auth::user()->id == $leagueInfor->owner_id)
                            <!-- Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('Setting') }} <i class="bi bi-gear"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('my.infoMyLeague',$leagueInfor['slug'])}}">{{'League Information'}}</a></li>
                                        <li><a class="dropdown-item" href="#">{{'Delete League'}}</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>

                <?php $current_date = strtotime(date("Y-m-d"));
                $start_date = strtotime($leagueInfor->start_date);
                $end_date_register = strtotime($leagueInfor->end_date_register);
                $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
                $format_register_date = $leagueInfor->end_date_register;
                ?>

                @if($current_date < $start_date && $current_date < $end_date_register)
                    <div class="container col-md-12">
                        <div class="league-banner--enroll flex flex-jus-center flex-align-center flex-column gradient">
                            <h4 class="text-center mb-10 text-white " style="opacity:1">
                                <span class="text-warning hidden" id="deadline-date">09/26/2024</span>
                                <span class="text-warning hidden" id="extend-time">23:59:59</span>
                                Giải cho phép đăng ký trực tuyến đến hết ngày <span class="text-warning"
                                                                                    style="color:#efff00">{{ $get_date_register }}</span>
                            </h4>
                            <div id="clockdiv">
                                <div>
                                    <span id="data_day" class="days"></span>
                                    <div class="smalltext">{{__('Days')}}</div>
                                </div>
                                <div>
                                    <span id="data_hours"  class="hours"></span>
                                    <div class="smalltext">{{__('hours')}}</div>
                                </div>
                                <div>
                                    <span id="data_minutes"  class="minutes"></span>
                                    <div class="smalltext">{{__('Minutes')}}</div>
                                </div>
                                <div>
                                    <span id="data_seconds"  class="seconds"></span>
                                    <div class="smalltext">{{__('Seconds')}}</div>
                                </div>
                            </div>
                            <div class="mb-20 text-center">
                                <button type="button" id="btn-register" class="btn btn-primary " data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                    {{ __('Register League') }}
                                </button>
                            </div>
                            <div class="competitor-members mb-20">
                                <div class="flex flex-jus-center">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="container wrapper-content-results" style="padding: 0px; margin-top: 18px;">

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('Register League') }}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                @if(Auth::check())
                                    <div class="modal-body">
                                        <div class="leagueInfo">
                                            <div class="tab-content" id="tab-content">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <img
                                                            class="image-modal-data lazy truncated initial loaded white center"
                                                            src="{{$leagueInfor->images}}">
                                                    </div>
                                                    <div class="col-lg-8 league-data">
                                                        <h4 class="">{{ $leagueInfor->name }}</h4>
                                                        {{ $leagueInfor->type_of_league }}
                                                        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                        ?>
                                                        <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                                        <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                                        <p class="">{{ __('PRIZE MONEY USD ') }}${{ $leagueInfor->money
                                                            }}</p>
                                                    </div>
                                                    <div class="checkbox" align="center">
                                                        <input id="check" name="checkbox" type="checkbox">
                                                        <label
                                                            for="checkbox">{{ __('I have read and agree to the tournament rules') }}</label>
                                                    </div>
                                                    <div align="center">
                                                        <button id="open-tab1" class="btn btn-success"
                                                                disabled>{{ __('Register ') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infor" style="display: none">
                                            <h1 align="center">{{__('Confirm Information')}}</h1>
                                            <form id="formAccountSettings" method="POST"
                                                  action="{{route('registerLeague')}}" enctype="multipart/form-data">
                                                @csrf()
                                                <div class="tab-content rankings-content_tabpanel">
                                                    <div class="item-active">
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                                               class="rankings-table">
                                                            <thead align="center">
                                                            <tr>
                                                                <th style="text-align: center" class="col-rank"
                                                                    align="center">{{ __('Name') }}</th>
                                                                <th style="text-align: center" class="col-country"
                                                                    align="center">{{ __('Image') }}</th>
                                                                <th style="text-align: center"
                                                                    class="col-player">{{ __('Age') }}</th>
                                                                <th style="text-align: center" class="col-points"
                                                                    align="center">{{ __('Address') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tr class="row-top-eight">
                                                                <input type="hidden" name="league_id" id=""
                                                                       value="{{ $leagueInfor->id }}">
                                                                <input type="hidden" name="end_date_register" id=""
                                                                       value="{{ $leagueInfor->end_date_register }}">
                                                                <input type="hidden" name="start_date" id=""
                                                                       value="{{ $leagueInfor->start_date }}">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="status" value="0">
                                                                <td align="center">
                                                                    {{ Auth::user()->name }}
                                                                </td>
                                                                <td align="center">
                                                                    <div class="country">
                                                                        <img width="48"
                                                                             src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png') }}"
                                                                             title="Japan" class="flag image-user">
                                                                    </div>
                                                                </td>

                                                                <td align="center" class="data-player">
                                                                    <div class="player">
                                                                        {{ Auth::user()->age }}
                                                                    </div>
                                                                </td>
                                                                <td class="data-points" align="center">
                                                                    {{ Auth::user()->address }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button type="submit"
                                                            class="btn btn-success me-2">{{ __('Send Information') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div align="center">
                                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                        <h4 class="mt-4 login-redriect">{{ __('Please')}}
                                            <a
                                                href="{{ route('login') }}">{{__('login')}}</a>
                                            {{__('before registering for the tournament!') }}
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="content-results">
                        <div class="item-results">
                            @if(Route::current()->getName() == 'leaguePlayer.info')
                                <div>
                                    @include('page.league.detail.player')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueResult.info')
                                <div>
                                    @include('page.league.detail.result')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueSchedule.info')
                                <div>
                                    @include('page.league.detail.schedule')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueResult.bracket')
                                @include('page.league.detail.bracket')
                            @else
                                <div class="item draws" style="display:block;">
                                    @include('page.league.detail.schedule')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/league.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $("[name='recordLeague']").on("change", function () {
            let edit_id = $(this).val();
            window.location.href = window.location.origin + '/league/' + edit_id;
        });
    </script>
    @if(Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr.success("{{Session::get('message')}}", 'Success!', {
                timeout: 12000
            });
        </script>
    @endif


    <script>
        // Set the date we're counting down to
        var register_date = '<?php echo $format_register_date ?>';
        var countDownDate = new Date(register_date).getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Display the result in the element with id="demo"
            document.getElementById("data_day").innerHTML = days;
            document.getElementById("data_hours").innerHTML = hours;
            document.getElementById("data_minutes").innerHTML = minutes;
            document.getElementById("data_seconds").innerHTML = seconds;
            //  + "d " + hours + "h "
            // + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection
