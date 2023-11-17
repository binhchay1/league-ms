@extends('layout.admin_layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">{{__('Tạo Đội')}}</h2>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('team.store')}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-4">
                            <label for="lastName" class="form-label">{{__('Logo đội')}}</label>
                            <div class="form-group" >
                                <div class="" style="display: inline-grid;">
                                    <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                    <div class=" choose-avatar" >
                                        <div id="btnimage">
                                            <img id="showImage" class="show-avatar" style="width: 135px; margin-left: 40px" src="/images/default_team_logo.png" alt="avatar">
                                        </div>
                                        <div id="button" >
                                            <i id="btn_chooseImg" class="fas fa-camera" >  {{__('Chọn ảnh')}}</i>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="lastName" class="form-label">{{__('Tên đội')}}</label>
                                <input class="form-control" type="text" name="name" id="name"/>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <label for="address" class="form-label">{{__('Huấn luyện viên')}}</label>
                                <input type="text" class="form-control" id="coach" name="coach"/>
                                @if ($errors->has('coach'))
                                    <span class="text-danger">{{ $errors->first('coach') }}</span>
                                @endif
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

