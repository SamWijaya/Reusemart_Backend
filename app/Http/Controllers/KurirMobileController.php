<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class KurirMobileController extends Controller
{
    public function profil($id)
    {
        $kurir = Pegawai::with('jabatan')
            ->where('ID_PEGAWAI', $id)
            ->whereHas('jabatan', function ($query) {
                $query->where('NAMA_JABATAN', 'kurir');
            })
            ->first();

        if (!$kurir) {
            return response()->json(['error' => 'Data kurir tidak ditemukan'], 404);
        }

        return response()->json($kurir);
    }
}

