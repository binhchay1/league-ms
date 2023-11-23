@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Group') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}">
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h1 class="center">{{ __('Group') }}</h1>
        <p class="center">{{ __('Join the group to have the opportunity to interact and chat with others.') }}</p>
    </div>
</section>

<section id="show-group" class="container">

</section>
@endsection
