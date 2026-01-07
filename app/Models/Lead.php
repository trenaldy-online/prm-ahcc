<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Kita siapkan relasinya sekalian
    public function trackingSession()
    {
        return $this->belongsTo(TrackingSession::class);
    }

    // Relasi: Pasien punya banyak aktivitas
    public function activities()
    {
        return $this->hasMany(LeadActivity::class)->latest();
    }
}