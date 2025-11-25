<?php

use App\Http\Controllers\MerchandiseWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganisasiWebController;
use App\Http\Controllers\PegawaiWebController;
use App\Http\Controllers\JabatanWebController;
use App\Http\Controllers\PenitipWebController;
use App\Http\Controllers\PembeliWebController;
use App\Http\Controllers\RequestWebController;
use App\Http\Controllers\OwnerWebController;
use App\Http\Controllers\AlamatWebController;
use App\Http\Controllers\BarangWebController;
use App\Http\Controllers\DiskusiWebController;
use App\Http\Controllers\GudangWebController;
use App\Http\Controllers\KeranjangWebController;
use App\Http\Controllers\PembelianWebController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AuthController;

Route::get('/test-session', function () {
    session(['test_key' => 'Coba Session']);
    return redirect('/check-session');
});

Route::get('/check-session', function () {
    return session('test_key', 'Session tidak ditemukan');
});

Route::get('/', [BarangWebController::class, 'index'])->name('halamanUmum');
Route::get('/produk/{id}', [BarangWebController::class, 'show'])->name('produk.show');
Route::post('/barang/store', [BarangWebController::class, 'store'])->name('barang.store');
Route::post('/barang/update/{id}', [BarangWebController::class, 'update'])->name('barang.update');

Route::post('/barang/perpanjang/{id}', [BarangWebController::class, 'perpanjang'])->name('barang.perpanjang');
Route::post('/barang/ambil/{id}', [BarangWebController::class, 'ambil'])->name('barang.ambil');
Route::post('/penitipan/{id}/konfirmasi-ambil', [BarangWebController::class, 'konfirmasiAmbil'])->name('penitipan.konfirmasiAmbil');


Route::post('/diskusi', [DiskusiWebController::class, 'store'])->name('diskusi.store');
Route::get('/CSForDiskusi', [DiskusiWebController::class, 'csIndex'])->name('cs.diskusi.index');

Route::get('/CSForVerif', [PembelianWebController::class, 'indexForVerif'])->name('cs.verif');
Route::put('/pembelian/{id}/upload-bukti', [PembelianWebController::class, 'uploadBukti'])->name('upload.bukti');
Route::post('/pembelian/{id}/verifikasi', [PembelianWebController::class, 'verifikasi'])->name('pembelian.verified');
Route::post('/pembelian/{id}/tolak', [PembelianWebController::class, 'tolak'])->name('pembelian.verified');


// Tampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login/otp', [AuthController::class, 'showOtpForm'])->name('login.otp.form');
Route::post('/login/otp', [AuthController::class, 'verifyOtp'])->name('login.otp.verify');
Route::get('/login/otp/resend', [AuthController::class, 'resendOtp'])->name('login.otp.resend');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('RegisterPembeli');
});

Route::get('/registerOrganisasi', function () {
    return view('RegisterOrganisasi');
});

Route::get('/keranjang', [KeranjangWebController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangWebController::class, 'tambah'])->name('keranjang.tambah');
Route::delete('/keranjang/{id}', [KeranjangWebController::class, 'hapus'])->name('keranjang.hapus');

Route::get('/checkout', [PembelianWebController::class, 'index'])->name('checkout');
Route::post('/pembelian/store', [PembelianWebController::class, 'store'])->name('pembelian.store');

Route::get('/konfirmasiPembayaran/{id}', [PembelianWebController::class, 'konfirmasi'])->name('konfirmasi.pembayaran');


Route::get('/halamanGudang', [GudangWebController::class, 'index'])->name('halamanGudang');

Route::get('/jadwalPengiriman', [GudangWebController::class, 'pengiriman'])->name('jadwal.kirim');
Route::post('/pembelian/jadwalkan', [PembelianWebController::class, 'jadwalkan'])->name('pembelian.jadwalkan');

Route::get('/jadwalPengambilan', [GudangWebController::class, 'pengambilan'])->name('jadwal.ambil');
Route::post('/jadwal-pengambilan', [PembelianWebController::class, 'jadwalkanPengambilan'])->name('jadwal.pengambilan');

Route::post('/pembelian/konfirmasi/{id}', [PembelianWebController::class, 'konfirmasiPengambilan'])->name('pembelian.konfirmasiPengambilan');



