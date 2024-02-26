@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('List Group') }}
@endsection

@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('Group') }}</h5>
        </div>
        <div class="card-body">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card container">
                    <div class="row product__filter mt-2">
                        @foreach($listGroup as $group)
                            <div class="col-lg-4 mt-2">
                                <div class="" style="background-color: #eff2f4; padding: 5px; margin-bottom: 15px;">
                                    <h5 class="mt-4" style=" text-align: center">{{ $group->name }}</h5>
                                    <img class="image" src="{{ $group->images }}" alt="avatar" style="display: block;margin-left: auto;margin-right: auto;width: 50%; height: 165px; ">
                                    <a href="{{ route('group.show',$group['id']) }}" style="margin-bottom: 10px;width: 70%;margin-left: 55px;" class="btn btn-primary col-sm-12 mt-4 ">{{__('Group Training')}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            pagingType: 'full_numbers',
        });
        $('.dataTables_length').addClass('bs-select');
    })

    setTimeout(function() {
        $('.alert-block').remove();
    }, 5000);
</script>
@endsection
