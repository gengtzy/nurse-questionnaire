<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Header -->
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold uppercase tracking-wide border border-[#b2ded8]">
                    <span>👤 Profil Pengguna · RSUD Welas Asih</span>
                </div>
                <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-[#132628]">
                    Profil Akun
                </h1>
                <p class="text-xs sm:text-sm text-[#4a6366]">
                    Kelola informasi profil, identitas kepegawaian, dan pengaturan akun Anda.
                </p>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5 font-medium shadow-xs">
                    <span class="text-base">✓</span>
                    <span>Informasi profil akun Anda berhasil disimpan!</span>
                </div>
            @endif

            <!-- CARD 1: Profile Information (SS 2 App Theme) -->
            <div class="bg-white border-2 border-[#d2dedc] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
                <div>
                    <h2 class="font-display text-lg font-bold text-[#132628]">
                        Informasi Profil (Profile Information)
                    </h2>
                    <p class="text-xs text-[#4a6366] mt-0.5">
                        Perbarui nama tampilan dan alamat email akun Anda.
                    </p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Nama Lengkap
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            autofocus
                            autocomplete="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs sm:text-sm font-semibold text-[#132628] mb-1.5">
                            Alamat Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autocomplete="username"
                            value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                        >
                        <x-input-error class="mt-1.5" :messages="$errors->get('email')" />
                    </div>

                    <!-- Kepegawaian Read-only Metadata -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 rounded-2xl bg-[#f9fbfa] border border-[#d2dedc] text-xs">
                        <div>
                            <span class="text-[10px] text-[#4a6366] uppercase font-mono block">NIP</span>
                            <strong class="text-[#132628]">{{ $user->nip ?? '-' }}</strong>
                        </div>
                        <div>
                            <span class="text-[10px] text-[#4a6366] uppercase font-mono block">Ruangan</span>
                            <strong class="text-[#0b6b63]">{{ $user->room ?? 'Ruang Umar Bin Khattab 2' }}</strong>
                        </div>
                        <div>
                            <span class="text-[10px] text-[#4a6366] uppercase font-mono block">Jabatan / Role</span>
                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[11px] font-bold bg-[#dbeeeb] text-[#0b6b63]">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-between">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 py-3 px-6 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white font-bold text-xs uppercase tracking-wider shadow-xs transition active:scale-[0.98] cursor-pointer"
                        >
                            <span>Simpan Perubahan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>

                        <a href="{{ route('password.edit') }}" class="text-xs text-[#0b6b63] hover:underline font-semibold flex items-center gap-1">
                            <span>Ingin ganti kata sandi?</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- CARD 2: Delete Account (SS 2 App Theme) -->
            <div class="bg-white border-2 border-red-200 rounded-3xl p-6 sm:p-8 shadow-xs space-y-5">
                <div>
                    <h2 class="font-display text-lg font-bold text-red-700">
                        Hapus Akun (Delete Account)
                    </h2>
                    <p class="text-xs text-[#4a6366] mt-0.5 leading-relaxed">
                        Setelah akun Anda dihapus, semua data sesi kuesioner dan kartu apresiasi yang terkait akan terhapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>

                <div x-data="{ confirmingDeletion: false }">
                    <button
                        type="button"
                        @click="confirmingDeletion = true"
                        class="inline-flex items-center gap-2 py-2.5 px-5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider shadow-xs transition cursor-pointer"
                    >
                        <span>Hapus Akun Saya</span>
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div
                        x-show="confirmingDeletion"
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs"
                    >
                        <div
                            @click.stop
                            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 border-2 border-red-300 shadow-2xl space-y-4"
                        >
                            <h3 class="text-lg font-bold text-[#132628]">
                                Apakah Anda yakin ingin menghapus akun?
                            </h3>
                            <p class="text-xs text-[#4a6366] leading-relaxed">
                                Silakan masukkan kata sandi Anda saat ini untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun secara permanen.
                            </p>

                            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                                @csrf
                                @method('delete')

                                <div>
                                    <label for="delete_password" class="sr-only">Kata Sandi</label>
                                    <input
                                        id="delete_password"
                                        name="password"
                                        type="password"
                                        required
                                        placeholder="Masukkan kata sandi Anda"
                                        class="w-full rounded-xl border border-[#d2dedc] bg-[#f9fbfa] px-3.5 py-3 text-sm text-[#132628] focus:border-red-500 focus:ring-2 focus:ring-red-200"
                                    >
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-2">
                                    <button
                                        type="button"
                                        @click="confirmingDeletion = false"
                                        class="px-4 py-2.5 rounded-xl border border-[#d2dedc] bg-white hover:bg-gray-50 text-xs font-semibold text-[#132628]"
                                    >
                                        Batal
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase"
                                    >
                                        Ya, Hapus Akun
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
