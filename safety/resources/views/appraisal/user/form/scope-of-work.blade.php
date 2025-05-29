@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Work of Scope')

@section('content')
    <div class="content-header">
        <h1>Section 4 of 21</h1>
        <h2>Scope of work</h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        // dd($content);

        $_relationship = '';
        $_envisageNextYear = '';
        $_comment = '';
        $_rolesCount = 0;

        try {
            if ($content->workOfScope) {
                $_relationship = $content->workOfScope->relationship;
                $_envisageNextYear = $content->workOfScope->envisageNextYear;
                $_comment = $content->workOfScope->comment;
                $_roles = $content->workOfScope->roles;

                try {
                    $_rolesCount = count($_roles);
                } catch (\Throwable $th) {
                }
            }
        } catch (\Throwable $th) {
        }

    @endphp

    @include('common.alert')

    <form action="{{ route('appraisal.user.scope-of-work.submit') }}" method="POST">
        @csrf
        <div class="content-body">

            <div class="content-subsection">

                <p>
                    Please complete the following boxes to cover all work that you undertake. This should include work for
                    voluntary organisations and work in private or
                    independent practice and should include managerial, educational, research and academic roles. Please
                    indicate how much time you are spending in
                    each job or role. Depending on the nature of the work, if you are undertaking a lesser volume of work in
                    an area you should take increasing care that
                    the information you provide in this form is sufficient to demonstrate fitness to practise in that area
                </p>

                <p>
                    Types of work should be categorised into:
                </p>

                <ul>
                    <li>clinical commitments</li>
                    <li>educational roles, including supervision, teaching, academic and research</li>
                    <li>managerial and leadership roles</li>
                    <li>any other role that requires you to hold a medical qualification / licence to practice
                        <i class="fas fa-question-circle help-icon" onclick="toggleHelp('categoryHelp')"></i>
                    </li>
                </ul>

                <div id="categoryHelp" class="help-text">
                    Examples of such roles include sports medicine, occupational health, ascetic practice, appraiser,
                    voluntary roles etc. If in doubt, include it anyway -
                    better to be over inclusive than under inclusive
                </div>

                <p>
                    About ‘Job or role title
                    <i class="fas fa-question-circle help-icon" onclick="toggleHelp('roleHelp')"></i>
                </p>
                <div id="roleHelp" class="help-text">
                    The list of jobs/roles you create here will be available to pick from in subsequent tables.<br>
                    Where you may perform the same/similar role at different organisations, please list these
                    separately.<br>
                    Organisation and contact details are important. Please include a name, email address, phone
                    number of someone responsible for supervising your
                    practice in this role.
                </div>

                <!-- Scope of work -->
                <div class="form-section" id="personal-details">
                    <div id="employmentContainer">
                        <div class="dynamic-row">
                            @if ($_rolesCount > 0)
                                @for ($i = 0; $i < $_rolesCount; $i++)
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Job or role title Detail of work</label>
                                            <input type="text" class="form-control" name="role[]"
                                                value="{{ $_roles[$i]->role }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Detail of work<br>(Including any changes since your
                                                last
                                                appraisal)</label>
                                            <input type="text" class="form-control" name="work[]"
                                                value="{{ $_roles[$i]->work }}">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Year commenced</label>
                                            <input type="text" class="form-control" name="yearCommenced[]"
                                                value="{{ $_roles[$i]->yearCommenced }}">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Organisation and contact details</label>
                                            <input type="text" class="form-control" name="organization[]"
                                                value="{{ $_roles[$i]->organization }}">
                                        </div>
                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-remove-row btn-sm text-white"
                                                onclick="removeRow(this)">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                @endfor
                            @endif

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Job or role title Detail of work</label>
                                    <input type="text" class="form-control" name="role[]">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Detail of work<br>(Including any changes since your last
                                        appraisal)</label>
                                    <input type="text" class="form-control" name="work[]">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Year commenced</label>
                                    <input type="text" class="form-control" name="yearCommenced[]">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Organisation and contact details</label>
                                    <input type="text" class="form-control" name="organization[]">
                                </div>
                                <div class="col-md-2 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-remove-row btn-sm text-white"
                                        onclick="removeRow(this)">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-add-row btn-sm text-white" onclick="addTableRow()">
                    <i class="fas fa-plus"></i> Add
                </button>

                <div class="form-section" id="personal-details">

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="fullName" class="form-label">
                                Please describe here anything significant regarding the relationship between your various
                                roles.
                                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('relationshipHelp')"></i>
                            </label>
                            <div id="relationshipHelp" class="help-text">
                                This is an opportunity for you to review the relationship between your roles and the steps
                                you have taken to address these. Describe here any issues
                                relating to conflicts of interests that you are managing and to flag with your appraiser.
                                Also include here any complementary relationships.
                            </div>
                            <textarea class="form-control" name="relationship" rows="2">{{ $_relationship }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="fullName" class="form-label">
                                Please describe any changes to your scope of work that you envisage taking place in the next
                                year.
                            </label>
                            <textarea class="form-control" name="envisageNextYear" rows="2">{{ $_envisageNextYear }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="fullName" class="form-label">
                                Appraiser's comments
                                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('commentsHelp')"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Your tooltip text here"></i>
                            </label>
                            <div id="commentsHelp" class="help-text">
                                'Appraiser's comments' boxes appear at the end of a number of sections in this form.
                                Appraisers are encouraged to record their comments here,
                                which are transcribed verbatim into the summary in Section 19. Appraisers should therefore
                                construct their comments accordingly. Please note if you
                                edit the text again in Section 19, it will automatically change the text in the
                                corresponding section.
                                Comments should include:
                                <ul>
                                    <li>
                                        an overview of the supporting information and the doctor's accompanying commentary.
                                    </li>
                                    <li>
                                        a comment on the extent to which the supporting information relates to all aspects
                                        of the doctor's scope of work.
                                    </li>
                                </ul>
                            </div>
                            <textarea class="form-control" name="comment" rows="2">{{ $_comment }}</textarea>

                            <div class="alert alert-warning small">
                                <strong>Note for appraiser:</strong> Text entered here will mirror automatically between the
                                corresponding 'Appraiser's comments' boxes and 'Section 19 Summary of the appraisal
                                discussion' boxes.
                            </div>
                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-between">
                     <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.personal-details')}}">
                    < Previous section</a>
                    <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.annual-appraisals')}}">Next section ></a>
                </div>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add row
        function addTableRow() {
            const container = document.getElementById("employmentContainer");
            const newRow = document.createElement("div");
            newRow.className = "dynamic-row";
            newRow.innerHTML = `
                 <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Job or role title Detail of work</label>
                        <input type="text" class="form-control" name="role[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Detail of work<br>(Including any changes since your last
                            appraisal)</label>
                        <input type="text" class="form-control" name="work[]">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Year commenced</label>
                        <input type="text" class="form-control" name="yearCommenced[]">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Organisation and contact details</label>
                        <input type="text" class="form-control" name="organization[]">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-remove-row btn-sm text-white"
                            onclick="removeRow(this)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
        }

        // Remove row
        function removeRow(button) {
            const row = button.closest(".dynamic-row");
            row.remove();
        }
    </script>

@endsection
