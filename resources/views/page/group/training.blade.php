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

    <div class="container">
        <div class="row">
            @forelse($listTrainings->group_trainings as $train)
            <div class="col-sm-4">
                <div class="card " style="margin: 5px">
                    <div class="card-header">
                        {{$train->name}}
                    </div>
                    <div class="card-body">
                        <p><span class="fw-bold">* {{__('Description')}} : </span>{{ $train->description }}</p>
                        <p><span class="fw-bold">* {{__('Activity time')}} : </span>{{ $train->activity_time }}</p>
                        <p><span class="fw-bold">* {{__('Location')}} : </span>{{ $train->location }}</p>
                        <p><em><span class="fw-bold">-----{{__('Note')}} : </span>{{ $train->note }}</em></p>
                    </div>
                    <div class="card-footer text-muted d-flex">
                        <div class="col-lg-6">
                            <button class="btn btn-success btn-training"
                                    id="group-{{ $train->name }}" onclick="detailGroupTraining(this.id)">{{__('Join')}}</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">10/20</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h2 class="text-center" style="height: 420px">{{__('There is no group training!')}}</h2>
            @endforelse
        </div>
    </div>

@endsection
<script>
    function detailGroupTraining(id) {
        let name = id.substring(6);
        console.log(name)
        let url = '/training?g_t=' + name;

        window.location.href = url;
    }
</script>
