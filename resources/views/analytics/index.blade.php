<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRM AHCC - Analytics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #52525b; }
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

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="px-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2 mt-2">Main Menu</p>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-gray-400 hover:text-white hover:bg-[#1c1c1f] rounded-lg transition group">
                <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                <span class="text-sm font-medium">Kanban Board</span>
            </a>

            <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-3 py-2 bg-[#27272a] text-white border border-gray-700/50 rounded-lg transition shadow-sm">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <main class="flex-1 flex flex-col min-w-0 bg-[#0e0e11] overflow-y-auto">
        
        <header class="h-16 border-b border-gray-800 flex items-center justify-between px-6 bg-[#0e0e11]/50 backdrop-blur-sm sticky top-0 z-10">
            <div>
                <h2 class="text-lg font-semibold text-white">Marketing Analytics</h2>
                <p class="text-xs text-gray-500">Real-time performance overview</p>
            </div>
            <div class="text-xs text-gray-500 font-mono bg-[#18181b] px-3 py-1.5 rounded-lg border border-gray-800">
                Period: All Time
            </div>
        </header>

        <div class="p-6 max-w-7xl mx-auto w-full">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm hover:border-gray-700 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Total Leads</p>
                            <h3 class="text-3xl font-bold text-white">{{ $totalLeads }}</h3>
                        </div>
                        <div class="p-2 bg-blue-900/20 rounded-lg text-blue-400 border border-blue-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-gray-500">
                        <span class="text-green-400 font-bold flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            +100%
                        </span>
                        <span class="ml-1.5">vs bulan lalu (Dummy)</span>
                    </div>
                </div>

                <div class="bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm hover:border-gray-700 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Deal / Converted</p>
                            <h3 class="text-3xl font-bold text-white">{{ $convertedLeads }}</h3>
                        </div>
                        <div class="p-2 bg-green-900/20 rounded-lg text-green-400 border border-green-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-gray-500">
                        <span class="text-gray-400">Pasien telah melakukan pembayaran</span>
                    </div>
                </div>

                <div class="bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm hover:border-gray-700 transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Conversion Rate</p>
                            <h3 class="text-3xl font-bold text-white">{{ number_format($conversionRate, 1) }}%</h3>
                        </div>
                        <div class="p-2 bg-purple-900/20 rounded-lg text-purple-400 border border-purple-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-1.5 mt-4">
                        <div class="bg-purple-500 h-1.5 rounded-full" style="width: {{ $conversionRate }}%"></div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        Efektivitas Konversi Lead ke Pasien
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                <div class="bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm">
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide border-b border-gray-800 pb-2">
                        Sumber Pasien (Traffic Source)
                    </h3>
                    <div id="chart-sources" class="min-h-[250px] flex items-center justify-center"></div>
                </div>

                <div class="bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm">
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide border-b border-gray-800 pb-2">
                        Funnel & Status Pasien
                    </h3>
                    <div id="chart-status" class="min-h-[250px]"></div>
                </div>
            </div>

            <div class="mt-6 bg-[#1c1c1f] rounded-xl border border-gray-800 p-6 shadow-sm">
                <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide border-b border-gray-800 pb-2">
                    Analisa Kegagalan (Lost Reasons)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div id="chart-lost" class="min-h-[250px] flex items-center justify-center"></div>
                    
                    <div class="text-sm text-gray-400 space-y-3">
                        <p>Grafik ini menunjukkan alasan utama mengapa calon pasien tidak jadi berobat.</p>
                        <ul class="list-disc list-inside space-y-1 text-gray-500">
                            <li>Gunakan data ini untuk mengevaluasi strategi harga.</li>
                            <li>Jika banyak "Ghosting", perbaiki skrip follow-up admin.</li>
                            <li>Jika "Lokasi Jauh", pertimbangkan layanan tele-konsultasi.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // --- 1. Konfigurasi Grafik Donut (Sources) ---
        var optionsSource = {
            series: @json($sourceData), 
            labels: @json($sourceLabels), 
            chart: {
                type: 'donut',
                height: 260, // <-- UKURAN DIUBAH (Sebelumnya 320)
                background: 'transparent'
            },
            theme: { mode: 'dark' }, 
            colors: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%', // Ketebalan donut (opsional, bisa dikecilkan ke 55% jika mau lebih tipis)
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#9ca3af',
                                fontSize: '14px', // Font dikecilkan sedikit
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { position: 'bottom', fontSize: '12px' }, // Legend dikecilkan
            stroke: { show: false } 
        };

        var chartSource = new ApexCharts(document.querySelector("#chart-sources"), optionsSource);
        chartSource.render();

        // --- 2. Konfigurasi Grafik Bar (Status) ---
        var optionsStatus = {
            series: [{
                name: 'Jumlah Pasien',
                data: @json($statusData)
            }],
            chart: {
                type: 'bar',
                height: 260, // <-- UKURAN DIUBAH (Sebelumnya 320)
                background: 'transparent',
                toolbar: { show: false }
            },
            theme: { mode: 'dark' },
            colors: ['#10b981'], 
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true, 
                    barHeight: '45%' // Bar lebih tipis biar proporsional
                }
            },
            dataLabels: { enabled: true, style: { fontSize: '10px' } }, // Angka dikecilkan
            xaxis: {
                categories: @json($statusLabels),
                labels: { style: { colors: '#9ca3af', fontSize: '10px' } }
            },
            yaxis: {
                labels: { style: { colors: '#d1d5db', fontSize: '11px' } }
            },
            grid: {
                borderColor: '#374151',
                strokeDashArray: 4,
                padding: { top: 0, bottom: 0 } // Mengurangi padding kosong
            }
        };

        var chartStatus = new ApexCharts(document.querySelector("#chart-status"), optionsStatus);
        chartStatus.render();

        // --- 3. Konfigurasi Grafik Pie (Lost Reasons) ---
        var optionsLost = {
            series: @json($lostData),
            labels: @json($lostLabels),
            chart: {
                type: 'pie',
                height: 260,
                background: 'transparent'
            },
            theme: { mode: 'dark' },
            colors: ['#ef4444', '#f87171', '#b91c1c', '#991b1b', '#7f1d1d'], // Variasi Merah
            dataLabels: { enabled: true },
            legend: { position: 'bottom', fontSize: '12px' },
            stroke: { show: false }
        };

        // Render hanya jika ada data lost (mencegah error grafik kosong)
        if (@json($lostData).length > 0) {
            var chartLost = new ApexCharts(document.querySelector("#chart-lost"), optionsLost);
            chartLost.render();
        } else {
            document.querySelector("#chart-lost").innerHTML = "<p class='text-gray-600 text-xs italic'>Belum ada data pasien Lost.</p>";
        }
    </script>

</body>
</html>