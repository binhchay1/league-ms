@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">{{__('Tạo Vận Động Viên')}}</h2>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('player.store') }}" enctype="multipart/form-data">
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @csrf()
                    <div class="row">
                        <div class="col-md-4">
                            <label for="lastName" class="form-label">{{__('Ảnh đại diện')}}</label>
                            <div class="form-group" >
                                <div class="" style="display: inline-grid;">
                                    <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                    <div class=" choose-avatar" >
                                        <div id="btnimage">
                                            <img id="showImage" class="show-avatar" src="images/default-avatar .png" alt="avatar" style="width: 135px; margin-left: 40px">
                                        </div>
                                        <div id="button" >
                                            <i id="btn_chooseImg" class="fas fa-camera">        {{__(' Chọn ảnh')}} </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label for="lastName" class="form-label">{{__('Tên vận động viên')}}</label>
                                <input class="form-control" type="text" name="name" id="name"  />
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <label for="address" class="form-label">{{__('Ngày sinh')}}</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" />
                                @if ($errors->has('birthday'))
                                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <label class="form-label" for="country">{{__('Giới tính')}}</label>
                                <select id="sex" name="sex" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach($gender as $sex => $value)
                                        <option id="sex" value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label class="form-label" for="country">{{__('Đội')}}</label>
                                <select id="team_id" name="team_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    @foreach ($listTeam as $team)
                                        <option id="team_id" value="{{ $team->id }}" >
                                            {{$team->name}}
                                        </option>
                                    @endforeach
                                </select>
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
