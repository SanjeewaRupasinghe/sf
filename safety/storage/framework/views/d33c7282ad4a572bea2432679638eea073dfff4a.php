<?php $__env->startSection('title', 'Quality improvement activity'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 8 of 21</h1>
        <h2>Quality improvement activity
        </h2>
    </div>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $content = json_decode(Auth::user()->content);

        $_practice = '';
        $_comments = '';
        $_jobRoles = null;
        $_jobRolesCount = 0;

        try {
            if ($content->qualityImprovement) {
                $_practice = $content->qualityImprovement->practice;
                $_comments = $content->qualityImprovement->comments;
                $_jobRoles = $content->qualityImprovement->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    ?>

    <form action="<?php echo e(route('appraisal.user.quality-improvement.submit')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="content-body">

            <p>
                This is the second type of supporting information doctors will use to demonstrate that they are continuing
                to meet the principles and values set out in Good Medical Practice. Please use the help bubble above to
                access more information on what you should be providing in this section.
            </p>

            <p>
                This is where you should demonstrate that you regularly participate in activities that review and evaluate
                the quality of your work. You should complete this in relation to your complete scope of work, including any
                clinical, academic, managerial, leadership and educational roles that you undertake.
                <br>
                <br>
                Please detail below the quality improvement activities that you have undertaken or contributed to over the
                last year, including team-based activities where appropriate.
                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('appropriateHelp')"></i>
            </p>

            <div id="appropriateHelp" class="help-text">
                GMC guidance 'Supporting information for appraisal and revalidation' (March 2011) states that when
                discussing quality improvement activity at your
                appraisal, the following areas should be considered:
                <br>
                <strong>Active participation relevant to your work</strong>
                <br>
                You will need to demonstrate that you have actively participated in a quality improvement activity or a
                clinical audit relevant to your work.
                <br>
                Evaluate and reflect on the results
                <br>
                You need to demonstrate that you have evaluated and reflected on the results of the activity or audit. This
                might be through reflective notes about
                the implications of the results on your work, discussion of the results at peer-supervision, professional
                development or team meetings and
                contribution to your professional development.
                <br>
                Take action
                <br>
                You will need to demonstrate that you have taken appropriate action in response to the results. This might
                include the development of an action plan
                based on the results of the activity or audit, any change in practice following participation, and informing
                colleagues of the findings and any action
                required.
                <br>
                <strong>Closing the loop - demonstration of outcome or maintenance of quality</strong>
                <br>
                You should consider whether an improvement has occurred or if the activity demonstrated that good practice
                has been maintained. This should be
                through the results of a repeat of the activity or re-audit after a period of time where possible.
            </div>
            <!-- CPD Table Section -->
            <div id="">

                <div class="mb-3">
                    <p><strong>About 'Relevant job title or role':
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('appropriateHelp')"></i>
                    </p>
                </div>

                <div id="appropriateHelp" class="help-text">
                    This list is created from your entries in the ‘Scope of Work’ table in Section 4. Select one, or choose
                    ‘Cross role’ if the item is relevant to more than
                    one of your roles
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
                                                <option value="Please select...">Please select...</option>
                                                <option value="Cross Role"
                                                    <?php if($_jobRoles[$i]->roles == 'Cross Role'): ?> selected <?php endif; ?>>Cross Role</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"><?php echo e($_jobRoles[$i]->dateAndBrief); ?></textarea>
                                        </td>
                                        <td>
                                            <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"><?php echo e($_jobRoles[$i]->outcomes); ?></textarea>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm location-select"
                                                name="supportingInfo[]">
                                                <option value="Please select...">Please select...</option>
                                                <option <?php if($_jobRoles[$i]->supportingInfo == 'Attached'): ?> selected <?php endif; ?> value="Attached">
                                                    Attached</option>
                                                <option <?php if($_jobRoles[$i]->supportingInfo == 'Email to appraiser'): ?> selected <?php endif; ?>
                                                    value="Email to appraiser">Email to appraiser</option>
                                                <option <?php if($_jobRoles[$i]->supportingInfo == 'Provided separately'): ?> selected <?php endif; ?>
                                                    value="Provided separately">Provided separately</option>
                                                <option <?php if($_jobRoles[$i]->supportingInfo == 'Not available'): ?> selected <?php endif; ?>
                                                    value="Not available">Not available</option>
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
                                        <option value="Please select...">Please select...</option>
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
                                        <option value="Please select...">Please select...</option>
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

                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Please use the box below to provide a commentary on how your quality improvement activities have
                        supported the areas described in your scope of work and demonstrates that you are continuing to meet
                        the requirements of Good Medical Practice.</p>
                    <textarea class="form-control" rows="6" name="practice"><?php echo e($_practice); ?></textarea>
                </div>

                <!-- Appraiser's Comments Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong>
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentHelp')"></i>
                        </h6>
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
                        placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes."><?php echo e($_comments); ?></textarea>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-between">
            
                     <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.cpd')); ?>">
                    < Previous section</a>
                    <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.significant-events')); ?>">Next section ></a>
                
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // // Handle royal college radio button changes
        // document.querySelectorAll('input[name="royalCollege"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const yesSection = document.getElementById('royalCollegeYesSection');
        //         const noSection = document.getElementById('royalCollegeNoSection');

        //         if (this.value === 'yes') {
        //             yesSection.style.display = 'block';
        //             noSection.style.display = 'none';
        //         } else {
        //             yesSection.style.display = 'none';
        //             noSection.style.display = 'block';
        //         }
        //     });
        // });

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
                            <option value="Please select...">Please select...</option>
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
                            <option value="Please select...">Please select...</option>
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

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/quality-improvement.blade.php ENDPATH**/ ?>