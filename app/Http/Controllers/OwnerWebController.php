<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penitip;
use App\Models\Request_Donasi;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerWebController extends Controller
{
    public function index()
    {
        $reqList = Request_Donasi::with('organisasi')->get();
        $barangList = Barang::where('STATUS_BARANG', 'barang untuk donasi')->get();

        return view('owner', compact('reqList', 'barangList'));
    }

    public function historyDonasi()
    {
        $donasiList = Donasi::with(['requestDonasi.organisasi', 'barang'])->get();
        return view('ownerHistoryDonasi', compact('donasiList'));
    }

    public function penitipanHabis()
    {
        $now = Carbon::now();

        $barangList = Barang::whereHas('penitipan', function ($query) use ($now) {
            $query->where('TANGGAL_BERAKHIR', '<', $now);
        })
            ->where('STATUS_BARANG', '!=', 'Terjual')
            ->get();
        return view('ownerBarangEnd', compact('barangList'));
    }

    public function transaksiPenitip()
    {
        $penitip = Penitip::all();
        return view('ownerTransaksiPenitip', compact('penitip'));
    }

    public function penjualanPerKategori()
    {
        $kategoriList = [
            'Elektronik & Gadget',
            'Pakaian & Aksesori',
            'Perabotan Rumah Tangga',
            'Buku, Alat Tulis, & Peralatan Sekolah',
            'Hobi, Mainan, & Koleksi',
            'Perlengkapan Bayi & Anak',
            'Otomotif & Aksesori',
            'Perlengkapan Taman & Outdoor',
            'Peralatan Kantor & Industri',
            'Kosmetik & Perawatan Diri'
        ];

        $tahun = request('tahun', date('Y'));
        $data = [];

        foreach ($kategoriList as $kategori) {
            $barangs = Barang::where('KATEGORI_BARANG', $kategori)
                ->whereHas('penitipan', function ($query) use ($tahun) {
                    $query->whereYear('TANGGAL_PENITIPAN', $tahun);
                })
                ->get();

            $terjual = $barangs->where('STATUS_BARANG', 'Terjual')->count();
            $gagal = $barangs->whereIn('STATUS_BARANG', ['Tersedia', 'barang untuk donasi', 'Terdonasi', 'Diambil'])->count();

            $data[$kategori] = [
                'terjual' => $terjual,
                'gagal' => $gagal,
            ];
        }

        return view('ownerKategoriBarang', [
            'kategoriData' => $data,
            'tahun' => $tahun,
        ]);
    }

    public function cetakNotaKategori(Request $request)
    {
        $kategoriList = [
            'Elektronik & Gadget',
            'Pakaian & Aksesori',
            'Perabotan Rumah Tangga',
            'Buku, Alat Tulis, & Peralatan Sekolah',
            'Hobi, Mainan, & Koleksi',
            'Perlengkapan Bayi & Anak',
            'Otomotif & Aksesori',
            'Perlengkapan Taman & Outdoor',
            'Peralatan Kantor & Industri',
            'Kosmetik & Perawatan Diri'
        ];

        $tahun = $request->get('tahun', date('Y'));

        $data = [];

        foreach ($kategoriList as $kategori) {
            $barangs = Barang::where('KATEGORI_BARANG', $kategori)
                ->whereHas('penitipan', function ($query) use ($tahun) {
                    $query->whereYear('TANGGAL_PENITIPAN', $tahun);
                })
                ->get();

            $terjual = $barangs->where('STATUS_BARANG', 'Terjual')->count();
            $gagal = $barangs->whereIn('STATUS_BARANG', ['Tersedia', 'barang untuk donasi', 'Terdonasi', 'Diambil'])->count();

            $data[$kategori] = [
                'terjual' => $terjual,
                'gagal' => $gagal,
            ];
        }

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaPerKategori', [
            'kategoriData' => $data,
            'tahun' => $tahun,
            'tanggalCetak' => $tanggalCetak,
        ]);

        return $pdf->download('Laporan-Penjualan-Kategori-Barang.pdf');
    }

    public function cetakBarangEnd()
    {
        $now = Carbon::now();

        $barangList = Barang::whereHas('penitipan', function ($query) use ($now) {
            $query->where('TANGGAL_BERAKHIR', '<', $now);
        })
            ->where('STATUS_BARANG', '!=', 'Terjual')
            ->get();

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
        $pdf = Pdf::loadView('pdf.notaBarangEnd', [
            'tanggalCetak' => $tanggalCetak,
            'barangList' => $barangList,
        ]);

        return $pdf->download('Laporan-Penitipan-Habis-Barang.pdf');
    }


    public function cetakHistoryDonasi()
    {
        $tahun = date('Y');
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $donasiList = Donasi::with(['requestDonasi.organisasi', 'barang'])->get();
        $pdf = Pdf::loadView('pdf.notaDonasiBarang', [
            'tahun' => $tahun,
            'tanggalCetak' => $tanggalCetak,
            'donasiList' => $donasiList,
        ]);

        return $pdf->download('Laporan-History-Donasi-Barang.pdf');
    }

    public function cetakReqDonasi()
    {
        $reqList = Request_Donasi::with('organisasi')
            ->where('STATUS_REQUEST', 'menunggu')
            ->get();
        $barangList = Barang::where('STATUS_BARANG', 'barang untuk donasi')->get();
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaRequestDonasi', [
            'tanggalCetak' => $tanggalCetak,
            'reqList' => $reqList,
            'barangList' => $barangList,
        ]);

        return $pdf->download('Laporan-Req-Donasi-Barang.pdf');
    }

    public function cetakTransaksiPenitip($id)
    {
        $penitip = Penitip::findOrFail($id);
        $tahun = date('Y');
        $bulan = Carbon::now()->locale('id')->isoFormat('MMMM');

        // Ambil semua barang penitip yang sudah terjual (ada relasi ke pembelian)
        $barangList = Barang::where('STATUS_BARANG', 'Terjual')
            ->whereHas('penitipan', function ($query) use ($id) {
                $query->where('ID_PENITIP', $id);
            })
            ->whereHas('pembelian')
            ->with(['penitipan', 'pembelian'])
            ->get();



        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('pdf.notaTransaksiPenitip', compact('penitip', 'barangList', 'tanggalCetak', 'tahun', 'bulan'));

        return $pdf->download('Laporan-Transaksi-Penitip-' . $penitip->NAMA_PENITIP . '.pdf');
    }

    public function laporanBulanan(Request $request)
    {
        $allMonths = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $tahunDipilih = $request->input('tahun', date('Y'));

        $data = DB::table('pembelian')
            ->join('detailpembelian', 'pembelian.ID_PEMBELIAN', '=', 'detailpembelian.ID_PEMBELIAN')
            ->join('barang', 'detailpembelian.ID_BARANG', '=', 'barang.ID_BARANG')
            ->select(
                DB::raw("MONTH(TANGGAL_PEMBELIAN) as bulan"),
                DB::raw("COUNT(detailpembelian.ID_DETAIL) as jumlah_terjual"),
                DB::raw("SUM(barang.HARGA_BARANG) as total_penjualan")
            )
            ->whereIn('pembelian.STATUS_PEMBAYARAN', ['verified', 'selesai', 'hangus'])
            ->whereYear('TANGGAL_PEMBELIAN', $tahunDipilih)
            ->groupBy(DB::raw("MONTH(TANGGAL_PEMBELIAN)"))
            ->orderBy(DB::raw("MONTH(TANGGAL_PEMBELIAN)"))
            ->get()
            ->keyBy('bulan');

        $laporan = [];
        $total_terjual = 0;
        $total_penjualan = 0;

        foreach ($allMonths as $num => $nama) {
            $bulanInt = (int) $num;
            $jumlah_terjual = $data->has($bulanInt) ? $data[$bulanInt]->jumlah_terjual : 0;
            $penjualan = $data->has($bulanInt) ? $data[$bulanInt]->total_penjualan : 0;

            $laporan[] = [
                'bulan' => $nama,
                'jumlah_terjual' => $jumlah_terjual,
                'total_penjualan' => $penjualan,
            ];

            $total_terjual += $jumlah_terjual;
            $total_penjualan += $penjualan;
        }

        return view('ownerLaporanBulanan', compact('laporan', 'total_terjual', 'total_penjualan', 'tahunDipilih'));
    }

    public function cetakLaporanBulanan(Request $request)
    {
        $allMonths = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $tahunDipilih = $request->input('tahun', date('Y'));

        $data = DB::table('pembelian')
            ->join('detailpembelian', 'pembelian.ID_PEMBELIAN', '=', 'detailpembelian.ID_PEMBELIAN')
            ->join('barang', 'detailpembelian.ID_BARANG', '=', 'barang.ID_BARANG')
            ->select(
                DB::raw("MONTH(TANGGAL_PEMBELIAN) as bulan"),
                DB::raw("COUNT(detailpembelian.ID_DETAIL) as jumlah_terjual"),
                DB::raw("SUM(barang.HARGA_BARANG) as total_penjualan")
            )
            ->whereIn('pembelian.STATUS_PEMBAYARAN', ['verified', 'selesai', 'hangus'])
            ->whereYear('TANGGAL_PEMBELIAN', $tahunDipilih)
            ->groupBy(DB::raw("MONTH(TANGGAL_PEMBELIAN)"))
            ->orderBy(DB::raw("MONTH(TANGGAL_PEMBELIAN)"))
            ->get()
            ->keyBy('bulan');

        $laporan = [];
        $total_terjual = 0;
        $total_penjualan = 0;
        $tahun = date('Y');
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        foreach ($allMonths as $num => $nama) {
            $bulanInt = (int) $num;
            $jumlah_terjual = $data->has($bulanInt) ? $data[$bulanInt]->jumlah_terjual : 0;
            $penjualan = $data->has($bulanInt) ? $data[$bulanInt]->total_penjualan : 0;

            $laporan[] = [
                'bulan' => $nama,
                'jumlah_terjual' => $jumlah_terjual,
                'total_penjualan' => $penjualan,
            ];

            $total_terjual += $jumlah_terjual;
            $total_penjualan += $penjualan;
        }

        // Generate grafik dengan QuickChart
        $chartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => array_column($laporan, 'bulan'),
                'datasets' => [
                    [
                        'label' => 'Penjualan Kotor (Rp)',
                        'data' => array_column($laporan, 'total_penjualan'),
                        'backgroundColor' => 'rgba(75, 192, 192, 0.7)'
                    ]
                ]
            ],
            'options' => [
                'plugins' => ['legend' => ['display' => false]],
                'scales' => ['y' => ['beginAtZero' => true]]
            ]
        ];

        // Ambil gambar dari QuickChart
        $chartUrlExternal = 'https://quickchart.io/chart?width=700&height=300&format=png&c=' . urlencode(json_encode($chartConfig));
        $chartFilename = Str::uuid() . '.png';
        $chartContent = file_get_contents($chartUrlExternal);
        if ($chartContent === false) {
            dd('Gagal mengambil chart dari QuickChart');
        }

        // Simpan ke storage/app/public/charts/
        Storage::disk('public')->put($chartFilename, $chartContent);

        // Akses URL file yang tersimpan
        $chartUrl = asset('storage/' . $chartFilename);


        // Generate PDF
        $pdf = Pdf::loadView('pdf.laporanBulanan', compact(
            'laporan',
            'total_terjual',
            'total_penjualan',
            'tahunDipilih',
            'tanggalCetak',
            'chartFilename'
        ));

        return $pdf->download('Laporan-Penjualan-Bulanan' . $tahunDipilih . '.pdf');
    }

    public function laporanKomisi()
    {
        $bulan = 6; // Juni
        $tahun = 2025;

        $data = DB::table('pembelian')
            ->join('detailpembelian', 'pembelian.ID_PEMBELIAN', '=', 'detailpembelian.ID_PEMBELIAN')
            ->join('barang', 'detailpembelian.ID_BARANG', '=', 'barang.ID_BARANG')
            ->join('penitipan', 'barang.ID_PENITIPAN', '=', 'penitipan.ID_PENITIPAN')
            ->select(
                'barang.ID_BARANG as kode_produk',
                'barang.NAMA_BARANG as nama_produk',
                'barang.HARGA_BARANG as harga_jual',
                'penitipan.TANGGAL_PENITIPAN as tanggal_masuk',
                'pembelian.TANGGAL_PEMBELIAN as tanggal_laku',
                'pembelian.KOMISI_HUNTER',
                'pembelian.KOMISI_REUSEMART',
                'pembelian.BONUS_PENITIP'
            )
            ->whereIn('pembelian.STATUS_PEMBAYARAN', ['verified', 'selesai'])
            ->whereMonth('pembelian.TANGGAL_PEMBELIAN', $bulan)
            ->whereYear('pembelian.TANGGAL_PEMBELIAN', $tahun)
            ->get();

        return view('ownerLaporanKomisi', compact('data', 'bulan', 'tahun'));
    }

    public function laporanGudang()
    {
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $data = DB::table('barang')
            ->join('penitipan', 'barang.ID_PENITIPAN', '=', 'penitipan.ID_PENITIPAN')
            ->join('penitip', 'penitipan.ID_PENITIP', '=', 'penitip.ID_PENITIP')
            ->leftJoin('hunter', 'penitipan.ID_HUNTER', '=', 'hunter.ID_HUNTER')
            ->select(
                'barang.ID_BARANG as kode_produk',
                'barang.NAMA_BARANG as nama_produk',
                'penitip.ID_PENITIP',
                'penitip.NAMA_PENITIP',
                'penitipan.TANGGAL_PENITIPAN as tanggal_masuk',
                'penitipan.STATUS_PERPANJANGAN as perpanjangan',
                'hunter.ID_HUNTER',
                'hunter.NAMA_HUNTER',
                'barang.HARGA_BARANG as harga'
            )
            ->where('barang.STATUS_BARANG', 'Tersedia') // hanya yang masih di gudang
            ->get();

        return view('ownerLaporanGudang', compact('data', 'tanggalCetak'));
    }

    public function cetakLaporanGudang()
    {
        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $data = DB::table('barang')
            ->join('penitipan', 'barang.ID_PENITIPAN', '=', 'penitipan.ID_PENITIPAN')
            ->join('penitip', 'penitipan.ID_PENITIP', '=', 'penitip.ID_PENITIP')
            ->leftJoin('hunter', 'penitipan.ID_HUNTER', '=', 'hunter.ID_HUNTER')
            ->select(
                'barang.ID_BARANG as kode_produk',
                'barang.NAMA_BARANG as nama_produk',
                'penitip.ID_PENITIP',
                'penitip.NAMA_PENITIP',
                'penitipan.TANGGAL_PENITIPAN as tanggal_masuk',
                'penitipan.STATUS_PERPANJANGAN as perpanjangan',
                'hunter.ID_HUNTER',
                'hunter.NAMA_HUNTER',
                'barang.HARGA_BARANG as harga'
            )
            ->where('barang.STATUS_BARANG', 'Tersedia') // hanya yang masih di gudang
            ->get();

        $pdf = Pdf::loadView('pdf.laporanGudang', compact(
            'data',
            'tanggalCetak'
        ));

        return $pdf->download('Laporan-Stok-Gudang.pdf');
    }
}
