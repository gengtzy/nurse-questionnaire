<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 5 Steps Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#0b6b63] uppercase tracking-wider font-mono">Tahap 2: Intervensi Relaksasi Butterfly Hug (Burnout Sedang)</span>
                    <span class="text-[#4a6366] font-mono">Langkah 2 dari 5</span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63] animate-pulse"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                </div>
                <div class="flex justify-between text-[11px] text-[#4a6366] mt-2 font-medium overflow-x-auto gap-2">
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 1. Pre-Test</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">★ 2. Butterfly Hug</span>
                    <span class="shrink-0">3. Game Katarsis</span>
                    <span class="shrink-0">4. Kirim Pesan</span>
                    <span class="shrink-0">5. Post-Test</span>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs relative overflow-hidden">
                <div class="space-y-2.5 max-w-2xl">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold uppercase tracking-wide border border-[#b2ded8]">
                        <span>🦋 Stimulasi Bilateral Terpadu</span>
                    </div>
                    <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-[#132628]">
                        Panduan Relaksasi Butterfly Hug 3 Menit
                    </h1>
                    <p class="text-xs sm:text-sm text-[#4a6366] leading-relaxed">
                        Tujuh langkah gerakan berilustrasi, dilanjutkan dengan sesi terpandu 180 ketukan bertempo tenang dan musik pad relaksasi untuk memulihkan ketenangan sistem saraf.
                    </p>
                </div>
            </div>

            <!-- 7 Langkah Gerakan Kartun Berilustrasi (File 2) -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
                <div>
                    <h2 class="font-display text-xl font-bold text-[#132628]">
                        Cara Melakukan Gerakan dengan Benar
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4a6366] mt-0.5">
                        Pelajari 7 langkah posisi tubuh berikut sebelum memulai sesi terpandu.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="stepsGrid">
                    <!-- Kartu 1: Duduk Nyaman -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <line x1="14" y1="188" x2="186" y2="188" stroke="#4a6366" stroke-width="1.5" stroke-dasharray="4 4"/>
                                <rect fill="#fff" stroke="#4a6366" stroke-width="2" x="46" y="70" width="9" height="72" rx="4"/>
                                <rect fill="#fff" stroke="#4a6366" stroke-width="2" x="52" y="140" width="80" height="10" rx="4"/>
                                <rect fill="#fff" stroke="#4a6366" stroke-width="2" x="58" y="150" width="7" height="38"/>
                                <rect fill="#fff" stroke="#4a6366" stroke-width="2" x="118" y="150" width="7" height="38"/>
                                <rect fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" x="60" y="84" width="36" height="60" rx="17"/>
                                <rect fill="#b9c7cc" stroke="#c79e80" stroke-width="1.5" x="68" y="132" width="74" height="19" rx="9"/>
                                <rect fill="#b9c7cc" stroke="#c79e80" stroke-width="1.5" x="128" y="142" width="17" height="42" rx="8"/>
                                <circle fill="#f0cfb5" stroke="#c79e80" stroke-width="1.5" cx="80" cy="56" r="22"/>
                                <path d="M58 56 C54 30 80 28 96 40 C86 40 70 42 66 58 Z" fill="#3a2e2a"/>
                                <text x="108" y="28" font-size="10" font-weight="bold" fill="#13242b">Punggung tegak</text>
                                <text x="122" y="88" font-size="10" font-weight="bold" fill="#13242b">Bahu rileks</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">1</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Duduk Nyaman</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Duduk tegak, kaki rata di lantai, bahu turun dan rileks. Cari posisi yang tenang.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 2: Silangkan Lengan -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <path fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" d="M26 200 C26 156 48 132 80 126 L120 126 C152 132 174 156 174 200 Z"/>
                                <circle fill="#f0cfb5" stroke="#c79e80" stroke-width="1.5" cx="100" cy="72" r="33"/>
                                <path d="M64 76 C56 34 84 22 102 24 C128 26 145 46 136 76 C131 56 117 46 100 46 C84 46 70 56 64 76 Z" fill="#3a2e2a"/>
                                <!-- Crossed Arms -->
                                <path d="M50 142 L44 182" stroke="#0c6a6a" stroke-width="22" stroke-linecap="round"/>
                                <path d="M150 142 L156 182" stroke="#0c6a6a" stroke-width="22" stroke-linecap="round"/>
                                <path d="M44 182 L124 142" stroke="#f0cfb5" stroke-width="14" stroke-linecap="round"/>
                                <path d="M156 182 L76 142" stroke="#f0cfb5" stroke-width="14" stroke-linecap="round"/>
                                <text x="100" y="24" text-anchor="middle" font-size="10" font-weight="bold" fill="#13242b">Silangkan kedua lengan</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">2</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Silangkan Lengan</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Silangkan kedua lengan di depan dada, tangan kanan di dada kiri dan sebaliknya.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 3: Posisi Tangan -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <path fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" d="M0 200 L0 82 C40 64 76 68 100 72 C124 68 160 64 200 82 L200 200Z"/>
                                <circle cx="100" cy="148" r="14" fill="none" stroke="#0c6a6a" stroke-width="2" stroke-dasharray="3 4"/>
                                <text x="100" y="26" text-anchor="middle" font-size="9" font-weight="bold" fill="#13242b">Ujung jari ke leher</text>
                                <text x="100" y="190" text-anchor="middle" font-size="8.5" font-weight="bold" fill="#0c6a6a">Ibu jari silang = badan kupu-kupu</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">3</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Atur Posisi Tangan</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Letakkan tangan di bawah tulang selangka, silangkan kedua ibu jari membentuk badan kupu-kupu.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 4: Pejamkan Mata -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <path fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" d="M26 200 C26 156 48 132 80 126 L120 126 C152 132 174 156 174 200 Z"/>
                                <circle fill="#f0cfb5" stroke="#c79e80" stroke-width="1.5" cx="100" cy="72" r="33"/>
                                <!-- Closed Eyes -->
                                <path d="M81 76 Q88 83 95 76" stroke="#13242b" stroke-width="2.5" fill="none"/>
                                <path d="M105 76 Q112 83 119 76" stroke="#13242b" stroke-width="2.5" fill="none"/>
                                <path d="M91 92 Q100 100 109 92" stroke="#13242b" stroke-width="2" fill="none"/>
                                <text x="100" y="24" text-anchor="middle" font-size="9" font-weight="bold" fill="#13242b">Mata terpejam, wajah rileks</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">4</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Pejamkan Mata</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Pejamkan mata atau arahkan tatapan lembut ke lantai untuk mereduksi rangsangan visual luar.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 5: Ketuk Bergantian -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <circle cx="130" cy="139" r="16" fill="none" stroke="#0c6a6a" stroke-width="2" opacity="0.8"/>
                                <circle cx="70" cy="139" r="16" fill="none" stroke="#0c6a6a" stroke-width="2" opacity="0.5"/>
                                <circle cx="162" cy="118" r="9" fill="#0c6a6a"/><text x="162" y="122" text-anchor="middle" fill="#fff" font-size="10" font-weight="bold">1</text>
                                <circle cx="38" cy="118" r="9" fill="#0c6a6a"/><text x="38" y="122" text-anchor="middle" fill="#fff" font-size="10" font-weight="bold">2</text>
                                <text x="100" y="24" text-anchor="middle" font-size="9" font-weight="bold" fill="#13242b">Kanan, Kiri: 1 ketukan per detik</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">5</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Ketuk Bergantian</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Ketuk lembut dengan ujung jari: kanan, kiri, kanan, kiri, sekitar 1 ketukan per detik seperti menepuk bahu bayi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 6: Atur Napas -->
                    <div class="rounded-2xl border border-[#d2dedc] bg-[#f9fbfa] overflow-hidden flex flex-col">
                        <div class="bg-[#eef3f4] p-4 flex items-center justify-center">
                            <svg viewBox="0 0 200 200" class="w-36 h-36">
                                <rect fill="#e3ecee" width="200" height="200"/>
                                <path fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" d="M26 200 C26 156 48 132 80 126 L120 126 C152 132 174 156 174 200 Z"/>
                                <circle fill="#f0cfb5" stroke="#c79e80" stroke-width="1.5" cx="100" cy="72" r="33"/>
                                <ellipse cx="100" cy="96" rx="4.5" ry="3.5" fill="#13242b"/>
                                <text x="18" y="48" font-size="9" font-weight="bold" fill="#0c6a6a">Tarik hidung &uarr;</text>
                                <text x="130" y="48" font-size="9" font-weight="bold" fill="#0c6a6a">Hembus mulut &darr;</text>
                            </svg>
                        </div>
                        <div class="p-3.5 flex gap-3 items-start flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs font-bold shrink-0">6</span>
                            <div>
                                <h3 class="text-xs font-bold text-[#132628]">Atur Napas</h3>
                                <p class="text-[11px] text-[#4a6366] mt-0.5">Tarik napas lembut lewat hidung, hembuskan perlahan lewat mulut sambil terus mengetuk teratur.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Medis Keamanan -->
                <div class="p-4 rounded-2xl bg-[#fff8e6] border border-[#f2b705]/40 text-xs text-[#6b4a00] flex items-center gap-3">
                    <span class="text-base shrink-0">💡</span>
                    <span><strong>Catatan:</strong> Bila merasa pusing, sesak, atau muncul perasaan terlalu berat, segera hentikan ketukan, tarik napas dalam secara bebas, dan istirahatlah sejenak.</span>
                </div>
            </div>

            <!-- SESI 3 MENIT TERPANDU (Interactive Stage) -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6" id="sesiStage">
                <div>
                    <h2 class="font-display text-xl font-bold text-[#132628]">
                        Sesi Latihan Butterfly Hug (3 Menit)
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4a6366] mt-0.5">
                        Target 180 tepukan ritmis (1 ketukan per detik) disertai audio penenang dan aba-aba napas.
                    </p>
                </div>

                <!-- SETUP STAGE -->
                <div id="hugSetup" class="space-y-5 p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc]">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="bTension" class="text-xs font-bold text-[#132628]">
                                Tingkat ketegangan tubuh saat ini:
                            </label>
                            <span class="text-xs font-mono font-bold text-[#0b6b63]" id="bValDisplay">Skala: 6 / 10</span>
                        </div>
                        <input type="range" id="bTension" min="0" max="10" value="6" class="w-full accent-[#0b6b63]">
                        <div class="flex justify-between text-[11px] text-[#4a6366]">
                            <span>0 Santai</span>
                            <span class="font-bold text-[#0b6b63]" id="bVal">6</span>
                            <span>10 Sangat Tegang</span>
                        </div>
                    </div>

                    <!-- Audio Options -->
                    <div class="pt-2 border-t border-[#d2dedc] flex flex-wrap items-center justify-between gap-4 text-xs text-[#132628]">
                        <label class="flex items-center gap-2 cursor-pointer font-medium">
                            <input type="checkbox" id="musCheck" checked class="w-4 h-4 rounded text-[#0b6b63] accent-[#0b6b63]">
                            <span>Musik Relaksasi Ambient Pad</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer font-medium">
                            <input type="checkbox" id="sndCheck" checked class="w-4 h-4 rounded text-[#0b6b63] accent-[#0b6b63]">
                            <span>Bunyi Ketukan (Tick Sound)</span>
                        </label>
                        <div class="flex items-center gap-2">
                            <span class="text-[#4a6366]">Volume:</span>
                            <input type="range" id="musVol" min="0" max="100" value="35" class="w-20 accent-[#0b6b63]">
                        </div>
                    </div>

                    <button id="btnStart" type="button" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-[#0b6b63] text-white font-bold text-sm hover:bg-[#08524c] transition shadow-md active:scale-[0.98]">
                        Mulai Sesi 3 Menit 🦋
                    </button>
                </div>

                <!-- RUNNING STAGE -->
                <div id="hugRun" class="space-y-6 text-center hidden">
                    <!-- Timer & Progress -->
                    <div class="space-y-2">
                        <div class="font-mono text-5xl sm:text-6xl font-extrabold text-[#0b6b63]" id="clockDisplay">
                            03:00
                        </div>
                        <div class="w-full max-w-md mx-auto bg-[#d2dedc] h-2.5 rounded-full overflow-hidden">
                            <div id="progBar" class="bg-[#0b6b63] h-full transition-all duration-100" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Animated Tapping Figure SVG -->
                    <div class="w-48 h-48 mx-auto relative bg-[#eef3f4] rounded-full p-2 border-4 border-white shadow-md flex items-center justify-center">
                        <svg viewBox="0 0 200 200" class="w-full h-full">
                            <circle cx="100" cy="100" r="95" fill="#e3ecee"/>
                            <!-- Scrub & Skin -->
                            <path fill="#d3ebea" stroke="#0c6a6a" stroke-width="2" d="M26 200 C26 156 48 132 80 126 L120 126 C152 132 174 156 174 200 Z"/>
                            <circle fill="#f0cfb5" stroke="#c79e80" stroke-width="1.5" cx="100" cy="72" r="33"/>
                            <!-- Crossed Arms -->
                            <path d="M50 142 L44 182" stroke="#0c6a6a" stroke-width="22" stroke-linecap="round"/>
                            <path d="M150 142 L156 182" stroke="#0c6a6a" stroke-width="22" stroke-linecap="round"/>
                            <path d="M44 182 L124 142" stroke="#f0cfb5" stroke-width="14" stroke-linecap="round"/>
                            <path d="M156 182 L76 142" stroke="#f0cfb5" stroke-width="14" stroke-linecap="round"/>
                            <!-- Glowing Tapping Rings -->
                            <circle id="hr" cx="130" cy="139" r="18" fill="#0b6b63" opacity="0.15" stroke="#0b6b63" stroke-width="2" class="transition-all duration-150"/>
                            <circle id="hl" cx="70" cy="139" r="18" fill="#0b6b63" opacity="0.15" stroke="#0b6b63" stroke-width="2" class="transition-all duration-150"/>
                        </svg>
                    </div>

                    <!-- Phase Text & Breath Cue -->
                    <div class="space-y-1">
                        <h3 class="font-display text-2xl font-bold text-[#132628]" id="phaseDisplay">
                            Siapkan Posisi Tangan
                        </h3>
                        <p class="text-xs sm:text-sm text-[#0b6b63] font-semibold" id="cueDisplay">
                            Silangkan lengan, tangan di bawah tulang selangka.
                        </p>
                    </div>

                    <!-- Tap Counters -->
                    <div class="grid grid-cols-2 gap-4 max-w-xs mx-auto">
                        <div class="p-3 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc]">
                            <strong class="font-mono text-2xl text-[#0b6b63]" id="tapCount">0</strong>
                            <span class="block text-[11px] text-[#4a6366]">Tepukan Selesai</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc]">
                            <strong class="font-mono text-2xl text-[#132628]">180</strong>
                            <span class="block text-[11px] text-[#4a6366]">Target Sesi</span>
                        </div>
                    </div>

                    <!-- Action Controls -->
                    <div class="flex items-center justify-center gap-3 pt-2">
                        <button id="btnStop" type="button" class="px-5 py-2.5 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 font-semibold text-xs transition">
                            Hentikan Sesi
                        </button>
                        <button id="btnMusicToggle" type="button" class="px-5 py-2.5 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition">
                            Musik: Aktif
                        </button>
                    </div>
                </div>

                <!-- END STAGE -->
                <div id="hugEnd" class="space-y-5 p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] hidden">
                    <div class="text-center space-y-1">
                        <div class="w-12 h-12 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-2xl mx-auto flex items-center justify-center">
                            ✓
                        </div>
                        <h3 class="font-display text-xl font-bold text-[#132628]" id="endTitle">
                            Sesi Selesai!
                        </h3>
                        <p class="text-xs text-[#4a6366]">
                            Bagaimana tingkat ketegangan tubuh dan pikiran Anda sekarang?
                        </p>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="aTension" class="text-xs font-bold text-[#132628]">
                                Tingkat ketegangan setelah sesi:
                            </label>
                            <span class="text-xs font-mono font-bold text-[#0b6b63]" id="aValDisplay">Skala: 3 / 10</span>
                        </div>
                        <input type="range" id="aTension" min="0" max="10" value="3" class="w-full accent-[#0b6b63]">
                        <div class="flex justify-between text-[11px] text-[#4a6366]">
                            <span>0 Tenang</span>
                            <span class="font-bold text-[#0b6b63]" id="aVal">3</span>
                            <span>10 Sangat Tegang</span>
                        </div>
                    </div>

                    <!-- Comparison Result Callout -->
                    <div class="p-4 rounded-xl bg-white border border-[#d2dedc] text-xs text-[#132628] flex items-center justify-between gap-4">
                        <div>
                            <span class="text-[#4a6366] block">Evaluasi Relaksasi:</span>
                            <strong class="text-sm text-[#0b6b63]" id="hugResult">Ketegangan Anda turun 3 poin.</strong>
                            <p class="text-[11px] text-[#4a6366] mt-0.5">Tepukan selesai: <strong id="tapsDone">180</strong> dari 180.</p>
                        </div>
                        <div class="flex items-center gap-2 text-center shrink-0">
                            <div class="bg-[#f1f5f4] p-2 rounded-lg">
                                <span class="text-[10px] text-[#4a6366] block">Sebelum</span>
                                <strong class="text-sm text-[#132628]" id="endBScore">6</strong>
                            </div>
                            <span class="text-[#0b6b63] font-bold">&rarr;</span>
                            <div class="bg-[#dbeeeb] p-2 rounded-lg">
                                <span class="text-[10px] text-[#0b6b63] block">Sesudah</span>
                                <strong class="text-sm text-[#0b6b63]" id="endAScore">3</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Final Submission Form -->
                    <form method="POST" action="{{ route('intervention.store') }}" id="formHug" class="pt-2">
                        @csrf
                        <input type="hidden" name="type" value="butterfly_hug">
                        <input type="hidden" name="tension_before" id="hugInputBefore" value="6">
                        <input type="hidden" name="tension_after" id="hugInputAfter" value="3">
                        <input type="hidden" name="duration_seconds" id="hugInputDuration" value="180">
                        <input type="hidden" name="taps_count" id="hugInputTaps" value="180">

                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.98]">
                                Simpan &amp; Lanjut ke Game Stres &rarr;
                            </button>
                            <button type="button" id="btnRestart" class="w-full sm:w-auto px-4 py-3 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition">
                                Ulangi Sesi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Web Audio & Butterfly Hug Script (from File 2) -->
    <script>
    (function(){
        const $ = id => document.getElementById(id);
        const BLOCK = 180;
        let st = {
            stage: 'setup',
            before: 6,
            after: 3,
            sound: true,
            ctx: null,
            timer: null,
            start: 0,
            lastBeat: -1,
            taps: 0,
            done: false
        };

        function formatClock(sec){
            sec = Math.max(0, Math.ceil(sec));
            const m = String(Math.floor(sec/60)).padStart(2,'0');
            const s = String(sec%60).padStart(2,'0');
            return `${m}:${s}`;
        }

        function getAudioContext(){
            if(!st.ctx){
                const A = window.AudioContext || window.webkitAudioContext;
                if(A) st.ctx = new A();
            }
            if(st.ctx && st.ctx.state === 'suspended') st.ctx.resume();
            return st.ctx;
        }

        // Tap Tick Sound
        function playTick(isLeft){
            if(!st.sound || !st.ctx) return;
            try {
                const c = st.ctx, o = c.createOscillator(), g = c.createGain(), t = c.currentTime + 0.01;
                o.type = 'sine';
                o.frequency.value = isLeft ? 440 : 523;
                g.gain.setValueAtTime(0.0001, t);
                g.gain.exponentialRampToValueAtTime(0.06, t + 0.02);
                g.gain.exponentialRampToValueAtTime(0.0001, t + 0.16);
                o.connect(g); g.connect(c.destination);
                o.start(t); o.stop(t + 0.18);
            } catch(e){}
        }

        // Completion Bell
        function playBell(){
            if(!st.sound || !st.ctx) return;
            try {
                const c = st.ctx, t = c.currentTime + 0.01;
                [660, 880].forEach((f, i) => {
                    const o = c.createOscillator(), g = c.createGain();
                    o.type = 'sine'; o.frequency.value = f;
                    g.gain.setValueAtTime(0.0001, t + i * 0.2);
                    g.gain.exponentialRampToValueAtTime(0.12, t + i * 0.2 + 0.03);
                    g.gain.exponentialRampToValueAtTime(0.0001, t + i * 0.2 + 0.6);
                    o.connect(g); g.connect(c.destination);
                    o.start(t + i * 0.2); o.stop(t + i * 0.2 + 0.65);
                });
            } catch(e){}
        }

        // Ambient Pad Relaksasi
        const music = {
            on: true,
            vol: 0.35,
            playing: false,
            master: null,
            timer: null,
            step: 0,
            gen: 0,
            extra: []
        };
        const CHORDS = [
            [110, 164.81, 220, 261.63, 329.63],
            [87.31, 130.81, 174.61, 220, 329.63],
            [130.81, 196, 261.63, 293.66, 329.63],
            [98, 146.83, 196, 246.94, 293.66]
        ];

        function playChord(gen){
            if(!music.playing || gen !== music.gen || !st.ctx) return;
            const c = st.ctx, t = c.currentTime + 0.05, ch = CHORDS[music.step++ % CHORDS.length];
            ch.forEach(f => {
                [-4, 4].forEach(det => {
                    const o = c.createOscillator(), g = c.createGain();
                    o.type = 'sine'; o.frequency.value = f; o.detune.value = det;
                    g.gain.setValueAtTime(0.0001, t);
                    g.gain.linearRampToValueAtTime(0.03, t + 3);
                    g.gain.setValueAtTime(0.03, t + 5);
                    g.gain.linearRampToValueAtTime(0.0001, t + 10);
                    o.connect(g); g.connect(music.master);
                    o.start(t); o.stop(t + 10.2);
                });
            });
        }

        function startMusic(){
            if(music.playing || !music.on) return;
            const c = getAudioContext();
            if(!c) return;
            try {
                const master = c.createGain(), lp = c.createBiquadFilter();
                master.gain.value = 0.0001;
                lp.type = 'lowpass'; lp.frequency.value = 1400;
                master.connect(lp); lp.connect(c.destination);
                master.gain.setTargetAtTime(Math.max(0.0001, music.vol * 0.9), c.currentTime, 1.2);

                music.master = master;
                music.playing = true;
                music.gen++;
                const gen = music.gen;
                playChord(gen);
                music.timer = setInterval(() => playChord(gen), 8000);
            } catch(e){ music.playing = false; }
        }

        function stopMusic(){
            if(!music.playing) return;
            music.playing = false;
            clearInterval(music.timer);
            music.gen++;
            try {
                if(music.master && st.ctx){
                    music.master.gain.setTargetAtTime(0.0001, st.ctx.currentTime, 0.4);
                }
            } catch(e){}
            music.master = null;
        }

        function beginSession(){
            getAudioContext();
            if(music.on && !music.playing) startMusic();
            st.stage = 'run';
            st.start = performance.now();
            st.lastBeat = -1;
            st.taps = 0;
            st.done = false;

            $("hugSetup").classList.add("hidden");
            $("hugEnd").classList.add("hidden");
            $("hugRun").classList.remove("hidden");

            st.timer = setInterval(loopSession, 80);
            loopSession();
        }

        function loopSession(){
            const el = (performance.now() - st.start) / 1000;
            if(el >= BLOCK){
                finishSession(true);
                return;
            }
            const leftSec = BLOCK - el;
            $("clockDisplay").textContent = formatClock(leftSec);

            const pct = (el / BLOCK) * 100;
            $("progBar").style.width = pct + "%";

            const beat = Math.floor(el);
            const isLeft = (beat % 2 === 1);

            if(beat !== st.lastBeat){
                st.lastBeat = beat;
                st.taps++;
                $("tapCount").textContent = st.taps;
                $("hl").setAttribute("opacity", isLeft ? "0.85" : "0.15");
                $("hr").setAttribute("opacity", !isLeft ? "0.85" : "0.15");
                playTick(isLeft);
            }

            $("phaseDisplay").textContent = isLeft ? "Kiri" : "Kanan";
            $("cueDisplay").textContent = Math.floor(el / 4) % 2 === 0
                ? "Tarik napas lembut lewat hidung, tepukan tetap teratur."
                : "Hembuskan perlahan lewat mulut dengan tenang.";
        }

        function finishSession(isDone){
            clearInterval(st.timer);
            stopMusic();
            st.done = isDone;
            st.stage = 'end';
            if(isDone) playBell();

            $("hugRun").classList.add("hidden");
            $("hugEnd").classList.remove("hidden");
            $("endTitle").textContent = isDone ? "Sesi Selesai!" : "Sesi Dihentikan";
            $("tapsDone").textContent = st.taps;
            $("hugInputTaps").value = st.taps;
            $("hugInputDuration").value = Math.round((performance.now() - st.start) / 1000);

            calcHugResult();
        }

        function calcHugResult(){
            const a = parseInt($("bTension").value, 10);
            const b = parseInt($("aTension").value, 10);
            const diff = a - b;
            if(diff > 0){
                $("hugResult").textContent = `Ketegangan Anda berhasil turun ${diff} poin (dari ${a} menjadi ${b}).`;
            } else if(diff === 0){
                $("hugResult").textContent = `Skor tetap ${a}. Relaksasi menjaga kestabilan energi Anda.`;
            } else {
                $("hugResult").textContent = `Skor sedikit naik. Ambil waktu istirahat dan bernapas tenang sejenak.`;
            }
            $("endBScore").textContent = a;
            $("endAScore").textContent = b;
            $("hugInputBefore").value = a;
            $("hugInputAfter").value = b;
        }

        // Listeners
        $("bTension").oninput = e => {
            $("bVal").textContent = e.target.value;
            $("bValDisplay").textContent = "Skala: " + e.target.value + " / 10";
            $("hugInputBefore").value = e.target.value;
        };

        $("aTension").oninput = e => {
            $("aVal").textContent = e.target.value;
            $("aValDisplay").textContent = "Skala: " + e.target.value + " / 10";
            $("hugInputAfter").value = e.target.value;
            calcHugResult();
        };

        $("sndCheck").onchange = e => { st.sound = e.target.checked; };
        $("musCheck").onchange = e => {
            music.on = e.target.checked;
            if(!music.on) stopMusic();
        };
        $("musVol").oninput = e => {
            music.vol = parseInt(e.target.value, 10) / 100;
        };

        $("btnStart").onclick = beginSession;
        $("btnStop").onclick = () => finishSession(false);
        $("btnMusicToggle").onclick = e => {
            if(music.playing){
                stopMusic(); music.on = false;
                e.target.textContent = "Musik: Mati";
            } else {
                music.on = true; startMusic();
                e.target.textContent = "Musik: Aktif";
            }
        };

        $("btnRestart").onclick = () => {
            $("hugEnd").classList.add("hidden");
            $("hugRun").classList.add("hidden");
            $("hugSetup").classList.remove("hidden");
        };
    })();
    </script>
</x-app-layout>
