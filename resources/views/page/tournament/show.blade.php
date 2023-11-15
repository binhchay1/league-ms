@extends('layouts.page')
@section('content')
<div class="container" style="background: white; border-radius: 10px; padding: 10px">
    <div class="row">
        <div class="col-lg-2">
            <img width="150" class="" src="{{ $tourInfo->image }}">

        </div>
        <div class="col-lg-6">
            <h2 class="">Power your league with
                LeagueRepublic</h2>

            <p class=" ">LeagueRepublic is free to use. We
                also offer with
                additional features.</p>
        </div>
    </div>
</div>
<div class="container mt-4" style="background: white; border-radius: 10px">
    <h2>Chi tiết giải đấu</h2>
    <div>
        @foreach($groupSchedule as $match => $schedules)
        <div style="background: #eee; border-radius: 10px">
            Vòng đấu: {{ $match }}
        </div>
        @foreach($schedules as $schedule)
        <div class="row mt-4">
            <div class="col-lg-3">Thời gian: {{ $schedule->time }} {{ $schedule->date }}</div>
            <div class="col-lg-2">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="image" src="{{ $schedule->team1->image }}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                        {{ $schedule->team1->name }}
                    </div>
                    <div class="col-lg-12 mt-4">
                        <img class="image" src="{{ $schedule->team2->image }}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                        {{ $schedule->team2->name }}
                    </div>
                </div>
            </div>
            <div class="col-lg-2">{{ $schedule->stadium }}</div>
        </div>
        @endforeach
        <hr>
        @endforeach

    </div>
</div>
@endsection
