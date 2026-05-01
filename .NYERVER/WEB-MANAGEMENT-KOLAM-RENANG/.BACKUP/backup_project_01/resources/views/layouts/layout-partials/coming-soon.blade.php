<div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0d1117]">

    <!-- Animated Background Blobs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500 rounded-full mix-blend-lighten filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-[20%] right-[-10%] w-96 h-96 bg-purple-500 rounded-full mix-blend-lighten filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-pink-500 rounded-full mix-blend-lighten filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-4xl px-6 text-center">

        <!-- Logo Section -->
        <div class="flex items-center justify-center gap-3 mb-8 animate-float">
            {{-- <div
                class="h-16 w-16 bg-ksc-blue rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-xl shadow-ksc-blue/30">
                K</div>
            <span class="text-4xl font-bold text-slate-100 tracking-wide">KSC<span class="text-ksc-accent">.</span></span> --}}

            <a href="/" class="flex items-center gap-2">
                <img src="{{ url('/assets/ico/icon-bar.png') }}" class="w-[150px]">
            </a>
        </div>

        <!-- Heading -->
        <h1 class="text-4xl md:text-6xl font-bold text-slate-50 mb-6 leading-tight drop-shadow-md">
            Sesuatu yang <span class="bg-gradient-to-r from-ksc-blue to-purple-500 bg-clip-text text-transparent">Luar
                Biasa</span><br>Sedang Kami Persiapkan
        </h1>

        <p class="text-lg text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
            Kami sedang melakukan pembaruan sistem untuk meningkatkan pengalaman Anda. Halaman ini akan segera kembali
            dengan fitur yang lebih baik dan lebih cepat.
        <p>

        <!-- Countdown -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto mb-12">
            <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl shadow-lg border border-white/10">
                <span class="block text-3xl font-bold text-ksc-accent" id="days">00</span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Hari</span>
            </div>
            <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl shadow-lg border border-white/10">
                <span class="block text-3xl font-bold text-ksc-accent" id="hours">00</span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Jam</span>
            </div>
            <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl shadow-lg border border-white/10">
                <span class="block text-3xl font-bold text-ksc-accent" id="minutes">00</span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Menit</span>
            </div>
            <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl shadow-lg border border-white/10">
                <span class="block text-3xl font-bold text-ksc-accent" id="seconds">00</span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Detik</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/"
                class="px-8 py-4 bg-ksc-blue text-white font-bold rounded-2xl border border-ksc-dark hover:bg-ksc-dark transition shadow-lg shadow-ksc-blue/20 hover:shadow-ksc-blue/30 flex items-center gap-2 transform hover:-translate-y-1">
                <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Beranda
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-16 text-slate-500 text-xs font-medium">
            &copy; 2026 Khafid Swimming Club. All rights reserved.
        </div>
    </div>
</div>

<script>
    // Atur tanggal tujuan hitung mundur (contoh: 2 hari dari sekarang)
    const countDownDate = new Date(Date.now() + 14 * 24 * 60 * 60 * 1000).getTime();

    const updateCountdown = () => {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance < 0) {
            document.getElementById("days").innerText = "00";
            document.getElementById("hours").innerText = "00";
            document.getElementById("minutes").innerText = "00";
            document.getElementById("seconds").innerText = "00";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const format = (num) => num < 10 ? '0' + num : num;

        document.getElementById("days").innerText = format(days);
        document.getElementById("hours").innerText = format(hours);
        document.getElementById("minutes").innerText = format(minutes);
        document.getElementById("seconds").innerText = format(seconds);
    };
    
    // Perbarui hitungan setiap 1 detik
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Panggil sekali di awal
</script>
