@extends('layouts.page')
@section('content')
    <div class="container" style="background: white; border-radius: 10px; padding: 10px">
        <div  style="">
            <div class="row">
                <div class="col-lg-2">
                    <img width="150" class="" src="{{$tourInfo->image}}">

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
    </div>
    <div class="container mt-4" style="background: white; border-radius: 10px">
        <h2>Chi tiết giải đấu</h2>
        <div>
            @foreach($tourInfo->schedule as $data)
                <div style="background: #eee; border-radius: 10px">
                    Vòng đấu: {{ $data->match }}
                </div>
                <div class="row mt-4">
                    <div class="col-lg-3">Thời gian: {{ $data->time }}  {{$data->date}}</div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <img class ="image" src="{{$data->team1->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                {{$data->team1->name}}
                            </div>
                            <div  class="col-lg-12 mt-4">
                                <img class ="image" src="{{$data->team2->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                {{$data->team2->name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">{{$data->stadium}}</div>
                </div>
                <hr>
            @endforeach

        </div>
    </div>
    @endsection
