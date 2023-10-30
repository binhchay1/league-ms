@extends('layout.admin_layout')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Lịch Thi Đấu</h4>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
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
                            <td>{{ $data->time }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img class ="image" src="{{$data->team1->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                        {{$data->team1->name}}
                                    </div>
                                    <div  class="col-lg-12 mt-4">
                                        <img class ="image" src="{{$data->team2->image}}" alt="avatar" style=" width: 15px; border-radius: 10px; margin-right: 15px;">
                                        {{$data->team2->name}}
                                    </div>

                                </div>
                            </td>
                            <td>{{$data->stadium}}</td>
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
