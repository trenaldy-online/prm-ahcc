<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\LostReason;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Cek dulu apakah tabelnya ada (biar tidak error saat migrate awal)
        if (Schema::hasTable('lost_reasons')) {
            // Bagikan variabel $globalLostReasons ke semua view
            View::share('globalLostReasons', LostReason::all());
        }
    }
}
