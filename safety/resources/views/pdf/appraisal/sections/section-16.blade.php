<div>
    <div>
        <div class="section-header">
            Section 16 of 21
            <br>Review of GMC Good Medical Practice domains
        </div>

        <div class="section-content">

            <p>
                In preparation for your appraisal you should consider how you are meeting the
                requirements of Good Medical Practice. This reflection will help you and your appraiser to prepare for
                your
                appraisal and will help your appraiser summarise the appraisal discussion.
            </p>
            <label class="form-label">
                Domain 1: Knowledge, skills and development
            </label>
            <div class="instruction-text">
                <p class="mb-1">1 Being competent</p>
                <p class="mb-1">2 Providing good clinical care</p>
                <p class="mb-1">3 Offering remote consultations</p>
                <p class="mb-1">4 Considering research opportunities</p>
                <p class="mb-1">5 Maintaining, developing and improving your performance</p>
                <p class="mb-1">6 Managing resources effectively and sustainably</p>
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['gmc_knowledge'] ?? '' }}
            </div>
            <label class="form-label">
                Domain 2: Patients, partnership and communication
            </label>
            <div class="instruction-text">
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
                <p class="mb-1">2.10 Being open if things go wrong</p>
            </div>
            <div class="form-input form-input-large">
                {{ $appraisalData['gmc_safety'] ?? '' }}
            </div>
            <label class="form-label">
                Domain 3: Colleagues, culture and safety
            </label>
            <div class="instruction-text">
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
            <div class="form-input form-input-large">
                {{ $appraisalData['gmc_communication'] ?? '' }}
            </div>
            <label class="form-label">
                Domain 4: Trust and professionalism
            </label>
            <div class="instruction-text">
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
            <div class="form-input form-input-large">
                {{ $appraisalData['gmc_trust'] ?? '' }}
            </div>
            <label class="form-label">
                <p class="mb-1"><strong>General Reflections on Practise</strong></p>
                <p class="mb-0">You may also wish to jot down ideas to include in your PDP here, or if you prefer,
                    draft these straight into the PDP table on Section 18 for discussion and refinement with your
                    appraiser when you meet.</p>
            </label>
            <div class="form-input form-input-large">
                {{ $appraisalData['gmc_comments'] ?? '' }}
            </div>

        </div>
    </div>

</div>
