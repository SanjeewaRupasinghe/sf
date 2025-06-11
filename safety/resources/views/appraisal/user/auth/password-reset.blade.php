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

            
            <!-- Forgot Password Page -->
            <div id="forgotPasswordPage" class="auth-container">
                <h2 class="form-title">
                    <i class="fas fa-key me-2"></i>
                    Reset Password
                </h2>

                <p class="form-subtitle">
                    Enter your email address and we'll your new password.
                </p>

                <form id="forgotPasswordForm" action="{{ route('appraisal.user.passwordReset.submit') }}" method="POST" novalidate>
                    @CSRF
                    <div class="form-group">
                        <label for="forgotEmail" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" id="forgotEmail" name="email" placeholder="Enter your email" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Reset Password</span>
                    </button>
                </form>

                <div class="auth-links">
                    <p style="color:#4585EE; margin: 0;">
                        Don't have an account?
                        <a type="button" href="{{ route('appraisal.user.register') }}">Sign In</a>
                    </p>
                    <p style="color:#4585EE; margin: 10px 0;">
                        Want to confirm email ID ?
                        <a type="button" href="{{ route('appraisal.user.emailConfirmation') }}">Comfirm Email</a>
                    </p>
                </div>
            </div>

            <!-- Reset Password Page -->
            <div id="resetPasswordPage" class="auth-container" style="display: none;">
                <h2 class="form-title">
                    <i class="fas fa-lock me-2"></i>
                    New Password
                </h2>

                <p class="form-subtitle">
                    Enter your new password below.
                </p>

                <form id="resetPasswordForm" novalidate>
                    <div class="form-group">
                        <label for="newPassword" class="form-label">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="newPassword" placeholder="Enter new password"
                                required>
                            <button type="button" class="password-toggle" onclick="togglePassword('newPassword')">
                                <i class="fas fa-eye" id="newPassword-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div id="newStrength-text" style="color: rgba(255, 255, 255, 0.8);"></div>
                            <div class="strength-bar" id="newStrength-bar"></div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirmNewPassword" class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirm New Password
                        </label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="confirmNewPassword"
                                placeholder="Confirm new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmNewPassword')">
                                <i class="fas fa-eye" id="confirmNewPassword-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Reset Password</span>
                    </button>
                </form>

                <div class="auth-links">
                    <p style="color: rgba(255, 255, 255, 0.8); margin: 0;">
                        <button type="button" onclick="showPage('loginPage')">← Back to Login</button>
                    </p>
                </div>
            </div>

        </div>
    </section>

    @include('appraisal.user.auth.auth-js')
@endsection
