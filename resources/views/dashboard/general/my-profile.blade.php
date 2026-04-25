@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
<div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50">
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div class="text-left">
            <h2 class="text-3xl font-black text-slate-900 leading-tight tracking-tight uppercase">Pengaturan Profil</h2>
            <p class="text-sm text-slate-500 font-medium italic">Kelola identitas digital, data fisik, dan dokumen verifikasi dalam satu panel terpadu.</p>
        </div>

        @php
            $profileStatus = $user->getProfileCompletion();
            $completionPercentage = $profileStatus['percentage'];
            $missingFields = $profileStatus['missing'];
        @endphp

        @if($completionPercentage < 100)
            <div class="flex items-center gap-3 bg-amber-50 border border-amber-200 p-3 rounded-xl">
                <div class="h-10 w-10 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 flex-shrink-0">
                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-amber-800 uppercase tracking-wider">Profil Belum Lengkap ({{ $completionPercentage }}%)</span>
                    </div>
                    <p class="text-[10px] text-amber-600 font-medium">Data yang kurang: <span class="font-bold underline">{{ implode(', ', $missingFields) }}</span></p>
                </div>
            </div>
        @else
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 p-3 rounded-xl">
                <div class="h-10 w-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Profil Terverifikasi 100%</span>
                    <p class="text-[10px] text-emerald-600 font-medium">Bagus! Seluruh data identitas Anda sudah lengkap.</p>
                </div>
            </div>
        @endif
    </div>
    
    <p class="text-sm text-slate-600 font-medium mb-4 italic">Kolom yang ditandai dengan <span class="text-red-500 font-bold">*</span> wajib diisi untuk melengkapi profil Anda.</p>

    @php
        $locations = [
            'ACEH' => ['KAB. ACEH SELATAN', 'KAB. ACEH TENGGARA', 'KAB. ACEH TIMUR', 'KAB. ACEH TENGAH', 'KAB. ACEH BARAT', 'KAB. ACEH BESAR', 'KAB. PIDIE', 'KAB. ACEH UTARA', 'KAB. SIMEULUE', 'KAB. ACEH SINGKIL', 'KAB. BIREUEN', 'KAB. ACEH BARAT DAYA', 'KAB. GAYO LUES', 'KAB. ACEH JAYA', 'KAB. NAGAN RAYA', 'KAB. ACEH TAMIANG', 'KAB. BENER MERIAH', 'KAB. PIDIE JAYA', 'KOTA BANDA ACEH', 'KOTA SABANG', 'KOTA LHOKSEUMAWE', 'KOTA LANGSA', 'KOTA SUBULUSSALAM'],
            'SUMATERA UTARA' => ['KAB. TAPANULI TENGAH', 'KAB. TAPANULI UTARA', 'KAB. TAPANULI SELATAN', 'KAB. NIAS', 'KAB. LANGKAT', 'KAB. KARO', 'KAB. DELI SERDANG', 'KAB. SIMALUNGUN', 'KAB. ASAHAN', 'KAB. LABUHANBATU', 'KAB. DAIRI', 'KAB. TOBA SAMOSIR', 'KAB. MANDAILING NATAL', 'KAB. NIAS SELATAN', 'KAB. PAKPAK BHARAT', 'KAB. HUMBANG HASUNDUTAN', 'KAB. SAMOSIR', 'KAB. SERDANG BEDAGAI', 'KAB. BATU BARA', 'KAB. PADANG LAWAS UTARA', 'KAB. PADANG LAWAS', 'KAB. LABUHANBATU SELATAN', 'KAB. LABUHANBATU UTARA', 'KAB. NIAS UTARA', 'KAB. NIAS BARAT', 'KOTA MEDAN', 'KOTA PEMATANGSIANTAR', 'KOTA SIBOLGA', 'KOTA TANJUNGBALAI', 'KOTA BINJAI', 'KOTA TEBING TINGGI', 'KOTA PADANGSIDIMPUAN', 'KOTA GUNUNGSITOLI'],
            'SUMATERA BARAT' => ['KAB. PESISIR SELATAN', 'KAB. SOLOK', 'KAB. SIJUNJUNG', 'KAB. TANAH DATAR', 'KAB. PADANG PARIAMAN', 'KAB. AGAM', 'KAB. LIMA PULUH KOTA', 'KAB. PASAMAN', 'KAB. KEPULAUAN MENTAWAI', 'KAB. DHARMASRAYA', 'KAB. SOLOK SELATAN', 'KAB. PASAMAN BARAT', 'KOTA PADANG', 'KOTA SOLOK', 'KOTA SAWAHLUNTO', 'KOTA PADANG PANJANG', 'KOTA BUKITTINGGI', 'KOTA PAYAKUMBUH', 'KOTA PARIAMAN'],
            'RIAU' => ['KAB. KUANTAN SINGINGI', 'KAB. INDRAGIRI HULU', 'KAB. INDRAGIRI HILIR', 'KAB. PELALAWAN', 'KAB. S I A K', 'KAB. KAMPAR', 'KAB. ROKAN HULU', 'KAB. BENGKALIS', 'KAB. ROKAN HILIR', 'KAB. KEPULAUAN MERANTI', 'KOTA PEKANBARU', 'KOTA D U M A I'],
            'JAMBI' => ['KAB. KERINCI', 'KAB. MERANGIN', 'KAB. SAROLANGUN', 'KAB. BATANGHARI', 'KAB. MUARO JAMBI', 'KAB. TANJUNG JABUNG BARAT', 'KAB. TANJUNG JABUNG TIMUR', 'KAB. BUNGO', 'KAB. TEBO', 'KOTA JAMBI', 'KOTA SUNGAI PENUH'],
            'SUMATERA SELATAN' => ['KAB. OGAN KOMERING ULU', 'KAB. OGAN KOMERING ILIR', 'KAB. MUARA ENIM', 'KAB. LAHAT', 'KAB. MUSI RAWAS', 'KAB. MUSI BANYUASIN', 'KAB. BANYUASIN', 'KAB. OGAN KOMERING ULU TIMUR', 'KAB. OGAN KOMERING ULU SELATAN', 'KAB. OGAN ILIR', 'KAB. EMPAT LAWANG', 'KAB. PENUKAL ABAB LEMATANG ILIR', 'KAB. MUSI RAWAS UTARA', 'KOTA PALEMBANG', 'KOTA PAGAR ALAM', 'KOTA LUBUKLINGGAU', 'KOTA PRABUMULIH'],
            'BENGKULU' => ['KAB. BENGKULU SELATAN', 'KAB. REJANG LEBONG', 'KAB. BENGKULU UTARA', 'KAB. KAUR', 'KAB. SELUMA', 'KAB. MUKOMUKO', 'KAB. LEBONG', 'KAB. KEPAHIANG', 'KAB. BENGKULU TENGAH', 'KOTA BENGKULU'],
            'LAMPUNG' => ['KAB. LAMPUNG SELATAN', 'KAB. LAMPUNG TENGAH', 'KAB. LAMPUNG UTARA', 'KAB. LAMPUNG BARAT', 'KAB. TULANG BAWANG', 'KAB. TANGGAMUS', 'KAB. LAMPUNG TIMUR', 'KAB. WAY KANAN', 'KAB. PESAWARAN', 'KAB. PRINGSEWU', 'KAB. MESUJI', 'KAB. TULANG BAWANG BARAT', 'KAB. PESISIR BARAT', 'KOTA BANDAR LAMPUNG', 'KOTA METRO'],
            'KEPULAUAN BANGKA BELITUNG' => ['KAB. BANGKA', 'KAB. BELITUNG', 'KAB. BANGKA SELATAN', 'KAB. BANGKA TENGAH', 'KAB. BANGKA BARAT', 'KAB. BELITUNG TIMUR', 'KOTA PANGKAL PINANG'],
            'KEPULAUAN RIAU' => ['KAB. BINTAN', 'KAB. KARIMUN', 'KAB. NATUNA', 'KAB. LINGGA', 'KAB. KEPULAUAN ANAMBAS', 'KOTA BATAM', 'KOTA TANJUNG PINANG'],
            'DKI JAKARTA' => ['KAB. KEPULAUAN SERIBU', 'KOTA JAKARTA PUSAT', 'KOTA JAKARTA UTARA', 'KOTA JAKARTA BARAT', 'KOTA JAKARTA SELATAN', 'KOTA JAKARTA TIMUR'],
            'JAWA BARAT' => ['KAB. BOGOR', 'KAB. SUKABUMI', 'KAB. CIANJUR', 'KAB. BANDUNG', 'KAB. GARUT', 'KAB. TASIKMALAYA', 'KAB. CIAMIS', 'KAB. KUNINGAN', 'KAB. CIREBON', 'KAB. MAJALENGKA', 'KAB. SUMEDANG', 'KAB. INDRAMAYU', 'KAB. SUBANG', 'KAB. PURWAKARTA', 'KAB. KARAWANG', 'KAB. BEKASI', 'KAB. BANDUNG BARAT', 'KAB. PANGANDARAN', 'KOTA BOGOR', 'KOTA SUKABUMI', 'KOTA BANDUNG', 'KOTA CIREBON', 'KOTA BEKASI', 'KOTA DEPOK', 'KOTA CIMAHI', 'KOTA TASIKMALAYA', 'KOTA BANJAR'],
            'JAWA TENGAH' => ['KAB. CILACAP', 'KAB. BANYUMAS', 'KAB. PURBALINGGA', 'KAB. BANJARNEGARA', 'KAB. KEBUMEN', 'KAB. PURWOREJO', 'KAB. WONOSOBO', 'KAB. MAGELANG', 'KAB. BOYOLALI', 'KAB. KLATEN', 'KAB. SUKOHARJO', 'KAB. WONOGIRI', 'KAB. KARANGANYAR', 'KAB. SRAGEN', 'KAB. GROBOGAN', 'KAB. BLORA', 'KAB. REMBANG', 'KAB. PATI', 'KAB. KUDUS', 'KAB. JEPARA', 'KAB. DEMAK', 'KAB. SEMARANG', 'KAB. TEMANGGUNG', 'KAB. KENDAL', 'KAB. BATANG', 'KAB. PEKALONGAN', 'KAB. PEMALANG', 'KAB. TEGAL', 'KAB. BREBES', 'KOTA MAGELANG', 'KOTA SURAKARTA', 'KOTA SALATIGA', 'KOTA SEMARANG', 'KOTA PEKALONGAN', 'KOTA TEGAL'],
            'DI YOGYAKARTA' => ['KAB. KULON PROGO', 'KAB. BANTUL', 'KAB. GUNUNGKIDUL', 'KAB. SLEMAN', 'KOTA YOGYAKARTA'],
            'JAWA TIMUR' => ['KAB. PACITAN', 'KAB. PONOROGO', 'KAB. TRENGGALEK', 'KAB. TULUNGAGUNG', 'KAB. BLITAR', 'KAB. KEDIRI', 'KAB. MALANG', 'KAB. LUMAJANG', 'KAB. JEMBER', 'KAB. BANYUWANGI', 'KAB. BONDOWOSO', 'KAB. SITUBONDO', 'KAB. PROBOLINGGO', 'KAB. PASURUAN', 'KAB. SIDOARJO', 'KAB. MOJOKERTO', 'KAB. JOMBANG', 'KAB. NGANJUK', 'KAB. MADIUN', 'KAB. MAGETAN', 'KAB. NGAWI', 'KAB. BOJONEGORO', 'KAB. TUBAN', 'KAB. LAMONGAN', 'KAB. GRESIK', 'KAB. BANGKALAN', 'KAB. SAMPANG', 'KAB. PAMEKASAN', 'KAB. SUMENEP', 'KOTA KEDIRI', 'KOTA BLITAR', 'KOTA MALANG', 'KOTA PROBOLINGGO', 'KOTA PASURUAN', 'KOTA MOJOKERTO', 'KOTA MADIUN', 'KOTA SURABAYA', 'KOTA BATU'],
            'BANTEN' => ['KAB. PANDEGLANG', 'KAB. LEBAK', 'KAB. TANGERANG', 'KAB. SERANG', 'KOTA TANGERANG', 'KOTA CILEGON', 'KOTA SERANG', 'KOTA TANGERANG SELATAN'],
            'BALI' => ['KAB. JEMBRANA', 'KAB. TABANAN', 'KAB. BADUNG', 'KAB. GIANYAR', 'KAB. KLUNGKUNG', 'KAB. BANGLI', 'KAB. KARANGASEM', 'KAB. BULELENG', 'KOTA DENPASAR'],
            'NUSA TENGGARA BARAT' => ['KAB. LOMBOK BARAT', 'KAB. LOMBOK TENGAH', 'KAB. LOMBOK TIMUR', 'KAB. SUMBAWA', 'KAB. DOMPU', 'KAB. BIMA', 'KAB. SUMBAWA BARAT', 'KAB. LOMBOK UTARA', 'KOTA MATARAM', 'KOTA BIMA'],
            'NUSA TENGGARA TIMUR' => ['KAB. KUPANG', 'KAB. TIMOR TENGAH SELATAN', 'KAB. TIMOR TENGAH UTARA', 'KAB. BELU', 'KAB. ALOR', 'KAB. FLORES TIMUR', 'KAB. SIKKA', 'KAB. ENDE', 'KAB. NGADA', 'KAB. MANGGARAI', 'KAB. SUMBA TIMUR', 'KAB. SUMBA BARAT', 'KAB. LEMBATA', 'KAB. ROTE NDAO', 'KAB. MANGGARAI BARAT', 'KAB. NAGAKEO', 'KAB. SUMBA TENGAH', 'KAB. SUMBA BARAT DAYA', 'KAB. MANGGARAI TIMUR', 'KAB. SABU RAIJUA', 'KAB. MALAKA', 'KOTA KUPANG'],
            'KALIMANTAN BARAT' => ['KAB. SAMBAS', 'KAB. MEMPAWAH', 'KAB. SANGGAU', 'KAB. KETAPANG', 'KAB. SINTANG', 'KAB. KAPUAS HULU', 'KAB. BENGKAYANG', 'KAB. LANDAK', 'KAB. SEKADAU', 'KAB. MELAWI', 'KAB. KAYONG UTARA', 'KAB. KUBU RAYA', 'KOTA PONTIANAK', 'KOTA SINGKAWANG'],
            'KALIMANTAN TENGAH' => ['KAB. KOTAWARINGIN BARAT', 'KAB. KOTAWARINGIN TIMUR', 'KAB. KAPUAS', 'KAB. BARITO SELATAN', 'KAB. BARITO UTARA', 'KAB. KATINGAN', 'KAB. SERUYAN', 'KAB. SUKAMARA', 'KAB. LAMANDAU', 'KAB. GUNUNG MAS', 'KAB. PULANG PISAU', 'KAB. MURUNG RAYA', 'KAB. BARITO TIMUR', 'KOTA PALANGKA RAYA'],
            'KALIMANTAN SELATAN' => ['KAB. TANAH LAUT', 'KAB. KOTABARU', 'KAB. BANJAR', 'KAB. BARITO KUALA', 'KAB. TAPIN', 'KAB. HULU SUNGAI SELATAN', 'KAB. HULU SUNGAI TENGAH', 'KAB. HULU SUNGAI UTARA', 'KAB. TABALONG', 'KAB. TANAH BUMBU', 'KAB. BALANGAN', 'KOTA BANJARMASIN', 'KOTA BANJARBARU'],
            'KALIMANTAN TIMUR' => ['KAB. PASER', 'KAB. KUTAI KARTANEGARA', 'KAB. BERAU', 'KAB. KUTAI BARAT', 'KAB. KUTAI TIMUR', 'KAB. PENAJAM PASER UTARA', 'KAB. MAHAKAM ULU', 'KOTA BALIKPAPAN', 'KOTA SAMARINDA', 'KOTA BONTANG'],
            'KALIMANTAN UTARA' => ['KAB. BULUNGAN', 'KAB. MALINAU', 'KAB. NUNUKAN', 'KAB. TANA TIDUNG', 'KOTA TARAKAN'],
            'SULAWESI UTARA' => ['KAB. BOLAANG MONGONDOW', 'KAB. MINAHASA', 'KAB. KEPULAUAN SANGIHE', 'KAB. KEPULAUAN TALAUD', 'KAB. MINAHASA SELATAN', 'KAB. MINAHASA UTARA', 'KAB. MINAHASA TENGGARA', 'KAB. BOLAANG MONGONDOW UTARA', 'KAB. KEP. SIAU TAGULANDANG BIARO', 'KAB. BOLAANG MONGONDOW TIMUR', 'KAB. BOLAANG MONGONDOW SELATAN', 'KOTA MANADO', 'KOTA BITUNG', 'KOTA TOMOHON', 'KOTA KOTAMOBAGU'],
            'SULAWESI TENGAH' => ['KAB. BANGGAI', 'KAB. POSO', 'KAB. DONGGALA', 'KAB. TOLI-TOLI', 'KAB. BUOL', 'KAB. MOROWALI', 'KAB. BANGGAI KEPULAUAN', 'KAB. PARIGI MOUTONG', 'KAB. TOJO UNA-UNA', 'KAB. SIGI', 'KAB. BANGGAI LAUT', 'KAB. MOROWALI UTARA', 'KOTA PALU'],
            'SULAWESI SELATAN' => ['KAB. KEPULAUAN SELAYAR', 'KAB. BULUKUMBA', 'KAB. BANTAENG', 'KAB. JENEPONTO', 'KAB. TAKALAR', 'KAB. GOWA', 'KAB. SINJAI', 'KAB. BONE', 'KAB. MAROS', 'KAB. PANGKAJENE KEPULAUAN', 'KAB. BARRU', 'KAB. SOPPENG', 'KAB. WAJO', 'KAB. SIDENRENG RAPPANG', 'KAB. PINRANG', 'KAB. ENREKANG', 'KAB. LUWU', 'KAB. TANA TORAJA', 'KAB. LUWU UTARA', 'KAB. LUWU TIMUR', 'KAB. TORAJA UTARA', 'KOTA MAKASSAR', 'KOTA PAREPARE', 'KOTA PALOPO'],
            'SULAWESI TENGGARA' => ['KAB. KOLAKA', 'KAB. KONAWE', 'KAB. MUNA', 'KAB. BUTON', 'KAB. KONAWE SELATAN', 'KAB. BOMBANA', 'KAB. WAKATOBI', 'KAB. KOLAKA UTARA', 'KAB. KONAWE UTARA', 'KAB. BUTON UTARA', 'KAB. MUNA BARAT', 'KAB. BUTON TENGAH', 'KAB. BUTON SELATAN', 'KAB. KONAWE KEPULAUAN', 'KOTA KENDARI', 'KOTA BAUBAU'],
            'GORONTALO' => ['KAB. GORONTALO', 'KAB. BOALEMO', 'KAB. BONE BOLANGO', 'KAB. PAHUWATO', 'KAB. GORONTALO UTARA', 'KOTA GORONTALO'],
            'SULAWESI BARAT' => ['KAB. MAMUJU', 'KAB. POLEWALI MANDAR', 'KAB. MAMASA', 'KAB. MAMUJU UTARA', 'KAB. MAMUJU TENGAH'],
            'MALUKU' => ['KAB. MALUKU TENGAH', 'KAB. MALUKU TENGGARA', 'KAB. KEPULAUAN ARU', 'KAB. SERAM BAGIAN BARAT', 'KAB. SERAM BAGIAN TIMUR', 'KAB. BURU', 'KAB. BURU SELATAN', 'KAB. MALUKU BARAT DAYA', 'KAB. KEPULAUAN TANIMBAR', 'KOTA AMBON', 'KOTA TUAL'],
            'MALUKU UTARA' => ['KAB. HALMAHERA BARAT', 'KAB. HALMAHERA TENGAH', 'KAB. HALMAHERA UTARA', 'KAB. HALMAHERA SELATAN', 'KAB. KEPULAUAN SULA', 'KAB. HALMAHERA TIMUR', 'KAB. PULAU MOROTAI', 'KAB. PULAU TALIABU', 'KOTA TERNATE', 'KOTA TIDORE KEPULAUAN'],
            'PAPUA' => ['KAB. MERAUKE', 'KAB. JAYAPURA', 'KAB. JAYAWIJAYA', 'KAB. NABIRE', 'KAB. KEPULAUAN YAPEN', 'KAB. BIAK NUMFOR', 'KAB. PUNCAK JAYA', 'KAB. PANIAI', 'KAB. MIMIKA', 'KAB. SARMI', 'KAB. KEEROM', 'KAB. WAROPEN', 'KAB. BOVEN DIGOEL', 'KAB. MAPPI', 'KAB. ASMAT', 'KAB. SUPIORI', 'KAB. TOLIKARA', 'KAB. YAHUKIMO', 'KAB. PEGUNUNGAN BINTANG', 'KAB. LANNY JAYA', 'KAB. Mamberamo Tengah', 'KAB. NDUGA', 'KAB. Yalimo', 'KAB. Mamberamo Raya', 'KAB. PUNCAK', 'KAB. DOGIYAI', 'KAB. INTAN JAYA', 'KAB. DEIYAI', 'KOTA JAYAPURA'],
            'PAPUA BARAT' => ['KAB. SORONG', 'KAB. MANOKWARI', 'KAB. FAKFAK', 'KAB. SORONG SELATAN', 'KAB. RAJA AMPAT', 'KAB. TELUK BINTUNI', 'KAB. TELUK WONDAMA', 'KAB. KAIMANA', 'KAB. TAMBRAUW', 'KAB. MAYBRAT', 'KAB. MANOKWARI SELATAN', 'KAB. PEGUNUNGAN ARFAK', 'KOTA SORONG'],
        ];
        $provinces = array_keys($locations);
        sort($provinces);
        
        $allCities = [];
        foreach ($locations as $provinceCities) {
            $allCities = array_merge($allCities, $provinceCities);
        }
        sort($allCities);

        $availableClubs = [
            'KHAFID SWIMMING CLUB'
        ];
    @endphp

    <form action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/my-profile/edit/process') }}"
        method="POST" enctype="multipart/form-data" x-data="profileHandler()" @submit="validateAndSubmit">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="space-y-6">
                <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm text-center">
                    <div class="relative w-40 h-40 mx-auto mb-6">
                        <img :src="avatarUrl" class="w-full h-full rounded-[2.5rem] object-cover border-4 border-slate-50 shadow-xl transition-all duration-500" :class="loadingAvatar ? 'opacity-50 blur-sm' : ''">
                        <button type="button" @click="$refs.avatarInput.click()" class="absolute -bottom-2 -right-2 bg-white border border-slate-200 p-3 rounded-2xl shadow-xl hover:text-ksc-blue transition-all active:scale-95 group">
                            <i data-lucide="camera" class="w-5 h-5 text-slate-500 group-hover:text-ksc-blue" x-show="!loadingAvatar"></i>
                            <i data-lucide="loader-2" class="w-5 h-5 animate-spin text-ksc-blue" x-show="loadingAvatar"></i>
                        </button>
                        <input type="file" name="foto_profil" x-ref="avatarInput" class="hidden" accept="image/*" @change="previewFile($event, 'avatar')">
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">{{ $user['nama_lengkap'] }}</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mt-1 italic">Identitas Utama<span class="text-red-500 ml-1">*</span></p>
                </div>

                @if ($user['nama_role'] != 'admin')
                    <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm text-left">
                        <label class="block mb-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Foto KTP/Foto KP<span class="text-red-500 ml-1">*</span></label>
                        <div class="relative w-full h-44 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 overflow-hidden group cursor-pointer" @click="$refs.ktpInput.click()">
                            <img :src="ktpUrl" x-show="ktpUrl" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity" x-show="ktpUrl">
                                <p class="text-white text-[10px] font-bold uppercase tracking-widest text-center px-4">Ganti Lampiran KTP</p>
                            </div>
                            <div class="flex flex-col items-center justify-center h-full space-y-2" x-show="!ktpUrl">
                                <i data-lucide="image-plus" class="w-8 h-8 text-slate-300"></i>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Unggah Foto KTP</p>
                            </div>
                        </div>
                        <input type="file" name="foto_ktp" x-ref="ktpInput" class="hidden" accept="image/*" @change="previewFile($event, 'ktp')">
                    </div>

                    <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm text-left">
                        <label class="block mb-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Foto Akta Kelahiran</label>
                        <div class="relative w-full h-44 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 overflow-hidden group cursor-pointer" @click="$refs.aktaInput.click()">
                            <img :src="aktaUrl" x-show="aktaUrl" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity" x-show="aktaUrl">
                                <p class="text-white text-[10px] font-bold uppercase tracking-widest text-center px-4">Ganti Foto Akta</p>
                            </div>
                            <div class="flex flex-col items-center justify-center h-full space-y-2" x-show="!aktaUrl">
                                <i data-lucide="file-text" class="w-8 h-8 text-slate-300"></i>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Unggah Foto Akta</p>
                            </div>
                        </div>
                        <input type="file" name="foto_akta" x-ref="aktaInput" class="hidden" accept="image/*" @change="previewFile($event, 'akta')">
                    </div>
                @endif
            </div>

            <div class="lg:col-span-2 space-y-8 text-left">
                
                <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-ksc-blue border border-slate-100">
                            <i data-lucide="user-cog" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 uppercase tracking-tight">Data Personal & Kontak</h4>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 bg-blue-50/50 p-4 rounded-2xl border border-blue-100 mb-2">
                             <label class="block mb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Terdaftar (Akun)</label>
                             <p class="font-bold text-slate-700">{{ $user['email'] }}</p>
                        </div>
                        
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap<span class="text-red-500 ml-1">*</span></label>
                            <input type="text" name="nama_lengkap" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['nama_lengkap'] }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Panggilan</label>
                            <input type="text" name="nama_panggilan" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['nama_panggilan'] ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tempat Lahir<span class="text-red-500 ml-1">*</span></label>
                            <div x-data="searchableDropdown({{ json_encode($allCities) }}, '{{ strtoupper($user['tempat_lahir'] ?? '') }}')" @click.away="closeDropdown()" class="relative">
                                <input type="hidden" name="tempat_lahir" x-model="selectedValue">
                                <input type="text" x-model="search" @focus="openDropdown()" @input.debounce.100ms="filterOptions()" placeholder="Cari atau pilih kota..." class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">
                                <div x-show="isOpen" style="display: none;" class="absolute z-10 w-full mt-1 bg-white border border-slate-200 rounded-2xl shadow-lg max-h-60 overflow-y-auto" x-transition>
                                    <template x-for="option in filteredOptions" :key="option">
                                        <div @click="selectOption(option)" class="px-4 py-2 hover:bg-slate-100 cursor-pointer" :class="{ 'bg-blue-100': option === selectedValue }" x-text="formatCityName(option)"></div>
                                    </template>
                                    <div x-show="filteredOptions.length === 0" class="px-4 py-2 text-slate-500 text-sm">Tidak ada hasil ditemukan.</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tanggal Lahir<span class="text-red-500 ml-1">*</span></label>
                            <input type="date" name="tanggal_lahir" max="{{ date('Y-m-d') }}" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['tanggal_lahir'] }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Jenis Kelamin<span class="text-red-500 ml-1">*</span></label>
                            <select name="jenis_kelamin" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">
                                <option value="L" {{ ($user['jenis_kelamin'] ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ ($user['jenis_kelamin'] ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor KTP (NIK)<span class="text-red-500 ml-1">*</span></label>
                            <input type="number" min="0" name="nomor_ktp" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['nomor_ktp'] ?? '' }}" placeholder="16 digit Nomor Induk Kependudukan">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor KK</label>
                            <input type="number" min="0" name="nomor_kk" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['nomor_kk'] ?? '' }}" placeholder="Nomor Kartu Keluarga">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nomor Telepon/WA<span class="text-red-500 ml-1">*</span></label>
                            <input type="number" min="0" name="no_telepon" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['no_telepon'] }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">No. Telepon Darurat</label>
                            <input type="number" min="0" name="no_telepon_darurat" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['no_telepon_darurat'] ?? '' }}">
                        </div>
                        
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Provinsi<span class="text-red-500 ml-1">*</span></label>
                            <select name="provinsi" x-model="selectedProvince" @change="updateCities()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province }}" {{ (strtoupper($user['provinsi'] ?? '') == $province) ? 'selected' : '' }}>{{ ucfirst(strtolower($province)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Kota / Kabupaten<span class="text-red-500 ml-1">*</span></label>
                            <select name="kota" x-model="selectedCity" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">
                                <option value="">Pilih Kota/Kabupaten</option>
                                <template x-for="city in availableCities" :key="city">
                                    <option :value="city" x-text="formatCityName(city)" :selected="city === selectedCity"></option>
                                </template>
                            </select>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Kode Pos<span class="text-red-500 ml-1">*</span></label>
                            <input type="number" min="0" name="kode_pos" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition" value="{{ $user['kode_pos'] ?? '' }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Alamat Lengkap<span class="text-red-500 ml-1">*</span></label>
                            <textarea name="alamat_lengkap" rows="2" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">{{ $user['alamat_lengkap'] ?? $user['alamat'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-red-500 border border-slate-100">
                            <i data-lucide="heart-pulse" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 uppercase tracking-tight">Kesehatan & Fisik</h4>
                    </div>
                    <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tinggi Badan (cm)<span class="text-red-500 ml-1">*</span></label>
                            <input type="number" step="0.1" min="0" name="tinggi_badan" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none" value="{{ $user['tinggi_badan'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Berat Badan (kg)<span class="text-red-500 ml-1">*</span></label>
                            <input type="number" step="0.1" min="0" name="berat_badan" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none" value="{{ $user['berat_badan'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Gol. Darah</label>
                            <select name="golongan_darah" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none">
                                <option value="" {{ empty($user['golongan_darah']) ? 'selected' : '' }}>Pilih</option>
                                @foreach(['A', 'B', 'AB', 'O'] as $gol)
                                <option value="{{ $gol }}" {{ ($user['golongan_darah'] ?? '') == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Alergi</label>
                            <input type="text" name="alergi" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['alergi'] ?? '' }}" placeholder="Tulis '-' jika tidak ada">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Obat Rutin</label>
                            <input type="text" name="obat_rutin" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['obat_rutin'] ?? '' }}" placeholder="Obat yang sering dikonsumsi">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Vaksin Covid</label>
                            <select name="vaksin_covid" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none">
                                <option value="0" {{ ($user['vaksin_covid'] ?? 0) == 0 ? 'selected' : '' }}>Belum / Tidak Vaksin</option>
                                <option value="1" {{ ($user['vaksin_covid'] ?? 0) == 1 ? 'selected' : '' }}>Sudah Vaksin</option>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Riwayat Penyakit</label>
                            <textarea name="riwayat_penyakit" rows="2" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" placeholder="Tulis '-' jika tidak ada">{{ $user['riwayat_penyakit'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                @php
                    $occupations = [
                        'BELUM/TIDAK BEKERJA', 'MENGURUS RUMAH TANGGA', 'WIRASWASTA / PEDAGANG', 'PEGAWAI NEGERI SIPIL',
                        'TNI / POLRI', 'KARYAWAN BUMN / BUMD', 'KARYAWAN SWASTA', 'PETANI / PETERNAK / NELAYAN',
                        'BURUH', 'PENSIUNAN', 'GURU / DOSEN', 'TENAGA KESEHATAN', 'LAINNYA...'
                    ];
                @endphp
                <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-emerald-500 border border-slate-100">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 uppercase tracking-tight">Keluarga & Pendidikan</h4>
                    </div>
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Ayah</label>
                            <input type="text" name="nama_ayah" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['nama_ayah'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Pekerjaan Ayah</label>
                            <input type="hidden" name="pekerjaan_ayah" :value="finalPekerjaanAyah">
                            <select x-model="pekerjaanAyahSelection" @change="updatePekerjaanAyahValue()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition">
                                <option value="">Pilih Pekerjaan</option>
                                @foreach($occupations as $occupation)
                                    <option value="{{ $occupation }}">{{ ucfirst(strtolower($occupation)) }}</option>
                                @endforeach
                            </select>
                            <div x-show="pekerjaanAyahSelection === 'LAINNYA...'" style="display: none;" class="mt-4">
                                <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Sebutkan Pekerjaan Ayah</label>
                                <input type="text" x-model="otherPekerjaanAyah" @input="updatePekerjaanAyahValue()" placeholder="Sebutkan pekerjaan ayah" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Ibu</label>
                            <input type="text" name="nama_ibu" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['nama_ibu'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Pekerjaan Ibu</label>
                             <input type="hidden" name="pekerjaan_ibu" :value="finalPekerjaanIbu">
                             <select x-model="pekerjaanIbuSelection" @change="updatePekerjaanIbuValue()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition">
                                <option value="">Pilih Pekerjaan</option>
                                @foreach($occupations as $occupation)
                                    <option value="{{ $occupation }}">{{ ucfirst(strtolower($occupation)) }}</option>
                                @endforeach
                            </select>
                            <div x-show="pekerjaanIbuSelection === 'LAINNYA...'" style="display: none;" class="mt-4">
                                <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Sebutkan Pekerjaan Ibu</label>
                                <input type="text" x-model="otherPekerjaanIbu" @input="updatePekerjaanIbuValue()" placeholder="Sebutkan pekerjaan ibu" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Asal Sekolah<span class="text-red-500 ml-1">*</span></label>
                            <input type="text" name="sekolah" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['sekolah'] ?? '' }}">
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Kelas<span class="text-red-500 ml-1">*</span></label>
                            <input type="text" name="kelas" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['kelas'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-orange-500 border border-slate-100">
                            <i data-lucide="trophy" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 uppercase tracking-tight">Afiliasi & Olahraga</h4>
                    </div>
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Klub Renang<span class="text-red-500 ml-1">*</span></label>
                            <input type="hidden" name="klub_renang" :value="finalClubName">
                            <select x-model="klubRenangSelection" @change="updateClubValue()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition appearance-none cursor-pointer">
                                <option value="" disabled>Pilih Klub Renang</option>
                                @foreach($availableClubs as $clubName)
                                    <option value="{{ $clubName }}">{{ $clubName }}</option>
                                @endforeach
                                <option value="LAINNYA...">Lainnya...</option>
                            </select>

                            <div x-show="klubRenangSelection === 'LAINNYA...'" style="display: none;" class="mt-4">
                                <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Klub Lainnya</label>
                                <input type="text" x-model="otherClubName" @input="updateClubValue()" placeholder="Tuliskan nama klub Anda" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue block w-full p-4 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Tingkat Keahlian</label>
                            <select name="tingkat_keahlian" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none">
                                <option value="Pemula" {{ ($user['tingkat_keahlian'] ?? '') == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                                <option value="Menengah" {{ ($user['tingkat_keahlian'] ?? '') == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                <option value="Mahir" {{ ($user['tingkat_keahlian'] ?? '') == 'Mahir' ? 'selected' : '' }}>Mahir</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Pengalaman (Tahun)</label>
                            <input type="number" name="pengalaman_renang" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['pengalaman_renang'] ?? '' }}">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nama Pelatih</label>
                            <input type="text" name="pelatih_renang" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['pelatih_renang'] ?? '' }}">
                        </div>
                        <div class="md:col-span-1">
                             <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Jabatan di Klub</label>
                             <input type="text" name="jabatan_klub" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" value="{{ $user['jabatan_klub'] ?? '' }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Prestasi Renang</label>
                            <textarea name="prestasi_renang" rows="2" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none" placeholder="Sebutkan prestasi terbaik Anda">{{ $user['prestasi_renang'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 p-8 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-slate-600 border border-slate-100">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 uppercase tracking-tight">Keamanan Akun</h4>
                    </div>
                    <div class="p-8">
                        <div>
                            <label class="block mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Ganti Password</label>
                            <input type="password" name="password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-50 block w-full p-4 outline-none transition" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-slate-900 hover:bg-black text-white px-10 py-5 rounded-2xl font-black text-xs transition shadow-2xl shadow-slate-300 flex items-center gap-3 uppercase tracking-[0.2em] transform hover:-translate-y-1 active:scale-95">
                        <i data-lucide="save" class="w-5 h-5 text-ksc-blue"></i>
                        Simpan Semua Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function searchableDropdown(options, initialValue) {
        return {
            isOpen: false,
            search: '',
            options: options,
            filteredOptions: [],
            selectedValue: initialValue,
            
            init() {
                this.filteredOptions = this.options;
                if (this.selectedValue) {
                    this.search = this.formatCityName(this.selectedValue);
                }
                this.$watch('search', () => {
                    if (this.isOpen) {
                        this.filterOptions();
                    }
                });
            },
            
            filterOptions() {
                if (!this.search) {
                    this.filteredOptions = this.options;
                    return;
                }
                this.filteredOptions = this.options.filter(
                    option => this.formatCityName(option).toLowerCase().includes(this.search.toLowerCase())
                );
            },
            
            openDropdown() {
                this.isOpen = true;
                if (this.selectedValue && this.search === this.formatCityName(this.selectedValue)) {
                    this.search = '';
                }
                this.filterOptions();
            },

            closeDropdown() {
                this.isOpen = false;
                if (!this.search || !this.options.some(opt => this.formatCityName(opt).toLowerCase() === this.search.toLowerCase())) {
                    this.search = this.selectedValue ? this.formatCityName(this.selectedValue) : '';
                }
            },
            
            selectOption(option) {
                this.selectedValue = option;
                this.search = this.formatCityName(option);
                this.isOpen = false;
            },

            formatCityName(city) {
                if (!city) return '';
                return city.toLowerCase().replace('kab. ', 'kabupaten ').replace(/\b\w/g, l => l.toUpperCase());
            }
        }
    }

    function profileHandler() {
        const allLocations = @json($locations);
        const availableClubs = @json($availableClubs);
        
        return {
            avatarUrl: `{{ $user['foto_profil'] ? url('/file/users/' . $user['foto_profil']) : 'https://ui-avatars.com/api/?name=' . urlencode($user['nama_lengkap']) . '&background=eff6ff&color=1e40af&size=256&bold=true' }}`,
            ktpUrl: `{{ $user['foto_ktp'] ? url('/file/id_cards/' . $user['foto_ktp']) : null }}`,
            aktaUrl: `{{ $user['foto_akta'] ? url('/file/birth_certificates/' . $user['foto_akta']) : null }}`,            loadingAvatar: false,
            
            selectedProvince: '{{ strtoupper($user['provinsi'] ?? '') }}',
            selectedCity: '{{ strtoupper($user['kota'] ?? '') }}',
            availableCities: [],

            klubRenangSelection: '',
            otherClubName: '',
            finalClubName: '{{ $user['klub_renang'] ?? '' }}',

            pekerjaanAyahSelection: '',
            otherPekerjaanAyah: '',
            finalPekerjaanAyah: '{{ $user['pekerjaan_ayah'] ?? '' }}',

            pekerjaanIbuSelection: '',
            otherPekerjaanIbu: '',
            finalPekerjaanIbu: '{{ $user['pekerjaan_ibu'] ?? '' }}',

            init() {
                this.updateCities();
                
                const userClub = '{{ $user['klub_renang'] ?? '' }}';
                if (availableClubs.includes(userClub)) {
                    this.klubRenangSelection = userClub;
                } else if (userClub) {
                    this.klubRenangSelection = 'LAINNYA...';
                    this.otherClubName = userClub;
                }
                this.updateClubValue();

                const occupations = @json($occupations);
                const userPekerjaanAyah = '{{ strtoupper($user['pekerjaan_ayah'] ?? '') }}';
                if (occupations.includes(userPekerjaanAyah)) {
                    this.pekerjaanAyahSelection = userPekerjaanAyah;
                } else if (userPekerjaanAyah) {
                    this.pekerjaanAyahSelection = 'LAINNYA...';
                    this.otherPekerjaanAyah = '{{ $user['pekerjaan_ayah'] ?? '' }}';
                }
                this.updatePekerjaanAyahValue();

                const userPekerjaanIbu = '{{ strtoupper($user['pekerjaan_ibu'] ?? '') }}';
                if (occupations.includes(userPekerjaanIbu)) {
                    this.pekerjaanIbuSelection = userPekerjaanIbu;
                } else if (userPekerjaanIbu) {
                    this.pekerjaanIbuSelection = 'LAINNYA...';
                    this.otherPekerjaanIbu = '{{ $user['pekerjaan_ibu'] ?? '' }}';
                }
                this.updatePekerjaanIbuValue();
            },

            updateCities() {
                const cities = this.selectedProvince ? (allLocations[this.selectedProvince] || []) : [];
                this.availableCities = cities.sort();
                if (!this.availableCities.includes(this.selectedCity)) {
                    this.selectedCity = '';
                }
            },

            formatCityName(city) {
                if (!city) return '';
                return city.toLowerCase().replace('kab. ', 'kabupaten ').replace(/\b\w/g, l => l.toUpperCase());
            },

            previewFile(event, type) {
                const file = event.target.files[0];
                if (!file) return;
                if (type === 'avatar') this.loadingAvatar = true;

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (type === 'avatar') {
                        this.avatarUrl = e.target.result;
                        setTimeout(() => this.loadingAvatar = false, 400);
                    } else if (type === 'ktp') {
                        this.ktpUrl = e.target.result;
                    } else if (type === 'akta') {
                        this.aktaUrl = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            },

            validateAndSubmit(event) {
                const form = event.target;
                const numericInputs = ['pengalaman_renang', 'tinggi_badan', 'berat_badan'];

                numericInputs.forEach(name => {
                    const element = form.elements[name];
                    if (element && element.value === '') {
                        element.value = '0';
                    }
                });
            },

            updateClubValue() {
                if (this.klubRenangSelection === 'LAINNYA...') {
                    this.finalClubName = this.otherClubName;
                } else {
                    this.finalClubName = this.klubRenangSelection;
                }
            },

            updatePekerjaanAyahValue() {
                if (this.pekerjaanAyahSelection === 'LAINNYA...') {
                    this.finalPekerjaanAyah = this.otherPekerjaanAyah;
                } else {
                    this.finalPekerjaanAyah = this.pekerjaanAyahSelection;
                }
            },
            
            updatePekerjaanIbuValue() {
                if (this.pekerjaanIbuSelection === 'LAINNYA...') {
                    this.finalPekerjaanIbu = this.otherPekerjaanIbu;
                } else {
                    this.finalPekerjaanIbu = this.pekerjaanIbuSelection;
                }
            }
        }
    }
</script>
@endsection
