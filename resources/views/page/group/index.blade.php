@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Group') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}">
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
        @php
        $isJoin = false;
        $isFull = false;
        @endphp
        @if($group->group_users->count() == $group->number_of_members)
        $isFull = true;
        @endif
        <div class="col-md-4">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <img src="{{ $group->images }}"></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">{{ $group->name }}</h6> <span>{{ $group->users->name }}</span>
                        </div>
                    </div>
                    <div class="badge"> <span class="{{ \App\Enums\Group::COLOR_OF_RATE[$group->rate] }}">{{ $group->rate }}</span> </div>
                </div>
                <div class="mt-3">
                    <p>* {{ __('Description') }}: {{ $group->description }}</p>
                    <p>* {{ __('Location') }}: {{ $group->location }}</p>
                    <p>* {{ __('Activity time') }}: {{ $group->activity_time }}</p>
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($group->group_users->count() / $group->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div> <span class="text1">{{ $group->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $group->number_of_members }}</span></span> </div>
                            @foreach($group->group_users as $user)
                            @if($user->user_id == Auth::user()->id)
                            @php
                            $isJoin = true;
                            @endphp
                            @endif
                            @endforeach

                            @if(!$isJoin and !$isFull)
                            <div>
                                <a class="btn btn-primary">{{ __('Join group') }}</a>
                            </div>
                            @else
                            <div>
                                <a class="btn btn-secondary" disabled>{{ __('Joined') }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="navigator short">
        <div class="head">
            @if(empty($listGroup['prev_page_url']))
            <a aria-label="arrow previous" class="arrow previous disable-link"></a>
            @else
            <a aria-label="arrow previous" class="arrow previous" href="{{ $listGroup['prev_page_url'] }}"></a>
            @endif
            <ul>
                @if($listGroup['current_page'] != 1)
                <li>
                    <a href="{{ $listGroup['prev_page_url'] }}">{{ $listGroup['current_page'] - 1 }}</a>
                </li>
                @endif
                <li class='current'>
                    <span>{{ $listGroup['current_page'] }}</span>
                </li>
                @if($listGroup['current_page'] != $listGroup['last_page'])
                <li>
                    <a href="{{ $listGroup['next_page_url'] }}">{{ $listGroup['current_page'] + 1 }}</a>
                </li>
                @endif
                @if($listGroup['last_page'] > $listGroup['current_page'] + 2)
                <li class="separator">
                    <span>...</span>
                </li>
                @endif
                @if($listGroup['last_page'] > $listGroup['current_page'] + 1)
                <li>
                    <a href="?page={{ $listGroup['last_page'] }}">{{ $listGroup['last_page'] }}</a>
                </li>
                @endif
            </ul>
            <a aria-label="arrow next" class="arrow next {{ $listGroup['current_page'] == $listGroup['last_page'] ? 'disable-link' : '' }}" href="{{ $listGroup['next_page_url'] }}"></a>
        </div>
    </div>
</section>
@endsection
