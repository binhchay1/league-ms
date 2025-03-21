@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color: red; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .label-success {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: green;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .label-danger {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: red;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .card-title {
        color: black !important;
    }

    .rounded-circle {
        margin-right: 10px;
    }

    .card-body p{
        font-size: 15px !important;
    }


</style>
@section('content')
    <section >
        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
        ?>
        <div class=" text-black p-3 align-items-center">
            <div class="container d-flex  img-fluid">
                <img src="{{asset($leagueInfor->images ?? asset('/images/no-image.png'))}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                <div class="col-md-10">
                    <div class="card-body">
                        <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                            <h2 class="card-title color-red p-0">{{$leagueInfor->name}}</h2>
                        </a>
                        <p class="card-text"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                        <p class="">
                            <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                        </p>
                        <p class="">
                            <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                        </p>
                        <p class="">
                            <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="container mt-4 form-active">
            <form id="formAccountSettings" method="POST" action="{{route('league.updatePlayer',$leagueInfor['id'])}}" enctype="multipart/form-data">
                @csrf()
                <div class="col-lg-12 " style="text-align: right; margin-left: -5px">
                    <div >
                        <button type="submit" class="btn btn-success float-right" style="margin: 10px;">{{__('Active player')}}</button>
                    </div>
                    <label>
                        <input type="radio" name="status" value="1" checked>
                        Active
                    </label>
                    <label>
                        <input type="radio" name="status" value="0">
                        Inactive
                    </label>
                </div>
            <!-- Bảng Ban huấn luyện -->
                <div class="col-lg-6">
                    <h3 class="card-header">{{ __('Information Player') }}</h3>
                </div>
                <p style="font-size: 20; font-weight: 600">{{count($leagueInfor->userLeagues) }} / {{$leagueInfor->number_of_athletes}} {{'Players'}}</p>
            <div class="card mb-">
                <div class="card-header bg-primary text-white">{{'Players'}}</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{"Check"}}</th>
                            <th>{{"Information"}}</th>
                            <th>{{"Address"}}</th>
                            <th>{{"Status"}}</th>
                            <th>{{"Action"}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leagueInfor->userLeagues as $player)
                            <tr>
                                <td><input type="checkbox"  name="user_ids[]" value="{{ $player->id }}" class="checkbox" ></td>
                                <td><img src="{{asset($player->user->profile_photo_path ?? '/images/default-avatar.png')}}"  width="50" height="50" class="rounded-circle ">{{ $player->user->name ?? "" }}</td>
                                <td>{{ $player->user->address ?? "" }}</td>
                                <td>
                                    <div  class="btn btn-{{$player->status == 1 ? 'info' : 'secondary' }}">
                                        {{$player->status ? "Active " : "Inactive "}}
                                    </div>
                                </td>
                                <td class="text_flow text-center">
                                    <a href="{{ route('league.destroyPlayer', $player['id']) }}">
                                        <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bảng Vận động viên -->
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function detailGroup(id) {
            let name = id.substring(6);
            let url = '/detail-group?g_i=' + name;

            window.location.href = url;
        }
    </script>
    <script>
        $(document).ready(function(){
            $(".list-group-item-action").click(function(){
                $(".list-group-item-action").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection
