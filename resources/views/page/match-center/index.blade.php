@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />

@endsection

@section('content')
    <style>
        #signup:before {
            width: 0;
        }
    </style>
    <div class="container">
        <div class="content-left container">
            <div class="content-left-scroll">
                <div class="home-wrap" tmt-detail="[object Object]">
                    <div class="home-page-outer current-tournament">
                        <div class="home-section text-left"><!----><h2>Current Live Tournament</h2>
                            <div class="current-tmt-wrap">
                                <div class="current-tmt-outer">
                                    <div class="current-tmt-inner">
                                        <div class="current-tmt-logo">
                                            <a href="" class="">
                                                <img src="https://extranet.bwfbadminton.com/docs/events/4737/logo-colour/Indonesia-Masters-2024.svg"></a>
                                        </div>
                                        <div class="current-tmt-name">DAIHATSU Indonesia Masters 2024</div>
                                    </div>
                                    <div class="current-tmt-link-wrap text-center" >
                                        <div><a href="/4737" class=" btn btn-danger "> Live Scores </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
