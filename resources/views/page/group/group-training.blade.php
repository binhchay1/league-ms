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
    <?php   $date = date("d/m/Y", strtotime($listTrainings->date));
    $start_time= date("H:i", strtotime($listTrainings->start_time));
    $end_time = date("H:i", strtotime($listTrainings->end_time));
    ?>
    <div>
        <div class=" text-black p-3 align-items-center"  style="background: #707787;padding: 10px; margin-top: -20px; ">
            <div class="container d-flex  flex-column flex-md-row mt-4" style="color: white">
                <div class="text-center">
                    <img src="{{ asset($listTrainings->images) }}" alt="User" width="200" height="200" class=" me-3 " >

                </div>
                <div class="ms-md-4 ">
                    <h2 class="p-0">{{$listTrainings->name}}</h2>
                    <p class="">
                        <i class="bi bi-bookmark"></i> {{$listTrainings->description}}
                    </p>
                    <p class="uppercase">
                        <i class="bi bi-geo-alt "></i> <em>{{$listTrainings->location}}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-calendar-event"></i> <em>{{ $date }}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-calendar-check"></i> <em>{{ $start_time}} ~ {{$end_time}}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-card-checklist"></i> <em>{{$listTrainings->note}}</em>
                    </p>
                </div>
            </div>
        </div>
        <hr>
    </div>
<div class="container" style="margin-bottom: 125px">
    <div class="row">
        <div class="col-md-4">
            <h2 style="color: black; font-weight: 400">{{ __('GROUP TRAINING') }}</h2>
        </div>
        <div class="col-md-8 mt-4">
            <form class="d-flex gap-2 justify-content-end" action="{{route('searchGroupTraining')}}" method="GET">
                <select class="form-select" name="sort">
                    <option selected disabled>{{ 'Sort by' }}</option>
                    <option value="newest">{{ 'Latest' }}</option>
                    <option value="oldest">{{ 'Oldest' }}</option>
                    <option value="name_asc">{{ 'Name (A → Z)' }}</option>
                    <option value="name_desc">{{ 'Name (Z → A)' }}</option>
                </select>

                <div class="input-group">
                    <input type="text" class="form-control"  name="query" placeholder="{{'group name...'}}">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <input type="hidden" name="group" value="{{$listTrainings->name}}">
            </form>
        </div>
    </div>


    <div class="row g-4">
        @forelse($listTrainings->group_trainings as $group)
            <?php
            $date = date("d/m/Y", strtotime($group->date));
            $start_time= date("H:i", strtotime($group->start_time));
            $end_time = date("H:i", strtotime($group->end_time));
            ?>
            <div class="col-md-4">
                <div class="feature-box content-gr" style="text-align: left">
                    <div  class="c-details-group name-group" >
                        <a href="/training?g_t={{ $group->name }}">
                            <h5 class="mb-0 gr-name">{{ $group->name }}</h5>
                        </a>
                    </div>
                    <hr>
                    <p class="event-location">  <i class="bi bi-bookmark"></i>  {{ $group->description }}</p>
                    <p class="uppercase">
                        <i class="bi bi-geo-alt  uppercase"></i> <span class="">{{$group->location}}</span>
                    </p>
                    <p>
                        <i class="bi bi-calendar-event"></i> <span class="">{{$date}}</span>
                    </p>
                    <p>
                        <i class="bi bi-calendar-check"></i> <span class="">{{ $start_time }} - {{$end_time}}</span>
                    </p>
                    <p>
                        <i class="bi bi-person-check-fill"></i> <span class="">{{ $group->totalMembers }} / {{ $group->number_of_members }}</span>
                    </p>
                    <p>
                        <i class="bi bi-card-checklist"></i>  <span class="">{{ Str::limit($group->note, 40) }}</span>
                    </p>
                    <hr>
                    <div class="card-footer text-muted d-flex gr-train-footer">
                        <div class="float-left">
                            @if(!$group->isJoin)
                            <a class="btn btn-success" href="{{ route('join.group.training') }}?g_t={{ $group->id }}" data-toggle="tooltip" data-html="true"
                               title="Click this button to join training">
                                <i class="fa fa-gamepad" aria-hidden="true"></i> ▶</a>
                            @else
                            <a href="/training?g_t={{ $group->name }}" class="btn btn-success" data-toggle="tooltip" data-html="true"
                                    title="Join training">
                                <i class="fa fa-gamepad" aria-hidden="true"></i> ▶</a>
                            @endif
                        </div>

                        <div class="float-right btn btn-primary text-white tox-cursor-format-painter" data-toggle="tooltip" data-html="true" title="" data-original-title="<em>Number of participants</em>">
                            <i class="fa fa-users mr-1" aria-hidden="true"></i>
                            {{ $group->totalMembers }} / {{ $group->number_of_members }} </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse

    </div>

</div>

@endsection
