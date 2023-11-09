@extends('layouts.page')
@section('content')
<div id="AppContent" class>
    <div id="loading-one-page" style="display:none">
        <div id="loading35">
            <div class="cssload-loader">
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
                <div class="cssload-side"></div>
            </div>
        </div>
    </div>
    <div id="wrapHomePage">
        <div id="fullpage">
            <div class="section" id="home--1">
                <div class="ps-wrapper">
                    <div class="site-logo">
                        <a href="/" title="Hệ thống quản lý giải đấu">
                            <img alt="Hệ thống quản lý giải đấu" width="220" src="homepage/content/images/white_logo.jpg" />
                        </a>
                    </div>
                    <div class="ps-middle">
                        <div class="heading-title mb30">
                            <h2>
                                Tổ chức giải đấu dễ dàng<br>Quản lý đội thể thao đơn giản!
                            </h2>
                        </div>
                        <div class="ps-buttons mb50">
                            <a href="https://myleague.vn/league/create-tournament" class="btn">
                                Tạo giải đấu
                            </a>
                            <a href="https://myleague.vn/league" class="btn btn__2">
                                Tìm giải đấu
                            </a>
                        </div>
                        <div class="ps-buttons mb-20 lineup">
                            <a href="https://myleague.vn/lineup" class="btn btn-warning">
                                Tạo đội hình
                            </a>
                        </div>
                        <ul class="ps-counts">
                            <li data-aos="zoom-out-right">
                                <span>{{ __('Giải đấu') }}</span>
                                <b id="total_league">43768</b>
                            </li>
                            <li data-aos="zoom-out-right">
                                <span>{{ __('Đội thi đấu') }}</span>
                                <b id="total_team">198349</b>
                            </li>
                            <li data-aos="zoom-out-left">
                                <span>{{ __('Vận động viê') }}n</span>
                                <b id="total_player">851573</b>
                            </li>
                            <li data-aos="zoom-out-left">
                                <span>{{ __('Lượt xem') }}</span>
                                <b id="total_view">16713252</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="section" id="home--2">
                <div class="wrapper">
                    <div class="heading-title text-center">
                        <h2>Điều hành giải</h2>
                        <p>Có 3 giai đoạn để điều hành một giải đấu</p>
                    </div>
                    <div class="st-image">
                        <img alt="Tạo giải và điều hành giải đấu" src="{{ asset('homepage/asset/home-page/images/index/home-2-image.png') }}" />
                    </div>
                    <div class="st-steps">
                        <div class="col-xs-12 col-lg-4 post-column" data-aos="zoom-out-right" data-aos-delay="80">
                            <div class="ps-post">
                                <div class="ps-post__content">
                                    <div class="ps-step">
                                        <div class="step-header">
                                            <span class="ps-step__index">1</span>
                                            <h3>Tạo Giải</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>Loại trực tiếp</span><br>
                                                <span>Đấu vòng tròn</span><br>
                                                <span>Chia bảng đấu</span><br>
                                                <span>Vòng tròn - loại trực tiếp</span><br>
                                                <span>Nhánh thắng - nhánh thua</span><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-4 post-column" data-aos="fade-up" data-aos-delay="80">
                            <div class="ps-post">
                                <div class="ps-post__content">
                                    <div class="ps-step">
                                        <div class="step-header">
                                            <span class="ps-step__index">2</span>
                                            <h3>Tùy chỉnh giải đấu</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>Nhập điều lệ, hình và địa điểm</span><br>
                                                <span>Nhập thông tin của đội / vận động viên</span><br>
                                                <span>Mời người tham gia</span><br>
                                                <span>Lập lịch đấu</span><br>
                                                <span>Tùy chỉnh giai đoạn</span><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-4 post-column" data-aos="zoom-out-left" data-aos-delay="80">
                            <div class="ps-post">
                                <div class="ps-post__content">
                                    <div class="ps-step">
                                        <div class="step-header">
                                            <span class="ps-step__index">3</span>
                                            <h3>Điều hành giải</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>Kích hoạt</span><br>
                                                <span>Nhập tỷ số</span><br>
                                                <span>Xem thống kê</span><br>
                                                <span>Chia sẻ với bạn bè</span><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="home--3">
                <div class="heading-title text-center mb50">
                    <h2>Hỗ trợ nhiều thể thức thi đấu</h2>
                    <p>Myleague giúp người dùng tạo ra các giải đấu có thể thức giống như<br> với các giải đấu nổi
                        tiếng thế giới như Champions League, World Cup, NBA, Laliga, ATP Cup ...</p>
                </div>
                <div class="ps-posts">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 post-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <p>Loại trực tiếp hoặc knockout <br>là loại giải đấu có đội thua<br> ở mỗi trận đấu
                                    <br>sẽ bị loại ngay khỏi giải đấu.
                                </p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="Loại trực tiếp" src="homepage/asset/home-page/images/index/home-3-image1.png?id=123" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img width="100" alt="Loại trực tiếp" src="homepage/content/images/icon_elimination.svg?id=123" data-file="icon_elimination" />
                                        <h3>Loại trực tiếp</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="fade-up" data-aos-delay="80">
                                <p>Mỗi đội sẽ thi đấu<br>với tất cả các đội còn lại.<br>Cho phép tuỳ chỉnh <br>điều
                                    lệ xếp hạng dễ dàng.</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="Đấu vòng tròn" src="homepage/asset/home-page/images/index/home-3-image2.png?id=123" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img style="padding:10px" alt="Đấu vòng tròn" src="https://myleague.vn/content/images/icon_round_robin.svg?id=123" width="100" data-file="icon_round_robin"><br>
                                        <h3>Đấu vòng tròn</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="zoom-out-left" data-aos-delay="80" style="float:right">
                                <p>Có hai giai đoạn đó là <br>giai đoạn một <br>chia thành nhiều bảng đấu <br>và
                                    giai đoạn hai là loại trực tiếp hoặc nhánh thắng - nhánh thua.</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="Chia bảng đấu" src="homepage/asset/home-page/images/index/home3-image5.png?id=123" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="Chia bảng đấu" src="homepage/content/images/icon_two_stages.svg?id=123" width="100" data-file="icon_two_stages"><br>
                                        <h3>Chia bảng đấu</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="fade-up" data-aos-delay="80">
                                <p>Là biến thể khác của thể thức đấu loại trực tiếp. Với thể thức này thì các đội bị
                                    thua sẽ tiếp tục được đấu với nhau ở một nhánh đấu được gọi là Nhánh Thua</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="Nhánh thắng - nhánh thua" src="homepage/asset/home-page/images/index/home-3-image3.png?id=123" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="Nhánh thắng - nhánh thua" style="padding:10px" src="homepage/content/images/icon_two_elimination.svg?id=123" width="100" data-file="icon_two_elimination"><br>
                                        <h3>Nhánh thắng -<br />Nhánh thua</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column hidden-md hidden-sm" data-aos="fade-up" data-aos-delay="1040">
                                <p>Kết hợp hai giai đoạn <br>vào một giải đấu, bao gồm <br>giai đoạn một đấu vòng
                                    tròn <br>và giai đoạn hai loại trực tiếp hoặc nhánh thắng - nhánh thua.</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="Vòng tròn - loại trực tiếp" src="homepage/asset/home-page/images/index/home-3-image4.png?id=123" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="Vòng tròn - loại trực tiếp" style="padding:10px" src="homepage/content/images/icon_league_knockout.svg?id=123" width="100" data-file="icon_league_knockout"><br>
                                        <h3>Vòng tròn -<br />Loại trực tiếp</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="home--4">
                <div class="ps-banner left">
                    <img alt="Phần mềm tạo giải đấu" src="homepage/asset/home-page/images/index/home4-img-left.svg" />
                </div>
                <div class="container">
                    <div class="ps-content">
                        <div class="heading-title text-center">
                            <h2>Lợi ích Myleague.vn mang lại</h2>
                            <p>Số hóa thể thao là xu hướng phát triển tất yếu!</p>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="Tiết kiệm tới 90% thời gian gọi điện, email, gặp gỡ, sắp xếp lịch, cập nhật kết quả, bảng xếp hạng... theo cách làm truyền thống." src="homepage/asset/home-page/images/index/home-4-icon1.svg" />
                                    <h4>Thời gian</h4>
                                    <p>
                                        Tiết kiệm tới 90% thời gian gọi điện, email, gặp gỡ, sắp xếp lịch, cập nhật
                                        kết quả, bảng xếp hạng... theo cách làm truyền thống.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="Thông tin luôn sẵn sàng để truy cập mọi lúc, mọi nơi qua máy tính, điện thoại thông minh, máy tính bảng. Báo cáo, thống kê hoàn toàn tự động." src="homepage/asset/home-page/images/index/home-4-icon2.svg" />
                                    <h4>Sự tiện lợi</h4>
                                    <p>
                                        Thông tin luôn sẵn sàng để truy cập mọi lúc, mọi nơi qua máy tính, điện
                                        thoại thông minh, máy tính bảng. Báo cáo, thống kê hoàn toàn tự động.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-left" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="Mọi thông tin của giải đấu sẽ được lưu lại làm kỷ niệm, phục vụ tra cứu, hoặc tái sử dụng cho giải tiếp theo. Dễ dàng tương tác, bình luận, chia sẻ các dữ liệu giải đấu." src="homepage/asset/home-page/images/index/home-4-icon3.svg" />
                                    <h4>Khả năng lưu trữ</h4>
                                    <p>
                                        Mọi thông tin của giải đấu sẽ được lưu lại làm kỷ niệm, phục vụ tra cứu,
                                        hoặc tái sử dụng cho giải tiếp theo. Dễ dàng tương tác, bình luận, chia sẻ
                                        các dữ liệu giải đấu.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-left" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="Tổ chức giải đấu hoàn toàn không in ấn, không lãng phí tài nguyên giấy, chung tay bảo vệ môi trường." src="homepage/asset/home-page/images/index/home-4-icon4.svg" />
                                    <h4>Tài nguyên giấy</h4>
                                    <p>
                                        Tổ chức giải đấu hoàn toàn không in ấn, không lãng phí tài nguyên giấy,
                                        chung tay bảo vệ môi trường.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-banner right">
                    <img alt="Nền tảng quản lý giải đấu, đội thi đấu" src="homepage/asset/home-page/images/index/home4-img-right.png" />
                </div>
            </div>

        </div>
    </div>
    <script>
        $(function() {
            AOS.init();
            countUp();


            if ($(window).width() < 1200) {
                $('#home--5 .client-column').each(function(k, v) {
                    $(this).removeAttr('data-aos');
                });
            }

            $(".wrap-back-top a").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 500);
            });

            $(window).scroll(function() {
                var top = $(this).scrollTop();
                var rightAdv = $('#adsHomePage .advertising:not(.bottomAdv)');
                var keyAdv = 'hideDiv' + rightAdv.attr('data-key');

                if (top > 300) {
                    $('.wrap-back-top').fadeIn();
                } else {
                    $('.wrap-back-top').fadeOut();
                }

                if (top > 600) {
                    if (localStorage.getItem(keyAdv)) {
                        rightAdv.attr('style', 'display: none !important');
                    } else {
                        rightAdv.fadeIn();
                    }
                } else {
                    rightAdv.fadeOut();
                }
            });
        });

        /**
         *
         * @returns  {undefined}
         */
        function countUp() {
            var options = {
                useEasing: true,
                useGrouping: true,
                separator: '.',
                decimal: ','
            };

            var demo1 = new CountUp('total_league', 0, 43768, 0, 3, options);
            var demo2 = new CountUp('total_team', 0, 198349, 0, 3, options);
            var demo3 = new CountUp('total_player', 0, 851573, 0, 3, options);
            var demo4 = new CountUp('total_view', 0, 16713252, 0, 3, options);
            !demo1.error ? demo1.start() : console.error(demo1.error);
            !demo2.error ? demo2.start() : console.error(demo2.error);
            !demo3.error ? demo3.start() : console.error(demo3.error);
            !demo4.error ? demo4.start() : console.error(demo4.error);
        }

        $('#home--3 .post-column').hover(function() {
            var _this = $(this);
            var cover = _this.find('.ps-post__content img');
            var filename = cover.data('file');
            cover.attr('src', "homepage/content/images/" + filename + "_hover.svg");
            _this.find('p').show();
        }, function() {
            var _this = $(this);
            var cover = _this.find('.ps-post__content img');
            var filename = cover.data('file');
            cover.attr('src', "homepage/content/images/" + filename + ".svg?id=123");
            _this.find('p').hide();
        });

        $('#home--3 .post-column p').hover(function() {
            $(this).next().addClass('show-bg');
        }, function() {
            $(this).next().removeClass('show-bg');
        })
    </script>
</div>
@endsection
