

<?php $__env->startSection('content'); ?>
<?php if(session()->has('msg')): ?><div class="alert alert-success"> <?php echo e(session('msg')); ?></div><?php endif; ?>
    <h1 class="h3 mb-4 text-gray-800">Gallery Images 
        <a href="<?php echo e(route('image.create')); ?>" class="btn btn-info float-right">New Image</a></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" >
                    <div class="table-responsive1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Image</th>
                        <th></th>                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                    ?>
                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><img src="<?php echo e(asset('storage/gallery/thumb_'.$result->image)); ?>" style="height: 50px"></td>
                       ndif
                        </td>
                        <td>
                            <form method="post" action="<?php echo e(route('image.destroy',$result->id)); ?>" class="form-inline d-inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" name="delete" class=""><i class="fa fa-trash"></i></button>
                            </form>
                        </td>                 
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/897092.cloudwaysapps.com/qnjpvbnhcv/public_html/safety/resources/views/admin/image_list.blade.php ENDPATH**/ ?>