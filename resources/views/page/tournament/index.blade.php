@extends('layouts.page')
@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>

    <div id="FilterTemplate">
        <form method="GET" action="https://myleague.vn/league" accept-charset="UTF-8" class="form-horizontal league-search-box" id="form-search-league" name="search-league">
            <input type="hidden" name="tab" value="card">
            <div class="container">
                <div class="row">
                    <div class="" style="margin-top: 30px">
                        <li id="search">
                            <form id="searchMenuForm" name="searchMenuForm" action="/search.html" method="post">
                                <div >
                                    <input type="search" name="searchValue" placeholder="Search leagues...">
                                    <button type="button">
                                        <img src="/images/icon-search.svg" alt="Search" title="Search" width="15" height="15">
                                    </button>
                                </div>
                            </form>
                        </li>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="row" >
        @foreach($listTournament as $listTour)
        <div class="col-lg-4" style="padding: 40px; margin-top: 10px">
            <section id="signup" style="background: #eee; border-radius: 10px; " >
                <div class="">
                    <a href="{{route('tour.info', $listTour['name'])}}">
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


{{--                        <div class="row">--}}
{{--                            <div class="col-xs-12" style="padding:0">--}}
{{--                                <nav class="text-center" aria-label="Page navigation">--}}
{{--                                    <ul class="pagination">--}}
{{--                                        <div class="pull-right pagination">--}}
{{--                                            {{$listTournament->appends($_GET)->links() }}--}}
{{--                                        </div>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


</main>
@endsection
