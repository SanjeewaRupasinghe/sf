
<?php echo $__env->make('appraisal.user.auth.auth-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('content'); ?>
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
            <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="container">


            <!-- Email Confirmation Page -->
            <div id="emailConfirmPage" class="auth-container">
                <h2 class="form-title">
                    <i class="fas fa-envelope-open me-2"></i>
                    Resend OTP
                </h2>

                <p class="form-subtitle">
                    We've sent a 6-digit verification code to<br>
                    <strong id="confirmationEmail"></strong>
                </p>

                <form id="emailConfirmForm" action="<?php echo e(route('appraisal.user.resendOtp.submit')); ?>" method="POST"
                    novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email" value="<?php echo e(request('e', '')); ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Resend OTP</span>
                    </button>

                    <p style="color:#4585EE; margin: 10px 0;">
                        Want to confirm email ID ?
                        <a type="button" href="<?php echo e(route('appraisal.user.emailConfirmation')); ?>">Comfirm Email</a>
                    </p>
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

    <?php echo $__env->make('appraisal.user.auth.auth-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        // Ensure jQuery is loaded

        $('#resendOtpBtn').on('click', function(e) {
            console.log('resent otp');
            e.preventDefault();

            $.ajax({
                url: route(
                'appraisal.user.resendOtp'), // If route() is not available in JS, replace with the actual URL string
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr(
                        'content') // Assumes CSRF token is in a meta tag
                },
                success: function(response) {
                    if (response.success === true) {
                        // Show success message (replace with your preferred notification method)
                        alert('OTP resent successfully!');
                    } else {
                        // Show error message
                        alert(response.message || 'Failed to resend OTP. Please try again.');
                    }
                },
                error: function(xhr) {
                    // Show error message
                    alert('An error occurred. Please try again.');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/auth/resend-otp.blade.php ENDPATH**/ ?>