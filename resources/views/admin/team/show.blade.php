@extends('layout.admin_layout')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5 >{{__('Thông tin đội')}}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{route('team.update', $dataTeam['id'])}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: 700">{{__('Logo đội')}}</label>
                                    <div class="">
                                        <div class="" style="display: inline-grid;">
                                            <input value="{{$dataTeam->image}}" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                            <div class=" choose-avatar" >
                                                <div id="btnimage">
                                                    <img id="showImage" class="show-avatar" src="{{$dataTeam->image}}" alt="avatar" style="width: 200px; margin-left: 40px">
                                                </div>
                                                <div id="button" >
                                                    <i id="btn_chooseImg" class="fas fa-camera">  {{__('Chọn ảnh')}}</i>
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
                        <div class="col-md-6">
                            <div>
                                <label style="font-weight: 700" for="lastName" class="form-group">{{__('Tên đội')}}</label>
                                <input class="form-control" value="{{$dataTeam->name}}" type="text" name="name" id="name"/>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <label style="font-weight: 700" for="address" class="form-group">{{__('Huấn luyện viên')}}</label>
                                <input type="text" value="{{$dataTeam->coach}}" class="form-control" id="coach" name="coach"/>
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
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">{{__('Thông tin vận động viên')}}</h5>
            <hr class="my-0" />
            <div class="card-body">
                <div class="card" style="padding: 10px">
                    <div class=" container-xl table-responsive text-nowrap">
                        <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                            <tr class="design-text">
                                <th scope="col">{{__('Tên')}}</th>
                                <th scope="col">{{__('Ngày sinh')}}</th>
                                <th scope="col">{{__('Giới tính')}}</th>
                                <th scope="col">{{__('Hình ảnh')}}</th>
                                <th scope="col">{{__('Hành động')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($dataTeam->players as $playOfTeam)
                                <tr>
                                    <td><i class=""></i> <strong>{{$playOfTeam->name}}</strong></td>
                                    <td><i class=""></i> <strong>{{$playOfTeam->birthday}}</strong></td>
                                    <td><i class=""></i> <strong>{{$playOfTeam->sex}}</strong></td>
                                    <td><img class ="image" src="{{$playOfTeam->image}}" alt="avatar" style="width: 150px"></td>
                                    <td>
                                        <a href="">
                                            <button type="button" class="btn btn-secondary">{{__('Sửa')}}</button>
                                        </a>
                                        <a href="">
                                            <button type="button" class="btn btn-danger">{{__('Xóa')}}</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                pagingType: 'full_numbers',
            });
            $('.dataTables_length').addClass('bs-select');
        })
    </script>
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection


