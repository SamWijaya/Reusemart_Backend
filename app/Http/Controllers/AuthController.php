<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\Pembeli;
use App\Models\Penitip;
use App\Models\Organisasi;
use App\Models\Request_Donasi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\LoginLog;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('LoginPage');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = null;
        $userType = null;
        $userId = null;
        $redirectRoute = null;
    
        // Cek di tabel pembeli
        $pembeli = Pembeli::where('EMAIL_PEMBELI', $email)->first();
        if ($pembeli && Hash::check($password, $pembeli->PASSWORD_PEMBELI)) {
            $user = $pembeli;
            $userType = 'pembeli';
            $userId = $pembeli->ID_PEMBELI;
            $redirectRoute = 'halamanPembeli';
        }

        // Cek di tabel penitip
        if (!$user) {
            $penitip = Penitip::where('EMAIL_PENITIP', $email)->first();
            if ($penitip && Hash::check($password, $penitip->PASSWORD_PENITIP)) {
                $user = $penitip;
                $userType = 'penitip';
                $userId = $penitip->ID_PENITIP;
                $redirectRoute = 'halamanPenitip';
            }
        }
        
        // Cek di tabel organisasi
        if (!$user) {
            $organisasi = Organisasi::where('EMAIL_ORGANISASI', $email)->first();
            if ($organisasi && Hash::check($password, $organisasi->PASSWORD_ORGANISASI)) {
                $user = $organisasi;
                $userType = 'organisasi';
                $userId = $organisasi->ID_ORGANISASI;
                $redirectRoute = 'halamanOrganisasi';
            }
        }

        // Cek di tabel pegawai
        if (!$user) {
            $pegawai = Pegawai::where('EMAIL_PEGAWAI', $email)->first();
            if ($pegawai && Hash::check($password, $pegawai->PASSWORD_PEGAWAI)) {
                $user = $pegawai;
                $userType = 'pegawai';
                $userId = $pegawai->ID_PEGAWAI;
                
                $namaJabatan = strtolower($pegawai->jabatan->NAMA_JABATAN); // Pastikan relasi 'jabatan' ada
                $redirectRoute = match ($namaJabatan) {
                    'admin' => 'halamanAdmin',
                    'customer service' => 'halamanCS',
                    'owner' => 'halamanOwner',
                    'pegawai gudang' => 'halamanGudang',
                    default => 'halamanUmum', // Ganti ke route default yang sesuai
                };
            }
        }

        // Jika user ditemukan dan password cocok
        if ($user) {

            $token = auth()->login($user);
    
            // return response()->json([
            //     'status' => 'success',
            //     'token' => $token,
            //     'token_type' => 'bearer',
            //     'expires_in' => auth()->factory()->getTTL() * 60,
            //     'route' => $redirectRoute,
            //     'user_type' => $userType,
            //     'user_id' => $userId
            // ]);

            LoginLog::create([
                'email_attempt' => $email,
                'ip_address'    => $request->ip(),
                'status'        => 'success'
            ]);
            
            // Buat OTP
            $otp = rand(100000, 999999);

            // Kirim OTP ke email
            try {
                Mail::to($email)->send(new SendOtpMail($otp));
            } catch (\Exception $e) {
                // Tangani error pengiriman email
                return back()->withErrors(['email' => 'Gagal mengirim email OTP. Silakan coba lagi.'])->withInput();
            }

            // Simpan data OTP dan user sementara di session
            session([
                'otp_user_id' => $userId,
                'otp_user_type' => $userType,
                'otp_redirect_route' => $redirectRoute,
                'otp_code' => $otp,
                'otp_email' => $email,
                'otp_expires_at' => now()->addMinutes(10) // OTP berlaku 10 menit
            ]);
            
            // Redirect ke halaman input OTP
            return redirect()->route('login.otp.form');
        }

        // Jika tidak ada user yang cocok
        LoginLog::create([
            'email_attempt' => $email,
            'ip_address'    => $request->ip(),
            'status'        => 'failed'
        ]);
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function showOtpForm()
    {
        // Pastikan user sudah melewati tahap login
        if (!session()->has('otp_email')) {
            return redirect()->route('login.form');
        }
        
        return view('LoginOTP', ['email' => session('otp_email')]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        // Cek apakah data session OTP masih ada
        if (!session()->has('otp_code') || !session()->has('otp_expires_at')) {
            return redirect()->route('login.form')->withErrors(['email' => 'Sesi Anda telah berakhir, silakan login kembali.']);
        }

        // Cek apakah OTP sudah kadaluarsa
        if (now()->gt(session('otp_expires_at'))) {
             session()->forget(['otp_user_id', 'otp_user_type', 'otp_redirect_route', 'otp_code', 'otp_email', 'otp_expires_at']);
             return redirect()->route('login.otp.form')->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan kirim ulang.']);
        }

        // Cek apakah OTP cocok
        if ($request->otp == session('otp_code')) {
            // Simpan data login permanen
            session([
                'user_type' => session('otp_user_type'),
                'user_id' => session('otp_user_id')
            ]);
            
            $redirectRoute = session('otp_redirect_route');

            // Hapus data OTP dari session
            session()->forget(['otp_user_id', 'otp_user_type', 'otp_redirect_route', 'otp_code', 'otp_email', 'otp_expires_at']);

            // Redirect ke halaman tujuan
            return redirect()->route($redirectRoute);
        
        } else {
            // Jika OTP salah
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah.']);
        }
    }

    public function resendOtp()
    {
        // Pastikan data session masih ada
        if (!session()->has('otp_email') || !session()->has('otp_code')) {
            return redirect()->route('login.form')->withErrors(['email' => 'Sesi Anda telah berakhir, silakan login kembali.']);
        }

        $otp = session('otp_code');
        $email = session('otp_email');

        // Kirim ulang email
        try {
            Mail::to($email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            return back()->withErrors(['otp' => 'Gagal mengirim ulang email OTP.']);
        }

        // Perbarui waktu kadaluarsa
        session(['otp_expires_at' => now()->addMinutes(10)]);

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('login.form'); // Redirect ke halaman login
    }
}
