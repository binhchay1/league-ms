@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Edit Product') }}
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Edit Product') }}</h5>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('product.update', $dataProduct['id']) }}" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-md-2 mt-4">
                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <div>
                                <div style="display: inline-grid;">
                                    <input value="{{ $dataProduct->images }}" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                                    <div class=" choose-avatar">
                                        <div id="btnimage">
                                            <img id="showImage" class="show-avatar" src="{{ asset($dataProduct->images) }}" alt="avatar">
                                        </div>
                                        <div id="button">
                                            <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image') }}</i>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="row mt-4">
                            <div class="col-4">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ $dataProduct->name ? $dataProduct->name : old('name') }}" type="text" name="name" id="name" />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-4">
                                <label for="lastName" class="form-label">{{__('Category')}}</label>
                                <select id="category" value="{{ old('category_id') }}" name="category" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                    @foreach($listCategory as $category)
                                        <option value="{{ $category->id }}" @if($category->category_id == $category->id) selected @endif>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>

                            <div class="col-4 ">
                                <label for="brand" class="form-label">{{'Brand'}}</label>
                                <select id="brand" name="brand" class="form-control">
                                    <option value="{{$dataProduct->brand}}">{{$dataProduct->brands->name ?? "no brand"}}</option>
                                </select>
                            </div>
                            <div class="col-4 mt-4">
                                <div class="form-group">
                                    <label for="price" class="form-label">{{ __('Price') }}</label>
                                    <input type="number" value="{{ $dataProduct->price ? $dataProduct->price : old('price') }}" class="form-control" id="price" name="price" />
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-4 mt-4">
                                <div class="form-group">
                                    <label for="price" class="form-label">{{ __('Discount') }}</label>
                                    <input type="number" value="{{ $dataProduct->discount ? $dataProduct->discount : old('discount') }}" class="form-control" id="discount" name="discount" min="0"/>
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4 mt-4">
                                <label for="lastName" class="form-label">{{__('Status')}}</label>
                                <select id="category" value="{{ old('status') }}" name="status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                    @foreach($status as $key => $value)
                                        <option id="format_of_league" value="{{ $value }}" {{$value == $dataProduct->status ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control"  name="description" id="description">{{ $dataProduct->description ? $dataProduct->description : old('description') }}</textarea>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/admin/league.css') }}">
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
@endsection
