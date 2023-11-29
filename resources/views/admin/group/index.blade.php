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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{__('Nhóm')}} </h4>
    <div class="card" style="padding: 10px">
        <div class=" container-xl table-responsive text-nowrap">
            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                <thead>
                    <tr class="design-text">
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Activity time') }}</th>
                        <th scope="col">{{ __('Number of members') }}</th>
                        <th scope="col">{{ __('Location') }}</th>
                        <th scope="col">{{ __('Rate') }}</th>
                        <th scope="col">{{ __('Images') }}</th>
                        <th scope="col">{{ __('Note') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
                        <th scope="col">{{ __('Group owner') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($listGroup as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td class="text-center">{{ $group->activity_time }}</td>
                        <td class="text-center">{{ $group->number_of_members }}</td>
                        <td>{{ $group->location }}</td>
                        <td>{{ $group->rate }}</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <img class="image" src="{{ $group->images == null ? asset('/images/default-group-avatar.png') : $group->images }}" alt="avatar" width="40" height="40">
                                </div>
                            </div>
                        </td>
                        <td>{{ $group->note }}</td>
                        <td class="text-center">{{ ucfirst($group->status) }}</td>
                        <td class="text-center">{{ $group->status == 1 ? 'Active' : 'De-active' }}</td>
                        <td class="text-center">{{ $group->users->name }}</td>
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
