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
                            <form id="formAccountSettings" method="POST" action="{{ route('team.store')}}" enctype="multipart/form-data">
                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Logo đội</label>
                                        <div class="form-group" >
                                            <div class="" style="display: inline-grid;">
                                                <input value="" type="file" class="border-0 bg-light pl-0" name="image" id="image" hidden>
                                                <div class=" choose-avatar" >
                                                    <div id="btnimage">
                                                        <img id="showImage" class="show-avatar" style="width: 200px; margin-left: 40px" src="/images/champion.png" alt="avatar">
                                                    </div>
                                                    <div id="button" >
                                                        <i id="btn_chooseImg" class="fas fa-camera" >  Choose image</i>
                                                    </div>
                                                    @if ($errors->has('image'))
                                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label for="lastName" class="form-label">Tên đội</label>
                                            <input class="form-control" type="text" name="name" id="name"/>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-4">
                                            <label for="address" class="form-label">Huấn luyện viên</label>
                                            <input type="text" class="form-control" id="coach" name="coach"/>
                                            @if ($errors->has('coach'))
                                                <span class="text-danger">{{ $errors->first('coach') }}</span>
                                            @endif
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

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script src="{{ asset('js/tournament.js') }}"></script>
@endsection

