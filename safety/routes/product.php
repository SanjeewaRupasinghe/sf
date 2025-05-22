<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('product')->group(function(){

    Route::get('/', [ProductController::class,'index'])->name('product.index');
    Route::get('/j-tip', [ProductController::class,'jtip'])->name('product.jtip');
    Route::get('/victor', [ProductController::class,'victor'])->name('product.victor');
    Route::get('/terms', [ProductController::class,'terms'])->name('product.terms');
    Route::get('/paynow', [ProductController::class,'paynow'])->name('product.paynow');

    Route::get('/contact', [ProductController::class,'contact'])->name('product.contact');
    Route::post('/contact', [ProductController::class,'contactMail'])->name('product.contactMail');
    
        Route::get('/privacy', [ProductController::class,'privacy'])->name('product.privacy');
    Route::get('/shipping', [ProductController::class,'shipping'])->name('product.shipping');
    Route::get('/refund', [ProductController::class,'refund'])->name('product.refund');
    Route::get('/about', [ProductController::class,'about'])->name('product.about');
    Route::get('/career', [ProductController::class,'career'])->name('product.career');


});
?>