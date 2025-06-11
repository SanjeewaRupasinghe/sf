<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appraisal\Auth\AppraisalAuthRegisterRequest;
use App\Http\Requests\Appraisal\Auth\EmailConfirmationRequest;
use App\Http\Requests\Appraisal\Auth\LoginRequest;
use App\Http\Requests\Appraisal\Auth\PersonalDetailRequest;
use App\Http\Requests\Appraisal\Auth\ResendOtpRequest;
use App\Models\AppraisaUser;
use App\Http\Requests\StoreAppraisaUserRequest;
use App\Http\Requests\UpdateAppraisaUserRequest;
use ElementorPro\Core\App\App;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AppraisaUserController extends Controller
{

    public function index()
    {

        return view('appraisal.user.form.index');
    }
    public function instructions()
    {

        return view('appraisal.user.form.instructions');
    }
    public function personalDetails()
    {
        return view('appraisal.user.form.personal-details');
    }
    public function personalDetailsSubmit(PersonalDetailRequest $request)
    {
        try {

            // dd($request->all());

            $name = $request->name;
            $gmcNumber = $request->gmcNumber;
            $address = $request->address;
            $phone = $request->phone;
            $email = $request->email;
            $yearOfAppraisal = $request->yearOfAppraisal;
            $clinicalAcademic = $request->clinicalAcademic;
            $revalidationRecommendation = $request->revalidationRecommendation;
            $secondAppraiser = $request->secondAppraiser;
            $designation = $request->designation;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);


            $medicalQualifications = [];
            try {
                for ($i = 0; $i < count($request->qualification); $i++) {

                    $_qualification = $request->qualification[$i];
                    $_awardingBody = $request->awardingBody[$i];
                    $_year = $request->year[$i];

                    if (
                        $_qualification or
                        $_awardingBody or
                        $_year
                    ) {
                        $medQ = [
                            "qualification" => $_qualification,
                            "awardingBody" => $_awardingBody,
                            "year" => $_year,
                        ];
                        array_push($medicalQualifications, $medQ);
                    }
                }
            } catch (\Throwable $th) {
            }

            $personalDetails = [
                "name" => $name,
                "gmcNumber" => $gmcNumber,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "yearOfAppraisal" => $yearOfAppraisal,
                "revalidationRecommendation" => $revalidationRecommendation,
                "designation" => $designation,
                "clinicalAcademic" => $clinicalAcademic,
                "medicalQualifications" => $medicalQualifications,
                "secondAppraiser" => $secondAppraiser,
            ];

            try {
                $content->personalDetails = $personalDetails;
            } catch (\Throwable $th) {
                $content['personalDetails'] = $personalDetails;
            }

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("personalDetailsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function scopeOfWork()
    {
        return view('appraisal.user.form.scope-of-work');
    }
    public function scopeOfWorkSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $relationship = $request->relationship;
            $envisageNextYear = $request->envisageNextYear;
            $comment = $request->comment;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $roles = [];
            try {
                for ($i = 0; $i < count($request->role); $i++) {

                    $_role = $request->role[$i];
                    $_work = $request->work[$i];
                    $_yearCommenced = $request->yearCommenced[$i];
                    $_organization = $request->organization[$i];

                    if (
                        $_role or
                        $_work or
                        $_yearCommenced or
                        $_organization
                    ) {
                        $r = [
                            "role" => $_role,
                            "work" => $_work,
                            "yearCommenced" => $_yearCommenced,
                            "organization" => $_organization,
                        ];
                        array_push($roles, $r);
                    }
                }
            } catch (\Throwable $th) {
            }

            $workOfScope = [
                "relationship" => $relationship,
                "envisageNextYear" => $envisageNextYear,
                "comment" => $comment,
                "roles" => $roles,
            ];

            $content->workOfScope = $workOfScope;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("scopeOfWorkSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function annualAppraisals()
    {
        return view('appraisal.user.form.annual-appraisals');
    }
    public function annualAppraisalsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $firstAppraisal = $request->firstAppraisal;
            $lastAppraisalDate = $request->lastAppraisalDate;
            $hasChanged = $request->hasChanged;
            $appraiserName = $request->appraiserName;
            $designatedBody = $request->designatedBody;
            $responsibleOfficer = $request->responsibleOfficer;
            $new_filename = "";

            $attachmentFile = $request->file('attachmentFile');
            if ($attachmentFile) {
                $time = time();
                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                $file_extension = $attachmentFile->getClientOriginalExtension();
                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                $attachmentFile_path = "storage/" . $attachmentFile_path;
            }


            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            if (!$new_filename) {
                try {
                    $new_filename = $content->annualAppraisals->new_filename;
                } catch (\Throwable $th) {
                }
            }

            $annualAppraisals = [
                "firstAppraisal" => $firstAppraisal,
                "lastAppraisalDate" => $lastAppraisalDate,
                "hasChanged" => $hasChanged,
                "appraiserName" => $appraiserName,
                "designatedBody" => $designatedBody,
                "responsibleOfficer" => $responsibleOfficer,
                "new_filename" => $new_filename
            ];

            $content->annualAppraisals = $annualAppraisals;
            // dd($annualAppraisals,$content);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("annualAppraisalsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function developmentPlans()
    {
        return view('appraisal.user.form.development-plans');
    }
    public function developmentPlansSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $generalComments = $request->generalComments;
            $appraisersComments = $request->appraisersComments;

            $new_filename = "";

            $attachmentFile = $request->file('attachmentFile');
            if ($attachmentFile) {
                $time = time();
                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                $file_extension = $attachmentFile->getClientOriginalExtension();
                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                $attachmentFile_path = "storage/" . $attachmentFile_path;
            }

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $jobRoles = [];
            try {
                for ($i = 0; $i < count($request->jobTitle); $i++) {

                    $_jobTitle = $request->jobTitle[$i];
                    $_lastAppraisal = $request->lastAppraisal[$i];
                    $_progress = $request->progress[$i];

                    if (
                        $_jobTitle or
                        $_lastAppraisal or
                        $_progress
                    ) {
                        $role = [
                            "jobTitle" => $_jobTitle,
                            "lastAppraisal" => $_lastAppraisal,
                            "progress" => $_progress,
                        ];
                        array_push($jobRoles, $role);
                    }
                }
            } catch (\Throwable $th) {
            }

            if (!$new_filename) {
                try {
                    $new_filename = $content->developmentPlans->new_filename;
                } catch (\Throwable $th) {
                }
            }

            $developmentPlans = [
                "generalComments" => $generalComments,
                "appraisersComments" => $appraisersComments,
                "jobRoles" => $jobRoles,
                "new_filename" => $new_filename,
            ];

            $content->developmentPlans = $developmentPlans;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("personalDetailsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function cpd()
    {
        return view('appraisal.user.form.cpd');
    }
    public function cpdSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $royalCollege = $request->royalCollege;
            $annualCertificate = $request->annualCertificate;
            $additionalCPD = $request->additionalCPD;
            $cpdDiary = $request->cpdDiary;
            $practice = $request->practice;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            // dd($request->all(),count($request->credit));

            $roles = [];
            try {
                for ($i = 0; $i < count($request->credit); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_credit = $request->credit[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_credit or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,
                            "credit" => $_credit,
                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->cpd->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $cpd = [
                "royalCollege" => $royalCollege,
                "annualCertificate" => $annualCertificate,
                "additionalCPD" => $additionalCPD,
                "cpdDiary" => $cpdDiary,
                "practice" => $practice,
                "comments" => $comments,
                "roles" => $roles,
            ];

            // dd($cpd);

            $content->cpd = $cpd;


            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("cpdSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function qualityImprovement()
    {
        return view('appraisal.user.form.quality-improvement');
    }
    public function qualityImprovementSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $practice = $request->practice;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $roles = [];
            try {
                for ($i = 0; $i < count($request->roles); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,

                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->qualityImprovement->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $qualityImprovement = [
                "practice" => $practice,
                "comments" => $comments,
                "roles" => $roles,
            ];

            $content->qualityImprovement = $qualityImprovement;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("qualityImprovementSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function significantEvents()
    {
        return view('appraisal.user.form.significant-events');
    }
    public function significantEventsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $sigEvents = $request->significantEvents;
            $practice = $request->practice;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $roles = [];
            try {
                for ($i = 0; $i < count($request->roles); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,
                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->significantEvents->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $significantEvents = [
                "sigEvents" => $sigEvents,
                "practice" => $practice,
                "comments" => $comments,
                "roles" => $roles,
            ];

            $content->significantEvents = $significantEvents;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("significantEventsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function feedback()
    {
        return view('appraisal.user.form.feedback');
    }
    public function feedbackSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $colleagueFeedback = $request->colleagueFeedback;
            $colleagueFeedbackDate = $request->colleagueFeedbackDate;
            $colleagueRevalidation = $request->colleagueRevalidation;
            $patientFeedback = $request->patientFeedback;
            $patientFeedbackDate = $request->patientFeedbackDate;
            $patientRevalidation = $request->patientRevalidation;
            $practice = $request->practice;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);


            $roles = [];
            try {
                for ($i = 0; $i < count($request->roles); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,
                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->feedback->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $feedback = [
                "colleagueFeedback" => $colleagueFeedback,
                "colleagueFeedbackDate" => $colleagueFeedbackDate,
                "colleagueRevalidation" => $colleagueRevalidation,
                "patientFeedback" => $patientFeedback,
                "patientRevalidation" => $patientRevalidation,
                "practice" => $practice,
                "comments" => $comments,
                "roles" => $roles,
            ];


            $content->feedback = $feedback;


            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("cpdSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function complaints()
    {
        return view('appraisal.user.form.complaints');
    }
    public function complaintsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $complaintsStatus = $request->complaintsStatus;
            $actionsTaken = $request->actionsTaken;
            $feedback = $request->feedback;
            $practice = $request->practice;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $roles = [];
            try {
                for ($i = 0; $i < count($request->roles); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,
                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->complaints->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $complaints = [
                "complaintsStatus" => $complaintsStatus,
                "actionsTaken" => $actionsTaken,
                "feedback" => $feedback,
                "practice" => $practice,
                "comments" => $comments,
                "roles" => $roles,
            ];

            $content->complaints = $complaints;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("complaintsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }

    public function achievements()
    {
        return view('appraisal.user.form.achievements');
    }
    public function achievementsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $includeDocuments = $request->includeDocuments;
            $challange = $request->challange;
            $aspirations = $request->aspirations;
            $discuss = $request->discuss;
            $comments = $request->comments;

            $achievements = [
                "includeDocuments" => $includeDocuments,
                "challange" => $challange,
                "aspirations" => $aspirations,
                "discuss" => $discuss,
                "comments" => $comments
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->achievements = $achievements;
            // dd($achievements,$content->achievements);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("achievementsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function probity()
    {
        return view('appraisal.user.form.probity');
    }
    public function probitySubmit(Request $request)
    {
        try {

            // dd($request->all());

            $probityConfirm = $request->probityConfirm;
            $probityDeclaration = $request->probityDeclaration;
            $gmcOrOther = $request->gmcOrOther;
            $healthConfirm = $request->healthConfirm;
            $comments = $request->comments;

            $probity = [
                "probityConfirm" => $probityConfirm,
                "probityDeclaration" => $probityDeclaration,
                "gmcOrOther" => $gmcOrOther,
                "healthConfirm" => $healthConfirm,
                "comments" => $comments
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->probity = $probity;
            // dd($probity,$content->probity);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("probitySubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function additionalInfo()
    {
        return view('appraisal.user.form.additional-info');
    }
    public function additionalInfoSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $specInfo = $request->specInfo;
            $appropriate = $request->appropriate;
            $comments = $request->comments;

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $roles = [];
            try {
                for ($i = 0; $i < count($request->roles); $i++) {

                    $_roles = $request->roles[$i];
                    $_dateAndBrief = $request->dateAndBrief[$i];
                    $_outcomes = $request->outcomes[$i];
                    $_supportingInfo = $request->supportingInfo[$i];

                    if (
                        $_roles or
                        $_dateAndBrief or
                        $_outcomes or
                        $_supportingInfo
                    ) {
                        $r = [
                            "roles" => $_roles,
                            "dateAndBrief" => $_dateAndBrief,
                            "outcomes" => $_outcomes,
                            "supportingInfo" => $_supportingInfo,
                        ];

                        if ($_supportingInfo == "Attached") {

                            $new_filename = "";
                            $_req_attachmentFile = "supportingInfoAttachment_" . $i;
                            $attachmentFile = $request->file($_req_attachmentFile);

                            if ($attachmentFile) {
                                $time = time();
                                $original_filename = substr($attachmentFile->getClientOriginalName(), 0, strrpos($attachmentFile->getClientOriginalName(), '.'));
                                $file_extension = $attachmentFile->getClientOriginalExtension();
                                $new_filename = $original_filename . "_" . $time . "." . $file_extension;
                                $attachmentFile_path = $attachmentFile->storeAs('public/apr/file', $new_filename);
                                $attachmentFile_path = "storage/" . $attachmentFile_path;
                            }

                            if (!$new_filename) {
                                try {
                                    $new_filename = $content->additionalInfo->new_filename;
                                } catch (\Throwable $th) {
                                }
                            }
                            $r["new_filename"] = $new_filename;
                        } else {
                            $_req_log = "supportingInfoLog_" . $i;
                            if ($request->$_req_log == 'on') {
                                $r["log"] = true;
                            } else {
                                $r["log"] = false;
                            }
                        }

                        array_push($roles, $r);
                    }
                }
            } catch (Exception $e) {
            }

            $additionalInfo = [
                "specInfo" => $specInfo,
                "appropriate" => $appropriate,
                "comments" => $comments,
                "roles" => $roles,
            ];

            $content->additionalInfo = $additionalInfo;

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("additionalInfoSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function supportingInfo()
    {
        return view('appraisal.user.form.supporting-info');
    }

    public function gmcDomains()
    {
        return view('appraisal.user.form.gmc-domains');
    }
    public function gmcDomainsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $knowledge = $request->knowledge;
            $safety = $request->safety;
            $communication = $request->communication;
            $trust = $request->trust;
            $comments = $request->comments;

            $gmcDomain = [
                "knowledge" => $knowledge,
                "safety" => $safety,
                "communication" => $communication,
                "trust" => $trust,
                "comments" => $comments
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->gmcDomain = $gmcDomain;
            // dd($supportingInfo,$content->supportingInfo);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("gmcDomainsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function checklist()
    {
        return view('appraisal.user.form.checklist');
    }
    public function checklistSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $what_this_checklist_is_for = $request->what_this_checklist_is_for;
            $previous_appraisal_record = $request->previous_appraisal_record;
            $scope_of_work = $request->scope_of_work;
            $reflection = $request->reflection;
            $confidentiality = $request->confidentiality;
            $personal_details = $request->personal_details;
            $overall = $request->overall;
            $review_of_last_year_pdp = $request->review_of_last_year_pdp;
            $cpd = $request->cpd;
            $quality_improvement_activities = $request->quality_improvement_activities;
            $significant_events = $request->significant_events;
            $feedback_from_colleagues = $request->feedback_from_colleagues;
            $feedback_from_patients = $request->feedback_from_patients;
            $complaints_and_compliments = $request->complaints_and_compliments;
            $achievements_challenges_aspirations = $request->achievements_challenges_aspirations;
            $probity_declaration = $request->probity_declaration;
            $health_declaration = $request->health_declaration;
            $additional_information = $request->additional_information;
            $review_of_gmc_good_medical_practice = $request->review_of_gmc_good_medical_practice;
            $new_pdp_ideas = $request->new_pdp_ideas;
            $confirm_agreement = $request->confirm_agreement;

            $checklist = [
                "what_this_checklist_is_for" => $what_this_checklist_is_for,
                "previous_appraisal_record" => $previous_appraisal_record,
                "scope_of_work" => $scope_of_work,
                "reflection" => $reflection,
                "confidentiality" => $confidentiality,
                "personal_details" => $personal_details,
                "overall" => $overall,
                "review_of_last_year_pdp" => $review_of_last_year_pdp,
                "cpd" => $cpd,
                "quality_improvement_activities" => $quality_improvement_activities,
                "significant_events" => $significant_events,
                "feedback_from_colleagues" => $feedback_from_colleagues,
                "feedback_from_patients" => $feedback_from_patients,
                "complaints_and_compliments" => $complaints_and_compliments,
                "achievements_challenges_aspirations" => $achievements_challenges_aspirations,
                "probity_declaration" => $probity_declaration,
                "health_declaration" => $health_declaration,
                "additional_information" => $additional_information,
                "review_of_gmc_good_medical_practice" => $review_of_gmc_good_medical_practice,
                "new_pdp_ideas" => $new_pdp_ideas,
                "confirm_agreement" => $confirm_agreement,
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->checklist = $checklist;
            // dd($checklist,$content->checklist);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("checklistSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function personalDevelopmentPlan()
    {
        return view('appraisal.user.form.personal-development-plan');
    }
    public function personalDevelopmentPlanSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $roles = [];
            try {
                for ($i = 0; $i < count($request->role); $i++) {

                    $_role = $request->role[$i];
                    $_detail = $request->detail[$i];

                    if (
                        $_role or
                        $_detail
                    ) {
                        $r = [
                            "role" => $_role,
                            "detail" => $_detail,
                        ];
                        array_push($roles, $r);
                    }
                }
            } catch (\Throwable $th) {
            }

            $personalDevelopmentPlanInfo = [
                "roles" => $roles
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->personalDevelopmentPlanInfo = $personalDevelopmentPlanInfo;
            // dd($personalDevelopmentPlanInfo,$content->personalDevelopmentPlanInfo);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("personalDevelopmentPlanSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function summary()
    {
        return view('appraisal.user.form.summary');
    }
    public function summarySubmit(Request $request)
    {
        try {

            // dd($request->all());

            $scope_of_work = $request->scope_of_work;
            $personal_development_plans = $request->personal_development_plans;
            $continuing_professional_development = $request->continuing_professional_development;
            $quality_improvement_activity = $request->quality_improvement_activity;
            $significant_events = $request->significant_events;
            $feedback_colleagues_patients = $request->feedback_colleagues_patients;
            $review_complaints_procedures = $request->review_complaints_procedures;
            $achievements_challenges_aspirations = $request->achievements_challenges_aspirations;
            $additional_information = $request->additional_information;
            $context_general_summary = $request->context_general_summary;
            $domain1_knowledge_skills = $request->domain1_knowledge_skills;
            $domain2_safety_quality = $request->domain2_safety_quality;
            $domain3_communication = $request->domain3_communication;
            $domain4_maintaining_trust = $request->domain4_maintaining_trust;

            $summary = [
                "scope_of_work" => $scope_of_work,
                "personal_development_plans" => $personal_development_plans,
                "continuing_professional_development" => $continuing_professional_development,
                "quality_improvement_activity" => $quality_improvement_activity,
                "significant_events" => $significant_events,
                "feedback_colleagues_patients" => $feedback_colleagues_patients,
                "review_complaints_procedures" => $review_complaints_procedures,
                "achievements_challenges_aspirations" => $achievements_challenges_aspirations,
                "additional_information" => $additional_information,
                "context_general_summary" => $context_general_summary,
                "domain1_knowledge_skills" => $domain1_knowledge_skills,
                "domain2_safety_quality" => $domain2_safety_quality,
                "domain3_communication" => $domain3_communication,
                "domain4_maintaining_trust" => $domain4_maintaining_trust,
            ];

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->summary = $summary;
            // dd($summary,$content->summary);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("summarySubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function outputs()
    {
        return view('appraisal.user.form.outputs');
    }
    public function outputsSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $statement_1 = $request->statement_1;
            $statement_2 = $request->statement_2;
            $statement_3 = $request->statement_3;
            $statement_4 = $request->statement_4;
            $statement_5 = $request->statement_5;
            $appraiser_comments = $request->appraiser_comments;
            $additional_issues = $request->additional_issues;
            $doctor_response = $request->doctor_response;
            $doctor_confirmation = $request->doctor_confirmation;
            $doctor_full_name = $request->doctor_full_name;
            $doctor_gmc_number = $request->doctor_gmc_number;
            $appraiser_confirmation = $request->appraiser_confirmation;
            $appraiser_full_name = $request->appraiser_full_name;
            $appraiser_gmc_number = $request->appraiser_gmc_number;
            $appraisal_date = $request->appraisal_date;

            $outputs = [
                "statement_1" => $statement_1,
                "statement_2" => $statement_2,
                "statement_3" => $statement_3,
                "statement_4" => $statement_4,
                "statement_5" => $statement_5,
                "appraiser_comments" => $appraiser_comments,
                "additional_issues" => $additional_issues,
                "doctor_response" => $doctor_response,
                "doctor_confirmation" => $doctor_confirmation,
                "doctor_full_name" => $doctor_full_name,
                "doctor_gmc_number" => $doctor_gmc_number,
                "appraiser_confirmation" => $appraiser_confirmation,
                "appraiser_full_name" => $appraiser_full_name,
                "appraiser_gmc_number" => $appraiser_gmc_number,
                "appraisal_date" => $appraisal_date
            ];

            // dd($outputs);

            $appraisaUser = AppraisaUser::where('email', Auth::user()->email)->first();

            $content = json_decode($appraisaUser->content);

            $content->outputs = $outputs;
            // dd($outputs,$content->outputs);

            $appraisaUser->content = json_encode($content);
            $appraisaUser->save();

            return back()->with('success', 'Saving successful');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("outputsSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function completion()
    {
        return view('appraisal.user.form.completion');
    }



    // PDF ============

    // private $sections = [
    //     1 => 'Welcome',
    //     2 => 'Guidance notes',
    //     3 => 'Personal details',
    //     4 => 'Scope of work',
    //     5 => 'Continuing professional development',
    //     6 => 'Quality improvement activity',
    //     7 => 'Significant events',
    //     8 => 'Feedback from colleagues',
    //     9 => 'Feedback from patients',
    //     10 => 'Complaints and compliments',
    //     11 => 'Probity and health',
    //     12 => 'Conduct and performance concerns',
    //     13 => 'Development needs',
    //     14 => 'Learning and development plan',
    //     15 => 'Previous year\'s development plan',
    //     16 => 'Goals and challenges',
    //     17 => 'Support and resources',
    //     18 => 'Appraiser\'s assessment',
    //     19 => 'Summary of appraisal discussion',
    //     20 => 'Recommendations',
    //     21 => 'Declarations'
    // ];

    public function generatePDF(Request $request)
    {

        try {

            $s = $request->s ?? 1;
            $e = $request->e ?? 21;
            $s1 = $request->s1;
            $e1 = $request->e1;
            $u = $request->u;

            $appraisal = null;

            if (Auth::user()) {
                $appraisal = AppraisaUser::where('email', Auth::user()->email)->first();
            } elseif ($u) {
                $appraisal = AppraisaUser::where('id', $u)->first();
            }

            if (!$appraisal) {
                return back()->with('fail', 'Something went wrong!!');
            }

            $content = json_decode($appraisal->content);
            $appraisalData = $this->getAppraisalData($content);

            // dd($appraisalData);

            // Configure mPDF for A4 landscape
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4-L', // A4 Landscape
                'orientation' => 'L',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 25,
                'margin_bottom' => 25,
                'margin_header' => 5,
                'margin_footer' => 5,
                'default_font' => 'Arial'
            ]);

            // Set document properties
            $mpdf->SetTitle('Medical Appraisal Guide - ' . ($appraisalData['doctor_name'] ?? 'Unknown'));
            $mpdf->SetAuthor('NHS England');
            $mpdf->SetCreator('Medical Appraisal System');

            // Define header and footer
            $header = View::make('pdf.appraisal.layout.header', compact('appraisalData'))->render();
            $footer = View::make('pdf.appraisal.layout.footer', compact('appraisalData'))->render();

            $mpdf->SetHTMLHeader($header);
            $mpdf->SetHTMLFooter($footer);

            // Generate all sections
            $sections = $this->getSections();
            $htmlContent = '';

            for ($i = $s - 1; $i < $e; $i++) {

                $sectionNumber = $i + 1;
                $sectionData = $appraisalData['sections'][$sectionNumber] ?? [];

                // Add page break before each section (except first)
                if ($i > $s) {
                    $htmlContent .= '<pagebreak />';
                }

                $sectionHtml = View::make("pdf.appraisal.sections.section-{$sectionNumber}", [
                    'sectionNumber' => $sectionNumber,
                    'sectionTitle' => $sections[$i]['title'],
                    'sectionData' => $sectionData,
                    'appraisalData' => $appraisalData,
                    'totalSections' => count($sections)
                ])->render();

                $htmlContent .= $sectionHtml;
            }

            if ($s1 and $e1) {
                for ($i = $s1 - 1; $i < $e1; $i++) {

                    $sectionNumber = $i + 1;
                    $sectionData = $appraisalData['sections'][$sectionNumber] ?? [];

                    // Add page break before each section (except first)
                    if ($i > $s1) {
                        $htmlContent .= '<pagebreak />';
                    }

                    $sectionHtml = View::make("pdf.appraisal.sections.section-{$sectionNumber}", [
                        'sectionNumber' => $sectionNumber,
                        'sectionTitle' => $sections[$i]['title'],
                        'sectionData' => $sectionData,
                        'appraisalData' => $appraisalData,
                        'totalSections' => count($sections)
                    ])->render();

                    $htmlContent .= $sectionHtml;
                }
            }

            // Add CSS styles
            $css = View::make('pdf.appraisal.layout.style')->render();
            $mpdf->WriteHTML($css, 1); // 1 = CSS mode
            $mpdf->WriteHTML($htmlContent, 2); // 2 = HTML mode

            // Ensure directory exists
            $directory = 'public/apr/pdf';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Generate filename
            $filename = 'medical_appraisal_' . ($appraisalData['gmc_number'] ?? 'unknown') . '_' . date('Y-m-d_H-i-s') . '.pdf';
            $filepath = storage_path('app/' . $directory . '/' . $filename);

            // dd("4");


            // Save PDF
            $mpdf->Output($filepath, Destination::FILE);

            return response()->file($filepath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ]);

            // Return response
            return response()->json([
                'success' => true,
                'message' => 'PDF generated successfully',
                'filename' => $filename,
                'path' => $directory . '/' . $filename,
                'download_url' => route('appraisal.user.completion.download.pdf', ['filename' => $filename])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadFIle($file)
    {
        $filepath = storage_path('app/public/apr/file/' . $file);

        if (!file_exists($filepath)) {
            abort(404, 'file not found');
        }

        return response()->download($filepath);
    }

    public function downloadPdf($filename)
    {

        $filepath = storage_path('app/public/apr/pdf/' . $filename);

        if (!file_exists($filepath)) {
            abort(404, 'file not found');
        }

        return response()->download($filepath);
    }

    private function getAppraisalData($content)
    {

        // dd($content);

        // personalDetails ===========
        $pd_name = "";
        $pd_gmcNumber = "";
        $pd_address = "";
        $pd_phone = "";
        $pd_email = "";
        $pd_yearOfAppraisal = "";
        $pd_revalidationRecommendation = "";
        $pd_clinicalAcademic = "";
        $pd_medicalQualifications = "";
        $pd_secondAppraiser = "";
        $pd_designation = "";

        try {
            if ($content->personalDetails) {
                $pd_name = $content->personalDetails->name;
                $pd_gmcNumber = $content->personalDetails->gmcNumber;
                $pd_address = $content->personalDetails->address;
                $pd_phone = $content->personalDetails->phone;
                $pd_email = $content->personalDetails->email;
                $pd_yearOfAppraisal = $content->personalDetails->yearOfAppraisal;
                $pd_revalidationRecommendation = $content->personalDetails->revalidationRecommendation;
                $pd_medicalQualifications = $content->personalDetails->medicalQualifications;
                $pd_clinicalAcademic = $content->personalDetails->clinicalAcademic;
                $pd_secondAppraiser = $content->personalDetails->secondAppraiser;
                $pd_designation = $content->personalDetails->designation;
            }
        } catch (\Throwable $th) {
        }
        // dd($pd_clinicalAcademic);

        // WORK OF SCOPE ===========
        $ws_relationship = '';
        $ws_envisageNextYear = '';
        $ws_comment = '';
        $ws_roles = null;

        try {

            if ($content->workOfScope) {
                $ws_relationship = $content->workOfScope->relationship;
                $ws_envisageNextYear = $content->workOfScope->envisageNextYear;
                $ws_comment = $content->workOfScope->comment;
                $ws_roles = $content->workOfScope->roles;
            }
        } catch (\Throwable $th) {
        }

        // RECORD OF ANNUAL APPRAISALS ===========
        $an_firstAppraisal = '';
        $an_lastAppraisalDate = '';
        $an_hasChanged = '';
        $an_appraiserName = '';
        $an_designatedBody = '';
        $an_responsibleOfficer = 'null';
        $an_new_filename = 'null';

        try {

            if ($content->annualAppraisals) {
                $an_firstAppraisal = $content->annualAppraisals->firstAppraisal;
                $an_lastAppraisalDate = $content->annualAppraisals->lastAppraisalDate;
                $an_hasChanged = $content->annualAppraisals->hasChanged;
                $an_appraiserName = $content->annualAppraisals->appraiserName;
                $an_designatedBody = $content->annualAppraisals->designatedBody;
                $an_responsibleOfficer = $content->annualAppraisals->responsibleOfficer;
                $an_new_filename = $content->annualAppraisals->new_filename;
            }
        } catch (\Throwable $th) {
        }

        // PERSONAL DEVELOPMENT ===========
        $dp_generalComments = '';
        $dp_appraisersComments = '';
        $dp_roles = null;

        try {

            if ($content->developmentPlans) {
                $an_firstAppraisal = $content->developmentPlans->generalComments;
                $an_lastAppraisalDate = $content->developmentPlans->appraisersComments;
                $dp_roles = $content->developmentPlans->jobRoles;
            }
        } catch (\Throwable $th) {
        }

        // CPD ===========
        $cpd_royalCollege = null;
        $cpd_annualCertificate = null;
        $cpd_additionalCPD = null;
        $cpd_cpdDiary = null;
        $cpd_practice = null;
        $cpd_comments = null;
        $cpd_roles = null;

        try {

            if ($content->cpd) {
                $cpd_royalCollege = $content->cpd->royalCollege;
                $cpd_annualCertificate = $content->cpd->annualCertificate;
                $cpd_additionalCPD = $content->cpd->additionalCPD;
                $cpd_cpdDiary = $content->cpd->cpdDiary;
                $cpd_practice = $content->cpd->practice;
                $cpd_comments = $content->cpd->comments;
                $cpd_roles = $content->cpd->roles;
            }
        } catch (\Throwable $th) {
        }

        // QUALITY IMPROVEMENT ===========
        $qi_practice = null;
        $qi_comments = null;
        $qi_roles = null;

        try {

            if ($content->qualityImprovement) {
                $qi_practice = $content->qualityImprovement->practice;
                $qi_comments = $content->qualityImprovement->comments;
                $qi_roles = $content->qualityImprovement->roles;
            }
        } catch (\Throwable $th) {
        }

        // SIGNIFICANT EVENTS ===========
        $se_sigEvents = null;
        $se_practice = null;
        $se_comments = null;
        $se_roles = null;

        try {

            if ($content->significantEvents) {
                $se_sigEvents = $content->significantEvents->sigEvents;
                $se_practice = $content->significantEvents->practice;
                $se_comments = $content->significantEvents->comments;
                $se_roles = $content->significantEvents->roles;
            }
        } catch (\Throwable $th) {
        }

        // FEEDBACK FROM COLLEAGUES AND PATIENTS ===========
        $fb_colleagueFeedback = null;
        $fb_colleagueFeedbackDate = null;
        $fb_colleagueRevalidation = null;
        $fb_patientFeedback = null;
        $fb_patientFeedbackDate = null;
        $fb_patientRevalidation = null;
        $fb_practice = null;
        $fb_comments = null;
        $fb_roles = null;

        try {

            if ($content->feedback) {
                $fb_colleagueFeedback = $content->feedback->colleagueFeedback;
                $fb_colleagueFeedbackDate = $content->feedback->colleagueFeedbackDate;
                $fb_colleagueRevalidation = $content->feedback->colleagueRevalidation;
                $fb_patientFeedback = $content->feedback->patientFeedback;
                $fb_patientFeedbackDate = $content->feedback->patientFeedbackDate;
                $fb_practice = $content->feedback->practice;
                $fb_comments = $content->feedback->comments;
                $fb_roles = $content->feedback->roles;
                $fb_patientRevalidation = $content->feedback->patientRevalidation;
            }
        } catch (\Throwable $th) {
        }

        // REVIEW OF COMPLAINTS AND COMPLIMENTS ===========
        $com_complaintsStatus = null;
        $com_actionsTaken = null;
        $com_feedback = null;
        $com_roles = null;
        $com_comments = null;

        try {

            if ($content->complaints) {
                $com_complaintsStatus = $content->complaints->complaintsStatus;
                $com_actionsTaken = $content->complaints->actionsTaken;
                $com_feedback = $content->complaints->feedback;
                $com_roles = $content->complaints->roles;
                $com_comments = $content->complaints->comments;
            }
        } catch (\Throwable $th) {
        }

        // ACHIEVEMENTS, CHALLENGES AND ASPIRATIONS ===========
        $ac_includeDocuments = null;
        $ac_challange = null;
        $ac_aspirations = null;
        $ac_discuss = null;
        $ac_comments = null;

        try {
            if ($content->achievements) {
                $ac_includeDocuments = $content->achievements->includeDocuments;
                $ac_challange = $content->achievements->challange;
                $ac_aspirations = $content->achievements->aspirations;
                $ac_discuss = $content->achievements->discuss;
                $ac_comments = $content->achievements->comments;
            }
        } catch (\Throwable $th) {
        }

        // PROBITY AND HEALTH STATEMENTS ===========
        $pb_probityConfirm = null;
        $pb_probityDeclaration = null;
        $pb_gmcOrOther = null;
        $pb_healthConfirm = null;
        $pb_comments = null;

        try {
            if ($content->probity) {
                $pb_probityConfirm = $content->probity->probityConfirm;
                $pb_probityDeclaration = $content->probity->probityDeclaration;
                $pb_gmcOrOther = $content->probity->gmcOrOther;
                $pb_healthConfirm = $content->probity->healthConfirm;
                $pb_comments = $content->probity->comments;
            }
        } catch (\Throwable $th) {
        }

        // ADDITIONAL INFORMATION ===========
        $ad_specInfo = null;
        $ad_appropriate = null;
        $ad_roles = null;
        $ad_comments = null;

        try {
            if ($content->additionalInfo) {
                $ad_specInfo = $content->additionalInfo->specInfo;
                $ad_appropriate = $content->additionalInfo->appropriate;
                $ad_roles = $content->additionalInfo->roles;
                $ad_comments = $content->additionalInfo->comments;
            }
        } catch (\Throwable $th) {
        }


        // REVIEW OF GMC GOOD MEDICAL PRACTICE DOMAINS ===========
        $gmc_knowledge = null;
        $gmc_safety = null;
        $gmc_communication = null;
        $gmc_trust = null;
        $gmc_comments = null;

        try {
            if ($content->gmcDomain) {
                $gmc_knowledge = $content->gmcDomain->knowledge;
                $gmc_safety = $content->gmcDomain->safety;
                $gmc_communication = $content->gmcDomain->communication;
                $gmc_trust = $content->gmcDomain->trust;
                $gmc_comments = $content->gmcDomain->comments;
            }
        } catch (\Throwable $th) {
        }

        // APPRAISAL CHECKLIST ===========
        $ck_what_this_checklist_is_for = null;
        $ck_previous_appraisal_record = null;
        $ck_scope_of_work = null;
        $ck_reflection = null;
        $ck_confidentiality = null;
        $ck_personal_details = null;
        $ck_overall = null;
        $ck_review_of_last_year_pdp = null;
        $ck_cpd = null;
        $ck_quality_improvement_activities = null;
        $ck_significant_events = null;
        $ck_feedback_from_colleagues = null;
        $ck_feedback_from_patients = null;
        $ck_complaints_and_compliments = null;
        $ck_achievements_challenges_aspirations = null;
        $ck_probity_declaration = null;
        $ck_health_declaration = null;
        $ck_additional_information = null;
        $ck_review_of_gmc_good_medical_practice = null;
        $ck_new_pdp_ideas = null;
        $ck_confirm_agreement = null;

        try {
            if ($content->checklist) {
                $ck_what_this_checklist_is_for = $content->checklist->what_this_checklist_is_for;
                $ck_previous_appraisal_record = $content->checklist->previous_appraisal_record;
                $ck_scope_of_work = $content->checklist->scope_of_work;
                $ck_reflection = $content->checklist->reflection;
                $ck_confidentiality = $content->checklist->confidentiality;
                $ck_personal_details = $content->checklist->personal_details;
                $ck_overall = $content->checklist->overall;
                $ck_review_of_last_year_pdp = $content->checklist->review_of_last_year_pdp;
                $ck_cpd = $content->checklist->cpd;
                $ck_quality_improvement_activities = $content->checklist->quality_improvement_activities;
                $ck_significant_events = $content->checklist->significant_events;
                $ck_feedback_from_colleagues = $content->checklist->feedback_from_colleagues;
                $ck_feedback_from_patients = $content->checklist->feedback_from_patients;
                $ck_complaints_and_compliments = $content->checklist->complaints_and_compliments;
                $ck_achievements_challenges_aspirations = $content->checklist->achievements_challenges_aspirations;
                $ck_probity_declaration = $content->checklist->probity_declaration;
                $ck_health_declaration = $content->checklist->health_declaration;
                $ck_additional_information = $content->checklist->additional_information;
                $ck_review_of_gmc_good_medical_practice = $content->checklist->review_of_gmc_good_medical_practice;
                $ck_new_pdp_ideas = $content->checklist->new_pdp_ideas;
                $ck_confirm_agreement = $content->checklist->confirm_agreement;
            }
        } catch (\Throwable $th) {
        }

        // THE AGREED PERSONAL DEVELOPMENT PLAN ===========
        $pd_roles = null;

        try {
            if ($content->personalDevelopmentPlanInfo) {
                $pd_roles = $content->personalDevelopmentPlanInfo->roles;
            }
        } catch (\Throwable $th) {
        }

        // SUMMARY OF THE APPRAISAL DISCUSSION ===========
        $sm_scope_of_work = null;
        $sm_personal_development_plans = null;
        $sm_continuing_professional_development = null;
        $sm_quality_improvement_activity = null;
        $sm_significant_events = null;
        $sm_feedback_colleagues_patients = null;
        $sm_review_complaints_procedures = null;
        $sm_achievements_challenges_aspirations = null;
        $sm_additional_information = null;
        $sm_context_general_summary = null;
        $sm_domain1_knowledge_skills = null;
        $sm_domain2_safety_quality = null;
        $sm_domain3_communication = null;
        $sm_domain4_maintaining_trust = null;

        try {
            if ($content->summary) {
                $sm_scope_of_work = $content->summary->scope_of_work;
                $sm_personal_development_plans = $content->summary->personal_development_plans;
                $sm_continuing_professional_development = $content->summary->continuing_professional_development;
                $sm_quality_improvement_activity = $content->summary->quality_improvement_activity;
                $sm_significant_events = $content->summary->significant_events;
                $sm_feedback_colleagues_patients = $content->summary->feedback_colleagues_patients;
                $sm_review_complaints_procedures = $content->summary->review_complaints_procedures;
                $sm_achievements_challenges_aspirations = $content->summary->achievements_challenges_aspirations;
                $sm_additional_information = $content->summary->additional_information;
                $sm_context_general_summary = $content->summary->context_general_summary;
                $sm_domain1_knowledge_skills = $content->summary->domain1_knowledge_skills;
                $sm_domain2_safety_quality = $content->summary->domain2_safety_quality;
                $sm_domain3_communication = $content->summary->domain3_communication;
                $sm_domain4_maintaining_trust = $content->summary->domain4_maintaining_trust;
            }
        } catch (\Throwable $th) {
        }


        // APPRAISAL OUTPUTS ===========
        $out_statement_1 = null;
        $out_statement_2 = null;
        $out_statement_3 = null;
        $out_statement_4 = null;
        $out_statement_5 = null;
        $out_appraiser_comments = null;
        $out_additional_issues = null;
        $out_doctor_response = null;
        $out_doctor_confirmation = null;
        $out_doctor_full_name = null;
        $out_doctor_gmc_number = null;
        $out_appraiser_confirmation = null;
        $out_appraiser_full_name = null;
        $out_appraiser_gmc_number = null;
        $out_appraisal_date = null;

        try {
            if ($content->outputs) {
                $out_statement_1 = $content->outputs->statement_1;
                $out_statement_2 = $content->outputs->statement_2;
                $out_statement_3 = $content->outputs->statement_3;
                $out_statement_4 = $content->outputs->statement_4;
                $out_statement_5 = $content->outputs->statement_5;
                $out_appraiser_comments = $content->outputs->appraiser_comments;
                $out_additional_issues = $content->outputs->additional_issues;
                $out_doctor_response = $content->outputs->doctor_response;
                $out_doctor_confirmation = $content->outputs->doctor_confirmation;
                $out_doctor_full_name = $content->outputs->doctor_full_name;
                $out_doctor_gmc_number = $content->outputs->doctor_gmc_number;
                $out_appraiser_confirmation = $content->outputs->appraiser_confirmation;
                $out_appraiser_full_name = $content->outputs->appraiser_full_name;
                $out_appraiser_gmc_number = $content->outputs->appraiser_gmc_number;
                $out_appraisal_date = $content->outputs->appraisal_date;
            }
        } catch (\Throwable $th) {
        }

        // dd($ck_significant_events);


        // Replace this with your actual data retrieval logic
        // This should fetch data from your database based on the appraisal ID
        return [
            // PERSONAL DETAILS ===========
            "pd_name" => $pd_name,
            "pd_gmcNumber" => $pd_gmcNumber,
            "pd_address" => $pd_address,
            "pd_phone" => $pd_phone,
            "pd_email" => $pd_email,
            "pd_designation" => $pd_designation,
            "pd_medicalQualifications" => $pd_medicalQualifications,
            "pd_yearOfAppraisal" => $pd_yearOfAppraisal,
            "pd_revalidationRecommendation" => $pd_revalidationRecommendation,
            "pd_clinicalAcademic" => $pd_clinicalAcademic,
            "pd_secondAppraiser" => $pd_secondAppraiser,

            // WORK OF SCOPE ===========
            "ws_relationship" => $ws_relationship,
            "ws_envisageNextYear" => $ws_envisageNextYear,
            "ws_comment" => $ws_comment,
            "ws_roles" => $ws_roles,

            // RECORD OF ANNUAL APPRAISALS ===========
            "an_firstAppraisal" => $an_firstAppraisal,
            "an_lastAppraisalDate" => $an_lastAppraisalDate,
            "an_hasChanged" => $an_hasChanged,
            "an_appraiserName" => $an_appraiserName,
            "an_designatedBody" => $an_designatedBody,
            "an_responsibleOfficer" => $an_responsibleOfficer,
            "an_new_filename" => $an_new_filename,

            // PERSONAL DEVELOPMENT ===========
            "dp_generalComments" => $dp_generalComments,
            "dp_appraisersComments" => $dp_appraisersComments,
            "dp_roles" => $dp_roles,

            // CPD ===========
            "cpd_royalCollege" => $cpd_royalCollege,
            "cpd_annualCertificate" => $cpd_annualCertificate,
            "cpd_additionalCPD" => $cpd_additionalCPD,
            "cpd_cpdDiary" => $cpd_cpdDiary,
            "cpd_practice" => $cpd_practice,
            "cpd_comments" => $cpd_comments,
            "cpd_roles" => $cpd_roles,

            // QUALITY IMPROVEMENT ===========
            "qi_practice" => $qi_practice,
            "qi_comments" => $qi_comments,
            "qi_roles" => $qi_roles,

            // SIGNIFICANT EVENTS ===========
            "se_sigEvents" => $se_sigEvents,
            "se_practice" => $se_practice,
            "se_comments" => $se_comments,
            "se_roles" => $se_roles,

            // FEEDBACK FROM COLLEAGUES AND PATIENTS ===========
            "fb_colleagueFeedback" => $fb_colleagueFeedback,
            "fb_colleagueFeedbackDate" => $fb_colleagueFeedbackDate,
            "fb_colleagueRevalidation" => $fb_colleagueRevalidation,
            "fb_patientFeedback" => $fb_patientFeedback,
            "fb_patientFeedbackDate" => $fb_patientFeedbackDate,
            "fb_patientRevalidation" => $fb_patientRevalidation,
            "fb_practice" => $fb_practice,
            "fb_comments" => $fb_comments,
            "fb_roles" => $fb_roles,

            // REVIEW OF COMPLAINTS AND COMPLIMENTS ===========
            "com_complaintsStatus" => $com_complaintsStatus,
            "com_actionsTaken" => $com_actionsTaken,
            "com_feedback" => $com_feedback,
            "com_roles" => $com_roles,
            "com_comments" => $com_comments,

            // ACHIEVEMENTS, CHALLENGES AND ASPIRATIONS ===========
            "ac_includeDocuments" => $ac_includeDocuments,
            "ac_challange" => $ac_challange,
            "ac_aspirations" => $ac_aspirations,
            "ac_discuss" => $ac_discuss,
            "ac_comments" => $ac_comments,

            // PROBITY AND HEALTH STATEMENTS ===========
            "pb_probityConfirm" => $pb_probityConfirm,
            "pb_probityDeclaration" => $pb_probityDeclaration,
            "pb_gmcOrOther" => $pb_gmcOrOther,
            "pb_healthConfirm" => $pb_healthConfirm,
            "pb_comments" => $pb_comments,

            // ADDITIONAL INFORMATION ===========
            "ad_specInfo" => $ad_specInfo,
            "ad_appropriate" => $ad_appropriate,
            "ad_roles" => $ad_roles,
            "ad_comments" => $ad_comments,

            // REVIEW OF GMC GOOD MEDICAL PRACTICE DOMAINS ===========
            "gmc_knowledge" => $gmc_knowledge,
            "gmc_safety" => $gmc_safety,
            "gmc_communication" => $gmc_communication,
            "gmc_trust" => $gmc_trust,
            "gmc_comments" => $gmc_comments,

            // APPRAISAL CHECKLIST ===========
            "ck_what_this_checklist_is_for" => $ck_what_this_checklist_is_for,
            "ck_previous_appraisal_record" => $ck_previous_appraisal_record,
            "ck_scope_of_work" => $ck_scope_of_work,
            "ck_reflection" => $ck_reflection,
            "ck_confidentiality" => $ck_confidentiality,
            "ck_personal_details" => $ck_personal_details,
            "ck_overall" => $ck_overall,
            "ck_review_of_last_year_pdp" => $ck_review_of_last_year_pdp,
            "ck_cpd" => $ck_cpd,
            "ck_quality_improvement_activities" => $ck_quality_improvement_activities,
            "ck_significant_events" => $ck_significant_events,
            "ck_feedback_from_colleagues" => $ck_feedback_from_colleagues,
            "ck_feedback_from_patients" => $ck_feedback_from_patients,
            "ck_complaints_and_compliments" => $ck_complaints_and_compliments,
            "ck_achievements_challenges_aspirations" => $ck_achievements_challenges_aspirations,
            "ck_probity_declaration" => $ck_probity_declaration,
            "ck_health_declaration" => $ck_health_declaration,
            "ck_additional_information" => $ck_additional_information,
            "ck_review_of_gmc_good_medical_practice" => $ck_review_of_gmc_good_medical_practice,
            "ck_new_pdp_ideas" => $ck_new_pdp_ideas,
            "ck_confirm_agreement" => $ck_confirm_agreement,

            // THE AGREED PERSONAL DEVELOPMENT PLAN ===========
            "pd_roles" => $pd_roles,

            // SUMMARY OF THE APPRAISAL DISCUSSION ===========
            "sm_scope_of_work" => $sm_scope_of_work,
            "sm_personal_development_plans" => $sm_personal_development_plans,
            "sm_continuing_professional_development" => $sm_continuing_professional_development,
            "sm_quality_improvement_activity" => $sm_quality_improvement_activity,
            "sm_significant_events" => $sm_significant_events,
            "sm_feedback_colleagues_patients" => $sm_feedback_colleagues_patients,
            "sm_review_complaints_procedures" => $sm_review_complaints_procedures,
            "sm_achievements_challenges_aspirations" => $sm_achievements_challenges_aspirations,
            "sm_additional_information" => $sm_additional_information,
            "sm_context_general_summary" => $sm_context_general_summary,
            "sm_domain1_knowledge_skills" => $sm_domain1_knowledge_skills,
            "sm_domain2_safety_quality" => $sm_domain2_safety_quality,
            "sm_domain3_communication" => $sm_domain3_communication,
            "sm_domain4_maintaining_trust" => $sm_domain4_maintaining_trust,

            // APPRAISAL OUTPUTS ===========
            "out_statement_1" => $out_statement_1,
            "out_statement_2" => $out_statement_2,
            "out_statement_3" => $out_statement_3,
            "out_statement_4" => $out_statement_4,
            "out_statement_5" => $out_statement_5,
            "out_appraiser_comments" => $out_appraiser_comments,
            "out_additional_issues" => $out_additional_issues,
            "out_doctor_response" => $out_doctor_response,
            "out_doctor_confirmation" => $out_doctor_confirmation,
            "out_doctor_full_name" => $out_doctor_full_name,
            "out_doctor_gmc_number" => $out_doctor_gmc_number,
            "out_appraiser_confirmation" => $out_appraiser_confirmation,
            "out_appraiser_full_name" => $out_appraiser_full_name,
            "out_appraiser_gmc_number" => $out_appraiser_gmc_number,
            "out_appraisal_date" => $out_appraisal_date,

            'doctor_name' => '',
            // 'gmc_number' => '1234567',
            // 'contact_address' => '123 Medical Street, Healthcare City, HC1 2AB',
            // 'contact_telephone' => '+44 123 456 7890',
            // 'contact_email' => 'dr.smith@example.com',
            // 'designated_body' => 'NHS Trust Example',
            // 'appraiser_name' => 'Dr. Jane Doe',
            // 'year_of_appraisal' => '2024',
            // 'appraisal_date' => '2024-05-27',
            // 'due_date_next_revalidation' => '2025-05-27',
            // 'sections' => [
            //     1 => ['data' => 'Section 1 data'],
            //     2 => ['data' => 'Section 2 data'],
            //     // Add data for all 21 sections
            // ]
        ];
    }

    private function getSections()
    {
        return [
            ['title' => 'Contents'],
            ['title' => 'Instructions for using this form'],
            ['title' => 'Personal details'],
            ['title' => 'Scope of work'],
            ['title' => 'Record of annual appraisals'],
            ['title' => 'Personal development plans and their review'],
            ['title' => 'Continuing professional development (CPD)'],
            ['title' => 'Quality improvement activity'],
            ['title' => 'Significant events'],
            ['title' => 'Feedback from colleagues and patients'],
            ['title' => 'Review of complaints and compliments'],
            ['title' => 'Achievements, challenges and aspirations'],
            ['title' => 'Probity and health statements'],
            ['title' => 'Additional information'],
            ['title' => 'Supporting Information'],
            ['title' => 'Review of GMC Good Medical Practice domains'],
            ['title' => 'Appraisal checklist'],
            ['title' => 'The agreed personal development plan'],
            ['title' => 'Summary of the appraisal discussion'],
            ['title' => 'Appraisal outputs'],
            ['title' => 'Completion - save, lockdown and print']
        ];
    }

    // END PDF ============


    // DOWNLOAD FILES ========

    // END DOWNLOAD FILES ========



    public function adminIndex()
    {
        try {

            $users = AppraisaUser::latest()
                ->get();

            return view('admin.ap.appraisal-user', compact('users'));
        } catch (Exception $exception) {
            Log::channel("laravel")->info("adminIndex Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());
            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }

    public function store(StoreAppraisaUserRequest $request)
    {
        //
    }

    public function show(AppraisaUser $appraisaUser)
    {
        //
    }


    public function edit(AppraisaUser $appraisaUser)
    {
        //
    }


    public function update(UpdateAppraisaUserRequest $request, AppraisaUser $appraisaUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppraisaUser  $appraisaUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppraisaUser $appraisaUser)
    {
        //
    }

    // AUTH ============    
    public function register()
    {
        return view("appraisal.user.auth.register");
    }
    public function registerSubmit(AppraisalAuthRegisterRequest $request)
    {
        try {

            if ($request->password !== $request->confirmPassword) {
                return back()->withErrors(['password' => 'Passwords do not match.'])->withInput();
            }

            $name = $request->name;
            $email = $request->email;
            $contact = $request->contact;
            $password = Hash::make($request->password);

            $appraisaUser = AppraisaUser::create(
                $name,
                $email,
                $contact,
                $password
            );

            // MAIL TO USER
            $data["email"] = $email;
            $data["title"] = "Your Successfully registered - Safety First Medical Service";

            Mail::send('mail.auth.user.register', ['content' => $appraisaUser], function ($message) use ($data) {
                $message->to($data["email"], "");
                $message->subject($data["title"]);
            });

            // MAIL TO ADMIN
            // PENDING

            return redirect()->route('appraisal.user.emailConfirmation', ['e' => $appraisaUser->email])->with('success', 'Registered successfully. Please confirm your email.');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("registerSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());
            // return $exception->getMessage() . ' - line - ' . $exception->getLine();
            // dd($exception->getMessage() . ' - line - ' . $exception->getLine());
            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }

    public function resendOtp()
    {
        return view("appraisal.user.auth.resend-otp");
    }
     public function resendOtpSubmit(Request $request)
    {
        try {

            $email = $request->email;

            $appraisaUser = AppraisaUser::where("email", $email)->first();

            if ($appraisaUser) {

                $appraisaUser->otp = rand(100000, 999999);
                $appraisaUser->save();

                // MAIL TO USER
                $data["email"] = $email;
                $data["title"] = "New OTP - Safety First Medical Service";

                Mail::send('mail.auth.user.new-otp', ['content' => $appraisaUser], function ($message) use ($data) {
                    $message->to($data["email"], "");
                    $message->subject($data["title"]);
                });
            } else {
                return back()->with("fail", "Email is not found!!")->withInput();
            }

            return redirect()->route('appraisal.user.login', ['e' => $appraisaUser->email])->with('success', 'New OTP sending is success. Please confirm your email.');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("resendOtpSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());
            // return $exception->getMessage() . ' - line - ' . $exception->getLine();
            // dd($exception->getMessage() . ' - line - ' . $exception->getLine());
            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function emailConfirmation()
    {
        return view("appraisal.user.auth.email-confirmation");
    }
    public function emailConfirmationSubmit(EmailConfirmationRequest $request)
    {
        try {

            $email = $request->email;

            $otp = "";
            for ($i = 1; $i <= 6; $i++) {
                $otpId = "otp" . $i;
                $otp .= $request->$otpId;
            }

            $appraisaUser = AppraisaUser::where('email', $email)->first();
            if ($appraisaUser) {
                if ($appraisaUser->otp == $otp) {
                    $appraisaUser->email_verification = 1;
                    $appraisaUser->save();

                    return redirect()->route('appraisal.user.login', ['e' => $appraisaUser->email])->with('success', 'Email verfication is success. Please login to system.');
                }
                return back()->withErrors('Invalid OTP')->withInput();
            }

            return back()->withErrors('Invalid Email ID')->withInput();
        } catch (Exception $exception) {
            Log::channel("laravel")->info("emailConfirmationSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function passwordReset()
    {
        return view("appraisal.user.auth.password-reset");
    }
    public function passwordResetSubmit(Request $request)
    {
        try {

            // dd($request->all());

            $email = $request->email;

            $appraisaUser = AppraisaUser::where("email", $email)->first();

            if ($appraisaUser) {

                $password = rand(10000, 99999)."@sF";
                $appraisaUser->password = Hash::make($password);
                $appraisaUser->save();

                // MAIL TO USER
                $data["email"] = $email;
                $data["title"] = "Password Reset - Safety First Medical Service";

                Mail::send('mail.auth.user.password-reset', ['content' => $appraisaUser,'pw'=>$password], function ($message) use ($data) {
                    $message->to($data["email"], "");
                    $message->subject($data["title"]);
                });
            } else {
                return back()->with("fail", "Email is not found!!")->withInput();
            }

            return redirect()->route('appraisal.user.login', ['e' => $appraisaUser->email])->with('success', 'Registered successfully. Please confirm your email.');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("passwordResetSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());
            return $exception->getMessage() . ' - line - ' . $exception->getLine();
            dd($exception->getMessage() . ' - line - ' . $exception->getLine());
            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function login()
    {
        return view("appraisal.user.auth.login");
    }
    public function loginSubmit(LoginRequest $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = AppraisaUser::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }

            if ($user->email_verification == false) {
                return back()->withErrors([
                    'email' => 'Please verify your email address before logging in.',
                ])->onlyInput('email');
            }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('appraisal.user.index')->with('success', 'You have successfully logged in!');
        } catch (Exception $exception) {
            Log::channel("laravel")->info("emailConfirmationSubmit Exception occurs ==> " . $exception->getMessage() . ' - line - ' . $exception->getLine());

            return back()->withErrors('Something went wrong!!')->withInput();
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();                          // Log out the user
        $request->session()->invalidate();      // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/appraisal');                    // Redirect to homepage or login page
    }
    // END AUTH ============


}
