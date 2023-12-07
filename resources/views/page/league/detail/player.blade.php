<div class="content-results">
    <div class="item-results">
        <div class="item-results-podium">
            <h3 class="title">
                {{__('LEAGUE PLAYER')}} </h3>
            <div class="men-single">
                <ul>
                    @forelse($leagueInfor->userLeagues as $listTour)
                        @if($listTour->status == 1)
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
                    </li>

                        @endif
                    @empty
                        <h2>{{__('No players found')}}</h2>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
