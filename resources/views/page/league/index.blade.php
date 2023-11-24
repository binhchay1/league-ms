@extends('layouts.page')
@section('title')
    Giải đấu
@endsection
@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>

    <div class="container">
        <h2>{{__('List League')}}</h2>
        <div  style="background: white; border-radius: 10px; padding: 10px">
            @foreach($listLeague as $listLeague)
                <div class="te" style=" margin-top: 10px">
                    <div id="" style="background: #eee;" >
                        <a href="{{route('tour.info', $listLeague['slug'])}}" style="text-decoration: none;">
                            <div class="row" style="color: black; height: 200px;">
                                <div class="col-lg-3">
                                    <img class="lazy truncated initial loaded white center" src="{{$listLeague->image}}" style="width: 200px;height: 150px;margin: 30px">
                                </div>
                                <div class="col-7 mt-4">
                                    <h3 class="" >{{ $listLeague->name }}</h3>

                                    <h5 class="">{{__('Start Date')}}: {{ $listLeague->start_date }}</h5>
                                    <h5 class="">{{__('End Date')}}: {{ $listLeague->end_date }}</h5>
                                    <p class="">{{__('PRIZE MONEY USD ')}}${{ $listLeague->money }}</p>
                                </div>
                                <div class="col-lg-2">
                                    <img class="" src="{{$listLeague->image_nation_flag}}" style="width: 100px;height: 50px; margin-top: 30px">
                                    <h6 class="mt-4" >{{$listLeague->national}}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
