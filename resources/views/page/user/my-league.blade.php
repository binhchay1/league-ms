@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
@endsection
<style>

    .tournament-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 1px 4px 8px rgba(0.1, 0.1, 0.1, 0.1);
        background-color: white;
        padding: 15px;
        margin-bottom: 15px;
    }
    .tournament-logo {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }
</style>
@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>{{ __('My League') }}</h3>
            <a href="{{route('league.createTour')}}">
                <button class="btn btn-success">{{ __('Create League') }}</button>
            </a>

        </div>
        <div class="row">
            @if(count($listLeague) > 0)
                @foreach($listLeague as $row)
            <div class="col-md-12">
                <div class="tournament-card d-flex align-items-center">
                    <img src="{{ asset($row-> images ?? 'https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}" alt="Logo" class="tournament-logo me-3">
                    <div class="flex-grow-1">
                        <a href="{{route('league.info', $row->slug)}}">
                            <h5>{{ $row->name }}</h5>
                        </a>
                        <p class="mb-1"><?php echo number_format($row->money ?? 0) . " VND"?> || {{$row->type_of_league}}  || {{$row->location}}</p>

                        <button  class="btn btn-{{$row->status ? 'info' : 'secondary' }}">
                            {{$row->status ? "Activated" : "Inactive"}}
                        </button>
                    </div>

                </div>
            </div>
                @endforeach
            @else
                <div class="text-center">
                    <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                    <h4 >{{ __('There are no leagues!') }}</h4>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('js')
@endsection
