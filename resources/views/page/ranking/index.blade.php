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
        <select class="form-control" onchange="selectTypeRank()" id="type-ranking">
            <option value="male-doubles">{{ __('Male doubles') }}</option>
            <option value="female-doubles">{{ __('Female doubles') }}</option>
            <option value="male-singles">{{ __('Male singles') }}</option>
            <option value="female-singles">{{ __('Female singles') }}</option>
            <option value="mixed-doubles">{{ __('Mixed doubles') }}</option>
        </select>
    </div>
    <div class="wrapper-ranking" style="padding-top: 0; padding-bottom: 0">
        <p class="fw-bold">Updated: {{ $ranking[0]->updated_at }}</p>
    </div>

    <div class="wrapper-ranking" style="padding-top: 0;">
        <table width="100%" class="table">
            <thead>
                <tr>
                    <th scope="col" class="fw-bold">{{ __('Rank') }}</th>
                    <th scope="col" class="fw-bold">{{ __('Name') }}</th>
                    <th scope="col" class="fw-bold">{{ __('Points') }}</th>
                    <th scope="col" class="fw-bold">{{ __('Title') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $index => $rank)
                <tr>
                    <td class="col-rank">
                        <div class="col-rank-wrapper d-flex">
                            <span class="rank-value d-flex-align-center">{{ $index + 1 }}</span>
                            @if($rank->places_old - $rank->places >= 0)
                            <span class="ranking-change d-flex-align-center" style="color: green; margin-left: 10px"><i class="fas fa-2x fa-caret-up"></i> {{ abs($rank->places_old - $rank->places) }}</span>
                            @else
                            <span class="ranking-change d-flex-align-center" style="color: red; margin-left: 10px"><i class="fas fa-2x fa-caret-down"></i> {{ abs($rank->places_old - $rank->places) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="col-player d-flex align-content-center">
                        <div class="player d-flex"><span><a style="color: black" href="{{ route('player.info', ['id' => $rank->users->id]) }}"><span><span class="name-1">{{ $rank->users->name }}</span></span></a></span></div>
                        <div style="margin-left: 5px;">
                            <span><img src="{{ asset($rank->users->profile_photo_path) }}" width="40" height="40" /></span>
                        </div>
                    </td>
                    <td class="col-points">{{ $rank->points }}</td>
                    <td class="col-points">{{ $rank->users->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
    function selectTypeRank() {
        let selected = $('#type-ranking').find(":selected").val();
        let url = '/ranking?type=' + selected;

        window.location.href = url;
    }
</script>
@endsection
