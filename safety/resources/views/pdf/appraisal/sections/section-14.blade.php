<div>
    <div>
        <div class="section-header">
            Section 14 of 21
            <br>Additional information
        </div>

        <div class="section-content">

            <p>
                This page is for you to include:
            <ul>
                <li>any specific information that your organisation requires you to include in your appraisal (e.g.
                    mandatory training records)</li>
                <li>any information that is particular to your circumstance, which you do not feel belongs in any other
                    section e.g. your job plan, appraiser performance review information, appraisal in other
                    organisations, if you wish to do so.</li>
            </ul>
            </p>


            <p>
                This additional information may or may not form part of the information needed for revalidation.
            </p>

            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Have you been requested to bring specific information to your appraisal
                    by your organisation or responsible officer?</span>
                <div class="instruction-text">
                    pected, and should be presented
                    at appraisal, with reflection.
                    Where such items are defined, they should be listed in this section. The information
                    itself should then be set out in the relevant section to which it pertains.
                    You should indicate in this section whether or not you have been specifically asked
                    to present any information in your appraisal submission, with your reflection on
                    these or an explanation of why you have not presented them.
                    <br>
                    <br>
                    These specific items may relate to the clinical specialty and originate from, for
                    example, College specialty guidance.
                    <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further information on College specialty
                        guidance can be found here.
                    </a>
                    Alternatively they may originate from local priorities
                    identified by the responsible officer or elsewhere in the system. They may include
                    any of the categories of supporting information (CPD, quality improvement,
                    significant events, complaints, feedback from colleagues and patients). They may
                    also relate to matters of health and probity as well as other professional matters.
                    They may be defined as expected for groups of doctors, or they may be agreed
                    individually between a doctor and their responsible office
                </div>
                    <div>
                        <div class="radio-group">
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['ad_specInfo']) && $appraisalData['ad_specInfo'] == 'yes' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Yes
                            </div>
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['ad_specInfo']) && $appraisalData['ad_specInfo'] == 'no' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button radio-checked"></span> No
                            </div>
                        </div>

                        <!-- IF -->
                        @if (isset($appraisalData['ad_specInfo']))
                            @if ($appraisalData['ad_specInfo'] == 'yes')
                                <label class="form-label">
                                    Please list below what you have been requested to include, before either entering
                                    the information
                                    itself in the relevant section of this form or in the following table, as
                                    appropriate.
                                </label>
                                <div class="form-input form-input-large">
                                    {{ $appraisalData['ad_appropriate'] ?? '' }}
                                </div>
                            @endif
                        @endif
                        <!-- END IF -->

                        <label class="form-label">
                            About 'Relevant job title or role':
                        </label>
                        <div class="instruction-text">
                            This list is created from your entries in the ‘Scope of Work’ table in Section 4. Select
                            one, or choose
                            ‘Cross role’ if the item is relevant to more than
                            one of your roles
                        </div>
                        <div class="form-row">
                            <table class="form-table">
                                <thead>
                                    <tr>
                                        <th>Relevant job title or role</th>
                                        <th>Date and brief description of activity provided as supporting information
                                        </th>
                                        <th>Outcome of learning and reflection / action taken and next steps</th>
                                        <th>Supporting information location</th>
                                        <th>Attachment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($appraisalData['ad_roles']) && is_array($appraisalData['ad_roles']))
                                        @foreach ($appraisalData['ad_roles'] as $r)
                                            <tr>
                                                <td>{{ $r->roles ?? '' }}</td>
                                                <td>{{ $r->dateAndBrief ?? '' }}</td>
                                                <td>{{ $r->outcomes ?? '' }}</td>
                                                <td>{{ $r->supportingInfo ?? '' }}</td>
                                                <td>
                                                    @php
                                                        $att = null;
                                                        try {
                                                            $att = $r->new_filename;
                                                        } catch (\Throwable $th) {
                                                        }
                                                        $lg = null;
                                                        try {
                                                            $lg = $r->log;
                                                        } catch (\Throwable $th) {
                                                        }
                                                    @endphp
                                                    @if ($r->supportingInfo == 'Attached')
                                                        @if ($att)
                                                            Attached
                                                        @endif
                                                    @else
                                                        @if ($lg)
                                                            Logged
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <label class="form-label">
                            Appraiser's comments
                        </label>
                        <div class="instruction-text">
                            Appraiser's comments boxes appear at the end of a number of sections in this form.
                            Appraisers are
                            encouraged to record their comments here, which will be aggregated verbatim into the summary
                            in
                            Section 10. Appraisers should therefore comment accordingly. Please do not edit the text
                            again
                            in Section 10, it will automatically change the text in the corresponding section.
                            <br>
                            <p>Comments should include:</p>
                            <ul>
                                <li>an overview of the supporting information and the doctor's accompanying commentary
                                </li>
                                <li>a comment on the appraisal discussion informing relates to all aspects of the
                                    doctor's scope
                                    of work.</li>
                            </ul>
                        </div>
                        <div class="form-input form-input-large">
                            {{ $appraisalData['ad_comments'] ?? '' }}
                        </div>
                    </div>
                </div>

            </div>
