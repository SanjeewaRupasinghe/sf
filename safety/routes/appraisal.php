<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppraisalController;

Route::prefix('appraisal')->group(function(){

    Route::get('/', [AppraisalController::class,'index'])->name('appraisal.index');
    Route::get('/faq', [AppraisalController::class,'faq'])->name('appraisal.faq');
    Route::get('/terms', [AppraisalController::class,'terms'])->name('appraisal.terms');
    Route::get('/paynow', [AppraisalController::class,'paynow'])->name('appraisal.paynow');

    Route::get('/contact', [AppraisalController::class,'contact'])->name('appraisal.contact');
    Route::post('/contact', [AppraisalController::class,'contactMail'])->name('appraisal.contactMail');

    Route::get('/blogs', [AppraisalController::class,'blogs'])->name('appraisal.blogs');
    Route::get('/blog/{slug}', [AppraisalController::class,'blog'])->name('appraisal.blog');

    Route::get('/services/{slug?}', [AppraisalController::class,'courses'])->name('appraisal.courses');
    Route::get('/service/{slug}', [AppraisalController::class,'course'])->name('appraisal.course');
    Route::post('/register', [AppraisalController::class,'registerMail'])->name('appraisal.registerMail');

    Route::get('/privacy', [AppraisalController::class,'privacy'])->name('appraisal.privacy');
    Route::get('/shipping', [AppraisalController::class,'shipping'])->name('appraisal.shipping');
    Route::get('/refund', [AppraisalController::class,'refund'])->name('appraisal.refund');
    Route::get('/about', [AppraisalController::class,'about'])->name('appraisal.about');
    Route::get('/career', [AppraisalController::class,'career'])->name('appraisal.career');

});
?>