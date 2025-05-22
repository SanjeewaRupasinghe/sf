
<?php $__env->startSection('content'); ?>
<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
		<div class="row">
			<div class="col" style="max-width: 60px;">
				<img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">
			</div>
			<div class="col ps-0 ms-0"  style="max-width:200px;">
				<h1><?php echo app('translator')->get('course/innerpage.Courses'); ?></h1>
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
						<h1 class="course-details-title">
							<?php if(app()->getLocale()=='en'): ?><?php echo e($result->name); ?> <?php else: ?> <?php echo e($result->ar_name); ?> <?php endif; ?>
						</h1>
						<div class="course-details-info">
							<div><?php echo app('translator')->get('course/innerpage.Category'); ?>: <a href="#">
								<?php if(app()->getLocale()=='en'): ?><?php echo e($result->Category->name); ?> <?php else: ?> <?php echo e($result->Category->ar_name); ?> <?php endif; ?>
								</a></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="course-details-actions">
							<div class="genius-btn" style="float: right;">
								<a href="#registerForm"> <?php echo app('translator')->get('course/innerpage.Register'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="course-details-body">
				<div class="row">
					<div class="col-sm-8">
						<div class="course-thumbnail">
							<img src="<?php echo e(asset('storage/course/thumb_'.$result->image)); ?>" class="img-fluid" />
						</div>
						<div class="course-details-tab">
							<h4 style="color:#f00"><?php echo app('translator')->get('course/innerpage.AboutCourse'); ?></h4>
							<?php if(app()->getLocale()=='en'): ?><?php echo $result->description; ?> <?php else: ?> <?php echo $result->ar_description; ?> <?php endif; ?>
							
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-course-sidebar">
							<div class="course-sidebar-card" style="background-color:#0063a7;">
								<div class="course-card-head">
									<ul class="course-ul">
										<li style="color:#fff;"><i class="fa fa-clock"></i>
											<?php if(app()->getLocale()=='en'): ?><?php echo e($result->duration); ?> <?php else: ?> <?php echo e($result->ar_duration); ?> <?php endif; ?>
											</li>
										<li style="color:#fff;"><i class="fa fa-allergies "></i><?php echo e($result->lastupdate); ?> <?php echo app('translator')->get('course/innerpage.LastUpdated'); ?> </li>
									</ul>
								</div>
							</div>
							<div class="course-sidebar-card">
								<div class="course-details-instructors">
									<h5 class="text-light"><?php echo app('translator')->get('course/innerpage.Acourseby'); ?></h5>
									<a href="#">
										<i class="fas fa-graduation-cap"></i>
										<span>
											<?php if(app()->getLocale()=='en'): ?><?php echo e($rootCat->name); ?> <?php else: ?> <?php echo e($rootCat->ar_name); ?> <?php endif; ?>											
										</span>
									</a>
								</div>
								<div class="course-details-widget">
									<h5><?php echo app('translator')->get('course/innerpage.Requirements'); ?></h5>
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
						<h4 class="mb-3"><?php echo app('translator')->get('course/innerpage.Registration'); ?></h4>
                            <?php if(session()->has('mailmsg')): ?><div class="alert alert-success"> <?php echo e(session('mailmsg')); ?></div> <?php endif; ?>
						<form method="post" name="form" action="/course/register" class="form" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
							<input type="hidden" name="rootId" value="<?php echo e($root); ?>">
							<input type="hidden" name="corsId" value="<?php echo e($result->id); ?>">
							<input type="hidden" name="corsName" value="<?php echo e($result->name); ?>">
							<input type="hidden" name="corsBy" value="<?php echo e($rootCat->name); ?>">

							<div class="row">
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.UrName'); ?></label><span class="text-danger">*</span>
									<input type="text" name="name" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.UrEmail'); ?> </label><span class="text-danger">*</span>
									<input type="email" name="email" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.UrMobile'); ?> </label><span class="text-danger">*</span>
									<input type="text" name="mobile" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 form-group">
									<label><?php echo app('translator')->get('course/innerpage.Address'); ?></label><span class="text-danger">*</span>
									<textarea name="address" class="form-control" rows="2"></textarea>
									<span class="text-danger"><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.Placeofwork'); ?></label><span class="text-danger">*</span>
									<input type="text" name="work" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['work'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.Profession'); ?></label><span class="text-danger">*</span>
									<input type="text" name="profession" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['profession'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.DateofCourse'); ?></label><span class="text-danger">*</span>
									<input type="date" name="date" class="form-control" />
									<span class="text-danger"><?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
								</div>
							</div>

							<?php if($result->id==8 || $result->id==9): ?>

							<p class="mb-3"><?php echo app('translator')->get('course/innerpage.Smallhead'); ?>
								
							</p>

							<div class="row">
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.AHABLS'); ?></label>
									<select class="form-control" name="blssts">
										<option value=""><?php echo app('translator')->get('course/innerpage.Select'); ?></option>
										<option value="YES"><?php echo app('translator')->get('course/innerpage.YES'); ?></option>
										<option value="NO"><?php echo app('translator')->get('course/innerpage.NO'); ?></option>
									</select>
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.DateofExpiry'); ?></label>
									<input type="date" name="doe" class="form-control" />
								</div>
								<div class="col-sm-4 form-group">
									<label><?php echo app('translator')->get('course/innerpage.BLSCard'); ?></label>
									<input type="file" name="card" class="form-control" />
								</div>

								<div class="col-sm-12 form-group">
									<label><?php echo app('translator')->get('course/innerpage.Comment'); ?></label>
									<textarea name="comment" class="form-control" rows="2"></textarea>
								</div>
							</div>
							<?php endif; ?>
								
								<div class="row">
									<div class="col-sm-12 form-group">
									<div class="genius-btn mt20">
										<button type="submit" name="submit"><?php echo app('translator')->get('course/innerpage.Submit'); ?></button>
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
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/course-single.blade.php ENDPATH**/ ?>