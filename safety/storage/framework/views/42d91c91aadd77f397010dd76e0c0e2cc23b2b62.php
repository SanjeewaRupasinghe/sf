<?php $__env->startSection('title', 'Feedback from colleagues and patients'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 10 of 21</h1>
        <h2>Feedback from colleagues and patients
        </h2>
    </div>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $content = json_decode(Auth::user()->content);

        $_colleagueFeedback = '';
        $_colleagueFeedbackDate = '';
        $_colleagueRevalidation = '';
        $_patientFeedback = '';
        $_patientFeedbackDate = '';
        $_patientRevalidation = '';
        $_practice = '';
        $_comments = '';
        $_jobRolesCount = 0;

        try {
            if ($content->feedback) {
                $_colleagueFeedback = $content->feedback->colleagueFeedback;
                $_colleagueFeedbackDate = $content->feedback->colleagueFeedbackDate;
                $_colleagueRevalidation = $content->feedback->colleagueRevalidation;
                $_patientFeedback = $content->feedback->patientFeedback;
                $_patientRevalidation = $content->feedback->patientRevalidation;
                $_practice = $content->feedback->practice;
                $_comments = $content->feedback->comments;
                $_jobRoles = $content->feedback->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

        $LOCKDOWN_STATUS = Auth::user()->status == 0 ? false : true;
    ?>

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

    <form <?php if($LOCKDOWN_STATUS): ?> action="<?php echo e(route('appraisal.user.feedback.submit')); ?>" <?php endif; ?> method="POST"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="content-body">
            <p>
                Colleague and patient feedback are the fourth and fifth types of supporting information doctors will use to
                demonstrate that they are continuing to meet the principles and values set out in Good Medical Practice.
                Please use the help bubbles to access more information on what you should be providing in this section.
            </p>

            <p>
                As part of appraisal and revalidation, you should seek feedback from colleagues and patients and review and
                act upon that feedback where appropriate. Feedback will usually be collected using standard questionnaires
                that comply with GMC guidance.
                <br>
                <br>
                The GMC state that you should seek this feedback in a formal manner consistent with their guidance at least
                once per revalidation cycle, normally every five years. This requirement constitutes a minimum and other
                sources of feedback, both formal and informal, can additionally be used to contribute to your reflection.
            </p>

            <!-- Colleague Feedback Question -->
            <div class="mb-3">
                <label class="form-label"><strong>Have you undertaken any formal colleague feedback in keeping with GMC
                        <br>
                        guidance since your last appraisal?
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('lastAppHelp')"></i>
                    </strong></label>
                <div id="lastAppHelp" class="help-text">
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
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="colleagueFeedback" id="colleagueFeedbackIf"
                            value="yes" <?php if($_colleagueFeedback == 'yes'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="colleagueFeedbackIf">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="colleagueFeedback" id="colleagueFeedbackElse"
                            value="no" <?php if($_colleagueFeedback == 'no'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="colleagueFeedbackElse">No</label>
                    </div>
                </div>
            </div>

            <!-- Colleague Feedback Yes Section -->
            <div id="colleagueFeedbackIfSection" style="display: none;">

            </div>

            <!-- Colleague Feedback No Section -->
            <div id="colleagueFeedbackElseSection" style="display: none;">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label"><strong>
                                Please enter the date of your last
                                <br>
                                colleague feedback:
                            </strong></label>
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('lastAppHelp2')"></i>
                    </div>
                    <div id="lastAppHelp2" class="help-text">
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
                    <div class="col-md-6">
                        <input type="date" class="form-control" id="colleagueFeedbackDate" name="colleagueFeedbackDate"
                            value="<?php echo e($_colleagueFeedbackDate); ?>">
                    </div>
                </div>
                <p>
                    If your responsible officer does not already hold a copy of this colleague feedback exercise, please
                    also
                    attach the feedback and describe your reflections in the table below.
                    <br>
                    You may also use the table to record other less formal evidence of feedback that you wish to present.
                    <br>
                    If the date of your last formal colleague feedback exercise was before your last revalidation you may
                    also
                    wish to use the comment box below to describe your plans to meet this requirement before your next
                    revalidation is due.
                </p>

                <textarea class="form-control form-control-sm" rows="4" name="colleagueRevalidation"><?php echo e($_colleagueRevalidation); ?></textarea>

            </div>

            <!-- CPD Table Section -->
            <div id="">

                <div class="mb-3">
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
                                    <?php if($LOCKDOWN_STATUS): ?>
                                        <button type="button" class="btn btn-success btn-sm add-row-btn">+</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Patient Feedback Question -->
                <div class="mb-3">
                    <label class="form-label"><strong>
                            Have you undertaken any formal patient feedback in keeping with GMC
                            guidance since your last appraisal?
                        </strong></label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="patientFeedback" id="patientFeedbackIf"
                                value="yes" <?php if($_patientFeedback == 'yes'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="patientFeedbackIf">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="patientFeedback" id="patientFeedbackElse"
                                value="no" <?php if($_patientFeedback == 'no'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="patientFeedbackElse">No</label>
                        </div>
                    </div>
                </div>

                <!-- Patient Feedback Yes Section -->
                <div id="patientFeedbackIfSection" style="display: none;">

                </div>

                <!-- Patient Feedback No Section -->
                <div id="patientFeedbackElseSection" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><strong>
                                    Please enter the date of your last
                                    <br>
                                    patient feedback:
                                </strong></label>
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="patientFeedback" name="patientFeedbackDate"
                                value="<?php echo e($_patientFeedbackDate); ?>">
                        </div>
                    </div>
                    <p>
                        If your responsible officer does not already hold a copy of this patient feedback exercise, please
                        also attach the feedback and describe your
                        reflections in the table below.
                        You may also use the table to record other less formal evidence of feedback that you wish to
                        present.
                        If the date of your last formal patient feedback exercise was before your last revalidation you may
                        also wish to use the comment box below to
                        describe your plans to meet this requirement before your next revalidation is due
                    </p>

                    <textarea class="form-control form-control-sm" rows="4" name="patientRevalidation"><?php echo e($_patientRevalidation); ?></textarea>

                </div>

                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Please use the box below to provide a commentary on how your CPD activities have supported
                        the areas described in your scope of work and demonstrate that you are continuing to meet the
                        requirements of Good Medical Practice.</p>
                    <textarea class="form-control" rows="6" name="practice"><?php echo e($_practice); ?></textarea>
                </div>

                <!-- Appraiser's Comments Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong></h6>
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentHelp')"></i>
                    </div>
                    <div id="commentHelp" class="help-text">
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
                    <textarea class="form-control" rows="4" name="comments"
                        placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 10 Summary of the appraisal discussion' boxes."><?php echo e($_comments); ?></textarea>

                </div>
            </div>

        </div>

        <div class="d-flex justify-content-between">

            <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.significant-events')); ?>">
                < Previous section</a>
                    <?php if($LOCKDOWN_STATUS): ?>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                    <?php endif; ?>
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.complaints')); ?>">Next section ></a>

        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle royal college radio button changes
        document.querySelectorAll('input[name="colleagueFeedback"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('colleagueFeedbackIfSection');
                const noSection = document.getElementById('colleagueFeedbackElseSection');

                if (this.value === 'yes') {
                    yesSection.style.display = 'block';
                    noSection.style.display = 'none';
                } else {
                    yesSection.style.display = 'none';
                    noSection.style.display = 'block';
                }
            });
        });

        // Handle royal college radio button changes
        document.querySelectorAll('input[name="patientFeedback"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('patientFeedbackIfSection');
                const noSection = document.getElementById('patientFeedbackElseSection');

                if (this.value === 'yes') {
                    yesSection.style.display = 'block';
                    noSection.style.display = 'none';
                } else {
                    yesSection.style.display = 'none';
                    noSection.style.display = 'block';
                }
            });
        });

        // Handle CPD diary radio button changes (for royal college = no)
        document.querySelectorAll('input[name="cpdDiary"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const attachedText = document.getElementById('attachedText');
                if (this.value === 'yes') {
                    attachedText.style.display = 'block';
                } else {
                    attachedText.style.display = 'none';
                }
            });
        });

        // Handle additional CPD radio button changes (for royal college = yes)
        document.querySelectorAll('input[name="additionalCPD"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const tableSection = document.getElementById('cpdTableSection');
                if (this.value === 'yes') {
                    tableSection.style.display = 'block';
                } else {
                    tableSection.style.display = 'none';
                }
            });
        });

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
            if (e.target.classList.contains('remove-row-btn')) {
                e.target.closest('tr').remove();
                calculateTotal();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/feedback.blade.php ENDPATH**/ ?>