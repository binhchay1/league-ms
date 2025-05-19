@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/show.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@if(Route::current()->getName() == 'leagueResult.bracket')
<link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}" />
@endif
@endsection

@section('content')
<?php
$currentDate = strtotime(date("Y-m-d"));
$startDate = strtotime(date($leagueInfor->start_date));
$end_date_register = strtotime($leagueInfor->end_date_register);
$get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
$format_register_date = $leagueInfor->end_date_register;
?>
@if ($hasEnded && $champion )
<div id="winner-popup" style="margin-top: -30px" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 text-white">
    {{-- Nút đóng (góc trên phải màn hình) --}}
    <button onclick="closeWinnerPopup()" id="popup-close" class="absolute top-4 right-6 text-white text-3xl hover:text-red-500 z-50">
        &times;
    </button>
    {{-- Nội dung popup --}}
    <div class="relative z-10 text-center bg-gray-900 bg-opacity-80 px-6 py-8 rounded-lg shadow-lg">
        <h2 class="text-2xl text-yellow-400 font-bold mb-4">{{'Congratulations to the defending champions of the tournament!'}}</h2>
        <img src="{{ asset('/images/player-team.jpg') }}" class="mx-auto w-32 h-32 rounded-full border-4 border-yellow-500 mb-4" alt="Winner Avatar">
        <h4 class="text-xxl text-white font-semibold">
            {{ $champion->user->name ?? '---' }}
            @if($champion->user->partner)
            @if($champion->league && $champion->league->type_of_league == "doubles")
            + {{ $champion->user->partner->name }}
            @endif
            @endif
        </h4>

        {{-- Canvas pháo hoa --}}
        <canvas id="canvas"></canvas>
    </div>
