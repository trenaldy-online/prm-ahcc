<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // --- 1. DATA RINGKASAN (KARTU ATAS) ---
        $totalLeads = Lead::count();
        $convertedLeads = Lead::where('status', 'Converted')->count();
        
        $conversionRate = 0;
        if ($totalLeads > 0) {
            $conversionRate = ($convertedLeads / $totalLeads) * 100;
        }

        // --- 2. DATA UNTUK GRAFIK SUMBER (DONUT CHART) ---
        // Kita gabungkan tabel leads dengan tracking_sessions untuk ambil utm_source
        $sources = Lead::leftJoin('tracking_sessions', 'leads.tracking_session_id', '=', 'tracking_sessions.id')
            ->select(
                // Jika utm_source kosong, kita namai 'Organic/Manual'
                DB::raw('COALESCE(tracking_sessions.utm_source, "Organic/Manual") as source_name'),
                DB::raw('count(*) as total')
            )
            ->groupBy('source_name')
            ->get();

        // Pisahkan label dan datanya untuk dikirim ke JS
        $sourceLabels = $sources->pluck('source_name');
        $sourceData = $sources->pluck('total');

        // --- 3. DATA UNTUK GRAFIK STATUS (BAR CHART) ---
        $statuses = Lead::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
            
        $statusLabels = $statuses->pluck('status');
        $statusData = $statuses->pluck('total');

        // --- 4. DATA UNTUK GRAFIK ALASAN LOST (PIE CHART) ---
        // Kita ambil hanya yang statusnya 'Lost' dan punya alasan
        $lostReasons = Lead::where('status', 'Lost')
            ->whereNotNull('lost_reason')
            ->select('lost_reason', DB::raw('count(*) as total'))
            ->groupBy('lost_reason')
            ->get();

        $lostLabels = $lostReasons->pluck('lost_reason');
        $lostData = $lostReasons->pluck('total');

        return view('analytics.index', compact(
            'totalLeads', 
            'convertedLeads', 
            'conversionRate',
            'sourceLabels',
            'sourceData',
            'statusLabels',
            'statusData',
            'lostLabels', // <--- Jangan lupa kirim ini
            'lostData'    // <--- Dan ini
        ));
    }
}