<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pembayaran berhasil diambil',
            'data' => $payments
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_tagihan' => 'required|numeric',
            'metode_pembayaran' => 'required|in:transfer_bank,dp,termin',
            'jumlah_dibayar' => 'nullable|numeric',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $no_invoice = 'INV-' . date('Ymd') . '-' . rand(100, 999);
        $status = ($request->jumlah_dibayar >= $request->total_tagihan) ? 'Lunas' : 'Pending';

        $pathBukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $pathBukti = $request->file('bukti_pembayaran')->store('bukti_resi', 'public');
        }

        $payment = Payment::create([
            'transaksi_id' => null,
            'no_invoice' => $no_invoice,
            'total_tagihan' => $request->total_tagihan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_dibayar' => $request->jumlah_dibayar ?? 0,
            'bukti_pembayaran' => $pathBukti, 
            'tanggal_bayar' => now(),
            'status_pembayaran' => $status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Invoice berhasil dibuat',
            'data' => $payment
        ], 201);
    }

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

        if ($request->hasFile('bukti_pembayaran')) {
            if ($payment->bukti_pembayaran) {
                Storage::disk('public')->delete($payment->bukti_pembayaran);
            }
            $payment->bukti_pembayaran = $request->file('bukti_pembayaran')->store('bukti_resi', 'public');
        }

        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ], 200);
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        
        if (!$payment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        $payment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}