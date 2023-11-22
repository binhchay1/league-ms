@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{__('Tạo Lịch Thi Đấu')}}</h5>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('group.store') }}" enctype="multipart/form-data">
                @csrf()
                @if(session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="container">
                    <div>
                        <div>
                            <label for="lastName" class="form-label">{{ __('Vòng đấu') }}</label>
                            <input class="form-control" value="" type="number" name="match" id="match" min="1" />
                            @if ($errors->has('match'))
                            <span class="text-danger">{{ $errors->first('match') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">{{ __('Lưu') }}</button>
                    <button type="reset" class="btn btn-outline-secondary">{{ __('Hủy') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
