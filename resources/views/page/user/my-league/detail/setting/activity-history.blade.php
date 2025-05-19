@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/page/detail-league/setting.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    @if(Route::current()->getName() == 'my.leagueBracket.info')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}"/>
    @endif
@endsection

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
                            <h2 class=" text-white color-red mb-1 p-0">{{$leagueInfor->name}}</h2>
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
                            <h4 class="p-0">{{'Activity History'}}</h4>

                        </div>
                        <div class="card mb-3 mt-4">
                            <div class="d-flex align-items-start bg-success bg-opacity-10 p-3 rounded">
                                <!-- Icon bên trái -->
                                <div class="me-3">
                                    <i class="bi bi-power fs-1 text-secondary"></i>
                                </div>

                                <!-- Nội dung chính -->
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <!-- Avatar -->
                                        <img src="{{asset($leagueInfor->user->profile_photo_path ?? asset('/images/default-avatar.png'))}}" alt="avatar" class="rounded-circle me-2" width="50" height="50">
                                        <span ><strong>{{$leagueInfor->user->name}}</strong> {{"created tournament."}}</span>
                                    </div>

                                    <!-- Thời gian + thiết bị -->
                                    <p class="text-green">{{ \Carbon\Carbon::parse($leagueInfor->created_at)->diffForHumans() }}</p>
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
