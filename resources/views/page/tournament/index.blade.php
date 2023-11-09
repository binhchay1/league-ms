@extends('layouts.page')
@section('content')
<main id="Leagues">
    <div id="FilterTemplate">
        <form method="GET" action="https://myleague.vn/league" accept-charset="UTF-8" class="form-horizontal league-search-box" id="form-search-league" name="search-league">
            <input type="hidden" name="tab" value="card">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-xs-10">
                        <div class="input-group">
                            <input class="form-control" placeholder="Tên giải đấu, tên người quản lý" name="keyword" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12 league-filter">
                        <label class="league-filter-icon visible-xs" for="league-filter-checkbox">
                            <i class="fa fa-filter"></i>
                        </label>
                        <input type="checkbox" id="league-filter-checkbox">
                        <div class="league-filter-box row">
                            <div class="col-sm-4 league-filter__item province" style="margin-right:0;padding-right:0">
                                <select class="form-control text-capitalize" id="sportName" name="sport">
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
                                </select>
                            </div>
                            <div class="col-sm-4 league-filter__item typeLeague" style="margin-right:0;padding-right:0">
                                <select class="form-control text-capitalize" id="typeLeague" name="typeLeague">
                                    <option value="" selected="selected">Hình Thức</option>
                                    <option value="1">Loại trực tiếp</option>
                                    <option value="2">Đấu vòng tròn</option>
                                    <option value="3">Chia bảng đấu</option>
                                    <option value="4">Vòng tròn - loại trực tiếp</option>
                                    <option value="5">Nhánh thắng - nhánh thua</option>
                                </select>
                            </div>
                            <div class="col-sm-4 league-filter__item Statuses" style="margin-right:0;padding-right:0">
                                <select class="form-control text-capitalize" id="Statuses" name="status">
                                    <option value="" selected="selected">Trạng Thái</option>
                                    <option value="0">Đang đăng ký</option>
                                    <option value="1">Hoạt động</option>
                                    <option value="2">Kết thúc</option>
                                </select>
                            </div>
                            <div class="col-sm-4 league-filter__item SortOptions">
                                <select class="form-control text-capitalize" id="SortOptions" style="padding-right:10px" name="sort">
                                    <option value="" selected="selected">Sắp Xếp</option>
                                    <option value="0">Theo Tên Giải Đấu</option>
                                    <option value="1">Mới Cập Nhật</option>
                                    <option value="2">Nhiều Người Xem</option>
                                    <option value="3">Nhiều Người Quan Tâm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="LeaguesTemplate">
        <section class="section section--dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex flex-jus-between flex-align-center mb-20">
                                    <h5 class="pull-left mb-0">
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="section-content">
                            <div class="league-result league-result--card">
                                @foreach($listTournament as $listTour)
                                    <div class="match-box-content league-item hvr-bob"style="margin: 30px; height: 250px; margin-top: 10px" >
                                        <div class="league-action league-action--right league-favourite">
                                            <div class="league-action__item league-favourite">
                                                <div class="pretty p-icon p-round p-tada">
                                                    <input type="checkbox" name="interval" data-id="45351">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="wrap-allinfo-league">
                                            <div class="show-cover">
                                                <img width="100%" class="lazy truncated initial loaded" alt="Cover Giải Bóng Đá Học Sinh T78" src="{{$listTour->image}}" data-was-processed="true">
                                            </div>
                                            <div class="league-info">
                                                <div class="league-info__img">
                                                    <a href="javascript:void(0)">
                                                        <img width="80" class="lazy truncated initial loaded" alt="Avatar Giải Bóng Đá Học Sinh T78"  src="{{$listTour->image}}" data-was-processed="true">
                                                    </a>
                                                </div>
                                                <div class="league-info__des">
                                                    <h5 class="league-info__name">
                                                        <a href="javascript:void(0)">
                                                        {{$listTour->name}}
                                                        </a>
                                                    </h5>
                                                    <p class="small text-muted hidden-xs league-info__short-info">
                                                        <span class="text-capitalize" style="word-break:break-word"> {{$listTour->type}} </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="padding:0">
                                <nav class="text-center" aria-label="Page navigation">
                                    <ul class="pagination">
                                        <div class="pull-right pagination">
                                            {{$listTournament->appends($_GET)->links() }}
                                        </div>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
