<?php $__env->startSection('content'); ?>

<section class="inerHeader">
	<div class="container">
		<marquee behavior="" direction="">
			<div class="row">
				<div class="col" style="max-width: 60px;">
                    <img src="<?php echo e(asset('products/img/giphy.webp')); ?>" alt="" style="width: 60px;">
				</div>
				<div class="col ps-0 ms-0" style="max-width:200px;">
					<h1><?php echo app('translator')->get('common.PayNow'); ?> </h1>
				</div>
			</div>
		</marquee>
	</div>
</section>

<section id="" class="about-page-section" style="padding-top: 10px;">
	<div class="container">
		<div style="max-width: 600px; margin: auto;">
		<form name="pay" action="/paynow" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
			<input type="hidden" name="type" value="Product">
				<div class="row">
					<div class="col-sm-6 form-group">
						<label>Product Package <span class="text-danger">*</span></label>
						<input type="text" name="package" placeholder="Package Name" class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.Amount'); ?><span class="text-danger">*</span></label>
						<input type="text" name="amount" placeholder="Your Amount" class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.UrName'); ?><span class="text-danger">*</span></label>
						<input type="text" name="name" placeholder="Your Full Name" class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.UrEmail'); ?><span class="text-danger">*</span></label>
						<input type="email" name="email" placeholder="Your Email" class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.UrMobile'); ?><span class="text-danger">*</span></label>
						<input type="tel" name="mobile" class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.Address'); ?><span class="text-danger">*</span></label>
						<input type="text" name="address" placeholder="Address " class="form-control" required />
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.Country'); ?><span class="text-danger">*</span></label>
						<!-- <input type="text" name="country" placeholder="Country " class="form-control" /> -->
						<select name="country" placeholder="Country " class="form-control">
							<option value="UAE">UAE</option>
						</select>
					</div>
					<div class="col-sm-6 form-group">
						<label><?php echo app('translator')->get('common.City'); ?><span class="text-danger">*</span></label>
						<input type="text" name="city" placeholder="e.g. Dubai, UAE " class="form-control" />
					</div>
					<div class="col-sm-12 form-group">
						<label><?php echo app('translator')->get('common.Remarks'); ?></label>
						<textarea name="remarks" id="" style="width: 100%;" class="form-control"></textarea>
					</div>
					<div class="col-sm-12 form-group">
						<input type="checkbox" name="termsAndCond" required>
						<label for="basiInput" class="form-label" style="font-size: 14px;"><b>I
							<?php echo app('translator')->get('common.Terms1'); ?>
								<a href="<?php echo e(asset('product/terms')); ?>" class="text-primary">
									<?php echo app('translator')->get('common.Terms'); ?> <span class="text-danger">*</span></a></b>
						</label>
						<div>
							<label>
								<?php echo app('translator')->get('common.Agreement'); ?>
							</label>
						</div>
					</div>
					<div class="col-sm-12 form-group">
						<div class="genius-btn mt20">
							<button type="submit" name="submit"><?php echo app('translator')->get('common.Submit'); ?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('product.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/product/paynow.blade.php ENDPATH**/ ?>