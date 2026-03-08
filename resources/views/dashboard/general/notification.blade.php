@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
<div class="flex flex-col h-screen overflow-hidden bg-slate-50" x-data="{ 
    activeMsg: null,
    mobileView: 'list',
    {{-- Data Dummy yang nantinya akan di-foreach dari Controller --}}
    messages: [
        {
            id: 1,
            sender: 'Sistem Konfirmasi KSC',
            subject: 'Pembayaran Anda Telah Diterima!',
            time: '14:20',
            date: '21 Feb 2026',
            category: 'Status Pembayaran',
            content: 'Halo <strong>Nabil</strong>,<br><br>Kami informasikan bahwa status pembayaran Anda telah divalidasi.',
            uid: 'DB-9921-X'
        },
        {
            id: 2,
            sender: 'Admin KSC',
            subject: 'Lengkapi Profil Anda',
            time: 'Kemarin',
            date: '20 Feb 2026',
            category: 'Sistem',
            content: 'Halo <strong>Nabil</strong>,<br><br>Mohon segera mengunggah foto KTP yang jelas di halaman profil.',
            uid: 'DB-8842-Y'
        }
    ]
}">
    <div class="flex flex-1 overflow-hidden relative">
        
        <div class="w-full md:w-96 flex flex-col border-r border-slate-200 bg-white"
             :class="mobileView === 'detail' ? 'hidden md:flex' : 'flex'">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-900">Kotak Masuk</h2>
            </div>
            
            <div class="flex-1 overflow-y-auto">
                {{-- Bagian yang akan di-foreach junior Anda nanti --}}
                <template x-for="msg in messages" :key="msg.id">
                    <div @click="activeMsg = msg; mobileView = 'detail'" 
                        :class="activeMsg && activeMsg.id === msg.id ? 'bg-blue-50 border-l-4 border-blue-600' : 'hover:bg-slate-50 border-l-4 border-transparent'"
                        class="p-4 border-b border-slate-50 cursor-pointer transition">
                        <div class="flex justify-between items-start">
                            <span class="text-[10px] font-bold text-blue-600 uppercase" x-text="msg.category"></span>
                            <span class="text-[10px] text-slate-400" x-text="msg.time"></span>
                        </div>
                        <h4 class="text-sm font-bold text-slate-900 truncate" x-text="msg.subject"></h4>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex-1 flex flex-col bg-white" :class="mobileView === 'list' ? 'hidden md:flex' : 'flex'">
            
            <div x-show="!activeMsg" class="flex-1 flex flex-col items-center justify-center p-12 text-slate-400">
                <i data-lucide="mail" class="w-12 h-12 mb-4 opacity-20"></i>
                <p>Pilih pesan untuk dibaca</p>
            </div>

            <div x-show="activeMsg" class="flex flex-col h-full" x-cloak>
                <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-white sticky top-0">
                    <button @click="mobileView = 'list'; activeMsg = null" class="md:hidden text-slate-500 font-bold text-xs flex items-center gap-1">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i> Kembali
                    </button>
                    <div class="flex gap-2 ml-auto">
                        {{-- Tombol Hapus: Mengirim ID ke Modal --}}
                        <button type="button" @click="openDeleteModal(activeMsg.uid)" class="p-2 text-slate-400 hover:text-red-600 transition">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="p-8 overflow-y-auto flex-1 text-left">
                    <h1 class="text-3xl font-black text-slate-900 mb-6" x-text="activeMsg?.subject"></h1>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-600" x-text="activeMsg?.sender.charAt(0)"></div>
                        <div>
                            <p class="text-sm font-bold text-slate-800" x-text="activeMsg?.sender"></p>
                            <p class="text-[10px] text-slate-400" x-text="activeMsg?.date"></p>
                        </div>
                    </div>
                    <div class="prose prose-slate max-w-none text-slate-600" x-html="activeMsg?.content"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full shadow-2xl text-center">
        <div class="w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="alert-triangle" class="w-8 h-8"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus Pesan?</h3>
        <p class="text-sm text-slate-500 mb-8">Data akan dihapus permanen dari database.</p>
        
        {{-- Form Murni (Tanpa action/csrf sesuai instruksi) --}}
        <form id="deleteForm" method="POST">
            <input type="hidden" name="message_uid" id="modal_uid_input">
            
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 text-sm font-bold text-slate-500 bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="flex-1 py-3 text-sm font-bold text-white bg-red-600 rounded-xl shadow-lg shadow-red-200">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modalElement = document.getElementById('deleteModal');
    const inputElement = document.getElementById('modal_uid_input');

    // Fungsi membuka modal dan menangkap UID
    function openDeleteModal(uid) {
        inputElement.value = uid; // Set UID ke hidden input
        modalElement.classList.remove('hidden');
        modalElement.classList.add('flex');
    }

    // Fungsi menutup modal
    function closeDeleteModal() {
        modalElement.classList.add('hidden');
        modalElement.classList.remove('flex');
    }

    // Klik di luar box untuk menutup
    window.onclick = function(event) {
        if (event.target == modalElement) closeDeleteModal();
    }

    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection