@php
    $receivedMessagesData = [];
    $unreadInboxCount = 0;
    if (Auth::check() && Auth::user()->role !== 'Kepala Ruangan') {
        $unreadInboxCount = Auth::user()->receivedThankYouCards()->where('is_read', false)->count();
        $receivedMessagesData = Auth::user()->receivedThankYouCards()
            ->with('user')
            ->latest()
            ->take(30)
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'sender_id' => $msg->user_id,
                    'sender_name' => $msg->user->name ?? $msg->recipient_name ?? 'Rekan Perawat',
                    'sender_role' => $msg->user->role ?? 'Perawat Pelaksana',
                    'sender_initial' => strtoupper(substr($msg->user->name ?? $msg->recipient_name ?? 'R', 0, 1)),
                    'message' => $msg->message,
                    'is_read' => (bool) $msg->is_read,
                    'created_at_human' => $msg->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i'),
                    'created_at_diff' => $msg->created_at->setTimezone('Asia/Jakarta')->diffForHumans(),
                ];
            })->values()->all();
    }
@endphp

<nav
    x-data="{
        open: false,
        showInboxDropdown: false,
        showDetailModal: false,
        messages: {{ Js::from($receivedMessagesData) }},
        unreadCount: {{ $unreadInboxCount }},
        activeMessage: null,
        replyTemplate: '',
        replyMessage: '',
        replyStatus: '',
        replyError: '',
        isReplying: false,

        openMessage(msg) {
            this.activeMessage = msg;
            this.showInboxDropdown = false;
            this.showDetailModal = true;
            this.replyTemplate = '';
            this.replyMessage = '';
            this.replyStatus = '';
            this.replyError = '';

            // Jika pesan belum dibaca, tandai telah dibaca dan kurangi badge counter
            if (!msg.is_read) {
                msg.is_read = true;
                if (this.unreadCount > 0) this.unreadCount--;
                fetch(`/thank-you/${msg.id}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).catch(e => console.error(e));
            }
        },

        applyReplyTemplate() {
            if (this.replyTemplate) {
                this.replyMessage = this.replyTemplate;
            }
        },

        sendReply() {
            if (!this.replyMessage.trim() || !this.activeMessage) return;
            this.isReplying = true;
            this.replyStatus = '';
            this.replyError = '';

            fetch('{{ route('thank-you.reply') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    recipient_id: this.activeMessage.sender_id,
                    message: this.replyMessage.trim()
                })
            })
            .then(res => res.json())
            .then(data => {
                this.isReplying = false;
                if (data.success) {
                    this.replyStatus = 'success';
                    setTimeout(() => {
                        this.showDetailModal = false;
                        this.replyStatus = '';
                        this.replyMessage = '';
                        this.replyTemplate = '';
                    }, 1800);
                } else {
                    this.replyStatus = 'error';
                    this.replyError = data.message || 'Gagal mengirim pesan balasan.';
                }
            })
            .catch(err => {
                this.isReplying = false;
                this.replyStatus = 'error';
                this.replyError = 'Terjadi gangguan koneksi jaringan.';
            });
        },

        markAllAsRead() {
            fetch('{{ route('thank-you.mark-as-read') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(() => {
                this.unreadCount = 0;
                this.messages.forEach(m => m.is_read = true);
            });
        }
    }"
    class="bg-white border-b border-[#d2dedc] sticky top-0 z-30"
>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-4">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo_welas_asih.png') }}" alt="Logo RSUD Welas Asih" class="w-10 h-10 object-contain shrink-0">
                        <div>
                            <span class="font-display font-bold text-base text-[#132628] leading-tight block">Nurse Recharge</span>
                            <span class="text-[11px] text-[#0b6b63] font-medium tracking-wide block uppercase font-mono">UBK 2 · RSUD Welas Asih</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-6 sm:flex">
                    @auth
                        @if (Auth::user()->role === 'Kepala Ruangan')
                            <x-nav-link :href="route('admin.rekap')" :active="request()->routeIs('admin.rekap*')" class="text-sm font-semibold text-[#132628]">
                                📊 {{ __('Monitoring Ruangan') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-semibold text-[#132628]">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings & Messages on Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Kotak Pesan / Inbox Dropdown Popover (Khusus Perawat) -->
                    @if (Auth::user()->role !== 'Kepala Ruangan')
                        <div class="relative me-3" @click.outside="showInboxDropdown = false">
                            <!-- Tombol Ikon Amplop -->
                            <button
                                type="button"
                                @click="showInboxDropdown = !showInboxDropdown"
                                class="relative p-2 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] hover:bg-[#f1f5f4] text-[#132628] focus:outline-none transition cursor-pointer"
                                title="Kotak Pesan Apresiasi Rekan"
                            >
                                <svg class="w-5 h-5 text-[#0b6b63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>

                                <!-- Badge Notifikasi Jumlah Pesan Belum Dibaca -->
                                <span
                                    x-show="unreadCount > 0"
                                    x-text="unreadCount"
                                    style="display: none;"
                                    class="absolute -top-1.5 -right-1.5 bg-[#e11d48] text-white text-[10px] font-bold rounded-full h-5 min-w-[20px] px-1 flex items-center justify-center border-2 border-white shadow-xs animate-pulse"
                                ></span>
                            </button>

                            <!-- Dropdown Popover Pesan Masuk -->
                            <div
                                x-show="showInboxDropdown"
                                x-cloak
                                style="display: none;"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                                class="absolute right-0 mt-2 w-80 sm:w-96 rounded-2xl bg-white shadow-2xl border border-[#d2dedc] overflow-hidden z-50 text-left"
                            >
                                <!-- Header Dropdown -->
                                <div class="px-4 py-3 bg-[#f9fbfa] border-b border-[#d2dedc] flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base">💌</span>
                                        <div>
                                            <h4 class="font-display font-bold text-xs text-[#132628]">Pesan Apresiasi Rekan</h4>
                                            <p class="text-[10px] text-[#4a6366] font-mono">
                                                <span x-text="unreadCount"></span> belum dibaca
                                            </p>
                                        </div>
                                    </div>
                                    <template x-if="unreadCount > 0">
                                        <button
                                            type="button"
                                            @click="markAllAsRead()"
                                            class="text-[10px] text-[#0b6b63] font-bold hover:underline cursor-pointer"
                                        >
                                            Tandai semua dibaca
                                        </button>
                                    </template>
                                </div>

                                <!-- List Pesan Masuk -->
                                <div class="max-h-80 overflow-y-auto divide-y divide-[#eef3f2]">
                                    <template x-if="messages.length === 0">
                                        <div class="py-8 text-center text-[#4a6366] space-y-1">
                                            <div class="text-2xl opacity-60">📭</div>
                                            <p class="text-xs font-semibold text-[#132628]">Belum ada pesan masuk</p>
                                            <p class="text-[10px] text-[#9db4b2]">Pesan dari rekan perawat UBK 2 akan muncul di sini</p>
                                        </div>
                                    </template>

                                    <template x-for="msg in messages" :key="msg.id">
                                        <div
                                            @click="openMessage(msg)"
                                            class="p-3.5 transition cursor-pointer flex items-start gap-3 relative"
                                            :class="!msg.is_read ? 'bg-[#f0fdf4] hover:bg-[#e6f7ec]' : 'bg-white hover:bg-[#f9fbfa]'"
                                        >
                                            <!-- Indikator Unread Bar Hijau -->
                                            <template x-if="!msg.is_read">
                                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#0b6b63]"></div>
                                            </template>

                                            <!-- Avatar Inisial -->
                                            <div
                                                class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0 mt-0.5"
                                                :class="!msg.is_read ? 'bg-[#0b6b63] text-white shadow-xs' : 'bg-[#dbeeeb] text-[#0b6b63]'"
                                                x-text="msg.sender_initial"
                                            ></div>

                                            <!-- Info Ringkas Pengirim & Pesan -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between gap-1 mb-0.5">
                                                    <span
                                                        class="text-xs truncate block"
                                                        :class="!msg.is_read ? 'font-bold text-[#132628]' : 'font-medium text-[#4a6366]'"
                                                        x-text="msg.sender_name"
                                                    ></span>
                                                    <span class="text-[9px] text-[#9db4b2] font-mono shrink-0" x-text="msg.created_at_diff"></span>
                                                </div>
                                                <p
                                                    class="text-[11px] truncate"
                                                    :class="!msg.is_read ? 'text-[#132628] font-medium' : 'text-[#4a6366]'"
                                                    x-text="msg.message"
                                                ></p>
                                            </div>

                                            <!-- Badge Titik Baru -->
                                            <template x-if="!msg.is_read">
                                                <span class="inline-block w-2 h-2 rounded-full bg-[#0b6b63] shrink-0 mt-1.5" title="Belum dibaca"></span>
                                            </template>
                                        </div>
                                    </template>
                                </div>

                                <!-- Footer Dropdown -->
                                <div class="p-2.5 bg-[#f9fbfa] border-t border-[#d2dedc] text-center text-[10px] text-[#4a6366]">
                                    Klik pesan untuk membaca rincian &amp; membalas 💬
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- User Account Dropdown (SS 3) -->
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-[#d2dedc] rounded-xl text-sm font-medium text-[#132628] bg-[#f9fbfa] hover:bg-[#f1f5f4] focus:outline-none transition cursor-pointer">
                                <div class="w-7 h-7 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left">
                                    <div class="text-xs font-semibold text-[#132628] leading-none">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] text-[#0b6b63] font-mono leading-tight">{{ Auth::user()->role }}</div>
                                </div>

                                <div class="ms-1 text-[#4a6366]">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profile Link -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Update Password Link (SS 3) -->
                            <x-dropdown-link :href="route('password.edit')">
                                {{ __('Update Password') }}
                            </x-dropdown-link>

                            <!-- Authentication Log Out -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger Button for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[#4a6366] hover:text-[#132628] hover:bg-[#f1f5f4] focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-[#d2dedc]">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->role === 'Kepala Ruangan')
                    <x-responsive-nav-link :href="route('admin.rekap')" :active="request()->routeIs('admin.rekap*')">
                        📊 {{ __('Monitoring Ruangan') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-[#d2dedc]">
            @auth
                <div class="px-4 mb-3">
                    <div class="font-bold text-sm text-[#132628]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-[#0b6b63] font-mono">{{ Auth::user()->role }}</div>
                </div>

                <div class="space-y-1">
                    @if (Auth::user()->role !== 'Kepala Ruangan')
                        <button
                            type="button"
                            @click="showInboxDropdown = !showInboxDropdown; open = false;"
                            class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-[#132628] hover:bg-gray-50"
                        >
                            <span>💌 Kotak Pesan Masuk</span>
                            <span x-show="unreadCount > 0" x-text="unreadCount + ' Baru'" class="text-xs bg-[#e11d48] text-white px-2 py-0.5 rounded-full font-bold"></span>
                        </button>
                    @endif

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('password.edit')">
                        {{ __('Update Password') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <!-- Modal Detail Pesan & Balas (Reply Modal) -->
    @auth
        @if (Auth::user()->role !== 'Kepala Ruangan')
            <div
                x-show="showDetailModal"
                x-cloak
                style="display: none;"
                @keydown.escape.window="showDetailModal = false"
                class="fixed inset-0 z-50 overflow-y-auto"
                aria-labelledby="modal-detail-title"
                role="dialog"
                aria-modal="true"
            >
                <!-- Backdrop Blur -->
                <div
                    class="fixed inset-0 bg-black/50 backdrop-blur-xs transition-opacity"
                    @click="showDetailModal = false"
                ></div>

                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div
                        @click.stop
                        x-show="showDetailModal"
                        x-transition
                        class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-[#d2dedc]"
                    >
                        <!-- Modal Header -->
                        <div class="bg-gradient-to-r from-[#0b6b63] to-[#08524c] px-6 py-4 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="text-xl">💌</span>
                                <div>
                                    <h3 class="font-display font-bold text-base leading-tight" id="modal-detail-title">Detail Pesan Apresiasi</h3>
                                    <p class="text-[11px] text-white/80 font-mono">Ruang Umar Bin Khattab 2 · RSUD Welas Asih</p>
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="showDetailModal = false"
                                class="rounded-xl p-1 text-white/70 hover:text-white hover:bg-white/10 transition cursor-pointer"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <template x-if="activeMessage">
                            <div class="p-6 space-y-5">
                                <!-- Info Pengirim -->
                                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc]">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-[#0b6b63] text-white font-bold text-sm flex items-center justify-center shadow-xs shrink-0"
                                            x-text="activeMessage.sender_initial"
                                        ></div>
                                        <div>
                                            <strong class="text-xs sm:text-sm text-[#132628] block" x-text="activeMessage.sender_name"></strong>
                                            <span class="text-[10px] text-[#0b6b63] font-mono block" x-text="activeMessage.sender_role"></span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] text-[#4a6366] font-mono block" x-text="activeMessage.created_at_human"></span>
                                        <span class="text-[9px] text-[#0b6b63] font-mono font-bold" x-text="activeMessage.created_at_diff"></span>
                                    </div>
                                </div>

                                <!-- Balon Teks Pesan Lengkap -->
                                <div class="relative p-5 rounded-2xl bg-[#f0fdf4] border-2 border-[#b2ded8] text-xs sm:text-sm text-[#06302a] italic font-serif leading-relaxed shadow-xs">
                                    <span class="text-xl text-[#0b6b63] opacity-40 font-mono block mb-1">“</span>
                                    <p class="pl-2" x-text="activeMessage.message"></p>
                                    <span class="text-xl text-[#0b6b63] opacity-40 font-mono block text-right mt-1">”</span>
                                </div>

                                <!-- Bagian Balas Pesan (Reply) -->
                                <div class="pt-3 border-t border-[#d2dedc] space-y-3">
                                    <div class="flex items-center justify-between">
                                        <label class="text-xs font-bold text-[#132628] flex items-center gap-1.5">
                                            <span>💬</span>
                                            <span>Balas Pesan ke <strong class="text-[#0b6b63]" x-text="activeMessage.sender_name"></strong>:</span>
                                        </label>
                                        <span class="text-[10px] text-[#4a6366] font-mono" x-text="replyMessage.length + '/500'"></span>
                                    </div>

                                    <!-- Dropdown Template Balasan -->
                                    <div>
                                        <label class="block text-[11px] font-medium text-[#4a6366] mb-1">
                                            Pilih Template Pesan Singkat (Opsional):
                                        </label>
                                        <select
                                            x-model="replyTemplate"
                                            @change="applyReplyTemplate()"
                                            class="w-full text-xs rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-[#132628] p-2.5 focus:border-[#0b6b63] focus:ring-1 focus:ring-[#0b6b63]"
                                        >
                                            <option value="">-- Pilih template balasan cepat --</option>
                                            <option value="Sama-sama, senang bisa saling bantu dan jaga shift bareng!">Sama-sama, senang bisa saling bantu dan jaga shift bareng!</option>
                                            <option value="Terima kasih kembali, tetap semangat dan jaga kesehatan ya!">Terima kasih kembali, tetap semangat dan jaga kesehatan ya!</option>
                                            <option value="Terima kasih sudah kompak dan saling dukung selama shift.">Terima kasih sudah kompak dan saling dukung selama shift.</option>
                                            <option value="Terima kasih sudah tenang dan sabar menghadapi pasien tadi.">Terima kasih sudah tenang dan sabar menghadapi pasien tadi.</option>
                                            <option value="Terima kasih sudah mengingatkan saya untuk minum dan istirahat.">Terima kasih sudah mengingatkan saya untuk minum dan istirahat.</option>
                                            <option value="Kerja kamu hari ini juga sangat luar biasa bagi pasien kita!">Kerja kamu hari ini juga sangat luar biasa bagi pasien kita!</option>
                                        </select>
                                    </div>

                                    <!-- Kolom Input Teks Balasan -->
                                    <div>
                                        <textarea
                                            x-model="replyMessage"
                                            rows="3"
                                            maxlength="500"
                                            placeholder="Ketik pesan balasan apresiasi Anda atau pilih template di atas..."
                                            class="w-full text-xs rounded-xl border border-[#d2dedc] bg-white text-[#132628] p-3 focus:border-[#0b6b63] focus:ring-1 focus:ring-[#0b6b63] placeholder-[#9db4b2]"
                                        ></textarea>
                                    </div>

                                    <!-- Status Notifikasi Sukses / Error -->
                                    <template x-if="replyStatus === 'success'">
                                        <div class="p-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-xs flex items-center gap-2">
                                            <span class="text-base">✅</span>
                                            <span>Pesan balasan berhasil terkirim sebagai pesan baru ke kotak masuk rekan!</span>
                                        </div>
                                    </template>

                                    <template x-if="replyStatus === 'error'">
                                        <div class="p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-center gap-2">
                                            <span class="text-base">⚠️</span>
                                            <span x-text="replyError || 'Gagal mengirim pesan balasan.'"></span>
                                        </div>
                                    </template>

                                    <!-- Tombol Aksi Modal -->
                                    <div class="flex items-center justify-between pt-2">
                                        <button
                                            type="button"
                                            @click="showDetailModal = false"
                                            class="px-4 py-2.5 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f9fbfa] text-xs font-semibold text-[#132628] transition cursor-pointer"
                                        >
                                            Tutup
                                        </button>
                                        <button
                                            type="button"
                                            @click="sendReply()"
                                            :disabled="!replyMessage.trim() || isReplying"
                                            :class="(!replyMessage.trim() || isReplying) ? 'opacity-50 cursor-not-allowed bg-[#0b6b63]' : 'bg-[#0b6b63] hover:bg-[#08524c] active:scale-[0.98]'"
                                            class="px-6 py-2.5 rounded-xl text-white text-xs font-bold shadow-md transition inline-flex items-center gap-1.5 cursor-pointer"
                                        >
                                            <span x-show="!isReplying">Kirim Balasan 💌</span>
                                            <span x-show="isReplying">Mengirim balasan...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        @endif
    @endauth
</nav>
