@extends('layouts.admin')

@section('title', 'Cập nhật mật khẩu')

@section('content')
    <div class="container mt-4">
        <h2>Cập nhật mật khẩu cho: {{ $user->name }}</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.updatePassword', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Nhập lại mật khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </form>
    </div>
@endsection
