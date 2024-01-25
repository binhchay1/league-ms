@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all"/>

@endsection

@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>
    <div class="container">
        <div class="content-left ">
            <div class="content-left-scroll">
                <div class="home-wrap" tmt-detail="[object Object]">
                    <div class="home-page-outer current-tournament">
                        <div class="home-section text-left"><!----><h2>Current Live Tournament</h2>
                            <div class="row">
                                <div class="current-tmt-wrap col-lg-8">
                                    <div class="current-tmt-outer">
                                        <div class="current-tmt-inner">
                                            <div class="current-tmt-logo">
                                                <a href="" class="">
                                                    <img
                                                        src="https://extranet.bwfbadminton.com/docs/events/4737/logo-colour/Indonesia-Masters-2024.svg"></a>
                                            </div>
                                            <div class="current-tmt-name">DAIHATSU Indonesia Masters 2024</div>
                                        </div>
                                        <div class="current-tmt-link-wrap text-center">
                                            <div><a href="/4737" class=" btn btn-danger "> Live Scores </a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <section id="live-match-schedule" class="container-livescore">
                                        <ul class="result-match-cards">
                                            <li class="result-match-single-card"><a href="/4737/match/122" class="">
                                                    <div class="card-top-row"><span class="round-court">Court 1</span>
                                                        <div class="card-top-row-right-wrap">
                                                            <div class="animated-line"><img
                                                                    src="data:image/gif;base64,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">
                                                            </div>
                                                            <div class="round-time">
                                                                <div class="time"><span><i class="far fa-fw fa-clock"></i> 1:07</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="player-score-wrap-card">
                                                        <div class="player-wrap">
                                                            <div class="team-details-wrap-card">
                                                                <div class="player-wrap-outer"><!---->
                                                                    <div class="player-detail-wrap">
                                                                        <div class="player1-wrap">
                                                                            <div class="flag"><img
                                                                                    src="https://extranet.bwf.sport/docs/flags-svg/denmark.svg"
                                                                                    alt="DEN"></div>
                                                                            <div class="player1"> L KJAERSFELDT</div>
                                                                        </div><!----></div>
                                                                </div>
                                                                <div class="score">
                                                                    <!---->
                                                                    <div><span>16</span><span>21</span><span>17</span></div>
                                                                </div>
                                                            </div>
                                                            <div class="team-details-wrap-card" style="margin-top: 12px;">
                                                                <div class="player-wrap-outer"><!---->
                                                                    <div class="player-detail-wrap">
                                                                        <div class="player3-wrap">
                                                                            <div class="flag"><img
                                                                                    src="https://extranet.bwf.sport/docs/flags-svg/japan.svg"
                                                                                    alt="JPN"></div>
                                                                            <div class="player3"> A OHORI</div>
                                                                        </div><!----></div>
                                                                </div>
                                                                <div class="score"><!---->
                                                                    <div><span>21</span><span>18</span><span>18</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="round-details">
                                                        <div class="round-details-text"><span
                                                                class="round-oop">WS - R32</span><span class="round-status">In Progress</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
