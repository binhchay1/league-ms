@extends('layouts.app')
<style>
    .container {
        max-width: 1250px !important;
    }
</style>
@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Quản lý tin đăng</h2>
            <input type="text" placeholder="Tìm tin đăng của bạn..." class="border p-2 rounded w-1/3">
        </div>

        <div class="flex border-b mb-4">
            <button class="p-2 border-b-2 border-blue-500">ĐANG HIỂN THỊ (1)</button>
            <button class="p-2 ml-4">HẾT HẠN (0)</button>
            <button class="p-2 ml-4">BỊ TỪ CHỐI (0)</button>
            <button class="p-2 ml-4">CẦN THANH TOÁN (0)</button>
            <button class="p-2 ml-4">TIN NHÁP (0)</button>
            <button class="p-2 ml-4">CHỜ DUYỆT (0)</button>
            <button class="p-2 ml-4">ĐÃ ẨN (0)</button>
        </div>

        <div class="border p-4 rounded-lg flex gap-4">
            @foreach($productNews as $product)
            <img src="{{asset($product->images)}}" class="w-32 h-32 object-cover rounded" />
            <div class="flex-1">
                <h3 class="text-lg font-bold">{{$product->title}}</h3>
                <p class="text-red-500 font-bold">{{$product->price}} đ</p>
                <p>{{$product->location}}</p>
                <p>Ngày đăng tin: {{$product->start_date}}</p>
                <p>Ngày hết hạn: {{$product->expires_at}}</p>
                <div class="flex gap-2 mt-2">
                    <button class="border p-2 rounded">Gia hạn tin</button>
                    <button class="border p-2 rounded">Sửa tin</button>
                    <button class="border p-2 rounded">Đẩy tin</button>
                    <button class="bg-green-500 text-white p-2 rounded">Bán nhanh hơn</button>
                </div>
            </div>
                @endforeach
        </div>
    </div>
@endsection

