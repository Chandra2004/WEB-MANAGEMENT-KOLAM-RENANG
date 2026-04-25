@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
<div class="p-4 md:p-8 overflow-y-auto h-screen bg-slate-50/50" x-data="reportSystem()">
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div class="text-left">
            <h2 class="text-4xl font-black text-slate-900 leading-tight tracking-tight">Pusat Laporan KSC</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Data pendaftaran real-time dari sistem manajemen event.</p>
        </div>
        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-200">
            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Database Connected</span>
        </div>
    </div>

    {{-- KARTU KONFIGURASI --}}
    <div class="bg-white border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/40 overflow-hidden mb-12">
        <div class="p-8 md:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
                
                {{-- 1. Pilih Event --}}
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Sumber Data</label>
                    <div class="relative group">
                        <i data-lucide="database" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 group-focus-within:text-ksc-blue transition-colors"></i>
                        <select x-model="selectedEventUid" @change="updatePreview()"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-bold rounded-xl focus:ring-4 focus:ring-blue-50 focus:border-ksc-blue p-4 pl-11 outline-none transition appearance-none cursor-pointer">
                            <option value="all">Semua Event (Grouped)</option>
                            <template x-for="event in rawBackendData" :key="event.uid">
                                <option :value="event.uid" x-text="event.nama_event"></option>
                            </template>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>

                {{-- 2. Pilih Format --}}
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest ml-1">Format Output</label>
                    <div class="flex gap-3 h-[58px]">
                        <label class="flex-1 relative cursor-pointer group">
                            <input type="radio" x-model="exportFormat" value="excel" class="hidden">
                            <div class="flex items-center justify-center gap-3 h-full px-4 rounded-xl border-2 transition-all duration-200"
                                :class="exportFormat === 'excel' ? 'bg-green-50 border-green-500 ring-4 ring-green-50' : 'bg-slate-50 border-slate-100'">
                                <i data-lucide="file-spreadsheet" class="w-5 h-5" :class="exportFormat === 'excel' ? 'text-green-600' : 'text-slate-400'"></i>
                                <span class="text-xs font-bold" :class="exportFormat === 'excel' ? 'text-green-700' : 'text-slate-500'">EXCEL</span>
                            </div>
                        </label>
                        <label class="flex-1 relative cursor-pointer group">
                            <input type="radio" x-model="exportFormat" value="pdf" class="hidden">
                            <div class="flex items-center justify-center gap-3 h-full px-4 rounded-xl border-2 transition-all duration-200"
                                :class="exportFormat === 'pdf' ? 'bg-red-50 border-red-500 ring-4 ring-red-50' : 'bg-slate-50 border-slate-100'">
                                <i data-lucide="file-text" class="w-5 h-5" :class="exportFormat === 'pdf' ? 'text-red-600' : 'text-slate-400'"></i>
                                <span class="text-xs font-bold" :class="exportFormat === 'pdf' ? 'text-red-700' : 'text-slate-500'">PDF</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- 3. Download Button --}}
                <div class="flex items-end">
                    <button @click="triggerExport()"
                        class="w-full bg-slate-900 text-white font-black py-[18px] rounded-xl shadow-xl shadow-slate-200 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group">
                        <i data-lucide="download-cloud" class="w-5 h-5 text-ksc-blue group-hover:animate-bounce"></i>
                        <span>GENERATE REPORT</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- AREA PREVIEW TABEL --}}
    <div id="export-container" class="space-y-10 pb-20">
        <template x-for="eventGroup in groupedData" :key="eventGroup.uid">
            <div class="bg-white border border-slate-300 rounded-2xl shadow-sm overflow-hidden">
                {{-- Judul Event Formal --}}
                <div class="py-6 border-b border-slate-200 text-center bg-slate-50">
                    <h4 class="text-xl font-bold text-slate-900 uppercase tracking-wider" x-text="eventGroup.nama_event"></h4>
                    <p class="text-[9px] text-slate-500 font-bold mt-1 uppercase tracking-widest" 
                       x-text="'Tipe: ' + eventGroup.tipe_event + ' | Official Registration Report'"></p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-600 uppercase tracking-wider">Nama Lengkap Peserta</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-center">Email</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-center">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-600 uppercase tracking-wider text-right">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <template x-for="member in eventGroup.registerMember" :key="member.uid">
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-xs font-bold text-slate-800" x-text="member.user.nama_lengkap"></td>
                                    <td class="px-6 py-4 text-xs text-slate-500 text-center font-medium" x-text="member.user.email"></td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-0.5 text-[8px] font-black uppercase rounded border" 
                                            :class="{
                                                'bg-green-50 text-green-700 border-green-200': member.status === 'diterima',
                                                'bg-yellow-50 text-yellow-700 border-yellow-200': member.status === 'menunggu',
                                                'bg-red-50 text-red-700 border-red-200': member.status === 'ditolak'
                                            }" x-text="member.status"></span>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono font-bold text-slate-900 text-right" 
                                        x-html="formatPayment(eventGroup.tipe_event, member.payment)"></td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot class="bg-slate-50/50">
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-[10px] text-slate-400 italic font-medium">
                                    * Total: <span x-text="eventGroup.registerMember.length" class="font-bold"></span> pendaftar tercatat.
                                </td>
                                <td class="px-6 py-3 text-[9px] text-slate-400 text-right uppercase font-bold">KSC Report Engine</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </template>
    </div>
