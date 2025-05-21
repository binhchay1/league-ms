@if (now() < date('Y-m-d', strtotime($leagueInfor->end_date_register)))
    <div class="container col-md-12 " id="form-reg">
        <div class="league-banner--enroll flex flex-jus-center flex-align-center flex-column gradient">
            <h4 class="text-center mb-10 text-white " style="opacity:1">
                <span class="text-warning hidden" id="deadline-date">09/26/2024</span>
                <span class="text-warning hidden" id="extend-time">23:59:59</span>
                {{ __('The tournament allows online registration until the end of the day.') }} <span class="text-warning"
                    style="color:#efff00">{{ $get_date_register }}</span>
            </h4>
            <div id="clockdiv">
                <div>
                    <span id="data_day" class="days"></span>
                    <div class="smalltext">{{ __('Days') }}</div>
                </div>
                <div>
                    <span id="data_hours" class="hours"></span>
                    <div class="smalltext">{{ __('hours') }}</div>
                </div>
                <div>
                    <span id="data_minutes" class="minutes"></span>
                    <div class="smalltext">{{ __('Minutes') }}</div>
                </div>
                <div>
                    <span id="data_seconds" class="seconds"></span>
                    <div class="smalltext">{{ __('Seconds') }}</div>
                </div>
            </div>
            <div class="mb-20 text-center">
                <button onclick="switchDivs()()" type="button" id="btn-register" class="btn btn-primary "
                    data-bs-toggle="modal" data-bs-target="">
                    <a href="{{ route('league.formRegisterLeague', $leagueInfor->slug) }}"
                        style="color: white !important;">
                        {{ __('Register League') }}</a>
                </button>
            </div>
            <div class="competitor-members mb-20">
                <div class="flex flex-jus-center">
                </div>
            </div>
        </div>
    </div>
@elseif(now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) &&
        now() < date('Y-m-d', strtotime($leagueInfor->start_date)))
    <div class="container col-md-12 " id="form-reg">
        <div class="league-banner--enroll flex flex-jus-center flex-align-center flex-column gradient">
            <h4 class="text-center mb-10 text-white " style="opacity:1">
                <span class="text-warning hidden" id="deadline-date">09/26/2024</span>
                <span class="text-warning hidden" id="extend-time">23:59:59</span>
                {{__('Tournament registration has ended') }} <span class="text-warning"
                    style="color:#efff00">{{ $get_date_register }}</span>
            </h4>
            <div id="clockdiv">
                <div>
                    <span id="" class="days"></span>
                    <div class="smalltext">{{ __('Days') }}</div>
                </div>
                <div>
                    <span id="" class="hours"></span>
                    <div class="smalltext">{{ __('hours') }}</div>
                </div>
                <div>
                    <span id="" class="minutes"></span>
                    <div class="smalltext">{{ __('Minutes') }}</div>
                </div>
                <div>
                    <span id="" class="seconds"></span>
                    <div class="smalltext">{{ __('Seconds') }}</div>
                </div>
            </div>
            <div class="competitor-members mb-20">
                <div class="flex flex-jus-center">
                </div>
            </div>
        </div>
    </div>
@endif
