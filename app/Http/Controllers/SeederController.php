<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\TrBahan;
use App\Models\TrProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SeederController extends Controller
{
    public function seed()
    {
        TrProduk::truncate();
        TrBahan::truncate();
        $resep = [
            'Bolu Kukus Biasa' => [
                'Tepung Terigu' => 0.25,
                'Gula Pasir' => 0.2,
                'Telur' => 3,
                'Mentega' => 0.1,
                'Baking Soda' => 0.1,
                'Vanili' => 0.1,

            ],
            'Bolu Kijing' => [
                'Tepung Terigu' => 0.2,
                'Gula Pasir' => 0.2,
                'Telur' => 6,
                'Mentega' => 0.6,
                'Baking Soda' => 0.1,
            ],
            'Brownies' => [
                'Tepung Terigu' => 0.2,
                'Gula Pasir' => 0.15,
                'Telur' => 3,
                'Mentega' => 0.1,
                'Coklat' => 0.1
            ]
        ];
        // create transaction produk
        for ($i = 1; $i <= 31; $i++) {
            $tanggal = Carbon::parse('2024-07-' . ($i < 10 ? "0$i" : $i));

            $bahan_keluar = [];
            foreach (Produk::all() as $produk) {
                $jml = rand(5, 10);
                // bahan keluar 1x /hari
                foreach ($resep[$produk->nama] as $bahan => $qty) {
                    $bahan_keluar[] = [
                        $bahan => $qty * $jml,
                    ];
                }


                // produk masuk
                $this->create_produk($tanggal, $produk->id_produk, $jml, "masuk");

                // produk keluar
                $this->create_produk($tanggal, $produk->id_produk, $jml-rand(1, 5), "keluar");
            }
            // bahan masuk
            
            foreach ($bahan_keluar as $bahan) {

                $bahan_baku = Bahan::where('nama_bahan', key($bahan))->first();
                if ($bahan_baku == null) {
                    $bahan_baku = Bahan::create([
                        'nama_bahan' => key($bahan),
                        'stok_bahan' => $bahan[key($bahan)],
                        'satuan_bahan' => 'kg',
                    ]);
                }
                
                $jml_masuk = $bahan[key($bahan)] + (0.5 * $bahan[key($bahan)]);
                $this->create_bahan($tanggal, $bahan_baku->id_bahan, $jml_masuk, "masuk");

            }

            // bahan keluar
            
            foreach ($bahan_keluar as $bahan) {

                $bahan_baku = Bahan::where('nama_bahan', key($bahan))->first();
                if ($bahan_baku == null) {
                    $bahan = Bahan::create([
                        'nama_bahan' => key($bahan),
                        'stok_bahan' => $bahan[key($bahan)],
                        'satuan_bahan' => 'kg',
                    ]);
                }
                $this->create_bahan($tanggal, $bahan_baku->id_bahan, $bahan[key($bahan)], "keluar");

            }
            // Update stok 
            $bahan = TrBahan::all()->groupBy('id_bahan')->map(function ($item) {
                
                return ['id' => $item[0]->id_bahan, 'qty' => $item
                ->where('jenis', 'masuk')
                ->sum('qty') - $item->where('jenis', 'keluar')->sum('qty')];
            })->values();
            foreach($bahan as $b){
                Bahan::find($b['id'])->update(['stok_bahan' => $b['qty']]);                
            }
        }
    }

    public function create_bahan($tgl, $id_bahan, $qty, $jenis)
    {
        DB::beginTransaction();
        $transaksi = Trbahan::create([
            'id_bahan' => $id_bahan,
            'tgl_transaksi' => Carbon::parse($tgl),
            'qty' => $qty,
            'jenis' => $jenis,
        ]);

        if ($jenis == "masuk") {
            Bahan::find($id_bahan)->update(['stok_bahan' => Bahan::find($id_bahan)->stok_bahan + $qty]);
        } else {
            $bahan = TrBahan::where([
                ['id_bahan', '=', $id_bahan],
                ['tgl_transaksi', '>=', Carbon::now()->subMonths(2)],
                ['jenis', '=', 'keluar'],
            ]);
            $trx_sum = $bahan->sum('qty');
            $trx_count = $bahan->count();
            $max_sold = $bahan->get()->max('qty');
            $buffer = ceil(($max_sold - ($trx_sum / $trx_count)) * 2);


            Bahan::where('id_bahan', $id_bahan)->update([
                'stok_bahan' => Bahan::find($id_bahan)->stok_bahan - $qty,
                'buffer_bahan' => $buffer
            ]);
        }
        DB::commit();
    }

    public function create_produk($tgl, $id_produk, $qty, $jenis)
    {
        DB::beginTransaction();
        $transaksi = TrProduk::create([
            'id_produk' => $id_produk,
            'tgl_transaksi' => Carbon::parse($tgl),
            'qty' => $qty,
            'jenis' => $jenis,
        ]);

        if ($jenis == "masuk") {
            Produk::find($id_produk)->update(['stok' => Produk::find($id_produk)->stok + $qty]);
        } else {
            $produk = TrProduk::where([
                ['id_produk', '=', $id_produk],
                ['tgl_transaksi', '>=', Carbon::now()->subMonths(2)],
                ['jenis', '=', 'keluar'],
            ]);
            $trx_sum = $produk->sum('qty');
            $trx_count = $produk->count();
            $max_sold = $produk->get()->max('qty');
            $buffer = ($max_sold - ($trx_sum / $trx_count)) * 2;

            Produk::where('id_produk', $id_produk)->update([
                'stok' => Produk::find($id_produk)->stok - $qty,
                'buffer' => ceil($buffer)
            ]);

        }
        DB::commit();
    }
}
