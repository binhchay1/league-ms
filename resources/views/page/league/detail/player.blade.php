<div class="content-results">
    <div class="item-results">
        <div class="item-results-podium">
            <h3 class="title">
            <div class="men-single">
                <ul>
                    @forelse($leagueInfor->userLeagues as $listTour)
                        @if(isset($listTour->user) &&  $listTour->status == 1  )
                            <li>
                                <div class="info">
                                    <div class="flag-name-wrap">
                                        <div class="flag">
                                            <img alt="" src="{{asset('/images/vietnam.png')}}" width="54" class=" b-error b-error">
                                        </div>
                                        <span>
                                            <a href="" title="Viktor AXELSEN">
                                                <strong> {{$listTour->user->name}}</strong>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="img">
                                    <a href="">
                                        <img src="{{$listTour->user->image ?? '/images/no-image.png'}}" alt="" class=" b-error b-error">
                                    </a>
                                </div>
                            </li>
                        @endif
                    @empty
                        <h2>{{__('Data has not been updated!')}}</h2>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
