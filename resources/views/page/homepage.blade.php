@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Homepage') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/homepage.css') }}" type="text/css" media="all" />
@endsection

@section('content')
<div class="wrapper">

    <section style="background-color: #DA0011; margin-top: -25px">
        <div>
            <img class="img-responsive b-error b-error" alt="" src="{{ asset('images/World_Tour_Website_Placeholder-KV_June-2023-(2).jpg') }}">
        </div>
    </section>

    <div class="std-title container-1280">
        <h2 class="left">{{ __('Next Tournament') }}</h2>
        <a href="{{ route('list.league') }}">
            <h2 class="right">{{ __('All Tournaments') }}</h2>
        </a>
    </div>
    <section id="next-tournament" class="next-tournament-section bg-black">
        <div class="next-tournament-wrap">
            <div class="results">
                @foreach($listLeague as $league)
                <div class="wrapper-results">
                    <div class="box-results-tournament">
                        <div class="box-results-tournament-left">
                            <div class="logo-left">
                                <a href="{{route('league.info', $league['slug'])}}">
                                    <img width="200" src="{{$league->images}}" alt="logo" class=" b-error">
                                </a>
                            </div>

                            <div class="info">
                                <a href="{{route('league.info', $league['slug'])}}">
                                    <h2>{{ $league->name }}</h2>
                                    <?php $start_date = date('d/m/Y', strtotime($league->start_date));
                                    $end_date = date('d/m/Y', strtotime($league->end_date));
                                    ?>
                                    <h6 class="">{{ __('Start Date')}}: {{ $start_date }}</h6>
                                    <h6 class="">{{ __('End Date')}}: {{ $end_date }}</h6>
                                </a>
                                <div class="prize">{{ __('PRIZE MONEY USD ') }}${{ $league->money }}</div>
                            </div>
                        </div>

                        <div class="box-results-tournament-right">
                            <div class="logo-right">
                                <img alt="" src="{{ asset('/images/logo-no-background.png') }}" width="150" height="150">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="news" class="container-1280 news-section bg-white">
        <div class="std-title" style="margin-top: 10px">
            <h2 class="left">{{ __('World Tour Leaders') }}</h2>
            <a href="{{route('ranking')}}">
                <h2 class="right">{{ __('Full Rankings') }}</h2>
            </a>
        </div>
        <div class="top-player">
            <div class="owl-carousel-rank owl-theme owl-carousel owl-loaded">
                <div class="owl-stage-outer" style="padding-left: 0px; padding-right: 0px;">
                    <div class="owl-stage">
                        <div class="owl-item active" style="width: 1220px; margin-right: 0px;">
                            <div class="rankings-content_tabpanel item">
                                <div class="top-ranked-wrap">
                                    @foreach($listRank as $index => $rank)
                                    <div class="top-ranked-left-single">
                                        <div class="top-ranked-avatar">
                                            <a title="" href="">
                                                <img style="width: 300px; height: 300px" src="{{$rank->users->profile_photo_path ?? asset('/images/no-image.png') }}" class=" b-error">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="top-ranked-right-single">
                                        <div class="top-ranked-country-wrap">
                                            <div class="top-ranked-country">
                                                <a title="" href="">
                                                    {{ $rank->users->name }} </a>
                                            </div>
                                        </div>
                                        <div class="top-ranked-info-wrap">

                                            <div class="top-ranked-ranking">
                                                <span>{{ __('Ranking') }}</span>
                                                <span>{{ $index+1 }}</span>
                                            </div>

                                            <div class="top-ranked-extra-wrap">
                                                <div class="top-ranked-points">
                                                    <span>{{ __('Points') }}</span>
                                                    <span>{{ $rank->points }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="top-ranked-nav-wrap">
                                    <div class="top-ranked-nav-center text-right">
                                        {{ __('Rankings') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="margin-top: -9px;">
        </div>
    </section>

    <div class="partners-section-wrap">
        <div class="partners-section">
            <div class="partners-left" style="margin-bottom: 100px">

            </div>
        </div>
    </div>

</div>
@endsection
