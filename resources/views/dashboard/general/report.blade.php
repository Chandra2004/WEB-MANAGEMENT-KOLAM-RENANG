@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50" x-data="reportSystem()">
        {{-- HEADER HALAMAN --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div class="text-left">
                <h2 class="text-4xl font-black text-slate-900 leading-tight tracking-tight">Pusat Laporan KSC</h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Export data pendaftaran resmi dengan pengelompokan per
                    event.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-200">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Laporan Aktif</span>
            </div>
        </div>

        {{-- KARTU FILTER LAPORAN --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/40 overflow-hidden mb-12">
            <div class="p-8 md:p-10">
                {{-- Section Header --}}
                <div class="flex items-center gap-4 mb-10 border-b border-slate-100 pb-8">
                    <div
                        class="w-12 h-12 bg-blue-50 text-ksc-blue rounded-2xl flex items-center justify-center shadow-inner">
                        <i data-lucide="settings-2" class="w-6 h-6"></i>
                    </div>
                    <div class="text-left">
                        <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">Konfigurasi Laporan</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Atur kriteria data dan
                            format output file</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
                    {{-- 1. Pilih Sumber Data (Event) --}}
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Sumber
                            Data</label>
                        <div class="relative group">
                            <i data-lucide="database"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-ksc-blue transition-colors"></i>
                            <select x-model="selectedEvent" @change="updatePreview()"
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue p-4 pl-11 outline-none transition appearance-none cursor-pointer">
                                <option value="all">Semua Event (Grouped)</option>
                                <option value="e1">Kejurnas Renang 2026</option>
                                <option value="e2">KSC Fun Swimming</option>
                                <option value="e3">Workshop AI & Masa Depan (Gratis)</option>
                            </select>
                            <i data-lucide="chevron-down"
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>

                    {{-- 2. Pilih Format Export --}}
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Format
                            Output</label>
                        <div class="flex gap-3 h-[58px]">
                            {{-- Excel Option --}}
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" x-model="exportFormat" value="excel" class="hidden">
                                <div class="flex items-center justify-center gap-3 h-full px-4 rounded-xl border-2 transition-all duration-200"
                                    :class="exportFormat === 'excel' ? 'bg-green-50 border-green-500 ring-4 ring-green-50' :
                                        'bg-slate-50 border-slate-100 hover:border-slate-300'">
                                    <i data-lucide="file-spreadsheet" class="w-5 h-5"
                                        :class="exportFormat === 'excel' ? 'text-green-600' : 'text-slate-400'"></i>
                                    <span class="text-xs font-bold"
                                        :class="exportFormat === 'excel' ? 'text-green-700' : 'text-slate-500'">EXCEL</span>
                                </div>
                            </label>
                            {{-- PDF Option --}}
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" x-model="exportFormat" value="pdf" class="hidden">
                                <div class="flex items-center justify-center gap-3 h-full px-4 rounded-xl border-2 transition-all duration-200"
                                    :class="exportFormat === 'pdf' ? 'bg-red-50 border-red-500 ring-4 ring-red-50' :
                                        'bg-slate-50 border-slate-100 hover:border-slate-300'">
                                    <i data-lucide="file-text" class="w-5 h-5"
                                        :class="exportFormat === 'pdf' ? 'text-red-600' : 'text-slate-400'"></i>
                                    <span class="text-xs font-bold"
                                        :class="exportFormat === 'pdf' ? 'text-red-700' : 'text-slate-500'">PDF</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- 3. Tombol Eksekusi --}}
                    <div class="flex items-end">
                        <button @click="triggerExport()"
                            class="w-full bg-slate-900 text-white font-black py-[18px] rounded-xl shadow-xl shadow-slate-200 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group">
                            <i data-lucide="download-cloud" class="w-5 h-5 text-ksc-blue group-hover:animate-bounce"></i>
                            <span class="tracking-widest">GENERATE & DOWNLOAD</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- AREA PREVIEW (Formal Grouped View) --}}
        <div id="export-container" class="space-y-8 pb-10">
            <template x-for="(group, eventName) in groupedData" :key="eventName">
                <div class="bg-white border border-slate-300 rounded-xl shadow-sm overflow-hidden">

                    {{-- Judul Besar Tengah (Formal & Compact) --}}
                    <div class="py-6 border-b border-slate-200 text-center bg-slate-50">
                        <h4 class="text-xl font-bold text-slate-900 uppercase tracking-wider" x-text="eventName"></h4>
                        <p class="text-[9px] text-slate-500 font-semibold mt-1 uppercase tracking-widest">Laporan Resmi
                            Pendaftaran Event</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50">
                                <tr class="border-b border-slate-200">
                                    <th
                                        class="px-6 py-3 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-left">
                                        Nama Peserta</th>
                                    <th
                                        class="px-6 py-3 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-center">
                                        Status Verifikasi</th>
                                    <th
                                        class="px-6 py-3 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-right">
                                        Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <template x-for="item in group" :key="item.id">
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-3 text-xs font-semibold text-slate-800 text-left"
                                            x-text="item.user"></td>
                                        <td class="px-6 py-3 text-center">
                                            {{-- Badge Status yang Lebih Kecil & Formal --}}
                                            <span class="px-2 py-0.5 text-[8px] font-bold uppercase rounded border"
                                                :class="item.status === 'diterima' ?
                                                    'bg-white text-green-700 border-green-200' :
                                                    'bg-white text-amber-700 border-amber-200'"
                                                x-text="item.status"></span>
                                        </td>
                                        <td class="px-6 py-3 text-xs font-mono font-bold text-slate-900 text-right"
                                            x-html="formatPrice(item.price)"></td>
                                    </tr>
                                </template>
                            </tbody>
                            {{-- Footer Tabel untuk Kesan Formal Laporan --}}
                            <tfoot class="bg-slate-50/50">
                                <tr>
                                    <td colspan="2" class="px-6 py-2 text-[9px] text-slate-400 italic text-left">
                                        * Total pendaftar pada event ini: <span x-text="group.length"
                                            class="font-bold"></span> orang
                                    </td>
                                    <td class="px-6 py-2 text-[9px] text-slate-400 text-right uppercase font-bold">KSC
                                        Official Report</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Scripts Export --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <script>
        function reportSystem() {
            return {
                selectedEvent: 'all',
                exportFormat: 'excel',
                allData: [{
                        id: 1,
                        user: 'Nabil',
                        event: 'Kejurnas Renang 2026',
                        status: 'diterima',
                        price: 'Rp 150.000',
                        event_id: 'e1'
                    },
                    {
                        id: 2,
                        user: 'Budi Darmawan',
                        event: 'Kejurnas Renang 2026',
                        status: 'menunggu',
                        price: 'Rp 150.000',
                        event_id: 'e1'
                    },
                    {
                        id: 3,
                        user: 'Ibrahim Fitra',
                        event: 'KSC Fun Swimming',
                        status: 'diterima',
                        price: 'Rp 50.000',
                        event_id: 'e2'
                    },
                    {
                        id: 4,
                        user: 'Siti Aminah',
                        event: 'Workshop AI & Masa Depan',
                        status: 'diterima',
                        price: 0,
                        event_id: 'e3'
                    },
                    {
                        id: 5,
                        user: 'Aris Munandar',
                        event: 'Workshop AI & Masa Depan',
                        status: 'diterima',
                        price: 0,
                        event_id: 'e3'
                    }
                ],
                groupedData: {},

                init() {
                    this.updatePreview();
                },

                updatePreview() {
                    let filtered = this.selectedEvent === 'all' ?
                        this.allData :
                        this.allData.filter(d => d.event_id === this.selectedEvent);

                    // Pecah data per event judul besar
                    this.groupedData = filtered.reduce((acc, obj) => {
                        let key = obj.event;
                        if (!acc[key]) acc[key] = [];
                        acc[key].push(obj);
                        return acc;
                    }, {});
                },

                formatPrice(price) {
                    if (price === 0 || price === '0' || !price) {
                        return '<span class="text-green-600 font-black tracking-widest text-[10px] bg-green-50 px-2 py-1 rounded-md border border-green-100 uppercase">Gratis</span>';
                    }
                    return price;
                },

                triggerExport() {
                    this.exportFormat === 'excel' ? this.exportToExcel() : this.exportToPDF();
                },

                exportToExcel() {
                    const wb = XLSX.utils.book_new();
                    Object.keys(this.groupedData).forEach(eventName => {
                        const data = this.groupedData[eventName].map(item => ({
                            'Nama Peserta': item.user,
                            'Status': item.status.toUpperCase(),
                            'Nominal': item.price === 0 ? 'GRATIS' : item.price
                        }));
                        const ws = XLSX.utils.json_to_sheet(data);
                        XLSX.utils.book_append_sheet(wb, ws, eventName.substring(0, 30));
                    });
                    XLSX.writeFile(wb, `KSC_Report_${new Date().getTime()}.xlsx`);
                },

                exportToPDF() {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();

                    Object.keys(this.groupedData).forEach((eventName, index) => {
                        if (index > 0) doc.addPage();

                        doc.setFontSize(22);
                        doc.setFont("helvetica", "bold");
                        doc.text(eventName.toUpperCase(), 105, 25, {
                            align: 'center'
                        });

                        doc.setFontSize(10);
                        doc.setFont("helvetica", "normal");
                        doc.setTextColor(150);
                        doc.text("Official Grouped Registration Report", 105, 32, {
                            align: 'center'
                        });

                        doc.autoTable({
                            head: [
                                ['NAMA PESERTA', 'STATUS', 'BIAYA']
                            ],
                            body: this.groupedData[eventName].map(i => [
                                i.user,
                                i.status.toUpperCase(),
                                i.price === 0 ? 'GRATIS' : i.price
                            ]),
                            startY: 45,
                            theme: 'striped',
                            headStyles: {
                                fillColor: [15, 23, 42],
                                halign: 'center'
                            },
                            columnStyles: {
                                2: {
                                    halign: 'right'
                                }
                            }
                        });
                    });
                    doc.save('KSC_Official_Report.pdf');
                }
            }
        }
    </script>
@endsection
