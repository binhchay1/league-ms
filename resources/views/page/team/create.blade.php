@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="row" style="padding: 30px">
            <div class="col-md-10 col-md-offset-1 parent">
                <form id="formAccountSettings" method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="step1">
                        <div class="panel">
                            <div class="panel-heading row">
                                <div class="col-md-10 col-sm-8 col-xs-12">
                                    <h3 class="panel-title">Tạo Đội</h3>
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
                                                    <label for="name" class="control-label">Logo đội</label>
                                                    <div>
                                                        <div class="">
                                                            <div class="" style="display: inline-grid;">
                                                                <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden style="display:none">
                                                                <div class=" choose-avatar" >
                                                                    <div id="btnimage">
                                                                        <img id="showImage" class="show-avatar" src="/images/team.png" alt="avatar" style="width: 180px; ">
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
                                                <div class="form-group wrap-group" id="intro-name-league"> <label for="name" class="control-label required">Tên đội</label>
                                                    <div>
                                                        <input class="form-control required " id="name"  name="name" type="text" value="">
                                                        @if ($errors->has('name'))
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group wrap-group" id="intro-name-league"> <label for="name" class="control-label required">Huấn luyện viên</label>
                                                    <div>
                                                        <input class="form-control required " id="coach"  name="coach" type="text" value="">
                                                        @if ($errors->has('coach'))
                                                            <span class="text-danger">{{ $errors->first('coach') }}</span>
                                                        @endif
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
                                        <button type="submit" class="btn btn-primary">Tạo đội</button> </div>
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

