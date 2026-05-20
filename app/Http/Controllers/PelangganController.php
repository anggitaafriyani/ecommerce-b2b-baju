<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    // 1. FUNGSI REGISTER TOKO BARU
    public function register(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'email' => 'required|string|email|unique:pelanggans,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'tipe_mitra' => 'required|in:distributor,agen,toko_retail',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_toko' => $request->nama_toko,
            'nama_pemilik' => $request->nama_pemilik,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tipe_mitra' => $request->tipe_mitra,
        ]);

        return response()->json([
            'message' => 'Registrasi toko B2B berhasil!',
            'data' => $pelanggan
        ], 201);
    }

    // 2. FUNGSI LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        // Cek akun dan kecocokan password
        if (!$pelanggan || !Hash::check($request->password, $pelanggan->password)) {
            return response()->json([
                'message' => 'Email atau password salah, silakan cek kembali.'
            ], 401);
        }

        // Generate Token Akses untuk Pelanggan tersebut
        $token = $pelanggan->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login sukses!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $pelanggan
        ]);
    }
}