</div>
@endif
<div id="page" class="hfeed site" style="{{ ($hasEnded && $champion) ? 'display: none;' : '' }}; margin-top: -20px">
    <div class=" results ">
        <div class="wrapper-results" id="league-detail">
            <div class="" style="background: #707787;padding: 10px; margin-top: -20px; color: white">
                <div class="container d-flex mt-4">
                    <div class=" logo-left">
                        <img src="{{ asset($leagueInfor->images ?? '/images/logo-no-background.png') }}"
                            class="show-image-league" alt="logo">
                    </div>
                    <div class="" id="info-league">
                        <h2 class="p-0">{{ $leagueInfor->name }}</h2>
                        <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . " VND" ?> || {{$leagueInfor->type_of_league}} || {{$leagueInfor->location}}</p>
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
                <div class="container d-flex gap-2 mt-4">
                    @if(now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                        <a href="{{ route('showGeneralNews.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('showGeneralNews.info') ? 'active' : '' }}">
                            {{ __('News') }}
                        </a>
                        <a href="{{ route('leagueResult.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('leagueResult.info') ? 'active' : '' }}">
                            {{ __('Result') }}
                        </a>
                        <a href="{{ route('showRank.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('showRank.info') ? 'active' : '' }}">
                            {{ __('Rank') }}
                        </a>
                    @endif
                    @if( $currentDate < $startDate)
                        <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                            {{ __('Register League') }}
                        </a>

                        <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                            {{ __('List Register') }}
                        </a>
                    @endif
                    @if($leagueInfor->format_of_league == "knockout")
                        <a href="{{ route('leagueResult.bracket', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('leagueResult.bracket') ? 'active' : '' }}">
                            {{ __('Bracket') }}
                        </a>
                    @endif

                    <a href="{{ route('leagueSchedule.info', $leagueInfor['slug']) }}"
                       class="btn-custom {{ request()->routeIs('leagueSchedule.info') ? 'active' : '' }}">
                        {{ __('Schedule') }}
                    </a>

                    <a href="{{ route('leaguePlayer.info', $leagueInfor['slug']) }}"
                       class="btn-custom {{ request()->routeIs('leaguePlayer.info') ? 'active' : '' }}">
                        {{ __('Player') }}
                    </a>

                    <a href="{{ route('league.leagueSetting',$leagueInfor['slug']) }}"
                       class="btn-custom {{ request()->routeIs('league.leagueSetting') ? 'active' : '' }}">
                        {{ __('Setting') }}
                    </a>

                    {{--                        @if(Auth::check() && Auth::user()->id == $leagueInfor->owner_id)--}}
                    {{--                        <div class="dropdown">--}}
                    {{--                            <a class="btn-custom dropdown-toggle {{ request()->routeIs('my.infoMyLeague') ? 'active' : '' }}"--}}
                    {{--                                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">--}}
                    {{--                                {{ __('Setting') }} <i class="bi bi-gear"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <ul class="dropdown-menu">--}}
                    {{--                                <li><a class="dropdown-item" href="{{ route('my.infoMyLeague', $leagueInfor['slug']) }}">League Information</a></li>--}}
                    {{--                                <li><a class="dropdown-item" href="#">Delete League</a></li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                        @endif--}}
                </div>
            </div>
            <div class="container wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">{{ __('Register League') }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            @if(Auth::check())
                            <div id="form-register" class="hidden">
                                <div class="infor">
                                    <h1 align="center">{{__('Confirm Information')}}</h1>
                                    <form id="formAccountSettings" method="POST"
                                        action="{{route('registerLeague')}}" enctype="multipart/form-data">
                                        @csrf()
                                        <div class="tab-content rankings-content_tabpanel">
                                            <div class="item">
                                                <table width="100%"
                                                    class="min-w-full border border-gray-300 border-collapse text-sm">
                                                    <thead align="center">
                                                        <tr class="tr-title" style="background: #596377">
                                                            <th style="text-align: center" class="col-rank"
                                                                align="center">{{ __('Name') }}</th>
                                                            <th style="text-align: center" class="col-country"
                                                                align="center">{{ __('Image') }}</th>
                                                            <th style="text-align: center"
                                                                class="col-player">{{ __('Email') }}</th>
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
                                                                {{ Auth::user()->email }}
                                                            </div>
                                                        </td>
                                                        <td class="data-points" align="center">
                                                            {{ Auth::user()->address }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Checkbox -->
                                        <div class="checkbox text-center my-4">
                                            <label for="check">{{ __('You should check your information again before submitting.') }}</label>
                                        </div>

                                        <!-- Button bị disable ban đầu -->
                                        <div class="mt-4 text-center">
                                            <button type="submit" id="submit-reg"
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
                        @elseif(Route::current()->getName() == 'showListRegister.info')
                        <div>
                            @include('page.league.detail.player-register')
                        </div>
                        @elseif(Route::current()->getName() == 'showGeneralNews.info')
                        <div>
                            @include('page.league.detail.news')
                        </div>
                        @elseif(Route::current()->getName() == 'leagueResult.info')
                        <div>
                            @include('page.league.detail.result')
                        </div>
                        @elseif(Route::current()->getName() == 'showRank.info')
                        <div>
                            @include('page.league.detail.rank')
                        </div>
                        @elseif(Route::current()->getName() == 'leagueSchedule.info')
                        <div>
                            @include('page.league.detail.schedule')
                        </div>
                        @elseif(Route::current()->getName() == 'leagueResult.bracket')
                        @include('page.league.detail.bracket')
                        @else
                        <div class="item draws" style="display:block;">
                            @if(now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                            @include('page.league.detail.news')
                            @elseif(now() < date('Y-m-d', strtotime($leagueInfor->start_date)))
                                @include('page.league.detail.register-league')
                                @endif
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
<script src="{{ asset('js/page/league-champion.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $("[name='recordLeague']").on("change", function() {
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
<script>
    const select = document.getElementById('playerSelect');
    const newPlayerForm = document.getElementById('newPlayerForm');

    select.addEventListener('change', function() {
        if (this.value === 'new') {
            newPlayerForm.classList.remove('hidden');
        } else {
            newPlayerForm.classList.add('hidden');
        }
    });
</script>
<script>
    function switchDivs() {
        const divA = document.getElementById('form-reg');
        const divB = document.getElementById('form-register');

        divA.classList.add('hidden');
        divB.classList.remove('hidden');
    }
</script>



@endsection
