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

    .label-success {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: mediumpurple;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .gr-name {
        color: green !important;
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
                        <h2 class="mb-1 p-0">{{Auth::user()->name}}</h2>
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
                            <a href="#" data-id="league-created" class="list-group-item list-group-item-action active">{{'Group created'}}</a>
                            <a href="#" data-id="league-assigned" class="list-group-item list-group-item-action">{{'Group assigned'}}</a>
                            <a href="#"  data-id="league-join" class="list-group-item list-group-item-action">{{'Group joined'}}</a>
                        </div>
                    </div>

                    <!-- Tournament List -->
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
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
                            <div class="text-center">
                                <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                <h4 >{{ __('There are no groups!') }}</h4>
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
@endsection
