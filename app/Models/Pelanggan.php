<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; // Baris ini penting!

class Pelanggan extends Model
{
    use HasApiTokens; // Pasang di sini

    protected $fillable = [
        'nama_toko',
        'nama_pemilik',
        'email',
        'password',
        'no_hp',
        'alamat_lengkap',
        'tipe_mitra',
    ];

    protected $hidden = [
        'password',
    ];
}