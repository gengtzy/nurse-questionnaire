<x-app-layout>
    <!-- Red Alert Sticky Banner -->
    <div id="baBanner" class="bg-[#b3261e] text-white px-4 py-3 sticky top-16 z-20 flex items-center justify-between gap-3 shadow-md animate-pulse">
        <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
            <span class="text-lg">⚠</span>
            <span>Tingkat burnout Anda tergolong <strong>TINGGI</strong>. Disarankan segera berkonsultasi &amp; menjalani psikoterapi.</span>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <button type="button" id="baBannerSound" class="px-2.5 py-1 rounded-lg bg-white text-[#b3261e] text-xs font-bold hover:bg-white/90 transition">
                🔊 Suara: Hidup
            </button>
            <button type="button" id="baBannerOpen" class="px-3 py-1 rounded-lg bg-white/20 text-white hover:bg-white/30 text-xs font-semibold transition">
                Rincian
            </button>
        </div>
    </div>

    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 5 Steps Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#b3261e] uppercase tracking-wider font-mono">Tahap 2: Peringatan Klinis &amp; Konseling (Burnout Tinggi)</span>
                    <span class="text-[#4a6366] font-mono">Langkah 2 dari 5</span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#b3261e] animate-pulse"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                </div>
                <div class="flex justify-between text-[11px] text-[#4a6366] mt-2 font-medium overflow-x-auto gap-2">
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 1. Pre-Test</span>
                    <span class="text-[#b3261e] font-bold shrink-0">★ 2. Peringatan Klinis</span>
                    <span class="shrink-0">3. Game Katarsis</span>
                    <span class="shrink-0">4. Kirim Pesan</span>
                    <span class="shrink-0">5. Post-Test</span>
                </div>
            </div>

            <!-- Main High Alert Card -->
            <div class="bg-white border-2 border-red-200 rounded-3xl overflow-hidden shadow-lg">
                <!-- Header with Alert Icon -->
                <div class="bg-[#b3261e] text-white p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center text-3xl shrink-0 animate-bounce">
                            🔔
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-mono tracking-wider text-white/80 block">Evaluasi Tingkat Stres Tinggi</span>
                            <h1 class="font-display text-2xl sm:text-3xl font-extrabold">
                                Peringatan: Burnout Kategori Tinggi
                            </h1>
                            <p class="text-xs text-white/90 mt-0.5">
                                Terdeteksi pada hasil evaluasi instrumen Maslach Burnout Inventory (MBI).
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/20 px-4 py-2 rounded-2xl text-center shrink-0 w-full sm:w-auto">
                        <span class="text-[10px] uppercase font-mono block text-white/80">Skor Burnout</span>
                        <strong class="text-2xl font-mono font-bold">{{ number_format($latestPreTest->percentage ?? 82, 1) }}%</strong>
                        <span class="block text-[10px] text-white/80">{{ $latestPreTest->total_score ?? 82 }} / 132 poin</span>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-6">

                    <!-- Narasi Bahaya Klinis (Sesuai Catatan Tulisan Tangan SS 1) -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-red-50 border border-red-200 text-xs sm:text-sm text-red-950 space-y-3">
                        <div class="flex items-center gap-2 text-red-800 font-bold text-sm sm:text-base">
                            <span>⚠️</span>
                            <h4>Mengapa Burnout Tinggi Membutuhkan Perhatian Segera?</h4>
                        </div>
                        <p class="leading-relaxed">
                            Kelelahan emosional dan depersonalisasi tingkat tinggi yang tidak segera ditangani dapat menimbulkan dampak signifikan bagi Anda maupun lingkungan kerja:
                        </p>
                        <ul class="space-y-2 pl-4 list-disc text-xs sm:text-sm leading-relaxed text-red-900">
                            <li>
                                <strong>Bahaya Terhadap Keselamatan Pasien (<em>Patient Safety</em>):</strong> Kelelahan kognitif menurunkan konsentrasi dan ketelitian, memicu risiko kesalahan pemberian dosis obat (<em>medication error</em>), kelalaian identifikasi pasien, atau miskomunikasi dalam operan jaga (SBAR).
                            </li>
                            <li>
                                <strong>Bahaya Terhadap Kesehatan Fisik &amp; Mental Perawat:</strong> Memicu insomnia berkepanjangan, sakit kepala tegang kronis, penurunan imunitas tubuh yang rentan infeksi, kelelahan fisik ekstrem, dan risiko cedera jarum suntik (<em>needle stick injury</em>).
                            </li>
                            <li>
                                <strong>Faktor Penyebab:</strong> Akumulasi beban dinas tanpa jeda pemulihan yang cukup, tuntutan emosional menghadapi pasien kritis/keluarga pasien, dan ritme rotasi shift kerja yang padat.
                            </li>
                        </ul>
                    </div>

                    <!-- Rekomendasi Konseling Psikoterapi (SS 1 & File 3) -->
                    <div class="p-5 rounded-2xl bg-[#eef6f4] border-l-4 border-[#0b6b63] space-y-3">
                        <div class="flex items-center gap-2 text-[#0b6b63] font-bold text-sm sm:text-base">
                            <span>🩺</span>
                            <h4>Rekomendasi Utama: Segera Jalani Konseling Psikoterapi</h4>
                        </div>
                        <p class="text-xs sm:text-sm text-[#132628] leading-relaxed">
                            Kami sangat menyarankan Anda untuk berkonsultasi dengan <strong>Tim Konselor Psikoterapi / Psikolog Klinis RSUD Welas Asih</strong>. Pendampingan psikoterapi akan membantu Anda memulihkan cadangan energi emosional, mengurai beban stres kerja, dan memulihkan ritme istirahat secara terukur.
                        </p>

                        <!-- Kutipan Ilmiah File 3 -->
                        <blockquote class="p-3.5 bg-white/80 rounded-xl border border-[#b2ded8] text-xs italic text-[#06302a] leading-relaxed">
                            “Bertemu konselor atau psikolog bukan berarti Anda lemah atau gagal. Itu adalah wujud tanggung jawab profesional merawat diri sendiri, sama seperti dedikasi Anda merawat pasien.”
                            <cite class="block font-sans not-italic text-[10px] text-[#4a6366] mt-1 font-semibold">
                                — (Clement et al., 2015; Henderson et al., 2013)
                            </cite>
                        </blockquote>
                    </div>

                    <!-- Akses Kontak Konseling RSUD Welas Asih -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="space-y-1 text-center sm:text-left">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#0b6b63] font-mono">
                                Layanan Pendampingan Psikologis Staf
                            </h4>
                            <p class="text-sm font-bold text-[#132628]">
                                Unit Bimbingan &amp; Konseling RSUD Welas Asih
                            </p>
                            <p class="text-xs text-[#4a6366]">
                                Ruang Konsultasi Lt. 2 Gedung Poliklinik · WhatsApp: 0812-3456-7890 (Kerahasiaan Terjamin)
                            </p>
                        </div>
                        <a
                            href="https://wa.me/?text=Halo%20Tim%20Konseling%20RSUD%20Welas%20Asih,%20saya%20perawat%20Ruang%20UBK%202%20ingin%20berkonsultasi%20terkait%20hasil%20burnout%20tinggi."
                            target="_blank"
                            class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#047857] hover:bg-[#065f46] text-white text-xs font-bold transition shadow-xs"
                        >
                            <span>Hubungi Konseling via WA</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>

                    <!-- Confirmation Form & Next Step -->
                    <form method="POST" action="{{ route('intervention.store') }}" class="pt-2">
                        @csrf
                        <input type="hidden" name="type" value="counseling_alert">
                        <input type="hidden" name="tension_before" value="8">
                        <input type="hidden" name="tension_after" value="6">
                        <input type="hidden" name="duration_seconds" value="60">
                        <input type="hidden" name="notes" value="Rujukan Konseling Psikoterapi RSUD Welas Asih (Skor Burnout Tinggi)">

                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <button
                                type="submit"
                                class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.98]"
                            >
                                Saya Mengerti &amp; Lanjut ke Game Katarsis &rarr;
                            </button>
                            <button
                                type="button"
                                id="toggleSoundBtn"
                                class="w-full sm:w-auto px-4 py-3.5 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition"
                            >
                                🔊 Bunyikan Contoh Sirene Alarm
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- Web Audio Siren Alarm Script (File 3) -->
    <script>
    (function(){
        let audioCtx = null;
        let isMuted = false;
        let sirenOscillators = [];
        let currentMaster = null;

        function getAudioContext(){
            if(!audioCtx){
                const AC = window.AudioContext || window.webkitAudioContext;
                if(AC) audioCtx = new AC();
            }
            if(audioCtx && audioCtx.state === 'suspended'){
                audioCtx.resume();
            }
            return audioCtx;
        }

        // Web Audio Two-tone Alternating Siren (File 3)
        function playSiren(){
            if(isMuted) return;
            const ctx = getAudioContext();
            if(!ctx) return;

            try {
                const t0 = ctx.currentTime + 0.05;
                const master = ctx.createGain();
                master.gain.value = 0.5; // volume
                master.connect(ctx.destination);
                currentMaster = master;

                for(let i = 0; i < 6; i++){
                    const o = ctx.createOscillator(), g = ctx.createGain();
                    const t = t0 + i * 0.5;
                    o.type = "square";
                    o.frequency.setValueAtTime(i % 2 ? 660 : 990, t);
                    g.gain.setValueAtTime(0.0001, t);
                    g.gain.exponentialRampToValueAtTime(0.25, t + 0.02);
                    g.gain.setValueAtTime(0.25, t + 0.38);
                    g.gain.exponentialRampToValueAtTime(0.0001, t + 0.46);
                    o.connect(g);
                    g.connect(master);
                    o.start(t);
                    o.stop(t + 0.5);
                    sirenOscillators.push(o);
                }
            } catch(e){
                console.warn("Autoplay policy or audio error:", e);
            }
        }

        function stopSiren(){
            try {
                if(currentMaster && audioCtx){
                    currentMaster.gain.setValueAtTime(0, audioCtx.currentTime);
                }
            } catch(e){}
        }

        // Play automatically on load
        window.addEventListener("DOMContentLoaded", () => {
            // Attempt autoplay
            playSiren();

            // Fallback: If browser blocked sound before first user interaction, trigger on first touch/click
            const resumeOnInteraction = () => {
                if(!isMuted && audioCtx && audioCtx.state === 'suspended'){
                    audioCtx.resume().then(() => playSiren());
                }
                window.removeEventListener("click", resumeOnInteraction);
                window.removeEventListener("touchstart", resumeOnInteraction);
            };
            window.addEventListener("click", resumeOnInteraction, { once: true });
            window.addEventListener("touchstart", resumeOnInteraction, { once: true });
        });

        // Toggle sound button
        const soundBtn = document.getElementById("baBannerSound");
        const toggleSoundBtn = document.getElementById("toggleSoundBtn");

        function toggleSound(){
            isMuted = !isMuted;
            if(isMuted){
                stopSiren();
                if(soundBtn) soundBtn.textContent = "🔇 Suara: Mati";
                if(toggleSoundBtn) toggleSoundBtn.textContent = "🔇 Suara: Mati";
            } else {
                playSiren();
                if(soundBtn) soundBtn.textContent = "🔊 Suara: Hidup";
                if(toggleSoundBtn) toggleSoundBtn.textContent = "🔊 Matikan Suara";
            }
        }

        if(soundBtn) soundBtn.onclick = toggleSound;
        if(toggleSoundBtn) toggleSoundBtn.onclick = toggleSound;

        const openBtn = document.getElementById("baBannerOpen");
        if(openBtn){
            openBtn.onclick = () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
        }
    })();
    </script>
</x-app-layout>

