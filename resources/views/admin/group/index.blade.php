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
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> {{ __('League') }}</h4>
    <div class="card" style="padding: 10px">
        <div class=" container-xl table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                <thead>
                <tr class="design-text">
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Location') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($listGroup as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td><img class="image" src="{{asset($data->images ?? '/images/logo-no-background.png')}}" alt="avatar" style="width: 150px"></td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->location }}</td>
                        <td>
                            <a href="{{ route('group.show',$data['id']) }}">
                                <button type="button" class="btn btn-success">{{__('Create Group Training')}}</button>
                            </a>
                            <a href="{{route('group.edit',$data['id'])}}">
                                <button type="button" class="btn btn-primary">{{ __('Edit') }}</button>
                            </a>
                                <a href="{{route('group.delete', $data['id'])}}">
                                    <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                                </a>
                            @if(Auth::user()->role == 'admin')
                                <a href="{{route('activeGroup', $data['id'])}}" class="btn btn-{{$data->active ? 'info' : 'secondary' }}">
                                    {{$data->active ? "Active Group" : "Inactive Group"}}
                                </a>
                            @endif
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

    setTimeout(function() {
        $('.alert-block').remove();
    }, 5000);
</script>
@endsection
