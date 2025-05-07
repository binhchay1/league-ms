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

    .list-group-item-action:hover {
        background: #ff3a35 !important;
        color: white !important;
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

    .status-league {
        font-weight: bold !important;
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
    }


    .sidebar-list li a:hover {
        background-color: lightgrey;

    }

    .sidebar-list li.active a {
        background-color: #ffffff;
        color: #4a5773;
        border-radius: 0;
    }

    .group-title {
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
    <section >
        <div class="">
            <!-- Header -->
            <div class=" text-black align-items-center" style="background: #707787;padding: 10px; margin-top: -20px;">
                <div class="container d-flex p-0 img-fluid">
                    <img src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png')}}" alt="User" width="150" height="150" class=" me-3 " >
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
                    <!-- Sidebar -->
                    <div class="col-md-3 p-0 mt-3" style="background-color: #4a5773; height: 60%;">
                        <ul class="sidebar-list mt-4">
                            <li class="{{ request()->routeIs('group.groupCreateByUser') ? 'active' : '' }}">
                                <a href="{{ route('group.groupCreateByUser') }}">
                                    <i class="fas fa-pen mr-2"></i>{{'Group Created'}}
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('group.groupJoin') ? 'active' : '' }}">
                                <a href="{{ route('group.groupJoin') }}">
                                    <i class="fas fa-users mr-2"></i> {{'Group Joined'}}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tournament List -->
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between group-title align-items-center mb-3">
                            <h4>{{'My groups'}}</h4>
                            <a href="{{route('group.createGroup')}}">
                                <button class="btn btn-success">{{ __('Create Group') }}</button>
                            </a>
                        </div>
                        @if(count($listGroup) > 0)
                            @foreach($listGroup as $row)
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="{{ asset($row->images ?? '/images/logo-no-background.png') }}" width="150" height="auto" class="img-fluid rounded-start" alt="BattleBots">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div  class=" name-group" data-id="{{ $row->name }}" title="{{ $row->name }}" id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                                                        <h6 class="mb-0 gr-name">{{ $row->name }}</h6>
                                                    </div>
                                                    @if($row->status == 'private')
                                                        <a href="{{route('my.myGroupActiveUser', $row->id)}}">
                                                            <button class="btn btn-success">{{ __('Active User Join Group') }}</button>
                                                        </a>
                                                    @endif
                                                </div>
                                                <p class="card-text">{{'Hosted: '}}  {{$row->users->name}} || {{$row->location}} </p>
                                                <p><i class="bi bi-bookmark"></i>
                                                    <span class="">{{$row->description}}</span>
                                                </p>
                                                <p><i class="bi bi-shield-check"></i>
                                                    <span class="extend_lb label-success">{{$row->status}}</span>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach
                        @else
                            <label class="m-0 block text-sm font-medium text-gray-700">
                                {{'No group yet.'}}
                            </label>
                        @endif
                    </div>
                </div>
            </div>
            @if($listGroup->total() > $listGroup->perPage())
                <div class="navigator short  mt-4">
                    <div class="head d-flex justify-content-center ">
                        <ul class="pagination">
                            <li>
                                <a href="{{ $listGroup->previousPageUrl() }}" aria-label="Previous" style="color: red"
                                   class="prevPlayersList">
                                <span aria-hidden="true">
                                    <span class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}
                                </span>
                                </a>
                            </li>
                            &emsp;
                            <li>
                                <a href="{{ $listGroup->nextPageUrl() }}" aria-label="Next" style="color: red"
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
            $.ajax({
                url: "/check-group-join",
                type: "GET",
                data: { group: id },
                success: function(response) {
                    if (response.joined) {
                        // Nếu user đã join, redirect sang trang nhóm

                        let url = '/detail-group?g_i=' + id;
                        window.location.href = url;
                    } else {
                        // Nếu chưa join, hiển thị cảnh báo
                        toastr.options.timeOut = 10000;
                        toastr.success("You should join group before accept");
                        setTimeout(function() {
                            location.reload(); // Change this to your desired URL
                        }, 5000); // 5000 milliseconds = 5 seconds

                    }
                },
                error: function() {
                    alert("Lỗi khi kiểm tra trạng thái nhóm, vui lòng thử lại!");
                }
            });

        }



        function requestJoin(id) {
            let g_i = id.substring(7);
            console.log(g_i)
            let url = '/join-group/';

            $.ajax({
                url: url,
                type: 'get',
                data: {
                    g_i: g_i
                }
            }).done(function(result) {
                if (result == 'success') {
                    toastr.options.timeOut = 10000;
                    toastr.success("Thank you for joining the group!");
                    setTimeout(function() {
                        location.reload(); // Change this to your desired URL
                    }, 5000); // 5000 milliseconds = 5 seconds

                } else if (result == 'wait') {
                    toastr.options.timeOut = 10000;
                    toastr.success("Thank you for joining the group, we will respond immediately.!");
                    setTimeout(function() {
                        location.reload(); // Change this to your desired URL
                    }, 5000); // 5000 milliseconds = 5 seconds
                } else {
                    toastr.options.timeOut = 10000;
                    toastr.error("Error when joining group!");
                    setTimeout(function() {
                        location.reload(); // Change this to your desired URL
                    }, 5000); // 5000 milliseconds = 5 seconds
                }
            });
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