</div>

{{-- Scripts Library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<script>
function reportSystem() {
    return {
        selectedEventUid: 'all',
        exportFormat: 'excel',
        // Integrasi Data dari Backend Controller
        rawBackendData: @json($dataExport), 
        groupedData: [],

        init() {
            this.updatePreview();
        },

        updatePreview() {
            if (this.selectedEventUid === 'all') {
                this.groupedData = this.rawBackendData;
            } else {
                this.groupedData = this.rawBackendData.filter(e => e.uid === this.selectedEventUid);
            }
        },

        formatPayment(type, payment) {
            if (type === 'gratis') {
                return '<span class="text-green-600 font-black text-[9px] uppercase bg-green-50 px-2 py-0.5 rounded border border-green-100">Gratis</span>';
            }
            if (payment && payment.total_bayar) {
                return 'Rp ' + parseInt(payment.total_bayar).toLocaleString('id-ID');
            }
            return '<span class="text-slate-400 font-bold text-[9px]">BELUM BAYAR</span>';
        },

        triggerExport() {
            this.exportFormat === 'excel' ? this.exportToExcel() : this.exportToPDF();
        },

        exportToExcel() {
            const wb = XLSX.utils.book_new();
            this.groupedData.forEach(event => {
                const sheetData = event.registerMember.map(m => ({
                    'Nama Lengkap': m.user.nama_lengkap,
                    'Email': m.user.email,
                    'Status': m.status.toUpperCase(),
                    'Metode': m.payment ? m.payment.metode_pembayaran : '-',
                    'Nominal': event.tipe_event === 'gratis' ? 'GRATIS' : (m.payment ? m.payment.total_bayar : '0')
                }));
                const ws = XLSX.utils.json_to_sheet(sheetData);
                XLSX.utils.book_append_sheet(wb, ws, event.nama_event.substring(0, 31));
            });
            XLSX.writeFile(wb, `KSC_Report_${new Date().getTime()}.xlsx`);
        },

        exportToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            this.groupedData.forEach((event, index) => {
                if (index > 0) doc.addPage();
                
                doc.setFontSize(18);
                doc.setFont("helvetica", "bold");
                doc.text(event.nama_event.toUpperCase(), 105, 20, { align: 'center' });
                
                doc.setFontSize(10);
                doc.text(`Tipe Event: ${event.tipe_event.toUpperCase()}`, 105, 27, { align: 'center' });

                const tableBody = event.registerMember.map(m => [
                    m.user.nama_lengkap,
                    m.user.email,
                    m.status.toUpperCase(),
                    event.tipe_event === 'gratis' ? 'GRATIS' : (m.payment ? `Rp ${m.payment.total_bayar}` : '-')
                ]);

                doc.autoTable({
                    head: [['NAMA LENGKAP', 'EMAIL', 'STATUS', 'BIAYA']],
                    body: tableBody,
                    startY: 35,
                    theme: 'grid',
                    headStyles: { fillColor: [15, 23, 42], halign: 'center' },
                    columnStyles: { 3: { halign: 'right' } }
                });
            });
            doc.save('KSC_Official_Report.pdf');
        }
    }
}
</script>
@endsection