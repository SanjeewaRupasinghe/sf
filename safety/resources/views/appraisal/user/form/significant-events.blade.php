@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Significant events')

@section('content')
    <div class="content-header">
        <h1>Section 9 of 21</h1>
        <h2>Significant events
            <i class="fas fa-question-circle help-icon text-white" onclick="toggleHelp('mainHelp')"></i>
        </h2>
    </div>

    @include('common.alert')

    @php
        $content = json_decode(Auth::user()->content);

        $_sigEvents = '';
        $_practice = '';
        $_comments = '';
        $_jobRolesCount = 0;

        try {
            if ($content->significantEvents) {
                $_sigEvents = $content->significantEvents->sigEvents;
                $_practice = $content->significantEvents->practice;
                $_comments = $content->significantEvents->comments;
                $_jobRoles = $content->significantEvents->roles;

                try {
                    $_jobRolesCount = count($_jobRoles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    @endphp

    <form action="{{ route('appraisal.user.significant-events.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content-body">
            <div id="mainHelp" class="help-text">
                The GMC states that a significant event (also known as an untoward, critical or patient safety incident) is
                any unintended or unexpected event, which
                could or did lead to harm of one or more patients.
                <br><br>
                <a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/further-info/"
                    target="_blank">
                    Further guidance on significant events as supporting information is available here.</a> Please also
                ensure you
                are familiar with your organisation's local
                processes and agreed thresholds for recording incidents.
                <br><br>
                In primary care, significant event audit has evolved as an important tool in improving practice. Where these
                have been undertaken and don’t meet
                the GMC definition above, they could be included in Section 8 as supporting information for quality
                improvement activity.
                <br><br>
                Please note:
                <ul>
                    <li>You do not need to list any significant events where your only involvement was in the investigation.
                    </li>
                    <li>It is not the appraiser's role to conduct investigations into serious events. Organisational
                        clinical governance systems and other management
                        processes are put in place to deal with these situations.</li>
                    <li>Please ensure you are familiar with your organisation's local processes and agreed thresholds for
                        recording significant events.</li>
                    <li>If you work in an environment in which the capturing and analysis of such events are not part of
                        local procedures, you must still note and include all
                        events which meet the definition above, whether or not this has been addressed in an official
                        capacity.</li>
                    <li>It is acceptable for this section to be blank if no such events have occurred since your last
                        appraisal.</li>
                </ul>
            </div>
            <p>
                Significant events are discussed as the third type of supporting information doctors will use to demonstrate
                that they are continuing to meet the principles and values set out in Good Medical Practice. Please use the
                help bubbles to access more information on what you should be providing in this section.
            </p>

            <!-- Conditional Question -->
            <div class="mb-3">
                <label class="form-label"><strong>Please select one of the following:</strong></label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="significantEvents" id="conditionalQuestionIf"
                            value="I have not been named in any significant events in the last year."
                            @if ($_sigEvents == 'I have not been named in any significant events in the last year.') checked @endif>
                        <label class="form-check-label" for="conditionalQuestionIf">
                            <strong>I have not</strong> been named in any significant events in the last year.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="significantEvents" id="conditionalQuestionElse"
                            value="I have been named in one or more significant events in the last year."
                            @if ($_sigEvents == 'I have been named in one or more significant events in the last year.') checked @endif>
                        <label class="form-check-label" for="conditionalQuestionElse">
                            <strong>I have</strong> been named in one or more significant events in the last year.
                        </label>
                    </div>
                </div>
            </div>

            <p>
                This section is specifically for recording your personal involvement in significant events. The GMC defines
                these as 'events which did or could have led to patient harm'. They include Serious Untoward Incidents
                (SUIs) and Serious Incidents Requiring Investigation (SIRIs) or their equivalent. If you have not been named
                in any significant events but wish to share learning of some that you were aware of, or if you have carried
                managerial responsibility for any significant events, please record this under Section 8 Quality improvement
                activity. Please note: you do not need to include those where your only involvement was in the investigation
                of the significant event.
            </p>

            <!-- Conditional Yes Section -->
            <div id="conditionalQuestion" style="display: none;">
            </div>

            <!-- Conditional No Section -->
            <div id="conditionalQuestionElseSection"
                @if ($_sigEvents == 'I have been named in one or more significant events in the last year.') style="display: block;" @else style="display: none;" @endif>
                <p>
                    Attachments relating to significant events are generally not encouraged due to potential data protection
                    issues. However if you wish to attach documents as reference, you may do so using the table below.
                    <br>
                    <br>
                    You are reminded that patients, colleagues and other third parties should not be identifiable. If in
                    doubt, you should consult your organisation's information management guidance.
                </p>

                <div class="mb-3">
                    <p><strong>About 'Relevant job title or role':
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('roleeHelp')"></i>
                    </p>
                </div>

                <div id="roleeHelp" class="help-text">
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
                                                <option value="Cross Role"
                                                    @if ($_jobRoles[$i]->roles == 'Cross Role') selected @endif>Cross Role</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea class="form-control form-control-sm" rows="2" name="dateAndBrief[]">{{ $_jobRoles[$i]->dateAndBrief }}</textarea>
                                        </td>
                                        <td>
                                            <textarea class="form-control form-control-sm" rows="2" name="outcomes[]">{{ $_jobRoles[$i]->outcomes }}</textarea>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm location-select"
                                                name="supportingInfo[]">
                                                <option>Please select...</option>
                                                <option @if ($_jobRoles[$i]->supportingInfo == 'Attached') selected @endif value="Attached">
                                                    Attached</option>
                                                <option @if ($_jobRoles[$i]->supportingInfo == 'Email to appraiser') selected @endif
                                                    value="Email to appraiser">Email to appraiser</option>
                                                <option @if ($_jobRoles[$i]->supportingInfo == 'Provided separately') selected @endif
                                                    value="Provided separately">Provided separately</option>
                                                <option @if ($_jobRoles[$i]->supportingInfo == 'Not available') selected @endif
                                                    value="Not available">Not available</option>
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
                                            <button type="button" class="btn btn-danger btn-sm remove-row-btn">-</button>
                                        </td>
                                    </tr>
                                @endfor
                            @endif
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
                        </tbody>
                    </table>

                    <p class="mt-2">
                        The GMC states that you should discuss significant events involving you at appraisal with a
                        particular emphasis on those that have led to specific change in practice or demonstrate learning.
                    </p>

                </div>
                <!-- CPD Table Section -->

                <!-- Commentary Section -->
                <div class="mt-4">
                    <p>Please use the box below to provide a commentary on how your CPD activities have supported
                        the areas described in your scope of work and demonstrate that you are continuing to meet the
                        requirements of Good Medical Practice.</p>
                    <textarea class="form-control" rows="6" name="practice">{{ $_practice }}</textarea>
                </div>

            </div>

            <div id="attachedText" class="mb-2 mt-2" style="display: none;">
                <p>Please attach record and provide reflection in the table below.</p>
            </div>

            <div id="">

                <!-- Appraiser's Comments Section -->
                <div class="mt-4">
                    <div class="d-flex align-items-center mb-2">
                        <h6 class="mb-0 me-2"><strong>Appraiser's comments</strong></h6>
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentHelp')"></i>
                    </div>
                    <div id="commentHelp" class="help-text">
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
                    <textarea class="form-control" rows="4" name="comments"
                        placeholder="Note for appraiser: Text entered here will mirror automatically between the corresponding 'Appraiser's comments' boxes and 'Section 10 Summary of the appraisal discussion' boxes.">{{ $_comments }}</textarea>

                </div>
            </div>

        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.quality-improvement')}}">
                < Previous section</a>
                    <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                    <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.feedback')}}">Next section ></a>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle royal college radio button changes
        document.querySelectorAll('input[name="significantEvents"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const yesSection = document.getElementById('conditionalQuestion');
                const noSection = document.getElementById('conditionalQuestionElseSection');

                if (this.value === 'I have not been named in any significant events in the last year.') {
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
