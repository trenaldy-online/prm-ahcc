<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappTemplate;

class SettingController extends Controller
{
    // Tampilkan Halaman Setting
    public function index()
    {
        $templates = WhatsappTemplate::all();
        return view('settings', compact('templates'));
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
}