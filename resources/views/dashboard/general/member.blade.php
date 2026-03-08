@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 leading-tight">Manajemen Member</h2>
                <p class="text-sm text-slate-500">Kelola data anggota dan verifikasi identitas peserta</p>
            </div>
            <button data-modal-target="modal-tambah-member" data-modal-toggle="modal-tambah-member"
                class="flex items-center gap-2 bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2.5 rounded-lg font-semibold transition shadow-sm focus:ring-4 focus:ring-blue-300"
                type="button">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>Tambah Member</span>
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Member</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Info Klub & Kontak</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Identitas</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($members as $member)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Member+Nabil&background=eff6ff&color=1e40af"
                                            class="w-10 h-10 rounded-full border border-slate-200 object-cover">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">{{ $member['nama_lengkap'] }}</p>
                                            <p class="text-xs text-slate-500">{{ $member['email'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-slate-700">{{ $member['nama_klub'] }}</p>
                                    <p class="text-[10px] text-slate-500 font-medium italic">{{ $member['no_telepon'] }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button class="text-xs font-bold text-ksc-blue hover:underline">Lihat KTP</button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">
                                        <button data-modal-target="modal-edit-member-{{ $member['uid'] }}"
                                            data-modal-toggle="modal-edit-member-{{ $member['uid'] }}"
                                            class="text-blue-600 hover:text-blue-800 transition p-1">
                                            <i data-lucide="edit-2" class="w-5 h-5"></i>
                                        </button>
                                        <button data-modal-target="modal-hapus-member-{{ $member['uid'] }}"
                                            data-modal-toggle="modal-hapus-member-{{ $member['uid'] }}"
                                            class="text-red-600 hover:text-red-800 transition p-1">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-tambah-member" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-[2rem] shadow-2xl border border-slate-200 overflow-hidden"
                x-data="memberUploadHandler()">
                {{-- Header --}}
                <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-ksc-blue rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                            <i data-lucide="user-plus" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Daftarkan Member Baru</h3>
                    </div>
                    <button type="button"
                        class="text-slate-400 hover:bg-slate-100 hover:text-slate-900 rounded-xl text-sm w-9 h-9 flex justify-center items-center transition"
                        data-modal-hide="modal-tambah-member">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                {{-- Form Body --}}
                <form
                    action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/' . $member['uid'] . '/dashboard/management-member/create/process') }}"
                    method="POST" class="p-6 md:p-8 max-h-[80vh] overflow-y-auto custom-scrollbar"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- Bagian Upload Foto (Row Atas) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        {{-- 1. Foto Profil --}}
                        <div class="space-y-3">
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest text-left ml-1">Pas
                                Foto Profil</label>
                            <div class="relative group cursor-pointer" @click="$refs.avatarInput.click()">
                                <div
                                    class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center overflow-hidden transition hover:border-ksc-blue/50 group">
                                    <template x-if="avatarPreview">
                                        <img :src="avatarPreview" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!avatarPreview">
                                        <div class="flex flex-col items-center">
                                            <i data-lucide="image" class="w-8 h-8 text-slate-300 mb-2"></i>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Pilih
                                                Foto</span>
                                        </div>
                                    </template>
                                    <div
                                        class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Ganti
                                            Gambar</span>
                                    </div>
                                </div>
                                <input type="file" name="foto_profil" x-ref="avatarInput" class="hidden" accept="image/*"
                                    @change="previewImage($event, 'avatar')">
                            </div>
                        </div>

                        {{-- 2. Foto KTP --}}
                        <div class="space-y-3">
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest text-left ml-1">Scan
                                Kartu Identitas (KTP)</label>
                            <div class="relative group cursor-pointer" @click="$refs.ktpInput.click()">
                                <div
                                    class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center overflow-hidden transition hover:border-ksc-blue/50 group">
                                    <template x-if="ktpPreview">
                                        <img :src="ktpPreview" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!ktpPreview">
                                        <div class="flex flex-col items-center">
                                            <i data-lucide="contact-2" class="w-8 h-8 text-slate-300 mb-2"></i>
                                            <span
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Pilih
                                                KTP</span>
                                        </div>
                                    </template>
                                    <div
                                        class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Ganti
                                            KTP</span>
                                    </div>
                                </div>
                                <input type="file" name="foto_ktp" x-ref="ktpInput" class="hidden" accept="image/*"
                                    @change="previewImage($event, 'ktp')">
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Biodata --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-left">
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama
                                Lengkap</label>
                            <input type="text" name="nama_lengkap" maxlength="100"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                required>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Alamat
                                Email</label>
                            <input type="email" name="email" maxlength="150"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                required>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Password
                                Default</label>
                            <input type="password" name="password"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor
                                Telepon</label>
                            <input type="text" name="no_telepon" maxlength="20"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Afiliasi
                                Klub</label>
                            <input type="text" name="nama_klub" maxlength="100"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tanggal
                                Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition">
                        </div>
                        <div class="md:col-span-2">
                            <label
                                class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Alamat
                                Lengkap (KTP)</label>
                            <textarea name="alamat" rows="2"
                                class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition">{{ $member['alamat'] }}</textarea>
                        </div>
                    </div>

                    {{-- Footer Aksi --}}
                    <div class="flex items-center pt-8 mt-6 border-t border-slate-100 space-x-3 justify-end">
                        <button data-modal-hide="modal-tambah-member" type="button"
                            class="text-slate-500 bg-white hover:bg-slate-50 rounded-xl border border-slate-200 text-[10px] font-black uppercase tracking-widest px-6 py-3 transition">Batal</button>
                        <button type="submit"
                            class="text-white bg-slate-900 hover:bg-black font-black text-[10px] uppercase tracking-[0.2em] rounded-xl px-8 py-3 shadow-xl shadow-slate-200 transition-all transform hover:-translate-y-1">Simpan
                            Member Resmi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function memberUploadHandler() {
            return {
                avatarPreview: null,
                ktpPreview: null,

                previewImage(event, type) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (type === 'avatar') {
                            this.avatarPreview = e.target.result;
                        } else {
                            this.ktpPreview = e.target.result;
                        }
                        setTimeout(() => lucide.createIcons(), 100);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>

    @foreach ($members as $member)
        <div id="modal-edit-member-{{ $member['uid'] }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-[2rem] shadow-2xl border border-slate-200 overflow-hidden"
                    x-data="memberEditHandler()">

                    {{-- Header Modal --}}
                    <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-amber-200">
                                <i data-lucide="user-cog" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight text-left">Perbarui Data
                                Anggota</h3>
                        </div>
                        <button type="button"
                            class="text-slate-400 hover:bg-slate-100 hover:text-slate-900 rounded-xl text-sm w-9 h-9 ms-auto inline-flex justify-center items-center transition"
                            data-modal-hide="modal-edit-member-{{ $member['uid'] }}">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <form
                        action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/' . $member['uid'] . '/dashboard/management-member/edit/process') }}"
                        method="POST" enctype="multipart/form-data"
                        class="p-6 md:p-8 max-h-[80vh] overflow-y-auto custom-scrollbar">
                        @csrf
                        {{-- Row 1: Dual Upload Preview --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            {{-- Preview Foto Profil --}}
                            <div class="space-y-3">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase tracking-widest text-left ml-1">Foto
                                    Profil Saat Ini</label>
                                <div class="relative group cursor-pointer" @click="$refs.avatarInputEdit.click()">
                                    <div
                                        class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center overflow-hidden transition hover:border-ksc-blue/50">
                                        <img :src="avatarPreview ??
                                            'https://ui-avatars.com/api/?name=User&background=eff6ff&color=1e40af'"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Ubah
                                                Foto</span>
                                        </div>
                                    </div>
                                    <input type="file" name="foto_profil" x-ref="avatarInputEdit" class="hidden"
                                        accept="image/*" @change="previewImage($event, 'avatar')">
                                </div>
                            </div>

                            {{-- Preview Foto KTP --}}
                            <div class="space-y-3">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase tracking-widest text-left ml-1">Lampiran
                                    KTP (Verifikasi)</label>
                                <div class="relative group cursor-pointer" @click="$refs.ktpInputEdit.click()">
                                    <div
                                        class="w-full h-40 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center overflow-hidden transition hover:border-ksc-blue/50">
                                        <template x-if="ktpPreview">
                                            <img :src="ktpPreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!ktpPreview">
                                            <div class="flex flex-col items-center">
                                                <i data-lucide="image-plus" class="w-8 h-8 text-slate-300 mb-2"></i>
                                                <span
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Belum
                                                    Ada KTP</span>
                                            </div>
                                        </template>
                                        <div
                                            class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                            <span
                                                class="text-[10px] font-black text-white uppercase tracking-widest">Update
                                                KTP</span>
                                        </div>
                                    </div>
                                    <input type="file" name="foto_ktp" x-ref="ktpInputEdit" class="hidden"
                                        accept="image/*" @change="previewImage($event, 'ktp')">
                                </div>
                            </div>
                        </div>

                        {{-- Row 2: Biodata Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-left">
                            <div>
                                <label
                                    class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama
                                    Lengkap</label>
                                <input type="text" name="nama_lengkap" maxlength="100"
                                    class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                    value="{{ $member['nama_lengkap'] }}">
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Email
                                    (Permanen)
                                </label>
                                <input type="email" name="email"
                                    class="bg-slate-100 border border-slate-200 text-slate-500 text-sm font-bold rounded-xl block w-full p-3.5 outline-none cursor-not-allowed"
                                    value="{{ $member['email'] }}" readonly>
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor
                                    Telepon</label>
                                <input type="text" name="no_telepon" maxlength="20"
                                    class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                    value="{{ $member['no_telepon'] }}">
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama
                                    Klub</label>
                                <input type="text" name="nama_klub" maxlength="100"
                                    class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                    value="{{ $member['nama_klub'] }}">
                            </div>
                            <div class="md:col-span-2">
                                <label
                                    class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Ganti
                                    Password (Kosongkan jika tidak diubah)</label>
                                <input type="password" name="password"
                                    class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-3.5 outline-none transition"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        {{-- Footer Action --}}
                        <div class="flex items-center pt-8 mt-6 border-t border-slate-100 space-x-3 justify-end">
                            <button data-modal-hide="modal-edit-member-{{ $member['uid'] }}" type="button"
                                class="text-slate-500 bg-white hover:bg-slate-50 rounded-xl border border-slate-200 text-[10px] font-black uppercase tracking-widest px-6 py-3 transition">Batal</button>
                            <button type="submit"
                                class="text-white bg-amber-500 hover:bg-amber-600 font-black text-[10px] uppercase tracking-[0.2em] rounded-xl px-8 py-3 shadow-xl shadow-amber-200 transition-all transform hover:-translate-y-1">Perbarui
                                Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function memberEditHandler() {
                return {
                    // Ganti dengan URL data asli dari backend di sisi Junior
                    avatarPreview: "https://ui-avatars.com/api/?name=Nabil&background=eff6ff&color=1e40af",
                    ktpPreview: null,

                    previewImage(event, type) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            if (type === 'avatar') {
                                this.avatarPreview = e.target.result;
                            } else {
                                this.ktpPreview = e.target.result;
                            }
                            setTimeout(() => lucide.createIcons(), 100);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        </script>

        <div id="modal-hapus-member-{{ $member['uid'] }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
            <div class="relative w-full max-w-sm max-h-full">
                <div class="relative bg-white rounded-lg shadow-2xl border border-slate-200">
                    <div class="p-4 md:p-6 text-center">
                        <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="trash-2" class="text-red-600 w-8 h-8"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-slate-900">Hapus Member?</h3>
                        <p class="mb-6 text-sm text-slate-500 text-left">Seluruh data pendaftaran event dan riwayat
                            pembayaran
                            member ini akan dihapus permanen.</p>
                        <div class="flex justify-center gap-3">
                            <button data-modal-hide="modal-hapus-member-{{ $member['uid'] }}" type="button"
                                class="text-slate-500 bg-white hover:bg-slate-100 rounded-lg border border-slate-200 text-sm font-medium px-5 py-2.5 transition">Tutup</button>
                            <form
                                action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/' . $member['uid'] . '/dashboard/management-member/delete/process') }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 font-bold rounded-lg text-sm px-5 py-2.5 transition">Ya,
                                    Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
@endsection
