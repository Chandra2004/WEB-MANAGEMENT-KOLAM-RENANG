@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto" x-data="{ openEvent: null }">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 leading-tight tracking-tight italic uppercase">Pendaftaran Saya</h2>
                <p class="text-sm text-slate-500 font-medium">Pantau status pendaftaran dan akses tiket kompetisi Anda.</p>
            </div>
        </div>

        {{-- Loop Riwayat (Dummy Data) --}}
        <div class="space-y-4">
            @php
                // Data dummy disesuaikan dengan struktur objek di file PHP Anda
                $myRegistrations = [
                    (object)[
                        'uid' => 'REG-9912',
                        'status_pendaftaran' => 'disetujui',
                        'metode_pembayaran' => 'Transfer BCA',
                        'total_bayar' => 150000,
                        'created_at' => '2023-10-15',
                        'event' => (object)[
                            'nama_event' => 'National Robotics Competition 2024',
                            'tipe_event' => 'berbayar'
                        ]
                    ],
                    (object)[
                        'uid' => 'REG-9915',
                        'status_pendaftaran' => 'pending',
                        'metode_pembayaran' => 'Dana',
                        'total_bayar' => 75000,
                        'created_at' => '2023-11-02',
                        'event' => (object)[
                            'nama_event' => 'Web Design Global Championship',
                            'tipe_event' => 'berbayar'
                        ]
                    ]
                ];
            @endphp

            @foreach ($myRegistrations as $index => $reg)
                <div class="bg-white border border-slate-200 rounded-[2rem] overflow-hidden transition-all duration-300 shadow-sm hover:shadow-md">
                    {{-- Header Kartu (Klik untuk buka detail) --}}
                    <div @click="openEvent === {{ $index }} ? openEvent = null : openEvent = {{ $index }}"
                        class="p-6 cursor-pointer flex items-center justify-between hover:bg-slate-50 transition-colors">
                        
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-slate-200">
                                <i data-lucide="calendar" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-900 uppercase italic tracking-wide">{{ $reg->event->nama_event }}</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">ID: #{{ $reg->uid }} • {{ date('d M Y', strtotime($reg->created_at)) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            {{-- Badge Status --}}
                            @if($reg->status_pendaftaran == 'disetujui')
                                <span class="hidden md:block px-4 py-1.5 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-full border border-green-100 italic">Terverifikasi</span>
                            @else
                                <span class="hidden md:block px-4 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black uppercase rounded-full border border-amber-100 italic">Menunggu</span>
                            @endif
                            
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="openEvent === {{ $index }} ? 'rotate-180' : ''"></i>
                        </div>
                    </div>

                    {{-- Detail Content (Accordion) --}}
                    <div x-show="openEvent === {{ $index }}" x-collapse>
                        <div class="px-6 pb-8 pt-2 border-t border-slate-50">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                {{-- Rincian Pembayaran --}}
                                <div class="bg-slate-50 p-6 rounded-[1.5rem] border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 italic">Rincian Pembayaran</p>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500 font-medium">Metode:</span>
                                            <span class="text-slate-900 font-bold uppercase">{{ $reg->metode_pembayaran }}</span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500 font-medium">Total Bayar:</span>
                                            <span class="text-blue-600 font-black italic">Rp {{ number_format($reg->total_bayar, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Status Info --}}
                                <div class="bg-slate-50 p-6 rounded-[1.5rem] border border-slate-100 flex flex-col justify-center">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 italic text-center">Status Verifikasi</p>
                                    <div class="flex items-center justify-center gap-2">
                                        @if($reg->status_pendaftaran == 'disetujui')
                                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-green-100">
                                                <i data-lucide="check" class="w-5 h-5"></i>
                                            </div>
                                            <span class="text-xs font-black text-green-600 uppercase italic">Pendaftaran Berhasil</span>
                                        @else
                                            <div class="w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-amber-100 animate-pulse">
                                                <i data-lucide="clock" class="w-5 h-5"></i>
                                            </div>
                                            <span class="text-xs font-black text-amber-600 uppercase italic">Dalam Antrian Admin</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Akses Tiket --}}
                                <div class="flex items-center justify-center">
                                    @if($reg->status_pendaftaran == 'disetujui')
                                        <a href="#" class="w-full py-4 bg-slate-900 hover:bg-black text-white text-center rounded-2xl font-black text-xs shadow-xl shadow-slate-200 transition-all active:scale-95 flex items-center justify-center gap-2 uppercase italic tracking-widest">
                                            <i data-lucide="download" class="w-4 h-4 text-blue-400"></i>
                                            Unduh E-Ticket
                                        </a>
                                    @else
                                        <div class="w-full py-4 bg-white border-2 border-dashed border-slate-200 text-slate-400 rounded-2xl font-black text-[10px] text-center uppercase tracking-widest italic">
                                            Tiket Belum Tersedia
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Jika Kosong --}}
        @if(count($myRegistrations) == 0)
            <div class="text-center py-20 bg-white border border-dashed border-slate-200 rounded-[3rem]">
                <div class="w-20 h-20 bg-slate-50 text-slate-200 rounded-[2rem] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="inbox" class="w-10 h-10"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900 italic uppercase">Belum Ada Riwayat</h3>
                <p class="text-xs text-slate-500 mt-1">Daftar ke event kompetisi untuk memulai.</p>
            </div>
        @endif
    </div>
@endsection