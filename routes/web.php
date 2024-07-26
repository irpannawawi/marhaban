<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiBahanController;
use App\Http\Controllers\TransaksiProdukController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/generate_advice', [AiController::class, 'generate'])->name('generate_advice')->middleware('role:admin');
    
    // Database view 
    Route::get('/database', [DatabaseController::class, 'index'])->name('database')->middleware('role:admin');
    
    // bahan baku
    Route::resource('/bahan', BahanController::class)->middleware('role:admin|staf_bahan');
    Route::resource('/produk', ProdukController::class)->middleware('role:admin|staf_produk');

    // transaksi bahan baku
    Route::resource('/trbahan', TransaksiBahanController::class)->middleware('role:admin|staf_bahan');
    
    // transaksi Produk
    Route::resource('/trproduk', TransaksiProdukController::class)->middleware('role:admin|staf_produk');
    Route::get('/trproduk/print/{id}', [TransaksiProdukController::class, 'print'])->name('trproduk.print')->middleware('role:admin|staf_produk');
    
    Route::resource('/pengaturan', PengaturanController::class)->middleware('role:admin');
    
    Route::resource('/administrator', UserController::class)->middleware('role:admin');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
