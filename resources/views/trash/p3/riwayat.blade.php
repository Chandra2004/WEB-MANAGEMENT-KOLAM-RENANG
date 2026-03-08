<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - KSC Member</title>

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

    <div class="flex min-h-screen">
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

                <nav class="flex-1 space-y-2">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Member Area</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="lomba.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Pendaftaran Lomba</span>
                    </a>
                    <a href="riwayat.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="history" class="w-5 h-5"></i>
                        <span>Riwayat Transaksi</span>
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
        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            <header
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4 text-left">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Riwayat Transaksi</h1>

                    </div>
                </div>

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
                                    <p class="text-xs font-bold text-slate-900 leading-tight">Jadwal Latihan Tambahan
                                    </p>
                                    <p class="text-[10px] text-slate-500 mt-1 line-clamp-1">Ada sesi tambahan di hari
                                        sabtu...</p>
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
                                    <span class="text-[9px] text-slate-400 mt-1 block italic underline">Kemarin</span>
                                </div>
                            </div>
                        </div>
                        <a href="pesan.html"
                            class="block p-4 text-center text-[11px] font-bold text-ksc-blue hover:bg-slate-50 transition">
                            Lihat Seluruh Kotak Masuk
                        </a>
                    </div>
                </div>
                <div class="h-9 w-9 md:h-10 md:w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200">
                    <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random" alt="User">
                </div>
    </div>
    </header>

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-8 pb-32">
        <div class="max-w-5xl mx-auto flex flex-col gap-6">

            <!-- Search & Filter Area -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-1">
                        <input type="text" placeholder="Cari transaksi..."
                            class="w-full bg-slate-50 border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-slate-700 placeholder:text-slate-400">
                        <i data-lucide="search"
                            class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    </div>
                    <div class="relative md:w-48">
                        <select
                            class="w-full bg-slate-50 border-none rounded-xl pl-4 pr-10 py-3 text-sm outline-none cursor-pointer font-medium text-slate-600 appearance-none focus:ring-2 focus:ring-ksc-blue transition">
                            <option>Semua Status</option>
                            <option>Berhasil</option>
                            <option>Menunggu</option>
                            <option>Gagal</option>
                        </select>
                        <i data-lucide="chevron-down"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <!-- Desktop Transaction Table -->
            <div
                class="hidden lg:block bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden text-left">
                <table class="w-full text-left">
                    <thead
                        class="bg-slate-50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-normal">
                        <tr>
                            <th class="px-8 py-5">Tanggal</th>
                            <th class="px-8 py-5">Event / Iuran</th>
                            <th class="px-8 py-5 text-right">Nominal</th>
                            <th class="px-8 py-5 text-center">Metode</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5 text-slate-500 font-medium">07 Feb 2026</td>
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-900">Annual Championship 2026</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Pendaftaran
                                    Lomba</p>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-900 italic">Rp 350.000</td>
                            <td class="px-8 py-5 text-center"><span
                                    class="px-2 py-1 bg-blue-50 text-ksc-blue text-[10px] font-bold rounded">BCA</span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-extrabold rounded-full border border-green-100 uppercase">
                                    Berhasil
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-400"><i
                                        data-lucide="download" class="w-4 h-4"></i></button>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5 text-slate-500 font-medium">05 Feb 2026</td>
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-900">Iuran Bulanan - Feb 2026</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Membership
                                    Club</p>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-900 italic">Rp 200.000</td>
                            <td class="px-8 py-5 text-center"><span
                                    class="px-2 py-1 bg-orange-50 text-ksc-accent text-[10px] font-bold rounded">QRIS</span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-extrabold rounded-full border border-green-100 uppercase">
                                    Berhasil
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-400"><i
                                        data-lucide="download" class="w-4 h-4"></i></button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5 text-slate-500 font-medium">04 Feb 2026</td>
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-900">Internal Friendly Match</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Pendaftaran
                                    Lomba</p>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-green-600 italic">GRATIS</td>
                            <td class="px-8 py-5 text-center text-slate-300">-</td>
                            <td class="px-8 py-5 text-center">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-ksc-blue text-[10px] font-extrabold rounded-full border border-blue-100 uppercase">
                                    Confirmed
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-400"><i data-lucide="eye"
                                        class="w-4 h-4"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Transaction Cards -->
            <div class="grid grid-cols-1 gap-4 lg:hidden">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="text-left">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Pendaftaran
                                Lomba</p>
                            <p class="text-sm font-bold text-slate-900 leading-tight">Annual Championship 2026</p>
                            <p class="text-[10px] text-slate-500 mt-1 italic">07 Feb 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 bg-green-50 text-green-600 text-[9px] font-extrabold rounded-md border border-green-100 uppercase">Berhasil</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Nominal</p>
                            <p class="text-sm font-bold text-ksc-blue underline italic">Rp 350.000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Metode</p>
                            <span
                                class="px-2 py-1 bg-blue-50 text-ksc-blue text-[9px] font-bold rounded uppercase">BCA</span>
                        </div>
                    </div>
                    <button
                        class="w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl text-[10px] font-bold flex items-center justify-center gap-2 transition">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Download E-Ticket
                    </button>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="text-left">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Membership
                                Club</p>
                            <p class="text-sm font-bold text-slate-900 leading-tight">Iuran Bulanan - Feb 2026</p>
                            <p class="text-[10px] text-slate-500 mt-1 italic">05 Feb 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 bg-green-50 text-green-600 text-[9px] font-extrabold rounded-md border border-green-100 uppercase">Berhasil</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Nominal</p>
                            <p class="text-sm font-bold text-ksc-blue underline italic">Rp 200.000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Metode</p>
                            <span
                                class="px-2 py-1 bg-orange-50 text-ksc-accent text-[9px] font-bold rounded uppercase">QRIS</span>
                        </div>
                    </div>
                    <button
                        class="w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl text-[10px] font-bold flex items-center justify-center gap-2 transition">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Download E-Ticket
                    </button>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="text-left">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Pendaftaran
                                Lomba</p>
                            <p class="text-sm font-bold text-slate-900 leading-tight">Internal Friendly Match</p>
                            <p class="text-[10px] text-slate-500 mt-1 italic">04 Feb 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 bg-blue-50 text-ksc-blue text-[9px] font-extrabold rounded-md border border-blue-100 uppercase">Confirmed</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Nominal</p>
                            <p class="text-sm font-bold text-green-600 underline italic">GRATIS</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter mb-1">Metode</p>
                            <span class="text-xs font-bold text-slate-300">-</span>
                        </div>
                    </div>
                    <button
                        class="w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-xl text-[10px] font-bold flex items-center justify-center gap-2 transition">
                        <i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat Detail
                    </button>
                </div>
            </div>

            <p class="text-[10px] text-slate-400 text-center italic mt-10">
                Menampilkan 10 transaksi terakhir. Untuk riwayat lebih lama, silakan hubungi admin KSC.
            </p>
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
    </script>
</body>

</html>