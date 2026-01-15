<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\TrackingSession;
use App\Models\LeadActivity;
use Illuminate\Support\Facades\Auth;
use App\Models\WhatsappTemplate;

class LeadController extends Controller
{
    // 1. Menampilkan Dashboard & Kanban
    public function index(Request $request)
    {
        // 1. Query Dasar
        $query = Lead::with('trackingSession')->latest();

        // 2. LOGIC PENCARIAN (BARU)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil Data untuk Kanban (Group by Status)
        // Kita clone query agar filter search tetap terbawa
        $leads = (clone $query)->get()->groupBy('status');

        // --- LOGIC REMINDER (TETAP SAMA, JANGAN DIUBAH) ---
        // Reminder sebaiknya TIDAK terpengaruh search, agar admin tetap aware tugas hari ini
        // Kita buat query baru khusus reminder agar bersih dari filter search di atas
        $reminderQuery = Lead::where('status', '!=', 'Converted')
                             ->where('status', '!=', 'Lost');

        $overdue = (clone $reminderQuery)->whereNotNull('next_action_date')
                    ->where('next_action_date', '<', now()->startOfDay())->orderBy('next_action_date', 'asc')->get();
        
        $today = (clone $reminderQuery)->whereNotNull('next_action_date')
                    ->whereDate('next_action_date', now())->orderBy('next_action_date', 'asc')->get();
        
        $tomorrow = (clone $reminderQuery)->whereNotNull('next_action_date')
                    ->whereDate('next_action_date', now()->addDay())->orderBy('next_action_date', 'asc')->get();

        $unlabelled = (clone $reminderQuery)->whereNull('next_action_date')
                        ->where('updated_at', '<', now()->subDays(2))->orderBy('updated_at', 'desc')->get();
        
        return view('kanban', compact('leads', 'overdue', 'today', 'tomorrow', 'unlabelled'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        // 1. BERSIHKAN NOMOR HP DULU
        $cleanPhone = $this->normalizePhone($request->phone);

        // 2. CEK APAKAH NOMOR HP (YANG SUDAH BERSIH) SUDAH ADA?
        $lead = Lead::where('phone', $cleanPhone)->first();

        if ($lead) {
            // === SKENARIO: PASIEN LAMA KEMBALI (REAKTIVASI) ===
            $oldStatus = $lead->status;
            $oldName = $lead->name;
            
            $lead->update([
                'status' => 'New',
                'updated_at' => now(),
                'phone' => $cleanPhone,
                'name' => $request->name,           
                'diagnosis' => $request->diagnosis, 
                'complaint' => $request->complaint  
            ]);

            $nameNote = ($oldName !== $request->name) 
                ? "Nama diperbarui dari **$oldName** menjadi **{$request->name}**." 
                : "Nama tetap sama.";

            LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::id(),
                'type' => 'status_change',
                'details' => "♻️ **Reaktivasi Pasien:** Pasien lama ($oldStatus) menghubungi kembali. $nameNote"
            ]);

            return redirect()->back()->with('success', "Pasien Lama ($oldName) ditemukan & diaktifkan kembali!");
        }
        
        // === SKENARIO: PASIEN BENAR-BENAR BARU ===
        else {
            
            // --- LOGIKA BARU: SMART ATTRIBUTION (COOKIE FALLBACK) ---
            // 1. Coba ambil dari Input Form (Prioritas 1)
            $refCode = $request->input('ref_code');

            // 2. Jika form kosong, coba ambil dari Cookie Browser (Prioritas 2)
            if (!$refCode) {
                $refCode = $request->cookie('ref_code');
            }

            // 3. Cari Data Tracking Session
            $trackingId = null;
            if ($refCode) {
                // Cari session berdasarkan ref_code yang ditemukan
                $session = \App\Models\TrackingSession::where('ref_code', $refCode)->first();
                $trackingId = $session ? $session->id : null;
            }
            // --------------------------------------------------------

            // Buat Lead Baru
            $lead = Lead::create([
                'name' => $request->name,
                'phone' => $cleanPhone,
                'diagnosis' => $request->diagnosis,
                'complaint' => $request->complaint,
                'status' => 'New',
                'tracking_session_id' => $trackingId // Sambungkan ID tracking disini
            ]);

            // Catat Log Awal
            $sourceLog = $trackingId ? "Sumber: Iklan/Tracking ($refCode)" : "Sumber: Organik/Direct";
            
            LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::id(),
                'type' => 'note',
                'details' => "Pasien Baru ditambahkan. $sourceLog"
            ]);

