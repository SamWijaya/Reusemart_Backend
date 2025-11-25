<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Donasi;
use App\Models\Organisasi;

class RequestWebController extends Controller
{
    public function index()
    {
        $organisasiId = session('user_id');

        // Ambil data organisasi jika dibutuhkan
        $organisasi = Organisasi::find($organisasiId);

        if (!$organisasi) {
            return redirect()->route('login.form')->withErrors(['msg' => 'Data organisasi tidak ditemukan. Silakan login ulang.']);
        }

        // Ambil data request donasi berdasarkan ID organisasi
        $requestList = Request_Donasi::where('ID_ORGANISASI', $organisasiId)->get();

        return view('organisasi', compact('organisasi', 'requestList'));
    }

    // Menyimpan Request Donasi baru ke dalam database
    public function store(Request $request)
    {
        $organisasiId = session('user_id');

        $validated = $request->validate([
            'DESKRIPSI_REQUEST' => 'required|string|max:255',
            'NAMA_BARANG' => 'required|string|max:100', 
        ]);

        // Tambahkan nilai otomatis
        $validated['ID_ORGANISASI'] = $organisasiId;
        $validated['TANGGAL_REQUEST'] = now(); // waktu saat ini
        $validated['STATUS_REQUEST'] = 'menunggu';

        Request_Donasi::create($validated);

        return redirect()->route('halamanOrganisasi')->with('success', 'Request Donasi berhasil ditambahkan.');
    }

    // Memperbarui Request Donasi di database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'DESKRIPSI_REQUEST' => 'required|string|max:255',
            'NAMA_BARANG' => 'required|string|max:100',
        ]);

        $requestDonasi = Request_Donasi::findOrFail($id);

        $requestDonasi->update([
            'ID_ORGANISASI' => session('user_id'), // asumsikan login sebagai organisasi
            'DESKRIPSI_REQUEST' => $validated['DESKRIPSI_REQUEST'],
            'NAMA_BARANG' => $validated['NAMA_BARANG'], // jika ada
            'TANGGAL_REQUEST' => now(),
            'STATUS_REQUEST' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Data Request berhasil diupdate.');
    }

    // Menghapus Request Donasi
    public function destroy($id)
    {
        $requestDonasi = Request_Donasi::findOrFail($id);
        $requestDonasi->delete();

        return redirect()->back()->with('success', 'Data Request berhasil dihapus.');
    }
}
