<?php if(session('success')): ?>
    <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <i class="ri-check-double-line label-icon"></i><strong><?php echo session('success'); ?></strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if(session('fail')): ?>
    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <i class="ri-error-warning-line label-icon"></i><strong><?php echo session('fail'); ?></strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
            <i class="ri-error-warning-line label-icon"></i><strong><?php echo e($error); ?></strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/common/alert.blade.php ENDPATH**/ ?>