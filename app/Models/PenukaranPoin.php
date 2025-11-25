<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenukaranPoin extends Model
{
    use HasFactory;
    protected $table = 'penukaranpoin';
    protected $primaryKey = 'ID_PENUKARAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_MERCHANDISE',
        'ID_PEMBELI',
        'TANGGAL_KLAIM',
    ];

    
    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class, 'ID_MERCHANDISE');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }
}
