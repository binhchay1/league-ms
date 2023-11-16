@extends('layout.admin_layout')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{__('Danh Sách Người Dùng')}}</h4>
        @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">{{__('Tên')}}</th>
                        <th scope="col">{{__('Hòm thư')}}</th>
                        <th scope="col">{{__('Hình ảnh')}}</th>
                        <th scope="col">{{__('Số điện thoại')}}</th>
                        <th scope="col">{{__('Địa chỉ')}}</th>
                        <th scope="col">{{__('Ngày sinh')}}</th>
                        <th scope="col">{{__('Giới tính')}}</th>

                        <th style="width: 10%" scope="col">{{__('Hành động')}}</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($dataUser as $data)
                        <tr class="design-text">
                            <td>{{ $data->name}}</th>
                            <td>{{ $data->email }}</td>
                            <td><img class="image" src="{{ $data->image ?? asset('/images/default-avatar.png') }}" alt="avatar" width="100" height="50"></td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->age }}</td>
                            <td>{{ $data->sex }}</td>
                            <td class="text_flow text-center">
                                <a href="{{route('user.delete', $data['id'])}}">
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
