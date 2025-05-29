<div>
    <div>
        <div class="section-header">
            Section 20 of 21
            <br>Supporting Information
        </div>

        <div class="section-content">

            <h5 class="text-primary mb-3">The appraiser makes the following statements to the responsible officer:
            </h5>

            <div class="form-row">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>* An appraisal has taken place that reflects the whole of the doctor's scope of work and
                                addresses the principles and values set out in Good Medical Practice.</td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_1']) && $appraisalData['out_statement_1'] == 'agree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Agree
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_1']) && $appraisalData['out_statement_1'] == 'disagree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Disagree
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>* Appropriate supporting information has been presented in accordance with the Good
                                Medical
                                Practice Framework for appraisal and revalidation and this reflects the nature and scope
                                of
                                the doctor's work.</td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_2']) && $appraisalData['out_statement_2'] == 'agree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Agree
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_2']) && $appraisalData['out_statement_1'] == 'disagree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Disagree
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>* A review that demonstrates progress against last year's personal development plan has
                                taken place.</td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_3']) && $appraisalData['out_statement_3'] == 'agree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Agree
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_3']) && $appraisalData['out_statement_3'] == 'disagree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Disagree
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                * An agreement has been reached with the doctor about a new personal development plan
                                and
                                any associated actions for the coming year.
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_4']) && $appraisalData['out_statement_4'] == 'agree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Agree
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_4']) && $appraisalData['out_statement_4'] == 'disagree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Disagree
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>* No information has been presented or discussed in the appraisal that raises a concern
                                about the doctor's fitness to practise.</td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_5']) && $appraisalData['out_statement_5'] == 'agree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Agree
                            </td>
                            <td>
                                <span
                                    class="radio-button {{ isset($appraisalData['out_statement_5']) && $appraisalData['out_statement_5'] == 'disagree' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Disagree
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <label class="form-label">
                The appraiser should record any comments that
                will assist the responsible officer to understand the reasons for the statements that have been
                made.
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['out_appraiser_comments'] ?? '' }}
            </div>
            <label class="form-label">
                The appraise should record any other issues
                that the responsible officer should be aware of that may be relevant to the revalidation
                recommendation.
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['out_additional_issues'] ?? '' }}
            </div>
            <label class="form-label">
                The doctor may use this space to respond to
                the above comments made by the appraiser. The responsible officer will review comments made in
                this space.
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['out_doctor_response'] ?? '' }}
            </div>
            <p class="fw-bold">Both the doctor and the appraiser are asked to read the following statements and
                sign below to confirm their acceptance:</p>

            <div class="p-3 mb-3">
                <p class="fw-bold">"I confirm that the information presented within this submission is an
                    accurate record of the documentation provided and used in the appraisal."</p>

                <p class="fw-bold">"I understand that I must protect patients from risk of harm posed by
                    another colleague's conduct, performance or health. The safety of patients must come first
                    at all times. If I have concerns that a colleague may not be fit to practise, I am aware
                    that I must take appropriate steps without delay, so that the concerns are investigated and
                    patients protected where necessary."</p>
            </div>
            <div style="padding: 15px 0px">
            <span class="radio-button {{ isset($appraisalData['out_doctor_confirmation']) && $appraisalData['out_doctor_confirmation'] == 'on' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> * Doctor - please tick here to confirm this.
            </div>

            <label class="form-label">
                * Full name of doctor accepting the
                                    declaration above:
            </label>           
            <div class="form-input form-input-large">
                {{ $appraisalData['out_doctor_full_name'] ?? '' }}
            </div>
            <label class="form-label">
               * Doctor GMC number:
            </label>           
            <div class="form-input form-input-large">
                {{ $appraisalData['out_doctor_gmc_number'] ?? '' }}
            </div>

            <div  style="padding: 15px 0px">
             <span class="radio-button {{ isset($appraisalData['out_appraiser_confirmation']) && $appraisalData['out_appraiser_confirmation'] == 'on' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> * Appraiser - please tick here to confirm this.

            </div>
            <label class="form-label">
               * Full name of appraiser accepting the
                                    declaration above:
            </label>           
            <div class="form-input form-input-large">
                {{ $appraisalData['out_appraiser_full_name'] ?? '' }}
            </div>
            <label class="form-label">
               * Appraiser GMC number:
            </label>           
            <div class="form-input form-input-large">
                {{ $appraisalData['out_appraiser_gmc_number'] ?? '' }}
            </div>
            <label class="form-label">
               * Date of appraisal meeting:
            </label>           
            <div class="form-input form-input-large">
                {{ $appraisalData['out_appraisal_date'] ?? '' }}
            </div>

        </div>
    </div>

</div>
