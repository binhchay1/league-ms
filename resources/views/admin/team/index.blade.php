@extends('layouts.admin')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{__('Danh Sách Các Đội')}}</h4>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">{{__('Tên Đội')}}</th>
                        <th scope="col">{{__('Huấn luyện viên')}}</th>
                        <th scope="col">{{__('Ảnh đội')}}</th>
                        <th scope="col">{{__('Hành động')}}</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listTeam as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{ $data->coach }}</td>
                            <td><img class ="image" src="{{$data->image ?? asset('/images/default_team_logo.png')}}" alt="avatar" style="width: 150px"></td>
                            <td>
                                <a href="{{route('team.edit',$data['id'])}}">
                                    <button type="button" class="btn btn-info">{{__('Sửa')}}</button>
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                pagingType: 'full_numbers',
            });
            $('.dataTables_length').addClass('bs-select');
        })
    </script>
@endsection
