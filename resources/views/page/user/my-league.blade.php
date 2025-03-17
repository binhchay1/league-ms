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
        background-color: #007bff; /* Màu xanh */
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
</style>
@section('content')
    <section >
        <div class="container-fluid">
            <!-- Header -->
            <div class=" text-black p-3 align-items-center">
                <div class="container d-flex  img-fluid">
                    <img src="{{Auth::user()->profile_photo_path ?? asset('/images/no-image.png')}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                    <div>
                        <h5 class="mb-0">{{Auth::user()->name}}</h5>
                        <p class="mb-1">
                            <i class="bi bi-envelope"></i> tranthuy240814@gmail.com
                        </p>
                        <p class="mb-1 text-muted">
                            <i class="bi bi-telephone"></i> <em>Chưa cập nhật</em>
                        </p>
                        <p class="mb-0 text-muted">
                            <i class="bi bi-calendar"></i> <em>Chưa cập nhật</em>
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
                            <h4>Giải đấu đã tạo</h4>
                            <a href="{{route('league.createTour')}}">
                                <button class="btn btn-success">{{ __('Create League') }}</button>
                            </a>
                        </div>
                        @if(count($listLeague) > 0)
                            @foreach($listLeague as $row)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="{{asset($row->images )}}" class="img-fluid rounded-start" alt="BattleBots">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$row->name}}</h5>
                                        <p class="card-text"><?php echo number_format($row->money ?? 0) . " VND"?> || {{$row->type_of_league}}  || {{$row->location}}</p>
                                        <span class="extend_lb {{ $row->status == 1 ? 'label-success' : 'label-danger' }}">
                                            {{ $row->status == 1 ? "Active" : "Inactive" }}
                                        </span>
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
        <script>
            $(document).ready(function(){
                $(".list-group-item-action").click(function(){
                    $(".list-group-item-action").removeClass("active");
                    $(this).addClass("active");
                });
            });
        </script>

        {{--    <div class="row">--}}
        {{--        @if(count($listGroup) > 0)--}}
        {{--        @foreach($listGroup as $row)--}}
        {{--        <div class="wp-group">--}}
        {{--            <div class="wp-group-content mb-4">--}}
        {{--                <div class="d-flex gr-title" >--}}
        {{--                    <div class=" align-items-center">--}}
        {{--                        <img class="avatar-group"  style="padding: 5px" src="{{ asset($row-> images ?? 'https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}" data-id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">--}}
        {{--                    </div>--}}
        {{--                    <div  class="c-details-group name-group" data-id="group-{{ $row->name }}" id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">--}}
        {{--                        <h6 class="mb-0 gr-name">{{ $row->name }}</h6>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--                <hr>--}}
        {{--                <div class="mt-3 descript-group">--}}
        {{--                    <p>■  {{ __('Description') }}: {{ $row->description }}</p>--}}
        {{--                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>--}}
        {{--                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>--}}
        {{--                    <p><span class="">■ {{ __('Number of member') }} : </span>{{ $row->number_of_members }}</p>--}}
        {{--                    <p class="">----- {{ __('Note') }}: {{ $row->note }}</p>--}}
        {{--                    <div class="mt-3">--}}
        {{--                        <div class="progress">--}}
        {{--                            <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($row->group_users->count() / $row->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
        {{--                        </div>--}}
        {{--                        <div class="d-flex justify-content-between mt-3">--}}
        {{--                            <div> <span class="text1">{{ $row->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $row->number_of_members }}</span></span> </div>--}}

        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        @endforeach--}}
        {{--            @else--}}
        {{--            <div class="text-center">--}}
        {{--                <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">--}}

        {{--                <h4 >{{ __('There are no groups !') }}</h4>--}}
        {{--            </div>--}}
        {{--            @endif--}}
        {{--    </div>--}}

        {{--    <!-- Paginate -->--}}
        {{--    <?php $countGroup= count($listGroup); ?>--}}
        {{--    @if($countGroup > $listGroup->perPage())--}}
        {{--        <div class="navigator short mt-4" >--}}
        {{--            <div class="head d-flex justify-content-center ">--}}
        {{--                <ul class="pagination">--}}
        {{--                    <li>--}}
        {{--                        <a href="{{ $listGroup->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">--}}
        {{--                            <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{__('PREVIOUS')}}</span>--}}
        {{--                        </a>--}}
        {{--                    </li >--}}
        {{--                    &emsp;--}}
        {{--                    <li>--}}
        {{--                        <a href="{{ $listGroup->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">--}}
        {{--                            <span aria-hidden="true">{{__('NEXT')}} <span class="fa fa-angle-right"></span></span>--}}
        {{--                        </a>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    @endif--}}
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
@endsection
