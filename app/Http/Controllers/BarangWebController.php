<?php

namespace App\Http\Controllers;

use App\Models\Penitipan;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Diskusi;

use Carbon\Carbon;

class BarangWebController extends Controller
{
    public function index()
    {
        $products = Barang::all(); // atau bisa disesuaikan dengan relasi kategori
        return view('halamanUmum', compact('products'));
    }

    public function show($id)
    {
        $produk = Barang::findOrFail($id);
        $discussions = Diskusi::where('ID_BARANG', $id)->with('pembeli')->get();
        return view('detailProduk', compact('produk', 'discussions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_PENITIPAN' => 'required|integer',
            'NAMA_BARANG' => 'required|string',
            'HARGA_BARANG' => 'required|integer',
            'GAMBAR_1' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'GAMBAR_2' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'GAMBAR_3' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'KATEGORI_BARANG' => 'required|string',
            'BERAT' => 'required|numeric',
            'DESKRIPSI_BARANG' => 'nullable|string',
            'GARANSI' => 'nullable|date',
            // Tidak perlu validasi STATUS_BARANG, akan diisi otomatis
        ]);

        $data = $request->all();

        // Upload gambar
        if ($request->hasFile('GAMBAR_1')) {
            $data['GAMBAR_1'] = $request->file('GAMBAR_1')->store('barang', 'public');
        }
        if ($request->hasFile('GAMBAR_2')) {
            $data['GAMBAR_2'] = $request->file('GAMBAR_2')->store('barang', 'public');
        }
        if ($request->hasFile('GAMBAR_3')) {
            $data['GAMBAR_3'] = $request->file('GAMBAR_3')->store('barang', 'public');
        }

        // Set status default
        $data['STATUS_BARANG'] = 'Tersedia';

        Barang::create($data);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_BARANG' => 'required|string|max:50',
            'HARGA_BARANG' => 'required|integer|min:0',
            'KATEGORI_BARANG' => 'required|string|max:50',
            'BERAT' => 'required|numeric|min:0',
            'DESKRIPSI_BARANG' => 'nullable|string|max:100',
            'GARANSI' => 'nullable|date',
            'GAMBAR_1' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'GAMBAR_2' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
            'GAMBAR_3' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->NAMA_BARANG = $request->NAMA_BARANG;
        $barang->HARGA_BARANG = $request->HARGA_BARANG;
        $barang->KATEGORI_BARANG = $request->KATEGORI_BARANG;
        $barang->BERAT = $request->BERAT;
        $barang->DESKRIPSI_BARANG = $request->DESKRIPSI_BARANG;
        $barang->GARANSI = $request->GARANSI;

        // Handle upload gambar baru jika ada
        if ($request->hasFile('GAMBAR_1')) {
            $barang->GAMBAR_1 = $request->file('GAMBAR_1')->store('barang', 'public');
        }
        if ($request->hasFile('GAMBAR_2')) {
            $barang->GAMBAR_2 = $request->file('GAMBAR_2')->store('barang', 'public');
        }
        if ($request->hasFile('GAMBAR_3')) {
            $barang->GAMBAR_3 = $request->file('GAMBAR_3')->store('barang', 'public');
        }

        $barang->save();

        return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
    }

    public function perpanjang($id)
    {
        $penitipan = Penitipan::findOrFail($id);

        // Tambah 30 hari dari tanggal berakhir saat ini

        $penitipan->STATUS_PERPANJANGAN = true;
        $penitipan->TANGGAL_BERAKHIR = Carbon::parse($penitipan->TANGGAL_BERAKHIR)->addDays(30);
        $penitipan->BATAS_AMBIL = Carbon::parse($penitipan->TANGGAL_BERAKHIR)->copy()->addDays(7);
        $penitipan->save();

        return back()->with('success', 'Tanggal berakhir berhasil diperpanjang 30 hari.');
    }

    public function ambil($id)
    {
        $penitipan = Penitipan::findOrFail($id);


        $penitipan->IS_AMBIL = true;
        $penitipan->save();

        return back()->with('success', 'Konfirmasi Pengambilan berhasil.');
    }

    public function konfirmasiAmbil($id)
    {
        $penitipan = Penitipan::findOrFail($id);
        $penitipan->STATUS_AMBIL_KEMBALI = true;

        Barang::where('ID_PENITIPAN', $id)
            ->where('STATUS_BARANG', 'Tersedia') // hanya barang yang statusnya 'Tersedia'
            ->update(['STATUS_BARANG' => 'Diambil']);

        $penitipan->save();

        return redirect()->back()->with('success', 'Pengambilan telah dikonfirmasi.');
    }
}
