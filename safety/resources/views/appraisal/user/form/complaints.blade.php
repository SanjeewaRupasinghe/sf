@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Review of complaints and compliments')

@section('content')
    <div class="content-header">
        <h1>Section 11 of 21</h1>
        <h2>Review of complaints and compliments
            <i class="fas fa-question-circle help-icon text-white" onclick="toggleHelp('mainHelp')"></i>
        </h2>
    </div>

    @include('common.alert')

    @php
        $content = json_decode(Auth::user()->content);

        $_complaintsStatus = '';
        $_actionsTaken = '';
        $_feedback = '';
        $_practice = '';
        $_comments = '';
        $_jobRolesCount = 0;

        try {
            if ($content->complaints) {
                $_complaintsStatus = $content->complaints->complaintsStatus;
                $_actionsTaken = $content->complaints->actionsTaken;
                $_feedback = $content->complaints->feedback;
                $_practice = $content->complaints->practice;
                $_comments = $content->complaints->comments;
                $_jobRoles = $content->complaints->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }
        $LOCKDOWN_STATUS = Auth::user()->status == 0 ? false : true;
    @endphp

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

    <form @if ($LOCKDOWN_STATUS) action="{{ route('appraisal.user.complaints.submit') }}" @endif method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="content-body">

            <div id="mainHelp" class="help-text" style="display: none;">
                <p>
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
                </p>
            </div>

            <p>
                Complaints and compliments are the sixth type of supporting information doctors will use to demonstrate that
                they are continuing to meet the principles and values set out in Good Medical practice Please use the help
                bubbles to access more information on what you should be providing in this section.
            </p>

            <p>
                Complaints
            </p>

            <!-- Conditional Question -->
            <div class="mb-3">
                <label class="form-label"><strong>Please select one of the following:</strong></label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="complaintsStatus" id="conditionalQuestionIf"
                            value="I have not been named in any complaints in the last year."
                            @if ($_complaintsStatus == 'I have not been named in any complaints in the last year.') checked @endif>
                        <label class="form-check-label" for="conditionalQuestionIf">
                            <strong>I have not</strong> been named in any complaints in the last year.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="complaintsStatus" id="conditionalQuestionElse"
                            value="I have been named in one or more significant events in the last year."
                            @if ($_complaintsStatus == 'I have been named in one or more significant events in the last year.') checked @endif>
                        <label class="form-check-label" for="conditionalQuestionElse">
                            <strong>I have</strong> been named in one or more significant events in the last year.
                        </label>
                    </div>
                </div>
            </div>

            <p>
                If you have not been involved personally in a complaint but wish to share learning of some that you were
                aware of, or if you have carried clinical or
                managerial responsibility for any complaints please record this under Section 8: Quality improvement
                activity.
            </p>

            <!-- Conditional Yes Section -->
            <div id="conditionalQuestion" style="display: none;">
            </div>

            <!-- Conditional No Section -->
            <div id="conditionalQuestionElseSection"
                @if ($_complaintsStatus == 'I have been named in one or more significant events in the last year.') style="display: block;" @else style="display: none;" @endif>

                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Please provide a brief summary of the complaint(s) including your participation in the investigation
                        and response and any actions taken</p>
                    <textarea class="form-control" rows="6" name="actionsTaken">{{ $_actionsTaken }}</textarea>
                </div>

            </div>

            <div>
                <p>
                    Compliments
                </p>


                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Compliments are another important piece of feedback. You may wish to detail here any compliments that
                        you have received to be discussed in your appraisal.</p>
                    <textarea class="form-control" rows="6" name="feedback">{{ $_feedback }}</textarea>
                </div>
            </div>

            <div class="mb-3">

                <p>
                    Attachments relating to complaints or compliments are generally not encouraged due to potential data
                    protection issues however if you wish to attach
                    documents as reference, you may do so using the table below. You are reminded that patients, colleagues
                    and other third parties should not be
                    identifiable. If in doubt, you should consult your local organisation’s information management guidance.
                    <br>
                    <br>
                    Please also be mindful of attachment sizes and the limitations of this form.
                </p>

                <p><strong>About 'Relevant job title or role':
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('lastAppHelp')"></i>
                </p>
            </div>

            <div id="lastAppHelp" class="help-text">
                This list is created from your entries in the ‘Scope of Work’ table in Section 4. Select one, or choose
                ‘Cross role’ if the item is relevant to more than
                one of your roles
            </div>

            <!-- CPD Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Relevant job title or role</th>
                            <th>Date and brief description of activity provided as supporting information</th>
                            <th>Outcome of learning and reflection / action taken and next steps</th>
                            <th>Supporting information location</th>
                            <th>Attachment</th>
                            <th>Add new row</th>
                        </tr>
                    </thead>
                    <tbody id="cpdTableBody">
                        @if ($_jobRolesCount > 0)
                            @for ($i = 0; $i < $_jobRolesCount; $i++)
                                <tr>
                                    <td>
                                        <select class="form-select form-select-sm" name="roles[]">
                                            <option>Please select...</option>
                                            <option value="Cross Role" @if ($_jobRoles[$i]->roles == 'Cross Role') selected @endif>
                                                Cross Role</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]">{{ $_jobRoles[$i]->dateAndBrief }}</textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control form-control-sm" rows="2" name="outcomes[]">{{ $_jobRoles[$i]->outcomes }}</textarea>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                                            <option>Please select...</option>
                                            <option @if ($_jobRoles[$i]->supportingInfo == 'Attached') selected @endif value="Attached">
                                                Attached</option>
                                            <option @if ($_jobRoles[$i]->supportingInfo == 'Email to appraiser') selected @endif
                                                value="Email to appraiser">Email to appraiser</option>
                                            <option @if ($_jobRoles[$i]->supportingInfo == 'Provided separately') selected @endif
                                                value="Provided separately">Provided separately</option>
                                            <option @if ($_jobRoles[$i]->supportingInfo == 'Not available') selected @endif
                                                value="Not available">
                                                Not available</option>
                                        </select>
                                    </td>
                                    <td class="attachment-cell">
                                        <div class="checkbox-log">
                                            @if ($_jobRoles[$i]->supportingInfo == 'Attached')
                                                <input type="file" class="form-control form-control-sm"
                                                    name="supportingInfoAttachment_{{ $i }}"
                                                    accept=".pdf,.doc,.docx,.jpg,.png">
                                            @else
                                                <input type="checkbox" class="form-check-input me-1"
                                                    name="supportingInfoLog_{{ $i }}"
                                                    @if ($_jobRoles[$i]->log) checked @endif value="on">
                                                <span class="badge bg-secondary">Log</span>
                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        @if ($LOCKDOWN_STATUS)
                                            <button type="button" class="btn btn-danger btn-sm remove-row-btn">-</button>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        @if ($LOCKDOWN_STATUS)
                            <tr>
                                <td>
                                    <select class="form-select form-select-sm" name="roles[]">
                                        <option>Please select...</option>
                                        <option value="Cross Role">Cross Role</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"></textarea>
                                </td>
                                <td>
                                    <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"></textarea>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                                        <option>Please select...</option>
                                        <option value="Attached">Attached</option>
                                        <option value="Email to appraiser">Email to appraiser</option>
                                        <option value="Provided separately">Provided separately</option>
                                        <option value="Not available">Not available</option>
                                    </select>
                                </td>
                                <td class="attachment-cell">
                                    <div class="checkbox-log">
                                        <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_0[]"
                                            value="on">
                                        <span class="badge bg-secondary">Log</span>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row-btn">+</button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- CPD Table Section -->

            <div id="">

                <!-- Practice Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2">
                            Please use the box below to provide a commentary on how the review of your complaints and
                            compliments has supported the areas described in
                            your scope of work and demonstrates that you are continuing to meet the requirements of Good
                            Medical Practice.
                        </h6>
                    </div>
                    <textarea class="form-control" rows="4" name="practice">{{ $_practice }}</textarea>

                </div>
                <!-- Appraiser's Comments Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong></h6>
                    </div>
                    <textarea class="form-control" rows="4" name="comments"
                        placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 10 Summary of the appraisal discussion' boxes.">{{ $_comments }}</textarea>

                </div>
            </div>

        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.feedback') }}">
                < Previous section</a>
                    @if ($LOCKDOWN_STATUS)
                        <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                    @endif
                    <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.achievements') }}">Next section
                        ></a>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle royal college radio button changes
        document.querySelectorAll('input[name="complaintsStatus"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('conditionalQuestion');
                const noSection = document.getElementById('conditionalQuestionElseSection');

                if (this.value === 'I have not I have not been named in any complaints in the last year.') {
                    yesSection.style.display = 'block';
                    noSection.style.display = 'none';
                } else {
                    yesSection.style.display = 'none';
                    noSection.style.display = 'block';
                }
            });
        });

        // // Handle CPD diary radio button changes (for royal college = no)
        // document.querySelectorAll('input[name="cpdDiary"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const attachedText = document.getElementById('attachedText');
        //         if (this.value === 'yes') {
        //             attachedText.style.display = 'block';
        //         } else {
        //             attachedText.style.display = 'none';
        //         }
        //     });
        // });

        // // Handle additional CPD radio button changes (for royal college = yes)
        // document.querySelectorAll('input[name="additionalCPD"]').forEach(radio => {
        //     radio.addEventListener('change', function() {
        //         const tableSection = document.getElementById('cpdTableSection');
        //         if (this.value === 'yes') {
        //             tableSection.style.display = 'block';
        //         } else {
        //             tableSection.style.display = 'none';
        //         }
        //     });
        // });

        // Handle location select changes
        function handleLocationChange(selectElement) {
            const row = selectElement.closest('tr');
            const rCount = Array.from(row.parentElement.children).indexOf(row) + 1;
            const attachmentCell = row.querySelector('.attachment-cell');

            if (selectElement.value === 'Attached') {
                attachmentCell.innerHTML =
                    `<input type="file" class="form-control form-control-sm" name="supportingInfoAttachment_${rCount}" accept=".pdf,.doc,.docx,.jpg,.png">`;
            } else {
                attachmentCell.innerHTML = `
                    <div class="checkbox-log">
                        <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_${rCount}">
                        <span class="badge bg-secondary">Log</span>
                    </div>
                `;
            }
        }

        // Add event listeners to existing location selects
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('location-select')) {
                handleLocationChange(e.target);
            }
        });

        // // Calculate total credits
        // function calculateTotal() {
        //     const creditInputs = document.querySelectorAll('.credit-input');
        //     let total = 0;

        //     creditInputs.forEach(input => {
        //         const value = parseFloat(input.value) || 0;
        //         total += value;
        //     });

        //     document.getElementById('totalCredits').textContent = total.toFixed(1);
        // }

        // // Add event listeners for credit calculation
        // document.addEventListener('input', function(e) {
        //     if (e.target.classList.contains('credit-input')) {
        //         calculateTotal();
        //     }
        // });

        // Add new row functionality
        document.addEventListener('click', function(e) {

            let rCount = document.querySelectorAll('#cpdTableBody tr').length + 1;

            if (e.target.classList.contains('add-row-btn')) {
                const tbody = document.getElementById('cpdTableBody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>
                        <select class="form-select form-select-sm" name="roles[]">
                            <option>Please select...</option>
                            <option value="Cross Role">Cross Role</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]"></textarea>
                    </td>
                    <td>
                        <textarea class="form-control form-control-sm" rows="2" name="outcomes[]"></textarea>
                    </td>
                    <td>
                        <select class="form-select form-select-sm location-select" name="supportingInfo[]">
                            <option>Please select...</option>
                            <option value="Attached">Attached</option>
                            <option value="Email to appraiser">Email to appraiser</option>
                            <option value="Provided separately">Provided separately</option>
                            <option value="Not available">Not available</option>
                        </select>
                    </td>
                    <td class="attachment-cell">
                        <div class="checkbox-log">
                            <input type="checkbox" class="form-check-input me-1" name="supportingInfoLog_${rCount}" value="on">
                            <span class="badge bg-secondary">Log</span>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row-btn">-</button>
                    </td>
                `;

                tbody.appendChild(newRow);
            }

            // Remove row functionality
            // if (e.target.classList.contains('remove-row-btn')) {
            //     e.target.closest('tr').remove();
            //     calculateTotal();
            // }
        });
    </script>
@endsection
