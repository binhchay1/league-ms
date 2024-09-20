@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('About') }}
@endsection

@section('content')

<section id="heading">
    <div class="container">
        <h1 class=""> {{ env('APP_NAME', 'Badminton.io') }}</h1>
        <p class="wcs-page_body ">{{ __('Badmintion.io is an online tournament management platform that allows users to create, manage and track tournaments in many different formats such as knockout, round robin and many other types. With a friendly and easy-to-use interface, Badmintion.io is suitable for both beginners and professional organizations.') }}</p>
    </div>
</section>

<section id="next-tournament" class="next-tournament-section bg-black">
    <div class="next-tournament-wrap">
        <div class="results">
            <div class="wrapper-results">
                <div class="center">
                        <img width="200" src="{{  '/images/logo-no-background.png' }}" alt="logo" class=" b-error">

                        <h3 class="text-white">{{__("Badminton.io")}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="container">
    <div>
        <h4 class="h24px " style="margin-top: 5%">{{ __('What we do') }}</h4>
        <strong>{{__('Quickly create tournaments:')}}</strong>
        <p class="wcs-page_body"> {{(' Users can create tournaments in just a few simple steps, from setting up the tournament type to adding participants.') }}</p>
        <strong>{{__('Match management: ')}}</strong>
        <p class="wcs-page_body"> {{('The interface helps to track matches intuitively, allowing you to easily update results and schedules.') }}</p>
        <strong>{{__('Easy sharing:')}}</strong>
        <p class="wcs-page_body"> {{(' Tournaments can be shared via direct links, helping viewers and participants track progress easily.') }}</p>
        <strong>{{__('Integrated leaderboard:')}}</strong>
        <p class="wcs-page_body"> {{(' The system automatically updates the leaderboard, helping participants clearly understand their position in the tournament.') }}</p>

        <h4 class="h24px ">{{ __('Benefits of using Badminton.io') }}</h4>
        <strong>{{__('Save time:')}}</strong>
        <p class="wcs-page_body"> {{(' Minimize the time to organize and manage tournaments thanks to automated tools.') }}</p>
        <strong>{{__('Increase professionalism: ')}}</strong>
        <p class="wcs-page_body"> {{('With a beautiful interface and diverse features, your tournament will look more professional in the eyes of participants and audiences.') }}</p>
        <strong>{{__('Customer support:')}}</strong>
        <p class="wcs-page_body"> {{(' Challonge provides dedicated support services, helping users solve problems quickly.') }}</p>

    </div>
</section>

<section id="news" class="container-1280 news-section bg-white">
    <div class="std-title padding-0"  >
        <h2 class="left" >{{ __('Latest Tour News') }}</h2>
        <a href="{{route('news')}}">
            <h2 class="right league-all-data">{{ __('All News') }}</h2>
        </a>
    </div>
    <div class="news-overview-wrap" style="margin-bottom: 2%">
        @foreach($listPosts as $post)
            <div class="news-overview-item">
                <div class="news-overview-image">
                    <a href="">
                        <img src="{{asset($post->thumbnail ?? '/images/logo-no-background.png' )}}" alt="" class="img-responsive-hover b-error">
                    </a>
                </div>

                <div class="news-overview-text">
                    <h4 class="media-heading fw-400 fs-16px">
                        <a href="{{route('news-show', $post['slug'])}}" title="{{$post->title}}">
                            {{$post->title}} </a>
                    </h4>
                    <span class="fw-300 fs-12px text-gray">
                        <?php echo date_format($post->created_at, 'd-F-Y')  ?><br>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
    <small style="margin-bottom: 10%">{{ env('APP_NAME', 'Badminton.io') }} {{('is a division of DJH Technology Ltd. registered in England and Wales, company number 4641708. Our registered office is: DJH Technology Ltd, Granville House, 2 Tettenhall Rd, Wolverhampton WV1 4SB, United Kingdom.') }}</small>

</section>
@endsection
