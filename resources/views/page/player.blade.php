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
</style>
@endsection

@section('content')
<section id="profile" class="container">
    <div class="d-flex">
        <img src='{{ $user->profile_photo_path }}' width="100" height="100">
        <div>
            <p style="margin: 0; padding: 0;">{{ $user->name }}</p>
            <p>{{ $user->title }}</p>
        </div>
    </div>
    <hr>
    <div class="rank-profile-user">
        <div>
            <p>{{ __('Male doubles') }}</p>
            <div>
                <p>{{ $user->ranking->places }}</p>
                <p>{{ $user->ranking->points }}</p>
            </div>
        </div>
        <div>
            <p>{{ __('Female doubles') }}</p>
            <div>
                <p>{{ $user->ranking->places }}</p>
                <p>{{ $user->ranking->points }}</p>
            </div>
        </div>
        <div>
            <p>{{ __('Male singles') }}</p>
            <div>
                <p>{{ $user->ranking->places }}</p>
                <p>{{ $user->ranking->points }}</p>
            </div>
        </div>
        <div>
            <p>{{ __('Female singles') }}</p>
            <div>
                <p>{{ $user->ranking->places }}</p>
                <p>{{ $user->ranking->points }}</p>
            </div>
        </div>
        <div>
            <p>{{ __('Mixed doubles') }}</p>
            <div>
                <p>{{ $user->ranking->places }}</p>
                <p>{{ $user->ranking->points }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
