@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Live Score') }}
@endsection

@section('css')
    <style>
        .score-box {
            width: 50px;
            height: 50px;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .team-name {
            font-size: 22px;
            font-weight: bold;
        }

        .btn-score {
            font-size: 18px;
            padding: 8px 12px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">{{ __('Live Score') }}</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-5">
                        <p class="team-name text-primary">{{ $getSchedule->player1Team1->name ?? 'Team 1' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            @for($i = 1; $i <= 2; $i++)
                                <div class="score-box mx-1 {{ $getSchedule->result_team_1 >= $i ? 'bg-success text-white' : '' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        <p class="h1" id="score-team-1">{{ $scoreT1Live ?? 0 }}</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success btn-score mx-1" id="add-score-team-1">+</button>
                            <button class="btn btn-danger btn-score mx-1" id="deduct-score-team-1">-</button>
                        </div>
                    </div>

                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                        <p class="h4">{{ __('Set') }} <span id="number-set">{{ $setLive }}</span></p>
                    </div>

                    <div class="col-md-5">
                        <p class="team-name text-danger">{{ $getSchedule->player1Team2->name ?? 'Team 2' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            @for($i = 1; $i <= 2; $i++)
                                <div class="score-box mx-1 {{ $getSchedule->result_team_2 >= $i ? 'bg-success text-white' : '' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        <p class="h1" id="score-team-2">{{ $scoreT2Live ?? 0 }}</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success btn-score mx-1" id="add-score-team-2">+</button>
                            <button class="btn btn-danger btn-score mx-1" id="deduct-score-team-2">-</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('add-score-team-1').addEventListener('click', function() {
            let score = document.getElementById('score-team-1');
            score.textContent = parseInt(score.textContent) + 1;
        });

        document.getElementById('deduct-score-team-1').addEventListener('click', function() {
            let score = document.getElementById('score-team-1');
            if (parseInt(score.textContent) > 0) {
                score.textContent = parseInt(score.textContent) - 1;
            }
        });

        document.getElementById('add-score-team-2').addEventListener('click', function() {
            let score = document.getElementById('score-team-2');
            score.textContent = parseInt(score.textContent) + 1;
        });

        document.getElementById('deduct-score-team-2').addEventListener('click', function() {
            let score = document.getElementById('score-team-2');
            if (parseInt(score.textContent) > 0) {
                score.textContent = parseInt(score.textContent) - 1;
            }
        });
    </script>
@endsection
