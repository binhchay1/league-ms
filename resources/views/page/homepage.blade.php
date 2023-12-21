@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Homepage') }}
@endsection
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{asset('css/page/homepage.css')}}" type="text/css" media="all"/>
@endsection
@section('content')
    <div class="wrapper">

        <section style="background-color: #DA0011; margin-top: -25px">
            <div>
                <img class="img-responsive b-error b-error" alt=""
                     src="https://bwfworldtour.bwfbadminton.com/wp-content/uploads/sites/11/2023/06/World_Tour_Website_Placeholder-KV_June-2023.jpg">
            </div>
        </section>

        <div class="std-title container-1280">
            <h2 class="left">Next Tournament</h2>
            <a href="{{ route('list.league') }}">
                <h2 class="right">All Tournaments</h2>
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
                                            <h2>{{$league->name}}</h2>
                                            <?php $start_date = date('d/m/Y', strtotime($league->start_date));
                                            $end_date = date('d/m/Y', strtotime($league->end_date));
                                            ?>
                                            <h6 class="">{{__('Start Date')}}: {{ $start_date }}</h6>
                                            <h6 class="">{{__('End Date')}}: {{ $end_date }}</h6>
                                        </a>
                                        <div class="prize">{{__('PRIZE MONEY USD ')}}${{ $league->money }}</div>
                                    </div>
                                </div>

                                <div class="box-results-tournament-right">
                                    <div class="logo-right">
                                        <img alt="" src="{{ asset('/images/logo-no-background.png') }}" width="150"
                                             height="150">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="news" class="container-1280 news-section bg-white">
            <div class="std-title">
                <h2 class="left">World Tour Leaders</h2>
                <a href="https://bwfworldtour.bwfbadminton.com/rankings/"><h2 class="right">Full Rankings</h2></a>
            </div>
            <div class="top-player">
                <div class="owl-carousel-rank owl-theme owl-carousel owl-loaded">

                    <div class="owl-stage-outer" style="padding-left: 0px; padding-right: 0px;">
                        <div class="owl-stage"
                             style="width: 8540px; transform: translate3d(-1220px, 0px, 0px); transform-style: preserve-3d; transition: all 0s ease 0s;">
                            <div class="owl-item cloned" style="width: 1220px; margin-right: 0px;">
                                <div class="rankings-content_tabpanel item">
                                    <div class="top-ranked-wrap double">
                                        <div class="top-ranked-left-double">

                                            <div class="top-ranked-player1-wrap">
                                                <div class="top-ranked-avatar">
                                                    <a title=""
                                                       href="https://bwfworldtour.bwfbadminton.com/player/65267/feng-yan-zhe">
                                                        <img
                                                            src="https://img.bwfbadminton.com/image/upload/t_96_player_profile_portrait/v1697420441/assets/players/thumbnail/65267.png">
                                                    </a>
                                                </div>
                                                <div class="top-ranked-country-wrap">
                                                    <div class="top-ranked-country">

                                                        <img height="48"
                                                             src="https://extranet.bwf.sport/docs/flags/china.png"
                                                             title="China" class="flag">

                                                        <a title=""
                                                           href="https://bwfworldtour.bwfbadminton.com/player/65267/feng-yan-zhe">
                                                            FENG<br>Yan Zhe </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="top-ranked-player2-wrap">
                                                <div class="top-ranked-avatar">
                                                    <a title=""
                                                       href="https://bwfworldtour.bwfbadminton.com/player/89426/huang-dong-ping">
                                                        <img
                                                            src="https://img.bwfbadminton.com/image/upload/t_96_player_profile_portrait/v1697424201/assets/players/thumbnail/89426.png">
                                                    </a>
                                                </div>
                                                <div class="top-ranked-country-wrap">
                                                    <div class="top-ranked-country">

                                                        <img height="48"
                                                             src="https://extranet.bwf.sport/docs/flags/china.png"
                                                             title="China" class="flag">

                                                        <a title=""
                                                           href="https://bwfworldtour.bwfbadminton.com/player/89426/huang-dong-ping">
                                                            HUANG<br>Dong Ping </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="top-ranked-right-double">
                                            <div class="top-ranked-info-wrap">
                                                <div class="top-ranked-ranking">
                                                    <span>Ranking</span>
                                                    <span>1</span>
                                                </div>

                                                <div class="top-ranked-extra-wrap">
                                                    <div class="top-ranked-change">
                                                        <span>Change</span>
                                                        <span>0 </span>
                                                    </div>
                                                    <div class="top-ranked-points">
                                                        <span>Points</span>
                                                        <span>112,050</span>
                                                    </div>
                                                    <div class="top-ranked-wins">
                                                        <span>Total Wins</span>
                                                        <span>74</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="owl-item active" style="width: 1220px; margin-right: 0px;">
                                <div class="rankings-content_tabpanel item">
                                    <div class="top-ranked-wrap">
                                        <div class="top-ranked-left-single">

                                            <div class="top-ranked-avatar">
                                                <a title=""
                                                   href="https://bwfworldtour.bwfbadminton.com/player/62063/kodai-naraoka">
                                                    <img
                                                        src="https://img.bwfbadminton.com/image/upload/t_96_player_profile_portrait/v1689644343/assets/players/thumbnail/62063.png"
                                                        class=" b-error">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="top-ranked-right-single">
                                            <div class="top-ranked-country-wrap">
                                                <div class="top-ranked-country">

                                                    <img height="48"
                                                         src="https://extranet.bwf.sport/docs/flags/japan.png"
                                                         title="Japan" class="flag b-error">

                                                    <a title=""
                                                       href="https://bwfworldtour.bwfbadminton.com/player/62063/kodai-naraoka">
                                                        Kodai NARAOKA </a>
                                                </div>
                                            </div>
                                            <div class="top-ranked-info-wrap">

                                                <div class="top-ranked-ranking">
                                                    <span>Ranking</span>
                                                    <span>1</span>
                                                </div>

                                                <div class="top-ranked-extra-wrap">
                                                    <div class="top-ranked-change">
                                                        <span>Change</span>
                                                        <span>5 <img src="https://bwfworldtour.bwfbadminton.com/wp-content/themes/world-tour/assets/images/arrow-up.png" alt="" class=" b-error"></span>
                                                    </div>
                                                    <div class="top-ranked-points">
                                                        <span>Points</span>
                                                        <span>89,250</span>
                                                    </div>
                                                    <div class="top-ranked-wins">
                                                        <span>Total Wins</span>
                                                        <span>184</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="top-ranked-nav-wrap">
                                        <div class="top-ranked-nav-center text-right">
                                           Rankings
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
