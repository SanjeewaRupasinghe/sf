@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Review of GMC Good Medical Practice domains')

@section('content')
    <div class="content-header">
        <h1>Section 16 of 21</h1>
        <h2>Review of GMC Good Medical Practice domains
        </h2>
    </div>

    @php
        $content = json_decode(Auth::user()->content);

        $_knowledge = '';
        $_safety = '';
        $_communication = '';
        $_trust = '';
        $_comments = '';

        try {
            if ($content->gmcDomain) {
                $_knowledge = $content->gmcDomain->knowledge;
                $_safety = $content->gmcDomain->safety;
                $_communication = $content->gmcDomain->communication;
                $_trust = $content->gmcDomain->trust;
                $_comments = $content->gmcDomain->comments;
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

    <form @if ($LOCKDOWN_STATUS) action="{{ route('appraisal.user.gmc-domains.submit') }}" @endif method="POST">
        @csrf

        <div class="content-body">

            <!-- Introduction Text -->
            <p class="text-primary mb-4">In preparation for your appraisal you should consider how you are meeting the
                requirements of Good Medical Practice. This reflection will help you and your appraiser to prepare for your
                appraisal and will help your appraiser summarise the appraisal discussion.</p>

            <!-- Domain 1: Knowledge, skills and development -->
            <div class="mb-4">
                <h6 class="d-flex align-items-center mb-2">
                    <strong>Domain 1: Knowledge, skills and development</strong>
                    <i class="fas fa-question-circle text-info ms-2" onclick="toggleHelp('domain1Help')"
                        style="cursor: pointer;"></i>
                </h6>
                <div id="domain1Help" class="help-text" style="display: none;">
                    <p class="mb-1">1 Being competent</p>
                    <p class="mb-1">2 Providing good clinical care</p>
                    <p class="mb-1">3 Offering remote consultations</p>
                    <p class="mb-1">4 Considering research opportunities</p>
                    <p class="mb-1">5 Maintaining, developing and improving your performance</p>
                    <p class="mb-1">6 Managing resources effectively and sustainably</p>
                </div>

                <textarea class="form-control" rows="6" name="knowledge">{{ $_knowledge }}</textarea>
            </div>

            <!-- Domain 2: Patients, partnership and communication -->
            <div class="mb-4">
                <h6 class="d-flex align-items-center mb-2">
                    <strong>Domain 2: Patients, partnership and communication</strong>
                    <i class="fas fa-question-circle text-info ms-2" onclick="toggleHelp('domain2Help')"
                        style="cursor: pointer;"></i>
                </h6>
                <div id="domain2Help" class="help-text" style="display: none;">
                    <p class="mb-1">1 Treating patients fairly and respecting their rights</p>
                    <p class="mb-1">2 Treating patients with kindness, courtesy and respect</p>
                    <p class="mb-1">3 Supporting patients to make decisions about treatment and care</p>
                    <p class="mb-1">4 Sharing information with patients</p>
                    <p class="mb-1">5 Communicating with those close to a patient</p>
                    <p class="mb-1">6 Caring for the whole patient</p>
                    <p class="mb-1">7 Safeguarding children and adults who are at risk of harm</p>
                    <p class="mb-1">8 Helping in emergencies</p>
                    <p class="mb-1">9 Making sure patients who pose a risk of harm to others can access appropriate care
                    </p>
                    <p class="mb-1">10 Being open if things go wrong</p>
                </div>


                <textarea class="form-control" rows="6" name="safety">{{ $_safety }}</textarea>
            </div>

            <!-- Domain 3: Colleagues, culture and safety -->
            <div class="mb-4">
                <h6 class="d-flex align-items-center mb-2">
                    <strong>Domain 3: Colleagues, culture and safety</strong>
                    <i class="fas fa-question-circle text-info ms-2" onclick="toggleHelp('domain3Help')"
                        style="cursor: pointer;"></i>
                </h6>
                <div id="domain3Help" class="help-text" style="display: none;">
                    <p class="mb-1">1 Treating colleagues with kindness, courtesy and respect</p>
                    <p class="mb-1">2 Contributing to a positive working and training environment</p>
                    <p class="mb-1">3 Demonstrating leadership behaviours</p>
                    <p class="mb-1">4 Contributing to continuity of care</p>
                    <p class="mb-1">5 Delegating safely and appropriately</p>
                    <p class="mb-1">6 Recording your work clearly, accurately, and legibly</p>
                    <p class="mb-1">7 Keeping patients safe</p>
                    <p class="mb-1">8 Responding to safety risks</p>
                    <p class="mb-1">9 Managing risks posed by your health</p>
                </div>
            </div>

            <!-- Domain 3 continued -->
            <div class="mb-4">
                <textarea class="form-control mb-4" rows="6" name="communication">{{ $_communication }}</textarea>
            </div>

            <!-- Domain 4: Trust and professionalism -->
            <div class="mb-4">
                <h6 class="d-flex align-items-center mb-2">
                    <strong>Domain 4: Trust and professionalism</strong>
                    <i class="fas fa-question-circle text-info ms-2" onclick="toggleHelp('domain4Help')"
                        style="cursor: pointer;"></i>
                </h6>
                <div id="domain4Help" class="help-text" style="display: none;">
                    <p class="mb-1">1 Acting with honesty and integrity</p>
                    <p class="mb-1">2 Acting with honesty and integrity in research</p>
                    <p class="mb-1">3 Maintaining professional boundaries</p>
                    <p class="mb-1">4 Communicating as a medical professional</p>
                    <p class="mb-1">5 All professional communication</p>
                    <p class="mb-1">6 Public professional communication, including using social media, advertising,
                        promotion, and endorsement</p>
                    <p class="mb-1">7 Giving evidence and acting as a witness</p>
                    <p class="mb-1">8 Private communication</p>
                    <p class="mb-1">9 Managing conflicts of interest</p>
                    <p class="mb-1">10 Cooperating with legal and regulatory requirements</p>
                </div>

                <textarea class="form-control mb-4" rows="6" name="trust">{{ $_trust }}</textarea>
            </div>

            <!-- General comment section -->
            <div class="mb-4">
                <div class="border p-3 mb-2" style="background-color: #f8f9fa;">
                    <p class="mb-1"><strong>General Reflections on Practise</strong></p>
                    <p class="mb-0">You may also wish to jot down ideas to include in your PDP here, or if you prefer,
                        draft these straight into the PDP table on Section 18 for discussion and refinement with your
                        appraiser when you meet.</p>
                </div>

                <textarea class="form-control" rows="6" name="comments">{{ $_comments }}</textarea>
            </div>

            <div class="d-flex justify-content-between">

                <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.supporting-info') }}">
                    < Previous section</a>
                        @if ($LOCKDOWN_STATUS)
                            <button type="submit" class="btn btn-sm btn-success">Save Form</button>
                        @endif
                        <a class="btn btn-sm btn-primary" href="{{ route('appraisal.user.checklist') }}">Next section
                            ></a>

            </div>


        </div>
    </form>

@endsection
