<?php $__env->startSection('title', 'Completion - save, lockdown and print'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <h1>Section 21 of 21</h1>
        <h2>Completion - save, lockdown and print
        </h2>
    </div>

    <?php echo $__env->make('common.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content-body">

        <section class="mb-4">
            <p class="text-muted">
                This final section gives you a number of options to save, lockdown and
                print your form, or to print out particular sections of the form that
                may be useful to you.
            </p>
            <p>
                Once this document is completed and ready for submission, the
                appraiser should save a final version (last minute changes can still
                be made at this point).
            </p>
            <p>Please click here to perform a final save of this form:</p>
            <button type="button" class="btn btn-success mb-3">
                Save form - final save of editable version
            </button>
            <p>
                This next step cannot be reversed, so please ensure that all of the
                information that both parties wish to be documented has been included
                and that an editable version has been safely stored for future
                reference.
            </p>
            <p>
                The appraiser should then lock the form to send a 'read only' version
                that cannot be edited to the responsible officer.
            </p>
            <p>
                <strong>Do not</strong> email the form onwards using the Adobe Reader
                menu bar: 'File', 'Send File...', nor the 'Send file as email
                attachment' icon. This will result in a warning message and the form
                will not transfer as an attachment into your email application. You
                should instead save and close the form, open your email application
                and attach the form directly from where it is filed.
            </p>
            <p>
                You will not be able to lockdown the form until all mandatory fields
                have been completed. An error box will list any that you have missed.
                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('missedHelp')"></i>
            </p>
            <div id="missedHelp" class="help-text">
                Mandatory fields can be found in Section 3 Personal details, Section 17 Appraisal checklist and Section 20
                Appraisal outputs.
                <br>
                <br>

                You should also check that the (non-mandatory) declaration(s) in:
                <br>
                <br>

                > Section 13 Probity and health statements have been ticked, or if not, that explanation has been given as
                to why not.
                <br>
                <br>

                Additionally, you should check that in Section 9 Significant events and Section 11 Review of complaints and
                compliments, that either ‘I have not’ or ‘I
                have’ options have been selected.
            </div>
            <p>
                Please click here to perform lockdown of this completed form
            </p>
            <button type="button" class="btn btn-success mb-3">
                Save form - LOCKDOWN
            </button>
            <p>
                Once the form has been locked down, you may use the following options
                to print the respective information for your own use or to provide to
                others as appropriate eg other employers, if you prefer not to show
                them all your information. If you have installed/available a basic pdf
                writing software on your computer, you can also save these print views
                as well as print them out.
                <i class="fas fa-question-circle help-icon" onclick="toggleHelp('printHelp')"></i>
            </p>
            <div id="printHelp" class="help-text">
                Print options via this section are only available once the form has been locked down.
                <br>
                <br>
                To save these options as separate documents you will require a basic pdf converter/writing software (e.g.
                CutePDF Writer) to be available/installed
                on your computer, via your printer settings/options. Click the appropriate print button below and select the
                pdf converter/writer as the printer option,
                then print. You can then choose where to save the document.
                <br>
                <br>
                Remember to print in landscape orientation
            </div>
        </section>
        <section>
            <p>Print whole form</p>
            <a href="<?php echo e(route('appraisal.user.completion.pdf')); ?>" class="btn btn-primary mb-3" target="_blank">
                Print - whole form
            </a>

            <p>Print Sections 3 Personal details &amp; 4 Scope of work:</p>

            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['s' => 3, 'e' => 4])); ?>" type="button" target="_blank"
                class="btn btn-primary mb-3">Print - Section 3,4</a>

            <p>Print Section 18 The agreed personal development plan:</p>

            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['s' => 18, 'e' => 18])); ?>" type="button" target="_blank"
                class="btn btn-primary mb-3">Print - Section 18</a>

            <p>Print Appraisal Outputs Report – Sections:</p>
            <ul>
                <li>3 Personal details</li>
                <li>4 Scope of work</li>
                <li>18 The agreed personal development plan</li>
                <li>
                    19 Summary of the appraisal discussion; and 20 Appraisal outputs
                </li>
            </ul>
            <a href="<?php echo e(route('appraisal.user.completion.pdf', ['s' => 3, 'e' => 4, 's1' => 18, 'e1' => 20])); ?>" type="button" target="_blank"
                class="btn btn-primary mb-3">Print - Section 3,4,18,19,20</a>

        </section>

        <div class="d-flex justify-content-between mt-3">
            <a class="btn btn-sm btn-primary" href="<?php echo e(route('appraisal.user.outputs')); ?>">
                < Previous section</a>
        </div>


    </div>


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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('appraisal.user.form.layout.appraisal-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/appraisal/user/form/completion.blade.php ENDPATH**/ ?>