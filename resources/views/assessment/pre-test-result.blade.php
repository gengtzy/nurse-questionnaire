<x-app-layout>
    @if ($assessment->category === 'Tinggi')
        <!-- Red Alert Sticky Banner for High Burnout -->
        <div id="baBanner" class="bg-[#b3261e] text-white px-4 py-3 sticky top-16 z-20 flex items-center justify-between gap-3 shadow-md animate-pulse">
            <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
                <span class="text-lg">⚠</span>
                <span>Tingkat burnout Anda tergolong <strong>TINGGI</strong> ({{ number_format($assessment->percentage, 1) }}%). Segera jalani bimbingan konseling / psikoterapi.</span>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" id="baBannerSound" class="px-2.5 py-1 rounded-lg bg-white text-[#b3261e] text-xs font-bold hover:bg-white/90 transition">
                    🔊 Suara: Hidup
                </button>
            </div>
        </div>

        <!-- Emergency Modal Dialog (File 3 & SS 1) -->
        <div id="baOverlay" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border-2 border-red-500 animate-in fade-in zoom-in duration-200">
                <div class="bg-[#b3261e] text-white p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 text-white flex items-center justify-center text-3xl shrink-0 animate-bounce">
                        🔔
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-mono tracking-wider text-white/80 block">Peringatan Klinis Mendesak</span>
                        <h2 class="text-xl font-bold font-display">Tingkat Burnout Kategori Tinggi</h2>
                    </div>
                </div>

                <div class="p-6 space-y-4 text-xs sm:text-sm text-[#132628] leading-relaxed max-h-[75vh] overflow-y-auto">
                    <div class="p-3 bg-red-50 border border-red-200 rounded-xl text-red-950 font-medium">
                        Skor Burnout Anda mencapai <strong class="text-red-700 font-mono text-base">{{ number_format($assessment->percentage, 1) }}%</strong> ({{ $assessment->total_score }} / 132 poin MBI).
                    </div>

                    <!-- Bahaya Klinis (SS 1) -->
                    <div class="space-y-2">
                        <strong class="text-red-800 font-bold block text-sm">⚠️ Bahaya Jika Burnout Tinggi Dibiarkan:</strong>
                        <ul class="space-y-1.5 pl-4 list-disc text-xs text-[#4a6366]">
                            <li><strong>Keselamatan Pasien:</strong> Risiko kesalahan medis (<em>medication error</em>) atau kelalaian SPO akibat penurunan fokus kognitif.</li>
                            <li><strong>Kesehatan Fisik Perawat:</strong> Insomnia kronis, penurunan imunitas tubuh, sakit kepala berkelanjutan, dan kelelahan ekstrem.</li>
                            <li><strong>Penyebab:</strong> Akumulasi beban shift kerja berturut-turut dan stres emosional menghadapi pasien kritis.</li>
                        </ul>
                    </div>

                    <!-- Rekomendasi Psikoterapi -->
                    <div class="p-3.5 bg-[#eef6f4] rounded-xl border border-[#b2ded8] text-xs space-y-1 text-[#06302a]">
                        <strong class="text-[#0b6b63] font-bold block">🩺 Rekomendasi Konseling Psikoterapi:</strong>
                        <p>Sangat disarankan segera berkonsultasi dengan Tim Konseling Psikoterapi / Psikolog RSUD Welas Asih untuk memulihkan energi emosional Anda.</p>
                        <blockquote class="italic text-[11px] text-[#4a6366] pt-1 border-t border-[#b2ded8]/60 mt-1">
                            “Mencari bantuan konseling adalah wujud tanggung jawab profesional merawat diri.”
                        </blockquote>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 pt-2">
                        <a
                            href="{{ route('intervention.create') }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl bg-[#b3261e] hover:bg-[#8c1d18] text-white font-bold text-xs shadow-md transition"
                        >
                            <span>Lanjut ke Halaman Konseling &rarr;</span>
                        </a>
                        <button
                            type="button"
                            onclick="document.getElementById('baOverlay').classList.add('hidden')"
                            class="w-full sm:w-auto px-4 py-3 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition"
                        >
                            Tutup Modal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Stepper Indicator -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs font-medium text-[#4a6366] overflow-x-auto gap-2 pb-1">
                    <!-- Step 1: Pre-test (Completed) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span>1. Pre-Test</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]/40"></div>

                    <!-- Step 2: Intervensi (Next Active) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs shadow-xs animate-pulse">2</span>
                        <span class="hidden sm:inline">
                            @if ($assessment->category === 'Rendah')
                                2. Relaksasi EFT
                            @elseif ($assessment->category === 'Sedang')
                                2. Butterfly Hug
                            @else
                                2. Peringatan &amp; Konseling
                            @endif
                        </span>
                        <span class="sm:hidden">2</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 3: Game -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">3</span>
                        <span class="hidden sm:inline">3. Game Katarsis</span>
                        <span class="sm:hidden">3</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 4: Kartu Apresiasi -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">4</span>
                        <span class="hidden sm:inline">4. Kirim Pesan</span>
                        <span class="sm:hidden">4</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 5: Post-test -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">5</span>
                        <span class="hidden sm:inline">5. Post-Test</span>
                        <span class="sm:hidden">5</span>
                    </div>
                </div>
            </div>

            <!-- Success Alert & Immediate Next Step Banner -->
            <div class="p-4 sm:p-5 rounded-2xl {{ $assessment->category === 'Tinggi' ? 'bg-[#b3261e]' : 'bg-gradient-to-r from-[#0b6b63] to-[#08524c]' }} text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-lg shrink-0">
                        ✓
                    </div>
                    <div>
                        <h4 class="font-bold text-sm sm:text-base">
                            Pre-Test Selesai! Skor: {{ number_format($assessment->percentage, 1) }}% ({{ $assessment->category }})
                        </h4>
                        <p class="text-xs text-white/80">
                            @if ($assessment->category === 'Rendah')
                                Kondisi stabil. Silakan lanjutkan ke Tahap 2: Relaksasi EFT (Emotional Freedom Technique).
                            @elseif ($assessment->category === 'Sedang')
                                Mulai terdeteksi kelelahan. Silakan lanjutkan ke Tahap 2: Relaksasi Butterfly Hug 3 Menit.
                            @else
                                Burnout tinggi terdeteksi. Silakan lanjutkan ke Tahap 2: Peringatan Klinis &amp; Rekomendasi Konseling.
                            @endif
                        </p>
                    </div>
                </div>
                <a
                    href="{{ route('intervention.create') }}"
                    class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-white text-[#0b6b63] hover:bg-[#dbeeeb] font-bold text-sm shadow-sm transition active:scale-[0.98]"
                >
                    <span>Lanjut ke Tahap 2 &rarr;</span>
                </a>
            </div>

            <!-- Main Score Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-sm">
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
                    <div class="font-mono text-5xl sm:text-6xl font-bold {{ $assessment->category === 'Tinggi' ? 'text-[#b3261e]' : 'text-[#0b6b63]' }}">
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
                        Kondisi emosional dan energi Anda saat ini relatif stabil. Jaga keseimbangan dengan memanfaatkan teknik relaksasi Emotional Freedom Technique (EFT) di sela giliran shift.
                    @elseif ($assessment->category === 'Sedang')
                        Terdapat sinyal kelelahan kerja yang mulai menumpuk. Sangat disarankan mengambil jeda relaksasi stimulasi bilateral Butterfly Hug 3 menit untuk menenangkan saraf fisik.
                    @else
                        Tingkat keletihan dan tekanan dinas tergolong tinggi. Diperlukan perhatian klinis segera, pendampingan konseling psikoterapi, dan diskusi pembagian beban kerja bersama Kepala Ruangan.
                    @endif
                </div>
            </div>

            <!-- NEXT STEP CALL TO ACTION (STEP 2 DYNAMIC INTERVENTION) -->
            <div class="{{ $assessment->category === 'Tinggi' ? 'bg-[#b3261e]' : 'bg-gradient-to-br from-[#0b6b63] to-[#08524c]' }} rounded-2xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold tracking-wide uppercase">
                            <span>
                                @if ($assessment->category === 'Rendah')
                                    🌿 Langkah Ke-2: Relaksasi EFT
                                @elseif ($assessment->category === 'Sedang')
                                    🦋 Langkah Ke-2: Butterfly Hug
                                @else
                                    🔔 Langkah Ke-2: Peringatan &amp; Konseling
                                @endif
                            </span>
                        </div>
                        <h3 class="font-display text-xl sm:text-2xl font-bold">
                            @if ($assessment->category === 'Rendah')
                                Lanjut ke Intervensi: "Relaksasi EFT"
                            @elseif ($assessment->category === 'Sedang')
                                Lanjut ke Intervensi: "Butterfly Hug 3 Menit"
                            @else
                                Peringatan Klinis &amp; Konseling Psikoterapi
                            @endif
                        </h3>
                        <p class="text-white/80 text-xs sm:text-sm max-w-lg leading-relaxed">
                            @if ($assessment->category === 'Rendah')
                                Ikuti panduan stimulasi titik akupresur EFT mandiri untuk menjaga ketenangan dan keseimbangan emosional Anda.
                            @elseif ($assessment->category === 'Sedang')
                                Lakukan latihan stimulasi bilateral dan pernapasan ritmis selama 3 menit (180 tepukan) untuk meredakan ketegangan fisik.
                            @else
                                Bacalah panduan bahaya klinis burnout dan akses layanan konseling psikoterapi profesional staf RSUD Welas Asih.
                            @endif
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a
                            href="{{ route('intervention.create') }}"
                            class="inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-white text-[#0b6b63] font-bold text-sm shadow-md hover:bg-[#dbeeeb] transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>
                                @if ($assessment->category === 'Rendah')
                                    Mulai Sesi EFT 🌿
                                @elseif ($assessment->category === 'Sedang')
                                    Mulai Butterfly Hug 🦋
                                @else
                                    Buka Panduan Konseling 🔔
                                @endif
                            </span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard / Retake Links -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-center mt-6">
                <a
                    href="{{ route('pre-test.create', ['retake' => 1]) }}"
                    class="text-xs text-[#0b6b63] hover:underline font-bold"
                >
                    🔄 Isi Ulang Kuesioner Awal (Pre-test)
                </a>
                <span class="hidden sm:inline text-gray-300">•</span>
                <a href="{{ route('dashboard') }}" class="text-xs text-[#4a6366] hover:text-[#132628] underline">
                    Kembali ke Beranda Dashboard
                </a>
            </div>

        </div>
    </div>

    @if ($assessment->category === 'Tinggi')
        <!-- Siren Sound Script for High Category -->
        <script>
        (function(){
            let audioCtx = null, isMuted = false, currentMaster = null;

            function playSiren(){
                if(isMuted) return;
                try {
                    const AC = window.AudioContext || window.webkitAudioContext;
                    if(!AC) return;
                    audioCtx = new AC();
                    const t0 = audioCtx.currentTime + 0.05;
                    const master = audioCtx.createGain();
                    master.gain.value = 0.45;
                    master.connect(audioCtx.destination);
                    currentMaster = master;

                    for(let i = 0; i < 6; i++){
                        const o = audioCtx.createOscillator(), g = audioCtx.createGain();
                        const t = t0 + i * 0.5;
                        o.type = "square";
                        o.frequency.setValueAtTime(i % 2 ? 660 : 990, t);
                        g.gain.setValueAtTime(0.0001, t);
                        g.gain.exponentialRampToValueAtTime(0.2, t + 0.02);
                        g.gain.setValueAtTime(0.2, t + 0.38);
                        g.gain.exponentialRampToValueAtTime(0.0001, t + 0.46);
                        o.connect(g);
                        g.connect(master);
                        o.start(t);
                        o.stop(t + 0.5);
                    }
                } catch(e){}
            }

            window.addEventListener("DOMContentLoaded", () => {
                playSiren();
                const resume = () => {
                    if(!isMuted && audioCtx && audioCtx.state === 'suspended') audioCtx.resume().then(()=>playSiren());
                    window.removeEventListener("click", resume);
                };
                window.addEventListener("click", resume, { once: true });
            });

            const soundBtn = document.getElementById("baBannerSound");
            if(soundBtn){
                soundBtn.onclick = () => {
                    isMuted = !isMuted;
                    if(isMuted){
                        if(currentMaster && audioCtx) currentMaster.gain.setValueAtTime(0, audioCtx.currentTime);
                        soundBtn.textContent = "🔇 Suara: Mati";
                    } else {
                        playSiren();
                        soundBtn.textContent = "🔊 Suara: Hidup";
                    }
                };
            }
        })();
        </script>
    @endif
</x-app-layout>
