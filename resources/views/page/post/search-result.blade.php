@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('News') }}
@endsection



@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('/css/page/post.css') }}"/>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row align-items-center mt-4">
            <!-- Tiêu đề và Menu -->


            <div class="col-md-4 d-flex flex-column">
                <h2 style="color: black">{{ __('NEWS') }}</h2>
            </div>

            <!-- Form Tìm Kiếm -->
            <div class="col-md-8">
                <form class="d-flex gap-2 justify-content-end" action="{{route('searchNews')}}" method="GET">

                    <select class="form-select" name="sort">
                        <option selected>{{'Sort by'}}</option>
                        <option value="newest">{{'Latest'}}</option>
                        <option value="oldest">{{'Oldest'}}</option>
                    </select>

                    <div class="input-group">
                        <input type="text" class="form-control" name="query"
                               placeholder="Name....">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <!-- Danh sách bài viết -->
            <div class="col-lg-9">
                <div class="row">
                    @foreach($listNews as $post)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm post-card">
                                <div class="position-relative">
                                    <img src="{{ asset($post->thumbnail ?? '/images/logo-no-background.png') }}" class="card-img-top rounded-top" alt="Hình ảnh bài viết">
                                    <div class="post-content p-3" title="{{$post->title}}">
                                        <a href="{{route('news-show', $post->slug)}}">
                                            <h6 class="fw-bold">{{ Str::limit($post->title, 60) }}</h6>
                                        </a>
                                        <div class="post-meta">
                                            <span class="badge bg-warning text-dark">{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i') }}</span>
                                        </div>
                                        <p class="text-muted mb-0">{!! Str::limit(strip_tags(html_entity_decode($post->content)), 100)!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Sidebar danh mục -->
            <div class="col-lg-3">
                <div class="list-group">
                    <h5 class="list-group-item bg-light m-0">{{'Category'}}</h5>
                    @foreach($categories as $category)
                        <a href="{{route('newsCategory', $category->slug)}}"  class="list-group-item list-group-item-action">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


