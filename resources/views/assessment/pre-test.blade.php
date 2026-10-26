<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stepper Indicator Alur 5 Langkah -->
            <div class="mb-8 bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs font-medium text-[#4a6366] overflow-x-auto gap-2 pb-1">
                    <!-- Step 1: Pre-test (Active) -->
                    <div class="flex items-center gap-2 shrink-0 text-[#0b6b63] font-bold">
                        <span class="w-6 h-6 rounded-full bg-[#0b6b63] text-white flex items-center justify-center text-xs shadow-xs animate-pulse">1</span>
                        <span>1. Pre-Test</span>
                    </div>
                    <div class="w-6 sm:w-12 h-0.5 bg-[#d2dedc]"></div>

                    <!-- Step 2: Game -->
                    <div class="flex items-center gap-2 shrink-0 opacity-60">
                        <span class="w-6 h-6 rounded-full bg-[#f1f5f4] border border-[#d2dedc] text-[#4a6366] flex items-center justify-center text-xs">2</span>
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

            <!-- Compact Context Hero Section -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 mb-8 shadow-xs relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-[#dbeeeb]/40 rounded-full blur-2xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold tracking-wide uppercase mb-3">
                            <span class="w-2 h-2 rounded-full bg-[#0b6b63]"></span>
                            <span>Kuesioner Awal (Pre-test)</span>
                        </div>
                        <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-[#132628]">
                            Evaluasi Tingkat Stres & Burnout Awal
                        </h1>
                        <p class="text-sm text-[#4a6366] mt-2 leading-relaxed max-w-2xl">
                            Selamat datang, <strong class="text-[#132628]">{{ $user->name }}</strong> ({{ $user->role }}).
                            Silakan jawab <strong>22 butir kuesioner baku MBI</strong> berikut sesuai frekuensi perasaan yang Anda alami selama dinas dalam <strong>2 minggu terakhir</strong>.
                        </p>
                    </div>

                    <!-- Badges Ringkas -->
                    <div class="flex sm:flex-col gap-2 shrink-0">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#f1f5f4] text-[#132628] text-xs font-mono font-medium border border-[#d2dedc]">
                            ⏱️ ~3-4 Menit
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#f1f5f4] text-[#132628] text-xs font-mono font-medium border border-[#d2dedc]">
                            📋 22 Pertanyaan
                        </span>
                    </div>
                </div>

                @if ($existingAssessment)
                    <div class="mt-5 p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-center justify-between flex-wrap gap-2">
                        <span>ℹ️ Anda sudah pernah menyelesaikan pre-test pada <strong>{{ $existingAssessment->completed_at?->format('d M Y H:i') }}</strong> dengan skor <strong>{{ $existingAssessment->percentage }}%</strong> ({{ $existingAssessment->category }}). Anda dapat mengisi kembali untuk evaluasi terbaru.</span>
                        <a href="{{ route('pre-test.result', $existingAssessment->id) }}" class="underline font-semibold hover:text-amber-950">Lihat Hasil Sebelumnya &rarr;</a>
                    </div>
                @endif
            </div>

            <!-- Sticky Scale Guide & Live Progress Bar -->
            <div class="sticky top-20 z-20 mb-8 bg-white/95 backdrop-blur-md border border-[#d2dedc] rounded-2xl p-4 shadow-sm">
                <div class="flex items-center justify-between gap-4 mb-2">
                    <span class="text-xs font-semibold text-[#132628] flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#0b6b63]"></span>
                        <span>Kemajuan Pengisian:</span>
                        <span id="progressText" class="font-mono text-[#0b6b63] font-bold">0 / 22 Dijawab (0%)</span>
                    </span>
                    <span class="text-[11px] text-[#4a6366] hidden md:inline">Skala frekuensi: 0 (Tidak Pernah) s/d 6 (Selalu)</span>
                </div>

                <!-- Progress Track -->
                <div class="w-full bg-[#f1f5f4] h-2.5 rounded-full overflow-hidden border border-[#d2dedc]/50">
                    <div id="progressBar" class="bg-[#0b6b63] h-full transition-all duration-300 rounded-full" style="width: 0%"></div>
                </div>

                <!-- Petunjuk Skala Mini -->
                <div class="grid grid-cols-7 gap-1 mt-3 text-center text-[10px] sm:text-xs text-[#4a6366] font-mono">
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">0</b>Tdk Pernah</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">1</b>Hampir Tdk</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">2</b>Jarang</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">3</b>Kadang</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">4</b>Sering</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">5</b>Hampir Selalu</div>
                    <div class="p-1 rounded bg-[#f1f5f4]"><b class="block text-[#132628]">6</b>Selalu</div>
                </div>
            </div>

            <!-- Error Alerts if any -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    <div class="flex items-center gap-2 font-semibold">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Mohon lengkapi seluruh pertanyaan</span>
                    </div>
                    <p class="mt-1 text-xs text-red-700">Masih ada beberapa pertanyaan yang belum Anda pilih nilainya. Harap jawab semua pertanyaan untuk hasil yang akurat.</p>
                </div>
            @endif

            <!-- Questionnaire Form -->
            <form id="preTestForm" method="POST" action="{{ route('pre-test.store') }}" class="space-y-6">
                @csrf

                @php
                    $scaleOptions = [
                        0 => '0 - Tidak Pernah',
                        1 => '1 - Hampir Tidak Pernah',
                        2 => '2 - Jarang',
                        3 => '3 - Kadang-kadang',
                        4 => '4 - Sering',
                        5 => '5 - Hampir Selalu',
                        6 => '6 - Selalu',
                    ];
                    $currentDimension = '';
                @endphp

                @foreach ($questions as $q)
                    @if ($currentDimension !== $q->dimension)
                        @php $currentDimension = $q->dimension; @endphp
                        <div class="pt-4 pb-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-xs font-bold tracking-wide uppercase
                                {{ $q->dimension === 'EE' ? 'bg-orange-100 text-orange-800 border border-orange-200' : '' }}
                                {{ $q->dimension === 'DP' ? 'bg-amber-100 text-amber-800 border border-amber-200' : '' }}
                                {{ $q->dimension === 'PA' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : '' }}">
                                <span>Bagian: {{ $q->dimension_name }}</span>
                                <span class="font-normal opacity-75">({{ $q->dimension === 'EE' ? 'No. 1–9' : ($q->dimension === 'DP' ? 'No. 10–14' : 'No. 15–22') }})</span>
                            </div>
                        </div>
                    @endif

                    <div id="q_card_{{ $q->number }}" class="bg-white border border-[#d2dedc] rounded-2xl p-5 sm:p-6 transition hover:border-[#0b6b63]/50 {{ $errors->has('answers.'.$q->number) ? 'ring-2 ring-red-400 bg-red-50/20' : '' }}">
                        <div class="flex items-start gap-3.5 mb-4">
                            <span class="w-8 h-8 rounded-xl bg-[#f1f5f4] text-[#0b6b63] font-mono font-bold text-sm flex items-center justify-center shrink-0 border border-[#d2dedc]">
                                {{ $q->number }}
                            </span>
                            <div class="flex-1">
                                <h3 class="text-sm sm:text-base font-semibold text-[#132628] leading-snug">
                                    {{ $q->question_text }}
                                </h3>
                                @if ($q->is_reversed)
                                    <span class="text-[11px] text-[#4a6366] italic mt-0.5 block">
                                        *Pernyataan perasaan positif & pencapaian diri
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- 7 Scale Radio Buttons -->
                        <div class="grid grid-cols-7 gap-1.5 sm:gap-2 pt-1">
                            @foreach ($scaleOptions as $val => $lbl)
                                <label class="cursor-pointer relative group text-center">
                                    <input
                                        type="radio"
                                        name="answers[{{ $q->number }}]"
                                        value="{{ $val }}"
                                        {{ old('answers.'.$q->number) === (string)$val ? 'checked' : '' }}
                                        required
                                        onchange="updateProgress()"
                                        class="peer sr-only"
                                    >
                                    <div class="py-2.5 sm:py-3 px-1 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-[#132628] text-xs font-mono font-bold peer-checked:bg-[#0b6b63] peer-checked:border-[#0b6b63] peer-checked:text-white group-hover:border-[#0b6b63]/40 transition shadow-xs flex flex-col items-center justify-center">
                                        <span class="text-sm sm:text-base leading-none">{{ $val }}</span>
                                    </div>
                                    <span class="text-[9px] sm:text-[10px] text-[#4a6366] mt-1 block truncate font-sans" title="{{ $lbl }}">
                                        {{ explode(' - ', $lbl)[1] }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Bottom Submit Card -->
                <div class="sticky bottom-4 z-20 bg-white/95 backdrop-blur-md border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-[#4a6366] text-center sm:text-left">
                        <span class="font-semibold text-[#132628] block">Pastikan seluruh 22 butir sudah dipilih</span>
                        <span>Sistem akan langsung menghitung persentase skor dan mengarahkan ke mini game.</span>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-semibold text-sm shadow-sm transition active:scale-[0.99] cursor-pointer"
                    >
                        <span>Kirim & Lihat Persentase Skor</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Live Counter Script -->
    <script>
        function updateProgress() {
            const total = 22;
            let answered = 0;

            for (let i = 1; i <= total; i++) {
                const checked = document.querySelector(`input[name="answers[${i}]"]:checked`);
                const card = document.getElementById(`q_card_${i}`);
                if (checked) {
                    answered++;
                    if (card) {
                        card.classList.remove('border-[#d2dedc]', 'bg-red-50/20');
                        card.classList.add('border-[#0b6b63]/30', 'bg-white');
                    }
                }
            }

            const percent = Math.round((answered / total) * 100);
            document.getElementById('progressText').textContent = `${answered} / ${total} Dijawab (${percent}%)`;
            document.getElementById('progressBar').style.width = `${percent}%`;
        }

        // Run once on initial load
        document.addEventListener('DOMContentLoaded', updateProgress);
    </script>
</x-app-layout>
