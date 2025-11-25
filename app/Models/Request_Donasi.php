<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request_Donasi extends Model
{
    use HasFactory;
    protected $table = 'requestdonasi';
    protected $primaryKey = 'ID_REQUEST';
    public $timestamps = false;

    protected $fillable = [
        'ID_ORGANISASI',
        'NAMA_BARANG',
        'DESKRIPSI_REQUEST',
        'TANGGAL_REQUEST',
        'STATUS_REQUEST',
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'ID_ORGANISASI', 'ID_ORGANISASI');
    }

}
