@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color: red; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .label-success {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: green;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .label-danger {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: red;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .card-title {
        color: black !important;
    }

    .rounded-circle {
        margin-right: 10px;
    }

    .card-body p{
        font-size: 15px !important;
    }

    .status-player {
        border-radius: 5px;
        color: white;
        font-weight: 600;
    }

</style>
@section('content')
    <section >
        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
        ?>
        <div class=" text-black p-3 align-items-center " style="background: #707787;padding: 10px; margin-top: -20px; color: white">
            <div class="container d-flex  img-fluid">
                <img src="{{asset($leagueInfor->images ?? asset('/images/no-image.png'))}}" alt="User" width="200" height="200" class=" me-3 " >
                <div class="col-md-10">
                    <div class="card-body" style="color: white">
                        <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                            <h2 class="text-white color-red p-0">{{$leagueInfor->name}}</h2>
                        </a>
                        <p class="card-text"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                        <p class="">
                            <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                        </p>
                        <p class="">
                            <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                        </p>
                        <p class="">
                            <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container mt-4">
            <h5 class="text-success fw-bold mb-3">{{"Schedule"}}</h5>
            @if($listSchedule->isNotEmpty())
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light fw-bold">
                        <tr>
                            <th>#</th>
                            <th>{{'Team 1'}}</th>
                            <th>{{'Team 2'}}</th>
                            <th>{{'Round'}}</th>
                            <th>{{'Match Date'}}</th>
                            <th>{{'Match Time'}}</th>
                            <th>{{'Action'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listSchedule as $index => $schedule)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start fw-semibold text-center text-success">{{ $schedule->player1Team1->name ?? "Team Win" }}
                                    @if($schedule->league && $schedule->league->type_of_league == "doubles")
                                        @if($schedule->player1Team1 && $schedule->player1Team1->partner)
                                            / {{ $schedule->player1Team1->partner->name ?? "Team Win" }}
                                        @endif
                                    @endif</td>
                                <td class="text-start fw-semibold text-center text-success">{{ $schedule->player1Team2->name ?? "Team Win" }}
                                    @if($schedule->league && $schedule->league->type_of_league == "doubles")
                                        @if($schedule->player1Team2 && $schedule->player1Team2->partner)
                                            / {{ $schedule->player1Team2->partner->name ?? "Team Win" }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                   {{$schedule->round}}
                                </td>
                                <td>
                                    {{$schedule->date}}
                                </td>
                                <td>
                                    {{$schedule->time}}
                                </td>
                                <td class="text_flow text-center">
                                    @php
                                        $modalId = $schedule->league && $schedule->league->format_of_league === 'round-robin'
                                            ? 'modalRoundRobin' . $schedule->id
                                            : 'modalKnockout' . $schedule->id;
                                    @endphp
                                    <button type="button" class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#{{ $modalId }}">
                                        {{ __('Update') }}
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal for Round-robin --}}
                            @if($schedule->league && $schedule->league->format_of_league === 'round-robin')
                                <div class="modal fade" id="modalRoundRobin{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('myLeague.schedule.updateScheduleRobin', $schedule->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('Update Round-robin Match') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Match Date</label>
                                                        <input type="date" class="form-control "  name="date" value="{{ $schedule->date }}">
                                                        @error('date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Match Time</label>
                                                        <input type="time" class="form-control" name="time" value="{{ $schedule->time }}">
                                                        @error('time')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    @if($schedule->result_team_1 !== null || $schedule->result_team_2 !== null)
                                                        <span class="text-muted me-auto">Match already has results</span>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary"
                                                        {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'disabled' : '' }}>
                                                        {{ __('Save') }}
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            {{-- Modal for Knockout --}}
                            @if($schedule->league && $schedule->league->format_of_league === 'knockout')
                                <div class="modal fade" id="modalKnockout{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('myLeague.schedule.updateScheduleKnockout', $schedule->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('Update Knockout Match') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Round</label>
                                                        <input type="text" class="form-control" value="{{ $schedule->round }}" readonly>
                                                    </div>

                                                    {{-- Nếu chưa có kết quả, cho phép cập nhật player --}}
                                                    @if($schedule->result_team_1 === null && $schedule->result_team_2 === null)
                                                        @if(is_null($schedule->player1_team_1))
                                                            <div class="mb-3">
                                                                <label for="player1_id" class="form-label">Player 1</label>
                                                                <select name="player1_team_1" class="form-select" required>
                                                                    <option value="">-- Select Player 1 --</option>
                                                                    @foreach ($players as $player)
                                                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif

                                                        @if(is_null($schedule->player1_team_2))
                                                            <div class="mb-3">
                                                                <label for="player2_id" class="form-label">Player 2</label>
                                                                <select name="player1_team_2" class="form-select" required>
                                                                    <option value="">-- Select Player 2 --</option>
                                                                    @foreach ($players as $player)
                                                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="alert alert-warning">
                                                            {{ __('This match already has results. Players cannot be changed.') }}
                                                        </div>
                                                    @endif

                                                    <div class="mb-3">
                                                        <label class="form-label">Match Date</label>
                                                        <input type="date" class="form-control" name="date" value="{{ $schedule->date }}"
                                                            {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'readonly' : '' }}>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Match Time</label>
                                                        <input type="time" class="form-control" name="time" value="{{ $schedule->time }}"
                                                            {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'readonly' : '' }}>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    @if($schedule->result_team_1 !== null || $schedule->result_team_2 !== null)
                                                        <span class="text-muted me-auto">Match already has results</span>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary"
                                                        {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'disabled' : '' }}>
                                                        {{ __('Save') }}
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="alert alert-primary">{{"Tournament is updating data."}}</div>
            @endif
        </div>

    </section>

@endsection

@section('js')

@endsection
