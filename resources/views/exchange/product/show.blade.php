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
            <a href="{{ route('exchange.home') }}" class="hover:underline">{{'Homepage'}}</a> >
            <a href="" class="hover:underline">{{ $product->categories->name }}</a> >
            <span class="text-gray-800 font-semibold">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
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
                <p class="text-black-700">{{ $product->condition }} • </p>
                <p class="text-black-700">{{ $product->categories->name ?? 'Danh mục khác' }} </p>

                <!-- Giá sản phẩm -->
                <p class="text-red-700 text-3xl font-semibold mt-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>

                <!-- Địa điểm và thời gian cập nhật -->
                <div class="flex items-center text-black-700 text-sm mt-2">
                    <i class="fas fa-map-marker-alt mr-2"></i> {{ $product->location }}
                </div>
                <div class="flex items-center text-black-700 text-sm mt-1">
                    <i class="fas fa-clock mr-2"></i> {{'Updated'}} {{ $product->updated_at->diffForHumans() }}
                </div>

                <!-- Nút liên hệ -->
                <div class="mt-4 flex space-x-2">

                    <a href="#" class="flex-1 text-center bg-green-500 text-white px-4 py-2 rounded-lg text-lg font-semibold hover:bg-green-600">
                        💬 Chat
                    </a>
                </div>

                <!-- Thông tin người bán -->
                <div class="mt-6 p-4 bg-gray-100 rounded-lg flex items-center">
                    <img src="{{ asset($product->users->profile_photo_path ?? 'default-avatar.png') }}" class="w-12 h-12 rounded-full border">
                    <div class="ml-3">
                        <h3 class="font-bold">{{ $product->users->name }}</h3>
                        <p class="text-sm text-gray-500">{{'Feedback'}}: 91% • </p>
                        <p class="text-sm text-gray-400">
                            {{'Active'}}
                        </p>

                    </div>
                </div>

                <!-- Đánh giá -->
                <div class="mt-4 flex items-center">
                    <span class="text-yellow-500 text-xl">⭐ {{ $product->rating }}</span>
                    <a href="#" class="text-blue-500 text-sm ml-2">{{ $product->reviews_count }} {{'Rate'}}</a>
                </div>

                <!-- Câu hỏi liên quan -->
                <div class="mt-4 flex space-x-2">
                    <a href="#" class="flex-1 text-center bg-gray-200 text-black px-4 py-2 rounded-lg text-sm">{{'Does this product come in other colors?'}}</a>
                    <a href="#" class="flex-1 text-center bg-gray-200 text-black px-4 py-2 rounded-lg text-sm">{{'Is this new or used?'}}</a>
                </div>
            </div>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
                <!-- Mô tả chi tiết -->
                <h2 class="text-lg font-semibold mb-2">{{'Detailed description'}}</h2>
                <p class="text-gray-700 mb-2">
                    {!! $product->description !!}
                </p>
                <p href="#" class="text-blue-600 mt-4 font-semibold">{{'Phone: '}}: {{$product->users->phone ?? ""}}</p>

                <!-- Thông số chi tiết -->
                <h2 class="text-lg font-semibold mt-4 mb-2">{{'Detailed specifications'}}</h2>
                <div class="border rounded-lg">
                    <div class="flex p-3 border-b">
                        <span class="text-gray-600">{{'Status'}}: </span>
                        <span class="font-semibold  ml-3">{{$product->condition}}</span>
                    </div>
                    <div class="flex  p-3">
                        <span class="text-gray-600">{{'Category'}}: </span>
                        <span class="font-semibold text ml-3"> {{ $product->categories->name }}</span>
                    </div>
                </div>

                <!-- Đăng bán -->
            <div class="flex items-center justify-between bg-gray-100 p-3 mt-4 rounded-lg">
                <div class="flex items-center gap-2">
                    <!-- Thay ảnh bằng icon camera -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                         class="w-8 h-8 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 7a2 2 0 012-2h2l1-2h6l1 2h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                        <circle cx="12" cy="13" r="3" />
                    </svg>

                    <span class="text-gray-600">{{'Do you have similar products?'}}</span>
                </div>
                <a href="{{route('exchange.productSale')}}" class="text-orange-500 font-semibold"> {{'POST NEW'}}</a>
            </div>

        </div>

        <!-- Sản phẩm liên quan -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">{{'Related products'}}</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($relatedProducts as $related)
                    <div class="border rounded-lg p-2">
                        <a href="{{route('exchange.productDetail', $related['slug'])}}">
                            <img src="{{ asset($related->images) }}" class="w-full rounded">
                            <h3 class="text-sm font-semibold mt-2">{{ $related->name }}</h3>
                            <p class="text-sm text-gray-500 font-semibold mt-2">{{ $product->condition }} </p>
                            <p class="text-red-500 font-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <div class="flex items-center text-gray-500 text-sm mt-2">
                                <p class="text-sm text-gray-500 font-semibold mt-2">{{ $product->location }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        </div>
    </div>
@endsection
<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>
