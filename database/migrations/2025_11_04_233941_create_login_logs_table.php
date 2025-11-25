<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('login_logs', function (Blueprint $table) {
        $table->id();
        $table->string('email_attempt'); // Email yang digunakan
        $table->string('ip_address');    // Alamat IP pengguna
        $table->string('status');        // 'success' atau 'failed'
        $table->timestamps();            // Kapan ini terjadi
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
