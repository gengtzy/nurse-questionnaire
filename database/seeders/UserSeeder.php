<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nursePassword = Hash::make('perawat123');
        $karuPassword = Hash::make('karu123');

        // 1. Kepala Ruangan (Admin Monitoring - At Top of Dropdown)
        User::updateOrCreate(
            ['name' => 'Oom Umriah,S.Kep.,Ners'],
            [
                'role' => 'Kepala Ruangan',
                'room' => 'Ruang Umar Bin Khattab 2',
                'password' => $karuPassword,
            ]
        );

        // 2. Data Perawat Asli Ruang Umar Bin Khattab 2 (24 Perawat)
        $nurses = [
            ['name' => 'Erni Gumilar,S.Kep.,Ners', 'role' => 'Kepala Tim 1'],
            ['name' => 'Wendi Sunjana, S.Kep.,Ners', 'role' => 'Kepala Tim 2'],
            ['name' => 'Ira Gusyanda, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Yunia Mariska, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Elis Sari Ningrum, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Arif Maulana Yusuf, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Rully Nasrulloh S, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Desi Amalia, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Taufik Alamsyah, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Asdini Purwantie, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Tati Rohanah, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Desi N Krisnandi, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Adika Sarsaparila N, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Sri Dewi Yanti, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Ahmad Sutrisna, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Fildza Nur Amalia, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Bayu Musthofa, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Moh. Arif Kusdian, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Rima Rahmawati, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Rochman Akbar S, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Gina Nurahayu, S.Kep.,Ners', 'role' => 'Perawat'],
            ['name' => 'Adinda Fitri, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Dede Yogi Iskandar, A.Md.Kep', 'role' => 'Perawat'],
            ['name' => 'Yally Mahmud Najib, A.Md.Kep', 'role' => 'Perawat'],
        ];

        foreach ($nurses as $nurse) {
            User::updateOrCreate(
                ['name' => $nurse['name']],
                [
                    'role' => $nurse['role'],
                    'room' => 'Ruang Umar Bin Khattab 2',
                    'password' => $nursePassword,
                ]
            );
        }

        // 3. User Test (Khusus Pengujian Pengiriman Email Asli)
        // User::updateOrCreate(
        //     ['name' => 'Testuserperawat'],
        //     [
        //         'role' => 'Perawat',
        //         'email' => 'agengpujipangestu3@gmail.com',
        //         'room' => 'Ruang Umar Bin Khattab 2',
        //         'password' => $nursePassword,
        //     ]
        // );
    }
}
