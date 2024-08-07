<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::truncate();
        $produk = [
            [
                "nama" => "Brownies",
                "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 3 butir, Mentega: 100g, Coklat: 100g",
                "stok" => 3,
                "satuan" => "loyang",
                "harga" => 70000
            ],
            [
                "nama" => "Bolu Kukus Biasa",
                "deskripsi" => "250 gram tepung terigu, 200 gram gula pasir, 3 butir telur, 1 sendok teh emulsifier (SP/TBM), 1 sendok teh vanili, Pewarna makanan",
                "stok" => 4,
                "satuan" => "loyang",
                "harga" => 40000
            ],
            [
                "nama" => "Bolu Kijing",
                "deskripsi" => "200 gram tepung terigu, 200 gram gula pasir, 6 butir telur, 200 gram mentega (cairkan), 1 sendok teh vanili, 1 sendok teh baking powder",
                "stok" => 30,
                "satuan" => "Pcs",
                "harga" => 500
            ]
        ];
        Produk::insert($produk);
    }
}
