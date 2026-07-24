<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        if ($booking->status === 'Pending') {
            return redirect()->route('dashboard')->with('error', 'Reservasi ini masih menunggu konfirmasi admin.');
        }

        $booking->load('studio');

        return view('payment.show', [
            'booking' => $booking,
            'subtotal' => $booking->subtotal,
            'taxAmount' => $booking->tax_amount,
            'totalHarga' => $booking->total_harga,
            'taxRate' => config('pricing.tax_rate'),
        ]);
    }

    public function process(Request $request, Booking $booking)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:bank,qris',
        ]);

        $metode = $request->metode_pembayaran === 'qris'
            ? 'QRIS'
            : $request->bank;

        $booking->update([
            'metode_pembayaran' => $metode,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('dashboard')->with('success', 'Konfirmasi pembayaran diterima. Admin akan segera memverifikasi.');
    }
}