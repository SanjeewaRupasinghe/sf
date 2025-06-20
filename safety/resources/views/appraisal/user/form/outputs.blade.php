@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Appraisal outputs')

@section('content')
    <div class="content-header">
        <h1>Section 20 of 21</h1>
        <h2>Appraisal outputs
        </h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        $_statement_1 = '';
        $_statement_2 = '';
        $_statement_3 = '';
        $_statement_4 = '';
        $_statement_5 = '';
        $_appraiser_comments = '';
        $_additional_issues = '';
        $_doctor_response = '';
        $_doctor_confirmation = '';
        $_doctor_full_name = '';
        $_doctor_gmc_number = '';
        $_appraiser_confirmation = '';
        $_appraiser_full_name = '';
        $_appraiser_gmc_number = '';
        $_appraisal_date = '';

        try {
            if ($content->outputs) {
                $_statement_1 = $content->outputs->statement_1;
                $_statement_2 = $content->outputs->statement_2;
                $_statement_3 = $content->outputs->statement_3;
                $_statement_4 = $content->outputs->statement_4;
                $_statement_5 = $content->outputs->statement_5;
                $_appraiser_comments = $content->outputs->appraiser_comments;
                $_additional_issues = $content->outputs->additional_issues;
                $_doctor_response = $content->outputs->doctor_response;
                $_doctor_confirmation = $content->outputs->doctor_confirmation;
                $_doctor_full_name = $content->outputs->doctor_full_name;
                $_doctor_gmc_number = $content->outputs->doctor_gmc_number;
                $_appraiser_confirmation = $content->outputs->appraiser_confirmation;
                $_appraiser_full_name = $content->outputs->appraiser_full_name;
                $_appraiser_gmc_number = $content->outputs->appraiser_gmc_number;
                $_appraisal_date = $content->outputs->appraisal_date;
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

    <form @if ($LOCKDOWN_STATUS) action="{{ route('appraisal.user.outputs.submit') }}" @endif method="POST">
        @csrf

        <div class="content-body">

            <div class="row">
                <div class="col-12">
                    <h5 class="text-primary mb-3">The appraiser makes the following statements to the responsible officer:
                    </h5>

                    <!-- Statement 1 -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1">1.</div>
                            <div class="col-7">
                                * An appraisal has taken place that reflects the whole of the doctor's scope of work and
                                addresses the principles and values set out in Good Medical Practice.
                            </div>
                            <div class="col-4">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="statement_1" id="statement_1_agree"
                                        value="agree" @if ($_statement_1 == 'agree') checked @endif required>
                                    <label class="btn btn-outline-success btn-sm" for="statement_1_agree">● Agree</label>

                                    <input type="radio" class="btn-check" name="statement_1" id="statement_1_disagree"
                                        value="disagree" @if ($_statement_1 == 'disagree') checked @endif required>
                                    <label class="btn btn-outline-danger btn-sm" for="statement_1_disagree">○
                                        Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statement 2 -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1">2.</div>
                            <div class="col-7">
                                * Appropriate supporting information has been presented in accordance with the Good Medical
                                Practice Framework for appraisal and revalidation and this reflects the nature and scope of
                                the doctor's work.
                            </div>
                            <div class="col-4">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="statement_2" id="statement_2_agree"
                                        value="agree" @if ($_statement_2 == 'agree') checked @endif required>
                                    <label class="btn btn-outline-success btn-sm" for="statement_2_agree">● Agree</label>

                                    <input type="radio" class="btn-check" name="statement_2" id="statement_2_disagree"
                                        value="disagree" @if ($_statement_2 == 'disagree') checked @endif required>
                                    <label class="btn btn-outline-danger btn-sm" for="statement_2_disagree">○
                                        Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statement 3 -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1">3.</div>
                            <div class="col-7">
                                * A review that demonstrates progress against last year's personal development plan has
                                taken place.
                            </div>
                            <div class="col-4">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="statement_3" id="statement_3_agree"
                                        value="agree" @if ($_statement_3 == 'agree') checked @endif required>
                                    <label class="btn btn-outline-success btn-sm" for="statement_3_agree">● Agree</label>

                                    <input type="radio" class="btn-check" name="statement_3" id="statement_3_disagree"
                                        value="disagree" @if ($_statement_3 == 'disagree') checked @endif required>
                                    <label class="btn btn-outline-danger btn-sm" for="statement_3_disagree">○
                                        Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statement 4 -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-1">4.</div>
                            <div class="col-7">
                                * An agreement has been reached with the doctor about a new personal development plan and
                                any associated actions for the coming year.
                            </div>
                            <div class="col-4">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="statement_4" id="statement_4_agree"
                                        value="agree" @if ($_statement_4 == 'agree') checked @endif required>
                                    <label class="btn btn-outline-success btn-sm" for="statement_4_agree">● Agree</label>

                                    <input type="radio" class="btn-check" name="statement_4" id="statement_4_disagree"
                                        value="disagree" @if ($_statement_4 == 'disagree') checked @endif required>
                                    <label class="btn btn-outline-danger btn-sm" for="statement_4_disagree">○
                                        Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statement 5 -->
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-1">5.</div>
                            <div class="col-7">
                                * No information has been presented or discussed in the appraisal that raises a concern
                                about the doctor's fitness to practise.
                            </div>
                            <div class="col-4">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="statement_5" id="statement_5_agree"
                                        value="agree" @if ($_statement_5 == 'agree') checked @endif required>
                                    <label class="btn btn-outline-success btn-sm" for="statement_5_agree">○ Agree</label>

                                    <input type="radio" class="btn-check" name="statement_5" id="statement_5_disagree"
                                        value="disagree" @if ($_statement_5 == 'disagree') checked @endif required>
                                    <label class="btn btn-outline-danger btn-sm" for="statement_5_disagree">○
                                        Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Appraiser Comments Section -->
                    <div class="mb-4">
                        <p class="fw-bold">The <span class="text-primary">appraiser</span> should record any comments that
                            will assist the responsible officer to understand the reasons for the statements that have been
                            made.</p>
                        <textarea class="form-control" name="appraiser_comments" id="appraiser_comments" rows="6">{{ $_appraiser_comments }}</textarea>
                    </div>

                    <!-- Additional Issues Section -->
                    <div class="mb-4">
                        <p class="fw-bold">The <span class="text-primary">appraiser</span> should record any other issues
                            that the responsible officer should be aware of that may be relevant to the revalidation
                            recommendation.</p>
                        <textarea class="form-control" name="additional_issues" id="additional_issues" rows="6">{{ $_additional_issues }}</textarea>
                    </div>

                    <!-- Doctor Response Section -->
                    <div class="mb-4">
                        <p class="fw-bold">The <span class="text-primary">doctor</span> may use this space to respond to
                            the above comments made by the appraiser. The responsible officer will review comments made in
                            this space.</p>
                        <textarea class="form-control" name="doctor_response" id="doctor_response" rows="6">{{ $_doctor_response }}</textarea>
                    </div>

                    <!-- Confirmation Section -->
                    <div class="mb-4">
                        <p class="fw-bold">Both the doctor and the appraiser are asked to read the following statements and
                            sign below to confirm their acceptance:</p>

                        <div class="border p-3 mb-3">
                            <p class="fw-bold">"I confirm that the information presented within this submission is an
                                accurate record of the documentation provided and used in the appraisal."</p>

                            <p class="fw-bold">"I understand that I must protect patients from risk of harm posed by
                                another colleague's conduct, performance or health. The safety of patients must come first
                                at all times. If I have concerns that a colleague may not be fit to practise, I am aware
                                that I must take appropriate steps without delay, so that the concerns are investigated and
                                patients protected where necessary."</p>
                        </div>

                        <!-- Doctor Confirmation -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="doctor_confirmation"
                                        id="doctor_confirmation" @if ($_doctor_confirmation == 'on') checked @endif
                                        required>
                                    <label class="form-check-label fw-bold" for="doctor_confirmation">
                                        * Doctor - please tick here to confirm this.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="doctor_full_name" class="form-label">* Full name of doctor accepting the
                                    declaration above:</label>
                                <input type="text" class="form-control border-danger" name="doctor_full_name" required
                                    id="doctor_full_name" value="{{ $_doctor_full_name }}">
                            </div>
                            <div class="col-6">
                                <label for="doctor_gmc_number" class="form-label">* Doctor GMC number:</label>
                                <input type="text" class="form-control border-danger" name="doctor_gmc_number"
                                    required id="doctor_gmc_number" value="{{ $_doctor_gmc_number }}">
                            </div>
                        </div>

                        <!-- Appraiser Confirmation -->
                        <div class="row mb-3" style="background-color: #fffacd;">
                            <div class="col-12 p-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="appraiser_confirmation"
                                        id="appraiser_confirmation" @if ($_appraiser_confirmation == 'on') checked @endif
                                        required>
                                    <label class="form-check-label fw-bold" for="appraiser_confirmation">
                                        * Appraiser - please tick here to confirm this.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" style="background-color: #fffacd;">
                            <div class="col-6 p-3">
                                <label for="appraiser_full_name" class="form-label">* Full name of appraiser accepting the
                                    declaration above:</label>
                                <input type="text" class="form-control border-danger" name="appraiser_full_name"
                                    id="appraiser_full_name" value="{{ $_appraiser_full_name }}" required>
                            </div>
                            <div class="col-6 p-3">
                                <label for="appraiser_gmc_number" class="form-label">* Appraiser GMC number:</label>
                                <input type="text" class="form-control border-danger" name="appraiser_gmc_number"
                                    id="appraiser_gmc_number" value="{{ $_appraiser_gmc_number }}" required>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="row">
                            <div class="col-3">
                                <label for="appraisal_date" class="form-label">* Date of appraisal meeting:</label>
                                <input type="date" class="form-control border-danger text-center"
                                    name="appraisal_date" id="appraisal_date" placeholder="DD/MM/YYYY"
                                    value="{{ $_appraisal_date }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">

                <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.summary') }}">
                    < Previous section</a>
                        @if ($LOCKDOWN_STATUS)
                            <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        @endif
                        <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.completion') }}">Next section
                            ></a>

            </div>

        </div>
    </form>


    <script>
        // Toggle collapse icons
        document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('.float-end');
                const target = document.querySelector(this.getAttribute('data-bs-target'));

                target.addEventListener('shown.bs.collapse', () => {
                    icon.textContent = '-';
                });

                target.addEventListener('hidden.bs.collapse', () => {
                    icon.textContent = '+';
                });
            });
        });
    </script>

@endsection
