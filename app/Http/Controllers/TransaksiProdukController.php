<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TrProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiProdukController extends Controller
{
    public function index()
    {
        $transaksis = TrProduk::all()->sortByDesc('id');
        $produks = Produk::all();
        return view('transaksi_produk.index', compact(['transaksis', 'produks']));
    }

    public function create()
    {
        return view('transaksi_produk.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $transaksi = TrProduk::create([
            'id_produk' => $request->id_produk, 
            'tgl_transaksi' => Carbon::now(),
            'qty' => $request->qty,
            'jenis' => $request->jenis,
        ]);
        
        if($request->jenis == "masuk"){
            Produk::find($request->id_produk)->update(['stok' => Produk::find($request->id_produk)->stok + $request->qty]);
        }else{
            Produk::find($request->id_produk)->update(['stok' => Produk::find($request->id_produk)->stok - $request->qty]);
        }
        DB::commit();
        return redirect()->route('trproduk.index');
    }

    public function edit($id)
    {
        $transaksi = TrProduk::findorfail($id);
        $produks = Produk::all();
        return view('transaksi_produk.edit', compact('transaksi', 'produks'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        // cek data lama
        $transaksiLama = TrProduk::findorfail($id);
        
        // perbedaan stok bahan
        $produk = Produk::findorfail($transaksiLama->id_produk);
        if($request->jenis == 'masuk'){
            $produk->stok = $produk->stok - $transaksiLama->qty + $request->qty;
        }else{
            $produk->stok = $produk->stok + $transaksiLama->qty - $request->qty;
        }
        $produk->save();
        
        $transaksi = TrProduk::findorfail($id);
        $transaksi->update([
            'id_produk' => $request->id_produk,
            'tgl_transaksi' => $request->tgl_transaksi,
            'qty' => $request->qty,
            'jenis' => $request->jenis,
        ]);
        DB::commit();
        return redirect()->route('trproduk.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $transaksi = TrProduk::findorfail($id);
        // update data 
        $produk = Produk::findorfail($transaksi->id_produk);
        if($transaksi->jenis == 'masuk'){
            $produk->stok = $produk->stok - $transaksi->qty;
        }else{
            $produk->stok = $produk->stok + $transaksi->qty;
        }
        $transaksi->delete();
        $produk->save();
        DB::commit();
        return redirect()->back();
    }
}
