<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembelianMobileController extends Controller
{
    public function getPembelianByPembeli($id)
    {
        $pembelian = Pembelian::with(['barangs', 'alamat'])
            ->where('ID_PEMBELI', $id)
            ->orderByDesc('TANGGAL_PEMBELIAN')
            ->get();

        return response()->json(['data' => $pembelian]);
    }

    public function getPengirimanUntukKurir()
    {
        $pembelian = Pembelian::with(['detailPembelian.barang.penitipan.penitip', 'pembeli', 'alamat'])
            ->where('METODE_PENGIRIMAN', true)
            ->get();

        return response()->json(['data' => $pembelian]);
    }

    public function updateStatusPengiriman(Request $request, $id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $detail = $pembelian->detailPembelian;
        $jumlahPoin = $pembelian->POIN_DIDAPAT - $pembelian->POIN_DIGUNAKAN;

        if ($pembelian->pembeli) {
            $pembelian->pembeli->POIN_PEMBELI += $jumlahPoin;
            $pembelian->pembeli->save();
        }

        $totalKomisiMart = 0;
        $totalKomisiHunter = 0;
        $totalBonusPenitip = 0;

        foreach ($detail as $item) {
            $barang = $item->barang;
            $penitipan = $barang->penitipan;
            $penitip = $penitipan->penitip;
            $hunter = $penitipan->hunter;
            $harga = $barang->HARGA_BARANG;

            $barang->STATUS_BARANG = 'Terjual';
            $barang->save();

            $tanggalPenitipan = Carbon::parse($penitipan->TANGGAL_PENITIPAN);
            $tanggalPembelian = Carbon::parse($pembelian->TANGGAL_PEMBELIAN);
            $durasiHari = $tanggalPenitipan->diffInDays($tanggalPembelian);

            $komisiHunter = 0;
            $komisiReUseMart = 0;
            $bonusPenitip = 0;

            if ($penitipan->STATUS_PERPANJANGAN) {
                if ($hunter) {
                    $komisiHunter = $harga * 0.05;
                    $komisiReUseMart = $harga * 0.25;
                } else {
                    $komisiReUseMart = $harga * 0.30;
                }
            } else {
                if ($hunter) {
                    $komisiHunter = $harga * 0.05;
                    $komisiReUseMart = $harga * 0.15;
                } else {
                    $komisiReUseMart = $harga * 0.20;
                }

                if ($durasiHari < 7) {
                    $bonusPenitip = $komisiReUseMart * 0.10;
                }
            }

            $totalKomisiMart += $komisiReUseMart;
            $totalKomisiHunter += $komisiHunter;
            $totalBonusPenitip += $bonusPenitip;

            $penitip->SALDO_PENITIP += ($harga * 0.80) + $bonusPenitip;
            $penitip->save();

            if ($hunter && $komisiHunter > 0) {
                $hunter->SALDO_HUNTER += $komisiHunter;
                $hunter->save();
            }
        }

        $pembelian->TANGGAL_DITERIMA = Carbon::now();
        $pembelian->STATUS_PENGIRIMAN = 'Selesai';
        $pembelian->STATUS_PEMBAYARAN = 'selesai';
        $pembelian->KOMISI_REUSEMART = $totalKomisiMart;
        $pembelian->KOMISI_HUNTER = $totalKomisiHunter;
        $pembelian->BONUS_PENITIP = $totalBonusPenitip;
        $pembelian->save();

        return response()->json(['success' => true, 'message' => 'Pengiriman selesai dan komisi dihitung.']);
    }

    public function getHistoryKomisiHunter($idHunter)
    {
        $pembelian = Pembelian::with(['detailPembelian.barang'])
            ->where(function ($query) {
                $query->where('STATUS_PENGIRIMAN', 'Selesai')
                    ->orWhere('STATUS_PENGAMBILAN', 'Sudah Diambil');
            })
            ->whereHas('detailPembelian.barang.penitipan', function ($query) use ($idHunter) {
                $query->where('ID_HUNTER', $idHunter);
            })
            ->get()
            ->map(function ($item) use ($idHunter) {
                return [
                    'TANGGAL_DITERIMA' => $item->TANGGAL_DITERIMA,
                    'KOMISI_HUNTER' => $item->KOMISI_HUNTER,
                    'barangs' => $item->detailPembelian->map(function ($detail) use ($idHunter) {
                        $barang = $detail->barang;
                        if ($barang && $barang->penitipan && $barang->penitipan->ID_HUNTER == $idHunter) {
                            return [
                                'NAMA_BARANG' => $barang->NAMA_BARANG,
                            ];
                        }
                        return null;
                    })->filter()->values()
                ];
            });

        return response()->json(['data' => $pembelian]);
    }
}