@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color: red; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }

    .label-success {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: green;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .label-danger {
        border-radius: 5px;
        color: #fff;
        padding: 3px 8px;
        background: red;
        font-size: 12px;
        font-weight: 700;
        padding-bottom: 6px;
        position: relative;
        font-size: 15px;
    }

    .card-title {
        color: black !important;
    }

    .rounded-circle {
        margin-right: 10px;
    }

    .card-body p{
        font-size: 15px !important;
    }


</style>
@section('content')
    <section >
        <div class=" text-black p-3 align-items-center">
            <div class="container d-flex  img-fluid">
                <img src="{{ asset($row->images ?? '/images/logo-no-background.png') }}" alt="User" width="200" height="200" class=" me-3 rounded-start" >
                <div>
                    <h2 class="p-0">{{$group->name}}</h2>
                    <p class="">
                        <i class="bi bi-bookmark"></i> {{$group->description}}
                    </p>
                    <p class=" ">
                        <i class="bi bi-geo-alt"></i> <em>{{$group->location}}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-people"></i> <em>{{$group->number_of_members}}</em>
                    </p>
                    <p> <i class="bi bi-card-checklist"></i> {{$group->note}}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="container mt-4 form-active">
            <form id="formAccountSettings" method="POST" action="{{route('group.activeUserJoin',$group['id'])}}" enctype="multipart/form-data">
                @csrf()
                <div class="col-lg-12 " style="text-align: right; margin-left: -5px">
                    <div >
                        <button type="submit" class="btn btn-success float-right" style="margin: 10px;">{{__('Active user')}}</button>
                    </div>
                    <label>
                        <input type="radio" name="status_request" value="accepted" checked>
                        {{'Accepted'}}
                    </label>
                    <label>
                        <input type="radio" name="status_request" value="0">
                        {{'Waiting'}}
                    </label>
                </div>
            <!-- Bảng Ban huấn luyện -->
                <div class="col-lg-6">
                    <h3 class="card-header">{{ __('Information User') }}</h3>
                </div>
                <p style="font-size: 20; font-weight: 600">{{count($group->group_users) }} / {{$group->number_of_members}} {{'Players'}}</p>
            <div class="card mb-">
                <div class="card-header bg-primary text-white">{{'Users'}}</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{"Check"}}</th>
                            <th>{{"Information"}}</th>
                            <th>{{"Address"}}</th>
                            <th>{{"Status"}}</th>
                            <th>{{"Action"}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($group->group_users as $group)
                            <tr>
                                <td><input type="checkbox"  name="user_ids[]" value="{{ $group->id }}" class="checkbox" ></td>
                                <td><img src="{{asset($group->users->profile_photo_path ?? '/images/default-avatar.png')}}"  width="50" height="50" class="rounded-circle ">{{ $group->user->name ?? "" }}</td>
                                <td>{{ $group->users->address ?? "" }}</td>
                                <td>
                                    <div  class="btn btn-{{$group->status_request == 'accepted' ? 'info' : 'warning' }}">
                                        {{$group->status_request == 'accepted' ? "Accepted " : "Waiting Accept "}}
                                    </div>
                                </td>
                                <td class="text_flow text-center">
                                    <a href="{{ route('user.destroyUser', $group['id']) }}">
                                        <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bảng Vận động viên -->
            </form>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function detailGroup(id) {
            let name = id.substring(6);
            let url = '/detail-group?g_i=' + name;

            window.location.href = url;
        }
    </script>
    <script>
        $(document).ready(function(){
            $(".list-group-item-action").click(function(){
                $(".list-group-item-action").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
@endsection
