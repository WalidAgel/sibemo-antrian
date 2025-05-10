<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        Kendaraan::create([
            'pelanggan_id' => 2, // Pastikan ID pelanggan ini ada
            'nomor_polisi' => 'B 1234 ABC',
            'merek' => 'Toyota',
            'tipe' => 'Avanza',
            'tahun' => 2020,
        ]);
    }
}
