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

<section id="group" class="container">
    <div class="row">
        @foreach($listGroup as $group)
        @php
        $isJoin = false;
        $isFull = false;
        @endphp
        @if($group->group_users->count() == $group->number_of_members)
        $isFull = true;
        @endif
        <div class="col-md-4" id="group-{{ $row->groups->name }}" onclick="detailGroup(this.id)">
            <div class="card p-3 mb-4">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <img class="avatar-group" src="{{ $group->images }}"></div>
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
                    <p class="fst-italic fw-light fw-bold">----- {{ __('Note') }}: {{ $group->note }}</p>
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

                            @if(!Auth::check())
                            <div>
                                <a class="btn btn-success" href="{{ route('login') }}?return_url={{ url()->full() }}">{{ __('Sign in for join') }}</a>
                            </div>
                            @else

                            @if(!$isJoin and !$isFull)
                            <div>
                                <a class="btn btn-primary" href="{{ route('join.group') }}">{{ __('Join group') }}</a>
                            </div>
                            @else
                            <div>
                                <button class="btn btn-secondary" disabled>{{ __('Joined') }}</button>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="navigator short">
        <div class="head d-flex justify-content-center">
            @if(empty($listGroup->previousPageUrl()))
            <a aria-label="arrow previous" class="arrow previous disable-link"></a>
            @else
            <a aria-label="arrow previous" class="arrow previous" href="{{ $listGroup->previousPageUrl() }}"></a>
            @endif
            <ul>
                @if($listGroup->currentPage() != 1)
                <li>
                    <a href="{{ $listGroup->previousPageUrl() }}">{{ $listGroup->currentPage() - 1 }}</a>
                </li>
                @endif
                <li class='current'>
                    <span>{{ $listGroup->currentPage() }}</span>
                </li>
                @if($listGroup->currentPage() != $listGroup->lastPage())
                <li>
                    <a href="{{ $listGroup->nextPageUrl() }}">{{ $listGroup->currentPage() + 1 }}</a>
                </li>
                @endif
                @if($listGroup->lastPage() > $listGroup->currentPage() + 2)
                <li class="separator">
                    <span>...</span>
                </li>
                @endif
                @if($listGroup->lastPage() > $listGroup->currentPage() + 1)
                <li>
                    <a href="?page={{ $listGroup->lastPage() }}">{{ $listGroup->lastPage() }}</a>
                </li>
                @endif
            </ul>
            <a aria-label="arrow next" class="arrow next {{ $listGroup->currentPage() == $listGroup->lastPage() ? 'disable-link' : '' }}" href="{{ $listGroup->nextPageUrl() }}"></a>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    function detailGroup(id) {
        let name = id.substring(6);
        let url = '/detail-group?g_id=' + name;

        window.location.href = url;
    }
</script>
@endsection
