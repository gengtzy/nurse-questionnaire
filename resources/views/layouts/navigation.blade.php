<nav x-data="{ open: false, showInboxModal: false, unreadCount: {{ Auth::check() ? Auth::user()->receivedThankYouCards()->where('is_read', false)->count() : 0 }} }" class="bg-white border-b border-[#d2dedc] sticky top-0 z-30">
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
                    <!-- Kotak Pesan / Inbox Apresiasi Button (SS 4: Khusus Perawat) -->
                    @if (Auth::user()->role !== 'Kepala Ruangan')
                        <button
                            type="button"
                            @click="showInboxModal = true"
                            class="relative p-2 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] hover:bg-[#f1f5f4] text-[#132628] focus:outline-none transition me-3 cursor-pointer"
                            title="Kotak Pesan Apresiasi Rekan"
                        >
                            <!-- Envelope SVG Icon -->
                            <svg class="w-5 h-5 text-[#0b6b63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>

                            <!-- Badge Notifikasi Pesan Belum Dibaca -->
                            <span
                                x-show="unreadCount > 0"
                                x-text="unreadCount"
                                class="absolute -top-1.5 -right-1.5 bg-[#e11d48] text-white text-[10px] font-bold rounded-full h-5 min-w-[20px] px-1 flex items-center justify-center border-2 border-white shadow-xs animate-pulse"
                            ></span>
                        </button>
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

                            <!-- Update Password Link (Added Below Profile per SS 3) -->
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
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-[#0b6b63] hover:underline">
                        Masuk &rarr;
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button for Mobile -->
            <div class="-me-2 flex items-center sm:hidden gap-2">
                @auth
                    @if (Auth::user()->role !== 'Kepala Ruangan')
                        <button
                            type="button"
                            @click="showInboxModal = true"
                            class="relative p-2 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-[#132628]"
                            title="Kotak Pesan Apresiasi"
                        >
                            <svg class="w-5 h-5 text-[#0b6b63]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span
                                x-show="unreadCount > 0"
                                x-text="unreadCount"
                                class="absolute -top-1 -right-1 bg-[#e11d48] text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center border border-white"
                            ></span>
                        </button>
                    @endif
                @endauth

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
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
                            @click="showInboxModal = true; open = false;"
                            class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-[#132628] hover:bg-gray-50"
                        >
                            <span>💌 Kotak Pesan Apresiasi</span>
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
            @else
                <div class="px-4 py-2">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-[#0b6b63]">Masuk Perawat &rarr;</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Modal Kotak Pesan Apresiasi Rekan (SS 4) -->
    @auth
        @if (Auth::user()->role !== 'Kepala Ruangan')
            <div
                x-show="showInboxModal"
                x-cloak
                style="display: none;"
                @keydown.escape.window="showInboxModal = false"
                class="fixed inset-0 z-50 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
            >
                <!-- Backdrop with blur -->
                <div
                    class="fixed inset-0 bg-black/50 backdrop-blur-xs transition-opacity"
                    @click="showInboxModal = false"
                ></div>

                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div
                        @click.stop
                        x-show="showInboxModal"
                        x-transition
                        class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-[#d2dedc]"
                    >
                        <!-- Modal Header -->
                        <div class="bg-gradient-to-r from-[#0b6b63] to-[#08524c] px-6 py-4 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="text-xl">💌</span>
                                <div>
                                    <h3 class="font-display font-bold text-base leading-tight">Kotak Pesan Apresiasi Rekan</h3>
                                    <p class="text-[11px] text-white/80 font-mono">Ruang Umar Bin Khattab 2 · RSUD Welas Asih</p>
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="showInboxModal = false"
                                class="rounded-xl p-1 text-white/70 hover:text-white hover:bg-white/10 transition cursor-pointer"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Modal Body (Message List) -->
                        <div class="p-6 max-h-[60vh] overflow-y-auto space-y-3">
                            @php
                                $receivedMessages = Auth::user()->receivedThankYouCards()->with('user')->latest()->get();
                            @endphp

                            @forelse ($receivedMessages as $msg)
                                <div class="p-4 rounded-2xl border {{ $msg->is_read ? 'border-[#d2dedc] bg-[#f9fbfa]' : 'border-[#0b6b63] bg-[#dbeeeb]/30 shadow-xs' }} space-y-2">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-[#0b6b63] text-white font-bold text-xs flex items-center justify-center shrink-0">
                                                {{ strtoupper(substr($msg->user->name ?? 'R', 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="text-xs text-[#132628] block">{{ $msg->user->name ?? $msg->recipient_name }}</strong>
                                                <span class="text-[10px] text-[#0b6b63] font-mono">{{ $msg->user->role ?? 'Perawat Pelaksana' }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] text-[#4a6366] font-mono block">{{ $msg->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}</span>
                                            @if (!$msg->is_read)
                                                <span class="inline-block text-[9px] font-bold uppercase tracking-wider text-white bg-[#0b6b63] px-2 py-0.5 rounded-full">Baru</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="p-3 bg-white rounded-xl border border-[#d2dedc] text-xs text-[#132628] italic font-serif leading-relaxed">
                                        “{{ $msg->message }}”
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-[#4a6366] space-y-2">
                                    <div class="text-3xl opacity-60">📭</div>
                                    <p class="text-xs font-semibold text-[#132628]">Belum ada pesan apresiasi yang masuk.</p>
                                    <p class="text-[11px] text-[#9db4b2]">Pesan dari rekan perawat UBK 2 akan muncul di sini saat rekan mengirimkan apresiasi.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-[#f1f5f4] px-6 py-3.5 flex items-center justify-between border-t border-[#d2dedc]">
                            @if ($receivedMessages->where('is_read', false)->count() > 0)
                                <button
                                    type="button"
                                    @click="fetch('{{ route('thank-you.mark-as-read') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' } }).then(() => { unreadCount = 0; });"
                                    class="text-xs text-[#0b6b63] hover:underline font-bold cursor-pointer"
                                >
                                    ✓ Tandai semua sudah dibaca
                                </button>
                            @else
                                <span class="text-[11px] text-[#4a6366]">Semua pesan telah dibaca</span>
                            @endif
                            <button
                                type="button"
                                @click="showInboxModal = false"
                                class="px-4 py-2 rounded-xl bg-white border border-[#d2dedc] text-xs font-semibold text-[#132628] hover:bg-[#f9fbfa] transition cursor-pointer"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
</nav>
