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
</section>

<section class="container">
    <p>{{ __('Group joined') }}</p>
    <div class="row">
        @foreach($groups as $group)
        @php
        if($group->totalMembers == $group->groups->number_of_members) {
        $isFull = true;
        } else {
        $isFull = false;
        }
        @endphp
        <div class="card p-3 mb-4 col-3" style="background: url('/images/auth-logo-opacity-50.png') !important">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                    <div class="icon" width="50" height="50"> <img class="avatar-group" src="{{ $group->groups->images ?? asset('/images/group.png') }}"></div>
                    <div class="ms-2 c-details name-group" id="group-{{ $group->groups->name }}" onclick="detailGroup(this.id)">
                        <h6 class="mb-0">{{ $group->groups->name }}</h6> <span>{{ $group->users->name }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <p>* {{ __('Description') }}: {{ $group->groups->description }}</p>
                <p>* {{ __('Location') }}: {{ $group->groups->location }}</p>
                <p>* {{ __('Activity time') }}: {{ $group->groups->activity_time }}</p>
                <p class="fst-italic fw-light fw-bold">----- {{ __('Note') }}: {{ $group->groups->note }}</p>
                <div class="mt-3">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($group->totalMembers / $group->groups->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div> <span class="text1">{{ $group->totalMembers }} {{ __('Applied') }} <span class="text2">of {{ $group->groups->number_of_members }}</span></span> </div>

                        @if(!Auth::check())
                        <div>
                            <a class="btn btn-success" href="{{ route('login') }}?return_url={{ url()->full() }}">{{ __('Sign in for join') }}</a>
                        </div>
                        @else

                        <div id="btn-join">
                            @if(!$isJoin and !$isFull)
                            <div>
                                <button class="btn btn-primary" id="groups-{{ $group->groups->name }}" onclick="requestJoin(this.id)">{{ __('Join group') }}</button>
                            </div>
                            @else
                            @if($isFull)
                            <div>
                                <button class="btn btn-secondary" disabled>{{ __('Full members') }}</button>
                            </div>
                            @else
                            <div>
                                <button class="btn btn-secondary" disabled>{{ __('Joined') }}</button>
                            </div>
                            @endif
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="container">
    <p>{{ __('League participated') }}</p>
    <div class="row">
        @foreach($leagues as $league)

        @endforeach
    </div>
</section>
@endsection


@section('js')
<script>
    function detailGroup(id) {
        let name = id.substring(6);
        let url = '/detail-group?g_i=' + name;

        window.location.href = url;
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
</script>
@endsection
