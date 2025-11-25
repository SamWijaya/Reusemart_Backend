<?php

namespace App\Http\Controllers;

use App\Models\Penitip;
use App\Models\Barang;
use App\Models\Penitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class PenitipWebController extends Controller
{

    public function history()
    {
        $penitipId = session('user_id');

        // Ambil penitipan milik penitip login
        $penitipanIds = Penitipan::where('ID_PENITIP', $penitipId)->pluck('ID_PENITIPAN');

        // Ambil barang yang FK-nya ada di penitipan tersebut
        $barangList = Barang::whereIn('ID_PENITIPAN', $penitipanIds)->get();
        return view('halamanPenitip', compact('barangList'));
    }

    public function index()
    {
        // Menampilkan semua penitip
        $penitips = Penitip::all();
        return view('CSForPenitip', compact('penitips'));
    }

    public function showProfil()
    {
        $penitipId = session('user_id');

        if (!$penitipId) {
            return redirect('/login')->with('error', 'Silakan login sebagai penitip terlebih dahulu.');
        }

        // Ambil data penitip dari database
        $penitip = Penitip::find($penitipId);
        return view('ProfilPenitip', compact('penitip'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'NAMA_PENITIP' => 'required|string|max:255',
            'EMAIL_PENITIP' => 'required|email|max:255|unique:penitip',
            'ALAMAT_PENITIP' => 'required|string|max:255',
            'NOTELP_PENITIP' => 'required|string|max:255',
            'NIK' => 'required|string|max:16',
            'SCAN_KTP' => 'required|image|mimes:jpg,jpeg,png,gif|max:5096',
            'PASSWORD_PENITIP' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan file jika ada
        $scanKTPPath = null;
        if ($request->hasFile('SCAN_KTP')) {
            $scanKTPPath = $request->file('SCAN_KTP')->store('ktp_images', 'public');
        }

        // Menyimpan penitip baru
        Penitip::create([
            'NAMA_PENITIP' => $request->NAMA_PENITIP,
            'EMAIL_PENITIP' => $request->EMAIL_PENITIP,
            'ALAMAT_PENITIP' => $request->ALAMAT_PENITIP,
            'NOTELP_PENITIP' => $request->NOTELP_PENITIP,
            'NIK' => $request->NIK,
            'SCAN_KTP' => $scanKTPPath,
            'PASSWORD_PENITIP' => bcrypt($request->PASSWORD_PENITIP),
            'SALDO_PENITIP' => 0,
            'POIN_PENITIP' => 0,
        ]);

        return redirect()->back()->with('success', 'Data penitip berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'NAMA_PENITIP' => 'required|string|max:255',
            'EMAIL_PENITIP' => 'required|email|max:255|unique:penitip,EMAIL_PENITIP,' . $id . ',ID_PENITIP',
            'ALAMAT_PENITIP' => 'required|string|max:255',
            'NOTELP_PENITIP' => 'required|string|max:255',
            'NIK' => 'required|string|max:16',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $penitip = Penitip::findOrFail($id);

        // Update penitip
        $penitip->update([
            'NAMA_PENITIP' => $request->NAMA_PENITIP,
            'EMAIL_PENITIP' => $request->EMAIL_PENITIP,
            'ALAMAT_PENITIP' => $request->ALAMAT_PENITIP,
            'NOTELP_PENITIP' => $request->NOTELP_PENITIP,
            'NIK' => $request->NIK,
        ]);

        return redirect()->back()->with('success', 'Data Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penitip = Penitip::findOrFail($id);

        // Hapus file SCAN_KTP jika ada
        if ($penitip->SCAN_KTP) {
            Storage::disk('public')->delete($penitip->SCAN_KTP);
        }

        // Hapus penitip
        $penitip->delete();

        return redirect()->back()->with('success', 'Data penitip berhasil dihapus.');
    }

    public function search(Request $request)
    {
        // Menyaring berdasarkan nama penitip
        $penitips = Penitip::query()
            ->when($request->input('NAMA_PENITIP'), function ($query, $nama) {
                return $query->where('NAMA_PENITIP', 'like', '%' . $nama . '%');
            })
            ->get();

        return view('CSForPenitip', compact('penitips'));
    }

    public function barangPerpanjangan()
    {
        $penitipId = session('user_id');
        $penitip = Penitip::findOrFail($penitipId);

        // Ambil penitipan milik penitip login
        $penitipanIds = Penitipan::where('ID_PENITIP', $penitipId)->pluck('ID_PENITIPAN');

        // Ambil barang yang FK-nya ada di penitipan tersebut


        $barangList = Barang::whereIn('ID_PENITIPAN', $penitipanIds)
            ->whereHas('penitipan', function ($query) {
                $query->where('STATUS_PERPANJANGAN', true); // atau '1' kalau boolean-nya string
            })
            ->get();
        return view('barangPerpanjangan', compact('barangList', 'penitip'));
    }

    public function perpanjang($id)
    {
        $penitipan = Penitipan::findOrFail($id);
        $penitip = $penitipan->penitip;

        $barangList = Barang::where('ID_PENITIPAN', $penitipan->ID_PENITIPAN)->get();
        $totalHarga = $barangList->sum('HARGA_BARANG');
        $potongan = $totalHarga * 0.05;
        

        // Cek saldo cukup
        if ($penitip->SALDO_PENITIP < $potongan) {
            return back()->with('error', 'Saldo penitip tidak mencukupi untuk perpanjangan.');
        }

        // Proses perpanjangan
        $tanggalBerakhirBaru = Carbon::parse($penitipan->TANGGAL_BERAKHIR)->addDays(30);
        $penitipan->TANGGAL_BERAKHIR = $tanggalBerakhirBaru;
        $penitipan->BATAS_AMBIL = $tanggalBerakhirBaru->copy()->addDays(7);
        $penitipan->STATUS_PERPANJANGAN = true;

        $penitip->SALDO_PENITIP -= $potongan;

        $penitipan->save();
        $penitip->save();

        return back()->with('success', 'Berhasil diperpanjang dan saldo telah dipotong.');
    }

}