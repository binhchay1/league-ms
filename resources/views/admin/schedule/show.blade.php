@extends('layouts.admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ __('Result') }}</h5>
    <a href="{{route('schedule.index')}}">
        <button type="reset" class="btn btn-primary" >{{ __('Back') }}</button></a>
    <div class="card container">
        <div class="row justify-content-start m-1 mb-2 mt-2">
            <h4>{{ __('Round') }}: {{ $dataSchedule->round }}</h4>
        </div>
        <div class="row">
            <div class="col-lg-5 mt-4 text-center">
                <strong>{{ $dataSchedule->player1Team1->name ?? ""}} / {{ $dataSchedule->player2Team1->name ?? "" }}</strong>
            </div>

            <div class="col-lg-2 text-center" style="vertical-align: middle;line-height: 40px;">
                <?php $date = date("m-d-Y", strtotime($dataSchedule->date)) ?>
                <strong> {{ $date }} &nbsp {{ $dataSchedule->time }} </strong>
            </div>

            <div class="col-lg-5 mt-4 text-center">
                <strong>{{ $dataSchedule->player1Team2->name ?? "" }} / {{ $dataSchedule->player2Team2->name ?? "" }}</strong>
            </div>
        </div>
        <div class="form-group text-right m-0 p-0 pt-5 pb-5 d-flex justify-content-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('Update Result') }}
            </button>
        </div>
        <form action="{{ route('schedule.updateResult', $dataSchedule['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{ $dataSchedule->league_id }}" name="league_id" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{ $dataSchedule->match }}" name="match" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{ $dataSchedule->time}}" name="time" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{ $dataSchedule->date }}" name="date" id="name" hidden />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" value="{{ $dataSchedule->stadium }}" name="stadium" id="name" hidden />
                        </div>
                        <div class="row container">
                            <div class="col-md-6">
                                <div class="text-center" style="font-size: 30px">
                                    <p>{{ $dataSchedule->player1Team1->name ?? ""}} / {{ $dataSchedule->player2Team1->name ?? "" }}</p>
                                </div>
                                <div class="container">
                                    <div class="form-group">
                                        <input class="form-control" value="" type="text" name="" id="name" hidden />
                                    </div>

                                    <div class="form-group mt-4">
                                        <strong>{{ __('Final Score') }}</strong>
                                        <input class="form-control" type="number" name="result_team_1" id="result_team_1" min="1" />
                                        @if ($errors->has('result_team_1'))
                                        <span class="text-danger">{{ $errors->first('result_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 1 ') }}</strong>
                                        <input class="form-control" type="text" name="set_1_team_1" id="name" />
                                        @if ($errors->has('set_1_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_1_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 2') }}</strong>
                                        <input class="form-control" type="text" name="set_2_team_1" id="name" />
                                        @if ($errors->has('set_2_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_2_team_1') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 3') }}</strong>
                                        <input class="form-control" type="text" name="set_3_team_1" id="name" />
                                        @if ($errors->has('set_3_team_1'))
                                        <span class="text-danger">{{ $errors->first('set_3_team_1') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center" style="font-size: 30px">
                                    <p>{{ $dataSchedule->player1Team2->name ?? "" }} / {{ $dataSchedule->player2Team2->name ?? "" }}</p>
                                </div>
                                <div class="container">
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="" name="" id="name" hidden />
                                    </div>
                                    <div class="form-group mt-4">
                                        <strong>{{ __('Final Score') }}</strong>
                                        <input class="form-control" type="number" name="result_team_2" id="result_team_2" />
                                        @if ($errors->has('result_team_2'))
                                        <span class="text-danger">{{ $errors->first('result_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 1') }}</strong>
                                        <input class="form-control" type="text" name="set_1_team_2" id="name" />
                                        @if ($errors->has('set_1_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_1_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 2') }}</strong>
                                        <input class="form-control" type="text" name="set_2_team_2" id="name" />
                                        @if ($errors->has('set_2_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_2_team_2') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Set 3') }}</strong>
                                        <input class="form-control" type="text" name="set_3_team_2" id="name" />
                                        @if ($errors->has('set_3_team_2'))
                                        <span class="text-danger">{{ $errors->first('set_3_team_2') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center" style="margin: 10px;">
                                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
