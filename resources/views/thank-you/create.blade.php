<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Progress Tracker -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs">
                <div class="flex items-center justify-between text-xs mb-3">
                    <span class="font-bold text-[#0b6b63] uppercase tracking-wider font-mono">Tahap Apresiasi Rekan Sejawat</span>
                    <span class="text-[#4a6366] font-mono">Langkah 4 dari 5</span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63]"></div>
                    <div class="h-2 rounded-full bg-[#0b6b63] animate-pulse"></div>
                    <div class="h-2 rounded-full bg-[#d2dedc]"></div>
                </div>
                <div class="flex justify-between text-[11px] text-[#4a6366] mt-2 font-medium overflow-x-auto gap-2">
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 1. Pre-Test</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 2. Intervensi</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">✓ 3. Game Stres</span>
                    <span class="text-[#0b6b63] font-bold shrink-0">★ 4. Kirim Pesan</span>
                    <span class="shrink-0">5. Post-Test</span>
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
                            Kirim Pesan Apresiasi untuk Rekan
                        </h1>
                        <p class="text-xs sm:text-sm text-[#4a6366] mt-0.5">
                            Pilih rekan perawat dan pesan positif. Pesan akan langsung terkirim ke kotak pesan akun rekan Anda.
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

                    <!-- Pilih Nama Rekan (Dropdown Select Nama-nama Perawat Selain Karu) -->
                    <div>
                        <label for="kRecipient" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Pilih Rekan Perawat Penerima
                        </label>
                        <div class="relative">
                            <select
                                id="kRecipient"
                                name="recipient_id"
                                required
                                class="w-full appearance-none rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 pr-10 text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            >
                                <option value="">-- Pilih Rekan Perawat (Ruang UBK 2) --</option>
                                @foreach ($colleagues as $c)
                                    <option value="{{ $c->id }}" data-name="{{ $c->name }}" {{ old('recipient_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->role }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#4a6366]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1">
                            Pilih nama rekan sejawat di Ruang UBK 2 yang ingin Anda beri apresiasi.
                        </p>
                    </div>

                    <!-- Pilihan Pesan -->
                    <div>
                        <label for="kMsg" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Pilihan Pesan Apresiasi
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
                                rows="3"
                                placeholder="Tuliskan apresiasi tulus Anda untuk rekan..."
                                class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-2.5 text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Hidden Input for Actual Stored Message -->
                    <input type="hidden" name="message" id="actualMessage" value="{{ old('message', $messages[0]) }}">

                    <!-- Pratinjau Pesan -->
                    <div>
                        <label for="kPrev" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Pratinjau Pesan yang Akan Terkirim
                        </label>
                        <div class="p-4 rounded-xl border border-[#b2ded8] bg-[#dbeeeb]/30 text-sm text-[#132628] space-y-1.5 font-medium">
                            <div class="text-xs text-[#0b6b63] font-semibold" id="prevTo">
                                Kepada: [Pilih Rekan Perawat]
                            </div>
                            <div class="italic text-[#132628]" id="prevContent">
                                “{{ $messages[0] }}”
                            </div>
                            <div class="text-[11px] text-[#4a6366] text-right pt-1 border-t border-[#b2ded8]/40">
                                Dari: <strong>{{ $user->name }}</strong>
                            </div>
                        </div>
                        <p class="text-[11px] text-[#4a6366] mt-1.5">
                            Pesan ini akan otomatis muncul pada <strong>Kotak Pesan</strong> di navbar akun rekan perawat yang Anda pilih.
                        </p>
                    </div>

                    <hr class="border-[#d2dedc]/80 my-4">

                    <!-- Submit Button: Kirim Pesan Langsung ke Akun Penerima -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
                        <button
                            type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-sm shadow-md transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>Kirim Pesan &amp; Lanjut ke Post-Test 💌</span>
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

        </div>
    </div>

    <!-- Dynamic Script for Message Preview -->
    <script>
    (function () {
        const kRecipient = document.getElementById('kRecipient');
        const kMsg = document.getElementById('kMsg');
        const customWrapper = document.getElementById('customMsgWrapper');
        const customInput = document.getElementById('customMsgInput');
        const actualMessage = document.getElementById('actualMessage');
        const prevTo = document.getElementById('prevTo');
        const prevContent = document.getElementById('prevContent');

        function updatePreview() {
            // Recipient
            const selectedOpt = kRecipient.options[kRecipient.selectedIndex];
            if (selectedOpt && selectedOpt.value) {
                const name = selectedOpt.getAttribute('data-name') || selectedOpt.text;
                prevTo.textContent = `Kepada: ${name}`;
            } else {
                prevTo.textContent = `Kepada: [Pilih Rekan Perawat]`;
            }

            // Message
            let text = '';
            if (kMsg.value === 'custom') {
                customWrapper.classList.remove('hidden');
                text = customInput.value.trim() || 'Tuliskan pesan apresiasi Anda...';
            } else {
                customWrapper.classList.add('hidden');
                text = kMsg.value;
            }

            actualMessage.value = text;
            prevContent.textContent = `“${text}”`;
        }

        kRecipient.addEventListener('change', updatePreview);
        kMsg.addEventListener('change', updatePreview);
        customInput.addEventListener('input', updatePreview);

        updatePreview();
    })();
    </script>
</x-app-layout>
