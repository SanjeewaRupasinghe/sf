<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ApCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $locale=app()->getLocale();
            $view->with('menuCats',Category::whereNull('parent_id')->get());
            $view->with('menuApCats',ApCategory::whereNull('parent_id')->get());
        });
    }
}
