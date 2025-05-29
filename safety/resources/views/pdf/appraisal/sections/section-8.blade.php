<div>
    <div>
        <div class="section-header">
            Section 8 of 21
            <br>Quality improvement activity
        </div>

        <div class="section-content">
            <p>
                This is the second type of supporting information doctors will use to demonstrate that they are
                continuing
                to meet the principles and values set out in Good Medical Practice. Please use the help bubble above to
                access more information on what you should be providing in this section.
            </p>

            <p>
                This is where you should demonstrate that you regularly participate in activities that review and
                evaluate
                the quality of your work. You should complete this in relation to your complete scope of work, including
                any
                clinical, academic, managerial, leadership and educational roles that you undertake.
                <br>
                <br>
                Please detail below the quality improvement activities that you have undertaken or contributed to over
                the
                last year, including team-based activities where appropriate.
            </p>

            <div class="instruction-text">
                GMC guidance 'Supporting information for appraisal and revalidation' (March 2011) states that when
                discussing quality improvement activity at your
                appraisal, the following areas should be considered:
                <br>
                <strong>Active participation relevant to your work</strong>
                <br>
                You will need to demonstrate that you have actively participated in a quality improvement activity or a
                clinical audit relevant to your work.
                <br>
                Evaluate and reflect on the results
                <br>
                You need to demonstrate that you have evaluated and reflected on the results of the activity or audit.
                This might be through reflective notes about
                the implications of the results on your work, discussion of the results at peer-supervision,
                professional development or team meetings and
                contribution to your professional development.
                <br>
                Take action
                <br>
                You will need to demonstrate that you have taken appropriate action in response to the results. This
                might include the development of an action plan
                based on the results of the activity or audit, any change in practice following participation, and
                informing colleagues of the findings and any action
                required.
                <br>
                <strong>Closing the loop - demonstration of outcome or maintenance of quality</strong>
                <br>
                You should consider whether an improvement has occurred or if the activity demonstrated that good
                practice has been maintained. This should be
                through the results of a repeat of the activity or re-audit after a period of time where possible.
            </div>

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
                        @if (isset($appraisalData['qi_roles']) && is_array($appraisalData['qi_roles']))
                            @foreach ($appraisalData['qi_roles'] as $r)
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
                {{ $appraisalData['qi_practice'] ?? '' }}
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
                {{ $appraisalData['qi_comments'] ?? '' }}
            </div>
        </div>
    </div>

</div>
