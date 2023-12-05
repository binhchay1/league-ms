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
        <select class="form-control">
            <option value="male-doubles">{{ __('Male doubles') }}</option>
            <option value="female-doubles">{{ __('Female doubles') }}</option>
            <option value="male-singles">{{ __('Male singles') }}</option>
            <option value="female-singles">{{ __('Female singles') }}</option>
            <option value="mixed-doubles">{{ __('Mixed doubles') }}</option>
        </select>
    </div>
    <div class="wrapper-ranking">
        <table width="100%" class="table">
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
                        <div class="player"><span><a href="{{ asset() }}"><span><span class="name-1">{{ $rank->users->name }}</span></span></a></span></div>
                    </td>
                    <td class="col-points"><strong>{{ $rank->points }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
