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


            <div class="news-overview">
                <div class="std-title">
                    <h2>{{__('News')}}</h2>
                    <nav class="news-filter">
                        <div class="sorting" id="news_sorting">

                            <label class="news-select">
                                <select name="categories_news" id="categories_news">
                                    <option value="?posts=all">
                                        MOST RECENT </option>
                                    <option value="?pyear=2024&amp;pmonth=09"> September 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=08"> August 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=07"> July 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=06"> June 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=05"> May 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=04"> April 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=03"> March 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=02"> February 2024 </option>
                                    <option value="?pyear=2024&amp;pmonth=01"> January 2024 </option>
                                    <option value="?pyear=2023&amp;pmonth=12"> December 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=11"> November 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=10"> October 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=09"> September 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=08"> August 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=07"> July 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=06"> June 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=05"> May 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=04"> April 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=03"> March 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=02"> February 2023 </option>
                                    <option value="?pyear=2023&amp;pmonth=01"> January 2023 </option>
                                    <option value="?pyear=2022&amp;pmonth=12"> December 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=11"> November 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=10"> October 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=09"> September 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=08"> August 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=07"> July 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=06"> June 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=05"> May 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=04"> April 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=03"> March 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=02"> February 2022 </option>
                                    <option value="?pyear=2022&amp;pmonth=01"> January 2022 </option>
                                    <option value="?pyear=2021&amp;pmonth=12"> December 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=11"> November 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=10"> October 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=09"> September 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=05"> May 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=04"> April 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=03"> March 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=02"> February 2021 </option>
                                    <option value="?pyear=2021&amp;pmonth=01"> January 2021 </option>
                                    <option value="?pyear=2020&amp;pmonth=12"> December 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=11"> November 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=10"> October 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=09"> September 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=08"> August 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=07"> July 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=06"> June 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=05"> May 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=04"> April 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=03"> March 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=02"> February 2020 </option>
                                    <option value="?pyear=2020&amp;pmonth=01"> January 2020 </option>
                                    <option value="?pyear=2019&amp;pmonth=12"> December 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=11"> November 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=10"> October 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=09"> September 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=08"> August 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=07"> July 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=06"> June 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=05"> May 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=04"> April 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=03"> March 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=02"> February 2019 </option>
                                    <option value="?pyear=2019&amp;pmonth=01"> January 2019 </option>
                                    <option value="?pyear=2018&amp;pmonth=12"> December 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=11"> November 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=10"> October 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=09"> September 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=08"> August 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=07"> July 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=06"> June 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=05"> May 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=04"> April 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=03"> March 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=02"> February 2018 </option>
                                    <option value="?pyear=2018&amp;pmonth=01"> January 2018 </option>
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
                            <h4 class="media-heading fw-400 fs-16px" title="Hong Kong Open: Fast and Furious Floors Holders">
                                <a href="">
                                    {{($new->title)}} </a>
                            </h4>
                            <span class="fw-300 fs-12px text-gray">  <?php echo date_format($new->created_at, 'd-F-Y')  ?><br></span>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
        <div class="news-sidebar">

            <div>
            </div>

            <aside id="secondary" class="sidebar-area" role="complementary" style="margin-top: 25px">
                <div class="widget widget__latest-news ">
                    <span style="font-size: 25px; padding: 10px">
                    {{__('Most News Popular')}} </span>
                    <div class="widget--content">
                        <ul>
                            @foreach($listNewsPopulars as $newPopular)
                                <li class="nn">
                                    <span class="widget--date text-uppercase"><?php echo date_format($newPopular->created_at, 'd-F-Y')  ?></span>
                                    <a href=""
                                       class="widget--link" target="_self">
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

