<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskusi;
use App\Models\Barang;

class DiskusiWebController extends Controller
{

    public function csIndex()
    {
        $products = Barang::all(); // atau bisa disesuaikan dengan relasi kategori
        return view('CSForDiskusi', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'ID_BARANG' => 'required|exists:barang,ID_BARANG',
            'PESAN' => 'required|string'
        ]);

        $diskusi = new Diskusi();
        $diskusi->ID_BARANG = $request->ID_BARANG;
        $diskusi->PESAN = $request->PESAN;

        if (session('user_type') === 'pembeli') {
            $diskusi->ID_PEMBELI = session('user_id');
            $diskusi->ID_PEGAWAI = null;
        } elseif (session('user_type') === 'pegawai') {
            $diskusi->ID_PEGAWAI = session('user_id');
            $diskusi->ID_PEMBELI = null;
        } else {
            return abort(403); // user tidak valid
        }

        $diskusi->save();

        return back()->with('success', 'Pesan diskusi berhasil dikirim.');
    }


}
