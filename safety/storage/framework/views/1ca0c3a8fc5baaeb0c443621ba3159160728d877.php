
<?php $__env->startSection('content'); ?>
<section class="inerHeader">
	<div class="container">
	<marquee behavior="" direction="">
            <div class="row">
                <div class="col" style="max-width: 60px;">
                    <img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">
                </div>
                <div class="col ps-0 ms-0" style="max-width:200px;">
                    <h1>Services</h1>
                </div>
            </div>
        </marquee>
	</div>
</section>

<section class="courseSection pt-5 pb-5">
	<div class="container">
		<div class="course-details-page">
			<div class="course-details-header">
				<div class="row">
					<div class="col-sm-10">
						<h1 class="course-details-title"><?php if(app()->getLocale()=='en'): ?><?php echo e($result->name); ?> <?php else: ?> <?php echo e($result->ar_name); ?> <?php endif; ?></h1>
						<div class="course-details-info">
							<div>Category: <a href="#">
								<?php if(app()->getLocale()=='en'): ?><?php echo e($result->ApCategory->name); ?> <?php else: ?> <?php echo e($result->ApCategory->ar_name); ?> <?php endif; ?>
							</a></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="course-details-actions">
							<div class="genius-btn" style="float: right;">
								<a href="#registerForm"> Inquire Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="course-details-body">
				<div class="row">
					<div class="col-sm-8">
						<div class="course-thumbnail">
							<img src="<?php echo e(asset('storage/service/thumb_'.$result->image)); ?>" class="img-fluid" />
						</div>
						<div class="course-details-tab">
							<?php if(app()->getLocale()=='en'): ?><?php echo $result->description; ?> <?php else: ?> <?php echo $result->ar_description; ?> <?php endif; ?>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-course-sidebar">
							<div class="course-sidebar-card" style="background-color:#0063a7;">
								<div class="course-card-head">
									<ul class="course-ul">
										<?php 
										if(app()->getLocale()=='en')
										{
											$reqs=explode(',',$result->extras);
										}
										else
										{
											$reqs=explode(',',$result->ar_extras);
										}
										?>
										<?php $__currentLoopData = $reqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li style="color:#fff;"><i class="fa fa-arrow-right"></i><?php echo e($req); ?></li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							</div>
							<div class="course-sidebar-card">
								<div class="course-details-instructors">
									<h5 class="text-light">Price</h5>
									<a href="#">
										<i class="fas fa-graduation-cap"></i>
										<span>AED <?php echo e($result->price); ?></span>
									</a>
								</div>
								<div class="course-details-widget">
									<h5>Requirements</h5>
									<ul>
										<?php 
										if(app()->getLocale()=='en')
										{
											$reqs=explode(',',$result->requirements);
										}
										else
										{
											$reqs=explode(',',$result->ar_requirements);
										}
										?>
										<?php $__currentLoopData = $reqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li><?php echo e($req); ?></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 mt-4" id="registerForm">
						<h4 class="mb-3">Registration</h4>
                            <?php if(session()->has('mailmsg')): ?><div class="alert alert-success"> <?php echo e(session('mailmsg')); ?></div> <?php endif; ?>
						<form method="post" name="form" action="<?php echo e(asset('/appraisal/register')); ?>" class="form">
							<?php echo csrf_field(); ?>
							<input type="hidden" name="rootId" value="<?php echo e($root); ?>">
							<input type="hidden" name="corsId" value="<?php echo e($result->id); ?>">
							<input type="hidden" name="corsName" value="<?php echo e($result->name); ?>">
							<div class="row">
								<div class="col-sm-8 form-group">
									<label>Your full name<span class="text-danger">*</span></label>
									<input type="text" name="name" placeholder="Your full name" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Your Email<span class="text-danger">*</span></label>
									<input type="email" name="email" placeholder="Your Email" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Your Mobile<span class="text-danger">*</span></label>
									<input type="text" name="mobile" placeholder="Your Mobile" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>GMC Number<span class="text-danger">*</span></label>
									<input type="text" name="gmc" placeholder="GMC Number" class="form-control" required/>
								</div>
								<div class="col-sm-4 form-group">
									<label>Profession<span class="text-danger">*</span></label>
									<input type="text" name="profession" placeholder="Profession " class="form-control" required/>
								</div>								
							
								<div class="col-sm-12 form-group">
									<div class="genius-btn mt20">
										<button type="submit" name="submit">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('appraisal.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/appraisal/course-single.blade.php ENDPATH**/ ?>