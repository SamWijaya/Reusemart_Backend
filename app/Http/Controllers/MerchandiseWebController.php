<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\PenukaranPoin;
use Illuminate\Http\Request;

class MerchandiseWebController extends Controller
{
    public function index()
    {
        $merchList = Merchandise::all();
        return view('admin.adminForMerchandise', compact('merchList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA_MERCHANDISE' => 'required',
            'STOK_MERCHANDISE' => 'required|integer',
            'POIN_DIPERLUKAN' => 'required|integer',
            'GAMBAR_MERCHANDISE' => 'required|image|mimes:jpg,jpeg,png|max:5096',
        ]);

        $file = $request->file('GAMBAR_MERCHANDISE')->store('merchandise', 'public');

        Merchandise::create([
            'NAMA_MERCHANDISE' => $request->NAMA_MERCHANDISE,
            'STOK_MERCHANDISE' => $request->STOK_MERCHANDISE,
            'POIN_DIPERLUKAN' => $request->POIN_DIPERLUKAN,
            'GAMBAR_MERCHANDISE' => $file,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $merch = Merchandise::findOrFail($id);

        $merch->NAMA_MERCHANDISE = $request->NAMA_MERCHANDISE;
        $merch->STOK_MERCHANDISE = $request->STOK_MERCHANDISE;
        $merch->POIN_DIPERLUKAN = $request->POIN_DIPERLUKAN;

        // hanya update gambar jika file diupload
        if ($request->hasFile('GAMBAR_MERCHANDISE')) {
            // hapus gambar lama jika ada
            if ($merch->GAMBAR_MERCHANDISE && \Storage::disk('public')->exists($merch->GAMBAR_MERCHANDISE)) {
                \Storage::disk('public')->delete($merch->GAMBAR_MERCHANDISE);
            }

            $file = $request->file('GAMBAR_MERCHANDISE');
            $filename = $file->store('merchandise', 'public'); // disimpan di storage/app/public/merchandise
            $merch->GAMBAR_MERCHANDISE = $filename;
        }

        $merch->save();

        return redirect()->route('merch.index')->with('success', 'Data merchandise berhasil diupdate.');
    }


    public function destroy($id)
    {
        Merchandise::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function penukaranList()
    {
        $merchList = PenukaranPoin::all();
        return view('CSForMerch', compact('merchList'));
    }

}
