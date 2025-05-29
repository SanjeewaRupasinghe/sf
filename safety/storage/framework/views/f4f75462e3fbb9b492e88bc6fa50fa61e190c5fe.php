<div>
    <div>
        <div class="section-header">
            Section 4 of 21
            <br>Scope of work
        </div>

        <div class="section-content">
            <div class="instruction-text">
                GMC and Academy guidance states that you should record the scope and nature of all of your professional
                work in your whole practice medical
                appraisal. This should include all roles and positions for which a licence to practise is required, and
                should include work for voluntary organisations,
                work in private or independent practice and managerial, educational, research and academic roles.
                <a href="https://www.england.nhs.uk/revalidation/appraisers/mag-mod/further-info/">
                    Further information can be found here.
                </a>
                As well as listing each of your roles you should describe the nature of your work in that role, and the
                governance arrangements within which you
                work in each role. You should upload any supportive information relating to your governance in a role
                such as in-post reviews/appraisals and
                personal objectives, under ‘Additional Information’ in your appraisal submission. If there is no formal
                governance in a role, you should make note of
                this fact, and comment on how you ensure your fitness to practise in that role, for example through
                activities such as self-review, peer review, selfdirected
                learning and quality improvement.
                You should reflect on your overall scope of work, and in particular make reference to whether any
                conflicts exist within it which would require action
                on your part
            </div>
            <div class="instruction-text">
                Please complete the following boxes to cover all work that you undertake. This should include work for
                voluntary organisations and work in private or independent practice and should include managerial,
                educational, research and academic roles. Please indicate how much time you are spending in each job or
                role. Depending on the nature of the work, if you are undertaking a lesser volume of work in an area you
                should take increasing care that the information you provide in this form is sufficient to demonstrate
                fitness to practise in that area.
            </div>
            <label class="form-label">
                Types of work should be categorised into:
            </label>
            <ul>
                <li>clinical commitments</li>
                <li>educational roles, including supervision, teaching, academic and research</li>
                <li>managerial and leadership roles</li>
                <li>any other role that requires you to hold a medical qualification / licence to practice
                </li>
            </ul>

            <div class="instruction-text">
                Examples of such roles include sports medicine, occupational health, ascetic practice, appraiser,
                voluntary roles etc. If in doubt, include it anyway -
                better to be over inclusive than under inclusive
            </div>
            <label class="form-label">About ‘Job or role title</label>

            <div class="instruction-text">
                The list of jobs/roles you create here will be available to pick from in subsequent tables.<br>
                Where you may perform the same/similar role at different organisations, please list these
                separately.<br>
                Organisation and contact details are important. Please include a name, email address, phone
                number of someone responsible for supervising your
                practice in this role.
            </div>

            <div class="form-row">
                <label class="form-label">* Medical qualifications, UK or elsewhere, including dates where
                    appropriate</label>
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Job or role title Detail of work</th>
                            <th>Detail of work<br>(Including any changes since your last
                                appraisal)</th>
                            <th>Year commenced</th>
                            <th>Organisation and contact details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($appraisalData['ws_roles']) && is_array($appraisalData['ws_roles'])): ?>
                            <?php $__currentLoopData = $appraisalData['ws_roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($r->role ?? ''); ?></td>
                                    <td><?php echo e($r->work ?? ''); ?></td>
                                    <td><?php echo e($r->organization ?? ''); ?></td>
                                    <td><?php echo e($r->yearCommenced ?? ''); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="form-row">
                <label class="form-label">Please describe here anything significant regarding the
                    relationship between your various roles:</label>
                <div class="instruction-text">
                    This is an opportunity for you to review the relationship between your roles and the steps
                    you have taken to address these. Describe here any issues
                    relating to conflicts of interests that you are managing and to flag with your appraiser.
                    Also include here any complementary relationships.
                </div>
                <div class="form-input form-input-large">
                    <?php echo e($appraisalData['ws_relationship'] ?? ''); ?>

                </div>
            </div>

            <div class="form-row">
                <label class="form-label">Please describe any changes in your scope of work that you
                    envisage taking place in the next year:</label>
                <div class="form-input form-input-large">
                    <?php echo e($appraisalData['ws_envisageNextYear'] ?? ''); ?>

                </div>
            </div>

            <div class="form-row">
                <label class="form-label">Appraiser's comments:</label>
                <div class="form-input form-input-large">
                    <?php echo e($appraisalData['ws_comment'] ?? ''); ?>

                </div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-4.blade.php ENDPATH**/ ?>