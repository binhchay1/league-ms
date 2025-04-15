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
                <a href="https://shop.myleague.vn/ao-the-thao.html" title="Áo thể thao"> {{'Category'}} </a></h2>
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
                <a href="#" title="Sản phẩm mới">{{ 'New Products ' }}</a>
            </h2>
        </div>

        <div id="product-container" class="grid grid-cols-2 md:grid-cols-6 gap-4 mt-4">
            @include('exchange.paginate.product-list', ['products' => $products])
        </div>

        <!-- Nút Load More -->
        @if(!empty($products))
        <div class="text-center mt-4">
            <button id="loadMoreBtn" class="bg-blue-500 text-white p-2 rounded-lg">{{'Load more'}}</button>
        </div>
        @endif
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let currentPage = 1;

        $('#loadMoreBtn').on('click', function () {
            currentPage++;

            $.ajax({
                url: "{{ route('exchange.loadMore') }}",
                type: "GET",
                data: { page: currentPage },
                beforeSend: function() {
                    $('#loadMoreBtn').text('Loading...'); // Hiển thị trạng thái loading
                },
                success: function (response) {
                    if (response.products.trim() === '') {
                        $('#loadMoreBtn').hide(); // Ẩn nút nếu không còn sản phẩm
                    } else {
                        $('#product-container').append(response.products);
                        $('#loadMoreBtn').text('Load more'); // Khôi phục lại trạng thái nút
                    }
                },
                error: function () {
                    alert('Error to update data!');
                    $('#loadMoreBtn').text('Load more'); // Khôi phục lại nếu lỗi
                }
            });
        });
    });
</script>

