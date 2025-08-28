<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- TAMBAHKAN BARIS INI
use App\Models\User; // <-- TAMBAHKAN BARIS INI
use Illuminate\Pagination\Paginator;
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
        // PERBAIKAN KRITIS: Menambahkan kembali definisi Gate untuk hak akses
        Gate::define('is_admin_or_tu', function (User $user) {
            return in_array($user->role, ['admin', 'tu']);
        });
        Paginator::useBootstrap(); // <-- TAMBAHKAN BARIS INI
    }
}