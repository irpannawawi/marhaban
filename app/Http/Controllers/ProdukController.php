<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TrProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);
        DB::beginTransaction();
        
        $produk = Produk::create($request->all());
        if($request->stok > 0){
            $transaksi = TrProduk::create([
                'id_produk' => $produk->id_produk, 
                'tgl_transaksi' => Carbon::now(),
                'qty' => $produk->stok,
                'jenis' => 'masuk',
            ]);
        }
        DB::commit();

        return redirect()->route('database')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Produk $produk)
    {
        
        return view('database.edit_produk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $produk = Produk::find($id);
        $produk->update($request->all());
        return redirect()->route('database')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    { 
        
        $produk = Produk::find($id);
        TrProduk::where('id_produk', $id)->delete();
        $produk->delete();
        return redirect()->route('database')->with('success', 'Data berhasil dihapus');
    }
}