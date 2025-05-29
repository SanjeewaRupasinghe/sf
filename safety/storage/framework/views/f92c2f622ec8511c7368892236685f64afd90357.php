<style>
    /* Auth System CSS - Common Styles */

    /* CSS Variables */
    :root {
        --main-color: #4585EE;
        --secondary-color: #CB282B;
        --glass-bg: rgba(255, 255, 255, 0.15);
        --glass-border: rgba(255, 255, 255, 0.2);
        --bg-color: #fff;
    }

    /* * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: var(--bg-color);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, var(--main-color) 0%, var(--secondary-color) 100%);
        z-index: -2;
    }

    body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="90" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
        animation: float 20s infinite linear;
        z-index: -1;
    } */

    @keyframes  float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }

        100% {
            transform: translateY(-100px) rotate(360deg);
        }
    }

    /* Auth Container */
    .auth-container {
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    .container {
        display: flex;
        justify-content: center;
    }

    @keyframes  slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Typography */
    .form-title {
        color: #4585EE;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 2rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .form-subtitle {
        color: #4585EE;
        text-align: center;
        margin-bottom: 30px;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-label {
        color: #4585EE;
        font-weight: 500;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        color: #4585EE;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
        width: 100%;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        color: $4585EE;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Password Field */
    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .password-toggle:hover {
        color: #4585EE;
        background: rgba(255, 255, 255, 0.1);
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--main-color) 0%, var(--secondary-color) 100%);
        border: none;
        border-radius: 12px;
        padding: 14px;
        color: $4585EE;
        font-weight: 600;
        font-size: 1.1rem;
        width: 100%;
        margin-top: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, var(--main-color) 0%, var(--secondary-color) 100%);
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary-custom {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 14px;
        color: #4585EE;
        font-weight: 500;
        font-size: 1rem;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-secondary-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        color: #4585EE;
    }

    /* Validation States */
    .invalid-feedback {
        color: #ffb3b3;
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    .valid-feedback {
        color: #90ee90;
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    .is-invalid {
        border-color: var(--secondary-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(203, 40, 43, 0.25) !important;
    }

    .is-valid {
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    /* Password Strength */
    .password-strength {
        margin-top: 8px;
        font-size: 0.8rem;
    }

    .strength-bar {
        height: 4px;
        border-radius: 2px;
        margin-top: 4px;
        transition: all 0.3s ease;
    }

    .strength-weak {
        background: var(--secondary-color);
        width: 33%;
    }

    .strength-medium {
        background: #ffa500;
        width: 66%;
    }

    .strength-strong {
        background: #28a745;
        width: 100%;
    }

    /* Auth Links */
    .auth-links {
        text-align: center;
        margin-top: 20px;
    }

    .auth-links a,
    .auth-links button {
        color: #4585EE text-decoration: none;
        transition: all 0.3s ease;
        background: none;
        border: none;
        cursor: pointer;
        font-size: inherit;
    }

    .auth-links a:hover,
    .auth-links button:hover {
        color: #4585EE;
        text-decoration: underline;
    }

    /* OTP Container */
    .otp-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin: 20px 0;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        border: 2px solid #4585EE70;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        color: #4585EE;
        transition: all 0.3s ease;
    }

    .otp-input:focus {
        border-color: #4585EE;
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        outline: none;
    }

    /* Resend Timer */
    .resend-timer {
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-top: 15px;
    }

    /* Alert Messages */
    .alert-custom {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: #4585EE;
        padding: 12px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .alert-success {
        background: rgba(40, 167, 69, 0.2);
        border-color: rgba(40, 167, 69, 0.3);
    }

    .alert-danger {
        background: rgba(203, 40, 43, 0.2);
        border-color: rgba(203, 40, 43, 0.3);
    }

    /* Page Management */
    .form-page {
        display: none;
    }

    .form-page.active {
        display: block;
    }

    /* Loading State */
    .loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes  spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .auth-container {
            padding: 30px 20px;
            margin: 10px;
        }

        .form-title {
            font-size: 1.75rem;
        }

        body {
            padding: 10px;
        }

        .otp-input {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
        }

        .otp-container {
            gap: 8px;
        }
    }

    @media (max-width: 400px) {
        .auth-container {
            padding: 25px 15px;
        }

        .form-title {
            font-size: 1.5rem;
        }

        .otp-input {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .otp-container {
            gap: 6px;
        }
    }

    @media (max-width: 320px) {
        .otp-input {
            width: 35px;
            height: 35px;
            font-size: 1.1rem;
        }

        .otp-container {
            gap: 4px;
        }
    }

    /* Utility Classes */
    .text-center {
        text-align: center;
    }

    .d-block {
        display: block;
    }

    .me-2 {
        margin-right: 0.5rem;
    }
</style>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/auth/auth-css.blade.php ENDPATH**/ ?>