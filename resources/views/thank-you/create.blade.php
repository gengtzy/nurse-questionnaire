<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#0b6b63] uppercase tracking-wider font-mono">Tahap Apresiasi Rekan Sejawat</span>
                    <span class="text-[#4a6366] font-mono">Langkah 3 dari 5</span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63] animate-pulse"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                </div>
                <div class="flex justify-between text-[11px] text-[#4a6366] mt-2 font-medium overflow-x-auto gap-2">
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 1. Pre-Test</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 2. Game Katarsis</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">★ 3. Kartu Apresiasi</span>
                    <span class="shrink-0">4. Post-Test</span>
                    <span class="shrink-0">5. Kirim Hasil</span>
                </div>
            </div>

            <!-- Main Thank You Card Card -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-6 sm:p-8 shadow-xs relative overflow-hidden">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#dbeeeb] text-[#0b6b63] flex items-center justify-center text-2xl shadow-2xs">
                        💌
                    </div>
                    <div>
                        <h1 class="font-display text-xl sm:text-2xl font-bold text-[#132628]">
                            Kartu terima kasih untuk rekan
                        </h1>
                        <p class="text-xs sm:text-sm text-[#4a6366] mt-0.5">
                            Pilih pesan singkat, lalu salin dan kirim ke rekan lewat aplikasi pesan Anda.
                        </p>
                    </div>
                </div>

                @if (session('info'))
                    <div class="mb-5 p-3 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs">
                        {{ session('info') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('thank-you.store') }}" class="space-y-5" id="thankYouForm">
                    @csrf

                    <!-- Nama Rekan -->
                    <div>
                        <label for="kName" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Nama rekan
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="kName"
                                name="recipient_name"
                                maxlength="60"
                                required
                                list="colleaguesList"
                                placeholder="Contoh: Ns. Hendra atau pilih dari daftar..."
                                value="{{ old('recipient_name') }}"
                                class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            >
                            <datalist id="colleaguesList">
                                @foreach ($colleagues as $c)
                                    <option value="{{ $c->name }}">{{ $c->role }}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1">
                            Ketik nama atau pilih perawat sejawat dari daftar Ruang UBK 2.
                        </p>
                    </div>

                    <!-- Pilihan Pesan (SS 2) -->
                    <div>
                        <label for="kMsg" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Pesan
                        </label>
                        <div class="relative">
                            <select
                                id="kMsg"
                                class="w-full appearance-none rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 pr-10 text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            >
                                @foreach ($messages as $idx => $msg)
                                    <option value="{{ $msg }}">{{ $msg }}</option>
                                @endforeach
                                <option value="custom">-- Tulis Pesan Sendiri --</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#4a6366]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Custom Message Input (Hidden by default) -->
                        <div id="customMsgWrapper" class="mt-2.5 hidden">
                            <textarea
                                id="customMsgInput"
                                rows="2"
                                placeholder="Tuliskan apresiasi tulus Anda untuk rekan..."
                                class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-2.5 text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Hidden Input for Actual Stored Message -->
                    <input type="hidden" name="message" id="actualMessage" value="{{ old('message', $messages[0]) }}">

                    <!-- Pratinjau Pesan -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="kPrev" class="block text-xs sm:text-sm font-semibold text-[#132628]">
                                Pratinjau
                            </label>
                            <span id="copyStatusBadge" class="text-xs font-semibold text-[#2f7d52] transition-opacity duration-300 opacity-0">
                                ✓ Pesan tersalin ke clipboard!
                            </span>
                        </div>
                        <div class="relative">
                            <textarea
                                id="kPrev"
                                readonly
                                rows="3"
                                class="w-full rounded-xl border border-[#b2ded8] bg-[#dbeeeb]/30 px-4 py-3 text-sm font-medium text-[#132628] select-all cursor-pointer focus:outline-none"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Tombol Salin Pesan (Sesuai SS 1) -->
                    <div>
                        <button
                            id="kCopy"
                            type="button"
                            class="inline-flex items-center gap-2 py-2.5 px-4 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-xs font-semibold shadow-xs transition active:scale-[0.98] cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                            </svg>
                            <span>Salin pesan</span>
                        </button>
                        <p class="text-[11px] text-[#4a6366] mt-2">
                            Salin pesan ini dan kirimkan ke rekan Anda lewat WhatsApp, Telegram, atau aplikasi pesan lainnya saat senggang.
                        </p>
                    </div>

                    <hr class="border-[#d2dedc]/80 my-4">

                    <!-- Submit & Proceed Button -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
                        <button
                            type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>Simpan & Lanjut ke Kuesioner Akhir (Post-Test)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>

                        <a
                            href="{{ route('post-test.create') }}"
                            class="text-xs text-[#4a6366] hover:text-[#132628] underline transition text-center sm:text-right"
                        >
                            Lewati tahap ini &rarr;
                        </a>
                    </div>
                </form>
            </div>

            <!-- Context Box -->
            <div class="p-4 rounded-xl bg-[#f1f5f4] border border-[#d2dedc] text-xs text-[#4a6366] space-y-1">
                <p class="font-semibold text-[#132628] flex items-center gap-1.5">
                    <span>💡 Mengapa Saling Mengapresiasi Penting?</span>
                </p>
                <p>
                    Dukungan sosial antar perawat terbukti klinis menjadi faktor pelindung terkuat (protective factor) terhadap kelelahan emosional (Emotional Exhaustion) dalam shift dinas rawat inap.
                </p>
            </div>

        </div>
    </div>

    <!-- Live Preview & Clipboard Script -->
    <script>
        (function() {
            var kName = document.getElementById('kName');
            var kMsg = document.getElementById('kMsg');
            var kPrev = document.getElementById('kPrev');
            var kCopy = document.getElementById('kCopy');
            var actualMessage = document.getElementById('actualMessage');
            var customMsgWrapper = document.getElementById('customMsgWrapper');
            var customMsgInput = document.getElementById('customMsgInput');
            var statusBadge = document.getElementById('copyStatusBadge');

            function getSelectedMessage() {
                if (kMsg.value === 'custom') {
                    return customMsgInput.value.trim() || 'Terima kasih atas kerja samanya hari ini.';
                }
                return kMsg.value;
            }

            function updatePreview() {
                var name = kName.value.trim();
                var msg = getSelectedMessage();
                actualMessage.value = msg;

                if (name) {
                    kPrev.value = name + ", " + msg.charAt(0).toLowerCase() + msg.slice(1);
                } else {
                    kPrev.value = msg;
                }
            }

            kName.addEventListener('input', updatePreview);

            kMsg.addEventListener('change', function() {
                if (kMsg.value === 'custom') {
                    customMsgWrapper.classList.remove('hidden');
                    customMsgInput.focus();
                } else {
                    customMsgWrapper.classList.add('hidden');
                }
                updatePreview();
            });

            customMsgInput.addEventListener('input', updatePreview);

            // Copy to clipboard with toast notification
            kCopy.addEventListener('click', function() {
                var textToCopy = kPrev.value;
                if (!textToCopy) return;

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(textToCopy).then(function() {
                        showCopySuccess();
                    }).catch(function() {
                        fallbackCopy();
                    });
                } else {
                    fallbackCopy();
                }
            });

            function fallbackCopy() {
                kPrev.focus();
                kPrev.select();
                try {
                    document.execCommand('copy');
                    showCopySuccess();
                } catch (e) {
                    alert('Silakan salin teks dari kotak pratinjau secara manual.');
                }
            }

            function showCopySuccess() {
                statusBadge.classList.remove('opacity-0');
                kCopy.classList.add('ring-2', 'ring-[#2f7d52]');
                setTimeout(function() {
                    statusBadge.classList.add('opacity-0');
                    kCopy.classList.remove('ring-2', 'ring-[#2f7d52]');
                }, 2500);
            }

            // Initial render
            updatePreview();
        })();
    </script>
</x-app-layout>
