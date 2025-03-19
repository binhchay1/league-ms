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
            <h5>{{__('Group')}}</h5>
            <a href="{{route('group.index')}}">
                <button type="reset" class="btn btn-primary" >{{ __('Back') }}</button></a>
        </div>
        <div class="card-body">
            <form id="formAccountSettings" method="POST" action="" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-lg-4" style="text-align: center;">
                        <img height="150" width="150" src="{{asset($group->images ?? '/images/logo-no-background.png')}}" alt="logo">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ $group->name }}</h2>
                        <h5>{{ __('Description') }}: {{ $group->description }}</h5>
                        <h5>{{ __('Location') }}: {{ $group->location }}</h5>
                        <h5>{{ __('Member') }}: {{ $group->group_users->count() }}</h5>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <form id="formAccountSettings" method="POST" action="{{route('group.activeUserJoin',$group['id'])}}" enctype="multipart/form-data">
        @csrf()
        <div class="card mb-4">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="card-header">{{ __('Information User') }}</h5>
                </div>
                <div class="col-lg-6 ">
                    <button type="submit" class="btn btn-success float-right" style="margin: 10px;">{{__('Active user')}}</button>
                </div>

            </div>
            <div class="col-lg-12 " style="text-align: right; margin-left: -5px">
                <label>
                    <input type="radio" name="status_request" value="accepted" checked>
                    Accepted
                </label>
                <label>
                    <input type="radio" name="status_request" value="0">
                    Waiting
                </label>
            </div>
            <div class="card-body">
                <div class="card" style="padding: 10px">
                    <div class=" container-xl table-responsive text-nowrap">
                        <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr class="design-text">
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Gender') }}</th>
                                    <th scope="col">{{ __('Address') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($group->group_users as $user)
                                <tr>
                                    <td><input type="checkbox"  name="user_ids[]" value="{{ $user->id }}" class="checkbox" ></td>
                                    <td><i class=""></i> <strong>{{ $user->users->name ?? "" }}</strong></td>
                                    <td><img class="image" src="{{asset($user->users->profile_photo_path ?? '/images/default-avatar.png')}}" alt="avatar" style="width: 100px"></td>
                                    <td><i class=""></i> <strong>{{ $user->users->gender ?? "" }}</strong></td>
                                    <td><i class=""></i> <strong>{{ $user->users->address ?? "" }}</strong></td>
                                    <td>
                                        <div  class="btn btn-{{$user->status_request == 'accepted' ? 'info' : 'warning' }}">
                                            {{$user->status_request == 'accepted' ? "Accepted " : "Waiting "}}
                                        </div>
                                     </td>
                                    <td class="text_flow text-center">
                                        <a href="{{ route('user.destroyUser', $user['id']) }}">
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
