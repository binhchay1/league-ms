@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />
@endsection

@section('content')
<style>
    #signup:before {
        width: 0;
    }

    .text-bold {
        font-weight: bold !important;
    }

    .highlight {
        background-color: #3d0314;
        border-radius: 4px;
        color: #ff0046;
        font-weight: 700;
        margin: auto;
        padding: 1px;
    }
</style>
<div class="container">
    <div class="content-left ">
        <div class="content-left-scroll">
            <div class="home-wrap">
                <div class="home-page-outer current-tournament">
                    <div class="home-section text-left">
                        <h2>{{ __('Current Live Tournament League') }} </h2>
                        <div class="row match-live">
                            <div class="current-tmt-wrap col-lg-12">
                                <div class="current-tmt-outer">
                                    <div class="current-tmt-inner">
                                        <div class="current-tmt-logo">
                                            <a href="" class="">
                                                <img style="height: 100%; width: 100%" src="{{ asset($league->images) }}"></a>
                                        </div>
                                        <div class="current-tmt-name">{{ $league->name }}</div>
                                        <?php $start_date = date('d/m/Y', strtotime($league->start_date));
                                        $end_date = date('d/m/Y', strtotime($league->end_date));
                                        ?>
                                        <div class="current-tmt-date">{{ $start_date }} - {{ $end_date }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <section id="live-match-schedule" class="container-livescore">
                                    <ul class="result-match-cards">
                                        @foreach($listSchedules as $schedule)
                                        <li class="result-match-single-card" id="schedule-{{ $schedule->id }}">
                                            <div class="card-top-row"><span class="round-court">Match {{ $schedule->match }}</span>
                                                <div class="card-top-row-right-wrap">
                                                    <div class="animated-line" style="display: flex;flex-wrap: wrap;align-content: center;"><img src="data:image/gif;base64,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">
                                                    </div>
                                                    <div class="round-time">
                                                        <div class="time"><span><i class="far fa-fw fa-clock"></i> {{ $schedule->time }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="player-score-wrap-card">
                                                <div class="player-wrap">
                                                    <div class="team-details-wrap-card d-flex">
                                                        <div class="player-wrap-outer">
                                                            <div class="player-detail-wrap">
                                                                <div class="player1-wrap">
                                                                    <div class="player1">{{ $schedule->player1Team1->name }}</div>
                                                                    @if(!empty($schedule->player2Team1))
                                                                    <div class="player1"> - {{ $schedule->player2Team1->name }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="score">
                                                            <div>
                                                                <span id="score-s-1-t-1-{{ $schedule->id }}">{{ !empty($schedule->set_1_team_1) ? $schedule->set_1_team_1 : 0 }}</span>
                                                                <span id="score-s-2-t-1-{{ $schedule->id }}">{{ !empty($schedule->set_2_team_1) ? $schedule->set_2_team_1 : 0 }}</span>
                                                                <span id="score-s-3-t-1-{{ $schedule->id }}">{{ !empty($schedule->set_3_team_1) ? $schedule->set_3_team_1 : 0 }}</span>
                                                                <span class="text-bold" id="result-t-1-{{ $schedule->id }}">{{ !empty($schedule->result_team_1) ? $schedule->result_team_1 : 0 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="team-details-wrap-card d-flex" style="margin-top: 12px;">
                                                        <div class="player-wrap-outer">
                                                            <div class="player-detail-wrap">
                                                                <div class="player3-wrap">
                                                                    <div class="player3">{{ $schedule->player1Team2->name }}</div>
                                                                    @if(!empty($schedule->player2Team2))
                                                                    <div class="player3"> - {{ $schedule->player2Team2->name }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="score">
                                                            <div>
                                                                <span id="score-s-1-t-2-{{ $schedule->id }}">{{ !empty($schedule->set_1_team_2) ? $schedule->set_1_team_2 : 0 }}</span>
                                                                <span id="score-s-2-t-2-{{ $schedule->id }}">{{ !empty($schedule->set_1_team_2) ? $schedule->set_2_team_2 : 0 }}</span>
                                                                <span id="score-s-3-t-2-{{ $schedule->id }}">{{ !empty($schedule->set_1_team_2) ? $schedule->set_3_team_2 : 0 }}</span>
                                                                <span class="text-bold" id="result-t-2-{{ $schedule->id }}">{{ !empty($schedule->result_team_2) ? $schedule->result_team_2 : 0 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="round-details">
                                                <div class="round-details-text"><span class="round-oop">{{ __('Stadium') }}: {{ !empty($schedule->stadium) ? $schedule->stadium : 'N/A' }}</span><span class="round-status">In Progress</span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
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

@section('js')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    let channel = 'live-score';
    Echo.channel(channel).listen('.update-score', (e) => {
        let split = e.team.split('-');
        let team = split[1];
        let s_i = '#score-s-' + e.set + '-t-' + team + '-' + e.schedule_id;
        let r_i_1 = '#result-t-1-' + e.schedule_id;
        let r_i_2 = '#result-t-2-' + e.schedule_id;

        $(s_i).text(e.score);
        $(s_i).addClass('highlight');
        setInterval(function() {
            $(s_i).removeClass('highlight')
        }, 6000);
        if (e.resultT1 > 0) {
            $(r_i_1).text(e.resultT1);
            $(r_i_1).addClass('highlight');
            setInterval(function() {
                $(r_i_1).removeClass('highlight')
            }, 6000);
        }

        if(e.resultT2 > 0) {
            $(r_i_2).text(e.resultT2);
            $(r_i_2).addClass('highlight');
            setInterval(function() {
                $(r_i_2).removeClass('highlight')
            }, 6000);
        }
    });
</script>
@endsection
