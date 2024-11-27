@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Create Post') }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin/league.css') }}">
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
                <h5>{{ __('Create Post') }}</h5>
            </div>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('post.update', $post['id']) }}" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label>{{ __('Thumbnail') }}</label>
                                <div class="">
                                    <div class="" style="display: inline-grid;">
                                        <input value="" type="file" class="border-0 bg-light pl-0" name="thumbnail" id="image" hidden>
                                        <div class=" choose-avatar">
                                            <div id="btnimage">
                                                <img id="showImage" class="show-avatar" src="{{asset($post->thumbnail ?? '/images/logo-no-background.png')}}" alt="avatar">
                                            </div>
                                            <div id="button">
                                                <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image: ') }}</i> <i class="text-black"> {{__('(jpeg,png,jpg)')}} </i>
                                            </div>

                                        </div>
                                        @if ($errors->has('thumbnail'))
                                            <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="lastName" class="form-label">{{__('Title')}}</label>
                                    <input class="form-control" value="{{ $post->title }}" type="text" name="title" id="name" placeholder="{{ __('Enter post title') }}"/>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="lastName" class="form-label">{{__('Category')}}</label>
                                    <select id="category_id" value="{{ old('category_id') }}" name="category_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        @foreach($listCategories as $category)
                                            <option value="{{ $category->id }}" @if($category->category_id == $category->id) selected @endif>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <label for="lastName" class="form-label">{{__('Status')}}</label>
                                    <div class="form-group">
                                          <input type="radio" id="html" name="status" value="hot" {{ ($post->status=="hot")? "checked" : "" }}>
                                          <label for="html">{{__('Hot')}}</label><br>
                                          <input type="radio" id="css" name="status" value="popular" {{ ($post->status=="popular")? "checked" : "" }}>
                                          <label for="css">{{__('Popular')}}</label><br>
                                          <input type="radio" id="javascript" name="status" value="normal" {{ ($post->status=="normal")? "checked" : "" }}>
                                          <label for="javascript">{{__('Normal')}}</label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="lastName" class="form-label">{{__('Content')}}</label>
                                <textarea id="summernote" name="content">{!! $post->content !!}</textarea>

                                @if ($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
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
