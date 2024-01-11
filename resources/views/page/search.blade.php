@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Privacy') }}
@endsection

@section('css')
<style type="text/css">
    .item-results {
        margin-bottom: 30px !important;
    }
</style>
@endsection

@section('content')
<section id="search-heading">
    <div class="container">
        <h1 class="center">{{ __('Search') }}</h1>
    </div>
    <div id="search-bar" class="no-search-results">
        <form id="search-form" action="{{ route('search') }}" method="post">
            @csrf
            <div class="search">
                <input type="text" name="search" value="{{ $search }}" id="search">
                <button type="submit"><span class="hidden">{{ __('Search') }}</span></button>
            </div>

            <div class="no-results-message">
                {{ __('Your search for') }} <strong>'{{ $search }}'</strong> {{ __('returned') }} <strong>{{ count($listLeagues) }}{{ __(' results') }}</strong>
            </div>
        </form>
    </div>
</section>

<section class="container">
    <div class="item-results">
        @foreach($listLeagues as $listLeague)
        <div class="tblResultLanding" style=" margin-top: 10px; background:#ffffff" onmouseover="this.style.background='#a4a4a4';" onmouseout="this.style.background='#ffffff';">
            <a href="{{ route('league.info', $listLeague['slug']) }}">
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
</section>
@endsection
