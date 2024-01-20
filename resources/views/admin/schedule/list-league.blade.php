@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('List League') }}</h5>
        </div>
        <div class="card-body">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card container">
                    <div class="row product__filter mt-2">
                        @foreach($listLeagues as $league)
                        <div class="col-lg-4 mt-2">
                            <div class="" style="background-color: #eff2f4; padding: 5px; margin-bottom: 15px;">
                                <h5 class="mt-4" style=" text-align: center">{{ $league->name }}</h5>
                                <img class="image" src="{{ $league->images }}" alt="avatar" style="display: block;margin-left: auto;margin-right: auto;width: 50%; height: 165px; border-radius: 80px">
                                <a href="{{ route('schedule.leagueSchedule',$league['id']) }}" style="margin-bottom: 10px;width: 70%;margin-left: 40px;" class="btn btn-primary col-sm-12 mt-4 ">{{__('Create Schedule')}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script src="{{ asset('js/tournament.js') }}"></script>
@endsection
