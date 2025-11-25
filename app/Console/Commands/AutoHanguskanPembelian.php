<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pembelian;
use Carbon\Carbon;

class AutoHanguskanPembelian extends Command
{
    protected $signature = 'cek:barang-hangus';
    protected $description = 'Cek pembelian yang melewati batas pengambilan dan update status barang menjadi hangus';

    public function handle()
    {
        $today = Carbon::today();

        // Ambil semua pembelian yang belum diambil dan melewati batas pengambilan
        $pembelians = Pembelian::where('STATUS_PENGAMBILAN', 'Belum Diambil')
            ->whereDate('BATAS_PENGAMBILAN', '<', $today)
            ->whereNull('TANGGAL_DITERIMA')
            ->get();


        foreach ($pembelians as $pembelian) {
            $pembelian->STATUS_PEMBAYARAN = 'hangus';
            $pembelian->save();

            foreach ($pembelian->barangs as $barang) {
                $barang->STATUS_BARANG = 'barang untuk donasi';
                $barang->save();
            }

            $this->info("Pembelian ID {$pembelian->ID_PEMBELIAN} di-set hangus.");
        }

        $this->info('Cek barang hangus selesai.');
    }
}
