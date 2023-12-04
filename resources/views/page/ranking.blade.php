@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Ranking') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/ranking.css') }}" />
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Ranking') }}</h1>
        <p class="center">{{ __('Join all league of us for ranking') }}</p>
    </div>
</section>

<section id="ranking" class="container">
    <div class="wrapper-ranking">
        <ul class="ranking-event-tabs">
            <li class="active"><a href="#"><span class="ranking-tab-desktop">{{ __("Men's singles") }}</span> <span class="ranking-tab-mobile">MS</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">{{ __("Women's singles") }}</span> <span class="ranking-tab-mobile">WS</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">{{ __("Men's doubles") }}</span> <span class="ranking-tab-mobile">MD</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">{{ __("Women's doubles") }}</span> <span class="ranking-tab-mobile">WD</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">{{ __('Mixed doubles') }}</span> <span class="ranking-tab-mobile">XD</span></a></li>
        </ul>
        <table id="table_id" cellpadding="0" cellspacing="0" border="0" width="100%" class="tblRankingLanding">
            <thead>
                <tr>
                    <th scope="col">{{ __('Rank') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Points') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $index => $rank)
                <tr>
                    <td class="col-rank">
                        <div class="col-rank-wrapper"><span class="rank-value">{{ $index + 1 }}</span>
                            <div class="ranking-change-outer"><span class="ranking-change" style="color: green;"><i class="fas fa-2x fa-caret-up"></i> 5</span></div>
                        </div>
                    </td>
                    <td class="col-player">
                        <div class="player"><span><a href="https://bwfbadminton.com/player/62063/kodai-naraoka/"><span><span class="name-1">{{ $rank->users->name }}</span></span></a></span></div>
                    </td>
                    <td class="col-points"><strong>{{ $rank->points }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
