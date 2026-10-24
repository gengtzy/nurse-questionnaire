<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scaleLabels = [
            0 => 'Tidak Pernah',
            1 => 'Hampir Tidak Pernah',
            2 => 'Jarang',
            3 => 'Kadang-kadang',
            4 => 'Sering',
            5 => 'Hampir Selalu',
            6 => 'Selalu',
        ];

        $questions = [
            // Dimensi 1: Kelelahan Emosional (Emotional Exhaustion - EE) -> Item 1 - 9
            [
                'number' => 1,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasakan emosi saya terkuras karena pekerjaan',
                'is_reversed' => false,
                'order' => 1,
            ],
            [
                'number' => 2,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa sangat lelah di akhir jam kerja (dinas)',
                'is_reversed' => false,
                'order' => 2,
            ],
            [
                'number' => 3,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa lelah saat bangun pagi karena membayangkan beratnya menjalani pekerjaan (banyaknya tugas yang harus dikerjakan sesuai dengan kompetensi)',
                'is_reversed' => false,
                'order' => 3,
            ],
            [
                'number' => 4,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa orang-orang yang bekerja di rumah sakit menyusahkan saya',
                'is_reversed' => false,
                'order' => 4,
            ],
            [
                'number' => 5,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa frustasi dengan pekerjaan sebagai perawat',
                'is_reversed' => false,
                'order' => 5,
            ],
            [
                'number' => 6,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa lelah dengan pekerjaan saya',
                'is_reversed' => false,
                'order' => 6,
            ],
            [
                'number' => 7,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa sudah bekerja terlalu keras sebagai perawat',
                'is_reversed' => false,
                'order' => 7,
            ],
            [
                'number' => 8,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa orang-orang yang bekerja di rumah sakit menyusahkan dengan terlalu banyak tekanan pada saya',
                'is_reversed' => false,
                'order' => 8,
            ],
            [
                'number' => 9,
                'dimension' => 'EE',
                'dimension_name' => 'Kelelahan Emosional',
                'question_text' => 'Saya merasa sudah di ujung tanduk saat tugas yang saya rasakan sudah sangat berat',
                'is_reversed' => false,
                'order' => 9,
            ],

            // Dimensi 2: Depersonalisasi (Depersonalization - DP) -> Item 10 - 14
            [
                'number' => 10,
                'dimension' => 'DP',
                'dimension_name' => 'Depersonalisasi',
                'question_text' => 'Saya merasa saya memperlakukan pasien sebagai objek yang tidak perlu dipahami secara personal (yang penting saya bisa mendapatkan kompentensi)',
                'is_reversed' => false,
                'order' => 10,
            ],
            [
                'number' => 11,
                'dimension' => 'DP',
                'dimension_name' => 'Depersonalisasi',
                'question_text' => 'Sejak saya menjadi perawat, saya tidak banyak melibatkan perasaan',
                'is_reversed' => false,
                'order' => 11,
            ],
            [
                'number' => 12,
                'dimension' => 'DP',
                'dimension_name' => 'Depersonalisasi',
                'question_text' => 'Saya khawatir pekerjaan ini akan membuat saya sulit secara emosional.',
                'is_reversed' => false,
                'order' => 12,
            ],
            [
                'number' => 13,
                'dimension' => 'DP',
                'dimension_name' => 'Depersonalisasi',
                'question_text' => 'Saya tidak terlalu peduli dengan klien, (yang penting menjalankan tugas saja)',
                'is_reversed' => false,
                'order' => 13,
            ],
            [
                'number' => 14,
                'dimension' => 'DP',
                'dimension_name' => 'Depersonalisasi',
                'question_text' => 'Saya merasa pasien menyalahkan saya seperti pasien berbohong atas keluhannya (pasien yang suka cari perhatian)',
                'is_reversed' => false,
                'order' => 14,
            ],

            // Dimensi 3: Rendahnya Prestasi Pribadi (Personal Accomplishment - PA, reverse scoring) -> Item 15 - 22
            [
                'number' => 15,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya dengan mudah memahami perasaan pasien',
                'is_reversed' => true,
                'order' => 15,
            ],
            [
                'number' => 16,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya dapat menyelesaikan masalah pasien secara efektif',
                'is_reversed' => true,
                'order' => 16,
            ],
            [
                'number' => 17,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya merasa dapat membawa pengaruh positif pada kehidupan orang lain melalui profesi sebagai perawat',
                'is_reversed' => true,
                'order' => 17,
            ],
            [
                'number' => 18,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya merasa sangat energik saat melaksanakan praktik profesi',
                'is_reversed' => true,
                'order' => 18,
            ],
            [
                'number' => 19,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya dapat dengan mudah menciptakan suasana santai',
                'is_reversed' => true,
                'order' => 19,
            ],
            [
                'number' => 20,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya merasa senang bekerja sebagai perawat',
                'is_reversed' => true,
                'order' => 20,
            ],
            [
                'number' => 21,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya merasa telah menyelesaikan tugas sesuai tujuan (SOP)',
                'is_reversed' => true,
                'order' => 21,
            ],
            [
                'number' => 22,
                'dimension' => 'PA',
                'dimension_name' => 'Pencapaian Pribadi',
                'question_text' => 'Saya merasa sangat tenang dalam menangani masalah emosional (sebagai perawat)',
                'is_reversed' => true,
                'order' => 22,
            ],
        ];

        foreach ($questions as $q) {
            Question::updateOrCreate(
                ['number' => $q['number']],
                [
                    'dimension' => $q['dimension'],
                    'dimension_name' => $q['dimension_name'],
                    'question_text' => $q['question_text'],
                    'is_reversed' => $q['is_reversed'],
                    'scale_min' => 0,
                    'scale_max' => 6,
                    'scale_labels' => $scaleLabels,
                    'order' => $q['order'],
                ]
            );
        }
    }
}
