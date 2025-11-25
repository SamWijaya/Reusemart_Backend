<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penitip;
use Illuminate\Http\Request;

class PenitipMobileController extends Controller
{
    public function getHistoryBarang($id)
    {
        $barang = Barang::with('penitipan')
            ->whereHas('penitipan', function ($query) use ($id) {
                $query->where('ID_PENITIP', $id);
            })
            ->get()
            ->map(function ($b) {
                return [
                    'NAMA_BARANG' => $b->NAMA_BARANG,
                    'GAMBAR_1' => $b->GAMBAR_1,
                    'TANGGAL_PENITIPAN' => $b->penitipan->TANGGAL_PENITIPAN,
                    'TANGGAL_BERAKHIR' => $b->penitipan->TANGGAL_BERAKHIR,
                    'STATUS_BARANG' => $b->STATUS_BARANG,
                ];
            });

        return response()->json($barang);
    }

    public function getProfil($id)
    {
        $penitip = Penitip::find($id);

        if (!$penitip) {
            return response()->json(['error' => 'Penitip tidak ditemukan'], 404);
        }

        return response()->json([
            'ID_PENITIP' => $penitip->ID_PENITIP,
            'NAMA_PENITIP' => $penitip->NAMA_PENITIP,
            'EMAIL_PENITIP' => $penitip->EMAIL_PENITIP,
            'ALAMAT_PENITIP' => $penitip->ALAMAT_PENITIP,
            'NOTELP_PENITIP' => $penitip->NOTELP_PENITIP,
            'SALDO_PENITIP' => $penitip->SALDO_PENITIP,
            'POIN_PENITIP' => $penitip->POIN_PENITIP,
        ]);
    }
}
