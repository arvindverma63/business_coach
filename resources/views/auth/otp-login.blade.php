@php
    $loginRole = request('role') === 'coach' ? 'coach' : 'seeker';
    $registerLabel = $loginRole === 'coach' ? 'Register as Coach' : 'Register as Seeker';
@endphp

<x-guest-layout title="Login | BestBusinessCoach">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg p-4 rounded-4">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <iconify-icon icon="tabler:shield-lock" class="text-primary fs-48"></iconify-icon>
                    </div>
                    <h3 class="fw-bold text-dark">Welcome </h3>
                    {{-- <p class="text-muted small">Enter your email to receive a secure login code.</p> --}}
                </div>

                <div id="email-section">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <iconify-icon icon="tabler:mail"></iconify-icon>
                            </span>
                            <input type="email" id="email" class="form-control bg-light border-start-0"
                                placeholder="name@company.com" value="{{ request('email') }}" required>
                        </div>
                        <div id="email-error" class="text-danger small mt-1 d-none">Please enter a valid email.</div>
                    </div>
                    <button id="btn-send-otp"
                        class="btn btn-primary w-100 py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                        <span>Send OTP</span>
                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status"></div>
                    </button>
                </div>

                <div id="otp-section" class="d-none">
                    <div class="alert alert-soft-primary border-0 py-2 small d-flex align-items-center">
                        <iconify-icon icon="tabler:info-circle" class="me-2 fs-18"></iconify-icon>
                        <span>OTP sent to <strong id="display-email"></strong></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Verification Code</label>
                        <input type="text" id="otp"
                            class="form-control text-center fs-24 fw-bold letter-spacing-5 bg-light" maxlength="6"
                            placeholder="000000" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);">
                        <div id="otp-error" class="text-danger small mt-1 d-none">Invalid code entered.</div>
                    </div>

                    <button id="btn-verify-otp"
                        class="btn btn-success w-100 py-2 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                        <span>Verify & Login</span>
                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status"></div>
                    </button>

                    <div class="text-center mt-3">
                        <p class="small text-muted mb-1">Didn't receive the code?</p>
                        <button id="btn-resend-otp" class="btn btn-link btn-sm text-decoration-none fw-bold p-0"
                            disabled>
                            <span id="resend-label">Resend OTP in <span id="timer">60</span>s</span>
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-link btn-sm text-decoration-none text-muted" id="btn-back">
                            <iconify-icon icon="tabler:arrow-left" class="align-middle"></iconify-icon> Change Email
                        </button>
                    </div>
                </div>
            </div>

            <p class="text-center mt-4 text-muted small">
                Don't have an account?
                <a href="{{ route('webapp.home', ['register' => $loginRole]) }}"
                    class="text-primary fw-bold text-decoration-none">
                    {{ $registerLabel }}
                </a>
            </p>
        </div>
    </div>

    @push('styles')
        <style>
            .letter-spacing-5 {
                letter-spacing: 5px;
            }

            .alert-soft-primary {
                background-color: #e7f0ff;
                color: #0d6efd;
            }

            .spinner-border-sm {
                width: 1rem;
                height: 1rem;
            }

            #btn-resend-otp:disabled {
                color: #6c757d;
                cursor: not-allowed;
            }

            .letter-spacing-5 {
                letter-spacing: 5px;
                padding-left: 5px;
                /* Offsets the letter-spacing of the last character */
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let timerInterval;

            function setResendButtonState({
                disabled,
                sending = false,
                timeLeft = null,
                ready = false
            }) {
                const resendBtn = $('#btn-resend-otp');
                const resendLabel = $('#resend-label');

                resendBtn.prop('disabled', disabled);

                if (sending) {
                    resendLabel.text('Sending...');
                    return;
                }

                if (ready) {
                    resendLabel.text('Resend OTP Now');
                    return;
                }

                if (timeLeft !== null) {
                    resendLabel.html(`Resend OTP in <span id="timer">${timeLeft}</span>s`);
                }
            }

            // Helper function for loading state
            function toggleLoading(btnId, isLoading) {
                const btn = $(`#${btnId}`);
                const spinner = btn.find('.spinner-border');
                const text = btn.find('span');

                btn.prop('disabled', isLoading);
                if (isLoading) {
                    spinner.removeClass('d-none');
                    text.addClass('opacity-50');
                } else {
                    spinner.addClass('d-none');
                    text.removeClass('opacity-50');
                }
            }

            // Countdown Timer Logic
            function startTimer() {
                let timeLeft = 60;
                clearInterval(timerInterval);
                setResendButtonState({
                    disabled: true,
                    timeLeft
                });

                timerInterval = setInterval(function() {
                    timeLeft--;
                    setResendButtonState({
                        disabled: true,
                        timeLeft
                    });

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        setResendButtonState({
                            disabled: false,
                            ready: true
                        });
                    }
                }, 1000);
            }

            // Send OTP Action
            $('#btn-send-otp').click(function() {
                const email = $('#email').val();
                if (!email) {
                    $('#email-error').removeClass('d-none').text('Email is required.');
                    return;
                }

                $('#email-error').addClass('d-none');
                toggleLoading('btn-send-otp', true);

                $.post("{{ route('auth.otp.send') }}", {
                        _token: "{{ csrf_token() }}",
                        email: email
                    })
                    .done(function(res) {
                        toastr.success(res.message);
                        $('#display-email').text(email);
                        $('#email-section').fadeOut(300, function() {
                            $('#otp-section').removeClass('d-none').hide().fadeIn(300);
                            startTimer();
                        });
                    })
                    .fail(function(err) {
                        const msg = err.responseJSON?.message || 'Something went wrong.';
                        toastr.error(msg);
                        toggleLoading('btn-send-otp', false);
                    });
            });

            // Resend OTP Action
            $('#btn-resend-otp').click(function() {
                const email = $('#email').val();
                clearInterval(timerInterval);
                setResendButtonState({
                    disabled: true,
                    sending: true
                });

                $.post("{{ route('auth.otp.send') }}", {
                        _token: "{{ csrf_token() }}",
                        email: email
                    })
                    .done(function(res) {
                        toastr.success('New OTP sent!');
                        startTimer();
                    })
                    .fail(function() {
                        toastr.error('Failed to resend. Try again.');
                        setResendButtonState({
                            disabled: false,
                            ready: true
                        });
                    });
            });

            // Verify OTP Action
            $('#btn-verify-otp').click(function() {
                const otp = $('#otp').val();
                if (otp.length < 6) {
                    $('#otp-error').removeClass('d-none').text('Please enter the 6-digit code.');
                    return;
                }

                $('#otp-error').addClass('d-none');
                toggleLoading('btn-verify-otp', true);

                $.post("{{ route('auth.otp.verify') }}", {
                        _token: "{{ csrf_token() }}",
                        email: $('#email').val(),
                        otp: otp
                    })
                    .done(function(res) {
                        toastr.success('Login successful! Redirecting...');
                        window.location.href = res.redirect;
                    })
                    .fail(function(err) {
                        const msg = err.responseJSON?.message || 'Invalid OTP.';
                        toastr.error(msg);
                        toggleLoading('btn-verify-otp', false);
                    });
            });

            // Back button
            $('#btn-back').click(function() {
                $('#otp-section').fadeOut(300, function() {
                    $('#email-section').hide().removeClass('d-none').fadeIn(300);
                    toggleLoading('btn-send-otp', false);
                    clearInterval(timerInterval);
                });
            });
        </script>
    @endpush
</x-guest-layout>
