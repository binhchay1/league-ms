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
            @foreach($listLeagues as $listLeague)
            <div class="tblResultLanding" style=" margin-top: 10px; background:#ffffff" onmouseover="this.style.background='#a4a4a4';" onmouseout="this.style.background='#ffffff';">
                <a href="{{route('league.info', $listLeague['slug'])}}">
                    <div class="tr-tournament-detail" id="4734">
                        <div class="tournament-detail ">
                            <div class="inner-tournament-detail">
                                <div class="description">
                                    <div class="logo-wrap">
                                        <div class="image">
                                            <img src="{{asset($listLeague->images)}}" class="show-image-league">
                                        </div>
                                    </div>

                                    <div class="info" style="color:black;">
                                        <h3>{{ $listLeague->name }}</h3>
                                        <?php $start_date = date('d/m/Y',strtotime($listLeague->start_date));
                                                $end_date = date('d/m/Y',strtotime($listLeague->end_date));
                                        ?>
                                        <h6 class="">{{__('Start Date')}}: {{ $start_date }}</h6>
                                        <h6 class="">{{__('End Date')}}: {{ $end_date }}</h6>
                                        <div class="prize">
                                            {{__('PRIZE MONEY USD ')}}${{ $listLeague->money }} </div>
                                    </div>
                                </div>
                                <div class="country-detail">
                                    <div class="venue-country"  style="color:black;">
                                        <div>
                                            <div style="margin-bottom: 40px; margin-right: 100px;">
                                                <img src="{{ asset('/images/logo-no-background.png') }}"  class=" b-error b-error" width="100"
                                                     height="100">
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
                            <a href="{{ $listLeagues->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                                <span aria-hidden="true"><span class="fa fa-angle-left"></span> PREVIOUS</span>
                            </a>
                        </li >
                        &emsp;
                        <li>
                            <a href="{{ $listLeagues->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                                <span aria-hidden="true">NEXT <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
@endsection
