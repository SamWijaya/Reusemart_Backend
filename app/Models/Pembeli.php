<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pembeli extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'pembeli';
    protected $primaryKey = 'ID_PEMBELI';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_PEMBELI',
        'EMAIL_PEMBELI',
        'PASSWORD_PEMBELI',
        'NOMOR_TELEPON',
        'POIN_PEMBELI',
    ];

    protected $hidden = [
        'PASSWORD_PEMBELI',
    ];

    public function getAuthPassword()
    {
        return $this->PASSWORD_PEMBELI;
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'ID_PEMBELI');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'ID_PEMBELIAN');
    }

    public function penukaranpoin()
    {
        return $this->hasMany(PenukaranPoin::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}

