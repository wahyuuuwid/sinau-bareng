<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\URL;

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
        // --- TAMBAHKAN KODE INI UNTUK MENGATASI MASALAH CSS DI RAILWAY ---
        // Jika aplikasi berjalan di environment production (Railway), paksa gunakan HTTPS
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        // -----------------------------------------------------------------

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