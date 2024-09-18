@extends('layouts.admin')
@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ __('Schedule') }} </h4>
    <div class="card" style="padding: 10px">
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
                        <th scope="col">{{ __('League') }}</th>
                        <th scope="col">{{ __('Round') }}</th>
                        <th scope="col">{{ __('Match') }}</th>
                        <th scope="col">{{ __('Time') }}</th>
                        <th scope="col">{{ __('Team 1') }}</th>
                        <th scope="col">{{ __('Team 2') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($listLeagues as $league )
                    @foreach($league->schedule as $data)
                    <tr>
                        <td>{{ $data->league->name ?? "" }}</td>
                        <td>{{ $data->round }}</td>
                        <td>{{ $data->match }}</td>
                        <td>{{ $data->time }}</td>
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
                        <td class="text-center">
                            <a href="{{route('schedule.edit', $data['id'])}}" class="btn btn-primary">
                                <span style="color:white"></span>{{ __('Edit Schedule') }}
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
