@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('About') }}
@endsection
<style>
    @media (max-width: 768px) {
        .news-overview-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .news-overview-text {
            margin-top: 1rem;
        }

        .news-overview-image img {
            width: 100%;
            height: auto;
        }

        .std-title {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }

        .std-title .left, .std-title .right {
            font-size: 18px;
        }
    }
</style>
@section('content')

<section id="heading">
    <div class="container">
        <h1 class=""> {{ "Badminton.io" }}</h1>
        <p class="wcs-page_body ">{{ __('Badmintion.io is an online tournament management platform that allows users to create, manage and track tournaments in many different formats such as knockout, round robin and many other types. With a friendly and easy-to-use interface, Badmintion.io is suitable for both beginners and professional organizations.') }}</p>
    </div>
</section>

    <section id="next-tournament" class="next-tournament-section bg-black py-5">
        <div class="container text-center">
            <img src="/images/logo-no-background.png" alt="logo" class="img-fluid mb-3" style="max-width: 200px;">
            <h3 class="text-white">{{ __("Badminton.io") }}</h3>
        </div>
    </section>

<section id="about" class="container">
    <div>
        <h3 class="h24px " style="margin-top: 5%">{{ __('What we do') }}</h3>
        <strong>{{__('Quickly create tournaments:')}}</strong>
        <p class="wcs-page_body"> {{(' Users can create tournaments in just a few simple steps, from setting up the tournament type to adding participants.') }}</p>
        <strong>{{__('Match management: ')}}</strong>
        <p class="wcs-page_body"> {{('The interface helps to track matches intuitively, allowing you to easily update results and schedules.') }}</p>
        <strong>{{__('Easy sharing:')}}</strong>
        <p class="wcs-page_body"> {{(' Tournaments can be shared via direct links, helping viewers and participants track progress easily.') }}</p>
        <strong>{{__('Integrated leaderboard:')}}</strong>
        <p class="wcs-page_body"> {{(' The system automatically updates the leaderboard, helping participants clearly understand their position in the tournament.') }}</p>

        <h3 class="h24px ">{{ __('Benefits of using Badminton.io') }}</h3>
        <strong>{{__('Save time:')}}</strong>
        <p class="wcs-page_body"> {{(' Minimize the time to organize and manage tournaments thanks to automated tools.') }}</p>
        <strong>{{__('Increase professionalism: ')}}</strong>
        <p class="wcs-page_body"> {{('With a beautiful interface and diverse features, your tournament will look more professional in the eyes of participants and audiences.') }}</p>
        <strong>{{__('Customer support:')}}</strong>
        <p class="wcs-page_body"> {{(' Challonge provides dedicated support services, helping users solve problems quickly.') }}</p>

    </div>
</section>


@endsection
