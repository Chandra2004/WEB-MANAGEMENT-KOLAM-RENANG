<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('/assets/ico/favicon.ico') }}" type="image/x-icon">
    <title>{{ $title ?? 'Dashboard' }} | Nama Aplikasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Alpine.js (WAJIB Aktifkan agar dropdown Bell dan Profil jalan) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        ksc: {
                            blue: '#1e40af',
                            dark: '#1e3a8a',
                            accent: '#f59e0b',
                            light: '#eff6ff',
                            slate: '#0f172a'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(30, 64, 175, 0.08) 0%, rgba(30, 64, 175, 0) 100%);
            border-left: 4px solid #1e40af;
            color: #1e40af;
            font-weight: 600;
        }
        .sidebar { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>

<body class="bg-slate-50 text-slate-700 font-sans antialiased">
    @include('layouts.layout-partials.notification')

    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="sidebar fixed inset-y-0 left-0 z-[60] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 shadow-sm">
            <div class="h-full flex flex-col p-6">
                <!-- LOGO SECTION -->
                <div class="flex items-center justify-between mb-8 px-2">
                    <a href="/" class="block">
                        <img src="{{ asset('assets/ico/icon-bar.png') }}" class="h-10 w-auto object-contain" alt="Logo">
                    </a>
                    <button id="closeSidebar" class="lg:hidden p-2 text-slate-400 hover:bg-slate-50 rounded-xl transition-colors">
                        <x-lucide-x class="w-6 h-6" />
                    </button>
                </div>

                <!-- NAVIGATION MENU -->
                <nav class="flex-1 space-y-1 overflow-y-auto custom-scrollbar">
                    @include('layouts.layout-dashboard.navbar')
                </nav>

                <!-- FOOTER SIDEBAR / LOGOUT -->
                <div class="pt-6 mt-6 border-t border-slate-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-all group">
                            <x-lucide-log-out class="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
                            <span class="font-bold text-sm">Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 min-w-0 bg-slate-50 flex flex-col h-screen overflow-hidden">
            
            <!-- HEADER -->
            <header class="h-20 flex-shrink-0 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-6 md:px-10 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <button id="toggleSidebar" class="lg:hidden p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all">
                        <x-lucide-menu class="w-6 h-6" />
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 tracking-tight">
                            DASHBOARD <span class="text-ksc-blue">{{ strtoupper($user->username) }}</span>
                        </h1>
                        <p class="text-[11px] text-slate-400 font-medium uppercase tracking-widest hidden sm:block">
                            Selamat Datang Kembali
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-5">
                    <!-- NOTIFICATION BELL -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="h-11 w-11 bg-slate-50 rounded-xl flex items-center justify-center text-slate-500 hover:text-ksc-blue hover:bg-ksc-light transition-all relative border border-slate-100">
                            <x-lucide-bell class="w-5 h-5" />
                            @if ($totalUnreadNotifications > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-white text-[10px] font-bold shadow-sm">
                                    {{ $totalUnreadNotifications }}
                                </span>
                            @endif
                        </button>

                        <!-- DROPDOWN BELL -->
                        <div x-show="open" @click.away="open = false" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="absolute top-full right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-slate-100 z-50 overflow-hidden">
                            
                            <div class="px-5 py-4 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                                <h3 class="font-bold text-slate-800 text-sm">Pemberitahuan</h3>
                                <a href="{{ url(strtolower($user->getRoleNames()->first()) . '/dashboard/notifications') }}" class="text-xs text-ksc-blue hover:underline font-semibold">
                                    Lihat Semua
                                </a>
                            </div>

                            <div class="max-h-[400px] overflow-y-auto">
                                @forelse($unreadNotifications as $notification)
                                    <div class="group flex items-start gap-4 p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex-shrink-0 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                                            <x-lucide-bell-ring class="w-5 h-5" />
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-sm text-slate-800 font-bold leading-tight">{{ $notification->title }}</p>
                                            <div class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">
                                                {!! $notification->message !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-12 px-6 text-center">
                                        <x-lucide-bell-off class="w-12 h-12 text-slate-200 mx-auto mb-3" />
                                        <p class="text-sm font-medium text-slate-400">Tidak ada notifikasi baru</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- USER PROFILE DROPDOWN -->
                    <div x-data="{ open: false }" class="relative">
                        <div @click="open = !open" class="flex items-center gap-3 pl-4 border-l border-slate-200 cursor-pointer group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 group-hover:text-ksc-blue transition-colors">{{ $user->username }}</p>
                                <p class="text-[9px] text-white bg-ksc-blue px-2 py-0.5 rounded-full inline-block font-black uppercase tracking-wider">
                                    {{ $user->getRoleNames()->first() }}
                                </p>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->getRoleNames()->first()) }}&background=1e40af&color=fff&bold=true"
                                class="h-10 w-10 rounded-xl border-2 border-transparent group-hover:border-ksc-blue transition-all shadow-sm" alt="Avatar">
                        </div>

                        <!-- DROPDOWN PROFIL -->
                        <div x-show="open" @click.away="open = false" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="absolute top-full right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 z-50 py-2">
                            
                            <div class="px-4 py-2 border-b border-slate-50 mb-1 sm:hidden">
                                <p class="text-sm font-bold text-slate-900">{{ $user->nama_lengkap }}</p>
                            </div>

                            <a href="{{ url(strtolower($user->getRoleNames()->first()) . '/dashboard/my-profile') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-ksc-blue transition-colors">
                                <x-lucide-user-circle class="w-4 h-4" />
                                <span>Profil Saya</span>
                            </a>

                            <div class="my-1 h-px bg-slate-50"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center w-full gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors font-semibold">
                                    <x-lucide-log-out class="w-4 h-4" />
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN SECTION AREA -->
            <section class="flex-1 overflow-y-auto p-6 md:p-10 custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    @yield('dashboard-section')
                </div>
            </section>
        </main>
    </div>

    <!-- MOBILE BACKDROP -->
    <div id="sidebarBackdrop"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[50] hidden lg:hidden transition-opacity duration-300 opacity-0">
    </div>

    <script>
        // Logika Sidebar yang diperbaiki
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            backdrop.classList.remove('hidden');
            setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            sidebar.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('opacity-0');
            setTimeout(() => backdrop.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }

        toggleBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        backdrop?.addEventListener('click', closeSidebar);

        // Tutup otomatis jika layar di-resize ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeSidebar();
        });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>