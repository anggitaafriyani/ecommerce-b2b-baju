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
            'message' => 'Data pengiriman berhasil diambil',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pesanan' => 'required',
            'nama_pelanggan' => 'required',
            'alamat_pengiriman' => 'required',
            'berat_kg' => 'required|integer|min:1',
            'ongkir' => 'required|integer|min:0',
            'status_pengiriman' => 'required|in:menunggu,diproses,dikirim,selesai',
        ]);

        $pengiriman = Pengiriman::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data pengiriman berhasil ditambahkan',
            'data' => $pengiriman
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengiriman tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'ekspedisi' => 'nullable|string',
            'no_resi' => 'nullable|string',
            'ongkir' => 'required|integer|min:0',
            'status_pengiriman' => 'required|in:menunggu,diproses,dikirim,selesai',
        ]);

        $pengiriman->update([
            'ekspedisi' => $request->ekspedisi,
            'no_resi' => $request->no_resi,
            'ongkir' => $request->ongkir,
            'status_pengiriman' => $request->status_pengiriman,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pengiriman berhasil diperbarui',
            'data' => $pengiriman
        ]);
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::find($id);

        if (!$pengiriman) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengiriman tidak ditemukan'
            ], 404);
        }

        $pengiriman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengiriman berhasil dihapus'
        ]);
    }
}