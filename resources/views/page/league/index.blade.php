@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/content/league.css') }}" type="text/css" media="all"/>

@endsection

@section('content')
    <style>
        #signup:before {
            width: 0;
        }

        .league-card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .league-banner {
            height: 150px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .league-logo {
            position: absolute;
            top: 85%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .league-logo img {
            width: 60px;
            height: 60px;
        }

        .league-name {
            font-weight: bold;
            color: green;
        }

        .league-info {
            font-size: 14px;
            color: #666;
        }

        .league-stats {
            font-size: 14px;
            color: #444;
            font-weight: 700;
        }

        .league-stats i {
            margin-right: 5px;
        }

        .league-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }

        .league-card:hover .league-logo {
            transform: translate(-50%, -50%) scale(1.1);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }

        .lb-register {
            color: #000;
            font-size: 12px;
            font-weight: 700;
            padding-bottom: 6px;
            position: relative;
        }

        .label-success {
            border-radius: 5px;
            color: #fff;
            padding: 3px 8px;
            background: mediumpurple;
        }

    </style>

    <div class="container">
        <div class="row align-items-center mt-4">
            <!-- Tiêu đề và Menu -->
            <h2 style="color: black">{{ __('LEAGUE CALENDAR') }}</h2>

            <div class="col-md-4 d-flex flex-column">
                <div id="select-list-state card">
                    <ul class="select-list" id="select-state">
                        <li data-id="all"><a data-state="remaining" href="#" class="active-menu "
                                             data-toggle="tab">{{__('All')}}</a></li>
                        <li data-id="completed"><a data-state="completed" href="#"
                                                   data-toggle="tab">{{__('COMPLETED')}}</a></li>
                        <li data-id="next"><a data-state="next" href="#" data-toggle="tab">{{__('NEXT')}}</a></li>
                    </ul>
                </div>
            </div>

            <!-- Form Tìm Kiếm -->
            <div class="col-md-8">
                <form class="d-flex gap-2 justify-content-end" action="{{route('searchLeague')}}" method="GET">

                    <select class="form-select" name="sort">
                        <option selected>{{'Sort by'}}</option>
                        <option value="newest">{{'Latest'}}</option>
                        <option value="oldest">{{'Oldest'}}</option>
                    </select>

                    <div class="input-group">
                        <input type="text" class="form-control" name="query"
                               placeholder="Tên giải đấu, tên người quản lý">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                @foreach($listLeagues as $league)
                    <?php $current_date = strtotime(date("Y-m-d"));
                    $start_date = strtotime($league->start_date);
                    $end_date_register = strtotime($league->end_date_register);
                    $get_date_register = date('d/m/Y', strtotime($league->end_date_register));
                    $format_register_date = $league->end_date_register;
                    ?>

                    @if($league->status == 1)
                        <?php   $start_date = date('d/m/Y', strtotime($league->start_date));
                        $end_date = date('d/m/Y', strtotime($league->end_date));
                        ?>
                        <div class="col-md-4 mt-4">
                            <div class="card league-card">
                                <!-- Ảnh nền -->
                                <div class="card-header league-banner"
                                     style="background-image: url('{{ asset('/images/bg-league.png') }}');">
                                    <!-- Logo giải đấu -->
                                    @if($current_date < $start_date && $current_date < $end_date_register)
                                    <div class="label lb-register">
                                        <span class="extend_lb label-success">{{'Registering'}}</span>
                                    </div>
                                    @endif
                                    <div class="league-logo">
                                        <img src="{{ asset($league->images ?? '/images/logo-no-background.png') }}"
                                             alt="League Logo">
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <!-- Tên giải đấu -->
                                    <a href="{{route('league.info', $league['slug'])}}">
                                        <h5 class="league-name">{{ $league->name }}</h5>
                                    </a>

                                    <!-- Mô tả ngắn -->
                                    <p class="league-info p-0">
                                        {{ $league->type_of_league }} || {{ $start_date }} || {{ $end_date }}
                                        || {{ $league->location }}
                                    </p>
                                    <div class="league-stats">
                                        {{ __('PRIZE MONEY:  ') }} <?php echo number_format($league->money ?? 0) . " VND"?>
                                    </div>
                                    <!-- Thống kê -->
                                    <div class="league-stats">
                                        <span><i class="fas fa-users"></i> {{ count($league->userLeagues) }}</span>
                                    </div>

                                    <!-- Thanh progress -->

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{--    <div class="item-results" style="margin-bottom: 50px">--}}
        {{--        @forelse($listLeagues as $listLeague)--}}
        {{--        @if($listLeague->status == 1)--}}
        {{--        <div class="tblResultLanding" style="margin-top:10px;background:#353535" onmouseover="this.style.background='gray';" onmouseout="this.style.background='#353535';">--}}
        {{--            <a href="{{route('league.info', $listLeague['slug'])}}">--}}
        {{--                <div class="tr-tournament-detail" id="4734">--}}
        {{--                    <div class="tournament-detail ">--}}
        {{--                        <div class="inner-tournament-detail">--}}
        {{--                            <div class="description">--}}
        {{--                                <div class="logo-wrap">--}}
        {{--                                    <div class="image">--}}
        {{--                                        <img src="{{asset($listLeague->images ?? '/images/logo-no-background.png')}}" class="show-image-league">--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}

        {{--                                <div class="info" style="color:white;">--}}
        {{--                                    <h3>{{ $listLeague->name }}</h3>--}}
        {{--                                    <?php $start_date = date('d/m/Y', strtotime($listLeague->start_date));--}}
        {{--                                    $end_date = date('d/m/Y', strtotime($listLeague->end_date));--}}
        {{--                                    ?>--}}
        {{--                                    <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>--}}
        {{--                                    <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>--}}
        {{--                                    <div class="prize">--}}
        {{--                                        {{ __('PRIZE MONEY:  ') }} <?php echo number_format($listLeague->money ?? 0). " VND"?>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <div class="country-detail">--}}
        {{--                                <div class="venue-country" style="color:black;">--}}
        {{--                                    <div>--}}
        {{--                                        <div style="margin-bottom: 40px; margin-right: 100px;">--}}
        {{--                                            <img src="{{ asset('/images/logo-no-background.png') }}" class=" b-error b-error" width="100" height="100">--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        {{--            @endif--}}
        {{--        @empty--}}
        {{--            <h3 style="height: 220px" class="text-center">{{__('Data has not been updated!')}}</h3>--}}
        {{--        @endforelse--}}
        {{--    </div>--}}
        @if($listLeagues->total() > $listLeagues->perPage())
            <div class="navigator short  mt-4">
                <div class="head d-flex justify-content-center ">
                    <ul class="pagination">
                        <li>
                            <a href="{{ $listLeagues->previousPageUrl() }}" aria-label="Previous" style="color: red"
                               class="prevPlayersList">
                                <span aria-hidden="true"><span
                                        class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}</span>
                            </a>
                        </li>
                        &emsp;
                        <li>
                            <a href="{{ $listLeagues->nextPageUrl() }}" aria-label="Next" style="color: red"
                               class="nextPlayersList">
                                <span aria-hidden="true">{{ __('NEXT') }} <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
<script src="{{ asset('js/league.js') }}"></script>
<script>
    $(document).ready(function () {
        $('ul li a').click(function () {
            $('li a').removeClass("active-menu");
            $(this).addClass("active-menu");
        });
    });

    $(document).ready(function () {
        $('#select-state li').click(function () {
            let url = '/tournament-leagues?state='
                + $(this).data('id');
            window.location.href = url;
        });
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

</script>


