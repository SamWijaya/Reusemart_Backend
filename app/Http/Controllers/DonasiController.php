<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Barang;
use App\Models\Request_Donasi;

class DonasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'ID_REQUEST' => 'required|exists:requestdonasi,ID_REQUEST',
            'ID_BARANG' => 'required|exists:barang,ID_BARANG',
            'NAMA_PENERIMA' => 'required|string|max:255',
        ]);

        // Simpan data donasi
        $donasi = Donasi::create([
            'ID_REQUEST' => $validated['ID_REQUEST'],
            'ID_BARANG' => $validated['ID_BARANG'],
            'TANGGAL_DONASI' => now(),
            'NAMA_PENERIMA' => $validated['NAMA_PENERIMA'],
        ]);

        // Ubah status barang menjadi 'terdonasi'
        $barang = Barang::findOrFail($validated['ID_BARANG']);
        $barang->STATUS_BARANG = 'Terdonasi';
        $barang->save();

        // Update status request menjadi selesai
        $requestDonasi = Request_Donasi::findOrFail($validated['ID_REQUEST']);
        $requestDonasi->STATUS_REQUEST = 'Donated';
        $requestDonasi->save();

        // Hitung dan tambah poin ke penitip
        if ($barang->penitipan && $barang->penitipan->penitip) {
            $penitip = $barang->penitipan->penitip;

            // Konversi harga ke poin (dibulatkan ke bawah)
            $poin = floor($barang->HARGA_BARANG / 10000);
            $penitip->POIN_PENITIP += $poin;
            $penitip->save();
        }

        return redirect()->back()->with('success', 'Donasi berhasil disimpan.');
    }
}
