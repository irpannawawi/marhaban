<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\Produk;
use App\Models\TrBahan;
use App\Models\TrProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = \Faker\Factory::create();
        TrProduk::truncate();
        TrBahan::truncate();
        // create transaction produk
        $produk = Produk::all();
        $transaksiProduk = [];
        foreach ($produk as $p) {
            for ($i = 0; $i < rand(3, 10); $i++) {
                $transaksiProduk[] = [
                    'id_produk' => $p->id_produk,
                    'tgl_transaksi' => $faker->dateTimeThisMonth(),
                    'jenis' => collect(['masuk', 'keluar'])->shuffle()->first(),
                    'qty' => rand(1, 10),
                    'created_at' => $faker->dateTimeThisMonth(),
                    'updated_at' => Carbon::now()
                ];

                Produk::where('id_produk', $p->id_produk)->update(['stok' => $p->stok - $transaksiProduk[$i]['qty']]);
            }
        }

        shuffle($transaksiProduk);
        TrProduk::insert($transaksiProduk);

        // create transaction Bahan
        $bahans = Bahan::all();
        $transaksiBahan = [];
        foreach ($bahans as $bahan) {
            for ($i = 0; $i < rand(3, 10); $i++) {
                $transaksiBahan[] =  [
                    'id_bahan' => $bahan->id_bahan,
                    'tgl_transaksi' => $faker->dateTimeThisMonth(),
                    'qty' => rand(1, 10),
                    'jenis' => collect(['masuk', 'keluar'])->shuffle()->first(),
                    'created_at' => $faker->dateTimeThisMonth(),
                    'updated_at' => Carbon::now()
                ];
            }
        }
        shuffle($transaksiBahan);
        TrBahan::insert($transaksiBahan);
    }
}
