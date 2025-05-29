@extends('appraisal.template')
@include('appraisal.user.auth.auth-css')
@section('content')
    <section class="inerHeader">
        <div class="container">
            <marquee behavior="" direction="">
                <div class="row">

                </div>
            </marquee>
        </div>
    </section>

    <section id="" class="about-page-section" style="padding-top: 10px;">
        
        <div class="container">
            @include('common.alert')
        </div>

        <div class="container">


            <!-- Email Confirmation Page -->
            <div id="emailConfirmPage" class="auth-container">
                <h2 class="form-title">
                    <i class="fas fa-envelope-open me-2"></i>
                    Verify Email
                </h2>

                <p class="form-subtitle">
                    We've sent a 6-digit verification code to<br>
                    <strong id="confirmationEmail"></strong>
                </p>

                <form id="emailConfirmForm" action="{{route('appraisal.user.emailConfirmationSubmit')}}" method="POST" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ request('e', '') }}" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label text-center d-block">
                            <i class="fas fa-key me-2"></i>Enter Verification Code
                        </label>
                        <div class="otp-container">
                            <input type="text" class="otp-input" name="otp1" maxlength="1" data-index="0">
                            <input type="text" class="otp-input" name="otp2" maxlength="1" data-index="1">
                            <input type="text" class="otp-input" name="otp3" maxlength="1" data-index="2">
                            <input type="text" class="otp-input" name="otp4" maxlength="1" data-index="3">
                            <input type="text" class="otp-input" name="otp5" maxlength="1" data-index="4">
                            <input type="text" class="otp-input" name="otp6" maxlength="1" data-index="5">
                        </div>
                        <div class="invalid-feedback text-center" id="otpError"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Verify Email</span>
                    </button>

                    {{-- <button type="button" class="btn btn-secondary-custom" id="resendOtpBtn" onclick="resendOTP()">
                        <a href="{{route('')}}"></a>
                        <span class="btn-text">Resend Code</span>
                    </button> --}}
                </form>

                <div class="resend-timer">
                    <span id="resendTimer"></span>
                </div>

                <div class="auth-links">
                    <p style="color: rgba(255, 255, 255, 0.8); margin: 0;">
                        <button type="button" onclick="showPage('registerPage')">← Back to Register</button>
                    </p>
                </div>
            </div>

        </div>
    </section>

    @include('appraisal.user.auth.auth-js')
@endsection
