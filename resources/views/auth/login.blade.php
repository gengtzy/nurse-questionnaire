<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="mb-4 text-right">
            <span class="text-[11px] text-[#4a6366] font-mono">Nurse Recharge v1.0</span>
        </div>

        <!-- Eyebrow & Brand Header -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-3">
                <img src="{{ asset('images/logo_welas_asih.png') }}" alt="Logo RSUD Welas Asih" class="w-20 h-20 object-contain drop-shadow-sm">
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold tracking-wide uppercase mb-3 border border-[#b2ded8]">
                <span class="w-2 h-2 rounded-full bg-[#0b6b63] animate-pulse"></span>
                <span>Ruang Umar Bin Khattab 2 · RSUD Welas Asih</span>
            </div>
            <h1 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-[#132628]">
                Nurse Recharge
            </h1>
            <p class="text-sm text-[#4a6366] mt-1 max-w-sm mx-auto">
                Portal evaluasi berkala burnout, mini game pelepas penat, dan monitoring kesejahteraan perawat
            </p>
        </div>

        <!-- Main Card -->
        <div class="bg-white border border-[#d2dedc] shadow-sm rounded-2xl p-6 sm:p-8">
            <!-- Session Status Alert -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            @if (isset($errors) && $errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    <div class="flex items-center gap-2 font-medium">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>Gagal Masuk</span>
                    </div>
                    <ul class="mt-1.5 list-disc list-inside text-xs text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Dropdown Nama Perawat / Kepala Ruangan -->
                <div>
                    <label for="user_id" class="block text-sm font-semibold text-[#132628] mb-1.5">
                        Pilih Nama Tenaga Medis / Kepala Ruangan
                    </label>
                    <div class="relative">
                        <select
                            id="user_id"
                            name="user_id"
                            required
                            autofocus
                            onchange="onUserSelectChange(this)"
                            class="block w-full appearance-none rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 pr-10 text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                            <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>
                                -- Pilih nama dari daftar --
                            </option>
                            @foreach ($nurses as $nurse)
                                <option
                                    value="{{ $nurse->id }}"
                                    data-role="{{ $nurse->role }}"
                                    {{ old('user_id') == $nurse->id ? 'selected' : '' }}
                                >
                                    {{ $nurse->name }} — {{ $nurse->role }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#4a6366]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-[#4a6366] mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-[#0b6b63] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Nama diambil otomatis dari daftar tenaga medis Ruang UBK 2</span>
                    </p>
                </div>

                <!-- Kata Sandi -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-[#132628] mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan kata sandi..."
                            class="block w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 pr-10 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#4a6366] hover:text-[#132628] focus:outline-none"
                            title="Tampilkan / sembunyikan sandi"
                        >
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Dynamic Helper & Quick Fill Buttons -->
                    <!-- <div class="mt-2.5 p-3 rounded-xl bg-[#f1f5f4] border border-[#d2dedc] space-y-2">
                        <div class="flex items-center justify-between text-xs text-[#4a6366]">
                            <span class="font-medium flex items-center gap-1.5">
                                <span>🔑</span>
                                <span id="roleLabelHint">Bantuan Sandi:</span>
                            </span>
                            <span id="targetDashboardHint" class="text-[11px] font-semibold text-[#0b6b63]">Dashboard Kuesioner</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <button
                                type="button"
                                id="btnFillPerawat"
                                onclick="fillPassword('perawat123', 'Perawat')"
                                class="px-2.5 py-1.5 rounded-lg bg-white border border-[#d2dedc] font-mono text-[#0b6b63] font-semibold text-xs text-center hover:bg-[#dbeeeb] hover:border-[#0b6b63] transition flex items-center justify-center gap-1 cursor-pointer"
                                title="Isi sandi perawat (perawat123)"
                            >
                                <span>Perawat:</span>
                                <span class="underline">perawat123</span>
                            </button>
                            <button
                                type="button"
                                id="btnFillKaru"
                                onclick="fillPassword('karu123', 'Kepala Ruangan')"
                                class="px-2.5 py-1.5 rounded-lg bg-white border border-[#d2dedc] font-mono text-[#e8501a] font-semibold text-xs text-center hover:bg-orange-50 hover:border-[#e8501a] transition flex items-center justify-center gap-1 cursor-pointer"
                                title="Isi sandi Kepala Ruangan (karu123)"
                            >
                                <span>👑 Karu:</span>
                                <span class="underline">karu123</span>
                            </button>
                        </div>
                    </div> -->
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-[#d2dedc] text-[#0b6b63] shadow-sm focus:ring-[#0b6b63]"
                            name="remember"
                            checked
                        >
                        <span class="ms-2 text-xs text-[#4a6366]">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-1">
                    <button
                        type="submit"
                        id="submitButton"
                        class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-semibold text-sm shadow-sm transition active:scale-[0.99] cursor-pointer"
                    >
                        <span id="submitButtonText">Masuk ke Sistem</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Privacy & Medical Ethics Note -->
        <div class="text-center mt-6 text-xs text-[#4a6366] max-w-sm mx-auto space-y-1">
            <p>🔒 Jawaban Anda digunakan khusus untuk evaluasi kesejahteraan perawat.</p>
            <p class="font-mono text-[11px] text-[#9db4b2]">Ruang Rawat Inap Umar Bin Khattab 2 · RSUD Welas Asih</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        }

        function fillPassword(val, role) {
            const pwd = document.getElementById('password');
            pwd.value = val;
            pwd.focus();
        }

        function onUserSelectChange(selectElem) {
            const selectedOption = selectElem.options[selectElem.selectedIndex];
            const role = selectedOption.getAttribute('data-role') || '';
            const pwd = document.getElementById('password');
            const hintRole = document.getElementById('roleLabelHint');
            const hintDashboard = document.getElementById('targetDashboardHint');
            const submitText = document.getElementById('submitButtonText');
            const btnKaru = document.getElementById('btnFillKaru');
            const btnPerawat = document.getElementById('btnFillPerawat');

            if (role === 'Kepala Ruangan') {
                pwd.value = 'karu123';
                hintRole.textContent = 'Akun Kepala Ruangan (Admin):';
                hintDashboard.textContent = 'Akan diarahkan ke Monitoring Rekap';
                submitText.textContent = 'Masuk Panel Monitoring & Rekap';
                btnKaru.classList.add('ring-2', 'ring-[#e8501a]');
                btnPerawat.classList.remove('ring-2', 'ring-[#0b6b63]');
            } else {
                pwd.value = 'perawat123';
                hintRole.textContent = 'Akun Perawat:';
                hintDashboard.textContent = 'Dashboard Kuesioner Perawat';
                submitText.textContent = 'Masuk & Mulai Kuesioner';
                btnPerawat.classList.add('ring-2', 'ring-[#0b6b63]');
                btnKaru.classList.remove('ring-2', 'ring-[#e8501a]');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const selectElem = document.getElementById('user_id');
            if (selectElem && selectElem.value) {
                onUserSelectChange(selectElem);
            }
        });
    </script>
</x-guest-layout>
