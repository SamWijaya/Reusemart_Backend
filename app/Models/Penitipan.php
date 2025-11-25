<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penitipan extends Model
{
    use HasFactory;
    protected $table = 'penitipan';
    protected $primaryKey = 'ID_PENITIPAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_PENITIP',
        'ID_PEGAWAI',
        'ID_HUNTER',
        'TANGGAL_PENITIPAN',
        'TANGGAL_BERAKHIR',
        'STATUS_PERPANJANGAN',
        'BATAS_AMBIL',
        'IS_AMBIL',
        'STATUS_AMBIL_KEMBALI',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI');
    }

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'ID_PENITIP');
    }

    public function hunter()
    {
        return $this->belongsTo(Hunter::class, 'ID_HUNTER');
    }

}
