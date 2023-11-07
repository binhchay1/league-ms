@extends('layouts.page')
@section('content')
    <div class="container " style="background-color: white">
        <div class="row">
            <div class=" title">
                <h3 class="">
                    <i class="fa fa-user"></i>
                    Thay đổi mật khẩu </h3>
            </div>
            <hr>
            <form method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" style="color: green; font-size: 20px;" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row" style="padding: 10px">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="name">{{ __('Mật khẩu cũ') }}</label>
                            <input  type="password" value="" name="old_password" class="form-control" placeholder="Mật khẩu cũ">
                            @if ($errors->has('old_password'))
                                <span class="text-danger">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="name">{{ __('Mật khẩu mới') }}</label>
                            <input type="password" value="" name="new_password" class="form-control " placeholder="Mật khẩu mới">
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-4" style="padding: 0;margin-top: 15px;margin-left: 15px;">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Lưu') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
