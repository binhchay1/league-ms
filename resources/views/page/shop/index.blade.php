@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Shop') }}
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Shop') }}</h1>
        <p class="center">{{ __('Our passion is to make it as easy as possible to run a sports league.') }}</p>
    </div>
</section>

<section id="shop" class="container">

</section>
@endsection
