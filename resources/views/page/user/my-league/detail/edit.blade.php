
<style>
    .league-tour {
        background: #eeeeee;
        padding: 10px;
    }

    .btn-success {
        padding: 10px;
    }

    .form-control {
        line-height: 2.5 !important;
    }

    .btn-success {
        margin-bottom: 10px;
    }

    .form-league {
        padding: 50px !important;
    }

    h2.text-left {
        font-weight: 400;
        color: black;
        margin: 0;
        font-size: 28px;
    }

</style>

<div class="container mt-4 league-tour">
    <h2 class="text-left">{{'League Information'}}</h2>
    <hr>
    <form id="formAccountSettings" method="POST" action="{{ route('my.updateMyLeagueMyLeague', $leagueInfor->id) }}" enctype="multipart/form-data">
        @csrf()
        <div class="row mb-3 form-league">
            <div class="col-md-3">
                <label>{{ __('Logo league') }}</label>
                <input value="" type="file" class="border-0 bg-light pl-0" name="images" id="image" hidden>
                <div class=" choose-avatar">
                    <div id="btnimage">
                        <img id="showImage" class="show-avatar" src="{{asset($leagueInfor->images ?? '/images/logo-no-background.png')}}"  alt="avatar" style="width: 200px;">
                    </div>

                    <div id="button">
                        <i id="btn_chooseImg" class="fas fa-camera"> {{ __('Choose Image') }}</i>
                    </div>

                </div>
                @if ($errors->has('images'))
                    <span class="text-danger">{{ $errors->first('images') }}</span>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="lastName" class="form-label">{{__('Name')}}</label>
                        <input class="form-control" value="{{ old('name', $leagueInfor['name']) }}" type="text" name="name" id="name" placeholder="{{ __('Enter league name') }}"/>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastName" class="form-label">{{ __('Prize money') }}</label>
                            <input class="form-control" value="{{ old('money', $leagueInfor['money']) }}" type="text" name="money" id="money" placeholder="{{ __('Enter league money') }}"/>
                            @if ($errors->has('money'))
                                <span class="text-danger">{{ $errors->first('money') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-6" hidden>
                    <label for="lastName" class="form-label">{{ __('Slug') }}</label>
                    <input class="form-control" value="{{ old('slug', $leagueInfor['slug']) }}" type="text" name="slug" id="slug" placeholder="{{ __('Enter league slug') }}"/>
                    @if ($errors->has('slug'))
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('Start date league') }}</label>
                            <input type="date" value="{{ old('start_date', $leagueInfor['start_date']) }}" class="form-control" id="start_date" name="start_date"  placeholder="{{ __('Enter league start date') }}"/>
                            @if ($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('End date league') }}</label>
                            <input type="date" value="{{ old('end_date', $leagueInfor['end_date']) }}" class="form-control" id="end_date" name="end_date"  placeholder="{{ __('Enter league end date ') }}"/>
                            @if ($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('Register date league ') }}</label>
                            <input type="datetime-local" value="{{ old('end_date_register',$leagueInfor['end_date_register']) }}" class="form-control" id="end_date_register" name="end_date_register" placeholder="{{ __('Enter league register date') }}"/>
                            @if ($errors->has('end_date_register'))
                                <span class="text-danger">{{ $errors->first('end_date_register') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastName" class="form-label">{{ __('Start time league') }}</label>
                            <input class="form-control" value="{{ old('start_time',$leagueInfor['start_time']) }}" type="time" name="start_time" id="start_time" placeholder="{{ __('Enter league start time') }}"/>
                            @if ($errors->has('start_time'))
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label for="lastName" class="form-label">{{ __('Location') }}</label>
                        <input class="form-control" value="{{ old('location',$leagueInfor['location']) }}"type="text" name="location" id="location" placeholder="{{ __('Enter league location') }}"/>
                        @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label class="form-label">{{'Number of players'}}</label>
                        <select class="form-select" name="number_of_athletes" value="{{ $leagueInfor->number_of_athletes }}">
                            @foreach($listPlayer as $number => $value)
                                <option id="" value="{{ $value }}" {{$value == $leagueInfor->number_of_athletes ? 'selected' : ''}}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">{{'Type league'}}</label>
                        <select class="form-select" name="type_of_league" value="{{ $leagueInfor->type_of_league }}">
                            @foreach($listTypeLeague as $number => $value)
                                <option id="" value="{{ $value }}" {{$value == $leagueInfor->type_of_league ? 'selected' : ''}}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label  class="form-label">{{ __('Format league') }}</label>
                            <select class="form-select" name="format_of_league" value="{{ $leagueInfor->format_of_league }}">
                                @foreach($listFormatLeague as $number => $value)
                                    <option id="" value="{{ $value }}" {{$value == $leagueInfor->format_of_league ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-12">
            <button class="btn btn-success w-10 mt-4 mb-12">{{'Update '}}</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/eventImage.js') }}"></script>

