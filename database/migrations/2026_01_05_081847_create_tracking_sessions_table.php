<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('tracking_sessions', function (Blueprint $table) {
        $table->id();
        $table->string('ref_code', 10)->unique(); // Kode unik pendek (misal: #A8X99)
        $table->text('gclid')->nullable();        // Google Click ID
        $table->text('fbclid')->nullable();       // Facebook Click ID
        $table->string('utm_source')->nullable(); // google, ig, facebook
        $table->string('utm_medium')->nullable(); // cpc, organic
        $table->string('utm_campaign')->nullable();
        $table->string('ip_address')->nullable();
        $table->text('user_agent')->nullable();   // Info browser hp/laptop
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_sessions');
    }
};
