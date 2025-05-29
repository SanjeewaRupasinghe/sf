<div>
    <div>
        <div class="section-header">
            Section 18 of 21
            <br>The agreed personal development plan
        </div>

        <div class="section-content">
            <div class="instruction-text">

                <p>You may wish to list some ideas in this section which can be discussed and agreed at the appraisal
                    discussion.</p>
                <p>The personal development plan is an itemised list of your key development objectives for the coming
                    year.
                    Important areas to cover include actions to maintain skills and levels of service to patients,
                    actions
                    to develop or acquire new skills and actions to improve existing practice.</p>
                <ul>
                    <li><strong>Relevant role</strong> - if the agreed action or goal does not apply specifically to one
                        particular role, select 'Cross-role'.</li>
                    <li><strong>Learning or development need; Agreed action(s) or goal(s); Timescale for
                            completion</strong>
                        should detail your learning need and how this will be addressed how you and your appraiser have
                        agreed this need will be addressed, such as the actions you will take and the resources
                        required.
                        There are several models for approaching the construction of a PDF item. The most well-known of
                        these is SMART – the item should be Specific, Measurable, Achievable, Realistic and Timely. It
                        is
                        particularly helpful to include in your description the date by which you aim to have completed
                        the
                        item.</li>
                    <li><strong>How do I intend to demonstrate success</strong> that the action or goal has been
                        addressed.
                        Detail how you will evaluate whether participation in this action/goal actually did result in
                        changes and how you intend to change your practice as a result of this activity.</li>
                </ul>
                <p>You may wish to copy and paste this information into Section 6 of next year's appraisal.</p>
            </div>

            <p>
                The personal development plan is a record of the agreed personal and/or professional development needs
                to be
                pursued throughout the following year, as agreed in the appraisal discussion between the doctor and the
                appraiser.
            </p>

            <p>
                About 'Relevant job title or role':
            </p>

            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Detail of item (should be short and concise)
                            </th>
                    </thead>
                    <tbody>
                        <?php if(isset($appraisalData['pd_roles']) && is_array($appraisalData['pd_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['pd_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($r->role ?? ''); ?></td>
                                    <td><?php echo e($r->detail ?? ''); ?></td>
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

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-18.blade.php ENDPATH**/ ?>