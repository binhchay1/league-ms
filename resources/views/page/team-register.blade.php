@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Team Register') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Team Register') }}</h1>
        <p class="center">{{ __('Join any tem to unleash your passion for sports.') }}</p>
    </div>
</section>

<section id="about" class="container">

</section>
@endsection
