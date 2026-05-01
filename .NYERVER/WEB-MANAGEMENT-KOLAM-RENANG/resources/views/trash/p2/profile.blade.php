<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KSC Coach</title>

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

                <nav class="flex-1 space-y-2 text-left text-left">
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Coach Portal</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left">
                        <i data-lucide="layout-dashboard"
                            class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="peserta.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left text-left">
                        <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Daftar Peserta</span>
                    </a>
                    <a href="lomba.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left text-left">
                        <i data-lucide="trophy" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Manajemen Lomba</span>
                    </a>
                    <a href="laporan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left text-left">
                        <i data-lucide="file-text" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Laporan</span>
                    </a>
                    <a href="pesan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left text-left">
                        <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition text-left"></i>
                        <span>Kotak Masuk</span>
                    </a>

                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 text-left">
                        Settings</p>
                    <a href="profile.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group text-left">
                        <i data-lucide="user-circle" class="w-5 h-5 transition text-left"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="pengaturan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group text-left">
                        <i data-lucide="settings"
                            class="w-5 h-5 group-hover:scale-110 transition text-left text-left text-left"></i>
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
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40 text-left">
                <div class="flex items-center gap-4 text-left">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg text-left">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="text-left text-left">
                        <h1 class="text-xl font-bold text-slate-900 leading-tight">Profil Pelatih</h1>
                    </div>
                </div>

                <div class="flex items-center gap-4 text-left text-left">
                    <button
                        class="bg-ksc-blue hover:bg-ksc-dark text-white px-5 py-2 rounded-xl font-bold text-xs transition shadow-lg shadow-ksc-blue/20 text-left">
                        Simpan Perubahan
                    </button>
                    <div class="h-10 w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200 text-left">
                        <img src="https://ui-avatars.com/api/?name=Coach+Andre&background=1e40af&color=fff" alt="User">
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 text-left text-left">
                <div class="max-w-4xl mx-auto text-left">
                    <!-- Profile Card -->
                    <div
                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden mb-8 text-left">
                        <div class="h-32 bg-gradient-to-r from-ksc-blue to-blue-400 text-left"></div>
                        <div class="px-8 pb-8 text-left">
                            <div class="relative flex justify-between items-end -mt-12 mb-8 text-left text-left">
                                <div class="relative group text-left">
                                    <img src="https://ui-avatars.com/api/?name=Coach+Andre&background=1e40af&color=fff&size=200"
                                        class="h-32 w-32 rounded-3xl border-4 border-white shadow-lg bg-white">
                                    <button
                                        class="absolute bottom-2 right-2 p-2 bg-white rounded-lg shadow-md border border-slate-100 text-slate-500 hover:text-ksc-blue transition text-left">
                                        <i data-lucide="camera" class="w-4 h-4 text-left"></i>
                                    </button>
                                </div>
                                <div class="text-right pb-2 flex flex-col items-end gap-2 text-left text-left">
                                    <span
                                        class="px-3 py-1 bg-blue-100 text-ksc-blue text-[10px] font-bold rounded-full uppercase tracking-widest text-left">Head
                                        Coach</span>
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-widest text-left">Lisensi
                                        FINA A</span>
                                </div>
                            </div>

                            <form class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 text-left text-left"
                                action="{{ url('/profile/update/process') }}" method="POST">
                                @csrf
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Nama
                                        Lengkap</label>
                                    <input name="nama_lengkap" type="text" value="Andre Kurniawan, S.Pd"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left">
                                </div>
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">ID
                                        Pelatih</label>
                                    <input name="id_pelatih" type="text" value="CO-KSC-002" disabled
                                        class="w-full bg-slate-100 border border-slate-100 rounded-xl px-4 py-3 text-sm text-slate-500 font-bold cursor-not-allowed text-left">
                                </div>
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left text-left">Email
                                        Profesional</label>
                                    <input name="email" type="email" value="andre.coach@ksc-club.com"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left">
                                </div>
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Nomor
                                        WhatsApp</label>
                                    <input name="no_telepon" type="text" value="+62 856-7890-1234"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left">
                                </div>
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Spesialisasi
                                        Gaya</label>
                                    <input name="spesialisasi_gaya" type="text"
                                        value="Gaya Kupu-kupu (Fly), Gaya Bebas (Free)"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left text-left">
                                </div>
                                <div class="space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Pengalaman</label>
                                    <input name="pengalaman" type="text" value="8 Tahun Pelatih Nasional"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left text-left text-left">
                                </div>

                                <div class="md:col-span-2 space-y-2 text-left">
                                    <label
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Biodata
                                        Singkat</label>
                                    <textarea rows="3"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition font-medium text-left text-left">Mantan atlet perenang regional, berfokus pada pengembangan teknik dasar dan mental kompetisi atlet muda.</textarea>
                                </div>

                                <!-- Security Section (Keamanan Akun) -->
                                <div class="md:col-span-2 mt-4 pt-6 border-t border-slate-50 text-left">
                                    <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2 text-left">
                                        <i data-lucide="lock" class="w-4 h-4 text-ksc-blue text-left"></i> Keamanan Akun
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left text-left">
                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left text-left text-left">Password
                                                Baru</label>
                                            <input name="password" type="password" placeholder="••••••••"
                                                class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition text-left">
                                        </div>
                                        <div class="space-y-2 text-left">
                                            <label
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1 text-left">Konfirmasi
                                                Password</label>
                                            <input name="password_confirm" type="password" placeholder="••••••••"
                                                class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition text-left text-left">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    </script>
</body>

</html>