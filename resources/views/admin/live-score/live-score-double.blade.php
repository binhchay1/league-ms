@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Live Score') }}
@endsection

@section('css')
<style>
    .square {
        height: 20px;
        width: 20px;
        border: 1px solid black;
    }

    .bg-square {
        background-color: gray;
    }

    #text-set {
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
@if($typeLive == 'live')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Live Score') }}</h5>
        </div>

        <div class="card-body row">
            <div class="col-lg-5 col-md-12 d-flex justify-content-center ">
                <div>
                    <div class="d-flex">
                        @if(isset($getSchedule->player1Team1))
                        <p class="text-center h1">{{ $getSchedule->player1Team1->name }}</p>
                        @endif

                        @if(isset($getSchedule->player2Team1))
                        <p class="h1 ml-2 mr-2"> - </p>
                        <p class="text-center h1">{{ $getSchedule->player2Team1->name }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        @if($getSchedule->result_team_1 >= 1)
                        <div class="square bg-square" id="square-1-1"></div>
                        @else
                        <div class="square" id="square-1-1"></div>
                        @endif

                        @if($getSchedule->result_team_1 >= 2)
                        <div class="square ml-1 bg-square" id="square-1-2"></div>
                        @else
                        <div class="square ml-1" id="square-1-2"></div>
                        @endif
                    </div>

                    <div>
                        @if(empty($scoreT1Live))
                        <p class="text-center h1" id="score-team-1">0</p>
                        @else
                        <p class="text-center h1" id="score-team-1">{{ $scoreT1Live }}</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="text-center h4" id="score-player-1-team-1">{{ $arrScore['player_1'] }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-center h4" id="score-player-2-team-1">{{ $arrScore['player_2'] }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-center" id="area-button-score-1-1">
                            <button class="btn btn-success" id="add-score-team-1-1">{{ __('Add') }}</button>
                            <button class="btn btn-danger ml-2" id="deduct-score-team-1-1">{{ __('Deduct') }}</button>
                        </div>

                        @if(isset($getSchedule->player2Team1))
                        <div class="d-flex justify-content-center ml-5" id="area-button-score-1-2">
                            <button class="btn btn-success" id="add-score-team-1-2">{{ __('Add') }}</button>
                            <button class="btn btn-danger ml-2" id="deduct-score-team-1-2">{{ __('Deduct') }}</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-12">
                <p class="text-center" id="text-set">{{ __('Set') }} <span id="number-set">{{ $setLive }}</span></p>
            </div>

            <div class="col-lg-5 col-md-12 d-flex justify-content-center">
                <div>
                    <div class="d-flex">
                        @if(isset($getSchedule->player1Team2))
                        <p class="text-center h1">{{ $getSchedule->player1Team2->name }}</p>
                        @endif

                        @if(isset($getSchedule->player2Team2))
                        <p class="h1 ml-2 mr-2"> - </p>
                        <p class="text-center h1">{{ $getSchedule->player2Team2->name }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        @if($getSchedule->result_team_2 >= 1)
                        <div class="square bg-square" id="square-2-1"></div>
                        @else
                        <div class="square" id="square-2-1"></div>
                        @endif

                        @if($getSchedule->result_team_2 >= 2)
                        <div class="square ml-1 bg-square" id="square-2-2"></div>
                        @else
                        <div class="square ml-1" id="square-2-2"></div>
                        @endif
                    </div>

                    <div>
                        @if(empty($scoreT2Live))
                        <p class="text-center h1" id="score-team-2">0</p>
                        @else
                        <p class="text-center h1" id="score-team-2">{{ $scoreT2Live }}</p>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="text-center h4" id="score-player-1-team-2">{{ $arrScore['player_3'] }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-center h4" id="score-player-2-team-2">{{ $arrScore['player_4'] }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-center" id="area-button-score-2-1">
                            <button class="btn btn-success" id="add-score-team-2-1">{{ __('Add') }}</button>
                            <button class="btn btn-danger ml-2" id="deduct-score-team-2-1">{{ __('Deduct') }}</button>
                        </div>

                        @if(isset($getSchedule->player2Team2))
                        <div class="d-flex justify-content-center ml-5" id="area-button-score-2-2">
                            <button class="btn btn-success" id="add-score-team-2-2">{{ __('Add') }}</button>
                            <button class="btn btn-danger ml-2" id="deduct-score-team-2-2">{{ __('Deduct') }}</button>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="noti-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h1 class="modal-title"></h1>
            </div>
            <div class="modal-body d-flex justify-content-center h2">
                <span></span>
                <p class="ml-1">{{ __(' win') }}</p>
                <p id="end-game-noti"></p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btn-next-round">{{ __('Next Round') }}</button>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Live Score') }}</h5>
        </div>

        <div class="card-body row">
            <div class="col-5 d-flex justify-content-center">
                <div>
                    <div>
                        @if(isset($getSchedule->player1Team1))
                        <p class="text-center h1">{{ $getSchedule->player1Team1->name }}</p>
                        @endif

                        @if(isset($getSchedule->player2Team1))
                        <p class="text-center h1">{{ $getSchedule->player2Team1->name }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        @if($getSchedule->result_team_1 >= 1)
                        <div class="square bg-square" id="square-1-1"></div>
                        @else
                        <div class="square" id="square-1-1"></div>
                        @endif

                        @if($getSchedule->result_team_1 >= 2)
                        <div class="square ml-1 bg-square" id="square-1-2"></div>
                        @else
                        <div class="square ml-1" id="square-1-2"></div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-2">
                <p class="text-center">{{ __('End game') }}</p>
            </div>

            <div class="col-5 d-flex justify-content-center">
                <div>
                    <div>
                        @if(isset($getSchedule->player1Team2))
                        <p class="text-center h1">{{ $getSchedule->player1Team2->name }}</p>
                        @endif

                        @if(isset($getSchedule->player2Team2))
                        <p class="text-center h1">{{ $getSchedule->player2Team2->name }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        @if($getSchedule->result_team_2 >= 1)
                        <div class="square bg-square" id="square-2-1"></div>
                        @else
                        <div class="square" id="square-2-1"></div>
                        @endif

                        @if($getSchedule->result_team_2 >= 2)
                        <div class="square ml-1 bg-square" id="square-2-2"></div>
                        @else
                        <div class="square ml-1" id="square-2-2"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('js')
<script src="{{ asset('js/admin/live-score-double.js') }}"></script>
@endsection
