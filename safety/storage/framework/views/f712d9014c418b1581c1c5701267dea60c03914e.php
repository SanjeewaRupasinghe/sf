<?php $__env->startSection('title', 'Record of annual appraisals'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 5 of 21</h1>
        <h2>Record of annual appraisals</h2>
    </div>

    <?php
        $content = json_decode(Auth::user()->content);

        $_firstAppraisal = '';
        $_lastAppraisalDate = '';
        $_hasChanged = '';
        $_appraiserName = '';
        $_designatedBody = '';
        $_responsibleOfficer = '';

        try {
            if ($content->annualAppraisals) {
                $_firstAppraisal = $content->annualAppraisals->firstAppraisal;
                $_lastAppraisalDate = $content->annualAppraisals->lastAppraisalDate;
                $_hasChanged = $content->annualAppraisals->hasChanged;
                $_designatedBody = $content->annualAppraisals->designatedBody;
                $_appraiserName = $content->annualAppraisals->appraiserName;
                $_responsibleOfficer = $content->annualAppraisals->responsibleOfficer;
            }
        } catch (\Throwable $th) {
        }
        $LOCKDOWN_STATUS = Auth::user()->status == 0 ? false : true;

    ?>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <?php if(!$LOCKDOWN_STATUS): ?>
        <div class="alert alert-danger" role="alert">
            This profile is locked. You can't change anything.
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            If you made any changes, please click the "Save Form" button to save your details. Otherwise, your changes will not be saved.
        </div>
    <?php endif; ?>

    <form <?php if($LOCKDOWN_STATUS): ?> action="<?php echo e(route('appraisal.user.annual-appraisals.submit')); ?>" <?php endif; ?>
        method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="content-body">

            <div class="content-subsection">

                <!-- Personal Details Section -->
                <div class="form-section" id="personal-details">

                    <!-- First appraisal checkbox -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="firstAppraisal" name="firstAppraisal"
                            <?php if($_firstAppraisal == 'on'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="firstAppraisal">
                            This is my first appraisal
                        </label>
                    </div>

                    <!-- Date of last appraisal -->
                    <div class="mb-3 row">
                        <label for="lastAppraisalDate" class="col-sm-3 col-form-label">Date of last appraisal:
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('dateHelp')"></i>
                        </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="lastAppraisalDate" name="lastAppraisalDate"
                                value="<?php echo e($_lastAppraisalDate); ?>">
                        </div>
                        <div id="dateHelp" class="help-text">
                            Enter name of responsible officer at last appraisal, if different
                        </div>
                    </div>

                    <!-- Changed since last year -->
                    <div class="mb-3">
                        <label class="form-label">Has the name of your appraiser / responsible officer / designated body
                            changed since last year's appraisal?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasChanged" id="changedYes" value="yes"
                                <?php if($_hasChanged == 'yes'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="changedYes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasChanged" id="changedNo" value="no"
                                <?php if($_hasChanged == 'no'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="changedNo">
                                No
                            </label>
                        </div>
                    </div>

                    <!-- Conditional fields that appear when "Yes" is selected -->
                    <div id="conditionalFields"
                        <?php if($_hasChanged == 'yes'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                        <!-- Name of appraiser at last appraisal -->
                        <div class="mb-3 row">
                            <label for="appraiserName" class="col-sm-4 col-form-label">Name of appraiser at last appraisal,
                                if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="appraiserName" name="appraiserName"
                                    value="<?php echo e($_appraiserName); ?>">
                            </div>
                        </div>

                        <!-- Name of responsible officer -->
                        <div class="mb-3 row">
                            <label for="responsibleOfficer" class="col-sm-4 col-form-label">Name of responsible officer at
                                last appraisal, if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="responsibleOfficer" name="responsibleOfficer"
                                    value="<?php echo e($_responsibleOfficer); ?>">
                            </div>
                        </div>

                        <!-- Name of designated body -->
                        <div class="mb-3 row position-relative">
                            <label for="designatedBody" class="col-sm-4 col-form-label">Name of designated body at last
                                appraisal, if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="designatedBody" name="designatedBody"
                                    value="<?php echo e($_designatedBody); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Instructions for attachment -->
                    <div class="mb-3">
                        <p class="small">Please attach a copy of last year's appraisal summary if it is not directly
                            accessible to your appraiser and responsible officer (e.g. via a central database/management
                            system).</p>
                    </div>

                    <div class="mb-3">
                        <p class="small">Please also be mindful of file size when uploading documents. It is advisable to
                            attach your Appraisal Outputs Report (via Section 21 from last year's appraisal form), rather
                            than the full form. If your summary is part of a larger document, it may be wise to print out
                            the summary page, scan it and upload that one section, or log it and provide it separately to
                            your appraiser via Section 14:</p>
                    </div>

                    <!-- File attachment -->
                    <div class="mb-3">
                        <input type="file" class="form-control" id="attachmentFile" name="attachmentFile"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <?php if($LOCKDOWN_STATUS): ?>
                            <button type="button" class="btn btn-success btn-sm mt-2"
                                onclick="handleAttachment()">Attach</button>
                        <?php endif; ?>
                    </div>

                    <div id="attachmentStatus" class="mt-2"></div>

                </div>


                <div class="d-flex justify-content-between">
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.scope-of-work')); ?>">
                        < Previous section</a>
                            <?php if($LOCKDOWN_STATUS): ?>
                                <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                            <?php endif; ?>
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.development-plans')); ?>">Next
                                section ></a>
                </div>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide conditional fields based on radio button selection
        const radioButtons = document.querySelectorAll('input[name="hasChanged"]');
        const conditionalFields = document.getElementById('conditionalFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes' && this.checked) {
                    conditionalFields.style.display = 'block';
                } else if (this.value === 'no' && this.checked) {
                    conditionalFields.style.display = 'none';
                }
            });
        });

        // Handle file attachment
        function handleAttachment() {
            const fileInput = document.getElementById('attachmentFile');
            const statusDiv = document.getElementById('attachmentStatus');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                statusDiv.innerHTML =
                    `<div class="alert alert-success">File "${file.name}" attached successfully (${(file.size / 1024).toFixed(1)} KB)</div>`;
            } else {
                statusDiv.innerHTML = `<div class="alert alert-warning">Please select a file to attach.</div>`;
            }
        }

        // Handle file input change
        document.getElementById('attachmentFile').addEventListener('change', function() {
            const statusDiv = document.getElementById('attachmentStatus');
            if (this.files.length > 0) {
                statusDiv.innerHTML = `<div class="alert alert-info">File selected: ${this.files[0].name}</div>`;
            }
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/annual-appraisals.blade.php ENDPATH**/ ?>