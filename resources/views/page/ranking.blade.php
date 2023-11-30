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
            <li class="active"><a href="#"><span class="ranking-tab-desktop">MEN'S SINGLES</span> <span class="ranking-tab-mobile">MS</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">WOMEN'S SINGLES</span> <span class="ranking-tab-mobile">WS</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">MEN'S DOUBLES</span> <span class="ranking-tab-mobile">MD</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">WOMEN'S DOUBLES</span> <span class="ranking-tab-mobile">WD</span></a></li>
            <li class=""><a href="#"><span class="ranking-tab-desktop">MIXED DOUBLES</span> <span class="ranking-tab-mobile">XD</span></a></li>
        </ul>
        <table id="table_id" cellpadding="0" cellspacing="0" border="0" width="100%" class="tblRankingLanding">
            <thead>
                <tr>
                    <th scope="col">RANK</th>
                    <th scope="col">NAME</th>
                    <th scope="col">NATION</th>
                    <th scope="col">POINTS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-rank">
                        <div class="col-rank-wrapper"><span class="rank-value">1</span>
                            <div class="ranking-change-outer"><span class="ranking-change" style="color: green;"><i class="fas fa-2x fa-caret-up"></i> 5</span></div>
                        </div>
                    </td>
                    <td class="col-player">
                        <div class="player"><span><a href="https://bwfbadminton.com/player/62063/kodai-naraoka/"><span><span class="name-1">Kodai</span> <span class="name-2">NARAOKA</span></span></a></span> </div>
                    </td>
                    <td class="col-country">
                        <div class="country"><img width="48" src="https://extranet.bwf.sport/docs/flags-svg/japan.svg" title="Japan"></div>
                    </td>
                    <td class="col-points"><strong>{{ $ranking }}</strong></td>
                </tr>
            </tbody>
        </table>
        <div class="table-search-row">
            <div class="table-page-results">
                Showing 1 to 10 of 357 entries
                <div class="table-ranking-disclaimer"><a href="#"><i class="fas fa-fw fa-info-circle"></i> Info/Disclaimer
                    </a></div>
                <div role="dialog" class="v-dialog__container"></div>
            </div>
            <div class="table-pagination">
                <nav class="pagination"><span class="page-stats">Page 1 of 36</span> <a disabled="disabled" class="button disabled"><i class="fas fa-lg fa-step-backward"></i></a> <a disabled="disabled" class="button disabled"><i class="fas fa-lg fa-chevron-left"></i></a> <a class="button"><i class="fas fa-lg fa-chevron-right"></i></a> <a class="button"><i class="fas fa-lg fa-step-forward"></i></a></nav>
            </div>
        </div>
    </div>
</section>
@endsection
