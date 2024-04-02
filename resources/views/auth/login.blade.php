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
                                <form method="POST" action="{{ route('login.custom') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="{{route('home')}}"> <img src="{{ asset('/images/logo-no-background.png') }}" style="width: 50px; height: 50px"></a>
                                        <span style="margin-left: 20px;" class="h1 fw-bold mb-0">{{ __('Login') }}</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">{{ __('Email') }}</label>
                                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" autofocus />

                                    </div>

                                    <div class="form-outline">
                                        <label class="control-label">{{ __('Password') }}</label>
                                        <input name="password" value="{{ old('password') }}" type="password" class="form-control" id="password-field" autofocus>
                                    </div>

                                    @if(isset($errors))
                                    @foreach ($errors->all() as $error)
                                    <div style="color: red; margin: 10px">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                    <div class="pt-1">
                                        <input type="checkbox" name="remember" />
                                        <label class="control-label">{{ __('Remember') }}</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">{{ __('Login') }}</button>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <p class="lead fw-normal mb-0 me-3">
                                            {{ __('Login with') }}
                                        </p>

                                        <a href="{{ route('auth.google') }}" class="btn btn-light btn-floating mx-1 text-danger border">
                                            <i class="fab fa-google"></i>
                                        </a>

                                        <a href="{{ route('auth.line') }}" class="btn btn-light btn-floating mx-1 text-danger border" style="padding: 0.275rem 0.75rem 0.375rem">
                                            <img width="20" height="20" src="{{ asset('/images/btn_base.png') }}" />
                                        </a>

                                        <a href="{{ route('auth.apple') }}" class="btn btn-light btn-floating mx-1 text-danger border" style="padding: 0.275rem 0.75rem 0.375rem">
                                            <img width="20" height="20" src="{{ asset('/images/apple-icon.png') }}" />
                                        </a>
                                    </div>

                                    @if(Request::exists('return_url'))
                                    <input type="hidden" name="return_url" value="{{ Request::get('return_url') }}">
                                    @endif

                                    @if (Route::has('password.request'))
                                    <a class="small text-muted" href="{{ route('password.request') }}">{{ __('Forgot password') }}</a>
                                    @endif
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">{{ __('Do not have an account ?') }}
                                        <a href="{{ route('register_user') }}" style="color: #393f81;">{{ __('Register') }}</a>
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
