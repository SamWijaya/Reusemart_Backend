<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanWebController extends Controller
{
    public function index()
    {
        $jabatanList = Jabatan::all();
        return view('admin.adminForJabatan', compact('jabatanList'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $jabatanList = Jabatan::when($search, function ($query, $search) {
            return $query->where('NAMA_JABATAN', 'like', '%' . $search . '%');
        })->get();

        return view('admin.adminForJabatan', compact('jabatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA_JABATAN' => 'required|string|max:255',
        ]);

        Jabatan::create([
            'NAMA_JABATAN' => $request->NAMA_JABATAN,
        ]);

        return redirect()->back()->with('success', 'Data Jabatan berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_JABATAN' => 'required|string|max:255',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update([
            'NAMA_JABATAN' => $request->NAMA_JABATAN,
        ]);

        return redirect()->back()->with('success', 'Data Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->back()->with('success', 'Data Jabatan berhasil diperbarui.');
    }
}
