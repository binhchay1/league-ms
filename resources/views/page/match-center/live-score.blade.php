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

    .result-live {
        font-size: 30px;
        background: green;
        color: white;
        border-radius: 5px;
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
                    <p class="team-name text-primary">{{ $getSchedule->player1Team1->name ?? 'Team 1' }}
                        @if($getSchedule->player1Team1 && $getSchedule->player1Team1->partner)
                            / {{ $getSchedule->player1Team1->partner->name ?? "" }}
                        @endif
                    </p>

                    {{-- Hiển thị tỉ số --}}
                    @if($typeLive == 'live')
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
                    @else
                        <p class="display-6 fw-bold">{{ __('Match Ended') }}</p>
                    @endif
                </div>
                {{-- Set Info --}}
                @if($typeLive == 'live')
                <div class="col-md-2">
                    <p class="h4 mb-1">{{ __('Set') }}</p>
                    <div class="badge bg-secondary fs-5 px-3 py-2" id="number-set">{{ $setLive }}</div>
                </div>
                @else
                    <div class="col-md-2">
                        <div class="fw-bold bg-green result-live">{{ $getSchedule->result_team_1 }} - {{ $getSchedule->result_team_2 }}</div>
                        <div class="badge bg-secondary fs-5 px-3 py-2" id="number-set">{{ $setLive }}</div>
                    </div>
                @endif
                {{-- Team 2 --}}
                <div class="col-md-5">
                    <p class="team-name text-danger">{{ $getSchedule->player1Team2->name ?? 'Team 2' }}
                        @if($getSchedule->player1Team2 && $getSchedule->player1Team2->partner)
                            / {{ $getSchedule->player1Team2->partner->name ?? "" }}
                        @endif
                    </p>

                    {{-- Hiển thị tỉ số --}}
                    @if($typeLive == 'live')
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
                    @else
                        <p class="display-6 fw-bold">{{ __('Match Ended') }}</p>
                    @endif
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
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btn-next-round">{{ __('Next Set') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/admin/live-score.js') }}"></script>

<script>
    const storeScoreUrl = "{{ route('store.score') }}";
    $('#btn-next-round').on('click', function () {
        location.reload();
    });

</script>
@endsection
