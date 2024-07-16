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
        $produk = [[
            "nama" => "Brownies",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 3 butir, Mentega: 100g, Coklat: 100g",
            "stok" => 50,
            "satuan" => "loyang",
            "harga" => 50000
        ],
        [
            "nama" => "Cheesecake",
            "deskripsi" => "Tepung: 100g, Gula: 120g, Telur: 4 butir, Mentega: 100g, Keju: 250g, Krim Kental: 200ml",
            "stok" => 30,
            "satuan" => "loyang",
            "harga" => 70000
        ],
        [
            "nama" => "Red Velvet Cake",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 3 butir, Mentega: 100g, Pewarna Makanan: 1 sdt, Krim Keju: 150g",
            "stok" => 25,
            "satuan" => "loyang",
            "harga" => 75000
        ],
        [
            "nama" => "Cupcake Vanilla",
            "deskripsi" => "Tepung: 150g, Gula: 100g, Telur: 2 butir, Mentega: 100g, Susu: 50ml, Vanili: 1 sdt",
            "stok" => 100,
            "satuan" => "buah",
            "harga" => 15000
        ],
        [
            "nama" => "Tiramisu",
            "deskripsi" => "Tepung: 100g, Gula: 100g, Telur: 3 butir, Krim Kental: 200ml, Keju Mascarpone: 250g, Kopi: 50ml",
            "stok" => 15,
            "satuan" => "loyang",
            "harga" => 80000
        ],
        [
            "nama" => "Black Forest Cake",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 4 butir, Mentega: 100g, Coklat: 100g, Krim Kental: 200ml, Cherry: 50g",
            "stok" => 20,
            "satuan" => "loyang",
            "harga" => 85000
        ],
        [
            "nama" => "Apple Pie",
            "deskripsi" => "Tepung: 250g, Gula: 100g, Mentega: 100g, Apel: 3 buah, Kayu Manis: 1 sdt",
            "stok" => 40,
            "satuan" => "buah",
            "harga" => 30000
        ],
        [
            "nama" => "Muffin Blueberry",
            "deskripsi" => "Tepung: 150g, Gula: 100g, Telur: 2 butir, Mentega: 100g, Blueberry: 100g",
            "stok" => 60,
            "satuan" => "buah",
            "harga" => 20000
        ],
        [
            "nama" => "Banana Bread",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 2 butir, Mentega: 100g, Pisang: 3 buah",
            "stok" => 35,
            "satuan" => "buah",
            "harga" => 25000
        ],
        [
            "nama" => "Chiffon Cake",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 5 butir, Minyak Kelapa: 100ml, Jus Lemon: 2 sdm",
            "stok" => 45,
            "satuan" => "loyang",
            "harga" => 55000
        ],
        [
            "nama" => "Carrot Cake",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 3 butir, Minyak Kelapa: 100ml, Wortel: 200g, Krim Keju: 150g",
            "stok" => 28,
            "satuan" => "loyang",
            "harga" => 65000
        ],
        [
            "nama" => "Lemon Tart",
            "deskripsi" => "Tepung: 200g, Gula: 100g, Mentega: 100g, Telur: 2 butir, Jus Lemon: 50ml",
            "stok" => 22,
            "satuan" => "buah",
            "harga" => 40000
        ],
        [
            "nama" => "Chocolate Chip Cookie",
            "deskripsi" => "Tepung: 200g, Gula: 150g, Telur: 2 butir, Mentega: 100g, Coklat Chips: 100g",
            "stok" => 120,
            "satuan" => "buah",
            "harga" => 10000
        ],
        [
            "nama" => "Scone",
            "deskripsi" => "Tepung: 200g, Gula: 50g, Mentega: 100g, Susu: 100ml, Baking Powder: 1 sdt",
            "stok" => 55,
            "satuan" => "buah",
            "harga" => 15000
        ],
        [
            "nama" => "Pavlova",
            "deskripsi" => "Telur: 4 putih telur, Gula: 200g, Krim Kental: 200ml, Buah-buahan: 100g",
            "stok" => 18,
            "satuan" => "buah",
            "harga" => 60000
        ],
        [
            "nama" => "Eclair",
            "deskripsi" => "Tepung: 150g, Gula: 100g, Telur: 3 butir, Mentega: 100g, Krim Kental: 200ml, Coklat: 100g",
            "stok" => 25,
            "satuan" => "buah",
            "harga" => 18000
        ],
        [
            "nama" => "Macaron",
            "deskripsi" => "Tepung Almond: 200g, Gula: 200g, Putih Telur: 4 butir, Pewarna Makanan: 1 sdt, Krim Mentega: 100g",
            "stok" => 70,
            "satuan" => "buah",
            "harga" => 25000
        ],
        [
            "nama" => "Pudding Roti",
            "deskripsi" => "Roti: 4 lembar, Susu: 200ml, Telur: 3 butir, Gula: 100g, Kismis: 50g, Mentega: 50g",
            "stok" => 32,
            "satuan" => "loyang",
            "harga" => 35000
        ],
        [
            "nama" => "Donat",
            "deskripsi" => "Tepung: 250g, Gula: 100g, Telur: 2 butir, Mentega: 100g, Ragi: 1 sdt, Susu: 100ml",
            "stok" => 90,
            "satuan" => "buah",
            "harga" => 8000
        ],
        [
            "nama" => "Churros",
            "deskripsi" => "Tepung: 200g, Gula: 100g, Telur: 3 butir, Mentega: 100g, Baking Powder: 1 sdt",
            "stok" => 65,
            "satuan" => "buah",
            "harga" => 10000
        ]
        ];
        Produk::insert($produk);
    }
}
