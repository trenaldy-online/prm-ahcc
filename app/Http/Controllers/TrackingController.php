<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackingSession;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class TrackingController extends Controller
{
    public function store(Request $request)
    {
        // 1. GENERATE REF CODE YANG UNIK & LEBIH PANJANG
        // Format: AHCC-XXXXXX (6 Karakter Acak)
        $refCode = '';
        $maxRetries = 5;
        $attempt = 0;

        do {
            $refCode = 'AHCC-' . Str::upper(Str::random(6));
            $exists = TrackingSession::where('ref_code', $refCode)->exists();
            $attempt++;
        } while ($exists && $attempt < $maxRetries);

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Failed to generate code'], 500);
        }

        // 2. SIMPAN DATA LENGKAP KE DATABASE
        TrackingSession::create([
            'ref_code'      => $refCode,
            'gclid'         => $request->gclid,
            'fbclid'        => $request->fbclid,
            'utm_source'    => $request->utm_source,
            'utm_medium'    => $request->utm_medium,
            'utm_campaign'  => $request->utm_campaign,
            'utm_term'      => $request->utm_term,     // Baru
            'utm_content'   => $request->utm_content,  // Baru
            'landing_page'  => $request->landing_page, // Baru
            'referrer'      => $request->referrer,     // Baru
            'ip_address'    => $request->ip(),
            'user_agent'    => $request->userAgent()
        ]);

        // 3. SKENARIO B: BUAT COOKIE DI BACKEND
        // Cookie ini akan otomatis disimpan browser dan dibawa saat user request lagi (misal saat submit form)
        // Nama: ref_code, Durasi: 30 Hari (43200 menit)
        $cookie = cookie('ref_code', $refCode, 43200);

        // 4. KIRIM RESPONSE + COOKIE
        return response()->json([
            'status'   => 'success',
            'ref_code' => $refCode
        ], 200)->withCookie($cookie);
    }
}