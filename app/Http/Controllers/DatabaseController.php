<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    {
        $bahans = Bahan::all();
        $produks = Produk::all();
        
        return view('database.index', compact(['bahans', 'produks']));
    }
    
}
