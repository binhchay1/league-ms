@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('My Group') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<style>
    .list-group-item-action {
        padding: 10px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .list-group-item-action.active {
        background-color: #007bff; /* Màu xanh */
        color: white;
        border-radius: 5px;
    }
</style>
@section('content')
<section >
    <div class="container-fluid">
        <!-- Header -->
        <div class=" text-black p-3 align-items-center">
            <div class="container d-flex ">
                <img src="avatar.jpg" alt="User" class="rounded-circle me-3" width="50">
                <div>
                    <h5 class="mb-0">Tran Thuy</h5>
                    <p>tranthuy240814@gmail.com</p>
                    <p>tranthuy240814@gmail.com</p>
                </div>
            </div>
        </div>
<hr>
        <!-- Main Content -->
        <div class="container bg-gray">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 p-3 bg-light">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Giải đấu đã tạo</a>
                        <a href="#" class="list-group-item list-group-item-action">Được phân công</a>
                        <a href="#" class="list-group-item list-group-item-action">Đang quan tâm</a>
                        <a href="#" class="list-group-item list-group-item-action">Đang tham gia</a>
                    </div>
                </div>

                <!-- Tournament List -->
                <div class="col-md-9 p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Giải đấu đã tạo</h4>
                        <button class="btn btn-success">Tạo Giải Đấu</button>
                    </div>

                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <img src="battlebots.jpg" class="img-fluid rounded-start" alt="BattleBots">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">1</h5>
                                    <p class="card-text">Loại Trực Tiếp | BattleBots | Tran Thuy | 1212</p>
                                    <span class="badge bg-secondary">Chưa kích hoạt</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <img src="badminton.jpg" class="img-fluid rounded-start" alt="Cầu Lông">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">Thuy Test</h5>
                                    <p class="card-text">Loại Trực Tiếp | Cầu Lông | Tran Thuy | Hà Nội, Việt Nam</p>
                                    <span class="badge bg-warning text-dark">Hoạt động</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
            $(".list-group-item-action").click(function(){
                $(".list-group-item-action").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>

{{--    <div class="row">--}}
{{--        @if(count($listGroup) > 0)--}}
{{--        @foreach($listGroup as $row)--}}
{{--        <div class="wp-group">--}}
{{--            <div class="wp-group-content mb-4">--}}
{{--                <div class="d-flex gr-title" >--}}
{{--                    <div class=" align-items-center">--}}
{{--                        <img class="avatar-group"  style="padding: 5px" src="{{ asset($row-> images ?? 'https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}" data-id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">--}}
{{--                    </div>--}}
{{--                    <div  class="c-details-group name-group" data-id="group-{{ $row->name }}" id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">--}}
{{--                        <h6 class="mb-0 gr-name">{{ $row->name }}</h6>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <hr>--}}
{{--                <div class="mt-3 descript-group">--}}
{{--                    <p>■  {{ __('Description') }}: {{ $row->description }}</p>--}}
{{--                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>--}}
{{--                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>--}}
{{--                    <p><span class="">■ {{ __('Number of member') }} : </span>{{ $row->number_of_members }}</p>--}}
{{--                    <p class="">----- {{ __('Note') }}: {{ $row->note }}</p>--}}
{{--                    <div class="mt-3">--}}
{{--                        <div class="progress">--}}
{{--                            <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($row->group_users->count() / $row->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-between mt-3">--}}
{{--                            <div> <span class="text1">{{ $row->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $row->number_of_members }}</span></span> </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--            @else--}}
{{--            <div class="text-center">--}}
{{--                <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">--}}

{{--                <h4 >{{ __('There are no groups !') }}</h4>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--    </div>--}}

{{--    <!-- Paginate -->--}}
{{--    <?php $countGroup= count($listGroup); ?>--}}
{{--    @if($countGroup > $listGroup->perPage())--}}
{{--        <div class="navigator short mt-4" >--}}
{{--            <div class="head d-flex justify-content-center ">--}}
{{--                <ul class="pagination">--}}
{{--                    <li>--}}
{{--                        <a href="{{ $listGroup->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">--}}
{{--                            <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{__('PREVIOUS')}}</span>--}}
{{--                        </a>--}}
{{--                    </li >--}}
{{--                    &emsp;--}}
{{--                    <li>--}}
{{--                        <a href="{{ $listGroup->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">--}}
{{--                            <span aria-hidden="true">{{__('NEXT')}} <span class="fa fa-angle-right"></span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
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
@endsection
