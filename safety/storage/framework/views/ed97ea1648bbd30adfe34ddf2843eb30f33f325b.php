

<?php $__env->startSection('content'); ?>

    <h1 class="h3 mb-4 text-gray-800">New Date <a href="<?php echo e(route('courseCalendar.index')); ?>" class="btn btn-info float-right">Back</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
        <div class="row">
            <div class="col-sm-12" >
                <form action="<?php echo e(route('courseCalendar.store')); ?>" method="post"  name="fname" enctype="multipart/form-data" role="form" id="formm">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="form-phone">Select Course </label>
                             <select id="course" name="course" class="form-control <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                <option value="">Select</option>
                                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cors->id); ?>"><?php echo e($cors->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="text-danger"><?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="form-phone">Select Date (yyyy-mm-dd)</label>
                            <input type="text" id="date" name="date" class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e('is-invalid'); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('date')); ?>" >
                            <span class="text-danger"><?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>                       

                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-info" value="SUBMIT" name="add" id="button">
                        </div>
                    </div>
                </form>
                <?php if(session()->has('msg')): ?><div class="alert alert-danger"> <?php echo e(session('msg')); ?></div><?php endif; ?>

            </div>
        </div>
        </div>
    </div>   

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>   
    $(function() {
         $('#date').datepicker({
            format:'yyyy-mm-dd',
            multidate:true,
            startDate: new Date(),
            todayHighlight:true
           });      
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/admin/calendar_add.blade.php ENDPATH**/ ?>