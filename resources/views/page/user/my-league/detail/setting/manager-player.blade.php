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
            <div class="container d-flex  img-fluid" style="color: white; margin-top: 20px">
                <img src="{{ asset($leagueInfor->images ?? asset('/images/logo-no-background.png')) }}" alt="User"
                    width="200" height="200" class=" me-3 ">
                <div class="col-md-10">
                    <div class="card-body">
                        <a href="{{ route('my.leagueDetail', $leagueInfor->slug) }}">
                            <h2 class=" text-white color-red mb-1 p-0">{{ $leagueInfor->name }}</h2>
                        </a>
                        <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . ' VND'; ?> || {{ $leagueInfor->format_of_league }} ||
                            {{ $leagueInfor->type_of_league }} || {{ $leagueInfor->location }}</p>
                        <p class="display">
                            <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{ $leagueInfor->location }}</em>
                        </p>
                        <p class="display">
                            <i class="bi bi-calendar"></i> <em>{{ 'From: ' }} {{ $start_date }} ~
                                {{ 'To: ' }}{{ $end_date }}</em>
                        </p>
                        <p class="display">
                            <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }}
                                {{ $leagueInfor->number_of_athletes }}</em>
                        </p>
                    </div>
                </div>
            </div>
            <div class="container d-flex gap-2 mt-4">
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
                        {{ __('List Register') }}
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

                <a href="{{ route('league.leagueSetting', $leagueInfor['slug']) }}"
                    class="btn-custom {{ request()->routeIs('league.leagueSetting') ? 'active' : '' }}">
                    {{ __('Setting') }}
                </a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="wrapper-content-results container">
            <div class="content-results">
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


                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-center league-title">
                            <h4 class="p-0">{{ __('Management Player') }}</h4>
                        </div>

                        <div class="mt-4">
                            @php
                                $type = $leagueInfor->type_of_league ?? 'singles';
                            @endphp

                            @if ($leagueInfor->userLeagues->isNotEmpty())
                                <div class="container form-active">
                                    <form id="formAccountSettings" method="POST"
                                        action="{{ route('league.updatePlayer', $leagueInfor['id']) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if (now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) && now() < $leagueInfor->start_date)
                                            <div class="col-lg-12 text-end text-white">
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-success mb-2">{{ __('Active player') }}</button>

                                                </div>
                                                <div>
                                                    <label class="text-black"><input type="radio" name="status"
                                                            value="1" checked> Active</label>
                                                    <label class="text-black"><input type="radio" name="status"
                                                            value="0"> Inactive</label>
                                                </div>

                                            </div>
                                        @endif

                                        <div class="d-flex flex-wrap gap-2 mb-3 text-white">
                                            <span class="status-player bg-primary px-3 py-2">
                                                {{ __('Total player') }}: {{ count($leagueInfor->userLeagues) }} /
                                                {{ $leagueInfor->number_of_athletes }} {{ __('players') }}
                                            </span>
                                            <span class="status-player bg-primary px-3 py-2">
                                                {{ __('Inactive') }}: {{ $pendingCount }}
                                            </span>
                                            <span class="status-player bg-success px-3 py-2">
                                                {{ __('Active') }}: {{ $acceptedCount }}
                                            </span>
                                        </div>

                                        <table class="table table-bordered align-middle text-center">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Check') }}</th>
                                                    <th>{{ __('Player') }}</th>
                                                    <th>{{ __('Address') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($leagueInfor->userLeagues as $player)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="user_ids[]"
                                                                value="{{ $player->id }}" class="checkbox">
                                                        </td>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('/images/player-team.jpg') }}"
                                                                alt="avatar" class="rounded-circle" width="40">
                                                            <div>
                                                                <span
                                                                    class="fw-bold text-success">{{ getFullNameWithPartner($player, $type) }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="text-success fst-italic">{{ $player->address ?? 'updating' }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="status-player bg-{{ $player->status == 0 ? 'primary' : 'success' }} text-white px-2 py-1">
                                                                {{ $player->status ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                                $disableDelete =
                                                                    now() >
                                                                    date(
                                                                        'Y-m-d',
                                                                        strtotime($leagueInfor->end_date_register),
                                                                    );
                                                            @endphp

                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmDeleteModal{{ $player['id'] }}"
                                                                {{ $disableDelete ? 'disabled' : '' }}>
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" id="confirmDeleteModal{{ $player['id'] }}"
                                                        tabindex="-1"
                                                        aria-labelledby="confirmDeleteLabel{{ $player['id'] }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title"
                                                                        id="confirmDeleteLabel{{ $player['id'] }}">Confirm
                                                                        Delete</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete player
                                                                    <strong>{{ $player->user?->name ?? '---' }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <a
                                                                        href="{{ route('league.destroyPlayer', $player['id']) }}">
                                                                        <button type="button"
                                                                            class="btn btn-danger">{{ __('Delete') }}</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            @else
                                <div class="container alert alert-primary mt-4">{{ __('Tournament is updating data.') }}
                                </div>
                            @endif
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
