@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    @if(Route::current()->getName() == 'my.leagueBracket.info')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}"/>
    @endif
@endsection


<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color:#dc3545 !important; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .card-title {
        color: black !important;
    }

    p.display {
        font-size: 15px !important;
    }

    .btn-custom {
        background-color: #dc3545 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px 15px!important;
        border: none;
    }

    .btn-custom:hover {
        background-color: #ff4b2b !important;
    }

    /* Tùy chỉnh dropdown */
    .btn-dropdown {
        background: white;
        border: 2px solid #ff4b2b !important;
        border-radius: 10px;
        color: #dc3545;
        padding: 10px 12px !important;
    }

    .btn-dropdown:hover {
        background: #f1f1f1 !important;
    }

    h5.modal-title {
        color: white !important;
    }
</style>
@section('content')
    <section >
        <div class="container-fluid">
            <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
            $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
            ?>
            <div class=" text-black p-3 ">
                <div class="container d-flex  img-fluid">
                    <img src="{{asset($leagueInfor->images ?? asset('/images/no-image.png'))}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                    <div class="col-md-10">
                        <div class="card-body">
                            <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                                <h2 class="card-title color-red mb-1 p-0">{{$leagueInfor->name}}</h2>
                            </a>
                            <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                            <p class="display">
                                <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                            </p>
                            <p class="display">
                                <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                            </p>
                            <p class="display">
                                <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="d-flex gap-2">
                        <a href="{{ route('my.leagueBracket.info',$leagueInfor['slug']) }}">
                            <button class="btn btn-custom">{{ __('Bracket') }} </button>
                        </a>
                        <a href="{{ route('my.leagueResult.info',$leagueInfor['slug']) }}">
                            <button class="btn btn-custom">{{ __('Result') }} </button>
                        </a>
                        <a href="{{ route('my.leagueSchedule.info',$leagueInfor['slug']) }}">
                            <button class="btn btn-custom">{{ __('Schedule') }} </button>
                        </a>
                        <a href="{{ route('my.leaguePlayer.info',$leagueInfor['slug']) }}">
                            <button class="btn btn-custom">{{ __('Player') }} </button>
                        </a>
                        <!-- Dropdown -->
                    @if(Auth::check() &&  Auth::user()->id == $leagueInfor->owner_id)
                        <!-- Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Setting') }} <i class="bi bi-gear"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('my.infoMyLeague',$leagueInfor['slug'])}}">{{'League Information'}}</a></li>
                                    <li>
                                        <a class="openDeleteModal dropdown-item" href="#" data-url="{{ route('delete.myLeague', $leagueInfor->id) }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                            {{ 'Delete League' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Bootstrap Modal -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <!-- Header -->
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title fw-bold" id="confirmDeleteModalLabel">
                                                <i class="bi bi-exclamation-triangle-fill "></i> {{ 'Delete League' }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body text-center">
                                            <p class="text-dark fw-medium fs-5">
                                                {{ 'Are you sure you want to delete this league?' }}
                                            </p>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i> {{ 'Cancel' }}
                                            </button>
                                            <form id="deleteForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4">
                                                    <i class="bi bi-trash"></i> {{ 'Delete' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        @endif
                    </div>
                </div>
            </div>
            <hr>

            <?php $current_date = strtotime(date("Y-m-d"));
            $start_date = strtotime($leagueInfor->start_date);
            $end_date_register = strtotime($leagueInfor->end_date_register);
            $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
            $format_register_date =$leagueInfor->end_date_register;
            ?>
            <!-- Main Content -->
                <div class="wrapper-content-results container">

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('Register League') }}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                @if(Auth::check())
                                    <div class="modal-body">
                                        <div class="leagueInfo">
                                            <div class="tab-content" id="tab-content">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <img
                                                            class="image-modal-data lazy truncated initial loaded white center"
                                                            src="{{$leagueInfor->images}}">
                                                    </div>
                                                    <div class="col-lg-8 league-data">
                                                        <h4 class="">{{$leagueInfor->name }}</h4>
                                                        {{$leagueInfor->type_of_league }}
                                                        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                                                        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                                                        ?>
                                                        <h6 class="">{{ __('Start Date') }}: {{ $start_date }}</h6>
                                                        <h6 class="">{{ __('End Date') }}: {{ $end_date }}</h6>
                                                        <p class="">{{ __('PRIZE MONEY USD ') }}${{$leagueInfor->money
                                                            }}</p>
                                                    </div>
                                                    <div class="checkbox" align="center">
                                                        <input id="check" name="checkbox" type="checkbox">
                                                        <label
                                                            for="checkbox">{{ __('I have read and agree to the tournament rules') }}</label>
                                                    </div>
                                                    <div align="center">
                                                        <button id="open-tab1" class="btn btn-success"
                                                                disabled>{{ __('Register ') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="infor" style="display: none">
                                            <h1 align="center">{{__('Confirm Information')}}</h1>
                                            <form id="formAccountSettings" method="POST"
                                                  action="{{route('registerLeague')}}" enctype="multipart/form-data">
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
                                                                <th style="text-align: center"
                                                                    class="col-player">{{ __('Age') }}</th>
                                                                <th style="text-align: center" class="col-points"
                                                                    align="center">{{ __('Address') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tr class="row-top-eight">
                                                                <input type="hidden" name="league_id" id=""
                                                                       value="{{$leagueInfor->id }}">
                                                                <input type="hidden" name="end_date_register" id=""
                                                                       value="{{$leagueInfor->end_date_register }}">
                                                                <input type="hidden" name="start_date" id=""
                                                                       value="{{$leagueInfor->start_date }}">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="status" value="0">
                                                                <td align="center">
                                                                    {{ Auth::user()->name }}
                                                                </td>
                                                                <td align="center">
                                                                    <div class="country">
                                                                        <img width="48"
                                                                             src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png')}}}}"
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
                                @else
                                    <div align="center">
                                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                        <h4 class="mt-4 login-redriect">{{ __('Please')}}
                                            <a
                                                href="{{ route('login') }}">{{__('login')}}</a>
                                            {{__('before registering for the tournament!') }}
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                        <div class="content-results">
                            <div class="item-results">
                                @if(Route::current()->getName() == 'my.leaguePlayer.info')
                                    <div>
                                        @include('page.user.my-league.detail.player')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueResult.info')
                                    <div>
                                        @include('page.user.my-league.detail.result')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.infoMyLeague')
                                    <div>
                                        @include('page.user.my-league.detail.edit')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueSchedule.info')
                                    <div>
                                        @include('page.user.my-league.detail.schedule')
                                    </div>
                                @elseif(Route::current()->getName() == 'my.leagueBracket.info')
                                    @include('page.user.my-league.detail.bracket')
                                @else
                                    <div class="item draws" style="display:block;">
                                        @include('page.user.my-league.detail.schedule')
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>

        </div>

    </section>
@endsection

@section('js')

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForm = document.getElementById("deleteForm");

        document.querySelectorAll(".openDeleteModal").forEach(button => {
            button.addEventListener("click", function () {
                const deleteUrl = this.getAttribute("data-url");
                deleteForm.setAttribute("action", deleteUrl);
            });
        });
    });
</script>
