@extends('layouts.layout-dashboard.app')

@section('content')
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Dashboard Ringkasan</h1>
            <p class="text-slate-500">Selamat datang di pusat kendali Khafid Swimming Club.</p>
        </div>
        <div class="flex gap-3">
            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-blue-600/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Buat Event Baru
            </button>
            <button class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white border border-white/5 rounded-xl font-bold transition">
                <i data-lucide="download" class="w-4 h-4"></i> Ekspor Laporan
            </button>
        </div>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card 1 -->
        <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="users" class="w-16 h-16 text-blue-500"></i>
            </div>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Total Atlet</p>
            <div class="flex items-end gap-3">
                <h2 class="text-4xl font-bold text-white">{{ $stats['total_athletes'] }}</h2>
                <span class="text-emerald-500 text-sm font-bold mb-1 flex items-center gap-1">
                    <i data-lucide="trending-up" class="w-3 h-3"></i> +12%
                </span>
            </div>
            <div class="mt-6 w-full h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 w-[70%]"></div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="building-2" class="w-16 h-16 text-purple-500"></i>
            </div>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Klub Bergabung</p>
            <div class="flex items-end gap-3">
                <h2 class="text-4xl font-bold text-white">{{ $stats['total_clubs'] }}</h2>
                <span class="text-emerald-500 text-sm font-bold mb-1 flex items-center gap-1">
                    <i data-lucide="trending-up" class="w-3 h-3"></i> +5%
                </span>
            </div>
            <div class="mt-6 w-full h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-purple-500 w-[45%]"></div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="calendar-days" class="w-16 h-16 text-amber-500"></i>
            </div>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Total Event</p>
            <div class="flex items-end gap-3">
                <h2 class="text-4xl font-bold text-white">{{ $stats['total_events'] }}</h2>
                <span class="text-slate-500 text-sm font-bold mb-1 italic">Aktif & Mendatang</span>
            </div>
            <div class="mt-6 w-full h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 w-[60%]"></div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="banknote" class="w-16 h-16 text-emerald-500"></i>
            </div>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Estimasi Pendapatan</p>
            <div class="flex items-end gap-3">
                <h2 class="text-3xl font-bold text-white">Rp 12.5M</h2>
                <span class="text-emerald-500 text-sm font-bold mb-1 flex items-center gap-1">
                    <i data-lucide="check-circle-2" class="w-3 h-3"></i> Terverifikasi
                </span>
            </div>
            <div class="mt-6 w-full h-1 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 w-[85%]"></div>
            </div>
        </div>
    </div>

    <!-- CONTENT SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- RECENT REGISTRATIONS -->
        <div class="lg:col-span-2 glass-card rounded-3xl p-8">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-white">Pendaftaran Terbaru</h3>
                <a href="#" class="text-blue-400 text-sm hover:underline font-bold">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-slate-500 text-xs uppercase tracking-widest border-b border-white/5">
                            <th class="pb-4 font-bold">Atlet</th>
                            <th class="pb-4 font-bold">Event</th>
                            <th class="pb-4 font-bold">Kategori</th>
                            <th class="pb-4 font-bold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($stats['recent_registrations'] as $reg)
                            <tr class="group">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-blue-600/20 flex items-center justify-center text-blue-400 font-bold">
                                            {{ substr($reg->user->username, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white group-hover:text-blue-400 transition">{{ $reg->user->username }}</p>
                                            <p class="text-[10px] text-slate-500">ID: #{{ substr($reg->uid, 0, 8) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <p class="text-sm text-slate-300 font-semibold">{{ $reg->eventCategory->event->nama_event }}</p>
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 bg-white/5 rounded-full text-[10px] font-bold text-slate-400 uppercase">
                                        {{ $reg->eventCategory->category->name }}
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-[10px] font-bold uppercase">
                                        Lunas
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-500 italic">
                                    Belum ada pendaftaran terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- QUICK ACTIONS / INFO -->
        <div class="space-y-6">
            <div class="glass-card rounded-3xl p-8 bg-gradient-to-br from-blue-600/20 to-indigo-600/5 border-blue-500/20">
                <h3 class="text-lg font-bold text-white mb-4">Butuh Bantuan?</h3>
                <p class="text-sm text-slate-400 mb-6 leading-relaxed">Sistem Command Center KSC memantau seluruh aktivitas klub. Jika terjadi kendala sistem, hubungi tim teknis.</p>
                <button class="w-full py-3 bg-white text-blue-900 rounded-xl font-bold hover:bg-blue-50 transition">
                    Dokumentasi Admin
                </button>
            </div>

            <div class="glass-card rounded-3xl p-8">
                <h3 class="text-lg font-bold text-white mb-6">Status Server</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold">Database</span>
                        <span class="flex items-center gap-2 text-xs text-emerald-500 font-bold">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span> Online
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold">Storage</span>
                        <span class="text-xs text-slate-500 font-bold">85% / 100GB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
