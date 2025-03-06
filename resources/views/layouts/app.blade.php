<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chợ Cầu Lông')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<header class="bg-gray-800 py-2 shadow-md">
    <div class=" mx-auto flex items-center justify-between px-4">
        <!-- Logo + Danh mục -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('exchange.home') }}" class="text-2xl font-bold text-white">Badminton Exchange</a>
            <button class="flex items-center space-x-2 text-white font-semibold">
                ☰ <span>Danh mục</span>
            </button>
        </div>

        <!-- Thanh tìm kiếm -->
        <div class="flex items-center bg-white rounded-lg overflow-hidden w-1/2">
            <input type="text" placeholder="Tìm kiếm sản phẩm trên Chợ Cầu Lông..."
                   class="w-full px-4 py-2 outline-none">
            <button class="px-4  text-white">🔍</button>
        </div>

        <!-- Tiện ích & User -->
        <div class="flex items-center space-x-4 text-white">
            <button>🔔</button>
            <button>🛍️</button>
            <button>📋 Quản lý tin</button>

            @auth
                <div class="flex items-center space-x-2">
                    <img src="{{ asset(Auth::user()->avatar ?? 'default-avatar.png') }}"
                         class="w-8 h-8 rounded-full border">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-white">{{'Login'}}</a>
        @endauth

        <!-- Nút Đăng Tin -->
            <a href="{{ route('post.create') }}"
               class="bg-orange-600 text-white px-4 py-2 rounded-lg font-bold">
                + Đăng tin
            </a>
        </div>
    </div>
</header>



<div class="py-6">
    @yield('content')
</div>

</body>
<footer class="bg-gray-800 text-white mt-10">
    <div class="container mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Cột 1: Logo & Giới thiệu -->
        <div>
            <h2 class="text-2xl font-bold text-yellow-400">{{'Badminton Market'}}</h2>
            <p class="mt-2 text-gray-400">{{'Badminton.io, the largest badminton trading and buying platform in Vietnam. A place to connect badminton enthusiasts.'}}</p>
        </div>

        <!-- Cột 2: Liên kết -->
        <div>
            <h3 class="text-lg font-semibold text-yellow-400">Liên kết nhanh</h3>
            <ul class="mt-2 space-y-2 text-gray-400">
                <li><a href="" class="hover:text-yellow-300">{{'Homepage'}}</a></li>
                <li><a href="" class="hover:text-yellow-300">{{'Product'}}</a></li>
                <li><a href="#" class="hover:text-yellow-300">{{'News'}}</a></li>
            </ul>
        </div>

        <!-- Cột 3: Liên hệ -->
        <div>
            <h3 class="text-lg font-semibold text-yellow-400">{{'COntact'}}</h3>
            <p class="mt-2 text-gray-400">Email: support@chocaulong.vn</p>
            <p class="text-gray-400">Hotline: 0123 456 789</p>
            <div class="mt-4 flex space-x-4">
                <a href="#" class="text-gray-400 hover:text-yellow-300"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-gray-400 hover:text-yellow-300"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="text-gray-400 hover:text-yellow-300"><i class="fab fa-youtube fa-2x"></i></a>
            </div>
        </div>
    </div>

    <!-- Bản quyền -->
    <div class="border-t border-gray-700 text-center py-4 text-gray-500">
        {{'&copy; 2025 Badminton Market. All rights reserved.'}}
    </div>
</footer>

</html>
