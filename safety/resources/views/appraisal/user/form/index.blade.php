@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Instructions for using this form - Medical Appraisal Guide')

<style>
    ul {
        list-style-type: none;
    }

    ul li {
        padding: 5px;
        border-bottom: solid 1px #00000040;
    }
</style>

@section('content')
    <div class="content-header">
        <h1>Welcome</h1>
    </div>

    @include('common.alert')

    <div class="content-body">
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li><a href="{{ route('appraisal.user.index') }}">Instructions for using this form</a></li>
                    <li><a href="{{ route('appraisal.user.instructions') }}">Instructions for using this form</a></li>
                    <li><a href="{{ route('appraisal.user.personal-details') }}">Personal details</a></li>
                    <li><a href="{{ route('appraisal.user.scope-of-work') }}">Scope of work</a></li>
                    <li><a href="{{ route('appraisal.user.annual-appraisals') }}">Record of annual appraisals</a></li>
                    <li><a href="{{ route('appraisal.user.development-plans') }}">Personal development plans and their
                            review</a></li>
                    <li><a href="{{ route('appraisal.user.cpd') }}">Continuing professional development (CPD)</a></li>
                    <li><a href="{{ route('appraisal.user.quality-improvement') }}">Quality improvement activity</a></li>
                    <li><a href="{{ route('appraisal.user.significant-events') }}">Significant events</a></li>
                    <li><a href="{{ route('appraisal.user.feedback') }}">Feedback from colleagues and patients</a></li>
                    <li><a href="{{ route('appraisal.user.complaints') }}">Review of complaints and compliments</a></li>
                    <li><a href="{{ route('appraisal.user.achievements') }}">Achievements, challenges and aspirations</a>
                    </li>
                    <li><a href="{{ route('appraisal.user.probity') }}">Probity and health statements</a></li>
                    <li><a href="{{ route('appraisal.user.additional-info') }}">Additional information</a></li>
                    <li><a href="{{ route('appraisal.user.supporting-info') }}">Supporting information</a></li>
                    <li><a href="{{ route('appraisal.user.gmc-domains') }}">Review of GMC Good Medical Practice domains</a>
                    </li>
                    <li><a href="{{ route('appraisal.user.checklist') }}">Appraisal checklist</a></li>
                    <li><a href="{{ route('appraisal.user.development-plan') }}">The agreed personal development plan</a>
                    </li>
                    <li><a href="{{ route('appraisal.user.summary') }}">Summary of the appraisal discussion</a></li>
                    <li><a href="{{ route('appraisal.user.outputs') }}">Appraisal outputs</a></li>
                    <li><a href="{{ route('appraisal.user.completion') }}">Completion - save, lockdown and print</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <div>
                    Please click on ‘Instructions for using this form’ and
                    use the helptext bubbles throughout for guidance on
                    how to enter the information required for your
                    appraisal into this form.
                </div>
                <div style="height: 60%;width: 100%; display: flex; align-items: center; justify-content: center;background: #4585EE;"
                    class="text-white">
                    <h2>
                        Preparation <br> for <br> Appraisal
                    </h2>
                </div>
                <div style="background: #CB282B;" class="text-white pb-5">
                    <h2>
                        Appraisal
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection
