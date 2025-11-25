<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Keranjang;

class KeranjangWebController extends Controller
{
    public function index()
    {
        $pembeliId = session('user_id');

        $keranjang = Keranjang::with('barang')
            ->where('ID_PEMBELI', $pembeliId)->where('STATUS_KERANJANG', true)->get();

        return view('keranjang', compact('keranjang'));
    }

    public function tambah($id)
    {
        $pembeliId = session('user_id');

        // Cek apakah barang sudah ada di keranjang
        $cek = Keranjang::where('ID_PEMBELI', $pembeliId)
            ->where('ID_BARANG', $id)
            ->first();

        if ($cek) {
            return back()->with('error', 'Barang sudah ada di keranjang.');
        }

        Keranjang::create([
            'ID_PEMBELI' => $pembeliId,
            'ID_BARANG' => $id,
            'STATUS_KERANJANG' => true,
        ]);

        return back()->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function hapus($id)
    {
        $pembeliId = session('user_id');
        $keranjang = Keranjang::where('ID_BARANG', $id)
            ->where('ID_PEMBELI', $pembeliId)
            ->first();

        if (!$keranjang) {
            return back()->with('error', 'Barang tidak ditemukan di keranjang.');
        }

        $keranjang->delete();

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return back()->with('success', 'Keranjang dikosongkan');
    }
}
