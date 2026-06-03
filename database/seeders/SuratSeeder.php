<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member; // <-- Memanggil model Member
use App\Models\Surat; // <-- Memanggil model SuratKepulangan

class SuratSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil sampel anggota (member) pertama dari database
        $anggota1 = Member::first();

        // 2. Jika anggotanya ada, buatkan data surat kepulangannya
        if ($anggota1) {
            Surat::create([
                'nomor_surat' => '001/SKA/2026',
                'tanggal_mulai_pulang' => '2026-05-20',
                'tanggal_kembali' => '2026-05-25',
                'alasan_pulang' => 'Acara pernikahan kakak kandung',
                'member_id' => $anggota1->id
            ]);

            Surat::create([
                'nomor_surat' => '002/SKA/2026',
                'tanggal_mulai_pulang' => '2026-06-01',
                'tanggal_kembali' => '2026-06-05',
                'alasan_pulang' => 'Sakit dan ingin berobat di kampung halaman',
                'member_id' => $anggota1->id
            ]);
        }
    }
}
