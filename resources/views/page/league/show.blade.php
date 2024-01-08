@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection
@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{asset('css/content/league.css')}}" type="text/css" media="all" />
@endsection
@section('content')
<link rel="stylesheet" id="dashicons-css" href="{{ asset('league/wp-includes/css/dashicons.min.css') }}" />
<link rel="stylesheet" id="editor-buttons-css" href="{{ asset('league/wp-includes/css/editor.min.css') }}" />
<link rel="stylesheet" id="wp-block-library-css" href="{{ asset('league/wp-includes/css/dist/block-library/style.min.css') }}" />
<link rel="stylesheet" id="bwf-newsletter-signup-style-css" href="{{asset('league/wp-content/plugins/bwf-newsletter/css/newsletter-signup.css') }}" />
<link rel="stylesheet" id="bwf_menu_style-css" href="{{ asset('league/wp-content/plugins/bwf-menu-system/css/bwf-menu-system.css') }}" />
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/css/style.css') }}" />
<link rel="stylesheet" id="hover-style-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/css/hover-min.css') }}" />
<link rel="stylesheet" id="fancybox-style-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/fancybox-master/dist/jquery.fancybox.css') }}" />
<link rel="stylesheet" id="select2-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/select2/dist/css/select2.css') }}" />
<link rel="stylesheet" id="fontawesome-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/fontawesome/css/font-awesome.css') }}" />
<link rel="stylesheet" id="animate.ss-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/animate.css/animate.min.css') }}" />
<link rel="stylesheet" id="owl-style-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.carousel.css') }}" />
<link rel="stylesheet" id="owl-theme-css" href="{{ asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.theme.default.css') }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div id="page" class="hfeed site">
    <div class="container-1280 results">
        <div class="std-title">
            <div class="std-title-left">
                <h2 class="left">{{__('LEAGUE INFORMATION')}}</h2>
            </div>
        </div>
        @if(Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{Session::get('message')}}", 'Success!', {
                timeout: 12000
            });
        </script>
        @endif
        <div class="wrapper-results">
            <div style="border: 1px solid #efefef;">
                <div class="box-title page-header">
                    <div class="box-title-left">
                    </div>
                    <div class="box-title-right">
                        <h3 class="right">
                            {{ __('OTHER LEAGUE') }}
                        </h3>
                        <label class="tournament-select clear">
                            <select name='record' class="ddlTournament">
                                <option id="format_of_league" value="">{{ __('Select League') }}</option>
                                @foreach($listLeagues as $league => $value )
                                <?php $dataLeague = str_slug($value->name) ?>
                                <option value="{{ $dataLeague }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="box-results-tournament">
                    <div>
                        <div class="logo-left">
                            <img src="{{ $leagueInfor->images }}" class="show-image-league" alt="logo">
                        </div>
                        <div class="info">
                            <h2>{{ $leagueInfor->name }}</h2>
                            <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                            $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                            ?>
                            <h5 class="">{{ __('Start Date') }}: {{ $start_date }}</h5>
                            <h5 class="">{{ __('End Date') }}: {{ $end_date }}</h5>
                            <div class="prize">{{ __('PRIZE MONEY USD ') }}${{ $leagueInfor->money }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                <ul id="ajaxTabs" class="content-tabs">
                    <li>
                        <a href="{{route('leagueResult.info', $leagueInfor['slug'])}}">{{ __('Result') }} </a>
                    </li>
                    <li><a href="{{route('leagueSchedule.info', $leagueInfor['slug'])}}">{{ __('Schedule') }}</a>
                    </li>
                    <!-- <li><a href="{{route('leagueFightBranch.info', $leagueInfor['slug'])}}">{{ __('Fighting Branch') }}</a>
                    </li> -->
                    <li><a id="player-data" href="{{ route('leaguePlayer.info', $leagueInfor['slug']) }}">{{ __('Player ') }}</a>
                    </li>
                </ul>
                <div class="register  row" align="right" id="register-league">
                    <div class="col-lg-10 mt-4">
                        <?php $end_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
                        ?>
                        <h5>{{__('Registration Deadline')}} : {{$end_date_register}}</h5>
                    </div>
                    <div class="col-lg-2 mt-3">
                        <button type="button" id="btn-register" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                            {{__('Register League')}}
                        </button>
                    </div>
                </div>

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{__('Register League')}}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            @if(Auth::check())
                            <div class="modal-body">
                                <div class="leagueInfo">
                                    <div class="tab-content" id="tab-content">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img class="image-modal-data lazy truncated initial loaded white center" src="{{$leagueInfor->images}}">
                                            </div>
                                            <div class="col-lg-8 league-data">
                                                <h4 class="">{{ $leagueInfor->name }}</h4>
                                                {{ $leagueInfor->type_of_league }}
                                                <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                ?>
                                                <h6 class="">{{__('Start Date')}}: {{ $start_date }}</h6>
                                                <h6 class="">{{__('End Date')}}: {{ $end_date }}</h6>
                                                <p class="">{{__('PRIZE MONEY USD ')}}${{ $leagueInfor->money }}</p>
                                            </div>
                                            <div class="checkbox" align="center">
                                                <input id="check" name="checkbox" type="checkbox">
                                                <label for="checkbox">{{__('I have read and agree to the tournament rules')}}</label>
                                            </div>
                                            <div align="center">
                                                <button id="open-tab1" class="btn btn-success" disabled>{{__('Register ')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="infor" style="display: none">
                                    <h1 align="center">{{__('Confirm Information')}}</h1>
                                    <form id="formAccountSettings" method="POST" action="{{route('registerLeague')}}" enctype="multipart/form-data">
                                        @csrf()
                                        <div class="tab-content rankings-content_tabpanel">
                                            <div class="item-active">
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="rankings-table">
                                                    <thead align="center">
                                                        <tr>
                                                            <th style="text-align: center" class="col-rank" align="center">{{ __('Name') }}</th>
                                                            <th style="text-align: center" class="col-country" align="center">{{ __('Image') }}</th>
                                                            <th style="text-align: center" class="col-player">{{ __('Age') }}</th>
                                                            <th style="text-align: center" class="col-points" align="center">{{ __('Address') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tr class="row-top-eight">
                                                        <input type="hidden" name="league_id" id="" value="{{ $leagueInfor->id }}">
                                                        <input type="hidden" name="end_date_register" id="" value="{{ $leagueInfor->end_date_register }}">
                                                        <input type="hidden" name="start_date" id="" value="{{ $leagueInfor->start_date }}">
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="status" value="0">
                                                        <td align="center">
                                                            {{ Auth::user()->name }}
                                                        </td>
                                                        <td align="center">
                                                            <div class="country">
                                                                <img width="48" src="/{{ Auth::user()->profile_photo_path }}" title="Japan" class="flag image-user">
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
                                            <button type="submit" class="btn btn-success me-2">{{ __('Send Information') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div align="center">
                                <h3>{{ __('Please log in before registering for the tournament!') }}</h3>
                                <a class="btn btn-dark btn-lg btn-block" href="{{ route('login') }}"> {{ __('Login') }}</a>
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
                        @else
                        <div>
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
<script>
    $("[name='record']").on("change", function(e) {
        let edit_id = $(this).val();
        window.location.href = window.location.origin + '/info/' + edit_id;
    });

    var date_register = '<?php echo strtotime($leagueInfor->end_date_register); ?>';
    var start_date = '<?php echo strtotime($leagueInfor->start_date); ?>';

    if (date_register < start_date) {
        $('#register-league').show();
    } else {
        $('#register-league').hide();
    }
</script>

@endsection
