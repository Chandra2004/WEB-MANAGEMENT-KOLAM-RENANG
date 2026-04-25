@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 leading-tight">Manajemen Pengguna</h2>
                <p class="text-sm text-slate-500">Kelola data admin, pelatih, dan member sistem</p>
            </div>
            <button data-modal-target="modal-tambah-user" data-modal-toggle="modal-tambah-user"
                class="flex items-center gap-2 bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2.5 rounded-lg font-semibold transition shadow-sm focus:ring-4 focus:ring-blue-300"
                type="button">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>Tambah Pengguna</span>
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Profil</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Kontak & Klub</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Tgl Lahir</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    @foreach ($users as $pengguna)
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($pengguna['foto_profil'])
                                            <img src="{{ url('/file/users/' . $pengguna['foto_profil']) }}"
                                                class="w-10 h-10 rounded-full border border-slate-200 object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($pengguna['nama_lengkap']) }}&background=eff6ff&color=1e40af&bold=true"
                                                class="w-10 h-10 rounded-full border border-slate-200 object-cover">
                                        @endif
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">{{ $pengguna['nama_lengkap'] }}</p>
                                            <p class="text-xs text-slate-500">{{ $pengguna['email'] }}</p>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest {{ $pengguna['nama_role'] == 'admin' ? 'bg-red-50 text-red-600' : ($pengguna['nama_role'] == 'coach' ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600') }}">
                                                {{ $pengguna['nama_role'] }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs font-bold text-slate-700">{{ $pengguna['no_telepon'] }}</p>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold tracking-tight">
                                        {{ $pengguna['nama_klub'] ?? 'Belum Ada Klub' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-slate-600">{{ $pengguna['tanggal_lahir'] }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-3">
                                        <button data-modal-target="modal-edit-pengguna-{{ $pengguna['uid'] }}"
                                            data-modal-toggle="modal-edit-pengguna-{{ $pengguna['uid'] }}"
                                            class="text-blue-600 hover:text-blue-800 transition p-1">
                                            <i data-lucide="user-cog" class="w-5 h-5"></i>
                                        </button>
                                        <button data-modal-target="modal-hapus-pengguna-{{ $pengguna['uid'] }}"
                                            data-modal-toggle="modal-hapus-pengguna-{{ $pengguna['uid'] }}"
                                            class="text-red-600 hover:text-red-800 transition p-1">
                                            <i data-lucide="user-minus" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div id="modal-tambah-user" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-slate-100 rounded-t">
                    <h3 class="text-lg font-bold text-slate-900">Registrasi Pengguna Baru</h3>
                    <button type="button"
                        class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modal-tambah-user">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <form
                    action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-user/create/process') }}"
                    method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Lengkap</label>
                            <input name="nama_lengkap" type="text"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Email</label>
                            <input name="email" type="email"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Password</label>
                            <input name="password" type="password"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Password Confirm</label>
                            <input name="password_confirm" type="password"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Nomor Telepon</label>
                            <input name="no_telepon" type="text"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Tanggal Lahir</label>
                            <input name="tanggal_lahir" type="date"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Jenis
                                Kelamin</label>
                            <select name="jenis_kelamin"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Afiliasi Klub</label>
                            <select name="nama_klub"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none cursor-pointer">
                                <option value="" selected disabled>Pilih Klub Renang</option>
                                <option value="KHAFID SWIMMING CLUB">KHAFID SWIMMING CLUB</option>
                                <option value="SIDOARJO AQUATIC CLUB">SIDOARJO AQUATIC CLUB (SAC)</option>
                                <option value="DELTA SWIMMING CLUB">DELTA SWIMMING CLUB</option>
                                <option value="JALASARI AQUATIC CLUB">JALASARI AQUATIC CLUB (JAC)</option>
                                <option value="FELLA SWIMMING">FELLA SWIMMING</option>
                                <option value="LAFI SWIMMING ACADEMY">LAFI SWIMMING ACADEMY</option>
                                <option value="SIDOARJO MUDA AQUATIC">SIDOARJO MUDA AQUATIC</option>
                                <option value="OSCAR SWIMMING CLUB">OSCAR SWIMMING CLUB</option>
                                <option value="HI-SIDOARJO AQUATIC">HI-SIDOARJO AQUATIC</option>
                                <option value="ELITE SWIMMING SIDOARJO">ELITE SWIMMING SIDOARJO</option>
                                <option value="AL-FATH SWIMMING">AL-FATH SWIMMING</option>
                                <option value="DOLPHIN SWIMMING SIDOARJO">DOLPHIN SWIMMING SIDOARJO</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Alamat</label>
                            <textarea name="alamat" rows="3"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Foto KTP</label>
                            <input name="foto_ktp" type="file" accept="image/*"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Foto Profil</label>
                            <input name="foto_profil" type="file" accept="image/*"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Role</label>
                            <select name="uid_role"
                                class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                                @foreach ($roles as $role)
                                    <option value="{{ $role['uid'] }}">{{ $role['nama_role'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2 flex items-center gap-3 py-2">
                            <input name="is_active" type="checkbox" id="is_active_checkbox"
                                class="w-5 h-5 rounded border-slate-500 bg-slate-300 text-ksc-blue focus:ring-ksc-blue transition cursor-pointer">
                            <label for="is_active_checkbox" class="text-sm text-slate-600 cursor-pointer transition">
                                Dengan ini meyetujui keaktifan akun ini.
                            </label>
                        </div>
                        <div class="md:col-span-2 flex items-center gap-3 py-2">
                            <input name="checkbox" type="checkbox" id="terms_checkbox"
                                class="w-5 h-5 rounded border-slate-500 bg-slate-300 text-ksc-blue focus:ring-ksc-blue transition cursor-pointer">
                            <label for="terms_checkbox" class="text-sm text-slate-600 cursor-pointer transition">
                                Saya menyetujui <a href="#" class="text-ksc-accent font-bold hover:underline">Syarat
                                    &
                                    Ketentuan</a>
                                serta Kebijakan Privasi KSC.
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center pt-5 border-t border-slate-100 space-x-3 justify-end">
                        <button data-modal-hide="modal-tambah-user" type="button"
                            class="text-slate-500 bg-white hover:bg-slate-100 rounded-lg border border-slate-200 text-sm font-medium px-5 py-2.5 transition">Batal</button>
                        <button type="submit"
                            class="text-white bg-ksc-blue hover:bg-ksc-dark font-bold rounded-lg text-sm px-6 py-2.5 transition">Simpan
                            User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($users as $pengguna)
        <div id="modal-edit-pengguna-{{ $pengguna['uid'] }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow-2xl border border-slate-200">
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b border-slate-100 rounded-t text-left">
                        <h3 class="text-lg font-bold text-slate-900">Ubah Data Pengguna</h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:bg-slate-100 hover:text-slate-900 rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="modal-edit-pengguna-{{ $pengguna['uid'] }}">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <form
                        action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/' . $pengguna['uid'] . '/dashboard/management-user/edit/process') }}"
                        method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Lengkap</label>
                                <input name="nama_lengkap" type="text"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['nama_lengkap'] }}">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Email</label>
                                <input name="email" type="email"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['email'] }}">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Password</label>
                                <input name="password" type="password"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Password
                                    Confirm</label>
                                <input name="password_confirm" type="password"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Nomor
                                    Telepon</label>
                                <input name="no_telepon" type="text"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['no_telepon'] }}">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Tanggal
                                    Lahir</label>
                                <input name="tanggal_lahir" type="date"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['tanggal_lahir'] }}">
                            </div>
                            <div>
                                <label
                                    class="block
                                    mb-2 text-sm font-semibold text-slate-700">Jenis
                                    Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                                    <option value="L" {{ $pengguna['jenis_kelamin'] == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P" {{ $pengguna['jenis_kelamin'] == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Afiliasi Klub</label>
                                <select name="nama_klub"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none cursor-pointer">
                                    <option value="" disabled>Pilih Klub Renang</option>
                                    <option value="KHAFID SWIMMING CLUB"
                                        {{ $pengguna['nama_klub'] == 'KHAFID SWIMMING CLUB' ? 'selected' : '' }}>KHAFID
                                        SWIMMING CLUB</option>
                                    <option value="SIDOARJO AQUATIC CLUB"
                                        {{ $pengguna['nama_klub'] == 'SIDOARJO AQUATIC CLUB' ? 'selected' : '' }}>SIDOARJO
                                        AQUATIC CLUB (SAC)</option>
                                    <option value="DELTA SWIMMING CLUB"
                                        {{ $pengguna['nama_klub'] == 'DELTA SWIMMING CLUB' ? 'selected' : '' }}>DELTA
                                        SWIMMING CLUB</option>
                                    <option value="JALASARI AQUATIC CLUB"
                                        {{ $pengguna['nama_klub'] == 'JALASARI AQUATIC CLUB' ? 'selected' : '' }}>JALASARI
                                        AQUATIC CLUB (JAC)</option>
                                    <option value="FELLA SWIMMING"
                                        {{ $pengguna['nama_klub'] == 'FELLA SWIMMING' ? 'selected' : '' }}>FELLA SWIMMING
                                    </option>
                                    <option value="LAFI SWIMMING ACADEMY"
                                        {{ $pengguna['nama_klub'] == 'LAFI SWIMMING ACADEMY' ? 'selected' : '' }}>LAFI
                                        SWIMMING ACADEMY</option>
                                    <option value="SIDOARJO MUDA AQUATIC"
                                        {{ $pengguna['nama_klub'] == 'SIDOARJO MUDA AQUATIC' ? 'selected' : '' }}>SIDOARJO
                                        MUDA AQUATIC</option>
                                    <option value="OSCAR SWIMMING CLUB"
                                        {{ $pengguna['nama_klub'] == 'OSCAR SWIMMING CLUB' ? 'selected' : '' }}>OSCAR
                                        SWIMMING CLUB</option>
                                    <option value="HI-SIDOARJO AQUATIC"
                                        {{ $pengguna['nama_klub'] == 'HI-SIDOARJO AQUATIC' ? 'selected' : '' }}>HI-SIDOARJO
                                        AQUATIC</option>
                                    <option value="ELITE SWIMMING SIDOARJO"
                                        {{ $pengguna['nama_klub'] == 'ELITE SWIMMING SIDOARJO' ? 'selected' : '' }}>ELITE
                                        SWIMMING SIDOARJO</option>
                                    <option value="AL-FATH SWIMMING"
                                        {{ $pengguna['nama_klub'] == 'AL-FATH SWIMMING' ? 'selected' : '' }}>AL-FATH
                                        SWIMMING</option>
                                    <option value="DOLPHIN SWIMMING SIDOARJO"
                                        {{ $pengguna['nama_klub'] == 'DOLPHIN SWIMMING SIDOARJO' ? 'selected' : '' }}>
                                        DOLPHIN SWIMMING SIDOARJO</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Alamat</label>
                                <textarea name="alamat" rows="3"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">{{ $pengguna['alamat'] }}</textarea>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Foto KTP</label>
                                <input name="foto_ktp" type="file" accept="image/*"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['foto_ktp'] }}">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Foto Profil</label>
                                <input name="foto_profil" type="file" accept="image/*"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none"
                                    value="{{ $pengguna['foto_profil'] }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Role</label>
                                <select name="uid_role"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-ksc-blue focus:border-ksc-blue block w-full p-2.5 outline-none">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role['uid'] }}"
                                            {{ $pengguna['uid_role'] == $role['uid'] ? 'selected' : '' }}>
                                            {{ $role['nama_role'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2 flex items-center gap-3 py-2">
                                <input name="is_active" type="checkbox"
                                    id="is_active_checkbox_edit_{{ $pengguna['uid'] }}"
                                    class="w-5 h-5 rounded border-slate-500 bg-slate-300 text-ksc-blue focus:ring-ksc-blue transition cursor-pointer"
                                    {{ $pengguna['is_active'] ? 'checked' : '' }}>
                                <label for="is_active_checkbox_edit_{{ $pengguna['uid'] }}"
                                    class="text-sm text-slate-600 cursor-pointer transition">
                                    Dengan ini meyetujui keaktifan akun ini.
                                </label>
                            </div>
                            <div class="md:col-span-2 flex items-center gap-3 py-2">
                                <input name="checkbox" type="checkbox" id="terms_checkbox_edit_{{ $pengguna['uid'] }}"
                                    class="w-5 h-5 rounded border-slate-500 bg-slate-300 text-ksc-blue focus:ring-ksc-blue transition cursor-pointer">
                                <label for="terms_checkbox_edit_{{ $pengguna['uid'] }}"
                                    class="text-sm text-slate-600 cursor-pointer transition">
                                    Saya menyetujui <a href="#"
                                        class="text-ksc-accent font-bold hover:underline">Syarat
                                        &
                                        Ketentuan</a>
                                    serta Kebijakan Privasi KSC.
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center pt-5 border-t border-slate-100 space-x-3 justify-end">
                            <button data-modal-hide="modal-edit-pengguna-{{ $pengguna['uid'] }}" type="button"
                                class="text-slate-500 bg-white hover:bg-slate-100 rounded-lg border border-slate-200 text-sm font-medium px-5 py-2.5 transition">Batal</button>
                            <button type="submit"
                                class="text-white bg-ksc-blue hover:bg-ksc-dark font-bold rounded-lg text-sm px-6 py-2.5 transition">Simpan
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modal-hapus-pengguna-{{ $pengguna['uid'] }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 left-0 right-0 z-[70] w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full flex items-center justify-center bg-slate-900/60 backdrop-blur-sm transition-opacity">
            <div class="relative w-full max-w-sm max-h-full">
                <div class="relative bg-white rounded-lg shadow-2xl border border-slate-200">
                    <div class="p-4 md:p-6 text-center">
                        <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="user-x" class="text-red-600 w-8 h-8"></i>
                        </div>
                        <h3 class="mb-2 text-lg font-bold text-slate-900">Hapus Pengguna?</h3>
                        <p class="mb-6 text-sm text-slate-500">Seluruh data terkait user ini akan dihapus permanen.</p>
                        <div class="flex justify-center gap-3">
                            <button data-modal-hide="modal-hapus-pengguna-{{ $pengguna['uid'] }}" type="button"
                                class="text-slate-500 bg-white hover:bg-slate-100 rounded-lg border border-slate-200 text-sm font-medium px-5 py-2.5 transition text-left">Batal</button>
                            <form
                                action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/' . $pengguna['uid'] . '/dashboard/management-user/delete/process') }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 font-bold rounded-lg text-sm px-5 py-2.5 transition shadow-sm">Ya,
                                    Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
