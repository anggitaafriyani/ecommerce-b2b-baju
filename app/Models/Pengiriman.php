<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model; 
class Pengiriman extends Model { 
    protected $fillable = [ 
        'kode_pesanan', 
        'nama_pelanggan', 
        'alamat_pengiriman', 
        'ekspedisi', 
        'no_resi', 
        'berat_kg', 
        'ongkir', 
        'status_pengiriman', 
    ]; }
