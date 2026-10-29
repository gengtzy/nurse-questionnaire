<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 5 Steps Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#0b6b63] uppercase tracking-wider font-mono">Tahap 2: Intervensi Relaksasi EFT (Burnout Rendah)</span>
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
                    <span class="text-[#0b6b63] font-bold shrink-0">★ 2. Relaksasi EFT</span>
                    <span class="shrink-0">3. Game Katarsis</span>
                    <span class="shrink-0">4. Kirim Pesan</span>
                    <span class="shrink-0">5. Post-Test</span>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-2.5 max-w-lg">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold uppercase tracking-wide border border-[#b2ded8]">
                            <span>🌿 Emotional Freedom Technique (EFT)</span>
                        </div>
                        <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-[#132628]">
                            Tenang – Jeda Relaksasi Mandiri
                        </h1>
                        <p class="text-xs sm:text-sm text-[#4a6366] leading-relaxed">
                            Panduan relaksasi berbasis <em>Emotional Freedom Technique</em> (EFT) untuk perawat: ketuk titik-titik akupresur tubuh sambil menyebutkan perasaanmu, lalu rasakan perubahannya.
                        </p>
                    </div>

                    <!-- Breathing Orb & Relaxation Audio Card -->
                    <div class="flex flex-col items-center gap-3 shrink-0 w-full sm:w-auto">
                        <div class="relative flex items-center justify-center">
                            <div id="orb" class="w-32 h-32 rounded-full bg-gradient-to-br from-[#bfe6df] to-[#2f8f83] flex items-center justify-center text-white font-bold text-sm shadow-md transition-transform duration-1000 transform scale-75">
                                <span id="orbTxt" class="text-[#06302a] text-center font-medium px-2">Siap?</span>
                            </div>
                        </div>
                        <button id="bBtn" type="button" class="px-4 py-2 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition">
                            Latihan Napas 1 Menit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Audio Controller Bar -->
            <div class="bg-[#f0fdf9] border border-[#b2ded8] rounded-2xl p-4 flex flex-wrap items-center justify-between gap-3 text-xs text-[#06302a]">
                <div class="flex items-center gap-3">
                    <button id="aBtn" type="button" class="px-3.5 py-2 rounded-xl bg-[#0b6b63] text-white font-semibold hover:bg-[#08524c] transition shadow-xs">
                        ♪ Putar Audio Penenang
                    </button>
                    <select id="aType" class="py-1.5 px-3 rounded-xl border border-[#b2ded8] bg-white text-xs font-medium text-[#132628]">
                        <option value="ombak">Ombak pelan</option>
                        <option value="hujan">Hujan lembut</option>
                        <option value="nada">Nada tenang</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[#4a6366]">Volume:</span>
                    <input type="range" id="aVol" min="0" max="100" value="40" class="w-24 accent-[#0b6b63]">
                </div>
            </div>

            <!-- Sesi EFT Mandiri Card -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6" id="sesiEFT">
                <div>
                    <h2 class="font-display text-xl font-bold text-[#132628]">
                        Sesi EFT Mandiri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4a6366] mt-0.5">
                        Satu putaran sekitar 3–5 menit. Ikuti langkah-langkah di bawah ini secara bertahap.
                    </p>
                </div>

                <!-- STEP 1: Skala & Isu -->
                <div class="p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] space-y-4" id="s1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-[#132628]">
                            1. Seberapa berat perasaanmu saat ini?
                        </h3>
                        <span class="text-xs font-mono font-bold text-[#0b6b63]" id="preVDisplay">Skala: 6 / 10</span>
                    </div>
                    <p class="text-xs text-[#4a6366]">Skala 0 (tenang/rileks) sampai 10 (sangat tertekan/lelah).</p>
                    <input type="range" id="pre" min="0" max="10" value="6" class="w-full accent-[#0b6b63]">
                    <div class="flex justify-between text-[11px] text-[#4a6366]">
                        <span>0 Tenang</span>
                        <span class="font-bold text-lg text-[#0b6b63]" id="preV">6</span>
                        <span>10 Sangat Tertekan</span>
                    </div>

                    <div class="pt-2">
                        <label for="issue" class="block text-xs font-semibold text-[#132628] mb-1">
                            Apa yang paling membebanimu saat ini? (opsional)
                        </label>
                        <input
                            type="text"
                            id="issue"
                            maxlength="100"
                            placeholder="Contoh: Operan shift padat, pasien kritis berturut-turut, lelah fisik..."
                            class="w-full rounded-xl border border-[#d2dedc] bg-white px-3.5 py-2.5 text-xs sm:text-sm text-[#132628] focus:border-[#0b6b63] focus:ring-2 focus:ring-[#0b6b63]/20"
                        >
                    </div>

                    <button id="go1" type="button" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-[#0b6b63] text-white font-bold text-xs hover:bg-[#08524c] transition shadow-xs">
                        Lanjut ke Kalimat Pengingat &rarr;
                    </button>
                </div>

                <!-- STEP 2: Kalimat Pengingat & Karate Chop -->
                <div class="p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] space-y-4 hidden" id="s2">
                    <h3 class="text-sm font-bold text-[#132628]">
                        2. Kalimat Pengingat (Set-up Phrase)
                    </h3>
                    <p class="text-xs text-[#4a6366]">
                        Ucapkan kalimat ini 3 kali sambil mengetuk sisi luar telapak tangan (<em>karate chop</em>).
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-6 py-2">
                        <!-- Karate Chop SVG Animation -->
                        <div class="shrink-0 bg-white p-3 rounded-2xl border border-[#d2dedc]">
                            <svg class="w-48 h-28" viewBox="0 0 220 120" role="img" aria-label="Animasi mengetuk sisi telapak tangan">
                                <g fill="#bfe6df" stroke="#4a6366" stroke-width="2">
                                    <rect x="44" y="8" width="14" height="38" rx="7"/>
                                    <rect x="62" y="2" width="14" height="44" rx="7"/>
                                    <rect x="80" y="6" width="14" height="40" rx="7"/>
                                    <rect x="98" y="16" width="13" height="32" rx="6.5"/>
                                    <rect x="38" y="34" width="74" height="78" rx="24"/>
                                </g>
                                <line x1="113" y1="58" x2="113" y2="100" stroke="#0b6b63" stroke-width="5" stroke-linecap="round"/>
                                <circle cx="113" cy="79" r="8" fill="none" stroke="#0b6b63" stroke-width="2" class="animate-ping"/>
                                <g transform="translate(118 79)">
                                    <g class="animate-bounce">
                                        <rect x="0" y="-11" width="40" height="9" rx="4.5" fill="#0b6b63" opacity="0.8"/>
                                        <rect x="0" y="2" width="40" height="9" rx="4.5" fill="#0b6b63" opacity="0.8"/>
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <!-- Affirmation Bubble -->
                        <div class="flex-1 bg-[#dbeeeb] border border-[#b2ded8] text-[#06302a] p-4 rounded-2xl italic font-serif text-sm leading-relaxed" id="setup">
                            “Meskipun saya merasa lelah, saya menerima diri saya sepenuhnya dan apa adanya.”
                        </div>
                    </div>

                    <button id="go2" type="button" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-[#0b6b63] text-white font-bold text-xs hover:bg-[#08524c] transition shadow-xs">
                        Mulai Mengetuk Titik EFT &rarr;
                    </button>
                </div>

                <!-- STEP 3: Ketuk Titik demi Titik -->
                <div class="p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] space-y-4 hidden" id="s3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-[#d2dedc] pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-[#132628]">
                                3. Ketuk Titik demi Titik
                            </h3>
                            <p class="text-xs text-[#4a6366]">
                                Ketuk lembut 5–7 kali di setiap titik mengikuti panduan instruktur.
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-mono font-bold text-[#0b6b63]" id="pCount">1 dari 9 Titik</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                        <!-- Human Figure SVG -->
                        <div class="md:col-span-5 flex justify-center bg-white p-4 rounded-2xl border border-[#d2dedc] relative">
                            <svg id="fig" viewBox="0 0 200 240" class="w-48 h-56" role="img" aria-label="Instruktur tubuh EFT">
                                <g id="human">
                                    <rect x="86" y="96" width="28" height="50" rx="10" fill="#e2b08c"/>
                                    <path d="M30 232 Q34 150 100 140 Q166 150 170 232Z" fill="#2f8f83"/>
                                    <path d="M78 143 Q100 172 122 143 Q100 150 78 143Z" fill="#e2b08c"/>
                                    <circle cx="58" cy="66" r="7" fill="#e2b08c"/><circle cx="142" cy="66" r="7" fill="#e2b08c"/>
                                    <circle cx="100" cy="62" r="42" fill="#e2b08c"/>
                                    <path d="M57 62 Q50 14 100 14 Q150 14 143 62 Q132 34 100 34 Q68 34 57 62Z" fill="#2b2b3a"/>
                                    <circle cx="80" cy="60" r="3.2" fill="#15303a"/><circle cx="120" cy="60" r="3.2" fill="#15303a"/>
                                    <path d="M90 89 Q100 96 110 89" fill="none" stroke="#a5604a" stroke-width="2.4" stroke-linecap="round"/>
                                </g>
                                <g id="dots"></g>
                                <g id="tapper" class="transition-transform duration-500 ease-in-out" style="transform:translate(150px,212px)">
                                    <circle id="ring" r="14" fill="none" stroke="#0b6b63" stroke-width="3" stroke-dasharray="90" stroke-dashoffset="0"/>
                                    <circle r="7" fill="#0b6b63" class="animate-ping opacity-60"/>
                                </g>
                            </svg>
                        </div>

                        <!-- Current Point Details & Controls -->
                        <div class="md:col-span-7 space-y-3">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-base text-[#132628]" id="pName">Sisi telapak tangan</h4>
                                <span class="text-xs font-mono bg-white px-2.5 py-1 rounded-full border border-[#d2dedc] text-[#0b6b63]" id="timer">15 dtk</span>
                            </div>
                            <p class="text-xs text-[#4a6366] leading-relaxed" id="pDesc">
                                Ketuk sisi telapak tangan yang sejajar dengan jari kelingking (karate chop).
                            </p>

                            <!-- Affirmation Reminder -->
                            <div class="bg-[#dbeeeb] text-[#06302a] text-xs font-serif italic p-3 rounded-xl border border-[#b2ded8]" id="pPhrase">
                                “Meski saya merasa lelah, saya tetap berharga dan berdaya.”
                            </div>

                            <!-- Progress Bar -->
                            <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                <div id="bar" class="bg-[#0b6b63] h-full transition-all duration-300" style="width: 11%"></div>
                            </div>

                            <!-- Action Controls -->
                            <div class="flex items-center gap-2 pt-2">
                                <button id="prev" type="button" class="px-3 py-2 rounded-xl border border-[#d2dedc] bg-white text-xs font-semibold text-[#132628] hover:bg-[#f1f5f4] transition" disabled>
                                    &larr; Sebelumnya
                                </button>
                                <button id="play" type="button" class="px-5 py-2 rounded-xl bg-[#0b6b63] text-white text-xs font-bold hover:bg-[#08524c] transition shadow-xs">
                                    Mulai Mengetuk
                                </button>
                                <button id="next" type="button" class="px-3 py-2 rounded-xl border border-[#d2dedc] bg-white text-xs font-semibold text-[#132628] hover:bg-[#f1f5f4] transition">
                                    Berikutnya &rarr;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Evaluasi Akhir & Simpan Hasil -->
                <div class="p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] space-y-4 hidden" id="s4">
                    <h3 class="text-sm font-bold text-[#132628]">
                        4. Tarik Napas Dalam, Lalu Nilai Kembali
                    </h3>
                    <p class="text-xs text-[#4a6366]">
                        Setelah menyelesaikan putaran ketukan, bagaimana tingkat perasaan/bebanmu saat ini?
                    </p>

                    <input type="range" id="post" min="0" max="10" value="3" class="w-full accent-[#0b6b63]">
                    <div class="flex justify-between text-[11px] text-[#4a6366]">
                        <span>0 Tenang</span>
                        <span class="font-bold text-lg text-[#0b6b63]" id="postV">3</span>
                        <span>10 Sangat Tertekan</span>
                    </div>

                    <!-- Comparison Result Callout -->
                    <div class="p-4 rounded-xl bg-white border border-[#d2dedc] text-xs text-[#132628] flex items-center justify-between gap-4">
                        <div>
                            <span class="text-[#4a6366] block">Perubahan Tingkat Tekanan:</span>
                            <strong class="text-sm text-[#0b6b63]" id="result">Tekanan Anda turun 3 poin. Tubuh terasa lebih rileks.</strong>
                        </div>
                        <div class="flex items-center gap-2 text-center shrink-0">
                            <div class="bg-[#f1f5f4] p-2 rounded-lg">
                                <span class="text-[10px] text-[#4a6366] block">Sebelum</span>
                                <strong class="text-sm text-[#132628]" id="bScore">6</strong>
                            </div>
                            <span class="text-[#0b6b63] font-bold">&rarr;</span>
                            <div class="bg-[#dbeeeb] p-2 rounded-lg">
                                <span class="text-[10px] text-[#0b6b63] block">Sesudah</span>
                                <strong class="text-sm text-[#0b6b63]" id="aScore">3</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Final Submission Form -->
                    <form method="POST" action="{{ route('intervention.store') }}" id="formEFT" class="pt-2">
                        @csrf
                        <input type="hidden" name="type" value="eft">
                        <input type="hidden" name="tension_before" id="inputBefore" value="6">
                        <input type="hidden" name="tension_after" id="inputAfter" value="3">
                        <input type="hidden" name="duration_seconds" id="inputDuration" value="180">
                        <input type="hidden" name="notes" id="inputNotes" value="">

                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.98]">
                                Simpan &amp; Lanjut ke Game Stres &rarr;
                            </button>
                            <button type="button" id="again" class="w-full sm:w-auto px-4 py-3 rounded-xl border border-[#d2dedc] bg-white hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition">
                                Ulangi Putaran EFT
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Web Audio Synthesis & EFT Interactive Script -->
    <script>
    (function(){
        const $ = id => document.getElementById(id);
        const pts = [
            {n:"Sisi telapak tangan", d:"Ketuk sisi telapak tangan yang sejajar dengan jari kelingking (karate chop).", x:150, y:212},
            {n:"Puncak kepala", d:"Ketuk bagian tengah atas kepala dengan lembut.", x:100, y:20},
            {n:"Awal alis", d:"Ketuk pangkal alis, dekat pangkal hidung.", x:88, y:48},
            {n:"Sisi mata", d:"Ketuk tulang di sisi luar mata.", x:62, y:60},
            {n:"Bawah mata", d:"Ketuk tulang tepat di bawah mata.", x:84, y:72},
            {n:"Bawah hidung", d:"Ketuk area di antara hidung dan bibir atas.", x:100, y:82},
            {n:"Dagu", d:"Ketuk lekukan di antara bibir bawah dan dagu.", x:100, y:98},
            {n:"Tulang selangka", d:"Ketuk area di bawah tulang selangka, dekat leher.", x:80, y:140},
            {n:"Bawah lengan", d:"Ketuk sisi tubuh sekitar 10 cm di bawah ketiak.", x:44, y:176}
        ];

        const SEC = 15;
        let cur = 0, tm = null, left = SEC, issue = "", totalDuration = 0;

        // Render Dots on SVG
        const dots = $("dots");
        dots.innerHTML = pts.map((p,i)=>`<circle id="d${i}" cx="${p.x}" cy="${p.y}" r="5" fill="#d2dedc" stroke="#0b6b63" stroke-width="1.5"/>`).join("");

        function showPoint(i){
            cur = i; left = SEC;
            pts.forEach((_,k)=>{
                const el = $("d"+k);
                if(el){
                    el.setAttribute("fill", k===i ? "#0b6b63" : "#d2dedc");
                    el.setAttribute("r", k===i ? "8" : "5");
                }
            });
            $("pName").textContent = pts[i].n;
            $("pDesc").textContent = pts[i].d;
            $("pCount").textContent = (i+1) + " dari " + pts.length + " Titik";
            $("pPhrase").textContent = "“Meski " + (issue || "saya merasa lelah dan tertekan") + ", saya tetap berharga dan berdaya.”";
            $("bar").style.width = ((i+1)/pts.length*100) + "%";
            $("timer").textContent = SEC + " dtk";
            $("prev").disabled = (i === 0);
            $("tapper").style.transform = `translate(${pts[i].x}px, ${pts[i].y}px)`;
        }

        function stopEFT(){
            if(tm){ clearInterval(tm); tm = null; }
            $("play").textContent = "Lanjut";
        }

        function tickEFT(){
            left--;
            totalDuration++;
            $("timer").textContent = left + " dtk";
            if(left <= 0){
                if(cur < pts.length - 1){
                    showPoint(cur + 1);
                } else {
                    stopEFT();
                    finishEFT();
                }
            }
        }

        function finishEFT(){
            stopAmbient();
            $("s4").classList.remove("hidden");
            $("inputDuration").value = Math.max(60, totalDuration);
            $("s4").scrollIntoView({behavior:"smooth", block:"center"});
            calcResult();
        }

        $("play").onclick = () => {
            if(tm){
                stopEFT();
            } else {
                $("play").textContent = "Jeda";
                tm = setInterval(tickEFT, 1000);
                startAmbient();
            }
        };

        $("next").onclick = () => {
            if(cur < pts.length - 1) showPoint(cur + 1);
            else { stopEFT(); finishEFT(); }
        };

        $("prev").onclick = () => {
            if(cur > 0) showPoint(cur - 1);
        };

        $("pre").oninput = e => {
            $("preV").textContent = e.target.value;
            $("preVDisplay").textContent = "Skala: " + e.target.value + " / 10";
            $("inputBefore").value = e.target.value;
            $("bScore").textContent = e.target.value;
            calcResult();
        };

        $("post").oninput = e => {
            $("postV").textContent = e.target.value;
            $("inputAfter").value = e.target.value;
            $("aScore").textContent = e.target.value;
            calcResult();
        };

        $("go1").onclick = () => {
            issue = $("issue").value.trim();
            $("inputNotes").value = issue;
            $("setup").textContent = "“Meskipun " + (issue || "saya merasa lelah dan tertekan") + ", saya menerima diri saya sepenuhnya dan apa adanya.”";
            $("s2").classList.remove("hidden");
            $("s2").scrollIntoView({behavior:"smooth", block:"center"});
        };

        $("go2").onclick = () => {
            $("s3").classList.remove("hidden");
            showPoint(0);
            $("s3").scrollIntoView({behavior:"smooth", block:"center"});
        };

        function calcResult(){
            const a = parseInt($("pre").value, 10);
            const b = parseInt($("post").value, 10);
            const diff = a - b;
            if(diff > 0){
                $("result").textContent = `Tekanan Anda berhasil turun ${diff} poin (dari ${a} menjadi ${b}). Tubuh terasa lebih rileks.`;
            } else if(diff === 0){
                $("result").textContent = `Skor tetap ${a}. Relaksasi menjaga kestabilan energi Anda.`;
            } else {
                $("result").textContent = `Skor sedikit naik. Tarik napas perlahan dan ambil jeda istirahat sejenak.`;
            }
        }

        $("again").onclick = () => {
            stopEFT();
            stopAmbient();
            ["s2","s3","s4"].forEach(id => $(id).classList.add("hidden"));
            $("s1").scrollIntoView({behavior:"smooth"});
        };

        // Latihan Napas 4-4-6
        let breathTimer = null;
        $("bBtn").onclick = () => {
            const orb = $("orb"), txt = $("orbTxt");
            if(breathTimer){
                clearTimeout(breathTimer); breathTimer = null;
                orb.classList.remove("scale-100");
                orb.classList.add("scale-75");
                txt.textContent = "Siap?";
                $("bBtn").textContent = "Latihan Napas 1 Menit";
                return;
            }
            $("bBtn").textContent = "Berhenti Latihan";
            let cycles = 0;
            const cycle = () => {
                if(cycles >= 4){
                    breathTimer = null;
                    orb.classList.remove("scale-100");
                    orb.classList.add("scale-75");
                    txt.textContent = "Selesai!";
                    $("bBtn").textContent = "Latihan Napas 1 Menit";
                    return;
                }
                orb.classList.remove("scale-75");
                orb.classList.add("scale-100");
                txt.textContent = "Tarik Napas...";
                breathTimer = setTimeout(()=>{
                    txt.textContent = "Tahan...";
                    breathTimer = setTimeout(()=>{
                        orb.classList.remove("scale-100");
                        orb.classList.add("scale-75");
                        txt.textContent = "Hembuskan...";
                        cycles++;
                        breathTimer = setTimeout(cycle, 6000);
                    }, 4000);
                }, 4000);
            };
            cycle();
        };

        // Web Audio Synthesizer (Zero External Audio Dependency)
        let audioCtx = null, masterGain = null, isPlaying = false;
        const aBtn = $("aBtn"), aType = $("aType"), aVol = $("aVol");

        function getAudioContext(){
            if(!audioCtx){
                const AC = window.AudioContext || window.webkitAudioContext;
                if(AC) audioCtx = new AC();
            }
            if(audioCtx && audioCtx.state === 'suspended') audioCtx.resume();
            return audioCtx;
        }

        function createNoiseBuffer(ctx, type){
            const length = ctx.sampleRate * 4;
            const buffer = ctx.createBuffer(1, length, ctx.sampleRate);
            const data = buffer.getChannelData(0);
            let lastOut = 0.0;
            for(let i=0; i<length; i++){
                const white = Math.random() * 2 - 1;
                if(type === 'pink'){
                    lastOut = (lastOut + 0.02 * white) / 1.02;
                    data[i] = lastOut * 3.5;
                } else {
                    data[i] = white * 0.4;
                }
            }
            return buffer;
        }

        let noiseSource = null;
        function startAmbient(){
            if(isPlaying) return;
            const ctx = getAudioContext();
            if(!ctx) return;
            try {
                masterGain = ctx.createGain();
                masterGain.gain.value = (aVol.value / 100) * 0.4;
                masterGain.connect(ctx.destination);

                const kind = aType.value;
                if(kind === 'ombak' || kind === 'hujan'){
                    const buf = createNoiseBuffer(ctx, kind === 'ombak' ? 'pink' : 'white');
                    noiseSource = ctx.createBufferSource();
                    noiseSource.buffer = buf;
                    noiseSource.loop = true;

                    const filter = ctx.createBiquadFilter();
                    filter.type = kind === 'ombak' ? 'lowpass' : 'bandpass';
                    filter.frequency.value = kind === 'ombak' ? 500 : 1200;

                    noiseSource.connect(filter);
                    filter.connect(masterGain);
                    noiseSource.start();
                } else {
                    // Nada Tenang (Ambient Sine Harmonic)
                    const osc = ctx.createOscillator();
                    osc.type = 'sine';
                    osc.frequency.value = 220; // A3
                    osc.connect(masterGain);
                    osc.start();
                    noiseSource = osc;
                }
                isPlaying = true;
                aBtn.textContent = "■ Hentikan Audio";
            } catch(e) {
                console.warn(e);
            }
        }

        function stopAmbient(){
            if(!isPlaying) return;
            try {
                if(noiseSource){ noiseSource.stop(); noiseSource.disconnect(); noiseSource = null; }
                if(masterGain){ masterGain.disconnect(); masterGain = null; }
            } catch(e){}
            isPlaying = false;
            aBtn.textContent = "♪ Putar Audio Penenang";
        }

        aBtn.onclick = () => {
            if(isPlaying) stopAmbient();
            else startAmbient();
        };

        aVol.oninput = e => {
            if(masterGain && audioCtx){
                masterGain.gain.setValueAtTime((e.target.value / 100) * 0.4, audioCtx.currentTime);
            }
        };

        aType.onchange = () => {
            if(isPlaying){ stopAmbient(); startAmbient(); }
        };
    })();
    </script>
</x-app-layout>

