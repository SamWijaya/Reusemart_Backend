<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diskusi extends Model
{
    use HasFactory;
    protected $table = 'diskusi';
    protected $primaryKey = 'ID_DISKUSI';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEGAWAI',
        'ID_BARANG',
        'ID_PEMBELI',
        'PESAN',
    ];

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG', 'ID_BARANG');
    }

    // Relasi ke Pembeli
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI', 'ID_PEMBELI');
    }

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }
}
