<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracking_sessions', function (Blueprint $table) {
            // 1. Perpanjang ref_code jadi 32 karakter (Cukup untuk 'AHCC-XXXXXX' dan format panjang lainnya)
            $table->string('ref_code', 32)->change();

            // 2. Ubah user_agent jadi TEXT (Bisa menampung ribuan karakter, aman untuk browser aneh-aneh)
            $table->text('user_agent')->change();
        });
    }

    public function down(): void
    {
        Schema::table('tracking_sessions', function (Blueprint $table) {
            // Kembalikan ke settingan awal (jika perlu rollback)
            $table->string('ref_code', 10)->change(); // Asumsi awal 10
            $table->string('user_agent', 255)->change();
        });
    }
};