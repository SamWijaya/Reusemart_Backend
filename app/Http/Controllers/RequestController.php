<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Donasi;
use Illuminate\Support\Facades\Auth;
use Exception;

class RequestController extends Controller
{
    public function index()
    {
        try {
            $data = Request_Donasi::all();
            return response()->json([
                "Status" => true,
                "message" => "Get successful",
                "data" => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'DESKRIPSI_REQUEST' => 'nullable|string|max:50',
                'TANGGAL_REQUEST' => 'required|date',
            ]);

            // Ambil user yang login dari guard 'organisasi'
            $organisasi = Auth::guard('organisasi')->user();

            if (!$organisasi) {
                return back()->with('error', 'User belum login sebagai organisasi.');
            }

            $idOrganisasi = $organisasi->ID_ORGANISASI;

            // Cek apakah organisasi sudah pernah mengirim request
            // if (Request_Donasi::where('ID_ORGANISASI', $idOrganisasi)->exists()) {
            //     return back()->with('error', 'Anda sudah mengirimkan request donasi.');
            // }

            // Simpan ke database
            Request_Donasi::create([
                'ID_ORGANISASI' => $idOrganisasi,
                'DESKRIPSI_REQUEST' => $request->input('DESKRIPSI_REQUEST'),
                'TANGGAL_REQUEST' => $request->input('TANGGAL_REQUEST'),
                'STATUS_REQUEST' => 1, // default status, misalnya pending
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Request donasi berhasil dikirim.'
            ], 201);

        } catch (\Throwable $e) {
            // Tangani semua jenis error (termasuk query atau auth)
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
