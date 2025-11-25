<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pembeli;
use App\Models\Alamat;
use App\Models\Pembelian;
use App\Models\DetailPembelian;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PembelianWebController extends Controller
{
    public function index()
    {
        $id_pembeli = session('user_id');
        $pembeli = Pembeli::find($id_pembeli);

        // Ambil keranjang user
        $keranjang = Keranjang::with('barang')
            ->where('ID_PEMBELI', $id_pembeli)
            ->whereHas('barang', function ($query) {
                $query->where('STATUS_BARANG', 'Tersedia');
            })
            ->get();

        $alamatList = Alamat::where('ID_PEMBELI', $id_pembeli)->orderByDesc('IS_DEFAULT')->get();

        // Hitung subtotal
        $subtotal = $keranjang->sum(function ($item) {
            $barang = $item->barang;
            return ($barang && $barang->STATUS_BARANG === 'Tersedia') ? $barang->HARGA_BARANG : 0;
        });

        // Ambil poin user (jika pakai poin)
        $poin = Pembeli::find($id_pembeli)?->POIN_PEMBELI ?? 0;

        return view('checkout', [
            'keranjang' => $keranjang,
            'subtotal' => $subtotal,
            'poin' => $poin,
            'alamat' => $alamatList,
            'pembeli' => $pembeli
        ]);
    }

    public function indexForVerif()
    {
        $pembelianList = Pembelian::whereNotNull('BUKTI_PEMBAYARAN')->get();
        return view('CSVerifikasi', compact('pembelianList'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ID_ALAMAT' => 'nullable|exists:alamat,ID_ALAMAT',
            'METODE_PENGIRIMAN' => 'required|boolean',
            'POIN_DIGUNAKAN' => 'required|integer|min:0',
            'SUBTOTAL' => 'required|numeric|min:0',
            'TOTAL_BAYAR' => 'required|numeric|min:0',
            'POIN_DIDAPAT' => 'required|integer|min:0',
        ]);

        $user = session('user_id');
        $keranjang = Keranjang::where('ID_PEMBELI', $user)->get();

        $pembelian = Pembelian::create([
            'ID_PEMBELI' => $user,
            'ID_ALAMAT' => $validated['METODE_PENGIRIMAN'] ? $validated['ID_ALAMAT'] : null,
            'ID_PEGAWAI' => null,
            'TANGGAL_PEMBELIAN' => Carbon::now(),
            'TANGGAL_LUNAS' => null,
            'BATAS_PENGAMBILAN' => null,
            'TANGGAL_PENGIRIMAN' => null,
            'TANGGAL_DITERIMA' => null,
            'SUBTOTAL' => $validated['SUBTOTAL'],
            'TOTAL_BAYAR' => $validated['TOTAL_BAYAR'],
            'STATUS_PEMBAYARAN' => "pending",
            'POIN_DIGUNAKAN' => $validated['POIN_DIGUNAKAN'],
            'POIN_DIDAPAT' => $validated['POIN_DIDAPAT'],
            'METODE_PENGIRIMAN' => (bool) $validated['METODE_PENGIRIMAN'],
            'BUKTI_PEMBAYARAN' => null,
            'STATUS_PENGIRIMAN' => null,
            'STATUS_PENGAMBILAN' => null,
            'KOMISI_REUSEMART' => null,
            'KOMISI_HUNTER' => 0,
            'BONUS_PENITIP' => 0,
        ]);

        $pembeli = Pembeli::where('ID_PEMBELI', $user)->first();
        if ($pembeli) {
            $pembeli->POIN_PEMBELI += ($validated['POIN_DIDAPAT'] - $validated['POIN_DIGUNAKAN']);
            $pembeli->save();
        }

        // Redirect ke halaman konfirmasi
        return redirect()->route('konfirmasi.pembayaran', ['id' => $pembelian->ID_PEMBELIAN]);

    }

    public function konfirmasi($id)
    {
        $pembelian = Pembelian::find($id);
        return view('konfirmasiPembayaran', compact('pembelian'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'BUKTI_PEMBAYARAN' => 'required|mimes:jpg,jpeg,png|max:5120', // 5MB
        ]);

        $pembelian = Pembelian::findOrFail($id);
        $id_pembeli = $pembelian->ID_PEMBELI;
        $keranjang = Keranjang::where('ID_PEMBELI', $id_pembeli)->get();

        foreach ($keranjang as $item) {
            $item->STATUS_KERANJANG = false;
            $barang = $item->barang;
            $item->save();

            $barang->STATUS_BARANG = 'Terjual';
            $barang->save();
        }

        // Simpan file ke folder storage/app/public/bukti_pembayaran
        if ($request->hasFile('BUKTI_PEMBAYARAN')) {
            $pembelian->BUKTI_PEMBAYARAN = $request->file('BUKTI_PEMBAYARAN')->store('bukti_pembayaran', 'public');
            $pembelian->save();
        }

        return redirect()->route('halamanPembeli')->with('payment_success', true);
    }

    public function batalBeli($id)
    {
        // Cari data pembelian
        $pembelian = Pembelian::findOrFail($id);

        // Ambil pembeli terkait
        $pembeli = $pembelian->pembeli;

        // Kembalikan poin yang digunakan dan kurangi poin yang didapat
        if ($pembeli) {
            $pembeli->POIN_PEMBELI = $pembeli->POIN_PEMBELI + $pembelian->POIN_DIGUNAKAN - $pembelian->POIN_DIDAPAT;
            $pembeli->save();
        }

        // Update status pembelian menjadi batal
        $pembelian->STATUS_PEMBAYARAN = 'batal';
        $pembelian->save();

        // Redirect ke halaman pembeli
        return redirect()->route('halamanPembeli')->with('success', 'Pembelian dibatalkan dan poin dikembalikan.');
    }



    public function verifikasi($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $id_pembeli = $pembelian->ID_PEMBELI;
        $keranjang = Keranjang::where('ID_PEMBELI', $id_pembeli)->get();

        $pembelian->STATUS_PEMBAYARAN = 'verified';
        $pembelian->TANGGAL_LUNAS = now();

        if ($pembelian->METODE_PENGIRIMAN) {
            $pembelian->STATUS_PENGIRIMAN = 'Disiapkan';
        } else {
            $pembelian->STATUS_PENGAMBILAN = 'Belum Diambil';
        }

        foreach ($keranjang as $item) {
            DetailPembelian::create([
                'ID_PEMBELIAN' => $pembelian->ID_PEMBELIAN,
                'ID_BARANG' => $item->ID_BARANG,
            ]);
        }

        foreach ($keranjang as $item) {
            $barang = $item->barang;
            $barang->STATUS_BARANG = 'Terjual';
            $barang->save();
        }

        Keranjang::where('ID_PEMBELI', $id_pembeli)->delete();

        $pembelian->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function tolak($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $id_pembeli = $pembelian->ID_PEMBELI;
        $keranjang = Keranjang::where('ID_PEMBELI', $id_pembeli)->get();

        $pembelian->STATUS_PEMBAYARAN = 'rejected';

        if ($pembelian->METODE_PENGIRIMAN) {
            $pembelian->STATUS_PENGIRIMAN = '-';
        } else {
            $pembelian->STATUS_PENGAMBILAN = '-';
        }

        foreach ($keranjang as $item) {
            $barang = $item->barang;

            $barang->STATUS_BARANG = 'Tersedia';
            $barang->save();
        }

        Keranjang::where('ID_PEMBELI', $id_pembeli)->delete();

        $pembelian->save();

        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }

    public function jadwalkan(Request $request)
    {
        $request->validate([
            'ID_PEGAWAI' => 'required|exists:pegawai,ID_PEGAWAI',
            'ID_PEMBELIAN' => 'required|exists:pembelian,ID_PEMBELIAN',
        ]);

        $pembelian = Pembelian::findOrFail($request->ID_PEMBELIAN);

        $waktuPembelian = Carbon::parse($pembelian->TANGGAL_PEMBELIAN);

        // Tentukan TANGGAL_PENGIRIMAN otomatis
        if ($waktuPembelian->format('H:i') > '16:00') {
            $tanggalPengiriman = Carbon::tomorrow();
        } else {
            $tanggalPengiriman = Carbon::now();
        }

        $pembelian->TANGGAL_PENGIRIMAN = $tanggalPengiriman;
        $pembelian->ID_PEGAWAI = $request->ID_PEGAWAI;
        $pembelian->STATUS_PENGIRIMAN = 'Dikirim';
        $pembelian->save();

        return redirect()->route('jadwal.kirim')->with('success', 'Pengiriman berhasil dijadwalkan.');
    }

    public function jadwalkanPengambilan(Request $request)
    {
        $pembelian = Pembelian::findOrFail($request->ID_PEMBELIAN);

        $tanggalPembelian = Carbon::parse($pembelian->TANGGAL_PEMBELIAN);

        // Cek apakah sebelum atau sesudah jam 16:00
        if ($tanggalPembelian->hour < 16) {
            $batasAmbil = $tanggalPembelian->copy()->addDay();
        } else {
            $batasAmbil = $tanggalPembelian->copy()->addDays(2);
        }

        $pembelian->BATAS_PENGAMBILAN = $batasAmbil;
        $pembelian->save();

        return redirect()->back()->with('success', 'Pengambilan telah dijadwalkan.');
    }

    public function konfirmasiPengambilan($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $detail = $pembelian->detailPembelian;
        $jumlahPoin = $pembelian->POIN_DIDAPAT - $pembelian->POIN_DIGUNAKAN;

        // Tambahkan poin ke pembeli
        if ($pembelian->pembeli) {
            $pembelian->pembeli->POIN_PEMBELI += $jumlahPoin;
            $pembelian->pembeli->save();
        }

        $totalKomisiMart = 0;

        foreach ($detail as $item) {
            $barang = $item->barang;
            $penitipan = $barang->penitipan;
            $penitip = $penitipan->penitip;
            $hunter = $penitipan->hunter;
            $harga = $barang->HARGA_BARANG;

            // Tandai barang terjual
            $barang->STATUS_BARANG = 'Terjual';
            $barang->save();

            // Hitung durasi dari penitipan ke pembelian
            $tanggalPenitipan = Carbon::parse($penitipan->TANGGAL_PENITIPAN);
            $tanggalPembelian = Carbon::parse($pembelian->TANGGAL_PEMBELIAN);
            $durasiHari = $tanggalPenitipan->diffInDays($tanggalPembelian);

            $komisiHunter = 0;
            $komisiReUseMart = 0;
            $bonusPenitip = 0;

            if ($penitipan->STATUS_PERPANJANGAN) {
                // Barang sudah diperpanjang
                if ($hunter) {
                    $komisiHunter = $harga * 0.05;
                    $komisiReUseMart = $harga * 0.25;
                } else {
                    $komisiReUseMart = $harga * 0.30;
                }
            } else {
                // Barang belum diperpanjang
                if ($hunter) {
                    $komisiHunter = $harga * 0.05;
                    $komisiReUseMart = $harga * 0.15;
                } else {
                    $komisiReUseMart = $harga * 0.20;
                }

                // Cek bonus: laku < 7 hari
                if ($durasiHari < 7) {
                    $bonusPenitip = $komisiReUseMart * 0.10;
                }
            }

            // Total komisi ReUseMart untuk semua barang
            $totalKomisiMart += $komisiReUseMart;

            // Komisi Penitip selalu 80% + bonus jika berlaku
            $penitip->SALDO_PENITIP += ($harga * 0.80) + $bonusPenitip;
            $penitip->save();

            if ($hunter && $komisiHunter > 0) {
                $hunter->SALDO_HUNTER += $komisiHunter;
                $hunter->save();
            }
        }

        // Update status pembelian dan komisi ReUseMart
        $pembelian->TANGGAL_DITERIMA = Carbon::now();
        $pembelian->STATUS_PENGAMBILAN = 'Sudah Diambil';
        $pembelian->STATUS_PEMBAYARAN = 'selesai';
        $pembelian->KOMISI_REUSEMART = $totalKomisiMart;
        $pembelian->KOMISI_HUNTER = $komisiHunter;
        $pembelian->BONUS_PENITIP = $bonusPenitip;
        $pembelian->save();

        return redirect()->back()->with('success', 'Pengambilan telah dikonfirmasi.');
    }


    public function cetakPembelian($id)
    {

        $pembelian = Pembelian::find($id);
        $barangList = DetailPembelian::with('barang')->where('ID_PEMBELIAN', $id)->get();

        $pdf = Pdf::loadView('pdf.nota_pembelian', compact('pembelian', 'barangList'));

        $namaFile = 'Nota_Pembelian_' . $pembelian->ID_PEMBELIAN . '.pdf';
        return $pdf->download($namaFile);
    }

    public function historyPembelian(Request $request)
    {
        $pembeliId = session('user_id');

        $query = DB::table('pembelian')
            ->join('detailpembelian', 'pembelian.ID_PEMBELIAN', '=', 'detailpembelian.ID_PEMBELIAN')
            ->join('barang', 'detailpembelian.ID_BARANG', '=', 'barang.ID_BARANG')
            ->leftJoin('rating', function ($join) use ($pembeliId) {
                $join->on('rating.ID_BARANG', '=', 'barang.ID_BARANG')
                    ->where('rating.ID_PEMBELI', '=', $pembeliId);
            })
            ->select(
                'barang.ID_BARANG',
                'barang.NAMA_BARANG',
                'barang.HARGA_BARANG',
                'barang.GAMBAR_1',
                'pembelian.TANGGAL_PEMBELIAN',
                DB::raw("CASE
                WHEN pembelian.STATUS_PENGIRIMAN IS NOT NULL THEN
                    CASE 
                        WHEN pembelian.STATUS_PENGIRIMAN = 'Dikirim' THEN 'Dikirim'
                        WHEN pembelian.STATUS_PENGIRIMAN = 'Selesai' THEN 'Diterima'
                        ELSE pembelian.STATUS_PENGIRIMAN
                    END
                ELSE
                    CASE
                        WHEN pembelian.STATUS_PENGAMBILAN = 'Belum Diambil' THEN 'Belum Diambil'
                        WHEN pembelian.STATUS_PENGAMBILAN = 'Sudah Diambil' THEN 'Diterima'
                        ELSE pembelian.STATUS_PENGAMBILAN
                    END
            END AS status_barang"),
                'rating.JUMLAH_BINTANG'
            )
            ->where('pembelian.ID_PEMBELI', $pembeliId);

        // ✅ Filter: Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('pembelian.TANGGAL_PEMBELIAN', $request->tahun);
        }

        // ✅ Filter: Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('pembelian.TANGGAL_PEMBELIAN', $request->bulan);
        }

        // ✅ Filter: Nama Barang
        if ($request->filled('nama')) {
            $query->where('barang.NAMA_BARANG', 'like', '%' . $request->nama . '%');
        }

        $items = $query->orderByDesc('pembelian.TANGGAL_PEMBELIAN')->get();

        return view('historyPembelian', compact('items'));
    }

}
