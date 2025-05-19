@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<section>
    <div class="">
        <!-- Header -->
        <div class=" text-black align-items-center" style="background: #707787;padding: 10px; margin-top: -20px;">
            <div class="container d-flex p-0 img-fluid">
                <img src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png')}}" alt="User" width="150" height="150" class=" me-3 ">
                <div>
                    <h2 class="p-0 text-white">{{Auth::user()->name}}</h2>
                    <p class="mb-1 text-white">
                        <i class="bi bi-envelope "></i> {{Auth::user()->email}}
                    </p>
                    <p class="mb-1 text-muted ">
                        <i class="bi bi-telephone text-white"></i> <em class="text-white">{{Auth::user()->phone ?? 'updating' }}</em>
                    </p>
                    <p class="mb-0 text-muted ">
                        <i class="bi bi-calendar text-white"></i> <em class="text-white">{{Auth::user()->age ?? 'updating' }}</em>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <!-- Main Content -->
        <div class="container bg-gray">
            <div class="row">
                <div class="col-md-3 p-0 mt-3" style="background-color: #4a5773;">
                    <ul class="sidebar-list mt-4">
                        <li class="{{ request()->routeIs('league.leagueCreate') ? 'active' : '' }}">
                            <a href="{{ route('league.leagueCreate') }}">
                                <i class="fas fa-pen mr-2"></i>{{'League Created'}}
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('league.leagueJoin') ? 'active' : '' }}">
                            <a href="{{ route('league.leagueJoin') }}">
                                <i class="fas fa-users mr-2"></i> {{'League Joined'}}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tournament List -->
                <div class="col-md-9 p-3">
                    <div class="d-flex justify-content-between align-items-center league-title mb-3">
                        <h4>{{'My leagues join'}}</h4>
                        <a href="{{route('league.createTour')}}">
                            <button class="btn btn-success">{{ __('Create League') }}</button>
                        </a>
                    </div>
                    @if(!($listLeague->isEmpty()))
                    @foreach($listLeague as $row)
                    @if($row && isset($row->slug))
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <img src="{{asset($row->images ?? asset('/images/no-image.png') )}}" class="img-fluid rounded-start" alt="BattleBots">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{route('league.info', $row->slug)}}" title="{{ $row->name }}">
                                            <h5 class="card-title color-red">{{$row->name}}</h5>
                                        </a>
                                        {{-- @if(now() > date('Y-m-d', strtotime($row->end_date_register)) && now() < $row->start_date)--}}
                                        {{-- <div>--}}
                                        {{-- <a href="{{route('my.myLeagueActivePlayer', $row->slug)}}">--}}
                                        {{-- <button class="btn btn-success">{{ __('Active Player Register League') }}</button>--}}
                                        {{-- </a>--}}
                                        {{-- @if(count($row->schedule) == 0)--}}
                                        {{-- <a href="{{ route('auto.create.myLeague.schedule') }}?s={{ $row->slug }}">--}}
                                        {{-- <button class="btn btn-success">{{ __('Create Schedule') }}</button>--}}
                                        {{-- </a>--}}
                                        {{-- @endif--}}
                                        {{-- </div>--}}
                                        {{-- @endif--}}
                                    </div>

                                    <p class="card-text"><?php echo number_format($row->money ?? 0) . " VND" ?> || {{$row->type_of_league}} || {{$row->location}}</p>
                                    @if(now()->between($row->start_date, $row->end_date))
                                    <span class="status-league p-1 bg-success text-white rounded">{{'Active'}}</span>
                                    @elseif(now() < date('Y-m-d', strtotime($row->end_date_register)))
                                        <span id="reg" class="status-league p-1 bg-warning text-white rounded">{{'Registering'}}</span>
                                        @elseif(now() > date('Y-m-d', strtotime($row->end_date_register)) && now() < $row->start_date)
                                            <span id="end-reg" class=" status-league p-1 bg-warning text-white rounded">{{'End Register'}}</span>
                                            @elseif(now() > $row->end_date)
                                            <span class="status-league p-1 bg-danger text-white rounded">{{'Ended '}}</span>
                                            @endif
                                </div>

                            </div>

                        </div>

                    </div>
                    @endif
                    @endforeach
                    @else
                    <label class="m-0 block text-sm font-medium text-gray-700">
                        {{'No tournament yet.'}}
                    </label>
                    @endif
                </div>
            </div>
        </div>
        @if($listLeague->total() > $listLeague->perPage())
        <div class="navigator short  mt-4">
            <div class="head d-flex justify-content-center ">
                <ul class="pagination">
                    <li>
                        <a href="{{ $listLeague->previousPageUrl() }}" aria-label="Previous" style="color: red"
                            class="prevPlayersList">
                            <span aria-hidden="true">
                                <span class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}
                            </span>
                        </a>
                    </li>
                    &emsp;
                    <li>
                        <a href="{{ $listLeague->nextPageUrl() }}" aria-label="Next" style="color: red"
                            class="nextPlayersList">
                            <span aria-hidden="true">{{ __('NEXT') }} <span class="fa fa-angle-right"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
    </div>

</section>
@endsection

@section('js')
<script>
    function detailGroup(id) {
        let name = id.substring(6);
        let url = '/detail-group?g_i=' + name;

        window.location.href = url;
    }
</script>
<script>
    $(document).ready(function() {
        $(".list-group-item-action").click(function() {
            $(".list-group-item-action").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
@endsection
