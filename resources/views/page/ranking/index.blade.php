@extends('layouts.page')

@php
    use App\Enums\Utility;$utility = new Utility();
@endphp

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Ranking') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/ranking.css') }}"/>
    <link rel="stylesheet" id="bwf-style-css" href="{{asset('css/page/homepage.css')}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM0sYq/xRSs+/Doh4Z2F4E4FIk5hpuYlDkkpM" crossorigin="anonymous">


@endsection

@section('content')
    <section class="container rankings-section pb-200" id="ranking">
        <div class="std-title">
            <div class="std-title-left d-flex " style="justify-content: space-between">
                <h2 class="left" style=" font-weight: 400; color: black; margin: 0">{{ __('Badominton Ranking') }}</h2>
            </div>
            <div>
                <div class="mx-auto my-3 ">
                    <div class="input-group">
                        <input type="text"  id="myInput" class="form-control border-gray-200" placeholder="player..." onkeyup="myFunction()">
                        <button class="border-gray-200 input-group-text  text-black"><i class="fas fa-search fa-2x"></i></button>

                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-ranking d-flex" style="padding-top: 0; padding-bottom: 0;  ">
            <?php $updated = date('D, j F, Y H:i a', strtotime($ranking[0]->updated_at)) ?>
            <p class="fw-bold" style="font-weight: 600!important;">{{ __('Last updated') }}: {{ $updated }}</p>

        </div>

        <div class="tab-content rankings-content_tabpanel">
            <div class="top-ranked-wrap">
                @foreach($listRank as $index => $rank)
                    <div class="top-ranked-left-single">
                        <div class="top-ranked-avatar">
                            <img class=" b-error b-error" style="width: 300px; height: 300px"
                                 src="{{asset($rank->users->profile_photo_path ?? asset('/images/no-image.png')) }}">
                        </div>
                    </div>
                    <div class="top-ranked-right-single">
                        <div class="top-ranked-country-wrap">
                            <div class="top-ranked-country">
                                <p style="color: white; font-size: 20px; font-weight: 500">{{ $rank->users->name }}</p>
                            </div>
                        </div>
                        <div class="top-ranked-info-wrap">
                            <div class="top-ranked-ranking">
                                <span>{{ __('Ranking') }}</span>
                                <span>{{ $index+1 }}</span>
                            </div>

                            <div class="top-ranked-extra-wrap">
                                <div class="top-ranked-points">
                                    <span>{{ __('Points') }}</span>
                                    <span>{{ $rank->points }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="item active mt-4 " style="margin-bottom: 50px">
                <table border="0" cellpadding="0" cellspacing="0" class="rankings-table" width="100%" id="myTable">
                    <thead>
                    <tr height="54">
                        <th align="center" class="text-center">{{ __('RANK') }}</th>
                        <th align="center" class="text-center">{{ __('AVATAR') }}</th>
                        <th class="rank-col_no3 text-left">{{ __('PLAYER') }}</th>
                        <th align="center" class="text-center">{{ __('POINTS') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listRankings as $index => $rank)
                        <tr>
                            <td align="center">
                                {{ $index + 1 }}
                            </td>
                            <td align="center">
                                <img class=" b-error b-error" style="width: 70px; height: 70px; padding: 10px"
                                     src="{{asset($rank->users->profile_photo_path ?? asset('/images/no-image.png')) }}">
                            </td>
                            <td align="center">
                                {{ $rank->users->name ?? "" }}
                            </td>
                            <td align="center">
                                {{ $rank->points }}
                            </td>

                            <td align="center" class="breakdown">
                                <div class="showPopup" id="61628">
                                    <i aria-hidden="true" class="fa fa-bar-chart"></i>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginate -->
            <?php $countRank = count($ranking); ?>
            @if($countRank > $listRankings->perPage())
                <div class="navigator short mt-4">
                    <div class="head d-flex justify-content-center ">
                        <ul class="pagination">
                            <li>
                                <a href="{{ $listRankings->previousPageUrl() }}" aria-label="Previous"
                                   style="color: red" class="prevPlayersList">
                                    <span aria-hidden="true"><span
                                            class="fa fa-angle-left"></span> {{__('PREVIOUS')}}</span>
                                </a>
                            </li>
                            &emsp;
                            <li>
                                <a href="{{ $listRankings->nextPageUrl() }}" aria-label="Next" style="color: red"
                                   class="nextPlayersList">
                                    <span aria-hidden="true">{{__('NEXT')}} <span
                                            class="fa fa-angle-right"></span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>

    </section>

@endsection

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
