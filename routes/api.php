<?php

use App\Http\Controllers\AlamatMobileController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\AuthMobileController;
use App\Http\Controllers\BarangMobileController;
use App\Http\Controllers\HunterMobileController;
use App\Http\Controllers\KurirMobileController;
use App\Http\Controllers\MerchandiseMobileController;
use App\Http\Controllers\PembelianMobileController;
use App\Http\Controllers\PembeliMobileController;
use App\Http\Controllers\PenitipMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/barang/tersedia', [BarangMobileController::class, 'index']);

Route::post('/login', [AuthMobileController::class, 'login']);

Route::get('/barang', [BarangMobileController::class, 'semuaBarang']);

Route::get('/pembeli/{id}', [PembeliMobileController::class, 'show']);

Route::get('/pembelian/pembeli/{id}', [PembelianMobileController::class, 'getPembelianByPembeli']);

Route::get('/alamat/pembeli/{id}', [AlamatMobileController::class, 'getByPembeli']);

Route::get('/penitip-mobile/{id}/history-barang', [PenitipMobileController::class, 'getHistoryBarang']);

Route::get('/penitip/{id}/profil', [PenitipMobileController::class, 'getProfil']);

Route::get('/kurir/{id}/profil', [KurirMobileController::class, 'profil']);

Route::get('/pengiriman/kurir', [PembelianMobileController::class, 'getPengirimanUntukKurir']);

Route::post('/pengiriman/selesai/{id}', [PembelianMobileController::class, 'updateStatusPengiriman']);

Route::get('/hunter/{id}/profil', [HunterMobileController::class, 'profil']);

Route::get('/hunter/komisi/{id}', [PembelianMobileController::class, 'getHistoryKomisiHunter']);

Route::get('/merchandise', [MerchandiseMobileController::class, 'index']);
Route::post('/penukaranpoin', [MerchandiseMobileController::class, 'penukaranPoin']);

Route::post('/login', [ApiAuthController::class, 'login']);