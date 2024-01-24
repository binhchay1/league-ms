@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/content/league.css') }}" type="text/css" media="all" />

@endsection

@section('content')
<style>
    #signup:before {
        width: 0;
    }
</style>

<div class="container" style="margin-bottom: 100px">
    <div class="std-title">
        <div class="std-title-left">
            <h2 class="left">{{ __('LEAGUE CALENDAR') }}</h2>
            <div id="select-list-state card">
                <ul class="select-list" id="select-state">
                    <li data-id="all"><a data-state="remaining" href="#" class="active-menu "  data-toggle="tab">{{__('All')}}</a></li>
                    <li data-id="completed"><a data-state="completed" href="#" data-toggle="tab">{{__('COMPLETED')}}</a></li>
                    <li data-id="next"><a data-state="next" href="#" data-toggle="tab">{{__('NEXT')}}</a></li>
                </ul>
            </div>
        </div>
        <a href="{{route('league.create')}}"><button class="btn btn-success btn-league">{{ __('Create League') }}</button></a>
    </div>
    <div class="item-results">
        @foreach($listLeagues as $listLeague)
        <div class="tblResultLanding" style=" margin-top: 10px; background:#ffffff; margin-bottom: -5px" onmouseover="this.style.background='#a4a4a4';" onmouseout="this.style.background='#ffffff';">
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
                                    <?php $start_date = date('d/m/Y', strtotime($listLeague->start_date));
                                    $end_date = date('d/m/Y', strtotime($listLeague->end_date));
                                    ?>
                                    <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                    <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                    <div class="prize">
                                        {{ __('PRIZE MONEY USD ') }}${{ $listLeague->money }}
                                    </div>
                                </div>
                            </div>
                            <div class="country-detail">
                                <div class="venue-country" style="color:black;">
                                    <div>
                                        <div style="margin-bottom: 40px; margin-right: 100px;">
                                            <img src="{{ asset('/images/logo-no-background.png') }}" class=" b-error b-error" width="100" height="100">
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

    @if($listLeagues->hasPages())
    <div class="navigator short">
        <div class="head d-flex justify-content-center ">
            <ul class="pagination">
                <li>
                    <a href="{{ $listLeagues->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                        <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}</span>
                    </a>
                </li>
                &emsp;
                <li>
                    <a href="{{ $listLeagues->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                        <span aria-hidden="true">{{ __('NEXT') }} <span class="fa fa-angle-right"></span></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
<script src="{{ asset('js/league.js') }}"></script>
<script>
    $(document).ready(function(){
        $('ul li a').click(function(){
            $('li a').removeClass("active-menu"  );
            $(this).addClass("active-menu");
        });
    });

    $(document).ready(function(){
    $('#select-state li').click(function() {
        let url  = '/tournament-leagues?state='
            + $(this).data('id');
        window.location.href = url;
    });
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    console.log(activeTab);
    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

</script>


