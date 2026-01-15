<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappTemplate;
use App\Models\LostReason;

class SettingController extends Controller
{
    // MENAMPILKAN HALAMAN SETTING
    public function index()
    {
        // 1. Ambil data Alasan Lost dari database
        $reasons = LostReason::all(); 

        // 2. Ambil data Template WA (jika ada)
        $templates = WhatsappTemplate::all();

        // 3. Kirim kedua data tersebut ke view 'settings'
        return view('settings', compact('reasons', 'templates'));
    }

    // Simpan Template Baru
    public function storeTemplate(Request $request)
    {
        $request->validate([
            'shortcut' => 'required|max:50',
            'message' => 'required'
        ]);

        WhatsappTemplate::create($request->only('shortcut', 'message'));
        
        return back()->with('success', 'Template berhasil disimpan!');
    }

    // Hapus Template
    public function destroyTemplate($id)
    {
        WhatsappTemplate::destroy($id);
        return back()->with('success', 'Template dihapus.');
    }

    // SIMPAN ALASAN BARU
    public function storeReason(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        
        LostReason::create([
            'title' => $request->title
        ]);

        return redirect()->back()
            ->with('success', 'Alasan baru berhasil ditambahkan!')
            ->with('active_tab', 'lost-reasons'); // Agar tetap di tab Lost Reason
    }

    // HAPUS ALASAN
    public function destroyReason($id)
    {
        LostReason::destroy($id);

        return redirect()->back()
            ->with('success', 'Alasan berhasil dihapus.')
            ->with('active_tab', 'lost-reasons');
    }
}