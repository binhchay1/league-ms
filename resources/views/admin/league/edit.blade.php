@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Edit League') }}
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header" >
            <h5>{{__('League')}}</h5>
            <a href="{{route('league.index')}}">
                <button type="reset" class="btn btn-primary" >{{ __('Back') }}</button>
            </a>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('league.update',$dataLeague['id']) }}" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label>{{__('Logo league')}}</label>
                            <div class="">
                                <div>
                                    <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                                    <div class=" choose-avatar">
                                        <div id="btnimage">
                                            <img id="showImage" class="show-avatar" src="{{asset($dataLeague->images ?? '/images/logo-no-background.png')}}" alt="avatar" >
                                        </div>
                                        <div id="button">
                                            <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image: ') }}</i> <i class="text-black"> {{__('(jpeg,png,jpg)')}} </i>
                                        </div>

                                    </div>
                                    @if ($errors->has('images'))
                                    <span class="text-danger">{{ $errors->first('images') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="lastName" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control" value="{{ old('name', $dataLeague['name']) }}" type="text" name="name" id="name" placeholder="{{ __('Enter league name') }}"/>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-6" hidden>
                                <label for="lastName" class="form-label">{{ __('Slug') }}</label>
                                <input class="form-control" value="{{ old('slug', $dataLeague['slug']) }}" type="text" name="slug" id="slug" placeholder="{{ __('Enter league slug') }}"/>
                                @if ($errors->has('slug'))
                                <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">{{ __('Prize money') }}</label>
                                    <input class="form-control" value="{{ old('money',$dataLeague['money']) }}" type="text" name="money" id="money" placeholder="{{ __('Enter league money') }}"/>
                                    @if ($errors->has('money'))
                                        <span class="text-danger">{{ $errors->first('money') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Start date') }}</label>
                                    <input type="date" value="{{ old('start_date', $dataLeague['start_date']) }}" class="form-control" id="start_date" name="start_date" placeholder="{{ __('Enter league start date') }}" />
                                    @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{__('End date')}}</label>
                                    <input type="date" value="{{ old('end_date', $dataLeague['end_date']) }}"class="form-control" id="end_date" name="end_date" placeholder="{{ __('Enter league end date') }}"/>
                                    @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Register league ') }}</label>
                                    <input type="datetime-local" value="{{ old('end_date_register',$dataLeague['end_date_register']) }}" class="form-control" id="end_date_register" name="end_date_register" placeholder="{{ __('Enter league register date') }}" />
                                    @if ($errors->has('end_date_register'))
                                        <span class="text-danger">{{ $errors->first('end_date_register') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">{{ __('Start time league') }}</label>
                                    <input class="form-control" value="{{ old('start_time',$dataLeague['start_time']) }}" type="time" name="start_time" id="start_time" placeholder="{{ __('Enter league start time') }}"/>
                                    @if ($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">{{ __('Location') }}</label>
                                    <input class="form-control" value="{{ old('location', $dataLeague['location']) }}" type="text" name="location" id="location" placeholder="{{ __('Enter league location') }}"/>
                                    @if ($errors->has('location'))
                                    <span class="text-danger">{{ $errors->first('location') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">{{ __('Number of athletes') }}</label>
                                    <select id="format_of_league" value="{{ $dataLeague->number_of_athletes }}" name="number_of_athletes" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        @foreach($listPlayer as $number => $value)
                                            <option id="format_of_league" value="{{ $value }}" {{$value == $dataLeague->number_of_athletes ? 'selected' : ''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Format of league') }}</label>
                                    <select id="format_of_league" value="{{ $dataLeague->format_of_league }}" name="format_of_league" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        @foreach($listFormat as $format => $value)
                                        <option id="format_of_league" value="{{ $value }}" {{$value == $dataLeague->format_of_league ? 'selected' : ''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Type of league') }}</label>
                                    <select id="type_of_league" value="{{ $dataLeague->type_of_league }}" name="type_of_league" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" >
                                        @foreach($listType as $type => $value)
                                        <option id="type_of_league" value="{{ $value }}" {{$value == $dataLeague->type_of_league ? 'selected' : ''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success me-2">{{ __('Save') }}</button>
                    <button type="reset" class="btn btn-outline-secondary">{{ __('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/admin/league.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
