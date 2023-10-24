@extends('layout.admin_layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Danh Sách Đội</h4>
        <div class="card container">
            <div class="row product__filter mt-2">
                @foreach($listTeam as $team)
                    <div class="col-lg-3 mt-2">
                        <div class="" style="background-color: #eff2f4; padding: 5px">
                                <h5 class="card-title mt-4" style="text-align: center">{{$team->name}}</h5>
                               <img class="image" src="{{$team->image}}" alt="avatar" style="display: block;margin-left: auto;margin-right: auto;width: 50%; border-radius: 80px">
                                <a href="" style="margin-bottom: 10px;width: 70%;margin-left: 54px;" class="btn btn-primary col-sm-12 mt-4 ">Profile</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection