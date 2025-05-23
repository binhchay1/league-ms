@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail New') }}
@endsection
<style>
    .post-detail-thumbnail {
        max-height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .post-detail-thumbnail {
            max-height: 300px;
        }
    }

    @media (max-width: 576px) {
        .post-detail-thumbnail {
            max-height: 220px;
        }

        .news-title h2 {
            font-size: 1.5rem;
        }

        .wcs-single_body {
            padding: 0 10px;
        }
    }
</style>

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('/css/page/post.css') }}" />
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="category-wrapper position-relative">
                    <div class=" bg-dark text-white p-2" style="cursor: pointer;">
                        {{ __('Category News') }}
                    </div>
                    <div class="list-group category-dropdown  ">
                        @foreach ($categories as $category)
                            <a href="{{ route('newsCategory', $category->slug) }}"
                                class="list-group-item list-group-item-action">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="news-featured">
                    <div class="wcs-single_header">
                        <div class="news-title">
                            <h2 class="p-0 fw-bold">{{ $newData->title }}</h2>
                        </div>

                        <div class="news-meta text-muted small mb-3">
                            <p class="mb-0">
                                {{ $newData->created_at->format('d F Y') }}<br>
                                {{ __('TEXT BY') }} {{ $newData->user->name ?? '' }}
                            </p>
                        </div>
                    </div>

                    <div class="featured-image mb-3">
                        <img src="{{ asset($newData->thumbnail ?? '/images/logo-no-background.png') }}"
                             class="img-fluid w-100 rounded post-detail-thumbnail"
                             alt="{{ $newData->title }}">
                    </div>
                </div>

                <div class="wcs-single_wrapper">
                    <div class="wcs-single_body">
                        {!! $newData->content !!}
                    </div>
                </div>
            </div>

        </div>
        @if ($relatedPosts->count())
            <div class="p-5 mt-4">
                <div class="col-md-4 d-flex flex-column">
                    <h2 style="color: black; font-weight: 400">{{ __('RELATE NEWS') }}</h2>
                </div>
                <div class="row">
                    @foreach ($relatedPosts as $post)
                        <div class="col-md-3 mb-4">
                            <div class="card border-0 shadow-sm post-card">
                                <div class="position-relative">
                                    <img src="{{ asset($post->thumbnail ?? '/images/logo-no-background.png') }}"
                                        class="card-img-top rounded-top" alt="Hình ảnh bài viết">
                                    <div class="post-content p-3" title="{{ $post->title }}">
                                        <a href="{{ route('news-show', $post->slug) }}">
                                            <h6 class="fw-bold">{{ Str::limit($post->title, 60) }}</h6>
                                        </a>
                                        <div class="post-meta">
                                            <span
                                                class="badge bg-warning text-dark">{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i') }}</span>
                                        </div>
                                        <p class="text-muted mb-0">{!! Str::limit(strip_tags(html_entity_decode($post->content)), 100) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

@endsection
