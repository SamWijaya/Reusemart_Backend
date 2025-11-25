<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthMobileController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // 1. Cek Pembeli
        $pembeli = DB::table('pembeli')->where('EMAIL_PEMBELI', $email)->first();
        if ($pembeli && Hash::check($password, $pembeli->PASSWORD_PEMBELI)) {
            return response()->json(['role' => 'pembeli', 'data' => $pembeli]);
        }

        // 2. Cek Penitip
        $penitip = DB::table('penitip')->where('EMAIL_PENITIP', $email)->first();
        if ($penitip && Hash::check($password, $penitip->PASSWORD_PENITIP)) {
            return response()->json(['role' => 'penitip', 'data' => $penitip]);
        }

        // 3. Cek Pegawai dengan jabatan kurir
        $kurir = DB::table('pegawai')
            ->join('jabatan', 'pegawai.ID_JABATAN', '=', 'jabatan.ID_JABATAN')
            ->where('jabatan.NAMA_JABATAN', 'kurir')
            ->where('EMAIL_PEGAWAI', $email)
            ->select('pegawai.*')
            ->first();

        if ($kurir && Hash::check($password, $kurir->PASSWORD_PEGAWAI)) {
            return response()->json(['role' => 'kurir', 'data' => $kurir]);
        }

        // 4. Cek Hunter
        $hunter = DB::table('hunter')->where('EMAIL_HUNTER', $email)->first();
        if ($hunter && $password === $hunter->PASSWORD_HUNTER) {
            return response()->json(['role' => 'hunter', 'data' => $hunter]);
        }

        // Jika tidak ditemukan
        return response()->json(['error' => 'Email atau password salah'], 401);
    }
}
