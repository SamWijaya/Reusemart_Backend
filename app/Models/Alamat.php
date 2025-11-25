<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamat';
    protected $primaryKey = 'ID_ALAMAT';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEMBELI',
        'LABEL_ALAMAT',
        'NAMA_JALAN',
        'KECAMATAN',
        'KELURAHAN',
        'KOTA',
        'KODE_POS',
        'IS_DEFAULT',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'ID_PEMBELIAN');
    }
}
