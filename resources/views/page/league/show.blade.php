@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{asset('css/content/league.css')}}" type="text/css" media="all" />
@endsection
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" id="dashicons-css"
          href="{{asset('league/wp-includes/css/dashicons.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="editor-buttons-css"
          href="{{asset('league/wp-includes/css/editor.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="wp-block-library-css"
          href="{{asset('league/wp-includes/css/dist/block-library/style.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="bwf-newsletter-signup-style-css"
          href="{{asset('league/wp-content/plugins/bwf-newsletter/css/newsletter-signup.css?ver=1.2')}}"/>
    <link rel="stylesheet" id="bootstrap-style-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/bootstrap.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="bwf_menu_style-css"
          href="{{asset('league/wp-content/plugins/bwf-menu-system/css/bwf-menu-system.css?ver=1.233')}}"/>
    <link rel="stylesheet" id="bwf-style-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/style.css?ver=1.233')}}"/>
    <link rel="stylesheet" id="hover-style-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/css/hover-min.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="fancybox-style-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/fancybox-master/dist/jquery.fancybox.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="select2-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/select2/dist/css/select2.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="fontawesome-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/fontawesome/css/font-awesome.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="animate.ss-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/animate.css/animate.min.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="owl-style-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.carousel.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <link rel="stylesheet" id="owl-theme-css"
          href="{{asset('league/wp-content/themes/world-tour-finals/assets/js/vendor/owl-carousel2/dist/assets/owl.theme.default.css?ver=1717160f66b565489b11f0a0e460e849')}}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div id="page" class="hfeed site">
    <div class="">
        <div class="container-1280 results">

            <div class="std-title">
                <div class="std-title-left">
                    <h2 class="left">{{__('LEAGUE INFORMATION')}}</h2>
                </div>
            </div>
            <div class="wrapper-results">
                <div>
                    <div class="box-title page-header">
                        <div class="box-title-left">
                        </div>
                        <div class="box-title-right">
                            <h4 class="right">
                                {{__('OTHER LEAGUE')}} </h4>
                            <label class="tournament-select clear">
                                <select name='record' class="ddlTournament">
                                    @foreach($listLeagues as $league => $value )
                                        <?php $dataLeague = str_slug($value->name) ?>
                                        <option value="{{$dataLeague}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="box-results-tournament">
                        <div>
                            <div class="logo-left">
                                <img height="90" src="{{ $tourInfo->images }}" alt="logo">
                            </div>
                            <div class="info">
                                <h2>{{ $tourInfo->name }}</h2>
                                <h5>{{__('Start Date')}}: {{ $tourInfo->start_date }}</h5>
                                <h5>{{__('End Date')}}: {{ $tourInfo->end_date }}</h5>
                                <div class="prize">{{__('PRIZE MONEY USD ')}}${{ $tourInfo->money }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                    <ul id="ajaxTabs" class="content-tabs">
                        <li>
                            <a href="{{route('result.info', $tourInfo['slug'])}}">{{__('Result')}} </a>
                        </li>
                        <li><a href="">{{__('Schedule')}}</a>
                        </li>
                        <li><a href="">{{__('Fighting Branch')}}</a>
                        </li>
                        <li><a id="player-data" href="{{route('player.info', $tourInfo['slug'])}}">{{__('Player ')}}</a>
                        </li>
                    </ul>
                    <div class="register mt-4" align="right">
                        <a href="#" class="popupLink btn btn-danger btn-lg" data-toggle="modal"
                           data-target="#MyDetailsModal">{{__('Register to the league')}}
                        </a>
                    </div>

                    <div class="content-results">
                        <div class="item-results">
                            @if(Route::current()->getName() == 'player.info')
                                <div>
                                    @include('page.league.detail.player')
                                </div>
                            @elseif(Route::current()->getName() == 'result.info')
                                <div>
                                    @include('page.league.detail.result')
                                </div>
                            @else
                                <div>
                                    @include('page.league.rank')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

    <div class="modal" id="MyDetailsModal" tabindex="-1" role="dialog" arialabelledby="myDetailsModal"
         aria-hidden="true">
        <div class="modal-dialog modal-details" role="document">
            <div class="modal-content modal-details"
                 style="width: 750px;margin: auto;height: 500px; margin-left: -80px;">
                <div class="leagueInfo">
                    <h1 align="center">{{__('Register')}}</h1>
                    <div class="tab-content" id="tab-content">
                        <div class="row" style="color: black; height: 200px;">
                            <div class="col-lg-4">
                                <img class="lazy truncated initial loaded white center " src="{{$tourInfo->images}}"
                                     style="width: 200px;height: 150px;margin: 30px">
                            </div>
                            <div class="col-8 mt-2" style="font-weight: 700" ;>
                                <h3 class="">{{ $tourInfo->name }}</h3>
                                {{ $tourInfo->type_of_league }}
                                <h6 class="">{{__('Start Date')}}: {{ $tourInfo->start_date }}</h6>
                                <h6 class="">{{__('End Date')}}: {{ $tourInfo->end_date }}</h6>
                                <p class="">{{__('PRIZE MONEY USD ')}}${{ $tourInfo->money }}</p>
                            </div>
                            <div class="checkbox" align="center">
                                <input id="check" name="checkbox" type="checkbox">
                                <label for="checkbox">{{__('I have read and agree to the tournament rules')}}</label>
                            </div>
                            <div align="center">
                                <button id="open-tab1" class="btn btn-success" disabled>Register</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infor" style="display: none">
                    <h1 align="center">{{__('Confirm Information')}}</h1>
                    <form id="formAccountSettings" method="POST" action="{{route('registerLeague')}}" enctype="multipart/form-data">
                        @csrf()
                    <div class="tab-content rankings-content_tabpanel">
                        <div class="item-active">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="rankings-table">
                                <thead align="center">
                                <tr >
                                    <th style="text-align: center" class="col-rank" align="center">{{__('Name')}}</th>
                                    <th style="text-align: center" class="col-country" align="center">{{__('Image')}}</th>
                                    <th style="text-align: center"  class="col-player">{{__('Age')}}</th>
                                    <th style="text-align: center" class="col-points" align="center">{{__('Address')}}</th>
                                </tr>
                                </thead>
                                <tr class="row-top-eight">
                                    <input type="hidden" name="league_id" id="" value="1">
                                    <input type="hidden" name="user_id" value="2">
                                    <input type="hidden" name="status" value="0">
                                    <td align="center" >
                                    </td>
                                    <td align="center">
                                        <div class="country">
                                            <img  width="48" src="https://extranet.bwf.sport/docs/flags/japan.png" title="Japan" class="flag">
                                        </div>
                                    </td>

                                    <td align="center" class="data-player">
                                        <div  class="player">

                                        </div>
                                    </td>
                                    <td class="data-points" align="center">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                        <div>
                            <button type="submit" class="btn btn-success me-2">{{ __('Send Information') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/league.js') }}"></script>
    <script>
        $("[name='record']").on("change", function (e) {
            let edit_id = $(this).val();
            window.location.href = window.location.origin + '/info/' + edit_id;
        });

    </script>

@endsection

