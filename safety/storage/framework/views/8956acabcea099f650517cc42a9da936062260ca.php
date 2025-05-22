

<?php $__env->startSection('content'); ?>


<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
				<img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1><?php echo app('translator')->get('common.Feedback'); ?></h1>
				</div>
			</div>
		</marquee>
	</div>
</section>

<section class="courseSection pt-5 pb-5">
	<div class="container">
		<h4 class="mb-3"><?php echo app('translator')->get('common.SendMessage'); ?></h4>
	<?php if(session()->has('mailmsg')): ?><div class="alert alert-success"> <?php echo e(session('mailmsg')); ?></div> <?php endif; ?>

		<form method="post" name="form" action="<?php echo e(asset('/appraisal/contact')); ?>" class="form">
            <?php echo csrf_field(); ?>
		<div class="row">				
			<div class="col-md-6 mt-4" id="registerForm">
				<div class="row">
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrName'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="name"  class="form-control" />
						<span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrEmail'); ?></label>
						<span class="text-danger">*</span>
						<input type="email" name="email"  class="form-control" />
						<span class="text-danger"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrMobile'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="phone" class="form-control" />
						<span class="text-danger"><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
					</div>		
					
					<div class="col-sm-12 form-group">
							<div class="g-recaptcha" data-sitekey="6Lf79yoqAAAAAIDI9qYCvokDwBVT1_Pvskk0H5ta"></div>
							<span class="text-danger"><?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>

					</div>	
					<div class="col-sm-12 form-group">
						<div class="genius-btn mt20">
							<button type="submit" name="submit"><?php echo app('translator')->get('common.Submit'); ?></button>
						</div>
					</div>	
					
					
				</div>						
			</div>
				
			<div class="col-md-6 mt-4" id="registerForm">
				<div class="row">						
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrDesig'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="designation"  class="form-control" />
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.UrCompany'); ?></label>
						<span class="text-danger">*</span>
						<input type="text" name="company" class="form-control" />
					</div>					
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.Message'); ?></label>
						<span class="text-danger">*</span>
						<textarea name="message" class="form-control" rows="4"></textarea>
						<span class="text-danger"><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>

					</div>						
				</div>
			</div>
		</div>
		</form>
		
	</div>
</section>


<section id="contact-area" class="contact-area-section backgroud-style">
		<div class="container">
			<div class="contact-area-content">
				<div class="row">
					<div class="col-md-12">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.6134367065865!2d54.40050847412759!3d
								24.498847259634413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e427edac00001%3A0x49a645ccff439f21!
								2sSafety%20First%20Medical%20Services%20(SFMS)!5e0!3m2!1sen!2sin!4v1698654153167!5m2!1sen!2sin"  style="border:0; width:100%; height:300px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
	(function() {

		var quotes1 = $(".quotes1");
		var quoteIndex = -1;

		function showNextQuote() {
			++quoteIndex;
			quotes1.eq(quoteIndex % quotes1.length)
				.fadeIn(2000)
				.delay(2000)
				.fadeOut(2000, showNextQuote);
		}

		showNextQuote();

	})();

	let showNextQuote2FunIntervel = setInterval(Function("showNextQuote2Fun();"), 1500);
	setInterval(Function("clearIntervel();"), 2500);

	function clearIntervel() {
		clearInterval(showNextQuote2FunIntervel);
	}

	function showNextQuote2Fun() {
		(function() {

			var quotes2 = $(".quotes2");
			var quoteIndex2 = -1;

			function showNextQuote2() {
				++quoteIndex2;
				quotes2.eq(quoteIndex2 % quotes2.length)
					.fadeIn(2000)
					.delay(2000)
					.fadeOut(2000, showNextQuote2);
			}

			showNextQuote2();

		})();
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/appraisal/contact.blade.php ENDPATH**/ ?>