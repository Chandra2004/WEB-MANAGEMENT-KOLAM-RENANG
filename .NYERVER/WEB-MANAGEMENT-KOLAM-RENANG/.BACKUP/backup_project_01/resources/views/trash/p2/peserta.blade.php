<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peserta - KSC Coach</title>

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
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="peserta.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="users" class="w-5 h-5 transition text-left"></i>
                        <span>Daftar Peserta</span>
                    </a>
                    <a href="lomba.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Manajemen Lomba</span>
                    </a>
                    <a href="laporan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="file-text" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Laporan</span>
                    </a>
                    <a href="pesan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Kotak Masuk</span>
                    </a>

                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Settings
                    </p>
                    <a href="profile.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
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
                        <span class="font-bold text-sm text-left font-bold text-sm">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden text-left">
            <header
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4 text-left">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Manajemen Peserta</h1>

                    </div>
                </div>
                <button id="addPesertaBtn"
                    class="bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl font-bold text-[10px] md:text-sm transition flex items-center gap-2 shadow-lg shadow-ksc-blue/20 whitespace-nowrap">
                    <i data-lucide="user-plus" class="w-3.5 h-3.5 md:w-4 md:h-4"></i> <span
                        class="hidden xs:inline">Tambah</span> <span class="hidden md:inline">Peserta</span>
                </button>
            </header>

            <!-- Modal Tambah Peserta -->
            <div id="addPesertaModal" class="fixed inset-0 z-[60] hidden">
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

                <!-- Modal Content -->
                <div class="flex min-h-full items-center justify-center p-4 text-left">
                    <div
                        class="relative w-full max-w-2xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all text-left">
                        <!-- Header -->
                        <div class="bg-ksc-blue p-8 text-white relative text-left">
                            <button id="closeModalBtn"
                                class="absolute top-6 right-6 p-2 hover:bg-white/10 rounded-full transition">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                            <h2 class="text-2xl font-bold mb-1">Tambah Peserta Baru</h2>
                            <p class="text-blue-100 text-sm">Masukan data atlet binaan untuk pendaftaran keanggotaan</p>
                        </div>

                        <!-- Form -->
                        <div class="p-6 md:p-8 max-h-[70vh] overflow-y-auto text-left">
                            <form class="space-y-6 text-left" action="{{ url('/peserta/create/process') }}"
                                method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Nama
                                            Lengkap Atlet</label>
                                        <input name="nama_lengkap" type="text" placeholder="Nama Atlet..."
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition text-left">
                                    </div>
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">ID
                                            Member (Otomatis)</label>
                                        <input name="id_member" type="text" value="KSC-2026-0083" disabled
                                            class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-5 py-3.5 text-sm text-slate-400 outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Program
                                            Latihan</label>
                                        <select
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer text-left">
                                            <option value="prestasi">Prestasi</option>
                                            <option value="pemula">Pemula</option>
                                            <option value="hobi">Hobi / Umum</option>
                                        </select>
                                    </div>
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Status
                                            Keanggotaan</label>
                                        <select
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer text-left">
                                            <option value="aktif">Aktif</option>
                                            <option value="non-aktif">Non-Aktif</option>
                                            <option value="alumni">Alumni</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Status
                                            Tagihan</label>
                                        <select
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer text-left">
                                            <option value="lunas">Lunas</option>
                                            <option value="tertunda">Tertunda</option>
                                        </select>
                                    </div>
                                    <div class="text-left">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Tanggal
                                            Bergabung</label>
                                        <input name="tanggal_bergabung" type="date"
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition text-left">
                                    </div>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row gap-4 text-left">
                                    <button type="button" id="cancelModalBtn"
                                        class="flex-1 py-3.5 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition">Batal</button>
                                    <button type="submit"
                                        class="flex-[2] py-3.5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95 text-center">Simpan
                                        Data Peserta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="max-w-7xl mx-auto space-y-6">

                    <!-- Filters -->
                    <div
                        class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 flex-1">
                            <div class="relative flex-1">
                                <input type="text" id="searchInput" placeholder="Cari nama atau ID..."
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-2.5 pl-10 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition text-left">
                                <i data-lucide="search"
                                    class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            </div>
                            <select id="filterStatus"
                                class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-sm outline-none cursor-pointer">
                                <option>Semua Status</option>
                                <option>Aktif</option>
                                <option>Non-Aktif</option>
                                <option>Alumni</option>
                            </select>
                        </div>
                        <button
                            class="bg-slate-50 text-slate-600 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-100 transition flex items-center justify-center gap-2">
                            <i data-lucide="download" class="w-4 h-4"></i> Export <span
                                class="hidden md:inline">PDF</span>
                        </button>
                    </div>

                    <!-- Desktop Table -->
                    <div
                        class="hidden md:block bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden text-left">
                        <table class="w-full text-left">
                            <thead
                                class="bg-slate-50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-left">
                                <tr>
                                    <th class="px-8 py-5 text-left">Atlet</th>
                                    <th class="px-8 py-5 text-left">ID Member</th>
                                    <th class="px-8 py-5 text-left">Program</th>
                                    <th class="px-8 py-5 text-center">Status</th>
                                    <th class="px-8 py-5 text-center">Tagihan</th>
                                    <th class="px-8 py-5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="memberTableBody" class="divide-y divide-slate-50 text-sm text-left">
                                <!-- Row 1 -->
                                <tr class="hover:bg-slate-50/80 transition group text-left">
                                    <td class="px-8 py-5 text-left">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random"
                                                class="h-10 w-10 rounded-xl">
                                            <div>
                                                <p class="text-sm font-bold text-slate-900">Fikri Haikal</p>
                                                <p class="text-[10px] text-slate-500">fikri.haikal@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm font-medium">KSC-2026-0083</td>
                                    <td class="px-8 py-5"><span
                                            class="px-3 py-1 bg-blue-100 text-ksc-blue text-[10px] font-bold rounded-full">PRESTASI</span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> AKTIF
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center"><span
                                            class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold rounded-full">LUNAS</span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex gap-2 justify-end">
                                            <button
                                                onclick="openProfileModal('Fikri Haikal', 'KSC-2026-0083', 'prestasi', 'AKTIF', 'fikri.haikal@example.com')"
                                                class="p-2 text-slate-400 hover:text-ksc-blue transition"><i
                                                    data-lucide="eye" class="w-4 h-4"></i></button>
                                            <button class="p-2 text-slate-400 hover:text-red-500 transition"><i
                                                    data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="hover:bg-slate-50/80 transition group text-left">
                                    <td class="px-8 py-5 text-left">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Dinda+Putri&background=random"
                                                class="h-10 w-10 rounded-xl">
                                            <div>
                                                <p class="text-sm font-bold text-slate-900">Dinda Putri</p>
                                                <p class="text-[10px] text-slate-500">dinda@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm font-medium">KSC-2026-0105</td>
                                    <td class="px-8 py-5"><span
                                            class="px-3 py-1 bg-blue-100 text-ksc-blue text-[10px] font-bold rounded-full">PRESTASI</span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span> NON-AKTIF
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center"><span
                                            class="px-3 py-1 bg-orange-100 text-orange-600 text-[10px] font-bold rounded-full">TERTUNDA</span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex gap-2 justify-end">
                                            <button
                                                onclick="openProfileModal('Dinda Putri', 'KSC-2026-0105', 'prestasi', 'NON-AKTIF', 'dinda@example.com')"
                                                class="p-2 text-slate-400 hover:text-ksc-blue transition"><i
                                                    data-lucide="eye" class="w-4 h-4"></i></button>
                                            <button class="p-2 text-slate-400 hover:text-red-500 transition"><i
                                                    data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div id="memberCardContainer" class="grid grid-cols-1 gap-4 md:hidden">
                        <!-- Cards will be rendered here -->
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

    <!-- Modal Profil Peserta -->
    <div id="profileModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="relative w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                <!-- Cover & Avatar -->
                <div class="h-32 bg-ksc-blue relative">
                    <button onclick="closeProfileModal()"
                        class="absolute top-4 right-4 p-2 bg-black/20 hover:bg-black/40 text-white rounded-full transition z-10">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                    <div class="absolute -bottom-10 left-8">
                        <img id="pAvatar" src="https://ui-avatars.com/api/?name=User"
                            class="h-24 w-24 rounded-3xl border-4 border-white shadow-lg bg-white">
                    </div>
                </div>

                <div class="pt-14 p-8">
                    <div class="mb-6">
                        <h2 id="pName" class="text-2xl font-bold text-slate-900">Nama Atlet</h2>
                        <p id="pID" class="text-sm font-medium text-slate-400">ID Member</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Program</p>
                            <p id="pProgram" class="text-sm font-bold text-ksc-blue uppercase">PRESTASI</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</p>
                            <span id="pStatus"
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">AKTIF</span>
                        </div>
                    </div>

                    <div class="space-y-4 pt-6 border-t border-slate-50">
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span id="pEmail" class="text-sm">email@example.com</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <span class="text-sm">+62 812-3456-7890</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span class="text-sm">Bergabung: 12 Jan 2026</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button onclick="closeProfileModal()"
                            class="w-full py-4 bg-slate-50 text-slate-400 font-bold rounded-2xl hover:bg-slate-100 transition">Tutup
                            Detail</button>
                    </div>
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

        // Profile Modal Logic
        const profileModal = document.getElementById('profileModal');
        const pName = document.getElementById('pName');
        const pID = document.getElementById('pID');
        const pProgram = document.getElementById('pProgram');
        const pStatus = document.getElementById('pStatus');
        const pEmail = document.getElementById('pEmail');
        const pAvatar = document.getElementById('pAvatar');

        function openProfileModal(name, id, program, status, email) {
            pName.textContent = name;
            pID.textContent = id;
            pProgram.textContent = program;
            pEmail.textContent = email;
            pAvatar.src = `https://ui-avatars.com/api/?name=${name.replace(' ', '+')}&background=random`;

            pStatus.textContent = status;
            if (status === 'AKTIF') {
                pStatus.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-green-50 text-green-600';
            } else {
                pStatus.className = 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-orange-50 text-orange-600';
            }

            profileModal.classList.remove('hidden');
        }

        function closeProfileModal() {
            profileModal.classList.add('hidden');
        }

        // Close on backdrop click
        profileModal?.addEventListener('click', (e) => {
            if (e.target.classList.contains('bg-slate-900/40')) closeProfileModal();
        });

        // Modal Logic (Add Peserta)
        const addPesertaBtn = document.getElementById('addPesertaBtn');
        const addPesertaModal = document.getElementById('addPesertaModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        const toggleModal = () => addPesertaModal.classList.toggle('hidden');

        addPesertaBtn?.addEventListener('click', toggleModal);
        closeModalBtn?.addEventListener('click', toggleModal);
        cancelModalBtn?.addEventListener('click', toggleModal);

        // Close on backdrop click
        addPesertaModal?.addEventListener('click', (e) => {
            if (e.target === addPesertaModal.querySelector('.absolute.inset-0')) toggleModal();
        });

        // Search & Filter Logic
        const searchInput = document.getElementById('searchInput');
        const filterStatus = document.getElementById('filterStatus');
        const memberTableBody = document.getElementById('memberTableBody');
        const memberCardContainer = document.getElementById('memberCardContainer');

        function updateTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const statusTerm = filterStatus.value.toLowerCase();
            const rows = Array.from(memberTableBody.querySelectorAll('tr:not(.no-data)'));

            // Clear mobile container
            memberCardContainer.innerHTML = '';
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.querySelector('p.text-sm.font-bold')?.textContent || '';
                const email = row.querySelector('p.text-[10px].text-slate-500')?.textContent || '';
                const avatar = row.querySelector('img')?.src || '';
                const id = row.cells[1]?.textContent || '';
                const progHtml = row.cells[2]?.innerHTML || '';
                const statusHtml = row.cells[3]?.innerHTML || '';
                const payHtml = row.cells[4]?.innerHTML || '';
                const actionsHtml = row.cells[5]?.innerHTML || '';

                const matchesSearch = name.toLowerCase().includes(searchTerm) || id.toLowerCase().includes(searchTerm);
                const matchesStatus = statusTerm === 'semua status' || statusHtml.toLowerCase().includes(statusTerm);

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;

                    // Create mobile card
                    const card = document.createElement('div');
                    card.className = 'bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 text-left';
                    card.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="${avatar}" class="h-10 w-10 rounded-xl">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">${name}</p>
                                    <p class="text-[10px] text-slate-500">${id}</p>
                                </div>
                            </div>
                            <div class="flex gap-1">${actionsHtml}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-50">
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Program</p>
                                ${progHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status</p>
                                ${statusHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tagihan</p>
                                ${payHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
                                <p class="text-[10px] text-slate-600 truncate">${email}</p>
                            </div>
                        </div>
                    `;
                    memberCardContainer.appendChild(card);
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                memberCardContainer.innerHTML = `<div class="py-10 text-center text-slate-500 text-sm italic">Data tidak ditemukan</div>`;
                if (!memberTableBody.querySelector('.no-data')) {
                    const tr = document.createElement('tr');
                    tr.className = 'no-data';
                    tr.innerHTML = `<td colspan="6" class="px-8 py-10 text-center text-slate-500 text-sm italic">Data tidak ditemukan</td>`;
                    memberTableBody.appendChild(tr);
                }
            } else {
                const noData = memberTableBody.querySelector('.no-data');
                if (noData) noData.remove();
            }

            lucide.createIcons();
        }

        searchInput.addEventListener('input', updateTable);
        filterStatus.addEventListener('change', updateTable);

        // Initialize
        updateTable();
    </script>
</body>

</html>