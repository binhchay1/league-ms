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

                                    <form method="POST" action="">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">{{ __('Đăng ký') }}</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">{{ __('Tên') }}</label>
                                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">{{ __('Hòm thư') }}</label>
                                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">{{ __('Mật khẩu') }}</label>
                                            <input type="password" id="password-field" class="form-control" name="password" required autocomplete="current-password" />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">{{ __('Đăng ký') }}</button>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">{{ __('Bạn có tài khoản ?') }}
                                            <a href="{{route('login')}}" style="color: #393f81;">{{ __('Đăng nhập') }}</a>
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
