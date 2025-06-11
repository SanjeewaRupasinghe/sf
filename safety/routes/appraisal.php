<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\AppraisaUserController;
use Illuminate\Support\Facades\Auth;

Route::prefix('appraisal')->group(function () {

    Route::get('/', [AppraisalController::class, 'index'])->name('appraisal.index');
    Route::get('/faq', [AppraisalController::class, 'faq'])->name('appraisal.faq');
    Route::get('/terms', [AppraisalController::class, 'terms'])->name('appraisal.terms');
    Route::get('/paynow', [AppraisalController::class, 'paynow'])->name('appraisal.paynow');

    Route::get('/contact', [AppraisalController::class, 'contact'])->name('appraisal.contact');
    Route::post('/contact', [AppraisalController::class, 'contactMail'])->name('appraisal.contactMail');

    Route::get('/blogs', [AppraisalController::class, 'blogs'])->name('appraisal.blogs');
    Route::get('/blog/{slug}', [AppraisalController::class, 'blog'])->name('appraisal.blog');

    Route::get('/services/{slug?}', [AppraisalController::class, 'courses'])->name('appraisal.courses');
    Route::get('/service/{slug}', [AppraisalController::class, 'course'])->name('appraisal.course');
    Route::post('/register', [AppraisalController::class, 'registerMail'])->name('appraisal.registerMail');

    Route::get('/privacy', [AppraisalController::class, 'privacy'])->name('appraisal.privacy');
    Route::get('/shipping', [AppraisalController::class, 'shipping'])->name('appraisal.shipping');
    Route::get('/refund', [AppraisalController::class, 'refund'])->name('appraisal.refund');
    Route::get('/about', [AppraisalController::class, 'about'])->name('appraisal.about');
    Route::get('/career', [AppraisalController::class, 'career'])->name('appraisal.career');

    // USERS ============
    Route::get('/register', [AppraisaUserController::class, 'register'])->name('appraisal.user.register');
    Route::post('/register', [AppraisaUserController::class, 'registerSubmit'])->name('appraisal.user.register.submit');
    Route::get('/resend-otp', [AppraisaUserController::class, 'resendOtp'])->name('appraisal.user.resendOtp');
    Route::post('/resend-otp-submit', [AppraisaUserController::class, 'resendOtpSubmit'])->name('appraisal.user.resendOtp.submit');
    Route::get('/email-confirmation', [AppraisaUserController::class, 'emailConfirmation'])->name('appraisal.user.emailConfirmation');
    Route::post('/email-confirmation-submit', [AppraisaUserController::class, 'emailConfirmationSubmit'])->name('appraisal.user.emailConfirmationSubmit');
    Route::get('/password-reset', [AppraisaUserController::class, 'passwordReset'])->name('appraisal.user.passwordReset');
    Route::post('/password-reset-submit', [AppraisaUserController::class, 'passwordResetSubmit'])->name('appraisal.user.passwordReset.submit');
    Route::get('/login', [AppraisaUserController::class, 'login'])->name('appraisal.user.login');
    Route::post('/login-submit', [AppraisaUserController::class, 'loginSubmit'])->name('appraisal.user.loginSubmit');

    Route::middleware('appraisalUserAuth')->prefix('user')->group(function () {
        Route::get('/', [AppraisaUserController::class, 'index'])->name('appraisal.user.index');        
        Route::get('/instructions', [AppraisaUserController::class, 'instructions'])->name('appraisal.user.instructions');
        Route::get('/personal-details', [AppraisaUserController::class, 'personalDetails'])->name('appraisal.user.personal-details');
        Route::post('/personal-details-submit', [AppraisaUserController::class, 'personalDetailsSubmit'])->name('appraisal.user.personal-details.submit');
        Route::get('/scope-of-work', [AppraisaUserController::class, 'scopeOfWork'])->name('appraisal.user.scope-of-work');
        Route::post('/scope-of-work-submit', [AppraisaUserController::class, 'scopeOfWorkSubmit'])->name('appraisal.user.scope-of-work.submit');
        Route::get('/annual-appraisals', [AppraisaUserController::class, 'annualAppraisals'])->name('appraisal.user.annual-appraisals');
        Route::post('/annual-appraisals-submit', [AppraisaUserController::class, 'annualAppraisalsSubmit'])->name('appraisal.user.annual-appraisals.submit');
        Route::get('/development-plans', [AppraisaUserController::class, 'developmentPlans'])->name('appraisal.user.development-plans');
        Route::post('/development-plans-submit', [AppraisaUserController::class, 'developmentPlansSubmit'])->name('appraisal.user.development-plans.submit');
        Route::get('/cpd', [AppraisaUserController::class, 'cpd'])->name('appraisal.user.cpd');
        Route::post('/cpd-submit', [AppraisaUserController::class, 'cpdSubmit'])->name('appraisal.user.cpd.submit');
        Route::get('/quality-improvement', [AppraisaUserController::class, 'qualityImprovement'])->name('appraisal.user.quality-improvement');
        Route::post('/quality-improvement-submit', [AppraisaUserController::class, 'qualityImprovementSubmit'])->name('appraisal.user.quality-improvement.submit');
        Route::get('/significant-events', [AppraisaUserController::class, 'significantEvents'])->name('appraisal.user.significant-events');
        Route::post('/significant-events-submit', [AppraisaUserController::class, 'significantEventsSubmit'])->name('appraisal.user.significant-events.submit');
        Route::get('/feedback', [AppraisaUserController::class, 'feedback'])->name('appraisal.user.feedback');
        Route::post('/feedback-submit', [AppraisaUserController::class, 'feedbackSubmit'])->name('appraisal.user.feedback.submit');
        Route::get('/complaints', [AppraisaUserController::class, 'complaints'])->name('appraisal.user.complaints');
        Route::post('/complaints-submit', [AppraisaUserController::class, 'complaintsSubmit'])->name('appraisal.user.complaints.submit');
        Route::get('/achievements', [AppraisaUserController::class, 'achievements'])->name('appraisal.user.achievements');
        Route::post('/achievements-submit', [AppraisaUserController::class, 'achievementsSubmit'])->name('appraisal.user.achievements.submit');
        Route::get('/probity', [AppraisaUserController::class, 'probity'])->name('appraisal.user.probity');
        Route::post('/probity-submit', [AppraisaUserController::class, 'probitySubmit'])->name('appraisal.user.probity.submit');
        Route::get('/additional-info', [AppraisaUserController::class, 'additionalInfo'])->name('appraisal.user.additional-info');
        Route::post('/additional-info-submit', [AppraisaUserController::class, 'additionalInfoSubmit'])->name('appraisal.user.additional-info.submit');
        Route::get('/supporting-info', [AppraisaUserController::class, 'supportingInfo'])->name('appraisal.user.supporting-info');
        Route::get('/gmc-domains', [AppraisaUserController::class, 'gmcDomains'])->name('appraisal.user.gmc-domains');
        Route::post('/gmc-domains-submit', [AppraisaUserController::class, 'gmcDomainsSubmit'])->name('appraisal.user.gmc-domains.submit');
        Route::get('/checklist', [AppraisaUserController::class, 'checklist'])->name('appraisal.user.checklist');
        Route::post('/checklist-submit', [AppraisaUserController::class, 'checklistSubmit'])->name('appraisal.user.checklist.submit');
        Route::get('/personal-development-plan', [AppraisaUserController::class, 'personalDevelopmentPlan'])->name('appraisal.user.development-plan');
        Route::post('/personal-development-plan-submit', [AppraisaUserController::class, 'personalDevelopmentPlanSubmit'])->name('appraisal.user.development-plan.submit');
        Route::get('/summary', [AppraisaUserController::class, 'summary'])->name('appraisal.user.summary');
        Route::post('/summary-submit', [AppraisaUserController::class, 'summarySubmit'])->name('appraisal.user.summary.submit');
        Route::get('/outputs', [AppraisaUserController::class, 'outputs'])->name('appraisal.user.outputs');
        Route::post('/outputs-submit', [AppraisaUserController::class, 'outputsSubmit'])->name('appraisal.user.outputs.submit');
        Route::get('/completion', [AppraisaUserController::class, 'completion'])->name('appraisal.user.completion');
        // Route::get('/file-download/{fileName}', [AppraisaUserController::class, 'fileDownload'])->name('appraisal.user.file.download');
        
        // LOGOUT
        Route::get('/logout', [AppraisaUserController::class, 'logout'])->name('appraisal.user.logout');
    });
    // PDF ----------------
    Route::get('/pdf}', [AppraisaUserController::class, 'generatePDF'])->name('appraisal.user.completion.pdf');
    Route::get('/download/{file}', [AppraisaUserController::class, 'downloadFIle'])->name('appraisal.user.download.file');
    // END USERS ============

});
