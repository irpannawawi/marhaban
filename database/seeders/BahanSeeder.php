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
        Bahan::insert([
            [
                'nama_bahan' => 'Tepung',
                'stok_bahan' => '100',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Gula',
                'stok_bahan' => '50',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Telur',
                'stok_bahan' => '300',
                'satuan_bahan' => 'butir',
            ],
            [
                'nama_bahan' => 'Mentega',
                'stok_bahan' => '40',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Coklat',
                'stok_bahan' => '25',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Susu',
                'stok_bahan' => '60',
                'satuan_bahan' => 'liter',
            ],
            [
                'nama_bahan' => 'Baking Soda',
                'stok_bahan' => '10',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Vanili',
                'stok_bahan' => '5',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Stroberi',
                'stok_bahan' => '20',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Keju',
                'stok_bahan' => '30',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Garam',
                'stok_bahan' => '15',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Baking Powder',
                'stok_bahan' => '8',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Kacang Almond',
                'stok_bahan' => '12',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Madu',
                'stok_bahan' => '18',
                'satuan_bahan' => 'liter',
            ],
            [
                'nama_bahan' => 'Ragi',
                'stok_bahan' => '7',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Bubuk Kayu Manis',
                'stok_bahan' => '6',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Krim Kental',
                'stok_bahan' => '25',
                'satuan_bahan' => 'liter',
            ],
            [
                'nama_bahan' => 'Blueberry',
                'stok_bahan' => '22',
                'satuan_bahan' => 'kg',
            ],
            [
                'nama_bahan' => 'Minyak Kelapa',
                'stok_bahan' => '35',
                'satuan_bahan' => 'liter',
            ],
            [
                'nama_bahan' => 'Pewarna Makanan',
                'stok_bahan' => '3',
                'satuan_bahan' => 'liter',
            ],
        ]);
    }
}
