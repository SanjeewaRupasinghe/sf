<div>
    <div>
        <div class="section-header">
            Section 12 of 21
            <br>Achievements, challenges and aspirations
        </div>

        <div class="section-content">

            <div class="instruction-text">
                It is not required for you to write anything down in this section of your appraisal submission, but you
                should expect your appraiser to raise the subject with you and you have the option of a private
                conversation
                on these matters. This section equally provides one of the clearest opportunities to ensure that the
                appraisal addresses the personal and professional needs of the doctor.
                <br><br>
                Having assembled and commented on your appraisal information to date it can help to pause in your
                preparation and organise your thoughts before making an entry in this section.
            </div>

            <p class="mb-2">Whilst these topics are not mandatory for revalidation, it is important to have
                the opportunity to discuss with your appraiser your achievements over the past year; your
                aspirations for the future and any challenges you may currently be facing.</p>
            <p class="mb-0">Appraisal is a formative process and therefore you are encouraged to discuss these
                topics.</p>

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Please select one of the following:</span>
                <div class="radio-group">
                    <div class="radio-option">
                        If you wish to include documents in support of your comments below, you can do so in Section 14.
                        Please tick here if you have done so.
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['ac_includeDocuments']) && $appraisalData['ac_includeDocuments'] == 'on' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button"></span>
                    </div>
                </div>
            </div>

            <h6 class="mb-0"><strong>Achievements and challenges</strong></h6>

            <label class="form-label">
                You can use this space to detail notable achievements or challenges since your
                last appraisal, across all of your practice.
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['ac_challange'] ?? ''); ?>

            </div>
            <h6 class="mb-0"><strong>Aspirations</strong></h6>

            <label class="form-label">
                You can use this space to detail your career aspirations and what you intend to do
                in the forthcoming year to work towards this.
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['ac_aspirations'] ?? ''); ?>

            </div>
            <h6 class="mb-0"><strong>Additional items for discussion</strong></h6>

            <label class="form-label">
                You can use this space to include anything additional that you would like to
                discuss with your appraiser.
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['ac_discuss'] ?? ''); ?>

            </div>

            <label class="form-label">
                Appraiser's comments
            </label>
            <div class="instruction-text">
                Appraiser's comments boxes appear at the end of a number of sections in this form. Appraisers are
                encouraged to record their comments here, which will be aggregated verbatim into the summary in
                Section 10. Appraisers should therefore comment accordingly. Please do not edit the text again
                in Section 10, it will automatically change the text in the corresponding section.
                <br>
                <p>Comments should include:</p>
                <ul>
                    <li>an overview of the supporting information and the doctor's accompanying commentary</li>
                    <li>a comment on the appraisal discussion informing relates to all aspects of the doctor's scope
                        of work.</li>
                </ul>
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['ac_comments'] ?? ''); ?>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-12.blade.php ENDPATH**/ ?>