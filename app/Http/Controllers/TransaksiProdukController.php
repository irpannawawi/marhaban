<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TrProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiProdukController extends Controller
{

    public function index(Request $request)
    {
        $transaksis = TrProduk::all()->sortByDesc('tgl_transaksi');
        if ($request->startDate != null && $request->endDate != null) {
            $transaksis = $transaksis->where('tgl_transaksi', '>=', Carbon::parse(request('startDate'))->startOfDay());
            $transaksis = $transaksis->where('tgl_transaksi', '<=', Carbon::parse(request('endDate'))->endOfDay());
        }
        if ($request->type != null && $request->type != 'all') {

            $transaksis = $transaksis->where('jenis', '=', $request->type);
        }
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
            $produk = TrProduk::where([
                ['id_produk', '=', $request->id_produk],
                ['tgl_transaksi', '>=', Carbon::now()->subMonths(2)],
                ['jenis', '=', 'keluar'],
            ]);
            $trx_sum = $produk->sum('qty');
            $trx_count = $produk->count();
            $max_sold = $produk->get()->max('qty');
            $buffer = ($max_sold - ($trx_sum / $trx_count) ) * 2;

            Produk::where('id_produk', $request->id_produk)->update([
                'stok' => Produk::find($request->id_produk)->stok - $request->qty,
                'buffer' => ceil($buffer)
            ]);

        }
        DB::commit();
        $msg = [
            'message' => 'Data Berhasilsukses Disimpan',
            'jenis' => $request->jenis,
            'id'=> $transaksi->id
        ];
        $print = True;
        return redirect()->route('trproduk.index')->with('msg', $msg)->with('print', $print);
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

    public function print($id){
        $transaksi = TrProduk::findorfail($id);
        return view('transaksi_produk.print', compact('transaksi'));
    }


    public function print_all(Request $request){
        $transaksi = TrProduk::all()->sortByDesc('tgl_transaksi');
        if ($request->startDate != null && $request->endDate != null) {
            $transaksi = $transaksi->where('tgl_transaksi', '>=', Carbon::parse(request('startDate'))->startOfDay());
            $transaksi = $transaksi->where('tgl_transaksi', '<=', Carbon::parse(request('endDate'))->endOfDay());
        }
        if ($request->type != null && $request->type != 'all') {

            $transaksi = $transaksi->where('jenis', '=', $request->type);
        }
        return view('transaksi_produk.print_all', compact('transaksi'));
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
