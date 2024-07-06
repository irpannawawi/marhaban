<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiBahanController;
use App\Http\Controllers\TransaksiProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Database view 
    Route::get('/database', [DatabaseController::class, 'index'])->name('database');
    
    // bahan baku
    Route::resource('/bahan', BahanController::class);
    Route::resource('/produk', ProdukController::class);

    // transaksi bahan baku
    Route::resource('/trbahan', TransaksiBahanController::class);
    
    // transaksi Produk
    Route::resource('/trproduk', TransaksiProdukController::class);
    
    Route::resource('/pengaturan', PengaturanController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
