<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Penitip;

class TopSeller extends Model
{
    use HasFactory;
    protected $table = 'topseller';
    protected $primaryKey = 'ID_TOPSELLER';
    public $timestamps = false;

    protected $fillable = [
        'ID_PENITIP',
        'PERIODE',
        'TOTAL_PENDAPATAN',
    ];

    public function penitip()
    {
        return $this->hasOne(Penitip::class);
    }
}