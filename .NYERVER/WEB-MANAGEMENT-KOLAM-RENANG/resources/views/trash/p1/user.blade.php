<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - KSC Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        ksc: {
                            blue: '#1e40af', 
                            dark: '#1e3a8a',
                            accent: '#f59e0b',
                            light: '#eff6ff', 
                        }
                    }
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
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-[60] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300">
            <div class="h-full flex flex-col p-6 text-left">
                <!-- Logo & Close (Mobile) -->
                <div class="flex items-center justify-between mb-10 px-2 text-left">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-ksc-blue rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">K</div>
                        <span class="text-2xl font-bold text-slate-900 tracking-wide">KSC<span class="text-ksc-accent">.</span></span>
                    </div>
                    <button id="closeSidebar" class="lg:hidden p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Navikasi -->
                <nav class="flex-1 space-y-2">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>
                    
                    <a href="dashboard.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="user.html" class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="user-cog" class="w-5 h-5"></i>
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

                    <a href="laporan.html" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="file-bar-chart" class="w-5 h-5 group-hover:scale-110 transition"></i>
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

                <!-- Logout -->
                <div class="pt-6 border-t border-slate-100">
                    <a href="../page/register.html" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition group">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition"></i>
                        <span class="font-bold text-sm">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            <!-- Top Header -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Manajemen User</h1>
                    
                    </div>
                </div>

                <button id="addAccountBtn" class="bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl font-bold text-[10px] md:text-sm transition flex items-center gap-2 shadow-lg shadow-ksc-blue/20 whitespace-nowrap">
                    <i data-lucide="user-plus" class="w-3.5 h-3.5 md:w-4 md:h-4"></i> <span class="hidden xs:inline">Tambah</span> <span class="hidden md:inline">Akun</span>
                </button>
            </header>

            <!-- Modal Tambah Akun -->
            <div id="addAccountModal" class="fixed inset-0 z-[60] hidden">
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
                
                <!-- Modal Content -->
                <div class="flex min-h-full items-center justify-center p-4">
                    <div class="relative w-full max-w-2xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                        <!-- Header -->
                        <div class="bg-ksc-blue p-8 text-white relative">
                            <button id="closeModalBtn" class="absolute top-6 right-6 p-2 hover:bg-white/10 rounded-full transition">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                            <h2 class="text-2xl font-bold mb-1">Tambah Akun Baru</h2>
                            <p class="text-blue-100 text-sm">Lengkapi data di bawah untuk mendaftarkan user baru</p>
                        </div>

                        <!-- Form -->
                        <div class="p-6 md:p-8 max-h-[70vh] overflow-y-auto text-left">
                            <form class="space-y-6" action="{{ url('/user/create/process') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Nama Lengkap</label>
                                        <input name="nama_lengkap" type="text" placeholder="Budi Santoso" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Nomor Telepon</label>
                                        <input name="no_telepon" type="tel" placeholder="0812xxxx" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Alamat Email</label>
                                    <input name="email" type="email" placeholder="email@contoh.com" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Tanggal Lahir</label>
                                        <input name="tanggal_lahir" type="date" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Role Akun</label>
                                        <select class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                            <option value="member">Member</option>
                                            <option value="pelatih">Pelatih</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Kata Sandi</label>
                                        <input name="password" type="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Konfirmasi Sandi</label>
                                        <input name="password_confirm" type="password" placeholder="••••••••" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                                    <button type="button" id="cancelModalBtn" class="flex-1 py-3.5 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition">Batal</button>
                                    <button type="submit" class="flex-[2] py-3.5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95">Simpan Akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <!-- Filter & Search -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                    <div class="relative flex-1">
                        <input type="text" id="searchInput" placeholder="Cari nama, email, atau username..." class="w-full bg-slate-50 border-none rounded-xl px-4 py-2.5 pl-10 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition">
                        <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    </div>
                    <select id="sortSelect" class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-sm outline-none cursor-pointer">
                        <option value="Terbaru">Terbaru</option>
                        <option value="Nama A-Z">Nama A-Z</option>
                        <option value="Status">Status</option>
                    </select>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden md:block bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden text-left">
                    <table class="w-full">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase">
                            <tr>
                                <th class="px-8 py-5">Identitas User</th>
                                <th class="px-8 py-5">Username</th>
                                <th class="px-8 py-5">Role Sistem</th>
                                <th class="px-8 py-5">Status Akun</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody" class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random" class="h-10 w-10 rounded-xl">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Fikri Haikal</p>
                                            <p class="text-[10px] text-slate-500">fikri.haikal@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-600">fikri_ksc26</td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 text-ksc-blue text-[10px] font-bold border border-blue-100 uppercase">Member</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> AKTIF
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-blue-50 rounded-lg transition"><i data-lucide="user-check" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><i data-lucide="user-x" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition"><i data-lucide="more-vertical" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <img src="https://ui-avatars.com/api/?name=Rina+Sari&background=random" class="h-10 w-10 rounded-xl">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Rina Sari</p>
                                            <p class="text-[10px] text-slate-500">rina.sari@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-600">rina_sport</td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-orange-50 text-ksc-accent text-[10px] font-bold border border-orange-100 uppercase">Pelatih</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> AKTIF
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                     <div class="flex items-center justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-blue-50 rounded-lg transition"><i data-lucide="user-check" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><i data-lucide="user-x" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition"><i data-lucide="more-vertical" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <img src="https://ui-avatars.com/api/?name=Dodi+Hermawan&background=random" class="h-10 w-10 rounded-xl">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Dodi Hermawan</p>
                                            <p class="text-[10px] text-slate-500">dodi.h@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-600">dodi_ksc</td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 text-ksc-blue text-[10px) font-bold border border-blue-100 uppercase">Member</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> NON-AKTIF
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                     <div class="flex items-center justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-blue-50 rounded-lg transition"><i data-lucide="user-check" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><i data-lucide="user-x" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition"><i data-lucide="more-vertical" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div id="userCardContainer" class="grid grid-cols-1 gap-4 md:hidden">
                    <!-- Cards will be rendered here -->
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

        // Modal Logic
        const addAccountBtn = document.getElementById('addAccountBtn');
        const addAccountModal = document.getElementById('addAccountModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        const toggleModal = () => addAccountModal.classList.toggle('hidden');

        addAccountBtn.addEventListener('click', toggleModal);
        closeModalBtn.addEventListener('click', toggleModal);
        cancelModalBtn.addEventListener('click', toggleModal);

        // Close on backdrop click
        addAccountModal.addEventListener('click', (e) => {
            if (e.target === addAccountModal.children[0]) toggleModal();
        });

        // Search & Sort Logic
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const userTableBody = document.getElementById('userTableBody');
        const userCardContainer = document.getElementById('userCardContainer');

        function updateTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const sortValue = sortSelect.value;
            const rows = Array.from(userTableBody.querySelectorAll('tr:not(.no-data)'));
            
            // 1. Sort
            if (sortValue === 'Nama A-Z') {
                rows.sort((a, b) => {
                    const nameA = a.querySelector('p.text-sm.font-bold')?.innerText.toLowerCase() || '';
                    const nameB = b.querySelector('p.text-sm.font-bold')?.innerText.toLowerCase() || '';
                    return nameA.localeCompare(nameB);
                });
            } else if (sortValue === 'Status') {
                rows.sort((a, b) => {
                    const statusA = a.cells[3]?.innerText.trim().toLowerCase() || '';
                    const statusB = b.cells[3]?.innerText.trim().toLowerCase() || '';
                    return statusA.localeCompare(statusB);
                });
            }
            rows.forEach(row => userTableBody.appendChild(row));

            // 2. Clear mobile container
            userCardContainer.innerHTML = '';
            let visibleCount = 0;

            // 3. Filter & Render Mobile
            rows.forEach(row => {
                const name = row.querySelector('p.text-sm.font-bold')?.textContent || '';
                const email = row.querySelector('p.text-[10px].text-slate-500')?.textContent || '';
                const avatar = row.querySelector('img')?.src || '';
                const username = row.cells[1]?.textContent || '';
                const roleHtml = row.cells[2]?.innerHTML || '';
                const statusHtml = row.cells[3]?.innerHTML || '';
                const actionsHtml = row.cells[4]?.innerHTML || '';
                
                const matchesSearch = name.toLowerCase().includes(searchTerm) || 
                                    email.toLowerCase().includes(searchTerm) || 
                                    username.toLowerCase().includes(searchTerm);

                if (matchesSearch) {
                    row.style.display = '';
                    visibleCount++;

                    // Create mobile card
                    const card = document.createElement('div');
                    card.className = 'bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4';
                    card.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="${avatar}" class="h-10 w-10 rounded-xl">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">${name}</p>
                                    <p class="text-[10px] text-slate-500">${username}</p>
                                </div>
                            </div>
                            <div class="flex gap-1">${actionsHtml}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-50">
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Role</p>
                                ${roleHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status</p>
                                ${statusHtml}
                            </div>
                            <div class="col-span-2">
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
                                <p class="text-[10px] text-slate-600 font-medium">${email}</p>
                            </div>
                        </div>
                    `;
                    userCardContainer.appendChild(card);
                } else {
                    row.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                userCardContainer.innerHTML = `<div class="col-span-full py-10 text-center text-slate-500 text-sm italic">User tidak ditemukan</div>`;
                if (!userTableBody.querySelector('.no-data')) {
                    const tr = document.createElement('tr');
                    tr.className = 'no-data';
                    tr.innerHTML = `<td colspan="5" class="px-8 py-10 text-center text-slate-500 text-sm italic">User tidak ditemukan</td>`;
                    userTableBody.appendChild(tr);
                }
            } else {
                const noData = userTableBody.querySelector('.no-data');
                if (noData) noData.remove();
            }

            lucide.createIcons();
        }

        searchInput.addEventListener('input', updateTable);
        sortSelect.addEventListener('change', updateTable);

        // Initialize
        updateTable();
    </script>
</body>
</html>
