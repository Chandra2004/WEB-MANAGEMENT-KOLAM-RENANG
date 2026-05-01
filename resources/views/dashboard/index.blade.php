@extends('layouts.layout-dashboard.app')
@section('content')
@endsection
{{--

@section('content')
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">
                @role('superadmin') Command Center @else Dashboard Atlet @endrole
            </h1>
            <p class="text-slate-500">Selamat datang kembali, {{ Auth::user()->username }}.</p>
        </div>

        <div class="flex gap-3">
            @role('superadmin')
                <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-blue-600/20">
                    <i data-lucide="plus" class="w-4 h-4"></i> Buat Event Baru
                </button>
            @endrole

            @role('atlet')
                <a href="/" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-blue-600/20">
                    <i data-lucide="search" class="w-4 h-4"></i> Cari Lomba
                </a>
            @endrole
        </div>
    </div>

    <!-- STATS GRID (Dynamic based on Role) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @role('superadmin')
            <!-- Stats untuk Superadmin -->
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Total Atlet</p>
                <h2 class="text-4xl font-bold text-white">{{ $data['total_athletes'] }}</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Klub Bergabung</p>
                <h2 class="text-4xl font-bold text-white">{{ $data['total_clubs'] }}</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Total Event</p>
                <h2 class="text-4xl font-bold text-white">{{ $data['total_events'] }}</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Pendapatan</p>
                <h2 class="text-3xl font-bold text-white">Rp 12.5M</h2>
            </div>
        @endrole

        @role('atlet')
            <!-- Stats untuk Atlet -->
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group border-blue-500/20 bg-blue-500/5">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Lomba Diikuti</p>
                <h2 class="text-4xl font-bold text-white">{{ count($data['my_registrations']) }}</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Sertifikat</p>
                <h2 class="text-4xl font-bold text-white">0</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Poin KSC</p>
                <h2 class="text-4xl font-bold text-white">1,250</h2>
            </div>
            <div class="glass-card p-6 rounded-3xl relative overflow-hidden group">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-4">Status Akun</p>
                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs font-bold uppercase">Aktif</span>
            </div>
        @endrole
    </div>

    <!-- MAIN CONTENT SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 glass-card rounded-3xl p-8">
            @role('superadmin')
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-white">Pendaftaran Terbaru (Sistem)</h3>
                    <a href="#" class="text-blue-400 text-sm hover:underline font-bold">Lihat Semua</a>
                </div>
                <!-- Table Pendaftaran (Superadmin View) -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-slate-500 text-xs uppercase tracking-widest border-b border-white/5">
                                <th class="pb-4">Atlet</th>
                                <th class="pb-4">Event</th>
                                <th class="pb-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($data['recent_registrations'] as $reg)
                                <tr>
                                    <td class="py-4 font-bold text-white">{{ $reg->user->username }}</td>
                                    <td class="py-4 text-sm text-slate-400">{{ $reg->eventCategory->event->nama_event }}</td>
                                    <td class="py-4 text-right">
                                        <span class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded text-[10px] font-bold">LUNAS</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endrole

            @role('atlet')
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-white">Riwayat Lomba Anda</h3>
                </div>
                <!-- Table Pendaftaran (Atlet View) -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-slate-500 text-xs uppercase tracking-widest border-b border-white/5">
                                <th class="pb-4">Nama Event</th>
                                <th class="pb-4">Tanggal</th>
                                <th class="pb-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($data['my_registrations'] as $myReg)
                                <tr>
                                    <td class="py-4 font-bold text-white">{{ $myReg->eventCategory->event->nama_event }}</td>
                                    <td class="py-4 text-sm text-slate-400">{{ $myReg->eventCategory->event->tanggal_event ?? 'TBA' }}</td>
                                    <td class="py-4 text-right">
                                        <span class="px-2 py-1 bg-blue-500/10 text-blue-500 rounded text-[10px] font-bold uppercase">Terdaftar</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-10 text-center text-slate-500 italic">Anda belum mendaftar lomba apapun.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endrole
        </div>

        <!-- SIDEBAR INFO (Universal) -->
        <div class="space-y-6">
            <div class="glass-card rounded-3xl p-8 bg-gradient-to-br from-blue-600/20 to-indigo-600/5 border-blue-500/20">
                <h3 class="text-lg font-bold text-white mb-2">Informasi Penting</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Pastikan data profil Anda selalu diperbarui untuk mempermudah proses verifikasi pendaftaran lomba.
                </p>
                <button class="mt-6 w-full py-3 bg-white text-blue-900 rounded-xl font-bold hover:bg-blue-50 transition text-sm">
                    Lengkapi Profil
                </button>
            </div>
        </div>
    </div>
@endsection --}}
