<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>PRM AHCC - Workspace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #52525b; }
        .kanban-col { min-width: 320px; }
        
        /* Style saat kartu sedang di-drag */
        .sortable-ghost {
            opacity: 0.4;
            background-color: #27272a;
            border: 1px dashed #4ade80;
        }
        .sortable-drag {
            cursor: grabbing;
        }
    </style>
</head>
<body class="bg-[#0e0e11] text-gray-300 h-screen flex overflow-hidden selection:bg-green-500 selection:text-black">

    <aside class="w-64 bg-[#131316] border-r border-gray-800 flex flex-col flex-shrink-0">
        <div class="p-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-gradient-to-tr from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-green-900/20">
                <span class="font-bold text-black text-xs">AH</span>
            </div>
            <span class="font-bold text-white tracking-tight">PRM AHCC</span>
        </div>
        <div class="px-6 mb-6">
            <button onclick="openCreateModal()" class="w-full bg-white hover:bg-gray-200 text-black font-semibold py-2 px-4 rounded-lg transition flex items-center justify-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Lead
            </button>
        </div>
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="px-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2 mt-2">Main Menu</p>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-[#27272a] text-white border border-gray-700/50' : 'text-gray-400 hover:text-white hover:bg-[#1c1c1f]' }} rounded-lg transition">
                <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-green-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="text-sm font-medium">Kanban Board</span>
            </a>

            <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('analytics') ? 'bg-[#27272a] text-white border border-gray-700/50' : 'text-gray-400 hover:text-white hover:bg-[#1c1c1f]' }} rounded-lg transition group">
                <svg class="w-4 h-4 {{ request()->routeIs('analytics') ? 'text-green-500' : 'text-gray-500 group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-sm font-medium">Analytics</span>
            </a>

            <a href="{{ route('leads.export') }}" class="flex items-center gap-3 px-3 py-2 text-gray-400 hover:text-white hover:bg-[#1c1c1f] rounded-lg transition group">
                <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                <span class="text-sm font-medium">Export CSV</span>
            </a>
        </nav>

        <div class="px-4 py-2 bg-[#131316]">
            <p class="px-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">System</p>
            <a href="{{ route('settings') }}" class="flex items-center gap-3 px-3 py-2 text-gray-400 hover:text-white hover:bg-[#1c1c1f] rounded-lg transition group">
                <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="text-sm font-medium">Settings</span>
            </a>
        </div>

        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-md">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-gray-500 truncate">{{ Auth::user()->email ?? 'admin@ahcc.co.id' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-400 transition" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 bg-[#0e0e11]">
        <header class="h-16 border-b border-gray-800 flex items-center justify-between px-6 bg-[#0e0e11]/50 backdrop-blur-sm sticky top-0 z-10">
            <div>
                <h2 class="text-lg font-semibold text-white">Board Overview</h2>
                <p class="text-xs text-gray-500">Manage your patient pipeline (Drag & Drop Enabled)</p>
            </div>
            <div class="flex items-center gap-3">
                
                <form action="{{ route('dashboard') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 group-focus-within:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama / HP..." 
                        class="bg-[#18181b] border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-48 pl-10 p-2.5 transition placeholder-gray-600 focus:w-full md:focus:w-64"
                        autocomplete="off">
                        
                    @if(request('search'))
                        <a href="{{ route('dashboard') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>

                <button onclick="openCreateModal()" class="bg-white hover:bg-gray-200 text-black px-4 py-2.5 rounded-lg font-bold flex items-center gap-2 transition shadow-lg shadow-white/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="hidden md:inline">New Lead</span>
                </button>
            </div>
            <div class="flex gap-4">
               <div class="text-right">
                    <span class="block text-xs text-gray-500">Total Leads</span>
                    <span class="font-mono text-sm font-bold text-white">{{ $leads->flatten()->count() }}</span>
               </div>
            </div>
        </header>

        <div class="flex-1 overflow-x-auto p-6">
            @if(request('search'))
        <div class="mb-6 bg-blue-900/20 border border-blue-900/50 p-4 rounded-xl flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/20 p-2 rounded-lg text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-300">Menampilkan hasil pencarian untuk: <span class="font-bold text-white">"{{ request('search') }}"</span></p>
                    <p class="text-xs text-gray-500">Ditemukan di semua kolom status.</p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs text-blue-400 hover:text-white underline">Reset Filter</a>
        </div>
        @endif
            <div class="flex gap-6 h-full items-start">
                
                @foreach(['New', 'Follow Up', 'Appointment', 'Converted', 'Lost'] as $status)
                
                @php
                    $dotColor = match($status) {
                        'New' => 'bg-gray-400',
                        'Follow Up' => 'bg-yellow-400',
                        'Appointment' => 'bg-blue-400',
                        'Converted' => 'bg-green-500',
                        'Lost' => 'bg-red-500',
                        default => 'bg-gray-400'
                    };
                @endphp

                <div class="kanban-col w-80 flex-shrink-0 flex flex-col h-full rounded-xl bg-[#131316]/50 border border-dashed border-gray-800/50">
                    
                    <div class="p-3 border-b border-gray-800/50 flex justify-between items-center sticky top-0 bg-[#131316] rounded-t-xl z-10">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $dotColor }} shadow-[0_0_8px_rgba(0,0,0,0.5)]"></span>
                            <h3 class="text-xs font-bold text-gray-300 uppercase tracking-wider">{{ $status }}</h3>
                        </div>
                        <span class="bg-[#27272a] text-gray-500 text-[10px] font-mono px-1.5 py-0.5 rounded count-badge">
                            {{ isset($leads[$status]) ? $leads[$status]->count() : 0 }}
                        </span>
                    </div>

                    <div class="kanban-list flex-1 overflow-y-auto p-2 space-y-2 min-h-[100px]" 
                         data-status="{{ $status }}">
                         
                        @if(isset($leads[$status]))
                            @foreach($leads[$status] as $lead)
                            
                            <div data-id="{{ $lead->id }}" onclick="window.location.href='{{ route('leads.show', $lead->id) }}'" 
                                 class="kanban-card group bg-[#1c1c1f] hover:bg-[#27272a] p-3 rounded-lg border border-[#27272a] hover:border-gray-600 shadow-sm transition-all cursor-grab active:cursor-grabbing">
                                
                                <div class="flex flex-wrap gap-1.5 mb-2 pointer-events-none">
                                    @if($lead->trackingSession)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-green-900/30 text-green-400 border border-green-500/20 uppercase">
                                            {{ $lead->trackingSession->utm_source ?? 'Ads' }}
                                        </span>
                                    @endif
                                    @if($lead->diagnosis)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-purple-900/30 text-purple-400 border border-purple-500/20 uppercase">
                                            {{ Str::limit($lead->diagnosis, 12) }}
                                        </span>
                                    @endif
                                </div>

                                <h4 class="text-gray-200 font-medium text-sm mb-0.5 leading-snug pointer-events-none">{{ $lead->name }}</h4>
                                <p class="text-gray-500 text-[11px] font-mono mb-2 pointer-events-none">{{ $lead->phone }}</p>

                                @if($lead->admin_notes)
                                <div class="flex items-start gap-1.5 text-gray-500 border-t border-gray-800 pt-2 pointer-events-none">
                                    <svg class="w-3 h-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                                    <p class="text-[10px] leading-tight line-clamp-2">{{ $lead->admin_notes }}</p>
                                </div>
                                @endif
                            </div>

                            @endforeach
                        @endif
                    </div>
                    
                    <button onclick="openCreateModal('{{ $status }}')" class="m-2 py-1.5 border border-dashed border-gray-700 rounded text-xs text-gray-500 hover:text-white hover:border-gray-500 transition">
                        + Add Card
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <div id="createModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-[#18181b] rounded-xl shadow-2xl w-full max-w-md border border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center bg-[#1c1c1f]">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider">Create New Lead</h2>
                <button onclick="closeCreateModal()" class="text-gray-500 hover:text-white">&times;</button>
            </div>
            <form action="{{ route('leads.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="bg-[#131316] p-3 rounded-lg border border-dashed border-gray-700">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tracking Code (Optional)</label>
                    <div class="flex gap-2">
                         <span class="text-gray-600 flex items-center justify-center bg-[#27272a] w-8 h-8 rounded text-xs">#</span>
                         <input type="text" name="ref_code" placeholder="Example: TRF-AB12" class="flex-1 bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1">Name</label>
                        <input type="text" name="name" required class="w-full bg-[#27272a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1">WhatsApp</label>
                        <input type="text" name="phone" required class="w-full bg-[#27272a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-green-500">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Diagnosis</label>
                    <input type="text" name="diagnosis" class="w-full bg-[#27272a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-green-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Complaint / Notes</label>
                    <textarea name="complaint" rows="3" class="w-full bg-[#27272a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-green-500"></textarea>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full bg-white hover:bg-gray-200 text-black font-bold py-2 rounded-lg transition text-sm">Create Lead</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-[#18181b] rounded-xl shadow-2xl w-full max-w-md border border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center bg-[#1c1c1f]">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider">Update Status</h2>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-white">&times;</button>
            </div>
            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Patient Name</label>
                    <input type="text" id="modalName" disabled class="w-full bg-[#131316] border border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-400">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Current Status</label>
                    <select name="status" id="modalStatus" class="w-full bg-[#27272a] border border-gray-600 rounded-lg px-3 py-2 text-sm text-white focus:border-green-500">
                        <option value="New">New</option>
                        <option value="Follow Up">Follow Up</option>
                        <option value="Appointment">Appointment</option>
                        <option value="Converted">Converted (Deal ✅)</option>
                        <option value="Lost">Lost (❌)</option>
                    </select>
                </div>
                <div id="lostReasonDiv" class="hidden mt-3 p-3 bg-red-900/10 border border-red-900/30 rounded-lg">
                    <label class="block text-xs font-bold text-red-400 mb-1">Kenapa Gagal / Lost?</label>
                    <select name="lost_reason" id="modalLostReason" class="w-full bg-[#27272a] border border-red-900/50 text-gray-300 rounded-lg px-3 py-2 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        <option value="">-- Pilih Alasan --</option>
                        @foreach($globalLostReasons as $reason)
                            <option value="{{ $reason->title }}">{{ $reason->title }}</option>
                        @endforeach
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Diagnosis</label>
                    <input type="text" name="diagnosis" id="modalDiagnosis" class="w-full bg-[#27272a] border border-gray-600 rounded-lg px-3 py-2 text-sm text-white focus:border-green-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-1">Admin Notes</label>
                    <textarea name="admin_notes" id="modalNotes" rows="3" class="w-full bg-[#27272a] border border-gray-600 rounded-lg px-3 py-2 text-sm text-white focus:border-green-500"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-lg text-xs font-bold text-gray-400 hover:text-white transition">Cancel</button>
                    <button type="submit" class="bg-green-600 hover:bg-green-500 text-black px-4 py-2 rounded-lg text-xs font-bold transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40">
        <div class="bg-[#18181b]/90 backdrop-blur-md border border-gray-700 rounded-2xl shadow-2xl px-6 py-3 flex items-center gap-6">
            
            <button onclick="openTaskModal('overdue')" class="flex flex-col items-center gap-1 group relative min-w-[60px]">
                <div class="relative">
                    <span class="text-xl group-hover:-translate-y-1 transition transform duration-200">🔥</span>
                    @if($overdue->count() > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg border-2 border-[#18181b]">
                        {{ $overdue->count() }}
                    </span>
                    @endif
                </div>
                <span class="text-[10px] font-medium text-gray-400 group-hover:text-red-400 transition">Terlewat</span>
            </button>

            <div class="w-px h-8 bg-gray-700"></div>

            <button onclick="openTaskModal('today')" class="flex flex-col items-center gap-1 group relative min-w-[60px]">
                <div class="relative">
                    <span class="text-xl group-hover:-translate-y-1 transition transform duration-200">📅</span>
                    @if($today->count() > 0)
                    <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg border-2 border-[#18181b]">
                        {{ $today->count() }}
                    </span>
                    @endif
                </div>
                <span class="text-[10px] font-medium text-gray-400 group-hover:text-blue-400 transition">Hari Ini</span>
            </button>

            <div class="w-px h-8 bg-gray-700"></div>

            <button onclick="openTaskModal('tomorrow')" class="flex flex-col items-center gap-1 group relative min-w-[60px]">
                <div class="relative">
                    <span class="text-xl group-hover:-translate-y-1 transition transform duration-200">➡️</span>
                    @if($tomorrow->count() > 0)
                    <span class="absolute -top-2 -right-2 bg-gray-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg border-2 border-[#18181b]">
                        {{ $tomorrow->count() }}
                    </span>
                    @endif
                </div>
                <span class="text-[10px] font-medium text-gray-400 group-hover:text-white transition">Besok</span>
            </button>

            <div class="w-px h-8 bg-gray-700"></div>

            <button onclick="openTaskModal('unlabelled')" class="flex flex-col items-center gap-1 group relative min-w-[60px]">
                <div class="relative">
                    <span class="text-xl group-hover:-translate-y-1 transition transform duration-200">⚠️</span>
                    @if($unlabelled->count() > 0)
                    <span class="absolute -top-2 -right-2 bg-yellow-500 text-black text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg border-2 border-[#18181b] animate-bounce">
                        {{ $unlabelled->count() }}
                    </span>
                    @endif
                </div>
                <span class="text-[10px] font-medium text-gray-400 group-hover:text-yellow-400 transition">No Label</span>
            </button>
        </div>
    </div>

    <div id="taskModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-[#18181b] rounded-xl shadow-2xl w-full max-w-lg border border-gray-700 overflow-hidden flex flex-col max-h-[80vh]">
            
            <div class="px-6 py-4 border-b border-gray-800 bg-[#1c1c1f] flex justify-between items-center shrink-0">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider">Daftar Follow Up</h2>
                <button onclick="closeTaskModal()" class="text-gray-500 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex border-b border-gray-800 bg-[#131316] shrink-0 overflow-x-auto">
                <button onclick="switchTab('overdue')" id="tab-overdue" class="flex-1 min-w-[80px] py-3 text-xs font-bold text-gray-500 hover:text-white border-b-2 border-transparent transition uppercase whitespace-nowrap">
                    Terlewat <span class="ml-1 bg-red-900/30 text-red-500 px-1.5 rounded">{{ $overdue->count() }}</span>
                </button>
                <button onclick="switchTab('today')" id="tab-today" class="flex-1 min-w-[80px] py-3 text-xs font-bold text-gray-500 hover:text-white border-b-2 border-transparent transition uppercase whitespace-nowrap">
                    Hari Ini <span class="ml-1 bg-blue-900/30 text-blue-500 px-1.5 rounded">{{ $today->count() }}</span>
                </button>
                <button onclick="switchTab('tomorrow')" id="tab-tomorrow" class="flex-1 min-w-[80px] py-3 text-xs font-bold text-gray-500 hover:text-white border-b-2 border-transparent transition uppercase whitespace-nowrap">
                    Besok <span class="ml-1 bg-gray-800 text-gray-400 px-1.5 rounded">{{ $tomorrow->count() }}</span>
                </button>
                <button onclick="switchTab('unlabelled')" id="tab-unlabelled" class="flex-1 min-w-[80px] py-3 text-xs font-bold text-gray-500 hover:text-white border-b-2 border-transparent transition uppercase whitespace-nowrap">
                    No Label <span class="ml-1 bg-yellow-900/30 text-yellow-500 px-1.5 rounded">{{ $unlabelled->count() }}</span>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 bg-[#0e0e11]">
                
                <div id="content-overdue" class="hidden space-y-2">
                    @forelse($overdue as $task)
                        <a href="{{ route('leads.show', $task->id) }}" class="flex items-center justify-between p-3 bg-[#1c1c1f] border border-gray-800 rounded-lg hover:border-gray-600 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-900/30 flex items-center justify-center text-red-400 text-xs font-bold border border-red-500/20">
                                    {{ substr($task->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white">{{ $task->name }}</h4>
                                    <p class="text-[10px] text-gray-500">
                                        {{ \Carbon\Carbon::parse($task->next_action_date)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-gray-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-xs text-gray-600 py-4">Tidak ada tugas terlewat. Bagus! 🎉</p>
                    @endforelse
                </div>

                <div id="content-today" class="hidden space-y-2">
                    @forelse($today as $task)
                        <a href="{{ route('leads.show', $task->id) }}" class="flex items-center justify-between p-3 bg-[#1c1c1f] border border-gray-800 rounded-lg hover:border-gray-600 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-900/30 flex items-center justify-center text-blue-400 text-xs font-bold border border-blue-500/20">
                                    {{ substr($task->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white">{{ $task->name }}</h4>
                                    <p class="text-[10px] text-gray-500">
                                        {{ \Carbon\Carbon::parse($task->next_action_date)->format('H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                            <div class="text-gray-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-xs text-gray-600 py-4">Hari ini santai, tidak ada jadwal. ☕</p>
                    @endforelse
                </div>

                <div id="content-tomorrow" class="hidden space-y-2">
                    @forelse($tomorrow as $task)
                        <a href="{{ route('leads.show', $task->id) }}" class="flex items-center justify-between p-3 bg-[#1c1c1f] border border-gray-800 rounded-lg hover:border-gray-600 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 text-xs font-bold border border-gray-600/20">
                                    {{ substr($task->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white">{{ $task->name }}</h4>
                                    <p class="text-[10px] text-gray-500">
                                        {{ \Carbon\Carbon::parse($task->next_action_date)->format('H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                            <div class="text-gray-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-xs text-gray-600 py-4">Belum ada jadwal untuk besok.</p>
                    @endforelse
                </div>

                <div id="content-unlabelled" class="hidden space-y-2">
                    <div class="bg-yellow-900/20 border border-yellow-700/30 p-3 rounded mb-4">
                        <p class="text-[10px] text-yellow-500">Pasien di bawah ini <b>belum deal</b>, tidak punya jadwal follow-up, dan sudah didiamkan lebih dari <b>2 hari</b>.</p>
                    </div>
                    @forelse($unlabelled as $task)
                        <a href="{{ route('leads.show', $task->id) }}" class="flex items-center justify-between p-3 bg-[#1c1c1f] border border-gray-800 rounded-lg hover:border-gray-600 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-yellow-900/30 flex items-center justify-center text-yellow-400 text-xs font-bold border border-yellow-500/20">
                                    {{ substr($task->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-200 group-hover:text-white">{{ $task->name }}</h4>
                                    <p class="text-[10px] text-gray-500">
                                        Update Terakhir: {{ $task->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-gray-600 group-hover:text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-xs text-gray-600 py-4">Semua pasien terurus dengan baik! 👍</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <script>
        // --- 1. SCRIPT SORTABLE JS (DRAG & DROP) ---
        document.addEventListener('DOMContentLoaded', function () {
            const containers = document.querySelectorAll('.kanban-list');
            
            containers.forEach(function (container) {
                new Sortable(container, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    delay: 100,
                    delayOnTouchOnly: true,
                    onEnd: function (evt) {
                        const itemEl = evt.item;
                        const newStatus = evt.to.getAttribute('data-status');
                        const leadId = itemEl.getAttribute('data-id');
                        
                        fetch('{{ route("leads.update-status-ajax") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ id: leadId, status: newStatus })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                updateCounts();
                            }
                        });
                    }
                });
            });
        });

        // --- UPDATE JUMLAH KARTU ---
        function updateCounts() {
            document.querySelectorAll('.kanban-col').forEach(col => {
                const count = col.querySelectorAll('.kanban-card').length;
                col.querySelector('.count-badge').textContent = count;
            });
        }

        // --- 2. SCRIPT MODAL CREATE ---
        function openCreateModal(status = null) {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }
        function closeCreateModal() {
            document.getElementById('createModal').classList.remove('flex');
            document.getElementById('createModal').classList.add('hidden');
        }

        // --- 3. SCRIPT MODAL EDIT (YANG SUDAH DIPERBAIKI) ---
        
        // A. Event Listener untuk Dropdown Status (Agar muncul saat dipilih 'Lost')
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('modalStatus');
            if(statusSelect) {
                statusSelect.addEventListener('change', function() {
                    const reasonDiv = document.getElementById('lostReasonDiv');
                    const reasonInput = document.getElementById('modalLostReason');
                    
                    if (this.value === 'Lost') {
                        reasonDiv.classList.remove('hidden'); // Munculkan
                        reasonInput.setAttribute('required', 'required'); // Wajib isi
                    } else {
                        reasonDiv.classList.add('hidden'); // Sembunyikan
                        reasonInput.removeAttribute('required');
                        reasonInput.value = ''; // Reset
                    }
                });
            }
        });

        // B. Fungsi Membuka Modal Edit (Logika Lost Reason ada DI DALAM sini)
        function openEditModal(lead) {
            // Isi form dengan data pasien
            document.getElementById('modalName').value = lead.name;
            document.getElementById('modalStatus').value = lead.status;
            document.getElementById('modalDiagnosis').value = lead.diagnosis || '';
            document.getElementById('modalNotes').value = lead.admin_notes || '';
            
            // --- LOGIKA ALASAN LOST (DIPERBAIKI) ---
            const reasonDiv = document.getElementById('lostReasonDiv');
            const reasonSelect = document.getElementById('modalLostReason');
            
            // Cek apakah status pasien saat ini adalah Lost?
            if (lead.status === 'Lost') {
                reasonDiv.classList.remove('hidden'); // Jika ya, munculkan dropdown
                reasonSelect.value = lead.lost_reason || ''; // Isi alasannya
            } else {
                reasonDiv.classList.add('hidden'); // Jika tidak, sembunyikan
                reasonSelect.value = '';
            }
            // ----------------------------------------

            document.getElementById('editForm').action = '/leads/' + lead.id;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('flex');
            document.getElementById('editModal').classList.add('hidden');
        }

        // --- 4. SCRIPT MODAL TASK/REMINDER ---
        function openTaskModal(tabName) {
            document.getElementById('taskModal').classList.remove('hidden');
            document.getElementById('taskModal').classList.add('flex');
            switchTab(tabName);
        }
        function closeTaskModal() {
            document.getElementById('taskModal').classList.remove('flex');
            document.getElementById('taskModal').classList.add('hidden');
        }
        function switchTab(tabName) {
            const allTabs = ['overdue', 'today', 'tomorrow', 'unlabelled'];
            allTabs.forEach(name => {
                document.getElementById('content-' + name).classList.add('hidden');
                const btn = document.getElementById('tab-' + name);
                btn.classList.remove('text-white', 'border-green-500', 'text-yellow-500', 'border-yellow-500', 'text-blue-500', 'border-blue-500', 'text-red-500', 'border-red-500'); 
                btn.classList.add('text-gray-500', 'border-transparent');
            });
            document.getElementById('content-' + tabName).classList.remove('hidden');
            const activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.classList.remove('text-gray-500', 'border-transparent');
            
            if(tabName === 'overdue') activeBtn.classList.add('text-white', 'border-red-500');
            else if(tabName === 'today') activeBtn.classList.add('text-white', 'border-blue-500');
            else if(tabName === 'unlabelled') activeBtn.classList.add('text-white', 'border-yellow-500');
            else activeBtn.classList.add('text-white', 'border-gray-500');
        }

        // Tutup modal jika klik di luar
        window.onclick = function(event) {
            const taskModal = document.getElementById('taskModal');
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            if (event.target == taskModal) closeTaskModal();
            if (event.target == createModal) closeCreateModal();
            if (event.target == editModal) closeEditModal();
        }
    </script>
    

    @if(session('success'))
    <div id="toast-success" class="fixed top-6 right-6 z-[100] flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white rounded-lg shadow-2xl border-l-4 border-green-500 animate-bounce" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">{{ session('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="document.getElementById('toast-success').remove()">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414Z" clip-rule="evenodd"/></svg>
        </button>
    </div>
    
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if(toast) {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 5000); // Hilang setelah 5 detik
    </script>
    @endif

</body>
</html>