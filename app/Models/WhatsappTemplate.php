<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    use HasFactory;

    // IZINKAN KOLOM INI UNTUK DIISI
    protected $fillable = ['shortcut', 'message'];
}