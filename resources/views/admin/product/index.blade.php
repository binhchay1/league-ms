@extends('layouts.admin')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('List Post') }}
@endsection

@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{ __('List Post') }}</h4>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Images') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                            <th scope="col">{{ __('Price') }}</th>
                            <th scope="col">{{ __('Location') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listProduct as $data)
                        <tr>
                            <td>
                                <div class="btn {{ $data->status == 'pending' ? 'btn-warning' : ($data->status == 'accepted' ? 'btn-success' : 'btn-secondary') }}">
                                    {{ $data->status == 'pending' ? 'Pending' : ($data->status == 'accepted' ? 'Accepted' : 'Rejected') }}
                                </div>
                            </td>
                            <td>{{ $data->name }}</td>
                            <td><img class="image" src="{{ asset( $data->images ?? '/images/champion.png') }}" alt="avatar" style="width: 150px"></td>
                            <td>{{ $data->categories->name ?? "" }}</td>
                            <td>{!! Str::limit(strip_tags(html_entity_decode($data->description)), 50)!!}</td>

                            <td>{{ $data->price }}</td>
                            <td>{{ $data->location }}</td>
                            <td>
                                <a href="{{ route('product.edit') }}?id={{ $data['id'] }}">
                                    <button type="button" class="btn btn-info">{{ __('Edit') }}</button>
                                </a>
                                <a href="{{ route('product.delete') }}?id={{ $data['id'] }}">
                                    <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                </a>
                                <a href="{{ route('product.accept') }}?id={{ $data['id'] }}">
                                    <button type="button" class="btn btn-success">{{ __('Accepted') }}</button>
                                </a>
                                <a href="{{ route('product.reject') }}?id={{ $data['id'] }}">
                                    <button type="button" class="btn btn-secondary">{{ __('Rejected') }}</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
    </script>
@endsection
