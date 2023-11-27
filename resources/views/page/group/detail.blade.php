@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@php
use Illuminate\Support\Facades\Hash;
@endphp

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
<style>
    #chat1 .form-outline .form-control~.form-notch div {
        pointer-events: none;
        border: 1px solid;
        border-color: #eee;
        box-sizing: border-box;
        background: transparent;
    }

    #chat1 .form-outline .form-control~.form-notch .form-notch-leading {
        left: 0;
        top: 0;
        height: 100%;
        border-right: none;
        border-radius: .65rem 0 0 .65rem;
    }

    #chat1 .form-outline .form-control~.form-notch .form-notch-middle {
        flex: 0 0 auto;
        max-width: calc(100% - 1rem);
        height: 100%;
        border-right: none;
        border-left: none;
    }

    #chat1 .form-outline .form-control~.form-notch .form-notch-trailing {
        flex-grow: 1;
        height: 100%;
        border-left: none;
        border-radius: 0 .65rem .65rem 0;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading {
        border-top: 0.125rem solid #39c0ed;
        border-bottom: 0.125rem solid #39c0ed;
        border-left: 0.125rem solid #39c0ed;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-leading,
    #chat1 .form-outline .form-control.active~.form-notch .form-notch-leading {
        border-right: none;
        transition: all 0.2s linear;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle {
        border-bottom: 0.125rem solid;
        border-color: #39c0ed;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-middle,
    #chat1 .form-outline .form-control.active~.form-notch .form-notch-middle {
        border-top: none;
        border-right: none;
        border-left: none;
        transition: all 0.2s linear;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing {
        border-top: 0.125rem solid #39c0ed;
        border-bottom: 0.125rem solid #39c0ed;
        border-right: 0.125rem solid #39c0ed;
    }

    #chat1 .form-outline .form-control:focus~.form-notch .form-notch-trailing,
    #chat1 .form-outline .form-control.active~.form-notch .form-notch-trailing {
        border-left: none;
        transition: all 0.2s linear;
    }

    #chat1 .form-outline .form-control:focus~.form-label {
        color: #39c0ed;
    }

    #chat1 .form-outline .form-control~.form-label {
        color: #bfbfbf;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .append-css-this {
        border-radius: 15px;
        background-color: #fbfbfb;
    }

    .append-css-that {
        border-radius: 15px;
        background-color: rgba(57, 192, 237, .2);
    }

    @media screen and (min-width: 1080px) {
        #chat-area {
            height: 300px;
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Group') }}</h1>
        <p class="center">{{ __('Join the group to have the opportunity to interact and chat with others.') }}</p>
    </div>
</section>

<section id="detail-group" class="container-fluid">
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card" id="chat1" style="border-radius: 15px;">
                    <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0">
                        <p class="mb-0 fw-bold">{{ ('Live chat') }}</p>
                    </div>
                    <div class="card-body">
                        <div id="chat-area">
                            @foreach($messages as $message)
                            @if($message->user_id == Auth::user()->id)
                            <div class="d-flex flex-row justify-content-end mb-4">
                                <div class="p-3 me-3 border append-css-this">
                                    <p class="small mb-0">{{ $message->message }}</p>
                                </div><img src="{{ $message->users->profile_photo_path }}" alt="Avatar" width="45">
                            </div>
                            @else
                            <div class="d-flex flex-row justify-content-start mb-4"><img src="{{ $message->users->profile_photo_path }}" alt="Avatar" width="45">
                                <div class="p-3 ms-3 append-css-that">
                                    <p class="small mb-0">{{ $message->message }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div>
                            <p id="statusMessage">{{ __('Last message : ') . $messages->last()->created_at; }} </p>
                        </div>
                        <div class="form-outline d-flex">
                            <textarea class="form-control" id="text-area-write-message" rows="4" placeholder="{{ __('Type your message') }}"></textarea>
                            <button id="send-massage">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="http://localhost:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var elem = document.getElementById('chat-area');
    elem.scrollTop = elem.scrollHeight;

    $('#send-massage').on('click', function() {
        sendMessage();
    });

    const g_i = '<?php echo $getGroup->id ?>';
    let group = 'chat-group-' + g_i;

    Echo.channel('chat-group-1').listen('.message-group', function(e) {
        let cU = e.user_id;
        let bU = '<?php echo Hash::make(Auth::user()->id); ?>';
        let ap = '';
        if (cU == bU) {
            ap = '<div class="d-flex flex-row justify-content-end mb-4"><div class="p-3 me-3 border append-css-this"><p class="small mb-0">' + e.message + '</p></div><img src="' + e.user_image + '" alt="Avatar" width="45"></div>';
        } else {
            ap = '<div class="d-flex flex-row justify-content-start mb-4"><img src="' + e.user_image + '" alt="Avatar" width="45"><div class="p-3 ms-3 append-css-that"><p class="small mb-0">' + e.message + '</p></div></div>';
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
        let statusMessage = '<?php echo __('Sending')  ?>' + ' ' + datetime;
        let sImage = '<?php echo Auth::user()->profile_photo_path ?>';
        let ap = '<div class="d-flex flex-row justify-content-end mb-4"><div class="p-3 me-3 border append-css-this"><p class="small mb-0">' + message + '</p></div><img src="' + sImage + '" alt="Avatar" width="45"></div>';
        $('#chat-area').append(ap);
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

            }
        });
    }
</script>
@endsection
