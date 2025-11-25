<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Hash;

class OrganisasiWebController extends Controller
{
    public function index()
    {
        $organisasiList = Organisasi::all();
        return view('admin.adminForOrganisasi', compact('organisasiList'));
    }

    public function showRegisterForm()
    {
        return view('RegisterOrganisasi');
    }

    public function register(Request $request)
    {
        $request->validate([
            'NAMA_ORGANISASI' => 'required|string|max:255',
            'EMAIL_ORGANISASI' => 'required|email|unique:organisasi,EMAIL_ORGANISASI',
            'ALAMAT_ORGANISASI' => 'required|string|max:255',
            'NOTELP_ORGANISASI' => 'required|string|max:15',
            'PASSWORD_ORGANISASI' => 'required|string|min:6',
        ]);

        Organisasi::create([
            'NAMA_ORGANISASI' => $request->NAMA_ORGANISASI,
            'EMAIL_ORGANISASI' => $request->EMAIL_ORGANISASI,
            'ALAMAT_ORGANISASI' => $request->ALAMAT_ORGANISASI,
            'NOTELP_ORGANISASI' => $request->NOTELP_ORGANISASI,
            'PASSWORD_ORGANISASI' => Hash::make($request->PASSWORD_ORGANISASI),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_ORGANISASI' => 'required|string|max:255',
            'EMAIL_ORGANISASI' => 'required|email|unique:organisasi,EMAIL_ORGANISASI,' . $id . ',ID_ORGANISASI',
            'ALAMAT_ORGANISASI' => 'required|string|max:255',
            'NOTELP_ORGANISASI' => 'required|string|max:15',
            // password optional (jika mau ganti)
            'PASSWORD_ORGANISASI' => 'nullable|string|min:6',
        ]);

        $organisasi = Organisasi::findOrFail($id);

        $organisasi->update([
            'NAMA_ORGANISASI' => $request->NAMA_ORGANISASI,
            'EMAIL_ORGANISASI' => $request->EMAIL_ORGANISASI,
            'ALAMAT_ORGANISASI' => $request->ALAMAT_ORGANISASI,
            'NOTELP_ORGANISASI' => $request->NOTELP_ORGANISASI,
            'PASSWORD_ORGANISASI' => $request->filled('PASSWORD_ORGANISASI')
                ? Hash::make($request->PASSWORD_ORGANISASI)
                : $organisasi->PASSWORD_ORGANISASI,
        ]);

        return redirect()->back()->with('success', 'Data organisasi berhasil diperbarui.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $organisasiList = Organisasi::when($search, function($query, $search) {
            return $query->where('NAMA_ORGANISASI', 'like', "%$search%");
        })->get();

        return view('admin.adminForOrganisasi', compact('organisasiList', 'search'));
    }

    public function destroy($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $organisasi->delete();

        return redirect()->back()->with('success', 'Organisasi berhasil dihapus.');
    }

    public function showLoginForm()
    {
        return view('LoginPage');
    }

    public function login(Request $request)
    {
        $request->validate([
            'EMAIL_ORGANISASI' => 'required|email',
            'PASSWORD_ORGANISASI' => 'required',
        ]);

        $organisasi = Organisasi::where('EMAIL_ORGANISASI', $request->EMAIL_ORGANISASI)->first();

        if ($organisasi && Hash::check($request->PASSWORD_ORGANISASI, $organisasi->PASSWORD_ORGANISASI)) {
            session(['organisasi' => $organisasi]);
            return redirect('/dashboard');
        }

        return back()->withErrors(['login' => 'Email atau password salah']);
    }

    public function logout()
    {
        session()->forget('organisasi');
        return redirect('/');
    }
}
