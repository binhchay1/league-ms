@extends('layouts.app')
@section('content')
    <div>
        <img class=" relative w-full  bg-cover bg-center flex items-center justify-center text-white" src="{{ asset('images/exchange/banner.jpg') }}">
    </div>
    <div class="container mx-auto px-4 mt-4">
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            @if(count($products) > 0)
                @foreach ($products as $product)
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
                    <h4 >{{ __('No products found!') }}</h4>
                </div>
            @endif
        </div>
    </div>
@endsection
