@extends('layout.admin_layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5>Tạo Lịch Thi Đấu</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{route('schedule.store')}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="container">
                        <div>
                            <div>
                                <label for="lastName" class="form-label">Vòng đấu</label>
                                <input class="form-control" value="" type="number" name="match" id="match" min="1"/>
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">Giải đấu</label>
                                <select id="tournament_id" name="tournament_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTournament as $tournament)
                                        <option value="{{ $tournament->id }}" >
                                            {{$tournament->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">Đội 1</label>
                                <select id="team_id_1" name="team_id_1" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTeam1 as $team1)
                                        <option value="{{ $team1->id }}" >
                                            {{$team1->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="" style="margin-top: 10px">
                                <label class="form-label" for="country">Đội 2</label>
                                <select id="team_id_2" name="team_id_2" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTeam2 as $team2)
                                        <option value="{{ $team2->id }}" >
                                            {{$team2->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Thời gian</label>
                                    <input type="text" value="" class="form-control" id="time" name="time"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Ngày thi đấu</label>
                                    <input type="date" value="" class="form-control" id="date" name="date"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
    <script src="{{ asset('js/tournament.js') }}"></script>
@endsection


