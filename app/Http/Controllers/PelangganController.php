<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    // 1. Mengambil semua data pelanggan (READ via API - Status 200 OK)
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json([
            'status' => 'success',
            'data' => $pelanggan
        ], 200);
    }

    // 2. Fungsi Login API (Mengembalikan JSON Token - Status 200 OK)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        // Validasi jika email atau password salah (Status 401 Unauthorized)
        if (!$pelanggan || !Hash::check($request->password, $pelanggan->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah, silakan cek kembali.'
            ], 401);
        }

        // Generate Token Akses (Sanctum)
        $token = $pelanggan->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login sukses!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $pelanggan
        ], 200);
    }
}