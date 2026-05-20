<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Mengambil semua data untuk ditampilkan di tabel
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pembayaran berhasil diambil',
            'data' => $payments
        ], 200);
    }

    // Menyimpan data tagihan baru dari form Pop-up
    public function store(Request $request)
    {
        $request->validate([
            'total_tagihan' => 'required|numeric',
            'metode_pembayaran' => 'required|in:transfer_bank,dp,termin',
            'jumlah_dibayar' => 'nullable|numeric',
        ]);

        $no_invoice = 'INV-' . date('Ymd') . '-' . rand(100, 999);

        $status = ($request->jumlah_dibayar >= $request->total_tagihan) ? 'Lunas' : 'Pending';

        $payment = Payment::create([
            'transaksi_id' => null, 
            'no_invoice' => $no_invoice,
            'total_tagihan' => $request->total_tagihan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_dibayar' => $request->jumlah_dibayar ?? 0,
            'bukti_pembayaran' => null,
            'tanggal_bayar' => now(), 
            'status_pembayaran' => $status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Invoice berhasil dibuat otomatis',
            'data' => $payment
        ], 201);
    }

    // Memperbarui nominal bayar dan status
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $payment->jumlah_dibayar = $request->jumlah_dibayar;
        
        if ($payment->jumlah_dibayar >= $payment->total_tagihan) {
            $payment->status_pembayaran = 'Lunas';
        } else {
            $payment->status_pembayaran = $request->status_pembayaran; 
        }

        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ], 200);
    }

    // Hapus data tagihan
    public function destroy($id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $payment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}