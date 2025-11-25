<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\AutoHanguskanPembelian;


class Kernel extends ConsoleKernel
{
    /**
     * Daftar semua custom Artisan commands yang akan didaftarkan.
     *
     * @var array
     */
    protected $commands = [
        AutoHanguskanPembelian::class,
    ];


    /**
     * Define schedule tugas yang dijalankan otomatis.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Jalankan command cek:barang-hangus setiap hari jam 00:00
        $schedule->command('cek:barang-hangus')->everyMinute();
    }

    /**
     * Register commands artisan yang ada di folder Commands.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        // Jika ada console routes, bisa di-uncomment:
        // require base_path('routes/console.php');
    }
}
