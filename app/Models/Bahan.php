<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;
    protected $table = "bahan";
    protected $primaryKey = "id_bahan";
    protected $fillable = ['nama_bahan', 'stok_bahan', 'satuan_bahan'];

    public function trBahan()
    {
        return $this->hasMany(TrBahan::class, 'id_bahan', 'id_bahan');
    }
}
