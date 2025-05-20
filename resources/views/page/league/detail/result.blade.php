<style>
    .player {
        font-weight: 500;
        padding-left: 5px;
        font-size: 15px;

    }

    .game-completed {
        font-weight: 500;
    }

    .location-name {
        background: green;
        text-align: center;
        padding: 10px !important;
        color: white !important;
        border-radius: 5px !important;
        text-transform: uppercase;

    }

    .score {
        font-size: 15px;
        background: green;
        border-radius: 5px;
        color: white;
        margin: 20px;
        width: 50px;
    }

    .time {
        font-size: 15px;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        20% {
            transform: translateX(-2px);
        }

        40% {
            transform: translateX(2px);
        }

        60% {
            transform: translateX(-2px);
        }

        80% {
            transform: translateX(2px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .li-shake:hover {
        animation: shake 1s;
    }
</style>
<!DOCTYPE html>
<html lang="en-US" class="bwf-main">

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
                                            <?php $count = 0; ?>
                                            @forelse($groupSchedule as $round => $schedules)
                                                <li class="location-name">
                                                    <strong>{{ $round }}</strong>
                                                </li>
                                                <?php $collection = collect($schedules)->sortBy('match'); ?>
                                                @foreach ($collection as $index => $schedule)
                                                    <li class="row1 draw-WD - Group B match-147 li-shake"
                                                        id="{{ $count }}" onclick="liveScore(this.id)">
                                                        <a id="match-link">
                                                            <div class="round_time">
                                                                <div class="time">
                                                                    <strong>{{ $schedule->match }}.</strong>
                                                                    {{ $schedule->time }}
                                                                </div>
                                                                <div class="round"></div>
                                                            </div>
                                                            <div class="player-score-wrap">
                                                                <div class="player-wrap">
                                                                    <div class="team-details-wrap">
                                                                        <div class="player1-wrap">
                                                                            <div class="player1 player_winner player">
                                                                                {{ $schedule->player1Team1->name ?? 'Team Win' }}

                                                                                @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                                                    @if ($schedule->player1Team1 && $schedule->player1Team1->partner)
                                                                                        /
                                                                                        {{ $schedule->player1Team1->partner->name ?? 'Team Win' }}
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                            <div class="flag">
                                                                                <img
                                                                                    src="{{ asset($schedule->player1Team1->profile_photo_path ?? '/images/no-image.png') }}">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="score">
                                                                        <div>
                                                                            {{ $schedule->result_team_1 ?? 0 }} -
                                                                            {{ $schedule->result_team_2 ?? 0 }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="team-details-wrap">
                                                                        <div class="player3-wrap player">
                                                                            <div class="flag">
                                                                                <img
                                                                                    src="{{ asset($schedule->player1Team2->profile_photo_path ?? '/images/no-image.png') }}">

                                                                            </div>
                                                                            <div class="player3 player">
                                                                                {{ $schedule->player1Team2->name ?? 'Team Win' }}
                                                                                @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                                                    @if ($schedule->player1Team2 && $schedule->player1Team2->partner)
                                                                                        /
                                                                                        {{ $schedule->player1Team2->partner->name ?? 'Team Win' }}
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timer1">
                                                                <?php $date = date('d/m/Y', strtotime($schedule->date)); ?>
                                                                {{ $date }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <!-- Score -->
                                                    <section id="livescore-top{{ $count }}"
                                                        class="container-livescore hidden"
                                                        style="padding-bottom: 0px; color: white;">
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
                                                                                        <a
                                                                                            href="https://bwfworldtour.bwfbadminton.com/player/84064/ong-yew-sin">
                                                                                            {{ $schedule->player1Team1->name ?? '' }}
                                                                                            @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                                                                @if ($schedule->player1Team1 && $schedule->player1Team1->partner)
                                                                                                    /
                                                                                                    {{ $schedule->player1Team1->partner->name ?? 'Team Win' }}
                                                                                                @endif
                                                                                            @endif
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="player1-profile">
                                                                                    <img src="{{ asset($schedule->player2Team1->profile_photo_path ?? '/images/no-image.png') }}"
                                                                                        class=" b-error">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- VS details -->
                                                                        <div class="vs">vs</div>
                                                                        <!-- Team 2 -->
                                                                        <div class="team-wrap">
                                                                            <!-- Team 2 Player 1 details -->
                                                                            <div class="player2-wrap">
                                                                                <div class="player2-profile">
                                                                                    <img src="{{ asset($schedule->player1Team2->profile_photo_path ?? '/images/no-image.png') }}"
                                                                                        class=" b-error">
                                                                                </div>
                                                                                <div class="player2-info">
                                                                                    <div class="player2-name">
                                                                                        <a
                                                                                            href="https://bwfworldtour.bwfbadminton.com/player/98935/m-r-arjun">
                                                                                            {{ $schedule->player1Team2->name ?? '' }}
                                                                                            @if ($schedule->league && $schedule->league->type_of_league == 'doubles')
                                                                                                @if ($schedule->player1Team2 && $schedule->player1Team2->partner)
                                                                                                    /
                                                                                                    {{ $schedule->player1Team2->partner->name ?? 'Team Win' }}
                                                                                                @endif
                                                                                            @endif
                                                                                        </a>

                                                                                    </div>
                                                                                </div>
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
                                                                            {{ $schedule->set_1_team_1 ?? 0 }}
                                                                        </div>
                                                                        <div class="game-number"></div>
                                                                        <div class="game-score-2 won-yellow">
                                                                            {{ $schedule->set_1_team_2 ?? 0 }}
                                                                        </div>
                                                                        <div class="game-shuttle-2">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- Game 2 details -->

                                                                <div id="game-2" class="game-completed-wrap"
                                                                    style="display:block;">
                                                                    <div class="game-completed">
                                                                        <div class="game-shuttle-1">
                                                                        </div>
                                                                        <div class="game-score-1 won-green">
                                                                            {{ $schedule->set_2_team_1 ?? 0 }}</div>
                                                                        <div class="game-number">{{ 'SET 2' }}
                                                                        </div>
                                                                        <div class="game-score-2 ">
                                                                            {{ $schedule->set_2_team_2 ?? 0 }}</div>
                                                                        <div class="game-shuttle-2">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- Game 3 details -->

                                                                <div id="game-3" class="game-completed-wrap"
                                                                    style="display:block;">
                                                                    <div class="game-completed">
                                                                        <div class="game-shuttle-1">
                                                                        </div>
                                                                        <div class="game-score-1 won-green">
                                                                            {{ $schedule->set_3_team_1 ?? 0 }}</div>
                                                                        <div class="game-number">{{ 'SET 3' }}
                                                                        </div>
                                                                        <div class="game-score-2 ">
                                                                            {{ $schedule->set_3_team_2 ?? 0 }}</div>
                                                                        <div class="game-shuttle-2">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="live-tabs-wrap">

                                                                <a id="match-stat-tab" href="?match=152&amp;stab=result"
                                                                    style="width:100px;">
                                                                    <div class="tab active">
                                                                        <span>{{ 'RESULT' }}</span> <img
                                                                            src="https://bwfworldtour.bwfbadminton.com/wp-content/themes/world-tour/assets/images/live-score-icons/live-red.svg"
                                                                            class=" b-error">
                                                                    </div>
                                                                    <div id="game-3" class="game-completed-wrap"
                                                                        style="display:block;">
                                                                        <div class="game-completed">
                                                                            <div class="game-shuttle-1">
                                                                            </div>
                                                                            <div class="game-score-1 won-green">
                                                                                {{ $schedule->result_team_1 }}</div>
                                                                            <div class="game-score-2 ">
                                                                                {{ $schedule->result_team_2 }}</div>
                                                                            <div class="game-shuttle-2">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </a>

                                                            </div>
                                                            <div class="live-tabs-arrow">
                                                                <div class="arrow-up">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <?php $count++; ?>
                                                @endforeach
                                            @empty
                                                <div class="alert alert-primary">{{ 'Tournament is updating data.' }}
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
        const popupId = '#livescore-top' + id;
        const $popup = $(popupId);

        // Ẩn tất cả các popup trước
        $('.container-livescore').hide();

        // Hiện popup tương ứng
        $popup.show();

        // Gỡ event cũ để tránh nhân đôi
        $(document).off('click.livescore').on('click.livescore', function(e) {
            // Nếu click KHÔNG nằm trong popup và KHÔNG nằm trong chính li đã click
            if (
                !$popup.is(e.target) &&
                $popup.has(e.target).length === 0 &&
                !$('#' + id).is(e.target) &&
                !$('#' + id).has(e.target).length
            ) {
                $popup.hide();
                $(document).off('click.livescore');
            }
        });
    }
</script>
