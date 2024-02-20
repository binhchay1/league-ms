@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Set title') }}
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Set title') }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('save.title', $user->id) }}">
                @csrf
                @foreach($listTitle as $title)
                <div class="form-check">
                    @if(in_array($title, $userTitle))
                    <input class="form-check-input" type="checkbox" id="check-box-{{ $title }}" name="{{ $title }}" checked>
                    @else
                    <input class="form-check-input" type="checkbox" id="check-box-{{ $title }}" name="{{ $title }}">
                    @endif
                    <label class="form-check-label" for="check-box-{{ $title }}">
                        {{ $title }}
                    </label>
                </div>
                @endforeach
                <button class="btn btn-success mt-2">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
