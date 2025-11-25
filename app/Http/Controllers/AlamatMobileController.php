<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatMobileController extends Controller
{
    public function getByPembeli($id)
    {
        $alamat = Alamat::where('ID_PEMBELI', $id)->get();

        return response()->json([
            'success' => true,
            'data' => $alamat
        ]);
    }
}

