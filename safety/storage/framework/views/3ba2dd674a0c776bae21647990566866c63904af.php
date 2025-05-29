<?php $__env->startSection('title', 'Continuing professional development (CPD)'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 7 of 21</h1>
        <h2>Continuing professional development (CPD)
            <i class="fas fa-question-circle help-icon text-white" onclick="toggleHelp('mainHelp')"></i>
        </h2>
    </div>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
        $content = json_decode(Auth::user()->content);

        $_royalCollege = '';
        $_annualCertificate = '';
        $_additionalCPD = '';
        $_cpdDiary = '';
        $_practice = '';
        $_comments = '';
        $_jobRolesCount = 0;
        $_creditT = 0;

        try {
            if ($content->cpd) {
                $_royalCollege = $content->cpd->royalCollege;
                $_annualCertificate = $content->cpd->annualCertificate;
                $_additionalCPD = $content->cpd->additionalCPD;
                $_cpdDiary = $content->cpd->cpdDiary;
                $_practice = $content->cpd->practice;
                $_comments = $content->cpd->comments;
                $_jobRoles = $content->cpd->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    ?>

    <form action="<?php echo e(route('appraisal.user.cpd.submit')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="content-body">
            <div id="mainHelp" class="help-text">
                In this section you should provide a record of both formal and informal learning that has taken place since
                your last appraisal. A royal college
                certification of CPD compliance may be attached, where available.<br>
                You should also provide commentary on your learning in support of your professional activities as detailed
                in your scope of work.
                <a
                    href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                    Further guidance
                    on CPD as supporting information is available here.
                </a>
                <br>
                <br>
                <a
                    href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                    Further guidance on the requirements of Good Medical Practice can be found here.
                </a>
                <br>
                <br>
                <a
                    href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                    Further information on the role of the medical royal colleges and faculties in revalidation, including
                    links to each specialty can be found here
                </a>
            </div>

            <p>
                This is the first type of supporting information doctors will use to demonstrate that they are continuing to
                meet the principles and values set out in
                Good Medical Practice. Please use the help bubble above to access more information on what you should be
                providing in this section.
            </p>

            <!-- Royal College Question -->
            <div class="mb-3">
                <label class="form-label"><strong>Continuing professional development (CPD) is an essential part of a
                        doctor’s career. Your participation in CPD should reflect your entire scope of
                        work, although it is not limited to this. This section allows you to document the CPD that you have
                        participated since your last appraisal. Are you a member of a royal college or
                        faculty?</strong></label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="royalCollege" id="royalCollegeYes"
                            value="yes" <?php if($_royalCollege == 'yes'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="royalCollegeYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="royalCollege" id="royalCollegeNo"
                            value="no" <?php if($_royalCollege == 'no'): ?> checked <?php endif; ?>>
                        <label class="form-check-label" for="royalCollegeNo">No</label>
                    </div>
                </div>
            </div>

            <!-- Royal College Yes Section -->
            <div id="royalCollegeYesSection" style="display: none;">
                <div class="mb-3">
                    <label class="form-label"><strong>Do you have an annual certificate to show you have participated in
                            college or faculty CPD?</strong></label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="annualCertificate"
                                id="annualCertificateYes" value="yes" <?php if($_annualCertificate == 'yes'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="annualCertificateYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="annualCertificate" id="annualCertificateNo"
                                value="no" <?php if($_annualCertificate == 'no'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="annualCertificateNo">No</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Do you have a diary, summary or list of additional CPD activity that
                            you have participated in?</strong></label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="additionalCPD" id="additionalCPDYes"
                                value="yes" <?php if($_additionalCPD == 'yes'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="additionalCPDYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="additionalCPD" id="additionalCPDNo"
                                value="no" <?php if($_additionalCPD == 'no'): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="additionalCPDNo">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Royal College No Section -->
            <div id="royalCollegeNoSection" style="display: none;">
                <div class="mb-3">
                    <label class="form-label"><strong>Do you have a diary, summary or list of CPD activity that you have
                            participated in this year?</strong></label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cpdDiary" id="cpdDiaryYes" value="yes">
                            <label class="form-check-label" for="cpdDiaryYes"
                                <?php if($_cpdDiary == 'yes'): ?> checked <?php endif; ?>>Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cpdDiary" id="cpdDiaryNo" value="no">
                            <label class="form-check-label" for="cpdDiaryNo"
                                <?php if($_cpdDiary == 'no'): ?> checked <?php endif; ?>>No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="attachedText" class="mb-2 mt-2" style="display: none;">
                <p><strong>Please attach record and provide reflection in the table below.</strong></p>
            </div>

            <!-- CPD Table Section -->
            <div id="">
                <p><strong>Instead of, or in support of, the above attachments you can also record your CPD below. There
                        is no need to duplicate what is written in your attachments.</strong></p>
                <p>Personal notes from CPD events are more useful than certificates of attendance or PowerPoint
                    presentations. The latter can be large and less informative to your appraiser and should be
                    logged/provided separately.</p>

                <div class="mb-3">
                    <p><strong>About 'Relevant job title or role':
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('roleHelp')"></i>
                    </p>
                </div>

                <div id="roleHelp" class="help-text">
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
                                <th>Credits</th>
                                <th>Supporting information location</th>
                                <th>Attachment</th>
                                <th>Add new row</th>
                            </tr>
                        </thead>
                        <tbody id="cpdTableBody">
                            <?php if($_jobRolesCount > 0): ?>
                                <?php for($i = 0; $i < $_jobRolesCount; $i++): ?>
                                    <?php
                                        $_creditT += $_jobRoles[$i]->credit;
                                    ?>
                                    <tr>
                                        <td>
                                            <select class="form-select form-select-sm" name="roles[]">
                                                <option>Please select...</option>
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
                                        <td><input type="number" class="form-control form-control-sm credit-input"
                                                name="credit[]" step="0.1" value="<?php echo e($_jobRoles[$i]->credit); ?>"></td>
                                        <td>
                                            <select class="form-select form-select-sm location-select"
                                                name="supportingInfo[]">
                                                <option>Please select...</option>
                                                <option <?php if($_jobRoles[$i]->supportingInfo == 'Attached'): ?> selected <?php endif; ?>
                                                    value="Attached">Attached</option>
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
                                <td><input type="number" class="form-control form-control-sm credit-input"
                                        name="credit[]" step="0.1"></td>
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
                        <tfoot>
                            <tr style="background-color: #f8f9fa;">
                                <td colspan="3"><strong>Total Credits:</strong></td>
                                <td><strong><span id="totalCredits"><?php echo e($_creditT); ?></span></strong></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
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
            <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.development-plans')); ?>">
                < Previous section</a>
                    <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.quality-improvement')); ?>">Next section ></a>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle royal college radio button changes
        document.querySelectorAll('input[name="royalCollege"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('royalCollegeYesSection');
                const noSection = document.getElementById('royalCollegeNoSection');

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

        // Calculate total credits
        function calculateTotal() {
            const creditInputs = document.querySelectorAll('.credit-input');
            let total = 0;

            creditInputs.forEach(input => {
                const value = parseFloat(input.value) || 0;
                total += value;
            });

            document.getElementById('totalCredits').textContent = total.toFixed(1);
        }

        // Add event listeners for credit calculation
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('credit-input')) {
                calculateTotal();
            }
        });

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
                    <td><input type="number" class="form-control form-control-sm credit-input" name="credit[]" step="0.1"></td>
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

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/cpd.blade.php ENDPATH**/ ?>