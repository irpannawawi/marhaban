<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrProduk extends Model
{
    use HasFactory;
    protected $table = 'transaksi_produk';
    protected $fillable = [
        'id_produk',
        'tgl_transaksi',
        'qty',
        'jenis'
    ];
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
