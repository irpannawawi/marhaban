<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\TrBahan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiBahanController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = TrBahan::all()->sortByDesc('tgl_transaksi');
        
        if ($request->startDate != null && $request->endDate != null) {
            $transaksis = $transaksis->where('tgl_transaksi', '>=', Carbon::parse(request('startDate'))->startOfDay());
            $transaksis = $transaksis->where('tgl_transaksi', '<=', Carbon::parse(request('endDate'))->endOfDay());
        }
        if ($request->type != null && $request->type != 'all') {

            $transaksis = $transaksis->where('jenis', '=', $request->type);
        }
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
            $bahan = TrBahan::where([
                ['id_bahan', '=', $request->id_bahan],
                ['tgl_transaksi', '>=', Carbon::now()->subMonths(2)],
                ['jenis', '=', 'keluar'],
            ]);
            $trx_sum = $bahan->sum('qty');
            $trx_count = $bahan->count();
            $max_sold = $bahan->get()->max('qty');
            $buffer = ceil( ($max_sold - ($trx_sum / $trx_count) ) * 2);


            Bahan::where('id_bahan', $request->id_bahan)->update([
                'stok_bahan' => Bahan::find($request->id_bahan)->stok_bahan - $request->qty,
                'buffer_bahan' => $buffer
            ]);
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

    public function print_all(Request $request){
        $transaksi = TrBahan::all()->sortByDesc('tgl_transaksi');
        if ($request->startDate != null && $request->endDate != null) {
            $transaksi = $transaksi->where('tgl_transaksi', '>=', Carbon::parse(request('startDate'))->startOfDay());
            $transaksi = $transaksi->where('tgl_transaksi', '<=', Carbon::parse(request('endDate'))->endOfDay());
        }
        if ($request->type != null && $request->type != 'all') {

            $transaksi = $transaksi->where('jenis', '=', $request->type);
        }
        
        return view('transaksi_bahan.print_all', compact('transaksi'));

    }
}
