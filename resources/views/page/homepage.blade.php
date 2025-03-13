@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Homepage') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/homepage.css') }}" type="text/css" media="all" />
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="wrapper">

    <section style="background-color: #DA0011; margin-top: -25px">
        <div>
            <img class=" b-error b-error" width="100%" style="margin-top: -11%"  src="{{ asset('images/banner.jpg') }}">
        </div>
    </section>

    <section class="features-section">
        <div class="container my-5">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5>{{'Community'}}</h5>
                        <p>{{'Connect and follow active players in the community or anywhere in the world.'}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h5>{{'Tournaments'}}</h5>
                        <p>{{'Manage participants, create schedules, and score matches while tracking scores and stats.'}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h5>{{'Team Management'}}</h5>
                        <p>{{'Manage every aspect of your team, sports organization, association and federation.'}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <h5>{{'Live Streaming'}}</h5>
                        <p>{{'Turn your local community sporting event into a Super Bowl with Live Stream and commentary.'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container hero-section">
            <div class="col-md-6">
                <img src="{{asset('/images/homepageimg1.png')}}" class="img-fluid floating" alt="Illustration">
            </div>
            <div class="col-md-6 text-content">
                <p class="about-us"><span class="text-danger">{{'ABOUT US'}}</span></p>
                <h1 class="p-0">{{'Simple league management to complex club management?'}}</h1>
                <p class="p-0 text-gray">{{'Join our sports ecosystem!'}}</p>
                <div>
                    <p class="p-0"><strong>■ {{'Tournament and group management software'}}</strong></p>
                    <p class="p-0">{{'A game changing way to organise tournaments. Built to suit small clubs to large leagues.'}}</p>
                </div>
                <div>
                    <p class="p-0"><strong>■ {{'Group management system'}}</strong></p>
                    <p class="p-0">{{'People can join groups to participate in activities, announcements, and conversations.'}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="outstanding-features">
        <div class="container py-5">
            <h2 class="text-center mb-4">{{'Outstanding features'}}</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-user-edit icon text-primary"></i>
                        <h4>{{'Register League'}}</h4>
                        <p>{{'Build a consistent registration process and create easy-to-use forms.'}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-calendar-alt icon text-danger"></i>
                        <h4>{{'Competition Schedule'}}</h4>
                        <p>{{'Easily schedule hundreds of matches with just a few clicks.'}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-bullhorn icon text-info"></i>
                        <h4>{{'Communications'}}</h4>
                        <p>{{'Manage media to bring the tournament to more people.'}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-chart-bar icon text-warning"></i>
                        <h4>{{'Statistical'}}</h4>
                        <p>{{'Build reports and instantly access tournament insights.'}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-users icon text-success"></i>
                        <h4>{{'Groups'}}</h4>
                        <p>{{'Manage members when participating in group activities'}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-photo-video icon text-secondary"></i>
                        <h4>{{'Media'}}</h4>
                        <p>{{'Manage tournament images, videos and sync data easily.'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5 text-center">
            <h2 class="mb-4">{{'Benefits of Badmiton.io'}}</h2>
            <p class="text-muted">{{'Digitalization of sports is an inevitable development trend!'}}</p>
            <div class="row mt-4">
                <div class="col-md-3 icon-box">
                    <i class="fas fa-calendar-alt"></i>
                    <h5 class="mt-3">{{'Time'}}</h5>
                    <p>{{'Save 90% of time on calls, emails, scheduling...'}}</p>
                </div>
                <div class="col-md-3 icon-box">
                    <i class="fas fa-exchange-alt active"></i>
                    <h5 class="mt-3">{{'Convenience'}}</h5>
                    <p>{{'Information is always available, accessible anytime, anywhere...'}}</p>
                </div>
                <div class="col-md-3 icon-box">
                    <i class="fas fa-camera"></i>
                    <h5 class="mt-3">{{'Storage capacity'}}</h5>
                    <p>{{'Save tournament data, easily interact, comment...'}}</p>
                </div>
                <div class="col-md-3 icon-box">
                    <i class="fas fa-file-alt active"></i>
                    <h5 class="mt-3">{{'Paper resources'}}</h5>
                    <p>{{'Organize tournaments without printing, protect the environment...'}}</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container my-5">
            <h2 class="text-center fw-bold">{{"Some satisfied customer reviews about our products"}}</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="testimonial-card p-3">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Hoàng Minh</h5>
                                <small class="text-muted">Trọng tài</small>
                            </div>
                        </div>
                        <p class="mt-3">"Nền tảng quản lý giải đấu rất thuận tiện. Tôi không cần phải mang theo quá nhiều tài liệu, chỉ cần một chiếc điện thoại là có thể giải quyết mọi thứ."</p>
                        <span class="rating">★★★★★</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card p-3">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Lê Phương</h5>
                                <small class="text-muted">Vận động viên</small>
                            </div>
                        </div>
                        <p class="mt-3">"Ứng dụng này giúp tôi dễ dàng kiểm tra lịch thi đấu và kết quả một cách nhanh chóng. Rất tiện lợi cho tất cả các vận động viên!"</p>
                        <span class="rating">★★★★★</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card p-3">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Toàn Nguyễn</h5>
                                <small class="text-muted">Huấn luyện viên</small>
                            </div>
                        </div>
                        <p class="mt-3">"Giao diện rất thân thiện và dễ sử dụng. Trước đây việc quản lý giải đấu rất phức tạp, nhưng giờ mọi thứ đã được tự động hóa!"</p>
                        <span class="rating">★★★★★</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section id="news" class="container-1280 news-section bg-white">--}}
{{--        <div class="std-title " >--}}
{{--            <h2 class="left">{{ __('Latest News') }}</h2>--}}
{{--            <a href="{{route('news')}}">--}}
{{--                <h2 class="right league-all-data">{{ __('All News') }}</h2>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="news-overview-wrap">--}}
{{--            @foreach($listPosts as $post)--}}
{{--                <div class="news-overview-item">--}}
{{--                    <div class="news-overview-image">--}}
{{--                        <a href="">--}}
{{--                            <img src="{{asset($post->thumbnail ?? '/images/logo-no-background.png' )}}" alt="" class="img-responsive-hover b-error">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="news-overview-text">--}}
{{--                        <h4 class="media-heading fw-400 fs-16px">--}}
{{--                            <a href="{{route('news-show', $post['slug'])}}" title="{{$post->title}}">--}}
{{--                                {{$post->title}} </a>--}}
{{--                        </h4>--}}
{{--                        <span class="fw-300 fs-12px text-gray">--}}
{{--                        <?php echo date_format($post->created_at, 'd-F-Y')  ?><br>--}}
{{--                    </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="" style="margin-top: -9px;">--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div class="std-title container-1280 " >--}}
{{--        <h2 class="left">{{ __('Next League') }}</h2>--}}
{{--        <a href="{{ route('list.league') }}">--}}
{{--            <h2 class="right league-all-data">{{ __('All Leagues') }}</h2>--}}
{{--        </a>--}}
{{--    </div>--}}

{{--    <section id="next-tournament" class="next-tournament-section bg-black">--}}
{{--        <div class="next-tournament-wrap">--}}
{{--            <div class="results">--}}
{{--                @if(count($listLeague) >0 )--}}
{{--                @foreach($listLeague as $league)--}}
{{--                <div class="wrapper-results">--}}
{{--                    <div class="box-results-tournament">--}}
{{--                        <div class="box-results-tournament-left">--}}
{{--                            <div class="logo-left">--}}
{{--                                <a href="{{ route('league.info', $league['slug']) }}">--}}
{{--                                    <img width="200" src="{{ asset($league->images ?? '/images/logo-no-background.png') }}" alt="logo" class=" b-error">--}}
{{--                                </a>--}}
{{--                            </div>--}}

{{--                            <div class="info">--}}
{{--                                <a href="{{ route('league.info', $league['slug']) }}">--}}
{{--                                    <h2 class="leage-name">{{ $league->name }}</h2>--}}
{{--                                    <?php $start_date = date('d/m/Y', strtotime($league->start_date));--}}
{{--                                    $end_date = date('d/m/Y', strtotime($league->end_date));--}}
{{--                                    ?>--}}
{{--                                    <h6 class="">{{ __('Start Date')}}: {{ $start_date }}</h6>--}}
{{--                                    <h6 class="">{{ __('End Date')}}: {{ $end_date }}</h6>--}}
{{--                                </a>--}}
{{--                                {{ __('PRIZE MONEY: ') }} <?php echo number_format($league->money ?? 0) . " VND"?>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="box-results-tournament-right">--}}
{{--                            <div class="logo-right">--}}
{{--                                <img alt="" src="{{ asset('/images/logo-no-background.png') }}" width="150" height="150">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endforeach--}}
{{--                @else--}}
{{--                    <h2 style="color:white; text-align: center">{{__('League has not been updated!')}}</h2>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


{{--    <section id="news" class="container-1280 news-section bg-white">--}}
{{--        <div class="std-title " style="margin-top: 10px" >--}}
{{--            <h2 class="left">{{ __('Leaders Ranking') }}</h2>--}}
{{--            <a href="{{route('ranking')}}" >--}}
{{--                <h2 class="right league-all-data">{{ __('Full Rankings') }}</h2>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="top-player">--}}
{{--            <div class="owl-carousel-rank owl-theme owl-carousel owl-loaded">--}}
{{--                <div class="owl-stage-outer" style="padding-left: 0px; padding-right: 0px;">--}}
{{--                    <div class="owl-stage">--}}
{{--                        <div class="owl-item active" style="width: 1220px; margin-right: 0px;">--}}
{{--                            <div class="rankings-content_tabpanel item">--}}
{{--                                <div class="top-ranked-wrap">--}}
{{--                                    @foreach($listRank as $index => $rank)--}}
{{--                                    @if($rank->users != null)--}}
{{--                                    <div class="top-ranked-left-single">--}}
{{--                                        <div class="top-ranked-avatar">--}}
{{--                                            <a title="" href="">--}}
{{--                                                <img style="width: 300px; height: 300px" src="{{ $rank->users->profile_photo_path ?? asset('/images/no-image.png') }}" class=" b-error">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="top-ranked-right-single">--}}
{{--                                        <div class="top-ranked-country-wrap">--}}
{{--                                            <div class="top-ranked-country">--}}
{{--                                                <a title="" href="">--}}
{{--                                                    {{ $rank->users->name }}--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="top-ranked-info-wrap">--}}

{{--                                            <div class="top-ranked-ranking">--}}
{{--                                                <span>{{ __('Ranking') }}</span>--}}
{{--                                                <span>{{ $index+1 }}</span>--}}
{{--                                            </div>--}}

{{--                                            <div class="top-ranked-extra-wrap">--}}
{{--                                                <div class="top-ranked-points">--}}
{{--                                                    <span>{{ __('Points') }}</span>--}}
{{--                                                    <span>{{ $rank->points }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                                <div class="top-ranked-nav-wrap">--}}
{{--                                    <div class="top-ranked-nav-center text-right">--}}
{{--                                        {{ __('Rankings') }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="" style="margin-top: -9px;">--}}
{{--        </div>--}}
{{--    </section>--}}

    <div class="partners-section-wrap">
        <div class="partners-section">
            <div class="partners-left" style="margin-bottom: 100px">

            </div>
        </div>
    </div>

</div>
@endsection
