<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chợ Cầu Lông')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
@if(session('success'))
    <div id="alert-success"
         class="fixed top-5 right-5 bg-green-500 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-md transition-opacity duration-300">
        {{ session('success') }}
    </div>

@endif
<header class="bg-gray-800 py-2 shadow-md">
    <div class="mx-auto flex items-center justify-between px-4">
        <!-- Logo + Danh mục -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('exchange.home') }}" class="text-2xl font-bold text-white">Badminton Exchange</a>

            <!-- Danh mục (Dropdown) -->
            <div class="relative">
                <!-- Nút Danh mục -->
                <button id="category-btn"
                        class="px-4 py-2 bg-yellow-500 text-white font-bold rounded flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    {{'CATEGORY'}}
                </button>

                <!-- Dropdown menu -->
                <div id="category-menu"
                     class="absolute left-0 mt-2 w-64 bg-white shadow-lg rounded-lg z-50 hidden">
                    @foreach ($categories as $category)
                        <a href="{{ route('exchange.categoryDetail', $category['slug']) }}"
                           class="block px-4 py-3 text-gray-700 hover:bg-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16"></path>
                            </svg>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Thanh tìm kiếm -->
        <form action="{{ route('products.search') }}" method="GET"
              class=" w-full max-w-md flex items-center space-x-4 mt-2">
            <div class="flex items-center bg-white rounded-lg overflow-hidden ">
                <input type="text" name="q" placeholder="{{'Search product...'}}"
                       class="w-full px-4 py-2 outline-none">
                <button class="px-4 text-white">🔍</button>
            </div>
        </form>


        <!-- Tiện ích & User -->
        <div class="flex items-center space-x-4 text-white">
            <!-- Nút Thông Báo -->
            <button id="notification-btn" class="relative bg-gray-200 p-2 rounded-full">
                🔔
                <span id="notification-count"
                      class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-2 rounded-full hidden">
                0
                </span>
            </button>

            <!-- Danh sách Thông Báo -->
            <div id="notification-list"
                 class="absolute right-5 mt-2 w-80 bg-white shadow-lg border rounded-lg p-3 hidden">
                <p class="text-sm text-gray-500">Không có thông báo mới</p>
            </div>

            <button>🛍️</button>
            <a href="{{route('exchange.managerNews')}}">
                <button>📋 {{'Manager news'}}</button>

            </a>

            @auth
                <div class="flex items-center space-x-2">
                    <img src="{{ asset( Auth::user()->profile_photo_path ?? '/images/no-image.png') }}"
                         class="w-8 h-8 rounded-full border">
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('exchange.productSale') }}"
                   class="bg-orange-600 text-white px-4 py-2 rounded-lg font-bold">
                    + {{'POST NEW'}}
                </a>
            @else
                <li><a href="{{ route('login') }}" class="button white ">{{ __('Log In') }}</a></li>
                <li><a href="{{ route('register_user') }}" class="button btn-register">{{ __('Register') }}</a></li>
        @endif

        <!-- Nút Đăng Tin -->

        </div>
    </div>
</header>

<div class="">
    @yield('content')
</div>

</body>
<footer class="bg-gray-800 text-white mt-10">
    <div class="container mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Cột 1: Logo & Giới thiệu -->
        <div>
            <h2 class="text-2xl font-bold text-white-400">{{'Badminton Market'}}</h2>
            <p class="mt-2 text-gray-400">{{'Badminton.io, the largest badminton trading and buying platform in Vietnam. A place to connect badminton enthusiasts.'}}</p>
        </div>

        <!-- Cột 2: Liên kết -->
        <div>
            <h3 class="text-lg font-semibold text-white-400">{{'Link'}}</h3>
            <ul class="mt-2 space-y-2 text-gray-400">
                <li><a href="{{route('exchange.home')}}" class="hover:text-yellow-300">{{'Homepage'}}</a></li>
                <li><a href="{{route('exchange.home')}}" class="hover:text-yellow-300">{{'Product'}}</a></li>
                <li><a href="#" class="hover:text-yellow-300">{{'News'}}</a></li>
            </ul>
        </div>

        <!-- Cột 3: Liên hệ -->
        <div>
            <h3 class="text-lg font-semibold text-white-400">{{'Contact'}}</h3>
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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryBtn = document.getElementById("category-btn");
        const categoryMenu = document.getElementById("category-menu");

        // Toggle menu khi click vào nút danh mục
        categoryBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // Ngăn không cho sự kiện lan ra ngoài
            categoryMenu.classList.toggle("hidden");
        });

        // Ẩn menu khi click ra ngoài
        document.addEventListener("click", function (event) {
            if (!categoryBtn.contains(event.target) && !categoryMenu.contains(event.target)) {
                categoryMenu.classList.add("hidden");
            }
        });
    });
</script>

<script>
    setTimeout(() => {
        let alertBox = document.getElementById('alert-success');
        if (alertBox) {
            alertBox.classList.add('opacity-0');
            setTimeout(() => alertBox.remove(), 500);
        }
    }, 3000);
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Kết nối Pusher
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            encrypted: true
        });

        var notificationCount = 0;
        var notificationBtn = document.getElementById("notification-btn");
        var notificationCountEl = document.getElementById("notification-count");
        var notificationList = document.getElementById("notification-list");

        // Lắng nghe sự kiện 'product.accepted'
        var channel = pusher.subscribe('product-accepted');
        channel.bind('product.accepted', function (data) {
            notificationCount++;
            notificationCountEl.textContent = notificationCount;
            notificationCountEl.classList.remove("hidden");

            // Thêm thông báo vào danh sách
            var notificationItem = document.createElement("div");
            notificationItem.className = "p-2 border-b text-sm";
            notificationItem.innerHTML = `
                <p class="font-bold">${data.product.name}</p>
                <p class="text-gray-500 text-xs">đã được duyệt</p>
            `;
            notificationList.prepend(notificationItem);
        });

        // Xử lý khi click vào nút 🔔
        notificationBtn.addEventListener("click", function () {
            notificationList.classList.toggle("hidden");
            notificationCount = 0;
            notificationCountEl.classList.add("hidden");
        });
    });
</script>

