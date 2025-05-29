<div>
    <div>
        <div class="section-header">
            Section 5 of 21
            <br>Record of annual appraisals
        </div>

        <div class="section-content">

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold; color: #4a90e2">Please provide the following information:</span>
            </div>

            <div style="margin-bottom: 15px">
                <div style="display: inline-block; margin-right: 200px">
                    <span style="font-weight: bold">This is my first appraisal</span>
                    <span class="checkbox" style="margin-left: 10px"></span>
                </div>
            </div>

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Date of last appraisal:</span>
                <span class="instruction-text">If this is your first appraisal, leave this date blank and
                    tick the box.</span>
                <div class="form-input">
                    <?php echo e($appraisalData['an_lastAppraisalDate'] ?? ''); ?>

                </div>
            </div>

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Has the name of your appraiser / responsible officer / designated
                    body changed since last year's appraisal?</span>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['an_hasChanged']) && $appraisalData['an_hasChanged'] == 'yes' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button"></span> Yes
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['an_hasChanged']) && $appraisalData['an_hasChanged'] == 'no' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button radio-checked"></span> No
                    </div>
                </div>
            </div>

            <?php if(isset($appraisalData['an_hasChanged'])): ?>
                <?php if($appraisalData['an_hasChanged'] == 'yes'): ?>
                    <div style="margin-bottom: 15px">
                        <span style="font-weight: bold">Name of appraiser at last appraisal, if different:</span>
                        <div class="form-input">
                            <?php echo e($appraisalData['an_appraiserName'] ?? ''); ?>

                        </div>
                    </div>

                    <div style="margin-bottom: 15px">
                        <span style="font-weight: bold">Name of responsible officer at last appraisal, if
                            different:</span>
                        <div class="form-input">
                            <?php echo e($appraisalData['an_responsibleOfficer'] ?? ''); ?>

                        </div>
                    </div>

                    <div style="margin-bottom: 15px">
                        <span>Name of designated body at last appraisal, if different:</span>
                        <div class="form-input">
                            <?php echo e($appraisalData['an_designatedBody'] ?? ''); ?>

                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div style="margin-bottom: 15px">
                <span>Please attach a copy of last year's appraisal summary if it is
                    not already accessible to your appraiser and responsible officer
                    (e.g. via a central database/management system).</span>
            </div>

            <div style="margin-bottom: 15px">
                <span>Please also be mindful of file size when uploading documents. It
                    is advisable to attach your Appraisal Outputs Report (via Section
                    21 from last year's appraisal form), rather than the full form. If
                    your summary is part of a larger document, it may be wise to print
                    out the summary page, scan it and just attach that section to this
                    form.</span>
            </div>

        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-5.blade.php ENDPATH**/ ?>