@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail New') }}
@endsection



@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('/css/page/post.css') }}"/>
@endsection

@section('content')
    <section class="news-landing-wrap container-1280" style="padding-top:0px;">
        <div class="news-section bg-white">

            <div class="news-featured">
                <img width="980" height="550"
                     src="{{asset($newData->thumbnail)}}"
                     class="attachment-news-maximum size-news-maximum wp-post-image b-error" alt="" loading="lazy"
                     srcset="{{asset($newData->thumbnail)}}"
                  ></div>
            <div class="wcs-single_wrapper">
                <div class="wcs-single_header">
                    <div class="news-title">
                        <h2>{{$newData->title}}</h2>
                    </div>

                    <div class="news-social-links">
                        <div class="">
                            <p class="wcs-single_meta">
                                <?php echo date_format($newData->created_at, 'd-F-Y')  ?>
                                    <br>
                                {{__('TEXT BY')}} {{$newData->user->name ?? ""}} </p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="wcs-single_body">
                    {!! $newData->content !!}
                </div>
            </div>

            <div class="news-overview">
                <div class="std-title">
                    <h2>{{__('Recent News')}}</h2>
                </div>
                <div class="news-overview-wrap">
                    @foreach($listNewsNormals as $new)
                    <div class="news-overview-item">

                        <div class="news-overview-image">
                            <a href="{{route('news-show', $new['slug'])}}">
                                <img class="img-responsive" alt="Hong Kong Open: Fast and Furious Floors Holders"
                                     src="{{asset($new->thumbnail)}}">
                            </a>
                        </div>

                        <div class="news-overview-text">
                            <h4 class="media-heading fw-400 fs-16px"
                                title=" {{$new->title}}">
                                <a class="post-popular" href="{{route('news-show', $new['slug'])}}">
                                    {{$new->title}} </a>
                            </h4>
                            <span class="fw-300 fs-12px text-gray">  <?php echo date_format($newData->created_at, 'd-F-Y')  ?><br></span>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
        <div class="news-sidebar">

            <div>
            </div>

            <aside id="secondary" class="sidebar-area" role="complementary">
                <div class="widget widget__latest-news ">
                    <h2 class="widget--title text-uppercase ">
                    <span>
                    {{__('Most News Popular')}} </span>
                    </h2>
                    <div class="widget--content">
                        <ul>
                            @foreach($listNewsPopulars as $newPopular)
                            <li class="nn">
                                <span class="widget--date text-uppercase"><?php echo date_format($newPopular->created_at, 'd-F-Y')  ?></span>
                                <a href="{{route('news-show', $new['slug'])}}"
                                   class="widget--link post-popular" target="_self">
                                    ​{{$newPopular->title}} </a>
                            </li>
                            <div class="widget-red-line"></div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

