@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50">

        {{-- 1. GREETING SECTION --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 text-left">
            <div>
                <h1 class="text-3xl font-black text-slate-900 leading-tight tracking-tight">
                    Halo, {{ $user['nama_lengkap'] }}
                </h1>
                <p class="text-sm text-slate-500 font-medium mt-1">
                    Panel Kendali Utama KSC — Role: {{ $user['nama_role'] }}
                    <span class="text-ksc-blue font-bold uppercase">{{ $user['nama_role'] }}</span>.
                </p>
            </div>
            <div class="px-5 py-3 bg-white border border-slate-200 rounded-2xl shadow-sm flex items-center gap-3">
                <i data-lucide="calendar" class="w-5 h-5 text-slate-400"></i>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">{{ date('d M y') }}</span>
            </div>
        </div>

        {{-- 2. STATISTIC CARDS (All-In Operasional) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            {{-- Card: Total Member Terdaftar --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-blue-100/50 transition duration-300 group">
                <div class="flex flex-col items-start gap-4">
                    <div
                        class="w-12 h-12 bg-blue-50 text-ksc-blue rounded-2xl flex items-center justify-center shadow-inner group-hover:bg-ksc-blue group-hover:text-white transition-colors">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Anggota</p>
                        <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $totalAnggota }}</h4>
                    </div>
                </div>
            </div>

            {{-- Card: Event Aktif --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-amber-100/50 transition duration-300 group">
                <div class="flex flex-col items-start gap-4">
                    <div
                        class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:bg-amber-500 group-hover:text-white transition-colors">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Event Aktif</p>
                        <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $eventAktif }}</h4>
                    </div>
                </div>
            </div>

            {{-- Card: Pendaftaran Menunggu Verifikasi --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-red-100/50 transition duration-300 group text-left">
                <div class="flex flex-col items-start gap-4">
                    <div
                        class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Antrean Validasi</p>
                        <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $antreanValidasi }}</h4>
                    </div>
                </div>
            </div>

            {{-- Card Ganti Pendapatan: Okupansi/Kapasitas Peserta --}}
            <div
                class="bg-slate-900 p-6 rounded-[2.5rem] border border-slate-800 shadow-2xl shadow-slate-300 transition duration-300 overflow-hidden relative group text-left">
                <div class="relative z-10 flex flex-col items-start gap-4">
                    <div
                        class="w-12 h-12 bg-white/10 text-white rounded-2xl flex items-center justify-center backdrop-blur-md">
                        <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Okupansi Kuota</p>
                        <h4 class="text-2xl font-black text-white mt-1 italic">85% Full</h4>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-ksc-blue/20 rounded-full blur-3xl"></div>
            </div>
        </div>

        {{-- 3. MAIN CONTENT: RECENT ACTIVITY & QUICK ACTIONS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">

            {{-- List Pendaftaran Teranyar --}}
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Pendaftaran Baru Masuk</h3>
                    <a href="{{ url('/' . $user['nama_role'] . '/dashboard/management-registration') }}"
                        class="text-[10px] font-bold text-ksc-blue hover:underline uppercase">Kelola Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($members as $member)
                                <tr
                                    class="group hover:bg-slate-50 transition-all duration-200 border-b border-slate-50 last:border-none text-left">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center gap-4">
                                            {{-- Foto Profil Logic --}}
                                            <div class="relative shrink-0">
                                                @if (!empty($member['foto_profil']))
                                                    <div
                                                        class="w-11 h-11 rounded-xl overflow-hidden shadow-sm border border-slate-200">
                                                        <img src="{{ url('/file/users/' . $member['foto_profil']) }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-11 h-11 rounded-xl overflow-hidden shadow-sm border border-slate-100 bg-blue-50">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member['nama_lengkap']) }}&background=eff6ff&color=1e40af&bold=true"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                                <div
                                                    class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-white rounded-full flex items-center justify-center border-2 border-white">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                                </div>
                                            </div>

                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-bold text-slate-900 group-hover:text-ksc-blue transition-colors">{{ $member['nama_lengkap'] }}</span>
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="shield-check" class="w-3 h-3 text-slate-300"></i>
                                                    <span
                                                        class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $member['nama_klub'] ?? 'Tidak memilik klub' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-4 text-center">
                                        <div
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 text-amber-600 border border-amber-100 shadow-sm shadow-amber-50/50">
                                            <span class="relative flex h-1.5 w-1.5">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-1.5 w-1.5 bg-amber-500"></span>
                                            </span>
                                            <span class="text-[9px] font-black uppercase tracking-widest">Menunggu</span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-4 text-right">
                                        <div class="flex flex-col items-end">
                                            <span class="text-xs font-bold text-slate-900">Baru Saja</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SISI KANAN: QUICK ACTIONS & INFO --}}
            <div class="space-y-6">
                <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Navigasi Cepat</h3>
                    <div class="grid grid-cols-1 gap-3">
                        <a href="{{ url('/' . $user['nama_role'] . '/dashboard/management-event') }}"
                            class="w-full flex items-center justify-between p-4 bg-slate-50 hover:bg-slate-900 hover:text-white rounded-2xl transition group text-left">
                            <span class="text-xs font-bold">Atur Kompetisi</span>
                            <i data-lucide="plus-square" class="w-4 h-4 text-slate-300 group-hover:text-white"></i>
                        </a>
                        <a href="{{ url('/' . $user['nama_role'] . '/dashboard/management-user') }}"
                            class="w-full flex items-center justify-between p-4 bg-slate-50 hover:bg-slate-900 hover:text-white rounded-2xl transition group text-left">
                            <span class="text-xs font-bold">Input Member Manual</span>
                            <i data-lucide="user-plus" class="w-4 h-4 text-slate-300 group-hover:text-white"></i>
                        </a>
                        <a href="{{ url('/' . $user['nama_role'] . '/dashboard/export-reports') }}"
                            class="w-full flex items-center justify-between p-4 bg-slate-50 hover:bg-slate-900 hover:text-white rounded-2xl transition group text-left">
                            <span class="text-xs font-bold">Tarik Laporan Data</span>
                            <i data-lucide="file-spreadsheet" class="w-4 h-4 text-slate-300 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                {{-- Panel Notifikasi Singkat --}}
                <div
                    class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-slate-300 overflow-hidden relative">
                    <div class="relative z-10 text-left">
                        <div class="flex items-center gap-2 mb-4">
                            <i data-lucide="bell" class="w-5 h-5 text-ksc-blue"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">Sistem Info</span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-medium leading-relaxed italic uppercase">
                            Pastikan semua dokumen KTP dan bukti pembayaran member diperiksa secara teliti sebelum
                            menyetujui
                            pendaftaran.
                        </p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-ksc-blue/20 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
