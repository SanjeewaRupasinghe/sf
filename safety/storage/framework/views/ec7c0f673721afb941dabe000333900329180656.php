
<?php $__env->startSection('content'); ?>
<section class="inerHeader">
<div class="container">
	 <marquee behavior="" direction="">
            <div class="row">
                <div class="col" style="max-width: 60px;">
                    <img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">
                </div>
                <div class="col ps-0 ms-0" style="max-width:200px;">
                    <h1><?php echo app('translator')->get('course/innerpage.Courses'); ?></h1>
                </div>
            </div>
        </marquee>
</div>
</section>
<section class="courseSection pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="section-title-2 mb65 headline text-left">
					<h2><?php echo e($category); ?></h2>
				</div>
			</div>
			<div class="col-sm-3">
				<form>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search Here...." />
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-md-3">
				<div class="tutor-card">
					<div class="tutor-course-thumbnail">
						<a href="<?php echo e(asset('/course/course/'.$cors->slug)); ?>" class="tutor-d-block">
							<img src="<?php echo e(asset('storage/course/thumb_'.$cors->image)); ?>" class="img-fluid" />
						</a>
					</div>
					<div class="tutor-card-body">
						<h3 class="tutor-course-name">
							<a href="<?php echo e(asset('/course/course/'.$cors->slug)); ?>">
								<?php if(app()->getLocale()=='en'): ?><?php echo e($cors->name); ?> <?php else: ?> <?php echo e($cors->ar_name); ?> <?php endif; ?>
							</a>
						</h3>
						<div class="tutor-meta">
							<div>
								<!--<i class="fa fa-user" area-hidden="true"></i>
								<span class="tutor-meta-value">93</span>-->
							</div>
							<div>
								<i class="fa fa-clock" area-hidden="true"></i>
								<span class="tutor-meta-value">
									<?php if(app()->getLocale()=='en'): ?><?php echo e($cors->duration); ?> <?php else: ?> <?php echo e($cors->ar_duration); ?> <?php endif; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/courses.blade.php ENDPATH**/ ?>