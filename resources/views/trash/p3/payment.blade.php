<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Lomba - KSC Member</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { ksc: { blue: '#1e40af', dark: '#1e3a8a', accent: '#f59e0b', light: '#eff6ff' } }
                }
            }
        }
    </script>

    <style>
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(30, 64, 175, 0.1) 0%, rgba(30, 64, 175, 0) 100%);
            border-left: 4px solid #1e40af;
            color: #1e40af;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-700 font-sans">

    <div class="flex min-h-screen text-left">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-[60] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300">
            <div class="h-full flex flex-col p-6 text-left">
                <!-- Logo & Close (Mobile) -->
                <div class="flex items-center justify-between mb-10 px-2 text-left">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-10 w-10 bg-ksc-blue rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            K</div>
                        <span
                            class="text-2xl font-bold text-slate-900 tracking-wide underline decoration-ksc-accent decoration-4 underline-offset-4">KSC<span
                                class="text-ksc-accent">.</span></span>
                    </div>
                    <button id="closeSidebar"
                        class="lg:hidden p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <nav class="flex-1 space-y-2 text-left">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Member Area</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="lomba.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                        <span>Pendaftaran Lomba</span>
                    </a>
                    <a href="pesan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Kotak Masuk</span>
                    </a>
                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Pengaturan
                    </p>
                    <a href="profile.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left">
                        <i data-lucide="user-circle" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="pengaturan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left">
                        <i data-lucide="settings" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>

                <div class="pt-6 border-t border-slate-100">
                    <a href="../page/register.html"
                        class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition group text-left">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition text-left"></i>
                        <span class="font-bold text-sm text-left">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden text-left">
            <header
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4 text-left">
                    <a href="lomba.html" class="p-2 hover:bg-slate-100 rounded-lg text-slate-500">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    </a>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight" id="pageTitle">Pembayaran
                        </h1>

                    </div>
                </div>

                <div class="flex items-center gap-2 md:gap-4 relative text-left">
                    <a href="payment.html"
                        class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-slate-50 rounded-full transition"
                        title="Riwayat Tagihan">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </a>
                    <div class="relative">
                        <button id="notifBtn"
                            class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-slate-50 rounded-full transition">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span
                                class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full"></span>
                        </button>

                        <!-- Notif Dropdown -->
                        <div id="notifDropdown"
                            class="absolute right-0 mt-3 w-72 md:w-80 bg-white rounded-3xl shadow-2xl border border-slate-100 hidden z-50 overflow-hidden transform origin-top-right transition-all duration-200">
                            <div
                                class="p-5 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center text-left">
                                <h3 class="font-bold text-slate-900 text-sm">Notifikasi</h3>
                                <span class="text-[10px] font-bold text-ksc-blue bg-blue-50 px-2 py-0.5 rounded">2
                                    Baru</span>
                            </div>
                            <div class="max-h-[350px] overflow-y-auto">
                                <div
                                    class="p-4 border-b border-slate-50 hover:bg-slate-50 transition cursor-pointer flex gap-3 text-left">
                                    <div
                                        class="h-8 w-8 bg-blue-100 text-ksc-blue rounded-lg flex items-center justify-center shrink-0">
                                        <i data-lucide="megaphone" class="w-4 h-4"></i></div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 leading-tight">Jadwal Latihan
                                            Tambahan</p>
                                        <p class="text-[10px] text-slate-500 mt-1 line-clamp-1">Ada sesi tambahan di
                                            hari sabtu...</p>
                                        <span class="text-[9px] text-slate-400 mt-1 block italic underline">2 jam yang
                                            lalu</span>
                                    </div>
                                </div>
                                <div
                                    class="p-4 border-b border-slate-50 hover:bg-slate-50 transition cursor-pointer flex gap-3 text-left">
                                    <div
                                        class="h-8 w-8 bg-orange-100 text-ksc-accent rounded-lg flex items-center justify-center shrink-0 text-left">
                                        <i data-lucide="credit-card" class="w-4 h-4"></i></div>
                                    <div class="text-left">
                                        <p class="text-xs font-bold text-slate-900 leading-tight">Pembayaran Iuran</p>
                                        <p class="text-[10px] text-slate-500 mt-1 line-clamp-1">Pembayaran iuran Feb
                                            berhasil.</p>
                                        <span
                                            class="text-[9px] text-slate-400 mt-1 block italic underline">Kemarin</span>
                                    </div>
                                </div>
                            </div>
                            <a href="pesan.html"
                                class="block p-4 text-center text-[11px] font-bold text-ksc-blue hover:bg-slate-50 transition">
                                Lihat Seluruh Kotak Masuk
                            </a>
                        </div>
                    </div>
                    <div
                        class="h-9 w-9 md:h-10 md:w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200">
                        <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random" alt="User">
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6 text-left">
                            <!-- Biodata Section (Always Visible) -->
                            <div
                                class="bg-white rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm p-6 md:p-8">
                                <h3 class="text-base md:text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                    <i data-lucide="user" class="w-5 h-5 text-ksc-blue"></i>
                                    Konfirmasi Biodata
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                    <div class="p-4 bg-slate-50 rounded-2xl">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                            Nama Peserta</p>
                                        <p class="text-sm font-bold text-slate-900">Fikri Haikal</p>
                                    </div>
                                    <div class="p-4 bg-slate-50 rounded-2xl">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                            ID Member</p>
                                        <p class="text-sm font-bold text-slate-900">KSC-2026-0083</p>
                                    </div>
                                    <div class="p-4 bg-slate-50 rounded-2xl md:col-span-2">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                            Kategori Lomba</p>
                                        <p class="text-sm font-bold text-slate-900" id="summaryCategory">Sprint 50m Gaya
                                            Bebas</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div id="paymentMethodsSection"
                                class="bg-white rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm p-6 md:p-8">
                                <h3 class="text-base md:text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                    <i data-lucide="credit-card" class="w-5 h-5 text-ksc-blue"></i>
                                    Metode Pembayaran
                                </h3>

                                <div class="space-y-3 md:space-y-4">
                                    <label class="block cursor-pointer group">
                                        <input type="radio" name="payment" class="hidden peer" checked>
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border border-slate-100 peer-checked:border-ksc-blue peer-checked:bg-blue-50/50 rounded-2xl transition group-hover:border-slate-200">
                                            <div class="flex items-center gap-3 md:gap-4 text-left">
                                                <div
                                                    class="h-10 w-10 flex items-center justify-center bg-white rounded-lg border border-slate-100 italic font-extrabold text-ksc-blue text-[10px]">
                                                    BCA</div>
                                                <div>
                                                    <p class="text-xs md:text-sm font-bold text-slate-900">Transfer Bank
                                                        BCA</p>
                                                    <p class="text-[9px] md:text-[10px] text-slate-500">Admin Fee Rp 0
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="h-5 w-5 rounded-full border-2 border-slate-200 peer-checked:border-ksc-blue flex items-center justify-center p-1">
                                                <div
                                                    class="h-full w-full bg-ksc-blue rounded-full opacity-0 peer-checked:opacity-100">
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="block cursor-pointer group">
                                        <input type="radio" name="payment" class="hidden peer">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border border-slate-100 peer-checked:border-ksc-blue peer-checked:bg-blue-50/50 rounded-2xl transition group-hover:border-slate-200">
                                            <div class="flex items-center gap-3 md:gap-4 text-left">
                                                <div
                                                    class="h-10 w-10 flex items-center justify-center bg-white rounded-lg border border-slate-100 font-extrabold text-ksc-accent text-[10px]">
                                                    QRIS</div>
                                                <div>
                                                    <p class="text-xs md:text-sm font-bold text-slate-900">QRIS All
                                                        Payment</p>
                                                    <p class="text-[9px] md:text-[10px] text-slate-500">Admin Fee Rp
                                                        2.500</p>
                                                </div>
                                            </div>
                                            <div
                                                class="h-5 w-5 rounded-full border-2 border-slate-200 peer-checked:border-ksc-blue flex items-center justify-center p-1">
                                                <div
                                                    class="h-full w-full bg-ksc-blue rounded-full opacity-0 peer-checked:opacity-100">
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div id="instructionSection"
                                class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 text-left">
                                <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <i data-lucide="alert-circle" class="w-5 h-5 text-ksc-accent"></i>
                                    Instruksi Penting
                                </h3>
                                <ul class="text-xs text-slate-500 space-y-2 list-disc pl-5" id="instructionList">
                                    <li>Pastikan nominal transfer sesuai sampai 3 digit terakhir.</li>
                                    <li>E-Ticket akan dikirim ke email segera setelah pembayaran diverifikasi.</li>
                                    <li>Pembayaran harus diselesaikan dalam waktu 1x24 jam.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Summary Sidebar -->
                        <div class="space-y-6 text-left">
                            <div
                                class="bg-white rounded-[2rem] md:rounded-[2.5rem] border border-slate-100 shadow-sm p-6 md:p-8 sticky top-28">
                                <h3
                                    class="text-[10px] md:text-sm font-bold text-slate-900 mb-6 uppercase tracking-widest text-left">
                                    Ringkasan Pesanan</h3>

                                <div class="space-y-4 mb-8">
                                    <div class="flex justify-between items-start">
                                        <div class="text-left">
                                            <p class="text-xs font-bold text-slate-900 leading-tight">Annual
                                                Championship 2026</p>
                                            <p class="text-[10px] text-slate-500 mt-0.5" id="sidebarCategory">Sprint 50m
                                                Gaya Bebas</p>
                                        </div>
                                        <span class="text-xs font-bold text-slate-900" id="basePrice">Rp 350.000</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                                        <p class="text-xs text-slate-500">Subtotal</p>
                                        <p class="text-xs font-bold text-slate-900 text-left" id="subtotalPrice">Rp
                                            350.000</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-slate-500">Biaya Layanan</p>
                                        <p class="text-xs font-bold text-green-600 text-left uppercase">Gratis</p>
                                    </div>
                                    <div
                                        class="flex justify-between items-center pt-4 border-t-2 border-dashed border-slate-100 text-left">
                                        <p class="text-sm font-bold text-slate-900">Total Bayar</p>
                                        <p class="text-lg font-bold text-ksc-blue" id="finalPrice">Rp 350.000</p>
                                    </div>
                                </div>

                                <button id="submitPayment"
                                    class="w-full py-4 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95 group flex items-center justify-center gap-2">
                                    <span class="text-sm">Bayar Sekarang</span>
                                    <i data-lucide="chevron-right"
                                        class="w-4 h-4 group-hover:translate-x-1 transition"></i>
                                </button>

                                <p class="text-[9px] text-slate-400 text-center mt-4 italic">
                                    Setujui syarat & ketentuan kompetisi KSC.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebarBackdrop"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[50] hidden lg:hidden transition-all duration-300 opacity-0">
    </div>

    <script>
        lucide.createIcons();

        // Responsive Sidebar Toggle Logic
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function toggleSidebar() {
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
                document.body.style.overflow = '';
            } else {
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
                sidebar.classList.remove('-translate-x-full');
                document.body.style.overflow = 'hidden';
            }
        }

        toggleBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });

        closeBtn?.addEventListener('click', toggleSidebar);
        backdrop?.addEventListener('click', toggleSidebar);

        // Sidebar Navigation Handling
        const navLinks = sidebar.querySelectorAll('nav a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Resize Handling
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.add('hidden');
                backdrop.classList.add('opacity-0');
                document.body.style.overflow = '';
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Notif Dropdown Logic
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');

        notifBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            notifDropdown?.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (notifDropdown && !notifDropdown.contains(e.target) && e.target !== notifBtn) {
                notifDropdown.classList.add('hidden');
            }
        });
        // Dynamic Logic for Paid vs Free
        const urlParams = new URLSearchParams(window.location.search);
        const isFree = urlParams.get('type') === 'free';

        if (isFree) {
            document.getElementById('pageTitle').innerText = 'Konfirmasi Pendaftaran';
            document.getElementById('pageSub').innerText = 'Event ini gratis. Silakan konfirmasi biodata Anda.';
            document.getElementById('paymentMethodsSection').classList.add('hidden');
            document.getElementById('instructionSection').classList.add('hidden');

            // Update Summary
            document.getElementById('basePrice').innerText = 'Rp 0';
            document.getElementById('subtotalPrice').innerText = 'Rp 0';
            document.getElementById('finalPrice').innerText = 'GRATIS';
            document.getElementById('finalPrice').classList.add('text-green-600');

            // Update Button
            const submitBtn = document.getElementById('submitPayment');
            submitBtn.querySelector('span').innerText = 'Konfirmasi Pendaftaran';
            submitBtn.classList.remove('bg-ksc-blue');
            submitBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'shadow-green-600/20');
        }
    </script>
</body>

</html>