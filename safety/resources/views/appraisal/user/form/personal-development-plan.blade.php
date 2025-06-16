@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'The agreed personal development plan')

@section('content')
    <div class="content-header">
        <h1>Section 18 of 21</h1>
        <h2>The agreed personal development plan
            <i class="fas fa-question-circle help-icon text-white" onclick="toggleHelp('mainHelp')"></i>
        </h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        $_roles = '';
        $_rolesCount = 0;

        try {
            if ($content->personalDevelopmentPlanInfo) {
                $_roles = $content->personalDevelopmentPlanInfo->roles;

                try {
                    $_rolesCount = count($_roles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }
        $LOCKDOWN_STATUS = Auth::user()->status == 0 ? false : true;
    @endphp

    @include('common.alert')

    @if (!$LOCKDOWN_STATUS)
        <div class="alert alert-danger" role="alert">
            This profile is locked. You can't change anything.
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            If you made any changes, please click the "Save Form" button to save your details. Otherwise, your changes will
            not be saved.
        </div>
    @endif

    <form @if ($LOCKDOWN_STATUS) action="{{ route('appraisal.user.development-plan.submit') }}" @endif
        method="POST">
        @csrf

        <div class="content-body">

            <div id="mainHelp" class="help-text" style="display: none;">
                <p>You may wish to list some ideas in this section which can be discussed and agreed at the appraisal
                    discussion.</p>
                <p>The personal development plan is an itemised list of your key development objectives for the coming year.
                    Important areas to cover include actions to maintain skills and levels of service to patients, actions
                    to develop or acquire new skills and actions to improve existing practice.</p>
                <ul>
                    <li><strong>Relevant role</strong> - if the agreed action or goal does not apply specifically to one
                        particular role, select 'Cross-role'.</li>
                    <li><strong>Learning or development need; Agreed action(s) or goal(s); Timescale for completion</strong>
                        should detail your learning need and how this will be addressed how you and your appraiser have
                        agreed this need will be addressed, such as the actions you will take and the resources required.
                        There are several models for approaching the construction of a PDF item. The most well-known of
                        these is SMART – the item should be Specific, Measurable, Achievable, Realistic and Timely. It is
                        particularly helpful to include in your description the date by which you aim to have completed the
                        item.</li>
                    <li><strong>How do I intend to demonstrate success</strong> that the action or goal has been addressed.
                        Detail how you will evaluate whether participation in this action/goal actually did result in
                        changes and how you intend to change your practice as a result of this activity.</li>
                </ul>
                <p>You may wish to copy and paste this information into Section 6 of next year's appraisal.</p>
            </div>

            <div>
                The personal development plan is a record of the agreed personal and/or professional development needs to be
                pursued throughout the following year, as agreed in the appraisal discussion between the doctor and the
                appraiser.
            </div>

            <h5>About 'Relevant job title or role': <i class="fas fa-question-circle help-icon"
                    onclick="toggleHelp('roleHelp')"></i></h5>
            <div id="roleHelp" class="help-text" style="display: none;">
                This list is created from your entries in the 'Scope of Work' table in Section 4. Select one, or choose
                'Cross role' if the item is relevant to more than one of your roles.
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        @if ($_rolesCount > 0)
                            @for ($i = 0; $i < $_rolesCount; $i++)
                                <tr>
                                    <th>Relevant job title or role</th>
                                    <th>Detail of item (should be short and concise)</th>
                                    <th>Add row</th>
                                </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-select" name="role[]">
                                    <option>Please select...</option>
                                    <option value="Cross Role" @if ($_roles[$i]->role == 'Cross Role') selected @endif>Cross Role
                                    </option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="8" name="detail[]">{{ $_roles[$i]->detail }}</textarea>
                            </td>
                            <td>
                                @if ($LOCKDOWN_STATUS)
                                    <div class="btn btn-success btn-sm" onclick="addRowToFirstTable()">+</div>
                                @endif
                            </td>
                        </tr>
                        @endfor
                        @endif
                        @if ($LOCKDOWN_STATUS)
                            <tr>
                                <th>Relevant job title or role</th>
                                <th>Detail of item (should be short and concise)</th>
                                <th>Add row</th>
                            </tr>
                            </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-select" name="role[]">
                                    <option>Please select...</option>
                                    <option value="Cross Role">Cross Role</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="8" name="detail[]">1. Learning or development need:

2. Agreed action(s) or goal(s):

3. Timescale for completion:

4. How I intend to demonstrate success:
</textarea>
                            </td>
                            <td>
                                <div class="btn btn-success btn-sm" onclick="addRowToFirstTable()">+</div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between">

                <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.checklist') }}">
                    < Previous section</a>
                        @if ($LOCKDOWN_STATUS)
                            <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        @endif
                        <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.summary') }}">Next section ></a>

            </div>


        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function addRowToFirstTable() {
            const tbody = document.querySelector('.table tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                 <td>
                                <select class="form-select" name="role[]">
                                    <option>Please select...</option>
                                    <option value="Cross Role">Cross Role</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="8" name="detail[]">1. Learning or development need:

2. Agreed action(s) or goal(s):

3. Timescale for completion:

4. How I intend to demonstrate success:
</textarea>
                            </td>
                <td><div class="btn btn-success btn-sm" onclick="addRowToFirstTable()">+</div></td>
            `;
            // Insert before the last row (which contains the add button)
            tbody.insertBefore(newRow, tbody.lastElementChild);
        }

        // function addRowToMainTable() {
        //     const tbody = document.querySelectorAll('.table tbody')[1]; // Get the second table's tbody
        //     const newRow = document.createElement('tr');
        //     newRow.innerHTML = `
    //         <td>
    //             <select class="form-select">
    //                 <option>Please select...</option>
    //             </select>
    //         </td>
    //         <td>
    //             <div class="bg-light p-2" style="min-height: 120px;">
    //                 <div class="text-danger fw-bold">1 Learning or development need:</div>
    //                 <div class="text-danger fw-bold">2 Agreed action(s) or goal(s):</div>
    //                 <div class="text-danger fw-bold">3 Timescale for completion:</div>
    //                 <div class="text-danger fw-bold">4 How I intend to demonstrate success:</div>
    //             </div>
    //         </td>
    //         <td class="bg-danger">&nbsp;</td>
    //     `;
        //     // Insert before the last row (which contains the add button)
        //     tbody.insertBefore(newRow, tbody.lastElementChild);
        // }
    </script>

@endsection
