<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header -->
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold uppercase tracking-wide border border-[#b2ded8]">
                    <span>🔒 Keamanan &amp; Kata Sandi</span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-[#132628]">
                    Update Password Akun
                </h1>
                <p class="text-xs sm:text-sm text-[#4a6366]">
                    Perbarui kata sandi secara berkala untuk menjaga keamanan akses data evaluasi dan rekapitulasi Anda.
                </p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5 font-medium shadow-xs">
                    <span class="text-base">✓</span>
                    <span>Kata sandi Anda berhasil diperbarui! Silakan gunakan kata sandi baru pada login berikutnya.</span>
                </div>
            @endif

            <!-- Main Form Card (SS 2 App Theme Style) -->
            <div class="bg-white border-2 border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
                <div>
                    <h2 class="font-display text-lg font-bold text-[#132628]">
                        Ganti Kata Sandi (Update Password)
                    </h2>
                    <p class="text-xs text-[#4a6366] mt-0.5">
                        Pastikan kata sandi baru minimal 8 karakter dan mengandung kombinasi huruf serta angka.
                    </p>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Kata Sandi Saat Ini (Current Password)
                        </label>
                        <input
                            id="current_password"
                            name="current_password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Kata Sandi Baru (New Password)
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Konfirmasi Kata Sandi Baru (Confirm Password)
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    <div class="pt-2 flex items-center justify-between">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 py-3 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-xs uppercase tracking-wider shadow-xs transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>Simpan Kata Sandi</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>

                        <a href="{{ route('profile.edit') }}" class="text-xs text-[#4a6366] hover:text-[#132628] underline">
                            Kembali ke Profil &rarr;
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

