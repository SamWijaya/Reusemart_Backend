<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\JabatanWebController;

class PegawaiWebController extends Controller
{
    public function index()
    {
        $pegawaiList = Pegawai::all();
        $jabatanList = Jabatan::all();
        return view('admin.adminForPegawai', compact('pegawaiList', 'jabatanList'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'NAMA_PEGAWAI' => 'required',
            'EMAIL_PEGAWAI' => 'required|email|unique:pegawai,EMAIL_PEGAWAI',
            'NOTELP_PEGAWAI' => 'required',
            'ID_JABATAN' => 'required',
            'TGL_LAHIR' => 'required|date',
            'PASSWORD_PEGAWAI' => 'required|min:6',
        ]);

        Pegawai::create([
            'NAMA_PEGAWAI' => $request->NAMA_PEGAWAI,
            'EMAIL_PEGAWAI' => $request->EMAIL_PEGAWAI,
            'NOTELP_PEGAWAI' => $request->NOTELP_PEGAWAI,
            'ID_JABATAN' => $request->ID_JABATAN,
            'TGL_LAHIR' => $request->TGL_LAHIR,
            'PASSWORD_PEGAWAI' => Hash::make($request->PASSWORD_PEGAWAI),
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'NAMA_PEGAWAI' => 'required',
            'EMAIL_PEGAWAI' => 'required|email|unique:pegawai,EMAIL_PEGAWAI,' . $id . ',ID_PEGAWAI',
            'NOTELP_PEGAWAI' => 'required',
            'ID_JABATAN' => 'required',
            'TGL_LAHIR' => 'required|date',
        ]);

        // Ambil data pegawai
        $pegawai = Pegawai::where('ID_PEGAWAI', $id)->firstOrFail();

        // Update field
        $pegawai->NAMA_PEGAWAI = $validated['NAMA_PEGAWAI'];
        $pegawai->EMAIL_PEGAWAI = $validated['EMAIL_PEGAWAI'];
        $pegawai->NOTELP_PEGAWAI = $validated['NOTELP_PEGAWAI'];
        $pegawai->ID_JABATAN = $validated['ID_JABATAN'];
        $pegawai->TGL_LAHIR = $validated['TGL_LAHIR'];

        // Simpan
        $pegawai->save();

        return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui.');
    }


    // Menghapus data pegawai
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->back()->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Pegawai::where('EMAIL_PEGAWAI', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email pengguna tidak ditemukan.');
        }

        if (!$user->TGL_LAHIR) {
            return back()->with('error', 'Tanggal lahir tidak tersedia untuk pengguna ini.');
        }

        $passwordBaru = \Carbon\Carbon::parse($user->TGL_LAHIR)->format('dmY');
        $user->PASSWORD_PEGAWAI = Hash::make($passwordBaru);
        $user->save();

        return back()->with('success', 'Password berhasil direset ke tanggal lahir pengguna.');
    }
}
