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
        color: green !important;
        font-weight: bold;
    }

    span {
        font-weight: bold;
    }
</style>
@section('content')
    <section >
        <div class="container-fluid">
            <!-- Header -->
            <div class=" text-black p-3 align-items-center">
                <div class="container d-flex  img-fluid">
                    <img src="{{Auth::user()->profile_photo_path ?? asset('/images/no-image.png')}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                    <div>
                        <h2 class="p-0">{{Auth::user()->name}}</h2>
                        <p class="mb-1">
                            <i class="bi bi-envelope"></i> {{Auth::user()->email}}
                        </p>
                        <p class="mb-1 text-muted">
                            <i class="bi bi-telephone"></i> <em>{{Auth::user()->phone}}</em>
                        </p>
                        <p class="mb-0 text-muted">
                            <i class="bi bi-calendar"></i> <em>{{'updating'}}</em>
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Main Content -->
            <div class="container bg-gray">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 p-3 bg-light">
                        <div class="list-group">
                            <a href="#" data-id="league-created" class="list-group-item list-group-item-action active">{{'League created'}}</a>
                            <a href="#" data-id="league-assigned" class="list-group-item list-group-item-action">{{'League assigned'}}</a>
                            <a href="#"  data-id="league-join" class="list-group-item list-group-item-action">{{'League joined'}}</a>
                        </div>
                    </div>

                    <!-- Tournament List -->
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>{{'My leagues'}}</h4>
                            <a href="{{route('league.createTour')}}">
                                <button class="btn btn-success">{{ __('Create League') }}</button>
                            </a>
                        </div>
                        @if(count($listLeague) > 0)
                            @foreach($listLeague as $row)
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <img src="{{asset($row->images ?? asset('/images/no-image.png') )}}" class="img-fluid rounded-start" alt="BattleBots">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{route('my.leagueDetail', $row->slug)}}" title="{{ $row->name }}">
                                                            <h5 class="card-title color-red" >{{$row->name}}</h5>
                                                        </a>
                                                        @if(now() > date('Y-m-d', strtotime($row->end_date_register)) && now() < $row->start_date)
                                                            <div>
                                                                <a href="{{route('my.myLeagueActivePlayer', $row->slug)}}">
                                                                    <button class="btn btn-success">{{ __('Active Player Register League') }}</button>
                                                                </a>
                                                                @if(count($row->schedule) == 0)
                                                                    <a href="{{ route('auto.create.myLeague.schedule') }}?s={{ $row->slug }}">
                                                                        <button class="btn btn-success">{{ __('Create Schedule') }}</button>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <p class="card-text"><?php echo number_format($row->money ?? 0) . " VND"?> || {{$row->type_of_league}}  || {{$row->location}}</p>
                                                    @if(now()->between($row->start_date, $row->end_date))
                                                        <span class="p-1 bg-success text-white rounded">{{'Active'}}</span>
                                                    @elseif(now() < date('Y-m-d', strtotime($row->end_date_register)))
                                                        <span class="p-1 bg-warning text-black rounded">{{'Registering'}}</span>
                                                    @elseif(now() > date('Y-m-d', strtotime($row->end_date_register)) && now() < $row->start_date)
                                                        <span class="p-1 bg-warning text-black rounded">{{'End Register'}}</span>
                                                    @elseif(now() > $row->end_date)
                                                        <span class="p-1 bg-danger text-white rounded">{{'Ended '}}</span>
                                                    @endif
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                            @endforeach
                        @else
                            <div class="text-center">
                                <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                <h4 >{{ __('There are no leagues!') }}</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

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
        $(document).ready(function(){
            $(".list-group-item-action").click(function(){
                $(".list-group-item-action").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection
