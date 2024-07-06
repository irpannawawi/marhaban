<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturans = Pengaturan::all();
        return view('pengaturan.index', compact('pengaturans'));
    }

    public function update(Request $request, $id){
        $pengaturan = Pengaturan::find($id);
        $pengaturan->value = $request->value;
        $pengaturan->save();
        return redirect()->route('pengaturan.index')->with('success','Success');
    }
}
