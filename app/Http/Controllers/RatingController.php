<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Rating;


class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ID_BARANG' => 'required|integer|exists:barang,ID_BARANG',
            'JUMLAH_BINTANG' => 'required|integer|min:1|max:5',
        ]);

        $id_pembeli = session('user_id');

        if (!$id_pembeli) {
            return response()->json(['success' => false, 'message' => 'Session pembeli tidak ditemukan'], 401);
        }

        Rating::updateOrCreate(
            [
                'ID_PEMBELI' => $id_pembeli,
                'ID_BARANG' => $request->ID_BARANG,
            ],
            [
                'JUMLAH_BINTANG' => $request->JUMLAH_BINTANG,
            ]
        );

        return response()->json(['success' => true]);
    }
}