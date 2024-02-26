@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('League') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4" style="text-align: center;">
                    <img height="150" width="150" src="{{ $league->images ?? asset('/images/champion.png') }}" alt="logo">
                </div>
                <div class="col-lg-6">
                    <h2>{{ $league->name }}</h2>
                    <h5>{{ __('Start Date') }}: {{ $league->start_date }}</h5>
                    <h5>{{ __('End Date') }}: {{ $league->end_date }}</h5>
                    <div class="prize">{{ __('PRIZE MONEY USD ') }}${{ $league->money }}</div>
                </div>
                @if(count($league->schedule) == 0)
                <div class="col-lg-2 ">
                    <a href="{{ route('auto.create.schedule') }}?s={{ $league->slug }}" class="btn btn-primary">{{ __('Auto Create Schedule') }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card mb-4">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="card-header">{{ __('Schedule') }}</h5>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <form id="formAccountSettings" method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data">
                @if ($errors->any())
                <div class="notification is-danger is-light">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf()
                <div class="table-responsive">
                    <table class="table table-hover table-white" id="tableEstimate">
                        <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th style="width: 200px;">{{ __('Round') }}</th>
                                <th style="width: 200px;">{{ __('Match') }}</th>
                                <th style="width: 200px;">{{ __('Player 1_Team 1') }}</th>
                                <th style="width: 200px;">{{ __('Player 2_Team 1') }}</th>
                                <th style="width: 200px;">{{ __('Player 1_Team 2') }}</th>
                                <th style="width: 200px;">{{ __('Player 2_Team 2') }}</th>
                                <th style="width: 150px;">{{ __('Time') }}</th>
                                <th style="width: 300px;">{{ __('Competition Day') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select style="width: 200px;" id="round" value="{{ old('round') }}" name="round[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        @foreach($rounds as $round => $value)
                                        <option id="format_of_league" value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input style="width: 200px;" class="form-control" value="{{ old('match') }}" type="number" name="match[]" id="match" min="1" />
                                    @if ($errors->has('match'))
                                    <span class="text-danger">{{ $errors->first('match') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player1_team_1" value="{{ old('player1_team_1') }}" name="player1_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{ __('Select Player') }}</option>

                                        @foreach($league->userLeagues as $user => $value)
                                        @if(empty($value->user))
                                        <option id="format_of_league" value=""></option>
                                        @else
                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player2_team_1" value="{{ old('player2_team_1') }}" name="player2_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach( $league->userLeagues as $user => $value)
                                        @if(empty($value->user))
                                        <option id="format_of_league" value=""></option>
                                        @else
                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player1_team_2" value="{{ old('player1_team_2') }}" name="player1_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                        @if(empty($value->user))
                                        <option id="format_of_league" value=""></option>
                                        @else
                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 200px;" id="player2_team_2" value="{{ old('player2_team_2') }}" name="player2_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                        @foreach($league->userLeagues as $user => $value)
                                        @if(empty($value->user))
                                        <option id="format_of_league" value=""></option>
                                        @else
                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input style="width: 200px;" type="time" value="{{ old('time') }}" class="form-control" id="time" name="time[]" />
                                </td>
                                @if ($errors->has('time'))
                                <span class="text-danger">{{ $errors->first('time') }}</span>
                                @endif
                                <td>
                                    <input style="width: 200px;" type="date" value="{{ old('date') }}" class="form-control" id="date" name="date[]" />
                                </td>
                                @if ($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                                @endif
                                <td>
                                    <input style="width: 200px;" type="hidden" name="league_id" value="{{ $league->id }}">
                                </td>
                                <td><a href="javascript:void(0)" class="text-success font-18" title="Add" id="addBtn"><i class="fa fa-plus"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="" style="margin: 40px;">
                    <button type="submit" class="btn btn-primary me-2">{{ __('Save') }} </button>
                    <button type="reset" class="btn btn-outline-secondary">{{ __('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>
<script>
    var rowIdx = 1;
    $("#addBtn").on("click", function() {
        $("#tableEstimate tbody").append(`
                <tr id="R${++rowIdx}">
                    <td class="row-index text-center"><p> ${rowIdx}</p></td>
                    <td>
                        <select style="width: 200px;"  id="round" value="{{ old('round') }}" name="round[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            @foreach($rounds as $round => $value)
                                @if(empty($value->user))
                                    <option id="format_of_league" value=""></option>
                                @else
                                    <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td><input style="width: 200px;" class="form-control" value="{{ old('match') }}" type="number" name="match[]" id="match" min="1"/></td>
                    <td>
                        <select style="width: 200px;"  id="player1_team_1" value="{{ old('player1_team_1') }}" name="player1_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                @if(empty($value->user))
                                    <option id="format_of_league" value=""></option>
                                @else
                                    <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player2_team_1" value="{{ old('player2_team_1') }}" name="player2_team_1[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                @foreach($league->userLeagues as $user => $value)
                                    @if(empty($value->user))
                                        <option id="format_of_league" value=""></option>
                                    @else
                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                    @endif
                               @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player1_team_2" value="{{ old('player1_team_2') }}" name="player1_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                @if(empty($value->user))
                                    <option id="format_of_league" value=""></option>
                                @else
                                    <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select style="width: 200px;" id="player2_team_2" value="{{ old('player2_team_2') }}" name="player2_team_2[]" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                            <option id="format_of_league" value="">{{__('Select Player')}}</option>
                            @foreach($league->userLeagues as $user => $value)
                                @if(empty($value->user))
                                    <option id="format_of_league" value=""></option>
                                @else
                                    <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    <td><input style="width: 200px;" type="text" value="{{ old('time') }}" class="form-control" id="time" name="time[]"/></td>
                    <td><input style="width: 200px;" type="date" value="{{ old('date') }}" class="form-control" id="date" name="date[]"/></td>
                    <td><input style="width: 200px;" type="hidden" name="league_id" value="{{$league->id}}"></td>
                    <td><a href="javascript:void(0)" style="width: 200px;" class="text-danger font-18 remove" title="Add" id="addBtn"><i class="fa fa-trash"></i></a></td>
                </tr>`);
    });
    $("#tableEstimate").on("click", ".remove", function() {
        var child = $(this).closest("tr").nextAll();
        child.each(function() {
            var id = $(this).attr("id");
            var idx = $(this).children(".row-index").children("p");
            var dig = parseInt(id.substring(1));

            idx.html(`${dig - 1}`);
            $(this).attr("id", `R${dig - 1}`);
        });

        $(this).closest("tr").remove();
        rowIdx--;
    });

    $("#tableEstimate tbody").on("input", ".unit_price", function() {
        var unit_price = parseFloat($(this).val());
        var qty = parseFloat($(this).closest("tr").find(".qty").val());
        var total = $(this).closest("tr").find(".total");
        total.val(unit_price * qty);

        calc_total();
    });

    $("#tableEstimate tbody").on("input", ".qty", function() {
        var qty = parseFloat($(this).val());
        var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
        var total = $(this).closest("tr").find(".total");
        total.val(unit_price * qty);
        calc_total();
    });
</script>
@endsection
