<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Evaluasi Burnout & Relaksasi Perawat</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f1f5f4; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #132628; -webkit-text-size-adjust: 100%; }
        table { border-collapse: collapse; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f1f5f4; padding: 30px 0; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-radius: 16px; border: 1px solid #d2dedc; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.04); }
        .header { background: linear-gradient(135deg, #0b6b63 0%, #08524c 100%); padding: 30px 32px; text-align: left; color: #ffffff; }
        .content { padding: 32px; }
        .footer { padding: 24px 32px; text-align: center; font-size: 11px; color: #718096; background-color: #f9fbfa; border-top: 1px solid #e2e8f0; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 9999px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-header { background-color: rgba(255,255,255,0.2); color: #ffffff; }
        .badge-green { background-color: #dff0e5; color: #2f7d52; }
        .badge-amber { background-color: #f7ebd2; color: #a8680f; }
        .badge-red { background-color: #f8e1dd; color: #b03a2e; }
        .metric-card { background-color: #f9fbfa; border: 1px solid #d2dedc; border-radius: 12px; padding: 16px; text-align: center; }
        .data-table th { background-color: #f1f5f4; color: #4a6366; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 10px 12px; text-align: left; border-bottom: 2px solid #d2dedc; }
        .data-table td { padding: 12px; font-size: 13px; border-bottom: 1px solid #edf2f7; }
        .game-card { background-color: #fde3d6; border: 1px solid #f8c4b0; border-radius: 12px; padding: 16px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table class="main" role="presentation" width="100%" cellpadding="0" cellspacing="0">
                        <!-- Header -->
                        <tr>
                            <td class="header">
                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <span class="badge badge-header">Ruang Umar Bin Khattab 2 · RSUD Welas Asih</span>
                                            <h1 style="margin: 10px 0 4px; font-size: 22px; font-weight: 700; line-height: 1.2;">Nurse Recharge</h1>
                                            <p style="margin: 0; font-size: 13px; opacity: 0.9;">Laporan Resmi Rekapitulasi Evaluasi Burnout & Relaksasi Perawat</p>
                                        </td>
                                        <td style="width: 60px; text-align: right; vertical-align: middle;">
                                            <img src="{{ isset($message) ? $message->embed(public_path('images/logo_welas_asih.png')) : asset('images/logo_welas_asih.png') }}" alt="Logo RSUD Welas Asih" width="56" height="56" style="display: block; border-radius: 8px; margin-left: auto;">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Body Content -->
                        <tr>
                            <td class="content">
                                <p style="font-size: 14px; margin-top: 0; margin-bottom: 20px; line-height: 1.5;">
                                    Halo, <strong>{{ $user->name }}</strong>. Berikut adalah salinan rekapitulasi lengkap hasil evaluasi awal (pre-test), sesi mini game katarsis, dan evaluasi akhir (post-test) yang telah Anda selesaikan.
                                </p>

                                <!-- Identitas Perawat -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px; background-color: #f9fbfa; border: 1px solid #d2dedc; border-radius: 12px; padding: 14px 18px;">
                                    <tr>
                                        <td style="font-size: 12px; color: #4a6366; width: 30%; padding: 4px 0;">Nama Perawat</td>
                                        <td style="font-size: 13px; font-weight: 600; color: #132628; padding: 4px 0;">: {{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px; color: #4a6366; padding: 4px 0;">Nomor Pegawai (NIP)</td>
                                        <td style="font-size: 13px; font-weight: 600; color: #132628; padding: 4px 0;">: {{ $user->nip ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px; color: #4a6366; padding: 4px 0;">Jabatan / Ruangan</td>
                                        <td style="font-size: 13px; font-weight: 600; color: #132628; padding: 4px 0;">: {{ $user->role }} · {{ $user->room }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px; color: #4a6366; padding: 4px 0;">Waktu Penyelesaian</td>
                                        <td style="font-size: 13px; font-weight: 600; color: #132628; padding: 4px 0;">: {{ $postTest->completed_at ? $postTest->completed_at->format('d M Y H:i:s') : now()->format('d M Y H:i:s') }} WIB</td>
                                    </tr>
                                </table>

                                <!-- Ringkasan Skor Utama (Pre vs Post) -->
                                <h3 style="font-size: 15px; font-weight: 700; margin: 0 0 12px; color: #132628;">1. Ringkasan Perubahan Skor Burnout:</h3>
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                                    <tr>
                                        <td width="32%" valign="top">
                                            <div class="metric-card">
                                                <span style="font-size: 10px; text-transform: uppercase; color: #4a6366; display: block; margin-bottom: 4px;">Skor Pre-Test</span>
                                                <strong style="font-size: 24px; color: #132628; display: block;">{{ $preTest ? number_format($preTest->percentage, 1) : '-' }}%</strong>
                                                <span class="badge {{ ($preTest?->category === 'Rendah') ? 'badge-green' : (($preTest?->category === 'Sedang') ? 'badge-amber' : 'badge-red') }}" style="margin-top: 6px;">
                                                    {{ $preTest?->category ?? '-' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td width="4%"></td>
                                        <td width="32%" valign="top">
                                            <div class="metric-card" style="background-color: #dbeeeb; border-color: #b2ded8;">
                                                <span style="font-size: 10px; text-transform: uppercase; color: #0b6b63; font-weight: bold; display: block; margin-bottom: 4px;">Skor Post-Test</span>
                                                <strong style="font-size: 24px; color: #0b6b63; display: block;">{{ number_format($postTest->percentage, 1) }}%</strong>
                                                <span class="badge {{ ($postTest->category === 'Rendah') ? 'badge-green' : (($postTest->category === 'Sedang') ? 'badge-amber' : 'badge-red') }}" style="margin-top: 6px;">
                                                    {{ $postTest->category }}
                                                </span>
                                            </div>
                                        </td>
                                        <td width="4%"></td>
                                        <td width="28%" valign="top">
                                            <div class="metric-card">
                                                <span style="font-size: 10px; text-transform: uppercase; color: #4a6366; display: block; margin-bottom: 4px;">Selisih (Delta)</span>
                                                <strong style="font-size: 20px; color: {{ $diffPercentage <= 0 ? '#2f7d52' : '#b03a2e' }}; display: block;">
                                                    {{ $diffPercentage > 0 ? '+'.$diffPercentage : $diffPercentage }}%
                                                </strong>
                                                <span style="font-size: 10px; color: {{ $diffPercentage <= 0 ? '#2f7d52' : '#b03a2e' }}; font-weight: bold; display: block; margin-top: 6px;">
                                                    {{ $diffPercentage < 0 ? 'Kondisi Membaik' : ($diffPercentage > 0 ? 'Skor Meningkat' : 'Skor Stabil') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Rincian Per Dimensi MBI -->
                                <h3 style="font-size: 15px; font-weight: 700; margin: 0 0 12px; color: #132628;">2. Rincian Per Dimensi Maslach Burnout Inventory:</h3>
                                <table class="data-table" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                                    <thead>
                                        <tr>
                                            <th>Dimensi Pengukuran</th>
                                            <th style="text-align: center;">Pre</th>
                                            <th style="text-align: center;">Post</th>
                                            <th style="text-align: center;">Perubahan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Kelelahan Emosional (EE)</strong>
                                                <span style="display: block; font-size: 11px; color: #718096;">Perasaan terkuras karena pekerjaan (Maks 54)</span>
                                            </td>
                                            <td style="text-align: center; font-weight: 600;">{{ $preTest?->ee_score ?? 0 }}</td>
                                            <td style="text-align: center; font-weight: 600; color: #0b6b63;">{{ $postTest->ee_score }}</td>
                                            <td style="text-align: center; font-weight: bold; color: {{ $diffEE <= 0 ? '#2f7d52' : '#b03a2e' }};">
                                                {{ $diffEE > 0 ? '+'.$diffEE : $diffEE }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Depersonalisasi (DP)</strong>
                                                <span style="display: block; font-size: 11px; color: #718096;">Sikap menjaga jarak dari pasien/rekan (Maks 30)</span>
                                            </td>
                                            <td style="text-align: center; font-weight: 600;">{{ $preTest?->dp_score ?? 0 }}</td>
                                            <td style="text-align: center; font-weight: 600; color: #0b6b63;">{{ $postTest->dp_score }}</td>
                                            <td style="text-align: center; font-weight: bold; color: {{ $diffDP <= 0 ? '#2f7d52' : '#b03a2e' }};">
                                                {{ $diffDP > 0 ? '+'.$diffDP : $diffDP }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Penurunan Prestasi Diri (PA)</strong>
                                                <span style="display: block; font-size: 11px; color: #718096;">Perasaan kurang berprestasi / efektif (Maks 48)</span>
                                            </td>
                                            <td style="text-align: center; font-weight: 600;">{{ $preTest?->pa_score ?? 0 }}</td>
                                            <td style="text-align: center; font-weight: 600; color: #0b6b63;">{{ $postTest->pa_score }}</td>
                                            <td style="text-align: center; font-weight: bold; color: {{ $diffPA <= 0 ? '#2f7d52' : '#b03a2e' }};">
                                                {{ $diffPA > 0 ? '+'.$diffPA : $diffPA }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Sesi Mini Game -->
                                @if ($gameLog)
                                    <div class="game-card">
                                        <h4 style="margin: 0 0 6px; font-size: 14px; color: #e8501a;">🎮 Sesi Mini Game "Hancurkan Stres":</h4>
                                        <p style="margin: 0; font-size: 12px; color: #4a6366; line-height: 1.5;">
                                            Durasi Main: <strong>{{ $gameLog->duration_seconds }} Detik</strong> &bull;
                                            Skor: <strong>{{ $gameLog->score }} Poin</strong> &bull;
                                            Beban Dihancurkan: <strong>{{ $gameLog->items_smashed }} Beban</strong> &bull;
                                            Kombo Maksimal: <strong>x{{ $gameLog->max_combo }}</strong> &bull;
                                            Si Burnout: <strong>{{ $gameLog->boss_defeated ? 'Terkalahkan 💥' : 'Selesai' }}</strong>
                                        </p>
                                    </div>
                                @endif

                                <!-- Rekomendasi Klinis Singkat -->
                                <div style="background-color: #f9fbfa; border-left: 4px solid #0b6b63; padding: 14px 18px; border-radius: 4px; margin-top: 20px;">
                                    <strong style="font-size: 13px; color: #132628; display: block; margin-bottom: 4px;">Catatan & Rekomendasi Ruangan:</strong>
                                    <p style="font-size: 12px; color: #4a6366; margin: 0; line-height: 1.5;">
                                        @if ($postTest->category === 'Rendah')
                                            Kondisi emosional dan energi Anda berada dalam rentang baik. Terus pertahankan pola istirahat teratur dan manfaatkan jeda latihan napas singkat di sela dinas.
                                        @elseif ($postTest->category === 'Sedang')
                                            Terdapat tanda keletihan yang perlu terus dimonitor. Sempatkan jeda sejenak bersama rekan shift Anda dan sampaikan kendala beban kerja kepada Katim bila diperlukan.
                                        @else
                                            Tingkat keletihan dinas tergolong tinggi. Sangat dianjurkan untuk berkonsultasi secara tertutup dengan Karu mengenai penyesuaian jadwal dinas sementara.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td class="footer">
                                <p style="margin: 0 0 6px;">Email ini dikirim secara otomatis oleh sistem <strong>Nurse Recharge</strong>.</p>
                                <p style="margin: 0; color: #a0aec0;">Ruang Umar Bin Khattab 2 · RSUD Welas Asih &bull; Kerahasiaan Data Terjamin</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
