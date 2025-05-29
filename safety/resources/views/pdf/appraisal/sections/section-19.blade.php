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
                {{ $appraisalData['sm_scope_of_work'] ?? '' }}
            </div>
            <label class="form-label">
                Personal development plans and their review (Section
                6)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_personal_development_plans'] ?? '' }}
            </div>

            <label class="form-label">
                Continuing professional development (Section 7)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_continuing_professional_development'] ?? '' }}
            </div>
            <label class="form-label">
                Quality improvement activity (Section 8)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_quality_improvement_activity'] ?? '' }}
            </div>
            <label class="form-label">
                Significant events (Section 9)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_significant_events'] ?? '' }}
            </div>
            <label class="form-label">
                Feedback from colleagues and patients (Section 10)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_feedback_colleagues_patients'] ?? '' }}
            </div>
            <label class="form-label">
                Review of complaints and procedures (Section 11)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_review_complaints_procedures'] ?? '' }}
            </div>
            <label class="form-label">
                Achievements, challenges and aspirations (Section
                12)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_achievements_challenges_aspirations'] ?? '' }}
            </div>
            <label class="form-label">
                Additional information (Section 14)
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_additional_information'] ?? '' }}
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
                {{ $appraisalData['sm_context_general_summary'] ?? '' }}
            </div>

            <label class="form-label">
                Domain 1: Knowledge, skills and performance
            </label>
            <div class="instruction-text">
                Domain 1. Knowledge, skills and performance - has three attributes <br>
                1.1 Maintain your professional performance<br>
                1.2 Apply knowledge and experience to practice<br>
                1.3 Ensure that all documentation (including clinical records) formally recording your work is clear,
                accurate and legible<br>
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_domain1_knowledge_skills'] ?? '' }}
            </div>

            <label class="form-label">
                Domain 2: Safety and quality
            </label>
            <div class="instruction-text">
                Domain 2. Safety and quality - has three attributes<br>
                2.1 Contribute to and comply with systems to protect patients<br>
                2.2 Respond to risks to safety<br>
                2.3 Protect patients and colleagues from any risk posed by your health
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_domain2_safety_quality'] ?? '' }}
            </div>

            <label class="form-label">
                Domain 3: Communication, partnership and teamwork
            </label>
            <div class="instruction-text">
                Domain 3. Communication, partnership and teamwork - has three attributes<br>
                3.1 Communicate effectively<br>
                3.2 Work constructively with colleagues and delegate effectively<br>
                3.3 Establish and maintain partnerships with patients
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_domain3_communication'] ?? '' }}
            </div>

            <label class="form-label">
                Domain 4: Maintaining trust
            </label>
            <div class="instruction-text">
                Domain 4. Maintaining trust - has three attributes<br>
                4.1 Show respect for patients<br>
                4.2 Treat patients and colleagues fairly and without discrimination<br>
                4.3 Act with honesty and integrity
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['sm_domain4_maintaining_trust'] ?? '' }}
            </div>

        </div>
    </div>

</div>
