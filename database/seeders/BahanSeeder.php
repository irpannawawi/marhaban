<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bahan::truncate();
        Bahan::insert([
            [
                'nama_bahan' => 'Tepung Terigu',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Telur',
                'stok_bahan' => '10',
                'satuan_bahan' => 'butir',
            ],
            [
                'nama_bahan' => 'Mentega',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Coklat',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Baking Soda',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Vanili',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Garam',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Baking Powder',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Pewarna Makanan',
                'stok_bahan' => '10',
                'satuan_bahan' => 'liter',
            ],
        ]);
    }
}
