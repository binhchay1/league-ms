@if($groupRound->isNotEmpty())
<div id="tournament-table" class="tournament-table-standings">
        <div id="tournament-table-tabs-and-content">
            <div class="subFilterOver subFilterOver--end"></div>
            <div class="draw__cover">
                <div class="draw__container">
                    <div class="draw__wrapper">
                        <div class="draw__shadowHeader"></div>
                        <div class="draw__clearHeader"></div>
                        <div class="draw">
                            @php
                                $status = 'odd';
                            @endphp

                            @foreach($groupRound as $key => $round)
                                <div class="draw__round">
                                    <div class="draw__header">
                                        <div class="draw__label">{{ ucfirst($key) }}</div>
                                        <div class="draw__arrow draw__arrow--next"></div>
                                    </div>
                                    <?php if ($key == array_key_last($groupRound->toArray())) { ?>
                                    <div class="draw__brackets draw__round--last">
                                        <?php } elseif ($key == array_key_first($groupRound->toArray())) { ?>
                                        <div class="draw__brackets draw__round--first">
                                            <?php } else { ?>
                                            <div class="draw__brackets">
                                                <?php } ?>
                                                @foreach($round as $match)
                                                    @if($status == 'odd')
                                                        <div class="draw__bracket draw__bracket--odd">
                                                            <div class="bracket bracket--doubles">
                                                                <div class="bracket__participantRow bracket__participantRow--home">
                                                                    @if(isset($match->player1Team1))
                                                                        <div class="bracket__participant">
                                                                            <span class="bracket__name {{ $match->result_team_1 == 2 ? 'bracket__name--advancing' : '' }}">
                                                                                {{ $match->player1Team1->name }}
                                                                                @if($leagueInfor->format_of_league == "doubles")
                                                                                    @if($match->player1Team1 && $match->player1Team1->partner)
                                                                                        / {{ $match->player1Team1->partner->name ?? "" }}
                                                                                    @endif
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="bracket__result bracket__result--home">
                                                                    <div class="result {{ $match->result_team_1 < 2 ? 'score__lose' : '' }}">{{ $match->result_team_1 }}</div>
                                                                </div>
                                                                <div class="bracket__participantRow bracket__participantRow--away">
                                                                    @if(isset($match->player1Team2))
                                                                        <div class="bracket__participant">
                                                                            <span class="bracket__name {{ $match->result_team_2 == 2 ? 'bracket__name--advancing' : '' }}">
                                                                                {{ $match->player1Team2->name }}
                                                                                    @if($leagueInfor->format_of_league == "doubles")
                                                                                        @if($match->player1Team2 && $match->player1Team2->partner)
                                                                                            / {{ $match->player1Team2->partner->name ?? "" }}
                                                                                        @endif
                                                                                    @endif
                                                                            </span>
                                                                        </div>

                                                                    @endif
                                                                    @if(isset($match->player2Team2))
                                                                        <div class="bracket__participant bracket__participant--2"><span class="bracket__name {{ $match->result_team_2 == 2 ? 'bracket__name--advancing' : '' }}">{{ $match->player2Team2->name }}</span></div>
                                                                    @endif
                                                                </div>
                                                                <div class="bracket__result bracket__result--away">
                                                                    <div class="result {{ $match->result_team_2 < 2 ? 'score__lose' : '' }}">{{ $match->result_team_2 }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $status = 'even';
                                                        @endphp
                                                    @else
                                                        <div class="draw__bracket draw__bracket--even">
                                                            <div class="bracket bracket--doubles">
                                                                <div class="bracket__participantRow bracket__participantRow--home">
                                                                    @if(isset($match->player1Team1))
                                                                        <div class="bracket__participant"><span class="bracket__name {{ $match->result_team_1 == 2 ? 'bracket__name--advancing' : '' }}">{{ $match->player1Team1->name }}
                                                                                @if($leagueInfor->format_of_league == "doubles")
                                                                                @if($match->player1Team1 && $match->player1Team1->partner)
                                                                                    / {{ $match->player1Team1->partner->name ?? "" }}
                                                                                @endif
                                                                                @endif
                                                                            </span></div>
                                                                    @endif

                                                                </div>
                                                                <div class="bracket__result bracket__result--home">
                                                                    <div class="result {{ $match->result_team_1 < 2 ? 'score__lose' : '' }}">{{ $match->result_team_1 }}</div>
                                                                </div>
                                                                <div class="bracket__participantRow bracket__participantRow--away">
                                                                    @if(isset($match->player1Team2))
                                                                        <div class="bracket__participant"><span class="bracket__name {{ $match->result_team_2 == 2 ? 'bracket__name--advancing' : '' }}">{{ $match->player1Team2->name }}
                                                                                @if($leagueInfor->format_of_league == "doubles")
                                                                                @if($match->player1Team2 && $match->player1Team2->partner)
                                                                                    / {{ $match->player1Team2->partner->name ?? "" }}
                                                                                @endif
                                                                             @endif
                                                                            </span></div>
                                                                    @endif

                                                                </div>
                                                                <div class="bracket__result bracket__result--away">
                                                                    <div class="result {{ $match->result_team_2 < 2 ? 'score__lose' : '' }}">{{ $match->result_team_2 }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $status = 'odd';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-primary">{{__("Tournament is updating data.")}}</div>
@endif
{{--@endif--}}
