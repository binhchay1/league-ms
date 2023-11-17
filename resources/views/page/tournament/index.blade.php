@extends('layouts.page')
@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>

    <div class="row" style="background: white; border-radius: 10px; padding: 10px">
        <h2>Danh sách giải đấu</h2>
        @foreach($listTournament as $listTour)
        <div class="col-lg-3" style=" margin-top: 10px">
            <section id="signup" style="background: #eee; border-radius: 10px; " >
                <div class="">
                    <a href="{{route('tour.info', $listTour['slug'])}}">
                        <div style="color: #434365">
                            <h5 class="center" >{{$listTour->name}}</h5>
                            <img width="80" class="lazy truncated initial loaded white center" src="{{$listTour->image}}" style="margin-left: 35%;width: 100px;">
                            <p class="center">{{$listTour->type}}</p>
                        </div>
                    </a>

                </div>
            </section>
        </div>
        @endforeach
    </div>

</main>
@endsection
