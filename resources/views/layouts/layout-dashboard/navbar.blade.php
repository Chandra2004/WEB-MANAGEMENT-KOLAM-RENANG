<style>
    /* Styling Active State */
    .sidebar-item-active {
        background-color: #0061ff;
        /* KSC Blue */
        color: white !important;
    }

    /* Memastikan ikon di dalam item aktif otomatis berwarna putih */
    .sidebar-item-active svg {
        color: white !important;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #f1f5f9;
        border-radius: 10px;
    }
</style>

<nav class="flex-1 space-y-2 overflow-y-auto pr-2 custom-scrollbar">
    {{-- Homepage --}}
    <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
        <x-lucide-panel-top class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue transition-colors" />
        <span class="text-sm font-medium text-slate-700">Homepage</span>
    </a>

    {{-- Main Menu --}}
    <div class="my-4 border-t border-slate-100 pt-4">
        <p class="px-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 text-left">Main Menu</p>

        <a href="{{ url('/dashboard') }}"
            class="{{ request()->is('dashboard') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
            <x-lucide-layout-dashboard
                class="w-5 h-5 {{ request()->is('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }} transition-colors" />
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <div>
            {{-- Button Trigger --}}
            <button type="button"
                class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-slate-700 rounded-xl transition group hover:bg-slate-50"
                data-collapse-toggle="dropdown-user-mgmt" aria-controls="dropdown-user-mgmt"
                aria-expanded="{{ request()->is('*/management-user*') || request()->is('*/management-role*') || request()->is('*/management-permission*') ? 'true' : 'false' }}">

                <div class="flex items-center gap-3 text-left">
                    <x-lucide-shield-check class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue" />
                    <span>Manajemen Akses</span>
                </div>

                {{-- Ikon Chevron --}}
                <x-lucide-chevron-down class="w-4 h-4 text-slate-400 transition-transform duration-300" />
            </button>

            {{-- Dropdown Menu --}}
            <ul id="dropdown-user-mgmt"
                class="{{ request()->is('*/management-user*') || request()->is('*/management-role*') || request()->is('*/management-permission*') ? '' : 'hidden' }} mt-1 ml-4 pl-4 border-l-2 border-slate-100 space-y-1">

                {{-- Pengguna --}}
                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-user') }}"
                        class="{{ request()->is('*/management-user*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Pengguna
                    </a>
                </li>

                {{-- Hak Akses (Roles) --}}
                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-role') }}"
                        class="{{ request()->is('*/management-role*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Hak Akses
                    </a>
                </li>

                {{-- Izin Akses (Permissions) --}}
                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-permission') }}"
                        class="{{ request()->is('*/management-permission*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Izin Akses
                    </a>
                </li>
            </ul>
        </div>


















































































        {{-- Dropdown: SDM & Anggota --}}
        <div>
            {{-- Button Trigger --}}
            <button type="button"
                class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-slate-700 rounded-xl transition group hover:bg-slate-50"
                data-collapse-toggle="dropdown-sdm" aria-controls="dropdown-sdm"
                aria-expanded="{{ request()->is('*/management-user*') || request()->is('*/management-coach*') || request()->is('*/management-member*') ? 'true' : 'false' }}">

                <div class="flex items-center gap-3 text-left">
                    <x-lucide-users-round class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue" />
                    <span>SDM & Anggota</span>
                </div>

                {{-- Ikon Chevron --}}
                <x-lucide-chevron-down class="w-4 h-4 text-slate-400 transition-transform duration-300" />
            </button>

            {{-- Dropdown Menu --}}
            <ul id="dropdown-sdm"
                class="{{ request()->is('*/management-user*') || request()->is('*/management-coach*') || request()->is('*/management-member*') ? '' : 'hidden' }} mt-1 ml-4 pl-4 border-l-2 border-slate-100 space-y-1">

                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-user') }}"
                        class="{{ request()->is('*/management-user*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Manajemen Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-coach') }}"
                        class="{{ request()->is('*/management-coach*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Manajemen Pelatih
                    </a>
                </li>
                <li>
                    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-member') }}"
                        class="{{ request()->is('*/management-member*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                        Manajemen Member
                    </a>
                </li>
            </ul>
        </div>
















































        <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/event') }}"
            class="{{ request()->is('*/dashboard/event*') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
            <x-lucide-calendar-check
                class="w-5 h-5 {{ request()->is('*/dashboard/event*') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }}" />
            <span class="text-sm font-medium">Event</span>
        </a>

        <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/registration-history') }}"
            class="{{ request()->is('*/dashboard/registration-history*') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
            <x-lucide-history
                class="w-5 h-5 {{ request()->is('*/dashboard/registration-history*') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }}" />
            <span class="text-sm font-medium">Riwayat Pendaftaran</span>
        </a>
    </div>



    {{-- Dropdown: Keuangan (Hanya jika punya izin) --}}
    @if ($user->can('manage-payments'))
        <div x-data="{ open: {{ request()->is('*/management-payment*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
                <div class="flex items-center gap-3 text-left">
                    <x-lucide-credit-card class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue" />
                    <span class="text-sm font-medium text-slate-700">Keuangan</span>
                </div>
                <x-lucide-chevron-down class="w-4 h-4 text-slate-400 transition-transform duration-300"
                    ::class="open ? 'rotate-180' : ''" />
            </button>

            <div x-show="open" x-cloak x-collapse class="mt-1 ml-4 pl-4 border-l-2 border-slate-100 space-y-1">
                <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/management-payment') }}"
                    class="{{ request()->is('*/management-payment') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                    Metode Pembayaran
                </a>
            </div>
        </div>
    @endif

    {{-- Dropdown: Layanan Event --}}
    <div x-data="{ open: {{ request()->is('*/management-*') && !request()->is('*/management-user*') && !request()->is('*/management-coach*') && !request()->is('*/management-member*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
            class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
            <div class="flex items-center gap-3 text-left">
                <x-lucide-calendar-range class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue" />
                <span class="text-sm font-medium text-slate-700">Layanan Event</span>
            </div>
            <x-lucide-chevron-down class="w-4 h-4 text-slate-400 transition-transform duration-300" ::class="open ? 'rotate-180' : ''" />
        </button>

        <div x-show="open" x-cloak x-collapse class="mt-1 ml-4 pl-4 border-l-2 border-slate-100 space-y-1">
            @php
                $eventMenus = [
                    'management-category' => 'Manajemen Gaya',
                    'management-requirement-parameter' => 'Master Parameter Lomba',
                    'management-event' => 'Manajemen Event',
                    'management-registration' => 'Manajemen Pendaftaran',
                    'management-result' => 'Manajemen Hasil Lomba',
                    'management-gallery' => 'Manajemen Galeri',
                ];
            @endphp
            @foreach ($eventMenus as $path => $label)
                <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/' . $path) }}"
                    class="{{ request()->is('*/' . $path . '*') ? 'text-ksc-blue font-black' : 'text-slate-500 hover:text-ksc-blue font-medium' }} block py-2 text-xs transition text-left">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>



    {{-- Laporan --}}
    <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/export-reports') }}"
        class="{{ request()->is('*/export-reports*') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
        <x-lucide-file-spreadsheet
            class="w-5 h-5 {{ request()->is('*/export-reports*') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }}" />
        <span class="text-sm font-medium">Laporan & Export</span>
    </a>







    {{-- Personal Menu --}}
    <div class="my-4 border-t border-slate-100 pt-4">
        <p class="px-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 text-left">Personal Menu
        </p>

        <a href="{{ url('/' . strtolower($user->nama_role) . '/dashboard/notifications') }}"
            class="{{ request()->is('*/notifications') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50">
            <x-lucide-bell
                class="w-5 h-5 {{ request()->is('*/notifications') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }}" />
            <span class="text-sm font-medium">Notifikasi</span>
        </a>

        <a href="{{ url('/dashboard/my-profile') }}"
            class="{{ request()->is('*/my-profile') ? 'sidebar-item-active shadow-lg shadow-blue-100' : '' }} flex items-center gap-3 px-4 py-3 rounded-xl transition group hover:bg-slate-50 text-left">
            <x-lucide-user-circle
                class="w-5 h-5 {{ request()->is('*/my-profile') ? 'text-white' : 'text-slate-500 group-hover:text-ksc-blue' }}" />
            <span class="text-sm font-medium">Profil Saya</span>
        </a>
    </div>
</nav>
