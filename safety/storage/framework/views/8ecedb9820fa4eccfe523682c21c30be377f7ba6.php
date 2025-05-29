<?php $__env->startSection('title', 'Additional information'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 14 of 21</h1>
        <h2>Additional information
        </h2>
    </div>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $content = json_decode(Auth::user()->content);

        $_specInfo = '';
        $_appropriate = '';
        $_comments = '';
        $_jobRolesCount = 0;

        try {
            if ($content->additionalInfo) {
                $_specInfo = $content->additionalInfo->specInfo;
                $_appropriate = $content->additionalInfo->appropriate;
                $_comments = $content->additionalInfo->comments;
                $_jobRoles = $content->additionalInfo->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    ?>

    <form action="<?php echo e(route('appraisal.user.additional-info.submit')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="content-body">

            <p>
                This page is for you to include:
            <ul>
                <li>any specific information that your organisation requires you to include in your appraisal (e.g.
                    mandatory training records)</li>
                <li>any information that is particular to your circumstance, which you do not feel belongs in any other
                    section e.g. your job plan, appraiser performance review information, appraisal in other organisations,
                    if you wish to do so.</li>
            </ul>
            </p>


            <p>
                This additional information may or may not form part of the information needed for revalidation.
            </p>

            <!-- Conditional Question -->
            <div class="mb-3">
                <label class="form-label"><strong>Have you been requested to bring specific information to your appraisal by
                        your organisation or responsible officer?</strong>
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('officerHelp')"></i></label>
                <div id="officerHelp" class="help-text">
                    In many settings there are specific items which the responsible officer may agree
                    with doctors are expected, and should be presented
                    at appraisal, with reflection.
                    Where such items are defined, they should be listed in this section. The information
                    itself should then be set out in the relevant section to which it pertains.
                    You should indicate in this section whether or not you have been specifically asked
                    to present any information in your appraisal submission, with your reflection on
                    these or an explanation of why you have not presented them.
                    <br>
                    <br>
                    These specific items may relate to the clinical specialty and originate from, for
                    example, College specialty guidance.
                    <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further information on College specialty
                        guidance can be found here.
                    </a>
                    Alternatively they may originate from local priorities
                    identified by the responsible officer or elsewhere in the system. They may include
                    any of the categories of supporting information (CPD, quality improvement,
                    significant events, complaints, feedback from colleagues and patients). They may
                    also relate to matters of health and probity as well as other professional matters.
                    They may be defined as expected for groups of doctors, or they may be agreed
                    individually between a doctor and their responsible office
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="specInfo" id="conditionalQuestionIf"
                            value="yes" <?php if($_specInfo == 'yes'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="conditionalQuestionIf">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="specInfo" id="conditionalQuestionElse"
                            value="no" <?php if($_specInfo == 'no'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="conditionalQuestionElse">
                            No
                        </label>
                    </div>
                </div>
            </div>

            <p>
                If you have not been involved personally in a complaint but wish to share learning of some that you were
                aware of, or if you have carried clinical or
                managerial responsibility for any complaints please record this under Section 8: Quality improvement
                activity.
            </p>

            <!-- Conditional Yes Section -->
            <div id="conditionalQuestion"
                <?php if($_specInfo == 'yes'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>

                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Please list below what you have been requested to include, before either entering the information
                        itself in the relevant section of this form or in the following table, as appropriate.</p>
                    <textarea class="form-control" rows="6" name="appropriate"><?php echo e($_appropriate); ?></textarea>
                </div>
            </div>

            <!-- Conditional No Section -->
            <div id="conditionalQuestionElseSection">

            </div>


            <div class="mb-3">

                <p>
                    Please upload this information into the table below and describe what you have included.
                </p>

                <p><strong>About 'Relevant job title or role':
                </p>
            </div>

            <!-- CPD Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Date and brief description of activity provided as supporting information</th>
                            <th>Outcome of learning and reflection / action taken and next steps</th>
                            <th>Supporting information location</th>
                            <th>Attachment</th>
                            <th>Add new row</th>
                        </tr>
                    </thead>
                    <tbody id="cpdTableBody">
                        <?php if($_jobRolesCount > 0): ?>
                            <?php for($i = 0; $i < $_jobRolesCount; $i++): ?>
                                <tr>
                                    <td>
                                        <select class="form-select form-select-sm" name="roles[]">
                                            <option>Please select...</option>
                                            <option value="Cross Role" <?php if($_jobRoles[$i]->roles == 'Cross Role'): ?> selected <?php endif; ?>>
                                                Cross Role</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"><?php echo e($_jobRoles[$i]->dateAndBrief); ?></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"><?php echo e($_jobRoles[$i]->outcomes); ?></textarea>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                                            <option>Please select...</option>
                                            <option <?php if($_jobRoles[$i]->supportingInfo == 'Attached'): ?> selected <?php endif; ?> value="Attached">
                                                Attached</option>
                                            <option <?php if($_jobRoles[$i]->supportingInfo == 'Email to appraiser'): ?> selected <?php endif; ?>
                                                value="Email to appraiser">Email to appraiser</option>
                                            <option <?php if($_jobRoles[$i]->supportingInfo == 'Provided separately'): ?> selected <?php endif; ?>
                                                value="Provided separately">Provided separately</option>
                                            <option <?php if($_jobRoles[$i]->supportingInfo == 'Not available'): ?> selected <?php endif; ?> value="Not available">
                                                Not available</option>
                                        </select>
                                    </td>
                                    <td class="attachment-cell">
                                        <div class="checkbox-log">
                                            <?php if($_jobRoles[$i]->supportingInfo == 'Attached'): ?>
                                                <input type="file" class="form-control form-control-sm"
                                                    name="supportingInfoAttachment_<?php echo e($i); ?>"
                                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                            <?php else: ?>
                                                <input type="checkbox" class="form-check-input me-1"
                                                    name="supportingInfoLog_<?php echo e($i); ?>"
                                                    <?php if($_jobRoles[$i]->log): ?> checked <?php endif; ?> value="on">
                                                <span class="badge bg-secondary">Log</span>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-btn">-</button>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                        <tr>
                            <td>
                                <select class="form-select form-select-sm" name="roles[]">
                                    <option>Please select...</option>
                                    <option value="Cross Role">Cross Role</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"></textarea>
                            </td>
                            <td>
                                <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"></textarea>
                            </td>
                            <td>
                                <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                                    <option>Please select...</option>
                                    <option value="Attached">Attached</option>
                                    <option value="Email to appraiser">Email to appraiser</option>
                                    <option value="Provided separately">Provided separately</option>
                                    <option value="Not available">Not available</option>
                                </select>
                            </td>
                            <td class="attachment-cell">
                                <div class="checkbox-log">
                                    <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_0[]"
                                        value="on">
                                    <span class="badge bg-secondary">Log</span>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm add-row-btn">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- CPD Table Section -->

            <div id="">

                <!-- Appraiser's Comments Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong></h6>
                    </div>
                    <textarea class="form-control" rows="4" name="comments"
                        placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 10 Summary of the appraisal discussion' boxes."><?php echo e($_comments); ?></textarea>

                </div>
            </div>

        </div>
            <div class="d-flex justify-content-between">

        <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.probity')); ?>">
            < Previous section</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.supporting-info')); ?>">Next section ></a>
                </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle royal college radio button changes
        document.querySelectorAll('input[name="specInfo"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('conditionalQuestion');
                const noSection = document.getElementById('conditionalQuestionElseSection');

                if (this.value === 'yes') {
                    yesSection.style.display = 'block';
                    noSection.style.display = 'none';
                } else {
                    yesSection.style.display = 'none';
                    noSection.style.display = 'block';
                }
            });
        });

        // // Handle CPD diary radio button changes (for royal college = no)
        // document.querySelectorAll('input[name="cpdDiary"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const attachedText = document.getElementById('attachedText');
        //         if (this.value === 'yes') {
        //             attachedText.style.display = 'block';
        //         } else {
        //             attachedText.style.display = 'none';
        //         }
        //     });
        // });

        // // Handle additional CPD radio button changes (for royal college = yes)
        // document.querySelectorAll('input[name="additionalCPD"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const tableSection = document.getElementById('cpdTableSection');
        //         if (this.value === 'yes') {
        //             tableSection.style.display = 'block';
        //         } else {
        //             tableSection.style.display = 'none';
        //         }
        //     });
        // });

        // Handle location select changes
        function handleLocationChange(selectElement) {
            const row = selectElement.closest('tr');
            const rCount = Array.from(row.parentElement.children).indexOf(row) + 1;
            const attachmentCell = row.querySelector('.attachment-cell');

            if (selectElement.value === 'Attached') {
                attachmentCell.innerHTML =
                    `<input type="file" class="form-control form-control-sm" name="supportingInfoAttachment_${rCount}" accept=".pdf,.doc,.docx,.jpg,.png">`;
            } else {
                attachmentCell.innerHTML = `
                    <div class="checkbox-log">
                        <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_${rCount}">
                        <span class="badge bg-secondary">Log</span>
                    </div>
                `;
            }
        }

        // Add event listeners to existing location selects
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('location-select')) {
                handleLocationChange(e.target);
            }
        });

        // // Calculate total credits
        // function calculateTotal() {
        //     const creditInputs = document.querySelectorAll('.credit-input');
        //     let total = 0;

        //     creditInputs.forEach(input => {
        //         const value = parseFloat(input.value) || 0;
        //         total += value;
        //     });

        //     document.getElementById('totalCredits').textContent = total.toFixed(1);
        // }

        // // Add event listeners for credit calculation
        // document.addEventListener('input', function(e) {
        //     if (e.target.classList.contains('credit-input')) {
        //         calculateTotal();
        //     }
        // });

        // Add new row functionality
        document.addEventListener('click', function(e) {

            let rCount = document.querySelectorAll('#cpdTableBody tr').length + 1;

            if (e.target.classList.contains('add-row-btn')) {
                const tbody = document.getElementById('cpdTableBody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>
                        <select class="form-select form-select-sm" name="roles[]">
                            <option>Please select...</option>
                            <option value="Cross Role">Cross Role</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"></textarea>
                    </td>
                    <td>
                        <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"></textarea>
                    </td>
                    <td>
                        <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                            <option>Please select...</option>
                            <option value="Attached">Attached</option>
                            <option value="Email to appraiser">Email to appraiser</option>
                            <option value="Provided separately">Provided separately</option>
                            <option value="Not available">Not available</option>
                        </select>
                    </td>
                    <td class="attachment-cell">
                        <div class="checkbox-log">
                            <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_${rCount}" value="on">
                            <span class="badge bg-secondary">Log</span>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row-btn">-</button>
                    </td>
                `;

                tbody.appendChild(newRow);
            }

            // Remove row functionality
            // if (e.target.classList.contains('remove-row-btn')) {
            //     e.target.closest('tr').remove();
            //     calculateTotal();
            // }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/additional-info.blade.php ENDPATH**/ ?>