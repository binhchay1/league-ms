@extends('layouts.page')
@section('title')
    Chi tiết giải đấu
@endsection
@section('content')

    <style>
        .test{
            background-image: url(''),;
        }

        body {
            text-align: center;
        }

        .tooltip {
            position: relative;
            cursor: default;
            opacity: 1;
            display: flex;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            padding: 0.25em 0.5em;
            color: black;
            text-align: center;
            border-radius: 0.25em;
            white-space: nowrap;
            margin-top: auto;
            transition-property: visibility;
            transition-delay: 0s;
            border-style: solid;
            border-color: #0c0c0c;
            border-width: 1px;
            margin-left: 40%;
            margin-bottom: 25%;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            transition-delay: 0.3s;

        }
    </style>
    <div id="loading" style="background-image: url('{{ asset('images/background.jpg')}}'); margin-top: -25px">

        <div class="" style="; border-radius: 10px; padding: 10px">
            <div class="row">
                <div class="col-lg-2 ">
                    <img width="150" class="" src="{{ $tourInfo->image }}">
                </div>
                <div class="col-lg-6 "style="text-align: left">
                    <h2 class="">{{ $tourInfo->name }}</h2>
                    <p class=" ">{{ $tourInfo->type }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>dđ</h1>
    </div>

    @endsection
    @section('js')
    <script src="{{ asset('js/eventSchedule.js') }}"></script>
@endsection
