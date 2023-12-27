<style>
    .player {
        font-weight: 500;
        padding-left: 5px;
    }

    .game-completed
    {
        font-weight: 500;
    }

    .tooltip {
        position: relative;
        cursor: default;
        opacity: 1;
        display: flex;
    }

    .tooltip .tooltiptext {
        visibility:hidden;
        color: black;
        text-align: center;
        border-radius: 0.25em;
        white-space: nowrap;
        margin-top: auto;
        transition-property: visibility;
        transition-delay: 0s;
        border-style: solid;
        border-color: #0c0c0c;
        border-width: 1px;
        margin-left: 0%;
        margin-bottom: 25%;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        transition-delay: 0.3s;

    }

    .match:hover {
        background-color: #eee;
    }
</style>
<!DOCTYPE html>
<html lang="en-US" class="bwf-main">
<body class="wp_router_page-template-default single single-wp_router_page postid-21">
<div id="page" class="hfeed site">
    <div class="">
        <div class="container-1280 results">
            <div class="wrapper-results">
                <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                    <div class="content-results">
                        <div class="item-results">
                            <div class="content-item-results" >
                                <div class="item active">
                                    <ul class="list-sort-time " style="color: black">
                                        @forelse($groupSchedule as $round => $schedules)
                                            <li class="location-name">
                                                <strong>{{$round}}</strong>
                                            </li>
                                            @foreach($schedules as $index => $schedule)
                                                <li class="row draw-WD - Group B match tooltip mt-4" id="{{$index}}" onclick="liveScorce(this.id)">
                                                        <div class="round_time col-lg-3">
                                                            <div class="time mt-2">
                                                                <strong>{{$schedule->match}}.</strong> {{$schedule->time}}</div>
                                                            <div class="round"></div>
                                                        </div>
                                                        <div class="player-score-wrap col-lg-6 mt-2">

                                                            <div class="player-wrap">
                                                                <div class="team-details-wrap">
                                                                    <div class="player1-wrap">
                                                                        <div class="player1 player">
                                                                            {{$schedule->player1Team1->name ?? ""}} </div>
                                                                        <div class="flag">
                                                                            <img src="{{$schedule->player2Team1->profile_photo_path ?? asset('/images/no-image.png')}}">
                                                                        </div>
                                                                    </div>
                                                                    @if(isset($schedule->player2Team1->name))
                                                                    <div class="player2-wrap">
                                                                        <div class="player2 player">
                                                                            {{$schedule->player2Team1->name ?? ""}} </div>
                                                                        <div class="flag">
                                                                            <img src="{{$schedule->player2Team1->profile_photo_path ?? asset('/images/no-image.png')}}">
                                                                        </div>
                                                                    </div>
                                                                        @endif
                                                                </div>

                                                                <div class="vs"> bt </div>

                                                                <div class="team-details-wrap">
                                                                    <div class="player3-wrap">
                                                                        <div class="flag">
                                                                            <img src="{{$schedule->player1Team2->profile_photo_path ?? asset('/images/no-image.png')}}">
                                                                        </div>
                                                                        <div class="player1 player">
                                                                            {{$schedule->player1Team2->name ?? ""}} </div>
                                                                    </div>
                                                                    @if(isset($schedule->player2Team2->name))
                                                                    <div class="player4-wrap">
                                                                        <div class="flag">
                                                                            <img src="{{$schedule->player2Team2->profile_photo_path ?? asset('/images/no-image.png')}}">
                                                                        </div>
                                                                        <div class="player4 player">
                                                                            {{$schedule->player2Team2->name ?? ""}}</div>
                                                                    </div>
                                                                        @endif
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <span class="tooltiptext">Click để xem chi tiết trận đấu</span>
                                                            </div>
                                                            <div class="score mt-2">
                                                                {{$schedule->set_1_team_1 }} - {{$schedule->set_1_team_2 }} ,
                                                                {{$schedule->set_2_team_1 }} - {{$schedule->set_2_team_2 }} ,
                                                                {{$schedule->set_3_team_1 }} - {{$schedule->set_3_team_2 }}
                                                                 </div>
                                                        </div>
                                                        <div class="timer1 col-lg-3">
                                                            <?php $date = date('d/m/Y',strtotime($schedule->date)); ?>
                                                           {{$date}}
                                                        </div>
                                                </li>

                                                <section id="livescore-top{{$index}}" class="container-livescore hidden" style="padding-bottom: 0px; color: white;" >
                                                    <div class="tabs">
                                                        <div id="tab-content3" class="live-tab-content">
                                                            <!-- Check match for players -->
                                                            <div class="live-profile-wrap">
                                                                <div class="live-profile-row">

                                                                    <!-- Team 1 -->
                                                                    <div class="team-wrap">

                                                                        <!-- Team 1 Player 1 details -->
                                                                        <div class="player1-wrap">
                                                                            <div class="player1-info">
                                                                                <div class="player1-name">
                                                                                    <a href="https://bwfworldtour.bwfbadminton.com/player/84064/ong-yew-sin">
                                                                                        {{$schedule->player1Team1->name ?? ""}} </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="player1-profile">
                                                                                <img src="{{$schedule->player2Team1->profile_photo_path ?? asset('/images/no-image.png')}}" class=" b-error">
                                                                            </div>
                                                                        </div>
                                                                        <div class="player1-wrap">
                                                                            @if(isset($schedule->player2Team1->name))
                                                                            <div class="player1-info">
                                                                                <div class="player1-name">
                                                                                    <a href="https://bwfworldtour.bwfbadminton.com/player/84064/ong-yew-sin">
                                                                                        {{$schedule->player2Team1->name ?? ""}} </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="player1-profile">
                                                                                <img src="{{$schedule->player2Team1->profile_photo_path ?? asset('/images/no-image.png')}}" class=" b-error">
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <!-- VS details -->
                                                                    <div class="vs">vs</div>

                                                                    <!-- Team 2 -->
                                                                    <div class="team-wrap">

                                                                        <!-- Team 2 Player 1 details -->
                                                                        <div class="player2-wrap">
                                                                            <div class="player2-profile">
                                                                                <img src="{{$schedule->player1Team2->profile_photo_path ?? asset('/images/no-image.png')}}" class=" b-error">
                                                                            </div>
                                                                            <div class="player2-info">
                                                                                <div class="player2-name">
                                                                                    <a href="https://bwfworldtour.bwfbadminton.com/player/98935/m-r-arjun">
                                                                                        {{$schedule->player1Team2->name ?? ""}} </a> </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="player2-wrap">
                                                                            @if(isset($schedule->player2Team2->name))
                                                                            <div class="player2-profile">
                                                                                <img src="{{$schedule->player2Team2->profile_photo_path ?? asset('/images/no-image.png')}}" class=" b-error">
                                                                            </div>
                                                                            <div class="player2-info">
                                                                                <div class="player2-name">
                                                                                    <a href="https://bwfworldtour.bwfbadminton.com/player/98935/m-r-arjun">
                                                                                        {{$schedule->player2Team2->name ?? ""}} </a> </a>
                                                                                </div>
                                                                            </div>
                                                                                @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Game 1 details -->

                                                            <div id="game-1" class="game-completed-wrap">
                                                                <div class="game-completed">
                                                                    <div class="game-shuttle-1">
                                                                    </div>
                                                                    <div class="game-score-1 ">
                                                                        {{$schedule->set_1_team_1 }} </div>
                                                                    <div class="game-number">GAME 1</div>
                                                                    <div class="game-score-2 won-yellow">
                                                                        {{$schedule->set_1_team_2 }} </div>
                                                                    <div class="game-shuttle-2">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- Game 2 details -->

                                                            <div id="game-2" class="game-completed-wrap" style="display:block;">
                                                                <div class="game-completed">
                                                                    <div class="game-shuttle-1">
                                                                    </div>
                                                                    <div class="game-score-1 won-green">{{$schedule->set_2_team_1 }}</div>
                                                                    <div class="game-number">GAME 2</div>
                                                                    <div class="game-score-2 ">{{$schedule->set_2_team_2 }}</div>
                                                                    <div class="game-shuttle-2">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- Game 3 details -->

                                                            <div id="game-3" class="game-completed-wrap" style="display:block;">
                                                                <div class="game-completed">
                                                                    <div class="game-shuttle-1">
                                                                    </div>
                                                                    <div class="game-score-1 won-green">{{$schedule->set_3_team_1 }}</div>
                                                                    <div class="game-number">GAME 3</div>
                                                                    <div class="game-score-2 ">{{$schedule->set_3_team_2 }}</div>
                                                                    <div class="game-shuttle-2">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="live-tabs-wrap">

                                                            <a id="match-stat-tab" href="?match=152&amp;stab=result" style="width:100px;">
                                                                <div id="game-3" class="game-completed-wrap" style="display:block;">
                                                                    <div class="game-completed">
                                                                        <div class="game-shuttle-1">
                                                                        </div>
                                                                        <div class="game-score-1 won-green">{{$schedule->result_team_1 }}</div>
                                                                        <div class="game-score-2 ">{{$schedule->result_team_2 }}</div>
                                                                        <div class="game-shuttle-2">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab active">
                                                                    <span>Results</span> <img src="https://bwfworldtour.bwfbadminton.com/wp-content/themes/world-tour/assets/images/live-score-icons/live-red.svg" class=" b-error">
                                                                </div>
                                                            </a>

                                                        </div>
                                                        <div class="live-tabs-arrow">
                                                            <div class="arrow-up">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            @endforeach
                                            <hr>
                                        @empty
                                            <h2>{{__('Data has not been updated!')}}</h2>
                                        @endforelse
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

<script>
    function liveScorce(id){
        let idElement = id;
        $('#livescore-top' + idElement ).show();
    }

</script>
