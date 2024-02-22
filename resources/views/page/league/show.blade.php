@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <style>
        .btn-league {
            font-size: 20px;
            text-transform: uppercase;
            border-radius: 50px;
            background-color: #6cbe4c;
            border-color: transparent;
            font-weight: 500;
            width: 200px;
        }

        .ddlTournament {
            width: 300px;
        }
    </style>
<link rel="stylesheet" href="{{ asset('css/page/show.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@if(Route::current()->getName() == 'leagueResult.bracket')
<link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}" />
@endif
@endsection

@section('content')
<div id="page" class="hfeed site">
    <div class="container-1280 results">
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
                        <a href="{{ route('leagueResult.bracket', $leagueInfor['slug']) }}">{{ __('Bracket') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('leagueResult.info', $leagueInfor['slug']) }}">{{ __('Result') }} </a>
                    </li>
                    <li><a href="{{ route('leagueSchedule.info', $leagueInfor['slug']) }}">{{ __('Schedule') }}</a>
                    </li>
                    <li><a id="player-data" href="{{ route('leaguePlayer.info', $leagueInfor['slug']) }}">{{ __('Player ') }}</a>
                    </li>
                </ul>
                <?php $current_date =  strtotime(date("Y-m-d"));
                      $start_date =  strtotime($leagueInfor->start_date);
                $end_date_register =  strtotime($leagueInfor->end_date_register);

                ?>
                @if($current_date <= $start_date && $current_date <= $end_date_register)
                <div class="register row" align="right" id="register-league">
                    <div class="col-lg-9 mt-4">
                        <?php $end_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
                        ?>
                        <h5>{{ __('Registration Deadline') }} : {{ $end_date_register }}</h5>
                    </div>
                    <div class="col-lg-3 mt-3">
                        <button type="button" id="btn-register" class="btn btn-success btn-league" data-bs-toggle="modal" data-bs-target="#myModal">
                            {{ __('Register League') }}
                        </button>
                    </div>
                </div>
                @endif

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
                                                <img class="image-modal-data lazy truncated initial loaded white center" src="{{$leagueInfor->images}}">
                                            </div>
                                            <div class="col-lg-8 league-data">
                                                <h4 class="">{{ $leagueInfor->name }}</h4>
                                                {{ $leagueInfor->type_of_league }}
                                                <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                ?>
                                                <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                                <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                                <p class="">{{ __('PRIZE MONEY USD ') }}${{ $leagueInfor->money }}</p>
                                            </div>
                                            <div class="checkbox" align="center">
                                                <input id="check" name="checkbox" type="checkbox">
                                                <label for="checkbox">{{ __('I have read and agree to the tournament rules') }}</label>
                                            </div>
                                            <div align="center">
                                                <button id="open-tab1" class="btn btn-success" disabled>{{ __('Register ') }}</button>
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
                                <h4 class="mt-4">{{ __('Please')}} <a href="{{ route('login') }}">{{__('login')}}</a> {{__('before registering for the tournament!') }}</h4>
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
    $("[name='record']").on("change", function(e) {
        let edit_id = $(this).val();
        window.location.href = window.location.origin + '/info/' + edit_id;
    });

</script>
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
@endsection
