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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{__('Group')}} </h4>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                        <tr class="design-text">
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Description') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col">{{ __('Activity time') }}</th>
                            <th scope="col">{{ __('Number of members') }}</th>
                            <th scope="col">{{ __('Location') }}</th>
                            <th scope="col">{{ __('Note') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($listGroupTraining as $groupTraining)
                        <tr>
                            <td>{{ $groupTraining->name }}</td>
                            <td>{{ $groupTraining->description }}</td>

                            <?php   $date = date("d/m/Y", strtotime($groupTraining->date));
                                    $start_time= date("H:i", strtotime($groupTraining->start_time));
                                    $end_time = date("H:i", strtotime($groupTraining->end_time));
                            ?>
                            <td>{{ $date }}</td>


                            <td class="">{{__('From: ')}} {{ $start_time }} - {{__('To: ')}} {{ $end_time }}</td>
                            <td class="">{{ $groupTraining->number_of_members }}</td>
                            <td>{{ $groupTraining->location }}</td>
                            <td>{{ $groupTraining->note }}</td>
                            <td>
                                <a href="{{route('edit.groupTraining',$groupTraining['id'])}}">
                                    <button type="button" class="btn btn-primary">{{ __('Edit') }}</button>
                                </a>

                                <a href="{{route('delete.groupTraining', $groupTraining['id'])}}">
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


        setTimeout(function() {
            $('.alert-block').remove();
        }, 5000);
    </script>
@endsection
