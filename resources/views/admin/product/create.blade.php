@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create Product') }}
@endsection
<style>
     img{
         width: 180px;
         margin-left: 40px;
         height: 200px;
    }
</style>
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="summernote-bs5.css" rel="stylesheet">
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <!-- Include Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

    <!-- Include jQuery (Summernote depends on it) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

@endsection
<!-- Include Summernote JS -->
@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Create Product') }}</h5>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <!-- Ảnh Chính -->
                    <div class="col-4">
                        <label class="block font-medium">Ảnh Chính</label>
                        <input type="file" name="images" class="w-full  p-2" id="mainImageInput">

                        <div class="mt-2">
                            <img id="mainImagePreview" src="{{asset( '/images/logo-no-background.png')}}" class="hidden w-32 h-32 object-cover  " />
                        </div>
                        @if ($errors->has('images'))
                            <span class="text-danger">{{ $errors->first('images') }}</span>
                        @endif
                    </div>

                    <!-- Ảnh Phụ -->
                    <div class="col-4">
                        <label class="block font-medium">Ảnh Phụ (Có thể chọn nhiều)</label>
                        <input type="file" name="product_images[]" multiple class="w-full  p-2 " id="subImagesInput" >
                        <!-- Hiển thị lỗi validate -->
                        @if ($errors->has('product_images.*'))
                            <span class="text-red-500">{{ $errors->first('product_images.*') }}</span>
                        @endif
                        <div class="mt-2 flex gap-2" id="subImagesPreview"></div>

                    </div>

                    <div class="col-md-10">
                        <div class="row mt-4">
                            <div class="col-4">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="name" />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">{{__('Category')}}</label>
                                        <select id="category" value="{{ old('category_id') }}" name="category" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                            <option value="">-- {{'Choose Category'}} --</option>
                                            @foreach($listCategory as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="price" class="form-label">{{ __('Price') }}</label>
                                    <input type="number" value="{{ old('price') }}" class="form-control" id="price" name="price" min="0"/>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="lastName" class="form-label">{{__('Status')}}</label>
                                <select id="category" value="{{ old('status') }}" name="status"
                                        class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger">
                                    @foreach($status as $key => $value)
                                        <option id="format_of_league"
                                                value="{{ $value }}">
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
                                <textarea id="summernote" name="description"></textarea>

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


@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>

<script>
    document.getElementById('category').addEventListener('change', function() {
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Include Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{{ asset('js/eventImage.js') }}"></script>
<!-- include summernote css/js-->
<script src="{{ asset('summernote/jquery.min.js') }}"></script>
<!-- Include Summernote JS -->
<script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write your content here...',
            tabsize: 2,
            height: 600
        });
    });
</script>
@endsection
