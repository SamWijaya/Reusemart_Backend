<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'ID_RATING';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEMBELI',
        'ID_BARANG',
        'JUMLAH_BINTANG',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'ID_BARANG');
    }
}
