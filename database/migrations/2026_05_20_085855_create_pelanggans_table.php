<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('nama_pemilik');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp');
            $table->text('alamat_lengkap');
            $table->enum('tipe_mitra', ['distributor', 'agen', 'toko_retail']); // Khusus tipe bisnis grosir baju
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};