
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
            <!-- Register Page -->
            <div id="registerPage" class="auth-container">
                <h2 class="form-title">
                    <i class="fas fa-user-plus me-2"></i>
                    Register
                </h2>

                <form id="registerForm" action="<?php echo e(route('appraisal.user.register.submit')); ?>" method="POST" novalidate>
					<?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                            required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="contact" class="form-label">
                            <i class="fas fa-phone me-2"></i>Contact Number
                        </label>
                        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter your contact number"
                            required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                                required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye text-dark" id="password-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div id="strength-text" style="color: #CB282B;"></div>
                            <div class="strength-bar" id="strength-bar"></div>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirm Password
                        </label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye text-dark" id="confirmPassword-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text">Create Account</span>
                    </button>
                </form>

                <div class="auth-links">
                    <p style="color: #4585EE; margin: 0;">
                        Already have an account?
                        <a type="button" href="<?php echo e(route('appraisal.user.login')); ?>">Sign In</a>
                    </p>
                     <p style="color:#4585EE; margin: 10px 0;">
                        Want to confirm email ID ?
                        <a type="button" href="<?php echo e(route('appraisal.user.emailConfirmation')); ?>">Comfirm Email</a>
                    </p>
                </div>
            </div>

        </div>
    </section>

	<?php echo $__env->make('appraisal.user.auth.auth-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/auth/register.blade.php ENDPATH**/ ?>