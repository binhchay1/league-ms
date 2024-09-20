@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('News') }}
@endsection



@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('/css/page/post.css') }}"/>
@endsection

@section('content')
    <section class="news-landing-wrap container-1280" style="padding-top:0px;">
        <div class="news-section bg-white">
            <div class="std-title-left d-flex " style="justify-content: space-between">
                <h2 class="left" style=" font-weight: 400; color: black; margin: 0">{{ __('News') }}</h2>
            </div>

            <div class="news-overview">
                <div class="news-featured">
                    @foreach($firstNews as $new)
                    <div class="news-featured-image">
                        <a href="{{route('news-show',$new['slug'])}}" rel="bookmark" title="China Open: Lei Turns Tables on Axelsen">
                            <img width="980" height="550" src="{{asset($new->thumbnail)}}" class="attachment-news-maximum size-news-maximum wp-post-image b-error" alt="" loading="lazy">
                            <div class="news-featured-splash">
                            </div>
                        </a>
                    </div>

                    <div class="news-featured-title">
                        <a href="{{route('news-show',$new['slug'])}}"  rel="bookmark" title="  {{($new->title)}}">
                            {{($new->title)}}</a>
                    </div>

                    <div class="news-featured-excerpt">
                        <p>{!! Str::limit(strip_tags(html_entity_decode($new->content)), 300)!!}</p>
                    </div>
                    @endforeach
                </div>
                <div class="std-title">
                    <h2 style="font-weight: 400;  color: black">{{__('News')}}</h2>
                    <nav class="news-filter">
                        <div class="sorting" id="news_sorting">

                            <label class="news-select">
                                <select name="recordCate" id="categories_news" onchange="getComboA(this)">
                                    <option value="?posts=all">
                                        {{__('CATEGORY')}} </option>
                                        @foreach($categories as $category => $value )
                                            <option value="{{ $value->slug }}">{{ $value->name }}</option>
                                        @endforeach
                                </select>
                            </label>
                        </div>
                    </nav>
                </div>
                <div class="news-overview-wrap">
                    @foreach($listNews as $new)
                    <div class="news-overview-item">
                        <div class="news-overview-image">
                            <a href="{{route('news-show',$new['slug'])}}">
                                <img class="img-responsive b-error"  src="{{asset($new->thumbnail)}}">
                            </a>
                        </div>

                        <div class="news-overview-text">
                            <h4 class="media-heading fw-400 fs-16px" title="  {{($new->title)}}">
                                <a href="{{route('news-show',$new['slug'])}}">
                                    {{($new->title)}}
                                </a>
                            </h4>
                            <span class="fw-300 fs-12px text-gray">  <?php echo date_format($new->created_at, 'd-F-Y')  ?><br></span>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
        <div class="news-sidebar" style="margin-top: 7%">
            <aside id="secondary" class="sidebar-area" role="complementary" >
                <div class="widget widget__latest-news ">
                    <span style="font-size: 25px; padding: 10px">
                    {{__('Most News Popular')}} </span>
                    <div class="widget--content">
                        <ul>
                            @foreach($listNewsPopulars as $newPopular)
                                <li class="nn ">
                                    <span class="widget--date text-uppercase"><?php echo date_format($newPopular->created_at, 'd-F-Y')  ?></span>
                                    <a  href="{{route('news-show',$newPopular['slug'])}}"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function getComboA(selectObject) {
        var value = selectObject.value;
        window.location.href = window.location.origin + '/news/category/' + value;
    }


</script>

