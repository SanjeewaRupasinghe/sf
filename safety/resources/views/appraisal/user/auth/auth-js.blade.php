<script>
    // Auth System JavaScript - UI/UX Only (Laravel Compatible)

    // Global variables for UI state
    let resendCountdown = 0;
    let resendTimer = null;

    // Validation patterns
    const patterns = {
        name: /^[a-zA-Z\s]{2,50}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        contact: /^[\+]?[0-9][\d]{0,15}$/,
        password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
    };

    // Error messages
    const errorMessages = {
        name: 'Name must be 2-50 characters long and contain only letters',
        email: 'Please enter a valid email address',
        contact: 'Please enter a valid contact number',
        password: 'Password must be at least 8 characters with uppercase, lowercase, number and special character',
        confirmPassword: 'Passwords do not match'
    };

    // Show specific page
    function showPage(pageId) {
        document.querySelectorAll('.auth-container').forEach(page => {
            page.style.display = 'none';
            page.classList.remove('active');
        });

        const targetPage = document.getElementById(pageId);
        if (targetPage) {
            targetPage.style.display = 'block';
            targetPage.classList.add('active');

            // Clear forms when switching pages (but don't reset, preserve data)
            clearValidationStates(targetPage);

            // Reset password strength indicators
            resetPasswordStrength();

            // Focus first input
            const firstInput = targetPage.querySelector('input:not([type="hidden"])');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 100);
            }
        }
    }

    // Clear validation states only (preserve form data)
    function clearValidationStates(container) {
        container.querySelectorAll('.form-control').forEach(field => {
            field.classList.remove('is-valid', 'is-invalid');
        });
        container.querySelectorAll('.invalid-feedback').forEach(feedback => {
            feedback.textContent = '';
        });
    }

    // Reset password strength indicators
    function resetPasswordStrength() {
        const strengthElements = [{
                text: 'strength-text',
                bar: 'strength-bar'
            },
            {
                text: 'newStrength-text',
                bar: 'newStrength-bar'
            }
        ];

        strengthElements.forEach(element => {
            const textEl = document.getElementById(element.text);
            const barEl = document.getElementById(element.bar);
            if (textEl) textEl.textContent = '';
            if (barEl) barEl.className = 'strength-bar';
        });
    }

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eye = document.getElementById(fieldId + '-eye');

        if (field && eye) {
            if (field.type === 'password') {
                field.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }
    }

    // Validate field (client-side only)
    function validateField(fieldName, value, relatedFieldId = null) {
        let isValid = true;
        let message = '';

        if (!value) {
            isValid = false;
            message =
            `${fieldName.charAt(0).toUpperCase() + fieldName.slice(1).replace(/([A-Z])/g, ' $1')} is required`;
        } else {
            switch (fieldName) {
                case 'name':
                    if (!patterns.name.test(value)) {
                        isValid = false;
                        message = errorMessages.name;
                    }
                    break;
                case 'email':
                case 'loginEmail':
                case 'forgotEmail':
                    if (!patterns.email.test(value)) {
                        isValid = false;
                        message = errorMessages.email;
                    }
                    break;
                case 'contact':
                    if (!patterns.contact.test(value)) {
                        isValid = false;
                        message = errorMessages.contact;
                    }
                    break;
                case 'password':
                case 'loginPassword':
                case 'newPassword':
                    if (!patterns.password.test(value)) {
                        isValid = false;
                        message = errorMessages.password;
                    }
                    break;
                case 'confirmPassword':
                    const passwordField = document.getElementById('password');
                    if (passwordField && value !== passwordField.value) {
                        isValid = false;
                        message = errorMessages.confirmPassword;
                    }
                    break;
                case 'confirmNewPassword':
                    const newPasswordField = document.getElementById('newPassword');
                    if (newPasswordField && value !== newPasswordField.value) {
                        isValid = false;
                        message = errorMessages.confirmPassword;
                    }
                    break;
            }
        }

        return {
            isValid,
            message
        };
    }

    // Update field status
    function updateFieldStatus(field, feedback, isValid, message) {
        field.classList.remove('is-valid', 'is-invalid');

        if (field.value.trim()) {
            if (isValid) {
                field.classList.add('is-valid');
            } else {
                field.classList.add('is-invalid');
            }
        }

        if (feedback) {
            feedback.textContent = message;
        }
    }

    // Check password strength
    function checkPasswordStrength(password, textId, barId) {
        const strengthText = document.getElementById(textId);
        const strengthBar = document.getElementById(barId);

        if (!strengthText || !strengthBar) return;

        if (!password) {
            strengthText.textContent = '';
            strengthBar.className = 'strength-bar';
            return;
        }

        let strength = 0;
        const checks = [
            /.{8,}/, // Length
            /[a-z]/, // Lowercase
            /[A-Z]/, // Uppercase
            /\d/, // Number
            /[@$!%*?&]/ // Special character
        ];

        checks.forEach(check => {
            if (check.test(password)) strength++;
        });

        if (strength < 3) {
            strengthText.textContent = 'Weak password';
            strengthBar.className = 'strength-bar strength-weak';
        } else if (strength < 5) {
            strengthText.textContent = 'Medium password';
            strengthBar.className = 'strength-bar strength-medium';
        } else {
            strengthText.textContent = 'Strong password';
            strengthBar.className = 'strength-bar strength-strong';
        }
    }

    // Setup real-time validation for form fields
    function setupFieldValidation(field, fieldName) {
        const feedback = field.parentElement.querySelector('.invalid-feedback') ||
            field.closest('.form-group').querySelector('.invalid-feedback');

        field.addEventListener('input', () => {
            const validation = validateField(fieldName, field.value.trim());
            updateFieldStatus(field, feedback, validation.isValid, validation.message);

            // Handle password strength
            if (fieldName === 'password') {
                checkPasswordStrength(field.value, 'strength-text', 'strength-bar');
                // Revalidate confirm password if it has value
                const confirmField = document.getElementById('confirmPassword');
                if (confirmField && confirmField.value) {
                    const confirmFeedback = confirmField.closest('.form-group').querySelector(
                        '.invalid-feedback');
                    const confirmValidation = validateField('confirmPassword', confirmField.value.trim());
                    updateFieldStatus(confirmField, confirmFeedback, confirmValidation.isValid,
                        confirmValidation.message);
                }
            }

            if (fieldName === 'newPassword') {
                checkPasswordStrength(field.value, 'newStrength-text', 'newStrength-bar');
                // Revalidate confirm new password if it has value
                const confirmField = document.getElementById('confirmNewPassword');
                if (confirmField && confirmField.value) {
                    const confirmFeedback = confirmField.closest('.form-group').querySelector(
                        '.invalid-feedback');
                    const confirmValidation = validateField('confirmNewPassword', confirmField.value.trim());
                    updateFieldStatus(confirmField, confirmFeedback, confirmValidation.isValid,
                        confirmValidation.message);
                }
            }

            if (fieldName === 'confirmPassword' || fieldName === 'confirmNewPassword') {
                const validation = validateField(fieldName, field.value.trim());
                updateFieldStatus(field, feedback, validation.isValid, validation.message);
            }
        });

        field.addEventListener('blur', () => {
            const validation = validateField(fieldName, field.value.trim());
            updateFieldStatus(field, feedback, validation.isValid, validation.message);
        });
    }

    // Validate entire form before submission
    function validateFormBeforeSubmit(form) {
        let isFormValid = true;
        let firstInvalidField = null;

        const fields = form.querySelectorAll('input[required], input[type="email"], input[type="password"]');

        fields.forEach(field => {
            const fieldName = field.name || field.id;
            const feedback = field.closest('.form-group').querySelector('.invalid-feedback');
            const validation = validateField(fieldName, field.value.trim());

            updateFieldStatus(field, feedback, validation.isValid, validation.message);

            if (!validation.isValid) {
                isFormValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            }
        });

        if (firstInvalidField) {
            firstInvalidField.focus();
            firstInvalidField.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        return isFormValid;
    }

    // Show loading state on form submission
    function showFormLoading(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            const btnText = submitBtn.querySelector('.btn-text');
            if (btnText) {
                btnText.setAttribute('data-original-text', btnText.textContent);
                btnText.textContent = 'Please wait...';
            }
        }
    }

    // Hide loading state
    function hideFormLoading(form) {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;

            const btnText = submitBtn.querySelector('.btn-text');
            if (btnText && btnText.hasAttribute('data-original-text')) {
                btnText.textContent = btnText.getAttribute('data-original-text');
                btnText.removeAttribute('data-original-text');
            }
        }
    }

    // Setup OTP input functionality
    function setupOTPInputs() {
        const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;

                // Only allow numbers
                if (!/^\d$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                // Move to next input
                if (value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Check if all inputs are filled
                const allFilled = Array.from(otpInputs).every(input => input.value !== '');
                if (allFilled) {
                    // Remove any previous validation errors
                    const otpError = document.getElementById('otpError');
                    if (otpError) otpError.textContent = '';

                    otpInputs.forEach(input => input.classList.remove('is-invalid'));
                }
            });

            input.addEventListener('keydown', (e) => {
                // Handle backspace
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }

                // Handle paste
                if (e.key === 'v' && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    navigator.clipboard.readText().then(text => {
                        const digits = text.replace(/\D/g, '').slice(0, 6);
                        digits.split('').forEach((digit, i) => {
                            if (otpInputs[i]) {
                                otpInputs[i].value = digit;
                            }
                        });
                        if (digits.length > 0) {
                            const nextIndex = Math.min(digits.length, otpInputs.length - 1);
                            otpInputs[nextIndex].focus();
                        }
                    });
                }
            });

            // Handle focus styling
            input.addEventListener('focus', () => {
                input.classList.remove('is-invalid');
            });
        });
    }

    // Get OTP value
    function getOTPValue() {
        const otpInputs = document.querySelectorAll('.otp-input');
        return Array.from(otpInputs).map(input => input.value).join('');
    }

    // Clear OTP inputs
    function clearOTPInputs() {
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(input => {
            input.value = '';
            input.classList.remove('is-valid', 'is-invalid');
        });
        if (otpInputs.length > 0) {
            otpInputs[0].focus();
        }
    }

    // Validate OTP before submission
    function validateOTP() {
        const otpValue = getOTPValue();
        const otpError = document.getElementById('otpError');
        const otpInputs = document.querySelectorAll('.otp-input');

        if (otpValue.length !== 6) {
            if (otpError) otpError.textContent = 'Please enter the complete 6-digit code';
            otpInputs.forEach(input => {
                if (!input.value) input.classList.add('is-invalid');
            });
            otpInputs[0].focus();
            return false;
        }

        // Clear errors if validation passes
        if (otpError) otpError.textContent = '';
        otpInputs.forEach(input => input.classList.remove('is-invalid'));

        return true;
    }

    // Start resend countdown
    function startResendCountdown(duration = 60) {
        const timerElement = document.getElementById('resendTimer');
        const resendBtn = document.getElementById('resendOtpBtn');

        if (!timerElement || !resendBtn) return;

        resendCountdown = duration;
        resendBtn.disabled = true;
        resendBtn.style.opacity = '0.6';
        resendBtn.style.pointerEvents = 'none';

        resendTimer = setInterval(() => {
            if (resendCountdown > 0) {
                timerElement.textContent = `Resend code in ${resendCountdown}s`;
                resendCountdown--;
            } else {
                clearInterval(resendTimer);
                timerElement.textContent = '';
                resendBtn.disabled = false;
                resendBtn.style.opacity = '1';
                resendBtn.style.pointerEvents = 'auto';
            }
        }, 1000);
    }

    // // Resend OTP (UI feedback only, actual request handled by Laravel)
    // function resendOTP() {
    //     console.log('resend otp');
        
    //     const btn = document.getElementById('resendOtpBtn');
    //     const btnText = btn.querySelector('.btn-text');

    //     // Show loading state
    //     btn.classList.add('loading');
    //     btnText.textContent = 'Sending...';

    //     // Create a temporary form to submit resend request
    //     const form = document.createElement('form');
    //     form.method = 'POST';
    //     form.action = '/resend-otp'; // Your Laravel route
    //     form.style.display = 'none';

    //     // Add CSRF token
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]');
    //     if (csrfToken) {
    //         const csrfInput = document.createElement('input');
    //         csrfInput.type = 'hidden';
    //         csrfInput.name = '_token';
    //         csrfInput.value = csrfToken.getAttribute('content');
    //         form.appendChild(csrfInput);
    //     }

    //     document.body.appendChild(form);
    //     form.submit();
    // }

    // Initialize form validation and interactions
    function initializeAuth() {
        // Setup Login Form
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            const loginEmail = document.getElementById('loginEmail');
            const loginPassword = document.getElementById('loginPassword');

            if (loginEmail) setupFieldValidation(loginEmail, 'loginEmail');
            if (loginPassword) setupFieldValidation(loginPassword, 'loginPassword');

            loginForm.addEventListener('submit', (e) => {
                if (!validateFormBeforeSubmit(loginForm)) {
                    e.preventDefault();
                    return false;
                }
                showFormLoading(loginForm);
            });
        }

        // Setup Register Form
        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const contact = document.getElementById('contact');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');

            if (name) setupFieldValidation(name, 'name');
            if (email) setupFieldValidation(email, 'email');
            if (contact) setupFieldValidation(contact, 'contact');
            if (password) setupFieldValidation(password, 'password');
            if (confirmPassword) setupFieldValidation(confirmPassword, 'confirmPassword');

            registerForm.addEventListener('submit', (e) => {
                if (!validateFormBeforeSubmit(registerForm)) {
                    e.preventDefault();
                    return false;
                }
                showFormLoading(registerForm);
            });
        }

        // Setup Email Confirmation Form
        setupOTPInputs();

        const emailConfirmForm = document.getElementById('emailConfirmForm');
        if (emailConfirmForm) {
            emailConfirmForm.addEventListener('submit', (e) => {
                if (!validateOTP()) {
                    e.preventDefault();
                    return false;
                }
                showFormLoading(emailConfirmForm);
            });
        }

        // Setup Forgot Password Form
        const forgotPasswordForm = document.getElementById('forgotPasswordForm');
        if (forgotPasswordForm) {
            const forgotEmail = document.getElementById('forgotEmail');
            if (forgotEmail) setupFieldValidation(forgotEmail, 'forgotEmail');

            forgotPasswordForm.addEventListener('submit', (e) => {
                if (!validateFormBeforeSubmit(forgotPasswordForm)) {
                    e.preventDefault();
                    return false;
                }
                showFormLoading(forgotPasswordForm);
            });
        }

        // Setup Reset Password Form
        const resetPasswordForm = document.getElementById('resetPasswordForm');
        if (resetPasswordForm) {
            const newPassword = document.getElementById('newPassword');
            const confirmNewPassword = document.getElementById('confirmNewPassword');

            if (newPassword) setupFieldValidation(newPassword, 'newPassword');
            if (confirmNewPassword) setupFieldValidation(confirmNewPassword, 'confirmNewPassword');

            resetPasswordForm.addEventListener('submit', (e) => {
                if (!validateFormBeforeSubmit(resetPasswordForm)) {
                    e.preventDefault();
                    return false;
                }
                showFormLoading(resetPasswordForm);
            });
        }

        // Auto-start countdown if on email confirmation page
        if (document.getElementById('emailConfirmPage') && document.getElementById('emailConfirmPage').style.display !==
            'none') {
            startResendCountdown(60);
        }
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', initializeAuth);

    // Handle browser back/forward buttons
    window.addEventListener('popstate', () => {
        // Re-initialize if needed
        initializeAuth();
    });

    // Utility function to set email in confirmation page (can be called from Laravel)
    function setConfirmationEmail(email) {
        const confirmationEmailElement = document.getElementById('confirmationEmail');
        if (confirmationEmailElement) {
            confirmationEmailElement.textContent = email;
        }
    }

    // Utility function to show success/error messages (can be called from Laravel blade)
    function showAuthMessage(message, type = 'info') {
        const activeContainer = document.querySelector('.auth-container[style*="block"], .auth-container.active');
        if (!activeContainer) return;

        const alert = document.createElement('div');
        alert.className = `alert-custom alert-${type}`;
        alert.innerHTML =
            `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'} me-2"></i>${message}`;

        const form = activeContainer.querySelector('form');
        if (form) {
            form.parentNode.insertBefore(alert, form);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }
    }
</script>
