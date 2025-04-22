@extends('layouts.app')
<!-- Summernote CSS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@section('content')
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hồ sơ cá nhân</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 text-sm text-gray-800">

    <div class="max-w-6xl mx-auto p-4 mt-6 grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <aside class="bg-white rounded shadow p-4">
            <ul class="space-y-4 font-medium">
                <li><a href="{{route('exchange.profile')}}" class="text-yellow-500">Thông tin cá nhân</a></li>
                <li><a href="{{route('exchange.changePassword')}}">Cài đặt tài khoản</a></li>
            </ul>
        </aside>

        <!-- Form chính -->
            <form action="{{ route('update-password') }}" method="POST" class="md:col-span-3 bg-white rounded shadow p-6 space-y-6" >
                @csrf
                <h2 class="text-xl font-semibold">Hồ sơ cá nhân</h2>
                @if (session('status'))
                    <div class="mb-4 text-green-600 text-base font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="oldPasswordInput" class="block text-black-700 font-semibold mb-1">Mật khẩu cũ</label>
                    <input name="old_password" type="password" id="oldPasswordInput"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('old_password') border-red-500 @enderror">
                    @error('old_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    @if(session('error'))
                        <div class="text-red-500 text-sm mt-2">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="newPasswordInput" class="block text-black-700 font-semibold mb-1">Mật khẩu mới</label>
                    <input name="new_password" type="password" id="newPasswordInput"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('new_password') border-red-500 @enderror">
                    @error('new_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="confirmNewPasswordInput" class="block text-black-700 font-semibold mb-1">Xác nhận mật khẩu mới</label>
                    <input name="new_password_confirmation" type="password" id="confirmNewPasswordInput"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="text-right">
                    <button type="submit"
                            class="bg-yellow-400 text-white px-6 py-2 rounded hover:bg-yellow-500 transition">
                        Lưu thay đổi
                    </button>
                </div>
            </form>

    </div>

    </body>
    </html>

@endsection
