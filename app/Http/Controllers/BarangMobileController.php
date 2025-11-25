<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMobileController extends Controller
{
    // Fungsi untuk menampilkan semua barang dengan status 'Tersedia'
    public function index()
    {
        try {
            $barangTersedia = Barang::where('STATUS_BARANG', 'Tersedia')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data barang tersedia berhasil diambil.',
                'data' => $barangTersedia
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi untuk menampilkan semua data barang (tanpa filter status)
    public function semuaBarang()
    {
        $barang = DB::table('barang')->get();
        return response()->json(['data' => $barang]);
    }
}
