<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

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
    {
        $bahan = Bahan::create($request->all());

        return redirect()->route('database')->with('success', 'Bahan berhasil ditambahkan');
    }

    public function edit(Bahan $bahan)
    {
        return view('bahan.edit', compact('bahan'));
    }

    public function update(Request $request, Bahan $bahan)
    {
        $bahan->update($request->all());

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil diubah');
    }

    public function destroy($id)
    {
        Bahan::find($id)->delete();

        return redirect()->route('database')->with('success', 'Bahan berhasil dihapus');
    }
}
