@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Homepage') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/homepage.css') }}" type="text/css" media="all"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection

@section('content')
    <div class="wrapper">

        <section>
            <div>
                <img class=" b-error b-error" width="100%" style="margin-top: -25%"
                     src="{{ asset('images/hunghafc.jpg') }}">
            </div>
        </section>
        <div class="c-intro-home">
            <div class="container">
                <div class="d-home-box">
                    <div class="c-intro-home__box clearfix">
                        <div class="is-left">
                            <div class="is-title"><h4>Giới thiệu</h4><a href="/gioi-thieu"><i
                                        class="bi bi-chevron-double-right"></i></a></div>
                            <div class="b-maincontent"><p>Dưới sự tài trợ của Tập đoàn T&amp;T, câu lạc bộ Hà Nội – T&amp;T
                                    thành lập vào ngày 18 tháng 6 năm 2006. 03 mùa giải đầu tiên, từ một đội bóng gồm đa
                                    số
                                    các cầu thủ trẻ do huấn luyện viên Triệu Quang Hà (cựu cầu thủ đội tuyển bóng đá
                                    Việt
                                    Nam và câu lạc bộ Thể Công) dẫn dắt đã liên tiếp thăng ba hạng, từ hạng Ba lên hạng
                                    chuyên nghiệp, giành quyền thi đấu ở đấu trường danh giá nhất Việt Nam V-League
                                    2009.</p></div>
                        </div>
                        <div class="is-right"><img src="{{ asset('/images/hunghafc.jpg') }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <section id="next-tournament" class="next-tournament-section bg-black">
            <div class="next-tournament-wrap">
                <div class="results">
                    <div class="wrapper-results">
                        <div class="box-results-tournament">
                            <div class="box-results-tournament-left">
                                <div class="logo-left">
                                    <div class="c-name"><img><span class="c-text">2024</span></div>
                                    <div class="c-name"><span>19/11/2024 19:15</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span>Sân bóng Đại Nam</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="box-results-tournament-right">
                                    <div class="c-left-team d-flex">
                                        <div class="c-name">Quảng Nam</div>
                                        <div class="c-img">
                                            <img src="https://cms.hanoifc.net/images/8db34e40-8070-4b04-87b2-fa42037c9676.png" width="200px">
                                        </div>
                                    </div>
                                    <div class="c-name" style="padding: 20px; font-size: 30px"><span>- -</span></div>
                                    <div class="c-left-team d-flex">
                                        <div class="c-img"><img
                                                src="https://cms.hanoifc.net/images/cde56006-947f-4393-8403-a0c9a0fcb2d8.png" width="200px"></div>
                                        <div class="c-name">Hà Nội</div>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="c-team-info-home">
            <div class="container">
                <div class="d-home-box">
                    <div class="is-title"><h4>Đội hình</h4>
                        <a href="/doi-hinh">
                            <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </div>
                </div>
                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('images/hunghafc.jpg') }}" alt="First Slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/hunghafc.jpg') }}" alt="Second Slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/hunghafc.jpg') }}" alt="Third Slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="partners-section-wrap">
            <div class="partners-section">
                <div class="partners-left" style="margin-bottom: 100px">

                </div>
            </div>
        </div>

    </div>
@endsection
