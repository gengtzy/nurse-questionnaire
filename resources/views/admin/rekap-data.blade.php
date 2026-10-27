<x-app-layout>
    <div class="py-6 sm:py-8" x-data="{
        search: '',
        filterStatus: 'all',
        records: {{ Js::from($records) }},
        get filteredRecords() {
            return this.records.filter(r => {
                const matchesSearch = this.search === '' ||
                    r.name.toLowerCase().includes(this.search.toLowerCase()) ||
                    r.role.toLowerCase().includes(this.search.toLowerCase()) ||
                    (r.thank_you_recipient && r.thank_you_recipient.toLowerCase().includes(this.search.toLowerCase())) ||
                    (r.thank_you_message && r.thank_you_message.toLowerCase().includes(this.search.toLowerCase()));

                if (!matchesSearch) return false;

                if (this.filterStatus === 'complete') return r.is_complete;
                if (this.filterStatus === 'pre_only') return r.has_pre && !r.has_post;
                if (this.filterStatus === 'empty') return !r.has_pre && !r.has_post;

                return true;
            });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Top Header & Role Indicator -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white border border-[#d2dedc] rounded-2xl p-5 sm:p-6 shadow-xs">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold tracking-wide uppercase mb-2 border border-[#b2ded8]">
                        <span class="w-2 h-2 rounded-full bg-[#0b6b63] animate-pulse"></span>
                        <span>Ruang Umar Bin Khattab 2 · RSUD Welas Asih</span>
                    </div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-[#132628]">
                        Monitoring Burnout & Kesejahteraan Perawat
                    </h1>
                    <p class="text-xs sm:text-sm text-[#4a6366] mt-1">
                        Panel pemantauan berkala kondisi keletihan kerja tenaga perawat · Kepala Ruangan: <strong>Oom Umriah,S.Kep.,Ners</strong>
                    </p>
                </div>

                <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#dbeeeb] text-[#0b6b63] text-xs font-semibold border border-[#b2ded8]">
                        <span>💌</span>
                        <span>{{ $stats['total_thank_you_cards'] ?? 0 }} Kartu Apresiasi Terkirim</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#0b6b63] text-white text-xs font-semibold shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-white"></span>
                        <span>Akses Kepala Ruangan (Admin)</span>
                    </span>
                </div>
            </div>

            <!-- 5 Research / Monitoring KPI Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Stat 1: Sesi Evaluasi & Perawat -->
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs font-mono uppercase tracking-wider text-[#4a6366] block mb-1">Total Sesi Evaluasi</span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-3xl font-bold text-[#132628]">{{ $stats['completed'] }}</span>
                        <span class="text-xs text-[#4a6366] font-mono">sesi selesai</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between text-xs">
                        <span class="text-[#0b6b63] font-semibold">{{ $stats['unique_nurses_count'] }} Perawat Aktif</span>
                        <span class="text-[#4a6366]">{{ $stats['empty'] }} Belum Mengisi</span>
                    </div>
                </div>

                <!-- Stat 2: Avg Delta Score -->
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs font-mono uppercase tracking-wider text-[#4a6366] block mb-1">Rata-Rata Selisih (&Delta;)</span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-3xl font-bold {{ $stats['avg_delta'] <= 0 ? 'text-[#2f7d52]' : 'text-[#b03a2e]' }}">
                            {{ $stats['avg_delta'] > 0 ? '+'.$stats['avg_delta'] : $stats['avg_delta'] }}%
                        </span>
                    </div>
                    <div class="mt-3 flex items-center justify-between text-xs text-[#4a6366]">
                        <span>Pre: <strong>{{ $stats['avg_pre'] }}%</strong></span>
                        <span>&rarr;</span>
                        <span>Post: <strong>{{ $stats['avg_post'] }}%</strong></span>
                    </div>
                </div>

                <!-- Stat 3: Responden Membaik -->
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs font-mono uppercase tracking-wider text-[#4a6366] block mb-1">Efektivitas Relaksasi</span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-3xl font-bold text-[#0b6b63]">{{ $stats['improved_percentage'] }}%</span>
                        <span class="text-xs text-[#4a6366]">sesi evaluasi</span>
                    </div>
                    <p class="text-xs text-[#4a6366] mt-3">
                        <strong class="text-[#0b6b63]">{{ $stats['improved_count'] }} sesi</strong> penurunan beban stres kerja.
                    </p>
                </div>

                <!-- Stat 4: Intervensi Butterfly Hug -->
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs font-mono uppercase tracking-wider text-[#4a6366] block mb-1">Butterfly Hug 🦋</span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-3xl font-bold text-[#0b6b63]">
                            {{ $stats['avg_tension_diff'] > 0 ? '-'.$stats['avg_tension_diff'] : $stats['avg_tension_diff'] }}
                        </span>
                        <span class="text-xs text-[#4a6366]">poin tegang</span>
                    </div>
                    <p class="text-xs text-[#4a6366] mt-3">
                        Rerata reduksi dari <strong class="text-[#0b6b63]">{{ $stats['total_interventions'] }} sesi</strong> relaksasi.
                    </p>
                </div>

                <!-- Stat 5: Avg Game Score -->
                <div class="bg-white border border-[#d2dedc] rounded-2xl p-5 shadow-xs">
                    <span class="text-xs font-mono uppercase tracking-wider text-[#4a6366] block mb-1">Rerata Skor Katarsis</span>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono text-3xl font-bold text-[#e8501a]">{{ number_format($stats['avg_game_score']) }}</span>
                        <span class="text-xs text-[#4a6366]">poin mini game</span>
                    </div>
                    <p class="text-xs text-[#4a6366] mt-3">
                        Aktivitas pelepasan penat shift dinas.
                    </p>
                </div>
            </div>

            <!-- Date Range Filter & Toolbar -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl p-4 sm:p-5 shadow-xs space-y-4">
                
                <!-- Row 1: Filter Rentang Tanggal -->
                <form method="GET" action="{{ route('admin.rekap') }}" class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-[#d2dedc]/60">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="text-xs font-bold text-[#132628] flex items-center gap-1.5">
                            <span>📅 Rentang Tanggal:</span>
                        </span>

                        <div class="flex items-center gap-2">
                            <input
                                type="date"
                                name="start_date"
                                value="{{ $startDate }}"
                                class="px-3 py-1.5 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-xs text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none"
                                title="Tanggal Mulai"
                            >
                            <span class="text-xs text-[#4a6366]">s/d</span>
                            <input
                                type="date"
                                name="end_date"
                                value="{{ $endDate }}"
                                class="px-3 py-1.5 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-xs text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none"
                                title="Tanggal Selesai"
                            >
                        </div>

                        <button
                            type="submit"
                            class="px-3.5 py-1.5 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-xs font-semibold shadow-2xs transition cursor-pointer"
                        >
                            Filter
                        </button>

                        @if ($startDate || $endDate)
                            <a
                                href="{{ route('admin.rekap') }}"
                                class="px-3 py-1.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium transition"
                            >
                                Reset
                            </a>
                        @endif
                    </div>

                    <!-- Quick Preset Buttons -->
                    <div class="flex flex-wrap items-center gap-1.5 text-xs text-[#4a6366]">
                        <span class="text-[11px] font-semibold text-[#4a6366]">Preset:</span>
                        <a
                            href="{{ route('admin.rekap', ['start_date' => now()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}"
                            class="px-2.5 py-1 rounded-lg border border-[#d2dedc] hover:bg-[#dbeeeb] hover:text-[#0b6b63] text-[11px] transition"
                        >
                            Hari Ini
                        </a>
                        <a
                            href="{{ route('admin.rekap', ['start_date' => now()->subDays(6)->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}"
                            class="px-2.5 py-1 rounded-lg border border-[#d2dedc] hover:bg-[#dbeeeb] hover:text-[#0b6b63] text-[11px] transition"
                        >
                            7 Hari Terakhir
                        </a>
                        <a
                            href="{{ route('admin.rekap', ['start_date' => now()->startOfMonth()->format('Y-m-d'), 'end_date' => now()->format('Y-m-d')]) }}"
                            class="px-2.5 py-1 rounded-lg border border-[#d2dedc] hover:bg-[#dbeeeb] hover:text-[#0b6b63] text-[11px] transition"
                        >
                            Bulan Ini
                        </a>
                        <a
                            href="{{ route('admin.rekap') }}"
                            class="px-2.5 py-1 rounded-lg border border-[#d2dedc] hover:bg-[#dbeeeb] hover:text-[#0b6b63] text-[11px] transition"
                        >
                            Semua Waktu
                        </a>
                    </div>
                </form>

                <!-- Row 2: Search Box & Export Buttons -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <!-- Left: Search & Status Filter -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1 max-w-xl">
                        <!-- Search Box -->
                        <div class="relative flex-1">
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Cari nama perawat atau jabatan..."
                                class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-xs sm:text-sm text-[#132628] placeholder-[#9db4b2] focus:border-[#0b6b63] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b6b63]/20 transition"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#4a6366]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <!-- Filter Status Dropdown -->
                        <div class="w-full sm:w-44">
                            <select
                                x-model="filterStatus"
                                class="w-full py-2.5 px-3 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] text-xs sm:text-sm text-[#132628] focus:border-[#0b6b63] focus:bg-white focus:outline-none transition"
                            >
                                <option value="all">Semua Status</option>
                                <option value="complete">Lengkap (Pre & Post)</option>
                                <option value="pre_only">Hanya Pre-Test</option>
                                <option value="empty">Belum Mengisi</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right: Excel & CSV Export Buttons -->
                    <div class="flex items-center gap-2.5 shrink-0">
                        <!-- Export Excel (.xls) -->
                        <a
                            href="{{ route('admin.rekap.export', ['format' => 'excel', 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0b6b63] hover:bg-[#08524c] text-white text-xs sm:text-sm font-semibold shadow-xs transition active:scale-[0.98] cursor-pointer"
                            title="Unduh rekapitulasi data lengkap ke file Microsoft Excel (.xls) dengan format warna dan formula rata-rata"
                        >
                            <svg class="w-4 h-4 shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Unduh Excel (.xls)</span>
                        </a>

                        <!-- Export CSV Dropdown -->
                        <div class="relative" x-data="{ openCsv: false }">
                            <button
                                type="button"
                                @click="openCsv = !openCsv"
                                class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl border border-[#d2dedc] bg-[#f9fbfa] hover:bg-[#f1f5f4] text-xs font-semibold text-[#132628] transition cursor-pointer"
                            >
                                <span>CSV</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div
                                x-show="openCsv"
                                @click.away="openCsv = false"
                                x-transition
                                class="absolute right-0 mt-1.5 w-44 rounded-xl bg-white border border-[#d2dedc] shadow-lg py-1.5 z-20 text-xs text-[#132628]"
                            >
                                <a
                                    href="{{ route('admin.rekap.export', ['format' => 'csv', 'delimiter' => ',', 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                                    class="block px-3.5 py-2 hover:bg-[#f1f5f4] transition"
                                >
                                    CSV Koma (,)
                                </a>
                                <a
                                    href="{{ route('admin.rekap.export', ['format' => 'csv', 'delimiter' => ';', 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                                    class="block px-3.5 py-2 hover:bg-[#f1f5f4] transition"
                                >
                                    CSV Titik Koma (;)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Counter & Active Filter Badge -->
                <div class="flex items-center justify-between text-xs text-[#4a6366] pt-2 border-t border-[#d2dedc]/60">
                    <div class="flex items-center gap-2">
                        <span>Menampilkan <strong class="text-[#132628]" x-text="filteredRecords.length"></strong> baris sesi evaluasi</span>
                        @if ($startDate || $endDate)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-[#dbeeeb] text-[#0b6b63] text-[10px] font-semibold">
                                Filter: {{ $startDate ?? 'Awal' }} s/d {{ $endDate ?? 'Sekarang' }}
                            </span>
                        @endif
                    </div>
                    <span class="text-[11px] font-mono text-[#0b6b63]">Waktu Indonesia Barat (WIB)</span>
                </div>
            </div>

            <!-- Master Data Matrix Table (Displays Every Evaluation Session) -->
            <div class="bg-white border border-[#d2dedc] rounded-2xl shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-[#f1f5f4] border-b border-[#d2dedc] text-[#4a6366] uppercase tracking-wider font-mono text-[10px]">
                                <th class="py-3 px-3.5 font-bold w-12 text-center">No</th>
                                <th class="py-3 px-4 font-bold min-w-[200px]">Nama Perawat</th>
                                <th class="py-3 px-3.5 font-bold min-w-[130px] text-center">Sesi Pengisian</th>
                                <th class="py-3 px-3.5 font-bold min-w-[110px] text-center">Pre-Test</th>
                                <th class="py-3 px-3.5 font-bold min-w-[140px]">Intervensi Butterfly Hug</th>
                                <th class="py-3 px-3.5 font-bold min-w-[130px]">Sesi Mini Game</th>
                                <th class="py-3 px-3.5 font-bold min-w-[190px]">Kartu Terima Kasih</th>
                                <th class="py-3 px-3.5 font-bold min-w-[110px] text-center">Post-Test</th>
                                <th class="py-3 px-3.5 font-bold min-w-[110px] text-center">Selisih (&Delta;)</th>
                                <th class="py-3 px-4 font-bold min-w-[160px]">Rincian Dimensi (EE &bull; DP &bull; PA)</th>
                                <th class="py-3 px-3.5 font-bold min-w-[120px] text-center">Waktu Selesai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#d2dedc]/60">
                            <template x-for="(r, index) in filteredRecords" :key="r.user_id + '-' + r.session_number">
                                <tr class="hover:bg-[#f9fbfa] transition">
                                    <!-- No -->
                                    <td class="py-3 px-3.5 text-center font-mono text-[#4a6366]" x-text="index + 1"></td>

                                    <!-- Nama Perawat & Role -->
                                    <td class="py-3 px-4">
                                        <div class="font-bold text-[#132628]" x-text="r.name"></div>
                                        <div class="text-[11px] text-[#0b6b63] font-semibold mt-0.5" x-text="r.role"></div>
                                    </td>

                                    <!-- Sesi Pengisian Badge -->
                                    <td class="py-3 px-3.5 text-center">
                                        <template x-if="r.is_complete">
                                            <div>
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#dff0e5] text-[#2f7d52] border border-[#b8e2cb]">
                                                    <span>✓</span>
                                                    <span x-text="r.session_label"></span>
                                                </span>
                                            </div>
                                        </template>
                                        <template x-if="r.has_pre && !r.has_post">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#f7ebd2] text-[#a8680f] border border-[#ecd5a9]">
                                                <span>⏳</span>
                                                <span>Hanya Pre-Test</span>
                                            </span>
                                        </template>
                                        <template x-if="!r.has_pre && !r.has_post">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-medium bg-[#f1f5f4] text-[#4a6366] border border-[#d2dedc]">
                                                <span>— Belum Mengisi —</span>
                                            </span>
                                        </template>
                                    </td>

                                    <!-- Pre-Test Score -->
                                    <td class="py-3 px-3.5 text-center">
                                        <template x-if="r.has_pre">
                                            <div>
                                                <span class="font-mono text-sm font-bold text-[#132628]" x-text="r.pre_percentage + '%'"></span>
                                                <div class="text-[10px] text-[#4a6366] font-mono" x-text="r.pre_total + '/132 (' + r.pre_category + ')'"></div>
                                            </div>
                                        </template>
                                        <template x-if="!r.has_pre">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Butterfly Hug Intervention -->
                                    <td class="py-3 px-3.5">
                                        <template x-if="r.has_intervention">
                                            <div class="text-[11px] space-y-0.5">
                                                <div class="font-bold flex items-center gap-1.5 text-[#132628]">
                                                    <span class="text-xs">🦋</span>
                                                    <span class="font-mono text-xs" x-text="r.intervention_before + ' → ' + r.intervention_after"></span>
                                                    <template x-if="r.intervention_diff > 0">
                                                        <span class="text-emerald-700 font-bold font-mono text-[10px] bg-emerald-50 px-1 py-0.2 rounded border border-emerald-200" x-text="'-' + r.intervention_diff + ' pt'"></span>
                                                    </template>
                                                    <template x-if="r.intervention_diff === 0">
                                                        <span class="text-amber-700 font-mono text-[10px] bg-amber-50 px-1 py-0.2 rounded border border-amber-200">0 pt</span>
                                                    </template>
                                                    <template x-if="r.intervention_diff < 0">
                                                        <span class="text-red-700 font-mono text-[10px] bg-red-50 px-1 py-0.2 rounded border border-red-200" x-text="'+' + Math.abs(r.intervention_diff) + ' pt'"></span>
                                                    </template>
                                                </div>
                                                <div class="text-[#4a6366] text-[10px] font-mono">
                                                    <span x-text="r.intervention_duration + 's'"></span> &bull; <span x-text="(r.intervention_taps || 0) + ' tepukan'"></span>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="!r.has_intervention">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Mini Game Info -->
                                    <td class="py-3 px-3.5">
                                        <template x-if="r.has_game">
                                            <div class="text-[11px]">
                                                <div class="font-bold text-[#e8501a]" x-text="r.game_score + ' Poin'"></div>
                                                <div class="text-[#4a6366] text-[10px]">
                                                    <span x-text="r.game_smashed + ' beban'"></span> &bull; <span x-text="r.game_duration + 's'"></span>
                                                </div>
                                                <span class="text-[9px] font-bold text-[#0b6b63]" x-text="r.game_boss ? 'Boss Kalah 💥' : 'Selesai'"></span>
                                            </div>
                                        </template>
                                        <template x-if="!r.has_game">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Kartu Terima Kasih (Rekan) -->
                                    <td class="py-3 px-3.5">
                                        <template x-if="r.has_thank_you">
                                            <div class="text-[11px] space-y-1">
                                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-[#dbeeeb] text-[#0b6b63] font-bold text-[10px] border border-[#b2ded8]">
                                                    <span>💌 Untuk:</span>
                                                    <span class="truncate max-w-[140px]" x-text="r.thank_you_recipient"></span>
                                                </div>
                                                <div class="text-[#4a6366] text-[10px] leading-tight italic line-clamp-2" :title="r.thank_you_message" x-text="'“' + r.thank_you_message + '”'"></div>
                                            </div>
                                        </template>
                                        <template x-if="!r.has_thank_you">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Post-Test Score -->
                                    <td class="py-3 px-3.5 text-center">
                                        <template x-if="r.has_post">
                                            <div>
                                                <span class="font-mono text-sm font-bold text-[#0b6b63]" x-text="r.post_percentage + '%'"></span>
                                                <div class="text-[10px] text-[#0b6b63] font-mono" x-text="r.post_total + '/132 (' + r.post_category + ')'"></div>
                                            </div>
                                        </template>
                                        <template x-if="!r.has_post">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Delta Change -->
                                    <td class="py-3 px-3.5 text-center">
                                        <template x-if="r.is_complete">
                                            <div>
                                                <span
                                                    class="font-mono text-sm font-bold inline-block px-2 py-0.5 rounded"
                                                    :class="r.diff_percentage < 0 ? 'bg-green-100 text-green-800' : (r.diff_percentage === 0 ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800')"
                                                    x-text="(r.diff_percentage > 0 ? '+' : '') + r.diff_percentage + '%'"
                                                ></span>
                                                <div class="text-[10px] text-[#4a6366] mt-0.5" x-text="r.diff_percentage < 0 ? 'Membaik' : (r.diff_percentage === 0 ? 'Stabil' : 'Meningkat')"></div>
                                            </div>
                                        </template>
                                        <template x-if="!r.is_complete">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Dimensi EE, DP, PA -->
                                    <td class="py-3 px-4">
                                        <template x-if="r.is_complete">
                                            <div class="space-y-0.5 font-mono text-[11px]">
                                                <div class="flex justify-between">
                                                    <span class="text-[#4a6366]">EE:</span>
                                                    <span><strong x-text="r.pre_ee"></strong> &rarr; <strong class="text-[#0b6b63]" x-text="r.post_ee"></strong> (<span :class="r.diff_ee <= 0 ? 'text-green-700 font-bold' : 'text-red-700'" x-text="(r.diff_ee > 0 ? '+' : '') + r.diff_ee"></span>)</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-[#4a6366]">DP:</span>
                                                    <span><strong x-text="r.pre_dp"></strong> &rarr; <strong class="text-[#0b6b63]" x-text="r.post_dp"></strong> (<span :class="r.diff_dp <= 0 ? 'text-green-700 font-bold' : 'text-red-700'" x-text="(r.diff_dp > 0 ? '+' : '') + r.diff_dp"></span>)</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-[#4a6366]">PA:</span>
                                                    <span><strong x-text="r.pre_pa"></strong> &rarr; <strong class="text-[#0b6b63]" x-text="r.post_pa"></strong> (<span :class="r.diff_pa <= 0 ? 'text-green-700 font-bold' : 'text-red-700'" x-text="(r.diff_pa > 0 ? '+' : '') + r.diff_pa"></span>)</span>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="!r.is_complete">
                                            <span class="text-[#9db4b2] font-mono">-</span>
                                        </template>
                                    </td>

                                    <!-- Completed At (WIB) -->
                                    <td class="py-3 px-3.5 text-center text-[11px] font-mono text-[#132628]" x-text="r.completed_at || '-'"></td>
                                </tr>
                            </template>

                            <!-- Empty Search Result -->
                            <tr x-show="filteredRecords.length === 0">
                                <td colspan="11" class="py-10 text-center text-[#4a6366]">
                                    <div class="text-3xl mb-2">🔍</div>
                                    <div class="text-sm font-semibold text-[#132628]">Tidak ada sesi pengisian yang sesuai filter</div>
                                    <p class="text-xs text-[#4a6366] mt-1">Coba sesuaikan kata kunci pencarian atau ubah rentang tanggal.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
