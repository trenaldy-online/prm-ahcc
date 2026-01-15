<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingSession extends Model
{
    use HasFactory;

    // KITA UBAH DARI GUARDED KE FILLABLE (Best Practice Security)
    // Agar kita tahu persis kolom apa saja yang boleh diisi
    protected $fillable = [
        'ref_code',
        'gclid',
        'fbclid',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',      // Baru
        'utm_content',   // Baru
        'ip_address',
        'user_agent',
        'landing_page',  // Baru
        'referrer'       // Baru
    ];
}