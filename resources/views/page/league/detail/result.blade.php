<style>
    .player {
        font-weight: 500;
        padding-left: 5px;
    }

    .game-completed {
        font-weight: 500;
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
                                <div class="content-item-results">
                                    <div class="item active">
                                        <ul class="list-sort-time " style="color: black">
                                            <?php $count = 0 ?>
                                            @forelse($groupSchedule as $round => $schedules)
                                            <li class="location-name">
                                                <strong>{{$round}}</strong>
                                            </li>
                                            <?php $collection = collect($schedules)->sortBy('match'); ?>
                                            @foreach($collection as $index => $schedule)
                                            <li class="row1 draw-WD - Group B match-147 " id="{{$count }}" onclick="liveScore(this.id)">
                                                <a id="match-link">
                                                    <div class="round_time">
                                                        <div class="time">
                                                            <strong>{{$schedule->match}}.</strong> {{$schedule->time}}
                                                        </div>
                                                        <div class="round"></div>
                                                    </div>
                                                    <div class="player-score-wrap">
                                                        <div class="player-wrap">

                                                            <div class="team-details-wrap">
                                                                <div class="player1-wrap">
                                                                    <div class="player1 player_winner player">
                                                                        {{$schedule->player1Team1->name ?? ""}}
                                                                    </div>
                                                                    <div class="flag">
                                                                        <img src="{{asset( $schedule->player1Team1->profile_photo_path ?? '/images/no-image.png')}}">

                                                                    </div>
                                                                </div>
                                                                @if(isset($schedule->player2Team1))
                                                                <div class="player2-wrap">
                                                                    <div class="player2 player_winner player">
                                                                        {{$schedule->player2Team1->name ?? ""}}
                                                                    </div>
                                                                    <div class="flag">
                                                                        <img src="{{asset( $schedule->player2Team1->profile_photo_path ?? '/images/no-image.png')}}">

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>

                                                            <div class="vs"> bt </div>

                                                            <div class="team-details-wrap">
                                                                <div class="player3-wrap player">
                                                                    <div class="flag">
                                                                        <img src="{{asset( $schedule->player1Team2->profile_photo_path ?? '/images/no-image.png')}}">

                                                                    </div>
                                                                    <div class="player3 player">
                                                                        {{$schedule->player1Team2->name ?? ""}}
                                                                    </div>
                                                                </div>
                                                                @if(isset($schedule->player2Team2))
                                                                <div class="player4-wrap player">
                                                                    <div class="flag">
                                                                        <img src="{{asset( $schedule->player2Team2->profile_photo_path ?? '/images/no-image.png')}}">

                                                                    </div>
                                                                    <div class="player4 player">
                                                                        {{( $schedule->player2Team2->name ?? '')}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="score">
                                                            @if(empty($schedule->set_1_team_1 && $schedule->set_1_team_2))
                                                            @else
                                                            <div>
                                                                {{$schedule->set_1_team_1 }} - {{$schedule->set_1_team_2 }},
                                                            </div>
                                                            @endif

                                                            @if(empty($schedule->set_2_team_1 && $schedule->set_2_team_2))
                                                            @else
                                                            <div>
                                                                {{$schedule->set_2_team_1 }} - {{$schedule->set_2_team_2 }}
                                                            </div>
                                                            @endif

                                                            @if(empty($schedule->set_3_team_1 && $schedule->set_3_team_2))
                                                            @else
                                                            <div>
                                                                ,{{$schedule->set_3_team_1 }} - {{$schedule->set_3_team_2 }}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="timer1">
                                                        <?php $date = date('d/m/Y', strtotime($schedule->date)); ?>
                                                        {{$date}}
                                                    </div>
                                                </a>
                                            </li>

                                            <section id="livescore-top{{$count}}" class="container-livescore hidden" style="padding-bottom: 0px; color: white;">
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
                                                                            <img src="{{asset( $schedule->player2Team1->profile_photo_path ?? '/images/no-image.png')}}" class=" b-error">
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
                                                                            <img src="{{asset( $schedule->player2Team1->profile_photo_path ?? '/images/no-image.png')}}" class=" b-error">
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
                                                                            <img src="{{asset( $schedule->player1Team2->profile_photo_path ?? '/images/no-image.png')}}" class=" b-error">
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
                                                                            <img src="{{asset( $schedule->player2Team2->profile_photo_path ?? '/images/no-image.png')}}" class=" b-error">
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
                                                                    {{$schedule->set_1_team_1 }}
                                                                </div>
                                                                <div class="game-number">GAME 1</div>
                                                                <div class="game-score-2 won-yellow">
                                                                    {{$schedule->set_1_team_2 }}
                                                                </div>
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
                                            <?php $count++ ?>
                                            @endforeach
                                            @empty
                                                    <div class="text-center">
                                                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                                        <h4 >{{ __('The result is updated!') }}</h4>
                                                    </div>
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
    function liveScore(id) {
        let idElement = id;
        $('#livescore-top' + idElement).show();
    }
</script>
