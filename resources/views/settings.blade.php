<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - PRM AHCC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#0e0e11] text-gray-300 font-sans h-screen flex overflow-hidden">

    <aside class="w-64 bg-[#131316] border-r border-gray-800 flex flex-col flex-shrink-0 z-20">
        
        <div class="p-6 pb-2">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-tr from-gray-700 to-gray-600 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="font-bold text-white tracking-tight">System Settings</span>
            </div>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-gray-400 hover:text-white hover:bg-[#27272a] rounded-lg transition group border border-transparent hover:border-gray-700 mb-6">
                <svg class="w-4 h-4 text-gray-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="text-sm font-medium">Back to Board</span>
            </a>
            
            <div class="h-px bg-gray-800 mb-6"></div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 space-y-1">
            <p class="px-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Configuration</p>

            <button onclick="switchSetting('whatsapp')" id="btn-whatsapp" class="w-full flex items-center gap-3 px-3 py-2 text-left rounded-lg transition text-white bg-[#27272a] border border-gray-700 shadow-sm">
                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <span class="text-sm font-medium">WhatsApp Templates</span>
            </button>

            <button onclick="switchSetting('lost-reasons')" id="btn-lost-reasons" class="w-full flex items-center gap-3 px-3 py-2 text-left rounded-lg transition text-gray-400 hover:text-white hover:bg-[#1c1c1f]">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span class="text-sm font-medium">Lost Reasons</span>
            </button>

            <button onclick="switchSetting('profile')" id="btn-profile" class="w-full flex items-center gap-3 px-3 py-2 text-left rounded-lg transition text-gray-400 hover:text-white hover:bg-[#1c1c1f]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-sm font-medium">My Profile</span>
            </button>

            <button onclick="switchSetting('general')" id="btn-general" class="w-full flex items-center gap-3 px-3 py-2 text-left rounded-lg transition text-gray-400 hover:text-white hover:bg-[#1c1c1f]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="text-sm font-medium">General</span>
            </button>
        </div>

        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-gray-500 truncate">System Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex min-w-0 bg-[#0e0e11] relative">
        
        <div class="flex-1 overflow-y-auto p-8">
            
            <div id="content-whatsapp" class="space-y-6 max-w-5xl mx-auto animate-fade-in">
                <header class="mb-8 border-b border-gray-800 pb-4">
                    <h1 class="text-2xl font-bold text-white">WhatsApp Templates</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola template pesan cepat untuk follow-up pasien.</p>
                </header>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div class="bg-[#18181b] p-6 rounded-xl border border-gray-800 h-fit sticky top-6">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Buat Template Baru</h2>
                        <form action="{{ route('settings.template.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Shortcut (Judul Singkat)</label>
                                <input type="text" name="shortcut" placeholder="Contoh: Sapaan Awal" class="w-full bg-[#0e0e11] border border-gray-700 rounded p-2 text-sm text-white focus:border-green-500 placeholder-gray-600 transition">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Isi Pesan</label>
                                <textarea name="message" rows="5" placeholder="Halo {name}, terima kasih sudah menghubungi AHCC..." class="w-full bg-[#0e0e11] border border-gray-700 rounded p-2 text-sm text-white focus:border-green-500 placeholder-gray-600 transition"></textarea>
                                <div class="mt-2 bg-blue-900/10 border border-blue-900/30 p-2 rounded text-[10px] text-blue-400 flex items-start gap-2">
                                    <svg class="w-3 h-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p>Tips: Gunakan <b>{name}</b>, sistem otomatis menggantinya dengan nama pasien.</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-black px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-lg shadow-green-900/20">
                                Simpan Template
                            </button>
                        </form>
                    </div>

                    <div class="space-y-4">
                        @if($templates->count() > 0)
                            @foreach($templates as $temp)
                            <div class="bg-[#18181b] p-4 rounded-xl border border-gray-800 flex justify-between items-start group hover:border-gray-600 transition">
                                <div class="flex-1 mr-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="bg-[#27272a] text-green-400 text-[10px] px-2 py-0.5 rounded border border-gray-600 font-mono font-bold">
                                            /{{ $temp->shortcut }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400 leading-relaxed whitespace-pre-wrap">"{{ $temp->message }}"</p>
                                </div>
                                <form action="{{ route('settings.template.destroy', $temp->id) }}" method="POST" onsubmit="return confirm('Hapus template ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-gray-600 hover:text-red-500 p-2 rounded hover:bg-red-900/10 transition" title="Hapus Template">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-16 border-2 border-dashed border-gray-800 rounded-xl bg-[#18181b]/50">
                                <p class="text-gray-500 text-sm font-medium">Belum ada template.</p>
                                <p class="text-gray-600 text-xs mt-1">Buat template pertama Anda di form sebelah kiri.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="content-lost-reasons" class="hidden space-y-6 max-w-5xl mx-auto animate-fade-in">
                <header class="mb-8 border-b border-gray-800 pb-4">
                    <h1 class="text-2xl font-bold text-white">Alasan Lost (Gagal)</h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola opsi alasan yang muncul saat pasien ditandai sebagai 'Lost'.</p>
                </header>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div class="bg-[#18181b] p-6 rounded-xl border border-gray-800 h-fit sticky top-6">
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Tambah Alasan Baru</h2>
                        <form action="{{ route('settings.reason.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Judul Alasan</label>
                                <input type="text" name="title" placeholder="Contoh: Harga Terlalu Mahal" required 
                                    class="w-full bg-[#0e0e11] border border-gray-700 rounded p-2 text-sm text-white focus:border-red-500 placeholder-gray-600 transition">
                            </div>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white px-4 py-2.5 rounded-lg text-sm font-bold transition shadow-lg shadow-red-900/20">
                                Simpan Alasan
                            </button>
                        </form>
                    </div>

                    <div class="space-y-3">
                        @if(isset($reasons) && $reasons->count() > 0)
                            @foreach($reasons as $reason)
                            <div class="bg-[#18181b] px-4 py-3 rounded-lg border border-gray-800 flex justify-between items-center group hover:border-gray-600 transition">
                                <span class="text-sm text-gray-300 font-medium">{{ $reason->title }}</span>
                                <form action="{{ route('settings.reason.destroy', $reason->id) }}" method="POST" onsubmit="return confirm('Hapus alasan ini? Data pasien yang sudah menggunakan alasan ini tidak akan berubah.')">
                                    @csrf @method('DELETE')
                                    <button class="text-gray-600 hover:text-red-500 p-2 rounded hover:bg-red-900/10 transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-16 border-2 border-dashed border-gray-800 rounded-xl bg-[#18181b]/50">
                                <p class="text-gray-500 text-sm font-medium">Belum ada alasan tersimpan.</p>
                                <p class="text-gray-600 text-xs mt-1">Gunakan form di kiri untuk menambah alasan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="content-profile" class="hidden space-y-6 max-w-2xl mx-auto">
                <header class="mb-8 border-b border-gray-800 pb-4">
                    <h1 class="text-2xl font-bold text-white">User Profile</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage your account information.</p>
                </header>
                <div class="bg-[#18181b] p-8 rounded-xl border border-gray-800 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-full mx-auto mb-6 flex items-center justify-center text-3xl font-bold text-white shadow-xl shadow-blue-900/20">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <h3 class="text-xl font-bold text-white">{{ Auth::user()->name ?? 'Admin' }}</h3>
                    <p class="text-gray-500 mb-6">{{ Auth::user()->email ?? 'admin@ahcc.co.id' }}</p>
                    <button class="bg-[#27272a] hover:bg-[#3f3f46] text-white px-6 py-2 rounded-full text-sm font-medium transition border border-gray-700">
                        Edit Profile (Coming Soon)
                    </button>
                </div>
            </div>

            <div id="content-general" class="hidden space-y-6 max-w-2xl mx-auto">
                <header class="mb-8 border-b border-gray-800 pb-4">
                    <h1 class="text-2xl font-bold text-white">General Settings</h1>
                    <p class="text-sm text-gray-500 mt-1">Application preferences.</p>
                </header>
                <div class="bg-[#18181b] p-12 rounded-xl border border-gray-800 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mb-4 text-gray-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-white font-medium">Coming Soon</h3>
                    <p class="text-gray-500 text-sm mt-2 max-w-xs">Pengaturan zona waktu, notifikasi, dan preferensi sistem lainnya akan tersedia di update berikutnya.</p>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Fungsi Switch Tab (Tetap sama)
        function switchSetting(tabName) {
            // 1. Hide Semua Konten
            ['whatsapp', 'lost-reasons', 'profile', 'general'].forEach(name => {
                const content = document.getElementById('content-' + name);
                if(content) content.classList.add('hidden');
                
                // Reset Style Tombol
                const btn = document.getElementById('btn-' + name);
                if(btn) {
                    btn.classList.remove('bg-[#27272a]', 'text-white', 'border', 'border-gray-700', 'shadow-sm');
                    btn.classList.add('text-gray-400', 'border-transparent');
                }
            });

            // 2. Show Konten Terpilih
            const selectedContent = document.getElementById('content-' + tabName);
            if(selectedContent) selectedContent.classList.remove('hidden');

            // 3. Highlight Tombol Terpilih
            const selectedBtn = document.getElementById('btn-' + tabName);
            if(selectedBtn) {
                selectedBtn.classList.remove('text-gray-400', 'border-transparent');
                selectedBtn.classList.add('bg-[#27272a]', 'text-white', 'border', 'border-gray-700', 'shadow-sm');
            }
        }

        // --- TAMBAHAN KODE: Auto Switch Tab saat Reload ---
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data 'active_tab' dari session PHP. 
            // Jika tidak ada session (akses biasa), default ke 'whatsapp'.
            const activeTab = "{{ session('active_tab', 'whatsapp') }}";
            
            // Jalankan fungsi switch ke tab tersebut
            switchSetting(activeTab);
        });
    </script>

    @if(session('success'))
    <div id="toast-success" class="fixed top-6 right-6 z-[100] flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-green-500 animate-bounce" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">{{ session('success') }}</div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if(toast) toast.remove();
        }, 3000);
    </script>
    @endif

</body>
</html>