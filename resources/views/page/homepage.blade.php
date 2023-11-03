@extends('layouts.page')
@section('content')
    <div class="container__content content">
        <div class="container__main" id="main">
            <div class="container__mainInner" id="tc">
                <main class="container__liveTableWrapper sport_page" id="mc">
                    <div class="container__livetable">
                        <div class="container__heading">
                            <div>
                                <div id="live-table">
                                    <div class="">
                                        <div class="">
                                            <div class="event__header">
                                                <div class="wizard__relativeWrapper">
                                                    <button type="button" class="eventSubscriber eventSubscriber__star">
                                                        <svg class="star-ico eventStar"><title></title>
                                                            <use xlink:href="/res/_fs/build/action.30f034d.svg#star"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="icon--flag event__title fl_3473162">
                                                    <div class="event__titleBox"><span class="event__title--type">BWF WORLD TOUR - NAM</span><span
                                                            class="event__title--name" title="HYLO Mở rộng (Đức)">HYLO Mở rộng (Đức)</span>
                                                    </div>
                                                    <div class="wizard__relativeWrapper">
                                                        <button type="button" class="eventSubscriber eventSubscriber__pin"
                                                                title="Ghim giải đấu này vào mục Giải đấu được ghim!">
                                                            <svg class="pin-ico pin eventPin"><title></title>
                                                                <use
                                                                    xlink:href="/res/_fs/build/action.30f034d.svg#pin"></use>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <a href="#" class="event__info active">Nhánh đấu</a><span
                                                    class="event__expanderBlock" title="Ẩn tất cả trận đấu thuộc giải đấu!"><svg
                                                        class="arrow event__expander event__expander--open"><title></title><use
                                                            xlink:href="/res/_fs/build/action.30f034d.svg#arrow"></use></svg></span>
                                            </div>
                                            <div id="g_21_6JpNiGCL" title="Click để có thông tin trận đấu!"
                                                 elementtiming="SpeedCurveFRP"
                                                 class="event__match event__match--scheduled event__match--twoLine">
                                                <div
                                                    class="eventSubscriber eventSubscriber__star eventSubscriber__star--event"
                                                    title="Thêm trận đấu này vào mục Quan tâm!">
                                                    <svg class="star-ico eventStar"><title></title>
                                                        <use xlink:href="/res/_fs/build/action.30f034d.svg#star"></use>
                                                    </svg>
                                                </div>
                                                <div class="event__time">18:00</div>
                                                <span class="flag fl_77 event__logo event__logo--home" title="Pháp"></span>
                                                <div class="event__participant event__participant--home">Popov C.</div>
                                                <span class="flag fl_222 event__logo event__logo--away"
                                                      title="Hồng Kông"></span>
                                                <div class="event__participant event__participant--away">Lee C. Y.</div>
                                                <div class="event__score event__score--home">-</div>
                                                <div class="event__score event__score--away">-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- MenuLeft -->
                <aside class="container__myMenu" id="lc">
                    <div class="container__overlay">
                        <div id='my-teams-left-menu' class='myTeamsWrapper'>
                            <div class="leftMenu__head">
                                <svg class="leftMenu__icon leftMenu__icon--star">
                                    <use xlink:href="/res/_fs/image/13_symbols/action.svg?1670000000#pin"/>
                                </svg>
                                <span class="leftMenu__title">Đội bóng của tôi </span>
                            </div>
                        </div>
                        <div id="rank-menu" class="menu country-list leftMenu leftMenu--ranking">
                            <div class="leftMenu__head">
                                <svg class="leftMenu__icon leftMenu__icon--rank">
                                    <use xlink:href=/res/_fs/image/13_symbols/action.svg#list-view></use>
                                </svg>
                                <span class="leftMenu__title leftMenu__title--white">Bảng xếp hạng</span>
                            </div>
                            <div class="leftMenu__item leftMenu__item--width  " title="BWF Đơn Nam">
                                <a class="leftMenu__href" href="/cau-long/xep-hang/bwf-singles-men/">
                                    <svg class="leftMenu__icon leftMenu__icon--rank">
                                        <use xlink:href="/res/_fs/image/13_symbols/others.svg#man"></use>
                                    </svg>
                                    <span class="leftMenu__text">BWF Đơn Nam</span></a>
                            </div>
                        </div>
                        <div class="mbox0px l-brd">
                            <div class="menu country-list leftMenu leftMenu--active" id="mt">
                                <div class="leftMenu__head"><span class="leftMenu__title leftMenu__title--white">Giải đấu hiện tại</span>
                                </div>
                                <div
                                    class="leftMenu__item leftMenu__item--width "
                                    title="BWF World Tour HYLO Mở rộng Men"><a class="leftMenu__href"
                                                                               href="/cau-long/bwf-world-tour-men/hylo-open/">
                                        <svg class="leftMenu__icon leftMenu__icon--rank">
                                            <use xlink:href="/res/_fs/image/13_symbols/others.svg#man"></use>
                                        </svg>
                                        <span class='leftMenu__text'>BWF WT HYLO Mở rộng Men</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <aside id="extraContent" class="extraContent">
                <div class="extraContent__content">
                    <div class="extraContent__text"><b>Hỗ trợ:</b> Dịch vụ kết quả cầu lông của Flashscore.vn cung cấp
                        livescore cầu lông, kết quả, lịch thi đấu và bốc thăm nhánh đấu từ HYLO mở rộng 2023, BWF World
                        Tour Super Series, giải Vô địch Thế giới BWF, các giải đấu đơn và đồng đội của các châu lục (ví
                        dụ giải Vô địch Cầu lông châu Á, Đại hội thể thao châu Âu) và các giải đấu cầu lông khác. Hãy
                        theo dõi kết quả cầu lông từ tất cả các giải đấu cầu lông đang diễn ra tại trang web này, <a
                            href="/cau-long/xep-hang/bwf-singles-men/">xếp hạng BWF thế giới</a>, giải đấu (ví dụ <a
                            href="/cau-long/bwf-world-tour-men/all-england-open/">All England Mở rộng</a>, <a
                            href="/cau-long/bwf-world-tour-men/japan-open/">Nhật Bản Mở rộng</a>, <a
                            href="/cau-long/bwf-world-tour-men/indonesia-open/">Indonesia Mở rộng</a>) hay trang hồ sơ
                        của các vận động viên (<a href="/cau-thu/axelsen-viktor/2TL9oyiB/">Viktor Axelsen</a>, <a
                            href="/cau-thu/yamaguchi-akane/pKuBkeNb/">Akane Yamaguchi</a>, … )!<br>
                        Theo dõi tỉ số trực tiếp HYLO mở rộng 2023 tại Flashscore.vn! HYLO mở rộng 2023 <a
                            href="/cau-long/bwf-world-tour-men/hylo-open/">đơn nam</a>, <a
                            href="/cau-long/bwf-world-tour-women/hylo-open/">đơn nữ</a>, <a
                            href="/cau-long/bwf-world-tour-doubles-men/hylo-open/">đôi nam</a>, <a
                            href="/cau-long/bwf-world-tour-doubles-women/hylo-open/">đôi nữ</a>.
                    </div>
                </div>
                <div class="extraContent__button">
                    Hiển thị thêm
                </div>
            </aside>
        </div>
    </div>
@endsection
