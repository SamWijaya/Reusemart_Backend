<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\Penitip;
use Carbon\Carbon;
use App\Models\Penitipan;
use App\Models\Barang;
use App\Models\Hunter;
use App\Models\Pembelian;

use Barryvdh\DomPDF\Facade\Pdf;


class GudangWebController extends Controller
{
    public function index()
    {
        $penitip = Penitip::all();
        return view('pegawaiGudang', compact('penitip'));
    }

    public function pengiriman()
    {
        $pegawaiList = Pegawai::whereHas('jabatan', function ($query) {
            $query->where('NAMA_JABATAN', 'kurir');
        })->get();

        $pembelianList = Pembelian::where('METODE_PENGIRIMAN', true)
            ->where('STATUS_PEMBAYARAN', 'verified')
            ->get();

        return view('jadwalPengiriman', compact('pembelianList', 'pegawaiList'));
    }


    public function pengambilan()
    {
        $pembelianList = Pembelian::where('METODE_PENGIRIMAN', false)
            ->whereIn('STATUS_PEMBAYARAN', ['verified', 'selesai', 'hangus'])
            ->get();

        return view('jadwalPengambilan', compact('pembelianList'));
    }

    public function barangTitipan($id)
    {
        $penitipan = Penitipan::find($id);
        $barangList = Barang::where('ID_PENITIPAN', $id)->get();
        return view('tambahBarang', compact('barangList', 'penitipan'));
    }

    public function detail(Request $request, $id)
    {
        $hunters = Hunter::all();
        $penitip = Penitip::findOrFail($id);
        $penitipanList = Penitipan::where('ID_PENITIP', $id)->get();

        return view('tambahPenitipan', compact('penitip', 'penitipanList', 'hunters'));
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'ID_HUNTER' => 'nullable|exists:hunter,ID_HUNTER',
        ]);

        $pegawaiId = session('user_id');

        $now = Carbon::now();
        $akhir = $now->copy()->addDays(30);
        $batasAmbil = $akhir->copy()->addDays(7);

        Penitipan::create([
            'ID_PENITIP' => $id,
            'ID_PEGAWAI' => $pegawaiId,
            'ID_HUNTER' => $request->ID_HUNTER ?? null,
            'TANGGAL_PENITIPAN' => $now,
            'TANGGAL_BERAKHIR' => $akhir,
            'STATUS_PERPANJANGAN' => false,
            'BATAS_AMBIL' => $batasAmbil,
            'IS_AMBIL' => false,
            'STATUS_AMBIL_KEMBALI' => false,
        ]);

        return redirect()->route('penitip.detail', $id)->with('success', 'Penitipan berhasil ditambahkan.');
    }

    public function cetakNotaPdf($id)
    {

        $penitipan = Penitipan::find($id);
        $barangList = Barang::where('ID_PENITIPAN', $id)->get();

        $pdf = Pdf::loadView('pdf.nota_penitipan', compact('penitipan', 'barangList'));

        $namaFile = 'Nota_Penitipan_' . $penitipan->id . '.pdf';
        return $pdf->download($namaFile);
    }
}
