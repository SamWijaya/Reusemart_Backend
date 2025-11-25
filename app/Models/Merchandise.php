<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchandise extends Model
{
    use HasFactory;
    protected $table = 'merchandise';
    protected $primaryKey = 'ID_MERCHANDISE';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_MERCHANDISE',
        'GAMBAR_MERCHANDISE',
        'STOK_MERCHANDISE',
        'POIN_DIPERLUKAN',
    ];

    public function penukaranpoin()
    {
        return $this->hasMany(PenukaranPoin::class);
    }
}
