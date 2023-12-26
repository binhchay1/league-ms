@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5 >{{__('LEAGUE')}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4" style="text-align: center;">
                        <img height="150" width="150"  src="{{ $league->images }}" alt="logo">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $league->name }}</h2>
                        <h5>{{__('Start Date')}}: {{ $league->start_date }}</h5>
                        <h5>{{__('End Date')}}: {{ $league->end_date }}</h5>
                        <div class="prize">{{__('PRIZE MONEY USD ')}}${{ $league->money }}</div>
                    </div>
                </div>
        </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="card-header">{{__('Create Schedule')}}</h5>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <form id="formAccountSettings" method="POST" action="{{route('schedule.store')}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="table-responsive">
                        <table class="table table-hover table-white" id="tableEstimate">
                            <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th class="" style="width: 200px;" >{{__('Round')}}</th>
                                <th class="" style="width: 200px;" >{{__('Match')}}</th>
                                <th style="" style="width: 200px;" >{{ __('Player1_Team_1') }}</th>
                                <th style="" style="width: 200px;" >{{ __('Player2_Team_1') }}</th>
                                <th style="" style="width: 200px;" >{{ __('Player1_Team_2') }}</th>
                                <th style="" style="width: 200px;" >{{ __('Player2_Team_2') }}</th>
                                <th style="" style="width: 150px;" >{{ __('Time') }}</th>
                                <th style="" style="width: 300px;" >{{ __('Competition Day') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select style="width: 200px;"  id="round" value="{{ old('round') }}" name="round[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        @foreach($rounds as $round => $value)
                                            <option id="format_of_league" value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input style="width: 200px;" class="form-control" value="{{ old('match') }}" type="number" name="match[]" id="match" min="1"/></td>
                                <td>
                                    <select style="width: 200px;"  id="player1_team_1" value="{{ old('player1_team_1') }}" name="player1_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                            <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player2_team_1" value="{{ old('player2_team_1') }}" name="player2_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                            <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player1_team_2" value="{{ old('player1_team_2') }}" name="player1_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                            <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player2_team_2" value="{{ old('player2_team_2') }}" name="player2_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                            <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input style="width: 200px;" type="text" value="{{ old('time') }}" class="form-control" id="time" name="time[]"/></td>
                                <td><input style="width: 200px;" type="date" value="{{ old('date') }}" class="form-control" id="date" name="date[]"/></td>
                                <td><input style="width: 200px;" type="hidden" name="league_id" value="{{$league->id}}"></td>
                                <td><a href="javascript:void(0)" class="text-success font-18" title="Add" id="addBtn"><i class="fa fa-plus"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="margin: 40px;">
                        <button type="submit" class="btn btn-primary me-2">{{__('Save')}}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{__('Cancel')}}Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')

    <script src="{{ asset('js/eventImage.js') }}"></script>
    <script >
        var rowIdx = 1;
        $("#addBtn").on("click", function () {
            // Adding a row inside the tbody.
            $("#tableEstimate tbody").append(`
                <tr id="R${++rowIdx}">
                    <td class="row-index text-center"><p> ${rowIdx}</p></td>
                    <td>
                        <select style="width: 200px;"  id="round" value="{{ old('round') }}" name="round[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            @foreach($rounds as $round => $value)
                                <option id="format_of_league" value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input style="width: 200px;" class="form-control" value="{{ old('match') }}" type="number" name="match[]" id="match" min="1"/></td>
                    <td>
                        <select style="width: 200px;"  id="player1_team_1" value="{{ old('player1_team_1') }}" name="player1_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player2_team_1" value="{{ old('player2_team_1') }}" name="player2_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                @foreach($league->userLeagues as $user => $value)
                                    <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                               @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player1_team_2" value="{{ old('player1_team_2') }}" name="player1_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player2_team_2" value="{{ old('player2_team_2') }}" name="player2_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input style="width: 200px;" type="text" value="{{ old('time') }}" class="form-control" id="time" name="time[]"/></td>
                    <td><input style="width: 200px;" type="date" value="{{ old('date') }}" class="form-control" id="date" name="date[]"/></td>
                    <td><input style="width: 200px;" type="hidden" name="league_id" value="{{$league->id}}"></td>
                    <td><a href="javascript:void(0)" style="width: 200px;" class="text-danger font-18 remove" title="Add" id="addBtn"><i class="fa fa-trash"></i></a></td>
                </tr>`
            );
        });
        $("#tableEstimate").on("click", ".remove", function () {
            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest("tr").nextAll();
            // Iterating across all the rows
            // obtained to change the index
            child.each(function () {
                // Getting <tr> id.
                var id = $(this).attr("id");

                // Getting the <p> inside the .row-index class.
                var idx = $(this).children(".row-index").children("p");

                // Gets the row number from <tr> id.
                var dig = parseInt(id.substring(1));

                // Modifying row index.
                idx.html(`${dig - 1}`);

                // Modifying row id.
                $(this).attr("id", `R${dig - 1}`);
            });

            // Removing the current row.
            $(this).closest("tr").remove();

            // Decreasing total number of rows by 1.
            rowIdx--;
        });

        $("#tableEstimate tbody").on("input", ".unit_price", function () {
            var unit_price = parseFloat($(this).val());
            var qty = parseFloat($(this).closest("tr").find(".qty").val());
            var total = $(this).closest("tr").find(".total");
            total.val(unit_price * qty);

            calc_total();
        });

        $("#tableEstimate tbody").on("input", ".qty", function () {
            var qty = parseFloat($(this).val());
            var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
            var total = $(this).closest("tr").find(".total");
            total.val(unit_price * qty);
            calc_total();
        });

    </script>
@endsection


