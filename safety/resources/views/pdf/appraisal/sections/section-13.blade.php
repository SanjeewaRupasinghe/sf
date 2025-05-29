<div>
    <div>
        <div class="section-header">
            Section 13 of 21
            <br>Probity and health statements
        </div>

        <div class="section-content">

            <p>
                Please read and respond to the following statements.
            </p>

            <div class="instruction-text">
                If you are subject to any suspensions, restrictions or investigations, or if you have been asked to
                include specific information in your
                appraisal but you are not including this in your appraisal submission it is vital that you discuss this
                with your appraiser or responsible
                officer before finalising your appraisal submission. Failure to include such information without prior
                discussion could constitute a failure
                of probity which could call into question your fitness to practise.
                <a
                    href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                    Further guidance on the requirements of Good Medical Practice and a doctor's probity and health
                    obligations with regards to
                    revalidation can be found here.
                </a>
            </div>

            <p>
                "I declare that I accept the professional obligations placed on me in Good Medical
                Practice in relation to probity, including the statutory obligation on me to ensure that I have adequate
                professional indemnity for all my professional roles and the professional obligation on me to manage my
                interests appropriately."
            </p>

            <div class="radio-option">
                <span
                    class="radio-button {{ isset($appraisalData['pb_probityConfirm']) && $appraisalData['pb_probityConfirm'] == 'I have not I have not been named in any complaints in the last year.' ? 'radio-checked' : '' }}">o</span>
                <span class="radio-button"></span> Please tick here to confirm.
            </div>

            <p class="mb-3">If you feel that you are unable to make this statement for whatever reason, please explain
                why in the comment box below.</p>

            <p class="mb-3"><strong>"In relation to suspensions, restrictions on practice or being subject to an
                    investigation of any kind since my last appraisal:</strong></p>


            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Please select one of the following:</span>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['pb_probityDeclaration']) && $appraisalData['pb_probityDeclaration'] == 'nothing' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button"></span>I have nothing to declare.
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['pb_probityDeclaration']) && $appraisalData['pb_probityDeclaration'] == 'something' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button radio-checked"></span> I have something to declare.
                    </div>
                </div>

                <!-- ELSE -->
                @if (isset($appraisalData['pb_probityDeclaration']))
                    @if ($appraisalData['pb_probityDeclaration'] == 'something')
                        <label class="form-label">
                            Please provide a brief summary of the complaint(s) including your participation in the
                            investigation
                            and response and any actions taken
                        </label>
                        <div class="form-input form-input-large">
                            {{ $appraisalData['com_actionsTaken'] ?? '' }}
                        </div>
                        <label class="form-label">
                           If you have been suspended from any medical post, have restrictions placed on your
                        practice or are currently under investigation by the GMC or any other body since your last
                        appraisal, please declare this below.
                        </label>
                        <div class="form-input form-input-large">
                            {{ $appraisalData['pb_gmcOrOther'] ?? '' }}
                        </div>
                    @endif
                @endif
                <!-- END ELSE -->
<h6>Health</h6>

<div class="instruction-text">
    Academy guidance indicates that, when making a health declaration that you accept your professional
                    obligations in this way, it is
                    appropriate to consider any relevant specialty guidance, as certain specialties may have specific
                    requirements in relation to health, such
                    as immunisation and infection control procedures. Further guidance on making a health declaration can be
                    found here.

                    <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further guidance on the requirements of Good Medical Practice and a doctor's probity and health
                        obligations with regards to revalidation
                        are available here
                    </a>
</div>
                <label class="form-label">
                   "I declare that I accept the professional obligations placed on me in Good Medical
                    Practice about my personal health."
                </label>
                <div class="radio-option">
                <span
                    class="radio-button {{ isset($appraisalData['pb_healthConfirm']) && $appraisalData['pb_healthConfirm'] == 'I have not I have not been named in any complaints in the last year.' ? 'radio-checked' : '' }}">o</span>
                <span class="radio-button"></span> Please tick here to confirm.
            </div>

            <p class="mb-3">If you feel that you are unable to make this statement for whatever reason, please explain
                    why in the comment box below.</p>

                <p class="mb-3">If you would like to make any comments to your appraiser regarding any of these topics,
                    please do so here.</p>

                <div class="form-input form-input-large">
                    {{ $appraisalData['pb_comments'] ?? '' }}
                </div>

            </div>
        </div>

    </div>
