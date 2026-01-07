<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade'); // Terhubung ke pasien
            $table->foreignId('user_id')->constrained(); // Siapa admin yang nulis?
            $table->string('type'); // 'note', 'status_change', 'file', 'whatsapp'
            $table->text('details')->nullable(); // Isi catatan
            $table->string('attachment')->nullable(); // Untuk upload file nanti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_activities');
    }
};
