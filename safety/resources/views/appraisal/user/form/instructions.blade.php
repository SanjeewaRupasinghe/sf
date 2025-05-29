@extends('appraisal.user.form.layout.appraisal-layout')

@section('title', 'Instructions for using this form - Medical Appraisal Guide')

@section('content')
    <div class="content-header">
        <h1>Section 2 of 21</h1>
        <h2>Instructions for using this form</h2>
    </div>

    @include('common.alert')

    <div class="content-body">
        <p>This form is intended as an example of a repository that holds the information required for a medical appraisal.
            It has been designed with the appraisal meeting in mind, in a logical manner that mirrors how the appraisal
            conversation may flow. It is also intended as a practical demonstration of the information in the <a
                href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/med-app-guide/"
                class="content-link">Medical Appraisal Guide: a guide to medical appraisal for revalidation in
                England, version 4 (NHS Revalidation Support Team, 2013 [reissued with updated hyperlinks September
                2014])</a>.</p>

        <p><a href="https://www.england.nhs.uk/professional-standards/medical-revalidation/appraisers/mag-mod/"
                class="content-link">The MAG Model Appraisal Form User Guide (NHS England 2016)</a> expands on
            the instructions below about how to use this form. This version of the form was updated in 2016 with an aim to
            improve its usability and enhance the appraisal outputs. It is now an annual form only.</p>

        <p>ALL aspects of a medical practitioner's role can be, and should be, detailed within this form, including
            clinical, managerial and academic work, research, private practice, locum work and voluntary roles. The main
            focus throughout the appraisal process should be your reflection in both your activity and the outcomes as a
            result. For any supporting information you include, you are encouraged to consider this from a quality versus
            quantity perspective.</p>

        <p>Doctors should complete up to and including section 17 and submit the package of information to the appraiser by
            a mutually agreed date (which is usually at least two weeks before the appraisal). Sections 18, 19 and 20 will
            be completed during and immediately after the appraisal meeting by both the doctor and the appraiser.</p>

        <div class="content-subsection">
            <h3>How does the form work?</h3>
            <ul>
                <li>It is an interactive pdf which allows you to type information into boxes and upload documents into the
                    form.</li>
                <li>To navigate through the various sections you must either use the navigation bar down the left-hand side
                    or use the <button class="btn btn-sm btn-primary">
                        < Previous section</button> and <button class="btn btn-sm btn-primary">Next section ></button>
                            buttons at
                            the end of each section.</li>
                <li>Drop down boxes on each of the tables allow you to attach documents or log that you intend to provide a
                    document separately. Documents are attached in the same way as you would attach a file to an email.</li>
                <li>The maximum size of the form cannot exceed 10MB due to restrictions with many email servers. Section 15
                    lists all of the supporting information that you have said you will provide. In the case of attachments,
                    it lists the size of each one and a running total of the space used for your information.</li>
                <li>To be able to use the form, you will require at least version XI (eleven) of Adobe Reader installed on
                    your computer/laptop, otherwise it may not be compatible and you may experience issues if you are not
                    using the correct software. NB: Internet browser pdf readers. If you are downloading this form from the
                    internet, your computer may attempt to do so using your browser's own pdf reader. This may occur even if
                    you have the correct version of Adobe Reader installed on your computer, and depends on your computer's
                    settings. To overcome this, instead of clicking on the download link as usual, right-click the link,
                    choose 'Save target as', and save the form to your hard drive. You should then be able to open the form
                    from your hard drive using Adobe Reader.</li>
            </ul>
        </div>

        <div class="content-subsection">
            <h3>Saving the form</h3>
            <ul>
                <li>The first time you use this form, you may wish to complete sections 3 and 4 and save this as your
                    appraisal template to use each year,
                    remembering to update relevant information in them where appropriate.</li>
                <li>For each year’s appraisal, save your template with a different filename and then use the <button
                        class="btn btn-sm btn-success">Save form</button>
                    buttons throughout the document to save
                    your work as you go.</li>
                <li>Clicking <button class="btn btn-sm btn-success">Save form</button> activates Adobe's ‘Save As’ function
                    which will ask you if you want to overwrite the
                    current file. It is OK to do this - you do
                    not need to save a new version every time.</li>
                <li>You do not need to save on each page - the form will retain information when you pass from section to
                    section, though it is good practice to
                    save a copy at regular intervals.</li>
                <li>Section 21 allows you to save, lockdown and print out the form. You can also print out a number of
                    different section options, including an
                    Appraisal Outputs Report (sections 3, 4, 18, 19 and 20), which can also be saved separately if you have
                    a basic pdf converter/writing software
                    available/installed on your computer (e.g. ‘CutePDF Writer’) via your printer settings/options.</li>

            </ul>
        </div>

        <div class="content-subsection">
            <h3>Submitting supporting information</h3>
            <ul>
                <li> Many file types can be uploaded as supporting information including Word and Excel documents,
                    PowerPoint slides, pdfs and image files.
                    Some file types may not be compatible with the form and if you try to upload one of these, a warning box
                    will tell you that it is not possible.</li>
                <li>Zip files and webpages cannot be uploaded.</li>
                <li>Some files will be too large. These generally include previous full MAG forms, presentations that
                    include a lot of graphics or some types of
                    scanned documents. These can either be emailed to the appraiser separately by a secure means or
                    submitted in hard copy format, in advance
                    of the appraisal meeting – but again, please consider quality over quantity.</li>
                <li>If you intend to provide any files separately you should still list them in the appropriate section, and
                    comment on them. Make sure you
                    remember to click the <button class="btn btn-sm btn-success">LOG</button> button in the table to ensure
                    that this piece of supporting information is listed in the Section 15 cumulative table.</li>
                <li>If you change your mind regarding an attachment, you will need to delete the row in the table and add a
                    new one. You can copy and paste any
                    text that you have written first, and then attach a new document.</li>
                <li>If you wish to amend a document that you have already attached, do not click on <button
                        class="btn btn-sm btn-primary">View</button> and open the attachment from within the form. You
                    must click <button class="btn btn-sm btn-danger">Remove</button>, amend the document from where it is
                    originally filed, and reattach the amended version into the form</li>
            </ul>
        </div>

        <div class="content-subsection">
            <h3>Helpful hints</h3>
            <ul>
                <li>An asterisk (*) next to a question denotes that this field is compulsory and you will not be able to
                    submit the form at the end unless it is
                    completed.</li>
                <li>The <button class="btn btn-sm btn-primary">?</button> buttons provide more information
                    about what should be included in each section or field. Many contain hyperlinks to further sources of
                    information, which requires on-line connection.</li>
                <li>Hovering the mouse over the numbers in the navigation bar at the side of each section will show you the
                    name of each section, as listed in the
                    contents page.</li>
                <li>All text boxes expand so you can write as much as you like although some have restrictions on the amount
                    of information you can add. You
                    can also copy and paste information into them.</li>
                <li>When adding rows to tables using the <button class="btn btn-sm btn-success">+</button> button, be sure
                    to complete your writing before adding the attachment or logging the supporting
                    information.</li>
                <li>Be careful when removing rows using the <button class="btn btn-sm btn-danger">-</button> button, you do
                    not get a reminder, it will delete immediately!</li>
                <li>Content to be completed by the appraiser is shaded yellow and/or has a yellow frame around relevant
                    boxes.</li>
                <li>Do not email the form onwards using the Adobe Reader menu bar: ‘File’, ‘Send File…’, nor the ‘Send file
                    as email attachment’ icon. This will
                    result in a warning message and the form will not transfer as an attachment into your email application.
                    You should instead save and close the
                    form, open your email application and attach the form directly from where it is filed</li>
            </ul>

            <p>
                Once you have completed all of the fields, the form can be transferred to your appraiser as per the process
                agreed within your designated body.
                If you have any issues with the form, or queries about how to use it, you should contact the appropriate
                revalidation/appraisal lead in your designated
                body or your appraiser
            </p>

            <div class="p-3 border border-danger border-2 text-danger">
                <b>Confidentiality and Information governance</b><br>
                <br>You must take care to abide by local confidentiality, data security and information governance protocols
                when adding details into this
                form. In particular, you must remove all personally and patient identifiable data. If you are unable to do
                this for specific items of
                information, you should log the existence of the information in this form but provide the information itself
                separately to your
                appraiser.<br><br>
                Remember, you are providing this information primarily to your appraiser. After your appraisal is signed
                off, your responsible officer
                or other person with appropriately delegated authority will receive a copy of the form, specifically to read
                the appraisal outputs (the
                appraiser’s statements, the appraisal summary, and your personal development plan). Your responsible officer
                may also access the
                rest of this form and all of your supporting information (whether attached to this form or provided
                separately) when considering your
                fitness to practise (for your revalidation recommendation or in other circumstances) and for quality
                assurance purposes. Your
                responsible officer can provide you with more information about who may view your form and the circumstances
                under which they
                may do so.<br><br>
                Throughout the appraisal process, doctors and appraisers must adhere to local information governance
                protocols, particularly in
                relation to the sending of this form and any supporting information by appropriate email or other means and
                in relation to the storing/
                filing of this form and any supporting information in an appropriate place and for an appropriate length of
                time.

            </div>

            <p class="pt-3 pb-3">
                The template Medical Appraisal Guide (MAG) Model Appraisal Form was produced and published by NHS England.
                The intended use of this freely
                available resource is for doctors with a prescribed connection to NHS England to record their annual
                appraisal. NHS England controls the copyright in
                this template. As the template sets out the statutory requirement for what should be covered as part of a
                medical appraisal, it may be adopted by any
                doctor and or designated body as their appraisal vehicle, but NHS England cannot be held responsible for
                their appraisal, nor their appraisal in
                relation to the conduct of such doctors who do not have a prescribed connection to NHS England.
            </p>

            <div class="d-flex justify-content-between">
                <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.index')}}">
                    < Previous section</a>
                        <a class="btn btn-sm btn-primary" href="{{route('appraisal.user.personal-details')}}">Next section ></a>
            </div>

        </div>
    </div>
@endsection
