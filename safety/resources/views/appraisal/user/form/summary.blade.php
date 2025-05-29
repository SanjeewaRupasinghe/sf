@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Summary of the appraisal discussion')

@section('content')
    <div class="content-header">
        <h1>Section 19 of 21</h1>
        <h2>Summary of the appraisal discussion
        </h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        $_scope_of_work = '';
        $_personal_development_plans = '';
        $_continuing_professional_development = '';
        $_quality_improvement_activity = '';
        $_significant_events = '';
        $_feedback_colleagues_patients = '';
        $_review_complaints_procedures = '';
        $_achievements_challenges_aspirations = '';
        $_additional_information = '';
        $_context_general_summary = '';
        $_domain1_knowledge_skills = '';
        $_domain2_safety_quality = '';
        $_domain3_communication = '';
        $_domain4_maintaining_trust = '';

        try {
            if ($content->summary) {
                $_scope_of_work = $content->summary->scope_of_work;
                $_personal_development_plans = $content->summary->personal_development_plans;
                $_continuing_professional_development = $content->summary->continuing_professional_development;
                $_quality_improvement_activity = $content->summary->quality_improvement_activity;
                $_significant_events = $content->summary->significant_events;
                $_feedback_colleagues_patients = $content->summary->feedback_colleagues_patients;
                $_review_complaints_procedures = $content->summary->review_complaints_procedures;
                $_achievements_challenges_aspirations = $content->summary->achievements_challenges_aspirations;
                $_additional_information = $content->summary->additional_information;
                $_context_general_summary = $content->summary->context_general_summary;
                $_domain1_knowledge_skills = $content->summary->domain1_knowledge_skills;
                $_domain2_safety_quality = $content->summary->domain2_safety_quality;
                $_domain3_communication = $content->summary->domain3_communication;
                $_domain4_maintaining_trust = $content->summary->domain4_maintaining_trust;
            }
        } catch (\Throwable $th) {
        }

    @endphp

    @include('common.alert')

    <form action="{{ route('appraisal.user.summary.submit') }}" method="POST">
        @csrf

        <div class="content-body">

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        The appraiser must record here a concise summary of the appraisal discussion, which should be agreed
                        with the doctor, prior to both parties signing off the document.
                    </div>

                    <h5 class="text-primary">Appraiser's review of portfolio</h5>
                    <p>The appraiser should review sections 4, 6, 7, 8, 9, 10, 11, 12 and 14 and either insert their summary
                        comments in the appropriate box at the end of each of those sections or here (the boxes below
                        correspond with the individual appraiser comments boxes in each of the above sections and will
                        mirror each other).</p>

                    <!-- Scope of work (Section 4) -->
                    <div class="mb-3">
                        <label for="scope_of_work">Scope of work (Section 4)</label>
                        <textarea class="form-control" name="scope_of_work" id="scope_of_work" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_scope_of_work }}</textarea>
                    </div>

                    <!-- Personal development plans and their review (Section 6) -->
                    <div class="mb-3">
                        <label for="personal_development_plans">Personal development plans and their review (Section
                            6)</label>
                        <textarea class="form-control" name="personal_development_plans" id="personal_development_plans" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_personal_development_plans }}</textarea>
                    </div>

                    <!-- Continuing professional development (Section 7) -->
                    <div class="mb-3">
                        <label for="continuing_professional_development">Continuing professional development (Section
                            7)</label>
                        <textarea class="form-control" name="continuing_professional_development" id="continuing_professional_development"
                            rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_continuing_professional_development }}</textarea>
                    </div>

                    <!-- Quality improvement activity (Section 8) -->
                    <div class="mb-3">
                        <label for="quality_improvement_activity">Quality improvement activity (Section 8)</label>
                        <textarea class="form-control" name="quality_improvement_activity" id="quality_improvement_activity" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_quality_improvement_activity }}</textarea>
                    </div>

                    <!-- Significant events (Section 9) -->
                    <div class="mb-3">
                        <label for="significant_events">Significant events (Section 9)</label>
                        <textarea class="form-control" name="significant_events" id="significant_events" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_significant_events }}</textarea>
                    </div>

                    <!-- Feedback from colleagues and patients (Section 10) -->
                    <div class="mb-3">
                        <label for="feedback_colleagues_patients">Feedback from colleagues and patients (Section 10)</label>
                        <textarea class="form-control" name="feedback_colleagues_patients" id="feedback_colleagues_patients" rows="6"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_feedback_colleagues_patients }}</textarea>
                    </div>

                    <!-- Review of complaints and procedures (Section 11) -->
                    <div class="mb-3">
                        <label for="review_complaints_procedures">Review of complaints and procedures (Section 11)</label>
                        <textarea class="form-control" name="review_complaints_procedures" id="review_complaints_procedures" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_review_complaints_procedures }}</textarea>
                    </div>

                    <!-- Achievements, challenges and aspirations (Section 12) -->
                    <div class="mb-3">
                        <label for="achievements_challenges_aspirations">Achievements, challenges and aspirations (Section
                            12)</label>
                        <textarea class="form-control" name="achievements_challenges_aspirations" id="achievements_challenges_aspirations"
                            rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_achievements_challenges_aspirations }}</textarea>
                    </div>

                    <!-- Additional information (Section 14) -->
                    <div class="mb-3">
                        <label for="additional_information">Additional information (Section 14)</label>
                        <textarea class="form-control" name="additional_information" id="additional_information" rows="3"
                            placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.">{{ $_additional_information }}</textarea>
                    </div>

                    <p class="mt-4">The summaries below should be recorded in accordance with the four domains of Good
                        Medical Practice. The doctor should have reflected on these already in Section 16. The appraiser
                        should be aware of the attributes within each of the domains and ensure that this, and future
                        appraisals, are in accordance with Good Medical Practice. Include actions to be taken by the doctor.
                    </p>

                    <h5>Context and general summary
                         <i class="fas fa-question-circle text-info ms-2" onclick="toggleHelp('summaryGeneralHelp')"
                        style="cursor: pointer;"></i>
                    </h5>

                     <div id="summaryGeneralHelp" class="help-text" style="display: none;">
                   The general summary should cover key elements of the wider appraisal discussion, particularly those
                arising from the information shared in Section
                12 regarding achievements, challenges and aspirations.
                </div>

                    <!-- Context and general summary -->
                    <div class="mb-3">
                        <textarea class="form-control" name="context_general_summary" id="context_general_summary" rows="6">{{ $_context_general_summary }}</textarea>
                    </div>

                    <!-- Domain 1: Knowledge, skills and performance -->
                    <div class="mb-3">
                        <label for="domain1_knowledge_skills">Domain 1: Knowledge, skills and performance</label>
                        <div style="position: relative;">
                            <textarea class="form-control" name="domain1_knowledge_skills" id="domain1_knowledge_skills" rows="6">{{ $_domain1_knowledge_skills }}</textarea>
                        </div>
                    </div>

                    <!-- Domain 2: Safety and quality -->
                    <div class="mb-3">
                        <label for="domain2_safety_quality">Domain 2: Safety and quality</label>
                        <textarea class="form-control" name="domain2_safety_quality" id="domain2_safety_quality" rows="6">{{ $_domain2_safety_quality }}</textarea>
                    </div>

                    <!-- Domain 3: Communication, partnership and teamwork -->
                    <div class="mb-3">
                        <label for="domain3_communication">Domain 3: Communication, partnership and teamwork</label>
                        <textarea class="form-control" name="domain3_communication" id="domain3_communication" rows="6">{{ $_domain3_communication }}</textarea>
                    </div>

                    <!-- Domain 4: Maintaining trust -->
                    <div class="mb-3">
                        <label for="domain4_maintaining_trust">Domain 4: Maintaining trust</label>
                        <textarea class="form-control" name="domain4_maintaining_trust" id="domain4_maintaining_trust" rows="6">{{ $_domain4_maintaining_trust }}</textarea>
                    </div>


                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.development-plan')}}">
                    < Previous section</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.outputs')}}">Next section ></a>
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

@endsection
