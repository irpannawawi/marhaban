<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    {
        $bahans = Bahan::all();
        return view('database.index', compact('bahans'));
    }
    
}
