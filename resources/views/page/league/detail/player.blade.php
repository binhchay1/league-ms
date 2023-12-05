<div class="content-results">
    <div class="item-results">
        <div class="item-results-podium">
            <h3 class="title">
                TOURNAMENT WINNERS 2022 </h3>
            <div class="men-single">
                <div class="title">
                    MEN'S SINGLES <span>8 ENTRIES FROM 7 COUNTRIES</span>
                </div>
                <ul>
                    @foreach($leagueInfor->userLeagues as $listTour)
                    <li>
                        <div class="info">
                            <div class="flag-name-wrap">
                                <div class="flag">
                                    <img alt="" src="https://extranet.bwf.sport/docs/flags/denmark.png" width="54" class=" b-error b-error">
                                </div>
                                <span>
                                    <a href="https://bwfworldtourfinals.bwfbadminton.com/player/25831/viktor-axelsen" title="Viktor AXELSEN">
                                        <strong> {{$listTour->user->name}}</strong>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="img">
                            <a href="https://bwfworldtourfinals.bwfbadminton.com/player/25831/viktor-axelsen">
                                <img src="{{$listTour->user->image ?? '/images/no-image.png'}}" alt="" class=" b-error b-error">
                            </a>
                        </div>

                        <div class="ranked">
                            RANKED N/A
                        </div>
                        <div class="prize-money">
                            PRIZE MONEY - <b>120,000</b></div>
                        <div class="points-gained">
                            POINTS GAINED - <b>12,000</b></div>
                    </li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
