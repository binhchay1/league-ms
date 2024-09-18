@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('My League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/page/my-league.css') }}">
@endsection

@section('content')
    <section id="heading">
        <div class="container">
            <h2 style="font-weight: 400" class="">{{ __('My League') }}</h2>
        </div>
    </section>

    <section id="about" class="container">
        <div class="row">
            @if(count($listLeague) > 0)
                @foreach($listLeague as $row)
                    <div class="wp-group">
                        <div class="wp-group-content mb-4">
                            <div class="d-flex gr-title" >
                                <div class=" align-items-center">
                                    <img class="avatar-group"  style="padding: 5px" src="{{ asset($row-> images ?? 'https://png.pngtree.com/png-clipart/20230817/original/pngtree-badminton-icon-logo-and-sport-club-template-vector-vector-picture-image_10923178.png')  }}" data-id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                                </div>
                                <div  class="c-details-group name-group" data-id="group-{{ $row->name }}" id="group-{{ $row->name }}" onclick="detailGroup(this.getAttribute('data-id'))">
                                    <h6 class="mb-0 gr-name">{{ $row->name }}</h6>
                                </div>
                            </div>

                            <hr>
                            <div class="mt-3 descript-group">
                                <p>* {{ __('Start Date') }}: <?php echo date('d/m/Y', strtotime($row->start_date));?> </p>
                                <p>* {{ __('End Date') }}: <?php echo date('d/m/Y', strtotime($row->end_date));?></p>
                                <p>* {{ __('Location') }}: {{ $row->location }}</p>
                                <div>
                                    <button  class="btn btn-{{$row->status ? 'info' : 'secondary' }}">
                                        {{$row->status ? "Activated" : "Inactive"}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                    <h4 >{{ __('There are no leagues!') }}</h4>
                </div>
            @endif
        </div>

        <!-- Paginate -->
        <?php $countLeague= count($listLeague); ?>
        @if($countLeague > $listLeague->perPage())
            <div class="navigator short mt-4" >
                <div class="head d-flex justify-content-center ">
                    <ul class="pagination">
                        <li>
                            <a href="{{ $listLeague->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
                                <span aria-hidden="true"><span class="fa fa-angle-left"></span> {{__('PREVIOUS')}}</span>
                            </a>
                        </li >
                        &emsp;
                        <li>
                            <a href="{{ $listGroup->nextPageUrl() }}" aria-label="Next" style="color: red" class="nextPlayersList">
                                <span aria-hidden="true">{{__('NEXT')}} <span class="fa fa-angle-right"></span></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </section>
@endsection

@section('js')
@endsection
