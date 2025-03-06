@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Thanh tìm kiếm -->
        <!-- Danh mục sản phẩm -->
        <h4 class="text-2xl font-semibold mt-6 mb-4">{{'Category'}}</h4>
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            @foreach($categories as $category)
                <a href="#" class="bg-white p-4 rounded-lg shadow-md">
                    <img src="/images/racket.png" class="mx-auto w-16">
                    <p class="mt-2 font-bold">{{$category->name}}</p>
                </a>
            @endforeach
        </div>

        <!-- Sản phẩm nổi bật -->
        <h4 class="text-2xl font-semibold mt-6 mb-4">{{'New Products'}}</h4>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach ($products as $product)
                <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105">
                    <img src="{{ asset($product->images) }}" class=" w-full  object-cover rounded-lg">
                    <h4 class="mt-2 font-semibold">{{ $product->name }}</h4>
                    <p class="text-gray-600">{{ $product->condition }} • {{ $product->status  }}</p>
                    <p class="text-red-500 font-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <div class="flex items-center text-gray-500 text-sm mt-2">
                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $product->location }}
                    </div>
                    <a href="{{route('exchange.productDetail', $product['slug'])}}" class="block text-center bg-green-500 text-white py-2 rounded-lg mt-2">{{'Detail'}}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
