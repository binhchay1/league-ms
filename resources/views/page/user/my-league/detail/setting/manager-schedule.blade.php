@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
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
        background-color:#dc3545 !important; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .card-title {
        color: black !important;
    }

    p.display {
        font-size: 15px !important;
    }

    .btn-custom {
        background-color: #dc3545 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px 15px!important;
        border: none;
    }

    .btn-custom:hover {
        background-color: #ff4b2b !important;
    }

    /* Tùy chỉnh dropdown */
    .btn-dropdown {
        background: white;
        border: 2px solid #ff4b2b !important;
        border-radius: 10px;
        color: #dc3545;
        padding: 10px 12px !important;
    }

    .btn-dropdown:hover {
        background: #f1f1f1 !important;
    }

    h5.modal-title {
        color: white !important;
    }

    .btn-custom {
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ccc;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-custom.active {
        background-color: lightgrey !important;
        color: black !important;
    }


    .sidebar-list {
        background-color: #4a5773;
        border-radius: 6px;
        padding: 0;
        list-style: none;
    }

    .sidebar-list li a {
        display: block;
        padding: 12px 16px;
        color: #ffffff;
        text-decoration: none;
        font-size: 15px !important;
    }


    .sidebar-list li a:hover {
        background-color: lightgrey;

    }

    .sidebar-list li.active a {
        background-color: #ffffff;
        color: #4a5773;
        border-radius: 0;
    }

    .league-title {
        background: #f5f5f5;
        padding: 10px;
    }

    .font-medium {
        border: 1px solid transparent;
        border-radius: 4px;
        padding: 10px;
        background-color: #d9edf7;
        color: #31708f;
        width: 100% !important;
        font-size: 18px !important;
        margin-top: 20px !important;
        margin-bottom: 20px !important;
        font-weight: 500;
    }

</style>
@section('content')
    <?php $currentDate = strtotime(date("Y-m-d"));
    $startDate = strtotime(date($leagueInfor->start_date));
    $end_date_register = strtotime($leagueInfor->end_date_register);
    $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
    $format_register_date =$leagueInfor->end_date_register;
    ?>
    @if ($hasEnded && $champion )
        <div id="winner-popup" style="margin-top: -30px" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 text-white">
            {{-- Nút đóng (góc trên phải màn hình) --}}
            <button onclick="closeWinnerPopup()" id="popup-close" class="absolute top-4 right-6 text-white text-3xl hover:text-red-500 z-50">
                &times;
            </button>
            {{-- Nội dung popup --}}
            <div class="relative z-10 text-center bg-gray-900 bg-opacity-80 px-6 py-8 rounded-lg shadow-lg">
                <h2 class="text-2xl text-yellow-400 font-bold mb-4">{{'Congratulations to the defending champions of the tournament!'}}</h2>
                <img src="{{ asset('/images/player-team.jpg') }}" class="mx-auto w-32 h-32 rounded-full border-4 border-yellow-500 mb-4" alt="Winner Avatar">
                <h4 class="text-xxl text-white font-semibold">
                    {{ $champion->user->name ?? '---' }}
                    @if($champion->user->partner)
                        @if($champion->league && $champion->league->type_of_league == "doubles")
                            + {{ $champion->user->partner->name }}
                        @endif
                    @endif
                </h4>

                {{-- Canvas pháo hoa --}}
                <canvas id="canvas"></canvas>
            </div>
        </div>
    @endif
    <div id="page" class="hfeed site" style="{{ ($hasEnded && $champion) ? 'display: none;' : '' }}; margin-top: -20px">
        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
        ?>
        <div class=" text-black p-3" style="background: #707787;padding: 10px; margin-top: -20px; color: white">
            <div class="container d-flex  img-fluid" style="color: white; margin-top: 20px">
                <img src="{{asset($leagueInfor->images ?? asset('/images/logo-no-background.png'))}}" alt="User" width="200" height="200" class=" me-3 " >
                <div class="col-md-10">
                    <div class="card-body">
                        <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                            <h2 class="card-title text-white color-red mb-1 p-0">{{$leagueInfor->name}}</h2>
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
            <div class="container d-flex gap-2 mt-4">
                @if(now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
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
                @if( $currentDate < $startDate)
                    <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                       class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                        {{ __('Register League') }}
                    </a>

                    <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                       class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                        {{ __('List Register') }}
                    </a>
                @endif
                @if($leagueInfor->format_of_league == "knockout")
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

                <a href="{{ route('league.leagueSetting',$leagueInfor['slug']) }}"
                   class="btn-custom {{ request()->routeIs('league.leagueSetting') ? 'active' : '' }}">
                    {{ __('Setting') }}
                </a>

                {{--                        @if(Auth::check() && Auth::user()->id == $leagueInfor->owner_id)--}}
                {{--                        <div class="dropdown">--}}
                {{--                            <a class="btn-custom dropdown-toggle {{ request()->routeIs('my.infoMyLeague') ? 'active' : '' }}"--}}
                {{--                                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">--}}
                {{--                                {{ __('Setting') }} <i class="bi bi-gear"></i>--}}
                {{--                            </a>--}}
                {{--                            <ul class="dropdown-menu">--}}
                {{--                                <li><a class="dropdown-item" href="{{ route('my.infoMyLeague', $leagueInfor['slug']) }}">League Information</a></li>--}}
                {{--                                <li><a class="dropdown-item" href="#">Delete League</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                        @endif--}}
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
                                    <i class="fas fa-clock mr-2"></i> {{'Activity History'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueConfig') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueConfig', $leagueInfor->slug) }}">
                                    <i class="fas fa-cog mr-2"></i> {{'Tournament Configuration'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueStatus') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueStatus', $leagueInfor->slug) }}">
                                    <i class="fas fa-sun mr-2"></i> {{'Operating Status'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueManagerPlayer') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueManagerPlayer', $leagueInfor->slug) }}">
                                    <i class="fas fa-users mr-2"></i> {{'Player Management'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueSchedule') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueSchedule', $leagueInfor->slug) }}">
                                    <i class="fas fa-calendar-alt mr-2"></i> {{'Schedule Management'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('league.leagueJoin') ? 'active' : '' }}">
                                <a href="{{ route('league.leagueJoin', $leagueInfor->slug) }}">
                                    <i class="fas fa-trash-alt mr-2"></i> {{'Delete Tournament'}}
                                </a>
                            </li>
                        </ul>

                    </div>

                    <!-- Tournament List -->
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-center league-title">
                            <h4 class="p-0">{{'Setting'}}</h4>
                        </div>

                        @if(count($leagueInfor->schedule) == 0)
                            @if(now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) && now() < $leagueInfor->start_date)
                            <div class=" gap-3 mt-4">
                                <p>{{"League doesn't have a match schedule yet, create one."}}</p>
                                <a href="{{ route('auto.create.myLeague.schedule') }}?s={{ $leagueInfor->slug }}">
                                    <button class="btn btn-success">{{ __('Create Schedule') }}</button>
                                </a>
                            </div>
                            @endif
                        @else
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
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForm = document.getElementById("deleteForm");

        document.querySelectorAll(".openDeleteModal").forEach(button => {
            button.addEventListener("click", function () {
                const deleteUrl = this.getAttribute("data-url");
                deleteForm.setAttribute("action", deleteUrl);
            });
        });
    });
</script>
