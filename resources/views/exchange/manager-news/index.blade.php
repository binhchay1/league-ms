@extends('layouts.app')
<style>
    .container {
        max-width: 1250px !important;
    }

    /* Class để thay đổi background khi button được click */
    /* Class để thay đổi background khi button được chọn */
    .active-btn {
        background-color: #3b82f6; /* Màu nền khi active */
        color: white; /* Màu chữ khi active */
        border-bottom-color: #3b82f6; /* Thay đổi màu border-bottom nếu cần */
    }

</style>
@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">{{'Manage news'}}</h2>
            <input type="text" placeholder="Tìm tin đăng của bạn..." class="border p-2 rounded w-1/3">
        </div>

        <div class="flex border-b mb-4 status-product">
            <button class="p-2 font-bold border-b-2  status-btn" data-id="accepted">
                SHOWING ({{ $countProductByStatus->accept_count ?? 0 }})
            </button>
            <button class="p-2 font-bold ml-4 border-b-2 border-transparent status-btn" data-id="pending">
                PENDING APPROVAL ({{ $countProductByStatus->pending_count ?? 0 }})
            </button>
            <button class="p-2 font-bold ml-4 border-b-2 border-transparent status-btn" data-id="rejected">
                REJECTED ({{ $countProductByStatus->reject_count ?? 0 }})
            </button>
        </div>

        <div class="container mx-auto p-4">
            <div class="grid grid-cols-1 gap-4">
                @if(count($productNews) > 0)
                @foreach($productNews as $product)
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
                                <a href="{{route('exchange.editNews', $product['slug'])}}">
                                    <button class="px-3 py-1 border border-gray-500 text-gray-500 rounded hover:bg-gray-500 hover:text-white transition">
                                        {{'Edit post'}}
                                    </button>
                                </a>
                                <a>
                                    <button class="openDeleteModal  px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition" data-url="{{ route('product.destroy', $product->id) }}">
                                        {{'Delete post'}}
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
                    @else
                @endif
            </div>
        </div>
    </div>
    <!-- Modal Xác Nhận Xóa -->

    <div id="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-[400px]">
            <!-- Header -->
            <div class="bg-yellow-400 text-white font-semibold text-lg px-4 py-3 rounded-t-lg">
             {{'Delete post'}}
            </div>

            <!-- Nội dung -->
            <div class="p-6">
                <p class="text-gray-800 font-medium">
                {{'When you no longer want the story to appear, select "Delete story".'}}
                </p>

            </div>

            <!-- Footer -->
            <div class="flex justify-between border-t px-6 py-4">
                <button id="cancelDelete" class="px-5 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
                    {{'Cancel'}}
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">
                   {{'Delete'}}
                    </button>
                </form>
            </div>
        </div>
    </div>




@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.status-product button').click(function() {
            let url  = '/manager-news?status='
                + $(this).data('id');
            window.location.href = url;
        });

    });

</script>
<script>
    $(document).ready(function() {
        // Khi một button được click
        $('.status-btn').click(function() {
            // Toggle class 'active-btn' cho button được click
            $(this).toggleClass('active-btn');
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("confirmDeleteModal");
        const cancelBtn = document.getElementById("cancelDelete");
        const deleteForm = document.getElementById("deleteForm");

        document.querySelectorAll(".openDeleteModal").forEach(button => {
            button.addEventListener("click", function () {
                const deleteUrl = this.getAttribute("data-url");
                deleteForm.setAttribute("action", deleteUrl);
                modal.classList.remove("hidden");
            });
        });

        cancelBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
    });
</script>

