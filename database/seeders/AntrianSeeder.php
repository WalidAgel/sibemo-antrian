<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Antrian;
use App\Models\Kendaraan;

class AntrianSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil salah satu kendaraan dari database
        $kendaraan = Kendaraan::first();

        if (!$kendaraan) {
            $this->command->warn('Tidak ada kendaraan ditemukan. Jalankan KendaraanSeeder terlebih dahulu.');
            return;
        }

        Antrian::insert([
            [
                'kendaraan_id' => $kendaraan->id,
                'tanggal' => now()->format('Y-m-d'),
                'waktu' => '09:00',
                'keluhan' => 'Ganti oli dan cek rem',
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kendaraan_id' => $kendaraan->id,
                'tanggal' => now()->addDay()->format('Y-m-d'),
                'waktu' => '10:30',
                'keluhan' => 'Servis rutin',
                'status' => 'proses',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
