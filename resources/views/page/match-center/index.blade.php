@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />
@endsection

@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>
    <div class="container">
        <div class="content-left container">
            <div class="content-left-scroll">
                <div class="home-wrap" tmt-detail="[object Object]">
                    <div class="home-page-outer current-tournament">
                        <h2 style="font-weight: 400">{{__('Current Live Tournament')}}</h2>
                        <div class="home-section text-left">
                            @forelse($listMatches as $league  )
                            <div class="current-tmt-wrap">
                                <div class="current-tmt-outer">
                                    <div class="current-tmt-inner">
                                        <div class="current-tmt-logo">
                                            <a href="" >
                                                <img src="{{asset($league->images)}}" style="height: 100%; width: 100%"></a>
                                        </div>
                                        <div class="current-tmt-name" style="font-size: 30px">{{$league->name}}</div>
                                    </div>
                                    <div class="current-tmt-link-wrap text-center mt-2" >
                                        <div><a href="{{route('league.live', $league['slug'])}}" class=" btn btn-danger "> {{__('Live Score')}} </a></div>

                                    </div>
                                    <div class="current-tmt-name" style="font-size: 30px">{{ $league->name }}</div>
                                </div>
                                <div class="current-tmt-link-wrap text-center mt-2">
                                    <div><a href="{{ route('league.live', $league['slug']) }}" class=" btn btn-danger "> {{__('Live Score')}} </a></div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h3 style="height: 220px" class="text-center">{{ __('Data has not been updated!') }}</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
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
