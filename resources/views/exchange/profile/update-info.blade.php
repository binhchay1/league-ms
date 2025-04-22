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
        <form class="md:col-span-3 bg-white rounded shadow p-6 space-y-6" method="POST" action="{{ route('exchange.update', $dataUser['id']) }}" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold">Hồ sơ cá nhân</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Họ và tên </label>
                    <input type="text" name="name" value="{{ $dataUser->name }}" class="w-full border rounded px-3 py-2" />
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div>
                    <label class="block font-medium mb-1">Số điện thoại </label>
                    <input type="text" name="phone" value="{{ old('phone', $dataUser->phone) }}" class="w-full border rounded px-3 py-2" />
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="md:col-span-2">
                    <label class="block font-medium mb-1">Địa chỉ</label>
                    <input type="text" name="address" value="{{ old('address', $dataUser->address) }}" class="w-full border rounded px-3 py-2" />
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" value="tranthuy240814@gmail.com" class="w-full border rounded px-3 py-2 bg-gray-100" disabled />
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <div>
                        <label class="block font-medium mb-1">Ngày, tháng, năm sinh</label>
                        <input type="date" name="age" value="{{ old('age', $dataUser->age) }}" class="w-full border rounded px-3 py-2" />
                        @if ($errors->has('age'))
                            <span class="text-danger">{{ $errors->first('age') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-yellow-400 text-white px-6 py-2 rounded hover:bg-yellow-500 transition">Lưu thay đổi</button>
            </div>
        </form>
    </div>

    </body>
    </html>

@endsection
