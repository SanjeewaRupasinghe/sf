@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Record of annual appraisals')

@section('content')
    <div class="content-header">
        <h1>Section 5 of 21</h1>
        <h2>Record of annual appraisals</h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        $_firstAppraisal = '';
        $_lastAppraisalDate = '';
        $_hasChanged = '';
        $_appraiserName = '';
        $_designatedBody = '';
        $_responsibleOfficer = '';

        try {
            if ($content->annualAppraisals) {
                $_firstAppraisal = $content->annualAppraisals->firstAppraisal;
                $_lastAppraisalDate = $content->annualAppraisals->lastAppraisalDate;
                $_hasChanged = $content->annualAppraisals->hasChanged;
                $_designatedBody = $content->annualAppraisals->designatedBody;
                $_appraiserName = $content->annualAppraisals->appraiserName;
                $_responsibleOfficer = $content->annualAppraisals->responsibleOfficer;
            }
        } catch (\Throwable $th) {
        }

    @endphp

    @include('common.alert')

    <form action="{{ route('appraisal.user.annual-appraisals.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content-body">

            <div class="content-subsection">

                <!-- Personal Details Section -->
                <div class="form-section" id="personal-details">

                    <!-- First appraisal checkbox -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="firstAppraisal" name="firstAppraisal" 
                        @if($_firstAppraisal=="on")checked @endif
                        >
                        <label class="form-check-label" for="firstAppraisal">
                            This is my first appraisal
                        </label>
                    </div>

                    <!-- Date of last appraisal -->
                    <div class="mb-3 row">
                        <label for="lastAppraisalDate" class="col-sm-3 col-form-label">Date of last appraisal:
                            <i class="fas fa-question-circle help-icon" onclick="toggleHelp('dateHelp')"></i>
                        </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="lastAppraisalDate" name="lastAppraisalDate" value="{{ $_lastAppraisalDate }}">
                        </div>
                        <div id="dateHelp" class="help-text">
                            Enter name of responsible officer at last appraisal, if different
                        </div>
                    </div>

                    <!-- Changed since last year -->
                    <div class="mb-3">
                        <label class="form-label">Has the name of your appraiser / responsible officer / designated body
                            changed since last year's appraisal?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasChanged" id="changedYes" value="yes" @if($_hasChanged=="yes") checked @endif>
                            <label class="form-check-label" for="changedYes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasChanged" id="changedNo" value="no" @if($_hasChanged=="no") checked @endif>
                            <label class="form-check-label" for="changedNo">
                                No
                            </label>
                        </div>
                    </div>

                    <!-- Conditional fields that appear when "Yes" is selected -->
                    <div id="conditionalFields" @if($_hasChanged=="yes") style="display: block;" @else style="display: none;"@endif>
                        <!-- Name of appraiser at last appraisal -->
                        <div class="mb-3 row">
                            <label for="appraiserName" class="col-sm-4 col-form-label">Name of appraiser at last appraisal,
                                if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="appraiserName" name="appraiserName" value="{{ $_appraiserName }}">
                            </div>
                        </div>

                        <!-- Name of responsible officer -->
                        <div class="mb-3 row">
                            <label for="responsibleOfficer" class="col-sm-4 col-form-label">Name of responsible officer at
                                last appraisal, if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="responsibleOfficer"
                                    name="responsibleOfficer" value="{{$_responsibleOfficer}}">
                            </div>
                        </div>

                        <!-- Name of designated body -->
                        <div class="mb-3 row position-relative">
                            <label for="designatedBody" class="col-sm-4 col-form-label">Name of designated body at last
                                appraisal, if different:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="designatedBody" name="designatedBody" value="{{ $_designatedBody }}">
                            </div>
                        </div>
                    </div>

                    <!-- Instructions for attachment -->
                    <div class="mb-3">
                        <p class="small">Please attach a copy of last year's appraisal summary if it is not directly
                            accessible to your appraiser and responsible officer (e.g. via a central database/management
                            system).</p>
                    </div>

                    <div class="mb-3">
                        <p class="small">Please also be mindful of file size when uploading documents. It is advisable to
                            attach your Appraisal Outputs Report (via Section 21 from last year's appraisal form), rather
                            than the full form. If your summary is part of a larger document, it may be wise to print out
                            the summary page, scan it and upload that one section, or log it and provide it separately to
                            your appraiser via Section 14:</p>
                    </div>

                    <!-- File attachment -->
                    <div class="mb-3">
                        <input type="file" class="form-control" id="attachmentFile" name="attachmentFile"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <button type="button" class="btn btn-success btn-sm mt-2"
                            onclick="handleAttachment()">Attach</button>
                    </div>

                    <div id="attachmentStatus" class="mt-2"></div>

                </div>


                <div class="d-flex justify-content-between">
                    <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.scope-of-work')}}">
                        < Previous section</a>
                            <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                            <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.development-plans')}}">Next section ></a>
                </div>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide conditional fields based on radio button selection
        const radioButtons = document.querySelectorAll('input[name="hasChanged"]');
        const conditionalFields = document.getElementById('conditionalFields');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes' && this.checked) {
                    conditionalFields.style.display = 'block';
                } else if (this.value === 'no' && this.checked) {
                    conditionalFields.style.display = 'none';
                }
            });
        });

        // Handle file attachment
        function handleAttachment() {
            const fileInput = document.getElementById('attachmentFile');
            const statusDiv = document.getElementById('attachmentStatus');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                statusDiv.innerHTML =
                    `<div class="alert alert-success">File "${file.name}" attached successfully (${(file.size / 1024).toFixed(1)} KB)</div>`;
            } else {
                statusDiv.innerHTML = `<div class="alert alert-warning">Please select a file to attach.</div>`;
            }
        }

        // Handle file input change
        document.getElementById('attachmentFile').addEventListener('change', function() {
            const statusDiv = document.getElementById('attachmentStatus');
            if (this.files.length > 0) {
                statusDiv.innerHTML = `<div class="alert alert-info">File selected: ${this.files[0].name}</div>`;
            }
        });
    </script>


@endsection
