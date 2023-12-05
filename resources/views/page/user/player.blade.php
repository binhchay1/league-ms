@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Profile') }}
@endsection

@section('css')
<style>
    .rank-profile-user {
        display: flex;
        justify-content: space-between;
    }

    p {
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .h2 {
        padding-bottom: 0 !important;
    }
</style>
@endsection

@section('content')
<section id="profile" class="container">
    <div class="d-flex">
        <img src='{{ $user->profile_photo_path }}' width="100" height="100">
        <div style="margin-left: 10px;">
            <p class="fw-bold h1" style="margin: 0; padding: 0;">{{ $user->name }}</p>
            <p>{{ $user->title }}</p>
        </div>
    </div>
    <hr>
    <div class="rank-profile-user">
        <div>
            <p class="fw-bold">{{ __('Male doubles') }}</p>
            @foreach($user->ranking as $ranking)
            @if($ranking->type == \App\Enums\Ranking::RANKING_MALE_DOUBLES)
            <div>
                <p class="text-center fw-bold h2">{{ $ranking->places }}</p>
                <p class="text-center">{{ $ranking->points }}</p>
            </div>
            @endif
            @endforeach
        </div>
        <div>
            <p class="fw-bold">{{ __('Female doubles') }}</p>
            @foreach($user->ranking as $ranking)
            @if($ranking->type == \App\Enums\Ranking::RANKING_FEMALE_DOUBLES)
            <div>
                <p class="text-center fw-bold h2">{{ $ranking->places }}</p>
                <p class="text-center">{{ $ranking->points }}</p>
            </div>
            @endif
            @endforeach
        </div>
        <div>
            <p class="fw-bold">{{ __('Male singles') }}</p>
            @foreach($user->ranking as $ranking)
            @if($ranking->type == \App\Enums\Ranking::RANKING_MALE_SINGLES)
            <div>
                <p class="text-center fw-bold h2">{{ $ranking->places }}</p>
                <p class="text-center">{{ $ranking->points }}</p>
            </div>
            @endif
            @endforeach
        </div>
        <div>
            <p class="fw-bold">{{ __('Female singles') }}</p>
            @foreach($user->ranking as $ranking)
            @if($ranking->type == \App\Enums\Ranking::RANKING_FEMALE_SINGLES)
            <div>
                <p class="text-center fw-bold h2">{{ $ranking->places }}</p>
                <p class="text-center">{{ $ranking->points }}</p>
            </div>
            @endif
            @endforeach
        </div>
        <div>
            <p class="fw-bold">{{ __('Mixed doubles') }}</p>
            @foreach($user->ranking as $ranking)
            @if($ranking->type == \App\Enums\Ranking::RANKING_MIXED_DOUBLES)
            <div>
                <p class="text-center fw-bold h2">{{ $ranking->places }}</p>
                <p class="text-center">{{ $ranking->points }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <hr>
</section>

<section class="container">
    <p>{{ __('Group joined') }}</p>
    <div>

    </div>
</section>

<section class="container">
    <p>{{ __('League participated') }}</p>
    <div>

    </div>
</section>
@endsection
