@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />
@endsection

<style>
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 1px 4px 10px rgba(0, 0, 0, 0.2) !important;
    }
    .transition-btn:hover {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-row {
        background: #eeeeee;
        padding: 10px;
    }

</style>
@section('content')
    <div class="container mt-4">
        <h2 style="font-weight: 400">{{__('CURRENT LIVE')}}</h2>
        <div class="row bg-row">
            @forelse($listMatches as $league  )
                @if($league->status == 1)
                <div class="col-md-3 bg-gray mt-4">
                    <div class="card text-center border-0 shadow-sm p-3 transition hover-effect">
                        <img src="{{ asset($league->images ?? '/images/logo-no-background.png') }}" alt="Avatar" class="card-img-top mx-auto" style="width: 80px; height: 80px;">
                        <div class="card-body">
                            <h5 class="text-success fw-bold">{{ $league->name }}</h5>

                            <div class="mt-3">
                                <div class="current-tmt-link-wrap text-center mt-2" >
                                    <div><a href="{{route('league.live', $league['slug'])}}" class=" btn btn-danger " target="_blank" rel="noopener noreferrer"> {{__('Live Score')}} </a></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                    <div class="text-center">
                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                        <h4 >{{ __('There are no live matches today!') }}</h4>
                    </div>
                @endforelse
                </div>
    @if($listMatches->total() > $listMatches->perPage())
    <div class="navigator short mt-4">
        <div class="head d-flex justify-content-center">
            <ul class="pagination">
                <li>
                    <a href="{{ $listMatches->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                        <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}</span>
                    </a>
                </li>
                &emsp;
                <li>
                    <a href="{{ $listMatches->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                        <span aria-hidden="true">{{ __('NEXT') }} <span class="fa fa-angle-right"></span></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
