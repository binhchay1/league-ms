@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create Group') }}
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    p {
        margin-bottom: 0 !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{__('Group')}}</h5>
            <a href="{{route('group.index')}}">
            <button type="reset" class="btn btn-primary" >{{ __('Back') }}</button></a>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('group.store') }}" enctype="multipart/form-data">
                @csrf()
                @if(session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ __('Logo group') }}</label>
                        <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                        <div class=" choose-avatar">
                            <div id="btnimage">
                                <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image: ') }}</i> <i class="text-black"> {{__('(jpeg,png,jpg)')}} </i>
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
                    <div class="col-md-6">
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
                            <select class="form-control" name="status" id="status" value="{{ old('status') }}">
                                <option value="public">{{ __('Public') }}</option>
                                <option value="private">{{ __('Private') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <input type="hidden" class="form-control" type="text" name="active" id="note" value="0" />
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

@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
