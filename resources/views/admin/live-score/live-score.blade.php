@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Live Score') }}
@endsection

@section('css')
<style>
    .square {
        height: 10px;
        width: 10px;
        border: 1px solid black;
    }

    .h1 {
        font-size: 5.5rem;
    }
</style>
@endsection

@section('content')
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
                        <div class="square"></div>
                        <div class="square ml-1"></div>
                    </div>

                    <div>
                        @if(empty($getSchedule->set_1_team_1))
                        <p class="text-center h1" id="score-team-1">0</p>
                        @else
                        <p class="text-center h1">{{ $getSchedule->set_1_team_1 }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" id="add-score-team-1">{{ __('Add') }}</button>
                        <button class="btn btn-danger" id="deduct-score-team-1">{{ __('Deduct') }}</button>
                    </div>
                </div>
            </div>

            <div class="col-2">
                <p class="text-center">{{ __('Round') }} 1</p>
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
                        <div class="square"></div>
                        <div class="square ml-1"></div>
                    </div>

                    <div>
                        @if(empty($getSchedule->set_1_team_2))
                        <p class="text-center h1" id="score-team-2">0</p>
                        @else
                        <p class="text-center h1">{{ $getSchedule->set_1_team_2 }}</p>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" id="add-score-team-2">{{ __('Add') }}</button>
                        <button class="btn btn-danger" id="deduct-score-team-2">{{ __('Deduct') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/admin/live-score.js') }}"></script>
@endsection