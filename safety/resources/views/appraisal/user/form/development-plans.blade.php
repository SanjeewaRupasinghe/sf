@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Personal development plans and their review')

@section('content')
    <div class="content-header">
        <h1>Section 6 of 21</h1>
        <h2>Personal development plans and their review</h2>
    </div>

    @include('common.alert')

    @php
        $content = json_decode(Auth::user()->content);

        $_generalComments = '';
        $_appraisersComments = '';
        $_jobRoles = '';
        $_jobRolesCount = 0;

        try {
            if ($content->developmentPlans) {
                $_generalComments = $content->developmentPlans->generalComments;
                $_appraisersComments = $content->developmentPlans->appraisersComments;
                $_jobRoles = $content->developmentPlans->jobRoles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    @endphp

    <form action="{{ route('appraisal.user.development-plans.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content-body">

            <p class="text-primary">Your personal development plan and progression towards achieving the actions you set
                yourself
                are an important discussion area at the appraisal meeting. Please use this space to describe your progress
                towards achieving the actions and goals set in your last appraisal.</p>
            <p>If you already have this information in another format, you can upload a copy here:
            </p>
            <input type="file" class="form-control d-inline-block w-auto ms-2" id="attachmentFile1" name="attachmentFile"
                accept=".pdf,.doc,.docx">
            <button type="button" class="btn btn-primary btn-sm ms-2"
                onclick="handleAttachment('attachmentFile1', 'attachmentStatus1')">Attach</button>
            <div id="attachmentStatus1" class="mt-2"></div>

            <div class="mt-3">
                <p>If you do not have a reflection document or similar, please use this table to update your appraiser on
                    your
                    progress against each of the items listed in your last personal development plan.
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('progressHelp')"></i>
            </div>

            <div id="progressHelp" class="help-text">
                <p class="mb-2">This information should correspond with the information you entered in to last year's
                    appraisal in Section 18. You may wish to copy and paste that information here.</p>
                <p class="mb-2">The 'Detail of item' column should cover the following four areas: 1 Learning or
                    development
                    need; 2 Agreed action(s) or goal(s); 3 Timescale for completion; 4 How I intend to demonstrate success.
                </p>
                <p class="mb-0">You do not have to have achieved all your planned items, but if you have not completed one
                    or
                    more, it is important that you describe why this has occurred. It will be helpful to indicate if you
                    wish to
                    carry forward to next year's PDP any items you have not completed.</p>
            </div>

            <div class="mt-3">
                <p class="mb-1">About 'Relevant job title or role':
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('roleHelp')"></i>
                </p>
                <div id="roleHelp" class="help-text">
                    This list is created from your entries in the 'Scope of Work' table in Section 4.
                    Select
                    one, or choose 'Cross role' if the item is relevant to more than one of your roles.
                </div>
            </div>

            <!-- Dynamic Table -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">Relevant job title or role</th>
                            <th style="width: 40%;">Detail of item (You may paste this information from the equivalent cell
                                of
                                your agreed PDP table from your last appraisal)</th>
                            <th style="width: 30%;">Review of progress on this item</th>
                            <th style="width: 10%;">Add row</th>
                        </tr>
                    </thead>
                    <tbody id="dynamicTableBody">
                        @if ($_jobRolesCount > 0)
                            @for ($i = 0; $i < $_jobRolesCount; $i++)
                                <tr>
                                    <td>
                                        <select class="form-select" name="jobTitle[]">
                                            <option value="Please select...">Please select...</option>
                                            <option value="Cross Role" @if($_jobRoles[$i]->jobTitle == 'Cross Role') selected @endif>Cross Role</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control" rows="3" name="lastAppraisal[]">{{$_jobRoles[$i]->lastAppraisal}}</textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" rows="3" name="progress[]">{{$_jobRoles[$i]->progress}}</textarea>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm mb-1"
                                            onclick="removeRow(this)">-</button><br>
                                        <button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button>
                                    </td>
                                </tr>
                            @endfor
                        @endif

                        <tr>
                            <td>
                                <select class="form-select" name="jobTitle[]">
                                    <option value="Please select...">Please select...</option>
                                    <option value="Cross Role">Cross Role</option>
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" rows="3" name="lastAppraisal[]"></textarea>
                            </td>
                            <td>
                                <textarea class="form-control" rows="3" name="progress[]"></textarea>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                    onclick="removeRow(this)">-</button><br>
                                <button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Comments Section -->
            <div class="mt-4">
                <label for="generalComments" class="form-label">If you would like to make any general comments to your
                    appraiser
                    about last year's progress, or anything else that was discussed last year for progression this year,
                    please
                    do so here.</label>
                <textarea class="form-control bg-light" id="generalComments" rows="4" name="generalComments">{{ $_generalComments }}</textarea>
            </div>

            <div class="mb-4">
                <label for="appraisersComments" class="form-label">
                    <strong>Appraiser's comments</strong>
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentHelp')"></i>
                </label>
                <div id="commentHelp" class="help-text">
                    <p class="mb-2">'Appraiser's comments' boxes appear at the end of a number of sections in this form.
                        Appraisers are encouraged to record their comments here, which are transcribed verbatim into the
                        summary
                        in Section 19. Appraisers should therefore construct their comments accordingly. Please note if you
                        edit
                        the text again in Section 19, it will automatically change the text in the corresponding section.
                    </p>
                    <p class="mb-2"><strong>Comments should include:</strong></p>
                    <ul class="mb-2">
                        <li style="border-bottom: none;">an overview of the supporting information and the doctor's
                            accompanying commentary.</li>
                        <li style="border-bottom: none;">a comment on the extent to which the supporting information relates
                            to all aspects of the
                            doctor's
                            scope of work.</li>
                </div>
                <textarea class="form-control" id="appraisersComments" name="appraisersComments" rows="5">{{ $_appraisersComments }}</textarea>
            </div>

            <div class="alert alert-warning">
                <strong>Note for appraiser:</strong> Text entered here will mirror automatically between the corresponding
                'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal discussion' boxes.
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.annual-appraisals')}}">
                    < Previous section</a>
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.cpd')}}">Next section ></a>
            </div>

        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle file attachment
        function handleAttachment(fileInputId, statusDivId) {
            const fileInput = document.getElementById(fileInputId);
            const statusDiv = document.getElementById(statusDivId);

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                statusDiv.innerHTML =
                    `<div class="alert alert-success">File "${file.name}" attached successfully (${(file.size / 1024).toFixed(1)} KB)</div>`;
            } else {
                statusDiv.innerHTML = `<div class="alert alert-warning">Please select a file to attach.</div>`;
            }
        }

        // Handle file input change
        document.getElementById('attachmentFile1').addEventListener('change', function() {
            const statusDiv = document.getElementById('attachmentStatus1');
            if (this.files.length > 0) {
                statusDiv.innerHTML = `<div class="alert alert-info">File selected: ${this.files[0].name}</div>`;
            }
        });

        // Add new row to the table
        function addRow() {
            const tableBody = document.getElementById('dynamicTableBody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
               <tr>
                    <td>
                        <select class="form-select" name="jobTitle[]">
                            <option value="Please select...">Please select...</option>
                            <option value="Cross Role">Cross Role</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control" rows="3" name="lastAppraisal[]"></textarea>
                    </td>
                    <td>
                        <textarea class="form-control" rows="3" name="progress[]"></textarea>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm mb-1"
                            onclick="removeRow(this)">-</button><br>
                        <button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button>
                    </td>
                </tr>
            `;

            tableBody.appendChild(newRow);
        }

        // Remove row from the table
        function removeRow(button) {
            const tableBody = document.getElementById('dynamicTableBody');
            if (tableBody.children.length > 1) {
                button.closest('tr').remove();
            } else {
                alert('At least one row must remain in the table.');
            }
        }
    </script>
@endsection
