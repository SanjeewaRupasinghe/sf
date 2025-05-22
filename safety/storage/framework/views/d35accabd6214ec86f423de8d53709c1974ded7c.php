

<?php $__env->startSection('content'); ?>
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
                    <img src="<?php echo e(asset('appraisal/img/giphy.webp')); ?>" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1><?php echo app('translator')->get('common.Privacy'); ?></h1>
				</div>
			</div>
		</marquee>
	</div>
</section>

<section id="" class="about-page-section" style="padding-top: 10px;">
	<div class="container">
	    <h3><?php echo app('translator')->get('common.PrivacyH'); ?></h3>
		<?php echo app('translator')->get('common.PrivacyP'); ?>	
	
	
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/privacy.blade.php ENDPATH**/ ?>