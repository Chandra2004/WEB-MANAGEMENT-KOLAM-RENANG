<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lomba - KSC Member</title>

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
                    <p class="px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 text-left">Member
                        Area</p>
                    <a href="dashboard.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="lomba.html"
                        class="sidebar-item-active flex items-center gap-3 px-4 py-3 rounded-xl transition group">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                        <span>Pendaftaran Lomba</span>
                    </a>
                    <a href="riwayat.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="history" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Riwayat Transaksi</span>
                    </a>
                    <a href="pesan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Kotak Masuk</span>
                    </a>
                    <p class="pt-8 px-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 text-left">
                        Pengaturan</p>
                    <a href="profile.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="user-circle" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="pengaturan.html"
                        class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:text-ksc-blue hover:bg-slate-50 rounded-xl transition group">
                        <i data-lucide="settings" class="w-5 h-5 group-hover:scale-110 transition"></i>
                        <span>Pengaturan</span>
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

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden text-left">
            <header
                class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40">
                <div class="flex items-center gap-2 md:gap-4 text-left">
                    <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-slate-900 leading-tight">Pendaftaran Lomba</h1>

                    </div>
                </div>

                <div class="flex items-center gap-2 md:gap-4">
                    <a href="payment.html"
                        class="p-2 text-slate-400 hover:text-ksc-blue hover:bg-slate-50 rounded-full transition"
                        title="Riwayat Tagihan">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </a>
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
                                        <p class="text-xs font-bold text-slate-900 leading-tight">Jadwal Latihan
                                            Tambahan</p>
                                        <p class="text-[10px] text-slate-500 mt-1 line-clamp-1">Ada sesi tambahan di
                                            hari sabtu...</p>
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
                                        <span
                                            class="text-[9px] text-slate-400 mt-1 block italic underline">Kemarin</span>
                                    </div>
                                </div>
                            </div>
                            <a href="pesan.html"
                                class="block p-4 text-center text-[11px] font-bold text-ksc-blue hover:bg-slate-50 transition">
                                Lihat Seluruh Kotak Masuk
                            </a>
                        </div>
                    </div>
                    <div
                        class="h-9 w-9 md:h-10 md:w-10 rounded-full bg-slate-200 overflow-hidden border border-slate-200">
                        <img src="https://ui-avatars.com/api/?name=Fikri+Haikal&background=random" alt="User">
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <!-- Filter & Search -->
                <div
                    class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-8 flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 flex-1 text-left">
                        <div class="relative flex-1">
                            <input type="text" placeholder="Cari event atau lokasi..."
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-2.5 pl-10 text-sm focus:ring-2 focus:ring-ksc-blue outline-none transition uppercase font-bold placeholder:normal-case">
                            <i data-lucide="search"
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        </div>
                        <select
                            class="bg-slate-50 border-none rounded-xl px-4 py-2.5 text-sm outline-none cursor-pointer font-bold text-slate-600">
                            <option>Semua Kategori</option>
                            <option>Nasional</option>
                            <option>Internal</option>
                        </select>
                    </div>
                </div>

                <!-- Event Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
                    <!-- Event 1 (Berbayar) -->
                    <div
                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group">
                        <div class="h-48 bg-slate-100 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?q=80&w=2070&auto=format&fit=crop"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-ksc-accent text-slate-900 text-[10px] font-extrabold rounded-full shadow-sm">OPEN</span>
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-bold rounded-full uppercase shadow-sm border border-white/20">Nasional</span>
                            </div>
                        </div>
                        <div class="p-7 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">Annual Championship 2026</h3>
                            <p class="text-[11px] text-slate-500 mb-6 line-clamp-2 leading-relaxed">Ajang tahunan paling
                                bergengsi untuk menunjukkan hasil latihan terbaik Anda di tingkat nasional.</p>

                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 mb-8 mt-auto">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">24-26 Feb</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div
                                        class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center text-left">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">Jakarta Pool</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">245 Peserta</span>
                                </div>
                                <div class="flex items-center gap-2 text-ksc-blue">
                                    <div class="h-7 w-7 bg-blue-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-extrabold uppercase">Rp 350.000</span>
                                </div>
                            </div>

                            <button id="registerBtn"
                                class="w-full py-3.5 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold transition shadow-lg shadow-ksc-blue/20 transform active:scale-95 text-sm">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- Event 2 (Sudah Terdaftar) -->
                    <div
                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group opacity-90">
                        <div class="h-48 bg-slate-100 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=2070&auto=format&fit=crop"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500 grayscale-[0.3]">
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-green-500 text-white text-[10px] font-extrabold rounded-full shadow-sm">TERDAFTAR</span>
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-bold rounded-full uppercase shadow-sm border border-white/20">Internal</span>
                            </div>
                        </div>
                        <div class="p-7 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">Sprint Series: 50m Free</h3>
                            <p class="text-[11px] text-slate-500 mb-6 line-clamp-2 leading-relaxed">Kejuaraan bulanan
                                KSC untuk menguji kecepatan murni gaya bebas jarak pendek.</p>

                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 mb-8 mt-auto">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold text-left">15 Mar 2026</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div
                                        class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center text-left">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold text-left">KSC Pool B</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">80 Peserta</span>
                                </div>
                                <div class="flex items-center gap-2 text-green-600">
                                    <div class="h-7 w-7 bg-green-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-extrabold uppercase">Lunas</span>
                                </div>
                            </div>

                            <button
                                class="w-full py-3.5 bg-slate-100 text-slate-400 rounded-2xl font-bold cursor-default text-sm">
                                Sudah Terdaftar
                            </button>
                        </div>
                    </div>

                    <!-- Event 3 (Gratis) -->
                    <div
                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group">
                        <div class="h-48 bg-slate-100 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1544648397-52e9dd2d5356?q=80&w=1974&auto=format&fit=crop"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-blue-600 text-white text-[10px] font-extrabold rounded-full shadow-sm">CLUB
                                    MEET</span>
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold rounded-full uppercase shadow-sm border border-green-200">Gratis</span>
                            </div>
                        </div>
                        <div class="p-7 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-slate-900 mb-2 truncate">Friendly Match #1</h3>
                            <p class="text-[11px] text-slate-500 mb-6 line-clamp-2 leading-relaxed">Latihan bersama
                                antar atlet KSC untuk menguji ketahanan dan teknik pernapasan.</p>

                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 mb-8 mt-auto">
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">10 Apr 2026</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div
                                        class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center text-left">
                                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">KSC Main Pool</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400">
                                    <div class="h-7 w-7 bg-slate-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-[10px] font-bold">45 Peserta</span>
                                </div>
                                <div class="flex items-center gap-2 text-green-600">
                                    <div class="h-7 w-7 bg-green-50 rounded-lg flex items-center justify-center">
                                        <i data-lucide="gift" class="w-3.5 h-3.5 text-left"></i>
                                    </div>
                                    <span class="text-[10px] font-extrabold uppercase text-left">Free Event</span>
                                </div>
                            </div>

                            <a href="payment.html?type=free"
                                class="block w-full py-3.5 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-bold transition shadow-lg shadow-green-600/20 transform active:scale-95 text-center text-sm">
                                Ikuti Club Meet
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal Pendaftaran Lomba -->
                <div id="registerModal" class="fixed inset-0 z-[60] hidden">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
                    <div class="flex min-h-full items-center justify-center p-4">
                        <div
                            class="relative w-full max-w-2xl bg-white rounded-[2rem] md:rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all">
                            <div class="bg-ksc-blue p-6 md:p-8 text-white relative">
                                <button id="closeModalBtn"
                                    class="absolute top-4 right-4 md:top-6 md:right-6 p-2 hover:bg-white/10 rounded-full transition">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                                <h2 class="text-xl md:text-2xl font-bold mb-1">Form Pendaftaran Lomba</h2>
                                <p class="text-blue-100 text-xs md:text-sm italic">Konfirmasi data atlet untuk
                                    pendaftaran event</p>
                            </div>
                            <div class="p-6 md:p-8 max-h-[80vh] overflow-y-auto">
                                <form class="space-y-6" action="{{ url('/lomba/create/process') }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        <h4
                                            class="text-[10px] md:text-xs font-bold text-ksc-blue uppercase tracking-widest border-b border-slate-100 pb-2">
                                            Biodata Peserta</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                            <div>
                                                <label
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">Nama
                                                    Lengkap</label>
                                                <input name="nama_lengkap" type="text" value="Fikri Haikal" disabled
                                                    class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-5 py-3.5 text-sm text-slate-500 outline-none">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 px-1 text-left">ID
                                                    Member</label>
                                                <input name="id_member" type="text" value="KSC-2026-0083" disabled
                                                    class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-5 py-3.5 text-sm text-slate-500 outline-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <h4
                                            class="text-[10px] md:text-xs font-bold text-ksc-blue uppercase tracking-widest border-b border-slate-100 pb-2 text-left">
                                            Pilih Kategori</h4>
                                        <div>
                                            <select
                                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-5 py-3.5 text-sm outline-none focus:ring-2 focus:ring-ksc-blue transition cursor-pointer font-bold text-slate-600">
                                                <option value="sprint-50-free">50m Gaya Bebas</option>
                                                <option value="sprint-50-fly">50m Gaya Kupu-kupu</option>
                                                <option value="sprint-50-breast">50m Gaya Dada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="bg-blue-50 rounded-2xl p-4 md:p-6 border border-blue-100">
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] md:text-xs font-bold text-slate-600">Terhitung
                                                Biaya</span>
                                            <span class="text-base md:text-lg font-bold text-ksc-blue italic">Rp
                                                350.000</span>
                                        </div>
                                    </div>
                                    <div class="pt-4 flex flex-col md:flex-row gap-3 md:gap-4">
                                        <button type="button" id="cancelModalBtn"
                                            class="w-full md:flex-1 py-3.5 md:py-4 border border-slate-200 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition text-sm">Batal</button>
                                        <a href="payment.html"
                                            class="w-full md:flex-[2] py-3.5 md:py-4 bg-ksc-blue hover:bg-ksc-dark text-white rounded-2xl font-bold shadow-xl shadow-ksc-blue/20 transition transform active:scale-95 text-center text-sm">Lanjut
                                            ke Payment</a>
                                    </div>
                                </form>
                            </div>
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
        const registerModal = document.getElementById('registerModal');
        const registerBtn = document.getElementById('registerBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        const toggleModal = () => registerModal.classList.toggle('hidden');

        registerBtn?.addEventListener('click', toggleModal);
        closeModalBtn?.addEventListener('click', toggleModal);
        cancelModalBtn?.addEventListener('click', toggleModal);

        // Close modal when clicking on backdrop
        registerModal?.addEventListener('click', (e) => {
            if (e.target === registerModal) toggleModal();
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