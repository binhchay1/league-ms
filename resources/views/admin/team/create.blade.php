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
                            <form id="formAccountSettings" method="POST" action="{{ route('team.store') }}">
                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Logo đội</label>
                                        <div class="form-group" >
                                            <div class="" style="display: inline-grid;">
                                                <input value="" type="file" class="border-0 bg-light pl-0" name="logo" id="image" hidden>
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
                                    <div class="col-md-6">
                                        <div>
                                            <label for="lastName" class="form-label">Tên đội</label>
                                            <input class="form-control" type="text" name="name" id="name"/>
                                        </div>
                                        <div class="mt-4">
                                            <label for="address" class="form-label">Huấn luyện viên</label>
                                            <input type="text" class="form-control" id="coach" name="coach"/>
                                        </div>
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
