@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail Group') }}
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}" />
    <style>

        .filter-box {
            border-radius: 8px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .form-select {
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .table-box {
            border-radius: 10px;
            overflow: hidden;
        }
        .table {
            border-radius: 10px;
            background: white;
            margin-bottom: 0;
        }
        .table thead {
            background: #f1f1f1;
        }
        .table th, .table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
<div class="">
    <?php   $date = date("d/m/Y", strtotime($groupTrainingDetail->date));
    $start_time= date("H:i", strtotime($groupTrainingDetail->start_time));
    $end_time = date("H:i", strtotime($groupTrainingDetail->end_time));
    ?>
    <div>
        <div class=" text-black p-3 align-items-center"  style="background: #707787;padding: 10px; margin-top: -20px; ">
            <div class="container d-flex  img-fluid" style="color: white">
                <img src="{{ asset($groupTrainingDetail->groups->images) }}" alt="User" width="200" height="200" class=" me-3 " >
                <div>
                    <h2 class="p-0">{{$groupTrainingDetail->name}}</h2>
                    <p class="">
                        <i class="bi bi-bookmark"></i> {{$groupTrainingDetail->description}}
                    </p>
                    <p class="">
                        <i class="bi bi-geo-alt"></i> <em>{{$groupTrainingDetail->location}}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-calendar-event"></i> <em>{{ $date }}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-calendar-check"></i> <em>{{ $start_time}} ~  {{$end_time}}</em>
                    </p>
                    <p class="">
                        <i class="bi bi-card-checklist"></i> <em>{{$groupTrainingDetail->note}}</em>
                    </p>

                    <div style="width: 200%;">

                        @if(!empty($listMembers))
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($listMembers->count() / $groupTrainingDetail->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div> <span class="text1">{{ $listMembers->count() }} {{ __('Applied') }} <span class="text2">of {{ $groupTrainingDetail->number_of_members }}</span></span> </div>
                            </div>
                        @else
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <div> <span class="text1">0 {{ __('Applied') }} <span class="text2">of {{ $groupTrainingDetail->number_of_members }}</span></span> </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>

        <div class="container p-0  mt-4 table-join" >
            <div class="">
                <div class="d-flex">
                    <button class="btn btn-primary">{{'Member Join'}}</button>
                </div>
                <!-- Bảng danh sách -->
                <div class="table-box mt-4">
                    <table class="table">
                        <thead class="bg-blue">
                        <tr >
                            <th>{{'MEMBER'}}</th>
                            <th>{{'EMAIL'}}</th>
                            <th>{{'PHONE'}}</th>
                            <th>{{'ADDRESS'}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listMembers as $member)
                            <tr>
                                <td>
                                    <img src="{{ $member->profile_photo_path ?? asset('/images/no-image.png') }}" width="40" height="40" alt="avatar" class="avatar">
                                    {{ $member->name }}
                                </td>
                                <td><a href="#">{{ $member->email }}</a></td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->address }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
