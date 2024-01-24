@extends('layouts.auth')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('/images/auth-logo.jpg') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height: 100%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="POST" action="{{ route('storeUser') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="{{route('home')}}"> <img src="{{ asset('/images/logo-no-background.png') }}" style="width: 50px; height: 50px"></a>
                                        <span style="margin-left: 20px;" class="h1 fw-bold mb-0" >{{ __('Register') }}</span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">{{ __('Name') }}</label>
                                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">{{ __('Email') }}</label>
                                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        <input type="password" id="password-field" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password_confirm">{{ __('Password Confirm') }}</label>
                                        <input type="password" id="password-confirm" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">{{ __('Register') }}</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">{{ __('Do you have an account ?') }}
                                        <a href="{{ route('login') }}" style="color: #393f81;">{{ __('Login') }}</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
