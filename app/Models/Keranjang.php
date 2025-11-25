<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $primaryKey = 'ID_KERANJANG';
    public $timestamps = false;

    protected $fillable = ['ID_PEMBELI', 'ID_BARANG', 'STATUS_KERANJANG'];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG');
    }
}
