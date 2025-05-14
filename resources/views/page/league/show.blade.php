@extends('layouts.page')

@section('title')
    {{ env('APP_NAME', 'Badminton.io') }} - {{ __('Detail League') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/page/show.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    @if(Route::current()->getName() == 'leagueResult.bracket')
        <link rel="stylesheet" href="{{ asset('css/page/bracket.css') }}"/>
    @endif
@endsection

@section('content')
    <?php
    $currentDate = strtotime(date("Y-m-d"));
    $startDate = strtotime(date($leagueInfor->start_date));
    $end_date_register = strtotime($leagueInfor->end_date_register);
    $get_date_register = date('d/m/Y', strtotime($leagueInfor->end_date_register));
    $format_register_date = $leagueInfor->end_date_register;
    ?>
    @if ($hasEnded )
        <div id="winner-popup" style="margin-top: -30px" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90 text-white">
            {{-- Nút đóng (góc trên phải màn hình) --}}
            <button onclick="closeWinnerPopup()" id="popup-close" class="absolute top-4 right-6 text-white text-3xl hover:text-red-500 z-50">
                &times;
            </button>

            {{-- Nội dung popup --}}
            <div class="relative z-10 text-center bg-gray-900 bg-opacity-80 px-6 py-8 rounded-lg shadow-lg">
                <h2 class="text-2xl text-yellow-400 font-bold mb-4">{{'Congratulations to the defending champions of the tournament!'}}</h2>
                <img src="{{ asset('/images/player-team.jpg') }}" class="mx-auto w-32 h-32 rounded-full border-4 border-yellow-500 mb-4" alt="Winner Avatar">
                <h4 class="text-xxl text-white font-semibold">{{ "Thủy-Oanh" }}</h4>

                {{-- Canvas pháo hoa --}}
                <canvas id="canvas"></canvas>
            </div>
        </div>

    @endif
    <div id="page" class="hfeed site" style="{{ $hasEnded ? 'display: none;' : '' }}; margin-top: -20px">
        <div class=" results ">
            <div class="wrapper-results" id="league-detail">
                <div class="" style="background: #707787;padding: 10px; margin-top: -20px; color: white">
                    <div class="container d-flex mt-4">
                        <div class=" logo-left">
                            <img src="{{ asset($leagueInfor->images ?? '/images/logo-no-background.png') }}"
                                 class="show-image-league" alt="logo">
                        </div>
                        <div class="" id="info-league">
                            <h2 class="p-0">{{ $leagueInfor->name }}</h2>
                            <p class="card-text display"><?php echo number_format($leagueInfor->money ?? 0) . " VND"?> || {{$leagueInfor->type_of_league}}  || {{$leagueInfor->location}}</p>
                            <p class="display">
                                <i class="bi bi-geo-alt"></i> <em>{{ __('Location: ') }} {{$leagueInfor->location}}</em>
                            </p>
                            <?php $start_date = date('d/m/Y', strtotime($leagueInfor->start_date));
                            $end_date = date('d/m/Y', strtotime($leagueInfor->end_date));
                            ?>
                            <p class="display">
                                <i class="bi bi-calendar"></i> <em>{{'From: '}} {{$start_date}} ~ {{'To: '}}{{$end_date}}</em>
                            </p>
                            <p class="display">
                                <i class="bi bi-people-fill"></i> <em>{{ __('Member: ') }} {{$leagueInfor->number_of_athletes}}</em>
                            </p>
                        </div>
                    </div>
                    <div class="container d-flex gap-2 mt-4">
                        @if(now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                            <a href="{{ route('showGeneralNews.info', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('showGeneralNews.info') ? 'active' : '' }}">
                                {{ __('News') }}
                            </a>
                            <a href="{{ route('leagueResult.info', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('leagueResult.info') ? 'active' : '' }}">
                                {{ __('Result') }}
                            </a>
                            <a href="{{ route('showRank.info', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('showRank.info') ? 'active' : '' }}">
                                {{ __('Rank') }}
                            </a>
                        @endif
                        @if( $currentDate < $startDate)
                            <a href="{{ route('registerLeague.info', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('registerLeague.info') ? 'active' : '' }}">
                                {{ __('Register League') }}
                            </a>

                            <a href="{{ route('showListRegister.info', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('showListRegister.info') ? 'active' : '' }}">
                                {{ __('List Register') }}
                            </a>
                        @endif
                        @if($leagueInfor->format_of_league == "knockout")
                            <a href="{{ route('leagueResult.bracket', $leagueInfor['slug']) }}"
                               class="btn-custom {{ request()->routeIs('leagueResult.bracket') ? 'active' : '' }}">
                                {{ __('Bracket') }}
                            </a>
                        @endif

                        <a href="{{ route('leagueSchedule.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('leagueSchedule.info') ? 'active' : '' }}">
                            {{ __('Schedule') }}
                        </a>

                        <a href="{{ route('leaguePlayer.info', $leagueInfor['slug']) }}"
                           class="btn-custom {{ request()->routeIs('leaguePlayer.info') ? 'active' : '' }}">
                            {{ __('Player') }}
                        </a>

                        @if(Auth::check() && Auth::user()->id == $leagueInfor->owner_id)
                            <div class="dropdown">
                                <a class="btn-custom dropdown-toggle {{ request()->routeIs('my.infoMyLeague') ? 'active' : '' }}"
                                   data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    {{ __('Setting') }} <i class="bi bi-gear"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('my.infoMyLeague', $leagueInfor['slug']) }}">League Information</a></li>
                                    <li><a class="dropdown-item" href="#">Delete League</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

{{--                @if(now() < date('Y-m-d', strtotime($leagueInfor->end_date_register)))--}}

{{--                @if(Route::is('league.info') )--}}
{{--                    <div class="container col-md-12 " id="form-reg">--}}
{{--                        <div class="league-banner--enroll flex flex-jus-center flex-align-center flex-column gradient">--}}
{{--                            <h4 class="text-center mb-10 text-white " style="opacity:1">--}}
{{--                                <span class="text-warning hidden" id="deadline-date">09/26/2024</span>--}}
{{--                                <span class="text-warning hidden" id="extend-time">23:59:59</span>--}}
{{--                                {{'The tournament allows online registration until the end of the day.'}} <span class="text-warning"--}}
{{--                                                                                    style="color:#efff00">{{ $get_date_register }}</span>--}}
{{--                            </h4>--}}
{{--                            <div id="clockdiv">--}}
{{--                                <div>--}}
{{--                                    <span id="data_day" class="days"></span>--}}
{{--                                    <div class="smalltext">{{__('Days')}}</div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <span id="data_hours"  class="hours"></span>--}}
{{--                                    <div class="smalltext">{{__('hours')}}</div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <span id="data_minutes"  class="minutes"></span>--}}
{{--                                    <div class="smalltext">{{__('Minutes')}}</div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <span id="data_seconds"  class="seconds"></span>--}}
{{--                                    <div class="smalltext">{{__('Seconds')}}</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="mb-20 text-center">--}}
{{--                                <button onclick="switchDivs()()" type="button" id="btn-register" class="btn btn-primary " data-bs-toggle="modal"--}}
{{--                                        data-bs-target="">--}}
{{--                                    <a href="{{route('league.formRegisterLeague', $leagueInfor->slug)}}" style="color: white !important;">--}}
{{--                                        {{ __('Register League') }}</a>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="competitor-members mb-20">--}}
{{--                                <div class="flex flex-jus-center">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                @elseif(now() > date('Y-m-d', strtotime($leagueInfor->end_date_register)) && now() < date('Y-m-d', strtotime($leagueInfor->start_date)) )--}}
{{--                    @if(Route::is('league.info') )--}}
{{--                        <div class="container col-md-12 " id="form-reg">--}}
{{--                            <div class="league-banner--enroll flex flex-jus-center flex-align-center flex-column gradient">--}}
{{--                                <h4 class="text-center mb-10 text-white " style="opacity:1">--}}
{{--                                    <span class="text-warning hidden" id="deadline-date">09/26/2024</span>--}}
{{--                                    <span class="text-warning hidden" id="extend-time">23:59:59</span>--}}
{{--                                    {{'Tournament registration has ended'}} <span class="text-warning" style="color:#efff00">{{ $get_date_register }}</span>--}}
{{--                                </h4>--}}
{{--                                <div id="clockdiv">--}}
{{--                                    <div>--}}
{{--                                        <span id="" class="days"></span>--}}
{{--                                        <div class="smalltext">{{__('Days')}}</div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <span id=""  class="hours"></span>--}}
{{--                                        <div class="smalltext">{{__('hours')}}</div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <span id=""  class="minutes"></span>--}}
{{--                                        <div class="smalltext">{{__('Minutes')}}</div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <span id=""  class="seconds"></span>--}}
{{--                                        <div class="smalltext">{{__('Seconds')}}</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="competitor-members mb-20">--}}
{{--                                    <div class="flex flex-jus-center">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endif--}}
                <div class="container wrapper-content-results" style="padding: 0px; margin-top: 18px;">
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content" id="modal-content">
                                <div class="modal-header">

                                    <h4  class="modal-title">{{ __('Register League') }}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                @if(Auth::check())
                                    <div id="form-register" class="hidden">
                                        <div class="infor" >
                                            <h1 align="center">{{__('Confirm Information')}}</h1>
                                            <form id="formAccountSettings" method="POST"
                                                  action="{{route('registerLeague')}}" enctype="multipart/form-data">
                                                @csrf()
                                                <div class="tab-content rankings-content_tabpanel">
                                                    <div class="item">
                                                        <table width="100%"
                                                               class="min-w-full border border-gray-300 border-collapse text-sm">
                                                            <thead align="center">
                                                            <tr class="tr-title" style="background: #596377">
                                                                <th style="text-align: center" class="col-rank"
                                                                    align="center">{{ __('Name') }}</th>
                                                                <th style="text-align: center" class="col-country"
                                                                    align="center">{{ __('Image') }}</th>
                                                                <th style="text-align: center"
                                                                    class="col-player">{{ __('Email') }}</th>
                                                                <th style="text-align: center" class="col-points"
                                                                    align="center">{{ __('Address') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tr class="row-top-eight">
                                                                <input type="hidden" name="league_id" id=""
                                                                       value="{{ $leagueInfor->id }}">
                                                                <input type="hidden" name="end_date_register" id=""
                                                                       value="{{ $leagueInfor->end_date_register }}">
                                                                <input type="hidden" name="start_date" id=""
                                                                       value="{{ $leagueInfor->start_date }}">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="status" value="0">
                                                                <td align="center">
                                                                    {{ Auth::user()->name }}
                                                                </td>
                                                                <td align="center">
                                                                    <div class="country">
                                                                        <img width="48"
                                                                             src="{{ asset(Auth::user()->profile_photo_path ?? '/images/no-image.png') }}"
                                                                             title="Japan" class="flag image-user">
                                                                    </div>
                                                                </td>

                                                                <td align="center" class="data-player">
                                                                    <div class="player">
                                                                        {{ Auth::user()->email }}
                                                                    </div>
                                                                </td>
                                                                <td class="data-points" align="center">
                                                                    {{ Auth::user()->address }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- Checkbox -->
                                                <div class="checkbox text-center my-4">
                                                    <label for="check">{{ __('You should check your information again before submitting.') }}</label>
                                                </div>

                                                <!-- Button bị disable ban đầu -->
                                                <div class="mt-4 text-center">
                                                    <button type="submit" id="submit-reg"
                                                            class="btn btn-success me-2" >{{ __('Send Information') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                @else
                                    <div align="center">
                                        <img class="avatar-group" width="200" height="200" src="{{ asset('/images/logo-no-background.png') }}">

                                        <h4 class="mt-4 login-redriect">{{ __('Please')}}
                                            <a
                                                href="{{ route('login') }}">{{__('login')}}</a>
                                            {{__('before registering for the tournament!') }}
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="content-results">
                        <div class="item-results">
                            @if(Route::current()->getName() == 'leaguePlayer.info')
                                <div>
                                    @include('page.league.detail.player')
                                </div>
                            @elseif(Route::current()->getName() == 'showListRegister.info')
                                <div>
                                    @include('page.league.detail.player-register')
                                </div>
                            @elseif(Route::current()->getName() == 'showGeneralNews.info')
                                <div>
                                    @include('page.league.detail.news')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueResult.info')
                                <div>
                                    @include('page.league.detail.result')
                                </div>
                            @elseif(Route::current()->getName() == 'showRank.info')
                                <div>
                                    @include('page.league.detail.rank')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueSchedule.info')
                                <div>
                                    @include('page.league.detail.schedule')
                                </div>
                            @elseif(Route::current()->getName() == 'leagueResult.bracket')
                                @include('page.league.detail.bracket')
                            @else
                                <div class="item draws" style="display:block;">
                                    @if(now() >= date('Y-m-d', strtotime($leagueInfor->start_date)))
                                        @include('page.league.detail.news')
                                    @elseif(now() < date('Y-m-d', strtotime($leagueInfor->start_date)))
                                        @include('page.league.detail.register-league')
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/league.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $("[name='recordLeague']").on("change", function () {
            let edit_id = $(this).val();
            window.location.href = window.location.origin + '/league/' + edit_id;
        });
    </script>
    @if(Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr.success("{{Session::get('message')}}", 'Success!', {
                timeout: 12000
            });
        </script>
    @endif
    <script>
        // Set the date we're counting down to
        var register_date = '<?php echo $format_register_date ?>';
        var countDownDate = new Date(register_date).getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Display the result in the element with id="demo"
            document.getElementById("data_day").innerHTML = days;
            document.getElementById("data_hours").innerHTML = hours;
            document.getElementById("data_minutes").innerHTML = minutes;
            document.getElementById("data_seconds").innerHTML = seconds;
            //  + "d " + hours + "h "
            // + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
    <script>
        const select = document.getElementById('playerSelect');
        const newPlayerForm = document.getElementById('newPlayerForm');

        select.addEventListener('change', function () {
            if (this.value === 'new') {
                newPlayerForm.classList.remove('hidden');
            } else {
                newPlayerForm.classList.add('hidden');
            }
        });

    </script>
    <script>
        function switchDivs() {
            const divA = document.getElementById('form-reg');
            const divB = document.getElementById('form-register');

            divA.classList.add('hidden');
            divB.classList.remove('hidden');
        }
    </script>
    <script>
        function closeWinnerPopup() {
            document.getElementById("winner-popup").style.display = "none";
            document.getElementById("page").style.display = "block";
        }
    </script>
    <script>
        // when animating on canvas, it is best to use requestAnimationFrame instead of setTimeout or setInterval
        // not supported in all browsers though and sometimes needs a prefix, so we need a shim
        window.requestAnimFrame = ( function() {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function( callback ) {
                    window.setTimeout( callback, 1000 / 60 );
                };
        })();

        // now we will setup our basic variables for the demo
        var canvas = document.getElementById( 'canvas' ),
            ctx = canvas.getContext( '2d' ),
            // full screen dimensions
            cw = window.innerWidth,
            ch = window.innerHeight,
            // firework collection
            fireworks = [],
            // particle collection
            particles = [],
            // starting hue
            hue = 120,
            // when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
            limiterTotal = 20,
            limiterTick = 0,
            // this will time the auto launches of fireworks, one launch per 80 loop ticks
            timerTotal = 500,
            timerTick = 0,
            mousedown = false,
            // mouse x coordinate,
            mx,
            // mouse y coordinate
            my;


        // set canvas dimensions
        canvas.width = cw;
        canvas.height = ch;

        // now we are going to setup our function placeholders for the entire demo

        // get a random number within a range
        function random( min, max ) {
            return Math.random() * ( max - min ) + min;
        }

        // calculate the distance between two points
        function calculateDistance( p1x, p1y, p2x, p2y ) {
            var xDistance = p1x - p2x,
                yDistance = p1y - p2y;
            return Math.sqrt( Math.pow( xDistance, 2 ) + Math.pow( yDistance, 2 ) );
        }

        // create firework
        function Firework( sx, sy, tx, ty ) {
            // actual coordinates
            this.x = sx;
            this.y = sy;
            // starting coordinates
            this.sx = sx;
            this.sy = sy;
            // target coordinates
            this.tx = tx;
            this.ty = ty;
            // distance from starting point to target
            this.distanceToTarget = calculateDistance( sx, sy, tx, ty );
            this.distanceTraveled = 0;
            // track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
            this.coordinates = [];
            this.coordinateCount = 3;
            // populate initial coordinate collection with the current coordinates
            while( this.coordinateCount-- ) {
                this.coordinates.push( [ this.x, this.y ] );
            }
            this.angle = Math.atan2( ty - sy, tx - sx );
            this.speed = 2;
            this.acceleration = 1.05;
            this.brightness = random( 50, 70 );
            // circle target indicator radius
            this.targetRadius = 1;
        }

        // update firework
        Firework.prototype.update = function( index ) {
            // remove last item in coordinates array
            this.coordinates.pop();
            // add current coordinates to the start of the array
            this.coordinates.unshift( [ this.x, this.y ] );

            // cycle the circle target indicator radius
            if( this.targetRadius < 8 ) {
                this.targetRadius += 0.3;
            } else {
                this.targetRadius = 1;
            }

            // speed up the firework
            this.speed *= this.acceleration;

            // get the current velocities based on angle and speed
            var vx = Math.cos( this.angle ) * this.speed,
                vy = Math.sin( this.angle ) * this.speed;
            // how far will the firework have traveled with velocities applied?
            this.distanceTraveled = calculateDistance( this.sx, this.sy, this.x + vx, this.y + vy );

            // if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
            if( this.distanceTraveled >= this.distanceToTarget ) {
                createParticles( this.tx, this.ty );
                // remove the firework, use the index passed into the update function to determine which to remove
                fireworks.splice( index, 1 );
            } else {
                // target not reached, keep traveling
                this.x += vx;
                this.y += vy;
            }
        }

        // draw firework
        Firework.prototype.draw = function() {
            ctx.beginPath();
            // move to the last tracked coordinate in the set, then draw a line to the current x and y
            ctx.moveTo( this.coordinates[ this.coordinates.length - 1][ 0 ], this.coordinates[ this.coordinates.length - 1][ 1 ] );
            ctx.lineTo( this.x, this.y );
            ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
            ctx.stroke();

            ctx.beginPath();
            // draw the target for this firework with a pulsing circle
            //ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
            ctx.stroke();
        }

        // create particle
        function Particle( x, y ) {
            this.x = x;
            this.y = y;
            // track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
            this.coordinates = [];
            this.coordinateCount = 5;

            while( this.coordinateCount-- ) {
                this.coordinates.push( [ this.x, this.y ] );
            }
            // set a random angle in all possible directions, in radians
            this.angle = random( 0, Math.PI * 2 );
            this.speed = random( 1, 10 );
            // friction will slow the particle down
            this.friction = 0.95;
            // gravity will be applied and pull the particle down
            this.gravity = 0.6;
            // set the hue to a random number +-20 of the overall hue variable
            this.hue = random( hue - 20, hue + 20 );
            this.brightness = random( 50, 80 );
            this.alpha = 1;
            // set how fast the particle fades out
            this.decay = random( 0.0075, 0.009 );
        }

        // update particle
        Particle.prototype.update = function( index ) {
            // remove last item in coordinates array
            this.coordinates.pop();
            // add current coordinates to the start of the array
            this.coordinates.unshift( [ this.x, this.y ] );
            // slow down the particle
            this.speed *= this.friction;
            // apply velocity
            this.x += Math.cos( this.angle ) * this.speed;
            this.y += Math.sin( this.angle ) * this.speed + this.gravity;
            // fade out the particle
            this.alpha -= this.decay;

            // remove the particle once the alpha is low enough, based on the passed in index
            if( this.alpha <= this.decay ) {
                particles.splice( index, 1 );
            }
        }

        // draw particle
        Particle.prototype.draw = function() {
            ctx. beginPath();
            // move to the last tracked coordinates in the set, then draw a line to the current x and y
            ctx.moveTo( this.coordinates[ this.coordinates.length - 1 ][ 0 ], this.coordinates[ this.coordinates.length - 1 ][ 1 ] );
            ctx.lineTo( this.x, this.y );
            ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';

            ctx.stroke();
        }

        // create particle group/explosion
        function createParticles( x, y ) {
            // increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
            var particleCount = 20;
            while( particleCount-- ) {
                particles.push( new Particle( x, y ) );
            }
        }


        // main demo loop
        function loop() {
            // this function will run endlessly with requestAnimationFrame
            requestAnimFrame( loop );

            // increase the hue to get different colored fireworks over time
            hue += 0.5;

            // normally, clearRect() would be used to clear the canvas
            // we want to create a trailing effect though
            // setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
            ctx.globalCompositeOperation = 'destination-out';
            // decrease the alpha property to create more prominent trails
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect( 0, 0, cw, ch );
            // change the composite operation back to our main mode
            // lighter creates bright highlight points as the fireworks and particles overlap each other
            ctx.globalCompositeOperation = 'lighter';

            // loop over each firework, draw it, update it
            var i = fireworks.length;
            while( i-- ) {
                fireworks[ i ].draw();
                fireworks[ i ].update( i );
            }

            // loop over each particle, draw it, update it
            var i = particles.length;
            while( i-- ) {
                particles[ i ].draw();
                particles[ i ].update( i );

            }


            // launch fireworks automatically to random coordinates, when the mouse isn't down
            if( timerTick >= timerTotal ) {
                timerTick = 0;
            } else {
                var temp = timerTick % 400;
                if(temp <= 15){
                    fireworks.push( new Firework( 100, ch, random( 190, 200 ), random(90, 100) ));
                    fireworks.push( new Firework( cw - 100, ch, random(cw - 200, cw - 190), random(90, 100) ));
                }

                var temp3 = temp / 10;

                if(temp > 319){
                    fireworks.push(new Firework(300 + (temp3 - 31 ) * 100 , ch, 300 + (temp3 - 31) * 100 , 200));
                }

                timerTick++;
            }

            // limit the rate at which fireworks get launched when mouse is down
            if( limiterTick >= limiterTotal ) {
                if( mousedown ) {
                    // start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
                    fireworks.push( new Firework( cw / 2, ch, mx, my ) );
                    limiterTick = 0;
                }
            } else {
                limiterTick++;
            }
        }

        // mouse event bindings
        // update the mouse coordinates on mousemove
        canvas.addEventListener( 'mousemove', function( e ) {
            mx = e.pageX - canvas.offsetLeft;
            my = e.pageY - canvas.offsetTop;
        });

        // toggle mousedown state and prevent canvas from being selected
        canvas.addEventListener( 'mousedown', function( e ) {
            e.preventDefault();
            mousedown = true;
        });

        canvas.addEventListener( 'mouseup', function( e ) {
            e.preventDefault();
            mousedown = false;
        });

        // once the window loads, we are ready for some fireworks!
        window.onload = loop;
    </script>


@endsection
