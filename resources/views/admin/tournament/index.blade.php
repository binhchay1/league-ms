@extends('layout.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Danh Sách Giải Đấu</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ngày Bắt Đầu</th>
                        <th scope="col">Ngày Kết Thúc</th>
                        <th scope="col">Image</th>
                        <th scope="col">Thể Thức</th>
                        <th scope="col">Số Đội Tham Gia</th>
                        <th scope="col">Số người tham gia mỗi đội</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listTournament as $data)
                        <tr>
                            <td><i class=""></i> <strong>{{ $data->id }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->name }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->start_date }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->end_date }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->image }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->format }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->number_of_team }}</strong></td>
                            <td><i class=""></i> <strong>{{ $data->people_of_team }}</strong></td>
                            <td>
                                <a href="">
                                    <button type="button" class="btn btn-secondary">Edit</button>
                                </a>
                                <a href="">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
