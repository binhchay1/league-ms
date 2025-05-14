<style>
    .player {
        font-weight: 500;
        padding-left: 5px;
        font-size: 15px;
    }

    .btn-referee {
        box-shadow: 0 0 3px #999;
        padding: 5px !important;
        background: red;
        color: white !important;
    }

    .btn-referee:hover {
        background: white !important;
        color: red !important;
    }

    .location-name {
        background: green;
        text-align: center;
        padding: 10px !important;
        color: white !important;
        border-radius: 5px !important;
        text-transform: uppercase;

    }

    .time {
        font-size: 15px;
    }
</style>
<!DOCTYPE html>
<html lang="en-US" class="bwf-main">

<?php

use \App\Enums\Utility;

$utility = new Utility();
if (Auth::check()) {
    $listTitle = explode(',', Auth::user()->title);
}

?>
<body class="wp_router_page-template-default single single-wp_router_page postid-21">
    <div id="page" class="hfeed site">
        <div class="">
            <div class="container results">
                <div class="wrapper-results">
                    <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                        <div class="content-results">
                            <div class="item-results">
                                <div class="content-item-results">
                                    <div class="item active">
                                        <ul class="list-sort-time " style="color: black">
                                            @forelse($groupSchedule as $round => $schedules)
                                            <li class="location-name">
                                                <strong>{{ $round }}</strong>
                                            </li>
                                            <?php $collection = collect($schedules)->sortBy('match'); ?>
                                            @foreach($collection as $index => $schedule )
                                            <li class="row1 draw-WD - Group B match-147 " id="{{$index}}">
                                                <a id="match-link">
                                                    <div class="round_time">
                                                        <div class="time">
                                                            <strong>{{ $schedule->match }}.</strong> {{ $schedule->time }}
                                                        </div>
                                                        <div class="round"></div>
                                                    </div>
                                                    <div class="player-score-wrap">
                                                        <div class="player-wrap">
                                                            <div class="team-details-wrap">
                                                                <div class="player1-wrap">
                                                                    <div class="player1 player_winner player">
                                                                        {{ $schedule->player1Team1->name ?? "Team Win" }}
                                                                        @if($schedule->league && $schedule->league->type_of_league == "doubles")
                                                                            @if($schedule->player1Team1 && $schedule->player1Team1->partner)
                                                                                    / {{ $schedule->player1Team1->partner->name ?? "Team Win" }}
                                                                            @endif
                                                                        @endif
                                                                    </div>

                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player1Team1->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="vs"> vs </div>

                                                            <div class="team-details-wrap">
                                                                <div class="player3-wrap  player">
                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player1Team2->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                    <div class="player3 player_winner player">
                                                                        {{ $schedule->player1Team2->name ?? "Team Win" }}
                                                                        @if($schedule->league && $schedule->league->type_of_league == "doubles")
                                                                            @if($schedule->player1Team2 && $schedule->player1Team2->partner)
                                                                                / {{ $schedule->player1Team2->partner->name ?? "Team Win" }}
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timer1">
                                                        <?php $date = date('d/m/Y', strtotime($schedule->date)); ?>
                                                        {{$date}}
                                                    </div>
                                                </a>
                                            </li>

                                            @endforeach
                                            @empty
                                                <div class="alert alert-primary">{{"Tournament is updating data."}}</div>
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
