@extends('layouts.admin')
@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{__('LEAGUE')}}</h5>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-lg-4" style="text-align: center;">
                        <img height="150" width="150" src="{{ $userRegisterLeague->images }}" alt="logo">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $userRegisterLeague->name }}</h2>
                        <h5>{{ __('Start Date') }}: {{ $userRegisterLeague->start_date }}</h5>
                        <h5>{{ __('End Date') }}: {{ $userRegisterLeague->end_date }}</h5>
                        <div class="prize">{{ __('PRIZE MONEY USD ') }}${{ $userRegisterLeague->money }}</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <form id="formAccountSettings" method="POST" action="{{route('league.updatePlayer',$userRegisterLeague['id'])}}" enctype="multipart/form-data">
        @csrf()
        <div class="card mb-4">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="card-header">{{ __('Thông tin vận động viên') }}</h5>
                </div>
                <div class="col-lg-6 ">
                    <button type="submit" class="btn btn-success float-right" style="margin: 10px;">{{__('Active player')}}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="card" style="padding: 10px">
                    <div class=" container-xl table-responsive text-nowrap">
                        <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr class="design-text">
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Gender') }}</th>
                                    <th scope="col">{{ __('Address') }}</th>
                                    <th scope="col">{{ __('Active') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($userRegisterLeague->userLeagues as $league)
                                <tr>
                                    <td><i class=""></i> <strong>{{ $league->user->name }}</strong></td>
                                    <td><img class="image" src="" alt="avatar" style="width: 150px"></td>
                                    <td><i class=""></i> <strong>{{ $league->user->age }}</strong></td>
                                    <td><i class=""></i> <strong>{{ $league->user->address }}</strong></td>
                                    <td><input type="checkbox" name="status" value="1" class="checkbox" {{ $league->status == 1 ? 'checked' : ''}}></td>
                                    <td class="text_flow text-center">
                                        <a href="{{ route('league.destroyPlayer', $league['id']) }}">
                                            <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script src="{{ asset('js/eventImage.js') }}"></script>
@endsection
