<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'no_invoice',
        'total_tagihan',
        'metode_pembayaran',
        'jumlah_dibayar',
        'bukti_pembayaran',
        'tanggal_bayar',
        'status_pembayaran',
    ];
}