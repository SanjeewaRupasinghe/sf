<div>
    <div>
        <div class="section-header">
            Section 15 of 21
            <br>Supporting Information
        </div>

        <div class="section-content">

            <p class="text-primary">
                The following is a self-populating list of all of the documents that you have attached within this form,
                agreed to email to your appraiser in advance or
                provide in hard copy format. If you cannot see a particular item in this list, go back to the section
                and
                check the document attached, or that you
                clicked the ‘Log’ button to add a listing to this table.
            </p>

            <p>
                Please be mindful of attachment sizes. Scroll down to the bottom of the table to see the total size of
                attachments in this form; please ensure it is under
                10MB to enable easy file transfer.
                <br>
                <br>
                Should you wish to add any further documentation or delete any attachments, please return to the
                appropriate
                section.
            </p>


            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Details
                            </th>
                            <th>Size<br>(MB)</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if($appraisalData['an_new_filename']): ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($appraisalData['an_new_filename'] ?? ''); ?></td>
                                <td></td>
                                <td>]
                                    <a class="primary-button"
                                        href="<?php echo e(route('appraisal.user.download.file', ['file' => $appraisalData['an_new_filename']])); ?>">View</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['cpd_roles']) && is_array($appraisalData['cpd_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['cpd_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['qi_roles']) && is_array($appraisalData['qi_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['qi_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['se_roles']) && is_array($appraisalData['se_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['se_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['fb_roles']) && is_array($appraisalData['fb_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['fb_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['com_roles']) && is_array($appraisalData['com_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['com_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(isset($appraisalData['ad_roles']) && is_array($appraisalData['ad_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['ad_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($r->supportingInfo == 'Attached'): ?>
                                    <tr>
                                        <td><?php echo e($r->roles ?? ''); ?></td>
                                        <td><?php echo e($r->new_filename ?? ''); ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $att = null;
                                                try {
                                                    $att = $r->new_filename;
                                                } catch (\Throwable $th) {
                                                }
                                            ?>
                                            <?php if($att): ?>
                                                <a class="primary-button"
                                                    href="<?php echo e(route('appraisal.user.download.file', ['file' => $r->new_filename])); ?>">View</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-15.blade.php ENDPATH**/ ?>