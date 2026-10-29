<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">

            <!-- Stepper Indicator Alur 5 Langkah -->
            <div class="mb-6 bg-white border border-[#d2dedc] rounded-2xl p-4 shadow-xs">
                <div class="flex items-center justify-between text-xs font-medium text-[#4a6366] overflow-x-auto gap-2 pb-1">
                    <!-- Step 1: Pre-test -->
                    <div class="flex items-center gap-1.5 shrink-0 text-[#0b6b63] font-semibold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="hidden sm:inline">1. Pre-Test</span>
                        <span class="sm:hidden">1</span>
                    </div>
                    <div class="w-6 sm:w-8 h-0.5 bg-[#0b6b63]"></div>

                    <!-- Step 2: Intervensi -->
                    <div class="flex items-center gap-1.5 shrink-0 text-[#0b6b63] font-semibold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="hidden sm:inline">2. Intervensi</span>
                        <span class="sm:hidden">2</span>
                    </div>
                    <div class="w-6 sm:w-8 h-0.5 bg-[#0b6b63]"></div>

                    <!-- Step 3: Game (Active) -->
                    <div class="flex items-center gap-1.5 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs shadow-xs animate-pulse">3</span>
                        <span>3. Game Stres</span>
                    </div>
                    <div class="w-6 sm:w-8 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 4: Kartu Apresiasi -->
                    <div class="flex items-center gap-1.5 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">4</span>
                        <span class="hidden sm:inline">4. Kartu Apresiasi</span>
                        <span class="sm:hidden">4</span>
                    </div>
                    <div class="w-6 sm:w-8 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 5: Post-test -->
                    <div class="flex items-center gap-1.5 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">5</span>
                        <span class="hidden sm:inline">5. Post-Test</span>
                        <span class="sm:hidden">5</span>
                    </div>
                </div>
            </div>

            <!-- Game Header -->
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#fde3d6] text-[#e8501a] text-xs font-semibold tracking-wide uppercase mb-2">
                        <span class="w-2 h-2 rounded-full bg-[#e8501a] animate-ping"></span>
                        <span>Langkah 3: Katarsis & Relaksasi</span>
                    </div>
                    <h1 class="font-marker text-3xl sm:text-4xl text-[#132628] leading-tight transform -rotate-1">
                        Hancurkan Stres
                    </h1>
                    <p class="text-xs sm:text-sm text-[#4a6366] mt-1 leading-relaxed">
                        Game 30–60 detik di sela shift. Hancurkan beban kerja yang melayang, kalahkan Si Burnout, lalu saksikan retakan layar berubah jadi emas kintsugi.
                    </p>
                </div>

                <button
                    id="snd"
                    type="button"
                    class="shrink-0 px-3.5 py-1.5 rounded-full border border-[#d2dedc] bg-white text-xs font-semibold text-[#132628] hover:bg-[#f1f5f4] transition shadow-xs cursor-pointer"
                >
                    🔊 Suara
                </button>
            </div>

            <!-- Start Panel -->
            <div id="start" class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-7 shadow-sm mb-6">
                @if ($totalPlayed > 0)
                    <div class="mb-5 p-4 rounded-xl bg-[#dbeeeb]/70 border border-[#b2ded8] flex flex-col sm:flex-row items-center justify-between gap-3 shadow-2xs">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">✅</span>
                            <div class="text-xs">
                                <strong class="text-[#0b6b63] text-sm block">Sesi game telah tercatat ({{ $totalPlayed }}x bermain)</strong>
                                <span class="text-[#4a6366]">Skor tertinggi Anda: <b class="text-[#0b6b63] font-mono">{{ number_format($bestScore) }} Poin</b>. Anda bisa langsung lanjut ke tahap kartu ucapan atau bermain lagi.</span>
                            </div>
                        </div>
                        <a
                            href="{{ route('thank-you.create') }}"
                            class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-xs font-bold shadow-xs transition active:scale-[0.98]"
                        >
                            <span>Lanjut: Kartu Apresiasi &rarr;</span>
                        </a>
                    </div>
                @endif

                <!-- Rank Header -->
                <div class="flex items-center justify-between gap-2 mb-1">
                    <span class="text-xs font-mono uppercase text-[#4a6366]">Gelar Pejuang Shift:</span>
                    <span class="font-marker text-lg text-[#e8501a]" id="rk">Perawat Baru Capek</span>
                </div>

                <!-- Rank Progress Bar -->
                <div class="w-full bg-[#f1f5f4] h-2.5 rounded-full overflow-hidden border border-[#d2dedc]/60 mb-2">
                    <div id="rb" class="bg-[#e8501a] h-full transition-all duration-300 rounded-full" style="width: 0%"></div>
                </div>
                <p class="text-[11px] text-[#4a6366] font-mono mb-5" id="rt">Memuat skor...</p>

                <!-- Cara Main List -->
                <div class="p-4 rounded-xl bg-[#f9fbfa] border border-[#d2dedc] mb-5 text-xs text-[#132628] space-y-2">
                    <b class="text-sm block text-[#132628]">Cara Main:</b>
                    <ul class="list-disc list-inside space-y-1.5 text-[#4a6366]">
                        <li><strong class="text-[#132628]">Ketuk beban yang melayang</strong> (bel pasien, laporan, lembur, infus macet) untuk menghancurkannya. Beruntun cepat menaikkan kombo dan poin.</li>
                        <li><strong class="text-[#132628]">Ketuk bagian kosong juga boleh:</strong> layar hanya akan retak artistik tanpa ada hukuman skor.</li>
                        <li>🔨 Palu menghantam area sekitar, 🔥 Api membakar semua, 🧊 Es memperlambat waktu.</li>
                        <li>Di tengah ronde, <strong class="text-[#e8501a]">Si Burnout</strong> akan muncul. Ketuk berkali-kali sampai meledak!</li>
                    </ul>
                </div>

                <!-- Duration Selector -->
                <div class="mb-5">
                    <label class="block text-xs font-bold text-[#132628] mb-2 uppercase tracking-wide">Pilih Durasi Jeda:</label>
                    <div class="grid grid-cols-2 gap-3" id="md"></div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button
                        id="go"
                        type="button"
                        class="flex-1 py-4 px-6 rounded-xl bg-[#e8501a] hover:bg-[#d44310] text-white font-marker text-xl shadow-md transition active:scale-[0.99] cursor-pointer flex items-center justify-center gap-2"
                    >
                        <span>{{ $totalPlayed > 0 ? 'Main Lagi (Pelepas Penat)' : 'Mulai Hancurkan Beban!' }}</span>
                        <span class="text-2xl leading-none">💥</span>
                    </button>

                    @if ($totalPlayed > 0)
                        <a
                            href="{{ route('thank-you.create') }}"
                            class="py-4 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.99] flex items-center justify-center gap-2 text-center"
                        >
                            <span>Lanjut Tahap Berikutnya &rarr;</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Canvas Container (Hidden until started) -->
            <div id="gm" class="hidden mb-6">
                <div class="relative rounded-2xl overflow-hidden border-2 border-[#12161c] shadow-lg bg-[#12161c]">
                    <canvas id="cv" class="block w-full h-[380px] sm:h-[480px] cursor-crosshair touch-none"></canvas>
                </div>

                <div class="text-center mt-3">
                    <span class="text-xs text-[#4a6366]">Sentuh layar secepat mungkin untuk menghancurkan beban stres!</span>
                </div>
            </div>

            <!-- Result Panel (Shown after round finish) -->
            <div id="res" class="hidden bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-md mb-6"></div>

            <!-- Ethics & Medical Note -->
            <div class="p-4 rounded-xl bg-[#f1f5f4] border border-[#d2dedc] text-[11px] text-[#4a6366] leading-relaxed space-y-1">
                <p>⚠️ <strong>Catatan Etika:</strong> Semua pelepasan emosi dan kehancuran hanya terjadi di atas layar kaca game. Jangan melampiaskan emosi ke pasien, rekan sejawat, atau fasilitas rumah sakit.</p>
                <p>Data aktivitas game ini otomatis tersimpan untuk menilai efektivitas intervensi sebelum Anda mengisi kuesioner evaluasi akhir (Post-test).</p>
            </div>

        </div>
    </div>

    <!-- Game Engine Logic & Audio Synthesis -->
    <script>
    (function(){
        var KEY = 'hancur_user_{{ $user->id }}';
        var G = {
            tot: {{ (int) ($totalScore ?? 0) }},
            best: {{ (int) ($bestScore ?? 0) }},
            snd: 1
        };

        try {
            // Remove legacy shared localStorage key so no dirty state leaks between accounts
            localStorage.removeItem('hancur_v1');
            var rr = localStorage.getItem(KEY);
            if (rr) {
                var parsed = JSON.parse(rr);
                if (parsed.snd !== undefined) G.snd = parsed.snd;
            }
        } catch (e) {}

        function save() {
            try { localStorage.setItem(KEY, JSON.stringify({ snd: G.snd })); } catch (e) {}
        }

        function $(i) { return document.getElementById(i); }

        var RM = window.matchMedia && matchMedia('(prefers-reduced-motion:reduce)').matches;
        var AC = null;

        function ctx() {
            try {
                if (!AC) AC = new (window.AudioContext || window.webkitAudioContext)();
                if (AC.state === 'suspended') AC.resume();
            } catch (e) { AC = null; }
            return AC;
        }

        function tn(f, t, d, v) {
            if (!ctx()) return;
            var o = AC.createOscillator(), g = AC.createGain();
            o.frequency.value = f;
            g.gain.setValueAtTime(.0001, t);
            g.gain.exponentialRampToValueAtTime(v, t + .04);
            g.gain.exponentialRampToValueAtTime(.0001, t + d);
            o.connect(g);
            g.connect(AC.destination);
            o.start(t);
            o.stop(t + d + .1);
        }

        function sfx(k) {
            if (!G.snd || !ctx()) return;
            var t = AC.currentTime;
            if (k === 'pop') {
                var o = AC.createOscillator(), g = AC.createGain();
                o.frequency.setValueAtTime(520, t);
                o.frequency.exponentialRampToValueAtTime(110, t + .12);
                g.gain.setValueAtTime(.18, t);
                g.gain.exponentialRampToValueAtTime(.001, t + .14);
                o.connect(g);
                g.connect(AC.destination);
                o.start(t);
                o.stop(t + .2);
            } else if (k === 'gold') {
                [523, 659, 784, 1047].forEach(function(f, i) {
                    tn(f, t + i * .12, 1.3, .1);
                });
            } else if (k === 'boom') {
                var o2 = AC.createOscillator(), g2 = AC.createGain();
                o2.type = 'triangle';
                o2.frequency.setValueAtTime(140, t);
                o2.frequency.exponentialRampToValueAtTime(30, t + .6);
                g2.gain.setValueAtTime(.4, t);
                g2.gain.exponentialRampToValueAtTime(.001, t + .7);
                o2.connect(g2);
                g2.connect(AC.destination);
                o2.start(t);
                o2.stop(t + .8);
            } else {
                var n = AC.sampleRate * .25 | 0, b = AC.createBuffer(1, n, AC.sampleRate), d = b.getChannelData(0);
                for (var i = 0; i < n; i++) d[i] = (Math.random() * 2 - 1) * (1 - i / n);
                var s = AC.createBufferSource();
                s.buffer = b;
                var f = AC.createBiquadFilter();
                f.type = 'highpass';
                f.frequency.value = 2800;
                var g3 = AC.createGain();
                g3.gain.value = .2;
                s.connect(f);
                f.connect(g3);
                g3.connect(AC.destination);
                s.start(t);
            }
        }

        function sndUI() {
            $('snd').textContent = G.snd ? '🔊 Suara: Nyala' : '🔇 Suara: Senyap';
        }

        $('snd').onclick = function() {
            G.snd = G.snd ? 0 : 1;
            save();
            sndUI();
            if (G.snd) { ctx(); sfx('pop'); }
        };
        sndUI();

        var RANKS = [
            [0, 'Perawat Baru Capek'],
            [800, 'Pejuang Shift'],
            [2500, 'Penghancur Beban'],
            [6000, 'Pendekar Overtime'],
            [12000, 'Legenda Ruang Rawat']
        ];

        function getRankTitle(score) {
            var idx = 0;
            RANKS.forEach(function(r, k) {
                if (score >= r[0]) idx = k;
            });
            return RANKS[idx][1];
        }

        function rank() {
            var i = 0;
            RANKS.forEach(function(r, k) { if (G.tot >= r[0]) i = k; });
            return i;
        }

        function ui() {
            var i = rank(), n = RANKS[i + 1];
            $('rk').textContent = RANKS[i][1];
            $('rb').style.width = (n ? Math.min(100, Math.max(0, (G.tot - RANKS[i][0]) / (n[0] - RANKS[i][0]) * 100)) : 100) + '%';
            $('rt').textContent = 'Total poin: ' + G.tot + ' · Skor terbaik: ' + G.best + (n ? ' · ' + (n[0] - G.tot) + ' poin lagi menuju gelar ' + n[1] : ' · Peringkat tertinggi tercapai!');
        }

        var mode = 30;
        [[30, '⚡ 30 Detik (Cepat)'], [60, '⏱️ 60 Detik (Puas)']].forEach(function(o) {
            var b = document.createElement('button');
            b.type = 'button';
            b.textContent = o[1];
            b.className = 'py-2.5 px-3 rounded-xl border-2 font-bold text-xs sm:text-sm cursor-pointer transition text-center ' +
                (mode === o[0] ? 'border-[#e8501a] bg-[#fde3d6] text-[#e8501a]' : 'border-[#d2dedc] bg-[#f9fbfa] text-[#4a6366]');
            b.onclick = function() {
                mode = o[0];
                Array.from($('md').children).forEach(function(k) {
                    var isActive = (k === b);
                    k.className = 'py-2.5 px-3 rounded-xl border-2 font-bold text-xs sm:text-sm cursor-pointer transition text-center ' +
                        (isActive ? 'border-[#e8501a] bg-[#fde3d6] text-[#e8501a]' : 'border-[#d2dedc] bg-[#f9fbfa] text-[#4a6366]');
                });
            };
            $('md').appendChild(b);
        });

        var LAB = [
            ['Bel pasien', '🔔'], ['Laporan', '📝'], ['Lembur', '⏰'], ['Kopi dingin', '☕'],
            ['Revisi jadwal', '📅'], ['Keluhan', '😤'], ['Nyeri punggung', '🦴'], ['Infus macet', '💉'],
            ['Tumpukan berkas', '📚'], ['Telepon', '📞']
        ];

        var QU = [
            'Kamu itu seperti infus: bikin hariku terasa lebih hidup. 💉',
            'Tensimu mungkin normal, tapi senyummu bikin jantungku tidak. ❤️',
            'Hasil lab layar: positif retak, negatif drama. 🧪',
            'Makan siang jam 4 sore itu bukan telat, itu makan siang premium. 🍱',
            'Kalau ada penghargaan perawat paling sabar, kamu nominasi tetap. 🏅',
            'Retak itu tanda kamu sudah bertahan lama. Emasnya baru ditambah sekarang. 🌈',
            'Kamu tidak harus kuat terus. Kuat bergantian dengan istirahat juga hebat. 🌿',
            'Skor GCS-mu hari ini: sadar penuh, tapi pengin rebahan. 😴',
            'Obat paling ampuh hari ini: tawa tiga detik, tanpa resep. 😂',
            'Kalau hari ini berantakan, besok masih ada halaman baru. 📖',
            'Seperti layar ini, kamu boleh retak, boleh ditambal, boleh lanjut. 🧡',
            'Satu pasien lagi pulang berkat kamu. 🏡',
            'Hatiku sudah rawat inap atas nama kamu. 🏥',
            'Kamu lebih kuat dari tensimeter yang kadang error. 💪'
        ];

        var cv = $('cv'), c = cv.getContext('2d'), W = 0, H = 0, S = null, raf = 0, lt = 0;

        function resize() {
            var r = cv.getBoundingClientRect(), d = Math.min(2, window.devicePixelRatio || 1);
            W = r.width; H = r.height;
            cv.width = W * d; cv.height = H * d;
            c.setTransform(d, 0, 0, d, 0, 0);
        }

        function dist(o, x, y) { return Math.hypot(o.x - x, o.y - y); }

        function newS() {
            return {
                it: [], pt: [], cr: [], pp: [],
                score: 0, combo: 0, ct: 0, mx: 0, sm: 0,
                t: 0, dur: mode, sp: 0, slow: 0,
                boss: null, bd: 0, shake: 0, ph: 'ready',
                rd: 1.3, gold: 0, bk: 0
            };
        }

        function crack(x, y, n) {
            if (S.cr.length > 70) S.cr.shift();
            var br = [];
            for (var b = 0; b < n; b++) {
                var px = x, py = y, an = Math.random() * 6.28, p = [[px, py]];
                for (var k = 0; k < 6; k++) {
                    an += (Math.random() - .5) * 1.1;
                    var l = 12 + Math.random() * 26;
                    px += Math.cos(an) * l; py += Math.sin(an) * l;
                    p.push([px, py]);
                }
                br.push(p);
            }
            S.cr.push(br);
        }

        function burst(x, y, col, n) {
            for (var i = 0; i < n; i++) {
                var a = Math.random() * 6.28, s = 80 + Math.random() * 220;
                S.pt.push({
                    x: x, y: y,
                    vx: Math.cos(a) * s,
                    vy: Math.sin(a) * s - 60,
                    l: .7 + Math.random() * .4,
                    col: col,
                    s: 3 + Math.random() * 4
                });
            }
        }

        function smash(o) {
            var m = 1 + Math.floor(S.combo / 5), p = 10 * m;
            S.score += p; S.combo++; S.ct = 1.6;
            S.mx = Math.max(S.mx, S.combo);
            S.sm++;
            burst(o.x, o.y, '#ff7a45', 14);
            crack(o.x, o.y, 3);
            S.pp.push({ x: o.x, y: o.y, t: 0, s: '+' + p });
            sfx(S.sm % 2 ? 'pop' : 'crack');
            o.dead = 1;
        }

        function power(o, x, y) {
            o.dead = 1;
            burst(o.x, o.y, '#f6b73c', 22);
            sfx('gold');
            if (o.pow === 'hammer') {
                S.it.forEach(function(q) {
                    if (!q.dead && !q.pow && Math.hypot(q.x - x, q.y - y) < 150) smash(q);
                });
                S.shake = .3;
            } else if (o.pow === 'fire') {
                S.it.forEach(function(q) {
                    if (!q.dead && !q.pow) smash(q);
                });
                S.shake = .4;
            } else {
                S.slow = 4;
            }
        }

        function hitBoss(x, y) {
            var b = S.boss;
            b.hp--;
            S.score += 5;
            burst(x, y, '#ff4d2e', 8);
            crack(x, y, 2);
            sfx('pop');
            b.fl = .12;
            if (b.hp <= 0) {
                S.score += 500;
                S.bd = 1;
                S.boss = null;
                S.it.forEach(function(q) {
                    if (!q.dead && !q.pow) smash(q);
                });
                burst(x, y, '#f6b73c', 50);
                S.shake = .7;
                sfx('boom');
                S.pp.push({ x: W / 2, y: H * .3, t: 0, s: 'SI BURNOUT HANCUR! +500', big: 1 });
            }
        }

        cv.onpointerdown = function(e) {
            if (!S || S.ph !== 'play') return;
            var r = cv.getBoundingClientRect(), x = e.clientX - r.left, y = e.clientY - r.top;
            if (S.boss && dist(S.boss, x, y) < S.boss.r) { hitBoss(x, y); return; }
            for (var i = S.it.length - 1; i >= 0; i--) {
                var o = S.it[i];
                if (!o.dead && dist(o, x, y) < o.r + 8) {
                    if (o.pow) power(o, x, y);
                    else smash(o);
                    return;
                }
            }
            crack(x, y, 2);
            sfx('crack');
        };

        function spawn() {
            var pw = Math.random() < .07;
            var L = LAB[Math.floor(Math.random() * LAB.length)];
            var r = pw ? 30 : 36 + Math.random() * 8;
            var o = {
                x: r + Math.random() * (W - 2 * r),
                y: H + r,
                vy: -(70 + Math.random() * 50 + S.t * 1.2),
                r: r,
                ph: Math.random() * 6
            };
            if (pw) {
                o.pow = ['hammer', 'fire', 'ice'][Math.floor(Math.random() * 3)];
                o.e = { hammer: '🔨', fire: '🔥', ice: '🧊' }[o.pow];
                o.l = '';
            } else {
                o.e = L[1]; o.l = L[0];
            }
            S.it.push(o);
        }

        function update(dt) {
            if (S.ph === 'ready') {
                S.rd -= dt;
                if (S.rd <= 0) S.ph = 'play';
                return;
            }
            if (S.ph === 'gold') { S.gold += dt; return; }
            var sd = S.slow > 0 ? .4 : 1;
            if (S.slow > 0) S.slow -= dt;
            var d = dt * sd;
            S.t += dt;
            if (S.t >= S.dur) {
                S.ph = 'gold'; S.gold = 0; finish(); return;
            }
            if (S.ct > 0) { S.ct -= dt; if (S.ct <= 0) S.combo = 0; }
            S.sp -= d;
            if (S.sp <= 0) {
                S.sp = Math.max(.3, .8 - S.t / S.dur * .5);
                spawn();
            }
            if (!S.bd && !S.boss && S.t >= S.dur * .5) {
                S.boss = {
                    x: W / 2, y: -90,
                    r: Math.min(78, W * .2),
                    hp: S.dur === 30 ? 14 : 22,
                    ph: 0, fl: 0
                };
            }
            if (S.boss) {
                var b = S.boss;
                b.ph += d;
                b.y += (H * .3 - b.y) * Math.min(1, d * 1.5);
                b.x = W / 2 + Math.sin(b.ph * .9) * (W * .26);
                if (b.fl > 0) b.fl -= dt;
            }
            S.it.forEach(function(o) {
                o.y += o.vy * d;
                o.x += Math.sin(o.ph + S.t * 2) * 20 * d;
                if (o.y < -70) o.dead = 1;
            });
            S.it = S.it.filter(function(o) { return !o.dead; });
            S.pt.forEach(function(p) {
                p.vy += 520 * dt; p.x += p.vx * dt; p.y += p.vy * dt; p.l -= dt;
            });
            S.pt = S.pt.filter(function(p) { return p.l > 0; });
            S.pp.forEach(function(p) { p.t += dt; });
            S.pp = S.pp.filter(function(p) { return p.t < 1; });
            if (S.shake > 0) S.shake -= dt;
        }

        function crks(col, w, a, glow) {
            c.strokeStyle = col; c.lineWidth = w; c.globalAlpha = a;
            c.shadowColor = col; c.shadowBlur = glow;
            S.cr.forEach(function(br) {
                br.forEach(function(p) {
                    c.beginPath();
                    c.moveTo(p[0][0], p[0][1]);
                    for (var i = 1; i < p.length; i++) c.lineTo(p[i][0], p[i][1]);
                    c.stroke();
                });
            });
            c.globalAlpha = 1; c.shadowBlur = 0;
        }

        function ball(o) {
            var g = c.createRadialGradient(o.x - o.r * .3, o.y - o.r * .3, o.r * .1, o.x, o.y, o.r);
            if (o.pow) {
                g.addColorStop(0, '#ffe9a8'); g.addColorStop(1, '#d99a1a');
            } else {
                g.addColorStop(0, '#ff9468'); g.addColorStop(1, '#b8350c');
            }
            c.fillStyle = g;
            c.beginPath();
            c.arc(o.x, o.y, o.r, 0, 6.3);
            c.fill();
            c.textAlign = 'center';
            c.fillStyle = '#fff';
            c.font = (o.pow ? '28px' : '26px') + ' system-ui';
            c.fillText(o.e, o.x, o.y + (o.l ? 2 : 10));
            if (o.l) {
                c.font = '800 10px Public Sans, system-ui';
                c.fillText(o.l, o.x, o.y + o.r * .62);
            }
        }

        function draw() {
            var g = c.createLinearGradient(0, 0, 0, H);
            g.addColorStop(0, '#1a2233');
            g.addColorStop(1, '#0d1118');
            c.fillStyle = g;
            c.fillRect(0, 0, W, H);
            c.save();
            if (S.shake > 0 && !RM) c.translate((Math.random() - .5) * 10, (Math.random() - .5) * 10);
            if (S.ph === 'gold') {
                var k = Math.min(1, S.gold / 1.4);
                crks('#f6b73c', 1.6 + k * 2.2, .4 + k * .6, k * 10);
                c.fillStyle = '#f6b73c';
                c.textAlign = 'center';
                c.globalAlpha = k;
                c.font = '400 28px "Permanent Marker", system-ui';
                c.fillText('Retakmu jadi emas', W / 2, H / 2);
                c.globalAlpha = 1;
                c.restore();
                return;
            }
            crks('#c9d3ea', 1.1, .35, 0);
            S.it.forEach(function(o) { ball(o); });
            if (S.boss) {
                var b = S.boss, gg = c.createRadialGradient(b.x, b.y, b.r * .2, b.x, b.y, b.r);
                gg.addColorStop(0, b.fl > 0 ? '#ffd1bf' : '#b3260f');
                gg.addColorStop(1, '#4a0e06');
                c.fillStyle = gg;
                c.beginPath();
                c.arc(b.x, b.y, b.r, 0, 6.3);
                c.fill();
                c.lineWidth = 4;
                c.strokeStyle = '#ff7a45';
                c.stroke();
                c.textAlign = 'center';
                c.font = b.r * .9 + 'px system-ui';
                c.fillStyle = '#fff';
                c.fillText('😈', b.x, b.y + b.r * .3);
                c.font = '800 13px Public Sans, system-ui';
                c.fillText('SI BURNOUT', b.x, b.y - b.r - 24);
                var mh = S.dur === 30 ? 14 : 22;
                c.fillStyle = '#3a1a14';
                c.fillRect(b.x - b.r, b.y - b.r - 16, b.r * 2, 8);
                c.fillStyle = '#ff7a45';
                c.fillRect(b.x - b.r, b.y - b.r - 16, b.r * 2 * b.hp / mh, 8);
            }
            S.pt.forEach(function(p) {
                c.globalAlpha = Math.max(0, p.l);
                c.fillStyle = p.col;
                c.fillRect(p.x, p.y, p.s, p.s);
            });
            c.globalAlpha = 1;
            S.pp.forEach(function(p) {
                c.globalAlpha = 1 - p.t;
                c.fillStyle = '#ffe08a';
                c.textAlign = 'center';
                c.font = (p.big ? '800 20px' : '800 16px') + ' Public Sans, system-ui';
                c.fillText(p.s, p.x, p.y - p.t * 50);
            });
            c.globalAlpha = 1;
            c.restore();
            c.fillStyle = '#fff';
            c.textAlign = 'left';
            c.font = '800 22px "IBM Plex Mono", system-ui';
            c.fillText(S.score, 16, 32);
            c.textAlign = 'right';
            c.fillText(Math.max(0, Math.ceil(S.dur - S.t)) + ' dtk', W - 16, 32);
            if (S.combo >= 3) {
                c.textAlign = 'center';
                c.fillStyle = '#f6b73c';
                c.font = '400 24px "Permanent Marker", system-ui';
                c.fillText('Combo x' + S.combo, W / 2, 34);
            }
            if (S.slow > 0) {
                c.textAlign = 'center';
                c.fillStyle = '#8fd3ff';
                c.font = '800 13px Public Sans, system-ui';
                c.fillText('🧊 Waktu melambat', W / 2, H - 16);
            }
            if (S.ph === 'ready') {
                c.fillStyle = 'rgba(0,0,0,.55)';
                c.fillRect(0, 0, W, H);
                c.fillStyle = '#fff';
                c.textAlign = 'center';
                c.font = '400 40px "Permanent Marker", system-ui';
                c.fillText('Siap?!', W / 2, H / 2);
            }
        }

        function loop(t) {
            var dt = Math.min(.05, (t - lt) / 1000 || 0);
            lt = t;
            if (S) { update(dt); draw(); }
            raf = requestAnimationFrame(loop);
        }

        function stop() {
            cancelAnimationFrame(raf);
            raf = 0;
        }

        function show(id) {
            ['start', 'gm', 'res'].forEach(function(x) {
                var el = $(x);
                if (el) el.classList.toggle('hidden', x !== id);
            });
        }

        function begin() {
            ctx();
            S = null;
            show('gm');
            $('res').classList.add('hidden');
            resize();
            S = newS();
            lt = performance.now();
            stop();
            raf = requestAnimationFrame(loop);
            cv.scrollIntoView({ block: 'center', behavior: 'smooth' });
        }

        $('go').onclick = begin;

        function finish() {
            var s = S;
            if (!s) return;
            var nb = s.score > G.best;
            G.tot += s.score;
            if (nb) G.best = s.score;
            save();
            sfx('gold');
            stop();

            var durPlayed = Math.max(10, Math.round(s.t || s.dur));

            // Send game metrics to Laravel Controller via AJAX
            fetch("{{ route('game.log') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    score: s.score,
                    items_smashed: s.sm,
                    max_combo: s.mx,
                    duration_seconds: durPlayed,
                    boss_defeated: s.bd ? true : false
                })
            }).then(function(res) {
                return res.json();
            }).catch(function(err) {
                console.warn("Could not save game log:", err);
            });

            var sessionRankTitle = getRankTitle(s.score);
            var q = QU[Math.floor(Math.random() * QU.length)];
            var r = $('res');

            r.innerHTML =
                '<div class="text-center">' +
                    '<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#fde3d6] text-[#e8501a] text-xs font-bold uppercase mb-2">' +
                        '<span>' + (nb && s.score > 0 ? '🏆 Rekor Baru!' : '🎉 Sesi Relaksasi Selesai!') + '</span>' +
                    '</div>' +
                    '<h2 class="font-marker text-3xl sm:text-4xl text-[#132628] mb-1">Retakmu Jadi Emas</h2>' +
                    '<div class="font-marker text-lg text-[#e8501a] mb-5">' + sessionRankTitle + '</div>' +
                '</div>' +

                '<div class="grid grid-cols-3 gap-3 mb-5 text-center">' +
                    '<div class="p-3.5 rounded-xl bg-[#f9fbfa] border border-[#d2dedc]">' +
                        '<b class="block font-mono text-2xl sm:text-3xl font-bold text-[#e8501a]">' + s.score + '</b>' +
                        '<span class="text-xs text-[#4a6366]">Skor Poin</span>' +
                    '</div>' +
                    '<div class="p-3.5 rounded-xl bg-[#f9fbfa] border border-[#d2dedc]">' +
                        '<b class="block font-mono text-2xl sm:text-3xl font-bold text-[#132628]">' + s.sm + '</b>' +
                        '<span class="text-xs text-[#4a6366]">Dihancurkan</span>' +
                    '</div>' +
                    '<div class="p-3.5 rounded-xl bg-[#f9fbfa] border border-[#d2dedc]">' +
                        '<b class="block font-mono text-2xl sm:text-3xl font-bold text-[#f6b73c]">x' + s.mx + '</b>' +
                        '<span class="text-xs text-[#4a6366]">Kombo Maks</span>' +
                    '</div>' +
                '</div>' +

                '<div class="p-4 rounded-xl bg-[#dbeeeb]/60 border border-[#b2ded8] text-center mb-6">' +
                    '<p class="text-xs sm:text-sm font-semibold text-[#0b6b63] italic">“' + q + '”</p>' +
                    '<span class="text-[11px] text-[#0b6b63]/80 font-mono mt-1 block">✓ Data sesi game Anda telah tercatat di database</span>' +
                '</div>' +

                '<div class="flex flex-col sm:flex-row gap-3 pt-2">' +
                    '<a href="{{ route("thank-you.create") }}" class="flex-1 py-4 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-center text-sm shadow-md transition active:scale-[0.98] flex items-center justify-center gap-2">' +
                        '<span>Lanjut: Kartu Apresiasi Rekan &rarr;</span>' +
                    '</a>' +
                    '<button id="ag" type="button" class="py-3 px-5 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] hover:bg-[#f1f5f4] text-xs font-bold text-[#132628] transition cursor-pointer">' +
                        'Main Lagi' +
                    '</button>' +
                '</div>';

            setTimeout(function() {
                show('res');
                r.scrollIntoView({ block: 'start', behavior: 'smooth' });
                S = null;

                $('ag').onclick = function() {
                    begin();
                };
            }, 600);
        }

        window.addEventListener('resize', function() {
            if (S) resize();
        });

        ui();
    })();
    </script>
</x-app-layout>
