@extends('layout.admin_layout')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{__('Danh Sách Giải Đấu')}}</h4>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">{{__('Name')}}</th>
                        <th scope="col">{{__('Start Date')}}</th>
                        <th scope="col">{{__('End Date')}}</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Location')}}</th>
                        <th scope="col">{{__('Prize Money')}}</th>
                        <th scope="col">{{__('Number of athletes')}}</th>
                        <th scope="col">{{__('Format of league')}}</th>
                        <th scope="col">{{__('Type of league')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listLeagues as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{ $data->start_date }}</td>
                            <td>{{ $data->end_date }}</td>
                            <td><img class ="image" src="{{$data->image ?? asset('/images/champion.png')}}" alt="avatar" style="width: 150px"></td>
                            <td>{{ $data->location }}</td>
                            <td>{{ $data->money }}</td>
                            <td>{{ $data->number_of_athletes }}</td>
                            <td>{{ $data->format_of_league }}</td>
                            <td>{{ $data->type_of_league }}</td>
                            <td>
                                <a href="{{route('league.edit',$data['id'])}}">
                                    <button type="button" class="btn btn-info">{{__('Edit')}}</button>
                                </a>
                                <a href="">
                                    <button type="button" class="btn btn-danger">{{__('Delete')}}</button>
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
