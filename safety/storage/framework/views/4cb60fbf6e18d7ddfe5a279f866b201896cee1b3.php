<div>
    <div>
        <div class="section-header">
            Section 9 of 21
            <br>Significant events
        </div>

        <div class="section-content">
            <div class="instruction-text">
             The GMC states that a significant event (also known as an untoward, critical or patient safety incident) is
                any unintended or unexpected event, which
                could or did lead to harm of one or more patients.
                <br><br>
                <a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                    target="_blank">
                    Further guidance on significant events as supporting information is available here.</a> Please also
                ensure you
                are familiar with your organisation's local
                processes and agreed thresholds for recording incidents.
                <br><br>
                In primary care, significant event audit has evolved as an important tool in improving practice. Where these
                have been undertaken and don’t meet
                the GMC definition above, they could be included in Section 8 as supporting information for quality
                improvement activity.
                <br><br>
                Please note:
                <ul>
                    <li>You do not need to list any significant events where your only involvement was in the investigation.
                    </li>
                    <li>It is not the appraiser's role to conduct investigations into serious events. Organisational
                        clinical governance systems and other management
                        processes are put in place to deal with these situations.</li>
                    <li>Please ensure you are familiar with your organisation's local processes and agreed thresholds for
                        recording significant events.</li>
                    <li>If you work in an environment in which the capturing and analysis of such events are not part of
                        local procedures, you must still note and include all
                        events which meet the definition above, whether or not this has been addressed in an official
                        capacity.</li>
                    <li>It is acceptable for this section to be blank if no such events have occurred since your last
                        appraisal.</li>
                </ul>
            </div>

            <p>
                Significant events are discussed as the third type of supporting information doctors will use to
                demonstrate
                that they are continuing to meet the principles and values set out in Good Medical Practice. Please use
                the
                help bubbles to access more information on what you should be providing in this section.
            </p>
            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Please select one of the following:</span>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['se_sigEvents']) && $appraisalData['se_sigEvents'] == 'I have not been named in any significant events in the last year.' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button"></span><strong>I have not</strong> been named in any significant
                        events in the last year.
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button <?php echo e(isset($appraisalData['se_sigEvents']) && $appraisalData['se_sigEvents'] == 'I have been named in one or more significant events in the last year.' ? 'radio-checked' : ''); ?>">o</span>
                        <span class="radio-button radio-checked"></span> <strong>I have</strong> been named in one or
                        more significant events in the last year.
                    </div>
                </div>
            </div>

            <!-- ELSE -->
            <?php if(isset($appraisalData['se_sigEvents'])): ?>
                <?php if($appraisalData['se_sigEvents'] == 'I have been named in one or more significant events in the last year.'): ?>
                 <p>
                    Attachments relating to significant events are generally not encouraged due to potential data protection
                    issues. However if you wish to attach documents as reference, you may do so using the table below.
                    <br>
                    <br>
                    You are reminded that patients, colleagues and other third parties should not be identifiable. If in
                    doubt, you should consult your organisation's information management guidance.
                </p>
    
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
                                <?php if(isset($appraisalData['se_roles']) && is_array($appraisalData['se_roles'])): ?>
                                    <?php $__currentLoopData = $appraisalData['se_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                    <p>
                       The GMC states that you should discuss significant events involving you at appraisal with a
                                particular emphasis on those that have led to specific change in practice or demonstrate learning.
                    </p>
                    <div class="instruction-text">
                       Please use the box below to provide a commentary on how your CPD activities have supported
                                the areas described in your scope of work and demonstrate that you are continuing to meet the
                                requirements of Good Medical Practice.
                    </div>           
                    <div class="form-input form-input-large">
                        <?php echo e($appraisalData['se_practice'] ?? ''); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- END ELSE -->

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
                <?php echo e($appraisalData['se_comments'] ?? ''); ?>

            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-9.blade.php ENDPATH**/ ?>