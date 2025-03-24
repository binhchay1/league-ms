@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('League') }}
@endsection

@section('css')
<link rel="stylesheet" id="bwf-style-css" href="{{ asset('css/page/match.css') }}" type="text/css" media="all" />
@endsection

<style>
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 1px 4px 10px rgba(0, 0, 0, 0.2) !important;
    }
    .transition-btn:hover {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .bg-row {
        background: #eeeeee;
        padding: 10px;
    }

</style>
@section('content')
    <div class="container mt-4">
        <h2 style="font-weight: 400">{{__('CURRENT LIVE')}}</h2>

        <div class="container mt-4">
            <div class="row">
                @foreach($listMatches as $league)
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
                                    <div class="league-logo">
                                        <img src="{{ asset($league->images ?? '/images/logo-no-background.png') }}"
                                             alt="League Logo">
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <!-- Tên giải đấu -->
                                    <a href="{{route('league.live', $league['slug'])}}">
                                        <h5 class="league-name">{{ $league->name }}</h5>
                                    </a>
                                    <!-- Mô tả ngắn -->
                                    <p class="league-info p-0">
                                         {{ $start_date }} || {{ $end_date }}

                                    </p>
                                    <div class="mt-3">
                                        <div class="current-tmt-link-wrap text-center mt-2" >
                                            <div><a href="{{route('league.live', $league['slug'])}}" class=" btn btn-danger open-new-tab "rel="noopener noreferrer"> {{__('Live Score')}} </a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @if($listMatches->total() > $listMatches->perPage())
            <div class="navigator short mt-4">
                <div class="head d-flex justify-content-center">
                    <ul class="pagination">
                        <li>
                            <a href="{{ $listMatches->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                                <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{ __('PREVIOUS') }}</span>
                            </a>
                        </li>
                        &emsp;
                        <li>
                            <a href="{{ $listMatches->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                                <span aria-hidden="true">{{ __('NEXT') }} <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
</div>
    <script>
        document.querySelectorAll('.open-new-tab').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                window.open(this.href, '_blank');
            });
        });
    </script>
@endsection
