<div class="">
    <div class="">
        <div class="section-header">
            Section 3 of 21
            <br>Personal details
        </div>

        <div class="section-content">
            <div class="form-row">
                <label class="form-label">* Name:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_name'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* GMC number:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_gmcNumber'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Contact address (for any official correspondence concerning your appraisal):</label>
                <div class="form-input form-input-large"><?php echo e($appraisalData['pd_address'] ?? ''); ?></div>
            </div>

            <p class="text-small">Please ensure that you provide an email address and telephone number to allow your appraiser to contact you.</p>

            <div class="form-row">
                <label class="form-label">* Contact telephone number:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_phone'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Contact email address:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_email'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Name of designated body:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_designation'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Medical qualifications, UK or elsewhere, including dates where appropriate</label>
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Qualification</th>
                            <th>Awarding body</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($appraisalData['pd_medicalQualifications']) && is_array($appraisalData['pd_medicalQualifications'])): ?>
                            <?php $__currentLoopData = $appraisalData['pd_medicalQualifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($qualification->qualification ?? ''); ?></td>
                                <td><?php echo e($qualification->awardingBody ?? ''); ?></td>
                                <td><?php echo e($qualification->year ?? ''); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="form-row">
                <label class="form-label">* Year of this appraisal:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_yearOfAppraisal'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Due date of next revalidation recommendation:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_revalidationRecommendation'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">* Appraiser's name:</label>
                <div class="form-input"><?php echo e($appraisalData['pd_secondAppraiser'] ?? ''); ?></div>
            </div>

            <div class="form-row">
                <label class="form-label">Are you a clinical academic who requires a second appraiser under the Follett principles?</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <span class="radio-button <?php echo e((isset($appraisalData['pd_clinicalAcademic']) && $appraisalData['pd_clinicalAcademic'] == 'yes') ? 'radio-checked' : ''); ?>">o</span>
                        Yes
                    </div>
                    <div class="radio-option">
                        <span class="radio-button <?php echo e((isset($appraisalData['pd_clinicalAcademic']) && $appraisalData['pd_clinicalAcademic'] == 'no') ? 'radio-checked' : ''); ?>">o</span>
                        No
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-3.blade.php ENDPATH**/ ?>