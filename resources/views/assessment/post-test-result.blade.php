<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Stepper Indicator -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs font-medium text-[#4a6366] overflow-x-auto gap-2 pb-1">
                    <!-- Step 1: Pre-test -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-semibold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="hidden sm:inline">1. Pre-Test</span>
                        <span class="sm:hidden">1</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]"></div>

                    <!-- Step 2: Game -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-semibold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="hidden sm:inline">2. Game Katarsis</span>
                        <span class="sm:hidden">2</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]"></div>

                    <!-- Step 3: Kartu Apresiasi -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-semibold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span class="hidden sm:inline">3. Kartu Apresiasi</span>
                        <span class="sm:hidden">3</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]"></div>

                    <!-- Step 4: Post-test (Done) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-xs font-bold">✓</span>
                        <span>4. Post-Test</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#0b6b63]/40"></div>

                    <!-- Step 5: Kirim Hasil (Next) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs shadow-xs animate-pulse">5</span>
                        <span class="hidden sm:inline">5. Kirim Hasil</span>
                        <span class="sm:hidden">5</span>
                    </div>
                </div>
            </div>

            <!-- Success Alert Banner -->
            <div class="p-4 rounded-2xl bg-[#dbeeeb] border border-[#b2ded8] text-[#0b6b63] flex items-center justify-between gap-3 shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#0b6b63] text-white flex items-center justify-center font-bold text-sm shrink-0">
                        ✓
                    </div>
                    <div>
                        <h4 class="font-bold text-sm">Evaluasi Post-Test Selesai & Komparasi Berhasil Dihitung!</h4>
                        <p class="text-xs text-[#0b6b63]/80">Berikut adalah rekapitulasi komparasi perubahan skor sebelum dan sesudah intervensi.</p>
                    </div>
                </div>
                <span class="text-xs font-mono text-[#0b6b63] hidden sm:inline">
                    {{ $assessment->completed_at?->format('d/m/Y H:i') }}
                </span>
            </div>

            <!-- Big Comparison Summary Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#d2dedc]">
                    <div>
                        <span class="text-xs uppercase font-mono tracking-wider text-[#4a6366] block mb-1">Komparasi Evaluasi Skor</span>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-[#132628]">
                            {{ $user->name }}
                        </h2>
                        <span class="text-xs text-[#0b6b63] font-semibold">{{ $user->role }} · {{ $user->room }}</span>
                    </div>

                    <!-- Overall Verdict Badge -->
                    <div>
                        @if ($diffPercentage < 0)
                            <div class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#dff0e5] text-[#2f7d52] border border-[#b8e2cb] shadow-xs">
                                <span class="text-sm">📉</span>
                                <span>Penurunan Burnout {{ abs($diffPercentage) }}% (Membaik!)</span>
                            </div>
                        @elseif ($diffPercentage == 0)
                            <div class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#f7ebd2] text-[#a8680f] border border-[#ecd5a9] shadow-xs">
                                <span class="text-sm">⚖️</span>
                                <span>Skor Burnout Stabil (0.0%)</span>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#f8e1dd] text-[#b03a2e] border border-[#f0c2bb] shadow-xs">
                                <span class="text-sm">📈</span>
                                <span>Peningkatan Skor {{ $diffPercentage }}%</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Side-by-side Score Metric Boxes -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
                    <!-- Pre-Test Box -->
                    <div class="p-5 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] text-center">
                        <span class="text-xs font-mono uppercase text-[#4a6366] block mb-1">1. Skor Pre-Test (Sebelum)</span>
                        <div class="font-mono text-4xl sm:text-5xl font-bold text-[#132628]">
                            {{ $preTest ? number_format($preTest->percentage, 1) : '-' }}<span class="text-2xl font-normal">%</span>
                        </div>
                        <div class="mt-2">
                            <span class="inline-block px-3 py-0.5 rounded-full text-xs font-semibold
                                {{ ($preTest?->category === 'Rendah') ? 'bg-[#dff0e5] text-[#2f7d52]' : (($preTest?->category === 'Sedang') ? 'bg-[#f7ebd2] text-[#a8680f]' : 'bg-[#f8e1dd] text-[#b03a2e]') }}">
                                {{ $preTest?->category ?? '-' }}
                            </span>
                        </div>
                        <span class="text-[11px] text-[#4a6366] font-mono mt-2 block">
                            Total: {{ $preTest?->total_score ?? 0 }} / 132 poin
                        </span>
                    </div>

                    <!-- Post-Test Box -->
                    <div class="p-5 rounded-2xl bg-[#dbeeeb]/40 border border-[#b2ded8] text-center">
                        <span class="text-xs font-mono uppercase text-[#0b6b63] font-bold block mb-1">2. Skor Post-Test (Sesudah)</span>
                        <div class="font-mono text-4xl sm:text-5xl font-bold text-[#0b6b63]">
                            {{ number_format($assessment->percentage, 1) }}<span class="text-2xl font-normal">%</span>
                        </div>
                        <div class="mt-2">
                            <span class="inline-block px-3 py-0.5 rounded-full text-xs font-semibold
                                {{ ($assessment->category === 'Rendah') ? 'bg-[#dff0e5] text-[#2f7d52]' : (($assessment->category === 'Sedang') ? 'bg-[#f7ebd2] text-[#a8680f]' : 'bg-[#f8e1dd] text-[#b03a2e]') }}">
                                {{ $assessment->category }}
                            </span>
                        </div>
                        <span class="text-[11px] text-[#0b6b63] font-mono mt-2 block">
                            Total: {{ $assessment->total_score }} / 132 poin
                        </span>
                    </div>

                    <!-- Delta Change Box -->
                    <div class="p-5 rounded-2xl bg-[#f1f5f4] border border-[#d2dedc] text-center flex flex-col justify-center">
                        <span class="text-xs font-mono uppercase text-[#4a6366] block mb-1">Selisih Perubahan (Delta)</span>
                        <div class="font-mono text-3xl sm:text-4xl font-bold {{ $diffPercentage <= 0 ? 'text-[#2f7d52]' : 'text-[#b03a2e]' }}">
                            {{ $diffPercentage > 0 ? '+'.$diffPercentage : $diffPercentage }}%
                        </div>
                        <span class="text-xs font-semibold {{ $diffPercentage <= 0 ? 'text-[#2f7d52]' : 'text-[#b03a2e]' }} mt-2 block">
                            {{ $diffPercentage < 0 ? 'Berkurang '.abs($diffTotal).' poin total' : ($diffPercentage > 0 ? 'Bertambah '.$diffTotal.' poin' : 'Tidak ada perubahan skor') }}
                        </span>
                        <span class="text-[10px] text-[#4a6366] mt-1 block">Pasca intervensi mini game</span>
                    </div>
                </div>

                <!-- 3 Dimensions Comparative Breakdown -->
                <div class="space-y-4 pt-4 border-t border-[#d2dedc]">
                    <h3 class="text-sm font-bold text-[#132628]">Komparasi Rinci Per Dimensi MBI:</h3>

                    <!-- Dimensi 1: Kelelahan Emosional (EE) -->
                    <div class="p-4 rounded-xl bg-[#f9fbfa] border border-[#d2dedc] space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-semibold text-[#132628]">1. Kelelahan Emosional (EE)</span>
                            <div class="flex items-center gap-3 font-mono">
                                <span class="text-[#4a6366]">Pre: <strong>{{ $preTest?->ee_score ?? 0 }}</strong></span>
                                <span class="text-[#132628]">&rarr;</span>
                                <span class="text-[#0b6b63] font-bold">Post: <strong>{{ $assessment->ee_score }}</strong> / 54</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $diffEE <= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $diffEE > 0 ? '+'.$diffEE : $diffEE }}
                                </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#4a6366]">Sebelum:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#4a6366] h-full rounded-full" style="width: {{ $preTest ? min(100, round(($preTest->ee_score / 54) * 100)) : 0 }}%"></div>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#0b6b63] font-semibold">Sesudah:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->ee_score / 54) * 100)) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dimensi 2: Depersonalisasi (DP) -->
                    <div class="p-4 rounded-xl bg-[#f9fbfa] border border-[#d2dedc] space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-semibold text-[#132628]">2. Depersonalisasi (DP)</span>
                            <div class="flex items-center gap-3 font-mono">
                                <span class="text-[#4a6366]">Pre: <strong>{{ $preTest?->dp_score ?? 0 }}</strong></span>
                                <span class="text-[#132628]">&rarr;</span>
                                <span class="text-[#0b6b63] font-bold">Post: <strong>{{ $assessment->dp_score }}</strong> / 30</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $diffDP <= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $diffDP > 0 ? '+'.$diffDP : $diffDP }}
                                </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#4a6366]">Sebelum:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#4a6366] h-full rounded-full" style="width: {{ $preTest ? min(100, round(($preTest->dp_score / 30) * 100)) : 0 }}%"></div>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#0b6b63] font-semibold">Sesudah:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->dp_score / 30) * 100)) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dimensi 3: Penurunan Pencapaian Pribadi (PA) -->
                    <div class="p-4 rounded-xl bg-[#f9fbfa] border border-[#d2dedc] space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-semibold text-[#132628]">3. Penurunan Pencapaian Diri (PA)</span>
                            <div class="flex items-center gap-3 font-mono">
                                <span class="text-[#4a6366]">Pre: <strong>{{ $preTest?->pa_score ?? 0 }}</strong></span>
                                <span class="text-[#132628]">&rarr;</span>
                                <span class="text-[#0b6b63] font-bold">Post: <strong>{{ $assessment->pa_score }}</strong> / 48</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $diffPA <= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $diffPA > 0 ? '+'.$diffPA : $diffPA }}
                                </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#4a6366]">Sebelum:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#4a6366] h-full rounded-full" style="width: {{ $preTest ? min(100, round(($preTest->pa_score / 48) * 100)) : 0 }}%"></div>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] text-[#0b6b63] font-semibold">Sesudah:</span>
                                <div class="w-full bg-[#d2dedc] h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#0b6b63] h-full rounded-full" style="width: {{ min(100, round(($assessment->pa_score / 48) * 100)) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini Game Session Recap Box -->
                @if ($gameLog)
                    <div class="mt-6 p-4 rounded-xl bg-[#fde3d6]/40 border border-[#f8c4b0] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3 text-xs">
                            <span class="text-2xl">🎮</span>
                            <div>
                                <b class="text-[#e8501a] block">Aktivitas Game "Hancurkan Stres":</b>
                                <span class="text-[#4a6366]">Durasi {{ $gameLog->duration_seconds }} detik · Berhasil menghancurkan <strong>{{ $gameLog->items_smashed }} beban</strong> dengan skor <strong>{{ $gameLog->score }} poin</strong>.</span>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-white text-[#e8501a] font-mono text-xs font-bold border border-[#f8c4b0] shrink-0">
                            {{ $gameLog->boss_defeated ? 'Si Burnout Kalah! 💥' : 'Selesai' }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- STEP 5 CALL TO ACTION CARD -->
            <div class="bg-gradient-to-br from-[#0b6b63] to-[#08524c] rounded-2xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-xl">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold tracking-wide uppercase">
                            <span>✉️ Langkah 5: Salinan Laporan Resmi</span>
                        </div>
                        @if ($user->email)
                            <h3 class="font-display text-xl sm:text-2xl font-bold flex items-center gap-2 flex-wrap">
                                <span>Laporan Resmi Otomatis Terkirim</span>
                                <span class="text-xs bg-[#2f7d52] text-white px-2.5 py-0.5 rounded-full font-sans font-semibold">✓ Terkirim</span>
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm leading-relaxed">
                                Seluruh rekapan evaluasi komparasi telah tersimpan permanen di database rumah sakit. Salinan bukti resmi ini telah <strong>otomatis dikirimkan ke email Anda:</strong> <strong class="text-white underline font-mono">{{ $user->email }}</strong> (silakan periksa folder Inbox atau Spam).
                            </p>
                        @else
                            <h3 class="font-display text-xl sm:text-2xl font-bold flex items-center gap-2 flex-wrap">
                                <span>Hasil Evaluasi Tersimpan di Database</span>
                                <span class="text-xs bg-white/20 text-white px-2.5 py-0.5 rounded-full font-sans font-semibold">✓ Tersimpan</span>
                            </h3>
                            <p class="text-white/90 text-xs sm:text-sm leading-relaxed">
                                Seluruh rekapan evaluasi komparasi telah tersimpan permanen di database rumah sakit. Akun Anda belum memiliki email terdaftar untuk menerima salinan bukti laporan.
                            </p>
                            <!-- Input Email Field -->
                            <form action="{{ route('assessment.send-email', $assessment->id) }}" method="POST" class="flex flex-col sm:flex-row gap-2 pt-2" onsubmit="const btn = this.querySelector('button'); btn.disabled = true; btn.classList.add('opacity-70', 'cursor-not-allowed'); btn.innerHTML = '<span>Mengirim...</span>';">
                                @csrf
                                <input
                                    type="email"
                                    name="target_email"
                                    required
                                    placeholder="Ketik email Anda (cth: nama@gmail.com)"
                                    class="px-3.5 py-2.5 rounded-xl bg-white text-[#132628] text-xs font-medium placeholder-[#4a6366] border border-transparent focus:border-white focus:outline-none flex-1 shadow-xs"
                                >
                                <button
                                    type="submit"
                                    class="shrink-0 py-2.5 px-4 rounded-xl bg-white text-[#0b6b63] font-bold text-xs shadow-md hover:bg-[#dbeeeb] transition active:scale-[0.98] cursor-pointer flex items-center justify-center gap-1.5"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span>Kirim ke Email</span>
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="shrink-0 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        @if ($user->email)
                            <form action="{{ route('assessment.send-email', $assessment->id) }}" method="POST" onsubmit="const btn = this.querySelector('button'); btn.disabled = true; btn.classList.add('opacity-70', 'cursor-not-allowed'); btn.innerHTML = '<span>Mengirim ulang...</span>';">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl border border-white/40 bg-white/15 hover:bg-white/25 text-white font-bold text-xs sm:text-sm shadow-xs transition active:scale-[0.98] cursor-pointer"
                                    title="Klik hanya jika email belum masuk di inbox maupun spam"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    <span>Kirim Ulang Email</span>
                                </button>
                            </form>
                        @endif

                        <a
                            href="{{ route('mail.preview') }}"
                            target="_blank"
                            class="inline-flex items-center justify-center gap-1.5 py-3 px-4 rounded-xl border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm transition cursor-pointer"
                            title="Buka pratinjau tampilan email di tab baru"
                        >
                            <span>Pratinjau Email</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="text-xs text-[#4a6366] hover:text-[#132628] underline">
                    Kembali ke Beranda Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
