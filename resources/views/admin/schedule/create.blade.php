@extends('layouts.admin')
@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
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
                <div class="card-body">
                    <div class="card" style="padding: 10px">
                        <div class=" container-xl table-responsive text-nowrap">
                            <form id="formAccountSettings" method="POST" action="{{route('schedule.store')}}" enctype="multipart/form-data">
                                @csrf()
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="lastName" class="form-label">{{__('Round')}}</label>
                                            <select  id="round" value="{{ old('format_of_league') }}" name="round" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                                @foreach($rounds as $rounds => $value)
                                                    <option id="format_of_league" value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="lastName" class="form-label">{{__('Match')}}</label>
                                            <input class="form-control" value="" type="number" name="match" id="match" min="1"/>

                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{ __('Player_Team_1') }}</label>
                                                <select  id="player1_team_1" value="{{ old('format_of_league') }}" name="player1_team_1" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                                    <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                                    @foreach($league->userLeagues as $rounds => $value)
                                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select  id="player2_team_1" value="{{ old('format_of_league') }}" name="player2_team_1" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                                    <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                                @foreach($league->userLeagues as $rounds => $value)
                                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{ __('Player_Team_2') }}</label>
                                                <select  id="player1_team_2" value="{{ old('format_of_league') }}" name="player1_team_2" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                                    <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                                    @foreach($league->userLeagues as $rounds => $value)
                                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select  id="player2_team_2" value="{{ old('format_of_league') }}" name="player2_team_2" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                                    <option id="format_of_league" value="">{{__('Select Player')}}</option>
                                                    @foreach($league->userLeagues as $rounds => $value)
                                                        <option id="format_of_league" value="{{ $value->user->id }}">{{ $value->user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6">
                                            <label for="address" class="form-label">{{__('Time')}}</label>
                                            <input type="text" value="" class="form-control" id="time" name="time"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">{{__('Competition Day')}}</label>
                                            <input type="date" value="" class="form-control" id="date" name="date"/>
                                        </div>
                                        <input type="hidden" name="league_id"
                                               value="{{$league->id}}">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary me-2">{{__('Save')}}</button>
                                    <button type="reset" class="btn btn-outline-secondary">{{__('Cancel')}}Cancel</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')

    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection


