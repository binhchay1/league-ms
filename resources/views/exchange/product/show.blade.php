@extends('layouts.app')
<style>
    .container {
        max-width: 1250px !important;
    }
</style>
@section('content')
    <div class="container mx-auto py-6 px-4">
        <!-- Breadcrumb -->
        <div class="text-gray-600 text-sm mb-4">
            <a href="/" class="hover:underline">Trang chủ</a> >
            <a href="#" class="hover:underline">{{ $product->categories->name }}</a> >
            <span class="text-gray-800 font-semibold">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Hình ảnh sản phẩm -->
            <div class="md:col-span-1">
                <img src="{{ asset($product->images) }}" id="mainImage" class="w-full rounded-lg shadow-md">
                <div class="flex space-x-2 mt-2">
                    <img src="{{ asset($product->images) }}" onmouseover="changeMainImage('{{ asset($product->images) }}')" id="mainImage" class="w-16 h-16 object-cover rounded border cursor-pointer">
                    @foreach($product->productImages as $image)
                        <img src="{{ asset($image->image_url) }}" class="w-16 h-16 object-cover rounded border cursor-pointer"
                             onmouseover="changeMainImage('{{ asset($image->image_url) }}')">
                    @endforeach
                </div>
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <!-- Tiêu đề sản phẩm -->
                <h1 class="text-2xl font-bold uppercase">{{ $product->name }}</h1>
                <p class="text-gray-600">{{ $product->condition }} • {{ $product->categories->name ?? 'Danh mục khác' }}</p>

                <!-- Giá sản phẩm -->
                <p class="text-red-500 text-3xl font-semibold mt-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>

                <!-- Địa điểm và thời gian cập nhật -->
                <div class="flex items-center text-gray-500 text-sm mt-2">
                    <i class="fas fa-map-marker-alt mr-2"></i> {{ $product->location }}
                </div>
                <div class="flex items-center text-gray-500 text-sm mt-1">
                    <i class="fas fa-clock mr-2"></i> Cập nhật {{ $product->updated_at->diffForHumans() }}
                </div>

                <!-- Nút liên hệ -->
                <div class="mt-4 flex space-x-2">
                    <a href="tel:{{ $product->phone }}" class="flex-1 text-center bg-gray-200 text-black px-4 py-2 rounded-lg text-lg font-semibold">
                        {{ $product->phone }}
                    </a>
                    <a href="#" class="flex-1 text-center bg-green-500 text-white px-4 py-2 rounded-lg text-lg font-semibold hover:bg-green-600">
                        💬 Chat
                    </a>
                </div>

                <!-- Thông tin người bán -->
                <div class="mt-6 p-4 bg-gray-100 rounded-lg flex items-center">
                    <img src="{{ asset($product->seller_avatar ?? 'default-avatar.png') }}" class="w-12 h-12 rounded-full border">
                    <div class="ml-3">
                        <h3 class="font-bold">{{ $product->seller_name }}</h3>
                        <p class="text-sm text-gray-500">Phản hồi: 91% • {{ $product->seller_sales }} đã bán</p>
                        <p class="text-sm text-gray-400">
                            Hoạt động
                            {{ $product->seller_last_active ? $product->seller_last_active->diffForHumans() : 'Không xác định' }}
                        </p>

                    </div>
                </div>

                <!-- Đánh giá -->
                <div class="mt-4 flex items-center">
                    <span class="text-yellow-500 text-xl">⭐ {{ $product->rating }}</span>
                    <a href="#" class="text-blue-500 text-sm ml-2">{{ $product->reviews_count }} đánh giá</a>
                </div>

                <!-- Câu hỏi liên quan -->
                <div class="mt-4 flex space-x-2">
                    <a href="#" class="flex-1 text-center bg-gray-200 text-black px-4 py-2 rounded-lg text-sm">Sản phẩm này có màu khác không?</a>
                    <a href="#" class="flex-1 text-center bg-gray-200 text-black px-4 py-2 rounded-lg text-sm">Đây là sản phẩm mới hay cũ?</a>
                </div>
            </div>

        </div>

        <!-- Mô tả sản phẩm -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-2">Mô tả sản phẩm</h2>
            <p class="text-gray-700">{{ $product->description }}</p>
        </div>

        <!-- Sản phẩm liên quan -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Sản phẩm tương tự</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($relatedProducts as $related)
                    <div class="border rounded-lg p-2">
                        <a href="{{route('exchange.productDetail', $related['slug'])}}">
                            <img src="{{ asset($related->images) }}" class="w-full rounded">
                            <h3 class="text-sm font-semibold mt-2">{{ $related->name }}</h3>
                            <p class="text-red-500 font-bold">{{ number_format($related->price, 0, ',', '.') }} VNĐ</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

{{--        <!-- Bình luận -->--}}
{{--        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">--}}
{{--            <h2 class="text-xl font-bold mb-4">Bình luận</h2>--}}
{{--            @foreach($product->comments as $comment)--}}
{{--                <div class="border-b py-2">--}}
{{--                    <p class="font-semibold">{{ $comment->user->name }}</p>--}}
{{--                    <p class="text-gray-600">{{ $comment->content }}</p>--}}
{{--                </div>--}}
{{--        @endforeach--}}

        <!-- Form bình luận -->

        </div>
    </div>
@endsection
<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>
