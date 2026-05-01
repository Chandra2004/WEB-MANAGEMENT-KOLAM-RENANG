<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// PASTIKAN import yang ini:
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                
                $view->with([
                    'user' => $user,
                    'totalUnreadNotifications' => Notification::where('user_uid', $user->uid)
                        ->where('is_read', false)
                        ->count(),
                    'unreadNotifications' => Notification::where('user_uid', $user->uid)
                        ->where('is_read', false)
                        ->latest()
                        ->take(5)
                        ->get()
                ]);
            }
        });
    }
}
