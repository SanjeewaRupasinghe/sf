

<?php $__env->startSection('title', 'Instructions for using this form - Medical Appraisal Guide'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 3 of 21</h1>
        <h2>Personal details</h2>
    </div>

    <?php
        $content = json_decode(Auth::user()->content);

        $_name = '';
        $_gmcNumber = '';
        $_address = '';
        $_phone = '';
        $_email = '';
        $_yearOfAppraisal = '';
        $_revalidationRecommendation = '';
        $_clinicalAcademic = '';
        $_medicalQualifications = '';
        $_secondAppraiser = '';
        $_designation = '';
        $_medicalQualificationsCount = 0;

        try {
            if ($content->personalDetails) {
                $_name = $content->personalDetails->name;
                $_gmcNumber = $content->personalDetails->gmcNumber;
                $_address = $content->personalDetails->address;
                $_phone = $content->personalDetails->phone;
                $_email = $content->personalDetails->email;
                $_yearOfAppraisal = $content->personalDetails->yearOfAppraisal;
                $_revalidationRecommendation = $content->personalDetails->revalidationRecommendation;
                $_medicalQualifications = $content->personalDetails->medicalQualifications;

                try {
                    $_medicalQualificationsCount = count($_medicalQualifications);
                } catch (\Throwable $th) {
                }

                $_clinicalAcademic = $content->personalDetails->clinicalAcademic;
                $_secondAppraiser = $content->personalDetails->secondAppraiser;
                $_designation = $content->personalDetails->designation;
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
            If you made any changes, please click the "Save Form" button to save your details. Otherwise, your changes will not be saved.
        </div>
    <?php endif; ?>

    <form <?php if($LOCKDOWN_STATUS): ?> action="<?php echo e(route('appraisal.user.personal-details.submit')); ?>" <?php endif; ?>
        method="POST">
        <?php echo csrf_field(); ?>
        <div class="content-body">

            <div class="content-subsection">

                <!-- Personal Details Section -->
                <div class="form-section" id="personal-details">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fullName" class="form-label">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="fullName" name="name"
                                value="<?php echo e($_name); ?>" required>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <label for="gmcNumber" class="form-label">
                                GMC Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="gmcNumber" name="gmcNumber"
                                value="<?php echo e($_gmcNumber); ?>" required>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <label for="gmcNumber" class="form-label">
                                Contact address (for any official
                                correspondence concerning your
                                appraisal): <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="address" rows="2"><?php echo e($_address); ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <p>Please ensure that you provide an email address and telephone number to allow your appraiser to
                            contact you</p>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Contact telephone number:
                            </label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="<?php echo e($_phone); ?>" required>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Contact email number: <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo e($_email); ?>" required>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Name of designated body: <span class="text-danger">*</span>
                                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('designationHelp')"></i>
                            </label>
                            <input type="text" class="form-control" id="designation" name="designation"
                                value="<?php echo e($_designation); ?>" required>
                            <div id="designationHelp" class="help-text">
                                A 'designated body' is an organisation that employs or
                                contracts with doctors and is designated in The
                                Medical Profession (Responsible Officer)
                                Regulations 2010.
                                <br><br>
                                The types of designated bodies are listed in the
                                legislation and include government departments, all
                                NHS trusts and other bodies employing or contracting
                                with a medical practitioner. <a
                                    href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                                    target="_blank">Further information is
                                    available here.</a>
                                <br><br>
                                For most doctors this is likely to be your main
                                employer. For GPs, this will probably be the body on
                                whose performers list you appear
                            </div>
                        </div>
                    </div>

                </div>

                <div>
                    <p>
                        Medical qualifications, UK or elsewhere, including dates where appropriate
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('qualificationHelp')"></i>
                    </p>
                    <div id="qualificationHelp" class="help-text">
                        Your appraiser needs to understand how you carry out your scope of work, so please list your
                        professional medical qualifications. For some roles, it
                        may also be appropriate to list any experience gained through postgraduate diplomas, courses or
                        other relevant programmes.
                    </div>
                </div>

                <!-- Scope of Work Section -->
                <div class="form-section" id="scope-work">

                    <div id="employmentContainer">
                        <div class="dynamic-row">
                            <?php if($_medicalQualificationsCount > 0): ?>
                                <?php for($i = 0; $i < $_medicalQualificationsCount; $i++): ?>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Qualification</label>
                                            <input type="text" class="form-control" name="qualification[]"
                                                value="<?php echo e($_medicalQualifications[$i]->qualification); ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Awarding body</label>
                                            <input type="text" class="form-control" name="awardingBody[]"
                                                value="<?php echo e($_medicalQualifications[$i]->awardingBody); ?>">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Year</label>
                                            <input type="number" class="form-control" name="year[]"
                                                value="<?php echo e($_medicalQualifications[$i]->year); ?>">
                                        </div>
                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                            <?php if($LOCKDOWN_STATUS): ?>
                                                <button type="button" class="btn btn-remove-row btn-sm text-white"
                                                    onclick="removeRow(this)">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                            <?php if($LOCKDOWN_STATUS): ?>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Qualification</label>
                                        <input type="text" class="form-control" name="qualification[]">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Awarding body</label>
                                        <input type="text" class="form-control" name="awardingBody[]">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Year</label>
                                        <input type="number" class="form-control" name="year[]">
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-remove-row btn-sm text-white"
                                            onclick="removeRow(this)">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if($LOCKDOWN_STATUS): ?>
                    <button type="button" class="btn btn-add-row btn-sm text-white" onclick="addEmploymentRow()">
                        <i class="fas fa-plus"></i> Add
                    </button>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="gmcNumber" class="form-label">
                        Year of this appraisal: <span class="text-danger">*</span>
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('yearOfAppraisalHelp')"></i>
                    </label>
                    <select name="yearOfAppraisal" class="form-control">
                        <option value="2017/18" <?php if($_yearOfAppraisal == '2017/18'): ?> selected <?php endif; ?>>2017/18</option>
                        <option value="2018/19" <?php if($_yearOfAppraisal == '2018/19'): ?> selected <?php endif; ?>>2018/19</option>
                        <option value="2019/20" <?php if($_yearOfAppraisal == '2019/20'): ?> selected <?php endif; ?>>2019/20</option>
                        <option value="2020/21" <?php if($_yearOfAppraisal == '2020/21'): ?> selected <?php endif; ?>>2020/21</option>
                        <option value="2021/22" <?php if($_yearOfAppraisal == '2021/22'): ?> selected <?php endif; ?>>2021/22</option>
                        <option value="2022/23" <?php if($_yearOfAppraisal == '2022/23'): ?> selected <?php endif; ?>>2022/23</option>
                        <option value="2023/24" <?php if($_yearOfAppraisal == '2023/24'): ?> selected <?php endif; ?>>2023/24</option>
                        <option value="2024/25" <?php if($_yearOfAppraisal == '2024/25'): ?> selected <?php endif; ?>>2024/25</option>
                        <option value="2025/26" <?php if($_yearOfAppraisal == '2025/26'): ?> selected <?php endif; ?>>2025/26</option>
                        <option value="2026/27" <?php if($_yearOfAppraisal == '2026/27'): ?> selected <?php endif; ?>>2026/27</option>
                        <option value="2027/28" <?php if($_yearOfAppraisal == '2027/28'): ?> selected <?php endif; ?>>2027/28</option>
                        <option value="2028/29" <?php if($_yearOfAppraisal == '2028/29'): ?> selected <?php endif; ?>>2028/29</option>
                        <option value="2031/30" <?php if($_yearOfAppraisal == '2031/30'): ?> selected <?php endif; ?>>2031/30</option>
                        <option value="2030/31" <?php if($_yearOfAppraisal == '2030/31'): ?> selected <?php endif; ?>>2030/31</option>
                        <option value="2032/33" <?php if($_yearOfAppraisal == '2032/33'): ?> selected <?php endif; ?>>2032/33</option>
                        <option value="2033/34" <?php if($_yearOfAppraisal == '2033/34'): ?> selected <?php endif; ?>>2033/34</option>
                        <option value="2034/35" <?php if($_yearOfAppraisal == '2034/35'): ?> selected <?php endif; ?>>2034/35</option>
                        <option value="2035/36" <?php if($_yearOfAppraisal == '2035/36'): ?> selected <?php endif; ?>>2035/36</option>
                        <option value="2036/37" <?php if($_yearOfAppraisal == '2036/37'): ?> selected <?php endif; ?>>2036/37</option>
                    </select>
                    <div id="yearOfAppraisalHelp" class="help-text">
                        The appraisal year is recorded in financial years. Your appraisal discussion
                        must take place before 31 March of your appraisal year. However, you may
                        begin to prepare for your appraisal using this form at any time preceding
                        your appraisal date.
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <label for="gmcNumber" class="form-label">
                        Due date of next revalidation
                        recommendation: <span class="text-danger">*</span>
                        <i class="fas fa-question-circle help-icon"
                            onclick="toggleHelp('revalidationRecommendationHelp')"></i>
                    </label>
                    <input type="date" class="form-control" name="revalidationRecommendation"
                        value="<?php echo e($_revalidationRecommendation); ?>" required>
                    <div id="revalidationRecommendationHelp" class="help-text">
                        If you're not sure of your date, <a
                            href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                            target="_blank"> further information can be found here.</a>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="clinicalAcademic" class="form-label">
                        Are you a clinical academic who requires a second appraiser under the Follett principles?
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('academicHelp')"></i>
                    </label>
                    <select class="form-select" id="clinicalAcademic" name="clinicalAcademic"
                        onchange="toggleSecondAppraiser()">
                        <option value="">Please select...</option>
                        <option value="yes" <?php if($_clinicalAcademic == 'yes'): ?> selected <?php endif; ?>>Yes</option>
                        <option value="no" <?php if($_clinicalAcademic == 'no'): ?> selected <?php endif; ?>>No</option>
                    </select>
                    <div id="academicHelp" class="help-text">
                        The Follett review states that "universities and NHS
                        bodies should work together to develop a jointly
                        agreed annual appraisal and performance review
                        process based on that for NHS consultants, to meet
                        the needs of both partners". That principle continues
                        in medical appraisal and clinical academics will
                        continue to participate in joint appraisal.
                        <br><br>
                        If this situation applies to you, please select 'Yes'
                        which will allow for a second appraiser to participate
                        in this process. If you require a second appraiser for
                        any other reason, please do not select this option, but
                        note this in Section 14.
                    </div>
                </div>
                <div class="row mb-3" id="secondAppraiserDiv" style="display: none;">
                    <div class="col-md-6">
                        <label for="secondAppraiser" class="form-label">
                            Second Appraiser's Name <span class="text-danger">*</span>
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('secondAppraiserHelp')"></i>
                        </label>
                        <input type="text" class="form-control" id="secondAppraiser" name="secondAppraiser"
                            value="<?php echo e($_secondAppraiser); ?>">
                        <div id="secondAppraiserHelp" class="help-text">
                            Name of your designated second appraiser for academic activities.
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.instructions')); ?>">
                    < Previous section</a>
                        <?php if($LOCKDOWN_STATUS): ?>
                            <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <?php endif; ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.scope-of-work')); ?>">Next section
                            ></a>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle second appraiser field
        function toggleSecondAppraiser() {
            const select = document.getElementById("clinicalAcademic");
            const div = document.getElementById("secondAppraiserDiv");
            const input = document.getElementById("secondAppraiser");

            if (select.value === "yes") {
                div.style.display = "block";
                input.required = true;
            } else {
                div.style.display = "none";
                input.required = false;
                input.value = "";
            }
        }

        // Add employment row
        function addEmploymentRow() {
            const container = document.getElementById("employmentContainer");
            const newRow = document.createElement("div");
            newRow.className = "dynamic-row";
            newRow.innerHTML = `
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Qualification</label>
                        <input type="text" class="form-control" name="qualification[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Awarding body</label>
                        <input type="text" class="form-control" name="awardingBody[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Year</label>
                        <input type="number" class="form-control" name="year[]">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-remove-row btn-sm text-white"
                            onclick="removeRow(this)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
        }

        // Add CPD row
        function addCPDRow() {
            const container = document.getElementById("cpdContainer");
            const newRow = document.createElement("div");
            newRow.className = "dynamic-row";
            newRow.innerHTML = `
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="cpdDate[]">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Activity/Course Title</label>
                        <input type="text" class="form-control" name="cpdTitle[]">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Hours</label>
                        <input type="number" class="form-control" name="cpdHours[]" min="0" step="0.5">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label class="form-label">Credits</label>
                        <input type="number" class="form-control" name="cpdCredits[]" min="0">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-remove-row btn-sm text-white" onclick="removeRow(this)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Learning Outcomes/Reflection</label>
                        <textarea class="form-control" name="cpdReflection[]" rows="2"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
        }

        // Add QI row
        function addQIRow() {
            const container = document.getElementById("qiContainer");
            const newRow = document.createElement("div");
            newRow.className = "dynamic-row";
            newRow.innerHTML = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Title</label>
                        <input type="text" class="form-control" name="qiTitle[]">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Your Role</label>
                        <select class="form-select" name="qiRole[]">
                            <option value="">Select role...</option>
                            <option value="lead">Project Lead</option>
                            <option value="participant">Participant</option>
                            <option value="advisor">Advisor</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-remove-row btn-sm text-white" onclick="removeRow(this)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description and Outcomes</label>
                        <textarea class="form-control" name="qiDescription[]" rows="3"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
        }

        // Remove row
        function removeRow(button) {
            const row = button.closest(".dynamic-row");
            row.remove();
        }

        // Save draft function
        function saveDraft() {
            alert("Draft saved successfully!");
        }

        toggleSecondAppraiser();

        // Form validation on submit
        document
            .getElementById("medicalAppraisalForm")
            .addEventListener("submit", function(e) {
                e.preventDefault();

                if (this.checkValidity()) {
                    alert("Form submitted successfully!");
                } else {
                    this.classList.add("was-validated");
                }
            });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/personal-details.blade.php ENDPATH**/ ?>