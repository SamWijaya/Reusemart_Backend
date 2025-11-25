<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Pembeli;
use App\Models\PenukaranPoin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MerchandiseMobileController extends Controller
{
    public function index()
    {
        $merchandise = Merchandise::all();

        return response()->json([
            'status' => true,
            'message' => 'Data merchandise berhasil diambil',
            'data' => $merchandise
        ]);
    }

    public function penukaranPoin(Request $request)
    {
        $request->validate([
            'id_merchandise' => 'required|exists:merchandise,ID_MERCHANDISE',
            'id_pembeli' => 'required|exists:pembeli,ID_PEMBELI',
        ]);

        $merchandise = Merchandise::where('ID_MERCHANDISE', $request->id_merchandise)->first();
        $pembeli = Pembeli::where('ID_PEMBELI', $request->id_pembeli)->first();

        // Cek stok
        if ($merchandise->STOK_MERCHANDISE <= 0) {
            return response()->json(['message' => 'Stok merchandise habis'], 400);
        }

        // Cek poin pembeli cukup
        if ($pembeli->POIN_PEMBELI < $merchandise->POIN_DIPERLUKAN) {
            return response()->json(['message' => 'Poin tidak mencukupi'], 400);
        }

        // Lakukan penukaran
        $penukaran = PenukaranPoin::create([
            'ID_MERCHANDISE' => $request->id_merchandise,
            'ID_PEMBELI' => $request->id_pembeli,
            'TANGGAL_KLAIM' => Carbon::now(),
        ]);

        // Update stok dan poin pembeli
        $merchandise->decrement('STOK_MERCHANDISE');
        $pembeli->decrement('POIN_PEMBELI', $merchandise->POIN_DIPERLUKAN);

        return response()->json([
            'message' => 'Penukaran berhasil',
            'data' => $penukaran
        ]);
    }
}
