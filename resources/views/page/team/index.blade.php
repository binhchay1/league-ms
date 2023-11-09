@extends('layouts.page')
@section('content')
<div id="findTeams">
    <div class="findTeams">
        <section class="section league-search-box">
            <form method="GET" action="https://myleague.vn/competitor/search" accept-charset="UTF-8" class="form-horizontal" id="form-search-team" name="search-team"> <input type="hidden" name="tab" value="card">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-xs-10 team-padding">
                            <div class="input-group"> <input id="searchText" class="form-control" placeholder="Tên đội, địa chỉ, tên người quản lý." name="keyword" type="text"> <span class="input-group-btn"> <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button> </span> </div>
                        </div>
                        <div class="col-sm-8 col-xs-12 league-filter"> <label class="league-filter-icon visible-xs" for="league-filter-checkbox"><i class="fa fa-filter"></i></label> <input type="checkbox" id="league-filter-checkbox">
                            <div class="league-filter-box row">
                                <div class="col-sm-4 league-filter__item"> <select class="form-control text-capitalize" id="sportName" name="sport">
                                        <option value="" selected="selected">Môn thi đấu</option>
                                        <option value="18">AOE</option>
                                        <option value="63">BattleBots</option>
                                        <option value="43">Bi đá trên băng</option>
                                        <option value="5">Bida</option>
                                        <option value="42">Bowling</option>
                                        <option value="33">Brawlhalla</option>
                                        <option value="4">Bóng bàn</option>
                                        <option value="34">Bóng bầu dục</option>
                                        <option value="2">Bóng chuyền</option>
                                        <option value="35">Bóng chày</option>
                                        <option value="40">Bóng gậy (cricket)</option>
                                        <option value="41">Bóng ném</option>
                                        <option value="49">Bóng nước</option>
                                        <option value="50">Bóng quần (squash)</option>
                                        <option value="3">Bóng rổ</option>
                                        <option value="48">Bóng vợt (pickleball)</option>
                                        <option value="1">Bóng đá</option>
                                        <option value="39">Bơi lội</option>
                                        <option value="37">Bắn cung</option>
                                        <option value="38">Bắn súng</option>
                                        <option value="32">Call of Duty</option>
                                        <option value="11">Caro</option>
                                        <option value="21">Clash of Clans</option>
                                        <option value="31">Counter-Strike</option>
                                        <option value="6">Cầu lông</option>
                                        <option value="10">Cờ tướng</option>
                                        <option value="9">Cờ vua</option>
                                        <option value="17">DOTA 2</option>
                                        <option value="56">Dragon Ball FighterZ</option>
                                        <option value="15">FIFA</option>
                                        <option value="12">Fantasy Premier League</option>
                                        <option value="58">Fortnite</option>
                                        <option value="52">Free Fire</option>
                                        <option value="8">Futsal</option>
                                        <option value="44">Golf</option>
                                        <option value="25">Karatedo</option>
                                        <option value="36">Khúc côn cầu</option>
                                        <option value="27">Kick Boxing</option>
                                        <option value="16">Liên minh huyền thoại</option>
                                        <option value="19">Liên minh tốc chiến</option>
                                        <option value="20">Liên quân mobile</option>
                                        <option value="54">Lost Ark</option>
                                        <option value="53">Mobile Legends</option>
                                        <option value="61">Moto GP</option>
                                        <option value="28">Muay Thai</option>
                                        <option value="57">NBA Esports</option>
                                        <option value="47">Ném đĩa</option>
                                        <option value="14">PES Mobile</option>
                                        <option value="51">PUBG Mobile</option>
                                        <option value="30">Pokémon GO</option>
                                        <option value="62">Quản lý bóng đá</option>
                                        <option value="24">Taekwondo</option>
                                        <option value="59">Teamfight Tactics</option>
                                        <option value="7">Tennis</option>
                                        <option value="55">Tennis Esports</option>
                                        <option value="22">Valorant</option>
                                        <option value="26">Vovinam</option>
                                        <option value="60">WWE</option>
                                        <option value="23">Warcraft</option>
                                        <option value="29">Wushu</option>
                                        <option value="13">eFootball</option>
                                        <option value="45">Đua xe</option>
                                        <option value="46">Đấu kiếm</option>
                                        <option value="99">Khác</option>
                                    </select> </div>
                                <div class="col-sm-4 league-filter__item"> <select class="form-control text-capitalize" id="Types" name="teamType">
                                        <option value="" selected="selected">Trình độ</option>
                                        <option value="1">chuyên nghiệp</option>
                                        <option value="2">bán chuyên nghiệp</option>
                                        <option value="3">cao cấp</option>
                                        <option value="4">trung cấp</option>
                                        <option value="5">vui</option>
                                        <option value="6">khác</option>
                                    </select> </div>
                                <div class="col-sm-4 league-filter__item"> <select class="form-control text-capitalize" id="gender" name="gender">
                                        <option value="" selected="selected">Giới Tính</option>
                                        <option value="0">Nữ</option>
                                        <option value="1">Nam</option>
                                    </select> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <div class="teamListResult" style="margin:30px">
            <section class="section child-section-team section--dashboard">
                <div class="container">
                    <div class="section-content">
                        <div class="row" id="card" style="">
                            @foreach($listTeam as $team)
                            <div class="col-sm-6 col-md-3 pb-3">
                                <div class="competitor cardTeam">
                                    <div class="pointer hvr-underline-from-center width-100" onclick="window.location='https://myleague.vn/competitor/25199/profile'">
                                        <div class="competitor-description">
                                            <div class="league-avatar" >
                                                <img width="100%" class="lazy truncated initial loaded" alt="Cover Giải Bóng Đá Học Sinh T78" src="{{$team->image}}" data-was-processed="true" style="height: 80px">

                                            </div>
                                            <p class="truncated team-title"><a href="https://myleague.vn/competitor/25199/profile">{{$team->name}}</a> </p>
                                        </div>
                                        <div class="competitor-stats">
                                            <p class="small text-muted hidden-xs league-info__short-info text-capitalize">Huấn luyện viên: {{$team->coach}} </p>
                                        </div>
                                    </div>
                                    <div class="competitor-members text-center">
                                        <p class="help-block text-center small clickable hvr-grow" onclick="window.location='https://myleague.vn/competitor/25199/player'"> Thành viên </p>
                                        <div class="flex flex-jus-center">
                                            <div class="flex-item">
                                                <div class="competitor-members__more" style="background-image: url('/uploadfiles/competitors/member/avatar/J3x932KjPknbdyqspiwV8GXBZW8hl22MGgQuMBNb.jpg')">
                                                </div>
                                            </div>
                                            <div class="flex-item">
                                                <div class="competitor-members__more" style="background-image: url('/uploadfiles/competitors/member/avatar/4xhi0KQRGP5ulXDXZnC62x5FXD1g4o8qmpdhtCx1.jpg')">
                                                </div>
                                            </div>
                                            <div class="flex-item">
                                                <div class="competitor-members__more" style="background-image: url('/uploadfiles/competitors/member/avatar/40823ac2214eedf5a4bef0621b98e28azdusf.png')">
                                                </div>
                                            </div>
                                            <div class="flex-item">
                                                <a href="https://myleague.vn/competitor/25199/player" class="competitor-members__more clickable">
                                                    +27
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12" style="padding:0">
                        <nav class="text-center" aria-label="Page navigation">
                            <ul class="pagination">
                                <div class="pull-right pagination">
                                    {{$listTeam->appends($_GET)->links() }}
                                </div>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
