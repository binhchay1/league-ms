@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Group') }}
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .card {
        margin-left: 10px;
        padding: 0;
    }

    .row {
        display: flex;
        justify-content: center;
    }

    p {
        margin-bottom: 0 !important;
        padding-bottom: 15px !important;
    }

    .card {
        border: none;
        border-radius: 10px;
        background-color: #eee;
    }

    .c-details span {
        font-weight: 300;
        font-size: 13px;
    }

    .icon {
        width: 50px;
        height: 50px;
        background-color: #eee;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 39px;
    }

    .badge {
        background-color: #eee;
    }

    .badge span {
        background-color: #fffbec;
        padding: 7px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .progress {
        height: 10px;
        border-radius: 10px
    }

    .progress div {
        background-color: red
    }

    .text1 {
        font-size: 14px;
        font-weight: 600
    }

    .text2 {
        color: #a5aec0;
    }

    .ancient {
        color: #fa5448;
    }

    .emerging {
        color: #fed85d;
    }

    .newly {
        color: #4aff2e;
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

<section id="about" class="container">
    <div class="row">
        @foreach($listGroup as $group)
        <div class="col-md-4">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <img src="{{ $group->images }}"></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">{{ $group->name }}</h6> <span>{{ $group->description }}</span>
                        </div>
                    </div>
                    <div class="badge"> <span class="{{ \App\Enums\Group::COLOR_OF_RATE[$group->rate] }}">{{ $group->rate }}</span> </div>
                </div>
                <div class="mt-3">
                    <p>* {{ __('Location') }}: {{ $group->location }}</p>
                    <p>* {{ __('Activity time') }}: {{ $group->activity_time }}</p>
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-3"> <span class="text1">12 {{ __('Applied') }} <span class="text2">of {{ $group->number_of_members }}</span></span> </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
