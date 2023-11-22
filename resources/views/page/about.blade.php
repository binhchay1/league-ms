@extends('page')

@section('title')
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('About') }} {{ env('APP_NAME', 'Badminton.io') }}</h1>
        <p class="center">{{ __('Our passion is to make it as easy as possible to run a sports league.') }}</p>
    </div>
</section>

<section id="about" class="container">
    <div>
        <h2 class="h24px">{{ __('What we do') }}</h2>
        <p>{{ env('APP_NAME', 'Badminton.io') }} {{('offers a comprehensive administration system for sports leagues, serving thousands of organizations worldwide. Our system is trusted and functional, being used by the English Football Association for their grassroots leagues on TheFA.com.') }}</p>

        <h2 class="h24px">{{ __('History') }}</h2>
        <p>{{ env('APP_NAME', 'Badminton.io') }} {{ __('was first released in December 2023 and has since evolved into a full solution for badminton leagues, including league websites, with a rich set of functionalities.') }}</p>

        <h2 class="h24px">{{ __('Our Location') }}</h2>
        <address>
            {{ env('APP_NAME', 'Badminton.io') }} <br>Granville House <br>2 Tettenhall Rd <br>Wolverhampton <br>WV1 4SB <br>United Kingdom
        </address>

        <small>{{ env('APP_NAME', 'Badminton.io') }} {{('is a division of DJH Technology Ltd. registered in England and Wales, company number 4641708. Our registered office is: DJH Technology Ltd, Granville House, 2 Tettenhall Rd, Wolverhampton WV1 4SB, United Kingdom.') }}</small>
    </div>
</section>
@endsection
