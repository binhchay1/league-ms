@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create Category Product') }}
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="card card-default">
            <div class="card-header">
                <h5>{{ __('Create Category Product') }}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('categoryProduct.update',$categoryProduct['id'] ) }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ __('Logo group') }}</label>
                            <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                            <div class=" choose-avatar">
                                <div id="btnimage">
                                    <img id="showImage" class="show-avatar" src="{{ asset($categoryProduct->image ?? '/images/logo-no-background.png') }}" alt="avatar" style="width: 200px;">
                                </div>
                                <i class="text-red"> {{__('Image format:jpeg,png,jpg')}} </i>


                                <div id="button">
                                    <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image') }}</i>
                                </div>

                            </div>
                            @if ($errors->has('images'))
                                <span class="text-danger">{{ $errors->first('images') }}</span>
                            @endif
                        </div>
                        <div class="col-md-10">
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input class="form-control" value="{{$categoryProduct->name}}" type="text" name="name" id="name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
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
