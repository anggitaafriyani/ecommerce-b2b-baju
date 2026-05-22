<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {

            $table->id();

            // kode pesanan
            $table->string('kode_pesanan');

            // data pelanggan
            $table->string('nama_pelanggan');

            // alamat tujuan pengiriman
            $table->text('alamat_pengiriman');

            // jasa ekspedisi / kargo
            $table->string('ekspedisi')->nullable();

            // nomor resi
            $table->string('no_resi')->nullable();

            // berat barang
            $table->integer('berat_kg')->default(1);

            // biaya ongkir
            $table->integer('ongkir')->default(0);

            // status pengiriman
            $table->enum('status_pengiriman', [
                'menunggu',
                'diproses',
                'dikirim',
                'selesai'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};