Route::get('/pembelian/cetak-pdf/{id}', [PembelianWebController::class, 'cetakPembelian'])->name('pembelian.cetak');

Route::get('/penitip/detail/{id}', [GudangWebController::class, 'detail'])->name('penitip.detail');
Route::post('/penitipan/tambah/{id}', [GudangWebController::class, 'create'])->name('penitipan.create');
Route::get('/penitipan/cetak-pdf/{id}', [GudangWebController::class, 'cetakNotaPdf'])->name('penitipan.cetak');
Route::get('/barang-titipan/{id}', [GudangWebController::class, 'barangTitipan'])->name('penitipan.detail');

Route::get('/organisasi', [RequestWebController::class, 'index'])->name('halamanOrganisasi');

Route::get('/adminForPegawai', [PegawaiWebController::class, 'index'])->name('halamanAdmin');



//////
Route::get('/owner', [OwnerWebController::class, 'index'])->name('halamanOwner');
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/reqDonasi/cetak', [OwnerWebController::class, 'cetakReqDonasi'])->name('reqDonasi.cetak');

Route::get('/historyDonasi', [OwnerWebController::class, 'historyDonasi'])->name('historyDonasi');
Route::get('/history/cetak', [OwnerWebController::class, 'cetakHistoryDonasi'])->name('historyDonasi.cetak');

Route::get('/penjualan-per-kategori', [OwnerWebController::class, 'penjualanPerKategori'])->name('penjualan.kategori');
Route::get('/penjualan-per-kategori/cetak', [OwnerWebController::class, 'cetakNotaKategori'])->name('penjualan.kategori.cetak');

Route::get('/penitipan-habis', [OwnerWebController::class, 'penitipanHabis'])->name('penitipan.habis');
Route::get('/barang-end/cetak', [OwnerWebController::class, 'cetakBarangEnd'])->name('barangEnd.cetak');

Route::get('/transaksi-penitip', [OwnerWebController::class, 'transaksiPenitip'])->name('transaksi.penitip');
Route::get('/cetak-transaksi-penitip/{id}', [OwnerWebController::class, 'cetakTransaksiPenitip'])->name('transaksiPenitip.cetak');

//
Route::get('/laporan/penjualan-perbulan', [OwnerWebController::class, 'laporanBulanan'])->name('laporan.perbulan');
Route::get('/laporan-bulanan/cetak', [OwnerWebController::class, 'cetakLaporanBulanan'])->name('laporanBulanan.cetak');

Route::get('/laporan-komisi', [OwnerWebController::class, 'laporanKomisi'])->name('komisi.perbulan');
Route::get('/laporan-komisi/cetak', [OwnerWebController::class, 'laporanKomisi'])->name('laporanKomisi.cetak');

Route::get('/laporan-gudang', [OwnerWebController::class, 'laporanGudang'])->name('laporan.gudang');
Route::get('/laporan-gudang/cetak', [OwnerWebController::class, 'cetakLaporanGudang'])->name('laporanGudang.cetak');

//////
Route::get('/halamanPembeli', [PembeliWebController::class, 'mainPage'])->name('halamanPembeli');
Route::get('/halamanPenitip', [PenitipWebController::class, 'history'])->name('halamanPenitip');


// Menampilkan halaman daftar pembeli
Route::get('/pembeli', [PembeliWebController::class, 'index'])->name('pembeli.index');

// Menyimpan data pembeli dari form (POST)
Route::post('/pembeli', [PembeliWebController::class, 'store'])->name('pembeli.store');

//Route::get('/profilPembeli', [PembeliWebController::class, 'profil'])->name('profilPembeli');

Route::get('/profilPenitip', [PenitipWebController::class, 'showProfil'])->name('penitip.profil');

Route::get('/profilPembeli', [PembeliWebController::class, 'index'])->name('pembeli.index');

Route::get('/admin/adminForMerchandise', function () {
    return view('admin/adminForMerchandise');
});


