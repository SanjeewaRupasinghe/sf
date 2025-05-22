

<?php $__env->startSection('content'); ?>
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
                    <img src="<?php echo e(asset('appraisal/img/giphy.webp')); ?>" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1><?php echo app('translator')->get('common.Refund'); ?></h1>
					<h1></h1>
				</div>
			</div>
		</marquee>
	</div>
</section>

<section id="" class="about-page-section" style="padding-top: 10px;">
	<div class="container">
		<?php echo app('translator')->get('common.RefundP'); ?>	

	
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/refund.blade.php ENDPATH**/ ?>