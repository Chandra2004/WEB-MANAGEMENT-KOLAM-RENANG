<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - KSC Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-[60] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300">
            <div class="h-full flex flex-col p-6 text-left">
                <!-- Logo & Close (Mobile) -->
                <div class="flex items-center justify-between mb-10 px-2 text-left">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-ksc-blue rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">K</div>
                        <span class="text-2xl font-bold text-slate-900 tracking-wide underline decoration-ksc-accent decoration-4 underline-offset-4">KSC<span class="text-ksc-accent">.</span></span>
                    </div>
                    <button id="closeSidebar" class="lg:hidden p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <nav class="flex-1 space-y-2 text-left">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>
                    <a href="dashboard.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="user.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-cog" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen User</span>
                    </a>
                    <a href="pelatih.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Pelatih</span>
                    </a>
                    <a href="member.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-square" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Member</span>
                    </a>
                    <a href="role.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="shield-check" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Role</span>
                    </a>
                    <a href="lomba.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Lomba</span>
                    </a>
                    <a href="laporan.html" class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="file-bar-chart" class="w-5 h-5"></i>
                        <span>Laporan Laba/Rugi</span>
                    </a>
                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">User Settings</p>
                    <a href="profile.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-circle" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="pengaturan.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="settings" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Pengaturan Site</span>
                    </a>
                </nav>
                <div class="pt-6 border-t border-slate-100">
                    <a href="../page/register.html" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition group">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition"></i>
                        <span class="font-bold text-sm text-left">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
                <div class="px-4 md:px-8 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                        <div>
                            <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Laporan Laba/Rugi</h1>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <select class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-bold outline-none cursor-pointer focus:ring-2 focus:ring-ksc-blue transition">
                            <option>Februari 2026</option>
                            <option>Januari 2026</option>
                        </select>
                        <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition flex items-center justify-center gap-2 shadow-sm active:scale-95">
                            <i data-lucide="download" class="w-4 h-4"></i> Export PDF
                        </button>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-left">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Total Pendapatan</p>
                        <h3 class="text-2xl font-bold text-slate-900 mb-1">Rp 142.500.000</h3>
                        <p class="text-xs text-green-500 font-medium">↑ 8.4% Dari bulan lalu</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-left">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Total Pengeluaran</p>
                        <h3 class="text-2xl font-bold text-slate-900 mb-1">Rp 64.200.000</h3>
                        <p class="text-xs text-slate-400 font-medium">Operasional & Gaji</p>
                    </div>
                    <div class="bg-ksc-blue p-6 rounded-3xl shadow-lg shadow-ksc-blue/20 text-left">
                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest mb-4">Laba Bersih</p>
                        <h3 class="text-2xl font-bold text-white mb-1">Rp 78.300.000</h3>
                        <p class="text-xs text-ksc-accent font-medium">Margin Keuntungan 55%</p>
                    </div>
                </div>

                <!-- Table Breakdown -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden text-left">
                    <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Rincian Transaksi Terakhir</h3>
                    </div>
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase">
                            <tr>
                                <th class="px-8 py-4">Kategori</th>
                                <th class="px-8 py-4">Deskripsi</th>
                                <th class="px-8 py-4">Metode</th>
                                <th class="px-8 py-4">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr>
                                <td class="px-8 py-4"><span class="px-2 py-0.5 bg-blue-50 text-ksc-blue text-[10px] font-bold rounded">INCOME</span></td>
                                <td class="px-8 py-4 text-sm font-medium">Biaya Pendaftaran Member Baru</td>
                                <td class="px-8 py-4 text-xs text-slate-500">Transfer Bank</td>
                                <td class="px-8 py-4 text-sm font-bold text-slate-900">+ Rp 1.500.000</td>
                            </tr>
                            <tr>
                                <td class="px-8 py-4"><span class="px-2 py-0.5 bg-red-50 text-red-500 text-[10px] font-bold rounded">EXPENSE</span></td>
                                <td class="px-8 py-4 text-sm font-medium">Perawatan Kolam & Ph Control</td>
                                <td class="px-8 py-4 text-xs text-slate-500">Tunai / Petty Cash</td>
                                <td class="px-8 py-4 text-sm font-bold text-red-500">- Rp 850.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[50] hidden lg:hidden transition-all duration-300 opacity-0"></div>

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
    </script>
</body>
</html>
