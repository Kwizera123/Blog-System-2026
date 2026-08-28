<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;

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
        View::composer('layouts.home-nav', function ($view) {

            $unreadMessages = 0;

            if (auth()->check() && auth()->user()->isAdmin()) {
                $unreadMessages = ContactMessage::where('is_read', false)->count();
            }

            $view->with('unreadMessages', $unreadMessages);
        });
        //
    }
}
