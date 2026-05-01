<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lomba - KSC Admin</title>
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
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-[60] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300">
            <div class="h-full flex flex-col p-6 text-left">
                <!-- Logo & Close (Mobile) -->
                <div class="flex items-center justify-between mb-10 px-2 text-left">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-10 w-10 bg-ksc-blue rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            K</div>
                        <span class="text-2xl font-bold text-slate-900 tracking-wide">KSC<span
                                class="text-ksc-accent">.</span></span>
                    </div>
                    <button id="closeSidebar"
                        class="lg:hidden p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <nav class="flex-1 space-y-2 text-left">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="user.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-cog" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen User</span>
                    </a>
                    <a href="pelatih.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Pelatih</span>
                    </a>
                    <a href="member.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-square" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Member</span>
                    </a>
                    <a href="role.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="shield-check" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Manajemen Role</span>
                    </a>
                    <a href="lomba.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                        <span>Manajemen Lomba</span>
                    </a>
                    <a href="laporan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="file-bar-chart" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Laporan Laba/Rugi</span>
                    </a>
                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">User
                        Settings</p>
                    <a href="profile.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-circle" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="pengaturan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="settings" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Pengaturan Site</span>
                    </a>
                </nav>
                <div class="pt-6 border-t border-slate-100">
                    <a href="../page/register.html"
                        class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition group">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition"></i>
                        <span class="font-bold text-sm text-left">Keluar Akun</span>
                    </a>
                </div>
            </div>
        </aside>

        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            <header
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Manajemen Lomba</h1>
                    </div>
                </div>
                <button id="addEventBtn"
                    class="bg-ksc-blue hover:bg-ksc-dark text-white px-4 py-2 md:px-5 md:py-2.5 rounded-xl font-bold text-[10px] md:text-sm transition flex items-center gap-2 shadow-lg shadow-ksc-blue/20 whitespace-nowrap">
                    <i data-lucide="plus-circle" class="w-3.5 h-3.5 md:w-4 md:h-4"></i> <span
                        class="hidden xs:inline">Event</span> Baru
                </button>
            </header>

            <!-- Modal Tambah Event Lomba -->
            <div id="addEventModal" class="fixed inset-0 z-[60] hidden">
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

                <!-- Modal Content -->
                <div class="flex min-h-full items-center justify-center p-4">
                    <div
                        class="relative w-full max-w-2xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                        <!-- Header -->
                        <div class="bg-ksc-blue p-8 text-white relative">
                            <button id="closeModalBtn"
                                class="absolute top-6 right-6 p-2 hover:bg-white/10 rounded-full transition">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                            <h2 class="text-2xl font-bold mb-1">Tambah Event Lomba</h2>
                            <p class="text-blue-100 text-sm">Publikasikan kompetisi renang baru untuk para atlet</p>
                        </div>

                        <!-- Form -->
                        <div class="p-8 max-h-[70vh] overflow-y-auto">
                            <form class="space-y-6" action="{{ url('/lomba/create/process') }}" method="POST">
                                @csrf
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Nama
                                        Event</label>
                                    <input name="nama_lengkap" type="text" placeholder="Contoh: Kejuaraan Walikota Cup 2026"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                </div>

                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Deskripsi</label>
                                    <textarea rows="3" placeholder="Tuliskan detail mengenai lomba..."
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition"></textarea>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Tanggal
                                            Event</label>
                                        <input name="tanggal" type="date"
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Lokasi
                                            Event</label>
                                        <input name="lokasi" type="text" placeholder="Lokasi kolam renang..."
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Tipe
                                            Event</label>
                                        <select id="eventType"
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                            <option value="berbayar">Berbayar</option>
                                            <option value="gratis">Gratis</option>
                                        </select>
                                    </div>
                                    <div id="priceField">
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Biaya
                                            Event (Rp)</label>
                                        <input name="biaya" type="number" placeholder="50000"
                                            class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition">
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Status
                                        Event</label>
                                    <select
                                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer">
                                        <option value="berjalan">Berjalan</option>
                                        <option value="ditunda">Ditunda</option>
                                        <option value="ditutup">Ditutup</option>
                                    </select>
                                </div>

                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1">Foto
                                        Untuk Banner</label>
                                    <div
                                        class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:bg-slate-50 transition cursor-pointer">
                                        <i data-lucide="image" class="w-8 h-8 mx-auto text-slate-300 mb-2"></i>
                                        <p class="text-xs text-slate-500 font-medium">Klik untuk upload banner lomba</p>
                                    </div>
                                </div>

                                <div class="pt-4 flex gap-4">
                                    <button type="button" id="cancelModalBtn"
                                        class="flex-1 py-4 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition">Batal</button>
                                    <button type="submit"
                                        class="flex-[2] py-4 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95">Simpan
                                        Event Lomba</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-8">
                <!-- Grid Lomba -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Event 1 -->
                    <div
                        class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col md:flex-row h-auto md:h-64">
                        <div class="w-full md:w-48 bg-slate-100 relative">
                            <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?q=80&w=2070&auto=format&fit=crop"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute top-3 left-3 px-3 py-1 bg-green-500 text-white text-[10px] font-bold rounded-full">
                                OPEN</div>
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2 text-left">Annual Championship 2026
                                </h3>
                                <p class="text-sm text-slate-500 mb-4 line-clamp-2 text-left">Kejuaraan nasional tahunan
                                    yang diadakan di kolam renang utama KSC.</p>
                                <div
                                    class="flex flex-wrap gap-4 text-[10px] font-bold text-slate-400 border-t border-slate-50 pt-4">
                                    <span class="flex items-center gap-1.5"><i data-lucide="calendar"
                                            class="w-3.5 h-3.5"></i> 24-26 FEB</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="map-pin"
                                            class="w-3.5 h-3.5"></i> KSC POOL</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="users"
                                            class="w-3.5 h-3.5"></i> 245 PESERTA</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-6">
                                <button
                                    class="flex-1 py-2 bg-slate-50 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-100 transition">Detail</button>
                                <button
                                    class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-blue-50 rounded-xl transition"><i
                                        data-lucide="edit-3" class="w-4 h-4"></i></button>
                                <button
                                    class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition"><i
                                        data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Event Placeholder -->
                    <div id="addEventPlaceholder"
                        class="border-2 border-dashed border-slate-200 rounded-3xl flex flex-col items-center justify-center p-8 bg-slate-50/30 cursor-pointer hover:bg-slate-100/50 transition duration-300">
                        <div
                            class="h-12 w-12 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm mb-4">
                            <i data-lucide="plus" class="w-6 h-6 text-left"></i>
                        </div>
                        <p class="text-sm font-bold text-slate-400">Tambah Event Kompetisi Baru</p>
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

        // Modal Logic
        const addEventBtn = document.getElementById('addEventBtn');
        const addEventPlaceholder = document.getElementById('addEventPlaceholder');
        const addEventModal = document.getElementById('addEventModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        const toggleModal = () => addEventModal.classList.toggle('hidden');

        addEventBtn?.addEventListener('click', toggleModal);
        addEventPlaceholder?.addEventListener('click', toggleModal);
        closeModalBtn?.addEventListener('click', toggleModal);
        cancelModalBtn?.addEventListener('click', toggleModal);

        // Close on backdrop click
        addEventModal?.addEventListener('click', (e) => {
            if (e.target === addEventModal.querySelector('.absolute.inset-0')) toggleModal();
        });

        // Toggle Price Field based on Event Type
        const eventType = document.getElementById('eventType');
        const priceField = document.getElementById('priceField');

        eventType?.addEventListener('change', () => {
            if (eventType.value === 'gratis') {
                priceField.classList.add('hidden');
            } else {
                priceField.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>