<?php $__env->startSection('content'); ?>
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
					<img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1><?php echo app('translator')->get('course/innerpage.Insights'); ?></h1>
				</div>
			</div>
		</marquee>
	</div>
</section>
<section id="blog-item" class="blog-item-post">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="blog-details-content">
					<div class="post-content-details mb-5">
						<div class="blog-detail-thumbnile mb35">
                            <img src="<?php echo e(asset('storage/blog/thumb_'.$blog->image)); ?>" alt="">
						</div>
						<h2><?php if(app()->getLocale()=='en'): ?><?php echo e($blog->name); ?> <?php else: ?> <?php echo e($blog->ar_name); ?> <?php endif; ?></h2>
						<div class="row">
							<div class="col">
								<div class="date-meta text-uppercase">
									<span><i class="fas fa-calendar-alt"></i> <?php echo e(Carbon\Carbon::parse($blog->publish)->format('l d Y')); ?></span>
									<span><i class="fas fa-user"></i> 
										<?php if(app()->getLocale()=='en'): ?><?php echo e($blog->blogCategory->name); ?> <?php else: ?> <?php echo e($blog->blogCategory->ar_name); ?> <?php endif; ?>
										</span>
								</div>
							</div>
							<div class="col text-right">
								<div class="date-meta text-uppercase share-on">
									<span>
										<a href="https://www.facebook.com" target="_blank">
											<i class="fab fa-facebook"></i>
										</a>
									</span>
									<span>
										<a href="https://www.instagram.com" target="_blank">
											<i class="fab fa-instagram"></i>
										</a>
									</span>
									<span>
										<a href="https://www.linkedin.com/" target="_blank">
											<i class="fab fa-linkedin"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
						<?php if(app()->getLocale()=='en'): ?>
						<?php echo $blog->description; ?>

						<?php else: ?>
						<?php echo $blog->ar_description; ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php echo $__env->make('site.blogright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/blog-single.blade.php ENDPATH**/ ?>