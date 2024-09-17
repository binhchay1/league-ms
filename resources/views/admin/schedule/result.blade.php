@extends('layouts.admin')
@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ __('Schedule') }} </h4>
    <a href="{{route('schedule.index')}}">
        <button type="reset" class="btn btn-primary" >{{ __('Back') }}</button></a>
    <div class="card mt-4" style="padding: 10px">
        <div class="form-group col-lg-3">
            <label style="font-weight: 600">{{ __('League') }}</label>
            <select id="league" value="{{ old('format_of_league') }}" name="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                <option id="format_of_league" value="">{{ __('Select League') }}</option>
                @foreach ($listLeagues as $league )
                <option value="{{ $league->name }}">
                    {{ $league->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label style="font-weight: 600">{{ __('Round') }}</label>
            <select id="round" value="{{ old('format_of_league') }}" name="" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                <option id="format_of_league" value="">{{ __('Select Round') }}</option>
                @foreach ($rounds as $round )
                <option value="{{ $round }}">
                    {{ $round }}
                </option>
                @endforeach
            </select>
        </div>
        <div class=" container-xl table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                <thead>
                    <tr class="design-text">
                        <th scope="col" style="width: 15px">{{__('League') }}</th>
                        <th scope="col">{{ __('Round') }}</th>
                        <th scope="col">{{ __('Team 1') }}</th>
                        <th scope="col">{{ __('Team 2') }}</th>
                        <th scope="col" style="width: 40px">{{ __('Final Score') }}</th>
                        <th scope="col" style="width: 60px">{{ __('Set 1') }}</th>
                        <th scope="col" style="width: 60px">{{ __('Set 2') }}</th>
                        <th scope="col" style="width: 60px">{{ __('Set 3') }}</th>
                        <th scope="col" style="text-align: center; width: 60px">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($listLeagues as $league)
                    @foreach($league->schedule as $data)
                    <tr>
                        <td>{{ $data->league->name ?? "" }}</td>
                        <td>{{ $data->round }}</td>
                        <td>
                            {{ $data->player1Team1->name ?? "" }}
                            <br>
                            {{ $data->player2Team1->name ?? "" }}
                        </td>
                        <td>
                            {{ $data->player1Team2->name ?? "" }}
                            <br>
                            {{ $data->player2Team2->name ?? "" }}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{ $data->result_team_1 }}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{ $data->result_team_2 }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{ $data->set_1_team_1 }}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{ $data->set_1_team_2 }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{ $data->set_2_team_1 }}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{ $data->set_2_team_2 }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    {{ $data->set_3_team_1 }}
                                </div>
                                <div class="col-lg-4">
                                    -
                                </div>
                                <div class="col-lg-2">
                                    {{ $data->set_3_team_2 }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('schedule.show', $data['id']) }}" class="btn btn-primary">
                                <span style="color:white"></span>{{ __('Update Result') }}
                            </a>
                            <a href="{{ route('schedule.export', $data['id']) }}" class="btn btn-success">
                                <span style="color:white"></span>{{ __('Export Result') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
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

    $('#league').on('change', function() {
        var league = $('#dataTables').DataTable();
        league.search(this.value).draw();
    });

    $('#round').on('change', function() {
        var round = $('#dataTables').DataTable();
        round.search(this.value).draw();
    });

    setTimeout(function() {
        $('.alert-block').remove();
    }, 5000);
</script>
@endsection
