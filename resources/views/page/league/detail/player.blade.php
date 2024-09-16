<div class="content-results">
    <div class="item-results">
        <div class="item-results-podium">
            <h3 class="title"></h3>
            <div class="men-single">
                <ul>
                    @forelse($leagueInfor->userLeagues as $player)
                        @if(isset($player->user) &&  $player->status == 1  )
                            <li>
                                <div class="info">
                                    <div class="flag-name-wrap">
                                        <span>
                                            <a href="" title="Viktor AXELSEN">
                                                <strong> {{$player->user->name}}</strong>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="img">
                                    <a href="">
                                        <img src="{{asset($player->user->profile_photo_path ?? '/images/no-image.png')}}" alt="" class=" b-error b-error" style="height: 250px">
                                    </a>
                                </div>
                            </li>
                        @endif
                    @empty
                        <div class="text-center">
                            <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                            <h4 >{{ __('There are no players in league!') }}</h4>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
