@extends('layouts.page')

@section('title')
{{__('Detail League')}}
@endsection

@section('content')
<style>
    .zoom-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all .3s ease;
    }

    .zoom-img img:hover {
        transform: scale(1.2);
    }
</style>
<div class="container">
    <div style="background: #eee">
        <div id="loading" style="background-image: url('{{ asset('images/badminton.jpg')}}'); height: 300px; margin-top: -25px; background-repeat: no-repeat;">
            <div class="" style="border-radius: 10px; padding: 10px">
                <div class="row">
                    <div class="col-lg-2 mt-4">
                        <img width="150" class="" src="{{ $tourInfo->image }}">
                    </div>
                    <div class="col-lg-6 " style="text-align: left">
                        <h2 class="">{{ $tourInfo->name }}</h2>
                        <h5 class="">{{__('Start Date')}}: {{ $tourInfo->start_date }}</h5>
                        <h5 class="">{{__('End Date')}}: {{ $tourInfo->end_date }}</h5>
                        <p class="">{{__('PRIZE MONEY USD ')}}${{ $tourInfo->money }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" style="font-size: 20px; font-weight: 600;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">{{__('Result')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{__('Schedule')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{__('Fighting Branch')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{__('Player')}}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <hr>

    {{--Content League --}}
    {{--Result --}}
    {{--Schedule--}}
    {{--Fighting Branch --}}
    {{--Player --}}
    <div id="page" class="hfeed site">
        <section id="ranking" class="container-1280 rankings-section pb-200">
            <div class="tab-content rankings-content_tabpanel">
                <h3 style="margin-bottom: 12px;">{{__('Player')}}</h3>
                <div class="entry-player-all-wrap">
                    @foreach($tourInfo->userLeagues as $listTour)
                    <div class="entry-player-pair-wrap">
                        <a href="" style="text-decoration: none;">
                            <div class="entry-player-wrap">
                                <div class="entry-player-image">
                                    <img width="80" class="lazy truncated initial loaded white " src="{{$listTour->user->image ?? '/images/no-image.png'}}" style="width: 100px; height: 125px">
                                </div>
                                <div class="entry-player-info-wrap">
                                    <div class="entry-player-name">
                                        {{$listTour->user->name}}
                                    </div>
                                    <div class="entry-player-flag">
                                        <img src="https://extranet.bwf.sport/docs/flags/indonesia.png" />
                                        <span>Indonesia</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    @endsection
    @section('js')
    <script src="{{ asset('js/eventSchedule.js') }}"></script>
    @endsection
