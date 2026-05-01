<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Member - KSC Admin</title>
    
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

                <nav class="flex-1 space-y-2">
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
                    <a href="member.html" class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="user-square" class="w-5 h-5"></i>
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

                <div class="pt-6 border-t border-slate-100 text-left">
                    <a href="../page/register.html" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition group text-left">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition text-left"></i>
                        <span class="font-bold text-sm text-left">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Manajemen Member</h1>
                    </div>
                </div>
                <button id="addMemberBtn" class="bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl font-bold text-[10px] md:text-sm transition flex items-center gap-2 whitespace-nowrap">
                    <i data-lucide="user-plus" class="w-3.5 h-3.5 md:w-4 md:h-4"></i> <span class="hidden xs:inline">Tambah</span> <span class="hidden md:inline">Member</span>
                </button>
            </header>

            <!-- Modal Tambah Member -->
            <div id="addMemberModal" class="fixed inset-0 z-[60] hidden">
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
                            <h2 class="text-2xl font-bold mb-1">Tambah Member Baru</h2>
                            <p class="text-blue-100 text-sm">Masukan data atlet untuk pendaftaran keanggotaan</p>
                        </div>

                        <!-- Form -->
                        <div class="p-6 md:p-8 max-h-[70vh] overflow-y-auto text-left">
                            <form class="space-y-6" action="{{ url('/member/create/process') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Nama Lengkap Atlet</label>
                                        <input name="nama_lengkap" type="text" placeholder="Nama Atlet..." class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">ID Member (Otomatis)</label>
                                        <input name="id_member" type="text" value="KSC-2026-0083" disabled class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-5 py-3.5 text-sm text-slate-400 outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Program Latihan</label>
                                        <select class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                            <option value="prestasi">Prestasi</option>
                                            <option value="pemula">Pemula</option>
                                            <option value="hobi">Hobi / Umum</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Status Keanggotaan</label>
                                        <select class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                            <option value="aktif">Aktif</option>
                                            <option value="non-aktif">Non-Aktif</option>
                                            <option value="alumni">Alumni</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Status Tagihan</label>
                                        <select class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                            <option value="lunas">Lunas</option>
                                            <option value="tertunda">Tertunda</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Tanggal Bergabung</label>
                                        <input name="tanggal_bergabung" type="date" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                                    <button type="button" id="cancelModalBtn" class="flex-1 py-3.5 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition">Batal</button>
                                    <button type="submit" class="flex-[2] py-3.5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95">Simpan Member</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6 flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
                    <div class="relative flex-1">
                        <input type="text" id="searchInput" placeholder="Cari nama atau ID..." class="w-full bg-slate-50 border-none rounded-xl px-4 py-2.5 pl-10 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition">
                        <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    </div>
                    <select id="filterStatus" class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-sm outline-none cursor-pointer">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Non-Aktif</option>
                        <option>Alumni</option>
                    </select>
                </div>

                <!-- Desktop Table View -->
                <div class="hidden md:block bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden text-left">
                    <table class="w-full">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase">
                            <tr>
                                <th class="px-8 py-5">Atlet</th>
                                <th class="px-8 py-5">ID Member</th>
                                <th class="px-8 py-5">Program</th>
                                <th class="px-8 py-5">Status</th>
                                <th class="px-8 py-5">Tagihan</th>
                                <th class="px-8 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="memberTableBody" class="divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50/80 transition group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Rizky+Maulana" class="h-10 w-10 rounded-xl">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Rizky Maulana</p>
                                            <p class="text-[10px] text-slate-500">rizky@email.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium">KSC-2026-0082</td>
                                <td class="px-8 py-5"><span class="px-3 py-1 bg-blue-100 text-ksc-blue text-[10px] font-bold rounded-full">PRESTASI</span></td>
                                <td class="px-8 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> AKTIF
                                    </span>
                                </td>
                                <td class="px-8 py-5"><span class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold rounded-full">LUNAS</span></td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-end gap-2">
                                        <button onclick="openProfileModal('Rizky Maulana', 'KSC-2026-0082', 'PRESTASI', 'AKTIF', 'rizky@email.com')" class="p-2 text-slate-400 hover:text-ksc-blue transition"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-red-500 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div id="memberCardContainer" class="grid grid-cols-1 gap-4 md:hidden">
                    <!-- Cards will be rendered here by script -->
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Profil Member -->
    <div id="profileModal" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                <!-- Cover & Avatar -->
                <div class="h-32 bg-ksc-blue relative">
                    <button onclick="closeProfileModal()" class="absolute top-4 right-4 p-2 bg-black/20 hover:bg-black/40 text-white rounded-full transition z-10">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                    <div class="absolute -bottom-10 left-8">
                        <img id="pAvatar" src="https://ui-avatars.com/api/?name=User" class="h-24 w-24 rounded-3xl border-4 border-white shadow-lg bg-white">
                    </div>
                </div>

                <div class="pt-14 p-8">
                    <div class="mb-6">
                        <h2 id="pName" class="text-2xl font-bold text-slate-900">Nama Member</h2>
                        <p id="pID" class="text-sm font-medium text-slate-400">ID Member</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Program</p>
                            <p id="pProgram" class="text-sm font-bold text-ksc-blue uppercase">PRESTASI</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</p>
                            <span id="pStatus" class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase">AKTIF</span>
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
                        <button onclick="closeProfileModal()" class="w-full py-4 bg-slate-50 text-slate-400 font-bold rounded-2xl hover:bg-slate-100 transition">Tutup Detail</button>
                    </div>
                </div>
            </div>
        </div>
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
                // Close
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
                document.body.style.overflow = ''; // Enable scroll
            } else {
                // Open
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
                sidebar.classList.remove('-translate-x-full');
                document.body.style.overflow = 'hidden'; // Disable scroll
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
            if(status === 'AKTIF') {
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

        // Modal Logic (Add Member)
        const addMemberBtn = document.getElementById('addMemberBtn');
        const addMemberModal = document.getElementById('addMemberModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        const toggleModal = () => addMemberModal.classList.toggle('hidden');

        addMemberBtn?.addEventListener('click', toggleModal);
        closeModalBtn?.addEventListener('click', toggleModal);
        cancelModalBtn?.addEventListener('click', toggleModal);

        // Close on backdrop click
        addMemberModal?.addEventListener('click', (e) => {
            if (e.target === addMemberModal.querySelector('.absolute.inset-0')) toggleModal();
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
                const program = row.cells[2]?.textContent || '';
                const statusHtml = row.cells[3]?.innerHTML || '';
                const statusText = row.cells[3]?.textContent.trim().toLowerCase() || '';
                const tagihanHtml = row.cells[4]?.innerHTML || '';
                const actionsHtml = row.cells[5]?.innerHTML || '';
                
                const matchesSearch = name.toLowerCase().includes(searchTerm) || id.toLowerCase().includes(searchTerm);
                const matchesStatus = statusTerm === 'semua status' || statusText.includes(statusTerm);

                if (matchesSearch && matchesStatus) {
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
                                    <p class="text-[10px] text-slate-500">${id}</p>
                                </div>
                            </div>
                            <div class="flex gap-1">${actionsHtml}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-50">
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Program</p>
                                ${program}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status</p>
                                ${statusHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tagihan</p>
                                ${tagihanHtml}
                            </div>
                            <div>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kontak</p>
                                <p class="text-[10px] text-slate-600 font-medium truncate">${email}</p>
                            </div>
                        </div>
                    `;
                    memberCardContainer.appendChild(card);
                } else {
                    row.style.display = 'none';
                }
            });

            // Handle No Data Message
            if (visibleCount === 0) {
                const noData = `<div class="col-span-full py-10 text-center text-slate-500 text-sm italic">Member tidak ditemukan</div>`;
                memberCardContainer.innerHTML = noData;
                
                // For table
                if (!memberTableBody.querySelector('.no-data')) {
                    const tr = document.createElement('tr');
                    tr.className = 'no-data';
                    tr.innerHTML = `<td colspan="6" class="px-8 py-10 text-center text-slate-500 text-sm italic">Member tidak ditemukan</td>`;
                    memberTableBody.appendChild(tr);
                }
            } else {
                const noDataRow = memberTableBody.querySelector('.no-data');
                if (noDataRow) noDataRow.remove();
            }

            // Sync icons
            lucide.createIcons();
        }

        // Initialize table
        updateTable();

        searchInput.addEventListener('input', updateTable);
        filterStatus.addEventListener('change', updateTable);
    </script>
</body>
</html>
