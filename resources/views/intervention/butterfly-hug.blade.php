<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 5 Steps Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#0b6b63] uppercase tracking-wider font-mono">Tahap 2: Intervensi Relaksasi Klinis</span>
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
                    <span class="shrink-0">4. Apresiasi</span>
                    <span class="shrink-0">5. Post-Test</span>
                </div>
            </div>

            <!-- Header Info -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold uppercase tracking-wide border border-[#b2ded8]">
                    <span>🦋 Relaksasi Burnout Perawat</span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-[#132628]">
                    Butterfly Hug (Pelukan Kupu-Kupu)
                </h1>
                <p class="text-xs sm:text-sm text-[#4a6366] max-w-lg mx-auto leading-relaxed">
                    Tepuk dada bagian atas secara bergantian, kiri dan kanan, sambil mengatur ritme napas. Sangat efektif meredakan ketegangan fisik dan beban mental di sela giliran jaga.
                </p>
            </div>

            @if (session('info'))
                <div class="p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs">
                    {{ session('info') }}
                </div>
            @endif

            @if (session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Interactive Stage Card -->
            <div class="bg-white border border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs flex flex-col items-center gap-5 relative overflow-hidden">
                <!-- Butterfly Canvas / SVG Stage -->
                <div class="relative w-full max-w-[320px] aspect-[320/260]">
                    <svg viewBox="0 0 320 260" class="w-full h-full overflow-visible" role="img" aria-label="Kupu-kupu dengan sayap kiri dan kanan yang menyala bergantian mengikuti tepukan">
                        <!-- Breathing Guide Ring -->
                        <circle
                            id="ring"
                            cx="160"
                            cy="130"
                            r="116"
                            class="fill-[#dbeeeb]/50 transition-transform duration-[4000ms] ease-in-out"
                            style="transform-origin: center; transform: scale(0.78);"
                        />

                        <!-- Left Wing -->
                        <g id="wingL" class="wing transition-all duration-300 ease-out" style="transform-origin: center;">
                            <path d="M156 122 C122 42 34 30 34 100 C34 150 108 160 156 132 Z" class="fill-[#0b6b63]/25 stroke-[#0b6b63] stroke-2 transition-all duration-300" />
                            <path d="M156 138 C122 168 66 226 104 236 C140 244 156 192 156 150 Z" class="fill-[#0b6b63]/25 stroke-[#0b6b63] stroke-2 transition-all duration-300" />
                        </g>

                        <!-- Right Wing -->
                        <g id="wingR" class="wing transition-all duration-300 ease-out" style="transform-origin: center;">
                            <g transform="translate(320 0) scale(-1 1)">
                                <path d="M156 122 C122 42 34 30 34 100 C34 150 108 160 156 132 Z" class="fill-[#0b6b63]/25 stroke-[#0b6b63] stroke-2 transition-all duration-300" />
                                <path d="M156 138 C122 168 66 226 104 236 C140 244 156 192 156 150 Z" class="fill-[#0b6b63]/25 stroke-[#0b6b63] stroke-2 transition-all duration-300" />
                            </g>
                        </g>

                        <!-- Butterfly Body -->
                        <rect x="157" y="104" width="6" height="74" rx="3" class="fill-[#132628]" />
                        <path d="M159 104 C154 86 144 78 136 76 M161 104 C166 86 176 78 184 76" class="stroke-[#132628] stroke-[3] stroke-linecap-round fill-none" />
                    </svg>
                </div>

                <!-- Guidance Cues -->
                <div class="text-center min-h-[60px]" aria-live="polite">
                    <p id="phase" class="font-display font-bold text-2xl text-[#132628]">Siap Dimulai</p>
                    <p id="sub" class="text-xs text-[#4a6366] font-mono mt-1">Atur durasi dan irama, lalu tekan Mulai.</p>
                </div>

                <!-- Progress Bar -->
                <div class="w-full h-2 rounded-full bg-[#f1f5f4] overflow-hidden border border-[#d2dedc]/60">
                    <div id="progress" class="h-full w-0 bg-gradient-to-r from-[#0b6b63] to-[#14b8a6] transition-all duration-75"></div>
                </div>

                <!-- Controls Form -->
                <div class="w-full space-y-4 pt-2">
                    <!-- Durasi -->
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-[#4a6366] mb-2">Pilih Durasi Sesi:</span>
                        <div class="grid grid-cols-3 gap-2 text-xs">
                            <label class="dur-label cursor-pointer text-center py-2.5 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] font-semibold text-[#132628] transition hover:border-[#0b6b63]">
                                <input type="radio" name="dur" value="60" class="sr-only">
                                <span>1 Menit</span>
                            </label>
                            <label class="dur-label cursor-pointer text-center py-2.5 px-3 rounded-xl border-2 border-[#0b6b63] bg-[#dbeeeb] font-bold text-[#0b6b63] transition shadow-xs">
                                <input type="radio" name="dur" value="120" checked class="sr-only">
                                <span>2 Menit</span>
                            </label>
                            <label class="dur-label cursor-pointer text-center py-2.5 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] font-semibold text-[#132628] transition hover:border-[#0b6b63]">
                                <input type="radio" name="dur" value="180" class="sr-only">
                                <span>3 Menit</span>
                            </label>
                        </div>
                    </div>

                    <!-- Irama Tepukan -->
                    <div>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-[#4a6366] mb-2">Irama Ketukan:</span>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <label class="tempo-label cursor-pointer text-center py-2 px-3 rounded-xl border-2 border-[#0b6b63] bg-[#dbeeeb] font-bold text-[#0b6b63] transition shadow-xs">
                                <input type="radio" name="tempo" value="1600" checked class="sr-only">
                                <span>Lambat (1.6 detik)</span>
                            </label>
                            <label class="tempo-label cursor-pointer text-center py-2 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] font-semibold text-[#132628] transition hover:border-[#0b6b63]">
                                <input type="radio" name="tempo" value="1000" class="sr-only">
                                <span>Sedang (1.0 detik)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Audio Toggle -->
                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-[#132628] font-medium">
                            <input type="checkbox" id="sound" checked class="rounded border-[#d2dedc] text-[#0b6b63] focus:ring-[#0b6b63]">
                            <span>Bunyi ritmis lembut kiri dan kanan (Audio Stereo)</span>
                        </label>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-2">
                        <button
                            id="go"
                            type="button"
                            class="w-full py-4 px-6 rounded-2xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-base shadow-md hover:shadow-lg transition active:scale-[0.99] cursor-pointer flex items-center justify-center gap-2"
                        >
                            <span id="goText">Mulai Sesi Butterfly Hug</span>
                            <span class="text-xl">🦋</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tension Check-in Scale (Sebelum & Sesudah) -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-7 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-[#d2dedc] pb-3">
                    <h2 class="font-display text-base sm:text-lg font-bold text-[#132628]">
                        Evaluasi Tingkat Ketegangan Tubuh
                    </h2>
                    <span class="text-[11px] font-mono text-[#0b6b63] bg-[#dbeeeb] px-2.5 py-0.5 rounded-full font-bold">
                        Skala 0–10
                    </span>
                </div>

                <div class="space-y-4">
                    <!-- Sebelum -->
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-[#132628] mb-1.5">
                            <label for="before">1. Sebelum Sesi Dimulai:</label>
                            <output id="beforeOut" class="font-mono text-base font-bold text-[#0b6b63]">6</output>
                        </div>
                        <input
                            type="range"
                            id="before"
                            min="0"
                            max="10"
                            step="1"
                            value="6"
                            class="w-full accent-[#0b6b63] cursor-pointer"
                        >
                        <div class="flex justify-between text-[11px] text-[#4a6366] mt-0.5 font-mono">
                            <span>0 (Sangat Santai)</span>
                            <span>10 (Sangat Tegang/Penuh)</span>
                        </div>
                    </div>

                    <!-- Sesudah -->
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-[#132628] mb-1.5">
                            <label for="after">2. Sesudah Sesi Selesai:</label>
                            <output id="afterOut" class="font-mono text-base font-bold text-[#0b6b63]">6</output>
                        </div>
                        <input
                            type="range"
                            id="after"
                            min="0"
                            max="10"
                            step="1"
                            value="6"
                            class="w-full accent-[#0b6b63] cursor-pointer"
                        >
                        <div class="flex justify-between text-[11px] text-[#4a6366] mt-0.5 font-mono">
                            <span>0 (Sangat Santai)</span>
                            <span>10 (Sangat Tegang/Penuh)</span>
                        </div>
                    </div>

                    <!-- Dynamic Evaluation Result Box -->
                    <div class="p-3.5 rounded-xl bg-[#f9fbfa] border border-[#d2dedc] text-xs text-[#132628]">
                        <p id="result" class="font-semibold text-center text-[#4a6366]">
                            Geser skala sebelum mulai, lalu sesuaikan lagi setelah sesi selesai.
                        </p>
                    </div>

                    <!-- Save & Next Step Form (Form submission) -->
                    <form id="interventionForm" method="POST" action="{{ route('intervention.store') }}" class="pt-2">
                        @csrf
                        <input type="hidden" name="tension_before" id="form_before" value="6">
                        <input type="hidden" name="tension_after" id="form_after" value="6">
                        <input type="hidden" name="duration_seconds" id="form_dur" value="120">
                        <input type="hidden" name="tempo_ms" id="form_tempo" value="1600">
                        <input type="hidden" name="taps_count" id="form_taps" value="0">
                        <input type="hidden" name="notes" id="form_notes" value="">

                        <button
                            type="submit"
                            id="btnSaveNext"
                            class="w-full py-3.5 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-sm transition active:scale-[0.99] cursor-pointer flex items-center justify-center gap-2"
                        >
                            <span>Simpan Sesi & Lanjut ke Tahap 3: Game Katarsis</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Cara Melakukannya Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-7 shadow-xs space-y-4">
                <h2 class="font-display text-base sm:text-lg font-bold text-[#132628] border-b border-[#d2dedc] pb-2.5">
                    Panduan Praktik Butterfly Hug
                </h2>
                <ol class="space-y-3 text-xs sm:text-sm text-[#132628]">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                        <div>
                            <strong>Duduk atau berdiri dengan nyaman:</strong>
                            <span class="text-[#4a6366] block text-xs mt-0.5">Turunkan bahu, tegakkan punggung tanpa dipaksa. Mata boleh terpejam atau menatap lembut ke layar.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                        <div>
                            <strong>Silangkan kedua lengan di depan dada:</strong>
                            <span class="text-[#4a6366] block text-xs mt-0.5">Letakkan ujung jari kedua tangan tepat di bawah tulang selangka. Kaitkan kedua ibu jari sehingga membentuk sayap kupu-kupu.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                        <div>
                            <strong>Tepuk bergantian, kiri lalu kanan:</strong>
                            <span class="text-[#4a6366] block text-xs mt-0.5">Ikuti ritme sayap yang menyala di layar. Tepukan ringan dan teratur, seperti sedang menenangkan bayi.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                        <div>
                            <strong>Atur ritme pernapasan:</strong>
                            <span class="text-[#4a6366] block text-xs mt-0.5">Tarik napas lewat hidung selama 4 hitungan, lalu hembuskan perlahan lewat mulut selama 6 hitungan.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">5</span>
                        <div>
                            <strong>Lepaskan dan rasakan perubahan:</strong>
                            <span class="text-[#4a6366] block text-xs mt-0.5">Setelah sesi selesai, turunkan tangan, ambil satu napas lega, lalu nilai penurunan ketegangan tubuh Anda.</span>
                        </div>
                    </li>
                </ol>

                <p class="text-[11px] text-[#4a6366] border-t border-[#d2dedc] pt-3 leading-relaxed">
                    💡 <em>Catatan:</em> Teknik ini merupakan stimulasi bilateral yang terbukti secara klinis membantu sistem saraf beralih dari mode stres (simpatis) ke mode pemulihan (parasimpatis).
                </p>
            </div>

            <!-- Back to Dashboard -->
            <div class="text-center pt-2 pb-6">
                <a href="{{ route('dashboard') }}" class="text-xs text-[#4a6366] hover:text-[#0b6b63] underline">
                    &larr; Kembali ke Beranda Dashboard
                </a>
            </div>

        </div>
    </div>

    <!-- Script Logika Butterfly Hug -->
    <script>
        (function () {
            var $ = function (id) { return document.getElementById(id); };
            var wingL = $('wingL'), wingR = $('wingR'), ring = $('ring');
            var phaseEl = $('phase'), subEl = $('sub'), prog = $('progress'), go = $('go'), goText = $('goText');
            var before = $('before'), after = $('after');
            var formBefore = $('form_before'), formAfter = $('form_after');
            var formDur = $('form_dur'), formTempo = $('form_tempo'), formTaps = $('form_taps'), formNotes = $('form_notes');
            var INHALE = 4000, EXHALE = 6000, CYCLE = INHALE + EXHALE;
            var timer = null, t0 = 0, dur = 120000, interval = 1600;
            var lastBeat = -1, lastPhase = '', taps = 0, ctx = null, running = false, sessionDone = false;

            function val(name) {
                var r = document.querySelector('input[name="' + name + '"]:checked');
                return r ? parseInt(r.value, 10) : 0;
            }

            function fmt(ms) {
                var s = Math.max(0, Math.ceil(ms / 1000));
                return Math.floor(s / 60) + ':' + ('0' + (s % 60)).slice(-2);
            }

            function tone(side) {
                if (!$('sound').checked) return;
                try {
                    if (!ctx) ctx = new (window.AudioContext || window.webkitAudioContext)();
                    if (ctx.state === 'suspended') ctx.resume();
                    var o = ctx.createOscillator(), g = ctx.createGain(), now = ctx.currentTime;
                    var p = ctx.createStereoPanner ? ctx.createStereoPanner() : null;
                    o.type = 'sine';
                    o.frequency.value = side === 0 ? 261.6 : 329.6;
                    g.gain.setValueAtTime(0.0001, now);
                    g.gain.exponentialRampToValueAtTime(0.08, now + 0.03);
                    g.gain.exponentialRampToValueAtTime(0.0001, now + 0.4);
                    o.connect(g);
                    if (p) {
                        p.pan.value = side === 0 ? -0.8 : 0.8;
                        g.connect(p);
                        p.connect(ctx.destination);
                    } else {
                        g.connect(ctx.destination);
                    }
                    o.start(now);
                    o.stop(now + 0.45);
                } catch (e) {
                    /* audio optional */
                }
            }

            function setRing(phase) {
                ring.style.transitionDuration = (phase === 'in' ? INHALE : EXHALE) + 'ms';
                ring.style.transform = 'scale(' + (phase === 'in' ? 1.05 : 0.78) + ')';
            }

            function resetWings() {
                var pL = wingL.querySelectorAll('path');
                var pR = wingR.querySelectorAll('path');
                pL.forEach(function(p) { p.classList.remove('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                pR.forEach(function(p) { p.classList.remove('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                wingL.style.transform = 'scale(1)';
                wingR.style.transform = 'scale(1)';
            }

            function tick() {
                var el = performance.now() - t0;
                if (el >= dur) {
                    finish();
                    return;
                }
                var beat = Math.floor(el / interval);
                if (beat !== lastBeat) {
                    lastBeat = beat;
                    taps++;
                    var side = beat % 2;
                    var pL = wingL.querySelectorAll('path');
                    var pR = wingR.querySelectorAll('path');

                    if (side === 0) {
                        wingL.style.transform = 'scale(1.08)';
                        wingR.style.transform = 'scale(1)';
                        pL.forEach(function(p) { p.classList.add('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                        pR.forEach(function(p) { p.classList.remove('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                    } else {
                        wingL.style.transform = 'scale(1)';
                        wingR.style.transform = 'scale(1.08)';
                        pR.forEach(function(p) { p.classList.add('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                        pL.forEach(function(p) { p.classList.remove('fill-[#e8501a]', 'stroke-[#e8501a]', 'fill-opacity-90'); });
                    }
                    tone(side);
                }

                var pos = el % CYCLE, ph = pos < INHALE ? 'in' : 'out';
                if (ph !== lastPhase) {
                    lastPhase = ph;
                    phaseEl.textContent = ph === 'in' ? 'Tarik Napas Pelan...' : 'Buang Napas Perlahan...';
                    phaseEl.className = 'font-display font-bold text-2xl ' + (ph === 'in' ? 'text-[#0b6b63]' : 'text-[#e8501a]');
                    setRing(ph);
                }

                subEl.textContent = 'Tepuk ' + (beat % 2 === 0 ? 'Kiri' : 'Kanan') + ' · Sisa ' + fmt(dur - el);
                prog.style.width = (el / dur * 100).toFixed(1) + '%';
            }

            function start() {
                dur = val('dur') * 1000;
                interval = val('tempo');
                running = true;
                sessionDone = false;
                lastBeat = -1;
                lastPhase = '';
                taps = 0;
                t0 = performance.now();
                goText.textContent = 'Hentikan Sesi';
                $('result').textContent = 'Sesi sedang berjalan... Nikmati setiap tarikan napas dan ketukan lembut.';
                tick();
                timer = setInterval(tick, 50);
            }

            function stop(msgTitle, msgSub) {
                clearInterval(timer);
                timer = null;
                running = false;
                resetWings();
                ring.style.transitionDuration = '4s';
                ring.style.transform = 'scale(0.78)';
                goText.textContent = 'Mulai Sesi Lagi';
                phaseEl.textContent = msgTitle;
                phaseEl.className = 'font-display font-bold text-2xl text-[#132628]';
                subEl.textContent = msgSub;
            }

            function finish() {
                prog.style.width = '100%';
                stop('Sesi Butterfly Hug Selesai!', 'Turunkan tangan perlahan, ambil satu napas lega, lalu nilai kembali skala ketegangan tubuh.');
                sessionDone = true;

                // Auto lower 'after' slider by 2 points default for positive encouragement
                var currentB = parseInt(before.value, 10);
                var suggestedA = Math.max(0, currentB - 2);
                after.value = suggestedA;
                $('afterOut').textContent = suggestedA;

                syncFormValues();
                showResult();

                // Save to database via background AJAX automatically
                saveViaAjax();
            }

            function syncFormValues() {
                formBefore.value = before.value;
                formAfter.value = after.value;
                formDur.value = Math.round(dur / 1000);
                formTempo.value = interval;
                formTaps.value = taps;
                var b = parseInt(before.value, 10), a = parseInt(after.value, 10), d = b - a;
                formNotes.value = 'Ketegangan sebelum: ' + b + ', sesudah: ' + a + ' (Penurunan: ' + d + ' poin). Total tepukan: ' + taps;
            }

            function showResult() {
                var b = parseInt(before.value, 10), a = parseInt(after.value, 10), d = b - a;
                var r = $('result');
                syncFormValues();

                if (!sessionDone) {
                    r.textContent = 'Ketegangan awal disetel pada level ' + b + '/10. Tekan Mulai untuk latihan Butterfly Hug.';
                    r.className = 'font-semibold text-center text-[#4a6366]';
                    return;
                }

                if (d > 0) {
                    r.innerHTML = '🎉 <strong>Alhamdulillah! Ketegangan turun ' + d + ' poin</strong> (dari skala ' + b + ' menjadi ' + a + '). Tubuh Anda mulai beralih ke mode relaksasi.';
                    r.className = 'font-semibold text-center text-emerald-800 bg-emerald-50 p-2 rounded-lg border border-emerald-200';
                } else if (d === 0) {
                    r.textContent = 'Skala ketegangan tetap di angka ' + a + '. Anda dapat mengulang sesi dengan irama lebih lambat atau durasi lebih panjang.';
                    r.className = 'font-semibold text-center text-amber-800 bg-amber-50 p-2 rounded-lg border border-amber-200';
                } else {
                    r.textContent = 'Skala tercatat di angka ' + a + '. Berhenti sejenak dan minum air bila tubuh merasa kurang nyaman.';
                    r.className = 'font-semibold text-center text-red-800 bg-red-50 p-2 rounded-lg border border-red-200';
                }
            }

            function saveViaAjax() {
                syncFormValues();
                var token = document.querySelector('input[name="_token"]')?.value || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch("{{ route('intervention.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        tension_before: parseInt(formBefore.value, 10),
                        tension_after: parseInt(formAfter.value, 10),
                        duration_seconds: parseInt(formDur.value, 10),
                        tempo_ms: parseInt(formTempo.value, 10),
                        taps_count: parseInt(formTaps.value, 10),
                        notes: formNotes.value
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    console.log("Intervention log saved:", data);
                }).catch(function(err) {
                    console.warn("Could not save intervention via AJAX:", err);
                });
            }

            // Radio Button styling handlers
            document.querySelectorAll('input[name="dur"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('.dur-label').forEach(function(l) {
                        l.className = 'dur-label cursor-pointer text-center py-2.5 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] font-semibold text-[#132628] transition hover:border-[#0b6b63]';
                    });
                    var parent = radio.closest('label');
                    if (parent) {
                        parent.className = 'dur-label cursor-pointer text-center py-2.5 px-3 rounded-xl border-2 border-[#0b6b63] bg-[#dbeeeb] font-bold text-[#0b6b63] transition shadow-xs';
                    }
                    formDur.value = radio.value;
                });
            });

            document.querySelectorAll('input[name="tempo"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('.tempo-label').forEach(function(l) {
                        l.className = 'tempo-label cursor-pointer text-center py-2 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] font-semibold text-[#132628] transition hover:border-[#0b6b63]';
                    });
                    var parent = radio.closest('label');
                    if (parent) {
                        parent.className = 'tempo-label cursor-pointer text-center py-2 px-3 rounded-xl border-2 border-[#0b6b63] bg-[#dbeeeb] font-bold text-[#0b6b63] transition shadow-xs';
                    }
                    interval = parseInt(radio.value, 10);
                    formTempo.value = radio.value;
                });
            });

            go.addEventListener('click', function () {
                if (running) {
                    stop('Dihentikan', 'Tekan Mulai Sesi Lagi kapan saja Anda siap.');
                    prog.style.width = '0%';
                } else {
                    prog.style.width = '0%';
                    start();
                }
            });

            before.addEventListener('input', function () {
                $('beforeOut').textContent = before.value;
                if (!running && !sessionDone) {
                    after.value = before.value;
                    $('afterOut').textContent = after.value;
                }
                showResult();
            });

            after.addEventListener('input', function () {
                $('afterOut').textContent = after.value;
                showResult();
            });

            document.addEventListener('visibilitychange', function () {
                if (document.hidden && running) {
                    stop('Dijeda', 'Sesi dijeda karena halaman ditutup sementara.');
                }
            });

            // Initialize default display
            showResult();
        })();
    </script>
</x-app-layout>
