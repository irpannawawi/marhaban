<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\TrBahan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiBahanController extends Controller
{
    public function index()
    {
        $transaksis = TrBahan::all()->sortByDesc('id');
        $bahans = Bahan::all();
        return view('transaksi_bahan.index', compact(['transaksis', 'bahans']));
    }

    public function create()
    {
        return view('transaksi_bahan.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $transaksi = Trbahan::create([
            'id_bahan' => $request->id_bahan, 
            'tgl_transaksi' => Carbon::now(),
            'qty' => $request->qty,
            'jenis' => $request->jenis,
        ]);
        
        if($request->jenis == "masuk"){
            Bahan::find($request->id_bahan)->update(['stok_bahan' => Bahan::find($request->id_bahan)->stok_bahan + $request->qty]);
        }else{
            Bahan::find($request->id_bahan)->update(['stok_bahan' => Bahan::find($request->id_bahan)->stok_bahan - $request->qty]);
        }
        DB::commit();
        return redirect()->route('trbahan.index');
    }

    public function edit($id)
    {
        $transaksi = TrBahan::findorfail($id);
        $bahans = Bahan::all();
        return view('transaksi_bahan.edit', compact('transaksi', 'bahans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        // cek data lama
        $transaksiLama = TrBahan::findorfail($id);
        
        // perbedaan stok bahan
        $bahan = Bahan::findorfail($transaksiLama->id_bahan);
        if($request->jenis == 'masuk'){
            $bahan->stok_bahan = $bahan->stok_bahan - $transaksiLama->qty + $request->qty;
        }else{
            $bahan->stok_bahan = $bahan->stok_bahan + $transaksiLama->qty - $request->qty;
        }
        $bahan->save();
        
        $transaksi = TrBahan::findorfail($id);
        $transaksi->update([
            'id_bahan' => $request->id_bahan,
            'tgl_transaksi' => $request->tgl_transaksi,
            'qty' => $request->qty,
            'jenis' => $request->jenis,
        ]);
        DB::commit();
        return redirect()->route('trbahan.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $transaksi = TrBahan::findorfail($id);
        // update data 
        $bahan = Bahan::findorfail($transaksi->id_bahan);
        if($transaksi->jenis == 'masuk'){
            $bahan->stok_bahan = $bahan->stok_bahan - $transaksi->qty;
        }else{
            $bahan->stok_bahan = $bahan->stok_bahan + $transaksi->qty;
        }
        $transaksi->delete();
        $bahan->save();
        DB::commit();
        return redirect()->back();
    }
}
