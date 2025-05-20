@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('css')
    <link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/content/league.css') }}" type="text/css" media="all"/>

@endsection

@section('content')
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
                    <select class="form-select" name="format">
                        <option value="" {{ request('format') == '' ? 'selected' : '' }}>{{ 'Format' }}</option>
                        <option value="round-robin" {{ request('format') == 'round-robin' ? 'selected' : '' }}>{{ 'Round Robin' }}</option>
                        <option value="knockout" {{ request('format') == 'knockout' ? 'selected' : '' }}>{{ 'Knockout' }}</option>
                    </select>
                    <select class="form-select" name="sort">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>{{ 'Sort by' }}</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ 'Latest' }}</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ 'Oldest' }}</option>
                    </select>

                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="{{ 'Name league...' }}"
                               value="{{ request('query') }}">
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
                                    @if(now() < date('Y-m-d', strtotime($league->end_date_register)))
                                        <div class="label lb-register">
                                            <span class="extend_lb label-success">{{'Registering'}}</span>
                                        </div>
                                    @elseif(now() > date('Y-m-d', strtotime($league->end_date_register)) && now() < date('Y-m-d', strtotime($league->start_date)) )
                                        <div class="label lb-register">
                                            <span class="extend_lb label-end">{{'End Register'}}</span>
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
                                        {{$league->format_of_league }} || {{ $league->type_of_league }} || {{ $start_date }} || {{ $end_date }}
                                        || {{ $league->location }}
                                    </p>
                                    <div class="league-stats">
                                        {{ __('PRIZE MONEY:  ') }} <?php echo number_format($league->money ?? 0) . " VND"?>
                                    </div>
                                    <!-- Thống kê -->
                                    <div class="league-stats">
                                        <span><i class="fas fa-users"></i> {{ count($league->userLeagues) }} / {{$league->number_of_athletes}} </span>
                                    </div>

                                    <!-- Thanh progress -->

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

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


