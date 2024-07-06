<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\TrBahan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanController extends Controller
{
    
    public function index()
    {
        $bahans= Bahan::all();

        return view('transaksi_bahan_baku.index', compact('bahans'));
    }

    public function create()
    {
        return view('bahan.create');
    }

    public function store(Request $request)
    {   DB::beginTransaction();
        $bahan = Bahan::create($request->all());
        if($request->stok_bahan > 0){
            TrBahan::create([
                'id_bahan' => $bahan->id_bahan,
                'tgl_transaksi'=> Carbon::now(),
                'qty' => $request->stok_bahan,
                'jenis' => 'masuk'
                ]);
        }
        DB::commit();

        return redirect()->route('database')->with('success', 'Bahan berhasil ditambahkan');
    }

    public function edit(Bahan $bahan)
    {
        return view('database.edit_bahan', compact('bahan'));
    }

    public function update(Request $request, Bahan $bahan)
    {
        $bahan->update($request->all());

        return redirect()->route('database')->with('success', 'Bahan berhasil diubah');
    }

    public function destroy($id)
    {
        Bahan::find($id)->delete();
        TrBahan::where('id_bahan', $id)->delete();
        return redirect()->route('database')->with('success', 'Bahan berhasil dihapus');
    }
}
