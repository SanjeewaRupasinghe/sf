

<?php $__env->startSection('content'); ?>
<h1 class="h3 mb-4 text-gray-800">Change Password </h1>    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <form action="<?php echo e(route('admin.update',$admin->id)); ?>" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">                      
                        <div class="row"> 
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Old Password</label>
                                <input type="text" id="old_password" name="old_password" class="form-control" >
                                <span class="text-danger"><?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="form-phone">New Password</label>
                                <input type="text" id="new_password" name="new_password" class="form-control" >
                                <span class="text-danger"><?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                            </div>
    
                            <div class="form-group col-sm-12">
                                <label for="form-phone">Confirm Password</label>
                                <input type="text" id="con_password" name="confirm_password" class="form-control" >
                                <span class="text-danger"><?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                            </div>


                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-info" value="UPDATE" name="add" id="button">
                            </div>
                        </div>
                    </form>
                    <?php if(session()->has('msg')): ?><div class="alert alert-danger"> <?php echo e(session('msg')); ?></div><?php endif; ?>

                </div>
            </div>
        </div>
    </div>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/admin/change_password.blade.php ENDPATH**/ ?>