@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create League') }}
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
        <h2 class="text-left">{{'Create group'}}</h2>
        <hr>
        <form id="formAccountSettings" method="POST" action="{{ route('group.storeGroup') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row mb-3 form-group-create">
                <div class="col-md-3">
                    <label>{{ __('Logo ') }}</label>
                    <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                    <div class=" choose-avatar">
                        <div id="btnimage">
                            <img id="showImage" class="show-avatar" src="{{ asset('/images/logo-no-background.png') }}" alt="avatar" style="width: 200px;">
                        </div>

                        <div id="button">
                            <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image') }}</i>
                        </div>

                    </div>
                    @if ($errors->has('images'))
                        <span class="text-danger">{{ $errors->first('images') }}</span>
                    @endif
                </div>
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

                    <div class="mt-4">
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                        <select class="form-select" name="status" id="status" value="{{ old('status') }}">
                            <option value="public">{{ __('Public') }}</option>
                            <option value="private">{{ __('Private') }}</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <input type="hidden" class="form-control" type="text" name="active" id="note" value="1" />
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
