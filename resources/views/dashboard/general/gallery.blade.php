@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50">
        {{-- 1. HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-10 gap-4 text-left">
            <div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight tracking-tight">Manajemen
                    Galeri KSC</h2>
                <p class="text-xs md:text-sm text-slate-500 font-medium mt-1">Penyimpanan aset visual terpadu ala Galeri
                    Android.</p>
            </div>
            <button data-modal-target="modal-tambah-gallery" data-modal-toggle="modal-tambah-gallery"
                class="w-full md:w-auto flex items-center justify-center gap-2 bg-slate-900 hover:bg-black text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition shadow-xl transform hover:-translate-y-1 active:scale-95">
                <i data-lucide="image-plus" class="w-5 h-5 text-ksc-blue"></i>
                <span>Tambah Foto</span>
            </button>
        </div>

        {{-- 2. ANDROID STYLE GRID --}}
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-1 md:gap-4">
            {{-- Dummy Data 1 --}}
            {{-- @for ($i = 0; $i < 50; $i++) --}}
            @foreach ($galleries as $gallery)
                
                <div
                    class="group relative aspect-square overflow-hidden bg-white md:rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500">
                    {{-- <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=1000" alt="Gallery"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"> --}}

                        <img src="{{ $gallery['foto_event'] }}" alt="Gallery"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <div
                        class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-2 md:p-4 text-left">
                        <div class="flex justify-end gap-1 md:gap-2">
                            <button data-modal-target="modal-edit-gallery" data-modal-toggle="modal-edit-gallery"
                                class="w-7 h-7 md:w-10 md:h-10 bg-white/90 backdrop-blur text-blue-600 rounded-lg md:rounded-xl flex items-center justify-center shadow-lg transition hover:scale-110">
                                <i data-lucide="pencil-line" class="w-3.5 h-3.5 md:w-5 md:h-5"></i>
                            </button>
                            <button data-modal-target="modal-hapus-gallery" data-modal-toggle="modal-hapus-gallery"
                                class="w-7 h-7 md:w-10 md:h-10 bg-white/90 backdrop-blur text-red-600 rounded-lg md:rounded-xl flex items-center justify-center shadow-lg transition hover:scale-110">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5 md:w-5 md:h-5"></i>
                            </button>
                        </div>
                        <div class="hidden md:block">
                            <span
                                class="text-[9px] font-black text-white uppercase tracking-widest bg-ksc-blue/80 px-3 py-1.5 rounded-lg backdrop-blur-md">
                                Kejuaraan Tasik
                            </span>
                        </div>
                    </div>
                </div> 
            @endforeach

            {{-- @endfor --}}
        </div>
        
        <div class="mt-12 flex flex-col md:flex-row items-center justify-between gap-6 pb-10 border-t border-slate-100 pt-8">
            {{-- 1. Info Data (Backend: $data->firstItem(), etc) --}}
            <div class="text-left">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                    Menampilkan <span class="text-slate-900 italic">1 - 24</span> 
                    dari <span class="text-ksc-blue">1,500</span> Foto Dokumentasi
                </p>
            </div>
        
            {{-- 2. Navigasi Pagination --}}
            <div class="flex items-center gap-2">
                {{-- Tombol Previous --}}
                <a href="#" class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-400 hover:text-ksc-blue hover:border-ksc-blue transition-all shadow-sm active:scale-90">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </a>
        
                {{-- Page Numbers (Looping Halaman) --}}
                <div class="flex items-center gap-1.5">
                    {{-- Halaman Aktif --}}
                    <span class="w-11 h-11 flex items-center justify-center rounded-2xl bg-slate-900 text-white font-black text-xs shadow-xl shadow-slate-200 cursor-default">
                        1
                    </span>
        
                    {{-- Halaman Lain --}}
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all active:scale-90">
                        2
                    </a>
        
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all active:scale-90">
                        3
                    </a>
        
                    {{-- Separator --}}
                    <span class="px-2 text-slate-300 font-black text-xs">...</span>
        
                    <a href="#" class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all active:scale-90">
                        62
                    </a>
                </div>
        
                {{-- Tombol Next --}}
                <a href="#" class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 hover:text-ksc-blue hover:border-ksc-blue transition-all shadow-sm active:scale-90">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modal-tambah-gallery" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden"
                x-data="galleryHandler()">
                <div class="flex items-center justify-between p-8 border-b border-slate-50">
                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight text-left">Unggah Foto Baru</h3>
                    <button type="button" class="text-slate-400 hover:text-slate-900 transition"
                        data-modal-hide="modal-tambah-gallery">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="p-8 text-left">
                    @csrf
                    <div class="space-y-8">
                        {{-- Preview Area --}}
                        <div class="flex flex-col items-center justify-center min-h-[250px] w-full bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 relative group transition-all duration-500 overflow-hidden"
                            :class="photoPreview ? 'border-none p-2' : 'p-12 cursor-pointer hover:bg-slate-100'"
                            @click="$refs.photoInput.click()">
                            <template x-if="photoPreview">
                                <img :src="photoPreview"
                                    class="max-w-full max-h-[500px] rounded-2xl shadow-2xl object-contain animate-in zoom-in duration-500">
                            </template>
                            <template x-if="!photoPreview">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div
                                        class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-400 mb-4">
                                        <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-900 uppercase tracking-tighter">Pilih Foto Event
                                    </p>
                                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-widest">Max Size
                                        2MB</p>
                                </div>
                            </template>
                            <input type="file" name="foto_event" x-ref="photoInput" class="hidden" accept="image/*"
                                @change="previewImage">
                        </div>

                        {{-- Searchable Select: Tambah --}}
                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1 block">Cari &
                                Pilih Event</label>
                            <div class="ts-wrapper-custom">
                                <select id="select-event-add" name="uid_event"
                                    placeholder="Ketik nama event untuk mencari..." autocomplete="off">
                                    <option value="">Cari event...</option>
                                    <option value="e1">Kejuaraan Renang Tasikmalaya</option>
                                    <option value="e2">KSC Fun Swimming 2026</option>
                                    <option value="e3">Lomba Estafet Surabaya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center pt-8 mt-8 border-t border-slate-100">
                        <button type="submit"
                            class="w-full bg-slate-900 text-white font-black text-[10px] uppercase tracking-[0.2em] py-5 rounded-2xl shadow-2xl hover:bg-black transition transform hover:-translate-y-1 active:scale-95">Simpan
                            ke Galeri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modal-edit-gallery" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden"
                x-data="galleryHandler('https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=1000')">
                <div class="flex items-center justify-between p-8 border-b border-slate-50 bg-slate-50/50">
                    <div class="flex items-center gap-3 text-left">
                        <div
                            class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-amber-200">
                            <i data-lucide="pencil-line" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Perbarui Dokumentasi</h3>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-900 transition"
                        data-modal-hide="modal-edit-gallery">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="p-8 text-left">
                    @csrf
                    <div class="space-y-8">
                        <div class="flex flex-col items-center justify-center min-h-[250px] w-full bg-slate-100 rounded-[2rem] relative group transition-all overflow-hidden p-2"
                            @click="$refs.editPhotoInput.click()">
                            <img :src="photoPreview"
                                class="max-w-full max-h-[500px] rounded-2xl shadow-xl object-contain animate-in fade-in zoom-in duration-500">
                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity cursor-pointer">
                                <span
                                    class="bg-white/90 backdrop-blur px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-2xl">Ganti
                                    File Baru</span>
                            </div>
                            <input type="file" name="foto_event" x-ref="editPhotoInput" class="hidden"
                                accept="image/*" @change="previewImage">
                        </div>

                        {{-- Searchable Select: Edit --}}
                        <div class="space-y-3">
                            <label
                                class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1 block text-left">Ganti
                                Relasi Event</label>
                            <div class="ts-wrapper-custom">
                                <select id="select-event-edit" name="uid_event" placeholder="Cari event terkait..."
                                    autocomplete="off">
                                    <option value="e1" selected>Kejuaraan Renang Tasikmalaya</option>
                                    <option value="e2">KSC Fun Swimming 2026</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center pt-8 mt-8 border-t border-slate-100">
                        <button type="submit"
                            class="w-full bg-amber-500 text-white font-black text-[10px] uppercase tracking-[0.2em] py-5 rounded-2xl shadow-2xl shadow-amber-100 hover:bg-amber-600 transition transform hover:-translate-y-1 active:scale-95">Simpan
                            Perubahan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 2. MODAL HAPUS GALLERY (Premium Alert) --}}
    <div id="modal-hapus-gallery" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity text-center">
        <div class="relative w-full max-w-sm max-h-full">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl border border-slate-200 p-12">
                {{-- Icon Peringatan --}}
                <div
                    class="w-20 h-20 bg-red-50 text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-6 transform -rotate-12 shadow-inner">
                    <i data-lucide="trash-2" class="w-10 h-10"></i>
                </div>

                <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Hapus Permanen?</h3>
                <p class="text-xs text-slate-400 font-medium mt-3 leading-relaxed">Aset visual ini akan dihapus selamanya
                    dari database galeri dan server penyimpanan.</p>

                <div class="flex flex-col gap-3 mt-10">
                    <form action="" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-600 text-white font-black text-[10px] uppercase py-4 rounded-2xl shadow-xl shadow-red-100 hover:bg-red-700 transition active:scale-95 tracking-widest">Ya,
                            Hapus Sekarang</button>
                    </form>
                    <button data-modal-hide="modal-hapus-gallery"
                        class="w-full bg-slate-100 text-slate-500 font-black text-[10px] uppercase py-4 rounded-2xl hover:bg-slate-200 transition tracking-widest">Batalkan
                        Aksi</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 767px) {
            .aspect-square {
                border-radius: 0px !important;
            }
        }

        @media (min-width: 768px) {
            .grid-cols-4 {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .grid-cols-5 {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }
        }

        /* Styling agar Tom Select menyatu dengan desain Senior */
        .ts-control {
            border-radius: 1rem !important;
            padding: 1rem !important;
            background-color: #f8fafc !important;
            /* bg-slate-50 */
            border: 1px solid #e2e8f0 !important;
            /* border-slate-200 */
            font-weight: 700 !important;
            font-size: 0.875rem !important;
        }

        .ts-dropdown {
            border-radius: 1rem !important;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1) !important;
            border: 1px solid #f1f5f9 !important;
            margin-top: 5px !important;
        }
    </style>

    <script>
        function galleryHandler(initialPreview = null) {
            return {
                photoPreview: initialPreview,
                previewImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.photoPreview = e.target.result;
                        setTimeout(() => lucide.createIcons(), 500);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Pencarian Event di Modal Tambah
            new TomSelect("#select-event-add", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            // Inisialisasi Pencarian Event di Modal Edit
            new TomSelect("#select-event-edit", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
@endsection
