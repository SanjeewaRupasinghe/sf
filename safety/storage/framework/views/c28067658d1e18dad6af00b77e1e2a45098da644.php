<div class="side-bar">
    <div class="side-bar-search">
        <form action="" method="get">
            <input type="text" class="" name="q" placeholder="Search Insights">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="side-bar-widget">
        <h2 class="widget-title text-capitalize"><?php echo app('translator')->get('course/innerpage.InsightRight1'); ?></h2>
        <div class="post-categori ul-li-block">
            <ul>
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="cat-item  "><a href="#"><?php if(app()->getLocale()=='en'): ?><?php echo e($cat->name); ?> <?php else: ?> <?php echo e($cat->ar_name); ?> <?php endif; ?> <!--<span>(<?php echo e($cat->count->count()); ?>)</span>--></a></li>	
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                    
            </ul>
        </div>
    </div>
    <div class="side-bar-widget">
        <h2 class="widget-title text-capitalize"><?php echo app('translator')->get('course/innerpage.InsightRight2'); ?></h2>
        <div class="tag-clouds ul-li">
            <ul>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="#" class="tag-cloud-link"><?php echo e($tag); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                   
            </ul>
        </div>
    </div>
</div><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/site/blogright.blade.php ENDPATH**/ ?>