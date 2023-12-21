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
            <form id="formAccountSettings" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
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
                            <div class="col-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ $dataProduct->name ? $dataProduct->name : old('name') }}" type="text" name="name" id="name" />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="price" class="form-label">{{ __('Price') }}</label>
                                    <input type="number" value="{{ $dataProduct->price ? $dataProduct->price : old('price') }}" class="form-control" id="price" name="price" />
                                    @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="category" class="form-label">{{ __('Category') }}</label>
                                    <input type="text" value="{{ $dataProduct->category ? $dataProduct->category : old('category') }}" class="form-control" id="category" name="category" />
                                    @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="brand" class="form-label">{{ __('Brand') }}</label>
                                    <input type="text" value="{{ $dataProduct->brand ? $dataProduct->brand : old('brand') }}" class="form-control" id="brand" name="brand" />
                                    @if ($errors->has('brand'))
                                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description" id="description">{{ $dataProduct->description }}</textarea>
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
@endsection
