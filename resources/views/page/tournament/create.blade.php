@extends('layouts.page')
@section('content')

<div class="container">
    <div class="row" style="padding: 30px">
        <div class="col-md-10 col-md-offset-1 parent">
            <form id="formAccountSettings" method="POST" action="{{ route('tournament.store') }}" enctype="multipart/form-data">
                @csrf
                <div id="step1">
                    <div class="panel">
                        <div class="panel-heading row">
                            <div class="col-md-10 col-sm-8 col-xs-12">
                                <h3 class="panel-title">Tạo Giải</h3>
                                <span class="message required introduction-farm">Vui lòng nhập thông tin hợp lệ cho các trường được yêu cầu</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="flex-row" id="show-error-success"> </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Hình giải đấu</label>
                                                <div>
                                                    <div class="avatar border-radius clearfix">
                                                        <div class="" style="display: inline-grid;">
                                                            <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden style="display:none">
                                                            <div class=" choose-avatar" >
                                                                <div id="btnimage">
                                                                    <img id="showImage" class="show-avatar" src="/images/champion.png" alt="avatar" style="width: 180px; ">
                                                                </div>
                                                                <div id="button" >
                                                                    <i id="btn_chooseImg" class="fa fa-camera pull-center">  Chọn ảnh</i>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('image'))
                                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group wrap-group" id="intro-name-league"> <label for="name" class="control-label required">Tên giải đấu</label>
                                                <div>
                                                    <input class="form-control required " id="name"  name="name" type="text" value="">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group wrap-group" id="intro-phone-league">
                                                        <label for="phone" class="control-label required">Ngày bắt đầu</label>
                                                        <input class="form-control " id="start_date" name="start_date" type="date" value="">
                                                        @if ($errors->has('start_date'))
                                                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group wrap-group" id="intro-phone-league">
                                                        <label for="phone" class="control-label required">Ngày kết thúc</label>
                                                        <input class="form-control  " id="end_date" name="end_date" type="date" value="">
                                                        @if ($errors->has('end_date'))
                                                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pac-card wrap-group" id="intro-location-league">
                                                <label for="location" class="control-label required">Đội tham gia</label>
                                                <div>
                                                    <input class="form-control required pac-target-input" id="number_of_team-input" name="number_of_team" type="text" value="" placeholder="Nhập vị trí" autocomplete="off">
                                                    @if ($errors->has('number_of_team'))
                                                        <span class="text-danger">{{ $errors->first('number_of_team') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group pac-card wrap-group" id="intro-location-league">
                                                <label for="location" class="control-label required">Hình thức thi đấu</label>
                                                <div>
                                                    <select id="format" name="format" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        @foreach($formatTour as $formatTour => $value)
                                                            <option id="format" value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group pac-card wrap-group" id="intro-location-league">
                                                <label for="location" class="control-label required">Thể thức thi đấu</label>
                                                <div>
                                                    <select  id="type" name="type" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                        @foreach($type_tour as $type_tour => $value)
                                                            <option id="type" value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center">
                                    <button type="submit" class="btn btn-primary">Tạo giải</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('js/tournament.js') }}"></script>
@endsection