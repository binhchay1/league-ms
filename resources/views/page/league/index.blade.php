@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{asset('css/content/league.css')}}" type="text/css" media="all" />

@endsection

@section('content')
<style>
    #signup:before {
        width: 0;
    }
</style>

    <div class="container">
        <div class="std-title">
            <div class="std-title-left">
                <h2 class="left">{{__('LEAGUE CALENDAR')}}</h2>
            </div>
        </div>
        <div class="item-results">
            @foreach($listLeague as $listLeague)
            <div class="tblResultLanding" style=" margin-top: 10px; background:#ffffff" onmouseover="this.style.background='#a4a4a4';" onmouseout="this.style.background='#ffffff';">
                <a href="{{route('league.info', $listLeague['slug'])}}">
                    <div class="tr-tournament-detail" id="4734">
                        <div class="tournament-detail ">
                            <div class="inner-tournament-detail">
                                <div class="description">
                                    <div class="logo-wrap">
                                        <div class="image">
                                            <img src="{{$listLeague->images}}" class="show-image-league">
                                        </div>
                                    </div>

                                    <div class="info" style="color:black;">
                                        <h3>{{ $listLeague->name }}</h3>
                                        <h4>{{ $listLeague->start_date }} - {{ $listLeague->end_date }}</h4>
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
                                                <img width="75" src="{{$listLeague->image_nation_flag ?? asset('/images/vietnam.png')}}"  class=" b-error b-error">
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

        <!-- Paginate -->
        <div class="navigator short" >
            <div class="head d-flex justify-content-center ">
                    <ul class="pagination">
                        <li>
                            <a href="{{ $paginateLeague->previousPageUrl() }}" aria-label="Previous" class="prevPlayersList">
                                <span aria-hidden="true"><span class="fa fa-angle-left"></span> PREVIOUS</span>
                            </a>
                        </li >
                        &emsp;
                        <li>
                            <a href="{{ $paginateLeague->nextPageUrl() }}" aria-label="Next" class="nextPlayersList">
                                <span aria-hidden="true">NEXT <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
@endsection
