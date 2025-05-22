<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::prefix('course')->group(function(){

    Route::get('/', [HomeController::class,'index'])->name('home.index');
    Route::get('/switchlocale/{locale}', [HomeController::class, 'switchlocale'])->name('locale.set');          
    Route::get('/calendar/{month?}/{year?}', [HomeController::class,'calendar'])->name('home.calendar');

    Route::get('/blogs', [HomeController::class,'blogs'])->name('home.blogs');
    Route::get('/blog/{slug}', [HomeController::class,'blog'])->name('home.blog');

    Route::get('/courses/{slug?}', [HomeController::class,'courses'])->name('home.courses');
    Route::get('/course/{slug}', [HomeController::class,'course'])->name('home.course');
    Route::post('/register', [HomeController::class,'registerMail'])->name('home.registerMail');

    Route::get('/contact', [HomeController::class,'contact'])->name('home.contact');
    Route::post('/contact', [HomeController::class,'contactMail'])->name('home.contactMail');

    Route::get('/findCourse',[HomeController::class,'findCourse'])->name('home.findCourse');

    Route::get('/gallery',[HomeController::class,'gallery'])->name('home.gallery');
    Route::get('/paynow', [HomeController::class,'paynow'])->name('home.paynow');
    Route::get('/terms', [HomeController::class,'terms'])->name('home.terms');
    Route::get('/privacy', [HomeController::class,'privacy'])->name('home.privacy');
    Route::get('/shipping', [HomeController::class,'shipping'])->name('home.shipping');
    Route::get('/refund', [HomeController::class,'refund'])->name('home.refund');
    Route::get('/about', [HomeController::class,'about'])->name('home.about');
    Route::get('/career', [HomeController::class,'career'])->name('home.career');

});

    Route::post('/paynow', [MainController::class,'paynowPost'])->name('home.paynowPost');
    Route::get('/response', [MainController::class,'response'])->name('home.response');



?>