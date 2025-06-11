<div>
    <div>
        <div class="section-header">
            Section 19 of 21
            <br>Summary of the appraisal discussion
        </div>

        <div class="section-content">

            <p>
                The appraiser must record here a concise summary of the appraisal discussion, which should be agreed
                with the doctor, prior to both parties signing off the document.

                <br>
                <br>

                Appraiser's review of portfolio
                <br>
                <br>
                The appraiser should review sections 4, 6, 7, 8, 9, 10, 11, 12 and 14 and either insert their summary
                comments in the appropriate box at the end of each of those sections or here (the boxes below
                correspond with the individual appraiser comments boxes in each of the above sections and will
                mirror each other).
            </p>
            <label class="form-label">
                Scope of work (Section 4)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_scope_of_work'] ?? ''); ?>

            </div>
            <label class="form-label">
                Personal development plans and their review (Section
                6)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_personal_development_plans'] ?? ''); ?>

            </div>

            <label class="form-label">
                Continuing professional development (Section 7)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_continuing_professional_development'] ?? ''); ?>

            </div>
            <label class="form-label">
                Quality improvement activity (Section 8)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_quality_improvement_activity'] ?? ''); ?>

            </div>
            <label class="form-label">
                Significant events (Section 9)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_significant_events'] ?? ''); ?>

            </div>
            <label class="form-label">
                Feedback from colleagues and patients (Section 10)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_feedback_colleagues_patients'] ?? ''); ?>

            </div>
            <label class="form-label">
                Review of complaints and procedures (Section 11)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_review_complaints_procedures'] ?? ''); ?>

            </div>
            <label class="form-label">
                Achievements, challenges and aspirations (Section
                12)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_achievements_challenges_aspirations'] ?? ''); ?>

            </div>
            <label class="form-label">
                Additional information (Section 14)
            </label>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_additional_information'] ?? ''); ?>

            </div>

            <p class="mt-4">The summaries below should be recorded in accordance with the four domains of Good
                Medical Practice. The doctor should have reflected on these already in Section 16. The appraiser
                should be aware of the attributes within each of the domains and ensure that this, and future
                appraisals, are in accordance with Good Medical Practice. Include actions to be taken by the doctor.
            </p>

            <label class="form-label">
                Context and general summary
            </label>
            <div class="instruction-text">
                The general summary should cover key elements of the wider appraisal discussion, particularly those
                arising from the information shared in Section
                12 regarding achievements, challenges and aspirations.
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_context_general_summary'] ?? ''); ?>

            </div>

           <label class="form-label">
                Domain 1: Knowledge, skills and development
            </label>
            <div class="instruction-text">
                <p class="mb-1">1 Being competent</p>
                <p class="mb-1">2 Providing good clinical care</p>
                <p class="mb-1">3 Offering remote consultations</p>
                <p class="mb-1">4 Considering research opportunities</p>
                <p class="mb-1">5 Maintaining, developing and improving your performance</p>
                <p class="mb-1">6 Managing resources effectively and sustainably</p>
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_domain1_knowledge_skills'] ?? ''); ?>

            </div>

            <label class="form-label">
                Domain 2: Patients, partnership and communication
            </label>
            <div class="instruction-text">
                <p class="mb-1">1 Treating patients fairly and respecting their rights</p>
                <p class="mb-1">2 Treating patients with kindness, courtesy and respect</p>
                <p class="mb-1">3 Supporting patients to make decisions about treatment and care</p>
                <p class="mb-1">4 Sharing information with patients</p>
                <p class="mb-1">5 Communicating with those close to a patient</p>
                <p class="mb-1">6 Caring for the whole patient</p>
                <p class="mb-1">7 Safeguarding children and adults who are at risk of harm</p>
                <p class="mb-1">8 Helping in emergencies</p>
                <p class="mb-1">9 Making sure patients who pose a risk of harm to others can access appropriate care
                </p>
                <p class="mb-1">2.10 Being open if things go wrong</p>
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_domain2_safety_quality'] ?? ''); ?>

            </div>

           <label class="form-label">
                Domain 3: Colleagues, culture and safety
            </label>
            <div class="instruction-text">
                <p class="mb-1">1 Treating colleagues with kindness, courtesy and respect</p>
                <p class="mb-1">2 Contributing to a positive working and training environment</p>
                <p class="mb-1">3 Demonstrating leadership behaviours</p>
                <p class="mb-1">4 Contributing to continuity of care</p>
                <p class="mb-1">5 Delegating safely and appropriately</p>
                <p class="mb-1">6 Recording your work clearly, accurately, and legibly</p>
                <p class="mb-1">7 Keeping patients safe</p>
                <p class="mb-1">8 Responding to safety risks</p>
                <p class="mb-1">9 Managing risks posed by your health</p>
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_domain3_communication'] ?? ''); ?>

            </div>

            <label class="form-label">
                Domain 4: Trust and professionalism
            </label>
            <div class="instruction-text">
                <p class="mb-1">1 Acting with honesty and integrity</p>
                <p class="mb-1">2 Acting with honesty and integrity in research</p>
                <p class="mb-1">3 Maintaining professional boundaries</p>
                <p class="mb-1">4 Communicating as a medical professional</p>
                <p class="mb-1">5 All professional communication</p>
                <p class="mb-1">6 Public professional communication, including using social media, advertising,
                    promotion, and endorsement</p>
                <p class="mb-1">7 Giving evidence and acting as a witness</p>
                <p class="mb-1">8 Private communication</p>
                <p class="mb-1">9 Managing conflicts of interest</p>
                <p class="mb-1">10 Cooperating with legal and regulatory requirements</p>
            </div>
            <div class="form-input form-input-large">
                <?php echo e($appraisalData['sm_domain4_maintaining_trust'] ?? ''); ?>

            </div>

        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/pdf/appraisal/sections/section-19.blade.php ENDPATH**/ ?>