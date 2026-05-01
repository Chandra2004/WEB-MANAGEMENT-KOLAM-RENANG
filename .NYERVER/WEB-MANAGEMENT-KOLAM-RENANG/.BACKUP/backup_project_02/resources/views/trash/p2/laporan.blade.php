<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik - KSC Coach</title>

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

                <nav class="flex-1 space-y-2 text-left">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Coach Portal</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard"
                            class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="peserta.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Daftar Peserta</span>
                    </a>
                    <a href="lomba.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Manajemen Lomba</span>
                    </a>
                    <a href="laporan.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="file-text" class="w-5 h-5 transition text-left"></i>
                        <span>Laporan</span>
                    </a>
                    <a href="pesan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Kotak Masuk</span>
                    </a>

                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 text-left">
                        Settings</p>
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

                <div class="pt-6 border-t border-slate-100 text-left">
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
                <div class="flex items-center gap-4 text-left text-left">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg text-left">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="text-left">
                        <h1 class="text-xl font-bold text-slate-900 leading-tight text-left">Laporan Pelatih</h1>

                    </div>
                </div>

                <div class="flex items-center gap-4 text-left">
                    <div class="h-10 w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200 text-left">
                        <img src="https://ui-avatars.com/api/?name=Coach+Andre&background=1e40af&color=fff" alt="User">
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 text-left">
                <div class="max-w-7xl mx-auto space-y-8 text-left">

                    <!-- Stats Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-left">
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 text-left">
                                Rata-rata Kehadiran Atlet</h4>
                            <div class="flex items-baseline gap-2 text-left text-left">
                                <span class="text-3xl font-bold text-slate-900 text-left">92%</span>
                                <span class="text-[10px] font-bold text-green-500 text-left">↑ 4% bln lalu</span>
                            </div>
                            <div class="mt-4 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden text-left">
                                <div class="h-full bg-ksc-blue rounded-full text-left" style="width: 92%"></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-left">
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 text-left">
                                Sertifikat Diperoleh (Atlet Andre)</h4>
                            <div class="flex items-baseline gap-2 text-left">
                                <span class="text-3xl font-bold text-slate-900">18</span>
                                <span class="text-xs text-slate-400">Tahun ini</span>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-left">
                            <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 text-left">
                                Sesi Bimbingan Privat</h4>
                            <div class="flex items-baseline gap-2 text-left text-left">
                                <span class="text-3xl font-bold text-slate-900 text-left text-left">42</span>
                                <span class="text-xs text-slate-400">Total Sesi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Table -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden text-left">
                        <div
                            class="p-8 border-b border-slate-50 flex justify-between items-center text-left text-left text-left">
                            <h3 class="font-bold text-slate-900 text-left text-left">Rekapan Evaluasi Tiap Atlet</h3>
                            <button class="text-xs font-bold text-ksc-blue flex items-center gap-2">
                                <i data-lucide="filter" class="w-3.5 h-3.5"></i> Filter Periode
                            </button>
                        </div>
                        <div class="overflow-x-auto text-left text-left text-left">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-slate-50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-left">
                                    <tr>
                                        <th class="px-8 py-5">Atlet</th>
                                        <th class="px-8 py-5">Sesi Hadir</th>
                                        <th class="px-8 py-5">Lomba Diikuti</th>
                                        <th class="px-8 py-5">Progres Teknik</th>
                                        <th class="px-8 py-5 text-right">Review</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50 text-sm">
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="px-8 py-5">
                                            <p class="font-bold text-slate-900">Fikri Haikal</p>
                                        </td>
                                        <td class="px-8 py-5 text-slate-500">18 / 20 Sesi</td>
                                        <td class="px-8 py-5 text-slate-500 text-left">3 Lomba</td>
                                        <td class="px-8 py-5">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-ksc-blue text-[10px] font-bold rounded-full">Sangat
                                                Baik</span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <button onclick="openPenilaianModal('Fikri Haikal')"
                                                class="px-4 py-2 bg-ksc-blue/10 text-ksc-blue hover:bg-ksc-blue hover:text-white rounded-xl text-xs font-bold transition flex items-center gap-2 ml-auto">
                                                <i data-lucide="clipboard-check" class="w-3.5 h-3.5"></i> Penilaian
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="px-8 py-5">
                                            <p class="font-bold text-slate-900">Dinda Putri</p>
                                        </td>
                                        <td class="px-8 py-5 text-slate-500">20 / 20 Sesi</td>
                                        <td class="px-8 py-5 text-slate-500">2 Lomba</td>
                                        <td class="px-8 py-5">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full text-left">Konsisten</span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <button onclick="openPenilaianModal('Dinda Putri')"
                                                class="px-4 py-2 bg-ksc-blue/10 text-ksc-blue hover:bg-ksc-blue hover:text-white rounded-xl text-xs font-bold transition flex items-center gap-2 ml-auto">
                                                <i data-lucide="clipboard-check" class="w-3.5 h-3.5"></i> Penilaian
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

    <!-- Modal Penilaian -->
    <div id="penilaianModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="relative w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                <div class="bg-ksc-blue p-8 text-white relative">
                    <button onclick="closePenilaianModal()"
                        class="absolute top-6 right-6 p-2 hover:bg-white/10 rounded-full transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                    <h2 class="text-2xl font-bold mb-1">Form Penilaian Atlet</h2>
                    <p class="text-blue-100 text-sm">Memberikan evaluasi untuk <span id="modalAtletName"
                            class="font-bold"></span></p>
                </div>

                <div class="p-8">
                    <form class="space-y-6" action="{{ url('/laporan/create/process') }}" method="POST">
                        @csrf
                        <div>
                            <label
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Sikap
                                (Attitude)</label>
                            <select
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                <option value="A">Sangat Baik (A)</option>
                                <option value="B">Baik (B)</option>
                                <option value="C">Cukup (C)</option>
                                <option value="D">Perlu Bimbingan (D)</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Daftar
                                Hadir (Input Sesi)</label>
                            <div class="flex items-center gap-4">
                                <input name="daftar_hadir" type="number" placeholder="Sesi Hadir"
                                    class="flex-1 bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                <span class="text-slate-400 font-bold">/</span>
                                <input type="number" value="20"
                                    class="w-20 bg-slate-100 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm text-slate-500 outline-none"
                                    readonly>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Capaian
                                & Progres Teknik</label>
                            <textarea rows="4"
                                placeholder="Tuliskan detail capaian atau kendala teknik atlet selama periode ini..."
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition"></textarea>
                        </div>

                        <div class="pt-4 flex gap-4">
                            <button type="button" onclick="closePenilaianModal()"
                                class="flex-1 py-4 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition">Batal</button>
                            <button type="submit"
                                class="flex-[2] py-4 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95">Simpan
                                Penilaian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        // Modal Logic
        const modal = document.getElementById('penilaianModal');
        const modalName = document.getElementById('modalAtletName');

        function openPenilaianModal(name) {
            modalName.textContent = name;
            modal.classList.remove('hidden');
        }

        function closePenilaianModal() {
            modal.classList.add('hidden');
        }

        // Close on backdrop click
        modal?.addEventListener('click', (e) => {
            if (e.target.classList.contains('bg-slate-900/40')) closePenilaianModal();
        });
    </script>
</body>

</html>