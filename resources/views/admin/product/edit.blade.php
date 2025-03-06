@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Edit Product') }}
@endsection
<style>
    img {
        width: 180px;
        margin-left: 40px;
        height: 200px;
    }
</style>
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
          integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="summernote-bs5.css" rel="stylesheet">
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <!-- Include Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

    <!-- Include jQuery (Summernote depends on it) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

@endsection
@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5>{{ __('Edit Product') }}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('product.update', $dataProduct['id']) }}"
                      enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-4">
                            <label class="block font-medium">Ảnh Chính</label>
                            <input type="file" name="images" class="w-full  p-2 " id="mainImageInput">
                            <div class="mt-2">
                                <img id="mainImagePreview"
                                     src="{{ asset($dataProduct->images) }}"
                                     class="w-32 h-32 object-cover rounded border {{ $dataProduct->images ? '' : 'hidden' }}"/>
                            </div>
                            @if ($errors->has('images'))
                                <span class="text-danger">{{ $errors->first('images') }}</span>
                            @endif
                        </div>

                        <div class="col-4">
                            <label class="block font-medium">Ảnh Phụ (Có thể chọn nhiều)</label>
                            <input type="file" name="Product_images[]" multiple class="w-full border p-2 rounded"
                                   id="subImagesInput">
                            <div class="mt-2 flex gap-2" id="subImagesPreview">
                                @foreach ($dataProduct->productImages as $image)
                                    <div  data-id="{{ $image->id }}">
                                        <img src="{{ asset($image->image_url) }}" class="w-20 h-20 object-cover rounded border">
                                            <button type="button"
                                                    class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full text-xs remove-image"
                                                    data-id="{{ $image->id }}">✖
                                            </button>
                                    </div>
                                    @endforeach
                                  </div>
                            @if ($errors->has('Product_images'))
                                <span class="text-danger">{{ $errors->first('Product_images') }}</span>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input class="form-control"
                                           value="{{ $dataProduct->name ? $dataProduct->name : old('name') }}"
                                           type="text" name="name" id="name"/>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-4">
                                    <label for="lastName" class="form-label">{{__('Category')}}</label>
                                    <select id="category" value="{{ old('category_id') }}" name="category"
                                            class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger">
                                        @foreach($listCategory as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($category->category_id == $category->id) selected @endif>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="price" class="form-label">{{ __('Price') }}</label>
                                        <input type="number"
                                               value="{{ $dataProduct->price ? $dataProduct->price : old('price') }}"
                                               class="form-control" id="price" name="price"/>
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-4 mt-4">
                                    <label for="lastName" class="form-label">{{__('Status')}}</label>
                                    <select id="category" value="{{ old('status') }}" name="status"
                                            class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger">
                                        @foreach($status as $key => $value)
                                            <option id="format_of_league"
                                                    value="{{ $value }}" {{$value == $dataProduct->status ? 'selected' : ''}}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="lastName" class="form-label">{{__('Description')}}</label>
                                    <textarea id="summernote" name="description">{!! $dataProduct->description !!}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success me-2">{{ __('Save') }}</button>
                        <button type="reset" class="btn btn-outline-secondary">{{ __('Reset') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
          integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/admin/league.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/eventImage.js') }}"></script>
    <script>
        document.getElementById('category').addEventListener('change', function () {
            let categoryId = this.value;
            let brandSelect = document.getElementById('brand');

            // Xóa các option cũ
            brandSelect.innerHTML = '<option value="">-- Chọn thương hiệu --</option>';

            if (categoryId) {
                fetch(`/get-brands/${categoryId}`)// Gọi API lấy brand
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(brand => {
                            let option = document.createElement('option');
                            option.value = brand.id;
                            option.textContent = brand.name;
                            brandSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Lỗi khi lấy danh sách brand:', error));
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="{{ asset('js/eventImage.js') }}"></script>
    <!-- include summernote css/js-->
    <script src="{{ asset('summernote/jquery.min.js') }}"></script>
    <!-- Include Summernote JS -->
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                placeholder: 'Write your content here...',
                tabsize: 2,
                height: 600
            });
        });
    </script>

    <script>
        document.getElementById('mainImageInput').addEventListener('change', function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = document.getElementById('mainImagePreview');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('subImagesInput').addEventListener('change', function (event) {
            let previewContainer = document.getElementById('subImagesPreview');
            previewContainer.innerHTML = ''; // Xóa ảnh cũ khi chọn lại

            let files = event.target.files;
            if (files.length > 5) { // Giới hạn tối đa 5 ảnh
                alert('Bạn chỉ được chọn tối đa 5 ảnh phụ!');
                return;
            }

            for (let i = 0; i < files.length; i++) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-16', 'h-16', 'object-cover', 'rounded', 'border');

                    // Thêm nút xóa ảnh
                    let removeBtn = document.createElement('button');
                    removeBtn.textContent = '❌';
                    removeBtn.classList.add('text-red-500', 'ml-1', 'text-xs');
                    removeBtn.onclick = function () {
                        img.remove();
                        removeBtn.remove();
                    };

                    let div = document.createElement('div');
                    div.classList.add('relative');
                    div.appendChild(img);
                    div.appendChild(removeBtn);

                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        });

        $(document).on('click', '.remove-image', function () {
            let imageId = $(this).data('id');
            let parentDiv = $(this).closest('div');

            $.ajax({
                url: '/delete-product-image/' + imageId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.success) {
                        parentDiv.remove(); // Xóa ảnh khỏi giao diện
                    }
                }
            });
        });

    </script>


@endsection
