

<?php $__env->startSection('content'); ?>
    <?php if(session()->has('msg')): ?>
        <div class="alert alert-success"> <?php echo e(session('msg')); ?></div>
    <?php endif; ?>
    <h1 class="h3 mb-4 text-gray-800">Appraisal Category
    </h1>
    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $content = json_decode($result->content);
                                        $_name = '';

                                        try {
                                            if ($content->personalDetails) {
                                                $_name = $content->personalDetails->name;
                                            }
                                        } catch (\Throwable $th) {
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($_name); ?></td>
                                        <td><?php echo e($result->email); ?></td>
                                        <td><?php echo e($result->contact); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id])); ?>"
                                                class="btn btn-primary mb-3" target="_blank">
                                                Print - whole form
                                            </a>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 3, 'e' => 4])); ?>" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 3,4</a>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 18, 'e' => 18])); ?>" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 18</a>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id,'s' => 3, 'e' => 4, 's1' => 18, 'e1' => 20])); ?>" target="_blank"
                                                type="button" class="btn btn-primary mb-3">Print - Section 3,4,18,19,20</a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/admin/ap/appraisal-user.blade.php ENDPATH**/ ?>