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
                        <a href="/" title="{{ __('Hệ thống quản lý giải đấu') }}">
                            <img alt="{{ __('Hệ thống quản lý giải đấu') }}" width="220" src="{{ asset('homepage/content/images/white_logo.jpg') }}" />
                        </a>
                    </div>
                    <div class="ps-middle">
                        <div class="heading-title mb30">
                            <h2>
                                {{ __('Tổ chức giải đấu dễ dàng') }}<br>{{ __('Quản lý đội thể thao đơn giản!') }}
                            </h2>
                        </div>
                        <div class="ps-buttons mb50">
                            <a href="{{ route('tournament.create') }}" class="btn">
                                {{ __('Tạo giải đấu') }}
                            </a>
                            <a href="{{ route('list.tour') }}" class="btn btn__2">
                                {{ __('Tìm giải đấu') }}
                            </a>
                        </div>
                        <div class="ps-buttons mb-20 lineup">
                            <a href="{{ route('team.create') }}" class="btn btn-warning">
                                {{ __('Tạo đội thi đấu') }}
                            </a>
                        </div>
                        <ul class="ps-counts">
                            <li data-aos="zoom-out-right">
                                <span>{{ __('Giải đấu') }}</span>
                                <b id="total_league">{{ $totalTour }}</b>
                            </li>
                            <li data-aos="zoom-out-right">
                                <span>{{ __('Đội thi đấu') }}</span>
                                <b id="total_team">{{ $totalTeam }}</b>
                            </li>
                            <li data-aos="zoom-out-left">
                                <span>{{ __('Vận động viên') }}</span>
                                <b id="total_player">{{ $totalUser }}</b>
                            </li>
                            <li data-aos="zoom-out-left">
                                <span>{{ __('Lượt xem') }}</span>
                                <b id="total_view">{{ $totalView }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="section" id="home--2">
                <div class="wrapper">
                    <div class="heading-title text-center">
                        <h2>{{ __('Điều hành giải') }}</h2>
                        <p>{{ __('Có 3 giai đoạn để điều hành một giải đấu') }}</p>
                    </div>
                    <div class="st-image">
                        <img alt="{{ __('Tạo giải và điều hành giải đấu') }}" src="{{ asset('homepage/asset/home-page/images/index/home-2-image.png') }}" />
                    </div>
                    <div class="st-steps">
                        <div class="col-xs-12 col-lg-4 post-column" data-aos="zoom-out-right" data-aos-delay="80">
                            <div class="ps-post">
                                <div class="ps-post__content">
                                    <div class="ps-step">
                                        <div class="step-header">
                                            <span class="ps-step__index">1</span>
                                            <h3>{{ __('Tạo Giải') }}</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>{{ __('Loại trực tiếp') }}</span><br>
                                                <span>{{ __('Đấu vòng tròn') }}</span><br>
                                                <span>{{ __('Chia bảng đấu') }}</span><br>
                                                <span>{{ __('Vòng tròn - loại trực tiếp') }}</span><br>
                                                <span>{{ __('Nhánh thắng - nhánh thua') }}</span><br>
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
                                            <h3>{{ __('Tùy chỉnh giải đấu') }}</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>{{ __('Nhập điều lệ, hình và địa điểm') }}</span><br>
                                                <span>{{ __('Nhập thông tin của đội / vận động viên') }}</span><br>
                                                <span>{{ __('Mời người tham gia') }}</span><br>
                                                <span>{{ __('Lập lịch đấu') }}</span><br>
                                                <span>{{ __('Tùy chỉnh giai đoạn') }}</span><br>
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
                                            <h3>{{ __('Điều hành giải') }}</h3>
                                        </div>
                                        <div class="ps-step__content">
                                            <p>
                                                <span>{{ __('Kích hoạt') }}</span><br>
                                                <span>{{ __('Nhập tỷ số') }}</span><br>
                                                <span>{{ __('Xem thống kê') }}</span><br>
                                                <span>{{ __('Chia sẻ với bạn bè') }}</span><br>
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
                    <h2>{{ __('Hỗ trợ nhiều thể thức thi đấu') }}</h2>
                    <p>{{ env('APP_NAME', 'ProLeague') }} {{ __('giúp người dùng tạo ra các giải đấu có thể thức giống như') }}<br> {{ __('với các giải đấu nổi tiếng thế giới như Champions League, World Cup, NBA, Laliga, ATP Cup ...') }}</p>
                </div>
                <div class="ps-posts">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 post-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <p>{{ __('Loại trực tiếp hoặc knockout') }} <br>{{ __('là loại giải đấu có đội thua') }}<br> {{ __('ở mỗi trận đấu') }}
                                    <br>{{ __('sẽ bị loại ngay khỏi giải đấu.') }}
                                </p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="{{ __('Loại trực tiếp') }}" src="{{ asset('homepage/asset/home-page/images/index/home-3-image1.png') }}" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img width="100" alt="{{ __('Loại trực tiếp') }}" src="{{ asset('homepage/content/images/icon_elimination.svg') }}" data-file="icon_elimination" />
                                        <h3>{{ __('Loại trực tiếp') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="fade-up" data-aos-delay="80">
                                <p>{{ __('Mỗi đội sẽ thi đấu') }}<br>{{ __('với tất cả các đội còn lại.') }}<br>{{ __('Cho phép tuỳ chỉnh') }} <br>{{ __('điều lệ xếp hạng dễ dàng.') }}</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="{{ __('Đấu vòng tròn') }}" src="{{ asset('homepage/asset/home-page/images/index/home-3-image2.png') }}" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img style="padding:10px" alt="{{ __('Đấu vòng tròn') }}" src="{{ asset('https://myleague.vn/content/images/icon_round_robin.svg') }}" width="100" data-file="icon_round_robin"><br>
                                        <h3>{{ __('Đấu vòng tròn') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="zoom-out-left" data-aos-delay="80" style="float:right">
                                <p>{{ __('Có hai giai đoạn đó là') }} <br>{{ __('giai đoạn một') }} <br>{{ __('chia thành nhiều bảng đấu') }} <br>{{ __('và giai đoạn hai là loại trực tiếp hoặc nhánh thắng - nhánh thua.') }}</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="{{ __('Chia bảng đấu') }}" src="{{ __('homepage/asset/home-page/images/index/home3-image5.png') }}" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="{{ __('Chia bảng đấu') }}" src="{{ __('homepage/content/images/icon_two_stages.svg') }}" width="100" data-file="icon_two_stages"><br>
                                        <h3>{{ __('Chia bảng đấu') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column" data-aos="fade-up" data-aos-delay="80">
                                <p>{{ __('Là biến thể khác của thể thức đấu loại trực tiếp. Với thể thức này thì các đội bị thua sẽ tiếp tục được đấu với nhau ở một nhánh đấu được gọi là Nhánh Thua') }}</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="{{ __('Nhánh thắng - nhánh thua') }}" src="{{ __('homepage/asset/home-page/images/index/home-3-image3.png') }}" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="{{ __('Nhánh thắng - nhánh thua') }}" style="padding:10px" src="{{ asset('homepage/content/images/icon_two_elimination.svg') }}" width="100" data-file="icon_two_elimination"><br>
                                        <h3>{{ __('Nhánh thắng') }} -<br />{{ __('Nhánh thua') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 post-column hidden-md hidden-sm" data-aos="fade-up" data-aos-delay="1040">
                                <p>{{ __('Kết hợp hai giai đoạn') }} <br>{{ __('vào một giải đấu, bao gồm') }} <br>giai đoạn một đấu vòng
                                    tròn <br>{{ __('và giai đoạn hai loại trực tiếp hoặc nhánh thắng - nhánh thua.') }}</p>
                                <div class="ps-post">
                                    <div class="ps-post__thumb">
                                        <img alt="{{ __('Vòng tròn - loại trực tiếp') }}" src="{{ asset('homepage/asset/home-page/images/index/home-3-image4.png') }}" />
                                    </div>
                                    <div class="ps-post__content">
                                        <img alt="{{ __('Vòng tròn - loại trực tiếp') }}" style="padding:10px" src="{{ asset('homepage/content/images/icon_league_knockout.svg') }}" width="100" data-file="icon_league_knockout"><br>
                                        <h3>{{ __('Vòng tròn') }} -<br />{{ __('Loại trực tiếp') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="home--4">
                <div class="ps-banner left">
                    <img alt="{{ __('Phần mềm tạo giải đấu') }}" src="{{ asset('homepage/asset/home-page/images/index/home4-img-left.svg') }}" />
                </div>
                <div class="container">
                    <div class="ps-content">
                        <div class="heading-title text-center">
                            <h2>{{ __('Lợi ích') }} {{ env('APP_NAME', 'pro-league.vn') }} {{ __('mang lại') }}</h2>
                            <p>{{ __('Số hóa thể thao là xu hướng phát triển tất yếu!') }}</p>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="{{ __('Tiết kiệm tới 90% thời gian gọi điện, email, gặp gỡ, sắp xếp lịch, cập nhật kết quả, bảng xếp hạng... theo cách làm truyền thống.') }}" src="homepage/asset/home-page/images/index/home-4-icon1.svg" />
                                    <h4>Thời gian</h4>
                                    <p>
                                        {{ __('Tiết kiệm tới 90% thời gian gọi điện, email, gặp gỡ, sắp xếp lịch, cập nhật kết quả, bảng xếp hạng... theo cách làm truyền thống.')}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-right" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="{{ __('Thông tin luôn sẵn sàng để truy cập mọi lúc, mọi nơi qua máy tính, điện thoại thông minh, máy tính bảng. Báo cáo, thống kê hoàn toàn tự động.') }}" src="homepage/asset/home-page/images/index/home-4-icon2.svg" />
                                    <h4>Sự tiện lợi</h4>
                                    <p>
                                        {{ __('Thông tin luôn sẵn sàng để truy cập mọi lúc, mọi nơi qua máy tính, điện thoại thông minh, máy tính bảng. Báo cáo, thống kê hoàn toàn tự động.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-left" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="{{ __('Mọi thông tin của giải đấu sẽ được lưu lại làm kỷ niệm, phục vụ tra cứu, hoặc tái sử dụng cho giải tiếp theo. Dễ dàng tương tác, bình luận, chia sẻ các dữ liệu giải đấu.') }}" src="homepage/asset/home-page/images/index/home-4-icon3.svg" />
                                    <h4>{{ __('Khả năng lưu trữ') }}</h4>
                                    <p>
                                        {{ __('Mọi thông tin của giải đấu sẽ được lưu lại làm kỷ niệm, phục vụ tra cứu,hoặc tái sử dụng cho giải tiếp theo. Dễ dàng tương tác, bình luận, chia sẻ các dữ liệu giải đấu.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 static-column" data-aos="zoom-out-left" data-aos-delay="80">
                                <div class="static-item">
                                    <img alt="{{ __('Tổ chức giải đấu hoàn toàn không in ấn, không lãng phí tài nguyên giấy, chung tay bảo vệ môi trường.') }}" src="homepage/asset/home-page/images/index/home-4-icon4.svg" />
                                    <h4>{{ __('Tài nguyên giấy') }}</h4>
                                    <p>
                                        {{ __('Tổ chức giải đấu hoàn toàn không in ấn, không lãng phí tài nguyên giấy, chung tay bảo vệ môi trường.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-banner right">
                    <img alt="{{ __('Nền tảng quản lý giải đấu, đội thi đấu') }}" src="{{ __('homepage/asset/home-page/images/index/home4-img-right.png') }}" />
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

        function countUp() {
            var options = {
                useEasing: true,
                useGrouping: true,
                separator: '.',
                decimal: ','
            };

            let total_player = '<?php echo $totalUser ?>';
            let total_league = '<?php echo $totalTour ?>';
            let total_team = '<?php echo $totalTeam ?>';
            let total_view = '<?php echo $totalView ?>';

            var demo1 = new CountUp('total_league', 0, total_league, 0, 3, options);
            var demo2 = new CountUp('total_team', 0, total_team, 0, 3, options);
            var demo3 = new CountUp('total_player', 0, total_player, 0, 3, options);
            var demo4 = new CountUp('total_view', 0, total_view, 0, 3, options);
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
            cover.attr('src', "homepage/content/images/" + filename + ".svg");
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
