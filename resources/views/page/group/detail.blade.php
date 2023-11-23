@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@section('css')
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
                        <div class="d-flex flex-row justify-content-start mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="Avatar" width="45">
                            <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                                <p class="small mb-0">...</p>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-end mb-4">
                            <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                                <p class="small mb-0">Thank you, I really like your product.</p>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp" alt="Avatar" width="45">
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
<script>
    $('$send-massage').on('click', function() {
        sendMessage();
    });

    Echo.private('chat').listen('message.broadcast', (e) => {
        console.log(e);
        this.messages.push({
            message: e.message.message,
            user: e.user
        });
    });

    function sendMessage() {
        let message = $('#text-area-write-message').val();
    }
</script>
@endsection
