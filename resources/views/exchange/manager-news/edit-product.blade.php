@extends('layouts.app')
<!-- Summernote CSS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow mt-4">
        <h2 class="text-xl font-bold mb-4">{{'New Post Product'}}</h2>

        <form id="" method="POST" action="{{ route('exchange.updateNews', $product['slug']) }}"
              enctype="multipart/form-data">
            @csrf()
            {{-- Ảnh Chính --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="border p-4 rounded-lg">
                    <label class="block font-medium">{{'Main Image'}}</label>
                    <input type="file" name="images" class="w-full p-2" id="mainImageInput">
                    <div class="mt-2">
                        <img id="mainImagePreview" src="{{ asset($product->images ?? '/images/logo-no-background.png') }}" class="w-32 h-32 object-cover {{ $product->images ? '' : 'hidden' }}" />
                    </div>
                </div>

                {{-- Ảnh Phụ --}}
                <div class=" p-4 rounded-lg">
                    <label class="block font-medium">{{'Sub Image'}}</label>
                    <input type="file" name="sub_images[]" multiple class="w-full p-2" id="subImagesInput">
                    <div class="mt-2 flex gap-2" id="subImagesPreview">

                        @foreach($product->productImages ?? [] as $image)
                            <img src="{{ asset($image->image_url) }}" class="w-20 h-20 object-cover rounded border">
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- Chọn danh mục --}}
            <div class="mt-4">
                <label class="block font-semibold">{{'Category'}}</label>
                <select name="category" class="w-full border px-3 py-2 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category== $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Thông tin chi tiết --}}
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">{{'Condition'}}</label>
                    <div class="flex gap-4">
                        <label><input type="radio" name="condition" value="new" {{ $product->condition == 'new' ? 'checked' : '' }}> New</label>
                        <label><input type="radio" name="condition" value="used" {{ $product->condition == 'used' ? 'checked' : '' }}> Used</label>
                    </div>
                </div>
            </div>

            {{-- Giá bán --}}
            <div class="mt-4">
                <label class="block font-semibold">{{'Price'}}</label>
                <input type="number" name="price" class="w-full border px-3 py-2 rounded" value="{{ old('price', $product->price) }}" required>
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tiêu đề & mô tả --}}
            <div class="mt-4">
                <label class="block font-semibold">{{'Title'}}</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $product->name) }}" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label class="block font-semibold">{{"Description"}}</label>
                <textarea id="editor" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Chọn địa chỉ --}}
            <div class="mt-4">
                <label class="block font-semibold">{{'Address'}}</label>
                <button type="button" id="open-popup" class="w-full border px-3 py-2 rounded bg-gray-100">
                    {{'Select Address'}}
                </button>
                <input type="hidden" name="location" id="location" {{$product->location}}>
                @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="text-black-600 mt-2" id="selected-location">{{$product->location}}</div>
            </div>
            <div id="address-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded shadow-lg w-96">
                    <h3 class="text-lg font-semibold mb-4">  {{'Select Address'}}</h3>

                    <label class="block font-semibold">{{'Province, city'}}</label>
                    <select id="province" class="w-full border px-3 py-2 rounded mb-2"></select>

                    <label class="block font-semibold">{{'District, county, town'}}</label>
                    <select id="district" class="w-full border px-3 py-2 rounded mb-2">
                        <option value="">{{'Choose District, county, town'}}</option>
                    </select>

                    <label class="block font-semibold">{{'Ward, commune, town'}}</label>
                    <select id="ward" class="w-full border px-3 py-2 rounded mb-2">
                        <option value="">{{'Choose Ward, commune, town'}}</option>
                    </select>

                    <label class="block font-semibold">{{'Specific address'}}</label>
                    <input type="text" id="street" class="w-full border px-3 py-2 rounded mb-4" placeholder="">

                    <button type="button" id="confirm-address" class="bg-orange-600 text-white px-6 py-2 rounded w-full">
                        {{'Address Confirmation'}}
                    </button>
                    <button type="button" id="close-popup" class="mt-2 w-full text-center text-red-600">{{'Candle'}}</button>
                </div>
            </div>

            {{-- Nút cập nhật --}}
            <div class="mt-6 flex justify-between">
                <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded">{{'Update'}}</button>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const provinceSelect = document.getElementById("province");
            const districtSelect = document.getElementById("district");
            const wardSelect = document.getElementById("ward");
            const addressPopup = document.getElementById("address-popup");
            const openPopupBtn = document.getElementById("open-popup");
            const closePopupBtn = document.getElementById("close-popup");
            const confirmBtn = document.getElementById("confirm-address");
            const selectedLocation = document.getElementById("selected-location");
            const inputLocation = document.getElementById("location");
            const streetInput = document.getElementById("street");

            // Mở popup
            openPopupBtn.addEventListener("click", function () {
                addressPopup.style.display = "flex";
            });

            // Đóng popup
            closePopupBtn.addEventListener("click", function () {
                addressPopup.style.display = "none";
            });

            // Lấy danh sách tỉnh/thành
            fetch("https://provinces.open-api.vn/api/p/")
                .then(response => response.json())
                .then(data => {
                    data.forEach(province => {
                        let option = new Option(province.name, province.code);
                        provinceSelect.add(option);
                    });
                });

            // Khi chọn tỉnh, load danh sách huyện
            provinceSelect.addEventListener("change", function () {
                districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                if (!this.value) return;

                fetch(`https://provinces.open-api.vn/api/p/${this.value}?depth=2`)
                    .then(response => response.json())
                    .then(data => {
                        data.districts.forEach(district => {
                            let option = new Option(district.name, district.code);
                            districtSelect.add(option);
                        });
                    });
            });

            // Khi chọn huyện, load danh sách xã
            districtSelect.addEventListener("change", function () {
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                if (!this.value) return;

                fetch(`https://provinces.open-api.vn/api/d/${this.value}?depth=2`)
                    .then(response => response.json())
                    .then(data => {
                        data.wards.forEach(ward => {
                            let option = new Option(ward.name, ward.code);
                            wardSelect.add(option);
                        });
                    });
            });

            // Xác nhận địa chỉ
            confirmBtn.addEventListener("click", function () {
                let province = provinceSelect.selectedOptions[0].text;
                let district = districtSelect.selectedOptions[0].text;
                let ward = wardSelect.selectedOptions[0].text;
                let street = streetInput.value;

                let fullAddress = `${street}, ${ward}, ${district}, ${province}`;
                selectedLocation.textContent = fullAddress;
                inputLocation.value = fullAddress;

                addressPopup.style.display = "none";
            });
        });

    </script>
    <script>
        document.getElementById('mainImageInput').addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.getElementById('mainImagePreview');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('subImagesInput').addEventListener('change', function(event) {
            let files = event.target.files;
            let previewContainer = document.getElementById('subImagesPreview');
            previewContainer.innerHTML = ''; // Clear previous previews

            for (let file of files) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-20', 'h-20', 'object-cover', 'rounded', 'border');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>


<script>
    $(document).ready(function() {
        $('#editor').summernote({
            placeholder: 'Content...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection
