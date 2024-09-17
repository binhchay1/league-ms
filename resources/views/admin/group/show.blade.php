@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5>{{ __('Group') }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4" style="text-align: center;">
                        <img height="150" width="150" src="{{ asset($dataGroup->images ?? '/images/logo-no-background.png') }}" alt="logo">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $dataGroup->name }}</h2>
                        <p>* {{ __('Description') }}: {{ $dataGroup->description }}</p>
                        <p>* {{ __('Location') }}: {{ $dataGroup->location }}</p>
                        <p class="fst-italic fw-light fw-bold">----- {{ __('Note') }}: {{ $dataGroup->note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h5>{{__('Create Group Training')}}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('groupTraining.create') }}" enctype="multipart/form-data">
                    @csrf()
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="container d-flex flex-row">
                        <div class="container ml-4">
                            <div>
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Enter group name') }}" />
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <input class="form-control" type="text" name="description" id="description" value="{{ old('description') }}" placeholder="{{ __('Enter group description') }}" />
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="description" class="form-label">{{ __('Date') }}</label>
                                <input class="form-control" type="date" name="date" id="description" value="{{ old('date') }}" placeholder="{{ __('Enter group description') }}" />
                                @if ($errors->has('date'))
                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="activity_time" class="form-label">{{ __('Activity time') }}</label>
                                <p>Start</p>
                                <input class="form-control" type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" />
                                @if ($errors->has('start_time'))
                                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                @endif
                                <p>End</p>
                                <input class="form-control" type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" />
                                @if ($errors->has('end_time'))
                                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="number_of_members" class="form-label">{{ __('Number of members') }}</label>
                                <input class="form-control" type="number" name="number_of_members" id="number_of_members" min="1" max="50" value="{{ old('number_of_members') }}" placeholder="{{ __('Choose number of member') }}" />
                                @if ($errors->has('number_of_members'))
                                    <span class="text-danger">{{ $errors->first('number_of_members') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="location" class="form-label">{{ __('Location') }}</label>
                                <input class="form-control" type="text" name="location" id="location" value="{{ old('location') }}" placeholder="{{ __('Enter group location') }}" />
                                @if ($errors->has('location'))
                                    <span class="text-danger">{{ $errors->first('location') }}</span>
                                @endif
                            </div>

                            <div>
                                <label for="note" class="form-label">{{ __('Note') }}</label>
                                <input class="form-control" type="text" name="note" id="note" value="{{ old('note') }}" placeholder="{{ __('Enter group note') }}" />
                                @if ($errors->has('note'))
                                    <span class="text-danger">{{ $errors->first('note') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" value="{{ $dataGroup->id }}" name="group_id" id="name" hidden />
                            </div>

                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">{{ __('Save') }}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{ __('Reset') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