Route::post('/register-organisasi', [OrganisasiWebController::class, 'register'])->name('organisasi.register');
Route::get('/admin/adminForOrganisasi', [OrganisasiWebController::class, 'index']);
Route::put('/admin/adminForOrganisasi/{id}', [OrganisasiWebController::class, 'update'])->name('organisasi.update');
Route::delete('/admin/adminForOrganisasi/{id}', [OrganisasiWebController::class, 'destroy'])->name('organisasi.destroy');
Route::get('/admin/adminForOrganisasi', [OrganisasiWebController::class, 'search']);

Route::post('/store-jabatan', [JabatanWebController::class, 'store'])->name('jabatan.store');
Route::get('/admin/adminForJabatan', [JabatanWebController::class, 'index']);
Route::put('/admin/adminForJabatan/{id}', [JabatanWebController::class, 'update'])->name('jabatan.update');
Route::delete('/admin/adminForJabatan/{id}', [JabatanWebController::class, 'destroy'])->name('jabatan.destroy');
Route::get('/admin/adminForJabatan', [JabatanWebController::class, 'search']);

Route::get('/admin/adminForPegawai', [PegawaiWebController::class, 'index']);
Route::post('/store-pegawai', [PegawaiWebController::class, 'store'])->name('pegawai.store');
Route::put('/admin/adminForPegawai/{id}', [PegawaiWebController::class, 'update'])->name('pegawai.update');
Route::delete('/admin/adminForPegawai/{id}', [PegawaiWebController::class, 'destroy'])->name('pegawai.destroy');

Route::get('/csForPenitip', [PenitipWebController::class, 'index'])->name('halamanCS');
Route::post('/store-penitip', [PenitipWebController::class, 'store'])->name('penitip.store');
Route::put('/csPenitip/{id}', [PenitipWebController::class, 'update'])->name('penitip.update');
Route::delete('/csPenitip/{id}', [PenitipWebController::class, 'destroy'])->name('penitip.destroy');
Route::get('/csPenitip', [PenitipWebController::class, 'search']);

Route::get('/organisasi/search', [OrganisasiWebController::class, 'search'])->name('organisasi.search');
Route::delete('/organisasi/delete/{id}', [OrganisasiWebController::class, 'destroy'])->name('organisasi.destroy');

Route::get('/admin/adminForReset', function () {
    return view('admin/adminForReset');
});

Route::get('/request', [RequestWebController::class, 'index'])->name('request.index');
Route::post('/request', [RequestWebController::class, 'store'])->name('request.store');
Route::put('/request/{id}', [RequestWebController::class, 'update'])->name('request.update');
Route::delete('/request/{id}', [RequestWebController::class, 'destroy'])->name('request.destroy');



Route::post('/alamat', [AlamatWebController::class, 'store'])->name('alamat.store');
Route::delete('/alamat/{id}', [AlamatWebController::class, 'destroy'])->name('alamat.destroy');
Route::patch('/alamat/{id}/default', [AlamatWebController::class, 'setDefault'])->name('alamat.set_default');
Route::patch('/alamat/{id}', [AlamatWebController::class, 'update'])->name('alamat.update');

Route::post('/reset-password', [PegawaiWebController::class, 'resetPassword'])->name('reset.password');

Route::get('/batal/{id}', [PembelianWebController::class, 'batalBeli'])->name('batal.beli');

Route::get('/mercch', [MerchandiseWebController::class, 'index'])->name('merch.index');
Route::post('/merchandise', [MerchandiseWebController::class, 'store'])->name('merchandise.store');
Route::post('/merchandise-edit/{id}', [MerchandiseWebController::class, 'update'])->name('merchandise.update');
Route::delete('/merchandise/{id}', [MerchandiseWebController::class, 'destroy'])->name('merchandise.destroy');

Route::get('/histori-pembelian', [PembelianWebController::class, 'historyPembelian'])->name('histori.pembelian');
Route::post('/beri-rating', [RatingController::class, 'store']);

Route::get('/penukaranList', [MerchandiseWebController::class, 'penukaranList'])->name('penukaran.list');

Route::get('/perpanjanganBarangList', [PenitipWebController::class, 'barangPerpanjangan'])->name('barang.perpanjangan');

Route::put('/penitipan/perpanjang/{id}', [PenitipWebController::class, 'perpanjang'])->name('penitipan.perpanjang');
