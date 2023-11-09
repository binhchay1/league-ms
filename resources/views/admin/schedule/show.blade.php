@extends('layout.admin_layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>Chi Tiết set Đấu</h5>
    <div class="card container">
        <div class="row justify-content-start m-1 mb-2 mt-2">
            <button type="submit" class="btn btn-success">Vòng: {{$dataSchedule->match}}</button>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group text-center">
                    <div class="" style="display: inline-grid;">
                        <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                        <div class=" choose-avatar">
                            <div id="btnimage">
                                <img class="show-avatar" style="width:150px; height: 150px; border-radius: 50%" src="{{$dataSchedule->team1->image}}" alt="avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <strong>{{$dataSchedule->team1->players[0]->name}}</strong>
                </div>
            </div>
            <div class="col-lg-2 text-center" style="vertical-align: middle;line-height: 120px;">
                <?php $date = date("m-d-Y", strtotime($dataSchedule->date)) ?>
                <strong>{{$dataSchedule->time}} &nbsp {{$date}} </strong>
            </div>
            <div class="col-md-5">
                <div class="form-group text-center">
                    <div class="" style="display: inline-grid;">
                        <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                        <div class=" choose-avatar">
                            <div id="btnimage">
                                <img class="show-avatar" style="width: 150px; height: 150px; border-radius: 50% " src="{{$dataSchedule->team2->image}}" alt="avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <strong>{{$dataSchedule->team2->players[0]->name}}</strong>
                </div>
            </div>
        </div>
        <div class="form-group text-right m-0 p-0 pt-5 pb-5">
            <button data-toggle="modal" data-target="#ModalCreate" class="btn btn-primary">Tạo kết quả</button>
        </div>
        <form action="{{route('schedule.update', $dataSchedule['id'])}}" method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tạo kết quả</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{$dataSchedule->tournament_id}}" name="tournament_id" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{$dataSchedule->match}}" name="match" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{$dataSchedule->time}}" name="time" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{$dataSchedule->date}}" name="date" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{$dataSchedule->stadium}}" name="stadium" id="name" hidden />
                        </div>
                        <div class="row container">
                            <div class="col-md-6">
                                <div class="text-center" style="font-size: 30px">
                                    <p>{{$dataSchedule->team1->players[0]->name}}</p>
                                </div>
                                <div class="container">
                                    <div class="form-group">
                                        <input class="form-control" value="{{$dataSchedule->team_id_1}}" type="text" name="team_id_1" id="name" hidden />
                                    </div>

                                    <div class="form-group mt-4">
                                        <strong>Tỉ số chung cuộc</strong>
                                        <input class="form-control" type="number" name="result_team_1" id="result_team_1" min="1" />
                                        @if ($errors->has('result_team_1'))
                                        <span class="text-danger">{{ $errors->first('result_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 1 1</strong>
                                        <input class="form-control" type="text" name="set_1_team_1" id="name" />
                                        @if ($errors->has('set_1_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_1_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 2</strong>
                                        <input class="form-control" type="text" name="set_2_team_1" id="name" />
                                        @if ($errors->has('set_2_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_2_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 3</strong>
                                        <input class="form-control" type="text" name="set_3_team_1" id="name" />
                                        @if ($errors->has('set_3_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_3_team_1') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center" style="font-size: 30px">
                                    <p>{{$dataSchedule->team2->players[0]->name}}</p>
                                </div>
                                <div class="container">
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="{{$dataSchedule->team_id_2}}" name="team_id_2" id="name" hidden />
                                    </div>
                                    <div class="form-group mt-4">
                                        <strong>Tỉ số chung cuộc</strong>
                                        <input class="form-control" type="number" name="result_team_2" id="result_team_2" />
                                        @if ($errors->has('result_team_2'))
                                        <span class="text-danger">{{ $errors->first('result_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 1</strong>
                                        <input class="form-control" type="text" name="set_1_team_2" id="name" />
                                        @if ($errors->has('set_1_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_1_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 2</strong>
                                        <input class="form-control" type="text" name="set_2_team_2" id="name" />
                                        @if ($errors->has('set_2_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_2_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>Tỉ số trận 3</strong>
                                        <input class="form-control" type="text" name="set_3_team_2" id="name" />
                                        @if ($errors->has('set_3_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_3_team_2') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center" style="margin: 10px;">
                                <button type="submit" class="btn btn-primary">Lưu kết quả</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
