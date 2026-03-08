@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50">
        {{-- HEADER --}}
        <div class="mb-8 text-left">
            <h2 class="text-3xl font-black text-slate-900 leading-tight tracking-tight uppercase">Pengaturan Profil</h2>
            <p class="text-sm text-slate-500 font-medium italic">Kelola identitas digital dan dokumen verifikasi dalam satu
                panel terpadu.</p>
        </div>

        {{-- FORM ALL-IN (Data & Media) --}}
        <form action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/my-profile/edit/process') }}"
            method="POST" enctype="multipart/form-data" x-data="profileHandler()">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="space-y-6">
                    <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm text-center">
                        <div class="relative w-40 h-40 mx-auto mb-6">
                            <img :src="avatarUrl"
                                class="w-full h-full rounded-[2.5rem] object-cover border-4 border-slate-50 shadow-xl transition-all duration-500"
                                :class="loadingAvatar ? 'opacity-50 blur-sm' : ''">

                            <button type="button" @click="$refs.avatarInput.click()"
                                class="absolute -bottom-2 -right-2 bg-white border border-slate-200 p-3 rounded-2xl shadow-xl hover:text-ksc-blue transition-all active:scale-95 group">
                                <i data-lucide="camera" class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue"
                                    x-show="!loadingAvatar"></i>
                                <i data-lucide="loader-2" class="w-5 h-5 animate-spin text-ksc-blue"
                                    x-show="loadingAvatar"></i>
                            </button>

                            <input type="file" name="foto_profil" x-ref="avatarInput" class="hidden" accept="image/*"
                                @change="previewFile($event, 'avatar')">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">Avatar Anggota</h3>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mt-1 italic">Profil Utama
                        </p>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm text-left">
                        <label class="block mb-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Verifikasi
                            Identitas (KTP)</label>
                        <div class="relative w-full h-44 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 overflow-hidden group cursor-pointer"
                            @click="$refs.ktpInput.click()">

                            <img :src="ktpUrl" x-show="ktpUrl" class="w-full h-full object-cover">

                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity"
                                x-show="ktpUrl">
                                <p class="text-white text-[10px] font-bold uppercase tracking-widest">Ganti Lampiran KTP</p>
                            </div>

                            <div class="flex flex-col items-center justify-center h-full space-y-2" x-show="!ktpUrl">
                                <i data-lucide="image-plus" class="w-8 h-8 text-slate-300"></i>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Unggah Foto KTP
                                </p>
                            </div>
                        </div>
                        <input type="file" name="foto_ktp" x-ref="ktpInput" class="hidden" accept="image/*"
                            @change="previewFile($event, 'ktp')">
                        <p class="mt-4 text-[9px] text-slate-400 italic text-center font-medium uppercase tracking-tighter">
                            * Data KTP bersifat rahasia dan hanya untuk validasi admin</p>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6 text-left">
                    <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                        <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-ksc-blue border border-slate-100">
                                <i data-lucide="user-cog" class="w-5 h-5"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 uppercase tracking-tight">Detail Informasi Personal</h4>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Alamat
                                        Email (Akun)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                            <i data-lucide="mail" class="w-4 h-4"></i>
                                        </div>
                                        <input type="email"
                                            class="bg-slate-50 border border-slate-100 text-slate-400 text-sm rounded-2xl block w-full pl-12 p-4 outline-none cursor-not-allowed font-medium shadow-inner"
                                            value="{{ $user['email'] }}" readonly>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama_lengkap" maxlength="100"
                                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition"
                                        value="{{ $user['nama_lengkap'] }}">
                                </div>

                                <div>
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor
                                        Telepon</label>
                                    <input type="text" name="no_telepon" maxlength="20"
                                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition"
                                        value="{{ $user['no_telepon'] }}">
                                </div>

                                <div>
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tanggal
                                        Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition"
                                        value="{{ $user['tanggal_lahir'] }}">
                                </div>

                                <div>
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Jenis
                                        Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition cursor-pointer appearance-none">
                                        <option selected disabled>Silahkan pilih salah satu</option>
                                        <option {{ $user['jenis_kelamin'] == 'L' ? 'selected' : '' }} value="L">
                                            Laki-laki</option>
                                        <option {{ $user['jenis_kelamin'] == 'P' ? 'selected' : '' }} value="P">
                                            Perempuan</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Afiliasi
                                        Klub</label>
                                    <div class="relative">
                                        <input type="text"
                                            class="bg-slate-50 border border-slate-100 text-slate-400 text-sm rounded-2xl block w-full p-4 outline-none cursor-not-allowed font-bold italic shadow-inner"
                                            value="{{ $user['nama_klub'] }}" readonly>
                                        <span
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[9px] font-black text-amber-500 uppercase tracking-tighter bg-amber-50 px-2 py-1 rounded-md border border-amber-100">Permanen</span>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Domisili
                                        / Alamat Lengkap</label>
                                    <textarea name="alamat" rows="3"
                                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition"
                                        placeholder="Tulis alamat lengkap Anda...">{{ $user['alamat'] }}</textarea>
                                </div>

                                <div class="md:col-span-2 pt-6 border-t border-slate-50">
                                    <label
                                        class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Keamanan
                                        Akun: Password</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 transition-colors group-focus-within:text-ksc-blue">
                                            <i data-lucide="lock" class="w-4 h-4"></i>
                                        </div>
                                        <input type="password" name="password"
                                            class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full pl-12 p-4 outline-none transition"
                                            placeholder="Kosongkan jika tidak ingin mengubah password">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-12">
                                <button type="submit"
                                    class="bg-slate-900 hover:bg-black text-white px-10 py-4 rounded-2xl font-black text-xs transition shadow-2xl shadow-slate-300 flex items-center gap-3 uppercase tracking-[0.2em] transform hover:-translate-y-1 active:scale-95">
                                    <i data-lucide="save" class="w-5 h-5 text-ksc-blue"></i>
                                    Simpan Semua Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <script>
        function profileHandler() {
            return {
                avatarUrl: `{{ $user['foto_profil']
                    ? url('/file/users/' . $user['foto_profil'])
                    : 'https://ui-avatars.com/api/?name=' .
                        urlencode($user['nama_lengkap']) .
                        '&background=eff6ff&color=1e40af&size=256&bold=true' }}`,
                loadingAvatar: false,
                ktpUrl: `{{ $user['foto_ktp']
                    ? url('/file/id_cards/' . $user['foto_ktp'])
                    : null }}`,

                previewFile(event, type) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (type === 'avatar') this.loadingAvatar = true;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if (type === 'avatar') {
                            this.avatarUrl = e.target.result;
                            setTimeout(() => this.loadingAvatar = false, 400);
                        } else {
                            this.ktpUrl = e.target.result;
                        }

                        setTimeout(() => {
                            if (window.lucide) lucide.createIcons();
                        }, 500);
                    };

                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
