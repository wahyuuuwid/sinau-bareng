<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        //
        Paginator::useTailwind();
        View::composer('*', function ($view) {

        $unreadCount = 0;
        $notifications = collect();

        if (Auth::check()) {
            $unreadCount = Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

            $notifications = Notification::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();
        }

        $view->with([
            'unreadCount' => $unreadCount,
            'notifications' => $notifications,
        ]);
    });
    }
}
