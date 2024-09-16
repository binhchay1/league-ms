<style>
    .player {
        font-weight: 500;
        padding-left: 5px;
    }

    .btn-referee {
        box-shadow: 0 0 3px #999;
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
            <div class="container-1280 results">
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
                                                                        {{ $schedule->player1Team1->name ?? "" }}
                                                                    </div>
                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player1Team1->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                </div>
                                                                @if(isset($schedule->player2Team1->name))
                                                                <div class="player2-wrap">
                                                                    <div class="player2 player_winner player">
                                                                        {{ $schedule->player2Team1->name ?? "" }}
                                                                    </div>
                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player2Team1->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>

                                                            <div class="vs"> vs </div>

                                                            <div class="team-details-wrap">
                                                                <div class="player3-wrap player">
                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player1Team2->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                    <div class="player3 player">
                                                                        {{ $schedule->player1Team2->name ?? "" }}
                                                                    </div>
                                                                </div>
                                                                @if(isset($schedule->player2Team2->name))
                                                                <div class="player4-wrap player">
                                                                    <div class="flag">
                                                                        <img src="{{ asset( $schedule->player2Team2->profile_photo_path ?? '/images/no-image.png') }}">

                                                                    </div>
                                                                    <div class="player4 player">
                                                                        {{ $schedule->player2Team2->name ?? asset('/images/no-image.png') }}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="score">

                                                        </div>
                                                    </div>
                                                    <div class="timer1">
                                                        <?php $date = date('d/m/Y', strtotime($schedule->date)); ?>
                                                        {{$date}}
                                                    </div>
                                                </a>
                                                @if(Auth::check())
                                                @if(in_array('referee', $listTitle))
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('live.score') }}?s_i={{ $utility->encode_hash_id($schedule->id) }}" class="btn btn-referee" style="margin-bottom: 10px;">{{ __('Be referee') }}</a>
                                                </div>
                                                @endif
                                                @endif
                                            </li>
                                            @endforeach
                                            <hr>
                                            @empty
                                                <div class="text-center">
                                                    <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                                    <h4 >{{ __('The Schedule is updated!') }}</h4>
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
