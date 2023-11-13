@extends('layout.admin_layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5>{{__('Tạo Lịch Thi Đấu')}}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{route('schedule.store')}}" enctype="multipart/form-data">
                    @csrf()
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="container">
                        <div>
                            <div>
                                <label for="lastName" class="form-label">{{__('Vòng đấu')}}</label>
                                <input class="form-control" value="" type="number" name="match" id="match" min="1"/>
                                @if ($errors->has('match'))
                                    <span class="text-danger">{{ $errors->first('match') }}</span>
                                @endif
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">{{__('Giải đấu')}}</label>
                                <select id="tournament_id" name="tournament_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTournament as $tournament)
                                        <option value="{{ $tournament->id }}" >
                                            {{$tournament->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tournament_id'))
                                    <span class="text-danger">{{ $errors->first('tournament_id') }}</span>
                                @endif
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">{{__('Đội 1')}}</label>
                                <select id="team_id_1" name="team_id_1" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTeam1 as $team1)
                                        <option value="{{ $team1->id }}" >
                                            {{$team1->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('team_id_1'))
                                    <span class="text-danger">{{ $errors->first('team_id_1') }}</span>
                                @endif
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">{{__('Đội 2')}}</label>
                                <select id="team_id_2" name="team_id_2" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTeam2 as $team2)
                                        <option value="{{ $team2->id }}" >
                                            {{$team2->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('team_id_2'))
                                    <span class="text-danger">{{ $errors->first('team_id_2') }}</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <label for="lastName" class="form-label">{{__('Sân thi đấu')}}</label>
                                <input class="form-control" value="" type="text" name="stadium" id="stadium" />
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="address" class="form-label">{{__('Thời gian')}}</label>
                                    <input type="text" value="" class="form-control" id="time" name="time"/>
                                    @if ($errors->has('time'))
                                        <span class="text-danger">{{ $errors->first('time') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">{{__('Ngày thi đấu')}}</label>
                                    <input type="date" value="" class="form-control" id="date" name="date"/>
                                    @if ($errors->has('date'))
                                        <span class="text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">{{__('Lưu')}}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{__('Hủy')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection


