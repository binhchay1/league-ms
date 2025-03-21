@if(isset($productNews))
    @foreach(products as $product)
        <div class="bg-white p-4 rounded-lg shadow-md flex gap-4 items-center">
            <!-- Ảnh sản phẩm -->
            <img src="{{ asset($product->images) }}" class="w-24 h-24 object-cover rounded-md border">

            <!-- Thông tin sản phẩm -->
            <div class="flex-1">
                <a href="{{route('exchange.productDetail', $product['slug'])}}">
                    <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                </a>
                <p class="text-red-500 font-semibold">{{ number_format($product->price) }} đ</p>
                <p class="text-gray-600"><i class="bi bi-geo-alt"></i> {{ $product->location }}</p>
                <p class="text-gray-500">🗓️ {{'Posting Date'}}: {{ $product->start_date }}</p>
                <p class="text-gray-500">⏳ {{'Expiration Date'}}: {{ $product->expires_at }}</p>

                <!-- Nút thao tác -->
                <div class="flex gap-2 mt-2">
                    <a>
                        <button class="px-3 py-1 border border-gray-500 text-gray-500 rounded hover:bg-gray-500 hover:text-white transition">
                            {{'Edit post'}}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
@endif
