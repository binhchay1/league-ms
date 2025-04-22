@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@php
use Illuminate\Support\Facades\Hash;

$utility = new \App\Enums\Utility();
@endphp
<style>
    .btn-training {
        background-color: #ff3a35 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 10px;
        border: #ff3a35 !important;
    }

    .btn-training:hover {
        background-color: #ff4b2b !important;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        z-index: 1050;
        background-color: white;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Khi hover vào nav-item hoặc dropdown-menu thì hiển thị */
    .nav-item:hover .dropdown-menu,
    .dropdown-menu:hover {
        display: block;
    }

    .table td {
        vertical-align: middle;
        word-break: break-word;
        white-space: normal;
    }

    .text-wrap {
        max-width: 300px; /* hoặc rộng hơn nếu bạn muốn */
    }
</style>
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
@endsection

@section('content')
<section class=" " id="heading">

    <div class=" text-black p-3 align-items-center">
        <div class="container d-flex  img-fluid">
            <img src="{{ asset($getGroup->images ?? '/images/logo-no-background.png') }}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
            <div>
                <h2 class="p-0">{{$getGroup->name}}</h2>
                <p class="">
                    <i class="bi bi-bookmark"></i> {{$getGroup->description}}
                </p>
                <p class=" ">
                    <i class="bi bi-geo-alt"></i> <em>{{$getGroup->location}}</em>
                </p>
                <p class="">
                    <i class="bi bi-people"></i> <em>{{$getGroup->number_of_members}}</em>
                </p>
                <p> <i class="bi bi-card-checklist"></i> {{$getGroup->note}}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class=" container d-flex">
        @if(Auth::check() and $isJoined)
        <div class="mt-4" style="margin-right: 10px;">
            <button class=" btn-training" id="group-{{ $getGroup->name }}" onclick="training(this.id)">{{ __('Training') }}</button>
        </div>
        @endif

        <div class="mt-4" data-bs-toggle="modal" data-bs-target="#rankingModal" style="margin-right: 10px;">
            <button class=" btn-training">{{ __('Ranking') }}</button>
        </div>

        @if(Auth::check() && Auth::user()->id == $getGroup->group_owner)
        <!-- Dropdown -->
            <div class="nav-item">
                <a class="mt-4 btn-training mx-2 nav-link">{{__('GROUP')}} ▼</a>
                <div class="dropdown-content">
                    <a href="{{route('my.infoMyGroup', $getGroup->id)}}">{{__('Edit Group')}}</a>
                    <a class="openDeleteModal" href="#" data-url="{{ route('delete.myGroup', $getGroup->id) }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"> {{ 'Delete Group' }}</a>

                </div>
            </div>

            <!-- Bootstrap Modal -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <!-- Header -->
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold" id="confirmDeleteModalLabel">
                                <i class="bi bi-exclamation-triangle-fill "></i> {{ 'Delete Group' }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body text-center">
                            <p class="text-dark fw-medium fs-5">
                                {{ 'Are you sure you want to delete this group?' }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> {{ 'Cancel' }}
                            </button>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4">
                                    <i class="bi bi-trash"></i> {{ 'Delete' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<section id="detail-group" class="container-fluid">
    <div class="container py-5" style="padding-top: 0 !important;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-6 card-chat" style="width: 45%" >
                <div class="card" id="chat1" style="border-radius: 0">
                    <div class="card-header d-flex justify-content-between " style="background: #0d6efd !important;border-radius: 0; ">
                        <p class="mb-0  " style="color: white">{{ __('Live chat') }}</p>
                    </div>
                    <div class="card-body">
                        @if(Auth::check() and $isJoined)
                        <div id="chat-area">
                            @foreach($messages as $message)
                            @if($message->user_id == Auth::user()->id)
                            <div class="d-flex flex-row justify-content-end mb-4">
                                <div class="p-3 me-3 border append-css-this">
                                    <p class="small mb-0">{{ $message->message }}</p>
                                </div><img src="{{ $message->users->profile_photo_path ?? asset('/images/no-image.png') }}" alt="Avatar" width="40" height="40">
                            </div>
                            @else
                            <div class="d-flex flex-row justify-content-start mb-4"><img src="{{ $message->users->profile_photo_path ?? asset('/images/no-image.png') }}" alt="Avatar" width="40" height="40">
                                <div class="p-3 ms-3 append-css-that">
                                    <p class="small mb-0">{{ $message->message }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @if(!empty($message))
                        <div>
                            <p id="statusMessage">{{ __('Last message : ') . $messages->last()->created_at; }} </p>
                        </div>
                        @endif
                        <div class="form-outline d-flex">
                            <textarea class="form-control" id="text-area-write-message" rows="4" placeholder="{{ __('Type your message') }}" style="margin-right: 10px"></textarea>
                            <button id="send-massage">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                        @endif
                        @if(!Auth::check() or !$isJoined)
                        <div id="chat-area-no-login">
                            <div id="bg-chat-area">

                            </div>
                            <div class="d-flex flex-row justify-content-end mb-4">
                                <div class="p-3 me-3 border append-css-this">
                                    <p class="small mb-0">{{ __('Hi') }}</p>
                                </div><img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" width="45">
                            </div>
                            <div class="d-flex flex-row justify-content-start mb-4"><img src="{{ asset('images/no-image.png') }}" alt="Avatar" width="45">
                                <div class="p-3 ms-3 append-css-that">
                                    <p class="small mb-0">{{ __('Hello') }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                        if(!Auth::check()) {
                        @endphp
                                <div>
                                    <a style="margin-top: 30px" class="btn btn-success" href="{{ route('login') }}?return_url={{ url()->full() }}">{{ __('Sign in for join') }}</a>
                                </div>
                        @php
                        } else {
                        @endphp
                        <div class="form-outline d-flex flex-column">
                            <p>{{ __('Please join group for explore chat, ...') }}</p>
                            <button class="btn btn-primary" id="groups-{{ $getGroup->name }}" onclick="requestJoin(this.id)">
                                {{ __('Join group') }}
                            </button>
                        </div>
                        @php }
                        @endphp

                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 card-member" style="width: 55%">
                <div class="card-header d-flex justify-content-start" style="background: #0d6efd !important; border-radius: 0; padding: 10px">
                    <p class="m-0 text-white">{{__('Members')}}</p>
                </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-th">{{'INFORMATION'}}</th>
                            <th  class="text-th">{{'NAME'}}</th>
                            <th class="text-th">{{'PHONE'}}</th>
                            <th class="text-th">{{'ADDRESS'}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td class="d-flex ">
                                    <img src="{{ asset($member->users->profile_photo_path ?? 'images/default-avatar.png') }}" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                </td>
                                <td class="align-items-center text-wrap">{{$member->users->name}}</td>
                                <td class="align-items-center">
                                    <span>{{ $member->users->phone }}</span>
                                </td>
                                <td class="align-items-center">{{ $member->users->address }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</section>
@include('includes.modal_ranking_group')
@endsection

@section('js')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    <?php if (Auth::check()) { ?>
        scrollToEnd();
        $('#send-massage').on('click', function() {
            sendMessage();
        });

        const g_i = '<?php echo $getGroup->id ?>';
        const group = 'chat-group-' + g_i;

        Echo.channel(group).listen('.message-group', (e) => {
            let cU = e.user_id;
            let cDate = new Date();
            let bU = '<?php echo Hash::make(Auth::user()->id); ?>';
            let ap = '';
            let datetime = cDate.getDate() + "/" +
                (cDate.getMonth() + 1) + "/" +
                cDate.getFullYear() + " @ " +
                cDate.getHours() + ":" +
                cDate.getMinutes() + ":" +
                cDate.getSeconds();

            if (cU == bU) {
                ap = '<div class="d-flex flex-row justify-content-end mb-4"><div class="p-3 me-3 border append-css-this"><p class="small mb-0">' + e.message + '</p></div><img src="' + e.user_image + '" alt="Avatar" width="40" height="40"></div>';
            } else {
                ap = '<div class="d-flex flex-row justify-content-start mb-4"><img src="' + e.user_image + '" alt="Avatar" width="40" height="40"><div class="p-3 ms-3 append-css-that"><p class="small mb-0">' + e.message + '</p></div></div>';
                let statusMessage = '<?php echo __('Last message :')  ?>' + ' ' + datetime;
                scrollToEnd();
                $('#statusMessage').empty();
                $('#statusMessage').html(statusMessage);
            }

            $('#chat-area').append(ap);
        });

        function sendMessage() {
            let tA = $('#text-area-write-message');
            let message = tA.val();
            let url = 'messages';
            let cDate = new Date();
            let datetime = cDate.getDate() + "/" +
                (cDate.getMonth() + 1) + "/" +
                cDate.getFullYear() + " @ " +
                cDate.getHours() + ":" +
                cDate.getMinutes() + ":" +
                cDate.getSeconds();
            let statusMessage = '<?php echo __('Sending :')  ?>' + ' ' + datetime;
            let sImage = '<?php echo (Auth::user()->profile_photo_path == null ? '/images/no-image.png' : Auth::user()->profile_photo_path) ?>';
            let ap = '<div class="d-flex flex-row justify-content-end mb-4"><div class="p-3 me-3 border append-css-this"><p class="small mb-0">' + message + '</p></div><img src="' + sImage + '" alt="Avatar" width="40" height="40"></div>';
            $('#chat-area').append(ap);
            $('#statusMessage').empty();
            $('#statusMessage').html(statusMessage);
            tA.val('');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: message,
                    g_i: g_i
                }
            }).done(function(result) {
                if (result.status == 'sent') {
                    let statusMessage = '<?php echo __('Sent :')  ?>' + ' ' + datetime;
                    scrollToEnd();
                    $('#statusMessage').empty();
                    $('#statusMessage').html(statusMessage);
                }
            });
        }

        function scrollToEnd() {
            let elem = document.getElementById('chat-area');
            if(elem != null) {
                elem.scrollTop = elem.scrollHeight;
            }

        }

        function requestJoin(id) {
            let g_i = id.substring(7);
            let url = '/join-group/';

            $.ajax({
                url: url,
                type: 'get',
                data: {
                    g_i: g_i
                }
            }).done(function(result) {
                if (result == 'success') {
                    let btnSuccess = '<div><button class="btn btn-secondary" disabled>' + '<?php echo __('Joined') ?>' + '</button></div>'
                    $('#btn-join').empty();
                    $('#btn-join').append(btnSuccess);
                    window.location.reload();
                } else if (result == 'wait') {
                    let btnWait = '<div><button class="btn btn-secondary" disabled>' + '<?php echo __('Wait group owner accept') ?>' + '</button></div>'
                    $('#btn-join').empty();
                    $('#btn-join').append(btnWait);
                } else {
                    let btnFail = '<div><p class="text-red">' + '<?php echo __('Fail to join. Try again later!') ?>' + '</p></div>'
                    $('#btn-join').append(btnFail);
                }
            });
        }
    <?php } ?>


    function training(id) {
        let name = id.substring(6);
        let url = '/group-training?g_i=' + name;

        window.location.href = url;
    }
</script>

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
@endsection
