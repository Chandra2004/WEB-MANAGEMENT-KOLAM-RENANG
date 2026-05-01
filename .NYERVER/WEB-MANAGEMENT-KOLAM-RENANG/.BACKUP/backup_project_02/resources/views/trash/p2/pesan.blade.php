<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk - KSC Coach</title>

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
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group text-left">
                        <i data-lucide="mail" class="w-5 h-5 transition text-left"></i>
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
                        <i data-lucide="settings"
                            class="w-5 h-5 group-hover:scale-110 transition text-left text-left"></i>
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
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg text-left text-left">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="text-left text-left">
                        <h1 class="text-xl font-bold text-slate-900 leading-tight">Kotak Masuk</h1>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-left">
                    <div class="h-10 w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200 text-left">
                        <img src="https://ui-avatars.com/api/?name=Coach+Andre&background=1e40af&color=fff" alt="User">
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 text-left">
                <div class="max-w-4xl mx-auto space-y-4 text-left text-left">
                    <!-- Unread Message -->
                    <div
                        class="bg-white p-6 rounded-3xl border-l-4 border-l-ksc-blue border border-slate-100 shadow-sm flex items-start gap-5 hover:bg-slate-50/80 transition cursor-pointer group text-left">
                        <div
                            class="h-12 w-12 bg-blue-50 text-ksc-blue rounded-2xl flex items-center justify-center shrink-0">
                            <i data-lucide="megaphone" class="w-6 h-6 group-hover:scale-110 transition text-left"></i>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <div class="flex items-center justify-between mb-1 text-left">
                                <h3 class="font-bold text-slate-900 truncate text-left">Update Aturan Penilaian Baru
                                </h3>
                                <span
                                    class="text-[10px] font-bold text-ksc-blue bg-blue-50 px-2 py-0.5 rounded uppercase text-left">BARU</span>
                            </div>
                            <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed text-left text-left">
                                Diberitahukan kepada seluruh pelatih, terdapat penyesuaian regulasi pada sistem poin
                                FINA untuk kelompok umur...</p>
                            <span class="text-[10px] text-slate-400 mt-3 block text-left">Admin • 1 jam yang lalu</span>
                        </div>
                    </div>

                    <!-- Read Message -->
                    <div
                        class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start gap-5 hover:bg-slate-50 transition cursor-pointer group text-left">
                        <div
                            class="h-12 w-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center shrink-0 text-left">
                            <i data-lucide="user" class="w-6 h-6 text-left"></i>
                        </div>
                        <div class="flex-1 min-w-0 text-left text-left">
                            <div class="flex items-center justify-between mb-1 text-left text-left">
                                <h3 class="font-bold text-slate-900 truncate text-left">Pertanyaan Evaluasi Teknik</h3>
                                <span class="text-[10px] text-slate-400 mt-1 block">Kemarin</span>
                            </div>
                            <p
                                class="text-sm text-slate-500 line-clamp-2 leading-relaxed text-left text-left text-left">
                                Coach Andre, Fikri ingin bertanya mengenai bagian pernapasan saat gaya kupu-kupu yang
                                Fikri rasa masih berat...</p>
                            <span class="text-[10px] text-slate-400 mt-3 block text-left">Fikri Haikal (Atlet)</span>
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