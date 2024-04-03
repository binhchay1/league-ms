@extends('layouts.page')

@section('content')
<style>
    input[type=text] {
        padding: 6px 8px;
    }

    a {
        color: black;
    }
</style>
<div style="background-color: white">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style=" margin-bottom: 20px">
                <div class="card-header">
                    <h3>{{ __('Profile') }}</h3>
                </div>
                <form method="POST" action="{{ route('profile.update', $dataUser['id']) }}" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                    <div class="alert alert-success" style="color: green; font-size: 20px;" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="row" style="padding: 10px">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" value="{{ $dataUser->name }}" name="name" class="form-control" placeholder="name">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div>
                                    <label for="img">{{ __('Avatar') }}</label>
                                    <input value="" type="file" class="border-0 bg-light pl-0" name="profile_photo_path" id="profile_photo_path" style="display: none">
                                    <input type="file" id="profile_photo_path_mobile" name="picture" accept="image/*;capture=camera" capture="environment" style="display: none"/>
                                    <div class=" choose-avatar">
                                        <div id="btnimage">
                                            <img id="showImage" style="width: 110px" class="show-avatar" src="{{ $dataUser->profile_photo_path ?? asset('/images/no-image.png') }}" alt="avatar">
                                        </div>
                                        <div id="button" style="margin-top: 10px;">
                                            <i id="btn_chooseImg" class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('profile_photo_path'))
                                    <span class="text-danger">{{ $errors->first('profile_photo_path') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <label for="name" class="form-label">{{ __('Email') }}</label>
                            <input type="text" value="{{ $dataUser->email }}" name="email" class="form-control" placeholder="name" disabled>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <label for="inputAddress" class="form-label">{{ __('Phone Number') }}</label>
                            <input name="phone" value="{{ old('phone', $dataUser->phone) }}" type="text" class="form-control ">
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>

                        <div class="col-sm-6 mt-3">
                            <label for="inputCity" class="form-label">{{ __('Address') }}</label>
                            <input name="address" type="text" value="{{ old('address', $dataUser->address) }}" class="form-control ">
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label for="inputCity" class="form-label">{{ __('Date of Birth') }}</label>
                            <input name="age" type="date" value="{{ old('age', $dataUser->age) }}" class="form-control">
                            @if ($errors->has('age'))
                            <span class="text-danger">{{ $errors->first('age') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex" style="margin: 20px 10px;">
                        <button type="submit" class="btn btn-success">
                            {{ __('Save') }}
                        </button>
                        <a class="btn btn-success" href="{{ route('change-password') }}" style="margin-left: 10px;">
                            {{ __('Change Password') }}
                        </a>
                        @if(Auth::user()->apple_id != null)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" style="margin-left: 10px;">
                            {{ __('Delete account') }}
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">{{ __('Delete account') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete this account ?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" onclick="deleteAccount()">{{ __('Yes') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/page/profile.js') }}"></script>
@endsection
