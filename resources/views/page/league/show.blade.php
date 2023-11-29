@extends('layouts.page')

@section('title')
{{__('Detail League')}}
@endsection
@section('content')

<div id="page" class="hfeed site">
    <div class="">
        <div class="container-1280 results">

            <div class="std-title">
                <div class="std-title-left">
                    <h2 class="left">{{__('LEAGUE INFORMATION')}}</h2>
                </div>
                <div class="std-title-center">
                </div>
                <div class="std-title-right">
                </div>
            </div>
            <div class="wrapper-results">
                <div class="box-title page-header">
                    <div class="box-title-left">
                    </div>
                    <div class="box-title-right">
                        <h4 class="right">
                            OTHER WORLD TOUR FINALS RESULTS </h4>

                        <label class="tournament-select clear">
                            <select class="ddlTournament" >
                                <option value="">HSBC BWF World Tour Finals 2022</option>
                                <option value="">HSBC BWF World Tour Finals 2021(New dates)</option>
                                <option value="">HSBC BWF World Tour Finals 2020 (New Dates)</option>
                                <option value="">HSBC BWF World Tour Finals 2019</option>
                                <option value="">HSBC BWF World Tour Finals 2018</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="box-results-tournament">
                    <div>
                        <div class="logo-left">
                            <img height="90" src="{{ $tourInfo->image }}" alt="logo">
                        </div>
                        <div class="info">
                            <h2>{{ $tourInfo->name }}</h2>
                            <h5>{{__('Start Date')}}: {{ $tourInfo->start_date }}</h5>
                            <h5>{{__('End Date')}}: {{ $tourInfo->end_date }}</h5>
                            <div class="prize">{{__('PRIZE MONEY USD ')}}${{ $tourInfo->money }}</div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                    <ul id="ajaxTabs" class="content-tabs">
                        <li>
                            <a href="">{{__('Result')}} </a>
                        </li>
                        <li><a href="">{{__('Schedule')}}</a>
                        </li>
                        <li><a href="">{{__('Fighting Branch')}}</a>
                        </li>
                        <li><a href="">{{__('Player ')}}</a>
                        </li>
                    </ul>
                    <div class="content-results">

                        <div class="item-results">
                            @include('page.league.detail.player')
                            @include('page.league.detail.result')
                            @include('page.league.rank')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('js/eventSchedule.js') }}"></script>
@endsection
