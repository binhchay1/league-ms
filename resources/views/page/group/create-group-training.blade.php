@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create Group Training') }}
@endsection
<style>
    .league-tour {
        background: #eeeeee;
        padding: 10px;
    }

    .btn-success {
        padding: 10px;
    }

    .form-control {
        line-height: 2.5 !important;
    }

    .btn-success {
        margin-bottom: 10px;
    }

    .form-group-create {
        padding: 50px !important;
    }

    h2.text-left {
        font-weight: 400;
        color: black;
        margin: 0;
        font-size: 28px;
    }

</style>

@section('content')
    <div class="container mt-4 league-tour">
        <h2 class="text-left">{{'Create group training'}}</h2>
        <hr>
        <form id="formAccountSettings" method="POST" action="{{ route('store.GroupTraining') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row mb-3 form-group-create">
                <div class="col-md-9">
                    <div class="mt-2">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Enter group name') }}" />
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input class="form-control" type="text" name="description" id="description" value="{{ old('description') }}" placeholder="{{ __('Enter group description') }}" />
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="mt-4 ">
                        <label for="description" class="form-label">{{ __('Date') }}</label>
                        <input class="form-control" type="date" name="date" id="date" value="{{ old('date') }}" placeholder="{{ __('Enter group date') }}" />
                        @if ($errors->has('date'))
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    <label for="activity_time" class="form-label mt-4">{{ __('Activity time') }}</label>

                    <div class=" row">
                       <div class="col-md-6">
                           <p class="">Start</p>
                           <input class="form-control" type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" />
                           @if ($errors->has('start_time'))
                               <span class="text-danger">{{ $errors->first('start_time') }}</span>
                           @endif
                       </div>
                        <div class="col-md-6">
                            <p>End</p>
                            <input class="form-control" type="time" name="end_time" id="start_time" value="{{ old('end_time') }}" />
                            @if ($errors->has('end_time'))
                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="number_of_members" class="form-label">{{ __('Number of members') }}</label>
                        <input class="form-control" type="number" name="number_of_members" id="number_of_members" min="1" max="50" value="{{ old('number_of_members') }}" placeholder="{{ __('Choose number of member') }}" />
                        @if ($errors->has('number_of_members'))
                            <span class="text-danger">{{ $errors->first('number_of_members') }}</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        <label for="location" class="form-label">{{ __('Location') }}</label>
                        <input class="form-control" type="text" name="location" id="location" value="{{ old('location') }}" placeholder="{{ __('Enter group location') }}" />
                        @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label for="location" class="form-label">{{ __('Number of members') }}</label>
                        <input class="form-control" type="number" name="number_of_members" id="location" value="{{ old('number_of_members') }}" placeholder="{{ __('Enter group number of members') }}" min="0"/>
                        @if ($errors->has('number_of_members'))
                            <span class="text-danger">{{ $errors->first('number_of_members') }}</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        <label for="note" class="form-label">{{ __('Note') }}</label>
                        <input class="form-control" type="text" name="note" id="note" value="{{ old('note') }}" placeholder="{{ __('Enter group note') }}" />
                        @if ($errors->has('note'))
                            <span class="text-danger">{{ $errors->first('note') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" value="{{ $group->id }}" name="group_id" id="name" hidden />
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <button class="btn btn-success w-10 mt-4 mb-12">{{'Create'}}</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
