@extends('layout.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Danh Sách Giải Đấu</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">Lịch thi đấu</th>
                        <th scope="col">Đội thi đấu</th>
                        <th scope="col">Sân thi đấu</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listSchedule as $data)
                        <tr>
                            <td><i class=""></i> <strong>{{ $data->time }}</strong></td>
                            <td>
                                <div class="row">
                                    <div>
                                        <img class ="image" src="{{$data->team1->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                        {{$data->team1->name}}
                                    </div>
                                    <div class="mt-2">
                                        <img class ="image" src="{{$data->team2->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                        {{$data->team2->name}}
                                    </div>

                                </div>
                            </td>
                            <td><i class=""></i> <strong>{{$data->stadium}}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
