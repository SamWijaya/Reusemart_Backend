<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
     use HasFactory;
    protected $table = 'donasi';
    protected $primaryKey = 'ID_DONASI';
    public $timestamps = false;

    protected $fillable = [
        'ID_REQUEST',
        'ID_BARANG',
        'TANGGAL_DONASI',
        'NAMA_PENERIMA',
    ];

    // Relasi ke Produk
    public function requestDonasi()
    {
        return $this->belongsTo(Request_Donasi::class, 'ID_REQUEST', 'ID_REQUEST');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG', 'ID_BARANG');
    }
}
