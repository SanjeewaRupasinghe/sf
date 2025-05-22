<li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>        <span>Course Blog</span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('blogCategory.index')); ?>">Manage Categories</a>
            <a class="collapse-item" href="<?php echo e(route('blogCategory.create')); ?>">New Category</a>
            <a class="collapse-item" href="<?php echo e(route('blogPost.index')); ?>">Manage Posts</a>
            <a class="collapse-item" href="<?php echo e(route('blogPost.create')); ?>">New Post</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i><span>Courses</span>
    </a>
    <div id="collapse2" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('category.index')); ?>">Manage Categories</a>
            <a class="collapse-item" href="<?php echo e(route('category.create')); ?>">New Category</a>
            <a class="collapse-item" href="<?php echo e(route('course.index')); ?>">Manage Course</a>
            <a class="collapse-item" href="<?php echo e(route('course.create')); ?>">New Course</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>        <span>Course Calendar</span>
    </a>
    <div id="collapse3" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('courseCalendar.index')); ?>">Manage Calendar</a>
            <a class="collapse-item" href="<?php echo e(route('courseCalendar.create')); ?>">New  Calendar Date</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>        <span>Course Gallery</span>
    </a>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('image.index')); ?>">Manage Gallery Images</a>
            <a class="collapse-item" href="<?php echo e(route('image.create')); ?>">New  Image</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>        <span>Appraisal Blog</span>
    </a>
    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('apBlogCategory.index')); ?>">Manage Categories</a>
            <a class="collapse-item" href="<?php echo e(route('apBlogCategory.create')); ?>">New Category</a>
            <a class="collapse-item" href="<?php echo e(route('apBlogPost.index')); ?>">Manage Posts</a>
            <a class="collapse-item" href="<?php echo e(route('apBlogPost.create')); ?>">New Post</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i><span>Appraisal Courses</span>
    </a>
    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo e(route('apCategory.index')); ?>">Manage Categories</a>
            <a class="collapse-item" href="<?php echo e(route('apCategory.create')); ?>">New Category</a>
            <a class="collapse-item" href="<?php echo e(route('apCourse.index')); ?>">Manage Course</a>
            <a class="collapse-item" href="<?php echo e(route('apCourse.create')); ?>">New Course</a>
        </div>
    </div>
</li>
<?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/admin/menu.blade.php ENDPATH**/ ?>