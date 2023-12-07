@extends('layouts.auth')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('images/auth-logo.jpg') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height: 100%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <div class="mb-4 text-sm text-gray-600 text-center">
                                    {{ __('Thanks for joining our community. Before continuing, check your email to verify the information you provided. If you do not receive the email, please click the button below so we can resend the email to you') }}
                                </div>

                                <div class="mb-4 font-medium text-success text-center">
                                    {{ $message }}
                                </div>

                                <div class="mt-4 flex items-center justify-center">
                                    <form action="POST" method="{{ route('resend.verify.email') }}" class="d-flex justify-content-center">
                                        @csrf
                                        <input type="hidden" name="token_verify" value="{{ $verify->token }}" />
                                        <button id="buttonSendVerify" type="submit" class="btn btn-dark btn-lg btn-block"><span id="textButtonResend">{{ __('Resend the verification email') }}</span></button>
                                    </form>
                                </div>

                                <p class="mt-3 mb-0 text-center"><small>{{ __('Issues with verification or incorrect email input?') }}
                                        <br>{{ __('Please register with') }} <a href="" style="text-decoration: underline; font-weight: 800;">{{ __('other') }}</a> {{ __('email') }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    const btn = document.getElementById("buttonSendVerify");
    const expired = <?php echo $expired ?>;
    var base_time = <?php echo $timer ?>;
    var display = document.getElementById('textButtonResend');
    if (expired == 0) {
        disableButton();
        startTimer(base_time, display);
    }

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        const text = "{{ __('Resend the verification email') }}";
        setInterval(function() {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.innerHTML = text + ' ( ' + minutes + ":" + seconds + ' )';

            if (--timer < 0) {
                timer = duration;
                btn.classList.remove("disable-button-with-timer");
            }
        }, 1000);
    }

    function disableButton() {
        btn.disabled = true;
        btn.classList.add("disable-button-with-timer");
    }
</script>
@endsection
