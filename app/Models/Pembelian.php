<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $primaryKey = 'ID_PEMBELIAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEMBELI',
        'ID_ALAMAT',
        'ID_PEGAWAI',
        'TANGGAL_PEMBELIAN',
        'TANGGAL_LUNAS',
        'BATAS_PENGAMBILAN',
        'TANGGAL_PENGIRIMAN',
        'TANGGAL_DITERIMA',
        'SUBTOTAL',
        'TOTAL_BAYAR',
        'STATUS_PEMBAYARAN',
        'POIN_DIGUNAKAN',
        'POIN_DIDAPAT',
        'METODE_PENGIRIMAN',
        'BUKTI_PEMBAYARAN',
        'STATUS_PENGIRIMAN',
        'STATUS_PENGAMBILAN',
        'KOMISI_REUSEMART',
        'KOMISI_HUNTER',
        'BONUS_PENITIP',
    ];
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'ID_ALAMAT');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'ID_PEMBELIAN', 'ID_PEMBELIAN');
    }

    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'detailpembelian', 'ID_PEMBELIAN', 'ID_BARANG');
    }

}
