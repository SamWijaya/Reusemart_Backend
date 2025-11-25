<?php

// app/Http/Controllers/ProdukController.php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Tampilkan semua barang
    public function index()
    {
        $produk = Barang::all();
        return view('halamanUmum', compact('produk'));
    }

    // Tampilkan form tambah barang
    public function create()
    {
        return view('produk.create');
    }

    // Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'NAMA_BARANG' => 'required',
            'HARGA_BARANG' => 'required|numeric',
            'DESKRIPSI_BARANG' => 'required',
            'GARANSI' => 'nullable|string',
            'BERAT' => 'required|numeric',
            'KATEGORI_BARANG' => 'required',
            'STATUS_BARANG' => 'required',
            'ID_PENITIPAN' => 'required',
            'ID_PEGAWAI' => 'required',
        ]);

        Barang::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan detail satu barang
    public function show($id)
    {
        $produk = Barang::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $produk = Barang::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // Simpan perubahan data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_BARANG' => 'required',
            'HARGA_BARANG' => 'required|numeric',
            'DESKRIPSI_BARANG' => 'required',
            'GARANSI' => 'nullable|string',
            'BERAT' => 'required|numeric',
            'KATEGORI_BARANG' => 'required',
            'STATUS_BARANG' => 'required',
            'ID_PENITIPAN' => 'required',
            'ID_PEGAWAI' => 'required',
        ]);

        $produk = Barang::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    // Hapus data barang
    public function destroy($id)
    {
        $produk = Barang::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
