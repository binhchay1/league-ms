@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Group') }}
@endsection

@php
    $isJoin = false;
    $isFull = false;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/group.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
@endsection
<style>
    .alert{
        display: none;
    }

    .content-gr {
        text-align: left!important;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    .content-gr img {
        border-radius: 10px;
        width: 100% !important;
        height: 180px !important;
        object-fit: cover;
    }

    .name-gr {
        font-weight: 600;
        padding: 0 !important;
    }

    .text-muted {
        font-size: .875rem;
        line-height: 1.25rem;
        color: #707070;
        font-weight: 500;
    }

</style>
@section('content')
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Success! message sent successfully.
    </div>

    </div>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 style="color: black; font-weight: 400">{{ __('GROUP') }}</h2>

                </div>
                <div class="col-md-8 mt-4">
                    <form class="d-flex gap-2 justify-content-end" action="{{route('searchGroup')}}" method="GET">

                        <select class="form-select"  name="sort">
                            <option selected>{{'Sort by'}}</option>
                            <option value="newest">{{'Latest'}}</option>
                            <option value="oldest">{{'Oldest'}}</option>
                        </select>

                        <div class="input-group">
                            <input type="text" class="form-control"  name="query" placeholder="{{'group name...'}}">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row g-4">
                @forelse($listGroup as $group)
                    @php
                        if($group->group_users->count() == $group->number_of_members) {
                        $isFull = true;
                        }
                    @endphp

                    @if(Auth::check())
                        @foreach($group->group_users as $user)
                            @php
                                if($user->user_id == Auth::user()->id) {
                                $isJoin = true;
                                }
                            @endphp
                        @endforeach
                    @endif
                    <div class="col-md-4">
                        <div class="feature-box content-gr">
                            <img src="{{$group->images}}" alt="Event" data-id="group-{{ $group->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                            <div  class="c-details-group name-group" data-id="{{ $group->name }}" id="group-{{ $group->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                                <h6 class="mb-0 gr-name">{{ $group->name }}</h6>
                            </div>
                            <p class="text-muted ">{{'Hosted by:'}} {{$group->users->name}} - {{$group->description}} </p>
                            <p class="event-location uppercase  ">📍 {{ $group->location }}</p>
                            <p> ✅ {{$group->note}}</p>
                            <div class="mt-3">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($group->group_users->count() / $group->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <div> <span class="text1">{{ $group->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $group->number_of_members }}</span></span> </div>

                                    @if(!Auth::check())
                                        <div>
                                            <a class="btn btn-success" href="{{ route('login') }}?return_url={{ url()->full() }}">{{ __('Sign in for join') }}</a>
                                        </div>
                                    @else
                                        <div id="btn-join">
                                            @php
                                                $checkAuth = Auth::id();
                                                $userIds = $group->group_users->pluck('user_id')->toArray();
                                                $isJoined = in_array($checkAuth, $userIds);
                                                $isFull = $group->group_users->count() >= $group->number_of_members;

                                                // Lấy bản ghi user hiện tại trong group_users
                                                $userGroup = $group->group_users->firstWhere('user_id', $checkAuth);
                                                $statusRequest = $userGroup->status_request ?? null;
                                            @endphp
                                            @if ($isJoined)
                                                <div>
                                                    @if ($statusRequest == App\Enums\Group::STATUS_ACCEPTED)
                                                        <button class="btn btn-success" disabled>{{ __('Joined') }}</button>
                                                    @else
                                                        <button class="btn btn-warning" disabled>{{ __('Awaiting approval') }}</button>
                                                    @endif
                                                </div>
                                            @elseif ($isFull)
                                                <div>
                                                    <button class="btn btn-danger" disabled>{{ __('Full members') }}</button>
                                                </div>

                                            @else
                                                <div>
                                                    <button class="btn btn-success" id="groups-{{ $group->id }}" onclick="requestJoin(this.id)">
                                                        {{ __('Join group') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>


                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                        <h4 >{{ __('The group is updated!') }}</h4>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
