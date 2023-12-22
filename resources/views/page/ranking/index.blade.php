@extends('layouts.page')

@php
$utility = new \App\Enums\Utility();
@endphp

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Ranking') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/ranking.css') }}" />
@endsection

@section('content')

<section id="ranking" class="container" style="margin-bottom: 100px">
    <div class="std-title">
        <div class="std-title-left">
            <h2 class="left">{{__('RANKING')}}</h2>
        </div>
    </div>
    <div class="wrapper-ranking" style="padding-top: 0; padding-bottom: 0">
        <p class="fw-bold">Updated: {{ $ranking[0]->updated_at }}</p>
    </div>

    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Rank') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Point') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ranking as $index => $rank)
                                <tr>
                                    <td class="col-rank">
                                        <div class="col-rank-wrapper d-flex">
                                            <span class="rank-value d-flex-align-center">{{ $index + 1 }}</span>
                                        </div>
                                    </td>
                                    <td class="col-player align-content-center">
                                        <div class="player d-flex"><span><a style="color: black" href="{{ route('player.info', ['id' => $utility->encode_hash_id($rank->users->id)]) }}"><span><span class="name-1">{{ $rank->users->name }}</span></span></a></span></div>
                                    </td>
                                    <td class="col-points" style="font-weight: 700">{{ $rank->points }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
