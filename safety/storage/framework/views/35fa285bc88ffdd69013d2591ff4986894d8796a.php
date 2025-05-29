<div>
    <div>
        <div class="section-header">
            Section 10 of 21
            <br>Feedback from colleagues and patients
        </div>

        <div class="section-content">

            <p>
                Colleague and patient feedback are the fourth and fifth types of supporting information doctors will use
                to
                demonstrate that they are continuing to meet the principles and values set out in Good Medical Practice.
                Please use the help bubbles to access more information on what you should be providing in this section.
            </p>

            <p>
                As part of appraisal and revalidation, you should seek feedback from colleagues and patients and review
                and
                act upon that feedback where appropriate. Feedback will usually be collected using standard
                questionnaires
                that comply with GMC guidance.
                <br>
                <br>
                The GMC state that you should seek this feedback in a formal manner consistent with their guidance at
                least
                once per revalidation cycle, normally every five years. This requirement constitutes a minimum and other
                sources of feedback, both formal and informal, can additionally be used to contribute to your
                reflection.
            </p>
            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Have you undertaken any formal colleague feedback in keeping with GMC
                    <br>
                    guidance since your last appraisal?</span>
                <div class="instruction-text">
                    Please ensure any personal identifiable information is removed or
                    redacted.
                    GMC guidance is for a minimum of one colleague survey, compliant
                    with GMC requirements, about the individual doctor to be
                    completed during each five-year revalidation cycle.
                    <a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                        target="_blank">
                        Further
                        guidance on feedback from colleagues and patients can be found
                        here.
                    </a>
                    You are expected to reflect on the results of these surveys
                    individually and with your appraiser and to identify lessons learned
                    and changes to be made as a result.
                    If you have several different positions and roles in your scope of
                    work, it may be appropriate for you to undertake separate colleague
                    feedback exercises in more than one of these roles. This is partly
                    because the design of one survey is typically structured towards a
                    particular type of role, for example questionnaires designed for
                    clinical and management settings may differ.
                </div>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['fb_colleagueFeedback']) && $appraisalData['fb_colleagueFeedback'] == 'yes' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button"></span>Yes
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['fb_colleagueFeedback']) && $appraisalData['fb_colleagueFeedback'] == 'no' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button radio-checked"></span>No
                    </div>
                </div>
            </div>

            <!-- ELSE -->
            <?php if(isset($appraisalData['fb_colleagueFeedback'])): ?>
                <?php if($appraisalData['fb_colleagueFeedback'] == 'no'): ?>
                    <label class="form-label">
                        Please enter the date of your last
                        <br>
                        colleague feedback:
                    </label>
                    <div class="form-input form-input-large">
                        <?php echo e($appraisalData['fb_colleagueFeedbackDate'] ?? ''); ?>

                    </div>
                    <label class="form-label">
                        If your responsible officer does not already hold a copy of this colleague feedback exercise,
                        please
                        also
                        attach the feedback and describe your reflections in the table below.
                        <br>
                        You may also use the table to record other less formal evidence of feedback that you wish to
                        present.
                        <br>
                        If the date of your last formal colleague feedback exercise was before your last revalidation
                        you may
                        also
                        wish to use the comment box below to describe your plans to meet this requirement before your
                        next
                        revalidation is due.
                    </label>
                    <div class="form-input form-input-large">
                        <?php echo e($appraisalData['fb_colleagueRevalidation'] ?? ''); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- END ELSE -->

            <label class="form-label">
                About 'Relevant job title or role':
            </label>
            <div class="instruction-text">
                This list is created from your entries in the ‘Scope of Work’ table in Section 4. Select one, or choose
                ‘Cross role’ if the item is relevant to more than
                one of your roles
            </div>
            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Date and brief description of activity provided as supporting information</th>
                            <th>Outcome of learning and reflection / action taken and next steps</th>
                            <th>Supporting information location</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($appraisalData['fb_roles']) && is_array($appraisalData['fb_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['fb_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($r->roles ?? ''); ?></td>
                                    <td><?php echo e($r->dateAndBrief ?? ''); ?></td>
                                    <td><?php echo e($r->outcomes ?? ''); ?></td>
                                    <td><?php echo e($r->supportingInfo ?? ''); ?></td>
                                    <td>
                                        <?php
                                            $att = null;
                                            try {
                                                $att = $r->new_filename;
                                            } catch (\Throwable $th) {
                                            }
                                            $lg = null;
                                            try {
                                                $lg = $r->log;
                                            } catch (\Throwable $th) {
                                            }
                                        ?>
                                        <?php if($r->supportingInfo == 'Attached'): ?>
                                            <?php if($att): ?>
                                                Attached
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($lg): ?>
                                                <?php if($lg == true): ?>
                                                    Logged
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Have you undertaken any formal patient feedback in keeping with GMC
                    guidance since your last appraisal?</span>
                <div class="instruction-text">
                    Please ensure any personal identifiable information is removed or
                    redacted.
                    GMC guidance is for a minimum of one colleague survey, compliant
                    with GMC requirements, about the individual doctor to be
                    completed during each five-year revalidation cycle.
                    <a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                        target="_blank">
                        Further
                        guidance on feedback from colleagues and patients can be found
                        here.
                    </a>
                    You are expected to reflect on the results of these surveys
                    individually and with your appraiser and to identify lessons learned
                    and changes to be made as a result.
                    If you have several different positions and roles in your scope of
                    work, it may be appropriate for you to undertake separate colleague
                    feedback exercises in more than one of these roles. This is partly
                    because the design of one survey is typically structured towards a
                    particular type of role, for example questionnaires designed for
                    clinical and management settings may differ.
                </div>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['fb_patientFeedback']) && $appraisalData['fb_patientFeedback'] == 'yes' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button"></span>Yes
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['fb_patientFeedback']) && $appraisalData['fb_patientFeedback'] == 'no' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button radio-checked"></span>No
                    </div>
                </div>
            </div>

            <!-- ELSE -->
            <?php if(isset($appraisalData['fb_patientFeedback'])): ?>
                <?php if($appraisalData['fb_patientFeedback'] == 'no'): ?>
                    <label class="form-label">
                        Please enter the date of your last
                        <br>
                        colleague feedback:
                    </label>
                    <div class="form-input form-input-large">
                        <?php echo e($appraisalData['fb_patientFeedbackDate'] ?? ''); ?>

                    </div>
                    <label class="form-label">
                        If your responsible officer does not already hold a copy of this colleague feedback exercise,
                        please
                        also
                        attach the feedback and describe your reflections in the table below.
                        <br>
                        You may also use the table to record other less formal evidence of feedback that you wish to
                        present.
                        <br>
                        If the date of your last formal colleague feedback exercise was before your last revalidation
                        you may
                        also
                        wish to use the comment box below to describe your plans to meet this requirement before your
                        next
                        revalidation is due.
                    </label>
                    <div class="form-input form-input-large">
                        <?php echo e($appraisalData['fb_colleagueRevalidation'] ?? ''); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- END ELSE -->

            <p>
                Please use the box below to provide a commentary on how your CPD activities have supported
                the areas described in your scope of work and demonstrate that you are continuing to meet the
                requirements of Good Medical Practice.
            </p>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['fb_practice'] ?? ''); ?>

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
                <?php echo e($appraisalData['fb_comments'] ?? ''); ?>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-10.blade.php ENDPATH**/ ?>