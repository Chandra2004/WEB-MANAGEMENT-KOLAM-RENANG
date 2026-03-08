@extends('layouts.layout-dashboard.app')
@section('dashboard-section')
    <div class="flex-1 overflow-y-auto p-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                {{-- <div
                    class="bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 shadow-sm text-center md:text-left">
                    <div
                        class="h-10 w-10 bg-blue-50 text-ksc-blue rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Atlet</p>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mt-1">24</h3>
                </div> --}}
                {{-- <div
                    class="bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 shadow-sm text-center md:text-left">
                    <div
                        class="h-10 w-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0">
                        <i data-lucide="activity" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sesi Latihan</p>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mt-1">18</h3>
                </div> --}}
                {{-- <div
                    class="bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 shadow-sm text-center md:text-left">
                    <div
                        class="h-10 w-10 bg-ksc-accent/10 text-ksc-accent rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Lomba Aktif</p>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mt-1">3</h3>
                </div> --}}
                {{-- <div
                    class="bg-white p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 shadow-sm text-center md:text-left">
                    <div
                        class="h-10 w-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Target Medali</p>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mt-1">10</h3>
                </div> --}}
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Upcoming Competitions -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900 text-left">Jadwal Lomba Terdekat</h2>
                        <a href="lomba.html" class="text-sm font-bold text-ksc-blue hover:underline">Lihat
                            Semua</a>
                    </div>
                    <div
                        class="bg-white rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden text-left">
                        <div class="p-4 md:p-8 space-y-4 md:space-y-6">
                            <div
                                class="flex items-center gap-4 md:gap-6 p-4 rounded-2xl md:rounded-3xl bg-slate-50 hover:bg-slate-100 transition cursor-pointer">
                                <div
                                    class="h-12 w-12 md:h-16 md:w-16 rounded-xl md:rounded-2xl bg-ksc-blue flex flex-col items-center justify-center text-white shrink-0">
                                    <span class="text-sm md:text-lg font-bold">24</span>
                                    <span class="text-[8px] md:text-[10px] font-bold uppercase">Feb</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm md:text-base font-bold text-slate-900 leading-tight">
                                        Annual Championship 2026</h4>
                                    <p class="text-[10px] md:text-xs text-slate-500">Jakarta Pool • 12 Atlet</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="px-2 py-0.5 md:px-3 md:py-1 bg-ksc-accent text-slate-900 text-[8px] md:text-[10px] font-bold rounded-full">UTAMA</span>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-4 md:gap-6 p-4 rounded-2xl md:rounded-3xl bg-slate-50 hover:bg-slate-100 transition cursor-pointer text-left">
                                <div
                                    class="h-12 w-12 md:h-16 md:w-16 rounded-xl md:rounded-2xl bg-slate-200 flex flex-col items-center justify-center text-slate-500 shrink-0">
                                    <span class="text-sm md:text-lg font-bold">15</span>
                                    <span class="text-[8px] md:text-[10px] font-bold uppercase">Mar</span>
                                </div>
                                <div class="flex-1 text-left">
                                    <h4 class="text-sm md:text-base font-bold text-slate-900 leading-tight">
                                        Sprint Series: 50m Free</h4>
                                    <p class="text-[10px] md:text-xs text-slate-500">KSC Pool B • 8 Atlet</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="px-2 py-0.5 md:px-3 md:py-1 bg-blue-100 text-ksc-blue text-[8px] md:text-[10px] font-bold rounded-full">INTERNAL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages Summary -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-slate-900 text-left">Pesan Terbaru</h2>
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 space-y-6 text-left">
                        <div class="flex gap-4">
                            <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random"
                                class="h-10 w-10 rounded-xl">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-slate-900">Fikri Haikal</h4>
                                <p class="text-xs text-slate-500 line-clamp-1">Coach, bagaimana hasil
                                    evaluasi...</p>
                            </div>
                            <span class="text-[10px] text-slate-400">10m</span>
                        </div>
                        <div class="flex gap-4">
                            <img src="https://ui-avatars.com/api/?name=Admin+KSC&background=1e40af&color=fff"
                                class="h-10 w-10 rounded-xl">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-slate-900">Admin KSC</h4>
                                <p class="text-xs text-slate-500 line-clamp-1">Daftar peserta lomba sudah...</p>
                            </div>
                            <span class="text-[10px] text-slate-400">2j</span>
                        </div>
                        <a href="pesan.html"
                            class="block w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-500 text-center rounded-xl font-bold text-xs transition">
                            Lihat Semua Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
