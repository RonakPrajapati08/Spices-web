<?php

namespace App\Providers;

use App\Models\ContactPageModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share contact info with all views
        View::composer('*', function ($view) {
            $contact = ContactPageModel::where('is_active', 1)->first();
            $view->with('contact', $contact);
        });
    }
}
