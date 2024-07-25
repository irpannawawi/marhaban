<?php

namespace App\View\Components;

use App\Models\Bahan;
use App\Models\Produk;
use App\Models\TrBahan;
use App\Models\TrProduk;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GrafikPenjualan extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data['productsSold'] = TrProduk::all()->groupBy('id_produk')->map(function ($item) {
            return [
                'name'=> $item[0]->produk->nama,
                'times'=> $item->where('jenis', 'keluar')->count(),
                'sold'=> $item->where('jenis', 'keluar')->sum('qty'),
            ];
        })->sortByDesc('times')->values();
        $data['maxProductSold'] = TrProduk::all()->where('jenis', 'keluar')->count();

        // bahan
        $data['products'] = Produk::all();
        $data['bahans'] = Bahan::all();
        return view('components.grafik-penjualan', $data);
    }
}
