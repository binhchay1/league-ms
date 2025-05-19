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
            <div class="content-results">
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
                            <h4 class="p-0">{{'Config Information'}}</h4>
                        </div>

                        <div class="mt-4" style="font-size: 15px; ">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white fw-bold">
                                    <i class="bi bi-plus-circle-fill me-2"></i>{{"Information"}}
                                </div>
                                <form id="formAccountSettings" method="POST" action="{{ route('my.updateMyLeagueMyLeague', $leagueInfor->id) }}" enctype="multipart/form-data">
                                    @csrf()
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Ảnh -->
                                            <div class="col-md-4 text-center">
                                                <label for="image" class="form-label fw-bold">{{"Logo"}}<span class="text-danger">*</span> </label>
                                                <div class="border p-3 rounded">
                                                    <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                                                    <div class=" choose-avatar mt-3">
                                                        <div id="btnimage">
                                                            <img id="showImage" class="show-avatar" src="{{asset($leagueInfor->images ?? '/images/logo-no-background.png')}}"  alt="avatar" style="width: 200px;">
                                                        </div>

                                                        <div id="button">
                                                            <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image') }}</i>
                                                        </div>
                                                    </div>
    {{--                                                <img src="{{asset($leagueInfor->images ?? asset('/images/logo-no-background.png'))}}" alt="Cover Image" class="img-fluid mb-2">--}}
                                                </div>
                                                @if ($errors->has('images'))
                                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                                @endif
                                            </div>

                                            <!-- Thông tin -->
                                            <div class="col-md-8">
                                                <div class="col-6" hidden>
                                                    <label for="lastName" class="form-label">{{ __('Slug') }}</label>
                                                    <input class="form-control" value="{{ old('slug', $leagueInfor['slug']) }}" type="text" name="slug" id="slug" placeholder="{{ __('Enter league slug') }}"/>
                                                    @if ($errors->has('slug'))
                                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{"Name"}} <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" name="name" value="{{$leagueInfor->name}}" required>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{"Prize Money"}}  </label>
                                                    <input type="text" class="form-control" name="money" value="{{$leagueInfor->money}}" required>
                                                    @if ($errors->has('money'))
                                                        <span class="text-danger">{{ $errors->first('money') }}</span>
                                                    @endif
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Start Date"}} <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="start_date" value="{{$leagueInfor->start_date}}" required>
                                                        @if ($errors->has('start_date'))
                                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"End Date"}} <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="end_date" value="{{$leagueInfor->end_date}}" required>
                                                        @if ($errors->has('end_date'))
                                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"End Date Register"}} <span class="text-danger">*</span></label>
                                                        <input type="datetime-local" class="form-control" name="end_date_register" value="{{$leagueInfor->end_date_register}}" required>
                                                        @if ($errors->has('end_date_register'))
                                                            <span class="text-danger">{{ $errors->first('end_date_register') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Start Time"}} <span class="text-danger">*</span></label>
                                                        <input type="time" class="form-control" name="start_time" value="{{$leagueInfor->start_time}}" required>
                                                        @if ($errors->has('start_time'))
                                                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Type League"}} <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="type_of_league">
                                                            @foreach($listTypeLeague as $number => $value)
                                                                <option id="" value="{{ $value }}" {{$value == $leagueInfor->type_of_league ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Format League"}} <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="format_of_league">
                                                            @foreach($listFormatLeague as $number => $value)
                                                                <option id="" value="{{ $value }}" {{$value == $leagueInfor->format_of_league ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Number players"}} <span class="text-danger">*</span></label>
                                                        <select class="form-select" name="number_of_athletes">
                                                            @foreach($listPlayer as $number => $value)
                                                                <option id="" value="{{ $value }}" {{$value == $leagueInfor->number_of_athletes ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">{{"Location"}} </label>
                                                        <input type="text" class="form-control" name="location" value="{{$leagueInfor->location}}" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success mt-2">{{'Update'}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    <script src="{{ asset('js/eventImage.js') }}"></script>
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
