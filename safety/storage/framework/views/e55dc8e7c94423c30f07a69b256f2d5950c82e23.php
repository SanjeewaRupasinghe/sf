<?php $__env->startSection('title', 'Achievements, challenges and aspirations'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 12 of 21</h1>
        <h2>Achievements, challenges and aspirations
            <i class="fas fa-question-circle help-icon text-white" onclick="toggleHelp('mainHelp')"></i>
        </h2>
    </div>

    <?php
        $content = json_decode(Auth::user()->content);

        $_challange = '';
        $_includeDocuments = '';
        $_aspirations = '';
        $_discuss = '';
        $_comments = '';

        try {
            if ($content->achievements) {
                $_challange = $content->achievements->challange;
                $_includeDocuments = $content->achievements->includeDocuments;
                $_aspirations = $content->achievements->aspirations;
                $_discuss = $content->achievements->discuss;
                $_comments = $content->achievements->comments;
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
            If you made any changes, please click the "Save Form" button to save your details. Otherwise, your changes will
            not be saved.
        </div>
    <?php endif; ?>

    <form <?php if($LOCKDOWN_STATUS): ?> action="<?php echo e(route('appraisal.user.achievements.submit')); ?>" <?php endif; ?> method="POST">
        <?php echo csrf_field(); ?>
        <div class="content-body">
            <div id="mainHelp" class="help-text">
                It is not required for you to write anything down in this section of your appraisal submission, but you
                should expect your appraiser to raise the subject with you and you have the option of a private conversation
                on these matters. This section equally provides one of the clearest opportunities to ensure that the
                appraisal addresses the personal and professional needs of the doctor.
                <br><br>
                Having assembled and commented on your appraisal information to date it can help to pause in your
                preparation and organise your thoughts before making an entry in this section.
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Information Box -->
                    <div class="mb-3">
                        <p class="mb-2">Whilst these topics are not mandatory for revalidation, it is important to have
                            the opportunity to discuss with your appraiser your achievements over the past year; your
                            aspirations for the future and any challenges you may currently be facing.</p>
                        <p class="mb-0">Appraisal is a formative process and therefore you are encouraged to discuss these
                            topics.</p>
                    </div>

                    <!-- Checkbox for documents -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="includeDocuments" name="includeDocuments"
                            <?php if($_includeDocuments == 'on'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="includeDocuments">
                            If you wish to include documents in support of your comments below, you can do so in Section 14.
                            Please tick here if you have done so.
                        </label>
                    </div>

                    <!-- Achievements and challenges Section -->
                    <div class="mb-4">
                        <div class="p-2 mb-2">
                            <h6 class="mb-0"><strong>Achievements and challenges</strong></h6>
                        </div>
                        <p class="mb-2">You can use this space to detail notable achievements or challenges since your
                            last appraisal, across all of your practice.</p>
                        <textarea class="form-control" rows="8" name="challange"><?php echo e($_challange); ?></textarea>
                    </div>

                    <!-- Aspirations Section -->
                    <div class="mb-4">
                        <div class="p-2 mb-2">
                            <h6 class="mb-0"><strong>Aspirations</strong></h6>
                        </div>
                        <p class="mb-2">You can use this space to detail your career aspirations and what you intend to do
                            in the forthcoming year to work towards this.</p>
                        <textarea class="form-control" rows="8" name="aspirations"><?php echo e($_aspirations); ?></textarea>
                    </div>

                    <!-- Additional Items Section -->
                    <div class="mb-4">
                        <div class="p-2 mb-2">
                            <h6 class="mb-0"><strong>Additional items for discussion</strong></h6>
                        </div>
                        <p class="mb-2">You can use this space to include anything additional that you would like to
                            discuss with your appraiser.</p>
                        <textarea class="form-control" rows="8" name="discuss"><?php echo e($_discuss); ?></textarea>
                    </div>

                    <!-- Appraiser's Comments Section -->
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong></h6>
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentHelp')"></i>
                        </div>
                        <div id="commentHelp" class="help-text">
                            <p class="mb-2">Appraiser's comments boxes appear at the end of a number of sections in this
                                form. Appraisers are encouraged to record their comments here, which are transcribed
                                verbatim into the summary in Section 10. Appraisers should therefore construct their
                                comments accordingly. Please note if you edit the text again in Section 10, it will
                                automatically change the text in the corresponding section.</p>
                            <p class="mb-2"><strong>Comments should include:</strong></p>
                            <ul class="mb-2">
                                <li>an overview of the supporting information and the doctor's accompanying commentary.</li>
                                <li>a comment on the extent to which the supporting information relates to all aspects of
                                    the doctor's scope of work.</li>
                            </ul>
                        </div>
                        <textarea class="form-control" rows="6" name="comments"
                            placeholder="Note for appraiser:Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 10 Summary of the appraisal discussion' boxes."><?php echo e($_comments); ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">

                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.complaints')); ?>">
                            < Previous section</a>
                                <?php if($LOCKDOWN_STATUS): ?>
                                    <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                                <?php endif; ?>
                                <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.probity')); ?>">Next section
                                    ></a>

                    </div>

                </div>
            </div>

        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/achievements.blade.php ENDPATH**/ ?>