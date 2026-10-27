<x-app-layout>
    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Hospital & Nurse Welcome Header -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-xs relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-48 h-48 bg-[#dbeeeb]/40 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold tracking-wide uppercase mb-2">
                            <span class="w-2 h-2 rounded-full bg-[#0b6b63] animate-pulse"></span>
                            <span>Ruang Umar Bin Khattab 2 · RSUD Welas Asih</span>
                        </div>
                        <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-[#132628]">
                            Selamat Datang, {{ $user->name }}
                        </h1>
                        <p class="text-xs sm:text-sm text-[#4a6366] mt-1 flex items-center gap-2 flex-wrap">
                            <span class="px-2.5 py-0.5 rounded-lg bg-[#f1f5f4] text-[#0b6b63] font-semibold border border-[#d2dedc]">{{ $user->role }}</span>
                            <span>•</span>
                            <span>{{ $user->room }}</span>
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center gap-3">
                        @if (! $latestPreTest)
                            <a
                                href="{{ route('pre-test.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Mulai Tahap 1: Pre-test</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @elseif (! $latestIntervention)
                            <a
                                href="{{ route('intervention.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Lanjut Tahap 2: Butterfly Hug 🦋</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @elseif (! $latestGame)
                            <a
                                href="{{ route('game.play') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#e8501a] hover:bg-[#d44310] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Lanjut Tahap 3: Main Game Stres 🎮</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @elseif (! $latestThankYou)
                            <a
                                href="{{ route('thank-you.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Lanjut Tahap 4: Kartu Apresiasi 💌</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @elseif (! $latestPostTest)
                            <a
                                href="{{ route('post-test.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Lanjut Tahap 5: Post-test 📝</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @else
                            <a
                                href="{{ route('post-test.result', $latestPostTest->id) }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-sm font-semibold shadow-sm transition active:scale-[0.98]"
                            >
                                <span>Lihat Hasil Evaluasi Lengkap 🏆</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 5 Steps Flow Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-xs">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#d2dedc]">
                    <div>
                        <h2 class="font-display text-lg font-bold text-[#132628]">Alur Program Evaluasi & Relaksasi</h2>
                        <p class="text-xs text-[#4a6366] mt-0.5">Selesaikan setiap tahapan secara berurutan sesuai alur intervensi</p>
                    </div>
                    <span class="text-xs font-mono text-[#0b6b63] font-bold bg-[#dbeeeb] px-3 py-1 rounded-full">
                        @if (! $latestPreTest)
                            Tahap 1: Pre-test Aktif
                        @elseif (! $latestIntervention)
                            Tahap 2: Butterfly Hug Aktif
                        @elseif (! $latestGame)
                            Tahap 3: Game Katarsis Aktif
                        @elseif (! $latestThankYou)
                            Tahap 4: Kartu Apresiasi Aktif
                        @elseif (! $latestPostTest)
                            Tahap 5: Post-test Aktif
                        @else
                            Seluruh Tahap Selesai ✓
                        @endif
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Step 1: Pre-test -->
                    <div class="p-4 rounded-xl border {{ $latestPreTest ? 'border-[#0b6b63]/30 bg-[#f9fbfa]' : 'border-[#0b6b63] bg-[#dbeeeb]/20 ring-2 ring-[#0b6b63]/20' }} relative">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-full {{ $latestPreTest ? 'bg-[#dbeeeb] text-[#0b6b63]' : 'bg-[#0b6b63] text-white animate-pulse' }} text-xs font-bold flex items-center justify-center">
                                {{ $latestPreTest ? '✓' : '1' }}
                            </span>
                            <span class="text-[10px] font-mono font-bold text-[#0b6b63] uppercase">
                                {{ $latestPreTest ? 'Selesai' : 'Aktif' }}
                            </span>
                        </div>
                        <h3 class="font-bold text-xs text-[#132628]">1. Kuesioner Awal</h3>
                        @if ($latestPreTest)
                            <p class="text-[11px] text-[#0b6b63] font-semibold mt-1">Skor: {{ $latestPreTest->percentage }}% ({{ $latestPreTest->category }})</p>
                            <a href="{{ route('pre-test.result', $latestPreTest->id) }}" class="text-[11px] text-[#0b6b63] underline font-bold mt-1.5 block">Lihat Hasil &rarr;</a>
                        @else
                            <p class="text-[11px] text-[#4a6366] mt-1">22 Butir instrumen MBI paten untuk mengukur skor awal.</p>
                            <a href="{{ route('pre-test.create') }}" class="text-[11px] text-[#0b6b63] font-bold mt-1.5 block hover:underline">Mulai Sekarang &rarr;</a>
                        @endif
                    </div>

                    <!-- Step 2: Intervensi Butterfly Hug -->
                    <div class="p-4 rounded-xl border {{ $latestIntervention ? 'border-[#0b6b63]/30 bg-[#f9fbfa]' : ($latestPreTest ? 'border-[#0b6b63] bg-[#dbeeeb]/20 ring-2 ring-[#0b6b63]/20' : 'border-[#d2dedc] bg-[#f1f5f4]/50 opacity-60') }} relative">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-full {{ $latestIntervention ? 'bg-[#dbeeeb] text-[#0b6b63]' : ($latestPreTest ? 'bg-[#0b6b63] text-white animate-pulse' : 'bg-white border border-[#d2dedc] text-[#4a6366]') }} text-xs font-bold flex items-center justify-center">
                                {{ $latestIntervention ? '✓' : '2' }}
                            </span>
                            <span class="text-[10px] font-mono font-bold {{ $latestIntervention ? 'text-[#0b6b63]' : ($latestPreTest ? 'text-[#0b6b63]' : 'text-[#4a6366]') }} uppercase">
                                {{ $latestIntervention ? 'Selesai' : ($latestPreTest ? 'Aktif' : 'Menunggu') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-xs text-[#132628]">2. Intervensi Relaksasi</h3>
                        @if ($latestIntervention)
                            <p class="text-[11px] text-[#0b6b63] font-semibold mt-1">
                                Ketegangan: {{ $latestIntervention->tension_before }} &rarr; {{ $latestIntervention->tension_after }}
                                @if ($latestIntervention->tension_diff > 0)
                                    <span class="text-emerald-600 font-bold">(-{{ $latestIntervention->tension_diff }})</span>
                                @endif
                            </p>
                            <a href="{{ route('intervention.create') }}" class="text-[11px] text-[#4a6366] underline mt-1.5 block hover:text-[#132628]">Sesi Ulang &rarr;</a>
                        @elseif ($latestPreTest)
                            <p class="text-[11px] text-[#4a6366] mt-1">Stimulasi bilateral Butterfly Hug 1–3 menit.</p>
                            <a href="{{ route('intervention.create') }}" class="text-[11px] text-[#0b6b63] font-bold mt-1.5 block hover:underline">Mulai Relaksasi &rarr;</a>
                        @else
                            <p class="text-[11px] text-[#4a6366] mt-1">Terbuka setelah kuesioner awal selesai.</p>
                        @endif
                    </div>

                    <!-- Step 3: Mini Game -->
                    <div class="p-4 rounded-xl border {{ $latestGame ? 'border-[#0b6b63]/30 bg-[#f9fbfa]' : ($latestIntervention ? 'border-[#0b6b63] bg-[#dbeeeb]/20 ring-2 ring-[#0b6b63]/20' : 'border-[#d2dedc] bg-[#f1f5f4]/50 opacity-60') }} relative">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-full {{ $latestGame ? 'bg-[#dbeeeb] text-[#0b6b63]' : ($latestIntervention ? 'bg-[#0b6b63] text-white animate-pulse' : 'bg-white border border-[#d2dedc] text-[#4a6366]') }} text-xs font-bold flex items-center justify-center">
                                {{ $latestGame ? '✓' : '3' }}
                            </span>
                            <span class="text-[10px] font-mono font-bold {{ $latestGame ? 'text-[#0b6b63]' : ($latestIntervention ? 'text-[#0b6b63]' : 'text-[#4a6366]') }} uppercase">
                                {{ $latestGame ? 'Selesai' : ($latestIntervention ? 'Aktif' : 'Menunggu') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-xs text-[#132628]">3. Aktivitas Game</h3>
                        @if ($latestGame)
                            <p class="text-[11px] text-[#e8501a] font-bold mt-1">Skor: {{ number_format($latestGame->score) }} Poin</p>
                            <a href="{{ route('game.play') }}" class="text-[11px] text-[#4a6366] underline mt-1.5 block hover:text-[#132628]">Main Ulang &rarr;</a>
                        @elseif ($latestIntervention)
                            <p class="text-[11px] text-[#4a6366] mt-1">Mini game "Hancurkan Stres" selama 30–60 detik.</p>
                            <a href="{{ route('game.play') }}" class="text-[11px] text-[#0b6b63] font-bold mt-1.5 block hover:underline">Buka Game &rarr;</a>
                        @else
                            <p class="text-[11px] text-[#4a6366] mt-1">Terbuka setelah intervensi relaksasi selesai.</p>
                        @endif
                    </div>

                    <!-- Step 4: Kartu Terima Kasih -->
                    <div class="p-4 rounded-xl border {{ $latestThankYou ? 'border-[#0b6b63]/30 bg-[#f9fbfa]' : ($latestGame ? 'border-[#0b6b63] bg-[#dbeeeb]/20 ring-2 ring-[#0b6b63]/20' : 'border-[#d2dedc] bg-[#f1f5f4]/50 opacity-60') }} relative">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-full {{ $latestThankYou ? 'bg-[#dbeeeb] text-[#0b6b63]' : ($latestGame ? 'bg-[#0b6b63] text-white animate-pulse' : 'bg-white border border-[#d2dedc] text-[#4a6366]') }} text-xs font-bold flex items-center justify-center">
                                {{ $latestThankYou ? '✓' : '4' }}
                            </span>
                            <span class="text-[10px] font-mono font-bold {{ $latestThankYou ? 'text-[#0b6b63]' : ($latestGame ? 'text-[#0b6b63]' : 'text-[#4a6366]') }} uppercase">
                                {{ $latestThankYou ? 'Selesai' : ($latestGame ? 'Aktif' : 'Menunggu') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-xs text-[#132628]">4. Kartu Terima Kasih</h3>
                        @if ($latestThankYou)
                            <p class="text-[11px] text-[#0b6b63] font-semibold mt-1 truncate" title="{{ $latestThankYou->recipient_name }}: {{ $latestThankYou->message }}">
                                Untuk: {{ $latestThankYou->recipient_name }}
                            </p>
                            <a href="{{ route('thank-you.create') }}" class="text-[11px] text-[#4a6366] underline mt-1.5 block hover:text-[#132628]">Tulis Lagi &rarr;</a>
                        @elseif ($latestGame)
                            <p class="text-[11px] text-[#4a6366] mt-1">Kirim pesan apresiasi singkat untuk rekan sejawat.</p>
                            <a href="{{ route('thank-you.create') }}" class="text-[11px] text-[#0b6b63] font-bold mt-1.5 block hover:underline">Tulis Kartu &rarr;</a>
                        @else
                            <p class="text-[11px] text-[#4a6366] mt-1">Terbuka setelah aktivitas game selesai.</p>
                        @endif
                    </div>

                    <!-- Step 5: Post-test & Evaluasi -->
                    <div class="p-4 rounded-xl border {{ $latestPostTest ? 'border-[#0b6b63]/30 bg-[#f9fbfa]' : ($latestThankYou ? 'border-[#0b6b63] bg-[#dbeeeb]/20 ring-2 ring-[#0b6b63]/20' : 'border-[#d2dedc] bg-[#f1f5f4]/50 opacity-60') }} relative">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-full {{ $latestPostTest ? 'bg-[#dbeeeb] text-[#0b6b63]' : ($latestThankYou ? 'bg-[#0b6b63] text-white animate-pulse' : 'bg-white border border-[#d2dedc] text-[#4a6366]') }} text-xs font-bold flex items-center justify-center">
                                {{ $latestPostTest ? '✓' : '5' }}
                            </span>
                            <span class="text-[10px] font-mono font-bold {{ $latestPostTest ? 'text-[#0b6b63]' : ($latestThankYou ? 'text-[#0b6b63]' : 'text-[#4a6366]') }} uppercase">
                                {{ $latestPostTest ? 'Selesai' : ($latestThankYou ? 'Aktif' : 'Menunggu') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-xs text-[#132628]">5. Kuesioner Akhir</h3>
                        @if ($latestPostTest)
                            <p class="text-[11px] text-[#0b6b63] font-semibold mt-1">Skor: {{ $latestPostTest->percentage }}% ({{ $latestPostTest->category }})</p>
                            <a href="{{ route('post-test.result', $latestPostTest->id) }}" class="text-[11px] text-[#0b6b63] underline font-bold mt-1.5 block">Lihat Komparasi &rarr;</a>
                        @elseif ($latestThankYou)
                            <p class="text-[11px] text-[#4a6366] mt-1">Evaluasi perubahan perasaan setelah intervensi.</p>
                            <a href="{{ route('post-test.create') }}" class="text-[11px] text-[#0b6b63] font-bold mt-1.5 block hover:underline">Mulai Post-Test &rarr;</a>
                        @else
                            <p class="text-[11px] text-[#4a6366] mt-1">Terbuka setelah mengirim kartu apresiasi.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Room Context Overview (From Jaga Perawat UBK 2.html) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs uppercase font-mono tracking-wider text-[#4a6366] block mb-1">Rasio Tenaga</span>
                    <div class="font-mono text-2xl font-bold text-[#132628]">1 : 8–10</div>
                    <p class="text-xs text-[#4a6366] mt-1">Rasio perawat dibanding pasien yang tercatat saat dinas.</p>
                </div>
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs uppercase font-mono tracking-wider text-[#4a6366] block mb-1">Kebutuhan Gillies</span>
                    <div class="font-mono text-2xl font-bold text-[#0b6b63]">31 vs 26</div>
                    <p class="text-xs text-[#4a6366] mt-1">Kebutuhan perawat metode Gillies dibanding tenaga tersedia.</p>
                </div>
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs uppercase font-mono tracking-wider text-[#4a6366] block mb-1">Prinsip Intervensi</span>
                    <div class="font-mono text-base font-bold text-[#132628]">Tanpa Beban Tambahan</div>
                    <p class="text-xs text-[#4a6366] mt-1">Menempel pada rutinitas yang ada, tanpa sesi baru yang memberatkan.</p>
                </div>
            </div>

            <!-- Discreet Researcher Footer Link -->
            <!-- <div class="text-center pt-2 pb-4">
                <a
                    href="{{ route('admin.rekap') }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#f1f5f4] hover:bg-[#dbeeeb] border border-[#d2dedc] text-[11px] font-mono text-[#4a6366] hover:text-[#0b6b63] transition"
                    title="Akses khusus peneliti untuk rekap data dan ekspor SPSS / Excel"
                >
                    <span>🔒 Khusus Peneliti: Portal Rekap Data & Unduh SPSS / Excel &rarr;</span>
                </a>
            </div> -->

        </div>
    </div>
</x-app-layout>
