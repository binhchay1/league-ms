@extends('layouts.admin')
@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{__('Lịch Thi Đấu')}} </h4>
    <div class="card" style="padding: 10px">
        <div class=" container-xl table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                <thead>
                    <tr class="design-text">
                        <th scope="col" style="width: 15px">{{__('League')}}</th>
                        <th scope="col" >{{__('Round')}}</th>
                        <th scope="col">{{__('Team 1')}}</th>
                        <th scope="col">{{__('Team 2')}}</th>
                        <th scope="col" style="width: 30px" >{{__('Final Score')}}</th>
                        <th scope="col" >{{__('Set 1')}}</th>
                        <th scope="col" >{{__('Set 2')}}</th>
                        <th scope="col" >{{__('Set 3')}}</th>
                        <th scope="col">{{__('Sân thi đấu')}}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($dataResult as $data)
                    <tr>
                        <td>{{ $data->league->name }}</td>
                        <td>{{ $data->round }}</td>
                        <td>
                            {{$data->player1Team1->name ?? ""}}
                            <br>
                            {{$data->player2Team1->name ?? ""}}
                        </td>
                        <td>
                            {{$data->player1Team2->name ?? ""}}
                            <br>
                            {{$data->player2Team2->name ?? ""}}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{$data->result_team_1}}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{$data->result_team_2}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{$data->set_1_team_1}}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{$data->set_1_team_2}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{$data->set_2_team_1}}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{$data->set_2_team_2}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{$data->set_3_team_1}}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{$data->set_3_team_2}}
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
