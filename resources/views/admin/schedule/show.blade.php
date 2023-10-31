@extends('layout.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>Chi Tiết Trận Đấu</h5>
        <div class="card container">
            <div class="row justify-content-start m-1 mb-2 mt-2">
               <h2>{{$dataSchedule->match}}</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-center" >
                        <div class="" style="display: inline-grid;">
                            <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                            <div class=" choose-avatar" >
                                <div id="btnimage">
                                    <img  class="show-avatar" style="width: 200px; " src="{{$dataSchedule->team1->image}}" alt="avatar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        {{$dataSchedule->team1->name}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group text-center" >
                        <div class="" style="display: inline-grid;">
                            <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                            <div class=" choose-avatar" >
                                <div id="btnimage">
                                    <img  class="show-avatar" style="width: 200px; " src="{{$dataSchedule->team1->image}}" alt="avatar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        {{$dataSchedule->team2->name}}
                    </div>
                </div>
            </div>
            <div class="form-group text-right m-0 p-0 pt-5 pb-5">
                <button data-toggle="modal" data-target="#ModalCreate" class="btn btn-success">Kết quả</button>
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
                            <div class="row container">
                                <div class="col-md-6">
                                    <div class="text-center">
                                        {{$dataSchedule->team1->name}}
                                    </div>
                                    <div class="container">
                                        <div class="form-group">
                                            <strong>Tỉ số chung cuộc</strong>
                                            <input class="form-control" type="text" name="result_team_1" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 1</strong>
                                            <input class="form-control" type="text" name="set_1_team_1" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 2</strong>
                                            <input class="form-control" type="text" name="set_2_team_1" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 3</strong>
                                            <input class="form-control" type="text" name="set_3_team_1" id="name"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        {{$dataSchedule->team2->name}}
                                    </div>
                                    <div class="container">
                                        <div class="form-group">
                                            <strong>Tỉ số chung cuộc</strong>
                                            <input class="form-control" type="text" name="result_team_2" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 1</strong>
                                            <input class="form-control" type="text" name="set_1_team_2" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 2</strong>
                                            <input class="form-control" type="text" name="set_2_team_2" id="name"/>
                                        </div>
                                        <div class="form-group">
                                            <strong>Tỉ số set 3</strong>
                                            <input class="form-control" type="text" name="set_2_team_2" id="name"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success">Lưu kết quả</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
