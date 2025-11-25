<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;

    protected $fillable = [
        'ID_JABATAN',
        'NAMA_PEGAWAI',
        'EMAIL_PEGAWAI',
        'NOTELP_PEGAWAI',
        'TGL_LAHIR',
        'PASSWORD_PEGAWAI',
    ];

    public function penitipan()
    {
        return $this->hasMany(Penitipan::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ID_JABATAN');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
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
