<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AnalyticsController;

// 1. Halaman Depan: Jika belum login ke Login, jika sudah langsung ke Dashboard
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Grup Rute yang WAJIB LOGIN (Dilindungi Breeze)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Arahkan /dashboard ke Controller Lead (Kanban Board kita)
    Route::get('/dashboard', [LeadController::class, 'index'])->name('dashboard');

    // Rute Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    // Rute Operasional PRM (Simpan, Update, Export)
    Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
    Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::get('/export-leads', [LeadController::class, 'export'])->name('leads.export');

    // Fitur Edit Profil Bawaan Breeze (Opsional, biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes Setting
    Route::post('/settings/reason', [SettingController::class, 'storeReason'])->name('settings.reason.store');
    Route::delete('/settings/reason/{id}', [SettingController::class, 'destroyReason'])->name('settings.reason.destroy');
});

// Memanggil rute auth bawaan Breeze (Login, Register, dll)
require __DIR__.'/auth.php';

// Route khusus untuk Drag & Drop
Route::post('/leads/update-status-ajax', [LeadController::class, 'updateStatusAjax'])->name('leads.update-status-ajax');

// Rute untuk Halaman Detail & Aktivitas
Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
Route::post('/leads/{lead}/activity', [LeadController::class, 'addActivity'])->name('leads.activity');

// Route Khusus Lead Hilang
Route::post('/leads/{lead}/lost', [LeadController::class, 'markAsLost'])->name('leads.lost');

// Routes Setting
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::post('/settings/template', [SettingController::class, 'storeTemplate'])->name('settings.template.store');
Route::delete('/settings/template/{id}', [SettingController::class, 'destroyTemplate'])->name('settings.template.destroy');

// LOG WA (AJAX)
Route::post('/leads/{lead}/log-wa', [LeadController::class, 'logWhatsapp'])->name('leads.log.wa');
    
// UPDATE REMINDER (MODAL)
Route::post('/leads/{lead}/reminder', [LeadController::class, 'updateReminder'])->name('leads.reminder.update');

