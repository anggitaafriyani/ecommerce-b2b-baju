<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Models\Pengiriman; 
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $data = Pengiriman::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar pengiriman berhasil diambil',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_pesanan' => 'required|string',
            'nama_pelanggan' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'ekspedisi' => 'nullable|string',
            'no_resi' => 'nullable|string',
            'berat_kg' => 'required|integer|min:1',
            'ongkir' => 'required|integer|min:0',
            'status_pengiriman' => 'required|in:menunggu,diproses,dikirim,selesai',
        ]);

        $pengiriman = Pengiriman::create([
            'kode_pesanan' => $validatedData['kode_pesanan'],
            'nama_pelanggan' => $validatedData['nama_pelanggan'],
            'alamat_pengiriman' => $validatedData['alamat_pengiriman'],
            'ekspedisi' => $validatedData['ekspedisi'] ?? null,
            'no_resi' => $validatedData['no_resi'] ?? null,
            'berat_kg' => $validatedData['berat_kg'],
            'ongkir' => $validatedData['ongkir'],
            'status_pengiriman' => $validatedData['status_pengiriman'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengiriman berhasil dibuat',
            'data' => $pengiriman
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::find($id);
        if (!$pengiriman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengiriman tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'ekspedisi' => 'nullable|string',
            'no_resi' => 'nullable|string',
            'status_pengiriman' => 'required|in:menunggu,diproses,dikirim,selesai',
            'ongkir' => 'required|integer|min:0',
        ]);

        $pengiriman->update([
            'ekspedisi' => $request->ekspedisi ?? $pengiriman->ekspedisi,
            'no_resi' => $request->no_resi ?? $pengiriman->no_resi,
            'status_pengiriman' => $request->status_pengiriman,
            'ongkir' => $request->ongkir,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengiriman berhasil diperbarui',
            'data' => $pengiriman
        ]);

    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::find($id);
        if (!$pengiriman) {
            return response()->json([
                    'success' => false,
                    'message' => 'Pengiriman tidak ditemukan',
                ], 404);
            }

            $pengiriman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengiriman berhasil dihapus',
            ]);
        }
}