<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Request_Donasi;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organisasi extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens;
    protected $table = 'organisasi';
    protected $primaryKey = 'ID_ORGANISASI';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_ORGANISASI',
        'EMAIL_ORGANISASI',
        'ALAMAT_ORGANISASI',
        'NOTELP_ORGANISASI',
        'PASSWORD_ORGANISASI',
    ];

    protected $hidden = [
        'PASSWORD_ORGANISASI',
    ];

    public function request()
    {
        return $this->hasMany(Request_Donasi::class, 'ID_ORGANISASI');
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD_ORGANISASI;
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
