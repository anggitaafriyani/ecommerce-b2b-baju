<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void { 
    Schema::create('pengiriman', function (Blueprint $table) { 
        $table->id(); 
        $table->string('kode_pesanan'); 
        $table->string('nama_pelanggan'); 
        $table->string('alamat_pengiriman'); 
        $table->string('ekspedisi')->nullable(); 
        $table->string('no_resi')->nullable(); 
        $table->integer('berat_kg')->default(1); 
        $table->integer('ongkir')->default(0); 
        $table->enum('status_pengiriman', [ 'menunggu', 'diproses', 'dikirim', 'selesai' ])->default('menunggu'); 
        $table->timestamps(); 
    }); }
    
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
