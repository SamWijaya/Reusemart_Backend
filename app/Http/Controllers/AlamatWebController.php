<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use App\Models\Alamat;

class AlamatWebController extends Controller
{
    public function store(Request $request)
    {
        $pembeliId = session('user_id');

        $validated = $request->validate([
            'LABEL_ALAMAT' => 'required|string|max:255',
            'NAMA_JALAN' => 'required|string|max:100',
            'KECAMATAN' => 'required|string|max:255',
            'KELURAHAN' => 'required|string|max:255',
            'KOTA' => 'required|string|max:255',
            'KODE_POS' => 'required|string|max:255',

        ]);

        // Tambahkan nilai otomatis
        $validated['ID_PEMBELI'] = $pembeliId;

        // Cek apakah pembeli sudah memiliki alamat
        $hasAlamat = Alamat::where('ID_PEMBELI', $pembeliId)->exists();
        $validated['IS_DEFAULT'] = $hasAlamat ? 0 : 1;

        Alamat::create($validated);
        return redirect()->back()->with('success', 'Data Alamat berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $alamat = Alamat::findOrFail($id);

        $validated = $request->validate([
            'LABEL_ALAMAT' => 'required|string|max:255',
            'NAMA_JALAN' => 'required|string|max:100',
            'KECAMATAN' => 'required|string|max:255',
            'KELURAHAN' => 'required|string|max:255',
            'KOTA' => 'required|string|max:255',
            'KODE_POS' => 'required|string|max:255',
        ]);

        $alamat->update($validated);

        return redirect()->back()->with('success', 'Data Alamat berhasil dibuat.');
    }

    public function setDefault($id)
    {
        $alamat = Alamat::findOrFail($id);
        $pembeliId = $alamat->ID_PEMBELI;

        // Set semua alamat pembeli menjadi IS_DEFAULT = 0
        Alamat::where('ID_PEMBELI', $pembeliId)->update(['IS_DEFAULT' => 0]);

        // Set alamat ini menjadi default
        $alamat->update(['IS_DEFAULT' => 1]);

        return redirect()->back()->with('success', 'Data Alamat berhasil dibuat.');
    }

    public function destroy($id)
    {
        $alamat = Alamat::findOrFail($id);
        $pembeliId = $alamat->ID_PEMBELI;
        $wasDefault = $alamat->IS_DEFAULT;

        $alamat->delete();

        // Jika yang dihapus adalah alamat default, set salah satu alamat lain sebagai default
        if ($wasDefault) {
            $alamatLain = Alamat::where('ID_PEMBELI', $pembeliId)->first();
            if ($alamatLain) {
                $alamatLain->update(['IS_DEFAULT' => 1]);
            }
        }

        return redirect()->back()->with('success', 'Data Alamat berhasil dibuat.');
    }


}
