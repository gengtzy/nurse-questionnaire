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
                Pusat layanan terpadu keperawatan RSUD Welas Asih. Silakan pilih sistem aplikasi yang ingin Anda akses untuk evaluasi kesejahteraan tenaga medis atau penjaminan mutu supervisi klinis.
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

        <!-- 2 Selection Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-stretch max-w-5xl mx-auto">

            <!-- CARD 1: Aplikasi Nurse Recharge (SIMONA) -->
            <div class="group relative flex flex-col justify-between bg-white rounded-3xl border-2 border-[#d2dedc] p-6 sm:p-8 hover:border-[#0b6b63] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
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

                <!-- Action Button -->
                <div class="pt-2">
                    <a
                        href="{{ route('login') }}"
                        class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all active:scale-[0.99] cursor-pointer"
                    >
                        <span>Masuk ke Nurse Recharge</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- CARD 2: Aplikasi Supervisi (Super PRO) -->
            <div class="group relative flex flex-col justify-between bg-white rounded-3xl border-2 border-[#d2dedc] p-6 sm:p-8 hover:border-[#0284c7] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
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

                <!-- Action Button -->
                <div class="pt-2">
                    @php
                        $supervisiUrl = config('services.supervisi.url', env('SUPERVISI_APP_URL', ''));
                    @endphp

                    @if(!empty($supervisiUrl))
                        <a
                            href="{{ $supervisiUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#0284c7] hover:bg-[#0369a1] text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all active:scale-[0.99] cursor-pointer"
                        >
                            <span>Buka Aplikasi Supervisi</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    @else
                        <button
                            type="button"
                            onclick="openSupervisiModal()"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-5 rounded-2xl bg-[#0284c7] hover:bg-[#0369a1] text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all active:scale-[0.99] cursor-pointer"
                        >
                            <span>Buka Aplikasi Supervisi</span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer Notice -->
        <div class="text-center mt-12 text-xs text-[#4a6366] space-y-1">
            <p class="font-medium">Komite Keperawatan & Manajemen Ruang Rawat Inap</p>
            <p class="font-mono text-[11px] text-[#9db4b2]">RSUD Welas Asih Provinsi Jawa Barat · Sistem Informasi Manajemen Terpadu</p>
        </div>
    </div>

    <!-- Modal Informasi & Preview Aplikasi Supervisi (Super PRO) -->
    <div id="supervisiModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-xs transition-opacity" onclick="closeSupervisiModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-[#d2dedc]">
                <!-- Header -->
                <div class="bg-gradient-to-r from-[#0284c7] to-[#0369a1] px-6 py-5 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="p-2 rounded-xl bg-white/10 backdrop-blur-xs">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-lg font-bold" id="modal-title">Aplikasi Supervisi (Super PRO)</h3>
                                <p class="text-xs text-sky-100">RSUD Welas Asih Provinsi Jawa Barat</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeSupervisiModal()" class="text-white/80 hover:text-white rounded-lg p-1.5 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Body -->
                <div class="px-6 py-5 space-y-4">
                    <div class="p-3.5 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-between text-xs text-sky-900">
                        <div>
                            <span class="font-bold block">Ruang Abdurahman Bin Auf 2</span>
                            <span class="text-sky-700">Kepala Ruangan: Acep Sudiana, S.Kep., Ners</span>
                        </div>
                        <span class="px-2 py-1 rounded-full bg-sky-200 text-sky-800 font-bold text-[10px] uppercase">
                            Aktif
                        </span>
                    </div>

                    <div class="text-xs text-[#4a6366] space-y-2 leading-relaxed">
                        <p>
                            Aplikasi <strong>Super PRO</strong> merupakan modul sistem pengawasan klinis keperawatan mandiri yang memfasilitasi:
                        </p>
                        <ul class="list-disc list-inside space-y-1 pl-1 text-[#132628]">
                            <li><strong>Jadwal & Pengingat Supervisi:</strong> Notifikasi otomatis jadwal harian & mingguan.</li>
                            <li><strong>Supervisi Pre & Post Conference:</strong> Evaluasi timbang terima dan pembagian asuhan pasien (SBAR).</li>
                            <li><strong>Audit Kepatuhan 72 SOP:</strong> Instrumen digital pengukur kepatuhan tindakan klinis.</li>
                            <li><strong>Integrasi Google Workspace:</strong> Rekapitulasi otomatis Google Sheets & kalender Google.</li>
                        </ul>
                    </div>

                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-[11px] text-amber-800 flex items-start gap-2">
                        <span class="text-amber-600 font-bold text-sm">💡</span>
                        <span>
                            Untuk mengarahkan tombol ini ke domain/URL hosting spesifik dari Aplikasi Supervisi, Anda dapat menambahkan variabel <code>SUPERVISI_APP_URL=https://alamat-supervisi.com</code> pada konfigurasi <code>.env</code> / Environment Variables di Vercel.
                        </span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-[#f9fbfa] px-6 py-4 flex flex-col sm:flex-row-reverse gap-2 border-t border-[#d2dedc]">
                    <button
                        type="button"
                        onclick="closeSupervisiModal()"
                        class="w-full sm:w-auto inline-flex justify-center rounded-xl bg-[#0284c7] px-4 py-2.5 text-xs font-semibold text-white shadow-xs hover:bg-[#0369a1] transition"
                    >
                        Tutup Informasi
                    </button>
                    <a
                        href="{{ route('login') }}"
                        class="w-full sm:w-auto inline-flex justify-center rounded-xl bg-white border border-[#d2dedc] px-4 py-2.5 text-xs font-semibold text-[#132628] hover:bg-[#f1f5f4] transition"
                    >
                        Buka Nurse Recharge Saja
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openSupervisiModal() {
            document.getElementById('supervisiModal').classList.remove('hidden');
        }

        function closeSupervisiModal() {
            document.getElementById('supervisiModal').classList.add('hidden');
        }

        // Close on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSupervisiModal();
            }
        });
    </script>
</x-guest-layout>
