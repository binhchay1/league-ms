@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @if (Route::current()->getName() == 'leagueResult.bracket')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}" />
    @endif
@endsection

<style>
    select {
        font-weight: 500;
    }

    select option {
        font-weight: 500;
    }
</style>
@section('content')
    <?php
    $currentDate = strtotime(date('Y-m-d'));
    $startDate = strtotime(date($leagueInfor->start_date));
    $end_date_register = strtotime($leagueInfor->end_date_register);
    $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
    $format_register_date = $leagueInfor->end_date_register;
    ?>
    <div id="page" class="hfeed site" style="margin-top: -20px">
        <div class=" results">
            <div class="wrapper-results">
                <div class="" style="background: #707787;padding: 10px;  color: white">
                    <div class="container box-results-tournament">
                        <div class="d-flex">
                            <div class="logo-left">
                                <img src="{{ asset($leagueInfor->images ?? '/images/logo-no-background.png') }}"
                                    class="show-image-league" alt="logo">
                            </div>
                            <div class="" id="info-league " style="color: white; margin-left: 10px">
                                <h2 class="p-0">{{ $leagueInfor->name }}</h2>
                                <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . ' VND'; ?> || {{ $leagueInfor->type_of_league }} ||
                                    {{ $leagueInfor->location }}</p>
                                <p class="display">
                                    <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }}
                                        {{ $leagueInfor->location }}</em>
                                </p>
                                <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                ?>
                                <p class="display">
                                    <i class="bi bi-calendar"></i> <em>{{ 'From: ' }} {{ $start_date }} ~
                                        {{ 'To: ' }}{{ $end_date }}</em>
                                </p>
                                <p class="display">
                                    <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }}
                                        {{ $leagueInfor->number_of_athletes }}</em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="d-flex gap-2 mt-4">
                            @if (now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                                <a href="{{ route('showGeneralNews.info', $leagueInfor['slug']) }}"
                                    class="btn-custom {{ request()->routeIs('showGeneralNews.info') ? 'active' : '' }}">
                                    {{ __('News') }}
                                </a>
                                <a href="{{ route('leagueResult.info', $leagueInfor['slug']) }}"
                                    class="btn-custom {{ request()->routeIs('leagueResult.info') ? 'active' : '' }}">
                                    {{ __('Result') }}
                                </a>
                            @endif
                            @if ($currentDate < $startDate)
                                <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                                    class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                                    {{ __('Register League') }}
                                </a>

                                <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                                    class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                                    {{ __('List Register') }}
                                </a>
                            @endif
                            @if ($leagueInfor->format_of_league == 'knockout')
                                <a href="{{ route('leagueResult.bracket', $leagueInfor['slug']) }}"
                                    class="btn-custom {{ request()->routeIs('leagueResult.bracket') ? 'active' : '' }}">
                                    {{ __('Bracket') }}
                                </a>
                            @endif

                            <a href="{{ route('leagueSchedule.info', $leagueInfor['slug']) }}"
                                class="btn-custom {{ request()->routeIs('leagueSchedule.info') ? 'active' : '' }}">
                                {{ __('Schedule') }}
                            </a>

                            <a href="{{ route('leaguePlayer.info', $leagueInfor['slug']) }}"
                                class="btn-custom {{ request()->routeIs('leaguePlayer.info') ? 'active' : '' }}">
                                {{ __('Player') }}
                            </a>

                            @if (Auth::check() && Auth::user()->id == $leagueInfor->owner_id)
                                <div class="dropdown">
                                    <a class="btn-custom dropdown-toggle {{ request()->routeIs('my.infoMyLeague') ? 'active' : '' }}"
                                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                        {{ __('Setting') }} <i class="bi bi-gear"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('my.infoMyLeague', $leagueInfor['slug']) }}">League
                                                Information</a></li>
                                        <li><a class="dropdown-item" href="#">Delete League</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--                --><?php //
                //                $current_date = strtotime(date("Y-m-d"));
                //                $start_date = strtotime($leagueInfor->start_date);
                //                $end_date_register = strtotime($leagueInfor->end_date_register);
                //                $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
                //                $format_register_date = $leagueInfor->end_date_register;
                //
                ?>

                <div class="container wrapper-content-results"
                    style="padding: 10px; margin-top: 18px;   background: #eeeeee;">
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('Register League') }}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="leagueInfo">
                                        <div class="tab-content" id="tab-content">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img class="image-modal-data lazy truncated initial loaded white center"
                                                        src="{{ $leagueInfor->images }}">
                                                </div>
                                                <div class="col-lg-8 league-data">
                                                    <h4 class="">{{ $leagueInfor->name }}</h4>
                                                    {{ $leagueInfor->type_of_league }}
                                                    <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                    $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                    ?>
                                                    <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                                    <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                                    <p class="">
                                                        {{ __('PRIZE MONEY USD ') }}${{ $leagueInfor->money }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="infor" style="display: none">
                                        <h1 align="center">{{ __('Confirm Information') }}</h1>
                                        <form id="formAccountSettings" method="POST"
                                            action="{{ route('registerLeague') }}" enctype="multipart/form-data">
                                            @csrf()
                                            <div class="tab-content rankings-content_tabpanel">
                                                <div class="item-active">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                                        class="rankings-table">
                                                        <thead align="center">
                                                            <tr>
                                                                <th style="text-align: center" class="col-rank"
                                                                    align="center">{{ __('Name') }}</th>
                                                                <th style="text-align: center" class="col-country"
                                                                    align="center">{{ __('Image') }}</th>
                                                                <th style="text-align: center" class="col-player">
                                                                    {{ __('Age') }}</th>
                                                                <th style="text-align: center" class="col-points"
                                                                    align="center">{{ __('Address') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="row-top-eight">
                                                            <input type="hidden" name="league_id" id=""
                                                                value="{{ $leagueInfor->id }}">
                                                            <input type="hidden" name="end_date_register" id=""
                                                                value="{{ $leagueInfor->end_date_register }}">
                                                            <input type="hidden" name="start_date" id=""
                                                                value="{{ $leagueInfor->start_date }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id }}">
                                                            <input type="hidden" name="status" value="0">
                                                            <td align="center">
                                                                {{ Auth::user()->name }}
                                                            </td>
                                                            <td align="center">
                                                                <div class="country">
                                                                    <img width="48"
                                                                        src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png') }}"
                                                                        title="Japan" class="flag image-user">
                                                                </div>
                                                            </td>

                                                            <td align="center" class="data-player">
                                                                <div class="player">
                                                                    {{ Auth::user()->age }}
                                                                </div>
                                                            </td>
                                                            <td class="data-points" align="center">
                                                                {{ Auth::user()->address }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button type="submit"
                                                    class="btn btn-success me-2">{{ __('Send Information') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="form-register">
                        <div class="infor">
                            <h3 align="center">{{ __('Confirm Information') }}</h3>
                            <form id="formAccountSettings" method="POST" action="{{ route('registerLeague') }}"
                                enctype="multipart/form-data">
                                @csrf()
                                <div class="tab-content rankings-content_tabpanel">
                                    <div class="item">
                                        <table width="100%"
                                            class="min-w-full border border-gray-300 border-collapse text-sm">
                                            <thead align="center">
                                                <tr class="tr-title" style="background: #596377">
                                                    <th style="text-align: center" class="col-rank" align="center">
                                                        {{ __('Name') }}</th>
                                                    <th style="text-align: center" class="col-country" align="center">
                                                        {{ __('Image') }}</th>
                                                    <th style="text-align: center" class="col-player">{{ __('Email') }}
                                                    </th>
                                                    <th style="text-align: center" class="col-points" align="center">
                                                        {{ __('Address') }}</th>
                                                </tr>
                                            </thead>
                                            <tr class="row-top-eight">
                                                <input type="hidden" name="league_id" id=""
                                                    value="{{ $leagueInfor->id }}">
                                                <input type="hidden" name="end_date_register" id=""
                                                    value="{{ $leagueInfor->end_date_register }}">
                                                <input type="hidden" name="start_date" id=""
                                                    value="{{ $leagueInfor->start_date }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="status" value="0">
                                                <td align="center">
                                                    {{ Auth::user()->name }}
                                                </td>
                                                <td align="center">
                                                    <div class="country">
                                                        <img width="50" height="50"
                                                            src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png') }}"
                                                            title="Japan" class="flag p-1 ">
                                                    </div>
                                                </td>

                                                <td align="center" class="data-player">
                                                    <div class="player">
                                                        {{ Auth::user()->email }}
                                                    </div>
                                                </td>
                                                <td class="data-points" align="center">
                                                    {{ Auth::user()->address }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @if ($leagueInfor->type_of_league == 'doubles')
                                    <div id="formPartner">
                                        <div class="row mb-6" style="margin-left: 2px; width: 100%;">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                {{ 'You are in doubles mode, please choose or create a new partner.' }}
                                            </label>

                                            <select id="playerSelect" name="partner_id"
                                                class=" block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                                <option value="">-- {{ 'choose' }} --</option>
                                                @isset($partners)
                                                    @foreach ($partners as $partner)
                                                        @if (is_object($partner))
                                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                                <option value="new">{{ 'Create new partner' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <!-- Button bị disable ban đầu -->
                                <div class="mt-4 text-center" id="submit-reg">
                                    <button type="submit"
                                        class="btn btn-success me-2">{{ __('Send Information') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Form Tạo Người Chơi Mới -->
                    <div id="newPlayerForm" class="hidden space-y-4  mt-4 bg-gray-50">
                        <div id="" class="  container mt-4 league-tour">
                            <h4 class="text-left">{{ 'Create Partner' }}</h4>
                            <hr>
                            <form id="formAccountSettings" method="POST" action="{{ route('user.create.partner') }}"
                                enctype="multipart/form-data">
                                @csrf()
                                <div class="row mb-3 form-league">
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('Avatar') }}</label>
                                        <input value="" type="file" class="border-0 bg-light pl-0"
                                            name="avatar" id="image" hidden>
                                        <div class=" choose-avatar">
                                            <div id="btnimage">
                                                <img id="showImage" class="show-avatar"
                                                    src="{{ asset('/images/logo-no-background.png') }}" alt="avatar"
                                                    style="width: 200px;">
                                            </div>

                                            <div id="button">
                                                <i id="btn_chooseImg" class="fas fa-camera">
                                                    {{ __('Choose Avatar') }}</i>
                                            </div>

                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="lastName" class="form-label">{{ __('Name') }}</label>
                                                <input class="form-control" value="{{ old('name') }}" type="text"
                                                    name="name" id="name"
                                                    placeholder="{{ __('Enter name') }}" />
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label for="lastName" class="form-label">{{ __('Email') }}</label>
                                                <input class="form-control" value="{{ old('email') }}" type="text"
                                                    name="email" id="location"
                                                    placeholder="{{ __('Enter email') }}" />
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label for="lastName" class="form-label">{{ __('Phone') }}</label>
                                                <input class="form-control" value="{{ old('phone') }}" type="text"
                                                    name="phone" id="location"
                                                    placeholder="{{ __('Enter phone') }}" />
                                                @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-12">
                                    <button
                                        class="create-partner-btn btn btn-success w-10 mt-4 mb-12">{{ 'Create' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--                    @endif --}}

                <div class="content-results">
                    <div class="item-results">
                        @if (Route::current()->getName() == 'leaguePlayer.info')
                            <div>
                                @include('page.league.detail.player')
                            </div>
                        @elseif(Route::current()->getName() == 'showListRegister.info')
                            <div>
                                @include('page.league.detail.player-register')
                            </div>
                        @elseif(Route::current()->getName() == 'showGeneralNews.info')
                            <div>
                                @include('page.league.detail.news')
                            </div>
                        @elseif(Route::current()->getName() == 'leagueResult.info')
                            <div>
                                @include('page.league.detail.result')
                            </div>
                        @elseif(Route::current()->getName() == 'leagueSchedule.info')
                            <div>
                                @include('page.league.detail.schedule')
                            </div>
                        @elseif(Route::current()->getName() == 'leagueResult.bracket')
                            @include('page.league.detail.bracket')
                        @else
                            <div class="item draws" style="display:block;">
                                @if (now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                                    @include('page.league.detail.news')
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/league.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $("[name='recordLeague']").on("change", function() {
            let edit_id = $(this).val();
            window.location.href = window.location.origin + '/league/' + edit_id;
        });
    </script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr.success("{{ Session::get('message') }}", 'Success!', {
                timeout: 12000
            });
        </script>
    @endif

    <script>
        const select = document.getElementById('playerSelect');
        const newPlayerForm = document.getElementById('newPlayerForm');
        const btnSub = document.getElementById('submit-reg');

        select.addEventListener('change', function() {
            if (this.value === 'new') {
                btnSub.classList.add('hidden');
                newPlayerForm.classList.remove('hidden');
            } else {
                newPlayerForm.classList.add('hidden');
            }
        });
    </script>
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
