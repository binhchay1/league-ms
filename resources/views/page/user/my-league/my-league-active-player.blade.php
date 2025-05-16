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

    .status-player {
        border-radius: 5px;
        color: white;
        font-weight: 600;
    }

</style>
@section('content')
    <section >
        <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
        $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
        ?>
        <div class=" text-black p-3 align-items-center " style="background: #707787;padding: 10px; margin-top: -20px; color: white">
            <div class="container d-flex  img-fluid">
                <img src="{{asset($leagueInfor->images ?? asset('/images/no-image.png'))}}" alt="User" width="200" height="200" class=" me-3 " >
                <div class="col-md-10">
                    <div class="card-body" style="color: white">
                        <a href="{{route('my.leagueDetail',$leagueInfor->slug)}}">
                            <h2 class="text-white color-red p-0">{{$leagueInfor->name}}</h2>
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
            @once
            @php
                $type = $leagueInfor->type_of_league ?? 'singles';

                function getFullNameWithPartner($player, $type = 'singles') {
                    $name1 = $player->user->name ?? '---';
                    $name2 = $player->partner->name ?? '';
                    return $type === 'doubles' && $name2 ? $name1 . ' + ' . $name2 : $name1;
                }

                function getUserAvatar($registration) {
                    return asset($registration->user->profile_photo_path ?? '/images/default-avatar.png');
                }
            @endphp
            @endonce

            @if($leagueInfor->userLeagues->isNotEmpty())
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
                        <div class="d-flex flex-wrap gap-2 mb-3" >
                             <span class="status-player bg-primary px-3 py-2">
                                {{'Total player'}}: {{count($leagueInfor->userLeagues) }} / {{$leagueInfor->number_of_athletes}} {{'players'}}
                            </span>
                            <span class="status-player bg-primary px-3 py-2" >
                                {{'Inactive'}}: {{ $pendingCount }}
                            </span>
                            <span class="status-player bg-success px-3 py-2">
                                {{'Active'}}: {{ $acceptedCount }}
                            </span>
                        </div>

                        <table class="table table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th>{{"Check"}}</th>
                                    <th>{{"Player"}}</th>
                                    <th>{{"Address"}}</th>
                                    <th>{{"Status"}}</th>
                                    <th>{{"Action"}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leagueInfor->userLeagues as $player)
                                    <tr>
                                        <td><input type="checkbox"  name="user_ids[]" value="{{ $player->id }}" class="checkbox" ></td>
                                        <td class="d-flex align-items-center gap-2">
                                            <img src="{{ getUserAvatar($player) }}"
                                                 alt="avatar" class="rounded-circle" width="40">
                                            <div>
                                                <span class="fw-bold text-success">{{ getFullNameWithPartner($player, $type) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-success fst-italic">{{ $player->address ?? 'updating' }}
                                            </span>
                                        </td>
                                        <td>
                                             <span class="status-player bg-{{ $player->status == 0 ? 'primary' : 'success' }}" style="padding: 5px">
                                                {{ $player->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text_flow text-center">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $player['id'] }}">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDeleteModal{{ $player['id'] }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $player['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="confirmDeleteLabel{{ $player['id'] }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete player <strong>{{ $player->user?->name ?? '---' }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                                    <a href="{{ route('league.destroyPlayer', $player['id']) }}">
                                                        <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            @else
                <div class="container alert alert-primary mt-4">{{"Tournament is updating data."}}</div>
            @endif
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $(".list-group-item-action").click(function(){
                $(".list-group-item-action").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection
