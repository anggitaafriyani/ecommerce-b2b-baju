<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    // 1. FUNGSI REGISTER TOKO BARU (VERSI WEB)
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

        Pelanggan::create([
            'nama_toko' => $request->nama_toko,
            'nama_pemilik' => $request->nama_pemilik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
            'tipe_mitra' => $request->tipe_mitra,
        ]);

        // Setelah daftar, langsung lempar ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi toko B2B berhasil!');
    }

    // 2. FUNGSI LOGIN (VERSI WEB / BLADE)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        // Cek akun dan kecocokan password
        if (!$pelanggan || !Hash::check($request->password, $pelanggan->password)) {
            // Jika salah, balikkan ke halaman form dengan pesan error merah
            return back()->withErrors(['email' => 'Email atau password salah, silakan cek kembali.']);
        }

        // SEARAH SAMA RINE: Jika sukses login, langsung lempar ke visual dashboard web
        return redirect('/dashboard-pelanggan');
    }
    // 3. MENAMPILKAN HALAMAN DASHBOARD + DAFTAR PELANGGAN
    public function dashboardWeb()
    {
        // Ambil semua data pelanggan dari database Laragon
        $semuaPelanggan = Pelanggan::all();

        // Kirim datanya ke file blade dashboard
        return view('dashboard-pelanggan', compact('semuaPelanggan'));
    }
}