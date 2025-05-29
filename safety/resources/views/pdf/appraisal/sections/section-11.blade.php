<div>
    <div>
        <div class="section-header">
            Section 11 of 21
            <br>Review of complaints and compliments
        </div>

        <div class="section-content">

            <div class="instruction-text">
             Please ensure any personal/patient identifiable information is removed.
                    <br>
                    <br>
                    GMC guidance is that doctors must view complaints as another form of valuable patient feedback, from
                    which learning and improvements to practice
                    can be derived. <a
                        href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/">
                        Further guidance on feedback from colleagues and patients can be found here.</a>
                    <br>
                    <br>
                    You must present all complaints in which you have been involved and which have been addressed at an
                    organisational level (practice, departmental
                    or higher).
                    <br>
                    <br>
                    Where you have not been involved in any complaints at an organisational level it may be acceptable for
                    this section to be blank. However if you work
                    in an environment in which there are no effective complaints procedures, you must remember that you have
                    a professional duty to be receptive to
                    complaints and to respond appropriately, and to present all complaints about your professional practice
                    within this section.
                    <br>
                    <br>
                    Bear in mind that the purpose of presenting a complaint at your appraisal is not to adjudicate on the
                    substance of the complaint, but to provide an
                    opportunity to reflect and develop insight and learning for your future practice.
                    <br>
                    <br>
                    If you have managerial responsibility for complaints in your organisation, you should present this,
                    along with your reflection on your effectiveness in
                    this regard within the Quality Improvement Activity section of your appraisal submission.
                    <br>
                    <br>
                    Academy guidance encourages the presentation of compliments at appraisal, as they too, provide a source
                    of learning and reinforcement.
                    <br>
                    <br>
                    Due to data protection issues, the attaching of complaints and compliments to your appraisal submission
                    is not encouraged. It is recommended that
                    you refer to them and provide your reflection on them in your appraisal submission but provide any
                    supporting documentation separately to your
                    appraiser.
            </div>

             <p>
                Complaints and compliments are the sixth type of supporting information doctors will use to demonstrate that
                they are continuing to meet the principles and values set out in Good Medical practice Please use the help
                bubbles to access more information on what you should be providing in this section.
            </p>

            <p>
                Complaints
            </p>
            
            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Please select one of the following:</span>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['com_complaintsStatus']) && $appraisalData['com_complaintsStatus'] == 'I have not I have not been named in any complaints in the last year.' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button"></span> <strong>I have not</strong> I have not been named in any complaints in the last year.
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['com_complaintsStatus']) && $appraisalData['com_complaintsStatus'] == 'I have been named in one or more significant events in the last year.' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button radio-checked"></span> <strong>I have</strong> been named in one or more significant events in the last year.
                </div>
            </div>

            <!-- ELSE -->
            @if (isset($appraisalData['com_complaintsStatus']))
                @if ($appraisalData['com_complaintsStatus'] == 'I have been named in one or more significant events in the last year.')
                    <label class="form-label">
                        Please provide a brief summary of the complaint(s) including your participation in the investigation
                        and response and any actions taken
                    </label>
                    <div class="form-input form-input-large">
                        {{ $appraisalData['com_actionsTaken'] ?? '' }}
                    </div>
                    @endif
                    @endif
                    <!-- END ELSE -->
                    <label class="form-label">
                       Compliments are another important piece of feedback. You may wish to detail here any compliments that
                        you have received to be discussed in your appraisal.
                    </label>
                    <div class="form-input form-input-large">
                        {{ $appraisalData['com_feedback'] ?? '' }}
                    </div>

            <label class="form-label">
                Attachments relating to complaints or compliments are generally not encouraged due to potential data
                    protection issues however if you wish to attach
                    documents as reference, you may do so using the table below. You are reminded that patients, colleagues
                    and other third parties should not be
                    identifiable. If in doubt, you should consult your local organisation’s information management guidance.
                    <br>
                    <br>
                    Please also be mindful of attachment sizes and the limitations of this form.
            </label>
            <label class="form-label">
                About 'Relevant job title or role':
            </label>
            <div class="instruction-text">
                This list is created from your entries in the ‘Scope of Work’ table in Section 4. Select one, or choose
                ‘Cross role’ if the item is relevant to more than
                one of your roles
            </div>
            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Date and brief description of activity provided as supporting information</th>
                            <th>Outcome of learning and reflection / action taken and next steps</th>
                            <th>Supporting information location</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($appraisalData['com_roles']) && is_array($appraisalData['com_roles']))
                            @foreach ($appraisalData['com_roles'] as $r)
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
                                                @if ($lg == true)
                                                    Logged
                                                @endif
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
            <div class="form-input form-input-large">
                {{ $appraisalData['com_comments'] ?? '' }}
            </div>
        </div>
    </div>

</div>
