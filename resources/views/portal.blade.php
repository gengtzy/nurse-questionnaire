<x-guest-layout>
    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 py-6 sm:py-10">
        <!-- Top Institutional Brand & Header -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
            <div class="flex justify-center mb-4">
                <div class="relative inline-block">
                    <img src="{{ asset('images/logo_welas_asih.png') }}" alt="Logo RSUD Welas Asih" class="w-20 h-20 sm:w-24 sm:h-24 object-contain drop-shadow-md">
                    <span class="absolute -bottom-1 -right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
                    </span>
                </div>
            </div>

            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold tracking-wide uppercase mb-3 border border-[#b2ded8] shadow-xs">
                <span class="w-2 h-2 rounded-full bg-[#0b6b63] animate-pulse"></span>
                <span>RSUD Welas Asih Provinsi Jawa Barat</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-[#132628]">
                Portal Layanan Keperawatan
            </h1>
            <p class="text-sm sm:text-base text-[#4a6366] mt-3 leading-relaxed max-w-2xl mx-auto">
                Pusat layanan terpadu keperawatan RSUD Welas Asih. Silakan klik kartu aplikasi yang ingin Anda tuju untuk membuka sistem.
            </p>

            @auth
                <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl inline-flex flex-wrap items-center justify-center gap-2 text-xs text-emerald-800">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span>Sesi aktif: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</span>
                    <span class="text-emerald-400">·</span>
                    <a href="{{ auth()->user()->role === 'Kepala Ruangan' ? route('admin.rekap') : route('dashboard') }}" class="font-bold underline hover:text-emerald-950">
                        Lanjut ke Dashboard &rarr;
                    </a>
                </div>
            @endauth
        </div>

        <!-- 2 Selection Cards Grid (Fully Clickable Cards) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-stretch max-w-5xl mx-auto">

            <!-- CARD 1: Aplikasi Nurse Recharge (SIMONA) -->
            <a
                href="{{ route('login') }}"
                class="group relative flex flex-col justify-between bg-white rounded-3xl border-2 border-[#d2dedc] p-6 sm:p-8 hover:border-[#0b6b63] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block no-underline text-inherit"
            >
                <!-- Top Accent Line -->
                <div class="absolute top-0 inset-x-8 h-1.5 bg-gradient-to-r from-[#0b6b63] to-[#14b8a6] rounded-t-3xl"></div>

                <div>
                    <!-- Badge Header -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-[11px] font-bold tracking-wide uppercase border border-[#b2ded8]">
                            <span>❤️</span> Kesejahteraan & Burnout
                        </span>
                        <span class="text-[11px] font-medium text-[#4a6366] bg-[#f1f5f4] px-2.5 py-1 rounded-full border border-[#d2dedc]">
                            Ruang Umar Bin Khattab 2
                        </span>
                    </div>

                    <!-- Icon & Title -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#0b6b63]/10 border border-[#0b6b63]/20 flex items-center justify-center text-[#0b6b63] shrink-0 group-hover:scale-110 transition-transform">
                            <!-- Battery & Heart Recharge SVG Icon -->
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-[#132628] group-hover:text-[#0b6b63] transition-colors">
                                Aplikasi Nurse Recharge
                            </h2>
                            <p class="text-xs sm:text-sm font-medium text-[#0b6b63]">
                                SIMONA · Self-Assessment & Mental Recharge
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-xs sm:text-sm text-[#4a6366] leading-relaxed mb-6">
                        Platform pendampingan psikologis dan evaluasi kelelahan kerja (burnout) perawat menggunakan instrumen Maslach Burnout Inventory (MBI) terstandarisasi.
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-3 mb-6 bg-[#f9fbfa] p-4 rounded-2xl border border-[#e4eeeb]">
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#0b6b63]">Self-Assessment MBI:</strong> Pre-Test & Post-Test tingkat kelelahan emosional, depersonalisasi, dan efikasi diri.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#0b6b63]">Mini Game "Hancurkan Stres":</strong> Relaksasi interaktif cepat di sela dinas untuk meredakan ketegangan mental.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#0b6b63]">Kartu Apresiasi Rekan (Thank You Card):</strong> Media saling mengirim pesan apresiasi positif antar rekan kerja.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-[#0b6b63]">Monitoring Rekapitulasi (Karu):</strong> Panel analitik hasil kuesioner dan tren kesejahteraan perawat bagi pimpinan.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Container -->
                <div class="pt-2">
                    <div
                        class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#0b6b63] group-hover:bg-[#08524c] text-white font-semibold text-sm shadow-md group-hover:shadow-lg transition-all"
                    >
                        <span>Masuk ke Nurse Recharge</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- CARD 2: Aplikasi Supervisi (Super PRO) -->
            <a
                href="{{ config('services.supervisi.url', 'https://super-studio-1.ai.studio/') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="group relative flex flex-col justify-between bg-white rounded-3xl border-2 border-[#d2dedc] p-6 sm:p-8 hover:border-[#0284c7] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block no-underline text-inherit"
            >
                <!-- Top Accent Line -->
                <div class="absolute top-0 inset-x-8 h-1.5 bg-gradient-to-r from-[#0284c7] to-[#0ea5e9] rounded-t-3xl"></div>

                <div>
                    <!-- Badge Header -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-[11px] font-bold tracking-wide uppercase border border-sky-200">
                            <span class="px-1.5 py-0.5 rounded bg-sky-600 text-white text-[9px] font-black">PRO</span>
                            <span>Supervisi Klinis</span>
                        </span>
                        <span class="text-[11px] font-medium text-[#4a6366] bg-[#f1f5f4] px-2.5 py-1 rounded-full border border-[#d2dedc]">
                            Ruang Abdurahman Bin Auf 2
                        </span>
                    </div>

                    <!-- Icon & Title -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-200 flex items-center justify-center text-sky-600 shrink-0 group-hover:scale-110 transition-transform">
                            <!-- Shield & Checkmark SVG Icon -->
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-xl sm:text-2xl font-bold text-[#132628] group-hover:text-sky-700 transition-colors">
                                    Aplikasi Supervisi
                                </h2>
                                <span class="px-2 py-0.5 rounded-md bg-sky-100 text-sky-800 text-xs font-extrabold">Super PRO</span>
                            </div>
                            <p class="text-xs sm:text-sm font-medium text-sky-700">
                                Sistem Manajemen & Penjaminan Mutu Keperawatan
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-xs sm:text-sm text-[#4a6366] leading-relaxed mb-6">
                        Platform digital pelaksanaan dan pemantauan supervisi klinis keperawatan berstandar RSUD Welas Asih untuk Kepala Ruangan (Karu) dan Ketua Tim (Katim).
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-3 mb-6 bg-sky-50/50 p-4 rounded-2xl border border-sky-100">
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-sky-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-sky-800">Supervisi Rutin Mingguan:</strong> Jadwal terstruktur wajib 1x/minggu oleh Karu & Katim dengan alur bertahap.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-sky-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-sky-800">Pre & Post Conference:</strong> Slot rutin (07:10 Shift Pagi & 14:00 Menjelang Operan SBAR) untuk evaluasi timbang terima.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-sky-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-sky-800">Daftar Tilik Klinis (72 Tindakan SOP):</strong> Audit kepatuhan SOP (Tekanan Darah, Infus, NGT, dll) dengan detail skor.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-sky-600 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-sky-800">Integrasi Google Workspace:</strong> Sinkronisasi Google Calendar, laporan Google Sheets, dan arsip PDF di Google Drive.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Container -->
                <div class="pt-2">
                    <div
                        class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#0284c7] group-hover:bg-[#0369a1] text-white font-semibold text-sm shadow-md group-hover:shadow-lg transition-all"
                    >
                        <span>Buka Aplikasi Supervisi</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Footer Notice -->
        <div class="text-center mt-12 text-xs text-[#4a6366] space-y-1">
            <p class="font-medium">Komite Keperawatan & Manajemen Ruang Rawat Inap</p>
            <p class="font-mono text-[11px] text-[#9db4b2]">RSUD Welas Asih Provinsi Jawa Barat · Sistem Informasi Manajemen Terpadu</p>
        </div>
    </div>
</x-guest-layout>
