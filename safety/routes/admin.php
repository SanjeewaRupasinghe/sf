<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ApCourseController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ApBlogPostController;
use App\Http\Controllers\Admin\ApCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\ApBlogCategoryController;
use App\Http\Controllers\Admin\CourseCalendarController;
use App\Http\Controllers\AppraisaUserController;

Route::prefix('superadmin')->group(function(){

    Route::get('/', [AdminController::class,'index'])->name('admin.index');
    Route::post('/store',[AdminController::class,'store'])->name('admin.store');

    Route::middleware('adminauth')->group(function(){
        Route::get('/create',[AdminController::class,'create'])->name('admin.dashboard');
        Route::get('/edit',[AdminController::class,'edit'])->name('admin.edit');  
        Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
        Route::patch('/update/{id}',[AdminController::class,'update'])->name('admin.update');

        Route::resource('blogCategory',BlogCategoryController::class);
        Route::get('/checkSlug',[BlogCategoryController::class,'checkSlug'])->name('blogCategory.checkSlug');
     
        Route::resource('blogPost',BlogPostController::class);
        Route::get('/checkSlug2',[BlogPostController::class,'checkSlug2'])->name('blogPost.checkSlug2');

        Route::resource('category', CategoryController::class);
        Route::get('/checkSlug3',[CategoryController::class,'checkSlug3'])->name('category.checkSlug3');

        Route::resource('course', CourseController::class);
        Route::get('/checkSlug4',[CourseController::class,'checkSlug4'])->name('course.checkSlug4');
        
        Route::resource('courseCalendar', CourseCalendarController::class);
        Route::resource('image',ImageController::class);

        Route::resource('apBlogCategory',ApBlogCategoryController::class);
        Route::get('/checkSlug5',[ApBlogCategoryController::class,'checkSlug5'])->name('apBlogCategory.checkSlug5');

        Route::resource('apBlogPost',ApBlogPostController::class);
        Route::get('/checkSlug6',[ApBlogPostController::class,'checkSlug6'])->name('apBlogPost.checkSlug6');

        Route::resource('apCategory', ApCategoryController::class);
        Route::get('/checkSlug7',[ApCategoryController::class,'checkSlug7'])->name('apCategory.checkSlug7');

        Route::resource('apCourse', ApCourseController::class);
        Route::get('/checkSlug8',[ApCourseController::class,'checkSlug8'])->name('apCourse.checkSlug8');
        
        // APRAISAL USER
        Route::get('/appraisalUser',[AppraisaUserController::class,'adminIndex'])->name('admin.appraisal.user');
        Route::get('/appraisalUser/unlock/{userId}',[AppraisaUserController::class,'unlock'])->name('admin.appraisal.user.unlock');
    });

});
