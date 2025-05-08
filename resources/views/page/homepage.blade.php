@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Homepage') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/page/homepage.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

@endsection

@section('content')
<div class="wrapper ">

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

    <section class="container">
        <div class=" row hero-section">
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
                            <img src="{{asset('images/upload/league/tien.jpg')}}" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Minh Tiến</h5>
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
                            <img src="{{asset('images/upload/league/vy.jpg')}}" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Thảo Vy</h5>
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
                            <img src="{{asset('images/upload/league/tung.jpg')}}" alt="Avatar">
                            <div class="ms-3">
                                <h5 class="mb-0">Tùng Nguyễn</h5>
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

    <div class="partners-section-wrap">
        <div class="partners-section">
            <div class="partners-left" style="margin-bottom: 100px">

            </div>
        </div>
    </div>

</div>
@endsection