            return redirect()->back()->with('success', 'Lead Baru berhasil dibuat!');
        }
    }

    // Update Status & Catatan
    public function update(Request $request, Lead $lead)
    {
        // 1. Siapkan data yang mau diupdate
        $data = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'diagnosis' => $request->diagnosis,
        ];

        // 2. Jika statusnya 'Lost', simpan juga alasannya
        if ($request->status === 'Lost') {
            $data['lost_reason'] = $request->lost_reason;
        } else {
            // Jika bukan lost (misal balik ke New), hapus alasan lost sebelumnya agar data bersih
            $data['lost_reason'] = null;
        }

        // 3. Eksekusi Update
        $lead->update($data);

        // 4. Catat Log (Tambahan biar rapi)
        if ($request->status === 'Lost' && $request->filled('lost_reason')) {
            \App\Models\LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::id(),
                'type' => 'status_change',
                'details' => "⛔ **Lost:** " . $request->lost_reason
            ]);
        }

        return redirect()->back()->with('success', 'Status pasien berhasil diperbarui!');
    }

    // Export Data untuk Google Ads
    public function export()
    {
        // 1. Ambil nama file & header
        $fileName = 'laporan-oct-ahcc-' . date('Y-m-d') . '.csv';
        
        // 2. Ambil data pasien yang sudah CONVERTED dan punya data TRACKING
        $leads = Lead::with('trackingSession')
                    ->where('status', 'Converted') // Hanya yang deal
                    ->whereNotNull('tracking_session_id') // Hanya yang dari iklan
                    ->get();

        // 3. Buat header HTTP agar browser mendownload file
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // 4. Tulis isi CSV
        $callback = function() use($leads) {
            $file = fopen('php://output', 'w');
            
            // Header Kolom (Sesuai format Google Ads Offline Import)
            fputcsv($file, ['Google Click ID', 'Conversion Name', 'Conversion Time', 'Conversion Value', 'Currency']);

            foreach ($leads as $lead) {
                // Ambil GCLID dari tabel relasi
                $gclid = $lead->trackingSession->gclid ?? '';
                
                // Jika GCLID kosong, skip (karena Google pasti nolak)
                if(empty($gclid)) continue;

                // Format Waktu: MM/dd/yyyy HH:mm:ss (Wajib format US)
                $time = $lead->updated_at->format('m/d/Y H:i:s');

                fputcsv($file, [
                    $gclid,             // Kolom 1: GCLID
                    'Lead Konversi',    // Kolom 2: Nama Konversi (Sesuaikan setting Google Ads)
                    $time,              // Kolom 3: Waktu
                    '100000',           // Kolom 4: Nilai (Bisa diganti dinamis nanti)
                    'IDR'               // Kolom 5: Mata Uang
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Menangani Drag & Drop (AJAX)
    public function updateStatusAjax(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:leads,id',
            'status' => 'required'
        ]);

        $lead = Lead::find($request->id);
        $oldStatus = $lead->status;
        $newStatus = $request->status;

        // Cek jika status beneran berubah
        if ($oldStatus !== $newStatus) {
            // 1. Update Status
            $lead->status = $newStatus;
            $lead->save();

            // 2. CATAT DI TIMELINE (History System)
            LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::id(),
                'type'    => 'status_change',
                'details' => "Mengubah status dari **$oldStatus** menjadi **$newStatus**"
            ]);
        }

        return response()->json(['success' => true]);
    }
    public function show(Lead $lead)
    {
        // 1. Load Relasi untuk Timeline (Activity & User) & Tracking
        $lead->load(['trackingSession', 'activities.user']);
        
        // 2. Load Data Template WhatsApp (Fitur Baru)
        // Pastikan Model WhatsappTemplate sudah di-import atau panggil path lengkapnya
        $templates = \App\Models\WhatsappTemplate::all(); 
        
        // 3. Kirim variabel $lead dan $templates ke View
        return view('leads.show', compact('lead', 'templates'));
    }

    public function addActivity(Request $request, Lead $lead)
    {
        $request->validate([
            'details' => 'required',
            'next_action_date' => 'nullable|date'
        ]);

        // 1. Simpan Catatan ke Timeline
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => Auth::id(),
            'type'    => 'note',
            'details' => $request->details
        ]);

        // 2. Jika ada set tanggal pengingat, update di tabel Lead utama
        if ($request->filled('next_action_date')) {
            $lead->update(['next_action_date' => $request->next_action_date]);
        }

        return back()->with('success', 'Catatan berhasil ditambahkan');
    }

    public function markAsLost(Request $request, Lead $lead)
    {
        // Update Status jadi Lost
        $lead->update(['status' => 'Lost']);

        // Catat Alasan (Optional dari request atau default)
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => Auth::id(),
            'type' => 'status_change',
            'details' => "⛔ **Menghilang:** " . ($request->reason ?? 'Dinyatakan Lost oleh Admin (Tidak ada respon).')
        ]);

        return redirect()->route('dashboard')->with('success', 'Status pasien diubah menjadi Lost.');
    }

    // Fungsi Pembantu untuk merapikan nomor HP
    private function normalizePhone($phone)
    {
        // 1. Hapus semua karakter kecuali angka
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // 2. Ubah 08xx jadi 628xx
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
    
    public function logWhatsapp(Request $request, Lead $lead)
    {
        // 1. Cek apakah pesan diedit?
        // Kita bandingkan pesan yang dikirim vs isi template asli
        $isEdited = trim($request->message) !== trim($request->template_content);
        
        $logMessage = "";
        
        if ($request->template_name) {
            $logMessage = "📲 **Mengirim WA:** Menggunakan template *'{$request->template_name}'*.";
            
            if ($isEdited) {
                $logMessage .= "\n\n📝 **Isi Pesan (Diedit):**\n_{$request->message}_";
            }
        } else {
            $logMessage = "📲 **Mengirim WA:** Manual (Tanpa Template).\n\n_{$request->message}_";
        }

        // 2. Simpan ke Activity Log
        \App\Models\LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'type' => 'whatsapp', // Tipe baru (opsional, atau pakai 'note')
            'details' => $logMessage
        ]);

        return response()->json(['status' => 'success']);
    }

    public function updateReminder(Request $request, Lead $lead)
    {
        // Hitung tanggal berdasarkan pilihan tombol
        $date = null;

        switch ($request->option) {
            case '2days':
                $date = now()->addDays(2);
                break;
            case '4days':
                $date = now()->addDays(4);
                break;
            case '6days':
                $date = now()->addDays(6);
                break;
            case 'custom':
                $date = $request->custom_date; // Ambil dari input date
                break;
        }

        if ($date) {
            $lead->update(['next_action_date' => $date]);
            
            // Catat log kecil bahwa reminder diatur
            \App\Models\LeadActivity::create([
                'lead_id' => $lead->id,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'type' => 'system',
                'details' => "⏰ **Reminder Diatur:** Follow up berikutnya pada " . \Carbon\Carbon::parse($date)->translatedFormat('d F Y, H:i')
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Follow up dijadwalkan! Data disimpan.');
    }
}