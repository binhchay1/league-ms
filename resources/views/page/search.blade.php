@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Privacy') }}
@endsection

@section('content')
<section id="search-heading">
    <div class="container">
        <h1 class="center">{{ __('Search') }}</h1>
        <p class="center">Find my league</p>
    </div>
    <div id="search-bar" class="no-search-results">
        <form id="search-form" action="{{ route('search') }}" method="post">
            @csrf
            <div class="search">
                <input type="text" name="search" value="{{ $search }}" id="search">
                <button type="submit"><span class="hidden">{{ __('Search') }}</span></button>
            </div>

            @if(!$isList)
            <div class="no-results-message">
                {{ __('Your search for') }} <strong>'{{ $search }}'</strong> {{ __('returned') }} <strong>{{ __('0 results') }}</strong>
            </div>
            @endif
        </form>
    </div>
</section>

<section class="container">
    @if($isList)
    <div class="search-results-container mtop30px">
        <div class="results-heading">
            <p>
                {{ __('Your search for') }} <strong>'{{ $search }}'</strong> {{ __('returned') }} <strong>{{ $listLeagueBySearch->count() }} {{ __('results') }}</strong>
            </p>
        </div>
        <div id="search-results">
            <div class="screenshot-info">
                <div class="screenshot">
                    <div>
                        <a href="http://ifagrassrootsabc.leaguerepublic.com/" title="View Site" target="_blank">
                            <img src="https://images.leaguerepublic.com/data/shrinktheweb/632281563.jpg" width="220" height="240" alt="IFA Grassroots Armagh, Banbridge &amp; Craigavon Small Sided Games Centre - screenshot">
                        </a>
                    </div>
                </div>
                <div class="info">
                    <h2 class="h21px">IFA Grassroots Armagh, Banbridge &amp; Craigavon Small Sided Games Centre</h2>
                    <p>
                        <span>Soccer/ Football</span> / United Kingdom
                    </p>
                    <p>
                        <a href="http://ifagrassrootsabc.leaguerepublic.com/" class="button" target="_blank">View Site</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
    @endif
</section>
@endsection
