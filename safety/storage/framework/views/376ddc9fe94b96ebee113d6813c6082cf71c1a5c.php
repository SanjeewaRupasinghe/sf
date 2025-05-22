<?php $__env->startSection('content'); ?>



<section class="inerHeader">

<div class="container">

	 <marquee behavior="" direction="">

            <div class="row">

                <div class="col" style="max-width: 60px;">

                    <img src="<?php echo e(asset('site/img/giphy.webp')); ?>" alt="" style="width: 60px;">

                </div>

                <div class="col ps-0 ms-0" style="max-width:200px;">

                    <h1><?php echo app('translator')->get('course/innerpage.Gallery'); ?></h1>

                </div>

            </div>

        </marquee>

</div>

</section>



<section class="courseSection pt-5 pb-5">

    <div class="container">



        <div class="row">
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-3">
                <a href="<?php echo e(asset('storage/gallery/'.$res->image)); ?>" class="" data-lightbox="roadtrip">
                    <img src="<?php echo e(asset('storage/gallery/thumb_'.$res->image)); ?>" class="img-fluid" />
                </a>
            </div>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           

        </div>

    </div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/gallery.blade.php ENDPATH**/ ?>