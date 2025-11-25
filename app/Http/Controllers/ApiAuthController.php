<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pembeli;
use App\Models\Penitip;
use App\Models\Organisasi;
use App\Models\Pegawai;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        // Combine all user tables manually
        $user = Pembeli::where('EMAIL_PEMBELI', $email)->first()
             ?? Penitip::where('EMAIL_PENITIP', $email)->first()
             ?? Organisasi::where('EMAIL_ORGANISASI', $email)->first()
             ?? Pegawai::where('EMAIL_PEGAWAI', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // Determine correct password column
        $passwordColumn = $user instanceof Pembeli ? 'PASSWORD_PEMBELI'
                        : ($user instanceof Penitip ? 'PASSWORD_PENITIP'
                        : ($user instanceof Organisasi ? 'PASSWORD_ORGANISASI'
                        : 'PASSWORD_PEGAWAI'));

        if (!Hash::check($password, $user->$passwordColumn)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        // Use JWTAuth to create a token manually
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }

        return response()->json([
            'email' => $email,
            'token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}