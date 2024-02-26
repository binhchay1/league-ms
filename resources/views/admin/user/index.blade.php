@extends('layouts.admin')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('List User') }}
@endsection

@section('content')
<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{ __('User') }}</h4>
    <div class="card" style="padding: 10px">
        <div class=" container-xl table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                <thead>
                    <tr class="design-text">
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Images') }}</th>
                        <th scope="col">{{ __('Phone number') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        <th scope="col">{{ __('Date of birth') }}</th>
                        <th scope="col">{{ __('Gender') }}</th>
                        <th scope="col">{{ __('Title') }}</th>

                        <th style="width: 10%" scope="col">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($dataUser as $data)
                    <tr class="design-text">
                        <td>{{ $data->name }}</th>
                        <td>{{ $data->email }}</td>
                        <td><img class="image" src="{{ $data->profile_photo_path ?? asset('/images/default-avatar.png') }}" alt="avatar" width="70" height="70"></td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->address }}</td>
                        <td>{{ $data->age }}</td>
                        <td>{{ $data->sex }}</td>
                        <td>{{ $data->title }}</td>
                        <td class="text_flow text-center">
                            <a href="{{ route('set.title', $data['id']) }}">
                                <button type="button" class="btn btn-success">{{ __('Set Title') }}</button>
                            </a>
                            <a href="{{ route('user.delete', $data['id']) }}">
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

<script src="{{ asset('plugins/jquery/1.7.1/jquery.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#dataTables').DataTable({
            pagingType: 'full_numbers',
        });
        $('.dataTables_length').addClass('bs-select');
    })
</script>
@endsection
