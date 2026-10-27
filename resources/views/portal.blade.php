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
                                Self-Assessment & Mental Recharge Program
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

            <!-- CARD 2: Supervisi Keperawatan Ruang UBK 2 -->
            <a
                href="{{ config('services.supervisi.url', 'https://supervisi-keperawatan-ruang-ubk-2-1.ai.studio/') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="group relative flex flex-col justify-between bg-white rounded-3xl border-2 border-[#d2dedc] p-6 sm:p-8 hover:border-[#047857] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block no-underline text-inherit"
            >
                <!-- Top Accent Line -->
                <div class="absolute top-0 inset-x-8 h-1.5 bg-gradient-to-r from-[#047857] to-[#10b981] rounded-t-3xl"></div>

                <div>
                    <!-- Badge Header -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-[11px] font-bold tracking-wide uppercase border border-emerald-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Supervisi Klinis Terpadu</span>
                        </span>
                        <span class="text-[11px] font-semibold text-emerald-900 bg-emerald-100/70 px-2.5 py-1 rounded-full border border-emerald-200">
                            Ruang Umar Bin Khattab 2
                        </span>
                    </div>

                    <!-- Icon & Title -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-[#047857] shrink-0 group-hover:scale-110 transition-transform shadow-xs">
                            <!-- Stethoscope / Clinical Supervision Icon -->
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-[#132628] group-hover:text-[#047857] transition-colors leading-tight">
                                Supervisi Keperawatan
                            </h2>
                            <p class="text-xs sm:text-sm font-semibold text-[#047857]">
                                Mutu Asuhan & Keselamatan Pasien
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-xs sm:text-sm text-[#4a6366] leading-relaxed mb-6">
                        Menjamin mutu asuhan, keselamatan pasien (IPSG), serta kepatuhan Standar Prosedur Operasional (SPO) melalui bimbingan reflektif klinis, perekaman suara, dan pengesahan digital resmi.
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-3 mb-6 bg-[#f0fdf4]/70 p-4 rounded-2xl border border-emerald-100">
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-700 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-emerald-900">Bimbingan Reflektif & Voice Note:</strong> Evaluasi bimbingan klinis terpadu dilengkapi rekaman suara (Voice Note) perawat.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-700 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-emerald-900">Berita Acara & TTD Digital:</strong> Pengesahan resmi instrumen supervisi dengan tanda tangan digital perawat & supervisor.
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-700 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-emerald-900">Instrumen Observasi SPO Ruang UBK 2:</strong> Pengujian kepatuhan berkala (Medikasi IV 7 Benar, Bedside Handover SBAR, Kateter, Kebersihan Tangan, dll).
                            </div>
                        </div>
                        <div class="flex items-start gap-2.5 text-xs text-[#132628]">
                            <span class="text-emerald-700 font-bold shrink-0 mt-0.5">✓</span>
                            <div>
                                <strong class="text-emerald-900">Struktur Tenaga Terverifikasi:</strong> 1 Kepala Ruangan, 2 Kepala Tim, dan 22 Perawat Pelaksana (Total 25 Staf Keperawatan UBK 2).
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Container -->
                <div class="pt-2">
                    <div
                        class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#047857] group-hover:bg-[#065f46] text-white font-semibold text-sm shadow-md group-hover:shadow-lg transition-all"
                    >
                        <span>Buka Supervisi Keperawatan</span>
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
