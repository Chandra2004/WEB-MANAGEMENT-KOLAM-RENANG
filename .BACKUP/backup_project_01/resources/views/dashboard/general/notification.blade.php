@extends('layouts.layout-dashboard.app')

@section('dashboard-section')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Quill Premium Styling */
        .ql-toolbar.ql-snow {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-color: #f1f5f9 !important;
            background: white;
            padding: 12px;
        }

        .ql-container.ql-snow {
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
            border-color: #f1f5f9 !important;
            background: #f8fafc;
            min-height: 200px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .ql-editor {
            min-height: 200px;
        }
    </style>
    <div class="flex flex-col h-screen overflow-hidden bg-slate-50" x-data="notificationSystem()" x-init="initData({{ json_encode($notifications) }})">

        <div class="flex flex-1 overflow-hidden relative">
            {{-- List Area --}}
            <div class="w-full md:w-96 flex flex-col border-r border-slate-200 bg-white shadow-xl z-10"
                :class="mobileView === 'detail' || mobileView === 'compose' ? 'hidden md:flex' : 'flex'">

                <div class="p-6 border-b border-slate-100 bg-white bg-opacity-70 backdrop-blur-md sticky top-0 z-20">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Inbox</h2>
                        <div class="flex gap-2">
                            {{-- Mark All Read --}}
                            <form
                                action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/notifications/mark-all-as-read/process') }}"
                                method="POST">
                                @csrf
                                <button type="submit" title="Tandai Semua Sudah Baca"
                                    class="p-2.5 bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200 transition">
                                    <i data-lucide="check-check" class="w-5 h-5"></i>
                                </button>
                            </form>
                            @if ($is_admin)
                                <button @click="mobileView = 'compose'; activeMsg = null"
                                    class="p-2.5 bg-ksc-blue text-white rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                                    <i data-lucide="plus" class="w-5 h-5"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="relative">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" x-model="searchQuery" placeholder="Cari pesan..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border-none rounded-xl text-xs font-bold text-slate-900 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto divide-y divide-slate-50 no-scrollbar">
                    <template x-for="msg in filteredMessages" :key="msg.uid">
                        <div @click="selectMessage(msg)"
                            :class="activeMsg && activeMsg.uid === msg.uid ? 'bg-blue-50/50' : 'hover:bg-slate-50'"
                            class="p-5 cursor-pointer transition relative group overflow-hidden">

                            <div x-show="!msg.is_read" class="absolute left-0 top-0 bottom-0 w-1 bg-ksc-blue"></div>

                            <div class="flex justify-between items-start mb-1">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"
                                    :class="!msg.is_read ? 'text-ksc-blue' : ''" x-text="formatDate(msg.created_at)"></span>
                                <div x-show="!msg.is_read"
                                    class="w-2 h-2 bg-ksc-blue rounded-full shadow-lg shadow-blue-200"></div>
                            </div>

                            <div class="flex items-center justify-between gap-2">
                                <h4 class="text-sm font-black text-slate-900 mb-1 truncate tracking-tight flex-1"
                                    :class="!msg.is_read ? 'text-slate-900' : 'text-slate-600'" x-text="msg.judul"></h4>

                                {{-- Quick Actions on Hover --}}
                                <div class="hidden group-hover:flex items-center gap-1">
                                    <button @click.stop="quickRead(msg)" x-show="!msg.is_read"
                                        class="p-1.5 text-blue-600 hover:bg-blue-100 rounded-lg transition"
                                        title="Tandai Sudah Baca">
                                        <i data-lucide="check" class="w-4 h-4"></i>
                                    </button>
                                    <button @click.stop="quickDelete(msg)"
                                        class="p-1.5 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-slate-400 font-medium line-clamp-1" x-text="stripHtml(msg.pesan)"></p>
                        </div>
                    </template>

                    <div x-show="filteredMessages.length === 0" class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="inbox" class="w-8 h-8 text-slate-200"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tidak ada pesan</p>
                    </div>

                    {{-- Delete All Button --}}
                    <div x-show="messages.length > 0" class="p-4 bg-slate-50/50">
                        <button type="button" @click="showDeleteAllModal = true"
                            class="w-full py-3 text-[10px] font-black text-red-600 uppercase tracking-widest hover:bg-red-50 rounded-xl transition flex items-center justify-center gap-2">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            Kosongkan Inbox
                        </button>
                    </div>
                </div>
            </div>

            {{-- Detail & Compose Area --}}
            <div class="flex-1 flex flex-col bg-slate-50/30 overflow-hidden"
                :class="(mobileView === 'list') ? 'hidden md:flex' : 'flex'">

                {{-- Default View --}}
                <div x-show="mobileView === 'list' && !activeMsg"
                    class="flex-1 flex flex-col items-center justify-center p-12 text-slate-300">
                    <div
                        class="w-32 h-32 bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 flex items-center justify-center mb-8 transform rotate-6 hover:rotate-0 transition-transform duration-500">
                        <i data-lucide="mail-open" class="w-12 h-12 text-slate-200"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-400 uppercase tracking-[0.2em]">Pilih pesan untuk dibaca</h3>
                </div>

                {{-- Detail View --}}
                <div x-show="mobileView === 'detail' && activeMsg"
                    class="flex flex-col h-full bg-white shadow-2xl md:m-6 md:rounded-[2.5rem] border border-slate-100 overflow-hidden"
                    x-cloak>
                    <div
                        class="p-4 md:p-6 border-b border-slate-50 flex justify-between items-center bg-white sticky top-0 z-20">
                        <button @click="mobileView = 'list'; activeMsg = null"
                            class="md:hidden w-10 h-10 flex items-center justify-center text-slate-500 hover:bg-slate-50 rounded-xl transition">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        </button>
                        <div class="flex gap-2 ml-auto">
                            <button type="button" @click="quickDelete(activeMsg)"
                                class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto p-8 md:p-12 text-left">
                        <div class="max-w-3xl mx-auto">
                            <div class="mb-10">
                                <span
                                    class="inline-block px-3 py-1 bg-blue-50 text-ksc-blue text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-4">Pesan
                                    Masuk</span>
                                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight tracking-tighter mb-8"
                                    x-text="activeMsg?.judul"></h1>

                                <div class="flex items-center gap-4 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                                    <div class="w-12 h-12 rounded-xl bg-ksc-blue flex items-center justify-center font-black text-white text-lg shadow-lg shadow-blue-200"
                                        x-text="activeMsg?.judul.charAt(0)"></div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 uppercase tracking-tight">System
                                            Administrator</p>
                                        <p class="text-xs text-slate-400 font-bold"
                                            x-text="formatFullDate(activeMsg?.created_at)"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed font-medium"
                                x-html="activeMsg?.pesan"></div>
                        </div>
                    </div>
                </div>

                {{-- Compose View (Admin Only) --}}
                @if ($is_admin)
                    <div x-show="mobileView === 'compose'"
                        class="flex flex-col h-full bg-white shadow-2xl md:m-6 md:rounded-[2.5rem] border border-slate-100 overflow-hidden"
                        x-cloak>
                        <div
                            class="p-4 md:p-6 border-b border-slate-50 flex items-center gap-4 bg-white sticky top-0 z-20">
                            <button @click="mobileView = 'list'"
                                class="w-10 h-10 flex items-center justify-center text-slate-400 hover:bg-slate-50 rounded-xl transition">
                                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            </button>
                            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Kirim Notifikasi Baru
                            </h3>
                        </div>

                        <div class="flex-1 overflow-y-auto p-8 md:p-12">
                            <div class="max-w-2xl mx-auto">
                                <form
                                    action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/notifications/create/process') }}"
                                    method="POST" class="space-y-8">
                                    @csrf

                                    <div x-data="{ target: 'all' }">
                                        <label
                                            class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-1">Target
                                            Penerima</label>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="target_type" value="all" x-model="target"
                                                    class="hidden peer">
                                                <div
                                                    class="p-4 border-2 border-slate-100 rounded-2xl peer-checked:border-ksc-blue peer-checked:bg-blue-50 transition group items-center flex flex-col text-center">
                                                    <i data-lucide="users"
                                                        class="w-6 h-6 mb-2 text-slate-400 group-peer-checked:text-ksc-blue"></i>
                                                    <span
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 peer-checked:text-ksc-blue">Semua</span>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="target_type" value="role" x-model="target"
                                                    class="hidden peer">
                                                <div
                                                    class="p-4 border-2 border-slate-100 rounded-2xl peer-checked:border-ksc-blue peer-checked:bg-blue-50 transition group items-center flex flex-col text-center">
                                                    <i data-lucide="shield"
                                                        class="w-6 h-6 mb-2 text-slate-400 group-peer-checked:text-ksc-blue"></i>
                                                    <span
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 peer-checked:text-ksc-blue">Per
                                                        Role</span>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="target_type" value="specific"
                                                    x-model="target" class="hidden peer">
                                                <div
                                                    class="p-4 border-2 border-slate-100 rounded-2xl peer-checked:border-ksc-blue peer-checked:bg-blue-50 transition group items-center flex flex-col text-center">
                                                    <i data-lucide="user"
                                                        class="w-6 h-6 mb-2 text-slate-400 group-peer-checked:text-ksc-blue"></i>
                                                    <span
                                                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 peer-checked:text-ksc-blue">Pilih
                                                        Orang</span>
                                                </div>
                                            </label>
                                        </div>

                                        <div x-show="target === 'role'" class="space-y-4" x-cloak>
                                            <select name="target_role_uid"
                                                class="w-full bg-slate-50 border border-slate-100 text-sm font-bold rounded-xl p-4 outline-none focus:ring-2 focus:ring-blue-100 transition">
                                                <option value="">Pilih Role Target...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role['uid'] }}">
                                                        {{ strtoupper($role['nama_role']) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div x-show="target === 'specific'" class="space-y-4" x-cloak>
                                            <div
                                                class="max-h-48 overflow-y-auto border border-slate-100 rounded-2xl bg-slate-50 p-4 space-y-2">
                                                @foreach ($users as $u)
                                                    <label
                                                        class="flex items-center gap-3 p-2 hover:bg-white rounded-xl transition cursor-pointer">
                                                        <input type="checkbox" name="target_user_uids[]"
                                                            value="{{ $u['uid'] }}"
                                                            class="rounded text-ksc-blue focus:ring-blue-200">
                                                        <div class="flex flex-col">
                                                            <span
                                                                class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ $u['nama_lengkap'] }}</span>
                                                            <span
                                                                class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $u['email'] }}</span>
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <div>
                                            <label
                                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Subjek
                                                Notifikasi</label>
                                            <input type="text" name="judul" required
                                                placeholder="Contoh: Jadwal Latihan Terbaru"
                                                class="w-full bg-slate-50 border border-slate-100 text-sm font-black rounded-xl p-4 outline-none focus:ring-2 focus:ring-blue-100 transition">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Pesan
                                                Lengkap</label>
                                            <div id="editor" class="bg-slate-50 rounded-xl"></div>
                                            <input type="hidden" name="pesan" id="pesan_input">
                                        </div>
                                    </div>

                                    <div class="pt-6">
                                        <button type="submit"
                                            class="w-full bg-slate-900 hover:bg-black text-white font-black text-[10px] uppercase tracking-[0.3em] rounded-2xl px-6 py-5 shadow-2xl shadow-slate-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                                            <i data-lucide="send" class="w-4 h-4"></i>
                                            Broadcast Notifikasi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Hapus Semua (Flowbite Style) --}}
    <div x-show="showDeleteAllModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity"
        x-cloak>
        <div @click.away="showDeleteAllModal = false"
            class="bg-white rounded-[2rem] p-8 max-w-md w-full shadow-2xl text-center border border-slate-100 transform transition-all">
            <div
                class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner shadow-red-100">
                <i data-lucide="alert-octagon" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-3">Kosongkan Seluruh Inbox?</h3>
            <p class="text-sm text-slate-500 font-medium mb-8 leading-relaxed">Seluruh pesan notifikasi Anda akan dihapus
                secara permanen dari database. Tindakan ini tidak dapat dibatalkan.</p>

            <form
                action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/notifications/delete-all/process') }}"
                method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="showDeleteAllModal = false"
                        class="w-full py-3.5 text-[10px] font-black uppercase tracking-widest text-slate-500 bg-slate-100 rounded-xl hover:bg-slate-200 transition">Batalkan</button>
                    <button type="submit"
                        class="w-full py-3.5 text-[10px] font-black uppercase tracking-widest text-white bg-red-600 rounded-xl shadow-lg shadow-red-100 hover:bg-red-700 transition">Ya,
                        Kosongkan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function notificationSystem() {
            return {
                mobileView: 'list',
                activeMsg: null,
                searchQuery: '',
                messages: [],
                showDeleteAllModal: false,
                quill: null,

                initData(data) {
                    this.messages = data;
                    setTimeout(() => {
                        lucide.createIcons();
                        this.initQuill();
                    }, 100);
                },

                initQuill() {
                    const editorContainer = document.getElementById('editor');
                    if (editorContainer && !this.quill) {
                        this.quill = new Quill('#editor', {
                            theme: 'snow',
                            placeholder: 'Tulis instruksi atau informasi di sini...',
                            modules: {
                                toolbar: [
                                    ['bold', 'italic', 'underline'],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    ['link', 'clean']
                                ]
                            }
                        });


                        const pesanInput = document.getElementById('pesan_input');
                        this.quill.on('text-change', () => {
                            pesanInput.value = this.quill.root.innerHTML;
                        });
                    }
                },

                get filteredMessages() {
                    if (!this.searchQuery) return this.messages;
                    return this.messages.filter(m =>
                        m.judul.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        m.pesan.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                selectMessage(msg) {
                    this.activeMsg = msg;
                    this.mobileView = 'detail';

                    if (!msg.is_read) {
                        this.markAsRead(msg);
                    }
                },

                quickRead(msg) {
                    this.markAsRead(msg);
                },

                quickDelete(msg) {
                    // Langsung hapus (AJAX) tanpa modal kotak sesuai request
                    const url =
                        `{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/notifications/') }}${msg.uid}/delete/process`;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `_token={{ csrf_token() }}`
                    }).then(response => {
                        if (response.ok) {
                            this.messages = this.messages.filter(m => m.uid !== msg.uid);
                            if (this.activeMsg && this.activeMsg.uid === msg.uid) {
                                this.activeMsg = null;
                                this.mobileView = 'list';
                            }
                        }
                    });
                },

                markAsRead(msg) {
                    const url =
                        `{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/notifications/') }}${msg.uid}/edit/process`;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `_token={{ csrf_token() }}`
                    }).then(response => {
                        if (response.ok) {
                            msg.is_read = 1;
                            // Update unread count in Navbar global
                            const badge = document.querySelector('.notification-badge');
                            if (badge) {
                                const current = parseInt(badge.innerText);
                                if (current > 1) badge.innerText = current - 1;
                                else badge.remove();
                            }
                        }
                    });
                },

                formatDate(dateStr) {
                    const date = new Date(dateStr);
                    const now = new Date();
                    const diff = (now - date) / 1000;

                    if (diff < 86400) return date.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    return date.toLocaleDateString([], {
                        day: '2-digit',
                        month: 'short'
                    });
                },

                formatFullDate(dateStr) {
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }).replace(',', ' •') + ' WIB';
                },

                stripHtml(html) {
                    let tmp = document.createElement("DIV");
                    tmp.innerHTML = html;
                    return tmp.textContent || tmp.innerText || "";
                }
            }
        }
    </script>
@endsection
