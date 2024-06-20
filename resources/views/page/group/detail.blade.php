@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@php
use Illuminate\Support\Facades\Hash;

$utility = new \App\Enums\Utility();
@endphp

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
@endsection

@section('content')
<section class="container " id="heading">
    <div class="row training" style="background: #ad9696;">
        <div class="col-lg-1 mt-4">
            <img src="{{ asset($getGroup->images) }}" width="100" height="100" healt="Group Avatar" />
        </div>
        <div class="col-lg-10 mt-3" style="margin-left: 10px;">
            <div class="d-flex">
                <h1 class="m-0 p-0">{{ $getGroup->name }}</h1>
            </div>
            <p>{{ $getGroup->users->name }}</p>
            <p><span class="fw-bold">* {{ __('Description') }} : </span>{{ $getGroup->description }}</p>
            <p><span class="fw-bold">* {{ __('Activity time') }} : </span>{{ $getGroup->activity_time }}</p>
            <p><span class="fw-bold">* {{ __('Location') }} : </span>{{ $getGroup->location }}</p>
            <p><em><span class="fw-bold">-----{{ __('Note') }} : </span>{{ $getGroup->note }}</em></p>
        </div>
    </div>
    <div class="d-flex">
        @if(Auth::check() and $isJoined)
        <div class="mt-4" style="margin-right: 10px;">
            <button class="btn btn-success btn-training" id="group-{{ $getGroup->name }}" onclick="training(this.id)">{{ __('Training') }}</button>
        </div>
        @endif

        <div class="mt-4" data-bs-toggle="modal" data-bs-target="#rankingModal">
            <button class="btn btn-success btn-training">{{ __('Ranking') }}</button>
        </div>
    </div>

</section>

<section id="detail-group" class="container-fluid">
    <div class="container py-5" style="padding-top: 0 !important;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-6" style="padding-left: 0;">
                <div class="card" id="chat1" style="border-radius: 15px;">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="background: #ad9696 !important;">
                        <p class="mb-0 fw-bold">{{ __('Live chat') }}</p>
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
                            <textarea class="form-control" id="text-area-write-message" rows="4" placeholder="{{ __('Type your message') }}"></textarea>
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
                        <div class="form-outline d-flex flex-column">
                            <p>{{ __('Please login for join group') }}</p>
                            <a id="login" class="btn btn-success" href="{{ route('login') }}?return_url={{ url()->full() }}">
                                {{ __('Login') }}
                            </a>
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
            <div class="col-md-4 col-lg-6 col-xl-6">
                <div class="card" id="chat1" style="border-radius: 15px;">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="background: #ad9696 !important;">
                        <p class="mb-0 fw-bold">{{ __('List members') }}</p>
                        <p class="mb-0 fw-bold">( {{ $getGroup->group_users->count() }} / {{ $getGroup->number_of_members }} )</p>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($members as $member)
                            <li class="d-flex mt-3">
                                <img src="{{ $member->users->profile_photo_path ?? asset('/images/no-image.png')  }}" width="40" height="40" />
                                <a style="margin-left: 10px;">{{ $member->users->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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
@endsection
