@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="card card-default">
        <div class="card-header">
            <h5>{{ __('League') }}</h5>
        </div>
        <div class="card" style="padding: 10px">
            <div class=" container-xl table-responsive text-nowrap">
                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="dataTables">
                    <thead>
                    <tr class="design-text">
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Image') }}</th>
                        <th scope="col">{{ __('Start Date') }}</th>
                        <th scope="col">{{ __('End Date') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listLeagues as $league)
                        @if($league->status == 1)
                        <tr>
                            <td>{{ $league->name }}</td>
                            <td><img class="image" src="{{asset($league->images ?? '/images/logo-no-background.png')}}" alt="avatar" style="width: 150px"></td>
                            <td>{{ $league->start_date }}</td>
                            <td>{{ $league->end_date }}</td>
                            <td>
                                <a href="{{ route('schedule.leagueSchedule', $league['slug']) }}" style="margin-bottom: 10px;width: 70%;margin-left: 40px;" class="btn btn-success col-sm-12 mt-4 ">{{__('Create Schedule')}}</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
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
