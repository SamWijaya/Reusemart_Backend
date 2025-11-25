<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use App\Models\Alamat;
use App\Models\Barang;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PembeliWebController extends Controller
{
    public function mainPage()
    {
        $products = Barang::whereIn('STATUS_BARANG', ['Tersedia', 'Terjual'])->get();
        return view('halamanPembeli', compact('products'));
    }


    public function index()
    {
        $pembeliId = session('user_id');

        if (!$pembeliId) {
            return redirect('/login')->with('error', 'Silakan login sebagai pembeli terlebih dahulu.');
        }

        // Ambil data pembeli dari database


        $pembeli = Pembeli::find($pembeliId);
        $alamatList = Alamat::where('ID_PEMBELI', $pembeliId)->get();
        return view('ProfilPembeli', compact('pembeli', 'alamatList'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NAMA_PEMBELI' => 'required|string|max:255',
                'EMAIL_PEMBELI' => 'required|email|unique:pembeli,EMAIL_PEMBELI',
                'PASSWORD_PEMBELI' => 'required|string|min:6',
                'NOMOR_TELEPON' => 'required|string|max:20',
            ]);

            $pembeli = Pembeli::create([
                'NAMA_PEMBELI' => $request->NAMA_PEMBELI,
                'EMAIL_PEMBELI' => $request->EMAIL_PEMBELI,
                'PASSWORD_PEMBELI' => Hash::make($request->PASSWORD_PEMBELI),
                'NOMOR_TELEPON' => $request->NOMOR_TELEPON,
                'POIN_PEMBELI' => 0,
            ]);

            return redirect('/login')->with('success', 'Pembeli berhasil ditambahkan. Silakan login.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rating()
    {
        // Ambil ID pembeli dari session
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $data = DB::table('pembelian')
            ->join('detailpembelian', 'pembelian.ID_PEMBELIAN', '=', 'detailpembelian.ID_PEMBELIAN')
            ->join('barang', 'detailpembelian.ID_BARANG', '=', 'barang.ID_BARANG')
            ->join('penitipan', 'barang.ID_PENITIPAN', '=', 'penitipan.ID_PENITIPAN')
            ->leftJoin('rating', function($join) use ($userId) {
                $join->on('rating.ID_BARANG', '=', 'barang.ID_BARANG')
                    ->where('rating.ID_PEMBELI', $userId);
            })
            ->where('pembelian.ID_PEMBELI', $userId)
            ->select(
                'pembelian.ID_PEMBELIAN',
                'barang.ID_BARANG',
                'barang.NAMA_BARANG',
                'barang.HARGA_BARANG',
                'rating.JUMLAH_BINTANG',
                'penitipan.ID_PENITIP'
            )
            ->get();

        return view('historyPembelian', ['historyPembelian' => $data]);
    }

    public function simpanRating(Request $request)
    {
        // Ambil ID pembeli dari session
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        DB::table('rating')->updateOrInsert(
            [
                'ID_PEMBELI' => $userId,
                'ID_BARANG' => $request->id_barang,
                'ID_PENITIP' => $request->id_penitip
            ],
            [
                'JUMLAH_BINTANG' => $request->jumlah_bintang,
            ]
        );

        return response()->json(['success' => true]);
    }

    public function ratarata()
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }   

        $averageRating = DB::table('rating')
            ->where('ID_PENITIP', $userId)
            ->avg('JUMLAH_BINTANG');

            Log::info($averageRating);
        return view('ProfilPenitip', [
            'averageRating' => round($averageRating, 1)
        ]);
    }
}
