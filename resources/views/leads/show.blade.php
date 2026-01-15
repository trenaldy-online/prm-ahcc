<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasien - {{ $lead->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 3px; }
    </style>
</head>
<body class="bg-[#0e0e11] text-gray-300 min-h-screen flex flex-col">

    <nav class="border-b border-gray-800 bg-[#131316] px-6 py-4 flex items-center gap-4 sticky top-0 z-50">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 text-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Board
        </a>
        <div class="h-6 w-px bg-gray-700"></div>
        <h1 class="text-lg font-bold text-white tracking-tight">{{ $lead->name }}</h1>
        
        @php
            $badgeColor = match($lead->status) {
                'New' => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                'Converted' => 'bg-green-500/20 text-green-400 border-green-500/30',
                'Lost' => 'bg-red-500/20 text-red-400 border-red-500/30',
                default => 'bg-blue-500/20 text-blue-400 border-blue-500/30'
            };
        @endphp
        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $badgeColor }}">
            {{ $lead->status }}
        </span>
    </nav>

    <div class="flex-1 max-w-6xl mx-auto w-full p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="space-y-6">
            
            <div class="bg-[#18181b] border border-gray-800 rounded-xl p-6 shadow-lg">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Patient Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase">WhatsApp</label>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-white font-mono text-sm">{{ $lead->phone }}</span>
                            <a href="https://wa.me/{{ $lead->phone }}" target="_blank" class="text-green-500 hover:text-green-400 text-xs bg-green-900/20 px-2 py-0.5 rounded border border-green-900/50">Chat WA</a>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase">Diagnosis</label>
                        <p class="text-white text-sm font-medium mt-1">{{ $lead->diagnosis ?? '-' }}</p>
                    </div>

                    @if($lead->status === 'Lost' && $lead->lost_reason)
                    <div class="bg-red-900/10 border border-red-900/30 p-2 rounded-lg">
                        <label class="block text-[10px] text-red-400 uppercase font-bold">Alasan Lost</label>
                        <p class="text-white text-sm mt-0.5">{{ $lead->lost_reason }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase">Source / Iklan</label>
                        @if($lead->trackingSession)
                            <div class="flex gap-2 mt-1">
                                <span class="bg-blue-900/30 text-blue-400 px-2 py-1 rounded text-xs border border-blue-900/50">
                                    {{ $lead->trackingSession->utm_source ?? 'Unknown' }}
                                </span>
                                <span class="text-gray-600 text-xs font-mono self-center">
                                    {{ $lead->trackingSession->ref_code }}
                                </span>
                            </div>
                        @else
                            <p class="text-gray-600 text-xs mt-1">Direct / Manual Input</p>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-gray-800 mt-4">
                        <label class="block text-[10px] text-gray-500 uppercase mb-2">Next Follow Up</label>
                        @if($lead->next_action_date)
                            <div class="bg-yellow-900/20 border border-yellow-700/50 text-yellow-500 px-3 py-2 rounded-lg flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-sm font-bold">
                                    {{ \Carbon\Carbon::parse($lead->next_action_date)->format('d M Y, H:i') }}
                                </span>
                            </div>
                        @else
                            <p class="text-gray-600 text-xs italic">Belum ada jadwal pengingat.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="bg-[#18181b] border border-green-900/30 rounded-xl p-4 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-green-500"></div>
                
                <h2 class="text-xs font-bold text-green-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Kirim Pesan WA
                </h2>

                <div class="mb-2">
                    <select id="templateSelector" onchange="fillMessage()" class="w-full bg-[#0e0e11] border border-gray-700 rounded-lg px-2 py-1.5 text-xs text-gray-300 focus:border-green-500">
                        <option value="">-- Pilih Template Pesan --</option>
                        @foreach($templates as $temp)
                            <option value="{{ $temp->id }}" data-msg="{{ $temp->message }}">{{ $temp->shortcut }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <textarea id="waMessageArea" rows="4" class="w-full bg-[#0e0e11] border border-gray-700 rounded-lg p-2 text-xs text-white focus:outline-none focus:border-green-500 font-sans" placeholder="Pilih template di atas atau ketik manual..."></textarea>
                </div>

                <button onclick="sendToWA()" class="w-full bg-green-600 hover:bg-green-500 text-black font-bold py-2 rounded-lg text-xs transition flex items-center justify-center gap-2">
                    Buka WhatsApp
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>

            <script>
                // Simpan Template Content Asli untuk perbandingan
                let originalTemplateContent = "";
                let selectedTemplateName = "";

                function fillMessage() {
                    const selector = document.getElementById('templateSelector');
                    const messageArea = document.getElementById('waMessageArea');
                    
                    // Ambil data
                    const selectedOption = selector.options[selector.selectedIndex];
                    let message = selectedOption.getAttribute('data-msg');
                    
                    if (message) {
                        const patientName = "{{ $lead->name }}";
                        message = message.replace(/{name}/g, patientName);
                        
                        messageArea.value = message;
                        
                        // Simpan state untuk logging nanti
                        originalTemplateContent = message; 
                        selectedTemplateName = selectedOption.text;
                    } else {
                        // Reset kalau pilih opsi kosong
                        originalTemplateContent = "";
                        selectedTemplateName = "";
                    }
                }

                async function sendToWA() {
                    let phone = "{{ $lead->phone }}"; 
                    
                    // 1. Normalisasi Nomor
                    phone = phone.replace(/\D/g, '');
                    if (phone.startsWith('0')) phone = '62' + phone.substring(1);
                    else if (phone.startsWith('8')) phone = '62' + phone;

                    if (phone.length < 5) { alert("Nomor tidak valid"); return; }

                    const message = document.getElementById('waMessageArea').value;
                    if (!message) { alert("Pesan kosong!"); return; }

                    // 2. LOGGING KE SERVER (AJAX)
                    try {
                        const csrfToken = document.querySelector('input[name="_token"]').value; 
                        
                        await fetch("{{ route('leads.log.wa', $lead->id) }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: JSON.stringify({
                                message: message,
                                template_content: originalTemplateContent, 
                                template_name: selectedTemplateName
                            })
                        });
                    } catch (error) {
                        console.error("Gagal mencatat log:", error);
                    }

                    // 3. BUKA WHATSAPP
                    const encodedMsg = encodeURIComponent(message);
                    window.open(`https://wa.me/${phone}?text=${encodedMsg}`, '_blank');

                    // 4. MUNCULKAN MODAL REMINDER
                    document.getElementById('reminderModal').classList.remove('hidden');
                    document.getElementById('reminderModal').classList.add('flex');
                }
            </script>

            <div class="bg-[#18181b] border border-gray-800 rounded-xl p-6 shadow-lg">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Initial Complaint</h2>
                <p class="text-gray-400 text-sm leading-relaxed">
                    "{{ $lead->complaint ?? 'Tidak ada catatan keluhan awal.' }}"
                </p>
            </div>
        </div>

        <div class="lg:col-span-2 flex flex-col h-[calc(100vh-8rem)]">
            
            <div class="bg-[#18181b] border border-gray-800 rounded-xl p-4 mb-6 shadow-lg">
                <form action="{{ route('leads.activity', $lead->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="details" rows="2" placeholder="Tulis catatan perkembangan pasien..." 
                            class="w-full bg-[#0e0e11] border border-gray-700 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-green-600 transition"></textarea>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2 bg-[#0e0e11] px-3 py-1.5 rounded-lg border border-gray-700">
                            <span class="text-xs text-gray-500">Ingatkan Tgl:</span>
                            <input type="datetime-local" name="next_action_date" 
                                class="bg-transparent text-xs text-white focus:outline-none [color-scheme:dark]">
                        </div>

                        <button type="submit" class="bg-green-600 hover:bg-green-500 text-black px-4 py-1.5 rounded-lg text-sm font-bold transition shadow-lg shadow-green-900/20">
                            Post Activity
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex-1 overflow-y-auto pr-2 space-y-6">
                
                @forelse($lead->activities as $activity)
                    <div class="relative pl-8 border-l border-gray-800">
                        <div class="absolute -left-1.5 top-1 w-3 h-3 rounded-full border-2 border-[#0e0e11] 
                            {{ $activity->type == 'status_change' ? 'bg-blue-500' : 'bg-gray-500' }}"></div>
                        
                        <div class="group">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-gray-300">{{ $activity->user->name ?? 'System' }}</span>
                                <span class="text-[10px] text-gray-600">{{ $activity->created_at->format('d M H:i') }}</span>
                                
                                @if($activity->type == 'status_change')
                                    <span class="text-[10px] bg-blue-900/30 text-blue-400 px-1.5 rounded border border-blue-900/50">Status Change</span>
                                @endif
                            </div>
                            
                            <div class="text-sm text-gray-400 leading-relaxed bg-[#18181b]/50 p-3 rounded-lg border border-transparent group-hover:border-gray-800 transition">
                                {!! Str::markdown($activity->details) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-600">
                        <p class="text-sm">Belum ada riwayat aktivitas.</p>
                        <p class="text-xs mt-1">Mulai tulis catatan di atas.</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>

    <div id="reminderModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[60] backdrop-blur-sm">
        <div class="bg-[#18181b] rounded-2xl shadow-2xl w-full max-w-md border border-gray-700 p-6 animate-fade-in-up">
            
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Pesan Terkirim!</h3>
                <p class="text-sm text-gray-400 mt-1">Kapan Anda ingin mem-follow up pasien ini lagi?</p>
            </div>

            <form action="{{ route('leads.reminder.update', $lead->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <button type="submit" name="option" value="2days" class="bg-[#27272a] hover:bg-blue-600 hover:text-white text-gray-300 py-3 rounded-xl border border-gray-700 transition flex flex-col items-center gap-1 group">
                        <span class="text-xs font-bold uppercase">Lusa</span>
                        <span class="text-xs text-gray-500 group-hover:text-blue-200">(+2 Hari)</span>
                    </button>
                    <button type="submit" name="option" value="4days" class="bg-[#27272a] hover:bg-blue-600 hover:text-white text-gray-300 py-3 rounded-xl border border-gray-700 transition flex flex-col items-center gap-1 group">
                        <span class="text-xs font-bold uppercase">Minggu Depan</span>
                        <span class="text-xs text-gray-500 group-hover:text-blue-200">(+4 Hari)</span>
                    </button>
                    <button type="submit" name="option" value="6days" class="bg-[#27272a] hover:bg-blue-600 hover:text-white text-gray-300 py-3 rounded-xl border border-gray-700 transition flex flex-col items-center gap-1 group">
                        <span class="text-xs font-bold uppercase">Minggu Depan</span>
                        <span class="text-xs text-gray-500 group-hover:text-blue-200">(+6 Hari)</span>
                    </button>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 bg-[#18181b] text-xs text-gray-500">Atau pilih tanggal manual</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <input type="datetime-local" name="custom_date" class="flex-1 bg-[#0e0e11] border border-gray-700 text-white text-sm rounded-lg p-2.5 focus:border-blue-500 focus:outline-none [color-scheme:dark]">
                    <button type="submit" name="option" value="custom" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-bold text-sm">
                        Set
                    </button>
                </div>
            </form>
            
            <div class="mt-4 text-center">
                 <a href="{{ route('dashboard') }}" class="text-xs text-gray-600 hover:text-gray-400 underline">Lewati, kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <div id="lostModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[70] backdrop-blur-sm">
        <div class="bg-[#18181b] rounded-2xl shadow-2xl w-full max-w-md border border-gray-700 p-6">
            
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-white">Konfirmasi Gagal</h3>
                <p class="text-sm text-gray-400 mt-1">Mengapa pasien ini tidak jadi/batal (Lost)?</p>
            </div>

            <form action="{{ route('leads.update', $lead->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Lost">
                
                <div class="mb-5">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Pilih Alasan Utama</label>
                    <select name="lost_reason" required class="w-full bg-[#0e0e11] border border-red-900/50 text-gray-300 rounded-lg px-4 py-3 text-sm focus:border-red-500 focus:outline-none">
                        <option value="">-- Pilih Alasan --</option>
                        @foreach($globalLostReasons as $reason)
                            <option value="{{ $reason->title }}">{{ $reason->title }}</option>
                        @endforeach
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button type="button" onclick="document.getElementById('lostModal').classList.add('hidden'); document.getElementById('lostModal').classList.remove('flex');" class="bg-[#27272a] hover:bg-gray-700 text-gray-300 py-2.5 rounded-lg text-sm font-bold transition">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white py-2.5 rounded-lg text-sm font-bold transition">
                        Konfirmasi Lost
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-40">
        @if($lead->status !== 'Lost' && $lead->status !== 'Converted')
            <button onclick="document.getElementById('lostModal').classList.remove('hidden'); document.getElementById('lostModal').classList.add('flex');" class="bg-[#18181b] hover:bg-red-900/80 text-gray-500 hover:text-white border border-gray-700 hover:border-red-500 px-4 py-3 rounded-full shadow-2xl flex items-center gap-2 transition group">
                <span class="text-xs font-bold group-hover:block hidden transition-all duration-300">Tandai Menghilang</span>
                <svg class="w-5 h-5 text-red-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </button>
        @endif
    </div>

</body>
</html>