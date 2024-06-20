@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@php
use Illuminate\Support\Facades\Hash;

$utility = new \App\Enums\Utility();
@endphp

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
@endsection

@section('content')

<div class="container" style="margin-bottom: 125px">
    <div class="row">
        @forelse($listTrainings->group_trainings as $train)
        <div class="col-sm-4">
            <div class="card " style="margin: 5px">
                <div class="card-header">
                    <a href="/training?g_t={{ $train->name }}">{{ $train->name }}</a>
                </div>
                <div class="card-body">
                    <?php   $date = date("d/m/Y", strtotime($train->date));
                    $start_time= date("H:i", strtotime($train->start_time));
                    $end_time = date("H:i", strtotime($train->end_time));
                    ?>
                    <p><span class="fw-bold">* {{ __('Description') }} : </span>{{ $train->description }}</p>
                    <p><span class="fw-bold">* {{ __('Date') }} : </span>{{ $date }}</p>
                    <p><span class="fw-bold">* {{ __('Activity time') }} : </span>{{ $start_time }} - {{$end_time}}</p>
                    <p><span class="fw-bold">* {{ __('Location') }} : </span>{{ $train->location }}</p>
                    <p><span class="fw-bold">* {{ __('Members') }} : </span>{{ $train->totalMembers }} / {{ $train->number_of_members }}</p>
                    <p><em><span class="fw-bold">-----{{ __('Note') }} : </span>{{ $train->note }}</em></p>
                </div>
                <div class="card-footer text-muted d-flex">
                    <div class="col-lg-6">
                        @if(!$train->isJoin)
                        <a href="{{ route('join.group.training') }}?g_t={{ $train->id }}" class="btn btn-success btn-training">{{ __('Join') }}</a>
                        @else
                        <a class="btn btn-success btn-training" style="visibility: hidden;">{{ __('Join') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h2 class="text-center" style="height: 420px">{{ __('There is no group training!') }}</h2>
        @endforelse
    </div>
</div>

@endsection
