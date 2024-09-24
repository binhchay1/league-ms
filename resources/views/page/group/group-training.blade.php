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
            <?php   $date = date("d/m/Y", strtotime($train->date));
            $start_time= date("H:i", strtotime($train->start_time));
            $end_time = date("H:i", strtotime($train->end_time));
            ?>
        <div class="col-sm-4 wp-group-content gr-train">
            <div class="d-flex  gr-title ">
                <div class=" align-items-center" >
                    <img class="avatar-group" src="{{ asset('https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}">
                </div>
                <div class="card-header gr-train-header">
                    <a href="/training?g_t={{ $train->name }}" >
                        {{ $train->name }}   ({{__('From') }} {{$start_time}} ~ {{__('To')}} {{$end_time}})
                    </a>
                </div>
            </div>

            <div class="card-body gr-train-body">


                <p><span class=""> ■ {{ __('Description') }} : </span>{{ $train->description }}</p>
                <p><span class="">■ {{ __('Date') }} : </span>{{ $date }}</p>
                <p><span class="">■ {{ __('Activity time') }} : </span>{{ $start_time }} - {{$end_time}}</p>
                <p><span class="">■ {{ __('Location') }} : </span>{{ $train->location }}</p>
                <p><span class="">■ {{ __('Members') }} : </span>{{ $train->totalMembers }} / {{ $train->number_of_members }}</p>
                <p><em><span class="">-----{{ __('Note') }} : </span>{{ $train->note }}</em></p>
            </div>
            <hr>
            <div class="card-footer text-muted d-flex gr-train-footer">
                <div class="float-left">
                    @if(!$train->isJoin)
                    <a class="btn btn-success" href="{{ route('join.group.training') }}?g_t={{ $train->id }}" data-toggle="tooltip" data-html="true"
                       title="Click this button to join training">
                        <i class="fa fa-gamepad" aria-hidden="true"></i> ▶</a>
                    @else
                    <a href="/training?g_t={{ $train->name }}" class="btn btn-success" data-toggle="tooltip" data-html="true"
                            title="Join training">
                        <i class="fa fa-gamepad" aria-hidden="true"></i> ▶</a>
                    @endif
                </div>

                <div class="float-right btn btn-primary text-white tox-cursor-format-painter" data-toggle="tooltip" data-html="true" title="" data-original-title="<em>Number of participants</em>">
                    <i class="fa fa-users mr-1" aria-hidden="true"></i>
                    {{ $train->totalMembers }} / {{ $train->number_of_members }} </div>
            </div>
        </div>
        @empty
            <div class="text-center">
                <img  width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                <h4 >{{ __('The group training is updated!') }}</h4>
            </div>
        @endforelse
    </div>
</div>

@endsection
