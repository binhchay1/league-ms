@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header group-name">
            {{ $groupTrainingDetail->name }}
        </div>

        <?php   $date = date("d/m/Y", strtotime($groupTrainingDetail->date));
        $start_time= date("H:i", strtotime($groupTrainingDetail->start_time));
        $end_time = date("H:i", strtotime($groupTrainingDetail->end_time));
        ?>

        <div class="card-body">
            <p>■  {{ __('Description') }}: {{ $groupTrainingDetail->description }}</p>
            <p>■  {{ __('Location') }}: {{ $groupTrainingDetail->location }}</p>
            <p>■  {{ __('Date') }}: {{ $date }}</p>
            <p>■  {{ __('Number of member') }}: {{ $groupTrainingDetail->location }}</p>
            <p>■  {{ __('Activity time') }}: {{ $start_time}} ~  {{$end_time}}</p>
            <p class="fst-italic fw-light fw-bold">----- {{ __('Note') }}: {{ $groupTrainingDetail->note }}</p>
        </div>
        <div class="mt-3" style="padding: 15px">
            @if(!empty($listMembers))
            <div class="progress">
                <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($listMembers->count() / $groupTrainingDetail->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div> <span class="text1">{{ $listMembers->count() }} {{ __('Applied') }} <span class="text2">of {{ $groupTrainingDetail->number_of_members }}</span></span> </div>
            </div>
            @else
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div> <span class="text1">0 {{ __('Applied') }} <span class="text2">of {{ $groupTrainingDetail->number_of_members }}</span></span> </div>
            </div>
            @endif

        </div>
    </div>

    <div class="card" style="width: 50rem; margin-top: 20px; margin-bottom: 120px">
        <div class="d-flex">
            <div class=" align-items-center" >
                <img class="avatar-group" src="{{ asset('https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}">
            </div>
            <div class="" >
                <h5 style="line-height: 50px">{{__('Join')}}</h5>
            </div>
        </div>

        <ul class="list-group list-group-flush">
            @foreach($listMembers as $members)
            <li class="list-group-item">{{ $members->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
