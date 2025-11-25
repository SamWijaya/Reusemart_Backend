<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'detailpembelian';
    protected $primaryKey = 'ID_DETAIL';
    public $timestamps = false;

    protected $fillable = [
        'ID_BARANG',
        'ID_PEMBELIAN',
    ];

    // Relasi ke Produk
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG', 'ID_BARANG');
    }

    // Relasi ke Pembeli
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'ID_PEMBELIAN', 'ID_PEMBELIAN');
    }
}
