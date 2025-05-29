<div>
    <div>
        <div class="section-header">
            Section 6 of 21
            <br>Personal development plans and their review
        </div>

        <div class="section-content">
            <div class="instruction-text">
                Your personal development plan and progression towards achieving the actions you set yourself are an
                important discussion area at the appraisal meeting. Please use this space to describe your progress
                towards achieving the actions and goals set in your last appraisal.
            </div>
            <label class="form-label">
                If you already have this information in another format, you can upload a copy here:
            </label>
            <label class="form-label">
                If you do not have a reflection document or similar, please use this table to update your appraiser on
                your progress against each of the items listed in your last personal development plan.
            </label>
            <div class="instruction-text">
                This information should correspond with the information you entered in to last year's appraisal in
                Section 18. You may wish to copy and paste that information here.
                <br><br>
                The 'Detail of item' column should cover the following four areas: 1 Learning or development need; 2
                Agreed action(s) or goal(s); 3 Timescale for completion; 4 How I intend to demonstrate success.
                <br><br>
                You do not have to have achieved all your planned items, but if you have not completed one or more, it
                is important that you describe why this has occurred. It will be helpful to indicate if you wish to
                carry forward to next year's PDP any items you have not completed.
            </div>
            <label class="form-label">
                About 'Relevant job title or role':
            </label>
            <div class="instruction-text">
                This list is created from your entries in the 'Scope of Work' table in Section 4. Select one, or choose
                'Cross role' if the item is relevant to more than one of your roles.
            </div>

            <div class="form-row">
                <table class="form-table">
                    <thead>
                        <tr>

                            <th>Relevant job title or role</th>
                            <th>Detail of item (You may paste this information from the
                                equivalent cell of your agreed PDP table from your last
                                appraisal)</th>
                            <th>Review of progress on this item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($appraisalData['dp_roles']) && is_array($appraisalData['dp_roles']))
                            @foreach ($appraisalData['dp_roles'] as $r)
                                <tr>
                                    <td>{{ $r->jobTitle ?? '' }}</td>
                                    <td>{{ $r->lastAppraisal ?? '' }}</td>
                                    <td>{{ $r->progress ?? '' }}</td>
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
                If you would like to make any general comments to your appraiser about last year's progress, or anything
                else that was discussed last year for progression this year, please do so here.
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['ws_relationship'] ?? '' }}
            </div>
            <label class="form-label">
                Appraiser's comments
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['ws_relationship'] ?? '' }}
            </div>
        </div>
    </div>

</div>
