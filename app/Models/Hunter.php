<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hunter extends Model
{
    use HasFactory;
    protected $table = 'hunter';
    protected $primaryKey = 'ID_HUNTER';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_HUNTER',
        'EMAIL_HUNTER',
        'PASSWORD_HUNTER',
        'SALDO_HUNTER',
    ];

    public function penitipan()
    {
        return $this->hasMany(Penitipan::class);
    }
}
