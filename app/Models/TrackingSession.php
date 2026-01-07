<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingSession extends Model
{
    use HasFactory;

    // Ini artinya: Semua kolom boleh diisi (Tidak ada yang dijaga/unguarded)
    protected $guarded = [];
}