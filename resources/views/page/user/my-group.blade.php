@extends('layouts.page')

@section('title')
{{ env('APP_NAME', 'Badminton.io') }} - {{ __('My Group') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/page/group.css') }}">
@endsection

@section('content')
<section id="heading">
    <div class="container">
        <h2 style="font-weight: 400" class="">{{ __('My Group') }}</h2>
    </div>
</section>

<section id="about" class="container">
    <div class="row">
        @if(count($listGroup) > 0)
        @foreach($listGroup as $row)
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
                    <p>■  {{ __('Description') }}: {{ $row->description }}</p>
                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>
                    <p>■  {{ __('Location') }}: {{ $row->location }}</p>
                    <p><span class="">■ {{ __('Number of member') }} : </span>{{ $row->number_of_members }}</p>
                    <p class="">----- {{ __('Note') }}: {{ $row->note }}</p>
                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" <?php echo 'style="width:' . ($row->group_users->count() / $row->number_of_members * 100) . '%"' ?> aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div> <span class="text1">{{ $row->group_users->count() }} {{ __('Applied') }} <span class="text2">of {{ $row->number_of_members }}</span></span> </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
            @else
            <div class="text-center">
                <img class="" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                <h4 >{{ __('There are no groups !') }}</h4>
            </div>
            @endif
    </div>

    <!-- Paginate -->
    <?php $countGroup= count($listGroup); ?>
    @if($countGroup > $listGroup->perPage())
        <div class="navigator short mt-4" >
            <div class="head d-flex justify-content-center ">
                <ul class="pagination">
                    <li>
                        <a href="{{ $listGroup->previousPageUrl() }}" aria-label="Previous" style="color: red" class="prevPlayersList">
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
<script>
    function detailGroup(id) {
        let name = id.substring(6);
        let url = '/detail-group?g_i=' + name;

        window.location.href = url;
    }
</script>
@endsection
