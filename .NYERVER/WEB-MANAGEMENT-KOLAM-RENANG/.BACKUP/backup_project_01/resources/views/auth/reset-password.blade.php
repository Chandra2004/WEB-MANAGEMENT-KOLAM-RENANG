@extends('layouts.layout-auth.app')
@section('auth-section')
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-white mb-2 uppercase tracking-tight">Reset Kata Sandi</h1>
        <p class="text-slate-400">Masukkan kata sandi baru Anda di bawah ini.</p>
    </div>

    <form class="space-y-6" action="{{ url('/reset-password/' . $data['uid'] . '/process') }}" method="POST">
        @csrf
        <div class="space-y-2">
            <input name="token" type="hidden" value="{{ $data['token'] }}">
            <input name="email" type="hidden" value="{{ $data['email'] }}">
        </div>
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest pl-1">Kata Sandi Baru</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="lock"
                        class="w-5 h-5 text-slate-500 group-focus-within:text-ksc-blue transition-colors"></i>
                </div>
                <input name="password" type="password" placeholder="********"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder:text-slate-600 outline-none focus:ring-2 focus:ring-ksc-blue focus:border-transparent transition-all hover:bg-white/10"
                    required>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest pl-1">Konfirmasi Kata Sandi Baru</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="lock"
                        class="w-5 h-5 text-slate-500 group-focus-within:text-ksc-blue transition-colors"></i>
                </div>
                <input name="password_confirm" type="password" placeholder="********"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-3.5 text-white placeholder:text-slate-600 outline-none focus:ring-2 focus:ring-ksc-blue focus:border-transparent transition-all hover:bg-white/10"
                    required>
            </div>
        </div>

        <button type="submit"
            class="w-full py-4 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 group">
            <span>Reset Kata Sandi</span>
            <i data-lucide="send" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
        </button>
    </form>
@endsection