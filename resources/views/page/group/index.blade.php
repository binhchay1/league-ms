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
                        <div class="mt-3"> <span class="text1">{{ $group->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $group->number_of_members }}</span></span> </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
