@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Edit League') }}
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header" >
                <h5>{{__('Schedule')}}</h5>
            </div>
            <div class="card-body container">
                <form id="formAccountSettings" method="POST" action="{{ route('schedule.update',$dataSchedule['id']) }}" enctype="multipart/form-data">
                    @csrf()
                    <div >
                        <!-- /.col -->
                        <div class="">
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="lastName" class="form-label">{{ __('League') }}</label>
                                    <input class="form-control" value="{{ $dataSchedule->league->name}}" type="text" name="league_id" id="name" placeholder="{{ __('Enter league ') }}" disabled="disabled"/>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Round') }}</label>
                                        <select id="type_of_league" value="{{ $dataSchedule->round }}" name="round" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" >
                                            @foreach($rounds as $round => $value)
                                                <option id="type_of_league" value="{{ $value }}" {{$value == $dataSchedule->round ? 'selected' : ''}}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{ __('Match') }}</label>
                                        <input type="number" value="{{ old('match', $dataSchedule['match']) }}" class="form-control" id="start_date" name="match" min="1" placeholder="{{ __('Enter schedule match') }}" />
                                        @if ($errors->has('match'))
                                            <span class="text-danger">{{ $errors->first('match') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{ __('Time') }}</label>
                                        <input type="time" value="{{ old('time', $dataSchedule['time']) }}" class="form-control" name="time" placeholder="{{ __('Enter schedule time') }}" />
                                        @if ($errors->has('time'))
                                            <span class="text-danger">{{ $errors->first('time') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{ __('Team 1') }}</label>
                                        <input type="" value="{{ $dataSchedule->player1Team1->name ?? "" }} - {{$dataSchedule->player2Team1->name ?? "" }} " class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">{{ __('Team 1') }}</label>
                                        <input type="" value="{{ $dataSchedule->player1Team2->name ?? "" }} - {{$dataSchedule->player2Team2->name ?? "" }} " class="form-control" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">{{ __('Save') }}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{ __('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/league.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
