<?php

namespace App\Providers;

use App\Models\User;
use App\Models\PendaftaranPeserta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        Carbon::setLocale('id');

        Gate::define('admin', function (User $user) {
            return $user->is_admin == 1; // Admin IT
        });

        Gate::define('preventAdmin', function (User $user) {
            return $user->is_admin == 0; // Admin IT
        });

        Gate::define('adminPendaftaran', function (User $user) {
            return $user->is_admin == 2; // Admin Pendaftaran
        });

        Gate::define('pembimbingLapangan', function (User $user) {
            return $user->is_admin == 3; // Pembimbing Lapangan
        });

        // Bagikan jumlah user pending ke semua view
        View::composer('*', function ($view) {
            $pendingUsersCount = User::where('status_verifikasi', 'pending')->count();
            $view->with('pendingUsersCount', $pendingUsersCount);
        });

        View::composer('*', function ($view) {
            $unreadCount = PendaftaranPeserta::where('is_checked', false)->count(); // Sesuaikan dengan logika bisnis Anda
            $view->with('unreadCount', $unreadCount);
        });
    }
}
