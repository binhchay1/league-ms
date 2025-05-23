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
                         class="img-fluid show-image-league" alt="logo" >
                </div>
                <div id="info-league" class="ms-md-4">
                    <h2 class="p-0">{{ $leagueInfor->name }}</h2>
                    <p class="card-text display">
                        {{ number_format($leagueInfor->money ?? 0) . " VND" }} |
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

                    @if($currentDate < $startDate)
                        <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                            {{ __('Register League') }}
                        </a>

                        <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                            {{ __('List Players Register') }}
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

                    @if(Auth::check() && Auth::user()->id == $leagueInfor->owner_id)
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
                    <!-- Delete League Modal -->
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
                            <h4 class="p-0">{{ 'Operating Status' }}</h4>
                        </div>
                        <div class="card p-4 shadow-sm rounded-4 mt-4">
                            <div class="row mb-3 align-items-center">
                                <div class="col-6 text-start text-muted">{{__('Current status') }}</div>
                                <div class="col-6 text-left">
                                    @if (now()->between($leagueInfor->start_date, $leagueInfor->end_date))
                                        <span
                                            class="status-league p-1 bg-success text-white rounded">{{ __('Active') }}</span>
                                    @elseif(now() < date('Y-m-d', strtotime($leagueInfor->end_date_register)))
                                        <span id="reg"
                                            class="status-league p-1 bg-warning text-white rounded">{{ __('Registering') }}</span>
                                    @elseif(now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) && now() < $leagueInfor->start_date)
                                        <span id="end-reg"
                                            class=" status-league p-1 bg-secondary text-white rounded">{{__('End Register') }}</span>
                                    @elseif(now() > $leagueInfor->end_date)
                                        <span
                                            class="status-league p-1 bg-danger text-white rounded">{{__('Ended ') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-6 text-start text-muted">{{ __('Total matches') }}</div>
                                <div class="col-6 text-left">
                                    <h3 class="mb-0">{{ $leagueInfor->schedule?->count() ?? 0 }} <small
                                            class="fs-6 text-success">{{ 'matches' }}</small></h3>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-6 text-start text-muted">{{ __('Total Players Registered') }}</div>
                                <div class="col-6 text-left">
                                    <h3 class="mb-0">{{ $leagueInfor->userLeagues?->count() ?? 0 }} <small
                                            class="fs-6 text-success">{{ __('players') }}</small></h3>
                                </div>
                            </div>

                        </div>


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
