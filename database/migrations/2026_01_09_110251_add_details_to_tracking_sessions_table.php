<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracking_sessions', function (Blueprint $table) {
            // 1. Cek dulu apakah kolom 'landing_page' sudah ada?
            // Jika BELUM ada (!), baru kita buat kolom-kolom barunya.
            if (!Schema::hasColumn('tracking_sessions', 'landing_page')) {
                $table->text('landing_page')->nullable()->after('ref_code');
                $table->text('referrer')->nullable()->after('landing_page');
                $table->string('utm_term')->nullable()->after('utm_campaign');
                $table->string('utm_content')->nullable()->after('utm_term');
            }
        });

        // 2. Coba tambahkan Unique Index di blok terpisah dengan try-catch
        try {
            Schema::table('tracking_sessions', function (Blueprint $table) {
                $table->unique('ref_code');
            });
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika errornya kode 1061 (Duplicate key name), berarti index sudah ada.
            // Kita abaikan saja errornya (continue), tidak perlu throw error.
            if ($e->errorInfo[1] != 1061) {
                throw $e; // Jika error lain, tetap tampilkan
            }
        }
    }

    public function down(): void
    {
        Schema::table('tracking_sessions', function (Blueprint $table) {
            $table->dropUnique(['ref_code']);
            $table->dropColumn(['landing_page', 'referrer', 'utm_term', 'utm_content']);
        });
    }
};