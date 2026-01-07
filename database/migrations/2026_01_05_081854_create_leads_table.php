<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->string('diagnosis')->nullable();
        $table->text('complaint')->nullable(); // Keluhan
        
        // Status Pipeline
        $table->enum('status', ['New', 'Follow Up', 'Appointment', 'Converted', 'Lost'])
              ->default('New');
              
        // Relasi ke tabel tracking (Boleh kosong jika lead manual tanpa iklan)
        $table->foreignId('tracking_session_id')->nullable()->constrained('tracking_sessions')->onDelete('set null');
        
        $table->text('admin_notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
