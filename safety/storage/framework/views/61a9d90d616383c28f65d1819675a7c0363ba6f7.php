
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
        <div class="blog-content-details">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-post-content">
                        <div class="row">
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-sm-12">
                                <div class="blog-post-img-content">
                                    <div class="blog-img-date relative-position">
                                        <div class="blog-thumnile">
                                            <img src="<?php echo e(asset('storage/blog/thumb_'.$blog->image)); ?>" alt="">
                                        </div>
                                        <div class="course-price text-center genius-btn">
                                            <span><?php echo e(Carbon\Carbon::parse($blog->publish)->format('F Y')); ?></span>
                                        </div>
                                    </div>
                                    <div class="blog-title-content headline">
                                        <h3>
                                            <a href="<?php echo e(asset('/course/blog/'.$blog->slug)); ?>">
                                                <?php if(app()->getLocale()=='en'): ?><?php echo e($blog->name); ?> <?php else: ?> <?php echo e($blog->ar_name); ?> <?php endif; ?>
                                            </a>
                                        </h3>
                                        <div class="blog-content">
                                            <?php if(app()->getLocale()=='en'): ?>
                                            <?php $short= substr(strip_tags($blog->description),0,100); ?>
                                            <?php else: ?>
                                            <?php $short= substr(strip_tags($blog->ar_description),0,100); ?>
                                            <?php endif; ?>
                                            <?php echo e($short); ?>...
                                        </div>
                                        <div class="view-all-btn bold-font">
                                            <a href="<?php echo e(asset('/course/blog/'.$blog->slug)); ?>"><?php echo app('translator')->get('course/innerpage.Readmore'); ?> <i class="fas fa-chevron-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>	
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php echo $__env->make('site.blogright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/site/blogs.blade.php ENDPATH**/ ?>