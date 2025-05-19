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
            </div>
        </div>
        <!-- Main Content -->
        <div class="wrapper-content-results container">
            <div class="content-results mt-4">
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
                            <li>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteLeagueModal">
                                    <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete Tournament') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Delete League Modal -->
                    <div class="modal fade" id="confirmDeleteLeagueModal" tabindex="-1" aria-labelledby="deleteLeagueLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteLeagueLabel">{{ __('Confirm Delete') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('Are you sure you want to delete this tournament? This action cannot be undone.') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>

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
                            <h4 class="p-0">{{'Setting'}}</h4>

                        </div>
                        <div class="text-center mt-4">
                            <img src="{{asset('/images/bg-league.png')}}" alt="Banner" class="img-fluid">
                        </div>
                        <div class="mt-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white fw-bold">
                                    <i class="bi bi-plus-circle-fill me-2"></i>{{"Information"}}
                                </div>
                                <div class="card-body">
                                        <div class="row">
                                            <!-- Ảnh -->
                                            <div class="col-md-4 text-center">
                                                <label for="image" class="form-label fw-bold">{{"Image"}} </label>
                                                <div class="border p-3 rounded">
                                                    <img src="{{asset($leagueInfor->images ?? asset('/images/logo-no-background.png'))}}" alt="Cover Image" class="img-fluid mb-2">

                                                </div>
                                            </div>

                                            <!-- Thông tin -->
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{"Name"}}  </label>
                                                    <input type="text" class="form-control" name="name" value="{{$leagueInfor->name}}" required>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Start Date"}} </label>
                                                        <input type="date" class="form-control" name="phone" value="{{$leagueInfor->start_date}}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Start Date"}} </label>
                                                        <input type="date" class="form-control" name="phone" value="{{$leagueInfor->end_date}}" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{"Location"}}</label>
                                                    <input type="text" class="form-control" name="location" value="{{$leagueInfor->location}}" required>
                                                </div>

                                            </div>
                                        </div>
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
