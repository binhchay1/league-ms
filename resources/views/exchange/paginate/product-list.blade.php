@foreach ($products as $product)
    <div class="bg-white p-6 rounded-lg shadow-md hover:scale-105">
        <a href="{{route('exchange.productDetail', $product['slug'])}}">
            <img src="{{ asset($product->images) }}" class=" w-full object-cover rounded-lg">
            <h4 class="mt-2 font-semibold">{{ $product->name }}</h4>
        </a>
        <p class="text-gray-600">{{ $product->condition }}</p>
        <p class="text-red-500 font-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
        <div class="flex items-center text-gray-500 text-sm mt-2">
            <p class="fas fa-map-marker-alt"> {{ $product->location }}</p>
        </div>
    </div>
@endforeach
