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
                            <img src="{{ asset('content/images/sport.png') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height: 100%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="POST" action="{{ route('login.custom') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">{{ __('Đăng nhập') }}</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">{{ __('Hòm thư') }}</label>
                                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" autofocus />
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-outline">
                                        <label class="control-label">{{ __('Mật khẩu') }}</label>
                                        <input name="password" value="{{ old('password') }}" type="password" class="form-control" id="password-field" autofocus>
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="pt-1">
                                        <input type="checkbox" name="remember" />
                                        <label class="control-label">{{ __('Lưu thông tin') }}</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">{{ __('Đăng nhập') }}</button>
                                    </div>

                                    <div class="d-flex flex-row">
                                        <p class="lead fw-normal mb-0 me-3">
                                            {{ __('Đăng nhập với') }}
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">{{ __('Bạn chưa có tài khoản ?') }}
                                            <a href="{{route('register_user')}}" style="color: #393f81;">{{ __('Đăng ký') }}</a>
                                        </p>
                                        <a href="{{ route('auth.facebook') }}" class="btn btn-primary btn-floating mx-1" style="width: 40px;">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>

                                        <a href="{{ route('auth.google') }}" class="btn btn-light btn-floating mx-1 text-danger border">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </div>

                                    @if(Request::exists('return_url'))
                                    <input type="hidden" name="return_url" value="{{ Request::get('return_url') }}">
                                    @endif

                                    @if (Route::has('password.request'))
                                    <a class="small text-muted" href="{{ route('password.request') }}">{{ __('Quên mật khẩu') }}</a>
                                    @endif
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">{{ __('Bạn chưa có tài khoản ?') }}
                                        <a href="" style="color: #393f81;">{{ __('Đăng ký') }}</a>
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
