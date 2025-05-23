@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/page/detail-league/setting.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @if (Route::current()->getName() == 'my.leagueBracket.info')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}" />
    @endif
@endsection

@section('content')
    <?php $currentDate = strtotime(date('Y-m-d'));
    $startDate = strtotime(date($leagueInfor->start_date));
    $end_date_register = strtotime($leagueInfor->end_date_register);
    $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
    $format_register_date = $leagueInfor->end_date_register;
    ?>

    <div id="page" class="hfeed site" style=" margin-top: -20px">
        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
        ?>
        <div class=" text-black p-3" style="background: #707787;padding: 10px; margin-top: -20px; color: white">
            <div class="container d-flex flex-column flex-md-row mt-4">
                <div class="logo-left text-center text-md-start mb-3 mb-md-0">
                    <img src="{{ asset($leagueInfor->images ?? '/images/logo-no-background.png') }}"
                        class="img-fluid show-image-league" alt="logo">
                </div>
                <div id="info-league" class="ms-md-4">
                    <h2 class="p-0">{{ $leagueInfor->name }}</h2>
                    <p class="card-text display">
                        {{ number_format($leagueInfor->money ?? 0) . ' VND' }} |
                        {{ $leagueInfor->format_of_league }} |
                        {{ $leagueInfor->type_of_league }} |
                        {{ $leagueInfor->location }}
                    </p>
                    <p class="display">
                        <i class="bi bi-geo-alt"></i>
                        <em>{{ __('Location: ') }} {{ $leagueInfor->location }}</em>
                    </p>
                    <?php
                    $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                    $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                    ?>
                    <p class="display">
                        <i class="bi bi-calendar"></i>
                        <em>From: {{ $start_date }} ~ To: {{ $end_date }}</em>
                    </p>
                    <p class="display">
                        <i class="bi bi-people-fill"></i>
                        <em>{{ __('Member: ') }} {{ $leagueInfor->number_of_athletes }}</em>
                    </p>
                </div>
            </div>
            <div class="container mt-4">
                <div class="d-flex flex-nowrap overflow-auto gap-2 pb-2">
                    @if (now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
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

                    @if ($currentDate < $startDate)
                        <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                            class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                            {{ __('Register League') }}
                        </a>

                        <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                            class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                            {{ __('List Players Register') }}
                        </a>
                    @endif

                    @if ($leagueInfor->format_of_league == 'knockout')
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

                    @if (Auth::check() && Auth::user()->id == $leagueInfor->owner_id)
                        <a href="{{ route('league.leagueSetting', $leagueInfor['slug']) }}"
                            class="btn-custom {{ request()->routeIs('league.leagueSetting') ? 'active' : '' }}">
                            {{ __('Setting') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="wrapper-content-results container">
            <div class="content-results ">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 p-0 mt-3" style="background-color: #4a5773;">
                        <ul class="sidebar-list mt-4">
                            <li class="{{ request()->routeIs('league.leagueActivity') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueActivity', $leagueInfor->slug) }}">
                                    <i class="fas fa-clock mr-2"></i> {{ 'Activity History' }}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueConfig') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueConfig', $leagueInfor->slug) }}">
                                    <i class="fas fa-cog mr-2"></i> {{ 'Tournament Configuration' }}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueStatus') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueStatus', $leagueInfor->slug) }}">
                                    <i class="fas fa-sun mr-2"></i> {{ 'Operating Status' }}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueManagerPlayer') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueManagerPlayer', $leagueInfor->slug) }}">
                                    <i class="fas fa-users mr-2"></i> {{ 'Player Management' }}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueSchedule') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueSchedule', $leagueInfor->slug) }}">
                                    <i class="fas fa-calendar-alt mr-2"></i> {{ 'Schedule Management' }}
                                </a>
                            </li>
                            <li>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteLeagueModal">
                                    <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete Tournament') }}
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="modal fade" id="confirmDeleteLeagueModal" tabindex="-1" aria-labelledby="deleteLeagueLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteLeagueLabel">{{ __('Confirm Delete') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('Are you sure you want to delete this tournament? This action cannot be undone.') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>

                                    <form method="POST" action="{{ route('delete.myLeague', $leagueInfor->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tournament List -->
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-center league-title">
                            <h4 class="p-0">{{ __('Management Schedule') }}</h4>
                        </div>

                        @if (count($leagueInfor->schedule) == 0)
                            @if (now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) && now() < $leagueInfor->start_date)
                                <div class=" gap-3 mt-4">
                                    <p style="padding: 10px; background: #e7e7b6;">
                                        {{ __("League doesn't have a match schedule yet, create one.") }}</p>
                                    <a href="{{ route('auto.create.myLeague.schedule') }}?s={{ $leagueInfor->slug }}">
                                        <button class="btn btn-success">{{ __('Create Schedule') }}</button>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="container mt-4 table-responsive">
                                <h5 class="text-success fw-bold mb-3">{{ __('Schedule') }}</h5>
                                @if ($listSchedule->isNotEmpty())
                                    <table class="table table-bordered align-middle text-center">
                                        <thead class="table-light fw-bold">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Team 1') }}</th>
                                                <th>{{ __('Team 2') }}</th>
                                                <th>{{ __('Round') }}</th>
                                                <th>{{ __('Match Date') }}</th>
                                                <th>{{ __('Match Time') }}</th>
                                                <th>{{ __('Winner Team') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listSchedule as $index => $schedule)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="text-start fw-semibold text-center text-success">
                                                        {{ $schedule->player1Team1->name ?? 'Team Win' }}
                                                        @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                            @if ($schedule->player1Team1 && $schedule->player1Team1->partner)
                                                                /
                                                                {{ $schedule->player1Team1->partner->name ?? 'Team Win' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-start fw-semibold text-center text-success">
                                                        {{ $schedule->player1Team2->name ?? 'Team Win' }}
                                                        @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                            @if ($schedule->player1Team2 && $schedule->player1Team2->partner)
                                                                /
                                                                {{ $schedule->player1Team2->partner->name ?? 'Team Win' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $schedule->round }}
                                                    </td>
                                                    <td>
                                                        {{ $schedule->date }}
                                                    </td>
                                                    <td>
                                                        {{ $schedule->time }}
                                                    </td>
                                                    <td class="text-start fw-semibold text-center text-success">
                                                        {{ $schedule->teamWin->name ?? '' }}
                                                        @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                            @if ($schedule->teamWin && $schedule->teamWin->partner)
                                                                /
                                                                {{ $schedule->teamWin->partner->name }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text_flow text-center">
                                                        @php
                                                            $modalId =
                                                                $schedule->league &&
                                                                $schedule->league->format_of_league === 'round-robin'
                                                                    ? 'modalRoundRobin' . $schedule->id
                                                                    : 'modalKnockout' . $schedule->id;
                                                        @endphp
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                                            {{ __('Update') }}
                                                        </button>
                                                    </td>
                                                </tr>

                                                {{-- Modal for Round-robin --}}
                                                @if ($schedule->league && $schedule->league->format_of_league === 'round-robin')
                                                    <div class="modal fade" id="modalRoundRobin{{ $schedule->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form
                                                                action="{{ route('myLeague.schedule.updateScheduleRobin', $schedule->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ __('Update Round-robin Match') }}</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('Match Date') }}</label>
                                                                            <input type="date" class="form-control "
                                                                                name="date"
                                                                                value="{{ $schedule->date }}">
                                                                            @error('date')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('Match Time') }}</label>
                                                                            <input type="time" class="form-control"
                                                                                name="time"
                                                                                value="{{ $schedule->time }}">
                                                                            @error('time')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @if ($schedule->result_team_1 !== null || $schedule->result_team_2 !== null)
                                                                            <span
                                                                                class="text-muted me-auto">{{ __('Match already
                                                                                                                                                                has results') }}</span>
                                                                        @endif
                                                                        <button type="submit" class="btn btn-primary"
                                                                            {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'disabled' : '' }}>
                                                                            {{ __('Save') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Modal for Knockout --}}
                                                @if ($schedule->league && $schedule->league->format_of_league === 'knockout')
                                                    <div class="modal fade" id="modalKnockout{{ $schedule->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form
                                                                action="{{ route('myLeague.schedule.updateScheduleKnockout', $schedule->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ __('Update Knockout Match') }}</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('Round') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $schedule->round }}" readonly>
                                                                        </div>

                                                                        {{-- Nếu chưa có kết quả, cho phép cập nhật player --}}
                                                                        @if (is_null($schedule->player1_team_1))
                                                                            <div class="mb-3">
                                                                                <label for="player1_id"
                                                                                    class="form-label">{{ __('Player 1') }}</label>
                                                                                <select name="player1_team_1"
                                                                                    class="form-select" required>
                                                                                    <option value="">--
                                                                                        {{ __('Select Player') }}
                                                                                        1 --</option>
                                                                                    @foreach ($players as $player)
                                                                                        <option
                                                                                            value="{{ $player->user_id }}">
                                                                                            {{ $player->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif

                                                                        @if (is_null($schedule->player1_team_2))
                                                                            <div class="mb-3">
                                                                                <label for="player2_id"
                                                                                    class="form-label">{{ __('Player 2') }}</label>
                                                                                <select name="player1_team_2"
                                                                                    class="form-select" required>
                                                                                    <option value="">--
                                                                                        {{ __('Select Player') }}
                                                                                        2 --</option>
                                                                                    @foreach ($players as $player)
                                                                                        <option
                                                                                            value="{{ $player->user_id }}">
                                                                                            {{ $player->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif

                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('Match Date') }}</label>
                                                                            <input type="date" class="form-control"
                                                                                name="date"
                                                                                value="{{ $schedule->date }}"
                                                                                {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'readonly' : '' }}>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Match Time</label>
                                                                            <input type="time" class="form-control"
                                                                                name="time"
                                                                                value="{{ $schedule->time }}"
                                                                                {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'readonly' : '' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div
                                                                        class="modal-footer flex-column flex-sm-row align-items-center">
                                                                        @if ($schedule->result_team_1 !== null || $schedule->result_team_2 !== null)
                                                                            <span
                                                                                class="text-muted alert alert-warning  mb-2 mb-sm-0">
                                                                                {{ __("Match already has results, don't change") }}
                                                                            </span>
                                                                        @endif
                                                                        <button type="submit" class="btn btn-primary"
                                                                            {{ $schedule->result_team_1 !== null || $schedule->result_team_2 !== null ? 'disabled' : '' }}>
                                                                            {{ __('Save') }}
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary ms-sm-2"
                                                                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
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
                                    <div class="alert alert-primary">{{ 'Tournament is updating data.' }}</div>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="{{ asset('js/page/league-champion.js') }}"></script>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteForm = document.getElementById("deleteForm");

        document.querySelectorAll(".openDeleteModal").forEach(button => {
            button.addEventListener("click", function() {
                const deleteUrl = this.getAttribute("data-url");
                deleteForm.setAttribute("action", deleteUrl);
            });
        });
    });
</script>
