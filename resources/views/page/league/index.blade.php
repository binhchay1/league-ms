@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{asset('css/content/league.css')}}" type="text/css" media="all" />
@endsection

<link rel="stylesheet" id="bootstrap-style-css" href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/bootstrap.css?ver=1717160f66b565489b11f0a0e460e849')}}"  />
@section('content')
<style>
    #signup:before {
        width: 0;
    }
</style>

    <div class="container">
        <h2>{{__('List League')}}</h2>

        <div class="item-results">
            @foreach($listLeague as $listLeague)
            <div class="tblResultLanding" >
                <a href="{{route('tour.info', $listLeague['slug'])}}">
                    <div class="tr-tournament-detail" id="4734">
                        <div class="tournament-detail ">
                            <div class="inner-tournament-detail">
                                <div class="description">
                                    <div class="logo-wrap">
                                        <div class="image">
                                            <img src="{{$listLeague->image}}" class=" b-error b-error">
                                        </div>
                                    </div>

                                    <div class="info" style="color:black;">
                                        <h2>{{ $listLeague->name }}</h2>
                                        <h3>{{ $listLeague->start_date }} - {{ $listLeague->end_date }}</h3>
                                        <div class="prize">
                                            {{__('PRIZE MONEY USD ')}}${{ $listLeague->money }} </div>
                                    </div>
                                </div>
                                <div class="country-detail">
                                    <div class="venue-country"  style="color:black;">
                                        <div>
                                            <div class="country_code">
                                                {{$listLeague->national}} </div>
                                        </div>
                                        <div>
                                            <div>
                                                <img width="75" src="{{$listLeague->image_nation_flag}}" title="China" class=" b-error b-error">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="navigator short">
            <div class="head d-flex justify-content-center ">
                    <ul class="pagination">
                        <li>
                            <a href="{{ $paginateLeague->previousPageUrl() }}" aria-label="Previous" class="prevPlayersList">
                                <span aria-hidden="true"><span class="fa fa-angle-left"></span> PREVIOUS</span>
                            </a>
                        </li>
                        @if($paginateLeague->currentPage() != 1)
                            <li>
                                <a href="{{ $paginateLeague->previousPageUrl() }}">{{ $paginateLeague->currentPage() - 1 }}</a>
                            </li>
                        @endif
                        <li class='current'>
                            <span>{{ $paginateLeague->currentPage() }}</span>
                        </li>
                        @if($paginateLeague->currentPage() != $paginateLeague->lastPage())
                            <li>
                                <a href="{{ $paginateLeague->nextPageUrl() }}">{{ $paginateLeague->currentPage() + 1 }}</a>
                            </li>
                        @endif
                        @if($paginateLeague->lastPage() > $paginateLeague->currentPage() + 2)
                            <li class="separator">
                                <span>...</span>
                            </li>
                        @endif
                        @if($paginateLeague->lastPage() > $paginateLeague->currentPage() + 1)
                            <li>
                                <a href="?page={{ $paginateLeague->lastPage() }}">{{ $paginateLeague->lastPage() }}</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ $paginateLeague->nextPageUrl() }}" aria-label="Next" class="nextPlayersList">
                                <span aria-hidden="true">NEXT <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>

            </div>
        </div>
@endsection
