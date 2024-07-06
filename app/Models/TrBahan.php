<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBahan extends Model
{
    use HasFactory;
    protected $table = 'transaksi_bahan';
    protected $fillable = [
        'id_bahan',
        'tgl_transaksi',
        'qty',
        'jenis'
    ];
    
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan');
    }
}
