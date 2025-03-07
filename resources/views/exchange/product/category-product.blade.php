@extends('layouts.app')
<style>
    .widget-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        border-top: 4px solid #1f2937;
    }

    .widget-title a {
        color: #333;
        text-transform: uppercase;
        font-size: 18px;
        font-weight: 700;
    }
</style>
@section('content')
    <div>
        <img class=" relative w-full  bg-cover bg-center flex items-center justify-center text-white" src="{{ asset('images/exchange/banner.jpg') }}">
    </div>
    <div class="container mx-auto px-4">
        <!-- Thanh tìm kiếm -->
        <!-- Danh mục sản phẩm -->
        <div class="widget-header">
            <h2 class="widget-title">
                <a href="" title="Áo thể thao"> {{'Category'}} </a></h2>
        </div>
        <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
            @foreach($categories as $category)
                <a href="{{route('exchange.categoryDetail', $category['slug'])}}" class="bg-white p-4 rounded-lg shadow-md">
                    <img src="{{asset($category->image)}}" class="mx-auto w-16">
                    <p class="mt-2 font-bold">{{$category->name}}</p>
                </a>
            @endforeach
        </div>

        <!-- Sản phẩm nổi bật -->
        <div class="widget-header mt-4">
            <h2 class="widget-title">
                <a href="https://shop.myleague.vn/ao-the-thao.html" title="Áo thể thao">{{'New Products'}} </a></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @if(count($categoryProduct->products) > 0)
            @foreach ($categoryProduct->products as $product)
                <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105">
                    <a href="{{route('exchange.productDetail', $product['slug'])}}">
                        <img src="{{ asset($product->images) }}" class=" w-full  object-cover rounded-lg">
                        <h4 class="mt-2 font-semibold">{{ $product->name }}</h4>
                    </a>
                    <p class="text-gray-600">{{ $product->condition }} • {{ $product->status  }}</p>
                    <p class="text-red-500 font-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <div class="flex items-center text-gray-500 text-sm mt-2">
                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $product->location }}
                    </div>
                </div>
            @endforeach
                @else
                    <div class="text-center">
                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">
                        <h4 >{{ __('No products found') }}</h4>
                    </div>
                @endif
        </div>
    </div>
@endsection
