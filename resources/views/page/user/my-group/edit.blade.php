@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color: red; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }



    .label-danger {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: red;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .label-success {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: mediumpurple;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .gr-name {
        color: green !important;
        font-weight: bold;
    }

    .list-group-item-action.active {
        background-color: #ff3a35 !important;
        color: white;
        border-radius: 5px;
        border-color: #ff3a35 !important;
    }

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
    <section >
        <div class="container-fluid">
            <!-- Header -->
            <div class=" text-black p-3 align-items-center">
                <div class="container d-flex  img-fluid">
                    <img src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png')}}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                    <div>
                        <h2 class="mb-1 p-0">{{Auth::user()->name}}</h2>
                        <p class="mb-1">
                            <i class="bi bi-envelope"></i> {{Auth::user()->email}}
                        </p>
                        <p class="mb-1 text-muted">
                            <i class="bi bi-telephone"></i> <em>{{Auth::user()->phone}}</em>
                        </p>
                        <p class="mb-0 text-muted">
                            <i class="bi bi-calendar"></i> <em>{{'updating'}}</em>
                        </p>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Main Content -->
            <div class="container bg-gray">
                <div class="container mt-4 league-tour">
                    <h2 class="text-left">{{'Update group'}}</h2>
                    <hr>
                    <form id="formAccountSettings" method="POST" action="{{ route('my.updateMyGroup', $dataGroup->id) }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row mb-3 form-group-create">
                            <div class="col-md-3">
                                <label>{{ __('Logo ') }}</label>
                                <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                                <div class=" choose-avatar">
                                    <div id="btnimage">
                                        <img id="showImage" class="show-avatar" src="{{ asset($dataGroup->images ??'/images/logo-no-background.png') }}" alt="avatar" style="width: 200px;">
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
                                    <input class="form-control" type="text" name="name" id="name" value="{{ $dataGroup->name }}" placeholder="{{ __('Enter group name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <label for="description" class="form-label">{{ __('Description') }}</label>
                                    <input class="form-control" type="text" name="description" id="description"  value="{{ $dataGroup->description }}" placeholder="{{ __('Enter group description') }}" />
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <label for="location" class="form-label">{{ __('Location') }}</label>
                                    <input class="form-control" type="text" name="location" id="location" value="{{ $dataGroup->location }}" placeholder="{{ __('Enter group location') }}" />
                                    @if ($errors->has('location'))
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <label for="location" class="form-label">{{ __('Number of members') }}</label>
                                    <input class="form-control" type="number" name="number_of_members" id="location" value="{{ $dataGroup->number_of_members }}" placeholder="{{ __('Enter group number of members') }}" min="0"/>
                                    @if ($errors->has('number_of_members'))
                                        <span class="text-danger">{{ $errors->first('number_of_members') }}</span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <label for="note" class="form-label">{{ __('Note') }}</label>
                                    <input class="form-control" type="text" name="note" id="note"value="{{ $dataGroup->note }}"placeholder="{{ __('Enter group note') }}" />
                                    @if ($errors->has('note'))
                                        <span class="text-danger">{{ $errors->first('note') }}</span>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select" name="status" id="status" value="{{ $dataGroup->status }}">
                                        <option value="public">{{ __('Public') }}</option>
                                        <option value="private">{{ __('Private') }}</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <input type="hidden" class="form-control" type="text" name="active" id="note" value="{{$dataGroup->active}}" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-12">
                            <button class="btn btn-success w-10 mt-4 mb-12">{{'Update'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
