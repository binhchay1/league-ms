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
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    @if(Route::current()->getName() == 'my.leagueBracket.info')
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
        background-color: #007bff; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .card-title {
        color: black !important;
    }
    p.display {
        font-size: 18px !important;
    }
</style>
@section('content')
    <section >
        <div class="container-fluid">
            <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
            $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
            ?>
            <div class=" text-black p-3 align-items-center">
                <div class="container d-flex  img-fluid">
                    <img src="{{$leagueInfor->images ?? asset('/images/no-image.png')}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                    <div class="col-md-10">
                        <div class="card-body">
                            <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                                <h2 class="card-title color-red mb-1 p-0">{{$leagueInfor->name}}</h2>
                            </a>
                            <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                            <p class="display">
                                <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                            </p>
                            <p class="display">
                                <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                            </p>
                            <p class="display">
                                <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                <hr>

            <?php $current_date = strtotime(date("Y-m-d"));
            $start_date = strtotime($leagueInfor->start_date);
            $end_date_register = strtotime($leagueInfor->end_date_register);
            $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
            $format_register_date =$leagueInfor->end_date_register;
            ?>
            <!-- Main Content -->
                <div class="wrapper-content-results container">
                    <ul id="ajaxTabs" class="content-tabs">
                        <li>
                            <a href="{{ route('my.leagueBracket.info',$leagueInfor['slug']) }}">{{ __('Bracket') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('my.leagueResult.info',$leagueInfor['slug']) }}">{{ __('Result') }} </a>
                        </li>
                        <li><a href="{{ route('my.leagueSchedule.info',$leagueInfor['slug']) }}">{{ __('Schedule') }}</a>
                        </li>
                        <li><a id="player-data"
                               href="{{ route('my.leaguePlayer.info',$leagueInfor['slug']) }}">{{ __('Player ') }}</a>
                        </li>
                    </ul>

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
                                                        <h4 class="">{{$leagueInfor->name }}</h4>
                                                        {{$leagueInfor->type_of_league }}
                                                        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                        ?>
                                                        <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                                        <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                                        <p class="">{{ __('PRIZE MONEY USD ') }}${{$leagueInfor->money
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
                                                                       value="{{$leagueInfor->id }}">
                                                                <input type="hidden" name="end_date_register" id=""
                                                                       value="{{$leagueInfor->end_date_register }}">
                                                                <input type="hidden" name="start_date" id=""
                                                                       value="{{$leagueInfor->start_date }}">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="status" value="0">
                                                                <td align="center">
                                                                    {{ Auth::user()->name }}
                                                                </td>
                                                                <td align="center">
                                                                    <div class="country">
                                                                        <img width="48"
                                                                             src="/{{ Auth::user()->profile_photo_path }}"
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
                                @if(Route::current()->getName() == 'my.leaguePlayer.info')
                                    <div>
                                        @include('page.user.my-league.detail.player')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueResult.info')
                                    <div>
                                        @include('page.user.my-league.detail.result')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueSchedule.info')
                                    <div>
                                        @include('page.user.my-league.detail.schedule')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueBracket.info')
                                    @include('page.user.my-league.detail.bracket')
                                @else
                                    <div class="item draws" style="display:block;">
                                        @include('page.user.my-league.detail.schedule')
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>

        </div>

    </section>
@endsection

@section('js')

@endsection
