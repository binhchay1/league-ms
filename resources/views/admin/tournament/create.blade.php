@extends('layout.admin_layout')
@section('content')
        <div class="container-fluid mt-4">
            <div class="card card-default">
                <div class="card-header">
                    <h5>Tạo Giải Đấu</h5>
                </div>
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('tournament.store') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Logo giải đấu</label>
                                    <div class="">
                                        <div class="" style="display: inline-grid;">
                                            <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                            <div class=" choose-avatar" >
                                                <div id="btnimage">
                                                    <img id="showImage" class="show-avatar" src="/images/champion.png" alt="avatar" style="width: 200px; margin-left: 40px">
                                                </div>
                                                <div id="button" >
                                                    <i id="btn_chooseImg" class="fas fa-camera">  Chọn ảnh</i>
                                                </div>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="">
                                    <label for="lastName" class="form-label">Tên giải đấu</label>
                                    <input class="form-control" type="text" name="name" id="name"  />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <label for="address" class="form-label">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Address" />
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <label for="address" class="form-label">Ngày kết thúc</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Address" />
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <label for="lastName" class="form-label">Đội tham gia</label>
                                    <input class="form-control" type="text" name="number_of_team" id="number_of_team"  />
                                    @if ($errors->has('number_of_team'))
                                        <span class="text-danger">{{ $errors->first('number_of_team') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Thể thức thi đấu</label>
                                    <select id="format" name="format" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        @foreach($formatTour as $formatTour => $value)
                                            <option id="format" value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Hình thức thi đấu</label>
                                    <select  id="type" name="type" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        @foreach($type_tour as $type_tour => $value)
                                            <option id="type" value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Lưu</button>
                            <button type="reset" class="btn btn-outline-secondary">Hủy</button>
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
