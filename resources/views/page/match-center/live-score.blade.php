@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />
@endsection

<style>
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 1px 4px 10px rgba(0, 0, 0, 0.2) !important;
    }
    .transition-btn:hover {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-row {
        background: #eeeeee;
        padding: 10px;
    }

</style>
@section('content')
    <style>
        .score-box {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
        }
        .team-name {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .btn-score {
            width: 40px;
            height: 40px;
            font-size: 20px;
            padding: 0;
            line-height: 1;
            border-radius: 50%;
        }
    </style>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>{{ __('Live Score') }}</h5>
            </div>
            <div class="card-body">
                <div class="row text-center align-items-center">
                    {{-- Team 1 --}}
                    <div class="col-md-5">
                        <p class="team-name text-primary">{{ $getSchedule->player1Team1->name ?? 'Team 1' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            @for($i = 1; $i <= 2; $i++)
                                <div class="score-box mx-1 {{ $getSchedule->result_team_1 >= $i ? 'bg-success text-white' : '' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        <p class="display-5 fw-bold" id="score-team-1">{{ $scoreT1Live ?? 0 }}</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success btn-score mx-1" id="add-score-team-1"><i class="fas fa-plus"></i></button>
                            <button class="btn btn-danger btn-score mx-1" id="deduct-score-team-1"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    {{-- Set Info --}}
                    <div class="col-md-2">
                        <p class="h4 mb-1">{{ __('Set') }}</p>
                        <div class="badge bg-secondary fs-5 px-3 py-2" id="number-set">{{ $setLive }}</div>
                    </div>

                    {{-- Team 2 --}}
                    <div class="col-md-5">
                        <p class="team-name text-danger">{{ $getSchedule->player1Team2->name ?? 'Team 2' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            @for($i = 1; $i <= 2; $i++)
                                <div class="score-box mx-1 {{ $getSchedule->result_team_2 >= $i ? 'bg-success text-white' : '' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        <p class="display-5 fw-bold" id="score-team-2">{{ $scoreT2Live ?? 0 }}</p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success btn-score mx-1" id="add-score-team-2"><i class="fas fa-plus"></i></button>
                            <button class="btn btn-danger btn-score mx-1" id="deduct-score-team-2"><i class="fas fa-minus"></i></button>
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
@section('js')
    <script src="{{ asset('js/admin/live-score.js') }}"></script>
@endsection
