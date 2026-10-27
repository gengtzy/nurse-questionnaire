<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stepper Indicator -->
            <div class="mb-8 bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs font-medium text-[#4a6366] overflow-x-auto gap-2 pb-1">
                    <!-- Step 1: Pre-test (Completed) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span>1. Pre-Test</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]/40"></div>

                    <!-- Step 2: Game (Next Active) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs shadow-xs animate-pulse">2</span>
                        <span class="hidden sm:inline">2. Game Katarsis</span>
                        <span class="sm:hidden">2</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 3: Kartu Apresiasi -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">3</span>
                        <span class="hidden sm:inline">3. Kartu Apresiasi</span>
                        <span class="sm:hidden">3</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 4: Post-test -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">4</span>
                        <span class="hidden sm:inline">4. Post-Test</span>
                        <span class="sm:hidden">4</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 5: Kirim Hasil -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">5</span>
                        <span class="hidden sm:inline">5. Kirim Hasil</span>
                        <span class="sm:hidden">5</span>
                    </div>
                </div>
            </div>

            <!-- Success Alert & Immediate Next Step Banner -->
            <div class="mb-6 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-[#0b6b63] to-[#08524c] text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-lg shrink-0">
                        ✓
                    </div>
                    <div>
                        <h4 class="font-bold text-sm sm:text-base">Pre-Test Selesai! Skor: {{ number_format($assessment->percentage, 1) }}% ({{ $assessment->category }})</h4>
                        <p class="text-xs text-white/80">Data telah tersimpan. Silakan lanjutkan ke Tahap 2: Mini Game Katarsis.</p>
                    </div>
                </div>
                <a
                    href="{{ route('game.play') }}"
                    class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-white text-[#0b6b63] hover:bg-[#dbeeeb] font-bold text-sm shadow-sm transition active:scale-[0.98]"
                >
                    <span>Lanjut ke Game Stres &rarr;</span>
                </a>
            </div>

            <!-- Main Score Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-sm mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#d2dedc]">
                    <div>
                        <span class="text-xs uppercase font-mono tracking-wider text-[#4a6366] block mb-1">Hasil Evaluasi Pre-Test</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-[#132628]">
                            {{ $user->name }}
                        </h2>
                        <span class="text-xs text-[#0b6b63] font-semibold">{{ $user->role }} · {{ $user->room }}</span>
                    </div>

                    <!-- Category Badge -->
                    <div class="text-left sm:text-right">
                        @if ($assessment->category === 'Rendah')
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-[#dff0e5] text-[#2f7d52] border border-[#b8e2cb]">
                                Burnout Rendah
                            </span>
                        @elseif ($assessment->category === 'Sedang')
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-[#f7ebd2] text-[#a8680f] border border-[#ecd5a9]">
                                Burnout Sedang
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-[#f8e1dd] text-[#b03a2e] border border-[#f0c2bb]">
                                Burnout Tinggi
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Big Percentage Display -->
                <div class="py-8 text-center bg-[#f9fbfa] rounded-2xl border border-[#d2dedc] my-6">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#4a6366] block mb-1">Persentase Tingkat Kelelahan (Burnout)</span>
                    <div class="font-mono text-5xl sm:text-6xl font-bold text-[#0b6b63]">
                        {{ number_format($assessment->percentage, 1) }}<span class="text-3xl font-medium">%</span>
                    </div>
                    <p class="text-xs text-[#4a6366] mt-2 font-mono">
                        Total Skor: <strong class="text-[#132628]">{{ $assessment->total_score }}</strong> dari 132 poin maksimum MBI
                    </p>
                </div>

                <!-- 3 Dimensions Breakdown -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-[#132628]">Rincian Per Dimensi MBI:</h3>

                    <!-- Dimensi 1: Kelelahan Emosional (EE) -->
                    <div class="p-4 rounded-xl bg-[#f1f5f4] border border-[#d2dedc]">
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <span class="font-semibold text-[#132628]">1. Kelelahan Emosional (EE)</span>
                            <span class="font-mono font-bold text-[#0b6b63]">{{ $assessment->ee_score }} / 54</span>
                        </div>
                        <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                            <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->ee_score / 54) * 100)) }}%"></div>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1.5">Mengukur perasaan terkuras dan lelah emosional akibat beban dinas harian.</p>
                    </div>

                    <!-- Dimensi 2: Depersonalisasi (DP) -->
                    <div class="p-4 rounded-xl bg-[#f1f5f4] border border-[#d2dedc]">
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <span class="font-semibold text-[#132628]">2. Depersonalisasi (DP)</span>
                            <span class="font-mono font-bold text-[#0b6b63]">{{ $assessment->dp_score }} / 30</span>
                        </div>
                        <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                            <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->dp_score / 30) * 100)) }}%"></div>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1.5">Mengukur kecenderungan menjaga jarak emosional atau sikap sinis terhadap pasien/rekan.</p>
                    </div>

                    <!-- Dimensi 3: Penurunan Pencapaian Pribadi (PA) -->
                    <div class="p-4 rounded-xl bg-[#f1f5f4] border border-[#d2dedc]">
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <span class="font-semibold text-[#132628]">3. Penurunan Pencapaian Diri (PA)</span>
                            <span class="font-mono font-bold text-[#0b6b63]">{{ $assessment->pa_score }} / 48</span>
                        </div>
                        <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                            <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->pa_score / 48) * 100)) }}%"></div>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1.5">Skor dibalik: Semakin rendah rasa berhasil menyelesaikan masalah pasien, semakin tinggi potensi burnout.</p>
                    </div>
                </div>

                <!-- Interpretation Text -->
                <div class="mt-6 p-4 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-xs text-[#4a6366] leading-relaxed">
                    <strong class="text-[#132628] block mb-1">Catatan Evaluasi Awal:</strong>
                    @if ($assessment->category === 'Rendah')
                        Kondisi emosional dan energi Anda saat ini relatif stabil. Jaga keseimbangan dengan memanfaatkan waktu istirahat dan latihan napas di sela shift.
                    @elseif ($assessment->category === 'Sedang')
                        Terdapat sinyal kelelahan kerja yang mulai menumpuk. Sangat disarankan mengambil jeda relaksasi, bermain mini game sejenak, dan mendiskusikan pembagian tugas bila diperlukan.
                    @else
                        Tingkat keletihan dan tekanan dinas tergolong tinggi. Jangan memaksakan diri secara berlebihan, luangkan waktu relaksasi, dan pertimbangkan berdiskusi dengan Katim atau Karu.
                    @endif
                </div>
            </div>

            <!-- NEXT STEP CALL TO ACTION (STEP 2: INTERVENSI BUTTERFLY HUG) -->
            <div class="bg-gradient-to-br from-[#0b6b63] to-[#08524c] rounded-2xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold tracking-wide uppercase">
                            <span>🦋 Langkah Ke-2: Intervensi Relaksasi</span>
                        </div>
                        <h3 class="font-display text-xl sm:text-2xl font-bold">
                            Lanjut ke Intervensi: "Butterfly Hug"
                        </h3>
                        <p class="text-white/80 text-xs sm:text-sm max-w-lg leading-relaxed">
                            Lakukan latihan stimulasi bilateral dan pernapasan ritmis selama 1–3 menit untuk menurunkan ketegangan fisik dan menenangkan saraf sebelum melanjutkan ke aktivitas game.
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a
                            href="{{ route('intervention.create') }}"
                            class="inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-white text-[#0b6b63] font-bold text-sm shadow-md hover:bg-[#dbeeeb] transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>Mulai Butterfly Hug 🦋</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard Link -->
            <div class="text-center mt-6">
                <a href="{{ route('dashboard') }}" class="text-xs text-[#4a6366] hover:text-[#132628] underline">
                    Kembali ke Beranda Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
