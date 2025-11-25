<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komisi extends Model
{
    use HasFactory;
    protected $table = 'komisi';
    protected $primaryKey = 'ID_KOMISI';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEGAWAI',
        'ID_PENITIP',
        'ID_PEMBELIAN',
        'JUMLAH_KOMISI',
        'PRESENTASE_KOMISI',
        'TANGGAL_KOMISI',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'ID_PEMBELIAN');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG');
    }

        public function  pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI');
    }

}