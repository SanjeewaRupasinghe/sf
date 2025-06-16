<?php $__env->startSection('title', 'Probity and health statements'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 13 of 21</h1>
        <h2>Probity and health statements
        </h2>
    </div>

    <?php
        $content = json_decode(Auth::user()->content);

        $_probityConfirm = '';
        $_probityDeclaration = '';
        $_gmcOrOther = '';
        $_healthConfirm = '';
        $_comments = '';

        try {
            if ($content->probity) {
                $_probityConfirm = $content->probity->probityConfirm;
                $_probityDeclaration = $content->probity->probityDeclaration;
                $_gmcOrOther = $content->probity->gmcOrOther;
                $_healthConfirm = $content->probity->healthConfirm;
                $_comments = $content->probity->comments;
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

    <form action="<?php echo e(route('appraisal.user.probity.submit')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="content-body">

            <!-- Header -->
            <p class="text-primary mb-3"><strong>Please read and respond to the following statements.</strong></p>

            <!-- Probity Section -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-0 me-2"><strong>Probity</strong></h6>
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('probityHelp')"></i>
                </div>
                <div id="probityHelp" class="help-text">
                    If you are subject to any suspensions, restrictions or investigations, or if you have been asked to
                    include specific information in your
                    appraisal but you are not including this in your appraisal submission it is vital that you discuss this
                    with your appraiser or responsible
                    officer before finalising your appraisal submission. Failure to include such information without prior
                    discussion could constitute a failure
                    of probity which could call into question your fitness to practise.
                    <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further guidance on the requirements of Good Medical Practice and a doctor's probity and health
                        obligations with regards to
                        revalidation can be found here.
                    </a>
                </div>
                <p class="mb-3">"I declare that I accept the professional obligations placed on me in Good Medical
                    Practice in relation to probity, including the statutory obligation on me to ensure that I have adequate
                    professional indemnity for all my professional roles and the professional obligation on me to manage my
                    interests appropriately."</p>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="probityConfirm" name="probityConfirm"
                        <?php if($_probityConfirm == 'on'): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="probityConfirm">
                        Please tick here to confirm.
                    </label>
                </div>

                <p class="mb-3">If you feel that you are unable to make this statement for whatever reason, please explain
                    why in the comment box below.</p>

                <p class="mb-3"><strong>"In relation to suspensions, restrictions on practice or being subject to an
                        investigation of any kind since my last appraisal:</strong></p>


                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="probityDeclaration" id="probityNothing" <?php if($_probityDeclaration == 'nothing'): ?> checked <?php endif; ?>
                        value="nothing">
                    <label class="form-check-label" for="probityNothing" >
                        I have nothing to declare."
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="probityDeclaration" id="probitySomething"  <?php if($_probityDeclaration == 'something'): ?> checked <?php endif; ?>
                        value="something">
                    <label class="form-check-label" for="probitySomething">
                        I have something to declare."
                    </label>
                </div>

                <!-- Conditional textarea for probity declaration -->
                <div id="probityDeclarationSection"
                    <?php if($_probityDeclaration == 'something'): ?> style="display: block; <?php else: ?> style="display: none; <?php endif; ?>">
                    <p class="mb-2">If you have been suspended from any medical post, have restrictions placed on your
                        practice or are currently under investigation by the GMC or any other body since your last
                        appraisal, please declare this below.</p>
                    <textarea class="form-control" name="gmcOrOther"><?php echo e($_gmcOrOther); ?></textarea>
                </div>
            </div>

            <!-- Health Section -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-0 me-2"><strong>Health</strong></h6>
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('healthHelp')"></i>
                </div>

                <div id="healthHelp" class="help-text">
                    Academy guidance indicates that, when making a health declaration that you accept your professional
                    obligations in this way, it is
                    appropriate to consider any relevant specialty guidance, as certain specialties may have specific
                    requirements in relation to health, such
                    as immunisation and infection control procedures. Further guidance on making a health declaration can be
                    found here.

                    <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further guidance on the requirements of Good Medical Practice and a doctor's probity and health
                        obligations with regards to revalidation
                        are available here
                    </a>
                </div>

                <p class="mb-3">"I declare that I accept the professional obligations placed on me in Good Medical
                    Practice about my personal health."</p>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="healthConfirm" name="healthConfirm"
                        <?php if($_healthConfirm == 'on'): ?> checked <?php endif; ?>>
                    <label class="form-check-label" for="healthConfirm">
                        Please tick here to confirm.
                    </label>
                </div>

                <p class="mb-3">If you feel that you are unable to make this statement for whatever reason, please explain
                    why in the comment box below.</p>

                <p class="mb-3">If you would like to make any comments to your appraiser regarding any of these topics,
                    please do so here.</p>
            </div>

            <!-- Empty textarea section -->
            <div class="mb-4">
                <textarea class="form-control" rows="8" name="comments"><?php echo e($_comments); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route("appraisal.user.achievements")); ?>">
                    < Previous section</a>
                    <?php if($LOCKDOWN_STATUS): ?>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <?php endif; ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route("appraisal.user.additional-info")); ?>">Next section ></a>
            </div>


        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/probity.blade.php ENDPATH**/ ?>