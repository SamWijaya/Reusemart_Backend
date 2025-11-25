<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'ID_BARANG';
    public $timestamps = false;

    protected $fillable = [
        'ID_PENITIPAN',
        'NAMA_BARANG',
        'GAMBAR_1',
        'GAMBAR_2',
        'GAMBAR_3',
        'HARGA_BARANG',
        'DESKRIPSI_BARANG',
        'GARANSI',
        'BERAT',
        'KATEGORI_BARANG',
        'STATUS_BARANG',
    ];

    public function penitipan()
    {
        return $this->belongsTo(Penitipan::class, 'ID_PENITIPAN');
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'detailpembelian', 'ID_BARANG', 'ID_PEMBELIAN');
    }

    public function donasi()
    {
        return $this->hasOne(Donasi::class);
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'ID_BARANG');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'ID_BARANG');
    }
}
