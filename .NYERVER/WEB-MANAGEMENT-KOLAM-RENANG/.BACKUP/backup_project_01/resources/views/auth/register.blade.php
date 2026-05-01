@extends('layouts.layout-auth.app')
@section('auth-section')
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-white mb-2 uppercase tracking-tight">Register</h1>
        <p class="text-slate-400">Lengkapi data diri Anda untuk memulai perjalanan prestasi.</p>
    </div>

    <form class="space-y-6" action="{{ url('/register/process') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Nama
                    Lengkap</label>
                <input name="nama_lengkap" value="{{ old('nama_lengkap') }}" type="text" placeholder="Budi Santoso"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Nomor
                    Telepon</label>
                <input name="no_telepon" value="{{ old('no_telepon') }}" type="tel" placeholder="0812xxxx"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Alamat Email</label>
            <input name="email" value="{{ old('email') }}" placeholder="email@contoh.com"
                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Tanggal Lahir</label>
            <input name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" type="date"
                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Kata Sandi</label>
                <input name="password" type="password" placeholder="••••••••"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Konfirmasi
                    Sandi</label>
                <input name="password_confirm" type="password" placeholder="••••••••"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
            </div>
        </div>

        <div class="flex items-start gap-3 py-2">
            <input name="checkbox" type="checkbox" id="terms"
                class="mt-1 w-5 h-5 rounded border-white/10 bg-white/5 checked:bg-ksc-blue transition cursor-pointer">
            <label for="terms" class="text-sm text-slate-400 cursor-pointer hover:text-white transition">
                Saya menyetujui <a href="#" class="text-ksc-accent font-bold hover:underline">Syarat & Ketentuan</a>
                serta Kebijakan Privasi KSC.
            </label>
        </div>

        <button type="submit"
            class="w-full py-5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-[1.5rem] font-bold shadow-2xl shadow-ksc-blue/30 transition transform hover:-translate-y-1 active:scale-[0.98] text-lg">
            Daftar Sekarang
        </button>
    </form>

    <div class="mt-10 pt-10 border-t border-white/5 text-center">
        <p class="text-slate-400">
            Sudah menjadi member?
            <a href="/login" class="text-ksc-accent font-bold hover:underline underline-offset-4">Masuk Di Sini</a>
        </p>
    </div>
@endsection


{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member - Khafid Swimming Club (KSC)</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        ksc: { blue: '#1e40af', accent: '#f59e0b' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0f172a] min-h-screen flex items-center justify-center p-6 relative overflow-x-hidden py-20">
    @include('layouts.layout-partials.notification')
    <!-- Background Decoration -->
    

    <div class="w-full max-w-2xl relative z-10">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="inline-flex items-center gap-2">
                <div class="h-12 w-12 bg-ksc-accent rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">K</div>
                <span class="text-3xl font-bold text-white tracking-wide">KSC<span class="text-ksc-accent">.</span></span>
            </a>
        </div>

        <!-- Register Card -->
        


            <form class="space-y-6" action="{{ url('/register/process') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Nama Lengkap</label>
                        <input name="nama_lengkap" value="{{ old('nama_lengkap') }}" type="text" placeholder="Budi Santoso" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Nomor Telepon</label>
                        <input name="no_telepon" value="{{ old('no_telepon') }}" type="tel" placeholder="0812xxxx" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Alamat Email</label>
                    <input name="email" value="{{ old('email') }}" placeholder="email@contoh.com" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Tanggal Lahir</label>
                    <input name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" type="date" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Kata Sandi</label>
                        <input name="password" type="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 pl-1">Konfirmasi Sandi</label>
                        <input name="password_confirm" type="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3.5 text-white outline-none focus:ring-2 focus:ring-ksc-blue transition">
                    </div>
                </div>

                <div class="flex items-start gap-3 py-2">
                    <input name="checkbox" type="checkbox" id="terms" class="mt-1 w-5 h-5 rounded border-white/10 bg-white/5 checked:bg-ksc-blue transition cursor-pointer">
                    <label for="terms" class="text-sm text-slate-400 cursor-pointer hover:text-white transition">
                        Saya menyetujui <a href="#" class="text-ksc-accent font-bold hover:underline">Syarat & Ketentuan</a> serta Kebijakan Privasi KSC.
                    </label>
                </div>

                <button type="submit" class="w-full py-5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-[1.5rem] font-bold shadow-2xl shadow-ksc-blue/30 transition transform hover:-translate-y-1 active:scale-[0.98] text-lg">
                    Daftar Sekarang
                </button>
            </form>

            
        </div>
        
        <!-- Back Link -->
        <div class="text-center mt-10">
            <a href="/" class="text-slate-500 hover:text-white text-sm flex items-center justify-center gap-2 transition group font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html> --}}
