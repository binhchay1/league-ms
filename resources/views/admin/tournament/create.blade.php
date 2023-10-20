@extends('layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Create Tournament</h5>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" action="{{ route('tournament.store') }}">
                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Logo giải đấu</label>
                                        <div class="form-group" >
                                            <div class="mt-4" style="display: inline-grid;">
                                                <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                                <div class=" choose-avatar" >
                                                    <div id="btnimage">
                                                        <img id="showImage" class="show-avatar" src="/images/champion.png" alt="avatar">
                                                    </div>
                                                    <div id="button" >
                                                        <i id="btn_chooseImg" class="fas fa-camera"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Tên giải đấu</label>
                                        <input class="form-control" type="text" name="name" id="name"  />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Ngày bắt đầu</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Address" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Ngày kết thúc</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Address" />
                                    </div>
                                    <div class="" style="margin-top: 10px">
                                        <label class="form-label" for="country">Hình thức thi đấu</label>
                                        <select id="format" name="format" class="select2 form-select">
                                            @foreach($formatTour as $formatTour => $value)
                                                <option id="format" value="{{$value}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="">
                                        <label for="lastName" class="form-label">Đội tham gia</label>
                                        <input class="form-control" type="text" name="number_of_team" id="number_of_team"  />
                                    </div>

                                    <div class="">
                                        <label for="lastName" class="form-label">Người tham gia mỗi đội</label>
                                        <input class="form-control" type="text" name="people_of_team" id="people_of_team"  />
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/tournament.js') }}"></script>
@endsection
