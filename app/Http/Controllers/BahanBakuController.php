<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{

    public function index()
    {
        $bahans= Bahan::all();

        return view('transaksi_bahan_baku.index', compact('bahans'));
    }

    public function store(Request $request)
    {
        $bahanBaku = Bahan::create($request->all());

        return redirect()->back()->with("success","Data Berhasil Dimasukan");
    }

    public function show($id)
    {
        $bahanBaku = Bahan::findOrFail($id);

        return $bahanBaku->toJson();
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = Bahan::findOrFail($id);
        $bahanBaku->update($request->all());

        return response()->json($bahanBaku, 200);
    }

    public function destroy($id)
    {
        Bahan::destroy($id);

        return response()->json(null, 204);
    }
}
