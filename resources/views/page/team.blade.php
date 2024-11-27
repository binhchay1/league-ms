@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Privacy') }}
@endsection
<style>
    .box-historical #list-historical {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }
    .box-historical #list-historical .item-single {
        box-sizing: border-box;
        overflow: hidden;
        background: darkgray;
        border-left: 2px solid #fff;
        border-top: 2px solid #fff;
        display: flex;
        flex-direction: column;
    }

    .player-number {
        width: 20%;
        font-size: 30px;
        font-weight: 700;
        color: white;
    }

    .player-name {
        width: 80%;
        font-size: 25px;
        font-weight: 700;
        color: white;
    }

    .box-historical {
        margin-top: 50px;
    }

</style>
@section('content')
    <div class="box-historical container">
        <!-- Display tournament details -->
        <div class="title text-center">
            <h2>DANH SÁCH THÀNH VIÊN ĐỘI BÓNG</h2>
        </div>
        <div class="title">
            <div class="">
                <h3>Goalkeeper</h3>
            </div>
        </div>
        @foreach($listGoalkeeper as $player)
            <div id="list-historical">
                <div class="item-single">
                    <div class="info">
                        <!-- Player profile image -->
                        <div class="image">
                            <a href="https://bwfworldtour.bwfbadminton.com/player/96713/nozomi-okuhara">
                                <img alt="nozomi-okuhara"
                                     src="{{asset($player->number_shirt)}}"
                                     class=" b-error">
                            </a>
                        </div>

                        <!-- Player flag and name -->
                        <div class="description d-flex">
                            <p class="player-number"> {{$player->number_shirt}}</p>
                            <p class="player-name" >{{$player->name}} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="background: #f3f4f6">
        <div class="box-historical container" >
            <!-- Display tournament details -->
            <div class="title">
                <div class="">
                    <h3>Defender</h3>
                </div>
            </div>
            @foreach($defender as $player)
                <div id="list-historical">
                    <div class="item-single">
                        <div class="info">
                            <!-- Player profile image -->
                            <div class="image">
                                <a href="https://bwfworldtour.bwfbadminton.com/player/96713/nozomi-okuhara">
                                    <img alt="nozomi-okuhara"
                                         src="{{asset($player->number_shirt)}}"
                                         class=" b-error">
                                </a>
                            </div>

                            <!-- Player flag and name -->
                            <div class="description d-flex">
                                <p class="player-number"> {{$player->number_shirt}}</p>
                                <p class="player-name" >{{$player->name}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div class="box-historical container">
        <!-- Display tournament details -->
        <div class="title">
            <div class="">
                <h3>Midfielder</h3>
            </div>
        </div>
        @foreach($midfielder as $player)
            <div id="list-historical">
                <div class="item-single">
                    <div class="info">
                        <!-- Player profile image -->
                        <div class="image">
                            <a href="https://bwfworldtour.bwfbadminton.com/player/96713/nozomi-okuhara">
                                <img alt="nozomi-okuhara"
                                     src="{{asset($player->number_shirt)}}"
                                     class=" b-error">
                            </a>
                        </div>

                        <!-- Player flag and name -->
                        <div class="description d-flex">
                            <p class="player-number"> {{$player->number_shirt}}</p>
                            <p class="player-name" >{{$player->name}} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="box-historical container" style="margin-bottom: 50px">
        <!-- Display tournament details -->
        <div class="title">
            <div class="">
                <h3>Forward</h3>
            </div>
        </div>
        @foreach($forward as $player)
        <div id="list-historical">
            <div class="item-single">
                <div class="info">
                    <!-- Player profile image -->
                    <div class="image">
                        <a href="https://bwfworldtour.bwfbadminton.com/player/96713/nozomi-okuhara">
                            <img alt="nozomi-okuhara"
                                 src="{{asset($player->number_shirt)}}"
                                 class=" b-error">
                        </a>
                    </div>

                    <!-- Player flag and name -->
                    <div class="description d-flex">
                        <p class="player-number"> {{$player->number_shirt}}</p>
                        <p class="player-name" >{{$player->name}} </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
