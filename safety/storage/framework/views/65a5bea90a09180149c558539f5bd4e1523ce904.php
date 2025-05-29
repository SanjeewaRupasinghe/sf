<?php $__env->startSection('title', 'Appraisal checklist'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 17 of 21</h1>
        <h2>Appraisal checklist
        </h2>
    </div>

    <?php
        $content = json_decode(Auth::user()->content);

        $_what_this_checklist_is_for = '';
        $_previous_appraisal_record = '';
        $_scope_of_work = '';
        $_reflection = '';
        $_confidentiality = '';
        $_personal_details = '';
        $_overall = '';
        $_review_of_last_year_pdp = '';
        $_cpd = '';
        $_quality_improvement_activities = '';
        $_significant_events = '';
        $_feedback_from_colleagues = '';
        $_feedback_from_patients = '';
        $_complaints_and_compliments = '';
        $_achievements_challenges_aspirations = '';
        $_probity_declaration = '';
        $_health_declaration = '';
        $_additional_information = '';
        $_review_of_gmc_good_medical_practice = '';
        $_new_pdp_ideas = '';
        $_confirm_agreement = '';

        try {
            if ($content->checklist) {
                $_what_this_checklist_is_for = $content->checklist->what_this_checklist_is_for;
                $_previous_appraisal_record = $content->checklist->previous_appraisal_record;
                $_scope_of_work = $content->checklist->scope_of_work;
                $_reflection = $content->checklist->reflection;
                $_confidentiality = $content->checklist->confidentiality;
                $_personal_details = $content->checklist->personal_details;
                $_overall = $content->checklist->overall;
                $_review_of_last_year_pdp = $content->checklist->review_of_last_year_pdp;
                $_cpd = $content->checklist->cpd;
                $_quality_improvement_activities = $content->checklist->quality_improvement_activities;
                $_significant_events = $content->checklist->significant_events;
                $_feedback_from_colleagues = $content->checklist->feedback_from_colleagues;
                $_feedback_from_patients = $content->checklist->feedback_from_patients;
                $_complaints_and_compliments = $content->checklist->complaints_and_compliments;
                $_achievements_challenges_aspirations = $content->checklist->achievements_challenges_aspirations;
                $_probity_declaration = $content->checklist->probity_declaration;
                $_health_declaration = $content->checklist->health_declaration;
                $_additional_information = $content->checklist->additional_information;
                $_review_of_gmc_good_medical_practice = $content->checklist->review_of_gmc_good_medical_practice;
                $_new_pdp_ideas = $content->checklist->new_pdp_ideas;
                $_confirm_agreement = $content->checklist->confirm_agreement;
            }
        } catch (\Throwable $th) {
        }

    ?>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form action="<?php echo e(route('appraisal.user.checklist.submit')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="content-body">

            <div class="row">
                <div class="col-12">
                    <p class="text-primary">
                        You have now reached the last section before your appraisal meeting. This form should have steered
                        you through all the necessary stages so that your submission is complete. However, you might like to
                        use the checklist on this page as a final step, to confirm that you have covered all the aspects
                        that your appraiser will be looking for in order to sign off your appraisal.
                    </p>

                    <!-- General Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white text-decoration-none w-100 text-start" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#generalSection" aria-expanded="true"
                                    aria-controls="generalSection">
                                    General
                                    <span class="float-end">-</span>
                                </button>
                            </h5>
                        </div>
                        <div id="generalSection" class="collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td width="50">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="what_this_checklist_is_for" id="what_this_checklist_is_for"
                                                        <?php if($_what_this_checklist_is_for == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">What this
                                                        checklist is for</span> – background
                                                </td>
                                                <td width="50"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="previous_appraisal_record" id="previous_appraisal_record"
                                                        <?php if($_previous_appraisal_record == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Previous
                                                        appraisal record</span> – submitted
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="scope_of_work"
                                                        id="scope_of_work" <?php if($_scope_of_work == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Scope of
                                                        work</span> – completed, with reflection, including governance
                                                    arrangements and conflicts of interest
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="reflection"
                                                        id="reflection" <?php if($_reflection == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Reflection</span> – present
                                                    throughout submission
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="confidentiality"
                                                        id="confidentiality"
                                                        <?php if($_confidentiality == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Confidentiality</span> –
                                                    identifiable information removed/redacted
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Supporting Information Section -->
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white text-decoration-none w-100 text-start" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#supportingSection" aria-expanded="true"
                                    aria-controls="supportingSection">
                                    Supporting information
                                    <span class="float-end">-</span>
                                </button>
                            </h5>
                        </div>
                        <div id="supportingSection" class="collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td width="50">
                                                    <input type="checkbox" class="form-check-input" name="personal_details"
                                                        id="personal_details"
                                                        <?php if($_personal_details == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Personal
                                                        details</span> – completed and up to date
                                                </td>
                                                <td width="50"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="overall"
                                                        id="overall" <?php if($_overall == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Overall</span>
                                                    – supporting information matches my scope of work
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="review_of_last_year_pdp" id="review_of_last_year_pdp"
                                                        <?php if($_review_of_last_year_pdp == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Review of
                                                        last year's PDP</span> – present
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="cpd"
                                                        id="cpd" <?php if($_cpd == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">CPD</span> –
                                                    listed, compliant with guidance, with reflection
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="quality_improvement_activities"
                                                        id="quality_improvement_activities"
                                                        <?php if($_quality_improvement_activities == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Quality
                                                        improvement activities</span> – listed, compliant with guidance,
                                                    with
                                                    reflection
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="significant_events" id="significant_events"
                                                        <?php if($_significant_events == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Significant events (also
                                                        known as untoward or critical incidents) or unintended or unexpected
                                                        events, which could have or did lead to harm of one or more
                                                        patients</span> – listed, with reflection, or confirmed none to
                                                    include
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="feedback_from_colleagues" id="feedback_from_colleagues"
                                                        <?php if($_feedback_from_colleagues == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Feedback
                                                        from colleagues</span> – submitted, with reflection, or date last
                                                    submitted
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="feedback_from_patients" id="feedback_from_patients"
                                                        <?php if($_feedback_from_patients == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Feedback
                                                        from patients</span> – submitted, with reflection, or date last
                                                    submitted, or confirmation not necessary (agreed by responsible officer)
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="complaints_and_compliments" id="complaints_and_compliments"
                                                        <?php if($_complaints_and_compliments == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Complaints
                                                        and compliments</span> – all complaints listed, with reflection, or
                                                    confirmed none to include. Compliments listed (optional), with
                                                    reflection
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="achievements_challenges_aspirations"
                                                        id="achievements_challenges_aspirations"
                                                        <?php if($_achievements_challenges_aspirations == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Achievements, challenges
                                                        and aspirations</span> – completed (optional – may be raised
                                                    verbally
                                                    at appraisal)
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="probity_declaration" id="probity_declaration"
                                                        <?php if($_probity_declaration == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Probity
                                                        declaration</span> – completed; suspensions, restrictions or
                                                    investigations – listed if present, with reflection
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="health_declaration" id="health_declaration"
                                                        <?php if($_health_declaration == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Health
                                                        declaration</span> – completed
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="additional_information" id="additional_information"
                                                        <?php if($_additional_information == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Additional
                                                        information</span> – listed, or confirmed none expected, or
                                                    explanation
                                                    why absent
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="review_of_gmc_good_medical_practice"
                                                        id="review_of_gmc_good_medical_practice"
                                                        <?php if($_review_of_gmc_good_medical_practice == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Review of
                                                        GMC 'Good Medical Practice' domains</span> – completed
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="new_pdp_ideas"
                                                        id="new_pdp_ideas"
                                                        <?php if($_new_pdp_ideas == 'on'): ?> checked <?php endif; ?>>
                                                </td>
                                                <td>
                                                    <span class="text-primary">New PDP
                                                        ideas</span> – listed (optional – may be raised verbally at
                                                    appraisal)
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mt-4">
                        <p>(<a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                                class="text-primary">A printable version of the checklist, including all of
                                the helptext can be found here</a>)</p>

                        <div class="border p-3 mb-3">
                            <p><strong>"I confirm that I have completed this form and compiled the supporting information
                                    listed in Section 15 to support this appraisal. I am responsible for the contents and
                                    confirm that it is appropriate for this information to be shared with my appraiser and
                                    responsible officer."</strong></p>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="confirm_agreement" required
                                    id="confirm_agreement" <?php if($_confirm_agreement == 'on'): ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="confirm_agreement">
                                    * Please tick here to confirm your agreement.
                                </label>
                            </div>
                        </div>

                        <p>This is the final page of the pre-appraisal portion of this form. Once all pre-appraisal sections
                            have been completed, please ensure that this form and any additional information that you have
                            said you will supply separately, is passed to your appraiser in accordance with your
                            organisation's guidelines for appraisal.</p>

                        <div class="alert alert-warning">
                            <strong>Do not</strong> email the form onwards using the Adobe Reader menu bar: 'File', 'Send
                            File...', nor the 'Send file as email attachment' icon. This will result in a warning message
                            and the form will not transfer as an attachment into your email application. You should instead
                            save and close the form, open your email application and attach the form directly from where it
                            is filed.
                        </div>

                        <p>Sections 18, 19 and 20 will be completed during and after the appraisal meeting in conjunction
                            with your appraiser.</p>

                        <p>If this is your final appraisal prior to your revalidation date and you are in any doubt that
                            your supporting information from all of your appraisals since your last revalidation is
                            sufficient to support a recommendation by your responsible officer, it is advisable that you
                            discuss this with your appraiser or your responsible officer prior to the meeting.</p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.gmc-domains')); ?>">
                    < Previous section</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.development-plan')); ?>">Next section ></a>
            </div>


        </div>
    </form>


    <script>
        // Toggle collapse icons
        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('.float-end');
                const target = document.querySelector(this.getAttribute('data-bs-target'));

                target.addEventListener('shown.bs.collapse', () => {
                    icon.textContent = '-';
                });

                target.addEventListener('hidden.bs.collapse', () => {
                    icon.textContent = '+';
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/checklist.blade.php ENDPATH**/ ?>