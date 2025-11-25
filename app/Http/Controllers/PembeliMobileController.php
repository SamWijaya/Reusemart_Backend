<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliMobileController extends Controller
{
    public function show($id)
    {
        $pembeli = Pembeli::find($id);

        if (!$pembeli) {
            return response()->json([
                'success' => false,
                'message' => 'Pembeli tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pembeli->ID_PEMBELI,
                'nama' => $pembeli->NAMA_PEMBELI,
                'email' => $pembeli->EMAIL_PEMBELI,
                'telepon' => $pembeli->NOMOR_TELEPON,
                'poin' => $pembeli->POIN_PEMBELI,
            ]
        ]);
    }
}
