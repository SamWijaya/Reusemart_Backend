<?php

namespace App\Http\Controllers;
use App\Models\Hunter;
use Illuminate\Http\Request;

class HunterMobileController extends Controller
{
    public function profil($id)
    {
        $hunter = Hunter::find($id);

        if (!$hunter) {
            return response()->json(['message' => 'Hunter tidak ditemukan'], 404);
        }

        return response()->json($hunter);
    }

}
