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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('transaksi_id')->nullable(); 
            
            $table->string('no_invoice')->unique(); 
            $table->decimal('total_tagihan', 12, 2); 
            $table->enum('metode_pembayaran', ['transfer_bank', 'dp', 'termin']); 
            $table->decimal('jumlah_dibayar', 12, 2)->default(0); 
            
            $table->string('bukti_pembayaran')->nullable(); 
            $table->timestamp('tanggal_bayar')->nullable();
            
            $table->enum('status_pembayaran', ['Pending', 'Lunas', 'Gagal'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};