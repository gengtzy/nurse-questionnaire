<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--[if gte mso 9]>
    @verbatim
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Rekap Burnout MBI</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    @endverbatim
    <![endif]-->
    <style>
        body { font-family: Calibri, Arial, sans-serif; font-size: 11pt; color: #132628; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #d2dedc; padding: 6px 10px; font-size: 10pt; vertical-align: middle; }
        
        .title-main { font-size: 15pt; font-weight: bold; color: #0b6b63; border: none; text-align: left; }
        .title-sub { font-size: 12pt; font-weight: bold; color: #132628; border: none; text-align: left; }
        .title-meta { font-size: 9pt; color: #555555; border: none; text-align: left; font-style: italic; }
        
        /* Group Super Headers */
        .group-identity { background-color: #132628; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-pre { background-color: #0b6b63; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-intervention { background-color: #1a5650; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-game { background-color: #e8501a; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-post { background-color: #0b6b63; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-delta { background-color: #2f7d52; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        .group-meta { background-color: #4a6366; color: #ffffff; font-weight: bold; text-align: center; font-size: 10pt; }
        
        /* Sub Headers */
        .sub-header { background-color: #f1f5f4; color: #132628; font-weight: bold; text-align: center; font-size: 9pt; }
        
        /* Data Rows */
        .row-even { background-color: #ffffff; }
        .row-odd { background-color: #f9fbfa; }
        
        /* Formats */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        
        .num-int { mso-number-format: "0"; text-align: right; }
        .num-dec { mso-number-format: "0\.00"; text-align: right; }
        
        /* Status Badges */
        .badge-complete { background-color: #dff0e5; color: #2f7d52; font-weight: bold; text-align: center; }
        .badge-pre-only { background-color: #f7ebd2; color: #a8680f; font-weight: bold; text-align: center; }
        .badge-empty { background-color: #f1f5f4; color: #718096; text-align: center; }
        
        /* Delta Styles */
        .delta-improved { background-color: #dff0e5; color: #2f7d52; font-weight: bold; mso-number-format: "0\.00"; text-align: right; }
        .delta-worsened { background-color: #f8e1dd; color: #b03a2e; font-weight: bold; mso-number-format: "0\.00"; text-align: right; }
        .delta-stable { background-color: #f7ebd2; color: #a8680f; font-weight: bold; mso-number-format: "0\.00"; text-align: right; }
        
        /* Summary Row */
        .summary-row { background-color: #e2eeec; font-weight: bold; border-top: 2px solid #0b6b63; border-bottom: 2px solid #0b6b63; }
    </style>
</head>
<body>
    <table>
        <!-- Hospital Title Block -->
        <tr>
            <td colspan="34" class="title-main">RSUD WELAS ASIH · RUANG UMAR BIN KHATTAB 2</td>
        </tr>
        <tr>
            <td colspan="34" class="title-sub">REKAPITULASI MONITORING BURNOUT PERAWAT &amp; AKTIVITAS RELAKSASI INTERVENSI</td>
        </tr>
        <tr>
            <td colspan="34" class="title-meta">
                <strong>Periode Laporan:</strong> {{ $periodLabel }} &nbsp;|&nbsp; 
                <strong>Waktu Unduh:</strong> {{ $exportDate }} &nbsp;|&nbsp; 
                <strong>Kepala Ruangan:</strong> Oom Umriah,S.Kep.,Ners
            </td>
        </tr>
        <tr>
            <td colspan="34" style="border:none; height: 12px;"></td>
        </tr>

        <!-- Group Super-Headers -->
        <thead>
            <tr>
                <th colspan="5" class="group-identity">1. IDENTITAS &amp; SESI PENGISIAN</th>
                <th colspan="6" class="group-pre">2. EVALUASI PRE-TEST (SEBELUM)</th>
                <th colspan="6" class="group-intervention">3. INTERVENSI RELAKSASI (EFT / BUTTERFLY HUG / KONSELING)</th>
                <th colspan="5" class="group-game">4. AKTIVITAS MINI GAME KATARSIS</th>
                <th colspan="6" class="group-post">5. EVALUASI POST-TEST (SESUDAH)</th>
                <th colspan="5" class="group-delta">6. KOMPARASI (&Delta;)</th>
                <th class="group-meta">WAKTU</th>
            </tr>

            <!-- Specific Column Sub-Headers -->
            <tr>
                <th class="sub-header" style="width: 40px;">No</th>
                <th class="sub-header" style="width: 220px;">Nama Perawat</th>
                <th class="sub-header" style="width: 140px;">Jabatan / Role</th>
                <th class="sub-header" style="width: 140px;">Sesi Pengisian</th>
                <th class="sub-header" style="width: 130px;">Status</th>

                <!-- Pre-test -->
                <th class="sub-header" style="width: 75px;">Skor (/132)</th>
                <th class="sub-header" style="width: 85px;">Persen (%)</th>
                <th class="sub-header" style="width: 80px;">Kategori</th>
                <th class="sub-header" style="width: 65px;">EE (/54)</th>
                <th class="sub-header" style="width: 65px;">DP (/30)</th>
                <th class="sub-header" style="width: 65px;">PA (/48)</th>

                <!-- Intervention -->
                <th class="sub-header" style="width: 120px;">Jenis Intervensi</th>
                <th class="sub-header" style="width: 75px;">Tegang Awal</th>
                <th class="sub-header" style="width: 75px;">Tegang Akhir</th>
                <th class="sub-header" style="width: 75px;">&Delta; Tegang</th>
                <th class="sub-header" style="width: 75px;">Durasi (s)</th>
                <th class="sub-header" style="width: 75px;">Tepukan</th>

                <!-- Game -->
                <th class="sub-header" style="width: 75px;">Durasi (s)</th>
                <th class="sub-header" style="width: 80px;">Skor Game</th>
                <th class="sub-header" style="width: 75px;">Beban</th>
                <th class="sub-header" style="width: 65px;">Combo</th>
                <th class="sub-header" style="width: 80px;">Si Burnout</th>

                <!-- Post-test -->
                <th class="sub-header" style="width: 75px;">Skor (/132)</th>
                <th class="sub-header" style="width: 85px;">Persen (%)</th>
                <th class="sub-header" style="width: 80px;">Kategori</th>
                <th class="sub-header" style="width: 65px;">EE (/54)</th>
                <th class="sub-header" style="width: 65px;">DP (/30)</th>
                <th class="sub-header" style="width: 65px;">PA (/48)</th>

                <!-- Delta -->
                <th class="sub-header" style="width: 75px;">&Delta; Skor</th>
                <th class="sub-header" style="width: 85px;">&Delta; Persen (%)</th>
                <th class="sub-header" style="width: 65px;">&Delta; EE</th>
                <th class="sub-header" style="width: 65px;">&Delta; DP</th>
                <th class="sub-header" style="width: 65px;">&Delta; PA</th>

                <!-- Timestamp -->
                <th class="sub-header" style="width: 140px;">Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($records as $index => $r)
                @php
                    $rowClass = ($index % 2 === 0) ? 'row-even' : 'row-odd';
                    
                    // Status Badge Class
                    $statusClass = 'badge-empty';
                    if ($r['is_complete']) {
                        $statusClass = 'badge-complete';
                    } elseif ($r['has_pre']) {
                        $statusClass = 'badge-pre-only';
                    }

                    // Delta Formatting
                    $deltaClass = 'text-center';
                    if (isset($r['diff_total'])) {
                        if ($r['diff_total'] > 0) {
                            $deltaClass = 'delta-improved';
                        } elseif ($r['diff_total'] < 0) {
                            $deltaClass = 'delta-worsened';
                        } else {
                            $deltaClass = 'delta-stable';
                        }
                    }

                    $typeLabel = match($r['intervention_type'] ?? '') {
                        'eft' => 'Relaksasi EFT',
                        'counseling_alert' => 'Konseling Psikoterapi',
                        'butterfly_hug' => 'Butterfly Hug',
                        default => ($r['has_intervention'] ? 'Butterfly Hug' : '-')
                    };
                @endphp
                <tr class="{{ $rowClass }}">
                    <!-- Identitas -->
                    <td class="text-center num-int">{{ $no++ }}</td>
                    <td style="font-weight: bold;">{{ $r['name'] }}</td>
                    <td>{{ $r['role'] }}</td>
                    <td class="text-center" style="font-weight: 600;">{{ $r['session_label'] }}</td>
                    <td class="{{ $statusClass }}">{{ $r['status_label'] }}</td>

                    <!-- Pre-Test -->
                    <td class="num-int">{{ $r['pre_total'] ?? '' }}</td>
                    <td class="num-dec">{{ $r['pre_percentage'] ?? '' }}</td>
                    <td class="text-center">{{ $r['pre_category'] ?? '-' }}</td>
                    <td class="num-int">{{ $r['pre_ee'] ?? '' }}</td>
                    <td class="num-int">{{ $r['pre_dp'] ?? '' }}</td>
                    <td class="num-int">{{ $r['pre_pa'] ?? '' }}</td>

                    <!-- Intervention -->
                    <td class="text-center" style="font-weight: 600;">{{ $typeLabel }}</td>
                    <td class="num-int">{{ $r['intervention_before'] ?? '' }}</td>
                    <td class="num-int">{{ $r['intervention_after'] ?? '' }}</td>
                    <td class="num-int {{ isset($r['intervention_diff']) && $r['intervention_diff'] > 0 ? 'delta-improved' : '' }}">{{ $r['intervention_diff'] ?? '' }}</td>
                    <td class="num-int">{{ $r['intervention_duration'] ?? '' }}</td>
                    <td class="num-int">{{ $r['intervention_taps'] ?? '' }}</td>

                    <!-- Game -->
                    <td class="num-int">{{ $r['game_duration'] ?? '' }}</td>
                    <td class="num-int">{{ $r['game_score'] ?? '' }}</td>
                    <td class="num-int">{{ $r['game_smashed'] ?? '' }}</td>
                    <td class="text-center">{{ isset($r['game_combo']) ? 'x'.$r['game_combo'] : '' }}</td>
                    <td class="text-center">{{ isset($r['game_boss']) ? ($r['game_boss'] ? 'Kalah 💥' : 'Selesai') : '-' }}</td>

                    <!-- Post-Test -->
                    <td class="num-int">{{ $r['post_total'] ?? '' }}</td>
                    <td class="num-dec">{{ $r['post_percentage'] ?? '' }}</td>
                    <td class="text-center">{{ $r['post_category'] ?? '-' }}</td>
                    <td class="num-int">{{ $r['post_ee'] ?? '' }}</td>
                    <td class="num-int">{{ $r['post_dp'] ?? '' }}</td>
                    <td class="num-int">{{ $r['post_pa'] ?? '' }}</td>

                    <!-- Delta (Komparasi) -->
                    <td class="{{ $deltaClass }} num-int">{{ $r['diff_total'] ?? '' }}</td>
                    <td class="{{ $deltaClass }} num-dec">{{ $r['diff_percentage'] ?? '' }}</td>
                    <td class="{{ $deltaClass }} num-int">{{ $r['diff_ee'] ?? '' }}</td>
                    <td class="{{ $deltaClass }} num-int">{{ $r['diff_dp'] ?? '' }}</td>
                    <td class="{{ $deltaClass }} num-int">{{ $r['diff_pa'] ?? '' }}</td>

                    <!-- Selesai -->
                    <td class="text-center" style="font-size: 9pt;">{{ $r['completed_at'] ?? '-' }}</td>
                </tr>
            @endforeach

            <!-- Rata-Rata Row (Formula Ready for Excel) -->
            @php
                $startRow = 7;
                $endRow = 6 + count($records);
            @endphp
            <tr class="summary-row">
                <td colspan="5" class="text-center" style="font-weight: bold; font-size: 10pt;">RATA-RATA (MEAN)</td>
                
                <!-- Pre Mean -->
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(F{{ $startRow }}:F{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(G{{ $startRow }}:G{{ $endRow }})</td>
                <td class="text-center">-</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(I{{ $startRow }}:I{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(J{{ $startRow }}:J{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(K{{ $startRow }}:K{{ $endRow }})</td>

                <!-- Intervention Mean -->
                <td class="text-center">-</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(M{{ $startRow }}:M{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(N{{ $startRow }}:N{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold; background-color: #dff0e5; color: #2f7d52;">=AVERAGE(O{{ $startRow }}:O{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(P{{ $startRow }}:P{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(Q{{ $startRow }}:Q{{ $endRow }})</td>

                <!-- Game Mean -->
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(R{{ $startRow }}:R{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(S{{ $startRow }}:S{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(T{{ $startRow }}:T{{ $endRow }})</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>

                <!-- Post Mean -->
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(W{{ $startRow }}:W{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(X{{ $startRow }}:X{{ $endRow }})</td>
                <td class="text-center">-</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(Z{{ $startRow }}:Z{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AA{{ $startRow }}:AA{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AB{{ $startRow }}:AB{{ $endRow }})</td>

                <!-- Delta Mean -->
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AC{{ $startRow }}:AC{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold; background-color: #dff0e5; color: #2f7d52;">=AVERAGE(AD{{ $startRow }}:AD{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AE{{ $startRow }}:AE{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AF{{ $startRow }}:AF{{ $endRow }})</td>
                <td class="num-dec" style="font-weight: bold;">=AVERAGE(AG{{ $startRow }}:AG{{ $endRow }})</td>
                <td class="text-center" style="font-size: 8pt; color: #555;">Formula Excel Aktif</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
