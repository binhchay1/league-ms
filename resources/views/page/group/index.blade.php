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
@endsection

@section('content')

<section id="group" class="container">
    <div class="std-title">
        <div class="std-title-left">
            <h2 class="left" style=" font-weight: 400; color: black">{{ __('GROUP') }}</h2>
        </div>

    </div>

    <div class="row">
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
        <div class="wp-group">
            <div class=" mb-4 wp-group-content" >
                <div class="d-flex gr-title" >
                    <div class=" align-items-center" >
                        <img class="avatar-group" src="{{ asset('https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}" data-id="group-{{ $group->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                    </div>
                    <div  class="c-details-group name-group" data-id="group-{{ $group->name }}" id="group-{{ $group->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                        <h6 class="mb-0 gr-name">{{ $group->name }}</h6>
                    </div>
                </div>

                <hr>
                <div class="mt-3 descript-group">
                    <p>■ {{ __('Description') }}: {{ $group->description }}</p>
                    <p>■ {{ __('Location') }}: {{ $group->location }}</p>
                    <p>■ {{ __('Number of member') }}: {{ $group->number_of_members }}</p>
                    <p class="">----- {{ __('Note') }}: {{ $group->note }}</p>
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
                                @if(!$isJoin and !$isFull)
                                <div>
                                    <button class="btn btn-success" id="groups-{{ $group->name }}" onclick="requestJoin(this.id)">{{ __('Join group') }}</button>
                                </div>
                                @else
                                @if($isFull)
                                <div>
                                    <button class="btn btn-danger"  disabled>{{ __('Full members') }}</button>
                                </div>
                                @else
                                <div>
                                    <button class="btn btn-success"  disabled>{{ __('Joined') }}</button>
                                </div>
                                @endif
                                @endif
                            </div>
                            @endif
                        </div>
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
    @if($listGroup->toTal()> $listGroup->perPage())
    <!-- Paginate -->
        <div class="navigator short" >
            <div class="head d-flex justify-content-center ">
                <ul class="pagination">
                    <li>
                        <a href="{{ $listGroup->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                            <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{__('PREVIOUS')}}</span>
                        </a>
                    </li >
                    &emsp;
                    <li>
                        <a href="{{ $listGroup->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                            <span aria-hidden="true">{{__('NEXT')}} <span class="fa fa-angle-right"></span></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
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
                let btnSuccess = '<div><button class="btn btn-success" disabled>' + '<?php echo __('Joined') ?>' + '</button></div>'
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
