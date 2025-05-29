<div>
    <div>
        <div class="section-header">
            Section 7 of 21
            <br>Continuing professional development (CPD)
        </div>

        <div class="section-content">
            <div class="instruction-text">
                In this section you should provide a record of both formal and informal learning that has taken place
                since
                your last appraisal. A royal college
                certification of CPD compliance may be attached, where available.<br>
                You should also provide commentary on your learning in support of your professional activities as
                detailed
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
                    Further information on the role of the medical royal colleges and faculties in revalidation,
                    including
                    links to each specialty can be found here
                </a>
            </div>
            <div class="instruction-text">
                This is the first type of supporting information doctors will use to demonstrate that they are
                continuing to
                meet the principles and values set out in
                Good Medical Practice. Please use the help bubble above to access more information on what you should be
                providing in this section.
            </div>
            <div style="margin-bottom: 15px">
                <span style="font-weight: bold">Has the name of your appraiser / responsible officer / designated
                    body changed since last year's appraisal?</span>
                <div class="radio-group">
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['cpd_royalCollege']) && $appraisalData['cpd_royalCollege'] == 'yes' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button"></span> Yes
                    </div>
                    <div class="radio-option">
                        <span
                            class="radio-button {{ isset($appraisalData['cpd_royalCollege']) && $appraisalData['cpd_royalCollege'] == 'no' ? 'radio-checked' : '' }}">o</span>
                        <span class="radio-button radio-checked"></span> No
                    </div>
                </div>
            </div>

            <!-- IF -->
            @if (isset($appraisalData['cpd_royalCollege']))
                @if ($appraisalData['cpd_royalCollege'] == 'yes')
                    <div style="margin-bottom: 15px">
                        <span style="font-weight: bold">Do you have an annual certificate to show you have participated
                            in
                            college or faculty CPD?</span>
                        <div class="radio-group">
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_annualCertificate']) && $appraisalData['cpd_annualCertificate'] == 'yes' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Yes
                            </div>
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_annualCertificate']) && $appraisalData['cpd_annualCertificate'] == 'no' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button radio-checked"></span> No
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px">
                        <span style="font-weight: bold">Do you have a diary, summary or list of additional CPD activity
                            that
                            you have participated in?</span>
                        <div class="radio-group">
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_additionalCPD']) && $appraisalData['cpd_additionalCPD'] == 'yes' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Yes
                            </div>
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_additionalCPD']) && $appraisalData['cpd_additionalCPD'] == 'no' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button radio-checked"></span> No
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <!-- END IF-->

            <!-- ELSE -->
            @if (isset($appraisalData['cpd_royalCollege']))
                @if ($appraisalData['cpd_royalCollege'] == 'no')
                    <div style="margin-bottom: 15px">
                        <span style="font-weight: bold">Do you have a diary, summary or list of CPD activity that you
                            have
                            participated in this year?</span>
                        <div class="radio-group">
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_cpdDiary']) && $appraisalData['cpd_cpdDiary'] == 'yes' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button"></span> Yes
                            </div>
                            <div class="radio-option">
                                <span
                                    class="radio-button {{ isset($appraisalData['cpd_cpdDiary']) && $appraisalData['cpd_cpdDiary'] == 'no' ? 'radio-checked' : '' }}">o</span>
                                <span class="radio-button radio-checked"></span> No
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <!-- END ELSE-->

            <!-- DIARY IF-->
            @if (isset($appraisalData['cpd_cpdDiary']))
                @if ($appraisalData['cpd_cpdDiary'] == 'yes')
                    Please attach record and provide reflection in the table below.
                @endif
            @endif
            <!-- END DIARY IF-->

            <p><strong>Instead of, or in support of, the above attachments you can also record your CPD below. There
                    is no need to duplicate what is written in your attachments.</strong></p>
            <p>Personal notes from CPD events are more useful than certificates of attendance or PowerPoint
                presentations. The latter can be large and less informative to your appraiser and should be
                logged/provided separately.</p>


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
                            <th>Credits</th>
                            <th>Supporting information location</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $creditTotal = 0;
                        @endphp
                        @if (isset($appraisalData['cpd_roles']) && is_array($appraisalData['cpd_roles']))
                            @foreach ($appraisalData['cpd_roles'] as $r)
                                <tr>
                                    <td>{{ $r->roles ?? '' }}</td>
                                    <td>{{ $r->dateAndBrief ?? '' }}</td>
                                    <td>{{ $r->outcomes ?? '' }}</td>
                                    <td>{{ $r->credit ?? '' }}</td>
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
                                            $creditTotal += $r->credit;
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
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>{{ $creditTotal }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        @else
                            <tr>
                                <td>&nbsp;</td>
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
                Please use the box below to provide a commentary on how your CPD activities have supported
                the areas described in your scope of work and demonstrate that you are continuing to meet the
                requirements of Good Medical Practice.
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['cpd_practice'] ?? '' }}
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
                {{ $appraisalData['cpd_comments'] ?? '' }}
            </div>
        </div>
    </div>

</div>
