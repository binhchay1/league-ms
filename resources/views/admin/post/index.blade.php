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
                        <th scope="col">{{ __('Title') }}</th>
                        <th scope="col">{{ __('Category') }}</th>
                        <th scope="col">{{ __('Content') }}</th>
                        <th scope="col">{{ __('Thumbnail') }}</th>
                        <th scope="col">{{ __('Author') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($listPosts as $data)
                    <tr>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->category->name ?? "" }}</td>

                        <td>{!! Str::limit(strip_tags(html_entity_decode($data->content)), 50)!!}</td>
                        <td><img class="image" src="{{asset($data->thumbnail ?? '/images/logo-no-background.png')}}" alt="avatar" style="width: 150px"></td>
                        <td>{{ $data->user->name ?? "" }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ route('post.edit', $data['id']) }}">
                                <button type="button" class="btn btn-primary">{{ __('Edit') }}</button>
                            </a>
                            <a href="{{ route('post.destroy', $data['id']) }}">
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
