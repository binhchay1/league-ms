{{--<style>--}}
{{--    body {--}}
{{--    }--}}

{{--    .tooltip {--}}
{{--        position: relative;--}}
{{--        cursor: default;--}}
{{--        opacity: 1;--}}
{{--        display: flex;--}}
{{--    }--}}

{{--    .tooltip .tooltiptext {--}}
{{--        visibility: hidden;--}}
{{--        padding: 0.25em 0.5em;--}}
{{--        color: black;--}}
{{--        text-align: center;--}}
{{--        border-radius: 0.25em;--}}
{{--        white-space: nowrap;--}}
{{--        margin-top: auto;--}}
{{--        transition-property: visibility;--}}
{{--        transition-delay: 0s;--}}
{{--        border-style: solid;--}}
{{--        border-color: #0c0c0c;--}}
{{--        border-width: 1px;--}}
{{--        margin-left: 40%;--}}
{{--        margin-bottom: 25%;--}}
{{--    }--}}

{{--    .tooltip:hover .tooltiptext {--}}
{{--        visibility: visible;--}}
{{--        transition-delay: 0.3s;--}}

{{--    }--}}
{{--</style>--}}
{{--<div class="row">--}}
{{--        <div class="" style="background: white; border-radius: 10px">--}}
{{--            <h2>Chi tiết giải đấu</h2>--}}
{{--            <div>--}}
{{--                    <div style="background: #eee; ">--}}
{{--                        Vòng đấu:1--}}
{{--                    </div>--}}
{{--                        <div  class="row mt-4 tooltip btn_delete" data-toggle="modal"--}}
{{--                             data-target="#ModalCreate " id="evenClick">--}}
{{--                            <div class="col-lg-3">Thời gian: 111</div>--}}
{{--                            <div class="col-lg-3">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <img class="image" src="" alt="avatar"--}}
{{--                                             style=" width: 15px; border-radius: 10px; margin-right: 15px;">--}}
{{--                                        222--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-12 mt-4">--}}
{{--                                        <img class="image" src="" alt="avatar"--}}
{{--                                             style=" width: 15px; border-radius: 10px; margin-right: 15px;">--}}
{{--                                        333--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-1">--}}
{{--                                <div class="row" style="font-weight: 800">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        1--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-12 mt-4">--}}
{{--                                        2--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                               1--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                              2--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                               3--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-12 mt-4">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                                4--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                            5--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-2">--}}
{{--                                              6--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <span class="tooltiptext">Click để xem chi tiết trận đấu</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                <hr>--}}
{{--                        <div class="modal fade text-left" id="ModalCreate" style="z-index: 99999" tabindex="-1"--}}
{{--                             role="dialog" aria-hidden="true">--}}
{{--                            <div class="modal-dialog modal-lg" role="document">--}}
{{--                                <div class="modal-content" style="height: 400px;">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h4 class="modal-title"></h4>--}}
{{--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div class="row justify-content-start m-1 mb-2 mt-2">--}}
{{--                                        <button type="submit" class="btn btn-success "--}}
{{--                                                style="width: 90px">{{__('Vòng')}}</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-group text-center">--}}
{{--                                                <div class="" style="display: inline-grid;">--}}
{{--                                                    <input value="" type="file" class="border-0 bg-light pl-0"--}}
{{--                                                           name="image" id="image" hidden>--}}
{{--                                                    <div class=" choose-avatar">--}}
{{--                                                        <div id="btnimage">--}}
{{--                                                            <img class="show-avatar"--}}
{{--                                                                 style="width:150px; height: 150px; border-radius: 50%"--}}
{{--                                                                 src="" alt="avatar">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="text-center">--}}
{{--                                                <strong></strong>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-4 text-center"--}}
{{--                                             style="vertical-align: middle;line-height: 120px;">--}}

{{--                                            <strong></strong>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-group text-center">--}}
{{--                                                <div class="" style="display: inline-grid;">--}}
{{--                                                    <input value="" type="file" class="border-0 bg-light pl-0"--}}
{{--                                                           name="image" id="image" hidden>--}}
{{--                                                    <div class=" choose-avatar">--}}
{{--                                                        <div id="btnimage">--}}
{{--                                                            <img class="show-avatar"--}}
{{--                                                                 style="width: 150px; height: 150px; border-radius: 50% "--}}
{{--                                                                 src="" alt="avatar">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="text-center">--}}
{{--                                                <strong></strong>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--</div>--}}

    <!DOCTYPE html>
<html lang="en-US" class="bwf-main">
<body class="wp_router_page-template-default single single-wp_router_page postid-21">
<div id="page" class="hfeed site">
    <div class="">
        <div class="container-1280 results">

            <div class="std-title">
                <div class="std-title-left">
                    <h2 class="left">TOURNAMENT RESULTS</h2>
                </div>
                <div class="std-title-center">
                </div>
                <div class="std-title-right">

                </div>
            </div>
            <div class="wrapper-results">
                <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                    <div class="content-results">
                        <div class="item-results">
                            <div class="content-item-results" >
                                <div class="item active">
                                    <ul class="list-sort-time " style="color: black">
                                        <li class="location-name">
                                            <strong>Mangupura Hall - 1</strong>
                                        </li>
                                        <li class="stats stats-147">
                                        </li>
                                        <li class="row1 draw-WD - Group B match-147 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=147&stab=result">
                                                <div class="round_time">
                                                    <div class="time"><strong>1.</strong> Starting at 10:00 AM</div>
                                                    <div class="round">WD - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Nami MATSUYAMA </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Chiharu SHIDA </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Ashwini PONNAPPA </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                                <div class="player4">
                                                                    REDDY Sikki </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-18 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:43</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-69">
                                        </li>

                                        <li class=" draw-WS - Group B match-69 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=69&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>2.</strong> Followed by</div>
                                                    <div class="round">WS - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Akane YAMAGUCHI </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/singapore.png">
                                                                </div>
                                                                <div class="player3">
                                                                    YEO Jia Min </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-11, 21-14 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:34</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-129">
                                        </li>

                                        <li class="row1 draw-WD - Group A match-129 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=129&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>3.</strong> Followed by</div>
                                                    <div class="round">WD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    KIM So Yeong </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/korea.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    KONG Hee Yong </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/korea.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                                <div class="player3">
                                                                    TAN Pearly </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                                <div class="player4">
                                                                    THINAAH Muralitharan </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-14 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:45</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-30">
                                        </li>

                                        <li class=" draw-MS - Group B match-30 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=30&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>4.</strong> Followed by</div>
                                                    <div class="round">MS - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    LEE Zii Jia </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Kunlavut VITIDSARN </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-15, 21-16 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:51</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-53">
                                        </li>

                                        <li class="row1 draw-WS - Group A match-53 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=53&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>5.</strong> Followed by</div>
                                                    <div class="round">WS - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Pornpawee CHOCHUWONG </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/germany.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Yvonne LI </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-18, 21-18 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:49</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-164">
                                        </li>

                                        <li class=" draw-XD - Group A match-164 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=164&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>6.</strong> Starting at 5:00 PM</div>
                                                    <div class="round">XD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Yuta WATANABE </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Arisa HIGASHINO </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Mathias CHRISTIANSEN </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Alexandra BØJE </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-12, 21-15 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:36</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-108">
                                        </li>

                                        <li class="row1 draw-MD - Group B match-108 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=108&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>7.</strong> Followed by</div>
                                                    <div class="round">MD - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Takuro HOKI </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Yugo KOBAYASHI </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Pramudya KUSUMAWARDANA </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Yeremia Erich Yoche Yacob RAMBITAN </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-19 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:42</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-186">
                                        </li>

                                        <li class=" draw-XD - Group B match-186 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=186&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>8.</strong> Followed by</div>
                                                    <div class="round">XD - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Dechapol PUAVARANUKROH </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Sapsiree TAERATTANACHAI </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Praveen JORDAN </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Melati Daeva OKTAVIANTI </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 10-21, 21-11 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:52</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-92">
                                        </li>

                                        <li class="row1 draw-MD - Group A match-92 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=92&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>9.</strong> Followed by</div>
                                                    <div class="round">MD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Marcus Fernaldi GIDEON </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Kevin Sanjaya SUKAMULJO </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/chinesetaipei.png">
                                                                </div>
                                                                <div class="player3">
                                                                    LEE Yang </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/chinesetaipei.png">
                                                                </div>
                                                                <div class="player4">
                                                                    WANG Chi-Lin </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        23-21, 21-19 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:44</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-16">
                                        </li>

                                        <li class=" draw-MS - Group A match-16 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=16&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>10.</strong> Followed by</div>
                                                    <div class="round">MS - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">1</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Lakshya SEN </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/japan.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Kento MOMOTA </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        1-1, Retired </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:01</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="stats stats-145">
                                        </li>

                                        <li class="stats stats-28">
                                        </li>

                                        <li class="row1 draw-MS - Group B match-28 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=28&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>3.</strong> Followed by</div>
                                                    <div class="round">MS - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    KIDAMBI Srikanth </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/france.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Toma Junior POPOV </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-16 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:42</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-131">
                                        </li>

                                        <li class=" draw-WD - Group A match-131 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=131&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>4.</strong> Followed by</div>
                                                    <div class="round">WD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Greysia POLII </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Apriyani RAHAYU </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/indonesia.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Jongkolphan KITITHARAKUL </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/thailand.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Rawinda PRAJONGJAI </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-15, 21-12 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:37</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-172">
                                        </li>

                                        <li class="row1 draw-XD - Group A match-172 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=172&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>5.</strong> Followed by</div>
                                                    <div class="round">XD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    CHAN Peng Soon </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    GOH Liu Ying </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                                <div class="player3">
                                                                    TAN Kian Meng </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                                <div class="player4">
                                                                    LAI Pei Jing </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-13 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:38</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-51">
                                        </li>

                                        <li class=" draw-WS - Group A match-51 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=51&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>6.</strong> Starting at 5:00 PM</div>
                                                    <div class="round">WS - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    PUSARLA V. Sindhu </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Line CHRISTOPHERSEN </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-14, 21-16 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:38</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-184">
                                        </li>

                                        <li class="row1 draw-XD - Group B match-184 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=184&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>7.</strong> Followed by</div>
                                                    <div class="round">XD - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    TANG Chun Man </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/hongkong.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    TSE Ying Suet </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/hongkong.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/england.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Marcus ELLIS </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/england.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Lauren SMITH </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-11, 21-16 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:37</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-106">
                                        </li>

                                        <li class=" draw-MD - Group B match-106 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=106&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>8.</strong> Followed by</div>
                                                    <div class="round">MD - Group B</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    ONG Yew Sin </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    TEO Ee Yi </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/malaysia.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/france.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Christo POPOV </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/france.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Toma Junior POPOV </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-16, 21-19 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:46</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-8">
                                        </li>

                                        <li class="row1 draw-MS - Group A match-8 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=8&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>9.</strong> Followed by</div>
                                                    <div class="round">MS - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Viktor AXELSEN </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Rasmus GEMKE </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        5-1, Retired </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:03</span>
                                                </div>
                                            </a>
                                        </li>


                                        <li class="stats stats-90">
                                        </li>

                                        <li class=" draw-MD - Group A match-90 ">
                                            <a id="match-link" href="https://bwfworldtourfinals.bwfbadminton.com/results/4044/hsbc-bwf-world-tour-finals-2021-new-dates/2021-12-01/?match=90&stab=result">

                                                <div class="round_time">
                                                    <div class="time"><strong>10.</strong> Followed by</div>
                                                    <div class="round">MD - Group A</div>
                                                    <div class="court">
                                                        <span class="round-location">Mangupura Hall</span>
                                                        <span class="round-court">2</span>
                                                    </div>
                                                </div>
                                                <div class="player-score-wrap">
                                                    <div class="player-wrap">

                                                        <div class="team-details-wrap">
                                                            <div class="player1-wrap">
                                                                <div class="player1 player_winner">
                                                                    Kim ASTRUP </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                            </div>
                                                            <div class="player2-wrap">
                                                                <div class="player2 player_winner">
                                                                    Anders Skaarup RASMUSSEN </div>
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/denmark.png">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="vs"> bt </div>

                                                        <div class="team-details-wrap">
                                                            <div class="player3-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                                <div class="player3">
                                                                    Satwiksairaj RANKIREDDY </div>
                                                            </div>
                                                            <div class="player4-wrap">
                                                                <div class="flag">
                                                                    <img src="https://extranet.bwf.sport/docs/flags/india.png">
                                                                </div>
                                                                <div class="player4">
                                                                    Chirag SHETTY </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        21-16, 21-5 </div>
                                                </div>

                                                <div class="timer1">
                                                    <span>0:40</span>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

