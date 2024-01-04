@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style=" margin-bottom: 20px">
                    <div class="card-header">
                        <h3>{{ __('Change Password') }}</h3>
                    </div>
                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" style="color: green; font-size: 20px;" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">{{ __('Old Password') }}</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="password-field">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if(session('error'))
                                    <div class="alert text-alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">{{ __('New Password') }}</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">{{ __('Password Confirm') }}</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
