<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackingSession;
use Illuminate\Support\Str; // Import library untuk bikin teks acak

class TrackingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Buat KODE UNIK (Misal: TRF-AB12)
        // Str::random(5) membuat 5 huruf acak, Str::upper bikin jadi HURUF BESAR
        $randomCode = 'TRF-' . Str::upper(Str::random(4)); 

        // 2. Simpan Data Pengunjung ke Database
        $tracking = TrackingSession::create([
            'ref_code'      => $randomCode,
            'gclid'         => $request->gclid,
            'fbclid'        => $request->fbclid,
            'utm_source'    => $request->utm_source,
            'utm_medium'    => $request->utm_medium,
            'utm_campaign'  => $request->utm_campaign,
            'ip_address'    => $request->ip(),      // Ambil IP otomatis
            'user_agent'    => $request->userAgent() // Ambil info browser
        ]);

        // 3. Kirim Balasan (Response) ke Website WordPress
        return response()->json([
            'status'   => 'success',
            'ref_code' => $randomCode
        ], 200);
    }
}