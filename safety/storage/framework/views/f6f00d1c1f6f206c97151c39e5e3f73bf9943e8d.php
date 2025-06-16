

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
                                    <th>Status</th>

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
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 3, 'e' => 4])); ?>"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                3,4</a>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 18, 'e' => 18])); ?>"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                18</a>
                                            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['u' => $result->id, 's' => 3, 'e' => 4, 's1' => 18, 'e1' => 20])); ?>"
                                                target="_blank" type="button" class="btn btn-primary mb-3">Print - Section
                                                3,4,18,19,20</a>
                                        </td>
                                        <td>
                                            <?php if($result->status == 1): ?>
                                                <span class="text-success">
                                                    UNLOCKED
                                                </span>
                                            <?php else: ?>
                                                <span class="text-danger">
                                                    LOCKED
                                                </span>

                                                <!-- MODAL -->
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#unlockModal<?php echo e($result->id); ?>">
                                                    Unlock
                                                </button>

                                                <div class="modal fade" id="unlockModal<?php echo e($result->id); ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="unlockModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="unlockModalLabel">
                                                                    Launch User <?php echo e($result->id); ?>

                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to unlock <?php echo e($result->email); ?>

                                                                    <?php if($_name): ?>
                                                                        (<?php echo e($_name); ?>)
                                                                    <?php endif; ?>?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <a href="<?php echo e(route('admin.appraisal.user.unlock', ['userId' => $result->id])); ?>"
                                                                    class="btn btn-primary">Launch</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END MODAL -->
                                            <?php endif; ?>
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