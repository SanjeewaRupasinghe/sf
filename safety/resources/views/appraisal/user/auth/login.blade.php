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
           <!-- Login Page -->
<div id="loginPage" class="auth-container">
    <h2 class="form-title">
        <i class="fas fa-sign-in-alt me-2"></i>
        Welcome Back
    </h2>
    
    <form id="loginForm" action="{{route('appraisal.user.loginSubmit')}}" method="POST" novalidate>
        @csrf
        <div class="form-group">
            <label for="loginEmail" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" value="{{ request('e', '') }}" required>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label for="loginPassword" class="form-label">
                <i class="fas fa-lock me-2"></i>Password
            </label>
            <div class="password-container">
                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                    <i class="fas fa-eye text-dark" id="loginPassword-eye"></i>
                </button>
            </div>
            <div class="invalid-feedback"></div>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="btn-text">Sign In</span>
        </button>
    </form>

    <div class="auth-links">
        <p style="color:#4585EE; margin: 10px 0;">
            <button type="button" onclick="showPage('forgotPasswordPage')">Forgot Password?</button>
        </p>
        <p style="color:#4585EE; margin: 0;">
            Don't have an account? 
            <button type="button" onclick="showPage('registerPage')">Sign Up</button>
        </p>
    </div>
</div>

        </div>
    </section>

	@include('appraisal.user.auth.auth-js')

@endsection
