<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::insert([
            [
                'nama' => 'Ahmad Fadli',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merpati No. 123, Bandung'
            ],
            [
                'nama' => 'Siti Rahma',
                'no_hp' => '082233445566',
                'alamat' => 'Jl. Kenanga No. 45, Surabaya'
            ]
        ]);

        
    }
}
